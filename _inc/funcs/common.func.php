<?php
/**
 * 全局函数定义文件，该文件定义的函数在整个框架中有效。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 分页样式
 * @param int $count 记录总条数
 * @param int $pageSize 每页多少条
 * @param string $pageNumber 模板中传递页数的字段
 * return string
 */

function showPage($count,$pageSize,$pageName='pageNumber')
{
	$startDiv = '<div class="pagination">';
	$endDiv   = '</div>';
	$pageStr  = '';
	if (is_numeric($pageSize) == false) {
		return false;
	}

	$pageCount = ceil($count/$pageSize); //总页数
	$curPage   = intval($_GET[$pageName]); //当前页

	if (is_numeric($curPage) == false) {
		return false;
	}
	if ($curPage < 1 || !$curPage) {
		$curPage = 1;
	}

	if ($curPage > $pageCount) {
		$curPage = $pageCount;
	}

	if ($pageCount > 1) { //如果页数大于1的话显示分页
		$pageStr .= $startDiv;
		if ($curPage == 1) {
			$pageStr .= '<span class="firstPage"></span><span class="previousPage"></span>';
		} else {
			$pageStr .= '<a href="javascript: $.pageSkip(1);" class="firstPage">&nbsp;</a>';
			$pageStr .= '<a href="javascript: $.pageSkip(' . ($curPage - 1) . ');" class="previousPage">&nbsp;</a>';
		}

		$begin = $curPage - 2;
		$end   = $curPage + 2;
		if ($begin < 1) {
			$begin = 1;
		}

		if ($end > $pageCount) {
			$end = $pageCount;
		}
		
		if ($begin >= 3) {
			$pageStr .= '<span class="pageBreak">...</span>';
		}

		for ($i=$begin; $i<=$end; $i++) {
			if ($i == $curPage) {
				$pageStr .= '<span class="currentPage">' . $curPage . '</span>';
			} else {
				$pageStr .= '<a href="javascript: $.pageSkip(' . $i . ');">' . $i .'</a>';
			}
		}

		if ($end <= $pageCount-2) {
			$pageStr .= '<span class="pageBreak">...</span>';
		}

		if ($curPage == $pageCount) {
			$pageStr .= '<span class="nextPage"></span><span class="lastPage"></span>';
		} else {
			$pageStr .= '<a href="javascript: $.pageSkip(' . ($curPage + 1) . ');" class="nextPage">&nbsp;</a>';
			$pageStr .= '<a href="javascript: $.pageSkip(' . $pageCount . ');" class="lastPage">&nbsp;</a>';
		}

		$jumpStr  = '<span class="pageSkip">共' . $pageCount . '页 到第<input onpaste="return false;" maxlength="9" ';
		$jumpStr .= 'value="' . $curPage . '" name="pageNumber" id="pageNumber"/>页<button type="submit">&nbsp;</button></span>';
		$pageStr .= $jumpStr;
		$pageStr .= $endDiv;
	}
	return $pageStr;
}

/**
 * 默认异常处理回调函数。
 * @param Exception $e
 */
function default_exception_handler($e)
{
    $message = $e->getMessage();
    switch ($message){
        //直接退出执行
        case 'exit':
            exit();
            break;
            
        default:
            echo $message;
            exit();
            break;
    }
}

/**
 * 控制输出调试信息
 * @param string $string
 */
function debug($string)
{
    if(DEBUG == 1){
        echo $string;
    }
}

/**
 * 获得缓存服务器对象。
 * 
 * @return MemcacheServer
 * @deprecated
 */
function getCSInstance($host, $port, $empire)
{
    if(defined('USE_CS')){
        require_once(ROOT_PATH.'/_inc/_libs/CacheServer.class.php'); //缓存服务器定义文件
        return new MemcacheServer(array(
     	    'host'   => $host,
	    'port'   => $port,
	    'empire' => $empire
	));
    }
}

/**
 * 获得SESSION操作对象。
 * 
 * @return Session
 */
function getSessionInstance()
{
    require_once(ROOT_PATH.'/_inc/_libs/Session.class.php');
    return new Session();
}

