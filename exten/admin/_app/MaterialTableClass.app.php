<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}
/**
 * 原料数据表分类控制器。
 *
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-09-02
 */
class MaterialTableClassApp extends BaseAppEx
{
	//用户相关属性
	private $_userSession = NULL;
	//原料数据表分类模型
	private $_tableClass = NULL;
	
	/**
     * 初始化控制器
     * 
     */
    public function init()
    {
        $this->_tableClass  = &$this->getModel('materialTableClass');
        $this->_userSession = &self::$ses->get('user');
    }
    
    /**
	 * 查看表分类列表
	 */
    public function getTableClassList()
    {
        $classList = array();
    	$rightOperates = array();
    	$isExistAddButton = 0;
    	
    	//获取分类列表
        $allClass = $this->_tableClass->getTableClassList();

        if (!empty($allClass)) {
        	$classList = $this->createMenuTree($allClass);
        }
        //获取操作权限
        $tableClassOperates = $this->_userSession['auth']['operates']['materialTableClass'];
        
        if (!empty($tableClassOperates[0]) && !empty($tableClassOperates[2])) {
        	$rightOperates = array_merge($tableClassOperates[0],$tableClassOperates[2]);
        } elseif (!empty($tableClassOperates[0]) && empty($tableClassOperates[2])) {
        	$rightOperates = $tableClassOperates[0];
        } elseif (empty($tableClassOperates[0]) && !empty($tableClassOperates[2])) {
        	$rightOperates = $tableClassOperates[2];
        }
        
        if (!empty($tableClassOperates[1])) {
        	$isExistAddButton = 1;
        }
        
        $this->assign('isExistAddButton',$isExistAddButton);
        $this->assign('classList',$classList);
        $this->assign('rightOperates',$rightOperates);
        
    	$this->setTplHtml('_materialTableClass/classList');
		$this->display();
    }
    
	/**
	 * 查看添加原料表分类
	 * 
	 */
    public function viewAddTableClass()
    {
        $allClass = $this->_tableClass->getTableClassList();

        $classList = array();
        if (!empty($allClass)) {
        	$classList = $this->createMenuTree($allClass);
        }
        
        $this->assign('classList',$classList);
    	$this->setTplHtml('_materialTableClass/addTableClass');
		$this->display();
    }

    
	/**
	 * 添加原料表分类
	 * 
	 * POST
	 * @param className string 分类名
	 * @param parentID  int    上级分类
	 */
    public function addTableClass()
    {
        if (empty($this->data['post']['name']) 
        	|| empty($this->data['post']['order'])) {
        	$this->headShow(1, 'parameters or arguments error');
        }
        
        $class_name = $this->data['post']['name'];
        $parentid   = empty($this->data['post']['parentId']) ? 0 : $this->data['post']['parentId'];
        $csort      = empty($this->data['post']['order']) ? 1 : $this->data['post']['order'];
        
        $result = $this->_tableClass->addTableClass($class_name, $parentid, $csort);

        if ($result == true) {
        	$this->headShow(0,'TableClass successfully added','admin.php?app=materialTableClass&act=getTableClassList');
        } else {
        	$this->headShow(1,'TableClass added failed','admin.php?app=materialTableClass&act=viewAddTableClass');
        }
        
    }
    
	/**
	 * 显示修改原料表
	 * 
	 * POST
	 * @param classID int 原料表分类ID
	 */
    public function viewEditTableClass()
    {
    	$classid = $this->data['get']['classid'];
    	if (empty($classid)) {
        	$this->headShow(1, 'parameters or arguments error');
        }
    	//获取分类列表
    	$allClass = $this->_tableClass->getTableClassList();
        $classList = array();
        if (!empty($allClass)) {
        	$classList = $this->createMenuTree($allClass);
        }
		//获取该分类相关信息
		$classInfo = $this->_tableClass->getClassInfoByID($classid);

        $classList = array();
        if (!empty($allClass)) {
        	$classList = $this->createMenuTree($allClass);
        }

        $this->assign('classList',$classList);
        $this->assign('classInfo',$classInfo);
    	$this->setTplHtml('_materialTableClass/editTableClass');
		$this->display();
    }
    
	/**
	 * 显示修改原料表
	 * 
	 * POST
	 * @param classID   int    分类ID
	 * @param className string 分类名
	 * @param parentID  int    父类ID
	 * @param sortID    string 排序
	 */
    public function editTableClass()
    {
    	if (empty($this->data['post']['id']) 
    		|| empty($this->data['post']['name']) 
        	|| empty($this->data['post']['order'])) {
        	$this->headShow(1, 'parameters or arguments error');
        }
        
        $classid    = $this->data['post']['id'];
        $class_name = $this->data['post']['name'];
        $parentid   = empty($this->data['post']['parentId']) ? 0 : $this->data['post']['parentId'];
        $csort      = empty($this->data['post']['order']) ? 1 : $this->data['post']['order'];
        
        $result = $this->_tableClass->editTableClass($classid, $class_name, $parentid, $csort);

        if ($result == true) {
        	$this->headShow(0,'TableClass successfully edited','admin.php?app=materialTableClass&act=getTableClassList');
        } else {
        	$this->headShow(1,'TableClass edited failed',"admin.php?app=materialTableClass&act=viewEditTableClass&classid={$classid}");
        }
    }
    
	/**
	 * 删除原料表（要考虑到删除分类后，分类下的原料表的归属问题）
	 * 
	 * POST
	 * @param classID string 表ID
	 */
    public function deleteTableClass()
    {
    	$classid = $this->data['post']['id'];
    	
        //1、删除分类表中的信息
        $res = $this->_tableClass->deleteTableClass($classid);
        //@todo2、处理原料数据表分类信息
        
        $result = array();
        if ($res) {
	        $result['type'] = 'success';
	        $result['content'] = '删除成功！';
        } else {
        	$result['type'] = 'failed';
	        $result['content'] = '删除失败！';
        }
        echo json_encode($result);
    }
    
	/**
	* 生成菜单
	*
	* @param array $data 原始数据
	* @param integer $pid 当前分类的父id
	* @return array 处理后数据
	*/
	public function createMenuTree($data = array(), $pid = 0)
	{
	    if (empty($data))
	    {
	        return array();
	    }
	 
	    static $level = 0;
	 
	    $returnArray = array();
	 
	    foreach ($data as $node)
	    {
	        if ($node['parentid'] == $pid)
	        {
	            $returnArray[] = array(
	                'classid'   => $node['classid'],
	                'className' => $node['class_name'],
	            	'order' 	=> $node['csort'],
	                'level' 	=> $level
	            );
	 
	            if ($this->hasChild($node['classid'], $data))
	            {
	                $level++;
	 
	                $returnArray = array_merge($returnArray, $this->createMenuTree($data, $node['classid']));
	 
	                $level--;
	            }
	        }
	    }
	 
	    return $returnArray;
	}
	 
	/**
	* 检查是否有子分类
	*
	* @param integer $cid 当前分类的id
	* @param array $data 原始数据
	* @return boolean 是否有子分类
	*/
	public function hasChild($cid, $data)
	{
	    $hasChild = false;
	 
	    foreach ($data as $node)
	    {
	        if ($node['parentid'] == $cid)
	        {
	            $hasChild = true;
	            break;
	        }
	    }
	 
	    return $hasChild;
	}
}
