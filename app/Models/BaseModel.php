<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 人员管理-模型
 * Class BaseModel
 * @package App\Models
 */
class BaseModel extends Model
{
    // 设置数据表
    protected $table;
    //设置主键
    protected $primaryKey = 'id';
    //主键类型
    protected $keyType = 'int';
    //指示模型主键是否递增
    public $incrementing = true;
    //是否自动维护时间戳
    public $timestamps = true;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    //数据库连接名称
    //protected $connection = 'connection-name';

    /**
     * 获取主键ID
     * @return string
     */
    public function getprimaryKey(){
        return $this->primaryKey;
    }

    /**
     * 获取所有数据
     * @param array $map
     * @param array $select
     * @param array $pagedata
     * @param string $listkey
     * @param array $sort
     * @return array
     */
    public function getList(array $map=[],array $select=[],array $pagedata=[],string $listkey='',array $sort=[['id','asc']]){
        $list=[];
        $query=$this;
        if(!empty($map)){
            $query=$this->whereFormat($query,$map);
        }
        if(!empty($select)){
            $query=$query->select($select);
        }
        if(!empty($pagedata)){
            $query=$query->offset($pagedata[0])->limit($pagedata[1]);
        }
        if(!empty($sort)){
            $query=$query->when($sort, function ($query, $sort) {
                foreach ($sort as $v) {
                    $query->orderBy($v[0], $v[1]);
                }
            });
        }
        foreach($query->cursor() as $info){
            $info=$info->toArray();
            if($listkey){
                $list[$info[$listkey]]=$info;
            }else{
                $list[]=$info;
            }
        }
        return $list;
    }

    /**
     * 获取单条信息
     * @param $map
     * @return mixed
     */
    public function info($map)
    {
        if(!$map) return false;
        if(is_array($map)){
            $info=$this->where($map)->first();
        }else{
            $info=$this->where($this->primaryKey,$map)->first();
        }
        return $info;
    }

    /**
     * 更新数据
     * @param array $data
     * @return bool
     */
    public function edit(array $data){
        if(!$data) return false;
        $primaryVal=$data[$this->primaryKey]??0;
        if(!$primaryVal) return  false;
        if($this->attributes){
            foreach ($data as $key=>$val){
                if(is_null($val) && array_key_exists($key,$this->attributes)){
                    $data[$key]=$this->attributes[$key];
                }
            }
        }
        return $this->where($this->primaryKey,$primaryVal)->update($data);
    }

    /**
     * 添加数据
     * @param array $data
     * @return bool
     */
    public function add(array $data){
        if(!$data) return false;
        if(isset($data[$this->primaryKey]))  unset($data[$this->primaryKey]);
        if($this->attributes){
            foreach ($data as $key=>$val){
                if(is_null($val) && array_key_exists($key,$this->attributes)){
                    $data[$key]=$this->attributes[$key];
                }
            }
        }
        $data[self::CREATED_AT]=date('Y-m-d H:i:s',time());
        $data[self::UPDATED_AT]=date('Y-m-d H:i:s',time());
        return $this->insert($data);
    }
    /**
     * 删除
     * @param mixed $id
     * @param string $field
     * @return bool
     */
    public function drop($id,string $field=''){
        if(!$id) return false;
        if(is_array($id)){
            $idarr=$id;
        }else{
            $id=trim($id,',');
            $idarr=explode(',',$id);
        }
        $idarr=array_unique($idarr);
        if(!$idarr) return false;
        $field=$field?:$this->primaryKey;
        if(count($idarr)>1){
            $res=$this->whereIn($field,$idarr)->delete();
        }else{
            $id=$idarr[0];
            $res=$this->where($field,$id)->delete();
        }
        return $res;
    }

    /**
     * 处理数组where条件
     * @param $query
     * @param $map
     * @return mixed
     */
    protected function whereFormat($query,$map){
        if(!$map) return $query;
        foreach ($map as $where){
            if(!is_array($where) || count($where)<2){
                continue;
            }
            //or 或者 column操作
            if(count($where)==2){
                $operate=strtolower($where[0]);

                $whereArr=$where[1];
                switch ($operate){
                    case 'column':
                        $query=$query->whereColumn($where[1]);
                        break;
                    case 'or':
                        $query=$query->orWhere(function ($q) use ($whereArr){
                            $this->whereFormat($q,$whereArr);
                        });
                        break;
                }
            }elseif(count($where)==3){
                $type=strtolower($where[1]);
                switch ($type){
                    case 'in':
                        $query=$query->whereIn($where[0],$where[2]);
                        break;
                    case 'notin':
                        $query=$query->whereNotIn($where[0],$where[2]);
                        break;
                    case 'between':
                        $query=$query->whereBetween($where[0],$where[2]);
                        break;
                    case 'notbetween':
                        $query=$query->whereNotBetween($where[0],$where[2]);
                        break;
                    default:
                        $query=$query->where($where[0],$where[1],$where[2]);
                }
            }
        }
        return $query;
    }
}
