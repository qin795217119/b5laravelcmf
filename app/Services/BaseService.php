<?php
namespace App\Services;


use App\Validates\ValidateBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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
    protected $validate=null;

    public function getModel(){
        return $this->model;
    }
    public function setModel(Model $model){
        $this->model=$model;
    }
    public function setValidate(ValidateBase $validate){
        $this->validate=$validate;
    }
    /**
     * 获取数据列表
     * @return array
     */
    public function getList($all=false)
    {
        $map = [];
        $sort = [];
        $order_column = 'id';
        $order_sort = 'asc';
        $page = 1;
        $limit = PAGE_LIMIT;

        $param = request()->input();
        if ($param){
            //表单的条件 where 的条件
            if(!empty($param['where']) && is_array($param['where'])){
                foreach ($param['where'] as $wname=>$wvalue){
                    $wvalue=trim($wvalue);
                    if($wvalue!==''){
                        $map[] = [$wname, '=', $wvalue];
                    }
                }
            }
            //表单的条件 like 的条件
            if(!empty($param['like']) && is_array($param['like'])){
                foreach ($param['like'] as $wname=>$wvalue){
                    $wvalue=trim($wvalue);
                    if($wvalue!==''){
                        $map[] = [$wname, 'like', "%{$wvalue}%"];
                    }
                }
            }
            //表单的条件 between 的条件
            if(!empty($param['between']) && is_array($param['between'])){
                foreach ($param['between'] as $wname=>$wvalue){
                    if(is_array($wvalue) && count($wvalue)>1){
                        $map[] = [$wname, 'between', [$wvalue['start'],$wvalue['end']]];
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
            $map_arg = (isset($argList[1]) && !empty($argList[1])) ? $argList[1] : [];
            if($map_arg) {
                $map=array_merge($map,$map_arg);
            }
            // 排序
            $sort = (isset($argList[1]) && !empty($argList[1])) ? $argList[1] : [];
        }
        $sort || $sort=[[$order_column,$order_sort]];

        $list = [];
        if($all){
            $list=$this->model->getList($map,[],[],'',$sort);
            $count=count($list);
        }else{
            //只获取主键的列表
            $offset = ($page - 1) * $limit;
            $result=$this->model->getList($map,[$this->model->getprimaryKey()],[$offset,$limit],'',$sort);
            if ($result) {
                foreach ($result as $val) {
                    $info = $this->info($val[$this->model->getprimaryKey()],true);
                    $list[] = $info;
                }
            }
            $count = $this->model->where($map)->count();
        }
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
     * 判断唯一
     * @param array $map
     * @param array $except
     * @param string $excetField
     * @return bool
     */
    public function exist(array $map=[],array $except=[],string $excetField=''){
        if(!$map) return false;
        $where=[];
        foreach ($map as $key=>$val){
            if(is_array($val)){
                if(count($val)<1){
                    continue;
                }elseif (count($val)==1){
                    $where[]=[$key,'in',$val[0]];
                }elseif (count($val)==2){
                    $where[]=[$val[0],'=',$val[1]];
                }else{
                    $where[]=$val;
                }
            }else{
                $where[]=[$key,'=',$val];
            }
        }
        $info=$this->info($where);
        $field=$excetField?:$this->model->getprimaryKey();
        if($info && !in_array($info[$field],$except)){
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
        $data = isset($argList[0]) ? $argList[0] : [];
        if(!$data) {
            $data=request()->all();
        }
        if($data){
            if($this->validate){
                $validate=$this->validate->data($data)->type('add')->run();
                if($validate->error){
                    return message($validate->error,false);
                }
                $data=$validate->get();
            }
            $result = $this->model->add($data);
            if($result!==false){
                return message('保存成功', true,[],null,'closeopen_refresh');
            }
        }
        return message('操作失败',false);
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $argList = func_get_args();
        $data = isset($argList[0]) ? $argList[0] : [];
        if (!$data) {
            $data = request()->all();
        }
        if($data){
            if($this->validate){
                $validate=$this->validate->data($data)->type('edit')->run();
                if($validate->error){
                    return message($validate->error,false);
                }
                $data=$validate->get();
            }
            $result = $this->model->edit($data);
            if($result!==false){
                return message('保存成功', true,[],null,'closeopen_refresh');
            }
        }
        return message('操作失败',false);
    }
    public function after_drop($data){
        return true;
    }
    /**
     * 删除
     * @return array
     */
    public function drop(){
        $argList = func_get_args();
        $data = isset($argList[0]) ? $argList[0] : [];
        if (!$data) {
            $data = request()->all();
        }
        if(!$data) return message('未获取到数据',false);

        if (!isset($data['ids']) || !$data['ids']) {
            return message('未选择数据', false);
        }
        $field=isset($argList[1]) ? $argList[1] : '';
        $result = $this->model->drop($data['ids'],$field);
        if ($result) {
            $this->after_drop($data);
            return message('删除成功', true, [], null, 'reload');
        }
        return message('删除失败', false);
    }

    /**
     * 设置记录状态
     * @return mixed
     */
    public function setStatus()
    {
        $argList = func_get_args();
        $data = isset($argList[0]) ? $argList[0] : [];
        if (!$data) {
            $data = request()->all();
        }
        if(!$data) return message('为获取到数据',false);
        if (!isset($data['id']) || !$data['id']) {
            return message('未选择数据', false);
        }
        if (!isset($data['status'])) {
            return message('状态参数错误', false);
        }
        $update=[$this->model->getprimaryKey()=>$data['id'],'status'=>$data['status']];
        $result = $this->model->edit($update);
        $title=$data['status']?'启用':'停用';
        if ($result) {
            return message('', true,[],null,'reload');
        }
        return message($title.'失败',false);
    }
}
