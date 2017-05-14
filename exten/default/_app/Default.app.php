<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}

/**
 * 默认页面管理控制器。
 *
 * @author yiluxiangbei<tsq7473281@163.com>
 */
class DefaultApp extends BaseAppEx
{

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

    public function index()
    {
		$this->head();
		
		//print_r($this->data);
    	//接收参数
    	$classid = empty($this->data['get']['classid']) ? 1 : $this->data['get']['classid'];
    	$tableID = $this->data['get']['tid'];
    	
    	//获取分类下所有的原料表
    	$allTables = $this->_material->getTablesAttrByClassid($classid);
    	if (empty($tableID)) {
    		$tableID = $allTables[0]['tid'];
    	}
    	
    	if (empty($tableID)) {
    		$this->notFound();
			exit();
    	}
    	
    	//$tableID = 5;

    	//列表相关参数（搜索条件、页数、排序等）
    	$basicInfo   = array();
    	$fieldsList  = array();
    	$recordsList = array();
    	
    	//根据tableID，获取原料表名
    	$tableInfo  = $this->_material->getTablesAttrBytid($tableID);
    	$basicInfo['tableID']    = $tableID;
    	$basicInfo['classid']    = $classid;
    	$basicInfo['tableName']  = $tableInfo['t_name'];
    	$basicInfo['tableComment']  = $tableInfo['tname'];
    	$basicInfo['open_statistics']  = $tableInfo['open_statistics'];
    	$basicInfo['xaxis']  = $tableInfo['xaxis'];
    	//获取原料记录个数
    	$counts = $this->_material->getRecordsCount($basicInfo['tableID']);
		$counts = $counts['count'];

		//获取总页数
		$basicInfo['recordCount']    = $counts;
		$basicInfo['pageSize']       = !empty($this->data['get']['pageSize']) ? $this->data['get']['pageSize'] : 10;
    	$basicInfo['pageNumber']     = !empty($this->data['get']['pageNumber']) ? $this->data['get']['pageNumber'] : 1;
		$basicInfo['showPage']       = showPage($counts, $basicInfo['pageSize']);
		$basicInfo['orderProperty']  = !empty($this->data['get']['orderProperty']) ? $this->data['get']['orderProperty'] : 'id';
		$basicInfo['orderDirection'] = !empty($this->data['get']['orderDirection']) ? $this->data['get']['orderDirection'] : 'desc';
		$basicInfo['gid']            = $this->_userSession['gid'];
		
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
			
			//组织查询条件
			$where = $condition1." AND ".$condition2." AND `r_status`=1";
			
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
		
		$this->assign('allTables',$allTables);
        $this->assign('basicInfo',$basicInfo);
        $this->assign('fieldsInfo',$fieldsInfo);
        $this->assign("staticfields",json_encode($staticfields));
    	$this->assign('recordsList',$recordsList);
    	
    	$this->setTplHtml('index');
		$this->display();
    }
    
    /**
     * 异步获取图表数据
     */
    public function asyncPlotData()
    {
    	//接收参数
    	$classid = $this->data['get']['classid'];//分类ID
    	$tid = $this->data['get']['tid'];//表ID
    	$shapeVal = $this->data['get']['shapeVal'];//图表类型
    	//echo $classid."\n".$tid."\n".$shapeVal;
    	
    	//如果选中,返回空
    	if (empty($shapeVal)) {
    		echo json_encode(array());
    		exit();
    	}
    	
    	//1、根据tid获取表属性
    	$tableInfo = $this->_material->getTablesAttrBytid($tid);
    	$tablename = $tableInfo['t_name'];
		
    	//2、查询material_fields_attr表
    	$fieldsList = $this->_material->getFieldUnitAndKeywords($tid);
    	$fieldsName = array();
    	$fieldsAttr = array();
    	foreach ($fieldsList as $fieldInfo) {
    		array_push($fieldsName, $fieldInfo['fname']);
    		$fieldsAttr[ $fieldInfo['fname'] ] = $fieldInfo['fcomment']."({$fieldInfo['unit']})";
    	}
    	$fieldsNameStr = implode(',', $fieldsName);
    	
		//3、在material中查询数据
		$records = array();
		$allData = $this->_material->getStatData($fieldsNameStr, $tablename);
		
		if ($shapeVal == 1) {//折线图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getCurveData($classid, $fieldsAttr,$allData);
		} elseif ($shapeVal == 2) {//柱状图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getGraphData($classid, $fieldsAttr,$allData);
		} elseif ($shapeVal == 3) {//饼状图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getPieData($classid, $fieldsAttr,$allData);
		}
		
		$returnData['plotType'] = $shapeVal;
		//print_r($returnData);
		echo json_encode($returnData);
    }
	
