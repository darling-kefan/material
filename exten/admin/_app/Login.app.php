<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 用户登录模块
 * @author bii
 *
 */
class LoginApp extends BaseAppEx
{
	//数据模型变量
    private $_user;
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
	
    /**
     * 输出模板
     * 
     */
    public function loginShow()
    {
    	//选择模板文件
        $this->setTplHtml('login');
        $this->display();
    }

    /**
     * 获取验证码图片
     * 
     */
    public function getAuthImage()
    {
        //包含发送邮件方法
     	importFunc('authImage');
    	//生成四位随机数字
    	$num = rand(1111,9999);
    	//存入session
    	self::$ses->set('authCode', $num);
    	//将随机数字生成验证码图片
        authImage($num);
    }

   /**
    * 用户登录验证，成功则赋予权限（password前端已经进行过md5加密）
    * @return string JSON格式
    */
    private function _asyncLogin()
    {
    	//转义特殊字符
    	$userinfo = arrayAddSlashes($this->data['post']);

		//判断参数是否为空
        if(!$userinfo['passport'] || !$userinfo['password']){
             $this->response(1, 'Parameters incompleted');
        }		

         //判断验证码否够正确
        $auth = &self::$ses->get('authCode');
	        
        if($userinfo['authCode'] == null || $userinfo['authCode'] != $auth){
        	$error['ErrorType'] = 2;
        	$error['ErrorMsg']='验证码错误';
            $this->response(1, 'Failure', $error);
        }
        //释放session验证码的值
        self::$ses->drop('authCode');	
       
        //判断用户名密码是否正确
        $result = $this->_user->userLogin($userinfo['passport'], md5($userinfo['password']));
		//返回从数据模型中验证的消息
        switch($result['Result']){
        	//用户名不存在
            case 'LoginName_NotExist':
            	$error['ErrorType'] = 1;
        		$error['ErrorMsg']='该用户不存在';
            	$this->response(1, 'Failure', $error);           
                break;
            //账户被禁用
            case 'LoginName_Disabled':
                $error['ErrorType'] = 1;
        		$error['ErrorMsg']='此账户被禁用';
            	$this->response(1, 'Failure', $error); 
                break;
            //密码错误
            case 'Password_Error':
                $error['ErrorType'] = 1;
        		$error['ErrorMsg']='用户名或密码错误';
            	$this->response(1, 'Failure', $error); 
                break;
            //登陆成功
            case 'Login_Success':           	      
            	//初始化user信息
            	$sessioninfo = array();

            	$sessioninfo['uid'] = $result['uid'];
            	$sessioninfo['gid'] = $result['gid'];
				$sessioninfo['uname'] = $result['uname'];
            	$sessioninfo['gname'] = $result['gname'];
            	$sessioninfo['operate_tables'] = $result['operate_tables'];
            	$sessioninfo['truename'] = $result['truename'];
            	$sessioninfo['uemail'] = $result['uemail'];
            	$sessioninfo['login_count'] = $result['login_count'];
            	$sessioninfo['last_login_time'] = $result['last_login_time'];
                $sessioninfo['last_login_ip'] = $result['last_login_ip'];
                $sessioninfo['auth'] = $result['auth'];

				//记录日志
				$row = array(
					'bname'     => $result['uname'],
					'uid'       => $result['uid'],
					'groupid'   => $result['gid'],
					'client_ip' => $_SERVER["REMOTE_ADDR"],
					'event'     => '用户:' . $result['uname'] . '登陆系统！',
					'eventtype' => 1
				);
				$this->loginLog->insertLog($row);

           		//增加登陆次数
            	//$this->_user->addLoginCount($result['UserID']);
            	//把初始化user信息赋给SESSION
            	self::$ses->set('user', $sessioninfo);
                //$this->addLog('登入系统', $result['UserID']);
                 $this->response(0, 'OK');
                break;
            default:
                break;
        }
      
    }

	/**
	 * 初始化函数
	 * @see BaseApp::run()
	 */
	public function run()
	{
		$methodMap = array(
			'asyncLogin'    => '_asyncLogin',
			'getAuthImage'  => 'getAuthImage',
			'loginShow'     => 'loginShow'	,	
			'index'         => 'loginShow'		
		);
		foreach ($methodMap as $k => $v){
			if(strcasecmp($this->act, $k) == 0){
				$this->$v();
				break;
			}
		}
	}
}
?>