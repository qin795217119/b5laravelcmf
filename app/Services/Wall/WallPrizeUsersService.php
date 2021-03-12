<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services\Wall;

use App\Models\Wall\WallPrizeUsersModel;
use App\Services\BaseService;

class WallPrizeUsersService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WallPrizeUsersModel());
    }
}
