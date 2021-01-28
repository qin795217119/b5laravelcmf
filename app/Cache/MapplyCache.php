<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;

use App\Services\MapplyService;
use Illuminate\Support\Facades\Cache;

class MapplyCache
{

    /**
     * 获取某个推荐位信息列表
     * @param $id
     * @return |null
     */
    public static function get($id)
    {
        if (!paramSet($id) || !$id) {
            return [];
        }
        $key='mapply_'.$id;
        $mapply=Cache::rememberForever($key,function () use ($id){
            $info = (new MapplyService())->info($id);
            if($info){
                $info['banner']=get_image_url($info['banner']);
                $info['share_img']=get_image_url($info['share_img']);
            }
            return $info ?: [];
        });
        return $mapply;
    }


    /**
     * 字典相关清除所有
     * @param $ids
     */
    public static function clear($ids=null)
    {
        if (empty($ids)){
            $ids=(new MapplyService())->getAll([],['id'],[],'id,id');
        }
        if (is_array($ids)) {
            $idArr = $ids;
        } else {
            $ids = trim($ids, ',');
            $idArr = explode(',', $ids);
        }
        $idArr = array_unique($idArr);
        foreach ($idArr as $id){
            Cache::forget('mapply_'.$id);
        }
    }
}
