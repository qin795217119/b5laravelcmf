<?php


namespace App\Http\Controllers\Api;


use App\Extends\Helpers\Result;
use Illuminate\Routing\Controller;

class TestController extends Controller
{

    public function index(){
        return Result::success('asdasdaa');
    }
}
