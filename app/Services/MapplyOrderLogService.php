<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\MapplyOrderLog;

/**
 * 微信预约报名订单记录
 * Class MapplyOrderLogService
 * @package App\Services
 */
class MapplyOrderLogService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new MapplyOrderLog());
    }

    public function getList($all = false)
    {
        return parent::getList($all, [], [['id', 'desc']]); // TODO: Change the autogenerated stub
    }

    public function AddLog($mapply_id,$order_id,$title,$optype,$opname,$remark=''){
        $data=[
            'mid'=>$mapply_id,
            'order_id'=>$order_id,
            'title'=>$title,
            'optype'=>$optype,
            'opname'=>$opname,
            'remark'=>$remark
        ];
        $this->add($data);
    }
}
