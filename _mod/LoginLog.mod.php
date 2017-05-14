<?php
/**
 * 登陆日志模型
 *
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}


class LoginLogModel extends BaseModelEx
{

    public function init()
    {
        $this->table   = APP_DBPREFIX . 'blog_user_login';
        $this->primary = 'bid';
    }

	/**
	 * 插入日志
	 * @param array $dataArr
	 * @return int or false
	 */
	public function insertLog($dataArr)
	{
		$status = self::$db_app->filtInsert($this->table,$dataArr);
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
	 * 删除日志
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