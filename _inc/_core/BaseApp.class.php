<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 业务层处理APP的基类，主要执行一些基本的APP操作，特别是一些通用的APP处理。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
*/
class BaseApp extends Base
{
    public $app;   //APP名称
    public $act;   //ACT名称
    public $data = array(); //传递的参数数组
    
    public function __construct($app = null, $act = null, $data = array())
    {
        parent::__construct();
        $this->app  = $app;
        $this->act  = $act;
        $this->data = $data;
    }
    
    /**
	 * 对象入口函数
	 *
	 */
	public function run()
	{
	    $act = $this->act;
		if(method_exists($this, $act)){
        	$this->$act();
        }else{
        	exit("I do not have '{$act}' method!");
        }
	}

	/**
	 * 封装：MVC显示的页面文件。
	 *
	 * @param string $tplHtml
	 */
	public function setTplHtml($tplHtml)
	{
	    if(defined('USE_TPL')){
	        $tplHtml = $tplHtml.'.tpl.htm';
		    self::$tpl->setTplHtml($tplHtml);
	    }else{
	        $this->_dieTplNotInitialized();
	    }
	}


	/**
	 * 封装：MVC页面赋值。
	 *
	 * @param array $array
	 */
	public function assigns($array)
	{
	    if(defined('USE_TPL')){
	        self::$tpl->assigns($array);
	    }else{
	        $this->_dieTplNotInitialized();
	    }
	}

	/**
	 * 封装：MVC页面赋值。
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function assign($name, $value)
	{
	    if(defined('USE_TPL')){
	        self::$tpl->assign($name, $value);
	    }else{
	        $this->_dieTplNotInitialized();
	    }
	}

	/**
	 * 封装：MVC显示页面。
	 *
	 */
	public function display()
	{
	    if(defined('USE_TPL')){
	        self::$tpl->display();
	    }else{
	        $this->_dieTplNotInitialized();
	    }
	}
	
	/*
	 * 当模板引擎没有包含，但是被调用时，会发出警告并停止执行
	 */
	private function _dieTplNotInitialized()
	{
	    exit('Template was not initialized!');
	}
}
?>