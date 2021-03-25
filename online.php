<?php
//创建WebSocket Server对象，监听0.0.0.0:9502端口
$ws = new Swoole\WebSocket\Server('0.0.0.0', 9502);

//监听WebSocket连接打开事件
$ws->on('Open', function ($ws, $request) {
    b5curl_get("http://b5laravelcmf.b5net.com/api/v1/onlineadd?fd={$request->fd}&ip={$request->server['remote_addr']}");
    echo "client-{$request->fd} ：{$request->server['remote_addr']}，连接成功\n";
    $ws->push($request->fd, "连接成功");
});

//监听WebSocket消息事件
$ws->on('Message', function ($ws, $frame) {

});

//监听WebSocket连接关闭事件
$ws->on('Close', function ($ws, $fd) {
    b5curl_get("http://b5laravelcmf.b5net.com/api/v1/onlinedel?fd={$fd}");
    echo "client-{$fd} is closed\n";
});

$ws->start();

function b5curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}
