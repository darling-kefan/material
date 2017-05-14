<?php
/**
 * 该文件定义了可以进行XML操作的两个函数: xml2Array, array2Xml
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * XML转换为数组，需要simplexml扩展支持
 *
 * @param string $xmlStr
 * @return array
 */
function xml2Array($xmlStr)
{
    $xmlStr = _uncdata($xmlStr);
    $array = json_decode(json_encode(simplexml_load_string($xmlStr)), 1);
    foreach ($array as $k => $v){
        if(is_array($v)){
            if(empty($v)){
                $array[$k] = '';
            }else{
                $array[$k] = _xml2Array($v);
            }
        }else{
            $array[$k] = $v;
        }
    }
    return $array;
}
function _xml2Array($array)
{
    if(is_array($array) && empty($array)){
        $array = '';
    }else{
        foreach ($array as $k => $v){
            if(is_array($v)){
                if(empty($v)){
                    $array[$k] = '';
                }else{
                    $array[$k] = _xml2Array($v);
                }
            }
        }
    }
    
    return $array;
}

/**
 * 转换XML里面的<![CDATA[ ]]>标签为simplexml可以读取的形式
 *
 * @param string $xml
 * @return string
 */
function _uncdata($xml)
{
    // States:
    //
    //     'out'
    //     '<'
    //     '<!'
    //     '<!['
    //     '<![C'
    //     '<![CD'
    //     '<![CDAT'
    //     '<![CDATA'
    //     'in'
    //     ']'
    //     ']]'
    //
    // (Yes, the states a represented by strings.)
    //
    $state = 'out';
    $a = str_split($xml);
    $new_xml = '';
    foreach ($a AS $k => $v) {
        // Deal with "state".
        switch ( $state ) {
            case 'out':
                if ( '<' == $v ) {
                    $state = $v;
                } else {
                    $new_xml .= $v;
                }
                break;
            case '<':
                if ( '!' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<!':
                if ( '[' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![':
                if ( 'C' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![C':
                if ( 'D' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![CD':
                if ( 'A' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![CDA':
                if ( 'T' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![CDAT':
                if ( 'A' == $v  ) {
                    $state = $state . $v;
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case '<![CDATA':
                if ( '[' == $v  ) {


                    $cdata = '';
                    $state = 'in';
                } else {
                    $new_xml .= $state . $v;
                    $state = 'out';
                }
                break;
            case 'in':
                if ( ']' == $v ) {
                    $state = $v;
                } else {
                    $cdata .= $v;
                }
                break;
            case ']':
                if (  ']' == $v  ) {
                    $state = $state . $v;
                } else {
                    $cdata .= $state . $v;
                    $state = 'in';
                }
                break;
            case ']]':
                if (  '>' == $v  ) {
                    $new_xml .= str_replace('>','&gt;',
                    str_replace('>','&lt;',
                    str_replace('"','&quot;',
                    str_replace('&','&amp;',
                    $cdata))));
                    $state = 'out';
                } else {
                    $cdata .= $state . $v;
                    $state = 'in';
                }
                break;
        } // switch
    }
    return $new_xml;
}

/**
 * 数组转换为XML，不能以数字作为标签，如果数组含有数字键名，那么使用父标签作为标签名。
 * 当$strict为false时，和xml2Array为互反的函数。
 * @todo 只能生成XML，没有对特殊字符进行处理。
 *
 * @param  array   $array    数组
 * @param  boolean $strict   是否完全按照键名生成XML标签，否则只能判断标签不使用数字标签
 * @param  string  $encoding 编码
 * @param  boolean $noHead   是不不需要主动添加<?xml version="1.0" encoding="'.$encoding.'"?>标签
 * @return string  XML字符串
 */
function array2Xml($array, $strict = false, $encoding='utf-8', $noHead = false)
{
    $xmlStr  = $noHead ? "" : '<?xml version="1.0" encoding="'.$encoding.'"?>';
    $xmlStr .= $strict ? _array2XmlStrtict($array) : _array2Xml($array);
    return $xmlStr;
}
function _array2Xml($array, $ptag = null)
{
    $xmlStr = '';
    foreach($array as $key => $val) {
        $tag = is_numeric($key) ? $ptag : $key;
        if(is_array($val)){
            //获得第一项的关联数组
            list($fkey, $fval) = each($val);
            //判断是否为数字，如果为数字则使用父级键作为标签
            if(is_numeric($fkey)){
                $xmlStr .= _array2Xml($val, $tag);
            }else{
                $attribute = '';
                if(isset($val['@attribute'])){
                    foreach ($val['@attribute'] as $k => $v){
                        $attribute .= " {$k}=\"{$v}\"";
                    }
                    unset($val['@attribute']);
                }
                $xmlStr .= "<{$tag}{$attribute}>"._array2Xml($val, $tag)."</{$tag}>";
            }
        }else{
            $xmlStr .= "<{$tag}>{$val}</{$tag}>";
        }
    }
    return $xmlStr;
}
function _array2XmlStrtict($array) 
{
    $xmlStr = '';
    foreach($array as $key => $val) {
        $xmlStr .= "<{$key}>";
        $xmlStr .= is_array($val) ? _array2XmlStrtict($val) : $val;
        $xmlStr .= "</{$key}>";
    }
    return $xmlStr;
}
?>