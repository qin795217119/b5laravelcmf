<?php
// 此文件为系统框架核心公共函数文件，为了系统的稳定与安全，未经允许不得擅自改动
if (!function_exists('get_password')) {

    /**
     * 获取双MD5加密密码
     * @param string $password 加密字符串
     * @return string 输出MD5加密字符串
     * @author 牧羊人
     * @date 2019/5/23
     */
    function get_password($password)
    {
        return md5(md5($password).'b5net');
    }

}
if (!function_exists('message')) {
    /**
     * 消息数组
     * @param string $msg
     * @param bool $success
     * @param array $data
     * @param int $code
     * @param string $url
     * @param array $extend
     * @return array
     */
    function message($msg = "操作成功", $success = true, $data = [], $code = null, $url = '', $extend = [])
    {
        $result = ['success' => $success, 'msg' => $msg, 'data' => $data, 'url' => $url];
        if ($success) {
            $result['code'] = is_null($code) ? 0 : $code;
        } else {
            $result['code'] = is_null($code) ? -1 : $code;
        }
        if ($extend) {
            foreach ($extend as $key => $value) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

if (!function_exists('get_image_url')) {

    /**
     * 获取图片地址
     * @param $image_url 图片地址
     * @return string 返回图片网络地址
     */
    function get_image_url($image_url,$default='')
    {
        if(!$image_url) return $default;
        if(strpos($image_url,',')){
            $image_url=explode(',',$image_url);
        }
        if(is_array($image_url)){
            $reInfo=[];
            foreach ($image_url as $img){
                if($img){
                    $reInfo[]=get_image_url($img);
                }
            }
            return  $reInfo;
        }
        if(strpos($image_url,'http')===0){
            return $image_url;
        }else{
            return IMG_URL . $image_url;
        }
    }
}


if (!function_exists('sub_str')) {

    /**
     * 字符串截取
     * @param string $str 需要截取的字符串
     * @param int $start 开始位置
     * @param int $length 截取长度
     * @param bool $suffix 截断显示字符
     * @param string $charset 编码格式
     * @return string 返回结果
     */

    function sub_str($str, $start = 0, $length = 10, $suffix = true, $charset = "utf-8")
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        $omit = mb_strlen($str) >= $length ? '...' : '';
        return $suffix ? $slice . $omit : $slice;
    }

}

if (!function_exists('strline_array')) {
    /**
     * 将字符串根据换行、分号、逗号转为数组，并可以再次根据设置分数组
     * @param $value
     * @param string $sediff
     * @return array|false|string[]
     */
    function strline_array($value, $sediff = '')
    {
        if ($value) {
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
            if ($sediff && strpos($value, $sediff)) {
                $value = [];
                foreach ($array as $val) {
                    list($k, $v) = explode($sediff, $val);
                    $value[$k] = $v;
                }
            } else {
                $value = $array;
            }
        } else {
            $value = [];
        }
        return $value;
    }
}
