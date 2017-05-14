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
class QuotaModel extends BaseModel
{
    public $table;
    
    //初始化表名
    public function init()
    {
        $this->table = "{$this->dbpre}quota";
    }
    
	/**
     * 添加原料表分类
     */
    public function addTableClass($class_name,$parentid,$csort=1)
    {
        if (empty($parentid)) {//顶级分类
        	$ancestors = "0";
        } else {//非顶级分类
	    	$sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `classid`={$parentid}";
	        $result = self::$db_app->getOne($sql);
	        $ancestors = $result['ancestors'].",".$parentid;
        }
        
    	$sql = "INSERT INTO `{$this->table}`(`class_name`,`ancestors`,`parentid`,`csort`) 
        		VALUES('{$class_name}','{$ancestors}',{$parentid},{$csort})";
        $res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }
    
    /**
     * 遍历原料表分类
     */
    public function getTableClassList()
    {
        $sql = "SELECT `classid`, `class_name`, `parentid`, `ancestors`, `csort` 
        		FROM `$this->table`";
        $result = self::$db_app->getAll($sql);

        return $result;
    }
    
	/**
     * 根据classid获取分类信息
     */
    public function getClassInfoByID($classid)
    {
        $sql = "SELECT `classid`, `class_name`, `parentid`, `ancestors`, `csort` 
        		FROM `$this->table` WHERE `classid` = {$classid}";
        $result = self::$db_app->getOne($sql);

        return $result;
    }
    
	/**
     * 根据classid获取分类序列（如：分类一/分类二/分类三）
     */
    public function getClassListByID($classid)
    {
        $result = '';
    	$sql  = "SELECT `class_name`,`ancestors` FROM `$this->table` 
        		 WHERE `classid` = {$classid}";
        $res1 = self::$db_app->getOne($sql);
        
        $result = $res1['class_name'];
        
        $classids = substr($res1['ancestors'], 2, strlen($res1['ancestors'])-2);
        if (!empty($classids)) {
        	$query = "SELECT `class_name` FROM `$this->table` 
        		  	  WHERE `classid` IN({$classids})";
        	$res2 = self::$db_app->getAll($query);
        	//print_r($res2);
        	foreach ($res2 as $class_name) {
        		$result = $class_name['class_name']."/".$result;
        	}
        }
        
        return $result;
    }
    
    /**
     * 更新分类表记录信息
     */
    public function editTableClass($classid,$class_name,$parentid,$csort) {
    	if (empty($parentid)) {//顶级分类
        	$ancestors = "0";
        } else {//非顶级分类
	    	$sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `classid`={$parentid}";
	        $result = self::$db_app->getOne($sql);
	        $ancestors = $result['ancestors'].",".$parentid;
        }
        
    	$sql = "UPDATE `$this->table` SET 
    			`class_name`='{$class_name}', `parentid`={$parentid}, `ancestors`='{$ancestors}', `csort`={$csort} 
        		WHERE `classid` = {$classid}";
        $res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }
    
	/**
     * 根据classid获取分类信息
     */
    public function deleteTableClass($classid)
    {
        $sql = "DELETE FROM `$this->table` WHERE `classid` = {$classid}";
        $res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }
    
    /**
     * quota表插入数据
     * 
     * @param $quotaName
     * @param $quotaContent
     * @param $qcid
     */
    public function insertQuota($quotaName, $quotaContent, $qcid)
    {
    	$sql = "INSERT INTO `quota`(`quotaname`,`quotacontent`,`qcid`) 
    			VALUES('{$quotaName}','{$quotaContent}',{$qcid})";
    	$res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }
    
