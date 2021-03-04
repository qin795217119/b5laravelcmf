<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 站点菜单
 * Class WebCat
 * @package App\Models
 */
class WebCat extends BaseModel
{
    protected $table = 'b5net_web_cat';
    protected $attributes = [
        'name' => '',
        'parent_id' => 0,
        'website' => 0,
        'title' => '',
        'target' => 0,
        'listsort' => 0,
        'type' => '',
        'status' => 1,
        'lang' => 0,
        'url' => '',
        'relcat' => '',
        'checkcode' => '',
    ];
}
