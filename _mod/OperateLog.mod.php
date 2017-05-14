<?php
/**
 * 操作日志模型
 *
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}


class OperateLogModel extends BaseModelEx
{

    public function init()
    {
        $this->table   = APP_DBPREFIX . 'blog_user_operation';
        $this->primary = 'bid';
    }

	
	/**
	 * 插入日志
	 * @param array $dataArr
	 * @return int or false
	 */
	/*public function insertLog($dataArr)
	{
		$status = self::$db_app->filtInsert($this->table,$dataArr);
		return $status;
	}*/


    /**
	 * 操作日志
	 * @param int $uid 用户id
	 * @param string $uname 用户名
	 * @param int $groupid 角色id
	 * @param string $event 消息
	 * @param int $eventtype 类型
	 * @param string $tableName 操作的表
	 * @param string @dbName 操作的数据库
	 */
	public function insertLog($uid,$uname,$groupid,$event,$eventtype,$tableName,$dbName = 'material')
	{
		$row = array(
			'uid'          => $uid,
			'bname'        => $uname,
			'groupid'      => $groupid,
			'event'        => $event,
			'eventtype'    => $eventtype,
			'table_name'   => $tableName,
			'storage_name' => $dbName
		);
		$status = self::$db_app->filtInsert($this->table,$row);
		return $status;
	}


	/**
     * 
     * 根据条件检索用户列表。
     * @param string $select
     * @param string $condition
     * @param int    $first
     * @param int    $limit
     * @param string $orderby
     */
    public function getList($select = "*", $condition = 1, $first = 0, $limit = 0, $orderby = "ORDER BY `bid` DESC", $usePrimaryAsKey = true)
    {
        return parent::getList($select, $condition, $first, $limit, $orderby, $usePrimaryAsKey);
    }

	/**
	 * 删除操作日志
	 * @param int $bid
	 * @param int $type
	 * return int|false
	 */
	public function delLog($bid,$type = 0)
	{
		if ($type == 0) {
			$condition =  $this->primary . '=' . intval($bid);
		} elseif ($type == 1) { //删除多条
			$bidStr = join(',',$bid);
			$condition =  $this->primary . ' In (' . $bidStr . ')';
		} elseif ($type == 2) { //清空全部
			$condition =  1;
		}
		$state = self::$db_app->delete($this->table,$condition);
		return $state;
	}
}
?>