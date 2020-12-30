<?php

namespace App\Services;

use App\Models\DictData;
use App\Validates\DictDataValidate;


/**
 * 字典数据
 * Class DictDataService
 * @package App\Services
 */
class DictDataService extends BaseService
{
    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->setModel(new DictData());
        $this->setValidate(new DictDataValidate());
    }
}
