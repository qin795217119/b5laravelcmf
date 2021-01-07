<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Util\UploadApi;

/**
 * 公共操作控制器
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class CommonController extends Backend
{

    public function uploadimg(){
        $upload=new UploadApi();
        $upload->cat=request()->input('cat','images');
        $upload->width=request()->input('width','0');
        $upload->height=request()->input('height','0');
        $res=$upload->run();

        return message($res['msg'],$res['status']?true:false,$res['data']);


    }
}
