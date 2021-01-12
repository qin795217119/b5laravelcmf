<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;


use App\Models\WechatUsers;

/**
 * 微信用户信息
 * Class WechatUsersService
 * @package App\Services
 */
class WechatUsersService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WechatUsers());
    }


}
