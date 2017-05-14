<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 系统日志
 * @author  sqtang
 */
class BlogApp extends BaseAppEx
{
	private $loginLog; //登陆日志model
	private $operateLog; //操作日志model
	protected $userSession; //用户session值


	public function init()
	{
	    //实例数据模型
        $this->loginLog    = &$this->getModel('loginlog');
		$this->operateLog  = &$this->getModel('operatelog');
		$this->userSession = &self::$ses->get('user');
	}


	/**
	 * 登陆日志
	 */
	public function getLoginLog()
	{
		global $pageArr,$searchType;
		$hasDel		 = 0; //是否有删除权限
		$currentGid  = $this->userSession['gid'];
		$operateArr  = $this->userSession['auth']['operates'][strtolower($this->app)];
		if ($operateArr[0]['del'] || $operateArr[2]['del']) {
			$hasDel = 1;
		}

		if ($currentGid == 1) { //如果是管理员的话拥有全部权限
			$hasDel  = 1;
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
			$orderby = 'ORDER BY bid DESC';
		} else {
			$orderby = 'ORDER BY ' . $orderProperty . ' ' . $orderDirection;
		}

		if ($searchProperty && $searchValue) {
			$condition = $searchProperty . ' like\'%' . $searchValue . '%\'';
		}

		$count	  = $this->loginLog->getCount($condition); //列表信息条数
		$list	  = $this->loginLog->getList('*',$condition,$start,$pageSize,$orderby,false);
		$this->assigns(array(
			'logList'		 => $list,
			'total_num'		 => $count,
			'orderProperty'  => $orderProperty,
			'orderDirection' => $orderDirection,
			'searchType'     => $searchType['loginLog'],
			'searchProperty' => $searchProperty,
			'searchValue'    => $searchValue,
			'pageSize'		 => $pageSize,
			'pageArr'		 => $pageArr,
			'pageStr'        => showPage($count,$pageSize),
			'hasDel'         => $hasDel
        ));
		$this->setTplHtml('_log/loginLog');
		$this->display();
	}

	/**
	 * 操作日志
	 */
	public function getOperateLog()
	{
		global $pageArr,$searchType,$operateLog;
		$hasDel		 = 0; //是否有删除权限
		$currentGid  = $this->userSession['gid'];
		$operateArr  = $this->userSession['auth']['operates'][strtolower($this->app)];
		if ($operateArr[0]['del'] || $operateArr[2]['del']) {
			$hasDel = 1;
		}

		if ($currentGid == 1) { //如果是管理员的话拥有全部权限
			$hasDel  = 1;
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
			$orderby = 'ORDER BY bid DESC';
		} else {
			$orderby = 'ORDER BY ' . $orderProperty . ' ' . $orderDirection;
		}

		if ($searchProperty && $searchValue) {
			$condition = $searchProperty . ' like\'%' . $searchValue . '%\'';
		}

		$count	  = $this->operateLog->getCount($condition); //列表信息条数
		$list	  = $this->operateLog->getList('*',$condition,$start,$pageSize,$orderby,false);
		$this->assigns(array(
			'logList'		 => $list,
			'total_num'		 => $count,
			'orderProperty'  => $orderProperty,
			'orderDirection' => $orderDirection,
			'searchType'     => $searchType['operateLog'],
			'searchProperty' => $searchProperty,
			'searchValue'    => $searchValue,
			'pageSize'		 => $pageSize,
			'pageArr'		 => $pageArr,
			'pageStr'        => showPage($count,$pageSize),
			'hasDel'         => $hasDel,
			'eventtype'      => $operateLog
        ));
		$this->setTplHtml('_log/operateLog');
		$this->display();
	}

	/**
	 * 删除登陆日志
	 */
	public function deleteLoginLog()
	{
		if (isset( $_POST['ids'])) {
			$state  = intval($this->loginLog->delLog($_POST['ids'],1));
		} elseif (isset( $_POST['bid'])) {
			$state  = intval($this->loginLog->delLog($_POST['bid']));
		} elseif (isset( $_POST['all'])) {
			$state  = intval($this->loginLog->delLog($_POST['all'],2));
		}
		if ($state) {
			$type    = 'success';
			$content = '删除登陆日志成功！';
		} else {
			$type    = 'error';
			$content = '删除登陆日志失败！';
		}

		//添加操作日志
		$uid   = $this->userSession['uid'];
		$uname = $this->userSession['uname'];
		$gid   = $this->userSession['gid'];
		$event = '用户' . $uname .$content;
		$etype = 3;
		$tableName = APP_DBPREFIX . 'blog_user_login';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$uname,$gid,$event,$etype,$tableName,$dbName);

		$row = array('type' => $type, 'content' => $content);
		echo json_encode($row);
		
	}

	/**
	 * 删除操作日志
	 */
	public function deleteOperateLog()
	{
		if (isset( $_POST['ids'])) {
			$state  = intval($this->operateLog->delLog($_POST['ids'],1));
		} elseif (isset( $_POST['bid'])) {
			$state  = intval($this->operateLog->delLog($_POST['bid']));
		} elseif (isset( $_POST['all'])) {
			$state  = intval($this->operateLog->delLog($_POST['all'],2));
		}
		if ($state) {
			$type    = 'success';
			$content = '删除操作日志成功！';
		} else {
			$type    = 'error';
			$content = '删除操作日志失败！';
		}

		//添加操作日志
		$uid   = $this->userSession['uid'];
		$uname = $this->userSession['uname'];
		$gid   = $this->userSession['gid'];
		$event = '用户' . $uname .$content;
		$etype = 3;
		$tableName = APP_DBPREFIX . 'blog_user_operation';
		$dbName    = APP_DATABASE;
		$this->operateLog->insertLog($uid,$uname,$gid,$event,$etype,$tableName,$dbName);

		$row = array('type' => $type, 'content' => $content);
		echo json_encode($row);
	}
}
?>