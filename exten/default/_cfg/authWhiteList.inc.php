<?php
/**
 * 权限白名单列表(不用进行权限判断就能访问的页面列表)。
 * 注意键名不区分大小写(但是确定好之后需要固定不能变动)。
 * @var array
 */
$_AuthWhiteList = array(
    'login' => array(
        'index'         => '登陆页面',
		 'getAuthImage' => '获取验证码图片',
        'loginShow'     => '用户登录页面',
        'asyncLogin'    => '用户登陆操作'
    ),
	'registration' => array(
		'index'	   => '注册页面',
		'register' => '注册业务处理'
	),
    'exit'    => array(
        'index'        => '用户退出'
    ),
	'default' => array(
		'index' => '首页'
	)
);
?>