<?php
/**
 * SESSION封装类，实现SESSION的功能封装
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Session
{
	public  $sid;
	private $_inited = false; //是否已初始化

	public function __construct()
	{
		if(!isset($_SESSION)){
             session_start();
        }
	}

	/**
	 * 设置Session
	 *
	 * @param string $key
	 * @param mixed $val
	 */
	public function set($key, $val)
	{
	    if($this->_inited == false){
	        $this->_init();
	    }
	    
		$this->$key = $val;
		$_SESSION[$key] = $val;
		$this->sid = session_id();
	}

	/**
	 * 删除Session
	 *
	 * @param string $key
	 */
	public function drop($key)
	{
	    if($this->_inited == false){
	        $this->_init();
	    }
	    
		unset($this->$key);
		unset($_SESSION[$key]);
	}
	/**
	 * 删除Session
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function &get($key)
	{
	    if($this->_inited == false){
	        $this->_init();
	    }
	    
		return $this->$key;
	}
	
	/**
	 * 初始化数据
	 *
	 */
	private function _init()
	{
	    $this->_load();
		$this->sid = session_id();
		
		$this->_inited = true;
	}
	
	/**
	 * Load Session变量
	 *
	 * @return bool
	 */
	private function _load()
	{
		foreach($_SESSION as $key => $val){
			$this->$key = $val;
		}
	}

}
?>
