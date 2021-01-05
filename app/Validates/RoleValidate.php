<?php

namespace App\Validates;


use App\Services\RoleService;

class RoleValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:30',
            'rolekey' => 'required|min:3|max:30|alpha_dash',
            'listsort' => 'integer'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '角色名称',
            'roleky' => '角色标识',
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
            if ($this->data['rolekey']) {
                $service = new RoleService();
                $expect = $this->type == 'edit' ? [$this->data['id']] : [];
                $exist = $service->exist(['rolekey' => trim($this->data['rolekey'])], $expect);
                if ($exist) {
                    $this->error = '权限字符已存在';
                }
            }
        }
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}