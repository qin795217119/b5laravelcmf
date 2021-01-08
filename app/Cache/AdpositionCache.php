<?php
namespace App\Cache;


use App\Services\AdpositionService;
use Illuminate\Support\Facades\Cache;

class AdpositionCache
{
    /**
     * 位置列表及位置名称
     * @param string $key
     * @param bool $showTitle
     * @return mixed|string
     */
    public static function get(string $key=null,bool $showTitle=true){
        $list=Cache::rememberForever('adpositon_list',function (){
            $list= (new AdpositionService())->getAll([],['title','type','width','height','note'],[],'type');
            return $list?:[];
        });
        if(paramSet($key)){
            if($showTitle){
                return isset($list[$key])?$list[$key]['title']:null;
            }
            return $list[$key]??null;
        }
        if($showTitle){
            $list=arr_keymap($list,'type','title');
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Cache::forget('adpositon_list');
    }
}
