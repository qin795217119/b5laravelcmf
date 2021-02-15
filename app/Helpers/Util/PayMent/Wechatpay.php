<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace App\Helpers\Util\PayMent;

use App\Helpers\Util\PayApi;
use Illuminate\Support\Facades\URL;


require_once dirname(dirname(dirname(__FILE__))).'/Plugins/WxPay/lib/WxPay.Api.php';
require_once dirname(dirname(dirname(__FILE__)))."/Plugins/WxPay/lib/WxPay.Notify.php";
require_once dirname(dirname(dirname(__FILE__)))."/Plugins/WxPay/lib/WxPay.Config.Interface.php";

class Wechatpay
{
    public function config(){
        $notify_url=URL::route('payback',[]);
        $parseUrl=parse_url($notify_url);
        $hostInfo=$parseUrl['scheme'].'://'.$parseUrl['host'];
        $config=[
            //绑定支付的APPID（必须配置，开户邮件中可查看）
            'AppId' => "wx11ed635565d6ef87",

            //商户号（必须配置，开户邮件中可查看）
            'MCHID'=>'1574344871',

            'HostInfo'=>$hostInfo,
            'HostName'=>env('APP_NAME'),

            //异步通知地址
            'NotifyUrl' => $notify_url,
            /*
             * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）, 请妥善保管， 避免密钥泄露
             * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
             */
            'Key'=>'d3a07b20ec3b163f455cb88ac7e552eb',

            /*
             * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）， 请妥善保管， 避免密钥泄露
             * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
             */
            'AppSecret'=>'68a9ebfb60ce563d1810cb44d7dbb7c6'
        ];
        return $config;
    }
    public function getConfig(){
        return new WxPayConfig($this->config());
    }

    public function pay($orderdata,$isMobile=false,$isApp=false){
        //$isMobile=false ，$isApp=false 时为 NATIVE
        //$isMobile=true  ，$isApp=true  时为 JSAPI
        //$isMobile=false ，$isApp=true  时为 APP
        //$isMobile=true  ，$isApp=false 时为 MWEB

        $config=$this->config();
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($orderdata['order_sn']);

        //订单名称，必填
        $subject = trim($orderdata['order_title']);

        //付款金额，必填
        $total_amount = trim($orderdata['order_money']*100);

        //商品描述，可空
        $body = trim($orderdata['order_remark']);

        //订单ID
        $order_id = trim($orderdata['order_id']);

        $trade_type='';
        if(!$isMobile && !$isApp){
            $trade_type='NATIVE';
        }elseif ($isMobile && $isApp){
            $trade_type='JSAPI';
        }elseif (!$isMobile && $isApp){
            $trade_type='APP';
        }elseif ($isMobile && !$isApp){
            $trade_type='MWEB';
        }

        if(!$trade_type) return ['status'=>0,'msg'=>'支付通道参数错误'];

        $input = new \WxPayUnifiedOrder();
        $input->SetBody($subject);
        $input->SetAttach($body);
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($total_amount);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 3600));
        $input->SetGoods_tag('');
        $input->SetTrade_type($trade_type);

        if($trade_type=='MWEB'){
            $input->SetScene_info('{"h5_info": {"type":"Wap","wap_url": "'.$config['HostInfo'].'","wap_name": "'.$config['HostName'].'"}}');
            $input->SetSpbill_create_ip($orderdata['ip']??'');
        }elseif ($trade_type=='JSAPI'){
            $input->SetOpenid($orderdata['openid']??'');
        }

        $input->SetProduct_id($order_id);
        try{
            $config = new WxPayConfig($config);
            $result = \WxPayApi::unifiedOrder($config, $input);
            if($result && $result['return_code']=='SUCCESS'){
            	if($trade_type=='APP'){
                    $info['appid'] = $result['appid'];
                    $info['partnerid'] = $result['mch_id'];
                    $info['package'] = "Sign=WXPay";
                    $info['noncestr'] = \WxPayApi::getNonceStr();//生成随机数,下面有生成实例,统一下单接口需要
                    $info['timestamp'] = time();
                    $info['prepayid'] = $result['prepay_id'];

                    $redata=[];
                    $redata['appid'] = $info['appid'];
                    $redata['packagevalue'] = $info['package'];
                    $redata['mch_id'] = $info['partnerid'];
                    $redata['nonce_str'] = $info['noncestr'];
                    $redata['sign'] = $this->get_sign($info);//生成签名
                    $redata['prepay_id'] = $info['prepayid'];
                    $redata['timestamp'] =$info['timestamp'];
                    $redata['result_code'] = "SUCCESS";
                    $redata['return_code'] = "SUCCESS";
                    $redata['return_msg'] = "OK";
                    return ['status'=>1,'msg'=>'创建订单成功','data'=>$redata];
                }
                return ['status'=>1,'msg'=>'创建订单成功','data'=>$result];
            }else{
                return ['status'=>0,'msg'=>isset($result['return_msg'])?$result['return_msg']:'调用支付失败'];
            }

        } catch(\Exception $e) {
            return ['status'=>0,'msg'=>'调用支付失败'];
        }
    }

    public function callbackcheck(){
        $config=$this->config();
        $config=new WxPayConfig($config);
        $notify = new PayNotifyCallBack();
        $notify->Handle($config, false);
    }
    private function get_sign($data){
        $config=$this->config();
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $str .= !$str ? $key . '=' . $value : '&' . $key . '=' . $value;
        }
        $str.='&key='.$config['Key'];
        $sign = strtoupper(md5($str));
        return $sign;
    }
}


