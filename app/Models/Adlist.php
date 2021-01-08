<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 推荐信息
 * Class Adlist
 * @package App\Models
 */
class Adlist extends BaseModel
{
    protected $table = 'b5net_adlist';
    protected $attributes=[
        'title'=>'',
        'redtype'=>'',
        'redfunc'=>'',
        'redinfo'=>'',
        'listsort'=>0,
        'status'=>1,
        'text_text'=>'',
        'text_rich'=>'',
        'imglist'=>''
    ];
}
