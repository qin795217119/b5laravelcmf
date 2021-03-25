<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

/**
 * 在线记录
 * Class TestOnline
 * @package App\Models
 * @property string $ip
 * @property string $create_time
 * @property string $update_time
 * @property string $fd
 * @property string $isrun
 */
class TestOnline extends Model
{
    protected $table = 'b5net_test_online';
    public $timestamps = false;
}
