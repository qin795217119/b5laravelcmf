<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

/**
 * 菜单管理
 * Class Menu
 * @package App\Models
 */
class Menu extends BaseModel
{
    protected $table = 'b5net_menu';
    protected $attributes=[
        'name'=>'',
        'parent_id'=>0,
        'listsort'=>0,
        'status'=>1,
        'url'=>'',
        'target'=>0,
        'menu_type'=>'',
        'is_refresh'=>0,
        'perms'=>'',
        'icon'=>'',
        'note'=>'',
    ];
}
