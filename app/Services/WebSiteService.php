<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\WebSiteCache;
use App\Models\WebSite;
use App\Validates\WebSiteValidate;


/**
 * 站点管理
 * Class WebSiteService
 * @package App\Services
 */
class WebSiteService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WebSite());
        $loadValidate && $this->setValidate(new WebSiteValidate());
    }

    /**
     * 获取站点列表
     * @return mixed
     */
    public function getSiteList()
    {
        $list=WebSiteCache::get();
        if($list){
            foreach ($list as $key=>$value){
                $list[$key]=$value['title'];
            }
        }
        return $list;
    }

    public function after_drop($data,$field)
    {
        (new WebCatService())->drop($data,'website');
        (new WebPosService())->drop($data,'website');
        (new WebAdService())->drop($data,'website');
        (new WebListService())->drop($data,'website');
        $this->delcache();
        return parent::after_drop($data,$field); // TODO: Change the autogenerated stub
    }

    public function after_add($data)
    {
        $this->delcache();
        return parent::after_add($data); // TODO: Change the autogenerated stub
    }

    public function after_edit($data)
    {
        $this->delcache();
        return parent::after_edit($data); // TODO: Change the autogenerated stub
    }


    /**
     * 清除缓存
     * @return array
     */
    public function delcache($all=false){
        WebSiteCache::clear();
        if($all){

        }

        return message('清理缓存完成', true);
    }
}
