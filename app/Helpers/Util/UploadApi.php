<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Helpers\Util;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UploadApi
{
    public $type = 'img'; //文件类型 img,file
    public $fileName = 'file';
    public $cat = 'images';//路径前缀
    public $saveName = '';//保存文件名
    public $savePath = '';//保存路径规格 Y代表为/年 M为/年/月  YM为/年月
    private $root = 'uploads';//根目录
    public $maxSize = 0;

    public $width = 0;
    public $height = 0;
    public $imgExt = ['jpg', 'gif', 'jpeg', 'png'];
    public $isCrop = true;//是否裁剪保持宽高，只有宽度和高度都存在时


    public function run()
    {
        $rearr = ['status' => 0, 'msg' => '上传完成', 'data' => []];
        $method = $this->type . 'Upload';

        if (method_exists($this, $method)) {
            return $this->$method($rearr);
        } else {
            $rearr['msg'] = '方法错误';
            return $rearr;
        }
    }


    /**
     * 文件上传
     * @param $rearr
     * @return mixed
     */
    private function fileUpload($rearr)
    {
        $file = request()->file($this->fileName);
        if (!$file->isValid()) {
            $rearr['msg'] = '无效文件';
            return $rearr;
        }
        $size = $file->getSize();
        if ($this->maxSize > 0) {
            $sizeKb = 0;
            if ($size) {
                $sizeKb = round($size / 1024, 2);
            }
            if ($sizeKb > 0 && $sizeKb > $this->maxSize) {
                $rearr['msg'] = '文件大小超出限制';
                return $rearr;
            }
        }

        $ext = $file->getClientOriginalExtension();//文件扩展名
        $originName = $file->getClientOriginalName();//源文件名

        $savePath = $this->getSavePath();//保存路径
        $uploads = public_path($savePath);

        $fileName = $this->getFileName($originName);//获取文件名
        $fileFullName = $fileName . '.' . $ext;

        $filePath = DIRECTORY_SEPARATOR . trim($savePath . DIRECTORY_SEPARATOR . $fileFullName, DIRECTORY_SEPARATOR);//前端显示文件地址
        $filePath = str_replace(DIRECTORY_SEPARATOR, '/', $filePath);

        $res = $file->move($uploads, $fileFullName);
        if ($res) {
            $rearr['status'] = 1;
            $rearr['data'] = [
                'path' => $filePath,
                'url' => get_image_url($filePath),
                'originName' => $originName,
                'ext' => $ext,
                'size' => $size,
            ];
        } else {
            $rearr['msg'] = '文件上传失败';
        }
        return $rearr;
    }

    /**
     * 图片上传
     * @param $rearr
     * @return mixed
     */
    private function imgUpload($rearr)
    {
        $file = request()->file($this->fileName);
        if (!$file->isValid()) {
            $rearr['msg'] = '无效文件';
            return $rearr;
        }

        $ext = $file->getClientOriginalExtension();//文件扩展名
        if (!in_array(strtolower($ext), $this->imgExt)) {
            $rearr['msg'] = '图片后缀格式不符合';
            return $rearr;
        }

        $imgObject = Image::make($file);
        if (!$imgObject) {
            $rearr['msg'] = '无效文件';
            return $rearr;
        }

        $size = $imgObject->filesize();
        if ($this->maxSize > 0) {
            $sizeKb = 0;
            if ($size) {
                $sizeKb = round($size / 1024, 2);
            }
            if ($sizeKb > 0 && $sizeKb > $this->maxSize) {
                $rearr['msg'] = '文件大小超出限制';
                return $rearr;
            }
        }

        $originName = $file->getClientOriginalName();//源文件名


        $savePath = $this->getSavePath();//保存路径
        $uploads = public_path($savePath);

        File::isDirectory($uploads) or File::makeDirectory($uploads, 0777, true, true);

        $fileName = $this->getFileName($originName);//获取文件名
        $fileFullName = $fileName . '.' . $ext;

        $saveFullFile = $uploads . DIRECTORY_SEPARATOR . $fileFullName;//保存的完整路径和文件名

        $filePath = DIRECTORY_SEPARATOR . trim($savePath . DIRECTORY_SEPARATOR . $fileFullName, DIRECTORY_SEPARATOR);//前端显示文件地址
        $filePath = str_replace(DIRECTORY_SEPARATOR, '/', $filePath);


        $width = $imgObject->width();//图片宽度

        $height = $imgObject->height();//图片高度
        if ($width > 2000 || $this->width > 0 || $this->height > 0) {
            //保存原图
            $file->move($uploads, $fileName . '_origin.' . $ext);

            if ($this->width > 0 && $this->height > 0) {
                if ($this->isCrop) {//将图片裁剪到指定比例，并选取合适的大小
                    $imgObject->fit($this->width, $this->height, function ($constraint) {
                        $constraint->upsize();
                    });
                } else {
                    if ($width > $this->width || $height > $this->height) {
                        //使最大的边在限制范围内；较小的边将被缩放以保持原始纵横比
                        $imgObject->resize($this->width, $this->height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    }
                }
            } elseif ($this->width > 0) {
                //根据宽度调整，保持图片缩放
                if ($width > $this->width) {
                    $imgObject->resize($this->width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
            } elseif ($this->height > 0) {
                //根据高度调整，保持图片缩放
                if ($height > $this->height) {
                    $imgObject->resize(null, $this->height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            } elseif ($width > 2000) {
                $imgObject->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }
        $res = $imgObject->save($saveFullFile);

        if ($res) {
            $rearr['status'] = 1;
            $rearr['data'] = [
                'path' => $filePath,
                'url' => get_image_url($filePath),
                'originName' => $originName,
                'ext' => $ext,
                'size' => $size,
            ];
        } else {
            $rearr['msg'] = '文件上传失败';
        }
        $imgObject->destroy();
        return $rearr;
    }


    /**
     * 获取保存路径
     * @return false|string
     */
    private function getSavePath()
    {
        if (!$this->savePath || $this->savePath == 'D') {
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d');
        } elseif ($this->savePath == 'Y') {
            $savePath = date('Y');
        } elseif ($this->savePath == 'M') {
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m');
        } elseif ($this->savePath == 'YM') {
            $savePath = date('Ym');
        } else {
            $savePath = $this->savePath;
        }
        return ($this->root ? ($this->root . DIRECTORY_SEPARATOR) : '') . ($this->cat ? ($this->cat . DIRECTORY_SEPARATOR) : '') . $savePath;
    }

    /**
     * 获取文件名称
     * @param $originName
     * @return string
     */
    private function getFileName($originName)
    {
        $fileName = $this->saveName;
        if (!$fileName) {
            $fileName = md5($originName . time() . mt_rand(1000, 9999));
        }
        return $fileName;
    }
}
