<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 角色管理
 *
 * @author  wh
 * 
 */
class RoleApp extends BaseAppEx
{
    private $group; //角色
	private $authlist; //权限配置文档
	private $userSession; //用户session
	private $operateLog; //操作日志model
    
    /**
     * 初始化操作。
     */
    public function init()
    {
		include(ROOT_PATH.'/_cfg/authSpecify.inc.php');
		$this->authlist    = $_AuthSpecify;
		$this->userSession =  &self::$ses->get('user');
		$this->operateLog  = &$this->getModel('operatelog');
		$this->group = &$this->getModel('userType');
    }

	/**
	 * 角色列表管理
	 *
	 */
	public function getRoleList()
	{
		global $pageArr,$searchType;
		$hasEdit = 0; //是否有编辑权限
		$hasDel  = 0; //是否有删除权限
		$hasAdd  = 0; //是否有添加权限
		$currentGid  = $this->userSession['gid'];
		$authArr     = $this->userSession['auth']['operates'][strtolower($this->app)];
		foreach ($authArr as $key => $val) {
			foreach ($val as $v) {
			 $operateArr[$key][$v['type']] = 1;
			}
		}
		if ($operateArr[0]['update'] || $operateArr[2]['update']) {
			$hasEdit = 1;
		}

		if ($operateArr[0]['del'] || $operateArr[2]['del']) {
			$hasDel = 1;
		}

		if ($operateArr[1]['add'] || $operateArr[2]['add']) {
			$hasAdd = 1;
		}

		if ($currentGid == 1) { //如果是管理员的话拥有全部权限
			$hasEdit = 1;
			$hasDel  = 1;
			$hasAdd  = 1;
		}

		
		$pageSize = PERPAGE; //定义每页显示条数
		if (trim($_GET['pageSize'])) {
			$pageSize = trim($_GET['pageSize']);
		}

		$curPage = intval($_GET['pageNumber']);
		if($curPage > 1){
			$start = ($curPage-1)*$pageSize;
		}else{
			$start = 0;
		}

		$condition       = 1;
		$orderProperty   =  strAddSlashes($_GET['orderProperty']); //排序字段
		$orderDirection  =  strAddSlashes($_GET['orderDirection']); //asc or descsearchProperty
		$searchProperty  =  strAddSlashes($_GET['searchProperty']); //搜索类型
		$searchValue	 =  strAddSlashes($_GET['searchValue']); //搜索值

		if (!$orderProperty) {
			$orderby = 'ORDER BY gid DESC';
		} else {
			$orderby = 'ORDER BY ' . $orderProperty . ' ' . $orderDirection;
		}

		if ($searchProperty && $searchValue) {
			$condition = $searchProperty . ' LIKE\'%' . $searchValue . '%\'';
		}

		$count	  = $this->group->getCount($condition); //列表信息条数
		$list	  = $this->group->getList('*',$condition,$start,$pageSize,$orderby,false);
		$this->assigns(array(
			'rolelist'		 => $list,
			'total_num'		 => $count,
			'orderProperty'  => $orderProperty,
			'orderDirection' => $orderDirection,
			'searchType'     => $searchType[strtolower($this->app)],
			'searchProperty' => $searchProperty,
			'searchValue'    => $searchValue,
			'pageSize'		 => $pageSize,
			'pageArr'		 => $pageArr,
			'pageStr'        => showPage($count,$pageSize),
			'hasAdd'         => $hasAdd,
			'hasDel'         => $hasDel,
			'hasEdit'        => $hasEdit
        ));
		$this->setTplHtml('_role/getRoleList');
		$this->display();
	}


	/**
	 * 增加角色 - 视图
	 *
	 */
	public function viewAddRole()
	{
		$modulelist = array(); //显示操作的模块
		$actList	= array(); //显示可操作的权限
		foreach ($this->authlist as $val) {
			$modulelist[$val['id']]['id'] = $val['name']; 
			foreach ($val['items'] as $id => $items) {
				$modulelist[$val['id']]['modules'][] = array('id' => $items['id'], 'name' => $items['name']); 
				if (!$items['opreates']) {
					continue;
				}
				$actList[$items['id']] = array('name' => $items['name'], 'pid' => $val['id'], 'operates' => $items['opreates']);
			}
		}
		$this->assigns(array(
			'groupinfo'  => $groupInfo,
			'modulelist' => $modulelist,
			'aclList'	 => $actList
		));
		$this->setTplHtml('_role/viewAddRole');
		$this->display();
	}

