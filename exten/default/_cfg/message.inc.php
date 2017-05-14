<?php
/*
 * 信息提示配置。
 * 注意键名区分大小写(但是确定好之后需要固定不能变动)。
 * @var array
 */
$_Messages = array(
    //通用提示信息
    'OK'                                 => '成功',
    'Failure'                            => '失败',
    'Uploading error'                    => '文件上传失败，请检查系统配置',
    'Parameters incompleted'             => '参数不完整',
    'Please login first'				 => '请先登陆后进行操作',
    'Permission denied'					 => '您没有访问当前功能的权限，请联系管理员获取详细信息',
    'Authcode incorrect'				 => '验证码不正确',
	//用户相关
	'Account already exist'              => '该名称已存在',
	'Account can register'               => '可以注册',
	'Register failed'                    => '添加注册用户失败失败',
	'Username format error'              => '用户名必须是英文字母或数字',
	'User name length error'             => '用户名必须长度在6-18字符以内',
	'Password incorrect'                 => '密码长度错误',
	'Passwords not equal'                => '两次密码不一致',
);
?>