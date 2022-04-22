<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF [快捷通用基础开发管理平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace App\Http\Controllers\Admin\Tool;

use App\Extends\Helpers\Functions;
use App\Extends\Helpers\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenController extends Tool
{
    /**
     * 代码生成
     */
    public function create(){
        if($this->request->isMethod('POST')){
            $params = $this->request->post();
            $table = $params['table']??'';
            $class = $params['class']??'';
            $dir = $params['dir']??'';
            if(empty($table)) return Result::error('请选择表名');
            if(empty($class)) return Result::error('请输入类名称');

            $table_exists = DB::select("show tables like '".$table."'");
            if(!$table_exists) return Result::error('表'.$table.'不存在');

            return $this->genCode($table,$class,$dir);

        }else{
            $systemList = ['b5net_admin','b5net_admin_role','b5net_admin_struct','b5net_config','b5net_menu','b5net_role','b5net_role_menu','b5net_role_struct','b5net_struct'];
            $tables = Db::select("show tables");
            $tableList = [];
            foreach ($tables as $value){
                $table = current($value);
                if(!in_array($table,$systemList)){
                    $tableList[]=$table;
                }
            }
            return $this->render('',['tableList'=>$tableList]);
        }

    }
    private function genCode($table,$class,$dir){
        $model_name = Str::studly($class);//生成模型的名称大驼峰
        $dir = Str::studly($dir);
        $fields = $this->getFields($table);
        if(!$fields){
            return $this->toError('获取表结构失败');
        }
        if(true !== $res = $this->createModel($fields,$table,$model_name,$dir)){
            return $res;
        }

        if(true !== $res = $this->createController($model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createIndex($fields,$model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createAdd($fields,$model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createEdit($fields,$model_name,$dir)){
            return $res;
        }
        return Result::success('生成完成');
    }
    //生成模型
    private function createModel($fields,$table,$model_name,$dir){
        $root = base_path();//根地址
        $model_path_name = $model_name;
        if($dir) {
            $model_path_name = $dir . '/' . $model_name;
            $dir='\\'.$dir;
        }

        //模型路径并创建
        $model_path = str_replace('/',DIRECTORY_SEPARATOR,$root."/app/Models".$dir);
        if(true !== $res = $this->mkdir($model_path)){
            return $res;
        }

        $fieldArr = '';
        foreach ($fields as $value){
            $fieldArr.="'".$value['COLUMN_NAME']."',";
        }
        $fieldArr = trim($fieldArr,',');

        //模型的示例代码
        $temp_path =  str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/model.tpl');
        $gen_path =  str_replace('/',DIRECTORY_SEPARATOR,$root."/app/Models/".$model_path_name.".php");//生成的模型地址
        $tem_f = fopen($temp_path,"r");
        $temp_str = fread($tem_f,filesize($temp_path));
        $temp_str = str_replace(['{$model}','{$table}','{$dir}','{$fields}'],[$model_name,$table,$dir,$fieldArr],$temp_str);
        $gen_model=fopen($gen_path,'w');
        fwrite($gen_model,$temp_str);
        return true;
    }

    //生成控制器
    private function createController($model_name,$dir){
        $root = base_path();//根地址
        $controller_name = $model_name;//生成控制器名称

        $base = $dir;

        $model_use = $model_name;
        if($dir) {
            $model_use = $dir.'\\'.$model_name;
            $dir='\\'.$dir;
        }

        //路径并创建
        $model_path = str_replace('/',DIRECTORY_SEPARATOR,$root."/app/Http/Controllers/Admin".$dir);
        if(true !== $res = $this->mkdir($model_path)){
            return $res;
        }

        if($base){
            $base_path = str_replace('/',DIRECTORY_SEPARATOR,$model_path.'/'.$base.'.php');
            if(!file_exists($base_path)){
                $group = strtolower($base);
                $base_temp_path =  str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/base.tpl');
                $tem_f = fopen($base_temp_path,"r");
                $temp_str = fread($tem_f,filesize($base_temp_path));
                $temp_str = str_replace(['{$base}','{$dir}','{$group}'],[$base,$dir,$group],$temp_str);
                $gen_model=fopen($base_path,'w');
                fwrite($gen_model,$temp_str);
            }
        }

        //的示例代码
        $temp_path =  str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/controller.tpl');
        $gen_model_path =  str_replace('/',DIRECTORY_SEPARATOR,$root."/app/Http/Controllers/Admin".$dir."/".$controller_name."Controller.php");//生成的模型地址
        $tem_f = fopen($temp_path,"r");
        $temp_str = fread($tem_f,filesize($temp_path));

        $base = $base?:'Backend';
        $temp_str = str_replace(['{$dir}','{$model_use}','{$controller}','{$model}','{$base}'],[$dir,$model_use,$controller_name,$model_name,$base],$temp_str);
        $gen_model=fopen($gen_model_path,'w');
        fwrite($gen_model,$temp_str);
        return true;
    }

    //创建index.html
    private function createIndex($fields,$model_name,$dir){
        $root = base_path();//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = strtolower($dir);
            $dir = '/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin'.$dir.'/'.$path_name);
        if(true !== $res = $this->mkdir($path)){
            return $res;
        }
        //index.html的示例代码
        $temp_index_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/index.tpl');
        //生成的index.html地址
        $gen_index_path = $path.DIRECTORY_SEPARATOR.'index.blade.php';
        $tem_index_f = fopen($temp_index_path,"r");
        $temp_index_str = fread($tem_index_f,filesize($temp_index_path));
        $html='';
        $fieldArr = [];
        foreach ($fields as $value){
            $fieldArr[] = $value['COLUMN_NAME'];
            if($value['COLUMN_NAME'] =='id' || $value['COLUMN_NAME'] =='create_time' || $value['COLUMN_NAME'] =='update_time'){
                continue;
            }
            if($value['COLUMN_NAME'] =='status'){
                $html.="                    {
                        field: '".$value['COLUMN_NAME']."',
                        title: '".($value['COLUMN_COMMENT']?:$value['COLUMN_NAME'])."',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,true);
                        }
                    },\r\n";
                continue;
            }
            if($value['COLUMN_NAME'] =='title' || $value['COLUMN_NAME'] =='name' || $value['COLUMN_NAME'] =='remark' || $value['COLUMN_NAME'] =='note' || $value['COLUMN_NAME'] =='desc'){
                $html.="                    {
                        field: '".$value['COLUMN_NAME']."',
                        title: '".($value['COLUMN_COMMENT']?:$value['COLUMN_NAME'])."',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,25);
                        }
                    },\r\n";
                continue;
            }
            if($value['COLUMN_NAME'] =='link' || $value['COLUMN_NAME'] =='path' || $value['COLUMN_NAME'] =='url'){
                $html.="                    {
                        field: '".$value['COLUMN_NAME']."',
                        title: '".($value['COLUMN_COMMENT']?:$value['COLUMN_NAME'])."',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,25,'link');
                        }
                    },\r\n";
                continue;
            }
            $html.="                    {field: '".$value['COLUMN_NAME']."', title: '".($value['COLUMN_COMMENT']?:$value['COLUMN_NAME'])."', align: 'center'},\r\n";
        }
        if(in_array('create_time',$fieldArr) && in_array('update_time',$fieldArr)){
            $time = "                   {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},";
        }else{
            $time='';
        }
        $temp_index_str = str_replace(['___REPLACE___','__TIME__'],[$html,$time],$temp_index_str);
        $gen_index=fopen($gen_index_path,'w');
        fwrite($gen_index,$temp_index_str);
        return true;
    }

    //创建add.html
    private function createAdd($fields,$model_name,$dir){
        $root = base_path();//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = strtolower($dir);
            $dir = '/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin'.$dir.'/'.$path_name);
        if(true !== $res = $this->mkdir($path)){
            return $res;
        }
        //模板
        $temp_add_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/add.tpl');
        //生成地址
        $gen_add_path = $path.DIRECTORY_SEPARATOR.'add.blade.php';
        $tem_add_f = fopen($temp_add_path,"r");
        $temp_add_str = fread($tem_add_f,filesize($temp_add_path));
        $html='';
        foreach ($fields as $value){
            if($value['COLUMN_NAME'] =='id' || $value['COLUMN_NAME'] =='create_time' || $value['COLUMN_NAME'] =='update_time'){
                continue;
            }
            if($value['COLUMN_NAME'] =='status'){
                $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['COLUMN_COMMENT']?:$value['COLUMN_NAME']).'：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
            </label>
        </div>
    </div>'."\r\n";
                continue;
            }
            $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['COLUMN_COMMENT']?:$value['COLUMN_NAME']).'：</label>
        <div class="col-sm-8">
            <input type="text" name="'.$value['COLUMN_NAME'].'" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>'."\r\n";
        }
        $temp_add_str = str_replace('___REPLACE___',$html,$temp_add_str);
        $gen_add=fopen($gen_add_path,'w');
        fwrite($gen_add,$temp_add_str);
        return true;
    }

    private function createEdit($fields,$model_name,$dir){
        $root = base_path();//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = strtolower($dir);
            $dir = '/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin'.$dir.'/'.$path_name);
        if(true !== $res = $this->mkdir($path)){
            return $res;
        }
        $temp_edit_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/resources/views/admin/tool/gen/create/edit.tpl');
        $gen_edit_path = $path.DIRECTORY_SEPARATOR.'edit.blade.php';
        $tem_edit_f = fopen($temp_edit_path,"r");
        $temp_edit_str = fread($tem_edit_f,filesize($temp_edit_path));
        $html='';
        foreach ($fields as $value){
            if($value['COLUMN_NAME'] =='id' || $value['COLUMN_NAME'] =='create_time' || $value['COLUMN_NAME'] =='update_time'){
                continue;
            }
            if ($value['COLUMN_NAME'] =='status'){
                $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['COLUMN_COMMENT']?:$value['COLUMN_NAME']).'：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "0") checked @endif/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" @if($info["status"] == "1") checked @endif/> 显示
            </label>
        </div>
    </div>'."\r\n";
                continue;
            }
            $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['COLUMN_COMMENT']?:$value['COLUMN_NAME']).'：</label>
        <div class="col-sm-8">
            <input type="text" name="'.$value['COLUMN_NAME'].'" value="{{$info[\''.$value['COLUMN_NAME'].'\']}}" class="form-control" required autocomplete="off"/>
        </div>
    </div>'."\r\n";
        }
        $temp_edit_str = str_replace('___REPLACE___',$html,$temp_edit_str);
        $gen_edit=fopen($gen_edit_path,'w');
        fwrite($gen_edit,$temp_edit_str);
        return true;
    }
    //创建文件夹
    private function mkdir($path){
        if (!is_dir($path)) {
            if (false === @mkdir($path, 0777, true) && !is_dir($path)) {
                return $this->toError('创建文件夹失败:'.$path);
            }
        }
        return true;
    }
    //获取字段列表
    private function getFields($table){
        $result = DB::select("select COLUMN_NAME,COLUMN_COMMENT,DATA_TYPE,COLUMN_DEFAULT from INFORMATION_SCHEMA.Columns where table_name='".$table."' and table_schema='".env('DB_DATABASE')."'");
        if(!$result){
            return false;
        }
        return Functions::stdToArray($result);
    }
}
