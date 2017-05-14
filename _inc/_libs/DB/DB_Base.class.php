<?php
/**
 * 数据库抽象层基类，子类必须定义抽象方法，这些方法是常用的数据库操作。
 * 该基类已包含一些定义的公共继承方法。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
abstract class DB_Base
{
	protected $_sql;			   //当前执行的SQL语句
	protected $_link     = null;   //建立数据库连接后保存的连接
	protected $_halt     = true;   //当数据库错误发生时停止执行并显示错误
	protected $_error    = null;   //最新一次错误
	protected $_count    = 0;      //进行数据库查询的次数(每次查询时增加)
	protected $_result   = null;   //每次查询返回的PDOStatement对象
	protected $_charset  = 'utf8'; //操作所使用的数据库编码
	protected $_tablepre = '';     //数据库表前缀
	protected $_hostname; //主机地址
	protected $_hostport; //主机端口
	protected $_username; //用户名称
	protected $_password; //用户密码
	protected $_database; //数据库名称
	
	/**
	 * 初始化数据库连接。
	 * 使用不同的数据库管理系统，连接方式会有所不同，这里在初始化的时候进行处理。
	 * 
	 */
	abstract protected function _init();
	
	/**
	 * 
	 * 构造函数只保存所需变量
	 * @param string $hostname
	 * @param string $username
	 * @param string $password
	 * @param string $database
	 * @param int    $hostport
	 * @param string $charset
	 */
	public function __construct($hostname, $username, $password, $database = null, $hostport = 3306, $charset = 'utf8')
	{
		$this->_hostname = $hostname;
		$this->_username = $username;
		$this->_password = $password;
		$this->_database = $database;
		$this->_hostport = $hostport;
		$this->_charset  = $charset;
	}
	
	/**
	 * 设置是否错误发生时停止执行脚本并报错
	 *
	 * @param boolean $halt
	 */
	public function setHalt($halt)
	{
	    $this->_halt = $halt;
	}
	
	/**
	 * 获得最新一次的数据库操作错误
	 *
	 * @return string
	 */
	public function getError()
	{
	    return $this->_error;
	}
	
	/**
	 * 设置数据表名前缀。
	 *
	 * @param string $tablepre
	 */
	public function setTablepre($tablepre)
	{
		$this->_tablepre = $tablepre;
	}
	
	/**
	 * 返回本次连接已经执行的SQL数。
	 *
	 * @return int
	 */
	public function queryCount()
	{
		return $this->_count;
	}
	
	/**
	 * 开启事务
	 */
	public function beginTransaction()
	{
	    if(!$this->_link) {
			$this->_init();
		}
	    return $this->_link->beginTransaction();
	}
	
	/**
	 * 批量写入数据库，注意传入的数据都应该经过了addslashes处理
	 * @param  string $table
	 * @param  array  $list
	 * @param  int    $perCount
	 * @return bool
	 */
	public function batchInsert($table, $list, $perCount, $replace = false)
	{
	    
	    if(!empty($list)){
	        //查询字段名称
            list($_, $firstItem) = each($list);
            $keys      = array_keys($firstItem);
            $filedStr  = '';
            foreach ($keys as $key){
                $filedStr .= "`{$key}`,";
            }
            $filedStr  = rtrim($filedStr, ',');
            //组织批量写入/更新SQL语句
            $insertStr = '';
            $index     = 0;
            $operator  = $replace ? 'REPLACE' : 'INSERT';
            foreach ($list as $item){
                $tempStr = '';
                foreach ($keys as $key){
                    $tempStr .= "'{$item[$key]}',";
                }
                $tempStr    = rtrim($tempStr, ',');
                $insertStr .= "({$tempStr}),";
                if((++$index) % $perCount == 0){
                    $insertStr  = rtrim($insertStr, ',');
                    $this->exec("{$operator} INTO `{$table}`({$filedStr}) VALUES{$insertStr}");
                    $insertStr = '';
                }
            }
            //插入最后剩余不满$perCount的数据
            if(!empty($insertStr)){
                $insertStr  = rtrim($insertStr, ',');
                $this->exec("{$operator} INTO `{$table}`({$filedStr}) VALUES{$insertStr}");
            }
            return true;
	    }else{
	        return false;
	    }
	}
	
	/**
	 * 执行一条SQL操作，注意返回的数据类型是和exec方法不一样的。
	 * query方法一般用于select查询。
	 *
	 * @param  string $sql
	 * @return resource 数据库操作结果资源
	 */
	public function query($sql)
	{
		if(!$this->_link) {
			$this->_init();
		}
		$this->_sql = $sql;
		$this->_count++;
		$result = $this->_link->query($sql);
		if($result === false){
		    $this->_halt();
		}
	    return $result;
	}
	
	/**
	 * 执行事务语句,返回受影响的记录数。
	 * 长用在事务处理操作中。
	 * @param  string $sql
	 * @return int
	 */
	public function exec($sql)
	{
	    if(!$this->_link) {
			$this->_init();
		}
		$this->_sql = $sql;
		$this->_count++;
		$result = $this->_link->exec($sql);
		if($result === false){
		    $this->_halt();
		}
	    return $result;
	}
	
	/**
	 * 回滚事务操作，当commit之后该操作无效
	 * @return bool
	 */
	public function rollBack()
	{
	    if(!$this->_link) {
			$this->_init();
		}
	    return $this->_link->rollBack();
	}
	
	/**
	 * 提交事务操作
	 */
	public function commit()
	{
	    if(!$this->_link) {
			$this->_init();
		}
	    return $this->_link->commit();
	}
	
	/**
	 * 实行多条SQL语句
	 *
	 * @param string $sql
	 */
	public function multiQuery($sql)
	{
	    $querys = explode(';', $sql);
    	foreach ($querys as $query){
    		$query = trim($query);
    		if($query){
    			$this->query($query);
    		}
    	}
	}
	
	/**
	 * 取得结果集中行的数目。
	 *
	 * @param  resource $result 数据库操作结果资源
	 * @return int
	 */
	public function rows($result)
	{
		return @$result->rowCount();
	}
	
	/**
	 * 从结果集中取得一行作为关联数组，或数字数组，或二者兼有。
	 * 
	 * @param  resource $result 数据库操作结果资源
	 * @return array
	 */
	public function fetchArray($result)
	{
		return @$result->fetch(PDO::FETCH_BOTH);
	}
	
	/**
	 * 从结果集中取得一行作为关联数组。
	 *
	 * @param  resource $result 数据库操作结果资源
	 * @return array
	 */
	public function fetchAssoc($result)
	{
		return @$result->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * 从结果集中取得一行作为枚举数组。
	 * 每个结果的列储存在一个数组的单元中，偏移量从0开始。
	 *
	 * @param  resource $result 数据库操作结果资源
	 * @return array
	 */
	public function fetchRow($result)
	{
		return @$result->fetch(PDO::FETCH_NUM);
	}
		
	/**
	 * 取得结果中指定字段的字段名。
	 *
	 * @param  resource $result 数据库操作结果资源
	 * @param  int      $index
	 * @return string
	 */
	public function fieldName($result, $index)
	{
		return @$result->fetchColumn($index);
	}

	/**
	 * 返回上一次执行insert操作产生的ID
	 *
	 * @return int
	 */
	public function insertId()
	{
		return @$this->_link->lastInsertId();
	}
	
	/**
	 * 关闭数据库连接。
	 *
	 */
	public function close()
	{
		$this->_link = null;
	}
	
	/**
	 * 获取SQL返回的一条记录(SQL只获取一条记录)
	 *
	 * @param  string $sql
	 * @return array
	 */
	public function getOne($sql)
	{
		$result = $this->query($sql);
		$one = $this->fetchAssoc($result);
		if(empty($one)){
		    $one = array();
		}
		return $one;
	}
	
	/**
	 * 返回查询的结果列表，列表索引从0开始，每一项为一个数组。
	 *
	 * @param  string $sql
	 * @return list
	 */
	public function getAll($sql)
	{
		$list = array();
		$result = $this->query($sql);
		while ($row = $this->fetchAssoc($result)) {
			$list[] = $row;
		}
		return $list;
	}
	
	/**
	 * 返回查询的记录数。
	 *
	 * @param  string $sql select查询的SQL
	 * @return int
	 */
	public function scalar($sql)
	{
		$result = $this->query($sql);
		$row = $this->fetchRow($result);
		return intval($row[0]);
	}
	
	/**
	 * 增加操作INSERT、REPLACE
	 *
	 * @param  string $table 表名称
	 * @param  array  $data  关联数组
	 * @return int|false
	 */
	public function insert($table, $data, $replace = false)
	{
		$table = $this->_tablepre ? $this->_tablepre.$table : $table;
		if(!empty($data)) {
			foreach ($data as $key => $value) {
				$keys[]   = "`$key`";
				if(is_string($value)){
					$values[] = "'{$value}'";
				}else{
					if(is_null($value)){
						$value = 'NULL';
					}
					$values[] = "{$value}";
				}
			}
			$key_str   = implode(',', $keys);
			$value_str = implode(',', $values);
			$operator  = $replace ? 'REPLACE' : 'INSERT';
			$sql = "{$operator} INTO `{$table}`({$key_str}) VALUES({$value_str})";
			return $this->exec($sql);
		}
	}

	/**
	 * 修改操作UPDATE
	 *
	 * @param string $table      表名称
	 * @param array  $data       关联数组
	 * @param string $conditions SQL的操作条件
	 * @return int|false
	 */
	public function update($table, $data, $conditions)
	{
		$table = $this->_tablepre ? $this->_tablepre.$table : $table;
		if(!empty($data)) {
			foreach ($data as $key => $value) {
				if(is_string($value)){
					$sets[] = "`{$key}` = '{$value}'";
				}else{
					if(is_null($value)){
						$value = 'NULL';
					}
					$sets[] = "`{$key}` = {$value}";
				}
			}
			$sets_str = implode(',', $sets);
			$sql = "UPDATE `{$table}` SET {$sets_str} WHERE {$conditions}";
			return $this->exec($sql);
		}
	}
	
	/**
	 * 删除操作
	 *
	 * @param string $table      表名称
	 * @param string $conditions SQL的操作条件
	 * @return int|false
	 */
	public function delete($table, $conditions)
	{
		$table = $this->_tablepre ? $this->_tablepre.$table : $table;
		$sql = "DELETE FROM `{$table}` WHERE {$conditions}";
		return $this->exec($sql);
	}
	
	/**
	 * 错误产生时停止脚本并显示错误。
	 * 
	 */
	protected function _halt($error = '')
	{
		if(empty($error) && $this->_link){
		    $array = $this->_link->errorInfo();
			$error = $array[2];
		}
		if($error) {
		    if($this->_halt){
		        echo '<h3>DB Error</h3>';
    			echo '<p><b>Error:</b>'.$error.'</p>';
    			if($this->_sql){
    				echo '<p><b>Query:</b>'.$this->_sql.'</p>';
    			}
    			$this->close();
    			exit();
		    }else{
		        $this->_error = $error;
		    }
		}
	}
}
?>