    /**
     * 获取所有指标
     */
    public function getAllQuotas()
    {
    	$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota`";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
	/**
     * 根据指标分类获取指标
     */
    public function getQuotasByQcid($qcid)
    {
		$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` WHERE `qcid`={$qcid}";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
	/**
     * 根据指标分类获取指标
     */
    public function getAllQuotasByQcid($qcid)
    {
		//获取指标分类路径
		$sql = "SELECT `ancestors` FROM `quota_class` WHERE `qcid`={$qcid}";
		$result = self::$db_app->getOne($sql);
		$ancestors = $result['ancestors'];
		
		//查找该指标分类以及其子分类下的指标
		$sql = "SELECT a.`quotaid`,a.`quotaname`,a.`quotacontent`,a.`qcid` FROM `quota` AS a
				LEFT JOIN `quota_class` AS b 
				ON a.`qcid` = b.`qcid` 
				WHERE `ancestors` like '{$ancestors}%'";
		//$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` WHERE `qcid`={$qcid}";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
	
	/**
     * 根据指标分类获取指标
     */
    public function getQuotasByQcids($qcids)
    {
    	$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` WHERE `qcid` IN ({$qcids})";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
    /**
     * 根据指标id获取指标
     * 
     * @param $quotaid
     */
    public function getQuotaInfoById($quotaid)
    {
    	$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` WHERE `quotaid`={$quotaid}";
    	$res = self::$db_app->getOne($sql);
    	
    	return $res;
    }
    
    /**
     * 根据条件获取指标
     * 
     * @param $qcid
     * @param $orderProperty
     * @param $orderDirection
     * @param $pageNumber
     * @param $pageSize
     */
    public function getQuotasByCondition($qcid, $orderProperty, $orderDirection, $pageNumber, $pageSize)
    {
    	$start = ($pageNumber-1)*$pageSize;
    	
    	if (empty($qcid)) {
    		$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` 
    				ORDER BY `{$orderProperty}` {$orderDirection} 
    				LIMIT {$start},{$pageSize}";
    	} else {
    		$sql = "SELECT `quotaid`,`quotaname`,`quotacontent`,`qcid` FROM `quota` 
    				WHERE `qcid` = {$qcid} 
    				ORDER BY `{$orderProperty}` {$orderDirection} 
    				LIMIT {$start},{$pageSize}";
    	}
    	
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
    /**
     * 删除指标
     * 
     * @param unknown_type $ids
     */
    public function deleteQuotas($ids)
    {
    	$quotaids = implode(',', $ids);
    	$sql = "DELETE FROM `quota` WHERE `quotaid` IN ({$quotaids})";
    	$res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }
    
    /**
     * 更新指标
     * 
     * @param $quotaid
     * @param $quotaname
     * @param $quotacontent
     * @param $qcid
     */
    public function updateQuota($quotaid, $quotaname, $quotacontent, $qcid)
    {
    	$sql = "UPDATE `quota` SET `quotaname`='{$quotaname}',`quotacontent`='{$quotacontent}',`qcid`={$qcid}
    			WHERE `quotaid`={$quotaid}";
    	$res = self::$db_app->query($sql);
        
        return $res ? true : false;
    }

	/**
	 * 获取表分类下的最新一条指标
	 * @param string $classid 表分类id
	 * @return array $result
	 */
	public function getQuotaByclassId($classid)
	{
		if (!$classid || (is_numeric($classid) == false)) {
			return false;
		}
		/*
		$sql  = "SELECT q.`quotaid`,q.`quotaname`,q.`qcid`,q.`quotacontent`,c.`classid` FROM `quota` as q, `quota_class` as c";
		$sql .= " WHERE q.`qcid`=c.`qcid` and c.`classid`=" . $classid . " order by q.`quotaid` desc ";
		$result = self::$db_app->getOne($sql);
    	return $result;
    	*/
		
		$sql = "SELECT q.`quotaid`,q.`quotaname`,q.`qcid`,q.`quotacontent` FROM `quota` AS q 
				LEFT JOIN `quota_class` AS c ON q.`qcid` = c.`qcid` 
				WHERE c.`classid` = {$classid} 
				ORDER BY q.`quotaid` DESC";
		$result = self::$db_app->getOne($sql);
    	return $result;
	}
	
	/**
	 * 获取数据
	 * @param unknown_type $tableName
	 * @param unknown_type $fields
	 */
	public function getDataByFields($tableName,$fields)
	{
		$sql = "SELECT $fields FROM `$tableName`";
		$result = self::$db_material->getAll($sql);
		
		return $result;
	}
	
	/**
	 * 获取字段属性
	 * @param array $tableIds
	 * @param array $fieldNames
	 */
	public function getQuotaFields($tableIds,$fieldNames)
	{
		$tableIds   = implode(',', $tableIds);
		$fields = "";
		foreach ($fieldNames as $fieldName) {
			$fields .= "'$fieldName',";
		}
		$fields = substr($fields, 0, strlen($fields)-1);
		
		$sql = "SELECT * FROM `material_fields_attr`
				WHERE `tid` IN({$tableIds}) AND `fname` IN({$fields})";
		$result = self::$db_app->getAll($sql);
    	
		return $result;
	}

	
	/**
	 * 获取最新的前8条指标
	 * date:2013-12-10
	 */
	public function getLatestQuotas()
	{
    	$sql = "SELECT q.`quotaid`,q.`quotaname`,qc.classid FROM `quota` as q INNER JOIN `quota_class` AS qc ON q.`qcid` = qc.`qcid` ORDER BY q.`quotaid` DESC LIMIT 8";
    	$res = self::$db_app->getAll($sql);
    	return $res;
	}

	/**
	 * 获取快速查询中(月度/季度/年度)的指标数据
	 */
	public function quotaRecords()
	{
		$sql  = "SELECT q.`quotaid`,q.`quotaname`,q.`qcid`,q.`quotacontent`,c.`classid` FROM `quota` as q, `quota_class` as c";
		$sql .= " WHERE q.`qcid`=c.`qcid` and c.`classid` IN(1,2,3) order by c.`classid` asc ";
		$result = self::$db_app->getAll($sql);
		$quotaRecordsArr = array(
			'0' => array(),
			'1' => array(),
			'2' => array()
		);
		if ($result) {
			foreach ($result as $val) {
				if ($val['classid'] == 1) {
					$quotaRecordsArr['0'][] = $val;
				} else if ($val['classid'] == 2) {
					$quotaRecordsArr['1'][] = $val;
				} else if ($val['classid'] == 3) {
					$quotaRecordsArr['2'][] = $val;
				}
			}
		}
		return $quotaRecordsArr;
	}

	/**
	 * 根据查询字段查询对应指标信息
	 * @param string $field 查询字段
	 * @param string $quotaid 指标id
	 * @param string $tid 表id
	 * @return array $quotaArr; //返回指标数组
	 */
	public function getQuotasByField($field,$quotaid = 0,$tid = 0)
	{
		$quotaArr   = array();
		$tablesArr  = array();
		$recordsArr = array();
		if (empty($field)) {
			return false;
		}
		$sql = "SELECT f.`fname`,f.`fcomment`,f.`tid`,q.`quotaid`,q.`quotaname`,q.`qcid` FROM `material_fields_attr` AS f INNER JOIN quota AS q 
				ON INSTR(q.quotacontent,f.fname) > 0  
				WHERE f.`fcomment` LIKE '%" . trim($field) . "%'";
		$result = self::$db_app->getAll($sql);
		if (!$result) {
			return array();
		} else {
			foreach ($result as $key => $val) {
				$quotaRecordArr[$val['quotaid']]['quotaname'] = $val['quotaname'];
				$quotaRecordArr[$val['quotaid']]['qcid']      = $val['qcid'];
				$quotaRecordArr[$val['quotaid']]['tableinfo'][$val['tid']][$val['fname']] = $val;
			}
			foreach ($quotaRecordArr as $key => $val) {
				$query = "SELECT q.`qcname`,c.`class_name` FROM `quota_class` AS q INNER JOIN `material_table_class` AS c 
				         ON q.`classid` = c.`classid` 
						 WHERE q.`qcid` = " . $val['qcid'];
				$quotaClassRecord = self::$db_app->getOne($query);
				$val['qcname']    = $quotaClassRecord['qcname'];
				$val['classname'] = $quotaClassRecord['class_name'];
				$quotaArr[$key]   = $val;
			}
		}
		if (empty($quotaArr)) {
			return array();
		}
		if ($quotaid == 0) {
			return $quotaArr;
		} else if ($quotaid && $tid ==0) {
			return $quotaArr[$quotaid];
		} else if ($quotaid && $tid) {
			return $quotaArr[$quotaid]['tableinfo'][$tid];
		} 
	}

	/**
	 * 获取最新指标下对应的字段(搜索栏显示字段)
	 * @return array $fieldsArr 返回指标下对应的字段信息数组
	 */
	public function getFieldsByQuota()
	{
		$sql			= "SELECT `quotacontent` FROM `quota` ORDER BY `quotaid` DESC LIMIT 1";	
		$quotaRecord    = self::$db_app->getOne($sql);
		$quotaArr       = unserialize($quotaRecord['quotacontent']);
		$tidArr         = array_keys($quotaArr);
		foreach ($quotaArr as $key => $val) {
			foreach ($val as $v) {
				$fnameArr[] = $v;
			}
		}
		$fieldsArr = $this->getQuotaFields($tidArr,array_unique($fnameArr));
		return array_slice($fieldsArr,0,3);
	}
}