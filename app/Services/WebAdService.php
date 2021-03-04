<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\AdlistCache;
use App\Models\WebAd;
use App\Validates\WebAdValidate;


/**
 * 网站广告信息
 * Class WebAdService
 * @package App\Services
 */
class WebAdService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WebAd());
        $loadValidate && $this->setValidate(new WebAdValidate());
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
