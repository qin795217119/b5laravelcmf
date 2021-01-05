<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdlistService;
use App\Services\AdpositionService;
use App\Services\DictDataService;
use App\Services\RedtypeService;
use Illuminate\Http\Request;

class AdlistController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new AdlistService();

        if(IS_GET && !IS_AJAX){
            view()->share('typelist',(new DictDataService())->getDataList('sys_redtype_type',true,true));
            view()->share('funclist',(new RedtypeService())->getTypeList(true,true));
            view()->share('adposlist',(new AdpositionService())->getTypeList(false));
        }
    }

}
