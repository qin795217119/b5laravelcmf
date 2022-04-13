<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin\System;

use App\Extends\Helpers\Result;
use App\Extends\Libs\AdminCommonAction;
use App\Extends\Services\System\MenuService;
use App\Extends\Validates\System\MenuValidate;
use App\Models\System\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class MenuController extends System
{
    use AdminCommonAction;

    protected string $model = Menu::class;
    protected string $validate = MenuValidate::class;

    /**
     * 获取菜单列表
     * @return View|JsonResponse
     */
    public function tree(): View|JsonResponse
    {
        $root = $this->request->get('root', 0);
        if ($this->request->isMethod('POST')) {
            $list = (new MenuService())->getList($root ? true : false);
            return Result::success('', $list);
        } else {
            $id = $this->request->get('id', 0);
            return $this->render('', ['menu_id' => $id, 'root' => $root]);
        }
    }

    /**
     * 首页列表默认排序
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        $params['orderBy'] = ['parent_id' => 'asc', 'listsort' => 'asc'];
        return $params;
    }

    /**
     * 添加渲染
     * @return View
     */
    protected function addRender(): View
    {
        return $this->render('', ['typeList' => (new MenuService())->typeList()]);
    }

    /**
     * 编辑渲染
     * @param $info
     * @return View
     */
    protected function editRender($info): View
    {
        if ($info['parent_id']) {
            $parent = Menu::bFind($info['parent_id']);
            if ($parent) {
                $info['parent_name'] = $parent['name'];
            } else {
                $info['parent_name'] = '错误：' . $info['parent_id'];
            }
        } else {
            $info['parent_name'] = '顶级菜单';
        }

        return $this->render('', ['info' => $info, 'typeList' => (new MenuService())->typeList()]);
    }

    /**
     * 保存前判断
     * @param array $data
     * @param string $type
     * @return array|string
     */
    protected function saveBefore(array $data, string $type): array|string
    {
        if ($type == 'edit' && $data['parent_id'] == $data['id']) {
            return '父级不能是自己';
        }
        return $data;
    }

    /**
     * 删除前判断
     * @param array $data
     * @return bool|string
     */
    protected function deleteBefore(array $data): bool|string
    {
        $child = $this->model::bFind('', [['parent_id', '=', $data['id']]]);
        if ($child) {
            return '含有子菜单，无法删除';
        }
        return true;
    }

    /**
     * 删除后操作
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除菜单的角色授权
//        (new RoleMenuService())->deleteByMenu($data['id']);
    }
}
