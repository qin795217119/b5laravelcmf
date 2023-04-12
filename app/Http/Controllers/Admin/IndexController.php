<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Extends\Helpers\Admin\LoginAuth;
use App\Extends\Helpers\Functions;
use App\Models\System\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class IndexController extends Backend
{

    /**
     * 首页
     * @return View
     */
    public function index(): View
    {
        //是否开启横向菜单
        $topNav = false;
        $style = $this->request->cookies->get("nav-style","left");
        if($style == 'top'){
            $topNav = true;
        }

        $userInfo = LoginAuth::adminLoginInfo();
        $menuList = $this->getMenuListByLogin();
        if($topNav){
            return $this->render('index.indextop', ['user_info' => $userInfo,'menuList'=>$menuList]);
        }
        $menuHtml = $this->menuToHtml($menuList);
        return $this->render('', ['user_info' => $userInfo,'menuHtml'=>$menuHtml]);
    }

    /**
     * 主页
     * @return View
     */
    public function home(): View
    {
       return $this->render();
    }

    /**
     * 主题
     * @return View
     */
    public function skin(): View
    {
        return $this->render();
    }

    /**
     * 菜单样式
     * @return View|\Illuminate\Http\JsonResponse
     */
    public function navStyle(): View|\Illuminate\Http\JsonResponse
    {
        $type = trim($this->request->get("type",'left'));
        $cookie = Cookie::make('nav-style', $type, 24 * 60 * 10);
        return $this->success('切换成功',['cookie'=>$cookie]);
    }

    public function download()
    {
        $fileName = $this->request->get('fileName','');
        if(!$fileName) return $this->toError('参数错误');
        header('location:'.$fileName);
    }
    /**
     * 根据登录session获取菜单
     * @return array
     */
    protected function getMenuListByLogin(): array
    {
        $menuList = $menuTree =[];
        $adminId = LoginAuth::adminLoginInfo('info.id');
        if ($adminId) {
            $isAdmin = LoginAuth::adminLoginInfo('info.is_admin');

            if ($isAdmin) {
                $menuList = DB::table(Menu::tableName())->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh', 'target'])->where('type', '<>', 'F')->where('status', 1)->orderBy('parent_id')->orderBy('listsort')->orderBy('id')->get();
            } else {
                $menuIdList = LoginAuth::adminLoginInfo('menu');
                if ($menuIdList) {
                    //获取菜单
                    $menuList = DB::table(Menu::tableName())->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh', 'target'])->whereIn('id', $menuIdList)->where('type', '<>', 'F')->where('status', 1)->orderBy('parent_id')->orderBy('listsort')->orderBy('id')->get();
                }
            }
        }

        if ($menuList) {
            $menuTree = $this->getMenuTree(Functions::stdToArray($menuList));
        }
        return $menuTree;
    }


    /**
     * 将菜单转为数形无限极
     * @param $list
     * @param int $pid
     * @param int $deep
     * @return array
     */
    protected function getMenuTree($list, $pid = 0, $deep = 0): array
    {
        $tree = [];
        foreach ($list as $key => $row) {
            if ($row['parent_id'] == $pid) {
                $row['deep'] = $deep;
                if($row['type'] == 'C'){
                    $url = $row['url'];
                    if ($url && strpos($url, 'http') !== 0) {
                        $url = url('/admin/'.$url);
                    }
                    $row['url'] = $url;
                }

                unset($list[$key]);
                $row['child'] = $this->getMenuTree($list, $row['id'], $deep + 1);
                $tree[] = $row;
            }
        }
        return $tree;
    }

    /**
     * 将菜单树形转为html
     * @param $menus
     * @param int $deep
     * @return string
     */
    protected function menuToHtml($menus, $deep = 0): string
    {
        $html = '';
        if (is_array($menus)) {
            foreach ($menus as $t) {
                if ($t['deep'] == $deep) {
                    if ($t['type'] == 'C') {
                        $url = $t['url'];
                        if ($t['parent_id'] == 0) {
                            $html .= '<li><a class="' . ($t['target'] == '1' ? 'menuBlank' : 'menuItem') . '" href="' . $url . '" data-refresh="' . ($t['is_refresh'] ? 'true' : 'false') . '">' . ($t['icon'] ? '<i class="' . $t['icon'] . '"></i>' : '') . ' <span class="nav-label">' . $t['name'] . '</span></a></li>';
                        } else {
                            $html .= '<li><a class="' . ($t['target'] == '1' ? 'menuBlank' : 'menuItem') . '" href="' . $url . '" data-refresh="' . ($t['is_refresh'] ? 'true' : 'false') . '">' . $t['name'] . '</a></li>';
                        }

                    } else {
                        //实现最多三级菜单
                        if ($t['child'] && $deep < 3) {
                            $html .= '<li><a href="javascript:;">' . ($t['icon'] ? '<i class="' . $t['icon'] . '"></i>' : '') . ' <span class="nav-label">' . $t['name'] . '</span><span class="fa arrow"></span></a>';
                            $html .= '<ul class="nav ' . ($deep == 0 ? 'nav-second-level' : 'nav-third-level') . '">';
                            $html .= $this->menuToHtml($t['child'], $deep+1);
                            $html = $html . "</ul></li>";
                        }
                    }
                }

            }
        }
        return $html;
    }
}
