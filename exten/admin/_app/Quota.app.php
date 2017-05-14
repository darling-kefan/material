<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 指标管理模块
 *
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-11-20
 */
class QuotaApp extends BaseAppEx
{
	private $_quota;
	private $_quotaClass;
	private $_userSession;
	
	 /**
     * 初始化数据模型
     * 
     */
    public function init()
    {
        $this->_quota       = &$this->getModel('quota');
    	$this->_quotaType   = &$this->getModel('quotaClass');
    	$this->_tableClass  = &$this->getModel('materialTableClass');
    	$this->_materialTable  = &$this->getModel('materialTable');
		$this->_userSession = &self::$ses->get('user');
    }
	
	/**
	 * 指标管理
	 */
	public function quotaManager()
	{
		$quotasList = array();
		
		//获取指标分类Id
		$qcid = $this->data['get']['qcid'];
		//接收参数
		$basicInfo['qcid']           = $qcid;
		$basicInfo['pageSize']       = isset($this->data['get']['pageSize']) ? $this->data['get']['pageSize'] : 20;
    	$basicInfo['pageNumber']     = isset($this->data['get']['pageNumber']) ? $this->data['get']['pageNumber'] : 1;
    	$basicInfo['orderProperty']  = isset($this->data['get']['orderProperty']) ? $this->data['get']['orderProperty'] : 'quotaid';
		$basicInfo['orderDirection'] = isset($this->data['get']['orderDirection']) ? $this->data['get']['orderDirection'] : 'desc';
		//$basicInfo['searchProperty'] = isset($this->data['get']['searchProperty']) ? $this->data['get']['searchProperty'] : '';
		//$basicInfo['searchValue']    = isset($this->data['get']['searchValue']) ? $this->data['get']['searchValue'] : '';
		
		//获取记录总条数
		if (empty($qcid)) {
			$allQuotas = $this->_quota->getAllQuotas();
		} else {
			$allQuotas = $this->_quota->getQuotasByQcid($qcid);
		}
		
		if (empty($allQuotas)) {
			$counts = 0;
			//$this->headShow(1,'quotas not existed',"admin.php?app=quotaType&act=quotaTypeManager");
		} else {
			$counts = count($allQuotas);
		}
		$basicInfo['showPage'] = showPage($counts, $basicInfo['pageSize']);
		
		//file_put_contents('/var/www/html/material/log', var_export($basicInfo,true), FILE_APPEND);
		
		if ($counts > 0) {
			
			//按条件获取指标
			$quotas = $this->_quota->getQuotasByCondition($qcid, $basicInfo['orderProperty'], $basicInfo['orderDirection'], $basicInfo['pageNumber'], $basicInfo['pageSize']);
			
			//获取所有的指标分类
			$quotaClasses = $this->_quotaType->getAllQuotaClass();
			foreach ($quotaClasses as $quotaClass) {
				$quotaCList[$quotaClass['qcid']]['qcname'] = $quotaClass['qcname'];
				$quotaCList[$quotaClass['qcid']]['ancestors'] = $quotaClass['ancestors'];
				$quotaCList[$quotaClass['qcid']]['classid'] = $quotaClass['classid'];
			}

			//获取所有原料表分类
			$materialClasses = $this->_tableClass->getTableClassList();
			foreach ($materialClasses as $materialClass) {
				$mClasses[$materialClass['classid']] = $materialClass['class_name'];
			}
			
			$tmpArr = array();
			
			foreach ($quotas as $quota) {
				$quotaid      = $quota['quotaid'];
				$quotaname    = $quota['quotaname'];
				$quotacontent = unserialize($quota['quotacontent']);
				$qcids        = $quota['qcid'];
				
				$quotasList[$quotaid]['quotaid'] = $quotaid;
				$quotasList[$quotaid]['name'] = $quotaname;
				
				$ancestors = explode(',',$quotaCList[$qcids]['ancestors']);
				foreach ($ancestors as $i) {
					if ($i != 0) {
						$quotasList[$quotaid]['classes'] = $quotasList[$quotaid]['classes'] . '/' . $quotaCList[$i]['qcname'];
					}
				}
				$classid = $quotaCList[$qcids]['classid'];
				
				$quotasList[$quotaid]['classes'] = $mClasses[$classid] . $quotasList[$quotaid]['classes'];
				//$quotasList[$quotaid]['content'] = $quotacontent;
				
				$tmpTFArr = array();
				foreach ($quotacontent as $t=>$fArr) {
					foreach ($fArr as $f) {
						$tmpTFArr[] = $f."_".$t;
					}
				}
				
				$quotasList[$quotaid]['content'] = $tmpTFArr;
				
				$j = array_keys($quotacontent);
				$tmpArr = array_merge($tmpArr, $j);
			}
			
			$tmpArr = array_unique($tmpArr);
			$tidsStr = implode(',', $tmpArr);
			
			//根据tid遍历material_fields_attr,获取字段名称
			$fieldsArr = array();
			$tableFields = $this->_materialTable->getFieldsInfo($tidsStr);
			foreach ($tableFields as $tableField) {
				$tmpKey = $tableField['fname']."_".$tableField['tid'];
				$fieldsArr[$tmpKey] = $tableField['fcomment'];
			}
			
			//整理得到content
			foreach ($quotasList as $ttid=>$item) {
				$qcontent = "";
				foreach ($item['content'] as $v) {
					if (empty($qcontent)) {
						$qcontent = $fieldsArr[$v];
					} else {
						$qcontent = $qcontent.",".$fieldsArr[$v];
					}
				}
				$quotasList[$ttid]['content'] = $qcontent;
			}
			
		}

		//print_r($tmpArr);
		//print_r($tableFields);
		//print_r($quotasList);
		
		//2、获取指标操作权限
        $quotaOperates = $this->_userSession['auth']['operates']['quota'];
        
        if (!empty($quotaOperates[0]) && !empty($quotaOperates[2])) {
        	$rightOperates = array_merge($quotaOperates[0],$quotaOperates[2]);
        } elseif (!empty($quotaOperates[0]) && empty($quotaOperates[2])) {
        	$rightOperates = $quotaOperates[0];
        } elseif (empty($quotaOperates[0]) && !empty($quotaOperates[2])) {
        	$rightOperates = $quotaOperates[2];
        }
        
    	if (!empty($quotaOperates[1]) && !empty($quotaOperates[2])) {
        	$topOperates = array_merge($quotaOperates[1],$quotaOperates[2]);
        } elseif (!empty($quotaOperates[1]) && empty($quotaOperates[2])) {
        	$topOperates = $quotaOperates[1];
        } elseif (empty($quotaOperates[1]) && !empty($quotaOperates[2])) {
        	$topOperates = $quotaOperates[2];
        } 
        
		//获取顶部操作按钮
        $topBottons = array();
        if (!empty($topOperates)) {
	        foreach ($topOperates as $button) {
	        	$topBotton['name'] = $button['name'];
	        	$topBotton['url']  = $button['url'];
	        	$topBottons[$button['type']] = $topBotton;
	        }
        }
		
        $this->assign('basicInfo',$basicInfo);
        $this->assign('quotasList',$quotasList);
    	$this->assign('topBottons',$topBottons);
        $this->assign('rightOperates',$rightOperates);
		
		$this->setTplHtml('_quota/quota');
		$this->display();	
	}
	
