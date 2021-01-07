<?php
namespace App\Cache;


use App\Services\AdpositionService;
use Illuminate\Support\Facades\Cache;

class AdpositionCache
{
    /**
     * 位置列表及位置名称
     * @param string $key
     * @return mixed|string
     */
    public static function getType(string $key=null){
        $list=Cache::rememberForever('adpositon_list',function (){
            $list= (new AdpositionService())->getAll([],['title','type'],[],'type,title');
            return $list?:[];
        });
        if(paramSet($key)){
            return $list[$key]??null;
        }
        return $list;
    }

    /**
     * 字典相关清除所有
     */
    public static function clear(){
        Cache::forget('adpositon_list');
    }
}
