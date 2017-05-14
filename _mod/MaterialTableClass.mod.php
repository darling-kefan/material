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
class MaterialTableClassModel extends BaseModel
{
    public $table;
    
    //初始化表名
    public function init()
    {
        $this->table = "{$this->dbpre}material_table_class";
    }
    
	/**
     * 添加原料表分类
     */
    public function addTableClass($class_name,$parentid,$csort=1)
    {
        self::$db_app->beginTransaction();
        
        //将接收到的数据插入到数据库
    	$sql = "INSERT INTO `{$this->table}`(`class_name`,`ancestors`,`parentid`,`csort`) 
        		VALUES('{$class_name}','',{$parentid},{$csort})";
        $result1 = self::$db_app->exec($sql);
        
        //获取最新插入的ID
        $newid = self::$db_app->insertId();
        
        //更新路径
    	if (empty($parentid)) {//顶级分类
        	$ancestors = "0,".$newid;
        } else {//非顶级分类
	    	$sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `classid`={$parentid}";
	        $result = self::$db_app->getOne($sql);
	        $ancestors = $result['ancestors'].",".$newid;
        }
        
        $query = "UPDATE `{$this->table}` SET `ancestors`='{$ancestors}'
        		  WHERE `classid`={$newid}";
        $result2 = self::$db_app->exec($query);
        
        if ($result1 && $result2) {
			self::$db_app->commit();
			$result = true;
        } else {
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
        
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
    	$sql  = "SELECT `ancestors` FROM `$this->table` 
        		 WHERE `classid` = {$classid}";
        $res1 = self::$db_app->getOne($sql);
        
        $classids = substr($res1['ancestors'], 2, strlen($res1['ancestors'])-2);
        
        if (!empty($classids)) {
        	$query = "SELECT `class_name` FROM `$this->table` 
        		  	  WHERE `classid` IN({$classids})";
        	$res2 = self::$db_app->getAll($query);

        	foreach ($res2 as $class_name) {
        		if (empty($result)) {
        			$result = $class_name['class_name'];
        		} else {
        			$result = $result."/".$class_name['class_name'];
        		}
        	}
        }
        
        return $result;
    }
    
    
    /**
     * 更新分类表记录信息
     */
    public function editTableClass($classid,$class_name,$parentid,$csort) {
        
        //获取新父节点分类路径
        $sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `classid`={$parentid}";
        $res = self::$db_app->getOne($sql);
        $newAncestors = $res['ancestors'].",".$classid;
        
        //获取该节点原始分类路径
        $sql = "SELECT `class_name`,`parentid`,`ancestors`,`csort` FROM `{$this->table}` WHERE `classid`={$classid}";
        $res = self::$db_app->getOne($sql);
        $oldAncestors = $res['ancestors'];
        $oldclass_name = $res['class_name'];
        $oldparentid = $res['parentid'];
        $oldcsort = $res['csort'];
        
        self::$db_app->beginTransaction();
        
        if ($class_name == $oldclass_name && $parentid == $oldparentid && $oldcsort == $csort) {
        	$result1 = true;
        } else {
	        //更新该分类
	    	$sql = "UPDATE `$this->table` SET 
	    			`class_name`='{$class_name}', `parentid`={$parentid}, `csort`={$csort} 
	        		WHERE `classid` = {$classid}";
	        $result1 = self::$db_app->exec($sql);
        }
        
        if ($oldAncestors == $newAncestors) {
        	$result2 = true;
        } else {
	        //更新该分类下的子分类
	        $sql = "UPDATE `$this->table` SET
	        		`ancestors` = REPLACE(`ancestors`,'{$oldAncestors}','{$newAncestors}') 
	        		WHERE 1";
	        $result2 = self::$db_app->exec($sql);
        }
        
        if ($result1 && $result2) {
			self::$db_app->commit();
			$result = true;
        } else {
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }
    
	/**
     * 根据classid获取分类信息
     */
    public function deleteTableClass($classid)
    {
        $sql = "SELECT `ancestors` FROM `$this->table` WHERE `classid` = {$classid}";
        $res = self::$db_app->getOne($sql);
        $ancestors = $res['ancestors'];

        self::$db_app->beginTransaction();
        
        //删除该分类
    	$sql = "DELETE FROM `$this->table` WHERE `classid` = {$classid}";
        $result1 = self::$db_app->exec($sql);
        
        //确认该分类下是否有子类
        $sql = "SELECT * FROM `$this->table` WHERE `parentid` = {$classid}";
        $res1 = self::$db_app->getAll($sql);
        
        if (!empty($res1)) {
	        //删除该分类下的所有子分类
	        $sql = "DELETE FROM `$this->table` 
	        		WHERE `ancestors` like '{$ancestors}%'";
	        $result2 = self::$db_app->exec($sql);
        } else {
        	$result2 = true;
        }
        
        if ($result1 && $result2) {
			self::$db_app->commit();
			$result = true;
        } else {
			self::$db_app->rollBack();
			$result = false;
        }
        
        return $result;     
    }

	/**
	 * 获取原料表分类详细信息
	 */
	public function getTableClassInfo($parentid=0)
    {
        $sql = "SELECT `classid`, `class_name`, `parentid`, `ancestors`, `csort` 
        		FROM `$this->table` where parentid=" . $parentid;
        $result = self::$db_app->getAll($sql);
		$tableArr = array();
		foreach ($result as $val) {
			$tableArr[$val['classid']] = $val;
			$record = $this->getTableClassInfo($val['classid']);
			if (count($record) > 0) {
				$tableArr[$val['classid']]['item'] = $record;
			}
			
		}
        return $tableArr;
    }

	/**
	 * 获取快速查询中(月度/季度/年度)的指标数据
	 */
	public function quotaRecords()
	{
		$sql  = "SELECT q.`quotaid`,q.`quotaname`,q.`qcid`,q.`quotacontent`,c.`classid` FROM `quota` as q, `quota_class` as c";
		$sql .= " WHERE q.`qcid`=c.`qcid` and c.`classid` IN(1,2,6) order by c.`classid` asc ";
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
				} else if ($val['classid'] == 6) {
					$quotaRecordsArr['2'][] = $val;
				}
			}
		}
		return $quotaRecordsArr;
	}
}