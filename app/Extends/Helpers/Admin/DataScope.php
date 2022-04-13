<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Helpers\Admin;

use App\Extends\Services\System\RoleStructService;
use App\Extends\Services\System\StructService;
use Illuminate\Database\Query\Builder;

class DataScope
{
    /**
     * 数据权限类型
     * @param null $type
     * @return array|string
     */
    public static function typeList($type = null): array|string
    {
        $list = [
            1 => '全部数据权限',
            2 => '本部门及以下数据权限',
            4 => '本部门数据权限',
            8 => '自定数据权限',
            16 => '仅本人数据权限'
        ];
        return is_null($type) ? $list : ($list[$type] ?? '--');
    }

    /**
     * 拼接数据权限条件
     * 表中必须含有存储用户的组织id，存储用户的id， 默认组织字段位struct_id，用户id位user_id
     *
     * $query = Db::table('xxx')->where(['xxxx'=>xxx]);
     * $list = DataScopeAuth::dataScope($query)->select();
     *
     * @param Builder $query DB查询构造器对象
     * @param string $structField 组织架构字段名
     * @param string $userField 用户字段名
     * @param string $structAlias 关联查询时 表的别名
     * @param string $userAlias 关联查询时的表别名
     * @return object
     */
    public static function queryDataScope(Builder $query, string $structField = 'struct_id', string $userField = 'user_id', string $structAlias = '', string $userAlias = ''): object
    {
        $filter = self::getFilterStructList();
        if ($filter === false) {
            $query->where('id','=',0);
        } elseif (is_array($filter)) {
            $structField = ($structAlias ? $structAlias . '.' : '') . $structField;
            $userField = ($userAlias ? $userAlias . '.' : '') . $userField;

            $structList = $filter['struct'] ?? [];
            $userId = $filter['user'] ?? false;
            if ($structList && $userId) {
                $query->where(function($cq) use ($userField,$userId,$structField,$structList){
                    $cq->where($userField, '=', $userId)
                        ->orWhere($structField, '=', $structList);
                });
            } elseif ($structList) {
                $query->whereIn($structField, $structList);
            } elseif ($userId) {
                $query->where($userField,'=', $userId);
            }
        }
        return $query;
    }


    /**
     *
     * 列表进行数据过滤
     * 数组
     * $list = [
     *      ['struct_id'=>xx,'user_id'=>xx, ...],
     *      ['struct_id'=>xx,'user_id'=>xx, ...],
     * ]
     *
     * @param array $list
     * @param string $structField 组织字段
     * @param string $userField 用户字段 可以为空 只检查组织
     * @return array
     */
    public static function arrayDataScope(array $list = [], string $structField = 'struct_id', string $userField = 'user_id'): array
    {
        if (empty($list)) return [];
        $filter = self::getFilterStructList();
        if ($filter === false) {
            return [];
        } elseif (is_array($filter)) {
            $structList = $filter['struct'] ?? [];
            $userId = $filter['user'] ?? false;

            foreach ($list as $key => $value) {
                $struct_id = $value[$structField] ?? 0;
                $user_id = $value[$userField] ?? 0;
                if ($structList && $userId) {
                    if (!in_array($struct_id, $structList) && ($userField && $user_id != $userId)) {
                        unset($list[$key]);
                    }
                } elseif ($structList) {
                    if (!in_array($struct_id, $structList)) {
                        unset($list[$key]);
                    }
                } elseif ($userId) {
                    if ($user_id != $userId) {
                        unset($list[$key]);
                    }
                }
            }
        }
        return $list;
    }

    /**
     * 获取数据权限过滤用户的组织id数组
     * 超管返回ture 所有数据；没有权限组织或角色返回false，没有任何数据
     * @return array|bool
     */
    private static function getFilterStructList(): bool|array
    {
        $user_id = LoginAuth::adminLoginInfo('info.id');
        if (!$user_id) return false; //未登录返回无权限

        $is_admin = LoginAuth::adminLoginInfo('info.is_admin');
        if ($is_admin == 1) return true; //超管返回全部权限

        $dataScope = LoginAuth::adminLoginInfo('dataScope');//用户数据权限权值
        if ($dataScope < 1) return false;

        if (!(31 & $dataScope)) return false;//无效的键值

        $roleList = LoginAuth::adminLoginInfo('role');
        if (empty($roleList)) return false; //无角色返回无权限

        $structArr = [];//组织id列表
        $isUser = false;//是否含有本人数据

        $structList = LoginAuth::adminLoginInfo('struct');//用户组织架构
        if (empty($structList)) return false;//无组织 返回无权限



        //全部数据权限
        if (1 & $dataScope) return true;

        ///本部门及以下数据权限
        if (2 & $dataScope) {
            foreach ($structList as $value) {
                array_push($structArr, $value['id']);
                $childList = StructService::getChildList($value['id'], true);
                if ($childList) {
                    $structArr = [...$structArr, ...$childList];
                }
            }
        }
        if (4 & $dataScope) {//本部门数据权限
            foreach ($structList as $value) {
                array_push($structArr, $value['id']);
            }
        }
        if (8 & $dataScope) {//自定义
            $struct = RoleStructService::getRoleStructList($roleList);
            if ($struct) {
                $structArr = [...$structArr, ...$struct];
            }
        }
        if (16 == $dataScope) {//个人数据 优先级最低
            $isUser = true;
        }
        $structArr = array_unique($structArr);
        return ['struct' => $structArr, 'user' => $isUser ? $user_id : false];
    }
}
