<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Http\Controllers\Admin\System;

use App\Extends\Cache\ConfigCache;
use App\Extends\Helpers\Result;
use App\Extends\Services\System\ConfigService;
use App\Extends\Libs\AdminCommonAction;
use App\Extends\Validates\System\ConfigValidate;
use App\Models\System\Config;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ConfigController extends System
{
    use AdminCommonAction;

    protected string $model = Config::class;
    protected string $validate = ConfigValidate::class;

    /**
     * 网站配置
     * @return View|JsonResponse
     */
    public function site(): View|JsonResponse
    {
        if($this->request->isMethod('POST')){
            $params = $this->request->post();
            if(!$params) return Result::error('无更新数据');

            foreach ($params as $id => $value) {
                if($id){
                    $this->model::bUpdate(['id'=>$id,'value'=>$value]);
                }
            }
            ConfigCache::clear();
            return Result::success('保存成功');
        }
        $lists=(new ConfigService())->getListByGroup();
        return $this->render('',['lists'=>$lists]);
    }

    /**
     * 首页渲染
     * @return View
     */
    protected function indexRender(): View
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');
        return $this->render('', ['groupList' => $groupList, 'styleList' => $styleList]);
    }

    /**
     * 查询后对列表进行处理
     * @param array $list
     * @return array
     */
    protected function indexAfter(array $list): array
    {
        if ($list) {
            $service = new ConfigService();
            $styleList = $service->styleList();
            $groupList = $service->getConfig('sys_config_group');
            foreach ($list as $key => $value) {
                $value['style_name'] = $styleList[$value['style']] ?? $value['style'];
                $value['group_name'] = $groupList[$value['groups']] ?? $value['groups'];
                $list[$key] = $value;
            }
        }
        return $list;
    }

    /**
     * 添加渲染
     * @return View
     */
    protected function addRender(): View
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');
        return $this->render('', ['groupList' => $groupList, 'styleList' => $styleList]);
    }

    /**
     * 编辑渲染
     * @param array $info
     * @return View
     */
    protected function editRender(array $info): View
    {
        $service = new ConfigService();
        $styleList = $service->styleList();
        $groupList = $service->getConfig('sys_config_group');
        return $this->render('', ['info' => $info, 'groupList' => $groupList, 'styleList' => $styleList]);
    }

    /**
     * 删除前判断
     * @param array $data
     * @return bool|string
     */
    protected function deleteBefore(array $data): bool|string
    {
        if ($data['is_sys'] == 1) {
            return '系统配置，无法删除';
        }
        return true;
    }

    /**
     * 导出字段处理和过滤
     * @param array $list
     * @return array
     */
    protected function exportBefore(array $list): array
    {
        //对list数据进行处理

        //返回导出的字段及字段名
        $attributes = [
            'title'=>'配置标题',
            'type'=>'配置标识',
            'style_name'=>'配置类型',
            'value'=>'配置值',
            'extra'=>'配置项',
            'update_time'=>'更新时间',
        ];
        return ['list'=>$list,'attributes'=>$attributes];
    }
}
