<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;

/**
 * 验证基类
 * Class ValidateBase
 * @package App\Validates
 */
class ValidateBase
{
    //错误信息
    public $error = '';
    //验证的数据
    protected $data;
    //验证场景
    protected $type = '';
    //验证规则
    protected $ruleList = [];

    /**
     * 初始化将验证规则赋值到属性
     * ValidateBase constructor.
     */
    public function __construct()
    {
        $this->ruleList = $this->rules();
    }

    /**
     * 验证规则
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    /**
     * 错误消息
     * @return array
     */
    protected function message()
    {
        return [];
    }

    /**
     * 自定义熟悉名称
     * @return array
     */
    protected function attributes()
    {
        return [];
    }

    /**
     * 验证场景
     * @return array
     */
    protected function scen()
    {
        return [];
    }

    /**
     * 验证成功后的操作
     * @return $this
     */
    protected function after_validate()
    {
        return $this;
    }

    /**
     * 验证前的操作
     * @return $this
     */
    protected function before_validate()
    {
        return $this;
    }

    /**
     * 基于验证场景获取验证规则
     * @return array
     */
    protected function getRules()
    {
        $rules = $this->ruleList;
        if (!$rules) return [];
        if (!$this->type) return $rules;

        //若指定场景则对验证规则调整
        $sceneArr = $this->scen();
        if ($sceneArr && array_key_exists($this->type, $sceneArr)) {
            foreach ($rules as $field => $rule) {
                if (!in_array($field, $sceneArr[$this->type])) {
                    unset($rules[$field]);
                }
            }
        }

        //增加bail
        foreach ($rules as $field => $rule) {
            if (!$rules) continue;
            if (is_string($rule)) {
                if (strpos($rule, '|') !== false && strpos($rule, '|bail') === false && strpos($rule, 'bail|') === false) {
                    $rule = 'bail|' . $rule;
                }
            } elseif (is_array($rule)) {
                if (count($rule) > 1 && !in_array('bail', $rule)) {
                    array_unshift($rule, 'bail');
                }
            }
            $rules[$field] = $rule;
        }
        return $rules;
    }

    /**
     * 赋值验证数据
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * 获取数据
     * @return mixed
     */
    public function get()
    {
        return $this->data;
    }

    /**
     * 设置场景
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 执行验证并返回错误信息
     * @return string
     */
    public function run()
    {
        if (!$this->data) {
            $this->error = '没有提交数据';
            return $this;
        } else {
            $this->before_validate();

            $rules = $this->getRules();
            $error = '';
            if ($rules) {
                $validator = Validator::make($this->data, $rules, $this->message(), $this->attributes());
                if ($validator->fails()) {
                    $error = $validator->errors()->first();

                    $error = $error ?: '请确定提交信息的完整';
                }
            }
            $this->error = $error;

            return $this->after_validate();
        }
    }
}
