<?php

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
