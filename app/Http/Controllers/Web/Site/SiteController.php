<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Site;

use App\Cache\WebAdCache;
use App\Cache\WebCatCache;
use App\Cache\WebSiteCache;
use App\Helpers\Util\PageApi;
use App\Http\Controllers\Web\WebController;
use App\Models\WebList;
use App\Services\WebListExtService;
use App\Services\WebListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//网站
class SiteController extends WebController
{
    public $website;
    public $website_code = '';
    public $template = 'default';

    public function __construct(Request $request)
    {
        parent::__construct($request);
//        $this->website_code=str_replace('controller','',strtolower(class_basename(get_class($this))));
        $this->website_code = strtolower(str_replace('/', '', Route::current()->getPrefix()));

        $siteInfo = WebSiteCache::getByCode($this->website_code);
        if ($siteInfo['template']) $this->template = $siteInfo['template'];

        $this->website = $siteInfo['id'];
        if (IS_GET) {
            view()->share('siteInfo', $siteInfo);
            view()->share('home_url', '/' . $this->website_code);
            view()->share('menuList', $this->getMenuList());
        }
    }

    public function index()
    {
        view()->share('bannerList', WebAdCache::get(1));
        view()->share('activeMenu', 'home');
        return $this->render('index');
    }

    /**
     * 新闻资讯和商品列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $id = intval(\request()->input('id', 0));
        if ($id < 1) return $this->error();
        $catAllList = WebCatCache::get($this->website);
        $catInfo = $catAllList[$id] ?? [];

        if (!$catInfo || !in_array($catInfo['type'], ['list', 'goods']) || !$catInfo['status']) return $this->error();

        $catList = [];
        $parentCat = [];
        if ($catInfo['parent_id']) {
            $parentCat = $catAllList[$catInfo['parent_id']] ?? [];
            foreach ($catAllList as $val) {
                if ($val['parent_id'] == $catInfo['parent_id']) {
                    $val = $this->getMenuUrl($val);
                    $catList[] = $val;
                }
            }
        } else {
            $catList[] = $catInfo;
        }

        $temp = $catInfo['template_list'] ?: $catInfo['type'];
        $where = [['catid', '=', $id], ['status', '=', 1]];
        $count = WebList::where($where)->count();
        $limit = 2;
        $pagation = new PageApi($count, $limit);

        $list = (new WebList())->getList($where, ['id', 'title', 'thumbimg', 'subtime', 'remark', 'linkurl'], [$pagation->firstRow, $pagation->listRows], '', [['subtime', 'desc'], ['id', 'desc']]);

        if ($list) {
            foreach ($list as $key => $value) {
                $value['linkurl'] = $value['linkurl'] ?: '/' . $this->website_code . '/info?id=' . $value['id'];
                $list[$key] = $value;
            }
        }
        view()->share('list', $list ?: []);
        view()->share('_page', $pagation->show());
        view()->share('catList', $catList);
        view()->share('parentCat', $this->getMenuUrl($parentCat));
        view()->share('catInfo', $this->getMenuUrl($catInfo));
        view()->share('activeMenu', $catInfo['checkcode']);
        return $this->render($temp);
    }

    public function info()
    {
        $id = intval(\request()->input('id', 0));
        if ($id < 1) return $this->error();
        $info = (new WebListService())->info([['id', '=', $id], ['status', '=', 1]]);
        if (!$info) return $this->error();
        if (!$info['catid']) $this->error();
        $catInfo = WebCatCache::get($this->website, $info['catid']);
        if (!$catInfo || !in_array($catInfo['type'], ['list', 'goods']) || !$catInfo['status']) return $this->error();
        $infoExt = (new WebListExtService())->info($info['id']);
        $infoExt = $infoExt ?: [];
        if ($infoExt && isset($infoExt['imglist']) && $infoExt['imglist']) {
            $infoExt['imglist'] = explode(',', $infoExt['imglist']);
        }
        $temp = $catInfo['template_info'] ?: $catInfo['type'] . '_info';
        return $this->render($temp, ['catInfo' => $catInfo, 'activeMenu' => $catInfo['checkcode'], 'info' => $info, 'infoExt' => $infoExt]);
    }

    /**
     * 单页处理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page()
    {
        $id = intval(\request()->input('id', 0));
        if ($id < 1) return $this->error();
        $catInfo = WebCatCache::get($this->website, $id);
        if (!$catInfo || $catInfo['type'] != 'page' || !$catInfo['status']) return $this->error();
        $temp = $catInfo['template_list'] ?: $catInfo['type'];
        $info = (new WebListService())->info([['catid', '=', $id], ['status', '=', 1]]);
        if (!$info) return $this->error();
        $infoExt = (new WebListExtService())->info($info['id']);
        view()->share('activeMenu', $catInfo['checkcode']);
        return $this->render($temp, ['catInfo' => $catInfo, 'info' => $info, 'infoExt' => $infoExt]);
    }

    /**
     * 获取菜单列表
     * @return array
     */
    private function getMenuList()
    {
        $list = WebCatCache::get($this->website);
        $reList = [];
        if ($list) {
            foreach ($list as $val) {
                if (!$val['status']) continue;
                if ($val['parent_id'] == 0) {
                    $val['childArr'] = [];
                    $val = $this->getMenuUrl($val);
                    $reList[$val['id']] = $val;
                } else {
                    if (isset($reList[$val['parent_id']])) {
                        $val = $this->getMenuUrl($val);
                        $reList[$val['parent_id']]['childArr'][] = $val;
                    }
                }
            }
            unset($list);
        }
        return $reList;
    }

    /**
     * 获取菜单的链接
     * @param $menu
     * @return mixed
     */
    private function getMenuUrl($menu)
    {
        if ($menu && isset($menu['type'])) {
            if ($menu['type'] == 'none') {
                $menu['url'] = '';
            } elseif ($menu['type'] == 'page') {
                $menu['url'] = '/' . $this->website_code . '/page?id=' . $menu['id'];
            } elseif ($menu['type'] == 'list' || $menu['type'] == 'goods') {
                $menu['url'] = '/' . $this->website_code . '/list?id=' . $menu['id'];
            }
        }
        return $menu;
    }

    /**
     * 渲染模板
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = "", $data = [])
    {
        return view("web.site." . $this->template . '.' . strtolower($view), $data);
    }
}
