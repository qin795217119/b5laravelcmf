<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\Struct;
use App\Validates\StructValidate;


/**
 * 组织架构
 * Class MenuService
 * @package App\Services
 */
class StructService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Struct());
        $loadValidate && $this->setValidate(new StructValidate());
    }

    /**
     * 获取第一个组织架构ID
     * @return int
     */
    public function getFirstId()
    {
        $info = $this->info([['order', [['id', 'asc']]]], true);
        return $info ? $info['id'] : 0;
    }

    /**
     * 获取信息时，获取父级名称
     * @param $id
     * @param bool $isArray
     * @return mixed
     */
    public function info($id, bool $isArray = true)
    {
        $info = parent::info($id, $isArray);
        if ($info) {
            $info['parent_name'] = '-';
            if ($info['parent_id'] > 0) {
                $parentInfo = $this->model->info($info['parent_id'], true);
                if ($parentInfo) {
                    $info['parent_name'] = $parentInfo['name'];
                } else {
                    $info['parent_name'] = '不存在';
                }
            }
        }
        return $info;
    }

    /**
     * 删除时，有子组织的无法删除
     * @return array
     */
    public function drop()
    {
        $ids = request()->input('ids');
        if ($ids) {
            if (is_array($ids)) {
                $idArr = $ids;
            } else {
                $ids = trim($ids, ',');
                $idArr = explode(',', $ids);
            }
            foreach ($idArr as $id) {
                $id = intval($id);
                if ($id) {
                    $hasChild = parent::info([['parent_id', '=', $id]], true);
                    if ($hasChild) {
                        return message('不能删除含有子组织的组织', false);
                    }
                }
            }
        }
        return parent::drop(); // TODO: Change the autogenerated stub
    }

    /**
     * 组织架构树
     * @return array
     */
    public function getTree()
    {
        $list = $this->getAll([], ['id', 'parent_id', 'name'], [], '', [['parent_id', 'asc'], ['listsort', 'asc']]);
        return message('操作成功', true, $list);
    }

    /**
     * 获取某个组织的所有子组织
     * @param $id
     * @param bool $onlyId
     * @return array
     */
    public function getChildList($id,bool $onlyId=false){
        $list=[];
        if($id>0){
            if($onlyId){
                $list=$this->getAll([['levels','findinset',$id]],['id'],[],'id,id');
            }else{
                $list=$this->getAll([['levels','findinset',$id]]);
            }

        }
        return $list?:[];
    }
}
