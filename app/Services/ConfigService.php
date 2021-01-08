<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\ConfigCache;
use App\Models\Config;
use App\Validates\ConfigValidate;


/**
 * 系统配置
 * Class ConfigService
 * @package App\Services
 */
class ConfigService extends BaseService
{

    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Config());
        $loadValidate && $this->setValidate(new ConfigValidate());
    }

    /**
     * 配置类型
     * @param null $type
     * @return array|mixed|string
     */
    public function styleList($type = null)
    {
        $styleList = ['text' => '文本', 'array' => '数组', 'select' => '枚举'];
        if (!is_null($type)) {
            return $styleList[$type] ?? '';
        }
        return $styleList;
    }

    /**
     * 获取配置信息
     * @param string $key
     * @param bool $isVal
     * @return array|false|string[]|null
     */
    public function getConfig(string $key,bool $isVal=true)
    {
        if (empty($key)) return null;
        $info = $this->info([['type', '=', $key]], true);
        if (empty($info)) return null;
        $info=$this->formatConfig($info);
        if($isVal){
            return $info['value'];
        }else{
            return $info;
        }
    }

    /**
     * 对配置的数组和枚举进行处理
     * @param $info
     * @return array
     */
    public function formatConfig($info){
        if(empty($info)) return [];
        $value = $info['value'];
        if ($info['style'] == 'array') {
            if ($value) {
                $value = strline_array($value, ':');
            }
            $value = $value ?: [];
        }
        $info['value']=$value;

        $extra=$info['extra'];
        if($info['style']=='select'){
            if ($extra) {
                $extra = strline_array($extra, ':');
            }
            $extra = $extra ?: [];
        }
        $info['extra']=$extra;
        return $info;
    }
    /**
     * 清除缓存
     * @return array
     */
    public function delcache(){
        ConfigCache::clear();
        return message('清理缓存完成', true);
    }
}
