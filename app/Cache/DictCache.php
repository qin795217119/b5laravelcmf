<?php
namespace App\Cache;


use App\Services\DictDataService;
use App\Services\DictTypeService;
use Illuminate\Support\Facades\Cache;

class DictCache
{
    /**
     * 字典类型及获取类型名称
     * @param string $key
     * @return mixed|string
     */
    public static function getType(string $key=null){
        $list=Cache::rememberForever('dict_type_list',function (){
            $list= (new DictTypeService())->getAll([],['name','type'],[],'type,name');
            return $list?:[];
        });
        if(paramSet($key)){
            return $list[$key]??null;
        }
        return $list;
    }

    /**
     * 获取某个字典类型下得数据列表及数据名
     * @param string|null $type 字典类型
     * @param string|null $value 数据值
     * @param bool $valid 是否只取有效数据
     * @return array|null
     */
    public static function getData(string $type=null,string $value=null,bool $valid=false){
        if(!paramSet($type)){
            return null;
        }
        $list=Cache::tags('dict_datalist')->rememberForever($type,function () use ($type){
            if(is_null(self::getType($type))){
                return null;
            }
            $list=(new DictDataService())->getAll([['type','=',$type]],['name','value','status'],[],'value',[['listsort','asc'],['id','asc']]);
            return $list?:[];
        });
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
     * 字典相关清除所有
     */
    public static function clear(){
        Cache::forget('dict_type_list');
        Cache::tags('dict_datalist')->flush();
    }
}
