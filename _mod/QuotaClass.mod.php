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
class QuotaClassModel extends BaseModel
{
    public $table;
    
    //初始化表名
    public function init()
    {
        $this->table = "{$this->dbpre}quota_class";
    }
    
    /**
     * 获取所有指标分类
     */
    public function getAllQuotaClass()
    {
    	$sql = "SELECT `qcid`,`qcname`,`parentid`,`ancestors`,`classid`,`qsort` FROM `{$this->table}`";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
    /**
     * 根据classid获取指标分类
     */
    public function getQuotaClassByClassID($classid)
    {
    	$sql = "SELECT `qcid`,`qcname`,`parentid`,`ancestors`,`classid`,`qsort` FROM `{$this->table}`
    			WHERE `classid`={$classid}";
    	$res = self::$db_app->getAll($sql);
    	
    	return $res;
    }
    
    /**
     * 根据指标类别ID，获取指标分类相关信息
     */
    public function getQuotaClassByqcid($qcid)
    {
    	$sql = "SELECT `qcid`,`qcname`,`parentid`,`ancestors`,`classid`,`qsort` FROM `{$this->table}`
    			WHERE `qcid`={$qcid}";
    	$res = self::$db_app->getOne($sql);
    	
    	return $res;
    }
    
    /**
     * 添加指标分类
     */
    public function addQuotaType( $name, $quotaParentID, $classifyID, $order )
    {
    	self::$db_app->beginTransaction();
    	
    	$sql = "INSERT INTO `{$this->table}`(`qcname`,`parentid`,`ancestors`,`classid`,`qsort`) 
    			VALUES('{$name}',{$quotaParentID},'',{$classifyID},{$order})";	
    	$result1 = self::$db_app->exec($sql);
    	
    	//获取最新插入的ID
        $newid = self::$db_app->insertId();
        
        //更新路径
    	if (empty($quotaParentID)) {//顶级分类
        	$ancestors = "0,".$newid;
        } else {//非顶级分类
	    	$sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `qcid`={$quotaParentID}";
	        $result = self::$db_app->getOne($sql);
	        $ancestors = $result['ancestors'].",".$newid;
        }
        
        $query = "UPDATE `{$this->table}` SET `ancestors`='{$ancestors}'
        		  WHERE `qcid`={$newid}";
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
     * 更新指标分类
     */
    public function editQuotaType($qcid, $name, $quotaParentID, $classifyID, $order) {	
        
        //获取新父节点分类路径
        $sql = "SELECT `ancestors` FROM `{$this->table}` WHERE `qcid`={$quotaParentID}";
        $res = self::$db_app->getOne($sql);
        $newAncestors = $res['ancestors'].",".$qcid;
        
        //获取该节点原始分类路径
        $sql = "SELECT `qcname`,`parentid`,`ancestors`,`classid`,`qsort` FROM `{$this->table}` WHERE `qcid`={$qcid}";
        $res = self::$db_app->getOne($sql);
        $oldAncestors = $res['ancestors'];
        $oldqcname = $res['qcname'];
        $oldparentid = $res['parentid'];
        $oldclassid = $res['classid'];
        $oldqsort = $res['qsort'];

        self::$db_app->beginTransaction();
        
        if ($oldqcname == $name && $oldparentid == $quotaParentID && $oldclassid == $classifyID && $oldqsort == $order) {
        	$result1 = true;
        } else {
	        //更新该分类
	    	$sql = "UPDATE `{$this->table}` SET 
	    			`qcname`='{$name}', `parentid`={$quotaParentID}, `classid`={$classifyID}, `qsort`={$order}  
	        		WHERE `qcid` = {$qcid}";
	        $result1 = self::$db_app->exec($sql);
        }
        
        if ($newAncestors !== $oldAncestors) {
	        //更新该分类下的子分类
	        $sql = "UPDATE `$this->table` SET
	        		`ancestors` = REPLACE(`ancestors`,'{$oldAncestors}','{$newAncestors}') 
	        		WHERE 1";
	        $result2 = self::$db_app->exec($sql);
        } else {//不更新
        	$result2 = true;
        }

        var_dump($result1);
        var_dump($result2);
        
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
     * 删除指标分类
     */
    public function deleteQuotaClass($qcid)
    {
        $sql = "SELECT `ancestors` FROM `$this->table` WHERE `qcid` = {$qcid}";
        $res = self::$db_app->getOne($sql);
        $ancestors = $res['ancestors'];

        self::$db_app->beginTransaction();
        
        //删除该分类
    	$sql = "DELETE FROM `$this->table` WHERE `qcid` = {$qcid}";
        $result1 = self::$db_app->exec($sql);
        
        //确认该分类下是否有子类
        $sql = "SELECT * FROM `$this->table` WHERE `parentid` = {$qcid}";
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
	 * 获取指标层次关系
	 * @param int $classid 表分类id
	 * @param int $qcid 指标分类id
	 * @return array $quotaClassArr || false 
	 */
	public function getNodes($classid,$qcid)
	{
		if (!$classid && !$qcid) {
			return false;
		}
		$sql = "SELECT `qcid` as id,`qcname` as name,parentid as pId,`classid` FROM `{$this->table}` WHERE `classid`={$classid}";
    	$res = self::$db_app->getAll($sql);
		foreach ($res as $val) {
			$record = self::$db_app->getOne("SELECT COUNT(`qcid`) as num FROM `{$this->table}` WHERE `parentid`=" . $val['id']);
			if ($record['num']) {
				$haschild = true;
			} else {
				$haschild = false;
			}
			$val['isParent'] = $haschild;
			$val['icon']     = '';
			$val['url']		 = 'index.php?app=classification&classid=' . $classid;
			$val['target']	 = '_self';
			$val['open']     = true;
			$quotaClassArr[] = $val;
		}
		$quotaArr = $this->createMenuTree($quotaClassArr);
		return $quotaArr;
	}

	/**
	* 生成菜单
	*
	* @param array $data 原始数据
	* @param integer $pid 当前分类的父id
	* @return array 处理后数据
	*/
	public function createMenuTree($data = array(), $pid = 0)
	{
	    if (empty($data))
	    {
	        return array();
	    }
	 
	    static $level = 0;
	 
	    $returnArray = array();
	 
	    foreach ($data as $node)
	    {
	        if ($node['pId'] == $pid)
	        {
				$node['level'] = $level;
				$returnArray[] = $node;
	 
	            if ($this->hasChild($node['id'], $data))
	            {
	                $level++;
	 
	                $returnArray = array_merge($returnArray, $this->createMenuTree($data, $node['id']));
	 
	                $level--;
	            }
	        }
	    }
	 
	    return $returnArray;
	}
	 
	/**
	* 检查是否有子分类
	*
	* @param integer $cid 当前分类的id
	* @param array $data 原始数据
	* @return boolean 是否有子分类
	*/
	public function hasChild($cid, $data)
	{
	    $hasChild = false;
	 
	    foreach ($data as $node)
	    {
	        if ($node['pId'] == $cid)
	        {
	            $hasChild = true;
	            break;
	        }
	    }
	 
	    return $hasChild;
	}
}