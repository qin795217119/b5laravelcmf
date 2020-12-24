<?php
namespace App\Services;


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
    protected $validate;


    public function getModel(){
        return $this->model;
    }
    public function setModel(Model $model){
        $this->model=$model;
    }
    /**
     * 获取数据列表
     * @return array
     */
    public function getList()
    {
        // 初始化变量
        $map = [];
        $sort = [['id', 'desc']];

        // 获取参数
        $argList = func_get_args();

        if (!empty($argList)) {
            // 查询条件
            $map = (isset($argList[0]) && !empty($argList[0])) ? $argList[0] : [];
            // 排序
            $sort = (isset($argList[1]) && !empty($argList[1])) ? $argList[1] : [['id', 'desc']];
        }

        // 常规查询条件
        $param = request()->input();
        if ($param) {
            // 筛选名称
            if (isset($param['name']) && $param['name']) {
                $map[] = ['name', 'like', "%{$param['name']}%"];
            }

            // 筛选标题
            if (isset($param['title']) && $param['title']) {
                $map[] = ['title', 'like', "%{$param['title']}%"];
            }

            // 筛选类型
            if (isset($param['type']) && $param['type']) {
                $map[] = ['type', '=', $param['type']];
            }

            // 筛选状态
            if (isset($param['status']) && $param['status']) {
                $map[] = ['status', '=', $param['status']];
            }

            // 手机号码
            if (isset($param['mobile']) && $param['mobile']) {
                $map[] = ['mobile', '=', $param['mobile']];
            }
        }
        // 排序(支持多重排序)
        $query = $this->model->where($map)->when($sort, function ($query, $sort) {
            foreach ($sort as $v) {
                $query->orderBy($v[0], $v[1]);
            }
        });
        // 分页条件
        $page=$param['page']?? 1;
        $perpage=$param['limit']?? PAGE_LIMIT;
        $offset = ($page - 1) * $perpage;
        $result = $query->offset($offset)->limit($perpage)->select('id')->get();
        $result = $result ? $result->toArray() : [];

        $list = [];
        if (is_array($result)) {
            foreach ($result as $val) {
                $info = $this->info($val['id'],true);
                $list[] = $info;
            }
        }

        //获取数据总数
        $count = $this->model->where($map)->count();

        //返回结果
        return message('操作成功',true,$list,0,'',['total'=>$count]);
    }

    /**
     * 获取单条信息
     * @param $id
     * @param bool $isArray
     * @return mixed
     */
    public function info($id,bool $isArray=true){
        $info=$this->model->info($id);
        if($info && $isArray){
            $info=$info->toArray();
        }
        return $info;
    }

    /**
     * 删除
     * @return array
     */
    public function drop(){
        // 获取参数
        $data = request()->all();
        if (!$data[$this->model->getprimaryKey()]) {
            return message('记录ID不能为空', false);
        }
        $result = $this->model->drop($data[$this->model->getprimaryKey()]);
        if ($result) {
            return message('删除成功', true,[],null,'reload');
        }
        return message('删除失败', false);
    }
    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        // 获取参数
        $argList = func_get_args();
        // 查询条件
        $data = isset($argList[0]) ? $argList[0] : [];

        if (!$data) {
            $data = request()->all();
        }

        $result = $this->model->edit($data);
        if($result!==false){
            return message('保存成功', true,[],null,'closeopen_refresh');
        }
        return message('操作失败',false);
    }

    /**
     * 添加
     * @return array
     */
    public function add()
    {
        // 获取参数
        $argList = func_get_args();
        // 查询条件
        $data = isset($argList[0]) ? $argList[0] : [];

        if (!$data) {
            $data = request()->all();
        }

        $result = $this->model->add($data);
        if($result!==false){
            return message('保存成功', true,[],null,'closeopen_refresh');
        }
        return message('操作失败',false);
    }
    /**
     * 设置记录状态
     * @return mixed
     */
    public function setStatus()
    {
        $data = request()->all();
        if (!$data[$this->model->getprimaryKey()]) {
            return message('记录ID不能为空', false);
        }
        if (!isset($data['status'])) {
            return message('记录状态不能为空', false);
        }
        $update=[$this->model->getprimaryKey()=>$data[$this->model->getprimaryKey()],'status'=>$data['status']];

        $result = $this->model->edit($update);
        $title=$data[$this->model->getprimaryKey()]?'启用':'禁用';
        if ($result) {
            return message($title.'成功', true,[],null,'reload');
        }
        return message($title.'失败',false);
    }
}
