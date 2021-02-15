<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace App\Helpers\Util;

use App\Helpers\Util\PayMent\Wechatpay;
use App\Models\MapplyCount;
use App\Models\MapplyOrder;
use App\Services\MapplyOrderLogService;
use Illuminate\Support\Facades\Log;

class PayApi
{
    public static function run($order,$isMobile=false,$isApp=false){
        $rearr=['status'=>0,'msg'=>'','data'=>'','pay_type'=>$order['pay_type']];

        if(!isset($order['order_sn']) || !$order['order_sn']) {
            $rearr['msg']='订单号错误';
            return $rearr;
        }
        if(!isset($order['order_money']) || $order['order_money']<=0) {
            $rearr['msg']='订单金额错误';
            return $rearr;
        }
        if(!isset($order['pay_type']) || !$order['pay_type']) {
            $rearr['msg']='支付方式错误';
            return $rearr;
        }

        if ($order['pay_type']=='wechat'){
            //微信支付分为APP（手机APP），MWEB（H5非微信），JSAPI（H5微信），NATIVE（PC网站）
            //$isMobile=false ，$isApp=false 时为 NATIVE
            //$isMobile=true  ，$isApp=true  时为 JSAPI
            //$isMobile=false ，$isApp=true  时为 APP
            //$isMobile=true  ，$isApp=false 时为 MWEB

            $res= (new Wechatpay())->pay($order,$isMobile,$isApp);
            $rearr['status']=$res['status'];
            $rearr['msg']=$res['msg'];
            $rearr['data']=$res['data']??[];
            return $rearr;
        }else{
            $rearr['msg']='支付方式错误';
            return $rearr;
        }
    }
    /**
     * 订单支付成功后的更新等操作
     * @param $out_trade_no string 订单号
     * @param $trade_no string 第三方订单号
     * @param $total_amount
     * @return bool
     */
    public static function orderprocess($out_trade_no,$trade_no,$total_amount){
        if(!$out_trade_no || !$trade_no || $total_amount<=0){
            Log::info('参数错误',['out_trade_no'=>$out_trade_no,'trade_no'=>$trade_no,'total_amount'=>$total_amount]);
            return false;
        }
        $firstword=substr($out_trade_no,0,2);
        if($firstword=='10'){
            $order_info=MapplyOrder::where('order_sn',$out_trade_no)->first();
            if(!$order_info) {
                Log::info('订单不存在',['out_trade_no'=>$out_trade_no,'trade_no'=>$trade_no,'total_amount'=>$total_amount]);
                return false;
            }
            //判断状态和金额
            if($order_info->is_pay==1) return true;
            if($order_info->money!=$total_amount) {
                Log::info('金额不正确',['out_trade_no'=>$out_trade_no,'trade_no'=>$trade_no,'total_amount'=>$total_amount,'order_money'=>$order_info['money']]);
                return false;
            }
            //更新状态
            $order_info->is_pay=1;
            $order_info->paytime=time();
            $order_info->trade_no=$trade_no;
            if($order_info->save()){
                (new MapplyOrderLogService())->AddLog($order_info->mid,$order_info->id, '支付订单', 1,'');
                MapplyCount::saveCount($order_info->mid,['paynumber'=>1,'money'=>$order_info->money]);
                return true;
            }
            Log::info('订单更新失败',['out_trade_no'=>$out_trade_no,'trade_no'=>$trade_no,'total_amount'=>$total_amount,'order_money'=>$order_info['money']]);
        }
        return false;
    }
}
