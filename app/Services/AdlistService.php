<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\AdlistCache;
use App\Models\Adlist;
use App\Validates\AdlistValidate;


/**
 * 推荐信息
 * Class AdlistService
 * @package App\Services
 */
class AdlistService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Adlist());
        $loadValidate && $this->setValidate(new AdlistValidate());
    }

    /**
     * 获取位置信息列表
     * @return array|mixed|string
     */
    public function getTypeList(string $type,int $limit=0)
    {
        $reArr=[];
        if(!$type) return $reArr;
        $pagation=[];
        if($limit>0){
            $pagation=[0,$limit];
        }
        $list=$this->getAll([['adtype','=',$type],['status','=',1]],['title','redtype','redfunc','redinfo','text_text','text_rich','imglist'],$pagation,'',[['listsort','asc'],['id','asc']]);
        if($list){
            foreach ($list as $val){
                $val['imglist']=get_image_url($val['imglist']);
                $reArr[]=$val;
            }
        }
        return $reArr;
    }

    /**
     * 清除缓存
     * @return array
     */
    public function delcache(){
        AdlistCache::clear();
        return message('清理缓存完成', true);
    }
}