	/**
	 * 添加角色 - 逻辑
	 *
	 */
	public function addRole()
	{
		$authStr     = ''; //权限字符串  
		$name		 = strAddSlashes($_POST['name']);
		$description = strAddSlashes($_POST['description']);
		if (isset($_POST['authorities'])) { //如果有权限设置
			$authStr = $this->convertJson($_POST['authorities']);
		}
		$row = array(
			'gname'		   => $name,
			'is_buildin'   => 0,
			'power'		   => $authStr,
			'gdescription' => $description
		);
		$status  = $this->group->insertGroup($row);
		$tipInfo = $status ? '添加角色成功!' : '添加角色失败!';

		//添加操作日志
		$uid       = $this->userSession['uid'];
		$uname     = $this->userSession['uname'];
		$groupid   = $this->userSession['gid'];
		$event     = '用户' . $uname . $tipInfo . ',角色名称为:' . $name;
		$etype     = 1;
		$tableName = APP_DBPREFIX . 'u_group';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$uname,$groupid,$event,$etype,$tableName,$dbName);

		$jumpUrl = '?app=role&act=getRoleList';
		if ($status) {
			$this->headShow(0,$tipInfo,$jumpUrl);
		} else {
			$this->headShow(1,$tipInfo,$jumpUrl);
		}
		exit;
	}

	/**
	 * 编辑角色 - 视图
	 *
	 */
	public function viewEditRole()
	{
		$modulelist    = array(); //显示操作的模块
		$actList	   = array(); //显示可操作的权限
		$groupInfo     = array(); //组信息
		$groupLeftMenu = array(); //角色拥有的左边菜单
		$groupOperate  = array(); //角色拥有的操作菜单
		if (isset($_GET['gid'])) {
			$gid = $_GET['gid'];
			if (!is_numeric($gid)) {
				return false;
			}
			$gid = intval(trim($gid));
			$groupInfo = $this->group->fetchRowByGid('*',$gid);
			if (trim($groupInfo['power'])) {
				$power     = unserialize($groupInfo['power']);
				foreach ($power as $val) {
					foreach ($val['items'] as $item) {
						$groupLeftMenu[] = $item['id'];
						if (isset($item['opreates']) && $item['opreates']) { //如果有操作权限
							foreach ($item['opreates'] as $op) {
								$groupOperate[ $item['id']][] = $op['type'];
							}
						}
					}
				}
			}
		}

		//status表示是否选中和禁用 1 选中 0 未选中
		foreach ($this->authlist as $val) { //遍历权限配置文件
			$modulelist[$val['id']]['id'] = $val['name']; 
			foreach ($val['items'] as $id => $items) {
				$moduleState  = 0;
				if (in_array($items['id'],$groupLeftMenu)) {
					$moduleState = 1;
				}
				$modulelist[$val['id']]['modules'][] = array('id' => $items['id'], 'name' => $items['name'], 'status' => $moduleState); 	
				if ($items['opreates']) {
					$opArr = array();
					foreach ($items['opreates'] as $ik => $op) {
						$operateState = 0;
						$baseArr = $groupOperate[$items['id']];
						if ($baseArr && in_array($op['type'],$baseArr)) {
							$operateState = 1;
						}
						$op['status'] = $operateState;
						$opArr[] = $op;
					}
					$actList[$items['id']] = array('name' => $items['name'], 'pid' => $val['id'], 'operates' => $opArr, 'status' => 2);	
				}	
			}
		}

		$this->assigns(array(
			'groupinfo'  => $groupInfo,
			'modulelist' => $modulelist,
			'aclList'	 => $actList
		));
		$this->setTplHtml('_role/viewEditRole');
		$this->display();
	}

	/**
	 * 编辑角色 - 逻辑
	 *
	 */
	public function editRole()
	{
		$authStr     = ''; //权限字符串  
		$name		 = strAddSlashes($_POST['name']);
		$description = strAddSlashes($_POST['description']);
		$gid		 = intval($_POST['gid']);
		if (isset($_POST['authorities'])) { //如果有权限设置
			$authStr = $this->convertJson($_POST['authorities']);
		}
		$row = array(
			'gname'		   => $name,
			'power'		   => $authStr,
			'gdescription' => $description
		);

		$status  = $this->group->updateGroup($row,$gid);
		$tipInfo = '编辑角色成功!' ;

		//添加操作日志
		$uid       = $this->userSession['uid'];
		$uname     = $this->userSession['uname'];
		$groupid   = $this->userSession['gid'];
		$event     = '用户' . $uname . $tipInfo . ',角色id为:' . $gid;
		$etype     = 2;
		$tableName = APP_DBPREFIX . 'u_group';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$uname,$groupid ,$event,$etype,$tableName,$dbName);

		$jumpUrl = '?app=role&act=getRoleList';
		$this->headShow(0,$tipInfo,$jumpUrl);
		exit;
	}


	/**
	 * 删除角色
	 *
	 */
	public function delRole()
	{
		$gid    = strAddSlashes($_POST['gid']);
		$state  = intval($this->group->delRole($gid));
		switch($state) {
			case 1:
				$type    = 'success';
				$content = '删除角色成功！';
				break;
			case -1:
				$type    = 'warn';
				$content = '该角色下还用用户，不能删除!';
				break;
			case 0:
				$type    = 'error';
				$content = '删除角色失败！';
				break;
		}

		//添加操作日志
		$uid       = $this->userSession['uid'];
		$uname     = $this->userSession['uname'];
		$groupid   = $this->userSession['gid'];
		$event     = '用户' . $uname .$content . ',角色id为:' . $gid;
		$etype     = 3;
		$tableName = APP_DBPREFIX . 'u_group';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$uname,$groupid,$event,$etype,$tableName,$dbName);

		$row = array('type' => $type, 'content' => $content);
		echo json_encode($row);
	}


	/**
	 * 将提交过来的权限转换成类似权限配置文件中的数组形式,并序列化
	 *
	 */
	private function convertJson($postData)
	{
		$authStr	= '';
		$authConfig = $this->authlist;
		$groupAuth  = array(); //角色权限
		$autharr	= $postData;
		$firstLevel = array_keys($autharr);
		foreach ($authConfig as $val) {
			$groupitem = array();
			if (in_array($val['id'],$firstLevel)) {
				$firstKey			= $val['id'];
				$groupitem['id']	= $val['id'];
				$groupitem['name']  = $val['name'];
				$groupitem['title'] = $val['title'];
				$secondLevel		= array_keys($autharr[$firstKey]); 
				foreach ($val['items'] as $item) {
					$operate = array();
					if (in_array($item['id'],$secondLevel)) { //如果权限在配置文档的第二层中则取得
						$secondKey		 = $item['id'];
						$operate['id']   = $item['id'];
						$operate['name'] = $item['name'];
						$operate['url']  = $item['url'];
						$operate['app']  = $item['app'];
						$operate['relevantActs'] = $item['relevantActs'];
						if (is_array($autharr[$firstKey][$secondKey])) { //如果是数组则说明有operate权限
							$thirdLevel = array_keys($autharr[$firstKey][$secondKey]); //取得组权限
							foreach ($item['opreates'] as $op) {
								if (in_array($op['type'],$thirdLevel)) {
									$operate['opreates'][] = $op;
								}
							}
						} else { //则说明只有操作顶部导航和右侧导航的权限
							$operate['opreates'] = array();
						}
						$groupitem['items'][] = $operate;
					}
				}
				$groupAuth[] = $groupitem;
			}
		}
		$authStr = serialize($groupAuth);
		return $authStr;	
	}

}
?>
