<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;

use App\Services\WebSiteService;
use Illuminate\Support\Facades\Cache;

class WebSiteCache
{

    /**
     * 获取所有站点列表
     * @param $website
     * @return |null
     */
    public static function get($website=null)
    {
        $key='website_list';
        $list=Cache::rememberForever($key,function (){
            $list = (new WebSiteService())->getAll([],[],[],'id',[]);
            $keyList=[];
            foreach ($list as $val){
                $keyList[$val['code']]=$val['id'];
            }
            Cache::add('website_list_code',$keyList);
            return $list ?: [];
        });
        if(!is_null($website)){
            return $list[$website]??[];
        }
        return $list;
    }

    public static function getByCode($website=null)
    {
        $key='website_list_code';
        $list=Cache::rememberForever($key,function (){
            $list = (new WebSiteService())->getAll([],['id','code','status','name','title'],[],'code',[]);
            return $list ?: [];
        });
        if(!is_null($website)){
            return $list[$website]??[];
        }
        return $list;
    }
    /**
     * 字典相关清除所有
     */
    public static function clear()
    {
        Cache::forget('website_list');
        Cache::forget('website_list_code');
    }
}
