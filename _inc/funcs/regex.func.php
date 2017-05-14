<?php
/**
 * 常用正则封装验证
 * @param string $option 正则名称
 * @param string $val    验证参数
 * @return bool
 */
function regex($option, $val)
{
    $regexOption = array(
                'Email'     => '/^\w*[_\-\.\w]+@\w+\.([_-\w]+\.)*\w{2,4}$/',
                'Cellphone' => '/^\+?\d{11}$/',
                'DeviceMAC' => '/^([0-9a-fA-F]{2})(([\/\s:-][0-9a-fA-F]{2}){7})$/',
                'Chinese'   => '/[\x80-\xff]./',
                'Gateway'   => '/^([0-9a-fA-F]{2})(([\/\s:-][0-9a-fA-F]{2}){5})$/'
     );
    if(preg_match($regexOption[$option], $val)){
        return true;
    }else{
        return false;
    }
}

?>