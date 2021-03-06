<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 原料数据表控制器。
 *
 * @author  Rabbit<tsq7473281@163.com>
 * @version v1.0 2013-09-02
 */
class MaterialTableApp extends BaseAppEx
{
	//用户相关属性
	private $_userSession = NULL;
	//原料数据表模型
	private $_material = NULL;
	
	/**
     * 初始化控制器
     * 
     */
    public function init()
    {
        $this->_tableClass  = &$this->getModel('materialTableClass');
    	$this->_material    = &$this->getModel('materialTable');
    	$this->_user        = &$this->getModel('user');
        $this->_userSession = &self::$ses->get('user');
        $this->operateLog   = &$this->getModel('operatelog');
        $this->_quotaType   = &$this->getModel('quotaClass');
    }
    
    /**
	 * 获取原料中心数据表
	 * 
	 * GET
	 * @param $tableClassID int 表分类ID
	 * @param $pageNo       int 页数
	 * @param $pageSize     int 每页大小
	 */
    public function getTablesList()
    {
        //print_r($this->data);
    	$tablesList = array();
    	//列表相关参数（搜索条件、页数、排序等）
    	$listInfo = array();
    	
    	$listInfo['pageSize'] = isset($this->data['get']['pageSize']) ? $this->data['get']['pageSize'] : 20;
    	$listInfo['pageNumber'] = isset($this->data['get']['pageNumber']) ? $this->data['get']['pageNumber'] : 1;
		$listInfo['orderProperty'] = isset($this->data['get']['orderProperty']) ? $this->data['get']['orderProperty'] : '';
		$listInfo['orderDirection'] = isset($this->data['get']['orderDirection']) ? $this->data['get']['orderDirection'] : '';
		
		//获取用户可访问的原料表
		$userInfo = $this->_user->getUserInfoByUserID($this->_userSession['uid']);
		$operate_tables = $userInfo['operate_tables'];
		$where = 0;
		if ($this->_userSession['gid'] == 1) {
			$where = 1;
		} else {
			if (!empty($operate_tables)) {
				$where = "`tid` IN({$operate_tables})";
			}
		}
		
		//获取原料数据表个数
    	$counts = $this->_material->getTablesCount($where);
		$counts = $counts['count'];
		
		$listInfo['showPage'] = showPage($counts, $listInfo['pageSize']);
		$listInfo['pageCount'] = ceil($counts / $listInfo['pageSize']);//总页数
		
		if ($counts > 0) {
			if ($listInfo['orderProperty'] == '') {
				$orderProperty = 't_time';
			} elseif ($listInfo['orderProperty'] == 'creator') {
				$orderProperty = 't_creatorid';
			} elseif ($listInfo['orderProperty'] == 'order') {
				$orderProperty = 'sort';
			}
			
	    	if ($listInfo['orderDirection'] == '') {
				$orderDirection = 'DESC';
			} else {
				$orderDirection = 'ASC';
			}

			//获取所有原料数据表
	    	$tablesInfo = $this->_material->getAllTablesAttrSection($where, $orderProperty, $orderDirection, $listInfo['pageNumber'], $listInfo['pageSize']);
	    	
	    	//@todo 此处循环查询数据库，如果前端响应过慢，则修改此处
	    	//1、获取原料表相关属性
	    	$i = 0;
			foreach ($tablesInfo as $tableInfo) {
		    	$tablesList[$i]['tableId']   = $tableInfo['tid'];
		    	$tablesList[$i]['tableName'] = $tableInfo['tname'];
		        //获取分类
		        $tablesList[$i]['tableMenu'] = $this->_tableClass->getClassListByID($tableInfo['classid']);
		        //print_r($tablesList[$i]['tableMenu']);
		        //获取用户相关
		        $userInfo = $this->_user->getUserInfoByUserID($tableInfo['t_creatorid']);
		        $tablesList[$i]['userName']  = $userInfo['uname'];
		        $tablesList[$i]['tableSort'] = $tableInfo['sort'];
		        $tablesList[$i]['open_statistics'] = $tableInfo['open_statistics'];
		        $tablesList[$i]['xaxis'] = empty($tableInfo['xaxis']) ? 0 : 1;
		        $i++;
			}
		}
        //2、获取原料表操作权限
        $tableOperates = $this->_userSession['auth']['operates']['materialTable'];
        
        if (!empty($tableOperates[0]) && !empty($tableOperates[2])) {
        	$rightOperates = array_merge($tableOperates[0],$tableOperates[2]);
        } elseif (!empty($tableOperates[0]) && empty($tableOperates[2])) {
        	$rightOperates = $tableOperates[0];
        } elseif (empty($tableOperates[0]) && !empty($tableOperates[2])) {
        	$rightOperates = $tableOperates[2];
        }
        
    	if (!empty($tableOperates[1]) && !empty($tableOperates[2])) {
        	$topOperates = array_merge($tableOperates[1],$tableOperates[2]);
        } elseif (!empty($tableOperates[1]) && empty($tableOperates[2])) {
        	$topOperates = $tableOperates[1];
        } elseif (empty($tableOperates[1]) && !empty($tableOperates[2])) {
        	$topOperates = $tableOperates[2];
        } 
        
        foreach ($topOperates as $operate) {
        	if ($operate['type'] == 'del') {
        		$isExistDelButton = 1;
        	} elseif ($operate['type'] == 'backup') {
        		$isExistBackupButton = 1;
        	} elseif ($operate['type'] == 'add') {
        		$isExistAddButton = 1;
        	}
        }
        
        $this->assign('listInfo',$listInfo);
        $this->assign('isExistAddButton',$isExistAddButton);
        $this->assign('isExistDelButton',$isExistDelButton);
        $this->assign('isExistBackupButton',$isExistBackupButton);
    	$this->assign('tablesList',$tablesList);
        $this->assign('rightOperates',$rightOperates);
        
    	$this->setTplHtml('_materialTable/tablesManager');
		$this->display();
    }
    
    /**
     * 显示添加原料表
     */
    public function viewCreateTable()
    {
    	$basicList['FieldType']  = Config::$cfg['typeOfField'];
    	
    	$allClass = $this->_tableClass->getTableClassList();
        $classList = array();
        if (!empty($allClass)) {
        	$classList = $this->createMenuTree($allClass);
        }
        
        $this->assign('basicList',$basicList);
        $this->assign('classList',$classList);
    	$this->setTplHtml('_materialTable/addTable');
		$this->display();
    }

	/**
     * 添加原料表
     * 
     */
    public function createTable()
    {
		$data = array();
		$fieldsAttr = array(); 
		
		$parameters = $this->data['post'];
		
		$materialTableName = $this->random_string(8);
		
		$data['tableName']      = $materialTableName;//原料表名
		$data['storage_engine'] = 'InnoDB';
		$data['encoding_type']  = 'utf8';
		$data['comment']        = $parameters['comment'];
		
		//检查表名是否重复
		$tablesInfo = $this->_material->getAllTablesAttr();
		if (!empty($tablesInfo)) {
			foreach ($tablesInfo as $tableInfo) {
				if ($data['tableName'] == $tableInfo['t_name']) {
					$this->headShow(1,'table name is same',"admin.php?app=materialTable&act=viewCreateTable");
				}
			}
		}
		
		//生成原料表
		$addSingleQuote = Config::$cfg['addSingleQuote'];
		$list = array();
		/*
		if ($parameters['parentId'] == 5 || $parameters['parentId'] == 8 ) {//如果不是年度/月度/季度数据的情况下，需添加field0字段
			$list[0] = "`field0` VARCHAR(200) NULL DEFAULT NULL COMMENT '年份/月份'";
		} elseif ($parameters['parentId'] == 7 || $parameters['parentId'] == 9) {
			$list[0] = "`field0` VARCHAR(200) NULL DEFAULT NULL COMMENT '年份'";
		} elseif ($parameters['parentId'] == 6) {
			$list[0] = "`field0` VARCHAR(200) NULL DEFAULT NULL COMMENT '年份/季度'";
		}
		*/
		$i = 1;
		foreach ($parameters['fieldComment'] as $key=>$value) {
			$fieldName    = "field".$i;
			$fieldType    = ($parameters['fieldType'][$key]=="VARCHAR" ? $parameters['fieldType'][$key]."(200)" : $parameters['fieldType'][$key]);
			$isNull       = 'NULL';
			$defaultValue = 'NULL';
			$fieldComment = $parameters['fieldComment'][$key];

			$str = "`{$fieldName}` {$fieldType} {$isNull} DEFAULT {$defaultValue} COMMENT '{$fieldComment}'";
			array_push($list, $str);
			
			//记录字段属性
			$unit = $parameters['unit'][$key];
			$keyWords = $parameters['keyWords'][$key];
			$fieldAttr = array('field'=>$fieldName, 'comment'=>$fieldComment, 'unit'=>$unit, 'keywords'=>$keyWords);
			array_push($fieldsAttr, $fieldAttr);
			
			$i++;
		}
		
		$data['list'] = $list;
		
		//记录原料表属性
		$dataAttr = array();
		$dataAttr['t_name']      = $materialTableName;
		$dataAttr['t_storage']   = MATERIAL_DATABASE;
		$dataAttr['t_creatorid'] = $this->_userSession['uid'];
		$dataAttr['classid']     = $parameters['parentId'];
		$dataAttr['qcid']        = empty($this->data['post']['quotaParentID']) ? 0 : $this->data['post']['quotaParentID'];
		$dataAttr['tname']       = $parameters['comment'];
		$dataAttr['sort']        = 1;//排序
		
		//组织表关键字
		/*
		$tableKeywords = array();
		foreach ($parameters['tableKeyword'] as $tableKeyword) {
			if (!empty($tableKeyword)) {
				array_push($tableKeywords, $tableKeyword);
			}
		}
		$dataAttr['tableKeyword'] = implode(',', $tableKeywords);
		*/
		/*
		file_put_contents('/var/www/html/material/log', var_export($parameters ,true)."\n", FILE_APPEND);
		file_put_contents('/var/www/html/material/log', var_export($data ,true)."\n", FILE_APPEND);
		file_put_contents('/var/www/html/material/log', var_export($dataAttr ,true)."\n", FILE_APPEND);
		file_put_contents('/var/www/html/material/log', var_export($fieldsAttr ,true)."\n", FILE_APPEND);
		*/
		//print_r($data);exit();
		$result = $this->_material->createTable($data, $dataAttr, $fieldsAttr);

    	if ($result == true) {
        	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功创建表：{$dataAttr['tname']}（{$dataAttr['t_name']}）";
			$etype     = 4;
			$tableName = "{$dataAttr['tname']}（{$dataAttr['t_name']}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
    		
    		$this->headShow(0,'materialTable successfully created','admin.php?app=materialTable&act=getTablesList');
        } else {
        	$this->headShow(1,'materialTable created failed',"admin.php?app=materialTable&act=viewCreateTable");
        }

    }
    
