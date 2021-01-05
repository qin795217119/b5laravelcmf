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
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new DictData());
        $loadValidate && $this->setValidate(new DictDataValidate());
    }

    /**
     * 获取某个字典数据列表
     * @param string $key
     * @param bool $valKey
     * @param bool $isable
     * @return array
     */
    public function getDataList(string $key = '', bool $valKey = false,bool $isable=false)
    {
        $reArr=[];
        if (empty($key)) return $reArr;
        $list = $this->getAll([['type', '=', $key]], ['name', 'value', 'status'], [], 'value', [['listsort', 'asc'], ['id', 'asc']]);
        if($list){
            foreach ($list as $val){
                if($isable && !$val['status']) continue;
                if($valKey){
                    $reArr[$val['value']]=$val['name'];
                }else{
                    $reArr[$val['value']]=$val;
                }
            }
        }
        return $reArr;
    }

    /**
     * 获取字典数据名称
     * @param string $key
     * @param string $value
     * @return string
     */
    public function getDataName(string $key = '', string $value = '')
    {
        if (empty($key) || $value === '') return '';
        $info = $this->info([['type', '=', $key], ['value', '=', $value]], true);
        return $info ? $info['name'] : '';
    }
}
