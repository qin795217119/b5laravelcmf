<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Services;

use App\Cache\ConfigCache;
use App\Models\Config;
use App\Validates\ConfigValidate;


/**
 * 系统配置
 * Class ConfigService
 * @package App\Services
 */
class ConfigService extends BaseService
{

    public function __construct(bool $loadValidate = true)
    {
        $this->setModel(new Config());
        $loadValidate && $this->setValidate(new ConfigValidate());
    }

    /**
     * 配置类型
     * @param null $type
     * @return array|mixed|string
     */
    public function styleList($type = null)
    {
        $styleList = ['text' => '文本','textarea'=>'多行文本', 'array' => '数组', 'select' => '枚举'];
        if (!is_null($type)) {
            return $styleList[$type] ?? '';
        }
        return $styleList;
    }

    /**
     * 获取配置信息
     * @param string $key
     * @param bool $isVal
     * @return array|false|string[]|null
     */
    public function getConfig(string $key,bool $isVal=true)
    {
        if (empty($key)) return null;
        $info = $this->info([['type', '=', $key]], true);
        if (empty($info)) return null;
        $info=$this->formatConfig($info);
        if($isVal){
            return $info['value'];
        }else{
            return $info;
        }
    }

    /**
     * 对配置的数组和枚举进行处理
     * @param $info
     * @param bool $changeArr 是否对数组进行解析
     * @return array
     */
    public function formatConfig($info,$changeArr=true){
        if(empty($info)) return [];
        $value = $info['value'];
        if ($info['style'] == 'array' && $changeArr) {
            if ($value) {
                $value = strline_array($value, ':');
            }
            $value = $value ?: [];
        }
        $info['value']=$value;

        $extra=$info['extra'];
        if($info['style']=='select'){
            if ($extra) {
                $extra = strline_array($extra, ':');
            }
            $extra = $extra ?: [];
        }
        $info['extra']=$extra;
        return $info;
    }
    /**
     * 清除缓存
     * @return array
     */
    public function delcache(){
        ConfigCache::clear();
        return message('清理缓存完成', true);
    }

    /**
     * 获取分组的配置列表
     * @param string $key
     * @return array
     */
    public function getListByGroup($key=''){
        $reList=[];
        $groups=$this->getConfig('sys_config_group');
        if($key && isset($groups[$key])){
            $groups=[$key=>$groups[$key]];
        }
        if($groups){
            $groupsKey=array_keys($groups);
            if($groupsKey){
                $where=[];
                if(count($groupsKey)>1){
                    $where[]=['groups','in',$groupsKey];
                }else{
                    $where[]=['groups','=',$groupsKey[0]];
                }
                $lists=$this->getAll($where,[],[],'',[['listsort','asc'],['id','asc']]);
                if($lists){
                    foreach ($groups as $gkey=>$gtitle){
                        $reList[$gkey]=[
                            'title'=>$gtitle,
                            'chlist'=>[]
                        ];
                        foreach ($lists as $key=>$val){
                            if($val['groups']==$gkey){
                                $val=$this->formatConfig($val,false);
                                $reList[$gkey]['chlist'][$val['type']]=$val;
                                unset($lists[$key]);
                            }
                        }
                    }
                }
            }
        }
        return $reList;
    }


    /**
     * 保存网站设置
     * @return array
     */
    public function siteSave(){
        $input=request()->input();
        if(empty($input)) return message('无更新数据',false);
        foreach ($input as $id=>$value){
            $data=['id'=>$id,'value'=>$value];
            $this->model->edit($data);
        }
        ConfigCache::clear();
        return message('保存成功',true);
    }
}
