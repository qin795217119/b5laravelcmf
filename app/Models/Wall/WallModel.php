<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Wall;

use App\Models\BaseModel;

class WallModel extends BaseModel
{
    protected $table = 'b5net_wall';
    protected $attributes=[
        'logoimg'=>'',
        'contents'=>'',
        'bgimg'=>''
    ];
}
