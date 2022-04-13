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
use App\Extends\Services\System\AdminStructService;
use App\Extends\Services\System\RoleStructService;
use App\Extends\Services\System\StructService;
use App\Extends\Validates\System\StructValidate;
use App\Models\System\Struct;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class StructController extends System
{
    use AdminCommonAction;

    protected string $model = Struct::class;
    protected string $validate = StructValidate::class;

    /**
     * 首页渲染
     * @return View
     */
    protected function indexRender(): View
    {
        $root_id = config('b5net.root_struct_id');
        return $this->render('', ['root_id' => $root_id]);
    }

    /**
     * 查询列表前
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        $params['orderBy'] = ['parent_id' => 'asc', 'listsort' => 'asc'];
        return $params;
    }

    /**
     * 添加页渲染
     * @return View
     */
    protected function addRender(): View
    {
        $root_id = config('b5net.root_struct_id');
        $rootInfo = $this->model::bFind($root_id);
        if (!$rootInfo) {
            return $this->toError("根组织错误，请添加根组织ID：" . $root_id);
        }
        return $this->render('', ['root_id' => $root_id, 'root_name' => $rootInfo['name']]);
    }

    /**
     * 编辑页渲染
     * @param array $info
     * @return View
     */
    protected function editRender(array $info): View
    {
        if ($info['parent_id']) {
            $info['parent_name'] = implode('-', explode(',', $info['parent_name']));
        } else {
            $info['parent_name'] = '顶级部门';
        }
        $root_id = config('b5net.root_struct_id');
        return $this->render('', ['info' => $info, 'root_id' => $root_id]);
    }

    /**
     * 添加和编辑保存前 处理 父级信息
     * @param array $data
     * @param string $type
     * @return array|string
     */
    protected function saveBefore(array $data, string $type): array|string
    {
        if ($type == 'add' || $type == 'edit') {
            $root_id = config('b5net.root_struct_id');
            $parent_id = $data['parent_id'] ?? '';
            if ($type == 'add' && !$parent_id) {
                return '不能添加顶级部门';
            }
            if ($type == 'edit' && $data['id'] == $root_id && $parent_id) {
                return '顶级部门不能修改上级部门';
            }
            if ($parent_id) {
                $parentInfo = $this->model::bFind($parent_id);
                if (!$parentInfo) {
                    return '上级部门信息不存在';
                }
                $data['parent_name'] = trim($parentInfo['parent_name'] . ',' . $parentInfo['name'], ',');
                $data['levels'] = trim($parentInfo['levels'] . ',' . $parentInfo['id'], ',');
            }
        }
        return $data;
    }

    /**
     * 修改后 进行parent_name和levels更新
     * @param array $data
     * @param string $type
     */
    protected function saveAfter(array $data, string $type): void
    {
        if ($type == 'edit') {
            (new StructService())->updateExtendField($data['id']);
        }
    }

    /**
     * @return View|JsonResponse
     */
    public function tree(): View|JsonResponse
    {
        if ($this->request->isMethod('POST')) {
            $list = (new StructService())->getList();
            return Result::success('', $list);
        } else {//是否显示父级名称
            $parent = $this->request->get('parent', 0);
            $id = $this->request->get('id', 0);
            return $this->render('', ['struct_id' => $id, 'parent' => $parent]);
        }
    }

    /**
     * 删除后操作
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除管理员组织信息
        (new AdminStructService())->deleteByStruct($data['id']);

        //删除角色数据权限信息
        (new RoleStructService())->deleteByStruct($data['id']);
    }
}
