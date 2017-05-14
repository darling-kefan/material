<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 所有类的基础类，提供了常用的基础组件封装：
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Base
{
	protected static $md;     //模型保存数组
	protected static $cs;
	protected static $db;     //数据库实例化对象
	protected static $db_app;     //app数据库实例化对象
	protected static $db_material;     //material数据库实例化对象
	protected static $pie;    //Cookie操作对象
	protected static $ses;    //Session操作对象
	protected static $conf;   //系统配置数组变量
	protected static $modmap; //模型映射数组
	public static $tpl;    //MVC模板类对象
	protected $ts;     //全局时间戳
	protected $dbpre;  //表名前缀
	protected static $mongo; //mongodb实例化对象

	public function __construct()
	{
		$this->ts     = time();
		//@todo
	    $this->dbpre  = '';
	}

	/**
	* 根据配置情况初始化静态变量，包括缓存/数据库/模型缓存等
	* 
	*/
	public static function initStatic($cfg){
	    if($cfg['USE_CS']){
	        require_once(ROOT_PATH.'/_inc/_libs/CacheServer.class.php'); //缓存服务器定义文件
			self::$cs = new MemcacheServer(array(
			    'host'  => MEMCACHE_HOST,
			    'port'  => MEMCACHE_PORT, 
			    'expire' => CACHE_EXPIRE
			));
	    }
	    self::$md = array();
	    if($cfg['USE_DB_APP']){
			require_once(ROOT_PATH.'/_inc/_libs/DB/DB.class.php'); //数据库抽>象类定义文件
	        self::$db_app = DB::getDb(APP_HOSTNAME, APP_USERNAME, APP_PASSWORD, APP_DATABASE, APP_HOSTPORT, APP_DBCHARSET, APP_DBOPTYPE);
	    }
		if($cfg['USE_DB_MATERIAL']){
			require_once(ROOT_PATH.'/_inc/_libs/DB/DB.class.php'); //数据库抽>象类定义文件
	        self::$db_material = DB::getDb(MATERIAL_HOSTNAME, MATERIAL_USERNAME, MATERIAL_PASSWORD, MATERIAL_DATABASE, MATERIAL_HOSTPORT, MATERIAL_DBCHARSET, MATERIAL_DBOPTYPE);
	    }
	    if($cfg['USE_TPL']){
    		require_once(ROOT_PATH.'/_inc/class/Template.class.php');
    		self::$tpl = new Template();
	    }
	    if($cfg['USE_PIE']){
    		require_once(ROOT_PATH.'/_inc/_libs/Cookie.class.php');

    		self::$pie = new Cookie(COOKIE_PATH,COOKIE_DOMAIN,COOKIE_EXPIRE);
	    }
	    if($cfg['USE_SES']){
    		require_once(ROOT_PATH.'/_inc/_libs/Session.class.php');
    		self::$ses = new Session();
	    }
	    if($cfg['USE_NOSQL']){
    		require_once(ROOT_PATH.'/_inc/_libs/NoSQL/MongoDB.class.php');
    		self::$mongo = new MongoDBClass(MONGO_HOST, MONGO_PORT, MONGO_DB, MONGO_USER, MONGO_PASS);
	    }
	    self::$conf = Config::$cfg;
	    self::$modmap = Config::$modmap;
	}
    
	/**
     * 获得模型。
     *
     * @param  string $modelName 模型名称
     * @return obj 模型`对象
     */
    public function &getModel($modelName)
    {
        //所有MODEL只实例化一次，如果原来有实例化的MODEL，则返回之
        $temp = strtolower($modelName);
        if(isset(self::$modmap[$temp])){
            $modelName = self::$modmap[$temp];
        }
        if(empty(self::$md[$modelName])) {
            //模型的物理绝对路径
            $modelPath = ROOT_PATH.'/_mod/'.$modelName.'.mod.php';
            if(file_exists($modelPath)) {
                include($modelPath);
            } else {
                exit('Model '.$modelName.' dose not exist!');
            }
            if(empty(self::$md[$modelName])) {
                $modelClass = ucfirst($modelName).'Model';
                self::$md[$modelName] = new $modelClass();
                //使用init()方法而不是构造函数初始化派生对象
                if(method_exists(self::$md[$modelName], 'init')) {
                    self::$md[$modelName]->init();
                }
            }
        }
        return self::$md[$modelName];
    }

}
?>
