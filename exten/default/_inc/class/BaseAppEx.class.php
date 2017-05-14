<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}
/**
 * 用于子系统业务扩展的APP基类，主要作为入口基类处理一些共同的业务操作。
 *
*/
class BaseAppEx extends BaseApp
{
    /**
     * 页面标题名称
     * @var string
     */
    private $_title    = null;
    /**
     * 信息配置
     * @var array
     */
    private $_messages = array();
	protected $tableClass; //表分类模型
	protected $table; //表模型
	protected $userSession; //用户登录信息

    
    public function __construct($app = null, $act = null, $data = array())
    {
        parent::__construct($app, $act, $data);
		$this->tableClass  =  &$this->getModel('MaterialTableClass');
		$this->table       =  &$this->getModel('MaterialTable');
		$this->userSession = &self::$ses->get('user');
        $this->_checkLoginAndAuth();
    }
    
    /**
     * 过滤掉列表每项中不需要的数组键值
     *
     * @param  list    $list
     * @param  array   $keys
     * @param  boolean $keep 保留键值还是除去键值
     * @return list
     */
    public function filterList($list, $keys, $keep = true)
    {
        foreach ($list as $k => $v){
            $list[$k] = $keep ? $this->keepKeys($v, $keys) : $this->unsetKeys($v, $keys);
        }
        return $list;
    }

    /**
     * 保留需要的，数组中对应的键值(用在接口或者异步调用中)
     *
     * @param  array $data
     * @param  array $keys
     * @return array
     */
    public function keepKeys($data, $keys)
    {
        foreach ($data as $k => $v) {
            if(!in_array($k, $keys)){
                unset($data[$k]);
            }
        }
        return $data;
    }

    /**
     * 过滤不需要的，数组中对应的键值(用在接口或者异步调用中)
     *
     * @param  array $data
     * @param  array $keys
     * @return array
     */
    public function unsetKeys($data, $keys)
    {
        foreach ($keys as $k) {
        	unset($data[$k]);
        }
        return $data;
    }

    /**
     * 返回处理结果
     *
     * @param int    $error
     * @param string $message
     * @param array  $data
     */
    public function response($error = 0, $msg = null, $data = array())
    {
        $message = $this->getMessage($msg);
        if(empty($message)){
            $message = $msg;
        }
        $result = array();
        $result['error'] = $error;
        $result['msg']   = $message;
        $result['data']  = $data;
        echo json_encode($result);
        exit();
    }
    
    /**
     * 跳转到中转页面。
     *
     * @param string $msgType    信息类型 0:成功 | 1:失败
     * @param string $msgContent 信息内容
     * @param string $referer    中转后跳转的页面
     * 1, 'Please login first', 'admin.php?app=login'
     */
    public function headShow($msgType, $msgContent, $referer = null)
    {
        $message = $this->getMessage($msgContent);
        if(empty($message)){
            $message = $msgContent;
        }
        self::$ses->set('MsgType',    $msgType);
        self::$ses->set('MsgContent', $message);
        self::$ses->set('Referer',    $referer ? $referer : $_SERVER['HTTP_REFERER']);
    	header("location:index.php?act=show");
    	exit();
    }
    
    /**
     * 设置页面标题
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }
    
   /**
     * 显示模版
     */
    public function display()
    {
    	//所有弹出层增加GET方法传递的iframe，用以标识使用弹出层模板
        if($_GET['iframe']){
            $this->setTplHtml('iframe');
        }
       
        //获得该页面的标题名称
        $title = null;
        include(EXTEN_PATH.'/_cfg/title.inc.php');
        foreach ($_Titles as $app => $acts){
            foreach ($acts as $act => $titleForAct){
                if(strcasecmp($this->app, $app) == 0 && strcasecmp($this->act, $act) == 0){
    				$title = $titleForAct;
    				break;
    			}
            }
			if($title){
			    break;
			}
		}	
		
		//获得该页面的分级条	
		
        //将系统配置为全局Smarty变量
        $settignModel = &$this->getModel('setting');
        $settignInfo  = $settignModel->getSettingInfo();
        $this->assigns(array(
            '_Style'     => Config::$cfg['Style'],
            '_Title'     => "{$title} - {$settignInfo['website_name']}",
            '_Setting'   => $settignInfo,
        	'_Rank'     => "{$settignInfo['website_name']} &raquo; {$title}",
        ));

        if(DEBUG == 1){
            ob_start();
            echo "<!-- \n";
            echo "SESSION变量：\n\n";
            print_r($_SESSION);
            echo "\n\n\n";
            echo "COOKIE变量：\n\n";
            print_r($_COOKIE);
            echo "\n\n\n";
            echo "SMARTY变量：\n\n";
            print_r(self::$tpl->getTplVars());
            echo "\n-->";
            $debugData = ob_get_contents();
            ob_end_clean();
        }
        parent::display();
        if(isset($debugData)){
            echo $debugData;
        }
    }
    
    /**
     * 根据信息Key获得信息配置字符串
     * @param  string $msgKey
     * @return string
     */
    public function getMessage($msgKey)
    {
        if(empty($this->_messages)){
            include(EXTEN_PATH.'/_cfg/message.inc.php');
            $this->_messages = $_Messages;
        }
        return $this->_messages[$msgKey];
    }
    
    /**
     * 判断是否已经登陆，如果登陆则判断当前的操作权限。
     */
    private function _checkLoginAndAuth()
    {
        /*
    	$app = strtolower($this->app);
        $act = strtolower($this->act);
        $checked = false;
        //判断网站是否开启
        $systemSiteModel = &$this->getModel('setting');
        $result = $systemSiteModel->checkSiteOpen();
		$userSession = &self::$ses->get('user');
        if ($result['website_open'] == 1) {
			 //权限白名单判断
	        include(EXTEN_PATH.'/_cfg/authWhiteList.inc.php');
	        foreach ($_AuthWhiteList as $kapp => $acts){
	            foreach ($acts as $kact => $_){
	                if(strcasecmp($app, $kapp) == 0 && strcasecmp($act, $kact) == 0){
	    				$checked = true;
	    				break;
	    			}
	            }
				if($checked){
				    break;
				}
	        }
			if ($checked == false) {
				if (empty($userSession)) { //直接跳转到登陆页
					 header('Location: index.php?app=login');
					 exit;
				}
			}
        } else {
        	$checked = false;
        	//@todo 此处需要跳转到网站关闭提示页面，未做。。。。
        	echo $result['website_close_msg'];
        	exit();
        }
        */
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
     
    /**
     * 判断是否是异步接口，返回没有权限的错误提示
     */
    private function _showPermissionDenied()
    {
        if(preg_match("/^async/i", $this->act)){
            $this->response(1, 'Permission denied');
        }else{
            $this->headShow(1, 'Permission denied', 'admin.php');
        }
    }

	/**
	 * 网站头部
	 */
	public function head()
	{	
		
		$keywordsArr   = array(); //搜索关键字
		$tableClassArr = $this->tableClass->getTableClassInfo();
		$attributeArr  = $this->table->getAttributeData('keywords',"keywords <>'' order by tid desc limit 5");
		foreach ($attributeArr as $val) {
			$keywordsArr[] = explode(',',$val['keywords']);
		}
		$this->assigns(array(
			'tableclassArr' => $tableClassArr,
			'keywordsArr'   => $keywordsArr,
			'uname'         => $this->userSession['uname']
        ));
	}
	
	/**
     * 无内容展示提醒
     */
	public function notFound()
    {
        $this->setTplHtml('error');
		$this->display();
    }
}
?>