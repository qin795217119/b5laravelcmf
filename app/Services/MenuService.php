<?php

namespace App\Services;

use App\Models\Menu;
use App\Validates\MenuValidate;


/**
 * 菜单管理
 * Class MenuService
 * @package App\Services
 */
class MenuService extends BaseService
{
    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->setModel(new Menu());
        $this->setValidate(new MenuValidate());
    }

    public function info($id, bool $isArray = true)
    {
        $info=parent::info($id, $isArray);
        if($info){
            $info['parent_name']='主目录';
            if($info['parent_id']>0){
                $parentInfo=$this->model->info($info['parent_id'],true);
                if($parentInfo){
                    $info['parent_name']=$parentInfo['name'];
                }else{
                    $info['parent_name']='不存在';
                }
            }
        }
        return $info;
    }
    public function getTree(){
        $list=$this->model->getList([],['id','parent_id','name'],[],'',[['parent_id','asc'],['listsort','asc']]);
        $first=[
           'id'=>0,
           'parent_id'=>'',
           'name'=>'根目录'
        ];
        if($list){
            array_unshift($list,$first);
        }
        return message('操作成功',true,$list);
    }
}
