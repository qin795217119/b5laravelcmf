<?php
namespace App\Models;

/**
 * 权限分组
 * Class Authgroup
 * @package App\Models
 */
class Authgroup extends BaseModel
{
    protected $table = 'b5net_auth_group';
    protected $attributes=[
        'name'=>'',
        'note'=>'',
        'permission'=>'',
        'status'=>0
    ];
    /**
     * 获取分组列表用于选择
     * @return array
     */
    public function getSelectList(){
        $result= $this->where('status',1)->select('id','name')->orderBy('id','asc')->get();

        return $result ? $result->toArray() : [];
    }
}
