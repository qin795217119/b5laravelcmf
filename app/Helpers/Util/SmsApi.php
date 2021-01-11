<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace App\Helpers\Util;


use AlibabaCloud\Client\AlibabaCloud;
use App\Cache\ConfigCache;
use App\Services\SmscodeService;

class SmsApi
{

    /**
     * 发送短信
     * @param $mobile
     * @param int $type 类型 1注册 2登录 3找回密码
     * @param string $os 短信服务商 ali  juhe
     * @return array
     */
    public function sendcode($mobile,$type=0,$os='ali'){
        if($type==1){
            //注册 验证手机号未注册
        }elseif($type==2 || $type==3){
            //登录 验证手机号已注册
        }else{
            return message('短信发送失败:1',false);
        }
        $code=mt_rand(100000,999999);
        $method=$os.'send';
        if(!method_exists($this,$method)){
            return message('短信服务未开启',false);
        }

        //一分钟内禁止相同操作的发送
        $info=(new SmscodeService())->getAll([['mobile','=',$mobile],['type','=',$type]],[],[0,1],'',[['id','desc']]);
        if($info && $info[0]['status']==0){
            $lastime=strtotime($info[0]['create_time']);
            if($lastime>time()-60){
                return message('操作太频繁，请稍后再试',false);
            }
        }
        $result=$this->$method($mobile,$code);
        if(!$result || !$result['success']){
            return message('短信发送失败',false);
        }
        return (new SmscodeService())->add(['mobile'=>$mobile,'code'=>$code,'os'=>$os,'type'=>$type,'status'=>0],'','短信发送');
    }
    /**
     * 验证码 验证
     * @param $mobile
     * @param $code
     * @param int $type
     * @return array
     */
    public function checkcode($mobile,$code,$type=0){
        if(!ValidateApi::is_mobile_phone($mobile)){
            return message('手机号码错误',false);
        }
        if(empty($code)){
            return message('验证码错误',false);
        }
        $info=(new SmscodeService())->getAll([['mobile','=',$mobile],['type','=',$type]],[],[0,1],'',[['id','desc']]);
        if(empty($info)){
            return message('验证码信息错误',false);
        }
        $info=$info[0];
        if($info['status']){
            return message('验证码已失效',false);
        }
        if($info['code']!=$code){
            return message('验证码错误',false);
        }
        $lasttime=time()-600;
        $addtime=strtotime($info['create_time']);
        if($addtime<$lasttime){
            return message('验证码已失效',false);
        }
        (new SmscodeService())->edit(['id'=>$info['id'],'status'=>1]);
        return message('验证码正确',true);
    }
    /**
     * 阿里云短信 发送验证码
     * @param $mobile
     * @param $code
     * @return array
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    private function alisend($mobile,$code){
        if(empty($mobile) || !ValidateApi::is_mobile_phone($mobile)){
            return message('手机号码格式错误',false);
        }
        if(empty($code)){
            return message('验证码不能为空',false);
        }
        $accessKeyId=ConfigCache::get('sms_ali_key');
        $accessSecret=ConfigCache::get('sms_ali_secret');
        $signName=ConfigCache::get('sms_ali_signname');
        $tempId=ConfigCache::get('sms_ali_temp');
        if(empty($accessKeyId) || empty($accessSecret) || empty($signName) || empty($tempId)){
            return message('短信服务配置错误',false);
        }
        AlibabaCloud::accessKeyClient($accessKeyId, $accessSecret)
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $mobile,
                        'SignName' => $signName,
                        'TemplateCode' => $tempId,
                        'TemplateParam' => "{code:".$code."}",
                    ],
                ])
                ->request();
            $result=$result->toArray();
            if($result && isset($result['Message'])){
                if($result['Message']=='OK'){
                    return message('发送成功',true);
                }else{
                    return message($result['Message'],false);
                }
            }

        } catch (ClientException $exception){

        } catch (ServerException $exception){

        }
        return message('发送失败',false);
    }

    /**
     * 聚合短信-发送验证码
     * @param $mobile
     * @param $code
     * @return array
     */
    private function juhesend($mobile,$code){
        $reArr=array('status'=>0,'msg'=>'短信发送失败');
        if(empty($mobile) || !ValidateApi::is_mobile_phone($mobile)){
            return message('手机号码格式错误',false);
        }
        if(empty($code)){
            return message('验证码不能为空',false);
        }
        $url = 'http://v.juhe.cn/sms/send';
        $appkey=ConfigCache::get('sms_juhe_appkey');
        $tplid=ConfigCache::get('sms_juhe_temp');
        if(empty($appkey) || empty($tplid)){
            return message('短信服务配置错误',false);
        }
        $params = array(
            'key'   => $appkey, //您申请的APPKEY
            'mobile'    => $mobile, //接受短信的用户手机号码
            'tpl_id'    => $tplid, //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code //您设置的模板变量，根据实际情况修改
        );
        $content = b5curl_post($url,$params); //请求发送短信
        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                return message('发送成功',true);
            }
            return message($result['reason'],false);
        }
        return message('发送失败',false);
    }
}
