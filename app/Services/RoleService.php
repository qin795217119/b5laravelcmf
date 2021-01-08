<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\Role;
use App\Validates\RoleValidate;


/**
 * 权限分组管理
 * Class RoleService
 * @package App\Services
 */
class RoleService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Role());
        $loadValidate && $this->setValidate(new RoleValidate());
    }

    /**
     * 保存授权信息
     * @return array
     */
    public function saveAuth(){
        $input=request()->input();
        $id=$input['id']??0;
        $treeId=$input['treeId']??'';
        if(empty($id)) return message('参数错误',false);

        //演示限制
        if(system_isDemo()){
            return $this->demo_system();
        }

        (new RoleMenuService())->update($id,$treeId);
        return message('授权成功',true);
    }

    /**
     * 获取授权菜单
     * @param $roleId
     * @param bool $isArr
     * @return array|string
     */
    public function authList($roleId,bool $isArr=true){
        $list=[];
        if($roleId){
            $list=(new RoleMenuService())->getRoleMenuList($roleId);
        }
        $list=$isArr?($list?:[]):($list?implode(',',$list):'');
        return $list;
    }
}
