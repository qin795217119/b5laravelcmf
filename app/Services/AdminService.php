<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\Admin;
use App\Validates\AdminValidate;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


/**
 * 人员管理
 * Class AdminService
 * @package App\Services
 */
class AdminService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Admin());
        $loadValidate && $this->setValidate(new AdminValidate());
    }
    //登录
    public function login(){
        $validator = Validator::make(request()->input(),
            [
                'username' => 'bail|required',
                'password' => 'bail|required',
                'captcha' => 'bail|required'
            ],
            [],
            ['username'=>'登录名称','password'=>'登录密码','captcha'=>'验证码']
        );
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $error = $error ?: '提交数据错误';
            return message($error,false);
        }
        $username=request()->input('username','');
        $password=request()->input('password','');
        $captcha=request()->input('captcha','');
        $remember=request()->input('remember',0);
        if(!captcha_check($captcha)){
            return $this->loginResult($username,'验证码错误',false);
        }
        $userinfo=$this->info([['username','=',$username]],true,false);
        if(empty($userinfo)){
            return $this->loginResult($username,'账号或密码错误',false);
        }
        if($userinfo['password']!=get_password($password)){
            return $this->loginResult($username,'账号或密码错误',false);
        }
        if($userinfo['status']!=1){
            return $this->loginResult($username,'该用户已被禁止登陆',false);
        }
        //获取管理员组织
        $structList=(new AdminStructService())->getListByAdmin($userinfo['id']);

        //获取管理员分组
        $roleList = (new AdminRoleService())->getListByAdmin($userinfo['id'], false, false);
        $roleName=[];
        $roleId=[];
        foreach ($roleList as $role){
            $roleId[]=$role['id'];
            $roleName[]=$role['name'];
        }
        //获取分组菜单权限ID
        $menuIdList = (new RoleMenuService())->getRoleMenuList($roleId);
        $sessionData=[
            'info'=>[
                'id'=>$userinfo['id'],
                'username'=>$userinfo['username'],
                'name'=>$userinfo['realname']
            ],
            'struct'=>$structList,
            'role'=>[
                'id'=>$roleId,
                'name'=>$roleName,
            ],
            'menu'=>$menuIdList
        ];
        app('session')->flush();
        app('session')->put(config('app.admin_session'),$sessionData);
        if($remember){
            Cookie::queue(config('app.admin_session').'_cookie',$userinfo['id'],30*24*3600);
        }
        return $this->loginResult($username,'登陆成功',true);
    }

    //修改密码
    public function repass(){
        $validator = Validator::make(request()->input(),
            [
                'oldpass' => 'bail|required|min:6|max:20|alpha_dash',
                'newpass' => 'bail|required|min:6|max:20',
                'confirmpass' => 'bail|required|min:6|max:20|same:newpass'
            ],
            [],
            ['oldpass'=>'旧密码','newpass'=>'新密码','confirmpass'=>'确认密码']
        );
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $error = $error ?: '提交数据错误';
            return message($error,false);
        }
        //演示限制
        if(system_isDemo() && get_class($this)!='App\Services\LoginlogService'){
            return $this->demo_system();
        }
        $oldpass=request()->input('oldpass','');
        $newpass=request()->input('newpass','');
        $adminId=adminLoginInfo('info.id');
        if(!$adminId) return message('登录信息错误',false);
        $adminInfo=$this->info($adminId,true,false);
        if(!$adminInfo) return message('登录信息错误',false);
        if($adminInfo['password']!=get_password($oldpass)){
            return message('旧密码错误',false);
        }
        $this->setValidate(null);
        $saveData=['id'=>$adminId,'password'=>get_password($newpass)];
        return parent::edit($saveData,'closeOpen');
    }
    /**
     * 返回登录信息 并添加登录记录
     * @param $username
     * @param $msg
     * @param $success
     * @return array
     */
    public function loginResult($username,$msg,$success){
        (new LoginlogService())->logAdd($username,$success?1:0,$msg);
        return message($msg,$success);
    }

    //退出登录
    public function logout(){
        app('session')->flush();
        Cookie::queue(Cookie::forget(config('app.admin_session').'_cookie'));
        return redirect('admin');
    }
    /**
     * 获取人员列表 基于组织架构
     * @param bool $all
     * @return array
     */
    public function getList($all = false)
    {
        $where=[];
        $structId=intval(request()->input('structId'));

        if($structId>0){
            $userList=(new AdminStructService())->getUsersByStruct($structId);
            if(!$userList){
                return message('操作成功', true, [], 0, '', ['total' => 0]);
            }else{
                $where=[['id','in',$userList]];
            }
        }
        return parent::getList($all,$where); // TODO: Change the autogenerated stub
    }

    /**
     * 人员信息返回关联信息
     * @param $id
     * @param bool $isArray
     * @param bool $extend
     * @return mixed
     */
    public function info($id, bool $isArray = true,bool $extend=true)
    {
        $info=parent::info($id, false);

        if($info && $extend){
            //组织架构信息
            $structIdStr='';
            $structNameStr='';
            $structList=$info->structs;
//            $structList=(new AdminStructService())->getListByAdmin($info['id']);
            if($structList){
                $structIdArr=[];
                $structNameArr=[];
                foreach ($structList as $structInfo){
                    $structIdArr[]=$structInfo['id'];
                    $structNameArr[]=$structInfo['name'];
                }
                $structIdStr=implode(',',$structIdArr);
                $structNameStr=implode(',',$structNameArr);
            }
            $info['structid']=$structIdStr;
            $info['structname']=$structNameStr;
            $info['structlist']=$structList?:[];

            //角色分组
            $roleIdStr='';
            $roleNameStr='';
            $roleList=$info->roles;
//            $roleList=(new AdminRoleService())->getListByAdmin($info['id']);
            if($roleList){
                $roleIdArr=[];
                $roleNameArr=[];
                foreach ($roleList as $roleInfo){
                    $roleIdArr[]=$roleInfo['id'];
                    $roleNameArr[]=$roleInfo['name'];
                }
                $roleIdStr=implode(',',$roleIdArr);
                $roleNameStr=implode(',',$roleNameArr);
            }
            $info=$info->toArray();
            $info['roleid']=$roleIdStr;
            $info['rolename']=$roleNameStr;
            $info['rolelist']=$roleList?:[];

        }
        return $info;
    }

    /**
     * 超管不可以删除
     * @return array
     */
    public function drop()
    {
        $data = request()->all();
        if ($data && isset($data['ids'])) {
            $id = $data['ids'];
            if (is_array($id)) {
                $idArr = $id;
            } else {
                $id = trim($id, ',');
                $idArr = explode(',', $id);
            }
            if (in_array(1, $idArr)) {
                return message('超级管理员无法删除', false);
            }
        }
        return parent::drop(); // TODO: Change the autogenerated stub
    }


    public function add()
    {
        if(IS_POST){
            $data = request()->input();
            unset($data['struct']);
            unset($data['role']);
            unset($data['roles']);
            return parent::add($data); // TODO: Change the autogenerated stub
        }
        return parent::add(); // TODO: Change the autogenerated stub
    }

    public function edit()
    {
        if(IS_POST){
            $data = request()->input();
            unset($data['struct']);
            unset($data['role']);
            unset($data['roles']);
            return parent::edit($data); // TODO: Change the autogenerated stub
        }
        return parent::edit(); // TODO: Change the autogenerated stub
    }

    /**
     * 删除用户后 删除对应的分组和组织
     * @param $data
     * @return bool
     */
    public function after_drop($data,$field)
    {
        (new AdminStructService())->drop($data,'admin_id');
        (new AdminRoleService())->drop($data,'admin_id');
        return parent::after_drop($data,$field); // TODO: Change the autogenerated stub
    }

    public function after_add($data)
    {
        $struct=request()->input('struct','');
        (new AdminStructService())->update($data['id'],$struct);

        $roles=request()->input('roles','');
        (new AdminRoleService())->update($data['id'],$roles);

        return parent::after_add($data); // TODO: Change the autogenerated stub
    }

    public function after_edit($data)
    {
        $struct=request()->input('struct','');
        (new AdminStructService())->update($data['id'],$struct);

        $roles=request()->input('roles','');
        (new AdminRoleService())->update($data['id'],$roles);

        return parent::after_edit($data); // TODO: Change the autogenerated stub
    }
}
