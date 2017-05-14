<?php
/**
 * 所有权限分组，用于用户界面选择元素的展示，
 * 一个元素可能包含多个APP里面的多个ACT，和权限是一种关联关系。
 * 注意下面数组中最复杂的是处理这种关联关系，分配权限的时候需要把与该功能相关的所有权限都绑定在一起，一般来说和页面的展示有很大的关系。
 * 注意键名不区分大小写(但是确定好之后需要固定不能变动)。
 * @var array
 * @todo 这个权限分组的配置是最麻烦的一个事情，如果考虑到维护性，可单独做成一个页面和一张表来分配管理.
 */
$_AuthSpecify = array(
	'user' => array(
        'name'  => '用户管理',
        'items' => array(
            'usersManagement' => array(
                'name' => '用户列表',
                'acts' => array(
                    'user' => array(
                        'showUserList',  //用户列表展示
                        'showUserInfo',  //查看用户信息
                        'showEditUser',  //修改用户信息展示
                        'asyncGetList',  //获取用户类型列表
                        'asyncEditUser', //修改用户信息
                        'asyncDelUser',  //删除用户信息
                        //新建用户
                        'showAdd',         //新建用户页面
                        'asyncCheckName',  //检测用户名
                        'asyncUserEnsure', //新建用户信息返回及确认
                        'asyncAdd',        //添加用户
                    ),  
                    'userType' => array(
                        'asyncGetList',   //获得用户类型列表(新建用户时)
                    ),                 
                )
            ),
			'userTypeManagement' => array(
                'name' => '用户类型管理',
                'acts' => array(
                	'userType' => array(
                        'index',        //用户类型列表展示
                        'showInfo',     //展示用户类型
                        'showEdit',     //修改用户类型展示
                        'asyncEdit',    //修改用户类型
                        'asyncUserNum', //统计用户类型涉及用户数量
                        'asyncDrop',    //删除用户类型
                        //新建用户类型
                        'showAdd',        //新建用户类型展示
                        'asyncCheckName', //检测用户名
                        'asyncAdd',       //新建用户类型
                        'asyncGetList',   //获得用户类型列表
                    ),
                )
            ),        
        )
    ),
	'device' => array(
        'name'  => '设备管理',
        'items' => array(
            'deviceManagement' => array(
                'name' => '设备列表',
                'acts' => array(
                    'device' => array(
                        'showDeviceList', //展示设备列表
                        'asyncSearch',    //检测设备型号
                        'asyncCheckMAC',   //检测MAC
                        //设备列表
                        'showView',       //查看设备信息
                        'showEdit',       //展示设备信息
                        'asyncUpdate',    //更新设备
                        'asyncDrop',      //删除设备
                        //新建设备
                        'showAdd',        //新建设备展示                      
                        'asyncAdd',       //添加设备
                    ),
                    'deviceFoctort' => array(
                        'asyncGetFactoryList',  //获取厂商列表
                    ),
                )
            ),  
            'deviceCategoryManagement' => array(
                'name' => '设备类别管理',
                'acts' => array(
                    'deviceCategory' => array(
                        'showCateList',     //设备类别列表
                        'showEdit',         //修改设备类别展示
                        'asyncedit',        //修改设备类别
                        'asyncDrop',        //删除设备类别
                        //新建设备类别
                        'showAdd',          //新建设备类别展示
                        'asyncCheckName',   //检测设备类别名
                        'asyncAdd',         //添加设备类别  
                    )                   
                )
            ), 
            'deviceTypeManagement' => array(
                'name' => '设备类型管理',
                'acts' => array(
                    'deviceType' => array(
                        'showEditList',           //设备类型管理列表展示
                        'showInfo',               //设备类型信息展示
                        'showEdit',               //设备类型修改展示
                        'asyncCheckName',         //检测类型名称
                        'asyncUpdate',            //更新设备类型
                        'asyncGetDevVersionNum',  //查询设备类型下挂信息
                        'asyncdel',               //删除设备类型
                        //新建设备类型
                        'showAdd',                //新建设备类型展示
                        'asyncAdd',               //新建设备类型
                    ),  
                    'deviceCategory' => array(
                        'asyncGetCategoryList',     //获取设备类别列表
                    )           
                )
            ),
            'deviceVersionManagement' => array(
                'name' => '设备型号管理',
                'acts' => array(
                    'deviceVersion' => array(
                        'showAdd',          //展示添加设备型号页面
                        'showVersionList',  //设备型号列表展示
                        'showView',         //查看设备型号展示
                        'asyncUpdate',      //更新设备型号
                        'asyncDrop',        //删除设备型号
                        'showEdit',         //修改设备型号展示
                    ),
                    'deviceType' => array(
                        'asyncGetList',            //获取设备类型列表
                    ),
                    'deviceFactory' => array(
                        'asyncGetFactoryList',     //获取设备厂商列表
                    ),
                    'deviceCategory' => array(
                        'asyncGetCategoryList',     //获取设备类别列表
                    ) 
                                     
                )
            ),
            'deviceFactoryManagement' => array(
                'name' => '设备厂商管理',
                'acts' => array(
                    'deviceFactory' => array(
                        'showFactoryList',   //厂商列表展示
                        'showAdd',           //厂商添加展示
                        'showView',          //厂商查看展示
                        'showEdit',          //厂商修改展示
                        'asyncUpdate',       //更新厂商信息
                        'asyncDrop',         //删除厂商
                        'asyncCheckName',    //检测厂商名称
                        'asyncAdd'           //添加厂商
                    ),           
                )
            ),
            'gatewayManagement' => array(
                'name' => '网关管理',
                'acts' => array(
                    'gateway' => array(
                        'showAdd',           //新增网关展示
                        'asyncCheckGateway', //检测网关是否合法
                        'asyncAdd'           //添加网关
                    ),           
                )
            ),     
        )
    ),   
	'deviceGroup' => array(
        'name'  => '设备组管理',
        'items' => array(
			'deviceGroupManagement' => array(
                'name' => '设备组管理',
                'acts' => array(
                	'deviceGroup' => array(
    					'showAdd',                    //新建设备组展示
    					'showAddIframe',              //新建设备组展示
                        'showDevGroupList',           //设备组列表展示  
                        'showTree',                   //设备组信息展示
                        'asyncGetRecursionFullList',  //获取某个设备组下设备组和设备列表
                        'asyncCheckName',             //检测名称
                        'asyncUpdate',                //更新设备组
                        'asyncDelDevGrop',            //删除设备组
                        'asyncDelDevGroup',           //删除设备组
                    ),
                    'device' => array(
                        'asyncGetListByRange',       //根据范围获取设备
                    ),
                    'deviceFactory' => array(
                        'showFactoryList',   //厂商列表展示
                    ),
                ),
            ),
			'devGroupTestManagement' => array(
                'name' => '测试设备组',
                'acts' => array(
                	'deviceGroup' => array(
                        'showRecent',         //测试设备组展示
                        'showTestTree',       //查看测试设备组数据
                        'asyncGetCustomList', //根据用户筛选列表
                    ),
                )
            ),
			
        )
    ),  
    'appUser' => array(
        'name'  => '应用管理',
        'items' => array(
			'apperManagement' => array(
                'name' => '应用管理者管理',
                'acts' => array(
                	'appUser' => array(
                        'showApperList',    //应用管理者列表展示
                        'showApperInfo',    //查看应用管理者信息展示
                        'showAddApper',     //添加应用管理者展示
                        'asyncApperEnsure', //新建应用管理者确认
                        'asyncAddApper'     //添加应用管理者
                    ),
                    'user' => array( 
                        'showApper',               //应用管理者展示
                        'showApperAuthDGTree',     //应用管理者权限展示
                        'showEditApper',           //应用管理者修改展示
                        'asyncEditUser',           //新建应用管理者确认
                        'asyncgetRoleAndOperaNum', //获取用户下挂信息
                        'asyncDelUser',            //删除应用管理者
                        'asyncCheckName'           //检测名称
                    ),
                    'deveceGroup' => array(
                        'asyncGetDGTreeListByDGIDStr', //获取设备组树
                        'asyncAddOperatorActAuth',     //添加用户权限
                        'asyncGetDevGroupList',        //获取设备组列表
                        'asyncGetDevGroTreeList'       //获取设备组树列表
                    ),   
                )
            ),
            'workForApper' => array(
                'name' => '为应用管理者工作',
                'acts' => array(
                	'appUser' => array(
                        'showForApper',      //用户信息展示
                        'showAddActor',      //操作员信息展示
                        'asyncActorEnsure',  //新建操作员确认
                        'asyncAddActor',     //添加操作员
                        'showAuthForOper',   //展示用户权限
                        'showOperList',      //展示操作员列表
                    ),
                    'user' => array(
                        'asyncCheckName',     //检测名称
                    ),
                    'deveceGroup' => array(
                        'asyncGetDGTreeIDByRoleID',  //获取角色的权限
                        'asyncAddOperatorActAuth',   //保存权限
                        'asyncGetAuthDGTreeList',    //获取权限设备组树
                    ),  
                    'role' => array(
                        'asynccheckRoleName',    //检测角色名称
                        'asyncAddRole',          //保存角色
                        'showAdd'                //新建角色展示
                    ), 
                )
            ),
            'operatorManForAdmin' => array(
                'name' => '操作员管理(管理员)',
                'acts' => array(
                	'appUser' => array(
                        'showOperListForAdmin',  //操作员列表展示
                        'showAuthForOper',       //操作员权限展示
                        'showApperListForOpera', //应用管理者下的操作员展示
                        'asyncActorEnsure',      //新建操作员确认
                        'asyncAddActor',         //添加操作员
                        'showAddActorForAdmin',  //新建操作员展示     
                        'showAuthForOperMan'     //授权操作员                  
                    ),
                    'user' => array(
                        'showOperator',          //操作员信息展示
                        'showOperaAuthDGTree',   //展示操作员权限
                        'showEditOpera',         //修改操作员展示
                        'asyncEdit',             //保存修改操作员 
                        'asyncDelUser',          //删除操作员
                        'asyncCheckNmae',        //验证名称
                    ),
                    'deviceGroup' => array(
                        'asyncGetDGTreeListByDGIDStr', //获取设备组树
                        'asyncGetDGTreeIDByRoleID',  //获取角色的权限
                    	'asyncAddOperatorActAuth',   //保存权限
                    ),
                )
            ),
            'roleoperatorManForAdmin' => array(
                'name' => '角色管理(管理员)',
                'acts' => array(
                	'role' => array(
                        'showRoleList',              //角色列表展示
                        'showRoleInfo',              //角色信息展示 
                        'showRoleEdit',              //修改角色信息展示 
                        'asyncUpdateRole',           //更新角色信息
                        'asynDelRole',               //删除角色
                        'showAdd',                   //新建角色展示
                        'asynccheckRoleName',        //检测角色名称
                        'asyncGetDGTreeListByDGIDStr', //获取设备组树
                        'asyncaddRole',                //添加角色
                    ),
                    'deviceGroup' => array(
                        'asyncGetDGTreeIDByRoleID',  //获取角色的权限
                        'asyncGetAuthDGTreeList',     //获取设备组树
                    ),
                    'apperUser' => array(
                        'showListForAddRole',        //新建角色展示
                        'showAuthForOper',           //操作员权限展示
                    ), 
                )
            ),
            'operatorManForApper' => array(
                'name' => '操作员管理(应用管理者)',
                'acts' => array(
                	'appUser' => array(
                        'showOperListForApper',      //操作员先的角色列表展示
                        'showAuthForOper',           //展示操作员权限
                        'showAddActorForApper',      //添加操作员展示
                        'asyncActorEnsure',          //新建操作员确认
                        'asyncAddActor',             //添加操作员
                        'showAddActorForApper',      //新建操作员展示
                        'showAuthForOperMan',        //授权操作员  
                    ),
                    'user' => array(
                        'showOperator',             //操作员信息展示
                        'showOperaAuthDGTree',      //操作员权限展示
                        'showEditOpera',            //修改操作员展示 
                        'asyncEdit',                //保存修改操作员信息
                        'asyncDelUser',             //删除操作员
                      	'asyncCheckName',           //验证名称 
                    ),
                    'deviceGroup' => array(
                        'asyncGetDGTreeListByDGIDStr', //获取设备组树
                        'asyncGetDGTreeIDByRoleID',  //获取角色的权限
                    	'asyncAddOperatorActAuth',   //保存权限
                    ),
                )
            ),            
            'roleoperatorManForApper' => array(
                'name' => '角色管理(应用管理者)',
                'acts' => array(
                	'role' => array(
                        'showRoleListForApper',      //显示操作员角色列表
                        'showRoleInfo',              //显示角色信息
                        'showRoleEdit',              //修改角色信息                      
                        'asyncUpdateRole',           //更新角色信息
                        'asynDelRole',               //删除角色
                        'showRoleListForApper',      //展示角色列表
                        'showAddForApper',                    //新建角色展示
                        'asynccheckRoleName',                 //检测名称
                        'asyncGetDGTreeListByDGIDStr',        //获取设备树
                        'asyncaddRole',                       //添加角色
                    ),
                    'deviceGroup' => array(
                        'asyncGetDGTreeIDByRoleID',   //获取角色的权限 
                        'asyncGetAuthDGTreeList',     //获取设备组树
                    ),
                    'apperUser' => array(
                        'showListForAddRole',        //新建角色展示
                        'showAuthForOper',           //操作员权限展示
                    ),
                )
            ),   
        )
    ),   
    'notice' => array(
        'name'  => '公告管理',
        'items' => array(
			'updateNotice' => array(
                'name' => '新增公告',
                'acts' => array(
                	'notice' => array(
                		'showNoticeList',     //公告管理展示
                		'showAdd',            //新增公告
                        'showEdit',           //修改公告
                        'showNotice',         //查看公告
                        'asyncAddNotice',     //保存公告
                        'asyncUpdateNotice',  //更新公告
                        'asyncDelNotice',     //删除公告
                    ),
                )
            ),
        )
    ),
    'setting' => array(
        'name'  => '系统配置',
        'items' => array(
			'updateSetting' => array(
                'name' => '录入系统信息',
                'acts' => array(
                	'setting' => array(
                		'show',             //显示系统配置页面
                		'update',           //更新系统配置信息
                    ),
                )
            ),
        )
    ),
    
    
);
?>