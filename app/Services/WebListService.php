<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\WebCatCache;
use App\Models\WebList;
use App\Validates\WebListValidate;


/**
 * 站点内容
 * Class WebListService
 * @package App\Services
 */
class WebListService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WebList());
        $loadValidate && $this->setValidate(new WebListValidate());
    }

    public function after_getList($list,$param)
    {
        $website=$param['where']['website']??'';
        $catList=WebCatCache::get($website);
        if($list){
            foreach ($list as $key=>$value){
                $value['catid_name']=isset($catList[$value['catid']]['title'])?$catList[$value['catid']]['title']:'';
                $list[$key]=$value;
            }
        }

        return $list;
    }

    public function after_add($data)
    {
        $this->extDataOp($data);
        return parent::after_add($data); // TODO: Change the autogenerated stub
    }

    public function after_edit($data)
    {
        $this->extDataOp($data);
        return parent::after_edit($data); // TODO: Change the autogenerated stub
    }

    private function extDataOp($data){
        if(isset($data['imglist']) && is_array($data['imglist'])){
            $data['imglist']=implode(',',$data['imglist']);
        }
        (new WebListExtService())->beforeAddFromList($data);
    }

    public function after_drop($data,$field)
    {
        (new WebListExtService())->drop($data,$field);
        return parent::after_drop($data,$field); // TODO: Change the autogenerated stub
    }

}