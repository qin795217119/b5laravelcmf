<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 站点内容表
 * Class WebList
 * @package App\Models
 */
class WebList extends BaseModel
{
    protected $table = 'b5net_web_list';
    protected $attributes = [
        'title' => '',
        'remark' => '',
        'author' => '',
        'froms' => '',
        'thumbimg' => '',
        'status' => 1,
        'catid' => 0,
        'click' => 0,
        'website' => 0,
        'linkurl' => ''
    ];
}
