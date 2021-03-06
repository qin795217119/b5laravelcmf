<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates\Wall;

use App\Validates\ValidateBase;

class WallPrizeValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'wall_id' => 'required',
            'title' => 'required|min:2|max:40',
            'name' => 'required|min:2|max:40',
            'number' => 'required|numeric',

        ];
    }

    public function attributes()
    {
        return [
            'wall_id' => '所属活动',
            'title' => '奖品等级',
            'name' => '奖品名称',
            'number' => '奖品数量'
        ];
    }

    /**
     * 跳转类型处理
     * @return ValidateBase
     */
    protected function before_validate()
    {

        $this->data['thumbimg']=$this->data['thumbimg']??[];
        if(is_array($this->data['thumbimg'])){
            $this->data['thumbimg']=$this->data['thumbimg'][0]??'';
        }
        return parent::before_validate(); // TODO: Change the autogenerated stub
    }
}