    /**
     * 显示修改原料表
     * 
     * GET
     * @param $tableID int 表ID
     */
    public function viewAlterTable()
    {
    	//获取参数
    	$tableID = $this->data['get']['tableID'];
    	//初始化smarty变量
    	$classList   = array();
    	$tableAttrs  = array();
    	$tableFields = array();
    	$fieldList = array();
    	$classQuotas = array();
    	
    	if (!empty($tableID)) {
	    	//获取原料表分类
	    	$allClass = $this->_tableClass->getTableClassList();
	        if (!empty($allClass)) {
	        	$classList = $this->createMenuTree($allClass);
	        }
	        
	        //获取原料属性
	        $tableAttrInfo = $this->_material->getTablesAttrBytid($tableID);
	        if (!empty($tableAttrInfo)) {
	        	$tableAttrs['id']    = $tableAttrInfo['tid'];
	        	$tableAttrs['tableName']    = $tableAttrInfo['t_name'];
	        	$tableAttrs['classid']      = $tableAttrInfo['classid'];
	        	$tableAttrs['qcid']         = $tableAttrInfo['qcid'];
	        	$tableAttrs['tableComment'] = $tableAttrInfo['tname'];
	        	$tableAttrs['keywords']     = explode(',', $tableAttrInfo['keywords']);
	        }
	        
	        //获取表字段相关信息
	        $fieldsInfo = $this->_material->getFieldInfo($tableAttrs['tableName']);
	        //获取指标和单位
	        $unitAndKeyword = $this->_material->getFieldUnitAndKeywords($tableAttrInfo['tid']);
	        
	    	//获取classid下所有指标类别
			$quotaClasses = $this->_quotaType->getQuotaClassByClassID($tableAttrs['classid']);
			
			if (!empty($quotaClasses)) {
				$classQuotas = $this->createMenuTree1($quotaClasses);
				
				$allParentids = array();
				foreach ($quotaClasses as $classItem) {
					array_push($allParentids, $classItem['parentid']);
				}
				array_unique($allParentids);
				
				for ($i=0; $i<count($classQuotas); $i++) {
					if (in_array($classQuotas[$i]['classid'], $allParentids)) {
						$classQuotas[$i]['leaf'] = 0;
					} else {
						$classQuotas[$i]['leaf'] = 1;
					}
				}
			}

	        $filedInfo = array();
	        $i = 0;
	        foreach ($fieldsInfo as $item) {
	        	if ($i == 0) {
	        		$i++;
	        		continue;
	        	}
	        	$fieldInfo['field']   = $item['Field'];
	        	$fieldInfo['type']    = preg_replace('/\(\d+\)/','',$item['Type']);
	        	$fieldInfo['default'] = $item['Default'];
	        	$fieldInfo['comment'] = $item['Comment'];
	        	
	        	if (!empty($unitAndKeyword)) {
	        		foreach ($unitAndKeyword as $unitKeyword) {
	        			if ($item['Field'] == $unitKeyword['fname']) {
	        				$fieldInfo['unit']     = $unitKeyword['unit'];
	        				$fieldInfo['keywords'] = $unitKeyword['keywords'];
	        			}
	        		}
	        	} else {
	        		$fieldInfo['unit']     = '';
	        		$fieldInfo['keywords'] = '';
	        	}
	        	
	        	array_push($tableFields, $fieldInfo);
	        	array_push($fieldList, $item['Field']);
	        	$i++;
	        }
	        $tableAttrs['fieldsCount'] = $i;
    	}
    	
    	//print_r($classQuotas);
    	//print_r($tableFields);
    	//print_r($fieldList);
    	
    	$basicList['FieldType']  = Config::$cfg['typeOfField'];
    	
    	
    	$this->assign('basicList',$basicList);
    	$this->assign('fieldList',implode('#',$fieldList));
        $this->assign('classList',$classList);
        $this->assign('tableAttrs',$tableAttrs);
        $this->assign('tableFields',$tableFields);
        $this->assign('classQuotas',$classQuotas);
        
    	$this->setTplHtml('_materialTable/editTable');
		$this->display();
    }
    
    /**
     * 修改原料表
     * 
     * POST
     * @param tableID int 表ID
     * @param tableName string 表名
     * @param engineType string 引擎类型
     * @param tableDescribe string 表描述
     *    	
     */
    public function alterTable()
    {
    	$appAttr      = array();
    	$materialAttr = array();
    	
    	//print_r($this->data['post']);exit();
    	
    	$appAttr['tableID']   = $this->data['post']['id'];
    	$appAttr['tableName'] = $this->data['post']['tableName'];
    	$appAttr['tableOldName'] = $this->data['post']['tableOldName'];
    	$appAttr['classID']   = $this->data['post']['parentId'];
    	$appAttr['qcid']      = empty($this->data['post']['quotaParentID']) ? 0 : $this->data['post']['quotaParentID'];
    	$appAttr['comment']   = $this->data['post']['comment'];
    	//$appAttr['tableKeyword']   = implode(',', $this->data['post']['tableKeyword']);
    	$appAttr['tableKeyword']   = '';
    	$appAttr['orders']    = 1;
    	
    	$fieldList = explode('#',$this->data['post']['fieldList']);
    	$fieldName = $this->data['post']['fieldName'];
    	$fieldType = $this->data['post']['fieldType'];
    	$unit      = $this->data['post']['unit'];
    	$keyWords  = $this->data['post']['keyWords'];
    	$fieldComment = $this->data['post']['fieldComment'];
    	
    	//更新原料表属性
    	$result1 = $this->_material->updateTableAttr($appAttr);
    	
    	//更新原料表字段
    	$addSingleQuote = Config::$cfg['addSingleQuote'];
    	$params = array();
    	foreach ($fieldComment as $key=>$fieldCom) {
    		$params['fieldName'] = isset($fieldName[$key]) ? $fieldName[$key] : "field".($key+2);
    		$params['isNull'] = 'NULL';
    		$params['fieldComment'] = $fieldCom;
    		//如果字段类型为VARCHAR，则组织成VARCHAR(200)
    		$params['fieldType'] = (strtoupper($fieldType[$key])=="VARCHAR" ? $fieldType[$key]."(200)" : $fieldType[$key]);
    		$params['defaultValue'] = "DEFAULT NULL";
    		
    		//处理指标和单位keyWords
    		$unitKey['tid']     = $this->data['post']['id'];
    		$unitKey['field']   = isset($fieldName[$key]) ? $fieldName[$key] : "field".($key+2);
    		$unitKey['comment'] = $fieldCom;
    		$unitKey['unit']    = $unit[$key];
    		$unitKey['keyword'] = $keyWords[$key];
    		
    		//print_r($params);continue;
    		
    		//添加原料表字段
    		if (in_array($fieldName[$key], $fieldList)) {
    			$result2 = $this->_material->updateTableField($appAttr['tableName'] ,$params);
    		} else {
    			$params['fieldName'] = "field".(count($fieldList)+1);
    			$unitKey['field']    = "field".(count($fieldList)+1);
    			
    			$result2 = $this->_material->addTableField($appAttr['tableName'] ,$params);
    		}
    		
    		//添加指标和单位
    		$result3 = $this->_material->replaceUnitKey($unitKey);
    	}
		//exit();
    	if ($result1 && $result2 && $result3) {
    		//获取表名
			$tableInfo    = $this->_material->getTablesAttrBytid($appAttr['tableID']);
			$tableComment = $tableInfo['tname'];
	    	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功更新表：{$tableComment}（{$appAttr['tableName']}）";
			$etype     = 5;
			$tableName = "{$tableComment}（{$appAttr['tableName']}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
    		
        	$this->headShow(0,'materialTable successfully updated','admin.php?app=materialTable&act=getTablesList');
        } else {
        	$this->headShow(1,'materialTable updated failed',"admin.php?app=materialTable&act=viewAlterTable&tableID={$appAttr['tableID']}");
        }
    }
    
	/**
     * 删除原料表
     * 
     * GET
     * @param tableID int 表ID
     *    	
     */
    public function deleteTable()
    {
		$ids = array();
		if (isset($this->data['post']['id'])) {
			array_push($ids, $this->data['post']['id']);
		} elseif(isset($this->data['post']['ids'])) {
			$ids = $this->data['post']['ids'];
		}

		//获取表名
		$tablesInfo = $this->_material->getTablesNameAndComment($ids);
		
		$tableName = "";
		$event     = "";
		foreach ($tablesInfo as $tableInfo) {
			$tableName .= $tableInfo['t_name'].",";
			$event .= "{$tableInfo['tname']}（{$tableInfo['t_name']}）,";
		}
		$tableName = substr($tableName,0,strlen($tableName)-1);
		$event     = substr($event,0,strlen($event)-1);
		
		//删除数据
		$res = $this->_material->deleteTable($ids);

		if ($res) {
			//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功删除表：{$event}";
			$etype     = 6;
			$tableName = $tableName;
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
			
			$result['type'] = "success";
    		$result['content'] = "删除成功！";
		} else {
			$result['type'] = "failed";
    		$result['content'] = "删除失败！";
		}
    	
    	echo json_encode($result);
    }
    
	/**
     * 删除原料表字段
     * 
     * GET
     * @param tableID int 表ID
     *    	
     */
    public function deleteTableField()
    {
    	//file_put_contents('/var/www/material/log',var_export($this->data,true),FILE_APPEND);
    	$data = $this->data['post']['data'];
    	$data = explode(':', $data);
    	
    	$tableName = $data[0];
    	$fieldName = $data[1];
    	
    	//删除表字段
    	$res = $this->_material->deleteTableField($tableName, $fieldName);
    	
    	//获取原料表属性
		$tableInfo    = $this->_material->getTablesAttrBytTname($tableName);
    	//删除字段计量单位和指标
    	$res1 = $this->_material->deleteFieldAttr($tableInfo['tid'], $fieldName);
		
    	if ($res && $res1) {
			$tableComment = $tableInfo['tname'];
	    	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功删除表{$tableComment}（{$tableName}）字段{$fieldName}";
			$etype     = 14;
			$tableName = "{$tableComment}（{$tableName}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
    		
    		$result['type'] = 'success';
    		$result['content'] = "删除成功！";
    	} else {
    		$result['type'] = 'failed';
    		$result['content'] = "删除失败！";
    	}
    	
    	echo json_encode($result);
    }
    
