<?php
/**
 * 一些系统的常量配置。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
define('MATERIAL',   1); //用于判断包含标识
define('DEBUG', 0); //是否开启调试模式
define('ROOT_PATH', dirname(__FILE__).'/..'); //系统根目录文件系统绝对路径

//数据库设置(当前使用数据库: MySQL)，系统默认只使用一种数据库，如果需要操作多种，请在子系统中配置
define('APP_HOSTNAME',  '127.0.0.1'); //主机地址(使用IP防止DNS解析)
define('APP_HOSTPORT',  '3306');          //数据库端口
define('APP_DATABASE',  'app');       //数据库名称
define('APP_USERNAME',  'root');          //账号
define('APP_PASSWORD',  '123ebiomass');      //密码
define('APP_DBPREFIX',  '');          //表名前缀
define('APP_DBOPTYPE',  'mysql');         //数据库连接操作方式 mysql|pgsql|sqlite
define('APP_DBCHARSET', 'utf8');          //数据库编码

//数据库设置(当前使用数据库: MySQL)，系统默认只使用一种数据库，如果需要操作多种，请在子系统中配置
define('MATERIAL_HOSTNAME',  '127.0.0.1'); //主机地址(使用IP防止DNS解析)
define('MATERIAL_HOSTPORT',  '3306');          //数据库端口
define('MATERIAL_DATABASE',  'material');       //数据库名称
define('MATERIAL_USERNAME',  'root');          //账号
define('MATERIAL_PASSWORD',  '123ebiomass');      //密码
define('MATERIAL_DBPREFIX',  '');          //表名前缀
define('MATERIAL_DBOPTYPE',  'mysql');         //数据库连接操作方式 mysql|pgsql|sqlite
define('MATERIAL_DBCHARSET', 'utf8');          //数据库编码

//NoSQL数据库设置(当前使用数据库: MongoDB)，系统默认只使用一种数据库，如果需要操作多种，请在子系统中配置
define('MONGO_HOST',  '127.0.0.1'); //主机地址(使用IP防止DNS解析)
define('MONGO_PORT',  '27017');          //数据库端口
define('MONGO_DB',    'iot');       //数据库名称
define('MONGO_USER',  '');          //账号
define('MONGO_PASS',  '');      //密码

//COOKIE项，必须设置
define('COOKIE_PATH', 	'/');
define('COOKIE_DOMAIN', '.biigroup.com');
define('COOKIE_EXPIRE', 864000);

//缓存设置
//define('CACHE_EMPIRE', 	86400);          //服务器缓存对象时间(秒), -1表示关闭缓存，0表示不过期
define('CACHE_EXPIRE', 86400);
define('MEMCACHE_HOST', '127.0.0.1');
define('MEMCACHE_PORT', '11211');


define('PERPAGE',15);//分页
define('ALLOW_WIDTH',160); //logo允许上传的宽度
define('ALLOW_HEIGHT',47); //logo允许上传的宽度
define('ALLOW_SIZE',5000); //允许上传的文件最大值
define('LOGO_DIRECTORY',ROOT_PATH . '/upload/logo'); //logo 上传目录
define('LOGO_URL','http://' . $_SERVER['SERVER_NAME'] . '/material/upload/logo'); //图片url引用地址
?>
