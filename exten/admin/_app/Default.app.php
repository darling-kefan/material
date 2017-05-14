<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 主页面管理控制器
 * @author  sqtang
 */
class DefaultApp extends BaseAppEx
{
    /**
     * index page
     */
    public function index()
    {
    	$userSession = &self::$ses->get('user');
    	//print_r($userSession);
		$this->assigns(array(
			'topMenu'  => $userSession['auth']['topMenu'],
			'leftMenu' => $userSession['auth']['leftMenu'],
			'uid'      => $userSession['uid'],
			'uname'    => $userSession['uname']
		));
    	$this->setTplHtml('main');
		$this->display();
    }
    
    /**
     * 显示提示信息跳转页面
     */
	public function show()
	{
	    $this->setTplHtml('show');
	    $this->display();  
        self::$ses->drop('MsgType');
        self::$ses->drop('MsgContent');
        self::$ses->drop('URL');
	}

	/**
	 * welcome page 欢迎页面
	 *
	 */
	public function welcome()
	{
		$basicInfo = array();
		
		$basicInfo['serverSoftware'] = $_SERVER['SERVER_SOFTWARE'];//网站服务器
		$basicInfo['serverProtocol'] = $_SERVER['SERVER_PROTOCOL'];//通信协议
		$basicInfo['documentRoot']   = $_SERVER['DOCUMENT_ROOT'];//文档根目录
		$basicInfo['systemRealse']   = php_uname();//系统类型及版本号
		$basicInfo['phpVersion']     = PHP_VERSION;//PHP版本
		$basicInfo['remoteAddr']     = $_SERVER['REMOTE_ADDR'];//客户端IP
		$basicInfo['serverName']     = $_SERVER["HTTP_HOST"];//服务器域名
		$basicInfo['serverAddr']     = $_SERVER["SERVER_ADDR"];//服务器IP
		$basicInfo['phpSapiName']    = php_sapi_name();//php运行方式
		
		$con = mysql_connect(APP_HOSTNAME, APP_USERNAME, APP_PASSWORD);
		$basicInfo['mysqlVersion']   = mysql_get_server_info($con);//获取MySQL信息
		mysql_close($con);
		
		$this->assign('basicInfo',$basicInfo);
		$this->setTplHtml('welcome');
	    $this->display();  
	}
}
?>