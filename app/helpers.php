<?php

use App\Extends\Helpers\Admin\LoginAuth;
use App\Models\System\Menu;

/**
 * laravel 查询Object对象转数组
 * @param $object
 * @return array|mixed
 */
function asArray($object)
{
    if (is_object($object)) {
        $object = json_decode(json_encode($object), true);
    }
    return $object ?: [];
}

/**
 * 是否管理员
 * @return bool true:是管理员|false:不是管理员
 */
function isAdmin(): bool
{
    return (boolean)LoginAuth::adminLoginInfo('info.is_admin');
}


/**
 * 添加模板按钮权限判断
 * @param $permission string 需要检查的权限
 * @return bool 返回true代表有权限,则显示,反之不显示
 */
function hasPerm(string $permission): bool
{
    $isAdmin = LoginAuth::adminLoginInfo('info.is_admin');

    if ($isAdmin) {
        return true;
    }

    $menuList = LoginAuth::adminLoginInfo('menu');
    //获取登录时的授权菜单Id列表
    if (empty($menuList)) {
        return false;
    }

    //权限判断
    //获取节点信息
    $menuInfo = Menu::bFind('', [['perms', '=', $permission]]);
    if (!$menuInfo || !$menuInfo['status']) return false;

    //判断是否在权限菜单内
    if (in_array($menuInfo['id'], $menuList)) return true;
    return false;
}
