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
	'parameters or arguments error'      => '参数有误',
    'Please login first'				 => '请先登陆后进行操作',
    'Permission denied'					 => '您没有访问当前功能的权限，请联系管理员获取详细信息',

	//原料表分类相关
	'TableClass successfully added'      => '原料表分类添加成功',	
	'TableClass added failed'            => '原料表分类添加失败',
	'TableClass successfully edited'     => '原料表分类更新成功',
	'TableClass edited failed'           => '原料表分类更新失败',
	
	//原料表相关
	'materialTable successfully created' => '原料表创建成功',
	'materialTable created failed'       => '原料表创建失败',
	'materialTable successfully updated' => '原料表更新成功',
	'materialTable updated failed'       => '原料表更新失败',
	'insert records successfully'        => '记录录入成功',
	'insert records failed'              => '记录录入失败',
	'restore file is not exists'         => '还原原料表文件不存在',
	'restore successfully'               => '还原成功',
	'restore failed'                     => '还原失败',
	'update records successfully'        =>	'记录更新成功',
	'update records failed'              =>	'记录更新失败，请仔细检查自己填写的数据',
	'import successfully'                => 'Excel导入成功',
	'import failed'                      => 'Excel导入失败，请检查导入数据类型是否匹配',
	'import excel empty'                 => 'Excel文件为空，或无法解析Excel文件',
	'no data export to excel'            => '没有数据可供导出，请检查原料表',
	'table has unique fields'            => '字段重复，请重新填写',
	'please select import data'          => '请选择要导入的数据，重新导入！',
	'import data is not right'           => '导入数据类型不匹配',
	'table fields has id'                => '字段不能命名为id、Id、iD、ID', 
	'table name is same'                 => '此表名已存在，请重新命名',
	'field is empty'                     => '必填字段不能为空',
	'insert fieldData type is wrong'     => '插入数据类型不匹配',

	//用户相关
	'Account already exist'              => '该名称已存在',
	'Account can register'               => '可以注册',
	'Mailbox format is not correct'      => '邮箱格式不正确',
    'Mailbox cannot be empty'            => '邮箱不能为空',
	'Callphone format is not correct'    => '手机格式不正确',
	'Create account failure'             => '用户创建失败',
	'Username format error'              => '用户名必须是英文字母或数字',
	'User name length error'             => '用户名长度错误',
	'The length of the password is wrong'=> '密码长度错误',
    'TrueName is too long'               => '真实姓名过长',
    'Password successfully changed'      => '密码修改成功',
    'Modify password failure'            => '密码修改失败',
    'Two password input is inconsistent' => '密码两次输入不一致',
    'The original password input error'  => '原密码输入错误',
    'Modify user information success'    => '用户信息修改成功',

    //用户类型相关
    'User type name cannot be empty'         => '用户类型名称不能为空',
    'Auth List cannot be empty'              => '权限列表不能为空',
    'Incorrect auth list data structure'     => '权限列表参数不正确',
    'Incorrect shortcut list data structure' => '常用操作列表参数不正确',
    'User type name already exist'           => '用户类型名称已经存在',
    'Error adding user type'                 => '添加用户类型失败',
    'Error adding user type auth group'      => '添加用户类型权限失败',
    'Error dropping user type'               => '删除用户类型失败',
    'No such user types'                     => '无用户类型',

	//统计  图形展示
	'statistic parameter is empty' => '必选项目不能为空',
	'statistic set success'        => '设置成功',
	'statistic set failed'         => '设置失败',
	'statistic set first'          => '请先对该原料表设置X轴',

	//指标相关
	'QuotaClass successfully added' => '指标分类添加成功',
	'QuotaClass added failed'       => '指标分类添加失败',
	'QuotaClass successfully edited'=> '指标分类更新成功',
	'QuotaClass edited failed'      => '指标分类更新失败',
	'Quota successfully added'      => '指标添加成功',
	'Quota added failed'            => '指标添加失败',
	'Quota successfully edited'     => '指标更新成功',
	'Quota edited failed'           => '指标更新失败',
	'do not selected fields'        => '请选择原料数据表字段',
	'quotas not existed'            => '该指标分类下不存在指标',
);
?>