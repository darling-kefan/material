<?php
/**
 * 权限详细说明
 * 
 * 所有权限分组，此数组记录了控制器所有public函数，用于用户界面选择元素的展示，同时监测角色对控制器中的方式是否有权限调用
 * 
 * @var array
 * array(
 * 	 class_first=>array(	//顶部导航
 *     class_second = array(	//左端导航
 *       operateList	//可操作列表
 *     )
 *   )
 * )
 * 
 * sign:0,只显示在右侧1,只显示在上面2,上面和右侧均可显示
 * @todo 此权限详细说明最后将进行写入xml中，用于与前端页面交互
 */
$_AuthSpecify = array(
	array(
		'id'   => 'data',
		'name' => '数据',
		'title'=> '原料数据中心',
		'items' => array(
			array(
				'id'   => 'tableManager',
				'name' => '表管理',
				'url'  => 'admin.php?app=materialTable&act=getTablesList',
				'app'  => 'materialTable',
				'relevantActs'  => array('getTablesList'),
				'opreates' => array(
					array(
						'name' => '查看',
						'url'  => 'admin.php?app=materialTable&act=viewTableRecords',
						'sign' => 0,
						'relevantActs' => array('viewTableRecords','needCurveData','needBargraphData','needPieData'),
						'type' => 'select'
					),
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=materialTable&act=viewAlterTable',
						'sign' => 0,
						'relevantActs' => array('viewAlterTable','alterTable','deleteTableField'),
						'type' => 'update'
					),
					array(
						'name' => '手工录入',
						'url'  => 'admin.php?app=materialTable&act=viewInsertRecords',
						'sign' => 0,
						'relevantActs' => array('viewInsertRecords','insertRecords'),
						'type' => 'insert'
					),
					/*
					array(
						'name' => '开启/关闭图形展示',
						'url'  => 'admin.php?app=materialTable&act=statisticSet',
						'sign' => 0,
						'relevantActs' => array('statisticSet','statisticSetSave','asyncSetChange','asyncSetChecked','needCurveData','needBargraphData','needPieData'),
						'type' => 'statistic'
					),
					*/
					array(
						'name' => 'Excel导入',
						'url'  => 'admin.php?app=materialTable&act=viewImportExcel',
						'sign' => 0,
						'relevantActs' => array('viewImportExcel','selectExcelData','importExcel','excelFileList','uploadExcel'),
						'type' => 'import'
					),
					array(
						'name' => 'Excel导出',
						'url'  => 'admin.php?app=materialTable&act=viewExportExcel',
						'sign' => 0,
						'relevantActs' => array('viewExportExcel','exportExcel'),
						'type' => 'export'
					),
					array(
						'name' => '备份',
						'url'  => 'admin.php?app=materialTable&act=backup',
						'sign' => 2,
						'relevantActs' => array('backup'),
						'type' => 'backup'
					),
					array(
						'name' => '还原',
						'url'  => 'admin.php?app=materialTable&act=viewRestore',
						'sign' => 0,
						'relevantActs' => array('viewRestore','restore','sqlFileList','uploadSQL'),
						'type' => 'restore'
					),
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=materialTable&act=deleteTable',
						'sign' => 2,
						'relevantActs' => array('deleteTable'),
						'type' => 'del'
					),
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=materialTable&act=viewCreateTable',
						'sign' => 1,
						'relevantActs' => array('createTable','viewCreateTable'),
						'type' => 'add'
					),
					array(
						'name' => '更新记录',
						'url'  => 'admin.php?app=materialTable&act=viewUpdateRecords',
						'sign' => 1,
						'relevantActs' => array('viewUpdateRecords','updateRecords'),
						'type' => 'updateRecord'
					),
					array(
						'name' => '删除记录',
						'url'  => 'admin.php?app=materialTable&act=deleteRecords',
						'sign' => 1,
						'relevantActs' => array('deleteRecords'),
						'type' => 'delRecord'
					)
				)
			),
			array(
				'id'   => 'tableTypeManager',
				'name' => '表分类',
				'url'  => 'admin.php?app=materialTableClass&act=getTableClassList',
				'app'  => 'materialTableClass',
				'relevantActs'  => array('getTableClassList'),
				'opreates' => array(
					array(
						'name' => '查看',
						'url'  => 'admin.php?app=materialTable&act=getTablesList',
						'sign' => 0,
						'relevantActs' => array('getTablesList'),
						'type' => 'select'
					),
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=materialTableClass&act=viewEditTableClass',
						'sign' => 0,
						'relevantActs' => array('viewEditTableClass','editTableClass'),
						'type' => 'update'
					),
					/*
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=materialTableClass&act=deleteTableClass',
						'sign' => 0,
						'relevantActs' => array('deleteTableClass'),
						'type' => 'del'
					),
					*/
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=materialTableClass&act=viewAddTableClass',
						'sign' => 1,
						'relevantActs' => array('viewAddTableClass','addTableClass'),
						'type' => 'add'
					)
				)
			),
			array(
				'id'   => 'quotaManager',
				'name' => '指标管理',
				'url'  => 'admin.php?app=quota&act=quotaManager',
				'app'  => 'quota',
				'relevantActs'  => array('quotaManager'),
				'opreates' => array(
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=quota&act=viewEditQuota',
						'sign' => 0,
						'relevantActs' => array('viewEditQuota','editQuota'),
						'type' => 'update'
					),
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=quota&act=deleteQuota',
						'sign' => 2,
						'relevantActs' => array('deleteQuota'),
						'type' => 'del'
					),
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=quota&act=viewAddQuota',
						'sign' => 1,
						'relevantActs' => array('viewAddQuota','addQuota','asyncGetTablesByQType'),
						'type' => 'add'
					)
				)
			),
			array(
				'id'   => 'quotaTypeManager',
				'name' => '指标分类',
				'url'  => 'admin.php?app=quotaType&act=quotaTypeManager',
				'app'  => 'quotaType',
				'relevantActs'  => array('quotaTypeManager'),
				'opreates' => array(
					array(
						'name' => '查看',
						'url'  => 'admin.php?app=quota&act=quotaManager',
						'sign' => 0,
						'relevantActs' => array('getQuotaList'),
						'type' => 'select'
					),
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=quotaType&act=viewEditQuotaType',
						'sign' => 0,
						'relevantActs' => array('viewEditQuotaType','editQuotaType'),
						'type' => 'update'
					),
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=quotaType&act=deleteQuotaType',
						'sign' => 0,
						'relevantActs' => array('deleteQuotaType'),
						'type' => 'del'
					),
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=quotaType&act=viewAddQuotaType',
						'sign' => 1,
						'relevantActs' => array('viewAddQuotaType','addQuotaType','asyncQuotaClass'),
						'type' => 'add'
					)
				)
			)
			
		)
	),
	array(
		'id'   => 'user',
		'name' => '用户',
		'title'=> '用户管理',
		'items' => array(
			array(
				'id'   => 'userManager',
				'name' => '用户管理',
				'url'  => 'admin.php?app=user&act=getUserList',
				'app'  => 'user',
				'relevantActs' => array('getUserList'),
				'opreates' => array(
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=user&act=viewAddUser',
						'sign' => 1,
						'relevantActs' => array('viewAddUser','addUser','isExistUsername'),
						'type' => 'add'
					),
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=user&act=viewEditUser',
						'sign' => 0,
						'relevantActs' => array('viewEditUser','editUser'),
						'type' => 'update'
					),
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=user&act=delUser',
						'sign' => 2,
						'relevantActs' => array('delUser'),
						'type' => 'del'
					)
				)
			),
			array(
				'id'   => 'roleManager',
				'name' => '角色管理',
				'url'  => 'admin.php?app=role&act=getRoleList',
				'app'  => 'role',
				'relevantActs' => array('getRoleList'),
				'opreates' => array(
					array(
						'name' => '编辑',
						'url'  => 'admin.php?app=role&act=viewEditRole',
						'sign' => 0,
						'relevantActs' => array('viewEditRole','editRole'),
						'type' => 'update'
					),
					array(
						'name' => '添加',
						'url'  => 'admin.php?app=role&act=viewAddRole',
						'sign' => 1,
						'relevantActs' => array('viewAddRole','addRole'),
						'type' => 'add'
					),
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=role&act=delRole',
						'sign' => 0,
						'relevantActs' => array('delRole'),
						'type' => 'del'
					)
				)
			)
		)
	),
	array(
		'id'   => 'log',
		'name' => '日志',
		'title'=> '日志管理',
		'items' => array(
			array(
				'id'   => 'loginLog',
				'name' => '登录日志',
				'url'  => 'admin.php?app=blog&act=getLoginLog',
				'app'  => 'blog',
				'relevantActs' => array('getLoginLog'),
				'opreates' => array(
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=blog&act=deleteLoginLog',
						'sign' => 2,
						'relevantActs' => array('deleteLoginLog'),
						'type' => 'del'
					)
				)
			),
			array(
				'id'   => 'operateLog',
				'name' => '操作日志',
				'url'  => 'admin.php?app=blog&act=getOperateLog',
				'app'  => 'blog',
				'relevantActs' => array('getOperateLog'),
				'opreates' => array(
					array(
						'name' => '删除',
						'url'  => 'admin.php?app=blog&act=deleteOperateLog',
						'sign' => 2,
						'relevantActs' => array('deleteOperateLog'),
						'type' => 'del'
					)
				)
			)
		)
	),
	array(
		'id'   => 'system',
		'name' => '系统',
		'title'=> '系统设置',
		'items' => array(
			array(
				'id'   => 'systemSet',
				'name' => '系统设置',
				'url'  => 'admin.php?app=system&act=viewSystemSet',
				'app'  => 'system',
				'relevantActs'  => array('viewSystemSet','systemSet','browse','upload'),
				'opreates' => array(		
				)
			)
		)
	),
);
?>