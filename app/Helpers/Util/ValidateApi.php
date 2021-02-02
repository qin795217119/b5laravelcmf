<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:常用验证类
// +----------------------------------------------------------------------
namespace App\Helpers\Util;

class ValidateApi
{
    /**
     * 验证身份证是否正确
     * @param string $idcard 身份证号
     * @return bool 返回结果true或false
     */
    public static function isIdcard($idcard)
    {
        $idcard = strtoupper($idcard);
        $idcard_len=strlen($idcard);
        if($idcard_len!==15 && $idcard_len!==18){
            return false;
        }
        $idcard_verify_number=function ($idbase){
            //获取最后验证
            $factor=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);  //加权因子
            $verify_number_list=array('1','0','X','9','8','7','6','5','4','3','2');//校验码对应值
            $checksum=0;
            for($i=0;$i<strlen($idbase);$i++){
                $checksum += substr($idbase,$i,1) * $factor[$i];
            }
            $mod=$checksum % 11;
            return $verify_number_list[$mod];
        };
        if($idcard_len===15){
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if(array_search(substr($idcard,12,3),array('996','997','998','999')) !== false){
                $idcard=substr($idcard,0,6).'18'.substr($idcard,6,9);
            }else{
                $idcard=substr($idcard,0,6).'19'.substr($idcard,6,9);
            }
            $idcard=$idcard.$idcard_verify_number($idcard);
        }

        $idcard_base = substr($idcard, 0, 17);
        if ($idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))) {
            return false;
        }
        $birthday=substr($idcard, 6, 8);
        if(strtotime($birthday)===false){
            return false;
        }
        $rearr=[];
        $birthday_format=date('Y-m-d',strtotime($birthday));
        $rearr['birthday']=$birthday_format;
        $rearr['age']=b5get_age($birthday_format);
        $rearr['sex']=substr($idcard, ($idcard_len==18 ? -2 : -1), 1) % 2 ? 1 : 2;
        return $rearr;
    }


    /**
     * 验证手机号或座机号
     * @param $mobile_phone
     * @param bool $tel 是否验证座机
     * @return bool
     */
    public static function is_mobile_phone($mobile_phone,$tel=false){
        $chars = "/^1[2-9]{1}[0-9]{1}[0-9]{8}$/";
        $chars1="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
        if(!preg_match($chars, $mobile_phone)) {
            if($tel){
                if(!preg_match($chars1, $mobile_phone)){
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }

    /**
     * 是否为邮箱
     * @param $email
     * @return mixed
     */
    public static function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    /**
     * 是否中文
     * @param $str
     * @return bool
     */
    public static function isChinese($str){
        if (preg_match('/^[\x7f-\xff]+$/', $str)) {
            return true;
        }
        return false;
    }
    /**
     * 验证只能是字母
     * @param $str
     * @return bool
     */
    public static function isAlpha($str){
        if(preg_match('/^[A-Za-z]+$/',$str)){
            return true;
        }
        return false;
    }
    /**
     * 验证只能是字母、数字、下划线和破折号
     * @param $str
     * @return bool
     */
    public static function isAlphaDash($str){
        if(preg_match('/^[A-Za-z0-9_-]+$/',$str)){
            return true;
        }
        return false;
    }
    /**
     * 验证只能是字母、数字
     * @param $str
     * @return bool
     */
    public static function isAlphaNum($str){
        if(preg_match('/^[A-Za-z0-9]+$/',$str)){
            return true;
        }
        return false;
    }

    /**
     * 验证只能是整数
     * @param $str
     * @return bool
     */
    public static function isInteger($str){
        if(preg_match('/^[1-9][0-9]*$/',$str)){
            return true;
        }
        return false;
    }

    /**
     * 判断是否为日期格式
     * @param $time
     * @param string $type
     * @param string $format
     * @return bool
     */
    public static function isDate($time,$type='date',$format='Y-m-d'){
        if(!$time) return false;
        $timestamp=strtotime($time);
        if($timestamp===false || !is_numeric($timestamp)) return false;
        $year=date('Y',$timestamp);
        $month=date('m',$timestamp);
        $day=date('d',$timestamp);
        $hour=date('H',$timestamp);
        $minute=date('i',$timestamp);
        $second=date('s',$timestamp);
        if(!checkdate($month,$day,$year)) return false;
        if($type=='date'){
            return true;
        }else{
            if($hour<=0 || $hour>23 || $minute<0 || $minute>60 || $second<0 || $second>60){
                return false;
            }
            return true;
        }
    }

    /**
     * 判断字符长度
     * @param $str
     * @param $rule
     * @return bool
     */
    public static function checkLen($str,$rule){
        $length=\Illuminate\Support\Str::length($str);
        if(strpos($rule,',')) { // 长度区间
            list($min,$max)   =  explode(',',$rule);
            if($max=="*"){
                return $length >= $min ;
            }else{
                return $length >= $min && $length <= $max;
            }
        }else{// 指定长度
            return $length == $rule;
        }
    }
}
