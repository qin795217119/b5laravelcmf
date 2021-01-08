<?php

namespace App\Http\Controllers\Admin;

use App\Cache\AdpositionCache;
use App\Cache\DictCache;
use App\Cache\RedtypeCache;
use App\Services\AdlistService;
use Illuminate\Http\Request;

class AdlistController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new AdlistService();
        if(IS_GET && !IS_AJAX){
            view()->share('typelist',DictCache::get('sys_redtype_type','',true));
            view()->share('funclist',RedtypeCache::get('',true,true));
            if(strtolower(ACTION_NAME)=='index'){
                view()->share('adposlist',AdpositionCache::get('',true));
            }else{
                view()->share('adposlist',AdpositionCache::get('',false));
            }
        }
    }
}
