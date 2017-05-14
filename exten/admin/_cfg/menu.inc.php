<?php
/**
 * 管理后台所有页面目录配置文件。
 * 该导航目录配置文件是针对有页面显示的接口，没有页面显示的接口不能写在该配置文件里！
 * 
 * 注意: 
 * 如果第三个元素是数组或者为空，那么表示子级菜单，
 * 如果是1，表示该导航菜单是一个隐藏菜单(不显示在页面，只有在特殊操作中才会出现，并且URL为空)
 */
$_Menu = array(
    //首页
    array('首页', 'default_index',
        array(
            array('修改基本信息', 'user_showEdit', 1),
            array('修改密码', 'user_showEditPwd', 1),
        )
    ),
    
    //用户管理
    array('用户管理', 'user_showEditList', 
        array(
            array('用户列表', 'user_showUserList',
                array(
                    array('新建用户', 'user_showAdd'),
                    array('修改用户信息', 'user_showEditUser', 1),
                    array('查看用户信息', 'user_showUserInfo', 1),                   
                )
            ),
            array('用户类型管理', 'userType_index',
                array(
                    array('新建用户类型', 'userType_showAdd'), 
                    array('修改用户类型信息', 'userType_showEdit', 1),
                    array('查看用户类型信息', 'userType_showInfo', 1)
                )
            ),
        ), 
    ),
    
    //设备管理
    array('设备管理', 'device_showDeviceList', 
        array(
            array('设备列表', 'device_showDeviceList',
                array(
                    array('新建设备', 'device_showAdd'),
                    array('修改设备', 'device_showEdit', 1),
                    array('查看设备', 'device_showView', 1), 
                )
            ),
            /*
            array('设备组列表', 'deviceGroup_showDevGroupList',
                array(
                   array('新建设备组', 'deviceGroup_showAdd'),
                )
            ),
            */
            array('设备类别管理', 'deviceCategory_showCateList',
                array(
                    array('新建设备类别', 'deviceCategory_showAdd'),
                    array('修改设备类别', 'deviceCategory_showEdit', 1),
                )
            ),
            array('设备类型管理', 'deviceType_showEditList',
                array(
                    array('新建设备类型', 'deviceType_showAdd'),
                    array('查看设备类型', 'deviceType_showInfo', 1),
                    array('修改设备类型', 'deviceType_showEdit', 1),                   
                )
            ),
            array('设备型号管理', 'deviceVersion_showVersionList',
                array(
                    array('新建设备型号', 'deviceVersion_showAdd'),
                    array('修改设备型号', 'deviceVersion_showEdit', 1),
                    array('查看设备型号', 'deviceVersion_showView', 1),
                )
            ),
            array('厂商管理', 'deviceFactory_showFactoryList',
                array(
                    array('增加厂商', 'deviceFactory_addFactoryShow'),
                    array('修改厂商', 'deviceFactory_showEdit', 1),
                    array('修改厂商', 'deviceFactory_showView', 1),
                )
            ),
            array('网关管理', 'gateway_showAdd',
                array(
                    array('录入网关', 'gateway_showAdd'),
                )
            ),
        ),
    ),
    
    //设备组管理
    array('设备组管理', 'deviceGroup_showDevGroupList', 
        array(
            array('设备组列表', 'deviceGroup_showDevGroupList',
                array(
                    array('新建设备组树', 'deviceGroup_showAdd'),
                    array('查看设备组树', 'deviceGroup_showTree', 1),
                    array('修改设备组树', 'deviceGroup_showEdit', 1),
                )
            ),
            array('测试设备组', 'deviceGroup_showRecent',
                array(
                    array('查看测试设备组', 'deviceGroup_showTestTree', 1),
                    array('查看测试设备组地图', 'deviceGroup_showTestTreeMap', 1),
                )
            ),  
        ),               
    ),
    
    //应用管理
    array('应用管理', 'appUser_showApperList', 
        array(
            array('应用管理者管理', 'appUser_showApperList',
                array(
                    array('新建应用管理者', 'appUser_showAddApper'),
                    array('授权应用管理者', 'appUser_showApperInfo', 1),
                    array('查看应用管理者权限树', 'user_showApperAuthDGTree', 1),
                    array('查看应用管理者信息', 'user_showApper', 1),
                    array('修改应用管理者信息', 'user_showEditApper', 1),
                )
            ),
           array('为应用管理者工作', 'appUser_showForApper',
          
           ),
           //超级管理员目录
           array('操作员管理', 'appUser_showOperListForAdmin',
                array(
                    array('新建操作员', 'appUser_showApperListForOpera'),                 
                    array('新建操作员', 'appUser_showAddActor', 1),
                    array('选择操作员', 'appUser_showOperList', 1),
                    array('授权操作员', 'appUser_showAuthForOper', 1),
                    array('查看操作员', 'user_showOperator', 1),
                    array('修改操作员', 'user_showEditOpera', 1),
                    array('查看操作员权限', 'user_showOperaAuthDGTree', 1),
                    array('新增操作员', 'appUser_showAddActorForAdmin', 1),
                    array('修改操作员权限', 'appUser_showAuthForOperMan', 1),
                )      
           ),
           //应用管理者目录
           array('操作员管理', 'appUser_showOperListForApper',
                array(
                    array('新建操作员', 'appUser_showAddActorForApper'),
                    array('新建操作员', 'appUser_showAddActor', 1),
                    array('选择操作员', 'appUser_showOperList', 1),
                    array('授权操作员', 'appUser_showAuthForOper', 1),
                    array('查看操作员', 'user_showOperator', 1),
                    array('修改操作员', 'user_showEditOpera', 1),
                    array('查看操作员权限', 'user_showOperaAuthDGTree', 1),
                    array('新增操作员', 'appUser_showAddActorForAdmin', 1),
                    array('修改操作员权限', 'appUser_showAuthForOperMan', 1),
                ), 1          
           ),
           //超级管理员目录
           array('角色管理', 'role_showRoleList',
                array(
                    array('新建角色', 'appUser_showListForAddRole'),                    
                    array('修改角色', 'role_showAdd', 1),
                    array('修改角色', 'role_showRoleEdit', 1),
                    array('查看角色', 'role_showRoleInfo', 1)
                )
            ),
            //应用管理者目录
            array('角色管理', 'role_showRoleListForApper',
                array(
                    array('新建角色', 'role_showAddForApper'),
                    array('修改角色', 'role_showAdd', 1),
                    array('修改角色', 'role_showRoleEdit', 1),
                    array('查看角色', 'role_showRoleInfo', 1)
                ), 1
            ),
        ), 
        
    ),
    //公告管理
    array('公告管理', 'notice_showNoticeList', 
        array(
            array('已发公告', 'notice_showNoticeList',
                array(
                    array('发布公告', 'notice_showAdd'),
                    array('修改公告', 'notice_showEdit', 1),
                    array('查看公告', 'notice_showNotice', 1),
                ),
            ),
        ),
    ),
    
    //系统配置
    array('系统配置', 'setting_show', 
        array(
            array('系统配置', 'setting_show')
        )
    )  
);
?>