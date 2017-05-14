<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}

/**
 * 入口控制核心文件。该文件控制着根据app的不同进行不同目录PHP文件的预包含的作用
 * 注意文件路径区分大小写，PHP类名称和函数名称u区分大小写。
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Core
{
	public $methodType  = 0;         //参数传递方式
                                     //0:使用GET方式传递app和act; 
                                     //1:使用GET方式传递method; 
                                     //2:使用XML传递Method; 
                                     //3:使用CLI模式传递参数，参数是数组序列化后的字符串(一般是使用PHP调用的shell脚本，参数是序列化的)
                                     //4:使用CLI模式传递参数，参数1是app，参数2是act，参数3是传递的参数字符串(一般用户使用shell直接执行的脚本)
    public $defApp        = 'default';                    //默认执行的app类
    public $defAct        = 'index';                      //默认执行的act方法
    public $appDir        = 'exten/default/_app';         //App目录
    public $cfgDir        = 'exten/default/_cfg';         //配置文件目录
    public $incDir        = 'exten/default/_inc';         //指定需要额外公共包含的文件common.inc.php的存放目录
    public $tplDir        = 'template';                   //MVC模板文件存放目录
    public $tplCompileDir = 'cache/compile/default';      //MVC模板编译文件保存目录

    /**
     * 入口函数
     *
     */
    public function run()
    {
        global $_Conf;
        //基础类、基础控制器基类、模型类基类
        require_once(ROOT_PATH.'/_inc/_core/Base.class.php');
        include(ROOT_PATH.'/_inc/_core/BaseApp.class.php');
        include(ROOT_PATH.'/_inc/_core/BaseModel.class.php');
        include(ROOT_PATH.'/_inc/_core/BaseModelEx.class.php');
        
        //额外公共包含文件，用于子系统额外的配置加载
        if(isset($this->incDir) && file_exists(ROOT_PATH.'/'.$this->incDir.'/common.inc.php')){
            include(ROOT_PATH.'/'.$this->incDir.'/common.inc.php');
        }
        
        //一些模板参数设置
        if(defined('USE_TPL')){
	    $_tpl = Base::$tpl;
            $_tpl->setTplDir(ROOT_PATH.'/'.$this->tplDir);
            $_tpl->setCompileDir(ROOT_PATH.'/'.$this->tplCompileDir);
        }
        
        //调用相关应用模块(注意这里的app可能会提交包含路径的字符串，应该处理)
        $data = array();
        switch ($this->methodType){
            case 0:
                $app = isset($_GET['app']) ? $_GET['app'] : $this->defApp;
                $act = isset($_GET['act']) ? $_GET['act'] : $this->defAct;
                $data['get']  = $_GET;
                $data['post'] = $_POST;
                break;
            case 1:
                list($app, $act) = explode('.', $_GET['method']);
                $app = $app ? $app : $this->defApp;
                $act = $act ? $act : $this->defAct;
                $data['get']  = $_GET;
                $data['post'] = $_POST;
                break;
            case 2:
                //包含XML处理函数库
                require_once(ROOT_PATH.'/_inc/funcs/xml.func.php');
                $xml = file_get_contents('php://input');
        		if($xml){
        		    $data = xml2Array($xml);
        		}
        		if(isset($data['Method'])){
        		    $method = $data['Method'];
        		}elseif(isset($data['Body']['Method'])){
        		    $method = $data['Body']['Method'];
        		}
        		
                list($app, $act) = explode('.', $method);
                $app = $app ? $app : $this->defApp;
                $act = $act ? $act : $this->defAct;
                break;
            case 3:
                $argv = unserialize($_SERVER['argv'][1]);
                $data = $argv['data'];
                $app  = $argv['app'] ? $argv['app'] : $this->defApp;
                $act  = $argv['act'] ? $argv['act'] : $this->defAct;
                break;
            case 4:
				$app  = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '';
                $act  = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : '';
                $data = isset($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : '';
                $app  = $app ? $app : $this->defApp;
                $act  = $act ? $act : $this->defAct;
                break;
        }
        //初始化app操作对象
        $this->_initApp($app, $act, $data);
    }

    /**
     * 初始化app对象操作。
     *
     * @param string $app  app名称
     * @param string $act  act名称
     * @param array  $data 传递参数
     */
    private function _initApp($app, $act, $data = array())
    {
		
        //app类文件路径
        $app = strtolower($app);
        if(file_exists(ROOT_PATH."/{$this->cfgDir}/appMapping.inc.php")){
            include(ROOT_PATH."/{$this->cfgDir}/appMapping.inc.php");
            if(isset($_AppMap[$app])){
               $app = $_AppMap[$app];
            }
        }
        $appPath = ROOT_PATH."/{$this->appDir}/{$app}.app.php";

        if(file_exists($appPath)) {
            include($appPath);
        } else {
            exit("App '{$app}' dose not exist!");
        }
        //生成类对象
        $appClass = ucfirst($app).'App';
        $appObj   = new $appClass($app, $act, $data);
        //使用init()方法而不是构造函数初始化派生对象
        if(method_exists($appObj, 'init')) {
            $appObj->init();
        }
        //使用run()方法作为对象入口函数
        if(method_exists($appObj, 'run')){
            $appObj->run();
        } else {
            exit("App '{$app}' dose not have 'run' method!");
        }
    }
}


?>
