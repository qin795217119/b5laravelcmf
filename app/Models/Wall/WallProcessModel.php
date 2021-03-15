<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Wall;

use App\Models\BaseModel;

class WallProcessModel extends BaseModel
{
    protected $table = 'b5net_wall_process';
    protected $attributes=[
        'desc'=>'',
        'hour'=>'',
        'status'=>1,
        'listsort'=>0
    ];
}
