<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 退出登录模块
 * 
 * @author yiluxiangbei<tsq7473281@163.com>
 */
class ExitApp extends BaseAppEx
{
	private $loginLog;
	 /**
     * 初始化数据模型
     * 
     */
    public function init()
    {
        $this->_user    = &$this->getModel('user');
		$this->loginLog = &$this->getModel('loginlog');
    }
	

	public function index()
	{
		//清除session
		$userSession = &self::$ses->get('user');
		//记录日志
		if ($userSession){
			$row = array(
				'bname'     => $userSession['uname'],
				'uid'       => $userSession['uid'],
				'groupid'   => $userSession['gid'],
				'client_ip' => $_SERVER["REMOTE_ADDR"],
				'event'     => '用户:' . $userSession['uname'] . '退出系统！',
				'eventtype' => 0
			);
			$this->loginLog->insertLog($row);
		}
		self::$ses->drop('user');		
		//跳转到登陆界面		
		header("Location:?app=login");	
		exit();	
	}
}