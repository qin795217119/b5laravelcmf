<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


use App\Services\MapplyService;

class MapplyValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:50',
            'money' => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '活动名称',
            'money' => '预约金额'
        ];
    }

    public function after_validate()
    {
        if ($this->data['money'] && $this->data['money']<0) $this->data['money']=0;
        $this->data['banner']=$this->data['banner']??'';
        if(is_array($this->data['banner'])){
            $this->data['banner']=implode(',',$this->data['banner']);
        }
        $this->data['share_img']=$this->data['share_img']??'';
        if(is_array($this->data['share_img'])){
            $this->data['share_img']=$this->data['share_img']?$this->data['share_img'][0]:'';
        }

        $formfieldlist=(new MapplyService())->extField();
        $regfielduparr=$this->data['regfieldup']??'';
        if(isset($this->data['regfieldup'])) unset($this->data['regfieldup']);
        $regfielddata=[];
        if($regfielduparr){
            foreach ($regfielduparr as $regfielname=>$regfieldinfo){
                if(isset($formfieldlist[$regfielname])){
                    $regfieldtitle=(isset($regfieldinfo['title']) && $regfieldinfo['title'])?trim($regfieldinfo['title']):$formfieldlist[$regfielname]['title'];
                    $isrequired=(isset($regfieldinfo['require']) && $regfieldinfo['require'])?1:0;
                    $regfielddata[$regfielname]=['title'=>$regfieldtitle,'require'=>$isrequired];
                }
            }
        }
        $this->data['regfield']=$regfielddata?json_encode($regfielddata):'';
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}
