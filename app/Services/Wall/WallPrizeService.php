<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services\Wall;

use App\Models\Wall\WallPrizeModel;
use App\Services\BaseService;
use App\Validates\Wall\WallPrizeValidate;

class WallPrizeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WallPrizeModel());
        $loadValidate && $this->setValidate(new WallPrizeValidate());
    }
}
