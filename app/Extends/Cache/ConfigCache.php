<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Cache;

use App\Extends\Helpers\Functions;
use App\Extends\Services\System\ConfigService;
use App\Models\System\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ConfigCache
{
    /**
     * 获取配置值
     * @param string|null $type
     * @param null $default
     * @return mixed
     */
    public static function get(string $type=null,$default = null): mixed
    {
        if(!$type) return false;
        $list = self::lists();
        return isset($list[$type])?$list[$type]['value']:$default;
    }

    /**
     * 获取配置列表
     * @return array
     */
    public static function lists():array{
        return Cache::rememberForever('config_list',function (){
            $result = [];
            $lists = DB::table(Config::tableName())->select(['type','value','extra','style'])->get();
            if($lists){
                $lists = Functions::stdToArray($lists);
                $service = new ConfigService();
                foreach ($lists as $key=>$value){
                    $result[$value['type']]=$service->formatFilter($value);
                }
            }
            return $result;
        });
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Cache::forget('config_list');
    }
}
