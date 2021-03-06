<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\AdpositionCache;
use App\Models\Adposition;
use App\Validates\AdpositionValidate;


/**
 * 推荐位置
 * Class AdpositionService
 * @package App\Services
 */
class AdpositionService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Adposition());
        $loadValidate && $this->setValidate(new AdpositionValidate());
    }

    /**
     * 获取位置列表
     * @param bool $valKey
     * @return array|mixed|string
     */
    public function getTypeList(bool $valKey = false)
    {
        $reArr=[];
        $list=$this->getAll([],['title','type','width','height','note'],[],'type');
        if($list){
            foreach ($list as $val){
                if($valKey){
                    $reArr[$val['type']]=$val['title'];
                }else{
                    $reArr[$val['type']]=$val;
                }
            }
        }
        return $reArr;
    }

    /**
     * 清除缓存
     * @return array
     */
    public function delcache(){
        AdpositionCache::clear();
        return message('清理缓存完成', true);
    }
}
