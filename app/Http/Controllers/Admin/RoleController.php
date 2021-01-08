<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;


use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new RoleService();
    }

    public function auth(){
        if(IS_POST){
            return $this->service->saveAuth();
        }else{
            $role_id=request()->input('role_id',0);
            if(!$role_id) return $this->toError('参数错误');
            $info=$this->service->info($role_id,false);
            if(empty($info)) return $this->toError('角色信息不存在');
            $menuList=[];
            $lists=$info->menus;
            if($lists){
                foreach ($lists as $menu){
                    $menuList[]=$menu['id'];
                }
            }
            $menuList=implode(',',$menuList);

//            $menuList=$this->service->authList($role_id,false);
            return $this->render("",['info'=>$info,'menuList'=>$menuList]);
        }

    }
}
