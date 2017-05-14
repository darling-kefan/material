<?php
/**
 * 用户功能模块
 *
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 用户管理模型。
 *
 */
class UserModel extends BaseModelEx
{

    public function init()
    {
        $this->table   = APP_DBPREFIX.'u_user';
        $this->primary = 'uid';
    }

    
     /*
	 * 用户登入验证
	 *
	 * @param string $passport 用户账号
     * $param string $password 用户密码
     *
     * @return array 用户信息
	 */
	public function userLogin($passport, $password, $loginIP = '')
	{
		if (!$loginIP) {
			$loginIP =  $_SERVER["REMOTE_ADDR"];
		}
		$sql = "SELECT `uid`,`uname`,`gid`,`passwd`,`operate_tables`,`truename`,`uemail`,`wether_to_enable`,`login_count`,`last_login_time`,`last_login_ip` 
        		FROM `" . $this->table ."` WHERE `uname`='{$passport}'";
       
        $result = self::$db_app->getOne($sql); 
        $returnArr = array();
        $passwd = md5($passport.$password);
        if(!$result){
            $returnArr['Result'] = 'LoginName_NotExist';
        }elseif($result['wether_to_enable'] != 1){//1表示账号启用，0表示账号禁止
        	$returnArr['Result'] = 'LoginName_Disabled';
        }elseif($passwd != $result['passwd']){
            $returnArr['Result'] = 'Password_Error';
        }else{
            //登入成功修改用户表最后一次登入时间、登入IP及登录次数            
            $sql = "UPDATE `" . $this->table . "` SET `login_count`=`login_count`+1,`last_login_time`=now(),`last_login_ip`='{$loginIP}' 
            		WHERE `uid`= {$result['uid']}";
            self::$db_app->query($sql);
            
            //为非超级管理员用户赋予权限
            $authArray = '';   
            //实例化用户类型数据模型            	       
    		$userType = &$this->getModel('userType');
    		//根据用户ID获得用户权限以及用户类型列表
	        $authArray = $userType->getUserTypeInfo($result['gid']);

	        //输出数据
        	$returnArr['uid'] = $result['uid'];
			$returnArr['uname'] = $result['uname'];
        	$returnArr['gid']   = $result['gid'];
        	$returnArr['gname'] = $authArray['gname'];
        	$returnArr['operate_tables'] = $result['operate_tables'];
            $returnArr['truename'] = $result['truename'];
            $returnArr['uemail'] = $result['uemail'];
            $returnArr['login_count'] = $result['login_count'];
            $returnArr['last_login_time'] = $result['last_login_time'];
            $returnArr['last_login_ip'] = $result['last_login_ip'];
            $returnArr['Result'] = 'Login_Success';
            $returnArr['auth'] = $authArray['Auth'];
        }
        return $returnArr;
	}
	
	/*
	 * 增加登陆次数
	 * 
	 */
	public  function addLoginCount($userID)
	{
		$sql = "UPDATE `" . $this->table . "` SET `longinCount` = longinCount+1 WHERE `UserID` = '{$userID}'";
		self::$db->query($sql);
	}

	/**
	 * 添加用户
	 * @param array $dataArr
	 * @return int or false
	 */
	public function insertUser($dataArr)
	{
		$status = self::$db_app->filtInsert($this->table,$dataArr);
		return $status;
	}

	/**
	 * 更新用户
	 * @param array $dataArr
	 * @return int or false
	 */
	public function updateUser($dataArr,$uid)
	{
		$condition =  $this->primary .'=' . $uid;
		$status = self::$db_app->filtUpdate($this->table,$dataArr,$condition);
		return $status;
	}

	/**
	 * 删除用户
	 * @param int $uid
	 * @param int $type
	 * return int|false
	 */
	public function delUser($uid,$type = 0)
	{
		if ($type == 0) {
			$condition =  $this->primary . '=' . intval($uid);
		} else { //删除多条
			$uidStr = join(',',$uid);
			$condition =  $this->primary . ' In (' . $uidStr . ')';
		}
		$state = self::$db_app->delete($this->table,$condition);
		return $state;
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
    public function getList($select = "*", $condition = 1, $first = 0, $limit = 0, $orderby = "ORDER BY `uid` DESC", $usePrimaryAsKey = true)
    {
        return parent::getList($select, $condition, $first, $limit, $orderby, $usePrimaryAsKey);
    }
    

	
    /*
	 * 检查用户名是否存在
	 *
	 * @param string $username
     *
     * @return bool
	 */
	public function checkUsername($username)
	{
        $sql = "SELECT `uid` FROM  " . $this->table . " WHERE `uname` = '{$username}'";
        $result = self::$db_app->getOne($sql);
		if ($result) {
			return false;
		} else {
			return true;
		}
	}
	
	/*
	 * 检查用户名是否存在，成功返回用户ID，失败返回false
	 *
	 * @param string $username
     *
     * @return bool
	 */
	public function checkUser($username)
	{
        $sql = "SELECT `uid` FROM  " . $this->table . " WHERE `uname` = '{$username}'";
        $result = self::$db_app->getOne($sql);
		if ($result) {
			return $result['uid'];
		} else {
			return false;
		}
	}
	
	/**
	 * 根据用户ID字符串获得用户名称
	 * @param sring  $userIDStr
	 * @return array 
	 */
	public function getUserNameByUserIDStr($userIDStr )
	{
	    $sql = "SELECT `UserID`, `Passport` FROM  `{$this->table}` WHERE `UserID` IN ({$userIDStr})";
	    $result = self::$db->query($sql);
	    while($arr = self::$db->fetchAssoc($result)){
	        $userArr[$arr['UserID']] = $arr['Passport'];
	    }	
	    return $userArr;
	}
	
	/**
	 * 根据用户ID查询用户相关
	 * @todo edit by sqtang
	 */
	public function getUserInfoByUserID($userID)
	{
	    $sql  = "SELECT `uid`,`uname`,`gid`,`passwd`,`operate_tables`,`truename`,`uemail`,`wether_to_enable`,`login_count`,";
		$sql .= "`last_login_time`,`last_login_ip`,`create_time` FROM `" . $this->table . "` WHERE `uid` = {$userID}";
	    $res =  self::$db_app->getOne($sql);
	    return $res;
	}
	
	/**
	 * 
	 * @param array $userIds
	 */
	public function getUserNames($userIds)
	{
		$idStr = implode(',', $userIds);
		$sql  = "SELECT `uid`,`uname`,`gid`,`passwd`,`operate_tables`,`truename`,`uemail`,`wether_to_enable`,`login_count`,";
		$sql .= "`last_login_time`,`last_login_ip`,`create_time` FROM `" . $this->table . "` WHERE `uid` IN({$idStr})";
	    $res =  self::$db_app->getAll($sql);
	    
	    $result = array();
	    if (!empty($res)) {
		    foreach ($res as $item) {
		    	$uid = $item['uid'];
		    	$result[$uid] = $item;
		    }
	    }
	    return $result;
	}

}
?>