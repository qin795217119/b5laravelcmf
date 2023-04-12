<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace App\Extends\Services\System;

use App\Extends\Helpers\Functions;
use App\Extends\Helpers\Result;
use App\Models\System\Admin;
use App\Models\System\Loginlog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminLoginService
{
    //错误信息
    public string $message = '';

    //用户信息
    public array $_user = [];

    //是否登录保存cookie
    public bool $cookie = false;

    /**
     * 登录操作
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse
    {
        if (!$this->validate($data)) {
            Loginlog::logAdd($data['username']??'',0,$this->message);
            return Result::error($this->message);
        }
        $user = $this->getUser('username', $data['username']);
        if (!$user) {
            Loginlog::logAdd($data['username']??'',0,'用户名或密码错误');
            return Result::error('用户名或密码错误');
        }
        if(!$this->validatePassword($data['password'])){
            Loginlog::logAdd($data['username']??'',0,$this->message);
            return Result::error($this->message);
        }

        if (!$this->loginSession($user['id'])) {
            Loginlog::logAdd($data['username']??'',0,$this->message);
            return Result::error($this->message);
        }
        $cookie = null;
        if ($this->cookie) {
            $cookie = Cookie::make(config('b5net.admin_login_cookie'), $user['id'], 24 * 60 * 10);
        }

        Loginlog::logAdd($data['username']??'',1,'登录成功');
        return Result::success('登录成功',['cookie'=>$cookie]);
    }

    /**
     * 保存登录信息
     * @param $id
     * @return bool
     */
    public function loginSession($id): bool
    {
        $user = $this->getUser('id', $id);
        if (!$user) {
            $this->message = '用户信息错误';
            return false;
        }

        if ($user['status'] != 1) {
            $this->message = '用户已被禁用，无法登录';
            return false;
        }

        $dataScope = 0; //数据权限
        $roleId = [];//角色ID数组
        $is_admin = 0;//超级管理员或者超管角色
        $menuList = []; //权限列表
        $struct = (new AdminStructService())->getStructByAdminId($user['id'],true);//组织部门

        $root_admin_id = config('b5net.root_admin_id');
        if($user['id'] == $root_admin_id){
            $is_admin = 1;
        }
        //非超管时，获取角色
        if(!$is_admin){
            $root_role_id = config('b5net.root_role_id');
            $roleList= (new AdminRoleService())->getRoleByAdmin($user['id'],true);
            if($roleList){
                foreach ($roleList as $role){
                    if(!$role['status']) continue;
                    if($role['id'] == $root_role_id){
                        $is_admin = 1;
                        break;
                    }else{
                        $dataScope += $role['data_scope'];
                        $roleId[] = $role['id'];
                    }
                }
            }
        }

        //非超管获取菜单列表
        if(!$is_admin){
            $menuList = (new RoleMenuService())->getRoleMenuList($roleId);
        }

        //非超管且无角色 无法登录
        if(!$is_admin && !$roleId){
            $this->message = '无角色分组，登录失败';
            return false;
        }

        $sessionData = [
            'info' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['realname'],
                'is_admin' => $is_admin
            ],
            'dataScope' => $is_admin?0:$dataScope,
            //预留多组织方式
            'struct' => $struct?[['id'=>$struct['id'],'name'=>$struct['name']]]:[],
            'role' => $is_admin?[]:$roleId,
            'menu' => $is_admin?[]:$menuList,
        ];
        session()->flush();
        session()->put(config('b5net.admin_login_session'), $sessionData);
        return true;
    }

    /**
     * 退出登录
     */
    public function logout(): void
    {
        session()->flush();
        Cookie::queue(cookie()->forget(config('b5net.admin_login_cookie')));
    }

    /**
     * 验证密码
     * @param $password
     * @return bool
     */
    public function validatePassword($password):bool{
        if(!$this->_user){
            $this->message = '用户信息获取失败';
            return false;
        }
        if($this->_user['password']!=md5($password)){
            $this->message = '用户名或密码错误';
            return false;
        }
        return true;
    }

    /**
     * 获取用户信息
     * @param string $field
     * @param string $value
     * @return array
     */
    public function getUser(string $field = '', $value = ''):array
    {
        if (!$this->_user) {
            if ($field && $value) {
                $user = DB::table(Admin::tableName())->where($field, $value)->first();
                $this->_user = $user?Functions::stdToArray($user):[];
            }
        }
        return $this->_user;
    }

    /**
     * 验证登录信息
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        $validator = Validator::make($data,
            [
                'username' => 'required|min:2|max:20',
                'password' => 'required|min:6|max:20',
                'captcha' => 'required|size:4'
            ],
            [],
            ['username'=>'登录名称','password'=>'登录密码','captcha'=>'验证码']
        );
        if ($validator->stopOnFirstFailure()->fails()) {
            $error = $validator->errors()->first();
            $this->message = $error ?: '提交数据错误';
            return false;
        }
        if(!captcha_check($data['captcha']??'')){
            $this->message= '验证码错误';
            return false;
        }
        if (isset($data['remember']) && $data['remember']) {
            $this->cookie = true;
        }
        return true;
    }
}
