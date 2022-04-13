<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Helpers;

use Illuminate\Http\JsonResponse;

class Result
{
     /**
     * 成功的JSON
     * @param string $msg
     * @param array $data
     * @param array $extend
     * @return JsonResponse
     */
    public static function success(string $msg = '', array $data = [], array $extend = []): JsonResponse
    {
        return static::message($msg, true, $data, 0, $extend);
    }

    /**
     * 失败JSON
     * @param string $msg
     * @param int $code
     * @return JsonResponse
     */
    public static function error(string $msg = '', int $code = 500): JsonResponse
    {
        return static::message($msg, false, [], $code);
    }

    /**
     * 返回json响应信息
     * @param string $msg
     * @param bool $success
     * @param array $data
     * @param int $code
     * @param array $extend
     * @return JsonResponse
     */
    public static function message(string $msg, bool $success, array $data, int $code = -1, array $extend = []): JsonResponse
    {
        $rs = [
            'code' => $code < 0 ? ($success ? 0 : 500) : $code,
            'msg' => $msg ?: ($success ? '操作成功' : '操作失败'),
            'data' => $data,
            'success' => $success
        ];
        if ($extend) {
            foreach ($extend as $key => $value) {
                $rs[$key] = $value;
            }
        }
        return response()->json($rs);
    }
}
