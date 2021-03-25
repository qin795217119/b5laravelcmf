<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Models\Test\TestOnline;


/**
 * Class IndexController
 * @package App\Http\Controllers\Api\V1
 */
class IndexController extends ApiController
{
    public function index(){
        var_dump('aaaaa');
    }

    public function onlineadd(){
        $ip=request()->get('ip','');
        $fd=request()->request->get('fd','');
        if($ip && $fd){
            $info=new TestOnline();
            $info->ip=$ip;
            $info->fd=$fd;
            $info->isrun=1;
            $info->create_time=date('Y-m-d H:i:s',time());
            $info->save();
            return message('',true);
        }
        return message('',false);
    }

    public function onlinedel(){
        $fd=request()->get('fd','');
        if($fd){
            $info=TestOnline::where('fd',$fd)->where('isrun',1)->orderBy('id','desc')->first();
            if($info){
                $info->isrun=0;
                $info->update_time=date('Y-m-d H:i:s',time());
                $info->save();
                return message('',true);
            }
        }
        return message('',false);
    }
}
