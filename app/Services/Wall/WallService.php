<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services\Wall;

use App\Models\Wall\WallModel;
use App\Services\BaseService;
use App\Validates\Wall\WallValidate;

class WallService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WallModel());
        $loadValidate && $this->setValidate(new WallValidate());
    }
}
