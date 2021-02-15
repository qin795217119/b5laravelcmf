<?php
/**
 * 支付宝支付
 * Created by PhpStorm.
 * User: liheng
 * Date: 2019/11/27
 * Time: 13:58
 */

namespace common\payment;


use common\includes\PayApi;
use yii\helpers\Url;

class Alipay
{
    public $root='';
    public function __construct()
    {
        $this->root=dirname(dirname(dirname(__FILE__)));
        require_once $this->root.'/plugins/alipay/pagepay/service/AlipayTradeService.php';
    }

    public function config(){
        $notify_url=Url::toRoute(['callback/alipay'],true);
        $return_url=Url::toRoute(['users/order'],true);
        $config = array (
            //应用ID,您的APPID。
            'app_id' => "2016101700704125",

            //商户私钥
            'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCwAvzBDaSEqRHcWP+ufPskySoc3y4KivohslvdpYOhuQEmS7GyxaPa5Qpx5z7ZCVGX0rWgyHBIF04jVbFib+i/h0hB6jOhcUg85OMhvbtR/mMtZqgY4pq5Mj1lyj018lUOW1qXvLPXMqbs86Ek/vpHvU4uH/bUY0FzS+1EvGOkpnTHEhw3gKdaFg8w1eMZgoSfasS2Puxh06RvPZtWNzIn7QtkzsPwV1Kr0ACeqXzSyvhFhlucq1byFR4tur5VhZ6vqY+sWa2qp61KjcIolQnuzXiimvFR5d9o5gpR3OQouCo3MVPt1U2qfovGF2vNCubU2ex90KVo6j328cqnPlw1AgMBAAECggEAAsIZOeE/2cBYgk52u0JEIUBxw4AP1aR15P9Jh0CnvmoKxZHcGAQW3EBImJ5aEsadm7Z2mC1r7QVIeS9Hl1ZPnGi/TiEgbAA9dI7VrFqvy8ojvbtlGPa8G/jYk3bG3MiOYqo10jjnzJCDoyTyOoUwYN1rkzd3A78GcIsZDcGyAgt/BVhhwaWYW+uC4gRpI1dpK7D1lpia0GcVRn13sHmPjRlvb0VLpy1nXqhbSVjKh6M6YiqLKgKAFSeg1liDVVxqBV8oSc30McJNP/Cc+++wZZzAGsuGdhP2eLVMO92yQXka9MvT3nIJRot6aKYXNT/P8enF7DJ/jdYrlXkT31AlpQKBgQDx1HPY/lCg56ATelr4Kb7xpLIFYUx3QPCaIEZsgvA3vl84OLhKdbPYcmSvxeE9bZQwjn74b3sNoCYj4pEzl+FHkw82cV2yx2yPcxUt1Qxncs8N3s456o4BAOjiWvmyZW1/iauUn150rHkmJ447eCQqBw/fG+MtCRPurRQgYppxEwKBgQC6UzwGZPivkqYkNkhG+phSpHEjJojqCLu8ZLdTO6ivd4Q4MyJ1X3Q6pSwD5XnCJ7RoJXk4qahpUALr16m/Hmvo/Oa1uA6s8BG8USYXDlF2iaq7pDwTe617B5Q6Xpng9Q48hnDkYS7g0vV0ize2mnFIdp15Ut3UBauUbNkXmaLulwKBgQCipY9dDH7SGbcSIqL4catY/ro04CH7uxOXtclnxhEmjMWiHJPmkI9rLlUF24MIO6EFn3FKSkBrA6FjVUjveGEuMHx0035/dZ1QRcii0L3M/ezAmW/+iAEGL8RyKVnzYEBrHP7nsOBofG/m94ez+7PnCGTmW+1JJuffCU2WEntpPQKBgHKEpefoN1Dx+VtYYaP+cZCZsU/BZ3UwWPK5lFN733m5I3LHOu6Y9H729c6PQ/6pGKDKJ29EF1Zi7ui1bIci04AnsEUQEzUHeF8eISMakcchZeZeUu5GnaF4TwpxCnLRKybYGprDgGR+RI6U4nFBC09WWAMxg1XFBmf7XpK6wwGRAoGAahFjGuX2qzF1T5gKqEbGtujqTdy4F9MW8xx2wJ50l3uBANSH7m0MIy5RTFHtxeTWUj+tvT4uqpQ85vj+U/1xLGkV3kiRQmWdNWfBd1GQPzRw8HFRlAFVRvHyxEAjvRTbh43DuEab/3Jw+E7cqOdSWjqdaM5yiYc2PEdtIGU9vWU=",

            //异步通知地址
            'notify_url' => $notify_url,

            //同步跳转
            'return_url' => $return_url,

            //编码格式
            'charset' => "UTF-8",

            //签名方式
            'sign_type'=>"RSA2",

            //支付宝网关
            'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

            //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
            'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgD1rF4FtVn4yHcl/vzlLU17Eo42kEv4B+d+mFBuoEC2xNKZkzJ3X+AjzJBZG4WJmD9iMyT1+MUZfIVyWnztu1uFOTCr1Ffqs/P343MygPPCyUo35TtPULH32zsXL9+a5BW3cMUI9qQE8WuStFi8fRytceb9ng03ZIbfB9jQj2MUC2kDmmYHb6l4FRvQGaGdct9dBh2El//Rjj/lYOCeXusSh3s7tcHbMAdzFmHvO0dtsk2HIl8kB61B59A2GaAuDSG9GdnnC0M1i+EM4ujX2H4BW3jQkTSrzVGWyNztmOTOKCzi+xvwamxtCHxAGrBZExGGXnIN3D+jfi24llTiguwIDAQAB",
        );
        return $config;
    }
    public function pay($orderdata){
        require_once $this->root.'/plugins/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
        $ismobile=(new \common\includes\Mobile_Detect())->isMobile();
        $config=$this->config();
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($orderdata['order_sn']);

        //订单名称，必填
        $subject = trim($orderdata['order_title']);

        //付款金额，必填
        $total_amount = trim($orderdata['order_money']);

        //商品描述，可空
        $body = trim($orderdata['order_remark']);

        //构造参数 AlipayTradePagePayContentBuilder
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder($ismobile);
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url'],$ismobile);
        //输出表单
        return $response;
    }

    /**
     * 支付宝支付异步回调处理
     * @param array $data
     * @throws \yii\db\Exception
     */
    public function callbackcheck($data=[]){
        $config=$this->config();
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result= $alipaySevice->check($arr);
        file_put_contents($this->root.'/aaa.txt',date('Y-m-d H:i:s',time()).'----'.(is_array($result)?json_encode($result):$result)."\r\n",FILE_APPEND);
        if($data){
            $rs=PayApi::orderprocess($data['out_trade_no'],$data['trade_no'],$data['total_amount']);
            if($rs){
                echo "success";
                die;
            }
        }else{
            if($result) {//验证成功
                $out_trade_no = $_POST['out_trade_no'];   //商户订单号
                $total_amount=$_POST['total_amount'];//订单金额
                $trade_no = $_POST['trade_no']; //支付宝交易号
                if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                    if($out_trade_no){
                        $rs=PayApi::orderprocess($out_trade_no,$trade_no,$total_amount);
                        if($rs){
                            echo "success";
                            die;
                        }
                    }
                }
            }
        }
        echo "fail";
        die;
    }
}