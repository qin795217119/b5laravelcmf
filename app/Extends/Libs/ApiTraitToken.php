<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Libs;

use App\Extends\Helpers\Functions;
use Illuminate\Support\Facades\DB;

/**
 * 设置token和查询token,自己也可以设置的规则例如jwt
 */
trait ApiTraitToken
{
    /**
     * 存储token的表名
     * 字段有 token,user_id,type(为了多平台)
     * @var string
     */
    protected string $token_table = 'b5net_app_token';


    /**
     * 查询token信息（解密）
     * @param string $token
     * @param string $type
     * @return bool|array
     */
    protected function getToken(string $token = '', string $type = ''): bool|array
    {
        if (!$token) return false;
        $token = trim($token);
        if (!ctype_alnum($token)) return false;
        if (strlen($token) != 32) return false;
        $record = DB::table($this->token_table)->where('token', $token)->first();
        if (!$record) return false;
        $record = Functions::stdToArray($record);
        if ($record['type'] !== $type) {
            return false;
        }
        if ($record['exp_time'] < time()) {
            return false;
        }
        return $record;
    }

    /**
     * 设置token（加密）
     * @param $id
     * @param string $type
     * @return string
     */
    protected function setToken($id, string $type = ''): string
    {
        if (!$id) return '';
        $record = DB::table($this->token_table)->where('user_id', $id)->where('type',$type)->first();

        $nowTime = time();
        $key = $id . $nowTime . $type . mt_rand(100, 999);
        $token = md5($key);
        $exp_time = $nowTime + 7 * 24 * 3600;
        $saveData = ['token' => $token, 'exp_time' => $exp_time];
        if ($record) {
            $record = Functions::stdToArray($record);
            $result = DB::table($this->token_table)->where('token',$record['token'])->update($saveData);
        } else {
            $saveData['type'] = $type;
            $saveData['user_id'] = $id;
            $result = DB::table($this->token_table)->insert($saveData);
        }
        return $result?$token:'';
    }
}
