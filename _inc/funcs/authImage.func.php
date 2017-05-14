<?php
/**
 * 该文件定义了生成验证码图片函数
 */
if(!defined('MATERIAL')){
    exit('Include Permission Denied!');
}

    
/**
 * 获取图片验证码
 * @param int $isCookie
 */
function authImage($authCode)
{
    header ("Content-Type: image/jpeg");
    $im = imagecreate (48, 20);
    $background_color = imagecolorallocate ($im, 255, 255, 255);
    //设置干扰像素，防止被OCR
    for ($i = 0; $i <= 128; $i++){
        $point_color = imagecolorallocate ($im, rand(0,255), rand(0,255), rand(0,255));
        imagesetpixel($im, rand(2,128), rand(2,38), $point_color);
    }
    //逐个画上验证码字符
    for ($i=0; $i<=4; $i++){
        $text_color = imagecolorallocate ($im, rand(0,255), rand(0,128), rand(0,255));
        $x = 5 + $i * 10;
        $y = 4;
        imagechar ($im, 5, $x, $y, substr($authCode, $i, 1), $text_color);
    }
    //输出PNG图像
    imagejpeg($im);
    imagedestroy($im);
}
?>