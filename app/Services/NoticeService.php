<?php

namespace App\Services;

use App\Models\DictData;
use App\Validates\DictDataValidate;


/**
 * 通知公告
 * Class NoticeService
 * @package App\Services
 */
class NoticeService extends BaseService
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
