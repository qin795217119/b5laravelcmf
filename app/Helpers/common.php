<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------

if (!function_exists('adminLoginInfo')) {
    /**
     * 获取管理员登录信息
     * @param null $key
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    function adminLoginInfo($key = null)
    {
        $session = session(config('app.admin_session'));
        if (is_null($key)) {
            return $session;
        } else {
            if (empty($session)) return false;
            return \Illuminate\Support\Arr::get($session, $key, false);
        }
    }
}
if(!function_exists('adminUrl')){
    /**
     * 对后台链接自动拼接module名
     * @param $route
     * @return string
     */
    function adminUrl($route){
        $module=strtolower(MODULES_NAME);
        return '/'.$module.'/'.ltrim($route,'/');
    }
}
if (!function_exists('system_isDemo')) {
    /**
     * 获取系统是否开启演示模式
     * @return bool
     */
    function system_isDemo()
    {
        if(MODULES_NAME=='admin'){
            $status=\App\Cache\ConfigCache::get('sys_config_demo');
            $status=='1'?true:false;
            $loginId=adminLoginInfo('info.id');
            $isAdmin=$loginId=='1'?true:false;
            if($isAdmin){
                return false;
            }
            return $status;
        }
        return false;
    }
}
if (!function_exists('get_password')) {

    /**
     * 获取双MD5加密密码
     * @param string $password 加密字符串
     * @return string 输出MD5加密字符串
     */
    function get_password($password)
    {
        return md5(md5($password).'b5net');
    }
}
if (!function_exists('b5UrlCreate')) {
    /**
     * Url拼接
     * @param $url
     * @param $param
     * @return string
     */
    function b5UrlCreate($url,$param)
    {
        if(!$url || !$param) return $url;
        $paramstr='';
        if(is_array($param)){
            $paramArr=[];
            foreach ($param as $pkey=>$pval){
                $paramArr[]=$pkey.'='.$pval;
            }
            $paramstr=implode('&',$paramArr);
        }

        if(strpos($url,'?')===false){
            $url.='?'.$paramstr;
        }else{
            $url.='&'.$paramstr;
        }
        return $url;
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
     * @param mixed $image_url 图片地址
     * @param bool $isArray
     * @return string 返回图片网络地址
     */

    function get_image_url($image_url,bool $isArray=true)
    {
        $rearr=[];
        if($image_url){
            if(is_array($image_url)){

            }elseif (strpos($image_url,',')){
                $image_url=explode(',',$image_url);
            }else{
                $image_url=(array)$image_url;
            }
            foreach ($image_url as $img){
                if($img){

                    if(strpos($img,'http')===0){
                        $rearr[]=$img;
                    }else{
                        $rearr[]= IMG_URL . $img;
                    }
                }
            }
        }
        return $isArray?$rearr:implode(',',$rearr);
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
if (!function_exists('paramSet')) {
    /**
     * 判断变量是否为null或空字符串
     * @param $key
     * @return bool
     */
    function paramSet($key)
    {
        if (is_null($key) || $key === '') {
            return false;
        }
        return true;
    }
}
if (!function_exists('arr_keymap')) {
    /**
     * 将二维数组 变成一维 以某个值为键或以某个值为值
     * @param array $arr
     * @param string $key
     * @param string|null $valueKey
     * @return array
     */
    function arr_keymap(array $arr,string $key,string $valueKey=null)
    {
        if(empty($arr)) return [];
        if(empty($key)) return $arr;
        $reArr=[];
        foreach ($arr as $value){
            if(is_array($value) && isset($value[$key])){
                if(paramSet($valueKey)){
                    $reArr[$value[$key]]=$value[$valueKey]??'';
                }else{
                    $reArr[$value[$key]]=$value;
                }
            }

        }
        return $reArr;
    }
}
if (!function_exists('b5curl_post')) {
    /**
     * curl的POST请求
     * @param $url
     * @param $array
     * @return bool|string
     */
    function b5curl_post($url, $array)
    {
        $curl = curl_init();
        //设置提交的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data = $array;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //获得数据并返回
        return $data;
    }
}
if (!function_exists('b5curl_get')) {
    /**curl的GET请求
     * @param $url
     * @return bool|string
     */
    function b5curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }
}
if (!function_exists('time_ago')) {
    /**
     * 时间处理
     * @param $timestamp
     * @return false|string
     */
    function time_ago($timestamp)
    {
        //相差时间戳
        $counttime = time() - $timestamp;
        //进行时间转换
        if ($counttime <= 60) {
            return '刚刚';
        } else if ($counttime < 3600) {
            return intval(($counttime / 60)) . '分钟前';
        } else if ($counttime >= 3600 && $counttime < 3600 * 24) {
            return intval(($counttime / 3600)) . '小时前';
        } else if ($counttime <= 3600 * 24 * 10) {
            return intval(($counttime / (3600 * 24))) . '天前';
        } else {
            return date('Y-m-d', $timestamp);
        }
    }
}
if (!function_exists('b5get_age')) {
    /**
     * 获取年龄
     * @param $start
     * @param $end
     * @return bool|int|mixed
     */
    function b5get_age($start, $end = '')
    {
        if (!$start) return false;
        $start = strtotime($start);
        if ($start === false) return false;

        if ($end) {
            $end = strtotime($end);
            if ($end === false) return false;
        } else {
            $end = time();
        }
        if ($end < $start) return false;
        list($y1, $m1, $d1) = explode("-", date("Y-m-d", $start));
        list($y2, $m2, $d2) = explode("-", date("Y-m-d", $end));
        $age = $y2 - $y1;
        if ((int)($m2 . $d2) < (int)($m1 . $d1))
            $age -= 1;
        return $age;
    }
}
