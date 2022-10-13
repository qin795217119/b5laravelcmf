<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin\System;


use App\Extends\Helpers\Admin\DataScope;
use App\Extends\Helpers\Result;
use App\Extends\Libs\AdminCommonAction;
use App\Extends\Services\System\AdminRoleService;
use App\Extends\Services\System\RoleMenuService;
use App\Extends\Services\System\RoleStructService;
use App\Extends\Validates\System\RoleValidate;
use App\Models\System\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class RoleController extends System
{
    use AdminCommonAction;

    protected string $model = Role::class;
    protected string $validate = RoleValidate::class;

    /**
     * 首页渲染
     * @return View
     */
    protected function indexRender(): View
    {
        $root_id = config('b5net.root_role_id');
        return $this->render('', ['root_id' => $root_id]);
    }

    /**
     * 角色授权
     * @return View|JsonResponse
     */
    public function auth(): View|JsonResponse
    {
        if ($this->request->isMethod('POST')) {
            $role_id = $this->request->post('id', 0);
            $treeId = $this->request->post('treeId', '');
            $result = (new RoleMenuService())->update($role_id, $treeId);
            if (!$result) {
                return Result::error('授权发生错误');
            }
            return Result::success();
        } else {
            $role_id = $this->request->get('role_id', 0);
            if (!$role_id) return $this->toError('参数错误');
            $info = $this->model::bFind($role_id);
            if (empty($info)) return $this->toError('角色信息不存在');
            $menuList = (new RoleMenuService())->getRoleMenuList($role_id);
            return $this->render("", ['info' => $info, 'menuList' => implode(',', $menuList)]);
        }
    }

    /**
     * 角色数据权限
     * @return View|JsonResponse
     */
    public function datascope(): View|JsonResponse
    {
        if ($this->request->isMethod('POST')) {
            $role_id = $this->request->post('id', 0);
            if (!$role_id) {
                return Result::error('参数错误');
            }
            $info = Role::bFind($role_id);
            if (empty($info)) {
                return $this->toError('角色信息不存在');
            }
            $dataList = DataScope::typeList();//数据范围列表
            $data_scope = $this->request->post('data_scope', '');
            if (!$data_scope || !array_key_exists($data_scope, $dataList)) {
                return Result::error('请选择数据范围');
            }
            $treeId = $this->request->post('treeId', '');
            $result = (new RoleStructService())->update($role_id, $data_scope == '8' ? $treeId : '');
            if (!$result) {
                return Result::error('发生错误了');
            }

            $result = Role::bUpdate(['id' => $role_id, 'data_scope' => $data_scope]);
            if ($result === false) {
                return Result::error('数据保存失败');
            }

            return Result::success();
        } else {
            $role_id = $this->request->get('role_id', 0);
            if (!$role_id) {
                return $this->toError('参数错误');
            }
            $info = Role::bFind($role_id);
            if (empty($info)) {
                return $this->toError('角色信息不存在');
            }
            $typeList = DataScope::typeList();//数据范围列表
            $userStruct = RoleStructService::getRoleStructList($role_id);
            return $this->render("", ['info' => $info, 'typeList' => $typeList, 'userStruct' => implode(',', $userStruct)]);
        }
    }

    /**
     * 删除前判断
     * @param array $data
     * @return bool|string
     */
    protected function deleteBefore(array $data): bool|string
    {
        $root_id = config('b5net.root_role_id');
        if ($data['id'] == $root_id) {
            return '默认超管角色无法删除';
        }
        return true;
    }

    /**
     * 删除角色后
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除对应的管理员角色信息
        (new AdminRoleService())->deleteByRole($data['id']);

        //删除对应的权限菜单信息
        (new RoleMenuService())->deleteByRole($data['id']);

        //删除对应角色数据权限信息
        (new RoleStructService())->deleteByRole($data['id']);
    }
}
