<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 用户模块
 *
 */
class UserApp extends BaseAppEx
{
    private $user; 
    private $role;
	private $userSession; //用户session
	private $operateLog; //操作日志model
	private $material;   //原料表model

    public function init()
	{
		date_default_timezone_set("PRC");
	    //实例数据模型
        $this->user        = &$this->getModel('user');
		$this->role		   = &$this->getModel('userType');
		$this->userSession = &self::$ses->get('user');
		$this->operateLog  = &$this->getModel('operatelog');
		$this->_material   = &$this->getModel('materialTable');
	}

	/**
	 * 用户管理
	 *
	 */
	public function getUserList()
	{
		global $pageArr,$searchType;
		$hasEdit = 0; //是否有编辑权限
		$hasDel  = 0; //是否有删除权限
		$hasAdd  = 0; //是否有添加权限
		$operateArr = array();
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

		$pageSize   = PERPAGE; //定义每页显示条数
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
			$orderby = 'ORDER BY uid DESC';
		} else {
			$orderby = 'ORDER BY ' . $orderProperty . ' ' . $orderDirection;
		}

		if ($searchProperty && $searchValue) {
			$condition = $searchProperty . ' like\'%' . $searchValue . '%\'';
		}

		$count	  = $this->user->getCount($condition); //列表信息条数
		$list	  = $this->user->getList('*',$condition,$start,$pageSize,$orderby,false);
		$this->assigns(array(
			'userlist'		 => $list,
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
		$this->setTplHtml('_user/userManager');
		$this->display();
	}


	/**
	 * 添加用户 - 视图
	 *
	 */
	public function viewAddUser()
	{
		$roleList  = $this->role->fetchGroupName();
		$tableList = $this->_material->getAllTablesAttr();
		$this->assign('roleList',$roleList);
		$this->assign('tableList',$tableList);
		$this->setTplHtml('_user/viewAddUser');
		$this->display();
	}

	
	/**
	 * 检查用户名是否存在
	 * @param mix $username
	 * @return true | false
	 */
	public function isExistUsername()
	{
		$username = strStripSlashes($_GET['username']);
		$state    = $this->user->checkUsername($username);
		echo json_encode($state);
		exit;
	}

	/**
	 * 添加用户 - 逻辑
	 *
	 */
	public function addUser()
	{
	
		$uname    = trim(strStripSlashes($_POST['username']));
		$gid      = strStripSlashes($_POST['role']);
		$passwd   = trim(strStripSlashes($_POST['password']));
		$truename = trim(strStripSlashes($_POST['truename']));
		$uemail   = trim(strStripSlashes($_POST['email']));
		$state    = strStripSlashes($_POST['isEnabled']) ? 1 : 0;
		$tidArr   = $_POST['tid'];
		$tidStr   = ''; //表id字符串
		if ($tidArr) {
			$tidStr = join(',',$tidArr);
		}

		$row = array(
			'uname'		       => $uname,
			'gid'	           => $gid,
			'create_time'      => date("Y-m-d H:i:s", time()),
			'passwd'	       => md5($uname.md5($passwd)),
			'truename'	       => $truename,
			'uemail'		   => $uemail,
			'wether_to_enable' => $state,
			'operate_tables'   => $tidStr
		);
		$status  = $this->user->insertUser($row);
		$tipInfo = $status ? '添加用户成功!' : '添加用户失败!';

		//添加操作日志
		$uid       = $this->userSession['uid'];
		$name     = $this->userSession['uname'];
		$groupid   = $this->userSession['gid'];
		$event     = '用户' . $name . $tipInfo . ',用户名称为:' . $uname;
		$etype     = 1;
		$tableName = APP_DBPREFIX . 'u_user';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);

		$jumpUrl = '?app=user&act=getUserList';
		if ($status) {
			$this->headShow(0,$tipInfo,$jumpUrl);
		} else {
			$this->headShow(1,$tipInfo,$jumpUrl);
		}

		exit;
	}

