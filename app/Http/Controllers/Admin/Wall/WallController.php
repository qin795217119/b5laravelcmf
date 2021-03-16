<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Admin\Wall;


use App\Http\Controllers\Admin\Backend;
use App\Services\Wall\WallPrizeService;
use App\Services\Wall\WallPrizeUsersService;
use App\Services\Wall\WallProcessService;
use App\Services\Wall\WallService;
use App\Services\Wall\WallUsersService;
use Illuminate\Http\Request;


class WallController extends Backend
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new WallService();
        $this->view_group = 'wall';
    }

    public function initdata(){
        $id=intval(request()->input('wall_id',0));
        if($id<1){
            return $this->toError('参数错误');
        }
        $wallInfo=$this->service->info($id);
        if(empty($wallInfo)) return $this->toError('活动信息不存在');
        if(IS_POST){
            $type=trim(request()->input('type',''));
            if(!$type) return message('类型参数错误',false);
            switch ($type){
                case 'wall':
                    (new WallService())->drop($wallInfo['id']);
                    (new WallPrizeService())->trash([['wall_id','=',$wallInfo['id']]]);
                    (new WallProcessService())->trash([['wall_id','=',$wallInfo['id']]]);
                case 'wallusers':
                    (new WallUsersService())->trash([['wall_id','=',$wallInfo['id']]]);
                case 'prizeusers':
                    (new WallPrizeUsersService())->trash([['wall_id','=',$wallInfo['id']]]);
                    break;
            }
            return message('清除成功',true);
        }else{
            view()->share('wallInfo',$wallInfo);
            return $this->render();
        }
    }
}
