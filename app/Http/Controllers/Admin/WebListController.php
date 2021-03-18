<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\WebCatService;
use App\Services\WebListExtService;
use App\Services\WebListService;
use App\Services\WebSiteService;
use Illuminate\Http\Request;

class WebListController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new WebListService();
    }

    public function index()
    {
        if(IS_POST){
            $catid=intval(request()->input('catid',0));
            $param=[];
            if($catid>0){
                $catIdArr=(new WebCatService())->getChildList($catid);
                $catIdArr=$catIdArr?:[];
                if($catIdArr){
                    $catIdArr[]=$catid;
                    $param[]=['catid','in',$catIdArr];
                }else{
                    $param[]=['catid','=',$catid];
                }
            }
            return $this->service->getList(true,$param);
        }else{
            $list=(new WebSiteService())->getSiteList();
            $param = request()->input();
            $website=$param['website']??'';
            if(!$website){
                if($list){
                    $website=key($list);
                }
            }
            view()->share('website',$website);
            view()->share('siteList',$list);
        }

        return parent::index(); // TODO: Change the autogenerated stub
    }
    public function add()
    {
        if(IS_GET){
            $catId=intval(request()->input('catid',0));
            if($catId<1) return $this->toError('参数错误');
            $catInfo=(new WebCatService())->info($catId);
            if(!$catInfo) return $this->toError('菜单分类信息不存在');
            view()->share('catInfo',$catInfo);
        }
        return parent::add(); // TODO: Change the autogenerated stub
    }

    public function edit_before($info, $data)
    {
        if($info){
            $catInfo=(new WebCatService())->info($info['catid']);
            view()->share('catInfo',$catInfo?:[]);

            $extInfo=(new WebListExtService())->info($info['id']);
            view()->share('extInfo',$extInfo?:['imglist'=>'','content'=>'']);
            return true;
        }
        return $this->toError('信息不存在');
    }
}
