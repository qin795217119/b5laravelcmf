<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
    /**
     * 获取主键ID
     * @return string
     */
    public function getprimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * 获取所有数据
     * @param array $map
     * @param array $select
     * @param array $pageData
     * @param string $listKey
     * @param array $sort
     * @return array
     */
    public function getList(array $map = [], array $select = [], array $pageData = [], string $listKey = '', array $sort = [['id', 'asc']])
    {
        $list = [];
        $query = $this;
        if (!empty($map)) {
            $query = $this->whereFormat($query, $map);
        }
        if (!empty($select)) {
            $query = $query->select($select);
        }
        if (!empty($pageData)) {
            $query = $query->offset($pageData[0])->limit($pageData[1]);
        }
        if (!empty($sort)) {
            $query = $query->when($sort, function ($query, $sort) {
                foreach ($sort as $v) {
                    $query->orderBy($v[0], $v[1]);
                }
            });
        }
        if ($listKey) {
            if(strpos($listKey,',')){
                $listKey=explode(',',$listKey,2);
            }
        }
        foreach ($query->cursor() as $info) {
            $info = $info->toArray();
            if ($listKey) {
                if(is_array($listKey)){
                    if($listKey[0]==$listKey[1]){
                        $list[] = $info[$listKey[0]];
                    }else{
                        $list[$info[$listKey[0]]] = $info[$listKey[1]];
                    }
                }else{
                    $list[$info[$listKey]] = $info;
                }
            } else {
                $list[] = $info;
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
        if (!$map) return false;
        if (is_array($map)) {
            $info = $this->whereFormat($this, $map);
            $info = $info->first();
        } else {
            $info = $this->where($this->primaryKey, $map)->first();
        }
        return $info;
    }

    /**
     * 更新数据
     * @param array $data
     * @return bool
     */
    public function edit(array $data)
    {
        if (empty($data)) return false;
        $primaryVal = $data[$this->primaryKey] ?? 0;
        if (empty($primaryVal)) return false;
        if ($this->attributes) {
            foreach ($data as $key => $val) {
                if (is_null($val) && array_key_exists($key, $this->attributes)) {
                    $data[$key] = $this->attributes[$key];
                }
            }
        }
        return $this->where($this->primaryKey, $primaryVal)->update($data);
    }

    /**
     * 添加数据
     * @param array $data
     * @return bool
     */
    public function add(array $data)
    {
        if (empty($data)) return false;
        if ($this->incrementing) unset($data[$this->primaryKey]);
        if ($this->attributes) {
            foreach ($data as $key => $val) {
                if (is_null($val) && array_key_exists($key, $this->attributes)) {
                    $data[$key] = $this->attributes[$key];
                }
            }
        }
        if ($this->timestamps) {
            $data[self::CREATED_AT] = date('Y-m-d H:i:s', time());
            $data[self::UPDATED_AT] = date('Y-m-d H:i:s', time());
        }
        if($this->incrementing){
            return $this->insertGetId($data);
        }else{
            return $this->insert($data);
        }

    }

    /**
     * 删除
     * @param mixed $id
     * @param string $field
     * @return bool
     */
    public function drop($id, string $field = '')
    {
        if (empty($id)) return false;
        if (is_array($id)) {
            $idArr = $id;
        } else {
            $id = trim($id, ',');
            $idArr = explode(',', $id);
        }
        $idArr = array_unique($idArr);
        if (empty($idArr)) return false;
        $field = $field ?: $this->primaryKey;
        if (count($idArr) > 1) {
            $res = $this->whereIn($field, $idArr)->delete();
        } else {
            $id = $idArr[0];
            $res = $this->where($field, $id)->delete();
        }
        return $res;
    }

    /**
     * 清空表
     */
    public function trash(){
        DB::table($this->table)->truncate();
        return true;
    }

    /**
     * 处理数组where条件
     * @param $query
     * @param $map
     * @return mixed
     */
    protected function whereFormat($query, $map)
    {
        if (empty($map)) return $query;
        foreach ($map as $where) {
            if (!is_array($where) || count($where) < 2) {
                continue;
            }
            //or 或者 column操作
            if (count($where) == 2) {
                $operate = strtolower($where[0]);

                $whereArr = $where[1];
                switch ($operate) {
                    case 'column':
                        $query = $query->whereColumn($whereArr);
                        break;
                    case 'or':
                        $query = $query->orWhere(function ($q) use ($whereArr) {
                            $this->whereFormat($q, $whereArr);
                        });
                        break;
                    case 'order':
                        $query = $query->when($whereArr, function ($q, $sort) {
                            foreach ($sort as $v) {
                                $q->orderBy($v[0], $v[1]);
                            }
                        });
                        break;
                }
            } elseif (count($where) == 3) {
                $type = strtolower($where[1]);
                switch ($type) {
                    case 'in':
                        $query = $query->whereIn($where[0], $where[2]);
                        break;
                    case 'notin':
                        $query = $query->whereNotIn($where[0], $where[2]);
                        break;
                    case 'between':
                        $query = $query->whereBetween($where[0], $where[2]);
                        break;
                    case 'notbetween':
                        $query = $query->whereNotBetween($where[0], $where[2]);
                        break;
                    case 'findinset':
                        $query = $query->whereRaw('FIND_IN_SET(?,'.$where[0].')',[$where[2]]);
                        break;
                    default:
                        $query = $query->where($where[0], $where[1], $where[2]);
                }
            }
        }
        return $query;
    }
}
