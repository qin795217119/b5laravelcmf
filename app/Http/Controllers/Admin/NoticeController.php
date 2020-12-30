<?php

namespace App\Http\Controllers\Admin;


use App\Services\NoticeService;
use Illuminate\Http\Request;

class NoticeController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new NoticeService();
    }

}
