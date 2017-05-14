<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 指标类别管理模块
 *
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-11-20
 */
class QuotaTypeApp extends BaseAppEx
{
	//指标分类数据模型
	private $_quotaType;
	
	 /**
     * 初始化数据模型
     * 
     */
    public function init()
    {
		$this->_userSession = &self::$ses->get('user');
    	$this->_quotaType   = &$this->getModel('quotaClass');
    	$this->_tableClass  = &$this->getModel('materialTableClass');
    }
	
	/**
	 * 指标分类展示管理
	 */
	public function quotaTypeManager()
	{
		//获取原料表分类名
		$allClass = $this->_tableClass->getTableClassList();
		$allClassNames = array();
		if (!empty($allClass)) {
			foreach ($allClass as $classInfo) {
				$allClassNames[$classInfo['classid']] = $classInfo['class_name'];
			}
		}
		
		//获取所有指标
		$allQuotaClass = $this->_quotaType->getAllQuotaClass();
		
		$allQuotaClassList = array();
		if (!empty($allQuotaClass)) {
			foreach ($allQuotaClass as $quotaClass) {
				$allQuotaClassList[$quotaClass['classid']]['data'][] = $quotaClass;
			}
			
			foreach ($allQuotaClassList as $classid=>$info) {
				$allQuotaClassList[$classid]['name'] = $allClassNames[$classid];
				
				$clientData = $this->createMenuTree1($info['data']);
				$allQuotaClassList[$classid]['data'] = $clientData;
			}
		}

		
		//获取操作权限
        $quotaTypeAuths = $this->_userSession['auth']['operates']['quotaType'];
        
        //获取列表操作按钮
        if (!empty($quotaTypeAuths[0]) && !empty($quotaTypeAuths[2])) {
        	$rightOperates = array_merge($quotaTypeAuths[0],$quotaTypeAuths[2]);
        } elseif (!empty($quotaTypeAuths[0]) && empty($quotaTypeAuths[2])) {
        	$rightOperates = $quotaTypeAuths[0];
        } elseif (empty($quotaTypeAuths[0]) && !empty($quotaTypeAuths[2])) {
        	$rightOperates = $quotaTypeAuths[2];
        }
        
        //获取顶部操作按钮
        $topBottons = array();
        if (!empty($quotaTypeAuths[1])) {
	        foreach ($quotaTypeAuths[1] as $button) {
	        	$topBotton['name'] = $button['name'];
	        	$topBotton['url']  = $button['url'];
	        	array_push($topBottons, $topBotton);
	        }
        }

        $this->assign('quotaClasses',$allQuotaClassList);
        $this->assign('topBottons',$topBottons);
        $this->assign('rightOperates',$rightOperates);
		
		$this->setTplHtml('_quota/quotaType');
		$this->display();	
	}
	
	/**
	 * 查看添加指标类别页面
	 */
	public function viewAddQuotaType()
	{
		//获取原料表分类
		$allClass = $this->_tableClass->getTableClassList();
		
		//标记叶子节点和非叶子节点
		$classList = array();
		if (!empty($allClass)) {
			
			$classList = $this->createMenuTree($allClass);
			
			$allParentids = array();
			foreach ($allClass as $classItem) {
				array_push($allParentids, $classItem['parentid']);
			}
			array_unique($allParentids);
			
			for ($i=0; $i<count($classList); $i++) {
				if (in_array($classList[$i]['classid'], $allParentids)) {
					$classList[$i]['leaf'] = 0;
				} else {
					$classList[$i]['leaf'] = 1;
				}
			}
			
		}

		
		$this->assign('classList',$classList);
		
		$this->setTplHtml('_quota/addQuotaType');
		$this->display();
	}

	/**
	 * 添加指标类别
	 */
	public function addQuotaType()
	{
		$classifyID  = $this->data['post']['classifyID'];
		$quotaParentID = isset($this->data['post']['quotaParentID']) ? $this->data['post']['quotaParentID'] : 0;
		$name        = $this->data['post']['name'];
		$order       = empty($this->data['post']['order']) ? 1 : $this->data['post']['order'];
		
		$result = $this->_quotaType->addQuotaType( $name, $quotaParentID, $classifyID, $order );
		
		if ($result == true) {
        	$this->headShow(0,'QuotaClass successfully added','admin.php?app=quotaType&act=quotaTypeManager');
        } else {
        	$this->headShow(1,'QuotaClass added failed',"admin.php?app=quotaType&act=viewAddQuotaType");
        }
	}
	
