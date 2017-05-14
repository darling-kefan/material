<?php
/**
 * 全局包含文件，负责一下工作:
 * 1、基础配置文件的包含;
 * 2、全局定义函数的包含;
 * 3、相关全局变量的定义和初始化;
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */

//开发中的调试模式判断，当为调试模式时，任何的错误信息都将会显示
if(defined('DEBUG')){
   // ini_set('display_errors', 'on');
   // error_reporting(E_ALL);
}

//包含默认系统框架配置文件
include(dirname(__FILE__).'/../_cfg/const.inc.php');	 //配置常量
include(dirname(__FILE__).'/../_cfg/config.inc.php');				 //配置变量
include(dirname(__FILE__).'/../_cfg/modMapping.inc.php');           //模型映射
include(dirname(__FILE__).'/../_inc/funcs/common.func.php');		 //公共函数库
include(dirname(__FILE__).'/../_inc/_core/Base.class.php');

/**
 * 设置默认的异常处理回调函数
 */
set_exception_handler('default_exception_handler');

Base::initStatic(array('USE_CS' =>defined('USE_CS'),
		       'USE_TPL' =>defined('USE_TPL'),
		       'USE_PIE' =>defined('USE_PIE'),
		       'USE_SES' =>defined('USE_SES'),
		       'USE_DB_APP' =>defined('USE_DB_APP'),
			   'USE_DB_MATERIAL' =>defined('USE_DB_APP'),
		       'USE_NOSQL' =>defined('USE_NOSQL')));

?>
