<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Extends\Helpers;


use App\Extends\Cache\ConfigCache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class WechatHelper
{
    /**
     * 微信授权state
     * @var string
     */
    protected string $state = '';

    /**
     * 是否获取用户信息
     * @var bool
     */
    protected bool $user_info = true;

    /**
     * 微信公众号 appID
     * @var string
     */
    protected string $appid = '';

    /**
     * 微信公众号 appSecret
     * @var string
     */
    protected string $secret = '';

    /**
     * 微信用户表
     * @var string
     */
    protected string $user_table = 'b5net_wechat_users';

    /**
     * 微信全局access_token标
     * @var string
     */
    protected string $access_table = 'b5net_wechat_access';


    public function __construct(bool $user_info = true, string $state = 'b5net')
    {
        $this->user_info = $user_info;

        $this->state = $state;

        $this->appid = ConfigCache::get('wechat_appid', '');

        $this->secret = ConfigCache::get('wechat_appsecret', '');
    }

    /**
     * 获取用户openid调用方法
     * @param string $auth_url
     * @return Redirector|RedirectResponse|Application
     */
    public function getOpenId(string $auth_url = ''): Redirector|RedirectResponse|Application
    {
        $scope = 'snsapi_base';
        if ($this->user_info) {
            $scope = 'snsapi_userinfo';
        }
        $wechat_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=" . urlencode($auth_url) . "&response_type=code&scope=" . $scope . "&state=" . $this->state . "#wechat_redirect";
        return redirect($wechat_url);
    }

    /**
     * 微信授权获取用户信息
     * @return array
     */
    public function getUserInfo(): array
    {
        $input = Request::input();
        $code = $input['code'] ?? '';
        $state = $input['state'] ?? '';
        $mtype = $input['mtype'] ?? '';//可以用来区分不同的应用

        if (empty($code) || $state != $this->state) {
            return ResultArray::error('授权参数错误');
        }
        $accessTokenResult = $this->auth_getAccessToken($code);
        if (!$accessTokenResult['success']) {
            return $accessTokenResult;
        }
        if (!$this->user_info) {
            return ResultArray::success('获取OpenId成功', ['openid' => $accessTokenResult['data']['openid'], 'mtype' => $mtype]);
        }

        //查看数据库中是否有该openid的为微信信息  不存在插入
        $userInfo = DB::table($this->user_table)->where('openid', $accessTokenResult['data']['openid'])->where('appid', $this->appid)->where('type', $mtype)->first();
        if (!$userInfo) {
            $getResult = $this->auth_getUserinfo($accessTokenResult['data']['access_token'], $accessTokenResult['data']['openid']);
            if (!$getResult['success']) {
                return $getResult;
            }
            $userInfo = [
                'openid' => $accessTokenResult['data']['openid'],
                'appid' => $this->appid,
                'nickname' => $getResult['data']['nickname'],
                'sex' => $getResult['data']['sex'],
                'headimg' => $getResult['data']['headimgurl'],
                'province' => $getResult['data']['province'],
                'city' => $getResult['data']['city'],
                'country' => $getResult['data']['country'],
                'type' => $mtype,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ];
            $result = DB::table($this->user_table)->insertGetId($userInfo);
            if (!$result) {
                return ResultArray::error('保存信息失败');
            }
            $userInfo['id'] = $result;
        } else {
            $userInfo = Functions::stdToArray($userInfo);
        }
        return ResultArray::success('获取成功', ['openid' => $accessTokenResult['data']['openid'], 'userInfo' => $userInfo, 'mtype' => $mtype]);
    }

    /**
     * 获取JSSDK的签名信息
     * @param string $url
     * @return array
     */
    public function signPackage(string $url = ''): array
    {
        $jsapiTicketResult = $this->getJsApiTicket();
        if (!$jsapiTicketResult['success']) {
            return $jsapiTicketResult;
        }
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domain = $_SERVER['HTTP_HOST'];
        $url = $url ? $url : "$protocol$domain$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=" . $jsapiTicketResult['data']['ticket'] . "&noncestr=" . $nonceStr . "&timestamp=" . $timestamp . "&url=" . $url;
        $signature = sha1($string);
        $signPackage = array(
            "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return ResultArray::success('获取成功', $signPackage);
    }


    /**
     * 微信授权-获取用户信息的 access_token和openid
     * @param $code
     * @return array
     */
    private function auth_getAccessToken($code): array
    {
        if (empty($this->appid) || empty($this->secret)) {
            return ResultArray::error('微信公众号配置错误');
        }
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->secret . '&code=' . $code . '&grant_type=authorization_code';
        $res = Functions::b5curl_get($url);
        if (empty($res)) {
            return ResultArray::error('获取AccessToken失败：1');
        }
        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return ResultArray::error('获取AccessToken失败：2');
        }
        if (empty($res['access_token']) || empty($res['openid'])) {
            return ResultArray::error('获取AccessToken失败');
        }
        return ResultArray::success('获取AccessToken成功', $res);
    }

    /**
     * 微信授权-根据accesstoken和openid获取用户详细信息
     * @param $access_token
     * @param $openid
     * @return array
     */
    private function auth_getUserinfo($access_token, $openid): array
    {
        if (empty($access_token) || empty($openid)) {
            return ResultArray::error('获取用户信息参数错误');
        }
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $res = Functions::b5curl_get($url);
        if (empty($res)) {
            return ResultArray::error('获取用户信息失败：1');
        }

        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return ResultArray::error('获取用户信息失败：2');
        }
        if (isset($res['errcode']) || empty($res['openid'])) {
            return ResultArray::error('获取用户信息失败：2');
        }
        return ResultArray::success('获取用户信息成功', $res);
    }

    /**
     * 获取加密随机字符串
     * @param int $length
     * @return string
     */
    private function createNonceStr(int $length = 16): string
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 获取jsApi的ticket
     * @return array
     */
    private function getJsApiTicket(): array
    {
        if (empty($this->appid)) {
            return ResultArray::error('微信配置错误');
        }

        $info = DB::table($this->access_table)->where('appid', $this->appid)->first();
        $info = $info ? Functions::stdToArray($info) : [];
        $lastTime = time() - 7000;
        if (empty($info) || $info['jsapi_ticket_add'] < $lastTime || empty($info['jsapi_ticket'])) {
            $accessTokenResult = $this->global_getAccessToken($info ?: false);
            if (!$accessTokenResult['success']) {
                return $accessTokenResult;
            }

            //通过微信接口获取
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=" . $accessTokenResult['data']['access_token'];

            //返回值验证
            $res = Functions::b5curl_get($url);
            if (empty($res)) {
                return ResultArray::error('获取jsapi_ticket失败：1');
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return ResultArray::error('获取jsapi_ticket失败：2');
            }
            if (!isset($res['ticket']) || !$res['ticket']) {
                return ResultArray::error('获取jsapi_ticket失败: 3');
            }

            //保存信息
            $saveData = ['jsapi_ticket_add' => time(), 'jsapi_ticket' => $res['ticket']];
            $result = DB::table($this->access_table)->where('appid', $this->appid)->update($saveData);
            if (!$result) {
                return ResultArray::error('保存jsapi_ticket失败');
            }
            $ticket = $res['ticket'];
        } else {
            $ticket = $info['jsapi_ticket'];
        }
        return ResultArray::success('获取成功', ['ticket' => $ticket]);
    }

    /**
     * 获取全局access_token
     * @param null $info
     * @return array
     */
    private function global_getAccessToken($info = null):array
    {
        if (empty($this->appid) || empty($this->secret)) {
            return ResultArray::error('微信配置错误');
        }
        if (is_null($info)) {
            $info = DB::table($this->access_table)->where('appid', $this->appid)->first();
            $info = $info ? Functions::stdToArray($info) : [];
        }

        $lastTime = time() - 7000;
        if (empty($info) || empty($info['access_token']) || $info['access_token_add'] < $lastTime) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";

            //返回值验证
            $res = Functions::b5curl_get($url);
            if (empty($res)) {
                return ResultArray::error('获取AccessToken失败：1');
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return ResultArray::error('获取AccessToken失败：2');
            }
            if (!isset($res['access_token']) || !$res['access_token']) {
                return ResultArray::error('获取AccessToken失败：3');
            }

            //保存信息
            $saveData = ['access_token_add' => time(), 'access_token' => $res['access_token']];
            if ($info) {
                $result = DB::table($this->access_table)->where('id', $info['id'])->update($saveData);
            } else {
                $saveData['appid'] = $this->appid;
                $result = DB::table($this->access_table)->insert($saveData);
            }
            if (!$result) {
                return ResultArray::error('保存access_token失败');
            }
            $access_token = $res['access_token'];
        } else {
            $access_token = $info['access_token'];
        }
        return ResultArray::success('获取成功', ['access_token' => $access_token]);
    }
}