	/**
	 * 查看更新指标类别页面
	 */
	public function viewEditQuotaType()
	{
		//根据指标类别ID，获取指标类别相关信息
		$quotaInfo = $this->_quotaType->getQuotaClassByqcid($this->data['get']['qcid']);
		
		//获取classid下所有指标类别
		$quotaClasses = $this->_quotaType->getQuotaClassByClassID($quotaInfo['classid']);
		$classQuotas = array();
		if (!empty($quotaClasses)) {
			$classQuotas = $this->createMenuTree1($quotaClasses);
			
			foreach ($classQuotas as $key=>$val) {
				if (strncmp($val['ancestors'],$quotaInfo['ancestors'],strlen($quotaInfo['ancestors'])) == 0) {
					unset($classQuotas[$key]);
				}
			}
		}
		
		//获取原料表分类
		$allClass = $this->_tableClass->getTableClassList();
		//标记叶子节点和非叶子节点
		$classList = array();
		if (!empty($allClass)) {
			
			$classList = $this->createMenuTree($allClass);
			
			$allParentids = array();
			foreach ($allClass as $classItem) {
				array_push($allParentids, $classItem['parentid']);
			}
			array_unique($allParentids);
			
			for ($i=0; $i<count($classList); $i++) {
				if (in_array($classList[$i]['classid'], $allParentids)) {
					$classList[$i]['leaf'] = 0;
				} else {
					$classList[$i]['leaf'] = 1;
				}
				/*
				//排除掉本分类以外的数据
				if ($classList[$i]['classid'] == $quotaInfo['classid']) {
					if (in_array($classList[$i]['classid'], $allParentids)) {
						$classList[$i]['leaf'] = 0;
					} else {
						$classList[$i]['leaf'] = 1;
					}
				} else {
					unset($classList[$i]);
				}
				*/
			}
			
		}
		
		$this->assign('quotaInfo',$quotaInfo);
		$this->assign('classQuotas',$classQuotas);
		$this->assign('classList',$classList);

		$this->setTplHtml('_quota/editQuotaType');
		$this->display();
	}
	
	/**
	 * 更新指标类别
	 */
	public function editQuotaType()
	{
		$qcid        = $this->data['post']['qcid'];
		$classifyID  = $this->data['post']['classifyID'];
		$quotaParentID = isset($this->data['post']['quotaParentID']) ? $this->data['post']['quotaParentID'] : 0;
		$name        = $this->data['post']['name'];
		$order       = empty($this->data['post']['order']) ? 1 : $this->data['post']['order'];
		
		$result = $this->_quotaType->editQuotaType($qcid, $name, $quotaParentID, $classifyID, $order);
		
		if ($result == true) {
        	$this->headShow(0,'QuotaClass successfully edited','admin.php?app=quotaType&act=quotaTypeManager');
        } else {
        	$this->headShow(1,'QuotaClass edited failed',"admin.php?app=quotaType&act=viewEditQuotaType&qcid={$qcid}");
        }
	}
	
	/**
	 * 删除指标类别
	 */
	public function deleteQuotaType()
	{
		$qcid = $this->data['post']['id'];
    	
        //1、删除分类表中的信息
        $res = $this->_quotaType->deleteQuotaClass($qcid);
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
	 * 根据classID异步获取指标
	 */
	public function asyncQuotaClass()
	{
		$quotaClasses = $this->_quotaType->getQuotaClassByClassID( $this->data['post']['id'] );
		
		if (!empty($quotaClasses)) {
			$quotaClassList = $this->createMenuTree1($quotaClasses);
			file_put_contents('/var/www/html/material/log', var_export($quotaClassList, true), FILE_APPEND);
			$result['type'] = 1;
			$result['msg'] = "成功";
			$result['data'] = $quotaClassList;
		} else {
			$result['type'] = 2;
			$result['msg'] = "暂无指标分类";
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
	public function createMenuTree1($data = array(), $pid = 0)
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
	                'qcid'   => $node['qcid'],
	                'qcname' => $node['qcname'],
	            	'ancestors' => $node['ancestors'],
	            	'order' 	=> $node['qsort'],
	                'level' 	=> $level
	            );
	 
	            if ($this->hasChild($node['qcid'], $data))
	            {
	                $level++;
	 
	                $returnArray = array_merge($returnArray, $this->createMenuTree1($data, $node['qcid']));
	 
	                $level--;
	            }
	        }
	    }
	 
	    return $returnArray;
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