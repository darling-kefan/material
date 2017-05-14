<?php
/**
 * 后台管理，入口文件
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
//当前子系统环境定义(不使用的基础部件则不包含，以优化配置)
define('USE_DB_APP',    1); //是否使用应用程序数据库
define('USE_DB_MATERIAL',    1); //是否使用原料中心数据库
define('USE_CS',    1); //是否使用缓存控制
define('USE_SES',   1); //是否使用SESSION
define('USE_PIE',   1); //是否使用COOKIE
define('USE_TPL',   1); //是否使用模板引擎
define('USE_NOSQL', 0); //是否NOSQL数据库

//包含基础配置文件并初始化流程控制类对象
$curPath = dirname(__FILE__);
include($curPath.'/_inc/common.inc.php');
include($curPath.'/_inc/_core/Core.class.php');
$core = new Core();
$exten = 'admin';
$core->defApp        = "default";
$core->appDir        = "exten/{$exten}/_app";
$core->cfgDir        = "exten/{$exten}/_cfg";
$core->incDir        = "exten/{$exten}/_inc";
$core->tplDir        = "exten/{$exten}/template";
$core->tplCompileDir = "cache/compile/{$exten}";
$core->run();

?>
