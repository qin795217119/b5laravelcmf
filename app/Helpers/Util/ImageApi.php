<?php
namespace App\Helpers\Util;

use common\models\Picture;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;


class ImageApi
{
    /** 显示图片或缩略图
     * @param $imapath
     * @param int $width
     * @param int $height
     * @param bool $all 当缩略图不存在时是否重新生成
     * @return string
     */
    public static function showpic($imapath,$width=0,$height=0,$all=true){
        if(!$imapath) return $imapath;
        $repath=$imapath;
        if(strpos($imapath,'http')===0 || strpos($imapath,'//')===0){
            return $repath;
        }
        $rootPath=\Yii::getAlias('@b5root');
        //原图片不存在 直接返回孔
        if(!file_exists($rootPath.$imapath)) return $repath;
        //不需要缩略图 直接返回
        if($width>0 || $height>0){
            $pathinfo=pathinfo($imapath);
            $thumbpath=$pathinfo['dirname'].'/'.$pathinfo['filename'].'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
            //缩略图存在 直接返回缩略图
            if(file_exists($rootPath.$thumbpath)){
                $repath=$thumbpath;
            }else{
                if($all){
                    ImageApi::thumbimg($rootPath.$imapath,$width,$height,$rootPath.$thumbpath);
                    if(file_exists($rootPath.$thumbpath)){
                        $repath=$thumbpath;
                    }
                }
            }
        }
        return CommonApi::getDomain($repath);
    }


    /**
     * 生成缩略图
     * @param $image
     * @param $width
     * @param $height
     * @param string $thumbpath
     * @return bool
     */
    public static function thumbimg($image,$width,$height,$thumbpath=""){

        if(empty($image) || !file_exists($image)) return false;
        $width=intval($width);$height=intval($height);
        if($width<1 && $height<1) return false;
        if(!$thumbpath) {
            $pathinfo = pathinfo($image);
            $thumbpath = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $width . '_' . $height . '.' . $pathinfo['extension'];
        }
        $width=$width<1?null:$width;
        $height=$height<1?null:$height;
        Image::thumbnail($image,$width,$height)->save($thumbpath,['quality' => 80]);
        $rootPath=Yii::getAlias('@b5root');
        return str_replace($rootPath,'',$thumbpath);
    }

