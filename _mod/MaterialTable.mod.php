<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 原料中心模型
 * 
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-09-02
 */
class MaterialTableModel extends BaseModel
{
    public $database;
    private $_userSession;
	public $tableClass;
    
    //初始化表名
    public function init()
    {
        $this->database = MATERIAL_DATABASE;
        $this->_userSession = &self::$ses->get('user');
		$this->tableClass   = &$this->getModel('materialtableclass');
    }
    
	/**
     * 获取所有原料表的属性
     * 
     */
    public function getAllTablesAttr()
    {
        $sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`t_time`,`sort`,`open_statistics`,`xaxis` FROM `material_table_attr`";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 根据tid获取原料表属性
     * 
     */
    public function getTablesAttrBytid($tid)
    {
        $sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`keywords`,`t_time`,`sort`,`open_statistics`,`xaxis` FROM `material_table_attr`
        		WHERE `tid`={$tid}";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
 	/**
     * 根据分类ID获取原料表
     */
    public function getTablesAttrByClassid($classid)
    {
    	$sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`t_time`,`sort` FROM `material_table_attr`
        		WHERE `classid`={$classid}";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 根据表名获取原料表属性
     * @param $tableName
     */
    public function getTablesAttrByName($tableName)
    {
    	$sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`t_time`,`sort`,`open_statistics`,`xaxis` FROM `material_table_attr`
        		WHERE `t_name`='{$tableName}'";
        $result = self::$db_app->getOne($sql);
        return $result;  
    }
    
    /**
     * 根据tid获取原料表属性
     * 
     */
    public function getTablesAttrBytTname($t_name)
    {
        $sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`t_time`,`sort` FROM `material_table_attr`
        		WHERE `t_name`='{$t_name}'";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
    /**
     * 根据指标类别ID获取原料表
     */
    public function getTablesByQcid($qcid)
    {
    	$sql = "SELECT `tid`,`t_name`,`t_storage`,`t_creatorid`,`classid`,`qcid`,`tname`,`t_time`,`sort` FROM `material_table_attr`
        		WHERE `qcid`='{$qcid}'";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 根据tid获取原料表名
     * 
     */
    public function getTableNames($ids)
    {
        $ids = implode(',', $ids);
    	$sql = "SELECT `t_name` FROM `material_table_attr` WHERE `tid` in({$ids})";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 根据ids获取原料表名
     * 
     */
    public function getTablesInfo($ids)
    {
    	$sql = "SELECT `tid`,`t_name`,`tname`,`xaxis` FROM `material_table_attr` WHERE `tid` in({$ids})";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 根据tid获取原料表名和comment
     * 
     */
    public function getTablesNameAndComment($ids)
    {
        $ids = implode(',', $ids);
    	$sql = "SELECT `t_name`,`tname` FROM `material_table_attr` WHERE `tid` in({$ids})";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 更新原料表属性
     * @param array $param
     */
    public function updateTableAttr($param)
    {
    	$sql = "UPDATE `material_table_attr` SET `t_name`='{$param['tableName']}',`classid`={$param['classID']},`qcid`={$param['qcid']},`tname`='{$param['comment']}',`keywords`='{$param['tableKeyword']}',`open_statistics`=1,`xaxis`='field1',`sort`={$param['orders']} 
        		WHERE `tid`={$param['tableID']}";
        $result = self::$db_app->query($sql);
        return $result ? true : false;	
    }
    
	/**
     * 分页获取原料表属性
     * 
     */
    public function getAllTablesAttrSection($where, $orderProperty, $orderDirection, $pageNumber, $pageSize)
    {
        $start = ($pageNumber - 1)*$pageSize;
    	$sql = "SELECT `tid`,`t_name`,`t_creatorid`,`classid`,`qcid`,`tname`,`open_statistics`,`xaxis`,`sort` FROM `material_table_attr`
        		WHERE {$where} 
    			ORDER BY `{$orderProperty}` {$orderDirection} LIMIT {$start},{$pageSize}";
        $result = self::$db_app->getAll($sql);
        return $result;     
    }
    
	/**
     * 创建表
     */
    public function createTable($data, $dataAttr, $fieldsAttr)
    {
		//生成创建原料数据表SQL语句
    	$sql = "CREATE TABLE `{$data['tableName']}`( 
    			`id` INT NOT NULL AUTO_INCREMENT COMMENT 'auto increment ID',";
    	foreach ($data['list'] as $val) {
    		$sql .= $val.",";
    	}
    	$sql .= "PRIMARY KEY (`id`)) ENGINE={$data['storage_engine']} DEFAULT CHARSET={$data['encoding_type']} COMMENT='{$data['comment']}';";
    	
    	//生成原料数据表相关属性SQL语句
    	$query = "INSERT INTO `material_table_attr`(`t_name`, `t_storage`, `t_creatorid`, `classid`, `qcid`, `tname`, `keywords`, `open_statistics`, `xaxis`, `sort`) VALUES
    			 ('{$dataAttr['t_name']}','{$dataAttr['t_storage']}',{$dataAttr['t_creatorid']},{$dataAttr['classid']},{$dataAttr['qcid']},'{$dataAttr['tname']}','',1,'field1','{$dataAttr['sort']}')";
    	
    	//file_put_contents('/var/www/html/material/log',$sql."\n".$query."\n",FILE_APPEND);
    	
    	//利用事务模式插入数据库
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
        $result1 = self::$db_material->exec($sql);
        $result2 = self::$db_app->exec($query);
        
        $sql = "SELECT `tid` FROM `material_table_attr` WHERE `t_name`='{$dataAttr['t_name']}'";
    	$res = self::$db_app->getOne($sql);
    	$tid = $res['tid'];
        
    	//更新user表的operate_tables字段
    	if ($this->_userSession['gid'] == 1) {
    		$result3 = true;
    	} else {
    		//更新用户表
    		$sql = "SELECT `operate_tables` FROM `u_user` WHERE `uid`={$dataAttr['t_creatorid']}";
    		$res = self::$db_app->getOne($sql);
    		$operateTables = $res['operate_tables'];
    		
    		if (empty($operateTables)) {
    			$newOperateTables = $tid;
    		} else {
    			$newOperateTables = $operateTables.",{$tid}";
    		}
    		$sql = "UPDATE `u_user` SET `operate_tables`='{$newOperateTables}' 
    				WHERE `uid`={$dataAttr['t_creatorid']}";
    		//file_put_contents('/var/www/html/material/log', $sql."\n", FILE_APPEND);
    		$result3 = self::$db_app->exec($sql);
    	}
    	
    	//更新字段表
   		if (!empty($fieldsAttr)) {
   			$sql = "INSERT INTO `material_fields_attr`(`fname`, `tid`, `fcomment` ,`unit`, `keywords`) VALUES";
   			foreach ($fieldsAttr as $fieldAttr) {
   				$sql .= "('{$fieldAttr['field']}',{$tid},'{$fieldAttr['comment']}','{$fieldAttr['unit']}','{$fieldAttr['keywords']}'),";
   			}
   			$sql = substr($sql, 0, strlen($sql)-1);
   			//file_put_contents('/var/www/html/material/log', $sql."\n", FILE_APPEND);
   			
   			$result4 = self::$db_app->exec($sql);
   		}
        
        //创建表，$result=0表示成功
        if (!$result1 && $result2 && $result3 && $result4) {
        	self::$db_material->commit();
			self::$db_app->commit();
			$result = true;
        } else {
        	self::$db_material->rollBack();
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
	
    /**
     * 删除原料表及相关属性
     * 
     * @param array $tableIDs
     * @return bool
     */
    public function deleteTable($tableIDs)
    {
    	$ids = implode(',', $tableIDs);
    	
    	//根据ids取得原料表名
    	$sql    = "SELECT `t_name` FROM `material_table_attr` WHERE `tid` IN({$ids})";
    	$res = self::$db_app->getAll($sql);
    	
    	$tableNames = array();
    	foreach ($res as $tableName) {
    		array_push($tableNames,$tableName['t_name']);
    	}
    	$tableNames = implode(',', $tableNames);
    	
    	//利用事务模式
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
        
		//1、删除material_table_attr表中的记录
		$query1 = "DELETE FROM `material_table_attr` WHERE `tid` IN($ids)";
		//file_put_contents('/var/www/material/cache/deletetable',$query1."\n",FILE_APPEND);
		$result1 = self::$db_app->exec($query1);
		//file_put_contents('/var/www/material/cache/deletetable',"result1:\n",FILE_APPEND);
		//file_put_contents('/var/www/material/cache/deletetable',var_export($result1,true),FILE_APPEND);

        //2、更新u_user的operate_tables字段
        $result2 = true;
        $sql = "SELECT `uid`,`operate_tables` FROM `u_user` WHERE `gid`!=1";
        $res = self::$db_app->query($sql);
        if (!empty($res)) {
        	foreach ($res as $item) {
        		if (!empty($item['operate_tables'])) {
        			$operate_tables = explode(',', $item['operate_tables']);
        			$intersectArr = array_intersect($operate_tables, $tableIDs);
        			if (!empty($intersectArr)) {
	        			foreach ($operate_tables as $tkey=>$tid) {
	        				if (in_array($tid, $intersectArr)) {
	        					unset($operate_tables[$tkey]);
	        				}
	        			}
	        			$operate_tablesStr = implode(',',$operate_tables);
	        			$sql = "UPDATE `u_user` SET `operate_tables`='{$operate_tablesStr}' WHERE `uid`={$item['uid']}";
	        			//file_put_contents('/var/www/material/cache/deletetable',$sql."\n",FILE_APPEND);
	        			$result = self::$db_app->exec($sql);
	        			//file_put_contents('/var/www/material/cache/deletetable',var_export($result,true),FILE_APPEND);
	        			if (!$result) {
	        				$result2 = false;
	        			}
        			}
        		}
        	}
        }
        
        //3、删除原料表相关记录
        $result3 = false;
        $sql = "SELECT count(*) as `count` FROM `material_record_attr` WHERE `tid` IN({$ids})";
        $res1 = self::$db_app->getOne($sql);
        if ($res1['count'] == 0) {//如果没有表记录
        	$result3 = true;
        } else{
	        $sql = "DELETE FROM `material_record_attr` WHERE `tid` IN({$ids})";
	        $res = self::$db_app->exec($sql);
	        if ($res) {
	        	$result3 = true;
	        }
        }
        
    	//4、删除字段相关属性
        $result4 = false;
        $sql = "SELECT COUNT(*) AS `count` FROM `material_fields_attr` WHERE `tid` IN ({$ids})";
        $res1 = self::$db_app->getOne($sql);
    	if ($res1['count'] == 0) {//如果没有表记录
        	$result4 = true;
        } else{
	        $sql = "DELETE FROM `material_fields_attr` WHERE `tid` IN({$ids})";
	        $res = self::$db_app->exec($sql);
	        if ($res) {
	        	$result4 = true;
	        }
        }
        
        //5、删除原料表
        $query = "DROP TABLE {$tableNames}";
        $result5 = self::$db_material->exec($query);

        //创建表，$result2=0表示成功
        if ($result1 && $result2 && $result3 && $result4 && !$result5) {
        	self::$db_material->commit();
			self::$db_app->commit();
			$result = true;
        } else {
        	self::$db_material->rollBack();
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
    
    /**
     * 删除原料表字段
     * 
     * @param string $tableName
     * @param string $field
     * @return bool
     */
    public function deleteTableField($tableName, $field)
    {
    	$result = false;
    	//根据表名查询表id
    	$sql = "SELECT `tid` FROM `material_table_attr` WHERE `t_name`='{$tableName}'";
    	$res = self::$db_app->getOne($sql);
    	if (!empty($res)) {
    		$tid = $res['tid'];
    		$check1 = false;
    		$check2 = false;
    		//遍历字段表
	    	$sql   = "SELECT COUNT(*) AS `count` FROM `material_fields_attr` WHERE `fname`='{$field}' AND `tid`={$tid}";
	    	$res1  = self::$db_app->getOne($sql);
	    	$count = $res1['count'];
	    	//删除原料表字段属性
	    	if ($count > 0) {
	    		$sql = "DELETE FROM `material_fields_attr` WHERE `fname`='{$field}' AND `tid`={$tid}";
	    		$res2 = self::$db_app->query($sql);
	    		if ($res2) {
	    			$check1 = true;
	    		}
	    	} else {
	    		$check1 = true;
	    	}
	    	
	    	//file_put_contents('/var/www/material/log',$tableName.$field,FILE_APPEND);
	    	$sql = "ALTER TABLE `{$tableName}` DROP COLUMN `{$field}`";
	        $res3 = self::$db_material->query($sql);
	        
	        if ($res3) {
	        	$check2 = true;
	        }
	        
	        if ($check1 && $check2) {
	        	$result = true;
	        }
	        
    	} else {
    		$result = true;
    	}
    	
    	return $result;
    }
    
    /**
     * 更新原料表字段属性
     * 
     * @param string $tableName
     * @param array  $params
     */
    public function updateTableField($tableName, $params)
    {
    	$sql = "ALTER TABLE `{$tableName}` CHANGE `{$params['fieldName']}` `{$params['fieldName']}` {$params['fieldType']} {$params['isNull']} {$params['defaultValue']} COMMENT '{$params['fieldComment']}'";
        $res = self::$db_material->query($sql);
        
        return $res ? true : false;
    }
    
	/**
     * 增加原料表字段
     * 
     * @param string $tableName
     * @param array  $params
     */
    public function addTableField($tableName, $params)
    {
    	//file_put_contents('/var/www/html/material/log', $tableName."\n".var_export($params,true), FILE_APPEND);
    	$sql = "ALTER TABLE `{$tableName}` ADD COLUMN `{$params['fieldName']}` {$params['fieldType']} {$params['isNull']} {$params['defaultValue']} COMMENT '{$params['fieldComment']}'";
        $res = self::$db_material->query($sql);
        
        return $res ? true : false;
    }
    
	/**
     * 获取原料数据表个数
     */
    public function getTablesCount($where)
    {
    	$sql = "SELECT COUNT(*) AS `count` FROM `material_table_attr` WHERE {$where}";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
	/**
     * 获取表字段相关信息
     */
    public function getFieldInfo($tableName)
    {
        $sql = "SHOW FULL FIELDS FROM `{$tableName}`";
        $result = self::$db_material->getAll($sql);
        return $result;     
    }
    
	/**
     * 获取原料表相关信息
     */
    public function getTableInfo($tableName)
    {
        $sql = "SHOW TABLE STATUS FROM `{$this->database}` WHERE NAME='{$tableName}'";
        $result = self::$db_material->getOne($sql);
        return $result;     
    }
    
    /**
     * 向原料表插入数据(事务模式)
     * 
     * @param string $query       SQL语句
     * @param int    $tableid     原料表ID
     * @param int    $storageType 存储类型，1提交、2暂存
     */
    public function insertRecord($query,$tableid,$storageType)
    {	
    	//file_put_contents('/var/www/material/cache/test', var_export($this->_userSession,true), FILE_APPEND);exit();
    	//开启事务
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
        //1、向原料表插入数据
		$result1 = self::$db_material->exec($query);
		
		$insertID = self::$db_material->insertId();
		//2、将最新插入数据产生的ID，插入到app数据库的material_record_attr表中
		$userid = $this->_userSession['uid'];
		$time   = date('Y-m-d H:i:s',time());
		$sql = "INSERT INTO `material_record_attr`(`r_id`,`tid`,`r_creatorid`,`r_status`,`r_time`) 
				VALUES({$insertID},{$tableid},{$userid},{$storageType},'{$time}')";
		$result2 = self::$db_app->exec($sql);
        
        if ($result1 && $result2) {
        	self::$db_material->commit();
			self::$db_app->commit();
			$result = true;
        } else {
        	self::$db_material->rollBack();
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
    
	/**
     * 备份原料表
     */
    public function backupStorage($tables)
    {
        $result = array();
        
    	foreach ($tables as $table) {
        	$time = date('YmdHis',time());
        	$timeStamp = time();
    		$command = "mysqldump -h".MATERIAL_HOSTNAME." -P".MATERIAL_HOSTPORT." -u".MATERIAL_USERNAME." -p'".MATERIAL_PASSWORD."' ".MATERIAL_DATABASE." {$table} > ".Config::$cfg['backupPath']."{$table}_{$timeStamp}.sql";
        	//file_put_contents('/var/www/material/test1', $command."\n", FILE_APPEND);
        	//执行命令
        	exec($command,$output,$status);
        	array_push($result,$status);
        }
		
        return $result;
    }
    
	/**
     * 还原原料表（利用事务模式）
     */
    public function restoreData($tableID, $tableName, $filePath)
    {
    	$result = false;
    	
    	//开启事务
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
        //1、删除记录属性表中的信息
        $sql = "SELECT * FROM `material_record_attr` WHERE `tid` = {$tableID}";
        $resu = self::$db_app->getOne($sql);
        if (!empty($resu)) {
			$sql = "DELETE FROM `material_record_attr` WHERE `tid` = {$tableID}";
			$result1 = self::$db_app->exec($sql);
        } else {
        	$result1 = true;
        }
		//2、还原原料表
		//$command = "mysql -h".MATERIAL_HOSTNAME." -P".MATERIAL_HOSTPORT." -u".MATERIAL_USERNAME." -p'".MATERIAL_PASSWORD."' ".MATERIAL_DATABASE." {$tableName} < ".$filePath;
		$command = "mysql -h".MATERIAL_HOSTNAME." -P".MATERIAL_HOSTPORT." -u".MATERIAL_USERNAME." -p'".MATERIAL_PASSWORD."' ".MATERIAL_DATABASE." < ".$filePath;
		exec($command,$output,$status);//$status=0执行成功；$status=1执行失败
		//file_put_contents('/var/www/material/cache/restore',$command."\n",FILE_APPEND);
		//file_put_contents('/var/www/material/cache/restore',$status,FILE_APPEND);
        //3、获取原料表的所有记录ID并将记录ID插入记录属性表中
        $sql = "SELECT `id` FROM `{$tableName}`";
        $res = self::$db_material->getAll($sql);
        
        $result2 = null;
        if (!empty($res)) {
	        $time   = date('Y-m-d H:i:s',time());
	        $userID = $this->_userSession['uid'];
	        $sql    = "INSERT INTO `material_record_attr`(`r_id`,`tid`,`r_creatorid`,`r_status`,`r_time`) VALUES";
	        foreach ($res as $item) {
	        	$sql .= "({$item['id']},{$tableID},{$userID},1,'{$time}'),";
	        }
	        $sql     = substr($sql,0,strlen($sql)-1);
	        $result2 = self::$db_app->exec($sql);
	        //file_put_contents('/var/www/material/cache/restore',$sql."\n",FILE_APPEND);
			//file_put_contents('/var/www/material/cache/restore',var_export($result2,true),FILE_APPEND);
        }

        if ($result1 && $result2 && !$status) {
			self::$db_app->commit();
			$result = true;
        } else {
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;  
           
    }
    
	/**
     * 获取原料数据表个数
     */
    public function getRecordsCount($tableID)
    {
        $sql = "SELECT COUNT(*) AS `count` FROM `material_record_attr` WHERE `tid`={$tableID}";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
    /**
     * 按条件查询原料表记录
     * 
     * @param string $tableName 表名
     * @param array  $recordsId 记录ID
     * @param string $orderProperty 排序字段
     * @param string $orderDirection 排序方法asc/desc
     * @param int $pageNumber 页码
     * @param int $pageSize 每页记录数
     */
    public function getRecords($tableName, $recordsId, $orderProperty=null, $orderDirection=null, $pageNumber=null, $pageSize=null)
    {
    	$recordsIdStr = implode(',',$recordsId);
    	/*
    	$sql = "SELECT * FROM `{$tableName}` 
	    		WHERE `id` IN({$recordsIdStr}) 
	    		ORDER BY {$orderProperty} {$orderDirection} 
	    		LIMIT {$start},{$pageSize}";
    	*/
    	$sql = "SELECT * FROM `{$tableName}` 
	    		WHERE `id` IN({$recordsIdStr})";
    	
    	if (!empty($orderProperty) && !empty($orderDirection)) {
    		$sql .= " ORDER BY {$orderProperty} {$orderDirection}";
    	} 
    	
    	if (isset($pageNumber) && isset($pageSize)) {
    		$start = ($pageNumber - 1)*$pageSize;
    		$sql .= " LIMIT {$start},{$pageSize}";
    	}
    	file_put_contents('/var/www/html/material/log', $sql."\n", FILE_APPEND);
    	$res = self::$db_material->getAll($sql);
    	
    	$result = array();
    	if (!empty($res)) {
    		foreach ($res as $item) {
    			$id = $item['id'];
    			//$result[$id] = array_slice($item,1,count($item)-1);
    			$result[$id] = array_values($item);
    		}
    	}
    	
        return $result;     
    }
    
    /**
     * 获取记录属性
     * 
     * @param array  $where     查询条件
     * @param string $tableID   原料表ID
     */
    public function getRecordsAttrByCondition($tableID, $where=true)
    {
    	$sql   = "SELECT * FROM `material_record_attr` 
    			  WHERE {$where} AND `tid`={$tableID}";
    	$res = self::$db_app->getAll($sql);
    	
    	$result = array();
    	$creators = array();
    	if (!empty($res)) {
    		foreach ($res as $item) {
    			$id = $item['r_id'];
    			//$result[$id] = array_slice($item,3,count($item)-3);
    			$result[$id] = array(
    				'r_id' => $id,
    				'r_creatorid' => $item['r_creatorid'],
    				'r_status' => $item['r_status'],
    				'r_time' => $item['r_time']
    			);
    			array_push($creators, $item['r_creatorid']);
    		}
    	}
    	
    	//获取用户名
    	$creators = array_unique($creators);
    	$result['creators'] = $creators;
    	
        return $result;     
    }
    
    /**
     * 删除原料表记录
     * 
     * @param string $tableName 原料名
     * @param array  $recordIds 记录id（一个或多个）
     */
    public function delRecords($tableID, $tableName, $recordIds)
    {
    	$ids = implode(',', $recordIds);
    	
    	//利用事务模式
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
        
		$query1 = "DELETE FROM `material_record_attr` WHERE `tid`={$tableID} AND `r_id` IN({$ids})";
		$query2 = "DELETE FROM `{$tableName}` WHERE `id` IN ({$ids})";
		//file_put_contents('/var/www/material/cache/deleteRecord', $query1."\n".$query2."\n", FILE_APPEND);exit();
		$result1 = self::$db_app->exec($query1);
        $result2 = self::$db_material->exec($query2);
        
        if ($result1 && $result2) {
        	self::$db_material->commit();
			self::$db_app->commit();
			$result = true;
        } else {
        	self::$db_material->rollBack();
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
    
	/**
	 * 获取记录属性
	 * 
	 * @param int $tableID  表ID
	 * @param int $recordID 记录ID
	 */
    public function getRecordAttr($tableID, $recordID)
    {
        $sql = "SELECT `rid`,`r_id`,`tid`,`r_creatorid`,`r_status`,`r_time` FROM `material_record_attr`
        		WHERE `r_id`={$recordID} AND `tid`={$tableID}";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
    /**
     * 根据记录id，获取记录
     * @param sting $tableName 原料表名
     * @param int   $recordID  记录ID
     */
    public function getRecordByID($tableName, $recordID)
    {
    	$sql = "SELECT * FROM `{$tableName}` WHERE `id`={$recordID}";
    	$result = self::$db_material->getOne($sql);
        return $result;    
    }
    
    /**
     * 更新原料表记录
     * 
     * @param string $tableName 原料表
     * @param int    $recordID  记录ID
     * @param array  $fieldArr  表字段
     * @param array  $valueArr  表值
     */
    public function updateRecord($tableName,$recordID,$fieldArr,$valueArr,$fieldsInfo)
    {
    	$sql = "UPDATE `{$tableName}` SET ";
    	
    	foreach ($fieldArr as $key=>$field) {
    		$val = $valueArr[$key];
    		
    		
    		
    		/*
    		if ($val != '') {
    			//判断数据字段类型与表字段类型是否一致
    			$valueType = myGetType($val);
    			if ($valueType == 'boolean' 
    				|| $valueType == 'float' 
    				|| $valueType == 'integer' 
    				|| $valueType == 'NULL' 
    				|| $valueType == 'numeric' ) {
    				$tip = 'unAddSingleQuote';
    			} else {
    				$tip = 'addSingleQuote';
    			}
    			
    			if (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[0]) && $tip=='unAddSingleQuote') {
    				$value .= "{$val},";
    			} elseif (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[1]) && $tip=='addSingleQuote') {		
    				$value .= "'{$val}',";
    			} else {
    				$this->headShow(1,'insert fieldData type is wrong',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");
    			}
			} else {
				if ($fieldNullArr[$key] == 'YES') {//空&&值为空
    				if (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[0])) {
    					$val = 0;
    					$value .= "{$val},";
    				} else {
    					$value .= "'{$val}',";
    				}
    			} else {
    				$this->headShow(1,'field is empty',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");		
    			}
			}
    		*/
    		
    		
    	
    		
    		
    		if (in_array($fieldsInfo[$field]['type'], Config::$cfg['addSingleQuote'][1])) {
    			$sql .= "`$field`='{$val}',";
    		} elseif (in_array($fieldsInfo[$field]['type'], Config::$cfg['addSingleQuote'][0])) {
    			if ($val == '') {
    				if ($fieldsInfo[$field]['null'] == 'YES') {
    					$val = 0;
    				} else {
    					return false;
    				}
    			}
    			$sql .= "`$field`={$val},";
    		}
    	}
    	/*
    	$value = substr($value,0,strlen($value)-1);
    	$value .= ")";
    	$query = $sql.$value;
    	*/
    	$sql = substr($sql,0,strlen($sql)-1);
    	
    	$sql .= " WHERE `id`={$recordID}";
    	//echo $sql;exit();
    	$result = self::$db_material->query($sql);
        return $result ? true : false;
    }
    
    /**
     * 导入数据
     * @param string $tableName   原料表名
     * @param array  $selectedRow 需要导入的数据
     * @return bool
     */
    public function importData($tableID, $tableName, $selectedRow)
    {
    	//获取表字段
    	$fields = array();
    	$fieldsType = array();
    	$sql = "SHOW FULL FIELDS FROM `{$tableName}`";
    	$fieldsAttr = self::$db_material->getAll($sql);
    	foreach ($fieldsAttr as $fieldInfo) {
    		if ($fieldInfo['Field'] != 'id' && $fieldInfo['Field'] != 'field0') {
    			array_push($fields, $fieldInfo['Field']);
    			$fieldType = strtoupper(preg_replace('/\(\d+\)/','',$fieldInfo['Type']));
    			array_push($fieldsType,$fieldType);
    		}
    	}

    	//获取原料表最大ID
    	$sql = "SELECT MAX(`id`) AS `maxId` FROM `{$tableName}`";
    	$res = self::$db_material->getOne($sql);
    	if ($res['maxId']) {
    		$maxId = $res['maxId'];
    	} else {
    		$maxId = -1;
    	}
    	
    	//利用事务模式
		self::$db_material->beginTransaction();
		self::$db_app->beginTransaction();
    	
    	//组织SQL语句
    	$fieldsStr = implode(',', $fields);
    	$sql = "INSERT INTO `{$tableName}`({$fieldsStr}) VALUES";
    	
    	foreach ($selectedRow as $row) {
    		$sql .= "(";
    		foreach ($row as $key=>$value) {
    			//判断数据字段类型与表字段类型是否一致
    			$valueType = myGetType($value);
    			if ($valueType == 'boolean' 
    				|| $valueType == 'float' 
    				|| $valueType == 'integer' 
    				|| $valueType == 'NULL' 
    				|| $valueType == 'numeric' ) {
    				$tip = 'unAddSingleQuote';
    			} else {
    				$tip = 'addSingleQuote';
    			}
    			
    			if (in_array($fieldsType[$key], Config::$cfg['addSingleQuote'][1]) && $tip=='addSingleQuote') {
    				$sql .= "'{$value}',";
    			} elseif (in_array($fieldsType[$key], Config::$cfg['addSingleQuote'][0]) && $tip=='unAddSingleQuote') {
    				//@todo 如果$value为空值，如何处理，待详细考虑
    				if (empty($value)) {
    					$value = 0;
    				}
    				$sql .= "{$value},";
    			} else {
    				return false;
    			}
    		}
    		$sql = substr($sql,0,strlen($sql)-1);
    		$sql .= "),";
    	}
    	$sql = substr($sql,0,strlen($sql)-1);
    	//file_put_contents('/var/www/material/cache/importData',$sql."\n",FILE_APPEND);
    	$result1 = self::$db_material->exec($sql);
    	
    	//获取所有新插入的ID
    	$insertIds = array();
    	$sql  = "SELECT `id` FROM `{$tableName}` WHERE `id`>{$maxId}";
    	$resu = self::$db_material->getAll($sql);
    	if (!empty($resu)) {
    		foreach ($resu as $idInfo) {
    			array_push($insertIds,$idInfo['id']);
    		}
    	}

    	//将新插入的信息插入到原料属性表
    	$sql = "INSERT INTO `material_record_attr`(`r_id`,`tid`,`r_creatorid`,`r_status`,`r_time`) VALUES";
    	$userid = $this->_userSession['uid'];
    	$time = date('Y-m-d H:i:s',time());
    	foreach ($insertIds as $rid) {
    		$sql .= "({$rid},{$tableID},{$userid},1,'{$time}'),";
    	}
    	$sql = substr($sql,0,strlen($sql)-1);
		//file_put_contents('/var/www/material/cache/importData',$sql."\n",FILE_APPEND);
    	$result2 = self::$db_app->exec($sql);

        if ($result1 && $result2) {
        	self::$db_material->commit();
			self::$db_app->commit();
			$result = true;
        } else {
        	self::$db_material->rollBack();
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
    
    /**
     * 根据表名获取原料表所有数据
     * 
     * @param unknown_type $tableName
     * @return array
     */
    public function getAllRecords($tableName)
    {
    	$sql = "SELECT * FROM `$tableName` ORDER BY `id` ASC";
    	$result = self::$db_material->getAll($sql);
    	return $result;
    }
    
    /**
     * 根据表ID获取字段相关单位及指标等
     * @param $tid
     */
    public function getFieldUnitAndKeywords($tid)
    {
    	$sql = "SELECT `fname`,`tid`,`fcomment`,`unit`,`keywords` FROM `material_fields_attr` WHERE `tid`={$tid}";	
    	$result = self::$db_app->getAll($sql);
    	return $result;
    }
    
	/**
     * 根据表ID获取字段相关单位及指标等
     * @param $tid
     */
    public function getFieldsInfo($tids)
    {
    	$sql = "SELECT `fname`,`tid`,`fcomment`,`unit`,`keywords` FROM `material_fields_attr` WHERE `tid` IN ({$tids})";	
    	$result = self::$db_app->getAll($sql);
    	return $result;
    }
    
    /**
     * 更新单位和指标
     * @param $unitKey
     */
    public function updateUnitKey($unitKey)
    {
    	$sql = "UPDATE `material_fields_attr` SET `fcomment`='{$unitKey['comment']}',`unit`='{$unitKey['unit']}',`keywords`='{$unitKey['keyword']}' 
    			WHERE `tid`={$unitKey['tid']} AND `fname`='{$unitKey['field']}'";
    	$result = self::$db_app->query($sql);
    	return $result;
    }
    
    /**
     * 添加单位和指标
     */
    public function addUnitKey($unitKey)
    {
    	$sql = "INSERT INTO `material_fields_attr`(`tid`,`fcomment`,`fname`,`unit`,`keywords`) 
    			VALUES({$unitKey['tid']}, '{$unitKey['field']}', '{$unitKey['comment']}', '{$unitKey['unit']}', '{$unitKey['keyword']}')";
    	$result = self::$db_app->query($sql);
    	return $result;
    }
    
	/**
     * 替换单位和指标
     */
    public function replaceUnitKey($unitKey)
    {
		//此处tid、fname为联合索引
    	$sql = "REPLACE INTO `material_fields_attr`(`tid`,`fname`,`fcomment`,`unit`,`keywords`) 
    			VALUES({$unitKey['tid']}, '{$unitKey['field']}','{$unitKey['comment']}', '{$unitKey['unit']}', '{$unitKey['keyword']}') 
    			";
    	$result = self::$db_app->query($sql);
    	
		return $result;
    }
    
	/**
     * 删除字段属性
     * 
     * @param $tid
     * @param $field
     */
    public function deleteAllFieldAttr($tid)
    {
    	$sql = "DELETE FROM `material_fields_attr` WHERE `tid`={$tid} AND `fname`='{$field}'";
    	$result = self::$db_app->query($sql);
    	return $result;
    }
    
    /**
     * 删除字段属性
     * 
     * @param $tid
     * @param $field
     */
    public function deleteFieldAttr($tid, $field)
    {
    	$sql = "DELETE FROM `material_fields_attr` WHERE `tid`={$tid} AND `fname`='{$field}'";
    	$result = self::$db_app->query($sql);
    	return $result;
    }
    
    /**
     * 获取统计数据
     * 
     * @param string $XAxis
     * @param string $field
     * @param string $tableName
     * @return array
     */
    public function getStatisticsData($XAxis,$field,$tableName)
    {
    	if (empty($field)) {
    		$sql = "SELECT `{$XAxis}` FROM `{$tableName}`";
    	} else {
    		$sql = "SELECT `{$XAxis}`,`{$field}` FROM `{$tableName}`";
    	}
    	$result = self::$db_material->getAll($sql);
    	return $result;
    }
    
    /**
     * 获取表数据
     * 
     * @param string $fields
     * @param string $tablename
     */
    public function getStatData($fields, $tablename)
    {
    	$sql = "SELECT {$fields} FROM `{$tablename}`";
    	$result = self::$db_material->getAll($sql);
    	
    	return $result;
    }
    
    /**
     * 统计设置
     */
    public function statisticSet($tableName, $openStatistic, $fieldName)
    {
    	$sql = "UPDATE `material_table_attr` SET `open_statistics`={$openStatistic},`xaxis`='{$fieldName}'
    			WHERE `t_name`='{$tableName}'";
    	$result = self::$db_app->query($sql);
    	return $result;
    }

	/**
	 * 查询表属性相关信息
	 */
	public function getAttributeData($select='*',$where = 1) {
		$sql = '';
		if (empty($select)) {
			$select = '*';
		}
		if (empty($where)) {
			$where = 1;
		}
		$sql = "SELECT " . $select . ' FROM `material_table_attr` WHERE ' . $where;
		$result = self::$db_app->getAll($sql);
    	return $result;
	}

	/**
	 * 获取数据更新
	 */
	public function getLatestRecords()
	{
		$sql  = "SELECT DISTINCT(m.tid),a.tname,a.classid,a.t_time FROM `material_record_attr` as m left join `material_table_attr` as a";
		$sql .= " on m.`tid`=a.`tid` ORDER BY m.r_time DESC LIMIT 8 ";
		$result = self::$db_app->getAll($sql);
		return $result;
	}

	/**
     * 根据表名获取原料表相应字段信息
     * @param string $select
	 * @param string $tname
     * @return array
     */
    public function getTableRecords($select,$tableName,$where = 1, $page = 0,$first = 0, $limit = 0,$orderby = " ORDER BY `id` ASC ")
    {
		if (!$select || !$where) {
			return false;
		}
		if ($page == 0) {
    		$sql = "SELECT " . $select . " FROM `" . $tableName . "` WHERE " . $where .  $orderby;
		} else {
			$limitString = ($limit == 0) ? '' : " LIMIT {$first}, {$limit}";
			$sql = "SELECT " . $select . " FROM `" . $tableName . "` WHERE " . $where . $orderby .  $limitString;
		}
    	$result = self::$db_material->getAll($sql);
    	return $result;
    }

	/**
	 * 根据关键字获取表信息
	 * @param string $keyword
	 */
	public function getTableListBykeywords($keyword)
	{
		if (!$keyword) {
			return false;
		}
		$tablesArr  = array();
		$sql		= "select group_concat(fname) as str,group_concat(fcomment) as fcomment,tid from material_fields_attr WHERE `fcomment` LIKE '%" . trim($keyword) . "%' group by tid";
		$result		= self::$db_app->getAll($sql);
		foreach ($result as $val) {
			$val['tableinfo']		= $this->getTablesAttrBytid($val['tid']);
			$classArr               = $this->tableClass->getClassInfoByID(intval($val['tableinfo']['classid']));
			$val['classname']       = $classArr['class_name'];
			$tablesArr[$val['tid']]	= $val;
		}
		return $tablesArr;
	}	 
	
	
}