/**
 * 获得模版引擎操作对象。
 * 
 * @deprecated
 * @return Template
 */
function getTemplateInstance()
{
    require_once(ROOT_PATH.'/_inc/class/Template.class.php');
    return new Template();
}

/**
 * 
 * 获得COOKIE操作对象。
 * 
 * @deprecated
 * @param  string $path
 * @param  string $domain
 * @param  int    $empire
 * @return Cookie
 */
function getCookieInstance($path, $domain, $empire)
{
    require_once(ROOT_PATH.'/_inc/_libs/Cookie.class.php');
    return new Cookie($domain, $domain, $empire);
}

/**
 * 根据参数选用不同的数据库操作封装类。
 * 根据不同的参数返回不同的对象，可以连接不同的数据库。
 * 
 * @deprecated
 * @param  string $hostname
 * @param  string $username
 * @param  string $password
 * @param  string $database
 * @param  string $hostport
 * @param  string $charset
 * @param  string $type
 * @return obj
 */
function getDBInstance($hostname, $username, $password, $database = null, $hostport = 3306, $charset = 'utf8', $type = 'mysqli')
{
    require_once(ROOT_PATH.'/_inc/_libs/DB/DB.class.php'); //数据库抽象类定义文件
    return DB::getDb($hostname, $username, $password, $database, $hostport, $charset, $type);
}

/**
 * 包含一个类库，在/_inc/_libs下面寻找，如果有目录结构，以“.”号分隔，
 * 如：Network.Ftp
 *
 * @param string $classNamePath
 * @param string $exten
 */
function importLib($classNamePath, $exten = null)
{
    $pos = strrpos($classNamePath, '.');
    $pos = $pos ? ($pos + 1) : 0;
    $className = substr($classNamePath, $pos);
    if(!class_exists($className)){
        $rootPath = $exten ? ROOT_PATH.'/exten/'.$exten : ROOT_PATH;
        $path     = $rootPath.'/_inc/_libs/'.str_ireplace('.', '/', $classNamePath).'.class.php';
        if(file_exists($path)){
            require_once($path);
        }else{
            echo "{$path} does not exist!";
            exit();
        }
    }
}

/**
 * 包含一个类库，在/_inc/class下面寻找，如果有目录结构，以“.”号分隔，
 * 如：Network.Ftp
 * 
 * @param string $classNamePath
 * @param string $exten
 */
function importClass($classNamePath, $exten = null)
{
    $pos = strrpos($classNamePath, '.');
    $pos = $pos ? ($pos + 1) : 0;
    $className = substr($classNamePath, $pos);
    if(!class_exists($classNamePath)){
        $rootPath = $exten ? ROOT_PATH.'/exten/'.$exten : ROOT_PATH;
        $path     = $rootPath.'/_inc/class/'.str_ireplace('.', '/', $classNamePath).'.class.php';
        if(file_exists($path)){
            require_once($path);
        }else{
            echo "{$path} does not exist!";
            exit();
        }
    }
}

/**
 * 包含一个函数库，在/_inc/func下面寻找，如果有目录结构，以“.”号分隔，
 * 如：Network.Ftp
 * 
 * @param string $funcNamePath 函数库名称(文件名，不包含.func.php)
 * @param string $exten        子系统名称，如果为空则默认在全局定义函数目录寻找
 */
function importFunc($funcNamePath, $exten = null)
{
    $pos = strrpos($funcNamePath, '.');
    $pos = $pos ? ($pos + 1) : 0;
    $funcName = substr($funcNamePath, $pos);
    $rootPath = $exten ? ROOT_PATH.'/exten/'.$exten : ROOT_PATH;
    $path     = $rootPath.'/_inc/funcs/'.str_ireplace('.', '/', $funcNamePath).'.func.php';
    if(file_exists($path)){
        require_once($path);
    }else{
        echo "{$path} does not exist!";
        exit();
    }
}

/**
 * 转义GET、POST、COOKIE传递的值，判断魔法引用进行处理。
 *
 * @param  string $str
 * @return string
 */