    /**上传图片
     * @param $image
     * @param string $type
     * @param int $width
     * @param int $height
     * @return array
     */
    public static function uploadimgone($type='',$width=0,$height=0,$uid=0,$fileTypes=[],$fileField=''){
        if(!$type) $type='images';
        if(!$fileTypes) $fileTypes=['jpg','jpeg','gif','png'];
        if(!$fileField) $fileField='file';
        $uploadobj=new UploadedFile();
        $image = $uploadobj::getInstanceByName($fileField);

        if(!$image){
            $image=$uploadobj::getInstanceNoName();
        }
        $rearr=array('status'=>0,'msg'=>'错误了','data'=>array());
        if(empty($image) || !is_object($image)){
            $rearr['msg']="未获得图片文件";
            return $rearr;
        }
        $thisext=strtolower($image->getExtension());
        if (!in_array($thisext,$fileTypes)) {
            $rearr['msg']="图片文件格式为jpg、jpeg、gif、png";
            return $rearr;
        }
        $thissize=$image->size;
        if($thissize){
            $maxsize=10*1024*1024;//10M
            if($maxsize<$thissize){
                $rearr['msg']="图片最大为10M";
                return $rearr;
            }
        }
        if($image->getHasError()){
            if($image->error==1){
                $rearr['msg']="图片上传错误:超出服务器限制";
            }else{
                $rearr['msg']="图片上传错误:".$image->error;
            }
            return $rearr;
        }
        $rootPath=Yii::getAlias('@b5root');
        $md5hash="";
        if($image->tempName){
            $md5hash=md5_file($image->tempName);
            if($md5hash){
                $hasinfo=Picture::find()->where("md5hash='".$md5hash."' and type='".$type."'")->one();
                if($hasinfo){
                    if(!file_exists($rootPath.$hasinfo->filepath)){
                        $hasinfo->delete();
                    }else{
                        $rearr['data']['filename']=$hasinfo->filename;
                        $rearr['data']['imgpath']=$hasinfo->filepath;
                        $rearr['status']=1;
                        return $rearr;
                    }
                }
            }
        }
        $targetFileName=md5($image->getBaseName().microtime().rand(1000,9999)).'.'.$thisext;
        $targetPath='/uploads/'.$type.'/'.date('Ym').'/'.date('d');
        $targetFolder = $rootPath.$targetPath;
        $filehelper = new FileHelper();
        $filehelper->createDirectory($targetFolder,0777);
        if($image->saveAs($targetFolder.'/'.$targetFileName)) {
            $savepath=$targetPath.'/'.$targetFileName;
            if(!file_exists($rootPath.$savepath)){
                $rearr['msg']='图片获取失败';
                return $rearr;
            }
            $picmodel=new Picture();
            $picmodel->type=$type;
            $picmodel->fileext=$thisext;
            $picmodel->filepath=$savepath;
            $picmodel->createtime=time();
            $picmodel->userid=$uid;
            $picmodel->filesize=$thissize;
            $picmodel->filename=$targetFileName;
            $picmodel->uploadip=Yii::$app->request->userIP;
            $picmodel->md5hash=empty($md5hash)?"":$md5hash;
            $rs=$picmodel->save();
            if(!$rs){
                $rearr['msg']="图片保存失败";
                return $rearr;
            }
            if($width>0 || $height>0){
                self::thumbimg($rootPath.$savepath,$width,$height,$rootPath.$savepath);
            }
            $rearr['data']['filename']=$targetFileName;
            $rearr['data']['imgpath']=$savepath;
            $rearr['status']=1;
            return $rearr;
        }
        else
        {
            $rearr['msg']='图片上传失败';
            return $rearr;
        }
    }
    public static function delimage($imapath,$ss=false){
        if(empty($imapath)) return true;
        $rootPath=Yii::getAlias("@b5root");
        if(!file_exists($rootPath.$imapath)) return true;

        $pathinfo=pathinfo($imapath);
        $filename=$pathinfo['filename'];
        $res=FileHelper::findFiles($rootPath.$pathinfo['dirname']);
        foreach($res as $val){
            if(stripos($val,$filename)){
                FileHelper::unlink($val);
            }
        }
    }
    /**上传图片
     * @param $image
     * @param string $type
     * @param int $width
     * @param int $height
     * @return array
     */
    public static function uploadimgone_phone($image,$uid=0,$width=0,$height=0,$fileTypes = ['jpg','jpeg','gif','png']){
        $rearr=array('status'=>0,'msg'=>'错误了','data'=>array());
        if(empty($image) || !is_object($image)){
            $rearr['msg']="未获得图片文件";
            return $rearr;
        }
        if($uid<1){
            $rearr['msg']="登录信息错误";
            return $rearr;
        }
        $thisext=$image->getExtension();
        if (!in_array(strtolower($thisext),$fileTypes)) {
            $rearr['msg']="图片文件格式为jpg、jpeg、gif、png";
            return $rearr;
        }
        $thissize=$image->size;
        if($thissize){
            $maxsize=10*1024*1024;//10M
            if($maxsize<$thissize){
                $rearr['msg']="图片最大为10M";
                return $rearr;
            }
        }
        if($image->getHasError()){
            if($image->error==1){
                $rearr['msg']="图片上传错误:超出服务器限制";
            }else{
                $rearr['msg']="图片上传错误:".$image->error;
            }
            return $rearr;
        }
        $rootPath=Yii::getAlias('@b5root');
        $md5hash="";
        if($image->tempName){
            $md5hash=md5_file($image->tempName);
            if($md5hash){
                $hasinfo=Picture::find()->where("md5hash='".$md5hash."'")->one();
                if($hasinfo){
                    if(!file_exists($rootPath.$hasinfo->filepath)){
                        $hasinfo->delete();
                    }else{
                        $rearr['data']['imgpath']=$hasinfo->filepath;
                        $rearr['data']['imgpath_token']=md5('b5net'.$rearr['data']['imgpath']);
                        $rearr['status']=1;
                        return $rearr;
                    }
                }
            }
        }
        $targetFileName=md5($image->getBaseName().microtime().rand(1000,9999)).'.'.$thisext;
        $upath=$uid%500;
        $targetPath='/uploads/xcx/'.$upath.'/'.$uid;
        $targetFolder = $rootPath.$targetPath;
        $filehelper = new FileHelper();
        $filehelper->createDirectory($targetFolder,0777);
        if($image->saveAs($targetFolder.'/'.$targetFileName)) {
            $savepath=$targetPath.'/'.$targetFileName;
            if(!file_exists($rootPath.$savepath)){
                $rearr['msg']='图片获取失败';
                return $rearr;
            }
            $picmodel=new Picture();
            $picmodel->userid=$uid;
            $picmodel->filename=$targetFileName;
            $picmodel->md5path=md5($savepath);
            $picmodel->filepath=$savepath;
            $picmodel->createtime=time();
            $picmodel->md5hash=empty($md5hash)?"":$md5hash;
            $rs=$picmodel->save();
            if(!$rs){
                $rearr['msg']="图片保存失败";
                return $rearr;
            }

            if($width>0 && $height>0){
                self::thumbimg($rootPath.$savepath,$width,$height);
            }else{
                if($thissize>0.8*1024*1024){//大于0.8M时自动压缩
                    self::thumbimg($rootPath.$savepath,0,0,$rootPath.$savepath);
                }
            }
            $rearr['data']['imgid']=$picmodel->id;
            $rearr['data']['imgpath']=$savepath;
            $rearr['data']['imgpath_token']=md5('b5net'.$rearr['data']['imgpath']);
            $rearr['status']=1;
            return $rearr;
        }
        else
        {
            $rearr['msg']='图片上传失败';
            return $rearr;
        }
    }
}
