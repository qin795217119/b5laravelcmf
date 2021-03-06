<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\WebCatCache;
use App\Models\WebCat;
use App\Validates\WebCatValidate;


/**
 * 站点菜单
 * Class WebMenuService
 * @package App\Services
 */
class WebCatService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WebCat());
        $loadValidate && $this->setValidate(new WebCatValidate());
    }

    /**
     * 内容类型
     * @param null $type
     * @return array|mixed|string
     */
    public function typeList($type=null){
        $arr=[
            'list' => '图文信息',
            'goods' => '产品信息',
            'page' => '单页介绍',
            'link' => '外链跳转',
            'none' => '无类型'
        ];
        if(is_null($type)) return $arr;
        return $arr[$type]??'';
    }

    public function after_getList($list,$param)
    {
        if($list){
            foreach ($list as $key=>$value){
                $list[$key]['type_name']=$this->typeList($value['type']);
            }
        }
        return parent::after_getList($list,$param); // TODO: Change the autogenerated stub
    }

    /**
     * 获取菜单信息时返回父菜单名称
     * @param $id
     * @param bool $isArray
     * @return mixed
     */
    public function info($id, bool $isArray = true)
    {
        $info = parent::info($id, $isArray);
        if ($info) {
            $info['parent_name'] = '顶级菜单';
            if ($info['parent_id'] > 0) {
                $parentInfo = $this->model->info($info['parent_id'], true);
                if ($parentInfo) {
                    $info['parent_name'] = $parentInfo['name'];
                } else {
                    $info['parent_name'] = '';
                }
            }
            if($info['type']) $info['type_name']=$this->typeList($info['type']);
            if($info['website']) {
                $websiteInfo=(new WebSiteService())->info($info['website']);
                $info['website_info']=$websiteInfo??[];
            }
        }
        return $info;
    }

    /**
     * 选择父级菜单的菜单树数据
     * @return array
     */
    public function getTree()
    {
        $website=request()->input('website', '');
        if($website){
            $list = $this->getAll([['website','=',$website]], ['id', 'parent_id', 'title as name','type'], [], '', [['parent_id', 'asc'], ['listsort', 'asc'],['id','asc']]);
        }else{
            $list=[];
        }
        $root = request()->input('root', 1);
        if ($root) {
            $first = [
                'id' => 0,
                'parent_id' => -1,
                'name' => '顶级菜单',
                'type' => 'none'
            ];
            array_unshift($list, $first);
        }
        return message('操作成功', true, $list);
    }

    /**
     * 获取某个分类的所有子分类
     * @param $pid
     * @param array $reList
     * @return array
     */
    public function getChildList($pid,&$reList=[]){
        $chList=$this->getAll([['parent_id','=',$pid]],['id','parent_id']);
        if($chList){
            foreach ($chList as $val){
                if($val['id']!=$val['parent_id'] && !in_array($val['id'],$reList)){
                    $reList[]=$val['id'];
                    $this->getChildList($val['id'],$reList);
                }
            }
        }
        return $reList;
    }

    public function after_edit($data)
    {
        if(isset($data['website'])){
            $website=$data['website'];
        }else{
            $info=$this->info($data['id']);
            $website=$info?$info['website']:'';
        }
        WebCatCache::clear($website);
        return parent::after_edit($data); // TODO: Change the autogenerated stub
    }

    public function after_add($data)
    {
        WebCatCache::clear($data['website']);
        return parent::after_add($data); // TODO: Change the autogenerated stub
    }

    public function after_drop($data, $field)
    {
        if($field==='website'){
            $id=$data['ids']??[];
            if (is_array($id)) {
                $idArr = $id;
            } else {
                $id = trim($id, ',');
                $idArr = explode(',', $id);
            }
            $idArr = array_unique($idArr);
            if($idArr){
                foreach ($idArr as $val){
                    $this->delcache($val);
                }
            }
        }
        return parent::after_drop($data, $field); // TODO: Change the autogenerated stub
    }

    /**
     * 清除缓存
     * @return array
     */
    public function delcache($website=null){
        if(!$website){
            $website=request()->input('website','');
        }
        WebCatCache::clear($website);
        return message('清理缓存完成', true);
    }
}