function strAddSlashes($str)
{
	return get_magic_quotes_gpc() ? $str : addslashes($str);
}

/**
 * 转义GET、POST、COOKIE传递的值，判断魔法引用进行处理。
 *
 * @param  array   $array
 * @param  boolean $strict 强制转义，不管有没魔法引用
 * @return array
 */
function arrayAddSlashes($array, $strict = false)
{
	if(!get_magic_quotes_gpc() || $strict){
		foreach ($array as $k => $v) {
		    if(is_array($v)){
		        $array[$k] = arrayAddSlashes($v);
		    }else{
		        $array[$k] = addslashes($v);
		    }
		}
	}
	return $array;
}

/**
 * 去除GET、POST、COOKIE的转义，判断魔法引用进行处理。
 *
 * @param  string $str
 * @return string
 */
function strStripSlashes($str)
{
	return get_magic_quotes_gpc() ? stripslashes($str) : $str;
}

/**
 * 去除GET、POST、COOKIE的转义，判断魔法引用进行处理。
 *
 * @param  array   $array
 * @param  boolean $strict 强制反转义，不管有没魔法引用
 * @return array
 */
function arrayStripSlashes($array, $strict = false)
{
	if(get_magic_quotes_gpc() || $strict){
		foreach ($array as $k => $v) {
			$array[$k] = stripslashes($v);
		}
	}
	return $array;
}


/**
 * 格式化当前日期并返回
 * 
 * @return string
 */
function getDateTime()
{
	$dateTime = date('Y-m-d H:i:s', time());
	return $dateTime;
}

/**
 * 判断数组内的某个值或字符串是否含有空值
 * @param mix $valStrOrArr
 * @return bool
 */
function isEmpty($valStrOrArr)
{
    if(is_array($valStrOrArr)){
        foreach($valStrOrArr as $v){
            if(empty($v)){
                return true;
            }
        }
    }else{
        if(empty($valStrOrArr)){
            return true;
        }
    }
    return false;
}


/*
 * 读取logo目录中的文件，并按相关字段进行排序
 * @param resource $dir logo文件目录
 * @param string $path 当前路径
 * @param string $imageurl 图片url
 * @param array $allow_type  检索的类型
 * @param string $orderby 按什么信息进行排序
 */
function dir_list($dir,$path,$imageurl,$allow_type,$orderby = 'name')
{
	$dir = $dir . $path;
	if ($dir[strlen($dir)-1] != '/') $dir .= '/';
	if (!is_dir($dir)) return array();

	$dir_handle  = opendir($dir);
	$dir_objects = array();
	while (false !== ($object = readdir($dir_handle)))
	{
		if (!in_array($object, array('.','..')))
		{
			$filename    = $dir . $object;
			$fileinfo    = pathinfo($object);
			$extension   = strtolower($fileinfo['extension']); //取得文件后缀名
			if (in_array($extension,$allow_type) || is_dir($filename)) 
			{	
				$file_object = array(
					'name'         => $object,
					'size'		   => filesize($filename),
					'isDirectory'  => is_dir($filename) ? true : false,
					'lastModified' => date("d F Y H:i:s", filemtime($filename)),
					'url'          => $imageurl . $path . $object
				);
				$dir_objects[] = $file_object;
				$orderArr[]    = $file_object[$orderby];
			}
		}
	}

	//对数组进行排序
	if ($orderArr) {
		array_multisort($orderArr,SORT_DESC,$dir_objects);
	}
	return $dir_objects;
}


/**
 * 生成随机浮点数
 * @min 最小值
 * @max 最大值
 * @return float
 */

function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}



/**
 * 获取变量数据类型
 * 
 * @param $var
 * @return string
 */
function myGetType($var)
{
	if (is_array($var)) return "array";
    if (is_bool($var)) return "boolean";
    if (is_float($var)) return "float";
    if (is_int($var)) return "integer";
    if (is_null($var)) return "NULL";
    if (is_numeric($var)) return "numeric";
    if (is_object($var)) return "object";
    if (is_resource($var)) return "resource";
    if (is_string($var)) return "string";
    return "unknown type";
}
?>
