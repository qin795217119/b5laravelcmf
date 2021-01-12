<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;


use App\Models\WechatAccess;

/**
 * 微信公众号token和jsapi信息
 * Class WechatAccessService
 * @package App\Services
 */
class WechatAccessService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WechatAccess());
    }


}
