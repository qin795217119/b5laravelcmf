<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Web\Site;

use App\Cache\WebCatCache;
use App\Cache\WebSiteCache;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

//网站
class SiteController extends BaseController
{
    public $website;
    public $template='default';

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $className=str_replace('controller','',strtolower(class_basename(get_class($this))));
        $siteInfo=WebSiteCache::getByCode($className);
        if(IS_GET) view()->share('siteInfo',$siteInfo);
        $this->website=$siteInfo['id'];
    }

    public function index(){
        view()->share('menuList',$this->getMenuList());
        return $this->render('index');
    }

    public function getMenuList(){
        $list=WebCatCache::get($this->website);

        $reList=[];
        if($list){
            foreach ($list as $val){
                if(!$val['status']) continue;
                if($val['parent_id']==0){
                    $val['childArr']=[];
                    $reList[$val['id']]=$val;
                }else{
                    if(isset($reList[$val['parent_id']])){
                        $reList[$val['parent_id']]['childArr'][]=$val;
                    }
                }
            }
            unset($list);
        }
        return $reList;
    }


    /**
     * 渲染模板
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = "", $data = [])
    {
        // 获取请求地址
        return view("web.site." .$this->template.'.'. strtolower($view), $data);
    }
}
