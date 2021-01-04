<?php

namespace App\Http\Controllers\Admin;


use App\Services\DictDataService;
use App\Services\DictTypeService;
use Illuminate\Http\Request;

class DictdataController extends Backend
{
    public $type_service;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new DictDataService();
        $this->type_service=new DictTypeService();
        if(IS_GET && !IS_AJAX){
            view()->share('typelist',$this->type_service->getTypeList());
        }
    }
}
