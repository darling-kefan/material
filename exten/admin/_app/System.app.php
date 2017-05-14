<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 系统设置
 * @author  sqtang
 */
class SystemApp extends BaseAppEx
{
	private $userSession; //用户session
	private $operateLog; //操作日志model
	private $setting; //系统设置model

	/**
     * 初始化操作。
     */
    public function init()
    {
		$this->userSession = &self::$ses->get('user');
		$this->operateLog  = &$this->getModel('operatelog');
		$this->setting     = &$this->getModel('setting');
    }

	/**
	 * 系统设置 - 视图
	 */
	public function viewSystemSet()
	{
		$systemConfig = $this->setting->getSettingInfo();
		$this->assign('systemConfig',$systemConfig);
		$this->setTplHtml('_system/systemSet');
		$this->display();
	}


	/**
	 * 系统设置 - 逻辑
	 */
	public function systemSet()
	{
		$siteName  = trim(strStripSlashes($_POST['siteName']));
		$siteUrl   = trim(strStripSlashes($_POST['siteUrl']));
		$logo      = trim(strStripSlashes($_POST['logo']));
		$address   = trim(strStripSlashes($_POST['address']));
		$phone     = trim(strStripSlashes($_POST['phone']));
		$zipCode   = trim(strStripSlashes($_POST['zipCode']));
		$email     = trim(strStripSlashes($_POST['email']));
		$certtext  = trim(strStripSlashes($_POST['certtext']));
		$isEnabled = trim(strStripSlashes($_POST['isEnabled'])) ? 1 : 0;
		$siteCloseMessage  = trim(strStripSlashes($_POST['siteCloseMessage']));
		$row = array(
			'website_name'	   => $siteName,
			'website_url'	   => $siteUrl,
			'website_logo'	   => $logo,
			'website_addr'	   => $address,
			'website_tel'	   => $phone,
			'website_zipcode'  => $zipCode,
			'website_mail'	   => $email,
			'website_icp'	   => $certtext,
			'website_open'     => $isEnabled,
			'website_close_msg'=> $siteCloseMessage
		);
		
		$status  = $this->setting->updateSetting($row);
		$tipInfo = '更新系统设置成功!' ;

		//添加操作日志
		$s_uid       = $this->userSession['uid'];
		$s_uname     = $this->userSession['uname'];
		$s_groupid   = $this->userSession['gid'];
		$s_event     = '用户' . $s_uname . $tipInfo;
		$s_etype     = 2;
		$s_tableName = APP_DBPREFIX . 'sys_config';
		$s_dbName    = APP_DATABASE;
		$this->operateLog->insertLog($s_uid,$s_uname,$s_groupid ,$s_event,$s_etype,$s_tableName,$s_dbName);

		$jumpUrl = '?app=system&act=viewSystemSet';
		$this->headShow(0,$tipInfo,$jumpUrl);
		exit;
	}

	/**
	 * 图片浏览
	 *
	 */
	public function browse()
	{
		global $allow_type; //允许检查的类型
		$upload_directory = LOGO_DIRECTORY; //logo目录
		$imageurl         = LOGO_URL;
		$path			  = '/';   //默认路径
		$orderby          = 'name'; //默认排序

		if (isset($_GET['path'])) {
			$path = $_GET['path'];
		}

		if (isset($_GET['orderType'])) {
			$orderby = $_GET['orderType'];
		}

		$picList =  dir_list($upload_directory,$path,$imageurl,$allow_type,$orderby);
		echo json_encode($picList);exit;
	}

	/**
	 * 图片上传 - 逻辑
	 *
	 */
	public function upload()
	{
		$allow_width      = ALLOW_WIDTH; //允许上传的宽
		$allow_height     = ALLOW_HEIGHT; //允许上传的高
		$allow_size       = ALLOW_SIZE; //允许上传的文件大小 
		$upload_directory = LOGO_DIRECTORY; //上传目录
		$url = '';
		if (isset($_FILES['file']))
		{
			$upload = $_FILES['file'];
		}

		if ($upload) {
			if (!$upload['error']) { //上传出错
				$type    = 'error';
				$content = '上传错误!';
			}

			list($width, $height) = getimagesize($upload['tmp_name']);
			if ($allow_width != $width || $allow_height != $height) { //尺寸不符合
				$status = array(
					'message' => array(
						'type'    => 'warn',
						'content' => '上传的图片尺寸不符!'
					)
				);
				echo json_encode($status);
				exit;
			}

			if ($upload['size'] > $allow_size) {
				$status = array(
					'message' => array(
						'type'    => 'warn',
						'content' => '上传的图片太大!'
					)
				);
				echo json_encode($status);
				exit;
			}

			if (!file_exists($upload_directory)) {
				$old_dir	= umask(0);
				$mk_res		= mkdir($upload_directory, 0777);
				umask($old_dir);
			}

			if (is_dir($upload_directory)) {
				$flag = move_uploaded_file($upload['tmp_name'],$upload_directory . DIRECTORY_SEPARATOR . $upload['name']);
				if ($flag) {
					$type    = 'success';
					$content = '上传成功!';
					$url     = $upload_directory .  DIRECTORY_SEPARATOR . $upload['name'];
				} else {
					$type    = 'warn';
					$content = '目录没有写入权限！';
				}
			}
			$status = array(
				'message' => array(
					'type'    => $type,
					'content' => $content
				),
				'url' => $url
			);
			echo json_encode($status);
			exit;
		}
	}
}
?>