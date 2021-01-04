<?php

namespace App\Http\Controllers\Admin;


use App\Services\DictDataService;
use App\Services\NoticeService;
use Illuminate\Http\Request;

class NoticeController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new NoticeService();
        if(IS_GET && !IS_AJAX){
            view()->share('typelist',(new DictDataService())->getDataList('sys_notice_type',true,true));
        }
    }

}