	/**
     * 导出预览
     * 
     * GET
     * @param tableID int 表ID
     *    	
     */
    public function viewExportExcel()
    {
    	$tableID = $this->data['get']['tableID'];
    	//获取表名
		$tableInfo    = $this->_material->getTablesAttrBytid($tableID);
		$tableName    = $tableInfo['t_name'];
		$tableComment = $tableInfo['tname'];
		
		//获取excel标题
		$titleArr = array();
		$fieldsInfo = $this->_material->getFieldInfo($tableName);
		foreach ($fieldsInfo as $fieldInfo) {
			if ($fieldInfo['Field'] != 'id') {
				array_push($titleArr, $fieldInfo['Comment']);
			}
		}
		
		//获取Excel列（如A,B,C,...）
		$maxCell = count($titleArr);
		$maxChar = chr(65+($maxCell-1));
		$bannerArr = range('A',$maxChar);
		
		//获取待导出数据
		$allRecords = $this->_material->getAllRecords($tableName);
		$records = array();
		if (!empty($allRecords)) {
			foreach ($allRecords as $tmpRecord) {
				array_shift($tmpRecord);
				$record = array_values($tmpRecord);
				array_push($records, $record);
			}
			
			//由于前段无法回传$records，将数据暂存到文件中
			$recordsJSON = json_encode($records);
			$randomStr = $this->_uuid();//产生一个随机字符
			$tmpFile = Config::$cfg['tmpExcelPath'].$randomStr;
			file_put_contents($tmpFile, $recordsJSON);
			
	    	$this->assign('tableID', $tableID);
	    	$this->assign('tableComment', $tableComment);
	    	$this->assign('bannerArr', $bannerArr);
	    	$this->assign('titleArr', $titleArr);
	    	$this->assign('records', $records);
	    	$this->assign('tmpFile', $tmpFile);
	        
	    	$this->setTplHtml('_materialTable/viewExportExcel');
			$this->display();
    	}else{
    		$this->headShow(1,'no data export to excel',"admin.php?app=materialTable&act=getTablesList");
    	}
    }
    
	/**
     * 导出Excel（提供下载功能）
     * 
     * GET
     * @param tableID int 表ID
     * Array ( [get] => Array ( [app] => materialTable [act] => exportExcel ) 
     * [post] => Array ( 
     * 	[tableID] => 6
     * 	[tmpFile] => /var/www/material/_cfg/../cache/a46a97d7-2029-45aa-b224-76ffb64f0802 
     * 	[captain] => 中国历年城市排水和污水处理情况统计(1978-2011) 
     * 	[title] => Array ( 
     * 	[0] => 年份/指标 [1] => 排水管道长度(公里) [2] => 污水年排放量(万立方米) [3] => 污水处理厂(座) [4] => 处理能力(万立方米/日) [5] => 污水年处理量(万立方米) [6] => 污水处理率(%) ) 
     * 	) 
     * ) 
     *    	
     */
    public function exportExcel()
    {
    	//接收参数
    	$tableID  = $this->data['post']['tableID'];
    	$dataFile = $this->data['post']['tmpFile'];
    	$captain  = $this->data['post']['captain'];
    	$titles   = $this->data['post']['title'];
    	
    	//获取表名
		$tableInfo    = $this->_material->getTablesAttrBytid($tableID);
		$tableComment = $tableInfo['tname'];
		$tableTName   = $tableInfo['t_name'];
    	//添加操作日志
		$uid       = $this->_userSession['uid'];
		$name      = $this->_userSession['uname'];
		$groupid   = $this->_userSession['gid'];
		$event     = "用户{$name}导出表：{$tableComment}（{$tableTName}）";
		$etype     = 10;
		$tableName = "{$tableComment}（{$tableTName}）";
		$dbName    = MATERIAL_DATABASE;
		$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
    	
    	
    	require_once(ROOT_PATH.'/_inc/_libs/PHPExcel/PHPExcel.php');
    	//require_once(ROOT_PATH.'/_inc/_libs/PHPExcel/PHPExcel/IOFactory.php');
    	
    	// 创建一个处理对象实例  
		$objExcel = new PHPExcel();
		
		// 创建文件格式写入对象实例, uncomment  
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);    // 用于其他版本格式    
		//$objWriter = new PHPExcel_Writer_Excel2007($objExcel); // 用于 2007 格式
		
		//设置文档基本属性  
		$objProps = $objExcel->getProperties();  
		$objProps->setCreator("Zeal Li");  
		$objProps->setLastModifiedBy("Zeal Li");  
		$objProps->setTitle("Office XLS Test Document");  
		$objProps->setSubject("Office XLS Test Document, Demo");  
		$objProps->setDescription("Test document, generated by PHPExcel.");  
		$objProps->setKeywords("office excel PHPExcel");  
		$objProps->setCategory("Test"); 
		
		//设置当前的sheet索引，用于后续的内容操作。一般只有在使用多个sheet的时候才需要显示调用。  缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
		$objExcel->setActiveSheetIndex(0);  
		$objActSheet = $objExcel->getActiveSheet();  
		//设置当前活动sheet的名称  
		$objActSheet->setTitle($captain);

		//设置Excel标题
		$objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置居中对齐
		$objActSheet->setCellValue('A1', $captain);
		//合并单元格 
		$highestColumnNum = 65+(count($titles)-1);
		$highestColumnCharacter = chr($highestColumnNum);
		$objActSheet->mergeCells("A1:{$highestColumnCharacter}1");
		
		//设置Excel Banner
		for ($i=0; $i<count($titles); $i++) {
			$columnCharacter = chr(65+$i);
			$objActSheet->getColumnDimension($columnCharacter)->setWidth(20);//设置表格宽度
			$objActSheet->getStyle("{$columnCharacter}2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置居中对齐
			$objActSheet->setCellValue("{$columnCharacter}2", $titles[$i]);
		}
		
		//从临时文件中获取待导出数据
		if (file_exists($dataFile)) {
	    	$file       = fopen($dataFile,"r");
	    	$importData = fgets($file);
	    	$importData = json_decode($importData, TRUE);//解析成数组
	    	fclose($file);
	    	unlink($dataFile);
	    	
	    	if (!empty($importData)) {
		    	foreach ($importData as $rowNum=>$rowInfo) {
		    		foreach ($rowInfo as $key=>$value) {
		    			$num = $rowNum+3;
		    			$colCharacter = chr(65+$key);
		    			$objActSheet->setCellValue("{$colCharacter}{$num}", $value); 
		    		}
		    	}
	    	}
		}
		
		//输出内容      
		$randomStr = $this->_ufileName();
		$outputFileName = "{$randomStr}.xls";
		//输出内容 到文件  
		//$outputFileName = Config::$cfg['downloadExcelPath']."{$randomStr}.xls";    
		//$objWriter->save($outputFileName);       
		//or  
		//输出内容 到浏览器  
		header("Content-Type: application/force-download");  
		header("Content-Type: application/octet-stream");  
		header("Content-Type: application/download");  
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');  
		header("Content-Transfer-Encoding: binary");  
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
		header("Pragma: no-cache");  
		$objWriter->save('php://output'); 
    }
    
    /**
     * 
     * @param $str
     */
    private function _convertUTF8($str)
	{
		if(empty($str)) return '';
		return iconv('gb2312', 'utf-8', $str);
	}
    
	/**
     * 查看导入excel（此模板暂无）
     * 
     * GET
     * @param tableID int 表ID
     *    	
     */
    public function viewImportExcel()
    {
    	$tableID = $this->data['get']['tableID'];
    	//获取表名
		$tableInfo    = $this->_material->getTablesAttrBytid($tableID);
		$tableName    = $tableInfo['t_name'];
		$tableComment = $tableInfo['tname'];
		$classid      = $tableInfo['classid'];
		
		//获取表分类名称
		$tableClassInfo = $this->_tableClass->getClassInfoByID($classid);
		$tableClassName = $tableClassInfo['class_name'];
		
    	$this->assign('tableID', $tableID);
    	$this->assign('tableName', $tableName);
    	$this->assign('tableComment', $tableComment);
    	$this->assign('tableClassName', $tableClassName);
        
    	$this->setTplHtml('_materialTable/importTable');
		$this->display();
    }
    
	/**
     * 选择要导入的excel数据
     * 
     * POST
     * @param tableID int    表ID
     * @param tableName string 表名
     * @param fileType  string 文件类型（excel、csv等）
     * @param filePath  string 文件路径
     */
    public function selectExcelData()
    {
    	$uploadPath = Config::$cfg['uploadPath'];
		$backupPath = Config::$cfg['importPath'];
		
		$tableID     = $this->data['post']['id'];
		$restoreFile = $this->data['post']['importFile'];
		//file_put_contents('/var/www/material/cache/upload',var_export($this->data,true),FILE_APPEND);
		
		$filePath = '';
		if (substr($restoreFile, 0, 7) == 'upload_') {
			$filePath = $uploadPath.$restoreFile;
		} else {
			$filePath = $backupPath.$restoreFile;
		}
		
		$excelData = $this->_readExcel($filePath);

		if (!empty($excelData)) {

			$maxChar = chr(65+(count($excelData[0])-1));
			$bannerArr = range('A',$maxChar);
			
			//由于前段无法回传$excelData，将excel数据暂存到文件中
			$excelDataJSON = json_encode($excelData);
			$randomStr = $this->_uuid();//产生一个随机字符
			$tmpFile = Config::$cfg['tmpExcelPath'].$randomStr;
			file_put_contents($tmpFile, $excelDataJSON);
			
			$this->assign('tableID', $tableID);
	    	$this->assign('bannerArr', $bannerArr);
	    	$this->assign('excelData', $excelData);
	    	$this->assign('tmpFile', $tmpFile);
	        
	    	$this->setTplHtml('_materialTable/viewExcel');
			$this->display();
		} else {
			$this->headShow(1,'import excel empty',"admin.php?app=materialTable&act=viewImportExcel&tableID={$tableID}");
		}
    }
    
