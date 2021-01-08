<?php
namespace App\Cache;

//
// 获取配置值使用  ConfigCache::get('配置标识')
// 若获取枚举选项  ConfigCache::get('配置标识',false)
//

use App\Services\ConfigService;
use Illuminate\Support\Facades\Cache;

class ConfigCache
{
    /**
     * 获取配置值或枚举选项
     * @param string|null $type
     * @param bool $isVal true获取值 false获取枚举选项
     * @return mixed|null
     */
    public static function get(string $type=null,$isVal=true){
        $info=self::getType($type);
        if(empty($info)) return null;
        return $isVal?$info['value']:$info['extra'];
    }
    /**
     * 获取配置信息
     * @param string $type
     * @return mixed|string
     */
    public static function getType(string $type=null){
        if(!paramSet($type)){
            return null;
        }
        if(config('cache.default')=='redis'){
            $info=Cache::tags('config_list')->rememberForever($type,function () use ($type){
                $info=(new ConfigService())->getConfig($type,false);
                if(empty($info)) return null;
                return [
                    'title'=>$info['title'],
                    'value'=>$info['value'],
                    'extra'=>$info['extra']
                ];
            });
        }else{
            $list=Cache::rememberForever('config_list',function (){
                $service=new ConfigService();
                $lists=$service->getAll([],['type','value','extra','style']);
                $list=[];
                if($lists){
                    foreach ($lists as $info){
                        $list[$info['type']]=$service->formatConfig($info);
                    }
                }
                unset($lists);
                return $list;
            });
            $info=$list[$type]??[];
        }
        return $info?:[];
    }


    /**
     * 清除所有
     */
    public static function clear(){
        if(config('cache.default')=='redis') {
            Cache::tags('config_list')->flush();
        }else{
            Cache::forget('config_list');
        }
    }
}
