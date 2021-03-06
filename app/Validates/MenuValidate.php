<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


use App\Services\MenuService;

class MenuValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:30',
            'listsort' => 'integer'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '菜单名称',
            'listsort' => '显示顺序'
        ];
    }

    /**
     * 验证标识的唯一性
     * @return ValidateBase
     */
    protected function after_validate()
    {
        if (empty($this->error)) {
            if ($this->data['perms']) {
                $service = new MenuService();
                $expect = $this->type == 'edit' ? [$this->data['id']] : [];
                $exist = $service->exist(['perms' => trim($this->data['perms'])], $expect);
                if ($exist) {
                    $this->error = '权限标识已存在';
                }
            }
        }
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}
