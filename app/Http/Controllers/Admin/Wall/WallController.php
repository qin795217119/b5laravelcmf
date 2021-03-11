<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin\Wall;


use App\Http\Controllers\Admin\Backend;
use App\Services\Wall\WallService;
use Illuminate\Http\Request;


class WallController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new WallService();
        $this->view_group = 'wall';
    }
}
