<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;


use App\Services\AdlistService;
use Illuminate\Support\Facades\Cache;

class AdlistCache
{

    /**
     * 获取某个推荐位信息列表
     * @param string|null $type
     * @return |null
     */
    public static function get(string $type = null)
    {
        if (!paramSet($type)) {
            return null;
        }
        if(config('cache.default')=='redis'){
            $list = Cache::tags('adlist_list')->rememberForever($type, function () use ($type) {
                $list = (new AdlistService())->getTypeList($type);
                //处理跳转链接
                foreach ($list as $key=>$value){
                    $value['url']='';
                    switch ($value['redtype']){
                        case 'url':
                            $value['url']=$value['redinfo'];
                            break;
                        case 'func':
                            if($value['redfunc']){
                                $funcinfo=RedtypeCache::get($value['redfunc']);
                                $value['url']=$funcinfo?$funcinfo['list_url']:'';
                            }
                            break;
                        case 'info':
                            if($value['redfunc']){
                                $funcinfo=RedtypeCache::get($value['redfunc']);
                                $value['url']=($funcinfo?$funcinfo['info_url']:'').$value['redinfo'];
                            }
                            break;
                    }
                    $list[$key]=$value;
                }
                return $list ?: [];
            });
        }else{
            $lists=Cache::rememberForever('adlist_list',function (){
                $lists = (new AdlistService())->getAll([['status','=','1']],['adtype','title','redtype','redfunc','redinfo','text_text','text_rich','imglist'],[],'',[['adtype','asc'],['listsort','asc'],['id','asc']]);

                foreach ($lists as $key=>$value){
                    $value['url']='';
                    switch ($value['redtype']){
                        case 'url':
                            $value['url']=$value['redinfo'];
                            break;
                        case 'func':
                            if($value['redfunc']){
                                $funcinfo=RedtypeCache::get($value['redfunc']);
                                $value['url']=$funcinfo?$funcinfo['list_url']:'';
                            }
                            break;
                        case 'info':
                            if($value['redfunc']){
                                $funcinfo=RedtypeCache::get($value['redfunc']);
                                $value['url']=($funcinfo?$funcinfo['info_url']:'').$value['redinfo'];
                            }
                            break;
                    }
                    $value['imglist']=get_image_url($value['imglist']);
                    $lists[$key]=$value;
                }
                return $lists ?: [];
            });
            $list=[];
            foreach ($lists as $info){
                if($info['adtype']==$type){
                    $list[]=$info;
                }
            }
        }
        return $list;
    }


    /**
     * 字典相关清除所有
     */
    public static function clear()
    {
        if(config('cache.default')=='redis'){
            Cache::tags('adlist_list')->flush();
        }else{
            Cache::forget('adlist_list');
        }

    }
}
