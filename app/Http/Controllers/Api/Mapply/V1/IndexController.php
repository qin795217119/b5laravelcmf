<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Api\Mapply\V1;

use App\Helpers\Util\PayApi;
use App\Helpers\Util\WechatApi;
use App\Http\Controllers\Api\ApiController;
use App\Models\MapplyOrder;
use App\Services\MapplyOrderService;
use App\Services\MapplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IndexController extends ApiController
{
    public $web_url='http://192.168.31.115:8080';

    /**
     * 活动首页
     * @param Request $request
     * @return array
     */
    public function index(Request $request){
        $signPackage=(new WechatApi())->signPackage($request->post('signurl',''));
        return message('操作成功',true,['info'=>$request->get('mapplyInfo'),'signpackage'=>$signPackage['data']]);
    }

    /**
     * 活动提交信息
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function add(Request $request){
        $mapplyInfo=$request->get('mapplyInfo');
        $nowdate=date('Y-m-d H:i:s',time());
        if($mapplyInfo['start_time'] && $mapplyInfo['start_time']>$nowdate){
            return message('活动报名未开始',false);
        }
        if($mapplyInfo['end_time'] && $mapplyInfo['end_time']<$nowdate){
            return message('活动报名已结束',false);
        }
        if ($mapplyInfo['status'] != 1) {
            return message('活动报名已关闭',false);
        }
        //判断后台定义的注册字段信息并进行验证
        $regfield = $mapplyInfo['regfield'];
        if (!$mapplyInfo['regfield']) {
            return message('该活动不需要报名',false);
        }
        $fdata = [];
        foreach ($regfield as $field => $fieldinfo) {
            $fieldval = trim($request->post($field, ''));
            $checkres = (new MapplyService())->checkExtField($field, $fieldval, $fieldinfo['title'], $fieldinfo['require']);
            if (!$checkres['success']) {
                return $checkres;
            }
            $fdata[$field] = $fieldval;
        }
        $userInfo=$request->get('userInfo');
        $lastinfo = (new MapplyOrderService())->info([['mid' ,'=', $mapplyInfo['id']], 'openid' => $userInfo['openid']]);
        if($mapplyInfo['is_multi']){
            $difftime = time() - 30;
            if ($lastinfo && strtotime($lastinfo['create_time']) > $difftime) {
                return message('操作太频繁，请稍后再试',false);
            }
        }else{
            if($lastinfo) return message('您已经预约过了，请不要重复预约',false);
        }

        $data=[
            'mid' => $mapplyInfo['id'],
            'openid' => $userInfo['openid'],
            'money' => floatval($mapplyInfo['money']),
            'order_title' => $mapplyInfo['title'],
            'order_sn' => '1'.time() .str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'ip' => Request::ip()
        ];
        foreach ($fdata as $fkey => $fval) {
            $data[$fkey] = $fval;
        }

        if ($mapplyInfo['money'] > 0) {
            $data['is_pay'] = 0;
            $data['paytime'] = 0;
        } else {
            $data['is_pay'] = 1;
            $data['paytime'] = time();
        }
        $data['status'] = 0;
        $data['create_time']=$nowdate;
        $data['update_time']=$nowdate;
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $order_id=MapplyOrder::insertGetId($data);
            if($order_id) {
                //保存成功添加订单记录
//                MapplyOrderLog::AddLog($data['mid'],$order_id, '创建订单', 1, $userInfo['nickname']);
                if ($data['money'] > 0) {
                    $paydata = [];
                    $paydata['order_sn'] = $data['order_sn'];
                    $paydata['order_title'] = $data['order_title'];
                    $paydata['order_id'] = $order_id;
                    $paydata['order_money'] = $data['money'];
                    $paydata['openid'] = $data['openid'];
                    $paydata['pay_type'] = 'wechat';
                    $paydata['ip'] = $data['ip'];
                    $paydata['order_remark'] = 'mapply_' . $order_id.'_'.$userInfo['openid'];
                    $res = PayApi::run($paydata, 'jsapi');
                    if ($res) {
                        if ($res['status']) {
                            $data = $res['data'];
                            if ($data['result_code'] != 'SUCCESS') {
                                \Illuminate\Support\Facades\DB::rollBack();
                                return $this->returnJson()->b5error($res['msg']);
                            } elseif (isset($data['prepay_id']) && $data['prepay_id']) {
//                                MapplyApi::saveCount($mapplyInfo['id'],['number'=>1]);
                                \Illuminate\Support\Facades\DB::commit();
                                return message('订单创建成功，正在打开支付',true,['type'=>1,'payinfo' => $data]);
                            } else {
                                \Illuminate\Support\Facades\DB::rollBack();
                                return message('在线支付订单生成失败',false);
                            }
                        } else {
                            \Illuminate\Support\Facades\DB::rollBack();
                            return message($res['msg'],false);
                        }
                    } else {
                        \Illuminate\Support\Facades\DB::rollBack();
                        return message('订单生成失败',false);
                    }
                } else {
//                    MapplyApi::saveCount($mapplyInfo['id'],['number'=>1,'paynumber'=>1]);
                    \Illuminate\Support\Facades\DB::commit();
                    return message('预约信息提交成功',true,['type'=>0]);
                }
            }
        }catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return message('订单提交错误',false);
        }
    }

    /**
     * 查看预约列表
     * @param Request $request
     * @return array
     */
    public function order(Request $request){
        $mapplyInfo=$request->get('mapplyInfo');
        $service=new MapplyOrderService();
        $list=$service->getAll([['mid','=',$mapplyInfo['id']]],[],[],'',[['id','desc']]);
        $orderlist=[];
        foreach ($list as $val){
            $val['paytime']=$val['paytime']?date('Y/m/d H:i:s',$val['paytime']):'';
            $val['scanurl']=get_image_url($service->qrcode(get_image_url($this->web_url.'/wxscan/#/scan?order_sn='.$val['order_sn'],false)),false);
            $orderlist[]=$val;
        }
        $fieldlist=$mapplyInfo['regfield'];
        $signPackage=(new WechatApi())->signPackage($request->post('signurl',''));
        return message('操作成功',true,['orderlist'=>$orderlist,'fieldlist'=>(object)$fieldlist,'signPackage'=>$signPackage]);
    }

    /**
     * 前端跳转授权地址
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wxauth(Request $request){
        $mapplyInfo=$request->get('mapplyInfo');
        $redrecturi=$request->get('redrecturi');
        $url=URL::route('mapply_v1_wxinfo',['b5reduri'=>$redrecturi,'actid'=>$mapplyInfo['id'],'mtype'=>'mapply_'.$mapplyInfo['id']],true);
        return (new WechatApi())->getOpenId($url);
    }

    /**
     * 微信授权成功回调地址，拼接前台地址参数 并跳转回到前台
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wxinfo(Request $request){
        $res=(new WechatApi())->authInfo();
        $mapplyInfo=$request->get('mapplyInfo');
        if($res['success']){
            $url=$res['data']['url'];
            if($url){
                $url=$url.'&token='.$res['data']['openid'];
            }else{
                $url=$this->web_url.'/#/auth?actid='.$mapplyInfo['id'].'&token='.$res['data']['openid'];
            }
            return redirect()->away($url);
        }else{
            return redirect()->away($this->web_url.'/#/error');
        }
    }
}
