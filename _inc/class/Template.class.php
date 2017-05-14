<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 模板管理类，实现模板引擎功能，主要对smarty对象进行封装。
 *
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Template
{
	private $_smarty;  //Smarty对象
	private $_tplDir     = 'exten/default/template'; //模板目录
	private $_tplHtml    = 'index.html';          //HTML模板文件
	private $_compileDir = 'cache/compile/default';  //模板编译文件保存目录
	
	/**
	 * 设置模板文件。
	 *
	 * @param string $tplHtml
	 */
	function setTplHtml($tplHtml)
	{
		$this->_tplHtml = $tplHtml;
	}
	
	/**
	 * 设置模板编译文件存放目录。
	 *
	 * @param string $compileDir
	 */
	function setCompileDir($compileDir)
	{
		$this->_compileDir = $compileDir;
	}
	
	/**
	 * 设置模板文件存放目录。
	 *
	 * @param string $tplDir
	 */
	function setTplDir($tplDir)
	{
		$this->_tplDir = $tplDir;
	}
	
	/**
	 * 用数组形式为页面赋值，每个变量是数组的键值对。
	 * @param array $array
	 */
	function assigns($array)
	{
		if(!$this->_smarty){
			$this->_init();
		}
		
		foreach ($array as $k => $v){
			$this->_smarty->assign($k, $v);
		}
	}
	
	/**
	 * 页面赋值
	 * @param string $name
	 * @param mixed $value
	 */
	function assign($name, $value)
	{
		if(!$this->_smarty){
			$this->_init();
		}
		$this->_smarty->assign($name, $value);
	}
	
	/**
	 * 显示模板。
	 *
	 */
	function display()
	{
		if(!$this->_smarty){
			$this->_init();
		}
		$this->_smarty->display($this->_tplHtml);
	}
	
	/**
	 * 获得smarty模板变量
	 */
	public function getTplVars()
	{
		if(!$this->_smarty){
			$this->_init();
		}
		return $this->_smarty->_tpl_vars;
	}
	
	/**
	 * 初始化
	 *
	 */
	private function _init()
	{
		require_once(ROOT_PATH."/_inc/_libs/Smarty/libs/Smarty.class.php");
		
		$this->_smarty = new Smarty;
		$this->_smarty->left_delimiter  = '<%{';
		$this->_smarty->right_delimiter = '}%>';
		$this->_smarty->cache_dir	= ROOT_PATH."/_inc/libs/Smarty/cache";
		$this->_smarty->config_dir	= ROOT_PATH."/_inc/libs/Smarty/configs";

		//$this->_smarty->cache_modified_check = true;
		$this->_smarty->caching		    = false;
		$this->_smarty->compile_check	= true;
		//$this->_smarty->debugging      = true;
		//$this->_smarty->debugging_ctrl = 'SMARTY_DEBUG';
		//$this->_smarty->debug_tpl      = $this->_tplDir.'/debug.tpl.htm';

		if(!file_exists($this->_compileDir)){
	        mkdir($this->_compileDir, 0777, true);
	    }
		$this->_smarty->compile_dir  = $this->_compileDir;
		$this->_smarty->template_dir = $this->_tplDir;
		//$this->_smarty->register_modifier('color','_smarty_modifier_highlight');
	}
}


/**
 * 用于Smarty的高亮修饰器，主要用于搜索时的字符串高亮。
 *
 * @param  string $str
 * @param  string $key
 * @param  string $color 十六进制颜色字符串
 * @return string
 */
function _smarty_modifier_highlight($str, $key, $color = '#ff0000')
{
    $str = str_ireplace($key, "<font style='color:{$color};'>{$key}</font>", $str);
	return $str;
}
?>