<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 推荐位置
 * Class DictType
 * @package App\Models
 */
class Adposition extends BaseModel
{
    protected $table = 'b5net_adposition';
    protected $attributes=[
        'title'=>'',
        'type'=>'',
        'note'=>'',
        'width'=>0,
        'height'=>0
    ];
}
