<?php 

/**
 * 发送异步请求，立即返回
 * @param string $url
 * @param string $data
 * @param int    $timeout 超时时间(毫秒)
 * @param int    $type 请求类型(0:post, 1:get)
 */
function asyncRequest($url, $data = null, $timeout = 10, $type = 0)
{
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if($type == 0){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, true);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
    curl_exec($ch);
    curl_close($ch);
}

?>