	/**
	 * 查看添加指标页面
	 */
	public function viewAddQuota()
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
		
		$this->assign('allQuotaClassList',$allQuotaClassList);
		
		$this->setTplHtml('_quota/addQuota');
		$this->display();
	}
	
	/**
	 * 添加指标
	 */
	public function addQuota()
	{
		//指标分类ID
		$qcid = $this->data['post']['quotaCId'];
		//指标名称
		$quotaName = $this->data['post']['quotaName'];
		//相关原料表
		$tids = $this->data['post']['tid'];
		
		//接收所选表的所选字段
		$quotaContent = array();
		foreach ($tids as $tid) {
			$acceptName = "table{$tid}_fields";
			if (!empty($this->data['post'][$acceptName])) {
				$quotaContent[$tid] = $this->data['post'][$acceptName];
			}
		}
		
		if (empty($quotaContent)) {
			$this->headShow(1,'do not selected fields',"admin.php?app=quota&act=viewAddQuota");
		}
		
		//print_r($quotaContent);
		$quotaContent = serialize($quotaContent);
		
		//将数据存入到quota表中
		$result = $this->_quota->insertQuota($quotaName, $quotaContent, $qcid);

		if ($result == true) {
        	$this->headShow(0,'Quota successfully added','admin.php?app=quota&act=quotaManager');
        } else {
        	$this->headShow(1,'Quota added failed',"admin.php?app=quota&act=viewAddQuota");
        }
	}
	
	/**
	 * 查看更新指标页面
	 */
	public function viewEditQuota()
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

		//获取参数
		$quotaid = $this->data['get']['quotaid'];
		//获取指标相关内容
		$quotaInfo = $this->_quota->getQuotaInfoById($quotaid);
		
		$quotaContent = unserialize($quotaInfo['quotacontent']);
		
		//获取原料表所有字段
		$tidsArr = array_keys($quotaContent);
		$tidsStr = implode(',', $tidsArr);
		$tableFields = $this->_materialTable->getFieldsInfo($tidsStr);
		
		//获取原料表名
		$tablenames = $this->_materialTable->getTablesInfo($tidsStr);
		$tablenamesVar = array();
		foreach ($tablenames as $tablename) {
			$tablenamesVar[$tablename['tid']] = $tablename['tname'];
		}

		$tableFieldsVar = array();
		foreach ($tableFields as $key=>$fieldInfo) {
			if ($fieldInfo['fname'] != 'field0' && $fieldInfo['fname'] != 'field1') {
				$tableFieldsVar[$fieldInfo['tid']]['name'] = $tablenamesVar[$fieldInfo['tid']];
				$checked = 0;
				foreach ($quotaContent as $tk=>$fns) {
					foreach ($fns as $fn) {
						if ($fn == $fieldInfo['fname'] && $tk == $fieldInfo['tid']) {
							$checked = 1;
						}
					}
					
				}
				
				$tableFieldsVar[$fieldInfo['tid']]['fields'][] = array(
					'fname'    => $fieldInfo['fname'],
					'fcomment' => $fieldInfo['fcomment'],
					'checked' => $checked
				);
			}
		}

		ksort($tableFieldsVar);
		
		$this->assign('tableFieldsVar',$tableFieldsVar);
		$this->assign('quotaInfo',$quotaInfo);
		$this->assign('allQuotaClassList',$allQuotaClassList);
		
		$this->setTplHtml('_quota/editQuota');
		$this->display();
	}
	
	/**
	 * 更新指标
	 */
	public function editQuota()
	{
		//指标id
		$quotaid = $this->data['post']['quotaid'];
		//指标分类ID
		$qcid = $this->data['post']['quotaCId'];
		//指标名称
		$quotaName = $this->data['post']['quotaName'];
		//相关原料表
		$tids = $this->data['post']['tid'];
		
		//接收所选表的所选字段
		$quotaContent = array();
		foreach ($tids as $tid) {
			$acceptName = "table{$tid}_fields";
			if (!empty($this->data['post'][$acceptName])) {
				$quotaContent[$tid] = $this->data['post'][$acceptName];
			}
		}
		
		if (empty($quotaContent)) {
			$this->headShow(1,'do not selected fields',"admin.php?app=quota&act=viewEditQuota&quotaid={$quotaid}");
		}
		
		//print_r($quotaContent);
		$quotaContent = serialize($quotaContent);
		
		//更新指标操作
		$result = $this->_quota->updateQuota($quotaid,$quotaName,$quotaContent,$qcid);
		
		if ($result == true) {
        	$this->headShow(0,'Quota successfully edited','admin.php?app=quota&act=quotaManager');
        } else {
        	$this->headShow(1,'Quota edited failed',"admin.php?app=quota&act=viewEditQuota");
        }
	}
	
	/**
	 * 删除指标
	 */
	public function deleteQuota()
	{
        $ids = array();
		if (isset($this->data['post']['id'])) {
			array_push($ids, $this->data['post']['id']);
		} elseif(isset($this->data['post']['ids'])) {
			$ids = $this->data['post']['ids'];
		}
		
		//删除数据
		$res = $this->_quota->deleteQuotas($ids);

		
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
	 * 异步获取某指标分类下的原料表
	 */
	public function asyncGetTablesByQType()
	{
		$qcid = $this->data['post']['id'];
		//获取原料表
		$materialTablesInfo = $this->_materialTable->getTablesByQcid($qcid);
		
		$tableIds = array();
		$result   = array();
		
		if (!empty($materialTablesInfo)) {
			foreach ($materialTablesInfo as $materialTable) {
				$result[ $materialTable['tid'] ]['tid'] = $materialTable['tid'];
				$result[ $materialTable['tid'] ]['name'] = $materialTable['t_name'];
				$result[ $materialTable['tid'] ]['comment'] = $materialTable['tname'];
				array_push($tableIds, $materialTable['tid']);
			}
			
			//获取原料表字段
			$tableIdsStr = implode(',', $tableIds);
			$allTablesFields = $this->_materialTable->getFieldsInfo($tableIdsStr);
			
			foreach ($allTablesFields as $tableInfo) {
				if ($tableInfo['fname'] != 'field0' && $tableInfo['fname'] != 'field1') {
					$result[ $tableInfo['tid'] ]['data'][] = array(
						'tid'      => $tableInfo['tid'],
						'fname'    => $tableInfo['fname'],
						'fcomment' => $tableInfo['fcomment']
					);
				}
			}

		}
		
		ksort($result);
		
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