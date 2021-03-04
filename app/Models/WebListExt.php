<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 站点内容其他信息表
 * Class WebList
 * @package App\Models
 */
class WebListExt extends BaseModel
{
    protected $table = 'b5net_web_list_ext';
    public $incrementing = false;
    public $timestamps = false;
    protected $attributes = [
        'id'=>0,
        'content' => '',
        'catid' => 0,
        'imglist' => '',
        'website' => '',
    ];
}
