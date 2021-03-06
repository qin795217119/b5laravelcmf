<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin;

use App\Services\StructService;
use Illuminate\Http\Request;

class StructController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new StructService();
    }

    public function index()
    {
        if (IS_POST) {
            return $this->service->getList(true);
        }
        return parent::index(); // TODO: Change the autogenerated stub
    }

    public function add()
    {
        if (IS_GET) {
            $parent_name = '-';
            $parent_id = request()->input('id');
            if (empty($parent_id)) {
                $parent_id = $this->service->getFirstId();
            }
            $parentInfo = $this->service->info($parent_id);
            if ($parentInfo) {
                $parent_name = $parentInfo['name'];
            }
            view()->share('parent_id', $parent_id);
            view()->share('parent_name', $parent_name);
        }
        return parent::add(); // TODO: Change the autogenerated stub
    }

    public function tree()
    {
        if (IS_POST) {
            return $this->service->getTree();
        } else {
            $id = request()->input('id','');
            $ismult = request()->input('ismult', '');
            if (empty($id) && empty($ismult)) {
                $id = $this->service->getFirstId();
            }

            view()->share('ismult', $ismult);
            view()->share('structId', $id);
            return $this->render();
        }
    }
}
