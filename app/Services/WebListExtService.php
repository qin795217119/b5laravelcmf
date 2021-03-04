<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\WebListExt;

/**
 * 站点内容其他信息
 * Class WebListExtService
 * @package App\Services
 */
class WebListExtService extends BaseService
{
    public function __construct()
    {
        $this->setModel(new WebListExt());
    }

    public function beforeAddFromList($data){
        if($data && isset($data['id'])){
            $delres=$this->model->drop($data['id']);
            if($delres!==false){
                $fieldArr=$this->model->getAttributes();
                if($fieldArr){
                    $opData=[];
                    foreach ($fieldArr as $field=>$deval){
                        $opData[$field]=$data[$field]??$deval;
                    }
                    return $this->add($opData);
                }
            }
        }
        return message('失败',false);
    }
}
