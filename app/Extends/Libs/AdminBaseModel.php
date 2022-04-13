<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Libs;

use Illuminate\Support\Facades\DB;

/**
 * 默认只用查询构造器进行数据库操作，该基类只是对该系统常用的DB操作的一部分封装
 * 如果习惯orm，可以将该类改成orm形式（所有子model需继承model）
 */
trait AdminBaseModel
{

    /**
     * 初始化过的模型.
     * @var array
     */
    protected static array $instance = [];

    /**
     * 静态方法获取表名
     * @return string
     */
    public static function tableName(): string
    {
        return static::getInstance()->table;
    }

    /**
     * 静态方法获取是否需要自动写入时间戳
     * @return bool
     */
    public static function autoTimestamp(): bool
    {
        return (static::getInstance())->timestamps;
    }

    /**
     * 静态方法获取主键字段
     * @return string
     */
    public static function primaryKey(): string
    {
        return (static::getInstance())->primaryKey;
    }

    /**
     * 是否主键自增
     * @return bool
     */
    public static function incrementing(): bool
    {
        return (static::getInstance())->incrementing;
    }

    /**
     * 获取字段
     * @return array
     */
    public static function tableFields(): array
    {
        return (static::getInstance())->fillable??[];
    }

    /**
     * 单例模式获取当前对象
     * @return mixed
     */
    public static function getInstance(): object
    {
        if (!isset(static::$instance[static::class])) {
            static::$instance[static::class] = new static();
        }
        return static::$instance[static::class];
    }

    /**
     * 插入方法
     * @param array $data
     * @return int
     */
    public static function bInsert(array $data):int
    {
        if(!$data) return 0;

        //主键删除可能含有的主键
        if(static::incrementing()){
            $pk = static::primaryKey();
            if($pk && isset($data[$pk])){
                unset($data[$pk]);
            }
        }

        //判断是否开启自动插入时间
        if(static::autoTimestamp()){
            $data[self::CREATED_AT] = $data[self::UPDATED_AT] = (new \DateTime())->format('Y-m-d H:i:s');
        }
        $data = static::filterFields($data);
        if(static::incrementing()){
            $result = DB::table(static::tableName())->insertGetId($data);
        }else{
            $result = DB::table(static::tableName())->insert($data);
        }

        return $result?intval($result):0;
    }

    /**
     * 更新数据
     * @param array $data
     * @param array $where
     * @return false|int
     */
    public static function bUpdate(array $data,array $where = []): bool|int
    {
        if(!$data) return false;

        //判断是否含有主键或条件
        $pk = static::primaryKey();
        if($pk){
            if((!isset($data[$pk]) || !$data[$pk]) && !$where){
                return false;
            }
            if(isset($data[$pk])){
                $where[]= [$pk,'=',$data[$pk]];
                unset($data[$pk]);
            }
        }

        //判断是否开启自动插入时间
        if(static::autoTimestamp()){
            $data[self::UPDATED_AT] = (new \DateTime())->format('Y-m-d H:i:s');
        }
        $query = DB::table(static::tableName());
        if($where){
            $query = $query->where($where);
        }
        $data = static::filterFields($data);
        return $query->update($data);
    }

    /**
     * 删除操作
     * @param $id
     * @param string $field
     * @return false|int
     */
    public static function bDelete($id, string $field = ''): bool|int
    {
        if(!$id) return false;
        if(!$field){
            $pk = static::primaryKey();
            if(!$pk) return false;
            $field = $pk;
        }
        return DB::table(static::tableName())->where($field,$id)->delete();
    }


    /**
     * 获取一条数据
     * @param $id
     * @param array $where 数组格式为[['field','=','xxxx'],xxxx]
     * @return array
     */
    public static function bFind($id, array $where = []): array
    {
        $query = DB::table(static::tableName());
        if($id){
            $query = $query->where(static::primaryKey(),$id);
        }
        if($where){
            $query = $query->where($where);
        }
        $info = $query->first();
        return self::asArray($info);
    }

    /**
     * 获取多条数据
     * @param array $where 二维数组形式，复杂查询请使用db查询
     * @param array $order ['id'=>'asc',xxx]
     * @param null $field
     * @return array
     */
    public static function bSelect(array $where = [],array $order = [],$field = null):array{
        $query = DB::table(static::tableName());
        if($where){
            $query = $query->where($where);
        }
        if($field){
            $query = $query->select($field);
        }
        if($order){
            foreach ($order as $key=>$val){
                $query = $query->orderBy($key,$val);
            }
        }
        return self::asArray($query->get());
    }

    /**
     * 查询的结果转数组
     * @param $object
     * @return array
     */
    public static function asArray($object):array
    {
        if(is_object($object)){
            $object = json_decode(json_encode($object),true);
        }
        return $object?:[];
    }

    /**
     * 过滤字段
     * @param array $data
     * @return array
     */
    public static function filterFields(array $data): array
    {
        $fields = static::tableFields();
        if(!$fields) return $data;
        foreach ($data as $key=>$val){
            if(!is_string($key)){
                foreach ($val as $key1=>$val1){
                    if(!in_array($key1,$fields)){
                        unset($val[$key1]);
                    }
                }
                $data[$key] = $val;
            }else{
                if(!in_array($key,$fields)){
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }
}
