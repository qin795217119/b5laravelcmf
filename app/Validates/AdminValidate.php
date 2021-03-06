<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Validates;


use App\Services\AdminService;

class AdminValidate extends ValidateBase
{
    public function rules()
    {
        return [
            'username' => 'required|min:3|max:30|alpha_dash',
            'password' => 'min:6|max:20'
        ];
    }

    public function attributes()
    {
        return [
            'username' => '登录名称',
            'password' => '登录密码'
        ];
    }

    /**
     * 验证前 若密码没填则去除，防止验证
     * @return ValidateBase
     */
    protected function before_validate()
    {
        if (empty($this->data['password'])) {
            unset($this->ruleList['password']);
        }
        $this->data['realname'] = $this->data['realname'] ?: $this->data['username'];
        return parent::before_validate(); // TODO: Change the autogenerated stub
    }

    /**
     * 验证用户名的唯一性；密码操作
     * @return ValidateBase
     */
    protected function after_validate()
    {
        if (empty($this->error)) {
            if ($this->data['username']) {
                $service = new AdminService();
                $expect = $this->type == 'edit' ? [$this->data['id']] : [];
                $exist = $service->exist(['username' => trim($this->data['username'])], $expect);
                if ($exist) {
                    $this->error = '登录名称已存在';
                }
            }
        }
        if (empty($this->error)) {
            if ($this->type == 'add') {
                $this->data['password'] = get_password($this->data['password'] ?: '123456');
            } elseif ($this->type == 'edit') {
                if ($this->data['password']) {
                    $this->data['password'] = get_password($this->data['password']);
                } else {
                    unset($this->data['password']);
                }
            }
        }
        return parent::after_validate(); // TODO: Change the autogenerated stub
    }
}
