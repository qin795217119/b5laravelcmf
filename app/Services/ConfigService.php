<?php

namespace App\Services;

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
     * @return array|false|string[]|null
     */
    public function getConfig(string $key)
    {
        if (empty($key)) return null;
        $info = $this->info([['type', '=', $key]], true);
        if (empty($info)) return null;
        $value = $info['value'];
        if ($info['style'] == 'array') {
            if ($value) {
                $value = strline_array($value, ':');
            }
            $value = $value ?: [];
        }
        return $value;
    }
}
