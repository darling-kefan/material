<?php
/**
 * 全局变量数组定义。
 * 
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Config{
    public static $cfg;//基本的配置信息
    public static $modmap;//模型映射数组
}

Config::$cfg = array(

    //引擎类型
    'EngineType' => array(
        0 => 'InnoDB',
        1 => 'MyISAM' 
    ),
    
    //编码类型
    'EncodeType' => array(
        0 => 'utf8',
        1 => 'gbk',
        2 => 'gb2312'
    ),
    
    'typeOfField' => array(
    	'INT'      => '整数',
    	'DOUBLE'   => '浮点数',
    	'VARCHAR'  => '文本',
    	'DATETIME' => '日期'
    ),
    
    //字段类型
    'FieldType' => array(
        0 => 'INT',
        1 => 'FLOAT',
        2 => 'DOUBLE',
        3 => 'VARCHAR',
        4 => 'TEXT',
        5 => 'DATE',
        6 => 'DATETIME',
        7 => 'BOOL'
    ),
    
    //更新数据时，需要加单引号的数据类型 及 不需要加单引号的数据类型
    'addSingleQuote' => array(
    	0 => array(
    		0 => 'INT',
    		1 => 'FLOAT',
    		2 => 'DOUBLE',
    		3 => 'BOOL',
    	),
    	1 => array(
    		0 => 'VARCHAR',
    		1 => 'TEXT',
    		2 => 'DATE',
    		3 => 'DATETIME',
    	)
    ),
    
    //备份目录
    'backupPath' => ROOT_PATH.'/data/backup/',
    
    //导入文件存放目录
    'importPath' => ROOT_PATH.'/data/import/',
    
    //sql文件上传目录
    'uploadPath' => ROOT_PATH.'/data/upload/',
    
    //excel导入，临时文件存放地址
    'tmpExcelPath' => ROOT_PATH.'/cache/',
    
    //待下载的Excel存放目录
    'downloadExcelPath' => ROOT_PATH.'/data/download/',
    
    //分类样式
    'classType' => array(
    	1  => 1,
    	2  => 1,
    	3  => 1,
    	4  => 2,
    	5  => 2,
    	6  => 2,
    	7  => 2,
    	8  => 2,
    	9  => 2
    ),
    
    //省份
    'province' => array(
    	'北京',
    	'天津',
    	'上海',
    	'重庆',
    	'河北',
    	'河南',
    	'云南',
    	'辽宁',
    	'黑龙江',
    	'湖南',
    	'安徽',
    	'山东',
    	'新疆',
    	'江苏',
    	'浙江',
    	'江西',
    	'湖北',
    	'广西',
    	'甘肃',
    	'山西',
    	'内蒙古',
    	'陕西',
    	'吉林',
    	'福建',
    	'贵州',
    	'广东',
    	'青海',
    	'西藏',
    	'四川',
    	'宁夏',
    	'海南',
    	'台湾',
    	'香港',
    	'澳门'),
    //主要城市
    'cities' => array('北京','上海','天津','重庆','哈尔滨','长春','沈阳','呼和浩特','石家庄','乌鲁木齐','兰州','西宁','西安','银川','郑州','济南','太原','合肥','武汉','长沙','南京','成都','贵阳','昆明','南宁','拉萨','杭州','南昌','广州','福州','台北','海口','香港','澳门'),
);

//分页导航
global $pageArr,$searchType,$operateLog,$loginLog,$allow_type;
$pageArr  = array(10,20,50,100);

//搜索类型
$searchType = array(
	'user' => array(
		'uname'    => '用户名',
		'uemail'   => 'E-mail', 
		'truename' => '姓名'
	),
	'role' => array(
		'gname' => '角色名称'
	),
	'loginLog' => array(
		'bname'  => '用户名',
	),
	'operateLog' => array(
		'bname' => '用户名',
		'table_name' => '表名'
	)
);

//操作日志eventtype字段
$operateLog = array(
	'1'  => 'insert',
	'2'  => 'update',
	'3'  => 'delete',
	'4'  => '创建表',
	'5'  => '更新表',
	'6'  => '删除表',
	'7'  => '备份',
	'8'  => '还原',
	'9'  => '导入',
	'10' => '导出',
	'11' => '添加记录',
	'12' => '更新记录',
	'13' => '删除记录',
	'14' => '删除表字段',
);

$loginLog = array(
	'0' => '退出',
	'1' => '登陆'
);

//允许上传的logo类型
$allow_type = array('jpg', 'jpeg', 'bmp', 'gif', 'png');
?>
