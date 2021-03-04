<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;

use App\Services\WebPosService;
use Illuminate\Support\Facades\Cache;

class WebPosCache
{
    /**
     * 位置列表及位置名称
     * @param string $website 某个站点的所有
     * @param null $id  某个唯一的
     * @param bool $showTitle
     * @return array|mixed|string
     */
    public static function get($website=null,$id=null,$showTitle=false){

        $list=Cache::rememberForever('webpos_list',function () use ($website){
            $list= (new WebPosService())->getAll([],['id','website','title','width','height','note'],[],'id');
            return $list?:[];
        });
        if(paramSet($website)){
            foreach ($list as $key=>$value){
                if($value['website']!==$website){
                    unset($list[$key]);
                }
            }
            if($showTitle){
                $list=arr_keymap($list,'id','title');
            }
            return $list;
        }
        if(paramSet($id)){
            if($showTitle){
                return isset($list[$id])?$list[$id]['title']:'';
            }
            return $list[$id]??[];
        }
        if($showTitle){
            $list=arr_keymap($list,'id','title');
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Cache::forget('webpos_list');
    }
}
