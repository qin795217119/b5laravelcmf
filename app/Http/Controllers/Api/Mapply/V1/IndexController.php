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
use App\Models\MapplyCount;
use App\Models\MapplyOrder;
use App\Models\MapplyOrderExt;
use App\Models\WechatUsers;
use App\Services\MapplyOrderLogService;
use App\Services\MapplyOrderService;
use App\Services\MapplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        //判断活动状态
        $mapplyCheck=$this->mapplyCheck($mapplyInfo);
        if(!$mapplyCheck['success']) return $mapplyCheck;

        //判断后台定义的注册字段信息并进行验证
        $fieldCheck=$this->regFieldCheck($mapplyInfo,$request);
        if(!$fieldCheck['success']) return $fieldCheck;
        $fdata=$fieldCheck['data'];

        //生成订单数据
        $orderData=$this->orderData($mapplyInfo,$request);
        if(!$orderData['success']) return $orderData;
        $data=$orderData['data'];

        DB::beginTransaction();
        try {
            $order_id=MapplyOrder::insertGetId($data);
            if($order_id) {
                $this->orderExt($mapplyInfo['id'],$order_id,$fdata);
                //保存成功添加订单记录
                (new MapplyOrderLogService())->AddLog($data['mid'],$order_id, '创建订单', 1,'');
                if ($data['money'] > 0) {
                    $paydata = [
                        'order_sn'=>$data['order_sn'],
                        'order_title'=>$data['order_title'],
                        'order_id'=>$order_id,
                        'order_money'=>$data['money'],
                        'openid'=>$data['openid'],
                        'pay_type'=>'wechat',
                        'ip'=>$data['ip'],
                        'order_remark'=>'mapply_' . $order_id.'_'.$data['openid']
                    ];
                    $res = PayApi::run($paydata, true,true);

                    if ($res) {
                        if ($res['status']) {
                            $data = $res['data'];
                            if ($data['result_code'] != 'SUCCESS') {
                                DB::rollBack();
                                return message($res['msg'],false);
                            } elseif (isset($data['prepay_id']) && $data['prepay_id']) {
                                MapplyCount::saveCount($mapplyInfo['id'],['number'=>1]);
                                DB::commit();
                                return message('订单创建成功，正在打开支付',true,['type'=>1,'payinfo' => $data]);
                            } else {
                                DB::rollBack();
                                return message('在线支付订单生成失败',false);
                            }
                        } else {
                            DB::rollBack();
                            return message($res['msg'],false);
                        }
                    } else {
                        DB::rollBack();
                        return message('订单生成失败',false);
                    }
                } else {
                    MapplyCount::saveCount($mapplyInfo['id'],['number'=>1,'paynumber'=>1]);
                    DB::commit();
                    return message('预约信息提交成功',true,['type'=>0]);
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return message('订单提交错误',false);
        }
    }

    //活动状态判断
    private function mapplyCheck($mapplyInfo){
        if($mapplyInfo){
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

            return message('',true);
        }
        return message('活动信息错误',false);
    }
    //注册字段判断
    private function regFieldCheck($mapplyInfo,$request){
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
        return message('',true,$fdata);
    }
    //生成订单数据
    private function orderData($mapplyInfo,$request){
        $openid=$request->get('token','');

        if(!$openid) return message('登录信息错误',false,[],305);
        $userInfo=WechatUsers::where('openid',$openid)->where('type','mapply_'.$mapplyInfo['id'])->first();
        if(!$userInfo) return message('登录信息错误',false,[],305);

        $lastinfo = MapplyOrder::where('mid',$mapplyInfo['id'])->where('openid',$openid)->orderBy('id', 'desc')->first();
        if($mapplyInfo['is_multi']){
            $difftime = time() - 30;
            if ($lastinfo && strtotime($lastinfo['create_time']) > $difftime) {
                return message('操作太频繁，请稍后再试',false);
            }
        }else{
            if($lastinfo) return message('您已经预约过了，请不要重复预约',false);
        }
        $nowdate=date('Y-m-d H:i:s',time());
        $data=[
            'mid' => $mapplyInfo['id'],
            'openid' => $userInfo['openid'],
            'money' => floatval($mapplyInfo['money']),
            'order_title' => $mapplyInfo['title'],
            'order_sn' => '10'.time() .str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'ip' => \Illuminate\Support\Facades\Request::ip()
        ];

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
        return message('',true,$data);
    }
    //插入注册信息
    private function orderExt($mapply_id,$order_id,$fdata){
        if($fdata){
            $insertData=[];
            foreach ($fdata as $fkey => $fval) {
                $insertData[]=[
                    'mid'=>$mapply_id,
                    'oid'=>$order_id,
                    'fieldkey'=>$fkey,
                    'fieldval'=>$fval
                ];
            }
            if($insertData){
                DB::table((new MapplyOrderExt())->getTable())->insertOrIgnore($insertData);
            }
        }
    }
    /**
     * 查看预约列表
     * @param Request $request
     * @return array
     */
    public function order(Request $request){
        $mapplyInfo=$request->get('mapplyInfo');
        $openid=$request->get('token','');
        $service=new MapplyOrderService();
        if($openid){
            $list=$service->getAll([['mid','=',$mapplyInfo['id']],['openid','=',$openid]],[],[],'',[['id','desc']]);
        }else{
            $list=[];
        }
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
