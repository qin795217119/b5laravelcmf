<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\WebPosService;
use App\Services\WebSiteService;
use Illuminate\Http\Request;

class WebPosController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new WebPosService();
        if(IS_GET && !IS_AJAX){
            view()->share('siteList',(new WebSiteService())->getSiteList());
        }
    }

    public function ajaxbywebsite(){
        $website=request()->input('website','');
        if($website){
            $list=$this->service->getAll([['website','=',$website]],['id','title'],[],'id,title');
        }else{
            $list=[];
        }
        return message('操作成功',true,(object)$list);
    }

}
