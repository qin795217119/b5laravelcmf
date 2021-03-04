<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 网站广告信息
 * Class WebAd
 * @package App\Models
 */
class WebAd extends BaseModel
{
    protected $table = 'b5net_web_ad';
    protected $attributes = [
        'title' => '',
        'pos_id' => 0,
        'linkurl' => '',
        'listsort' => 0,
        'status' => 1,
        'text_text' => '',
        'text_rich' => '',
        'imglist' => '',
        'website' => 0
    ];
}
