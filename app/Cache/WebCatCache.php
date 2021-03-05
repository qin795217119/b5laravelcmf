<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;

use App\Services\WebCatService;
use Illuminate\Support\Facades\Cache;

class WebCatCache
{

    /**
     * 获取某个站点的所有菜单
     * @param $website
     * @param $id
     * @return |null
     */
    public static function get($website,$id=null)
    {
        if (!paramSet($website) || !$website) {
            return [];
        }
        $key='webcat_'.$website;
        $reList=Cache::rememberForever($key,function () use ($website){
            $list=(new WebCatService())->getAll([['website','=',$website]],[],[],'id',[['parent_id','asc'],['listsort','asc'],['id','asc']]);
            return $list ?: [];
        });
        if(!is_null($id)){
            return $reList[$id]??[];
        }
        return $reList;
    }

    /**
     * 相关清除
     * @param $ids
     */
    public static function clear($website)
    {
        if($website){
            Cache::forget('webcat_'.$website);
        }
    }
}
