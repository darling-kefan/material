<?php
/**
 * 数据库操作抽象封装类。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class DB
{
	/**
	 * 根据参数选用不同的数据库操作封装类。
	 *
	 * @param  string $hostname 主机地址
	 * @param  string $username 用户名称
	 * @param  string $password 用户密码
	 * @param  string $database 数据库名称
	 * @param  string $hostport 主机端口
	 * @param  string $charset  操作所使用的数据库编码
	 * @param  string $type
	 * @return obj
	 */
	public static function getDb($hostname, $username, $password, $database = null, $hostport = 3306, $charset = 'utf8', $type = 'mysqli')
	{
		$type = strtolower($type);
		switch ($type){
			case 'mysql':
				require_once(dirname(__FILE__).'/DB_PDO_MySQL.class.php');
				return new DB_PDO_MySQL($hostname, $username, $password, $database, $hostport, $charset);
				break;
				
			case 'pgsql':
				require_once(dirname(__FILE__).'/DB_PDO_PostgreSQL.class.php');
				return new DB_PDO_PostgreSQL($hostname, $username, $password, $database, $hostport, $charset);
				break;	
				
			case 'sqlite':
				require_once(dirname(__FILE__).'/DB_PDO_SQLite.class.php');
				return new DB_PDO_SQLite($hostname, $username, $password, $database, $hostport, $charset);
				break;	
				
			default:
				die('DB type is not surported!');
				break;
		}
	}
}


?>