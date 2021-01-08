<?php

namespace App\Services;


use App\Validates\ValidateBase;
use Illuminate\Database\Eloquent\Model;

/**
 * 服务类-基类
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    // 模型
    protected $model;
    // 验证类
    protected $validate = null;

    //获取模型
    public function getModel()
    {
        return $this->model;
    }

    //设置模型
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    //设置验证类
    public function setValidate(ValidateBase $validate)
    {
        $this->validate = $validate;
    }

    /**
     * 获取数据列表
     * @param bool $all
     * @return array
     */
    public function getList($all = false)
    {
        $map = [];
        $sort = [];
        $order_column = 'id';
        $order_sort = 'asc';
        $page = 1;
        $limit = PAGE_LIMIT;

        $param = request()->input();
        if ($param) {
            //表单的条件 where 的条件
            if (!empty($param['where']) && is_array($param['where'])) {
                foreach ($param['where'] as $paramField => $paramValue) {
                    $paramValue = trim($paramValue);
                    if ($paramValue !== '') {
                        $map[] = [$paramField, '=', $paramValue];
                    }
                }
            }
            //表单的条件 like 的条件
            if (!empty($param['like']) && is_array($param['like'])) {
                foreach ($param['like'] as $paramField => $paramValue) {
                    $paramValue = trim($paramValue);
                    if ($paramValue !== '') {
                        $map[] = [$paramField, 'like', "%{$paramValue}%"];
                    }
                }
            }
            //表单的条件 between 的条件
            if (!empty($param['between']) && is_array($param['between'])) {
                foreach ($param['between'] as $paramField => $paramValue) {
                    if (is_array($paramValue) && count($paramValue) > 1) {
                        $start=$paramValue['start'];
                        $end=$paramValue['end'];
                        if($start || $end){
                            if($start && $end){
                                $map[] = [$paramField, 'between', [$start, $end]];
                            }elseif ($start){
                                $map[] = [$paramField, '>', $start];
                            }elseif ($end){
                                $map[] = [$paramField, '<', $end];
                            }
                        }

                    }
                }
            }
            //排序条件
            if (!empty($param['orderByColumn'])) {
                $order_column = trim($param['orderByColumn']);
            }
            if (!empty($param['isAsc'])) {
                $order_sort = trim($param['isAsc']);
            }
            // 分页条件
            if (!empty($param['pageNum'])) $page = intval($param['pageNum']);
            if (!empty($param['pageSize'])) $limit = intval($param['pageSize']);
        }
        // 获取参数
        $argList = func_get_args();
        if (!empty($argList)) {
            // 查询条件合并
            $map_arg = (!empty($argList[1])) ? $argList[1] : [];
            if ($map_arg) {
                $map = array_merge($map, $map_arg);
            }
            // 排序
            $sort = (!empty($argList[2])) ? $argList[2] : [];
        }
        $sort || $sort = [[$order_column, $order_sort]];

        $list = [];
        if ($all) {
            $list = $this->getAll($map, [], [], '', $sort);
            $count = count($list);
        } else {
            //只获取主键的列表
            $offset = ($page - 1) * $limit;
            $result = $this->getAll($map, [$this->model->getprimaryKey()], [$offset, $limit], '', $sort);
            if ($result) {
                foreach ($result as $val) {
                    $info = $this->info($val[$this->model->getprimaryKey()], true);
                    $list[] = $info;
                }
            }
            $count = $this->model->where($map)->count();
        }
        return message('操作成功', true, $list, 0, '', ['total' => $count]);
    }

    /**
     * 获取数据列表
     * @param array $map
     * @param array $select
     * @param array $pageData
     * @param string $listKey
     * @param array $sort
     * @return array
     */
    public function getAll(array $map = [], array $select = [], array $pageData = [], string $listKey = '', array $sort = [['id', 'asc']]){
        $list = $this->model->getList($map, $select, $pageData, $listKey, $sort);
        return $list?:[];
    }
    /**
     * 获取单条信息
     * @param $id
     * @param bool $isArray
     * @return mixed
     */
    public function info($id, bool $isArray = true)
    {
        $info = $this->model->info($id);
        if ($info && $isArray) {
            $info = $info->toArray();
        }
        return $info;
    }

    /**
     * 判断唯一
     * @param array $map
     * @param array $except
     * @param string $excetField
     * @return bool
     */
    public function exist(array $map = [], array $except = [], string $excetField = '')
    {
        if (!$map) return false;
        $where = [];
        foreach ($map as $key => $val) {
            if (is_array($val)) {
                if (count($val) < 1) {
                    continue;
                } elseif (count($val) == 1) {
                    $where[] = [$key, 'in', $val[0]];
                } elseif (count($val) == 2) {
                    $where[] = [$val[0], '=', $val[1]];
                } else {
                    $where[] = $val;
                }
            } else {
                $where[] = [$key, '=', $val];
            }
        }
        $info = $this->info($where);
        $field = $excetField ?: $this->model->getprimaryKey();
        if ($info && !in_array($info[$field], $except)) {
            return true;
        }
        return false;
    }

    /**
     * 添加
     * @return array
     */
    public function add()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = request()->all();
        }
        if ($data) {
            if ($this->validate) {
                $validate = $this->validate->data($data)->type('add')->run();
                if ($validate->error) {
                    return message($validate->error, false);
                }
                $data = $validate->get();
            }
            $result = $this->model->add($data);
            if ($result) {
                $data[$this->model->getprimaryKey()] = $result;
                $this->after_add($data);
                return message('保存成功', true, [], null, 'closeopen_refresh');
            }
        }
        return message('操作失败', false);
    }

    /**
     * 添加成功后的操作
     * @param $data
     * @return bool
     */
    protected function after_add($data)
    {
        return true;
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = request()->all();
        }
        if ($data) {
            if ($this->validate) {
                $validate = $this->validate->data($data)->type('edit')->run();
                if ($validate->error) {
                    return message($validate->error, false);
                }
                $data = $validate->get();
            }
            $result = $this->model->edit($data);
            if ($result !== false) {
                $this->after_edit($data);
                return message('保存成功', true, [], null, 'closeopen_refresh');
            }
        }
        return message('操作失败', false);
    }

    /**
     * 编辑成功后
     * @param $data
     * @return bool
     */
    protected function after_edit($data)
    {
        return true;
    }

    /**
     * 删除
     * @return array
     */
    public function drop()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = request()->all();
        }
        if (!$data) return message('未获取到数据', false);

        if (empty($data['ids'])) {
            return message('未选择数据', false);
        }
        $field = $argList[1] ?? '';
        $result = $this->model->drop($data['ids'], $field);
        if ($result) {
            $this->after_drop($data);
            return message('删除成功', true, [], null, 'reload');
        }
        return message('删除失败', false);
    }

    /**
     * 删除成功后
     * @param $data
     * @return bool
     */
    protected function after_drop($data)
    {
        return true;
    }

    /**
     * 设置记录状态
     * @return mixed
     */
    public function setStatus()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = request()->all();
        }
        if (!$data) return message('为获取到数据', false);
        if (empty($data['id'])) {
            return message('未选择数据', false);
        }
        if (!isset($data['status'])) {
            return message('状态参数错误', false);
        }
        $update = [$this->model->getprimaryKey() => $data['id'], 'status' => $data['status']];
        $result = $this->model->edit($update);
        $title = $data['status'] ? '启用' : '停用';
        if ($result) {
            return message('', true, [], null, 'reload');
        }
        return message($title . '失败', false);
    }
}
