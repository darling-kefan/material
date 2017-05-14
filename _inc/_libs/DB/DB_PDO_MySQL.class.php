<?php
require_once(dirname(__FILE__).'/DB_Base.class.php');

/**
 * PDO封装类，主要使用PDO对数据库进行操作。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class DB_PDO_MySQL extends DB_Base
{
    /**
     * 获得表可插入的字段列表
     *
     * @param  string  $table
     * @param  boolean $full  详细的列信息
     * @return list
     */
	public function getColumns($table, $full = false)
	{
	    //获得列详细信息
	    if($full){
	        return $this->getAll("SHOW FULL COLUMNS FROM `{$table}`");
	    }
	    
	    //只获得列字段
	    $columns = array();
	    $result  = $this->query("SHOW COLUMNS FROM `{$table}`");
	    while ($row = $this->fetchAssoc($result)) {
	    	if($row['Key'] == 'PRI'){
	    	    continue;
	    	}
	    	$columns[] = $row['Field'];
	    }
	    return $columns;
	}
	
	/**
	 * 根据表字段过滤数组。
	 *
	 * @param  string $table
	 * @param  array $data
	 * @return array
	 */
	public function filter($table, $data)
	{
	    $columns = $this->getColumns($table);
	    foreach ($data as $k => $v){
	        if(!in_array($k, $columns)){
	            unset($data[$k]);
	        }
	    }
	    return $data;
	}
	
	/**
	 * 修改操作UPDATE，内部调用filter进行数组过滤
	 *
	 * @param string $table 表名称
	 * @param array  $data 关联数组
	 * @param boolean  $replace 是否更新
	 */
	public function filtInsert($table, $data, $replace = false)
	{
		return $this->insert($table, $this->filter($table, $data), $replace);
	}
	
	/**
	 * 增加操作INSERT、REPLACE，内部调用filter进行数组过滤
	 *
	 * @param string $table 表名称
	 * @param array  $data 关联数组
	 * @param string $conditions SQL的操作条件
	 */
	public function filtUpdate($table, $data, $conditions)
	{
		return $this->update($table, $this->filter($table, $data), $conditions);
	}
	
	/**
	 * 初始化数据库连接。
	 *
	 */
	protected function _init()
	{
	    if(!$this->_link) {
	        try {
	            $this->_link = new PDO("mysql:host={$this->_hostname};port={$this->_hostport};dbname={$this->_database}", 
	                                    $this->_username, $this->_password);
	        } catch (PDOException $e) {
	            $this->_halt($e->getMessage());
	        }
			$this->exec("SET NAMES '{$this->_charset}'");
			//$this->query("SET time_zone='+8:00'");
		}
	}
}
?>