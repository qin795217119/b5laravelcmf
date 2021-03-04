<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


use App\Services\WebCatService;

class WebCatValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:50',
            'name' => 'required|min:2|max:50',
            'catkey' => 'required|min:1|max:20|alpha_dash',
            'website' => 'required',
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '菜单标题',
            'name' => '菜单名称',
            'catkey' =>'菜单标识',
            'website' => '所属站点',
            'type' => '菜单类型'
        ];
    }
    /**
     * 验证标识的唯一性
     * @return ValidateBase
     */
    protected function after_validate()
    {
        if (empty($this->error)) {
            if ($this->data['catkey']) {
                $service = new WebCatService();
                $expect = $this->type == 'edit' ? [$this->data['id']] : [];
                $exist = $service->exist(['catkey' => trim($this->data['catkey'])], $expect);
                if ($exist) {
                    $this->error = '菜单标识已存在';
                }
            }
        }
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}
