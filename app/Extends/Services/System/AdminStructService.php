<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace App\Extends\Services\System;

use App\Extends\Helpers\Functions;
use App\Models\System\Struct;
use Illuminate\Support\Facades\DB;

class AdminStructService
{
    protected string $table = 'b5net_admin_struct';

    /**
     * 更新信息
     * @param $admin_id
     * @param $struct_id
     * @return bool
     */
    public function update($admin_id, $struct_id): bool
    {
        if (!$admin_id) return false;
        DB::table($this->table)->where('admin_id', $admin_id)->delete();
        if (!$struct_id) return true;
        DB::table($this->table)->insert(['admin_id' => $admin_id, 'struct_id' => $struct_id]);
        return true;
    }

    /**
     * 获取某个人员的组织部门
     * @param $admin_id
     * @param false $showStruct
     * @return mixed
     */
    public function getStructByAdminId($admin_id, $showStruct = false): mixed
    {
        if (!$admin_id) return false;
        $info = DB::table($this->table)->where('admin_id', $admin_id)->first();
        if (!$info) return false;
        $info = Functions::stdToArray($info);
        if (!$showStruct) return $info['struct_id'];
        $struct = Struct::bFind($info['struct_id']);
        return $struct ?: [];
    }

    /**
     * 获取某个组织下的用户
     * @param $struct_id
     * @return array
     */
    public function getAdminIdByStructId($struct_id): array
    {
        if (!$struct_id) return [];
        if(is_array($struct_id)){
            $list = DB::table($this->table)->whereIn('struct_id', $struct_id)->get();
        }else{
            $list = DB::table($this->table)->where('struct_id', $struct_id)->get();
        }
        $list = $list?Functions::stdToArray($list):[];
        return $list ? array_column($list, 'admin_id') : [];
    }

    /**
     * 删除某个角色的组织信息
     * @param $admin_id
     * @return bool
     */
    public function deleteByAdmin($admin_id): bool
    {
        if ($admin_id) {
            DB::table($this->table)->where('admin_id', $admin_id)->delete();
            return true;
        }
        return false;
    }

    /**
     * 删除某个组织的角色信息
     * @param $struct_id
     * @return bool
     */
    public function deleteByStruct($struct_id): bool
    {
        if ($struct_id) {
            DB::table($this->table)->where('struct_id', $struct_id)->delete();
            return true;
        }
        return false;
    }
}
