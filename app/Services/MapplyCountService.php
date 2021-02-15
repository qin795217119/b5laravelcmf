<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\MapplyCount;

/**
 * 微信预约统计
 * Class MapplyCountService
 * @package App\Services
 */
class MapplyCountService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new MapplyCount());
    }


}
