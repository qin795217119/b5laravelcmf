<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services\Wall;

use App\Models\Wall\WallUsersModel;
use App\Services\BaseService;
use App\Validates\Wall\WallUsersValidate;

class WallUsersService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WallUsersModel());
        $loadValidate && $this->setValidate(new WallUsersValidate());
    }
}
