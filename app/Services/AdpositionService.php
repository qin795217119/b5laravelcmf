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
     * 获取位置列表
     * @param bool $valKey
     * @return array|mixed|string
     */
    public function getTypeList(bool $valKey = false)
    {
        $reArr=[];
        $list=$this->getAll([],['title','type','width','height','note'],[],'type');
        if($list){
            foreach ($list as $val){
                if($valKey){
                    $reArr[$val['type']]=$val['title'];
                }else{
                    $reArr[$val['type']]=$val;
                }
            }
        }
        return $reArr;
    }
}