    /**
     * 获取折线图数据
     * 
     * @param array $fieldsAttr
     * @param array $allData
     */
    private function _getCurveData($classid, $fieldsAttr, $allData)
    {
    	$xaxises = array();
    	$data    = array();
		
    	$fields = array_keys($fieldsAttr);
    	foreach ($allData as $rowKey=>$rowInfo) {
    		if ($rowInfo['field1'] == '全国') {
    			continue;
    		}
    		
    		if ($classid == 1 || $classid == 2) {
    			$xaxises[] = array($rowKey, substr($rowInfo['field1'],0,4)."/".substr($rowInfo['field1'],4,strlen($rowInfo['field1'])-1));
    		} else {
    			$xaxises[] = array($rowKey, $rowInfo['field1']);
    		}
    		foreach ($fields as $field) {
    			if ($field != 'field1') {
    				$data[$field]['data'][] = array($rowKey, $rowInfo[$field]);
    			}
    		}
    	}
    	
    	foreach ($data as $key=>$value) {
    		$data[$key]['label'] = $fieldsAttr[$key];
    		$data[$key]['color'] = "#4572A7";
    	}
    	
    	$result['xaxis'] = $xaxises;
    	$result['data']  = array_values($data);
    	
    	return $result;
    }
    
	/**
     * 获取折线图数据
     * 
     * @param array $fieldsAttr
     * @param array $allData
     */
    private function _getGraphData($classid, $fieldsAttr, $allData)
    {
    	$data    = array();
		
    	$fields = array_keys($fieldsAttr);
    	foreach ($allData as $rowKey=>$rowInfo) {
    		if ($rowInfo['field1'] == '全国') {
    			continue;
    		}
    		
    		if ($classid == 1 || $classid == 2) {
    			$xaxis = substr($rowInfo['field1'],0,4)."/".substr($rowInfo['field1'],4,strlen($rowInfo['field1'])-1);
    		} else {
    			$xaxis = $rowInfo['field1'];
    		}
    		foreach ($fields as $field) {
    			if ($field != 'field1') {
    				$data[$field]['data'][] = array($xaxis, $rowInfo[$field]);
    			}
    		}
    	}
    	
    	foreach ($data as $key=>$value) {
    		$data[$key]['label'] = $fieldsAttr[$key];
    		//$data[$key]['color'] = "#4572A7";
    	}
    	
    	$result['data']  = array_values($data);
    	
    	return $result;
    	
    }
    
	/**
     * 获取折线图数据
     * 
     * @param array $fieldsAttr
     * @param array $allData
     */
    private function _getPieData($classid, $fieldsAttr, $allData)
    {
    	$data   = array();
    	
    	$fields = array_keys($fieldsAttr);
    	foreach ($allData as $rowKey=>$rowInfo) {
    		if ($rowInfo['field1'] == '全国') {
    			continue;
    		}
    		
    		if ($classid == 1 || $classid == 2) {
    			$xaxis = substr($rowInfo['field1'],0,4)."/".substr($rowInfo['field1'],4,strlen($rowInfo['field1'])-1);
    		} else {
    			$xaxis = $rowInfo['field1'];
    		}
    		foreach ($fields as $field) {
    			if ($field != 'field1') {
    				$data[$field]['data'][] = array('label'=>$xaxis, 'data'=>$rowInfo[$field]);
    			}
    		}
    	}
    	
    	foreach ($data as $key=>$value) {
    		$data[$key]['label'] = $fieldsAttr[$key];
    		//$data[$key]['color'] = "#4572A7";
    	}
    	
    	$result['data']  = array_values($data);
    	
    	return $result;
    	
    }
}