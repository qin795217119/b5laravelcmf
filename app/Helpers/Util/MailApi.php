<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace App\Helpers\Util;

use App\Cache\ConfigCache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MailApi
{
    /**
     * 发送有劲啊
     * @param string $type  发送类型 repass 重置密码   vemail验证邮箱
     * @param array $data  发送数据 包含用户ID（可无），email和name（用户名称）
     * @return bool
     */
    public function sendEmail($type,$data)
    {
        if(!$type || !$data || !isset($data['email'])) return false;

        $method=$type.'Send';
        if(!method_exists($this,$method)){
            return false;
        }
        $token_data=[
            'id'=>$data['id']??0,
            'email'=>$data['email'],
            'time'=>time()
        ];

        $token=base64_encode(encrypt($token_data,true));
        $token_data['token']=$token;
        $token_data['name']=$data['name']??'';
        return $this->$method($token_data);
    }

    //邮箱验证 和 密码重置  根据需要自己追加 及模板
    private function vemailSend($data){
        $data['url']=b5UrlCreate(URL::to('admin/public/vemail'),['token'=>$data['token']]);
        return $this->emailSend($data,'widget.mail.vemail','邮箱验证');
    }

    private function repassSend($data){
        $data['url']=b5UrlCreate(URL::to('admin/public/repass'),['token'=>$data['token']]);
        return $this->emailSend($data,'widget.mail.repass','修改密码');
    }

    /**
     * 发送邮箱底层方法
     * @param $data
     * @param string $view
     * @param string $title
     * @return bool
     */
    private function emailSend($data,$view='',$title=''){
        if(!$data || !$view) return false;
        Config::set('mail.host',ConfigCache::get('sys_email_host'));
        Config::set('mail.username',ConfigCache::get('sys_email_username'));
        Config::set('mail.password',ConfigCache::get('sys_email_password'));
        Config::set('mail.port',ConfigCache::get('sys_email_port'));
        Config::set('mail.encryption',ConfigCache::get('sys_email_ssl')?'ssl':'tls');
        Config::set('mail.from.address',ConfigCache::get('sys_email_username'));
        Config::set('mail.from.name',ConfigCache::get('sys_config_sysname'));
        $subject=ConfigCache::get('sys_config_sysname').($title?'-'.$title:'');
        $data['subject']=$subject;
        Mail::send($view,$data,function ($message) use ($data){
            $message->to($data['email'])->subject($data['subject']);
        });
    }
}
