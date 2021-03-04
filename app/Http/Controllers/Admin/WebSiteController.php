<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\WebSiteService;
use Illuminate\Http\Request;

class WebSiteController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new WebSiteService();
    }
}
