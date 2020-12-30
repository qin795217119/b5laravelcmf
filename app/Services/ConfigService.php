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
    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->setModel(new Config());
        $this->setValidate(new ConfigValidate());
    }

    public function getStyleList($type=null){
        $list=$this->model->styleList;
        if(!is_null($type)){
            return $list[$type]??'';
        }
        return $list;
    }
}
