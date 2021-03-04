<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Site;

use Illuminate\Http\Request;

//网站
class Test1Controller extends SiteController
{
//    public $template='test1';

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}