	/**
	 * 编辑用户 - 视图
	 *
	 */
	public function viewEditUser()
	{
		$userInfo = array(); //用户信息
		$tableList= array(); //表信息
		$tableRet = $this->_material->getAllTablesAttr();
		$roleList = $this->role->fetchGroupName(); //角色信息
		$uid      = intval($_GET['uid']);
		$userInfo = $this->user->getUserInfoByUserID($uid);
		$tidStr   = trim($userInfo['operate_tables']);
		$tidArr   = array();
		if ($tidStr){
			$tidArr = explode(',',$tidStr);
		}
		
		foreach ($tableRet as $val) {
			if (in_array($val['tid'],$tidArr)) {
				$val['checktxt'] = 'checked="checked"';
			} else {
				$val['checktxt'] = '';
			}
			$tableList[] = $val;
		}

		$this->assigns(array(
			'userInfo' => $userInfo,
			'roleList' => $roleList,
			'tableList'=> $tableList
		));
		$this->setTplHtml('_user/viewEditUser');
		$this->display();
	}

	/**
	 * 编辑用户 - 逻辑
	 *
	 */
	public function editUser()
	{
		$uid	  = intval(strStripSlashes($_POST['uid']));
		$uname    = trim(strStripSlashes($_POST['username']));
		$gid      = strStripSlashes($_POST['role']);
		$passwd   = trim(strStripSlashes($_POST['password']));
		$truename = trim(strStripSlashes($_POST['truename']));
		$uemail   = trim(strStripSlashes($_POST['email']));
		$state    = strStripSlashes($_POST['isEnabled']) ? 1 : 0;
		$tidArr   = $_POST['tid'];
		$tidStr   = ''; //表id字符串
		if ($tidArr) {
			$tidStr = join(',',$tidArr);
		}
		$row = array(
			'gid'	           => $gid,
			'truename'	       => $truename,
			'uemail'		   => $uemail,
			'wether_to_enable' => $state,
			'operate_tables'   => $tidStr
		);

		if ($passwd) { //如果为真表示也更新密码
			$row['passwd'] = md5($uname.md5($passwd));
		}

		$status  = $this->user->updateUser($row,$uid);
		$tipInfo = '更新用户成功!';

		//添加操作日志
		$s_uid       = $this->userSession['uid'];
		$s_uname     = $this->userSession['uname'];
		$s_groupid   = $this->userSession['gid'];
		$s_event     = '用户' . $s_uname . $tipInfo . ',用户id为:' . $uid;
		$s_etype     = 2;
		$s_tableName = APP_DBPREFIX . 'u_user';
		$s_dbName    = APP_DATABASE;
		$this->operateLog->insertLog($s_uid,$s_uname,$s_groupid ,$s_event,$s_etype,$s_tableName,$s_dbName);

		$jumpUrl = '?app=user&act=getUserList';
		$this->headShow(0,$tipInfo,$jumpUrl);
	}

	/**
	 *
	 * 删除用户
	 */
	public function delUser()
	{
		if (isset( $_POST['ids'])) {
			$state  = intval($this->user->delUser($_POST['ids'],1));
			$ids    = join(',',$_POST['ids']);
		} else {
			$state  = intval($this->user->delUser($_POST['uid']));
			$ids    = $_POST['uid'];
		}

		if ($state) {
			$type    = 'success';
			$content = '删除用户成功！';
		} else {
			$type    = 'error';
			$content = '删除用户失败！';
		}

		
		//添加操作日志
		$s_uid       = $this->userSession['uid'];
		$s_uname     = $this->userSession['uname'];
		$s_groupid   = $this->userSession['gid'];
		$s_event     = '用户' . $s_uname . $content . ',删除的用户id为:' . $ids;
		$s_etype     = 3;
		$s_tableName = APP_DBPREFIX . 'u_user';
		$s_dbName    = APP_DATABASE;
		$this->operateLog->insertLog($s_uid,$s_uname,$s_groupid ,$s_event,$s_etype,$s_tableName,$s_dbName);

		$row = array('type' => $type, 'content' => $content);
		echo json_encode($row);
	}

}
?>