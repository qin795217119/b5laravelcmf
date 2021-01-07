<?php

namespace App\Services;

use App\Models\Loginlog;
use Jenssegers\Agent\Agent;

/**
 * 登录日志
 * Class Loginlog
 * @package App\Services
 */
class LoginlogService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Loginlog());
    }

   public function logAdd($login_name,$status,$msg){
       $agent=new Agent();
       $os=$agent->platform().' '.$agent->version($agent->platform());
       $browser=$agent->browser().' '.$agent->version($agent->browser());
       $login_time=date('Y-m-d H:i:s',time());
       $ipaddr=implode(',',request()->getClientIps());
       $this->add(['login_name'=>$login_name,'ipaddr'=>$ipaddr,'browser'=>$browser,'os'=>$os,'status'=>$status,'msg'=>$msg,'login_time'=>$login_time]);
   }

   public function trash(){
        $this->model->trash();
        return message('操作成功', true);
   }
}
