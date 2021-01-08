<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;


use App\Services\DictDataService;
use App\Services\DictTypeService;
use Illuminate\Support\Facades\Cache;

class DictCache
{
    /**
     * 获取某个字典类型下得数据列表及数据名
     * @param string|null $type 字典类型
     * @param string|null $value 数据值
     * @param bool $valid 是否只取有效数据
     * @return array|null
     */
    public static function get(string $type=null,string $value=null,bool $valid=true){
        if(!paramSet($type)){
            return null;
        }

        if(config('cache.default')=='redis'){
            $list=Cache::tags('dict_datalist')->rememberForever($type,function () use ($type){
                if(is_null(self::getType($type))){
                    return null;
                }
                $list=(new DictDataService())->getAll([['type','=',$type]],['name','value','status'],[],'value',[['listsort','asc'],['id','asc']]);
                return $list?:[];
            });
        }else{
            $lists=Cache::rememberForever('dict_datalist',function (){
                $list=(new DictDataService())->getAll([],['type','name','value','status'],[],'',[['type','asc'],['listsort','asc'],['id','asc']]);
                return $list?:[];
            });
            $list=[];
            foreach ($lists as $val){
                if($val['type']==$type){
                    $list[$val['value']]=$val;
                }
            }
        }
        if(paramSet($value)){
            return isset($list[$value])?$list[$value]['name']:null;
        }
        $dataList=[];
        if($list){
            foreach ($list as $value){
                if(!$valid || ($valid && $value['status']=='1')){
                    $dataList[$value['value']]=$value['name'];
                }
            }
        }
        return $dataList;
    }


    /**
     * 字典类型及获取类型名称
     * @param string $key
     * @return mixed|string
     */
    public static function getType(string $key=null){
        $list=Cache::rememberForever('dict_typelist',function (){
            $list= (new DictTypeService())->getAll([],['name','type'],[],'type,name');
            return $list?:[];
        });
        if(paramSet($key)){
            return $list[$key]??null;
        }
        return $list;
    }


    /**
     * 清除所有
     */
    public static function clear(){
        Cache::forget('dict_typelist');
        if(config('cache.default')=='redis'){
            Cache::tags('dict_datalist')->flush();
        }else{
            Cache::forget('dict_datalist');
        }
    }
}
