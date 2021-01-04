<?php

namespace App\Services;

use App\Models\Redtype;
use App\Validates\RedtypeValidate;


/**
 * 跳转管理
 * Class RedtypeService
 * @package App\Services
 */
class RedtypeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Redtype());
        $loadValidate && $this->setValidate(new RedtypeValidate());
    }

    /**
     * 获取字典类型列表
     * @param string|null $key
     * @return array
     */
    public function getTypeList(string $key=null)
    {
        $list=(new DictDataService())->getDataList('sys_redtype_type',true,true);
        return is_null($key)?$list:(isset($list[$key])?$list[$key]:'');
    }
}
