<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates\Wall;

use App\Helpers\Util\ValidateApi;
use App\Validates\ValidateBase;

class WallUsersValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'truename' => 'required|min:2|max:20',
            'mobile' => 'required|digits:11',
        ];
    }

    public function attributes()
    {
        return [
            'truename' => '姓名',
            'mobile' => '手机号码'
        ];
    }

    public function after_validate()
    {
        if(!$this->error){
            if (!ValidateApi::is_mobile_phone($this->data['mobile'])){
                $this->error='手机号码格式不正确';
            }else{
                $this->data['openid']='back_'.md5(time().$this->data['truename'].$this->data['mobile'].mt_rand(1,99));
                $this->data['sex']=$this->data['sex']?:0;
                if(!isset($this->data['headimg']) || !$this->data['headimg']){
                    if(in_array($this->data['sex'],[0,1,2])){
                        $this->data['headimg']='/static/common/images/deheader_'.$this->data['sex'].'.jpg';
                    }else{
                        $this->data['headimg']='/static/common/images/deheader_0.jpg';
                    }
                }else{
                    if(is_array($this->data['headimg'])){
                        $this->data['headimg']=$this->data['headimg'][0];
                    }
                }
            }
        }
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}
