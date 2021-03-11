<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Wall;

use App\Http\Controllers\Web\WebController;
use App\Services\Wall\WallService;
use Illuminate\Http\Request;

class IndexController extends WebController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request){
        $wallInfo=$request->get('wallInfo');
        return $this->render('wall.index');
    }

    public function login(Request $request){
        return $this->render('wall.login');
    }

}
