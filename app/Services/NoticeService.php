<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Models\Notice;
use App\Validates\NoticeValidate;


/**
 * 通知公告
 * Class NoticeService
 * @package App\Services
 */
class NoticeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Notice());
        $loadValidate && $this->setValidate(new NoticeValidate());
    }
}