class PayNotifyCallBack extends \WxPayNotify
{
//重写回调处理函数
    /**
     * @param WxPayNotifyResults $data 回调解释出的参数
     * @param WxPayConfigInterface $config
     * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    public function NotifyProcess($objData, $config, &$msg)
    {
        $data = $objData->GetValues();
        //TODO 1、进行参数校验
        if(!array_key_exists("return_code", $data)
            ||(array_key_exists("return_code", $data) && $data['return_code'] != "SUCCESS")) {
            //TODO失败,不是支付成功的通知
            //如果有需要可以做失败时候的一些清理处理，并且做一些监控
            $msg = "异常异常";
            return false;
        }
        if(!array_key_exists("out_trade_no", $data) || !array_key_exists("transaction_id", $data) || !array_key_exists("total_fee", $data)){
            $msg = "输入参数不正确";
            return false;
        }

        //TODO 2、进行签名验证
        try {
            $checkResult = $objData->CheckSign($config);
            if($checkResult == false){
                //签名错误
                return false;
            }
        } catch(\Exception $e) {
            return false;
        }

        //TODO 3、处理业务逻辑
        //查询订单，判断订单真实性
        if(!$this->Queryorder($config,$data["transaction_id"],$data['out_trade_no'])){
            $msg = "订单查询失败";
            return false;
        }
        $out_trade_no=$data["out_trade_no"];//商户订单号
        $total_amount=intval($data['total_fee'])/100;//订单金额
        $trade_no = $data['transaction_id']; //微信交易号
        $res= PayApi::orderprocess($out_trade_no,$trade_no,$total_amount);
        if(!$res){
            $msg = "订单处理失败";
            return false;
        }
        return true;
    }
    //查询订单
    public function Queryorder($config,$transaction_id,$out_trade_no)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($config, $input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS" && $result['out_trade_no']==$out_trade_no && array_key_exists('trade_state',$result) && $result['trade_state']=='SUCCESS')
        {
            return true;
        }
        return false;
    }

    /**
     *
     * 回包前的回调方法
     * 业务可以继承该方法，打印日志方便定位
     * @param string $xmlData 返回的xml参数
     *
     **/
    public function LogAfterProcess($xmlData)
    {
        return;
    }


}



/**
 *
 * 该类需要业务自己继承， 该类只是作为deamon使用
 * 实际部署时，请务必保管自己的商户密钥，证书等
 *
 */

class WxPayConfig extends \WxPayConfigInterface
{
    public $config=[];
    public function __construct($config)
    {
        $this->config=$config;
    }

    public function GetAppId()
    {
        return isset($this->config['AppId'])?trim($this->config['AppId']):'';
    }
    public function GetMerchantId()
    {
        return isset($this->config['MCHID'])?trim($this->config['MCHID']):'';
    }

    public function GetNotifyUrl()
    {
        return isset($this->config['NotifyUrl'])?trim($this->config['NotifyUrl']):'';
    }
    public function GetSignType()
    {
        return "MD5";
    }

    public function GetProxy(&$proxyHost, &$proxyPort)
    {
        $proxyHost = "0.0.0.0";
        $proxyPort = 0;
    }

    public function GetReportLevenl()
    {
        return 1;
    }

    public function GetKey()
    {
        return isset($this->config['Key'])?trim($this->config['Key']):'';
    }
    public function GetAppSecret()
    {
        return isset($this->config['AppSecret'])?trim($this->config['AppSecret']):'';
    }

    public function GetSSLCertPath(&$sslCertPath, &$sslKeyPath)
    {
        $sslCertPath = dirname(dirname(dirname(__FILE__))).'/Plugins/WxPay/cert/apiclient_cert.pem';
        $sslKeyPath = dirname(dirname(dirname(__FILE__))).'/Plugins/WxPay/cert/apiclient_key.pem';
    }
}
