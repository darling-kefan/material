<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 用户类型管理模型。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class UserTypeModel extends BaseModelEx
{
    /**
     * 权限文件路径。
     * @var string
     */
    public $authFilePath     = null;

    public function init()
    {
        $this->table            = APP_DBPREFIX.'u_group';
        $this->primary          = 'gid';
    }
    
    public function getAuthFromXML($authFilePath,$gid)
    {
		if ($gid == 1) {
			include ROOT_PATH.'/_cfg/authSpecify.inc.php';
    		$authInfo = $_AuthSpecify;
		} else {
			$authInfo = unserialize($authFilePath);
		}
    	
    	$authList = array();
    	$authList['topMenu'] = array();
    	$authList['leftMenu'] = array();
    	$authList['operates'] = array();
    	$authList['interfaces'] = array();
		if ($authInfo) {
			foreach ($authInfo as $topInfo) {
				$authList['topMenu'][$topInfo['id']] = $topInfo['name']; //上面导航菜单
				foreach ($topInfo['items'] as $leftInfo) {
					$leftMenu['name'] = $leftInfo['name'];
					$leftMenu['url'] = $leftInfo['url'];
					$authList['leftMenu'][$topInfo['id']]['title'] = $topInfo['name'];
					$authList['leftMenu'][$topInfo['id']]['items'][] = $leftMenu; //左侧导航菜单
					$app  = $leftInfo['app'];
					if (empty($authList['interfaces'][$app])) {
						$authList['interfaces'][$app] = $leftInfo['relevantActs'];
					} else {
						$authList['interfaces'][$app] = array_merge($authList['interfaces'][$app],$leftInfo['relevantActs']);
					}
					if (!empty($leftInfo['opreates'])) {
						foreach ($leftInfo['opreates'] as $operateInfo) {
							if (empty($authList['interfaces'][$app])) {
								$authList['interfaces'][$app] = $operateInfo['relevantActs'];
							} else {
								$authList['interfaces'][$app] = array_merge($authList['interfaces'][$app],$operateInfo['relevantActs']);
							}
							$sign = $operateInfo['sign'];
							if ($operateInfo['type'] != 'updateRecord' && $operateInfo['type'] != 'delRecord') {
								$tmpOperates['name'] = $operateInfo['name'];
								$tmpOperates['url']  = $operateInfo['url'];
								$tmpOperates['type'] = $operateInfo['type'];
								$authList['operates'][$app][$sign][] = $tmpOperates;
							}
						}
					}
				}
			}
		}
    	return $authList;
    }

	/**
	 * 添加角色
	 * @param array $dataArr
	 * @return int or false
	 */
	public function insertGroup($dataArr)
	{
		$status = self::$db_app->filtInsert($this->table,$dataArr);
		return $status;
	}

	/**
	 * 更新角色
	 * @param array $dataArr
	 * @return int or false
	 */
	public function updateGroup($dataArr,$groupid)
	{
		$condition =  $this->primary .'=' . $groupid;
		$status = self::$db_app->filtUpdate($this->table,$dataArr,$condition);
		return $status;
	}

	/**
	 * 删除角色
	 * @param int $id
	 * return int|false
	 */
	public function delRole($id)
	{
		$condition =  $this->primary . '=' . intval($id);
		$result    =  self::$db_app->getOne("SELECT COUNT(*) AS num FROM `". APP_DBPREFIX . "u_user` WHERE " . $condition);
		if ($result['num'] > 1) {
			$state = -1; //角色下有用户不能删除
		} else {
			$state = self::$db_app->delete($this->table,$condition);
		}
		return $state;
	}
	
	/**
	 * 取得组id和name
	 */
	public function fetchGroupName()
	{
		$sql = 'select gid,gname from `' . $this->table;
		$grouplist = self::$db_app->getAll($sql);
		return $grouplist;
	}

	/**
	 * 取得单条组信息
	 * @param int $gid
	 * @param string $select
	 * @return array
	 */
	public function fetchRowByGid($select='*',$gid)
	{
		$condition = $this->primary . '=' . $gid;
		$groupinfo = parent::getOne($select,$condition);
		return $groupinfo;
	}
    
	/**
     * 根据用户ID获得用户权限以及用户类型列表。
     * @param int $userID
     * @return array
     */
    public function getUserTypeInfo($gid)
    {
        $userTypeInfo    = array();
    	$sql = "SELECT `gname`,`auth_config_file`,`power` FROM `" . $this->table . "` WHERE `gid`={$gid}";
    	$res = self::$db_app->getOne($sql);

    	$userTypeInfo['gname'] = $res['gname'];
    	//获取角色权限
    	$authFilePath = $res['power'];
    	$userTypeInfo['Auth'] = $this->getAuthFromXML($authFilePath,$gid);

        return $userTypeInfo;  
    }

	/**
     * 
     * 获得组信息列表。
     * @param string $select
     * @param string $condition
     * @param int    $first
     * @param int    $limit
     * @param string $orderby
     */
    public function getList($select = "*", $condition = 1, $first = 0, $limit = 0, $orderby = "ORDER BY `gid` DESC", $usePrimaryAsKey = true)
    {
        return parent::getList($select, $condition, $first, $limit, $orderby, $usePrimaryAsKey);
    }
    
    
     /**
      * 解析给定的URL字符串，获得app和act字符串
      * @param  string $url
      * @param  string $defaultApp
      * @param  string $defaultAct
      * @return array
      * array(
      *     0 => app
      *     1 => act
      * )
      */
     private function _getAppAndActFromUrl($url, $defaultApp = 'default', $defaultAct = 'index')
     {
         preg_match("/app=([\w]*)/i", $url, $match);
         $app = isset($match[1]) ? $match[1] : $defaultApp;
         preg_match("/act=([\w]*)/i", $url, $match);
         $act = isset($match[1]) ? $match[1] : $defaultAct;
         return array($app, $act);
     }    
}
?>