<?php

namespace App\Services;

use App\Models\Adposition;
use App\Validates\AdpositionValidate;


/**
 * 推荐位置
 * Class AdpositionService
 * @package App\Services
 */
class AdpositionService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Adposition());
        $loadValidate && $this->setValidate(new AdpositionValidate());
    }

    /**
     * 获取字典类型列表
     * @return mixed
     */
    public function getTypeList()
    {
        return $this->getAll([], ['type', 'title'], [], '');
    }
}
