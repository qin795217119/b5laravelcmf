<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services\Wall;

use App\Models\Wall\WallProcessModel;
use App\Services\BaseService;
use App\Validates\Wall\WallProcessValidate;

class WallProcessService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new WallProcessModel());
        $loadValidate && $this->setValidate(new WallProcessValidate());
    }
}
