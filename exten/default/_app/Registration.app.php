<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}

/**
 * 注册页面管理控制器。
 *
 * @author yiluxiangbei<tsq7473281@163.com>
 */
class RegistrationApp extends BaseAppEx
{
	public $user; //用户模型

	public function init()
	{
		 $this->user = &$this->getModel('user');
	}

    public function index()
    {
		$this->head();
    	$this->setTplHtml('registration');
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
	 * 处理注册用户
	 */
	public function register()
	{
		//转义特殊字符
    	$userinfo = arrayAddSlashes($this->data['post']);
		//判断验证码否够正确
        $auth = &self::$ses->get('authCode');
        if ($userinfo['authcode'] == null || $userinfo['authcode'] != $auth) {
            $this->response(1, '验证码错误');
        }
		$username = trim($userinfo['username']);
		$passwd   = trim($userinfo['password']);
		$email    = trim($userinfo['email']);
		$state = $this->user->checkUsername($username);
		if (!$state) { //用户名已存在
			$this->response(2, '用户名已存在!');
		}

		$insertRow = array(
			'uname'		       => $username,
			'passwd'	       => $passwd,
			'create_time'	   => date("Y-m-d H:i:s", time()),
			'uemail'		   => $email,
			'wether_to_enable' => 0
		);
		$insertStatus  = $this->user->insertUser($insertRow);
		if ($insertStatus) {
			$this->response(0, '注册成功!');
		}
		exit;
	}

	public function run()
	{
		$methodMap = array(
			'register'    => 'register',
			'getAuthImage'  => 'getAuthImage',
			'index'         => 'index'
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