<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Site;

use App\Services\WebCatService;
use App\Services\WebListService;
use Illuminate\Http\Request;

//网站
class Test1Controller extends SiteController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $catList=(new WebCatService())->getChildList(2);
        $catList[]=2;
        $goodsList=(new WebListService())->getAll([['status','=',1],['id','in',$catList]],[]);

        return parent::index(); // TODO: Change the autogenerated stub
    }
}