	/**
     * 导入excel
     * 
     * POST
     * @param tableID int    表ID
     * @param tableName string 表名
     * @param fileType  string 文件类型（excel、csv等）
     * @param filePath  string 文件路径
     */
    public function importExcel()
    {
    	//print_r($this->data);
    	$tableID = $this->data['post']['tableID'];
    	$tmpFile = $this->data['post']['tmpFile'];
    	$idsArr  = $this->data['post']['ids'];
    	
    	//判断导入数据是否为空
    	if (empty($idsArr)) {
    		$this->headShow(1,'please select import data',"admin.php?app=materialTable&act=viewImportExcel&tableID={$tableID}");
    	} 
    	
    	//从临时文件中取出Excel数据
    	if (file_exists($tmpFile)) {
	    	$file      = fopen($tmpFile,"r");
	    	$excelData = fgets($file);
	    	$excelData = json_decode($excelData, TRUE);//解析成数组
	    	fclose($file);
	    	unlink($tmpFile);
	    	
	    	$selectedRow = array();
	    	foreach ($excelData as $key=>$row) {
	    		if (in_array($key, $idsArr)) {
	    			array_push($selectedRow, $row);
	    		}
	    	}

	    	//获取原料表名
	    	$tableInfo = $this->_material->getTablesAttrBytid($tableID);
			$tableName = $tableInfo['t_name'];
			$tableComment = $tableInfo['tname'];
			
			//导入数据
	    	$result = $this->_material->importData($tableID, $tableName, $selectedRow);

	    	if ($result) {
				//添加操作日志
				$uid       = $this->_userSession['uid'];
				$name      = $this->_userSession['uname'];
				$groupid   = $this->_userSession['gid'];
				$event     = "用户{$name}导入表：{$tableComment}（{$tableName}）";
				$etype     = 9;
				$tableName1 = "{$tableComment}（{$tableName}）";
				$dbName    = MATERIAL_DATABASE;
				$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName1,$dbName);
	    		
	    		$this->headShow(0,'import successfully',"admin.php?app=materialTable&act=viewImportExcel&tableID={$tableID}");
			} else {
				$this->headShow(1,'import failed',"admin.php?app=materialTable&act=viewImportExcel&tableID={$tableID}");
			}
	    	
    	} else {
    		$this->headShow(1,'import failed',"admin.php?app=materialTable&act=viewImportExcel&tableID={$tableID}");
    	}
    }
    
    /**
     * 利用PHPExcel读取Excel文件
     * 
     * @param string $filePath Excel文件路径
     * @return array
     */
	private function _readExcel( $filePath) {
		
		require_once(ROOT_PATH.'/_inc/_libs/PHPExcel/PHPExcel/IOFactory.php');
		
		$PHPReader = new PHPExcel_Reader_Excel2007();
		if(!$PHPReader->canRead($filePath)){   
			$PHPReader = new PHPExcel_Reader_Excel5();   
			if(!$PHPReader->canRead($filePath)){
				echo 'no Excel';  
				return ;   
			}
		} 
		
		//建立excel对象，此时你即可以通过excel对象读取文件，也可以通过它写入文件  
		$PHPExcel = $PHPReader->load($filePath);  
		  
		/**读取excel文件中的第一个工作表*/  
		$currentSheet = $PHPExcel->getSheet(0);  
		/**取得最大的列号*/  
		$allColumn = $currentSheet->getHighestColumn();  
		/**取得一共有多少行*/  
		$allRow = $currentSheet->getHighestRow();  
		  
		//循环读取每个单元格的内容。注意行从1开始，列从A开始  
		$all = array();
		for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){  
		    $flag = 0;
		    $col = array();
			for($colIndex='A';$colIndex<=$allColumn;$colIndex++){  
		        $addr = $colIndex.$rowIndex;  
		        $cell = $currentSheet->getCell($addr)->getValue();  
		        if($cell instanceof PHPExcel_RichText){     //富文本转换字符串  
		            $cell = $cell->__toString();  
		        }
		        $col[$flag] = $cell;
                $flag++;
		    }  
		  	$all[] = $col;
		}  
		return $all;
	}
    
	/**
     * 上传Excel文件
     * 
     * POST
     * @param tableID int    表ID
     * @param sqlPath string sql文件路径
     */
    public function uploadExcel()
    {
		//file_put_contents('/var/www/material/test', $_FILES["file"]["type"]."\n", FILE_APPEND);
    	$uploadPath = Config::$cfg['uploadPath'];
		
		$isUpload = 'success';
		
		if ($_FILES["file"]["type"] == 'application/vnd.ms-excel'
			|| $_FILES["file"]["type"] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
	    	if ($_FILES["file"]["error"] > 0) {
				$msg = $_FILES["file"]["error"];
				$isUpload = false;
			} else {
				if (file_exists($uploadPath . $_FILES["file"]["name"])) {
					$msg = $_FILES["file"]["name"] . "已经存在！";
					$isUpload = 'error';
				} else {
					move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath."upload_".$_FILES["file"]["name"]);
					$msg = "上传成功";
				}
			}
		} else {
			$msg = '传输格式有误，传输文本类型！';
			$isUpload = false;
		}
		
		$response['message']['type']    = $isUpload;
    	$response['message']['content'] = $msg;
    	$response['url'] = "upload_{$_FILES["file"]["name"]}";
    	
    	echo json_encode($response);
    }
    
	/**
     * 列举所有Excel文件
     */
    public function excelFileList($paths='')
    {
    	$pathConst = Config::$cfg['importPath'];
    	
        if (empty($paths)) {
        	$path = $pathConst;
        } else {
        	$path = $paths;
        }
    	
    	$fileList = array();
    	$current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
        while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
	        $fileInfo = array();
        	$sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
	        if($file == '.' || $file == '..') {
	        	continue;
	        } else if(is_dir($sub_dir)) {    //如果是目录,进行递归
	        	continue;
        	} else {
	            //文件真实路径
        		$filePath = $path.$file;
        		$fileInfo['name'] = strlen($file)>25 ? substr($file,0,25)."..." : $file;
	            $fileInfo['url'] = $file;
	            $fileInfo['size'] = filesize($filePath);
	            $fileInfo['lastModified'] = date('Y-m-d H:i:s',filectime($filePath));
	            $fileInfo['isDirectory'] = false;
	            array_push($fileList, $fileInfo);
	        }
        }
        
        //排序
        $finalData = array();
        if ($this->data['get']['orderType'] == 'size') {
        	$finalData = $this->_array_sort($fileList,'size');
        } elseif ($this->data['get']['orderType'] == 'time') {
        	$finalData = $this->_array_sort($fileList,'lastModified','desc');
        } elseif ($this->data['get']['orderType'] == 'name') {
        	$finalData = $this->_array_sort($fileList,'name');
        } else {
        	$finalData = $fileList;
        }
        //file_put_contents('/var/www/material/cache/upload',var_export($finalData,true),FILE_APPEND);
        $response = json_encode($finalData);
    	//$response = '[{"name":"blank.gif","size":35,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/blank.gif","isDirectory":false},{"name":"default_large.jpg","size":60453,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_large.jpg","isDirectory":false},{"name":"default_medium.jpg","size":38943,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_medium.jpg","isDirectory":false},{"name":"default_thumbnail.jpg","size":35739,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_thumbnail.jpg","isDirectory":false},{"name":"logo.gif","size":3445,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/logo.gif","isDirectory":false},{"name":"watermark.png","size":5340,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/watermark.png","isDirectory":false}]';
    	echo $response;
    }
    
	/**
     * 备份（此处备份到指定路径）
     * 
     * GET
     * @param tableID int    表ID
     */
    public function backup()
    {   	
    	$data = $this->data['post'];
    	
    	$ids = array();
    	if (!empty($data['id'])) {
    		array_push($ids, $data['id']);
    	} elseif (!empty($data['ids'])) {
    		$ids = $data['ids'];
    	}

    	//获取原料表名
    	$res = $this->_material->getTableNames($ids);
    	
    	$tableNames = array();
    	foreach ($res as $tableInfo) {
    		array_push($tableNames, $tableInfo['t_name']);
    	}
    	
    	//备份原料表
    	$result = $this->_material->backupStorage($tableNames);
    	//file_put_contents('/var/www/material/test1', var_export($result,true), FILE_APPEND);
    	
    	//判断是否备份成功
    	$isSuccess = true;
    	foreach ($result as $val) {
    		if ($val) {
    			$isSuccess = false;
    			break;
    		}
    	}

    	if ($isSuccess) {
    		
    		//获取表名
			$tablesInfo = $this->_material->getTablesNameAndComment($ids);
			
			$tableName = "";
			$event     = "";
			foreach ($tablesInfo as $tableInfo) {
				$tableName .= $tableInfo['t_name'].",";
				$event .= "{$tableInfo['tname']}（{$tableInfo['t_name']}）,";
			}
			$tableName = substr($tableName,0,strlen($tableName)-1);
			$event     = substr($event,0,strlen($event)-1);
			
	    	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功备份表：{$event}";
			$etype     = 7;
			$tableName = $tableName;
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName,$dbName);
    		
    		$response['type'] = 'success';
    		$response['content'] = "备份成功！";
    	} else {
    		$response['type'] = 'failed';
    		$response['content'] = "备份失败！";
    	}
    	
    	echo json_encode($response);
    }
    
	/**
     * 查看还原数据表（此模板暂无）
     * 
     * GET
     * @param tableID int    表ID
     */
    public function viewRestore()
    {
    	$tableID = $this->data['get']['tableID'];
    	//获取表名
		$tableInfo    = $this->_material->getTablesAttrBytid($tableID);
		$tableName    = $tableInfo['t_name'];
		$tableComment = $tableInfo['tname'];
		
    	$this->assign('tableID', $tableID);
    	$this->assign('tableName', $tableName);
    	$this->assign('tableComment', $tableComment);
        
    	$this->setTplHtml('_materialTable/restore');
		$this->display();
    }
    
	/**
     * 还原数据表（.sql文件）
     * 
     * POST
     * @param tableID int    表ID
     * @param sqlPath string sql文件路径
     */
    public function restore()
    {
		$uploadPath = Config::$cfg['uploadPath'];
		$backupPath = Config::$cfg['backupPath'];
		
		$tableID     = $this->data['post']['id'];
		$restoreFile = $this->data['post']['restoreFile'];
		//file_put_contents('/var/www/material/cache/upload',var_export($this->data,true),FILE_APPEND);
		
		$filePath = '';
		if (substr($restoreFile, 0, 7) == 'upload_') {
			$filePath = $uploadPath.$restoreFile;
		} else {
			$filePath = $backupPath.$restoreFile;
		}
		
		if (file_exists($filePath)) {
			//获取表名
			$tableInfo = $this->_material->getTablesAttrBytid($tableID);
			$tableName = $tableInfo['t_name'];
			$tableComment = $tableInfo['tname'];
			//还原原料表
			$result = $this->_material->restoreData($tableID, $tableName, $filePath);
			
			if ($result) {
		    	//添加操作日志
				$uid       = $this->_userSession['uid'];
				$name      = $this->_userSession['uname'];
				$groupid   = $this->_userSession['gid'];
				$event     = "用户{$name}成功还原表：{$tableComment}（{$tableName}）";
				$etype     = 8;
				$tableName1 = "{$tableComment}（{$tableName}）";
				$dbName    = MATERIAL_DATABASE;
				$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName1,$dbName);
				
				$this->headShow(0,'restore successfully',"admin.php?app=materialTable&act=viewTableRecords&tableID={$tableID}");
			} else {
				$this->headShow(1,'restore failed',"admin.php?app=materialTable&act=viewRestore&tableID={$tableID}");
			}
			
		} else {
			$this->headShow(1,'restore file is not exists',"admin.php?app=materialTable&act=viewRestore&tableID={$tableID}");
		}
    }
    
	/**
     * 上传SQL文件
     * 
     * POST
     * @param tableID int    表ID
     * @param sqlPath string sql文件路径
     */
    public function uploadSQL()
    {
		//file_put_contents('/var/www/material/test', $_FILES["file"]["type"]."\n", FILE_APPEND);
    	$uploadPath = Config::$cfg['uploadPath'];
		
		$isUpload = 'success';
		
		if ($_FILES["file"]["type"] == 'text/plain') {
	    	if ($_FILES["file"]["error"] > 0) {
				$msg = $_FILES["file"]["error"];
				$isUpload = false;
			} else {
				if (file_exists($uploadPath . $_FILES["file"]["name"])) {
					$msg = $_FILES["file"]["name"] . "已经存在！";
					$isUpload = 'error';
				} else {
					move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath."upload_".$_FILES["file"]["name"]);
					$msg = "上传成功";
				}
			}
		} else {
			$msg = '传输格式有误，传输文本类型！';
			$isUpload = false;
		}
		
		$response['message']['type']    = $isUpload;
    	$response['message']['content'] = $msg;
    	$response['url'] = "upload_{$_FILES["file"]["name"]}";
    	
    	echo json_encode($response);
    }
    
    /**
     * 列举所有备份文件
     */
    public function sqlFileList($paths='')
    {
        //file_put_contents('/var/www/material/test', var_export($this->data,true), FILE_APPEND);
    	$pathConst = Config::$cfg['backupPath'];
    	
        if (empty($paths)) {
        	$path = $pathConst;
        } else {
        	$path = $paths;
        }
    	
    	$fileList = array();
    	$current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
        while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
	        $fileInfo = array();
        	$sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
	        if($file == '.' || $file == '..') {
	        	continue;
	        } else if(is_dir($sub_dir)) {    //如果是目录,进行递归
	        	continue;
        	} else {
	            //文件真实路径
        		$filePath = $path.$file;
        		$fileInfo['name'] = strlen($file)>25 ? substr($file,0,25)."..." : $file;
	            $fileInfo['url'] = $file;
	            $fileInfo['size'] = filesize($filePath);
	            $fileInfo['lastModified'] = date('Y-m-d H:i:s',filectime($filePath));
	            $fileInfo['isDirectory'] = false;
	            array_push($fileList, $fileInfo);
	        }
        }
        
        //排序
        $finalData = array();
        if ($this->data['get']['orderType'] == 'size') {
        	$finalData = $this->_array_sort($fileList,'size');
        } elseif ($this->data['get']['orderType'] == 'time') {
        	$finalData = $this->_array_sort($fileList,'lastModified','desc');
        } elseif ($this->data['get']['orderType'] == 'name') {
        	$finalData = $this->_array_sort($fileList,'name');
        } else {
        	$finalData = $fileList;
        }
        
        $response = json_encode($finalData);
    	//$response = '[{"name":"blank.gif","size":35,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/blank.gif","isDirectory":false},{"name":"default_large.jpg","size":60453,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_large.jpg","isDirectory":false},{"name":"default_medium.jpg","size":38943,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_medium.jpg","isDirectory":false},{"name":"default_thumbnail.jpg","size":35739,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/default_thumbnail.jpg","isDirectory":false},{"name":"logo.gif","size":3445,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/logo.gif","isDirectory":false},{"name":"watermark.png","size":5340,"lastModified":1370482192000,"url":"http://demo.shopxx.net/upload/image/watermark.png","isDirectory":false}]';
    	echo $response;
    }
    
	/**
     * 查看修改原料表字段（此模板暂未创建）
     * 
     * GET
     * @param tableID int    表ID
     */
    public function viewAlterField()
    {

    }
    
	/**
     * 修改原料表字段
     * 
     * POST
     * @param tableID int    表ID
     * @param tableName     string 表名
     * @param fieldName    string 字段名称
     * @param fieldType    string 字段类型
     * @param fieldLength  int    字段长度
     * @param fieldComment string 字段描述
     */
    public function alterField()
    {
    	
    }
    
	/**
     * 查看原料表记录
     * 
     * GET
     * @param tableID int    表ID
     * @param tableName string 表名
     * @param pageSize  int    每页记录数
     * @param pageNo    int    页码
     */
    public function viewTableRecords()
    {
    	//print_r($this->data);
    	//接收参数
    	$tableID = $this->data['get']['tableID'];

    	//列表相关参数（搜索条件、页数、排序等）
    	$basicInfo   = array();
    	$fieldsList  = array();
    	$recordsList = array();
    	
    	//根据tableID，获取原料表名
    	$tableInfo  = $this->_material->getTablesAttrBytid($tableID);
    	$basicInfo['tableID']    = $tableID;
    	$basicInfo['tableName']  = $tableInfo['t_name'];
    	$basicInfo['open_statistics']  = $tableInfo['open_statistics'];
    	$basicInfo['xaxis']  = $tableInfo['xaxis'];
    	//获取原料记录个数
    	$counts = $this->_material->getRecordsCount($basicInfo['tableID']);
		$counts = $counts['count'];

		//获取总页数
		$basicInfo['recordCount']    = $counts;
		$basicInfo['pageSize']       = isset($this->data['get']['pageSize']) ? $this->data['get']['pageSize'] : 20;
    	$basicInfo['pageNumber']     = isset($this->data['get']['pageNumber']) ? $this->data['get']['pageNumber'] : 1;
		$basicInfo['showPage']       = showPage($counts, $basicInfo['pageSize']);
		$basicInfo['orderProperty']  = !empty($this->data['get']['orderProperty']) ? $this->data['get']['orderProperty'] : 'id';
		$basicInfo['orderDirection'] = !empty($this->data['get']['orderDirection']) ? $this->data['get']['orderDirection'] : 'desc';
		$basicInfo['recordStatus']   = isset($this->data['get']['recordStatus']) ? $this->data['get']['recordStatus'] : '';
		$basicInfo['searchProperty'] = isset($this->data['get']['searchProperty']) ? $this->data['get']['searchProperty'] : '';
		$basicInfo['searchValue']    = isset($this->data['get']['searchValue']) ? $this->data['get']['searchValue'] : '';
		$basicInfo['gid']            = $this->_userSession['gid'];
		/*
		//获取表字段
		$fieldsInfo = $this->_material->getFieldInfo($basicInfo['tableName']);
		
		//遍历原料表字段，去除X轴
		$staticfields = array();
		
        $i = 0;
        $filedInfo = array();
        foreach ($fieldsInfo as $item) {
        	if ($i == 0) {
        		$i++;
        		continue;
        	}
        	$fieldInfo['field']   = $item['Field'];
        	$fieldInfo['type']    = preg_replace('/\(\d+\)/','',$item['Type']);
        	$fieldInfo['null']    = $item['Null'];
        	$fieldInfo['default'] = $item['Default'];
        	$fieldInfo['comment'] = $item['Comment'];
        	array_push($fieldsList, $fieldInfo);
        	if ($basicInfo['xaxis'] != $item['Field'] && $item['Field'] != "field0") {
        		array_push($staticfields, array('field'=>$item['Field'],'comment'=>$item['Comment']));
        	}
        	$i++;
        }
        */
        
    	//获取表字段
		$fieldsInfo = $this->_material->getFieldUnitAndKeywords($basicInfo['tableID']);
		//遍历原料表字段，去除X轴
		$staticfields = array();
		
        $filedInfo = array();
        foreach ($fieldsInfo as $item) {
        	$fieldInfo['field']   = $item['fname'];
        	$fieldInfo['comment'] = $item['fcomment'];
        	$fieldInfo['unit']    = $item['unit'];
        	
        	array_push($fieldsList, $fieldInfo);
        	if ($basicInfo['xaxis'] != $item['fname'] && $item['fname'] != "field0") {
        		array_push($staticfields, array('field'=>$item['fname'],'comment'=>$item['fcomment'],'unit'=>$item['unit']));
        	}
        	$i++;
        }
        
        
        $basicInfo['fieldCount'] = count($fieldsList);
		
		//获取原料表所有记录
		if ($counts > 0) {
			$where   = ''; //搜索条件
			//@todo 角色权限控制
			if ($this->_userSession['gid'] == 1) {	//超级管理员
				$condition1   = true; //搜索条件
			} elseif ($this->_userSession['gid'] == 2) { //录入人员，只能查看自己录入的数据
				$condition1   = "`r_creatorid`={$this->_userSession['uid']}"; //搜索条件
			//} elseif ($this->_userSession['gid'] == 3) { //普通用户
			} else {
				$condition1   = "`r_status`=1"; //提交状态数据
			}
	    	
			//前台搜索处理
			if (!empty($basicInfo['searchValue'])) {
				if ($basicInfo['searchProperty'] == 'inputer') {
					$condition2 = "";
					//监测用户是否存在
					$searchUid = $this->_user->checkUser($basicInfo['searchValue']);
					if (!$searchUid) {
						$condition2 = false;
					} else {
						$condition2 = "`r_creatorid`={$searchUid}";
					}
				}
			} else {
				$condition2 = true;
			}
			
			//记录筛选处理
			if ($basicInfo['recordStatus'] == 1) {
				$condition3 = "`r_status`=1";
			} elseif ($basicInfo['recordStatus'] == 2) {
				$condition3 = "`r_status`=2";
			} else {
				$condition3 = true;
			}
			
			//组织查询条件
			$where = $condition1." AND ".$condition2." AND ".$condition3;
			
			//获取记录属性
	    	$recordsAttr = $this->_material->getRecordsAttrByCondition($tableID, $where);
	    	$creatorIds = $recordsAttr['creators'];//获取用户ID
	    	//获取用户名
	    	if (!empty($creatorIds)) {
	    		$userInfos = $this->_user->getUserNames($creatorIds);
	    	}
	    	
	    	//将用户名添加到$recordsAttr中
			array_pop($recordsAttr);
	    	foreach ($recordsAttr as $recordsAttrKey => $recordsAttrItem) {
	    		$uidTmp = $recordsAttrItem['r_creatorid'];
	    		$recordsAttr[$recordsAttrKey]['uname'] = $userInfos[$uidTmp]['uname'];
	    	}
	    	
			$orderProperty  = null;
			$orderDirection = null;

			$orderDirect = strtolower($basicInfo['orderDirection']) == 'desc' ? SORT_DESC : SORT_ASC;
	    	if (empty($basicInfo['orderProperty'])) {
	    		krsort($recordsAttr,SORT_NUMERIC);
	    		//$recordsAttr = array_slice($recordsAttr,($basicInfo['pageNumber']-1)*$basicInfo['pageSize'],$basicInfo['pageSize']);
	    	} elseif ($basicInfo['orderProperty'] == 'keyboarder') {
	    		//$recordsAttr = $this->_arrayColumnSort("uname", $orderDirect, SORT_STRING, "r_id", SORT_DESC, SORT_NUMERIC, $recordsAttr);
	    		$recordsAttr = $this->_array_msort($recordsAttr, array('uname'=>$orderDirect,'r_id'=>SORT_DESC));
	    		//$recordsAttr = array_slice($recordsAttr,($basicInfo['pageNumber']-1)*$basicInfo['pageSize'],$basicInfo['pageSize']);
	    	} elseif ($basicInfo['orderProperty'] == 'entryTime') {
	    		//$recordsAttr = $this->_arrayColumnSort("r_time", SORT_ASC, SORT_STRING, "r_id", SORT_DESC, SORT_NUMERIC, $recordsAttr);
	    		$recordsAttr = $this->_array_msort($recordsAttr, array('r_time'=>$orderDirect,'r_id'=>SORT_DESC));
	    		//$recordsAttr = array_slice($recordsAttr,($basicInfo['pageNumber']-1)*$basicInfo['pageSize'],$basicInfo['pageSize']);
	    	} elseif ($basicInfo['orderProperty'] == 'recordStatus') {
	    		//$recordsAttr = $this->_arrayColumnSort("r_status", $orderDirect, SORT_NUMERIC, "r_id", SORT_DESC, SORT_NUMERIC, $recordsAttr);
	    		$recordsAttr = $this->_array_msort($recordsAttr, array('r_status'=>$orderDirect,'r_id'=>SORT_DESC));
	    		//$recordsAttr = array_slice($recordsAttr,($basicInfo['pageNumber']-1)*$basicInfo['pageSize'],$basicInfo['pageSize']);
	    	} else {
	    		$orderProperty  = $basicInfo['orderProperty'];
				$orderDirection = $basicInfo['orderDirection'];
				
	    	}
	    	
			//按条件查询所有原料表记录
			$recordsId = array_keys($recordsAttr);
			
			if (!empty($recordsId)) {
	    		$records   = $this->_material->getRecords($basicInfo['tableName'], $recordsId, $orderProperty, $orderDirection, $basicInfo['pageNumber'], $basicInfo['pageSize']);
			}
	    	
	    	//合并原料表数据及其相关属性
	    	if (!empty($records)) {
		    	$recordInfo = array();
		    	
		    	if (empty($basicInfo['orderProperty'])
		    		|| $basicInfo['orderProperty'] == 'keyboarder'
		    		|| $basicInfo['orderProperty'] == 'entryTime'
		    		|| $basicInfo['orderProperty'] == 'recordStatus') {
			    	foreach ($recordsId as $recordId) {
			    		if (isset($records[$recordId])) {
				    		$recordInfo = $records[$recordId];
				    		$recordInfo['attr'] = $recordsAttr[$recordId];
				    		array_push($recordsList, $recordInfo);
			    		}
			    	}
		    	} else {
			    	foreach ($records as $recordId => $record) {
			    		$recordInfo = $record;
			    		$recordInfo['attr'] = $recordsAttr[$recordId];
			    		array_push($recordsList, $recordInfo);
			    	}
		    	}
	    	}

		}

        //2、获取原料表操作权限
        $interfaces = $this->_userSession['auth']['interfaces']['materialTable'];
        
        if (in_array('viewUpdateRecords',$interfaces)) {
        	$isExistUpdateButton = 1;
        }
        
        if (in_array('viewInsertRecords',$interfaces)) {
        	$isExistAddButton = 1;
        }
        
    	if (in_array('deleteRecords',$interfaces)) {
        	$isExistDelButton = 1;
        }

        $this->assign('isExistAddButton',$isExistAddButton);
        $this->assign('isExistDelButton',$isExistDelButton);
        $this->assign('isExistUpdateButton',$isExistUpdateButton);
        $this->assign('basicInfo',$basicInfo);
        $this->assign('fieldsInfo',$fieldsInfo);
        $this->assign("staticfields",json_encode($staticfields));
    	$this->assign('recordsList',$recordsList);
        
    	//print_r($fieldsInfo);
    	//print_r($recordsList);
    	
    	$this->setTplHtml('_materialTable/recordsManager');
		$this->display();
    }
    
	/**
     * 查看添加记录
     * 
     * GET
     * @param tableID int    表ID
     */
    public function viewInsertRecords()
    {
    	$tableID   = isset($this->data['get']['tableID']) ? $this->data['get']['tableID'] : '';
    	$tableList = array();
    	$titleList = array();
    	$fieldList = array();
    	$cols      = 1;
    	
    	//遍历原料表
    	$tablesInfo = $this->_material->getAllTablesAttr();
    	if (!empty($tablesInfo)) {
    		$currentTable = array();
    		foreach ($tablesInfo as $tableInfo) {
	    		$table['tableID']   = $tableInfo['tid'];
	    		$table['tableName'] = $tableInfo['tname'];
	    		array_push($tableList, $table);
	    		if ($tableInfo['tid'] == $tableID) {
	    			$currentTable['tableID']   = $tableInfo['tid'];
	    			$currentTable['table'] = $tableInfo['t_name'];
	    			$currentTable['classid'] = $tableInfo['classid'];
	    		}
	    	}
    	}
		
    	if ($tableID != '') {
    		//获取当前原料表的字段信息
	    	if (!empty($currentTable)) {
	    		$fullFields = $this->_material->getFieldInfo($currentTable['table']);
	    		$cols = count($fullFields);
	    		array_shift($fullFields);
	    		
	    		foreach ($fullFields as $fieldInfo) {
	    			array_push($titleList, $fieldInfo['Comment']);
	    			$field['Field']   = $fieldInfo['Field'];
	    			$field['Type']    = preg_replace('/\(\d+\)/','',$fieldInfo['Type']);
	    			$field['Null']    = $fieldInfo['Null'];
	    			$field['Default'] = $fieldInfo['Default'];
	    			array_push($fieldList, $field);
	    		}
	    	}
    	}
		//print_r($fieldList);
		
    	//年份
    	$years = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
    		array_push($years, $y);
    	}
    	//月份
    	$months = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
	    	for ($m=12; $m>=1; $m--) {
	    		$month['name'] = $y."年".$m."月";
	    		$month['value'] = $m<10 ? $y."0".$m : $y.$m;
	    		array_push($months, $month);
	    	}
    	}
    	//季度
    	$quarters = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
	    	for ($q=4; $q>=1; $q--) {
	    		$quarter['name'] = $y."年第".$q."季度";
	    		$quarter['value'] = $y.$q;
	    		array_push($quarters, $quarter);
	    	}
    	}
    	
    	$this->assign('cols',$cols);
    	$this->assign('tableID',$tableID);
    	$this->assign('tableList',$tableList);
        $this->assign('fieldList',$fieldList);
        $this->assign('titleList',$titleList);
        $this->assign('currentTable',$currentTable);
        $this->assign('provinces',Config::$cfg['province']);
        $this->assign('cities',Config::$cfg['cities']);
        $this->assign('years', $years);
        $this->assign('months', $months);
        $this->assign('quarters', $quarters);
        
    	$this->setTplHtml('_materialTable/insertRecords');
		$this->display();
    }
	
	/**
     * 查看添加记录
     * 
     * GET
     * @param tableID int    表ID
	 * @todo
     */
    public function viewInsertRecords1()
    {
    	$tableID   = isset($this->data['get']['tableID']) ? $this->data['get']['tableID'] : '';
    }
    
	/**
     * 添加记录
     * 
     * POST
     * @param tableID int    表ID
     * @param field1  string 字段1
     * @param field2  string 字段2
     * ...
     * @param recordStatus int 存储状态（1提交，2暂存）
     */
    public function insertRecords()
    {
    	$isSuccess = true;
    	$data = $this->data['post'];
    	//获取原料数据表名
    	$res = $this->_material->getTablesAttrBytid($data['tableID']);
    	$tableName   = $res['t_name'];
    	$tableComment = $tableInfo['tname'];
    	//存储类型，1提交、2暂存
    	$storageType = $data['storageType'];
    	//获取原料数据表字段及相应的值
    	$fieldArr = array();
    	$valueArr = array(); 
    	
    	foreach ($data as $field=>$vals) {
    		if ($field != 'tableID' && $field != 'storageType') {
    			array_push($fieldArr, $field);
    			$valCount = count($vals);
    			for ($i=0; $i<$valCount; $i++) {
    				if (!isset($valueArr[$i])) {
    					$valueArr[$i] = array();
    				}
    				array_push($valueArr[$i], $vals[$i]);
    			}
    		}
    	}
    	
    	//获取每个字段的数据类型
    	$fieldTypeArr = array();
    	$fieldNullArr = array();
    	$fullFields = $this->_material->getFieldInfo($tableName);
    	foreach ($fieldArr as $fieldName) {
	    	foreach ($fullFields as $fieldInfo) {
	    		if ($fieldName == $fieldInfo['Field']) {
	    			$fieldType = preg_replace('/\(\d+\)/','',$fieldInfo['Type']);
	    			array_push($fieldTypeArr,$fieldType);
	    			array_push($fieldNullArr,$fieldInfo['Null']);
	    		}
	    	}
    	}
    	
    	//组织模型所需数据
    	$fieldsStr = implode(',',$fieldArr); 
    	$sql = "INSERT INTO `{$tableName}`({$fieldsStr}) VALUES";
		
		$addSingleQuote = Config::$cfg['addSingleQuote'];
		$count = 0;
		
    	foreach ($valueArr as $items) {
    		$query = '';
    		$value = '(';
    		foreach ($items as $key=>$val) {
				if ($val != '') {
    				//判断数据字段类型与表字段类型是否一致
	    			$valueType = myGetType($val);
	    			if ($valueType == 'boolean' 
	    				|| $valueType == 'float' 
	    				|| $valueType == 'double'
	    				|| $valueType == 'integer' 
	    				|| $valueType == 'NULL' 
	    				|| $valueType == 'numeric' 
	    				) {
	    				if ($key == 0) {//如果是field1的话，数据类型类型则为字符型
	    					$tip = 'addSingleQuote';	
	    				} else {
	    					$tip = 'unAddSingleQuote';
	    				}
	    				
	    			} else {
	    				$tip = 'addSingleQuote';
	    			}
	    			
	    			if (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[0]) && $tip=='unAddSingleQuote') {
	    				$value .= "{$val},";
	    			} elseif (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[1]) && $tip=='addSingleQuote') {		
	    				$value .= "'{$val}',";
	    			} else {
	    				$this->headShow(1,'insert fieldData type is wrong',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");
	    			}
				} else {
					if ($fieldNullArr[$key] == 'YES') {//空&&值为空
	    				if (in_array(strtoupper($fieldTypeArr[$key]),$addSingleQuote[0])) {
	    					$val = 0;
	    					$value .= "{$val},";
	    				} else {
	    					$value .= "'{$val}',";
	    				}
	    			} else {
	    				$this->headShow(1,'field is empty',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");		
	    			}
				}
    		}
    		
    		$value = substr($value,0,strlen($value)-1);
    		$value .= ")";
    		$query = $sql.$value;
			
    		//file_put_contents('/var/www/material/cache/test', $query."\n", FILE_APPEND);continue;
    		$result = $this->_material->insertRecord($query,$data['tableID'],$storageType);

    		if ($result) {
    			$count++;;
    		} else {
    			$isSuccess = false;
    			break;
    		}
    	}
		
    	if ($isSuccess !== false) {
	    	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功录入表{$tableComment}（{$tableName}）记录";
			$etype     = 11;
			$tableName1 = "{$tableComment}（{$tableName}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName1,$dbName);
    		
        	$this->headShow(0,'insert records successfully',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");
        } else {
        	$this->headShow(1,'insert records failed',"admin.php?app=materialTable&act=viewInsertRecords&tableID={$data['tableID']}");
        }
    	/*
    	if ($isSuccess == false) {
    		$response['type'] = 'failed';
    		$response['content'] = "录入数据失败！";
    	} else {
    		$response['type'] = 'success';
    		$response['content'] = "成功录入{$count}条数据！";
    	}
    	
    	echo json_encode($response);
    	*/
    }
    
	/**
     * 查看更新记录
     * 
     * GET
     * @param tableID  int    表ID
     * @param recordID int  记录ID
     */
    public function viewUpdateRecords()
    {
    	//接收参数
    	$tableID  = $this->data['get']['tableID'];
    	$recordID = $this->data['get']['recordID'];

    	//列表相关参数（搜索条件、页数、排序等）
    	$basicInfo  = array();
    	$fieldsInfo = array();
    	$recordInfo = array();
    	
    	//获取表属性
    	$tableInfo = $this->_material->getTablesAttrBytid($tableID);
    	
    	//获取记录属性
    	$recordAttr = $this->_material->getRecordAttr($tableID, $recordID);
    	$basicInfo['tableID']     = $tableID;
    	$basicInfo['tableName']   = $tableInfo['t_name'];
    	$basicInfo['tableName1']  = $tableInfo['tname'];
    	$basicInfo['classid']     = $tableInfo['classid'];
    	$basicInfo['recordID']    = $recordID;
    	$basicInfo['r_status']    = $recordAttr['r_status'];
    	$basicInfo['r_creatorid'] = $recordAttr['r_creatorid'];
		$basicInfo['r_time']      = $recordAttr['r_time'];
		$basicInfo['gid']         = $this->_userSession['gid'];
		
		//根据$basicInfo['r_creatorid']获取会员名
		$creatorArr = array();
		array_push($creatorArr, $basicInfo['r_creatorid']);
    	if (!empty($creatorArr)) {
    		$userInfos = $this->_user->getUserNames($creatorArr);
    	}
    	$basicInfo['uname'] = $userInfos[1]['uname'];
		
		//获取表字段
		$fieldsInfo = $this->_material->getFieldInfo($basicInfo['tableName']);

		//获取记录
		$recordInfo = $this->_material->getRecordByID($basicInfo['tableName'], $recordID);
		
		foreach ($fieldsInfo as $key=>$item) {
			$fieldName = $item['Field'];
			//array_push($fieldsInfo[$key], $recordInfo[$fieldName]);
			$fieldTypeStr = $item['Type'];
			$fieldsInfo[$key]['Type']  = preg_replace('/\(\d+\)/','',$item['Type']);
			//计算字段长度
			if (strtolower($fieldsInfo[$key]['Type']) == 'int' || strtolower($fieldsInfo[$key]['Type']) == 'varchar') {
				$fieldTypeArr = explode('(' ,$fieldTypeStr);
				$fieldLength = substr($fieldTypeArr[1],0,strlen($fieldTypeArr[1])-1);
			} else {//否则最大长度为100
				$fieldLength = 100;
			}
			$fieldsInfo[$key]['length'] = $fieldLength;
			$fieldsInfo[$key]['value']  = $recordInfo[$fieldName];
		}
		
		//获取操作权限
		//print_r($fieldsInfo);
		
		//年份
    	$years = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
    		array_push($years, $y);
    	}
    	
    	//月份
    	$months = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
	    	for ($m=12; $m>=1; $m--) {
	    		$month['name'] = $y."年".$m."月";
	    		$month['value'] = $m<10 ? $y."0".$m : $y.$m;
	    		array_push($months, $month);
	    	}
    	}
    	//季度
    	$quarters = array();
    	for ($y=date('Y'); $y>=1990; $y--) {
	    	for ($q=4; $q>=1; $q--) {
	    		$quarter['name'] = $y."年第".$q."季度";
	    		$quarter['value'] = $y.$q;
	    		array_push($quarters, $quarter);
	    	}
    	}
    	
        $this->assign('provinces',Config::$cfg['province']);
        $this->assign('cities',Config::$cfg['cities']);
        $this->assign('years', $years);
        $this->assign('months', $months);
        $this->assign('quarters', $quarters);		
    	$this->assign('basicInfo', $basicInfo);
    	$this->assign('fieldsInfo', $fieldsInfo);
    	$this->assign('provinces',Config::$cfg['province']);
        $this->assign('cities',Config::$cfg['cities']);
        
    	$this->setTplHtml('_materialTable/editRecord');
		$this->display();
    }
    
	/**
     * 更新记录
     * 
     * POST
     * @param tableID  int    表ID
     * @param recordID int  记录ID
     * [post] => Array ( 
    		[tableID] => 1 
    		[recordID] => 13
    		[uname] => dgdfgdfg 
    		[uage] => 54 
    		[truename] => dgdfgdfg 
    		[address] => fgjhfghfgh 
    		[email] => fjfgjfg 
    	)
     * ...
     * @param recordStatus int 存储状态（1提交，2暂存）
     */
    public function updateRecords()
    {
    	$tableID  = $this->data['post']['tableID'];
    	$recordID = $this->data['post']['recordID'];
    	
    	//获取表名
    	$res = $this->_material->getTablesAttrBytid($tableID);
    	$tableName   = $res['t_name'];
    	$tableComment = $tableInfo['tname'];
    	
    	$fieldArr = array();
    	$valueArr = array();
    	foreach ($this->data['post'] as $field=>$value) {
    		if ($field == 'tableID' || $field == 'recordID') {
    			continue;
    		}
    		array_push($fieldArr, $field);
    		array_push($valueArr, $value);
    	}
    	
    	//获取表字段
		$fieldsArr = $this->_material->getFieldInfo($tableName);
		$fieldsInfo = array();
    	foreach ($fieldsArr as $i=>$fieldInfo) {
    		if ($i == 0) {
    			continue;
    		}
    		$fieldName = $fieldInfo['Field'];
    		$fieldType = $fieldInfo['Type'];
    		$fieldsInfo[$fieldName]['type'] = strtoupper(preg_replace('/\(\d+\)/','',$fieldType));
    		$fieldsInfo[$fieldName]['null'] = $fieldInfo['Null'];
    	}
		
		
    	$result = $this->_material->updateRecord($tableName,$recordID,$fieldArr,$valueArr,$fieldsInfo);
    	
    	if ($result === true) {
	    	//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功更新表{$tableComment}（{$tableName}）记录";
			$etype     = 12;
			$tableName1 = "{$tableComment}（{$tableName}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName1,$dbName);
    		
        	$this->headShow(0,'update records successfully',"admin.php?app=materialTable&act=viewUpdateRecords&tableID={$tableID}&recordID={$recordID}");
        } else {
        	$this->headShow(1,'update records failed',"admin.php?app=materialTable&act=viewUpdateRecords&tableID={$tableID}&recordID={$recordID}");
        }
    }
    
	/**
     * 删除记录
     * 
     * POST
     * @param tableID  int    表ID
     * @param recordID string 记录ID(可多条)
     */
    public function deleteRecords()
    {
    	//file_put_contents('/var/www/material/cache/deleteRecord', var_export($this->data,true), FILE_APPEND);exit();
    	$ids = array();
		if (isset($this->data['post']['id'])) {
			array_push($ids, $this->data['post']['id']);
		} elseif(isset($this->data['post']['ids'])) {
			$ids = $this->data['post']['ids'];
		}
		
		//获取原料表名
    	$tableID =  $this->data['get']['tableID'];
		$res = $this->_material->getTablesAttrBytid($tableID);
    	$tableName   = $res['t_name'];
    	$tableComment = $res['tname'];
    	
    	$res = $this->_material->delRecords($tableID,$tableName,$ids);
		
		if ($res) {
			//添加操作日志
			$uid       = $this->_userSession['uid'];
			$name      = $this->_userSession['uname'];
			$groupid   = $this->_userSession['gid'];
			$event     = "用户{$name}成功删除表{$tableComment}（{$tableName}）记录";
			$etype     = 13;
			$tableName1 = "{$tableComment}（{$tableName}）";
			$dbName    = MATERIAL_DATABASE;
			$this->operateLog->insertLog($uid,$name,$groupid,$event,$etype,$tableName1,$dbName);
			
			$result['type'] = "success";
    		$result['content'] = "删除成功！";
		} else {
			$result['type'] = "failed";
    		$result['content'] = "删除失败！";
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
	
	/**
	 * 二维数组排序（不保留键值）
	 * 
	 * @param array  $arr  二维数组
	 * @param string $keys 排序字段
	 * @param string $type 升序/降序
	 * @return array
	 */
	private function _array_sort($arr,$keys,$type='asc')
	{
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k=>$v){
			//$new_array[$k] = $arr[$k];
			array_push($new_array, $arr[$k]);
		}
		return $new_array;
	} 
	
	/**
	 * 二维数组排序（保留键值）
	 * 
	 */
	private function _arrayColumnSort()
  	{
		$n = func_num_args();
	    $ar = func_get_arg($n-1);
	    if(!is_array($ar))
	    	return false;
	
	    for($i = 0; $i < $n-1; $i++)
	      	$col[$i] = func_get_arg($i);
	
	    foreach($ar as $key => $val)
	      	foreach($col as $kkey => $vval)
	        	if(is_string($vval))
	          		${"subar$kkey"}[$key] = $val[$vval];
	
	    $arv = array();
	    foreach($col as $key => $val)
	      	$arv[] = (is_string($val) ? ${"subar$key"} : $val);
	    $arv[] = $ar;
	
	    call_user_func_array("array_multisort", $arv);
	    return $ar;
	}
	
	/**
	 * 二维数组排序
	 * @param array $array
	 * @param array $cols eg:array('name'=>SORT_DESC, 'cat'=>SORT_ASC)
	 * 
	 * eg:
	 *      $arr1 = array(
		    array('id'=>1,'name'=>'aA','cat'=>'cc'),
		    array('id'=>2,'name'=>'aa','cat'=>'dd'),
		    array('id'=>3,'name'=>'bb','cat'=>'cc'),
		    array('id'=>4,'name'=>'bb','cat'=>'dd')
			);
			$arr2 = array_msort($arr1, array('name'=>SORT_DESC, 'cat'=>SORT_ASC));
	 */
	private function _array_msort($array, $cols)
	{
	    $colarr = array();
	    foreach ($cols as $col => $order) {
	        $colarr[$col] = array();
	        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	    }
	    $params = array();
	    foreach ($cols as $col => $order) {
	        $params[] =& $colarr[$col];
	        $params = array_merge($params, (array)$order);
	    }
	    call_user_func_array('array_multisort', $params);
	    $ret = array();
	    $keys = array();
	    $first = true;
	    foreach ($colarr as $col => $arr) {
	        foreach ($arr as $k => $v) {
	            if ($first) { $keys[$k] = substr($k,1); }
	            $k = $keys[$k];
	            if (!isset($ret[$k])) $ret[$k] = $array[$k];
	            $ret[$k][$col] = $array[$k][$col];
	        }
	        $first = false;
	    }
	    return $ret;
	}
	
	/**
	 * 产生随机数
	 * 
	 */
	private function _uuid(){
	  	return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	    	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ),
	    	mt_rand( 0, 0x0fff ) | 0x4000,
	    	mt_rand( 0, 0x3fff ) | 0x8000,
	    	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ));
	}
	
	/**
	 * 产生随机文件名
	 * 
	 */
	private function _ufileName(){
	  	return sprintf('%04x-%04x-%04x-%04x-%04x',
	    	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ),
	    	mt_rand( 0, 0x0fff ) | 0x4000,
	    	mt_rand( 0, 0x3fff ) | 0x8000,
	    	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ));
	}
	
	/**
	 * 随机产生字符串
	 * 
	 * @param unknown_type $length
	 * @param unknown_type $max
	 */
	public function random_string($length, $max=FALSE)
	{
		if (is_int($max) && $max > $length) {
	    	$length = mt_rand($length, $max);
	  	}	
	  	$output = '';
	   
	  	for ($i=0; $i<$length; $i++)
	  	{
	    	$which = mt_rand(0,2);
	     
	    	if ($which === 0) {
	      		$output .= mt_rand(0,9);
	    	} elseif ($which === 1) {
	      		$output .= chr(mt_rand(65,90));
	    	} else {
	      		$output .= chr(mt_rand(97,122));
	    	}
	  	}
	  	return $output;
	}
	
	/**
     * 统计设置
     */
    public function statisticSet()
    {
		$tid = $this->data['get']['tableID'];
    	//获取所有原料表
		$tablesInfo = $this->_material->getTablesAttrBytid($tid);
		
		$this->assign('tablesInfo',$tablesInfo);
    	$this->setTplHtml('_materialTable/statisticSet');
		$this->display();
    }
	
    /**
     * 保存统计设置
     */
    public function statisticSetSave()
    {
    	$tableName     = $this->data['post']['tableName'];
    	$openStatistic = $this->data['post']['openStatistic'];
    	$fieldName     = $this->data['post']['fieldName'];
    	
    	if ($openStatistic == 1 && empty($fieldName)) {
    		$this->headShow(1,'statistic parameter is empty','admin.php?app=materialTable&act=statisticSet');
    	}
    	
    	//@todo 写入数据  待做
    	$result = $this->_material->statisticSet($tableName, $openStatistic, $fieldName);
    	
    	if ($result) {
    		$this->headShow(0,'statistic set success','admin.php?app=materialTable&act=getTablesList');
    	} else {
    		$this->headShow(1,'statistic set failed','admin.php?app=materialTable&act=statisticSet');
    	}
    }
    
    /**
     * 统计设置（Ajax响应change事件部分）
     */
    public function asyncSetChange()
    {
    	$tableName = $this->data['get']['tableName'];
    	$tableInfo = $this->_material->getFieldInfo($tableName);
		
    	//获取原料表字段
		$fieldsInfo = array();
		if (!empty($tableInfo)) {
			foreach ($tableInfo as $key=>$fieldInfo) {
				if ($fieldInfo['Field'] != 'id') {
					$item['Field']   = $fieldInfo['Field'];
					$item['Comment'] = $fieldInfo['Comment'];
					array_push($fieldsInfo, $item);
				}
			}
		}
		
		$result = array();
		$result['fieldsInfo'] = $fieldsInfo;
		
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		//获取原料表统计状态
		$result['statisticStatus'] = $tableAttr['open_statistics'];
		
		//X轴
		$result['xAxis'] = $tableAttr['xaxis'];
		
		$result = json_encode($result);
		echo $result;
    }
    
    /**
     * 统计设置（Ajax响应checked事件部分）
     */
    public function asyncSetChecked()
    {
    	$tableName = $this->data['get']['tableName'];
    	$tableInfo = $this->_material->getFieldInfo($tableName);
		
    	//获取原料表字段
		$fieldsInfo = array();
		if (!empty($tableInfo)) {
			foreach ($tableInfo as $key=>$fieldInfo) {
				if ($fieldInfo['Field'] != 'id') {
					$item['Field']   = $fieldInfo['Field'];
					$item['Comment'] = $fieldInfo['Comment'];
					array_push($fieldsInfo, $item);
				}
			}
		}
		
		$result = json_encode($fieldsInfo);
		echo $result;
    }
    
    /*
	public function needCurveData()
	{
		
		$tableName = trim($_GET['tableName']);
		$fields    = substr($_GET['fields'], 0, strlen($_GET['fields'])-1);
		
		//file_put_contents('/var/www/html/material/log', $tableName."\n".$field."\n".$comment."\n", FILE_APPEND);
		
		$datasets = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		
		//获取数值
		$statisticData = $this->_material->getStatisticsData($XAxis,$fields,$tableName);
		//获取指标
		$target = array();
		$targetsArr = $this->_material->getFieldInfo($tableName);
		foreach ($targetsArr as $targetItem) {
			$target[$targetItem['Field']] = $targetItem['Comment'];
		}
		
		$i = 0;
		foreach ($statisticData as $item) {
			foreach ($item as $field=>$value) {
				if ($field == $XAxis) {
					$datasets['ticks'][$i]  = array($i, $item[$field]);
				} else {
					$datasets[$field]['data'][$i]   = array($i, $item[$field]);
					$datasets[$field]['label'] = $target[$field];
				}
			}
			$i++;
		}
		
		//file_put_contents('/var/www/html/material/log', var_export($datasets,true), FILE_APPEND);
		
		echo json_encode($datasets);
		exit;
	}
	*/
	
	/**
	 * 获取数据（曲线图）
	 */
	public function needCurveData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = empty($_GET['field']) ? '' : $_GET['field'];
		
		//file_put_contents('/var/www/html/material/log', $tableName."\n".$field."\n".$comment."\n", FILE_APPEND);
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		$tid   = $tableAttr['tid'];
		
		//获取指标
		$target = array();
		$targetsArr = $this->_material->getFieldInfo($tableName);
		foreach ($targetsArr as $targetItem) {
			$target[$targetItem['Field']] = $targetItem['Comment'];
		}
		
		//获取Y轴单位
		$units = array();
		$unitsAndKeys = $this->_material->getFieldUnitAndKeywords($tid);
		//print_r($unitsAndKeys);
		if (!empty($unitsAndKeys)) {
			foreach ($unitsAndKeys as $fieldAttr) {
				$units[ $fieldAttr['fname'] ] = $fieldAttr['unit'];
			}
		}
		$unit = empty($units[$field]) ? '' : $units[$field];
		
		//统计分析数据（去掉全国）
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);
		//print_r($statisticData);
		$i = 0;
		foreach ($statisticData as $item) {
			if ($item[$XAxis] != "全国") {
				$data[$i]  = array($i, $item[$field]);
				$ticks[$i] = array($i, $item[$XAxis]);
				$i++;
			}
		}
		$label = $target[$field]."（单位：{$unit}）";
		
		//设置曲线颜色
		$color = "rgb(30, 180, 20)";//绿色
		$row = array('label' => $label, 'data' => $data, 'ticks'=>$ticks, 'color'=>$color);
		
		//file_put_contents('/var/www/html/material/log', var_export($row,true), FILE_APPEND);
		
		echo json_encode($row);
		exit;
	}
	
	/**
	 * 获取数据（柱状图）
	 */
	public function needBargraphData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = empty($_GET['field']) ? '' : $_GET['field'];
		//$comment   = trim($_GET['comment']);
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		$tid   = $tableAttr['tid'];
		
		//获取指标
		$target = array();
		$targetsArr = $this->_material->getFieldInfo($tableName);
		foreach ($targetsArr as $targetItem) {
			$target[$targetItem['Field']] = $targetItem['Comment'];
		}
		
		//获取Y轴单位
		$units = array();
		$unitsAndKeys = $this->_material->getFieldUnitAndKeywords($tid);
		if (!empty($unitsAndKeys)) {
			//$units[ $unitsAndKeys['fname'] ] = $unitsAndKeys['unit'];
			foreach ($unitsAndKeys as $fieldAttr) {
				$units[ $fieldAttr['fname'] ] = $fieldAttr['unit'];
			}
		}
		$unit = empty($units[$field]) ? '' : $units[$field];
		
		//获取统计数据
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);

		foreach ($statisticData as $item) {
			if ($item[$XAxis] != '全国') {
				$data[]  = array($item[$XAxis], $item[$field]);
				$ticks[] = $item[$XAxis];
			}
		}
		//$label = $comment;
		$label = $target[$field]."（单位：{$unit}）";
		
		$color = "rgb(30, 180, 20)";//绿色
		$row = array('label' => $label, 'data' => $data, 'color' => $color);
		echo json_encode($row);
		exit;
	}
	
	/**
	 * 获取数据（饼状图）
	 */
	public function needPieData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = empty($_GET['field']) ? '' : $_GET['field'];
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		$tid   = $tableAttr['tid'];
		
		//获取指标
		$target = array();
		$targetsArr = $this->_material->getFieldInfo($tableName);
		foreach ($targetsArr as $targetItem) {
			$target[$targetItem['Field']] = $targetItem['Comment'];
		}
		
		//获取Y轴单位
		$units = array();
		$unitsAndKeys = $this->_material->getFieldUnitAndKeywords($tid);
		if (!empty($unitsAndKeys)) {
			//$units[ $unitsAndKeys['fname'] ] = $unitsAndKeys['unit'];
			foreach ($unitsAndKeys as $fieldAttr) {
				$units[ $fieldAttr['fname'] ] = $fieldAttr['unit'];
			}
		}
		$unit = empty($units[$field]) ? '' : $units[$field];
		//获取数据
		
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);

		foreach ($statisticData as $i=>$item) {
			//$data[]  = array($item[$XAxis], $item[$field]);
			if ($item[$XAxis] != '全国') {
				$tmpItem['label'] = $item[$XAxis];
				$tmpItem['data']  = $item[$field];
				array_push($data, $tmpItem);
			}
		}
		$label = $target[$field]."（单位：{$unit}）";

		$row = array('label' => $label, 'data' => $data);
		echo json_encode($row);
		exit;
	}
    
}
?>