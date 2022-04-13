<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Helpers\Admin;


use App\Models\System\Menu;

class LoginAuth
{

    /**
     * 获取管理员登录信息
     * @param string $key
     * @return mixed
     */
    public static function adminLoginInfo(string $key = ''): mixed
    {

        $session = session()->get(config('b5net.admin_login_session'));
        if (!$key) {
            return $session;
        } else {
            if (is_null($session)) return null;
            return \Illuminate\Support\Arr::get($session, $key);
        }
    }

    /**
     * 权限判断
     * @param string $group
     * @param string $controller_name
     * @param string $action_name
     * @return bool
     */
    public static function checkPower(string $group = '', string $controller_name = '', string $action_name = ''): bool
    {
        if (!$controller_name || !$action_name) return false;
        $is_admin = self::adminLoginInfo('info.is_admin');
        if ($is_admin) return true;
        //检测权限
        $group = strtolower($group);
        $controller_name = strtolower($controller_name);
        $action_name = strtolower($action_name);
        $permission = ($group ? $group . ':' : '') . $controller_name . ':' . $action_name;

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission = ['index:index', 'index:home', 'index:download'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission, $notAuthPermission) || substr($action_name, 0, 4) === 'ajax') {
            return true;
        }

        //判断登录
        $user_id = self::adminLoginInfo('info.id');
        if (!$user_id == 1) return false;

        //获取登录时的授权菜单Id
        $menuList = self::adminLoginInfo('menu');
        if (empty($menuList)) {
            return false;
        }

        //获取节点信息
        $menuInfo = Menu::bFind('', [['perms', '=', $permission]]);
        if (!$menuInfo || !$menuInfo['status']) return false;

        //判断是否在权限菜单内
        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
    }

}
