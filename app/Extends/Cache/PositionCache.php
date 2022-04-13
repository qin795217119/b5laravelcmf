<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Cache;

use App\Extends\Helpers\Functions;
use App\Models\System\Position;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PositionCache
{
    /**
     * 获取信息
     * @param string|null $id
     * @return mixed
     */
    public static function get(string $id=null): mixed
    {
        if(!$id) return [];
        $list = self::lists();
        $list = $list?array_column($list,null,'id'):[];
        return isset($list[$id])?$list[$id]:[];
    }

    /**
     * 获取列表
     * @return array
     */
    public static function lists():array{
        return Cache::rememberForever('position_list',function (){
            $lists = DB::table(Position::tableName())->select(['id','name','poskey','status'])->orderBy('listsort')->orderBy('id')->get();
            return $lists?Functions::stdToArray($lists):[];
        });
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Cache::forget('position_list');
    }
}
