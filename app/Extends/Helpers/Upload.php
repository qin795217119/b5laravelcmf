<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Helpers;

use App\Extends\Cache\ConfigCache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Upload
{
    public string $type = 'img'; //文件类型 img,file,video
    public string $fileName = 'file';//上传文件名称
    public string $cat = 'images';//路径前缀
    public int $maxSize = 0; //文件最大 kb
    public array $ext = []; //文件后缀
    public string $savePath = '';//保存路径规格 Y代表为/年 M为/年/月  YM为/年月

    //缩略图设置，其中一个大于0则开启
    public int $width = 0; //缩略图宽度
    public int $height = 0;//缩略图高度

    public bool $water = false;//水印设置


    /**
     * 上传
     * @return JsonResponse
     */
    public function run(): JsonResponse
    {
        $method = $this->type . 'Upload';
        if (method_exists($this, $method)) {
            if (!$this->fileName) $this->fileName = 'file';
            return $this->$method();
        } else {
            return Result::error('方法错误');
        }
    }


    /**
     * 图片上传
     * @return JsonResponse
     */
    protected function imgUpload(): JsonResponse
    {
        if (!$this->cat) $this->cat = 'images';
        if (!$this->ext) $this->ext = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        if ($this->maxSize < 1) $this->maxSize = 10 * 1024;//10M
        return $this->_upload();
    }

    /**
     * 视频上传
     * @return JsonResponse
     */
    protected function videoUpload(): JsonResponse
    {
        if (!$this->cat) $this->cat = 'video';
        if (!$this->ext) $this->ext = ['mp4', 'm3u8', 'ogv', 'webm'];
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }


    /**
     * 文件上传
     * @return JsonResponse
     */
    protected function fileUpload(): JsonResponse
    {
        if (!$this->cat) $this->cat = 'file';
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }

    /**
     * 上传操作方法
     * @return JsonResponse
     */
    protected function _upload(): JsonResponse
    {
        $file = request()->file($this->fileName);

        if (!$file->isValid()) {
            if ($file->getError() == 1) {
                $error = "上传错误:超出服务器限制";
            } else {
                $error = "上传错误:" . $file->getErrorMessage();
            }
            return Result::error($error);
        }


        //验证大小和格式
        $thisExt = strtolower($file->getClientOriginalExtension());
        if ($this->ext && !in_array($thisExt, $this->ext)) {
            return Result::error('格式只能是：' . implode('、', $this->ext));
        }
        $thisSize = $file->getSize();
        if ($thisSize && $this->maxSize * 1024 < $thisSize) {
            return Result::error('文件超过最大限制:' . Transform::sizeFormat($this->maxSize * 1024));
        }

        //根路径
        $root = public_path();
        //保存前地址
        $saveRoot = DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
        //保存路径
        $savePath = $this->getSavePath();
        //创建保存目录
        $uploads = $root. $saveRoot . $savePath . DIRECTORY_SEPARATOR;
        File::isDirectory($uploads) or File::makeDirectory($uploads, 0777, true, true);
        //定义保存名称
        $saveName = $this->getSaveName($file);

        //如果是图片 并且 生成缩略图或添加水印
        $water_text = trim(ConfigCache::get('img_water_text_color', ''));
        if ($this->type == 'img' && ($this->width > 0 || $this->height > 0) || ($this->water && $water_text)) {
            $image = Image::make($file);
            if (!$image) {
                return Result::error('图片打开错误');
            }
            $width = $image->width(); // 返回图片的宽度
            $height = $image->height(); // 返回图片的高度

            if ($this->width > 0 && $this->height > 0) {
                if ($width > $this->width && $height > $this->height) {
                    //将图片裁剪到指定比例，并选取合适的大小
                    $image->fit($this->width, $this->height, function ($constraint) {
                        $constraint->upsize();
                    });
                } else if ($width > $this->width || $height > $this->height) {
                    //使最大的边在限制范围内；较小的边将被缩放以保持原始纵横比
                    $image->resize($this->width, $this->height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            } elseif ($this->width > 0) {
                //根据宽度调整，保持图片缩放
                if ($width > $this->width) {
                    $image->resize($this->width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
            } elseif ($this->height > 0) {
                //根据高度调整，保持图片缩放
                if ($height > $this->height) {
                    $image->resize(null, $this->height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            } elseif ($width > 2000) {
                $image->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $result = $image->save($uploads.$saveName);
        }else{
            $result = $file->move($uploads,$saveName);
        }
        if ($result) {
            $fullPath = str_replace(DIRECTORY_SEPARATOR,'/',$saveRoot.$savePath.DIRECTORY_SEPARATOR.$saveName);
            $data = [
                'path' => $fullPath,
                'url' => Functions::getFileUrl($fullPath),
                'originName' => $file->getClientOriginalName(),
                'ext' => $thisExt,
            ];
            return Result::success('上传成功',$data);
        } else {
            return Result::error('上传失败');
        }
    }

    /**
     * 获取保存路径
     * @return string
     */
    protected function getSavePath(): string
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
        $savePath = ($this->cat ? ($this->cat . DIRECTORY_SEPARATOR) : '') . $savePath;
        return $savePath;
    }

    /**
     * 获取保存名称
     * @param $file
     * @return string
     */
    protected function getSaveName($file): string
    {
        return md5(microtime(true) . $file->getClientOriginalName()) . '.' . strtolower($file->getClientOriginalExtension());
    }
}
