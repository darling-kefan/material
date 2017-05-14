<?php
require_once(dirname(__FILE__).'/DB_Base.class.php');
/**
 * PDO对PostgreSQL数据库操作封装类，主要使用PDO对数据库进行操作。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class DB_PDO_PostgreSQL extends DB_Base
{
	/**
	 * 初始化数据库连接。
	 *
	 */
	protected function _init()
	{
	    if(!$this->_link) {
	        try {
	            $this->_link = new PDO("pgsql:host={$this->_hostname};port={$this->_hostport};dbname={$this->_database}", 
	                                    $this->_username, $this->_password);
	        } catch (PDOException $e) {
	            $this->_halt($e->getMessage());
	        }
		}
	}
}
?>