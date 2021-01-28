<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ApiController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        defined('MODULES_NAME') or define('MODULES_NAME', 'api');
    }
}
