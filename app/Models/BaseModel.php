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
        return $this->insert($data);
    }
    /**
     * 删除
     * @param mixed $id
     * @return bool
     */
    public function drop($id){
        if(!$id) return false;
        if(is_array($id)){
            $idarr=$id;
        }else{
            $id=trim($id,',');
            $idarr=explode(',',$id);
        }
        if(count($idarr)>1){
            $res=$this->whereIn($this->primaryKey,$idarr)->delete();
        }else{
            $id=$idarr[0];
            $res=$this->where($this->primaryKey,$id)->delete();
        }
        return $res;
    }

}
