<?php
/**
 * MongoDB操作类
 */
class MongoDBClass
{
	private $_mongo = null;			//Mongo实例
	private $_db    = null;			//当前使用的数据库
	private $_col   = null;			//当前使用的集合
	
	public function __construct($hostname, $hostport, $database = null, $username = null, $password = null)
	{
		$uri = "mongodb://{$hostname}:{$hostport}";
	}
	
}
?>
