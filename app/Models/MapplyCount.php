<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 微信预约活动统计
 * Class MapplyOrder
 * @package App\Models
 */
class MapplyCount extends BaseModel
{
    protected $table = 'b5net_mapply_count';
    public $timestamps=false;

    public static function saveCount($mid,$data){
        $nowtime=strtotime(date('Y-m-d',time()));
        $model=self::where('mid',$mid)->where('daytime',$nowtime)->first();
        if(!$model){
            $model=new self();
            $model->mid=$mid;
            $model->daytime=$nowtime;
            $model->click=0;
            $model->number=0;
            $model->money=0;
            $model->paynumber=0;
        }
        foreach ($data as $key=>$val){
            $model->$key=$model->$key+$val;
        }
        $model->save();
    }
}
