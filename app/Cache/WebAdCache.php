<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Cache;

use App\Services\WebAdService;

class WebAdCache
{
    public static function get($pos_id,$num=0){
        if(!$pos_id) return [];
        if($num>0){
            $pageData=[0,$num];
        }else{
            $pageData=[];
        }
        $list=(new WebAdService())->getAll([['pos_id','=',$pos_id],['status','=',1]],['id','title','linkurl','imglist'],$pageData,'',[['listsort','asc'],['id','asc']]);
        if($list){
            foreach ($list as $key=>$value){
                if($value['imglist']){
                    $value['imglist']=explode(',',$value['imglist']);
                }else{
                    $value['imglist']=[];
                }
                $value['firstimg']=$value['imglist']?$value['imglist'][0]:'';
                $list[$key]=$value;
            }
        }
        return $list;
    }
}
