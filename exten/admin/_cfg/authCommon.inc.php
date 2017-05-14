<?php
/**
 * 只要是用户都有的访问权限，不用分配。
 * 注意键名不区分大小写(但是确定好之后需要固定不能变动)。
 * @var array
 */
$_AuthCommon = array(
    'default' => array(
        'index', //主页面
    ),
    'user'    => array(
        'showEdit',       //显示修改用户信息
        'ayncEdit',       //异步修改用户信息
    	'showEditPwd',    //显示修改用户密码
        'asyncUpdatePwd', //异步修改用户密码
    ),
);
?>