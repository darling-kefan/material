<?php
/**
 * 该文件用于配置控制器名称以及模型类名称与文件名称的映射关系。
 * app一般在URL中是不区分大小写的，然而在文件系统中却必须以固定的大写或者小写的形式存在，
 * 这样在命名的时候不便于阅读，因此构造了此映射数组，以便可以通过不区分大小写的app或者模型名称
 * 都能够找到对应的包含文件。
 * 
 * 注意：
 * 1、如果在映射数组中不存在的app或者模型名称，默认该名称和文件名称一致;
 * 2、映射数组中键名必须为小写，键值必须有对应的文件存在;
 * 
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
$_AppMap = array(
    'role'       => 'Role',
    'default'    => 'Default',
    'login'      => 'Login',
    'user'       => 'User',
	'system'     => 'System',
	'blog'       => 'Blog',
	'exit'	     => 'Exit',
	'materialtable'  => 'MaterialTable',
	'materialtableclass' => 'MaterialTableClass',
	'statistics' => 'Statistics',
	'quota'      => 'Quota',
	'quotatype'  => 'QuotaType',
);
?>