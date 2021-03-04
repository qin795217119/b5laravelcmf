<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 网站广告位置
 * Class WebPos
 * @package App\Models
 */
class WebPos extends BaseModel
{
    protected $table = 'b5net_web_pos';
    protected $attributes = [
        'title' => '',
        'website' => 0,
        'note' => '',
        'width' => 0,
        'height' => 0
    ];
}
