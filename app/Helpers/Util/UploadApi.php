<?php
namespace App\Helpers\Util;


class UploadApi{
    public $uid=0;
    public $type='';
    public $width=0;
    public $height=0;
    public $cat='';
    public $uptoken=true;

    public function run($type){
        $rearr=array('status'=>0,'msg'=>'上传完成','data'=>[]);

        $filetype=$type;

        $method=$filetype.'Upload';


        if(method_exists($this,$method)){
            return $this->$method($type,$rearr);
        }else{
            $rearr['msg']='方法错误';
            return $rearr;
        }
    }
    private function imgUpload($type,$rearr){
        $filename=\Yii::$app->request->get('filefield','');
        if($this->width || $this->height){
            $width=$this->width ;
            $height=$this->height;
        }else{
            $width=\Yii::$app->request->get('width',0);
            $height=\Yii::$app->request->get('height',0);
        }

        $upres=ImageApi::uploadimgone($type,$width,$height,$this->uid,[],$filename);
        if($upres['status']){
            $rearr['data']=$upres['data'];
            $rearr['location']=$upres['data']['imgpath'];
            $rearr['status']=1;
        }else{
            $rearr['location']='';
            $rearr['msg']=$upres['msg'];
        }
        return $rearr;
    }
    private function fileUpload($type,$rearr){
        $upres=FileApi::uploadFile($type,$this->uid);
        if($upres['status']){
            $rearr['data']=$upres['data'];
            $rearr['status']=1;
        }else{
            $rearr['msg']=$upres['msg'];
        }
        return $rearr;
    }
    private function videoUpload($type,$rearr){
        $upres=FileApi::uploadVideo($type,$this->uid);
        if($upres['status']){
            $rearr['data']=$upres['data'];
            $rearr['status']=1;
        }else{
            $rearr['msg']=$upres['msg'];
        }
        return $rearr;
    }
}
