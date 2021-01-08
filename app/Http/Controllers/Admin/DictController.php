<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\DictTypeService;
use Illuminate\Http\Request;

class DictController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new DictTypeService();
    }
}
