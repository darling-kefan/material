<?php
require_once(dirname(__FILE__).'/DB_Base.class.php');
/**
 * PDO对SQLite数据库操作封装类，主要使用PDO对数据库进行操作。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class DB_PDO_SQLite extends DB_Base
{
	protected function _init()
	{
	    if(!$this->_link) {
	        try {
	            $this->_link = new PDO("sqlite:{$this->_database}");
	        } catch (PDOException $e) {
	            $this->_halt($e->getMessage());
	        }
		}
	}
}
?>