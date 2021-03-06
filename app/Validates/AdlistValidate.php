<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


class AdlistValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:50',
            'redtype' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '信息标题',
            'redtype' => '跳转类型'
        ];
    }

    /**
     * 跳转类型处理
     * @return ValidateBase
     */
    protected function before_validate()
    {

        if($this->data['redtype']=='none'){
            $this->data['redfunc']='';
            $this->data['redinfo']='';
        }elseif ($this->data['redtype']=='url'){
            $this->data['redfunc']='';
        }elseif ($this->data['redtype']=='func'){
            $this->data['redinfo']='';
        }

        $this->data['imglist']=$this->data['imglist']??[];
        $this->data['imglist']=$this->data['imglist']?:'';
        if(is_array($this->data['imglist'])){
            $this->data['imglist']=implode(',',$this->data['imglist']);
        }
        return parent::before_validate(); // TODO: Change the autogenerated stub
    }
}
