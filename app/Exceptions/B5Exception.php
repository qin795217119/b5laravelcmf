<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Exceptions;

use App\Extends\Helpers\Result;
use Exception;
use Illuminate\Http\Request;

class B5Exception extends Exception
{
    //自定义异常 渲染
    public function render(Request $request){
        if($request->isMethod('POST') || $request->ajax()){
            return Result::error($this->getMessage(),$this->getCode());
        }else{
            return view('error',['msg'=>$this->getMessage(),'code'=>$this->getCode()]);
        }
    }
}
