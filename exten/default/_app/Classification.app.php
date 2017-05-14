<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}

/**
 * 分类页面管理控制器。
 *
 * @author yiluxiangbei<tsq7473281@163.com>
 */
class ClassificationApp extends BaseAppEx
{
	private $_quotaClass; //指标分类model
	private $_quota;	//指标数据模型
	private $_materialTable	;
	
	/**
	 * 初始化模型
	 */
	public function init()
	{
		$this->_quotaClass = &$this->getModel('quotaClass');
		$this->_quota      = &$this->getModel('quota');
		$this->_materialTable = &$this->getModel('materialTable');
	}
	
	/**
	 * 分类页面控制器
	 */
    public function index()
    {
		global $selectArr;
		//接收参数
		$classid = intval($this->data['get']['classid']);
		$quotaid = intval($this->data['get']['quotaid']);
		$tableId = intval($this->data['get']['tid']);//原料表id（此参数使用于分省或主要城市数据）
		$field   = $this->data['get']['field'];//字段名（此参数使用于分省或主要城市数据）
		
		if (!$quotaid) { //如果没有传指标id,则获取该分类下的最新的一个指标id
			$quotaRecord = $this->_quota->getQuotaByclassId($classid);
			//print_r($quotaRecord);
			if ($quotaRecord) {
				$quotaid = $quotaRecord['quotaid'];
			}
		}
		//如果原料表分类下没有指标，则返回到首页
		if (empty($quotaid)) {
			$this->notFound();
			exit();
		}
		
    	//头部展示
		$this->head();
		
		//1、根据classid获取指标分类
		$qutoaClassesInfo = $this->_quotaClass->getQuotaClassByClassID($classid);
		
		$leftMenu = '';
		$leftMenuData = array();
		if (!empty($qutoaClassesInfo)) {
			//2、获取所有指标分类ID
			$quotaCids = array();
			foreach ($qutoaClassesInfo as $quotaClassInfo) {
				array_push($quotaCids, $quotaClassInfo['qcid']);
			}
			
			//3、获取指标分类下的所有指标
			$quotaCidsStr = implode(',', $quotaCids);
			
			$quotasInfo = $this->_quota->getQuotasByQcids($quotaCidsStr);
			
			
			//整理指标数据 以及 获取已打开状态的指标分类
			$quotasList   = array();
			$openClassId  = '';
			$currentQuota = array();
			foreach ($quotasInfo as $quotaInfo) {
				$quotasList[$quotaInfo['qcid']][] = array(
					'quotaid' => $quotaInfo['quotaid'],
					'quotaname' => $quotaInfo['quotaname']
				);
				if ($quotaInfo['quotaid'] == $quotaid) {
					$openClassId  = $quotaInfo['qcid'];
					$currentQuota = unserialize($quotaInfo['quotacontent']);
				}
				
			}
			
			//获取所有打开状态的指标分类
			$openClassIds = array();
			foreach ($qutoaClassesInfo as $quotaClassInfo) {
				//array_push($quotaCids, $quotaClassInfo['qcid']);
				if ($openClassId == $quotaClassInfo['qcid']) {
					$openClassIds = explode(',' ,substr($quotaClassInfo['ancestors'],2,(strlen($quotaClassInfo['ancestors'])-2)));
				}
			}
			
			//生成前端HTML代码
			$leftMenu = $this->createMenuTree($qutoaClassesInfo, $quotasList, $openClassIds, $classid, $quotaid);
			$leftMenu = "<dl>".$leftMenu;
			//echo $leftMenu;
			
			//获取指标数据
			$quotaData = $this->_getQuotaData($currentQuota, $classid, $tableId, $field);
			
			//生成模板变量
			$varModule = $this->_createModuleVar($classid, $quotaid, $quotaData);
		}
		
		$this->assigns(array(
			'classid'   => $classid,
			'quotaid'   => $quotaid,
			'tid'       => $tableId,
			'field'     => $field,
			'leftMenu'  => $leftMenu,
			'varModule' => $varModule,
			'yaxises'   => json_encode($quotaData['yaxis']),
        ));
    	$this->setTplHtml('class');
		$this->display();
    }
    
    /**
     * 获取指标数据
     * 
     * @param array $quotacontent
     * @param int   $classid
     */
    private function _getQuotaData($currentQuota, $classid, $crrentTableId, $currentField)
    {
		//print_r($currentQuota);
		//echo $classid."\n";
		//echo $crrentTableId."\n";
		//echo $currentField."\n";
    	
    	$result = array();
    	//print_r($currentQuota);
		//1获取所有的表名
		$tableIds = array_keys($currentQuota);
		$tableIdsStr = implode(',', $tableIds);
		$tablesInfo =$this->_materialTable->getTablesInfo($tableIdsStr);
		//print_r($tablesInfo);
		//获取字段名称
		$quotaFieldNames = array();
		foreach ($currentQuota as $val) {
			foreach ($val as $val1) {
				array_push($quotaFieldNames,$val1);
			}
		}
		$quotaFields = $this->_quota->getQuotaFields($tableIds, $quotaFieldNames);
		//print_r($quotaFields);
		
    	//2获取数据x轴数据及展示数据
		$timeData = array();
		$quotaDatas = array();
		$yaxis = array();
		if (Config::$cfg['classType'][$classid] == 1) {
			$i = 0;
			foreach ($tablesInfo as $tableInfo) {
				//获取时间序列
				$quotaFieldsPart = implode(',', $currentQuota[$tableInfo['tid']]);
				if (Config::$cfg['classType'][$classid] == 1) {
					$quotaFieldsPart = $quotaFieldsPart.",field1";
				}
				
				$order = " ORDER BY `field1` DESC";
				$tmpsInfo = $this->_quota->getDataByFields($tableInfo['t_name'], $quotaFieldsPart, $order);
				foreach ($tmpsInfo as $tmpItemData) {
					if ($i == 0) {
						array_push($timeData, $tmpItemData['field1']);
					}
					
					foreach ($tmpItemData as $field=>$fieldVal) {
						if ($field != 'field0' && $field != 'field1') {
							$key = $tableInfo['tid']."_".$field;
							$quotaDatas[$key]['data'][] = $fieldVal;
						}
					}
				}
			}

			foreach ($quotaDatas as $k=>$v) {
				foreach ($quotaFields as $fieldInfo) {
					if ($k == ($fieldInfo['tid']."_".$fieldInfo['fname'])) {
						$quotaDatas[$k]['quotaName'] = $fieldInfo['fcomment']."（{$fieldInfo['unit']}）";
						$y['name'] = $k;
						$y['comment'] = $fieldInfo['fcomment'];
						array_push($yaxis, $y);
						$tmpfiedsList[$k] = 1;
					}
					
				}
			}

		} elseif (Config::$cfg['classType'][$classid] == 2) {
			if (empty($crrentTableId) || empty($currentField)) {//初始选择指标字段
				$crrentTableId = $quotaFields[0]['tid'];
				$currentField  = $quotaFields[0]['fname'];
			}	
			//组织待查询的字段
			//$fieldsStr = "field0,field1,{$currentField}";
			$fieldsStr = "field1,{$currentField}";
			//获取当前表名
			foreach ($tablesInfo as $tableAttr) {
				if ($tableAttr['tid'] == $crrentTableId) {
					$tablename = $tableAttr['t_name'];
				}
			}
			
			$order = " ORDER BY `id` DESC";
			$tmpsInfo = $this->_quota->getDataByFields($tablename, $fieldsStr, $order);
			
			foreach ($tmpsInfo as $tmpItem) {
				array_push($timeData, $tmpItem['field0']);
				$quotaDatas[$tmpItem['field1']]['quotaName'] = $tmpItem['field1'];
				$quotaDatas[$tmpItem['field1']]['data'][] = $tmpItem[$currentField];
				array_push($yaxis, $tmpItem['field1']);
			}
			
			//获取指标列表
			foreach ($quotaFields as $fieldKey=>$fieldInfo) {
				if ($fieldInfo['tid'] == $crrentTableId && $fieldInfo['fname'] == $currentField) {
					$quotaFields[$fieldKey]['selected'] = 1;
				} else {
					$quotaFields[$fieldKey]['selected'] = 0;
				}
			}
			
			$yaxis = array_unique($yaxis);			
		}
		
		//删除重复项
		$timeData = array_unique($timeData);
		$quotaDatas = array_values($quotaDatas);
		
		//print_r($quotaFields);
		//print_r($timeData);
		//print_r($quotaDatas);
		
		$result['timeData'] = $timeData;//日期序列
		$result['quotaDatas'] = $quotaDatas;//列表展示数据
		$result['tablesInfo'] = $tablesInfo;//该指标下的所有原料表信息
		$result['quotaFields'] = $quotaFields;//该指标下的所有字段信息
		$result['yaxis'] = $yaxis;
		
		return $result;
			
		
    }
    
    /**
     * 异步获取图表数据
     */
    public function asyncPlotData()
    {
    	//接收参数
    	//print_r($this->data);
    	$classid = $this->data['get']['classid'];//分类ID
    	$quotaid = $this->data['get']['quotaid'];//指标ID
    	$tid = $this->data['get']['tid'];//表ID
    	$field    = $this->data['get']['field'];//字段
    	$shapeVal = $this->data['get']['shapeVal'];//图表类型
    	$selectedItem = $this->data['post']['selectedItem'];//被选中要展示的数据
    	
    	//如果无指标选中,返回空
    	if (empty($selectedItem)) {
    		echo json_encode(array());
    		exit();
    	}
    	//print_r($selectedItem);
    	//$selectedItem = explode('&', str_replace('selectedItem=','',$selectedItem));
    	
    	//1、根据quotaid获取quotacontent
    	$quotaAttr = $this->_quota->getQuotaInfoById($quotaid);
    	$quotaContent = unserialize($quotaAttr['quotacontent']);
    	
    	//2、获取所有表id
    	$tableIds    = array_keys($quotaContent);
		$tableIdsStr = implode(',', $tableIds);
		$tablesInfo  = $this->_materialTable->getTablesInfo($tableIdsStr);
		
		//3、获取所有字段属性
		$quotaFieldNames = array();
		foreach ($quotaContent as $val) {
			foreach ($val as $val1) {
				array_push($quotaFieldNames,$val1);
			}
		}
		$quotaFields = $this->_quota->getQuotaFields($tableIds, $quotaFieldNames);
    	
		if ($shapeVal == 1) {//折线图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getCurveData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields);
		} elseif ($shapeVal == 2) {//柱状图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getGraphData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields);
		} elseif ($shapeVal == 3) {//饼状图
			$xaxisData = array();
			$data = array();
			$returnData = $this->_getPieData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields);
		}
		
		$returnData['plotType'] = $shapeVal;
		echo json_encode($returnData);
    }
    
    /**
     * 获取曲线图数据
     * 
     * @param int $classid
     * @param int $quotaid
     * @param int $tid
     * @param string $field
     * @param array $selectedItem
     */
    private function _getCurveData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields)
    {
    	$xaxisArr = array();
    	$dataArr  = array();
    	
    	if (Config::$cfg['classType'][$classid] == 1) {//年度数据、月度数据、季度数据
    		foreach ($tablesInfo as $tableInfo) {
    			//获取指标中的字段
    			$quotaFieldsPart = $quotaContent[$tableInfo['tid']];

    			//过滤字段
    			$fields = array();
    			foreach ($quotaFieldsPart as $quotaField) {
    				if (in_array($tableInfo['tid']."_".$quotaField,$selectedItem)) {
    					array_push($fields, $quotaField);
    				}
    			}
    			//如果该表没有查询字段，则略过
				if (empty($fields)) {
					continue;
				}
				
    			$fieldsStr = implode(',', $fields);
    			$fieldsStr .= ",field1";
    			//echo $fieldsStr;
    			//查询数据
    			$order = " ORDER BY `field1` DESC";
    			$tmpsData = $this->_quota->getDataByFields($tableInfo['t_name'], $fieldsStr, $order);
    			
    			foreach ($tmpsData as $kData=>$tmpsDataSon) {
    				$xaxisAllArr[$tableInfo['tid']][] = $tmpsDataSon['field1'];

    				foreach ($fields as $fieldItem) {
    					$key = $tableInfo['tid']."_".$fieldItem;
    					//$dataArr[$key]['color'] = "#4572A7";
    					$dataArr[$key]['data'][] = array($kData,$tmpsDataSon[$fieldItem]);
	    				if (!isset($dataArr[$key]['label'])) {
	    					foreach ($quotaFields as $fieldInfo) {
		    					if ($fieldInfo['tid'] == $tableInfo['tid'] && $fieldInfo['fname'] == $fieldItem) {
		    						$dataArr[$key]['label'] = $fieldInfo['fcomment']."(".$fieldInfo['unit'].")";
		    					}
		    				}
	    				}
    				}
    			}
    		}
			
	    	if (!empty($xaxisAllArr)){
	    		//校验数据（获取个数最多的）
	    		$xaxisArr = array();
	    		foreach ($xaxisAllArr as $xaxis) {
	    			if (count($xaxis) > count($xaxisArr)) {
	    				$xaxisArr = $xaxis;
	    			}
	    		}
	    	}
    		//图表下面的选择按钮
			//$selectBtns = array_keys($dataArr);
			
    	} elseif (Config::$cfg['classType'][$classid] == 2) {//地区数据
    		if (empty($tid) || empty($field)) {//初始选择指标字段
				$tid = $quotaFields[0]['tid'];
				$field  = $quotaFields[0]['fname'];
			}
			
			//组织待查询的字段
			$fieldsStr = "field0,field1,{$field}";
			//获取当前表名
			foreach ($tablesInfo as $tableAttr) {
				if ($tableAttr['tid'] == $tid) {
					$tablename = $tableAttr['t_name'];
				}
			}

			$order = " ORDER BY `field0` DESC";
			$tmpsInfo = $this->_quota->getDataByFields($tablename, $fieldsStr, $order);
			
			foreach ($tmpsInfo as $tmpKey=>$tmpItem) {
				array_push($xaxisArr, $tmpItem['field0']);
				//过滤字段
				if (in_array($tmpItem['field1'], $selectedItem)) {
					$dataArr[$tmpItem['field1']]['label'] = $tmpItem['field1'];
					if (isset($dataArr[$tmpItem['field1']]['data'])) {
						$dataArr[$tmpItem['field1']]['data'][] = array(count($dataArr[$tmpItem['field1']]['data']),$tmpItem[$field]);
					} else {
						$dataArr[$tmpItem['field1']]['data'][] = array(0,$tmpItem[$field]);
					}
					
				}
			}
			$xaxisArr = array_values(array_unique($xaxisArr));
			//图表下面的选择按钮
			//$selectBtns = array_keys($dataArr);
    	}
		
		$dataArr = array_values($dataArr);
    	//为第一条曲线设置颜色
    	foreach ($dataArr as $dataArrKey=>$dataArrValue) {
    		$dataArr[$dataArrKey]['color'] = "#4572A7";
    		break;
    	}
    	
    	//整理X轴数据
    	$xaiaxes = array();
    	foreach ($xaxisArr as $ticks1Key=>$ticks1Val) {			
    		$xaiaxes['ticks'][$ticks1Key] = $ticks1Val;
    	}
    	
    	$xaiaxes['min'] = 0;
    	$xaiaxes['max'] = count($xaxisArr)-1;
    	
    	foreach ($xaiaxes['ticks'] as $tKey=>$tick) {
    		if ($classid == 1 || $classid == 5 || $classid == 8) {//月度
    			$dateArr[0] = substr($tick,0,4);
				$dateArr[1] = substr($tick,4,strlen($tick)-4);
    			$xaiaxes['ticks'][$tKey] = array($tKey, $dateArr[0]."年".$dateArr[1]."月");
    		} elseif($classid == 2 || $classid == 6) {//季度
    			$dateArr[0] = substr($tick,0,4);
				$dateArr[1] = substr($tick,4,strlen($tick)-4);
    			$xaiaxes['ticks'][$tKey] = array($tKey, $dateArr[0]."年第".$dateArr[1]."季度");
    		} elseif($classid == 3 || $classid == 7 || $classid == 9) {//年度
    			$xaiaxes['ticks'][$tKey] = array($tKey, $tick."年");
    		}
    	}

    	
    	$result['xaxis'] = $xaiaxes;
    	$result['data']  = $dataArr;

    	return $result;
    }
    
	/**
     * 获取柱状图数据
     * 
     * @param int $classid
     * @param int $quotaid
     * @param int $tid
     * @param string $field
     * @param array $selectedItem
     */
    private function _getGraphData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields)
    {
    	$namesList = array();
    	$dataArr  = array();
    	
    	if (Config::$cfg['classType'][$classid] == 1) {//年度数据、月度数据、季度数据
    		foreach ($tablesInfo as $tableInfo) {
    			//获取指标中的字段
    			$quotaFieldsPart = $quotaContent[$tableInfo['tid']];

    			//过滤字段
    			$fields = array();
    			foreach ($quotaFieldsPart as $quotaField) {
    				if (in_array($tableInfo['tid']."_".$quotaField,$selectedItem)) {
    					array_push($fields, $quotaField);
    				}
    			}
    			//如果该表没有查询字段，则略过
				if (empty($fields)) {
					continue;
				}
				
    			$fieldsStr = implode(',', $fields);
    			$fieldsStr .= ",field1";
    			//echo $fieldsStr;
    			//查询数据
    			$order = " ORDER BY `field1` DESC";
    			$tmpsData = $this->_quota->getDataByFields($tableInfo['t_name'], $fieldsStr, $order);
    			
    			foreach ($tmpsData as $kData=>$tmpsDataSon) {
    				
		    		if ($classid == 1) {//月度
		    			$dateArr[0] = substr($tmpsDataSon['field1'],0,4);
						$dateArr[1] = substr($tmpsDataSon['field1'],4,strlen($tmpsDataSon['field1'])-4);
		    			$keyValue = $dateArr[0]."年".$dateArr[1]."月";
		    		} elseif($classid == 2) {//季度
		    			$dateArr[0] = substr($tmpsDataSon['field1'],0,4);
						$dateArr[1] = substr($tmpsDataSon['field1'],4,strlen($tmpsDataSon['field1'])-4);
		    			$keyValue = $dateArr[0]."年第".$dateArr[1]."季度";
		    		} elseif($classid == 3) {//年度
		    			$keyValue = $tmpsDataSon['field1']."年";
		    		}

    				foreach ($fields as $fieldItem) {
    					$key = $tableInfo['tid']."_".$fieldItem;
    					$dataArr[$key][] = array($keyValue, $tmpsDataSon[$fieldItem]);
    				}
    			}
    		}
    		
    		//获取前端选中的所有指标名称
    		$quotanameInfoList = array_keys($dataArr);
    		foreach ($quotanameInfoList as $quotanameInfoListVal) {
    			foreach ($quotaFields as $quotaFieldsVal) {
    				if ($quotanameInfoListVal == $quotaFieldsVal['tid']."_".$quotaFieldsVal['fname']) {
    					array_push($namesList, $quotaFieldsVal['fcomment']);
    				}
    			}
    		}

    	} elseif (Config::$cfg['classType'][$classid] == 2) {//地区数据
    		if (empty($tid) || empty($field)) {//初始选择指标字段
				$tid = $quotaFields[0]['tid'];
				$field  = $quotaFields[0]['fname'];
			}
			
			//组织待查询的字段
			$fieldsStr = "field0,field1,{$field}";
			//获取当前表名
			foreach ($tablesInfo as $tableAttr) {
				if ($tableAttr['tid'] == $tid) {
					$tablename = $tableAttr['t_name'];
				}
			}

			$order = " ORDER BY `field0` DESC";
			$tmpsInfo = $this->_quota->getDataByFields($tablename, $fieldsStr, $order);
			
			foreach ($tmpsInfo as $tmpKey=>$tmpItem) {
				//array_push($xaxisArr, $tmpItem['field0']);
				//过滤字段
				if (in_array($tmpItem['field1'], $selectedItem)) {
					
					
					if ($classid == 5 || $classid == 8) {//月度
		    			$dateArr[0] = substr($tmpItem['field0'],0,4);
						$dateArr[1] = substr($tmpItem['field0'],4,strlen($tmpItem['field0'])-4);
		    			$keyValue = $dateArr[0]."年".$dateArr[1]."月";
		    		} elseif($classid == 6) {//季度
		    			$dateArr[0] = substr($tmpItem['field0'],0,4);
						$dateArr[1] = substr($tmpItem['field0'],4,strlen($tmpItem['field0'])-4);
		    			$keyValue = $dateArr[0]."年第".$dateArr[1]."季度";
		    		} elseif($classid == 7 || $classid == 9) {//年度
		    			$keyValue = $tmpItem['field0']."年";
		    		}
					
					$dataArr[$tmpItem['field1']][] = array($keyValue, $tmpItem[$field]);
				}
			}
			$namesList = array_keys($dataArr);
    	}
		
    	$dataArr = array_values($dataArr);
    	
    	//print_r($dataArr);
    	//print_r($namesList);
    	
    	$result['namesList'] = $namesList;
    	$result['data']  = $dataArr;

    	return $result;
    }
    
	/**
     * 获取饼状图数据
     * 
     * @param int $classid
     * @param int $quotaid
     * @param int $tid
     * @param string $field
     * @param array $selectedItem
     */
    private function _getPieData($classid,$quotaid,$tid,$field,$selectedItem,$quotaContent,$tablesInfo,$quotaFields)
    {
    	$dataArr  = array();
    	$namesList = array();
    	
    	if (Config::$cfg['classType'][$classid] == 1) {//年度数据、月度数据、季度数据
    		foreach ($tablesInfo as $tableInfo) {
    			//获取指标中的字段
    			$quotaFieldsPart = $quotaContent[$tableInfo['tid']];

    			//过滤字段
    			$fields = array();
    			foreach ($quotaFieldsPart as $quotaField) {
    				if (in_array($tableInfo['tid']."_".$quotaField,$selectedItem)) {
    					array_push($fields, $quotaField);
    				}
    			}
    			//如果该表没有查询字段，则略过
				if (empty($fields)) {
					continue;
				}
				
    			$fieldsStr = implode(',', $fields);
    			$fieldsStr .= ",field1";
    			//echo $fieldsStr;
    			//查询数据
    			$order = " ORDER BY `field1` DESC";
    			$tmpsData = $this->_quota->getDataByFields($tableInfo['t_name'], $fieldsStr, $order);
    			
    			foreach ($tmpsData as $kData=>$tmpsDataSon) {
    				
		    		if ($classid == 1) {//月度
		    			$dateArr[0] = substr($tmpsDataSon['field1'],0,4);
						$dateArr[1] = substr($tmpsDataSon['field1'],4,strlen($tmpsDataSon['field1'])-4);
		    			$keyValue = $dateArr[0]."年".$dateArr[1]."月";
		    		} elseif($classid == 2) {//季度
		    			$dateArr[0] = substr($tmpsDataSon['field1'],0,4);
						$dateArr[1] = substr($tmpsDataSon['field1'],4,strlen($tmpsDataSon['field1'])-4);
		    			$keyValue = $dateArr[0]."年第".$dateArr[1]."季度";
		    		} elseif($classid == 3) {//年度
		    			$keyValue = $tmpsDataSon['field1']."年";
		    		}

    				foreach ($fields as $fieldItem) {
    					$key = $tableInfo['tid']."_".$fieldItem;
    					$dataArr[$key][] = array(
    						'label' => $keyValue, 
    						'data'  => $tmpsDataSon[$fieldItem]
    					);
    				}
    			}
    		}
    		
    		//获取前端选中的所有指标名称
    		$quotanameInfoList = array_keys($dataArr);
    		foreach ($quotanameInfoList as $quotanameInfoListVal) {
    			foreach ($quotaFields as $quotaFieldsVal) {
    				if ($quotanameInfoListVal == $quotaFieldsVal['tid']."_".$quotaFieldsVal['fname']) {
    					array_push($namesList, $quotaFieldsVal['fcomment']);
    				}
    			}
    		}

    	} elseif (Config::$cfg['classType'][$classid] == 2) {//地区数据
    		if (empty($tid) || empty($field)) {//初始选择指标字段
				$tid = $quotaFields[0]['tid'];
				$field  = $quotaFields[0]['fname'];
			}
			
			//组织待查询的字段
			$fieldsStr = "field0,field1,{$field}";
			//获取当前表名
			foreach ($tablesInfo as $tableAttr) {
				if ($tableAttr['tid'] == $tid) {
					$tablename = $tableAttr['t_name'];
				}
			}

			$order = " ORDER BY `field0` DESC";
			$tmpsInfo = $this->_quota->getDataByFields($tablename, $fieldsStr, $order);
			
			foreach ($tmpsInfo as $tmpKey=>$tmpItem) {
				//array_push($xaxisArr, $tmpItem['field0']);
				//过滤字段
				if (in_array($tmpItem['field1'], $selectedItem)) {
					
					
					if ($classid == 5 || $classid == 8) {//月度
		    			$dateArr[0] = substr($tmpItem['field0'],0,4);
						$dateArr[1] = substr($tmpItem['field0'],4,strlen($tmpItem['field0'])-4);
		    			$keyValue = $dateArr[0]."年".$dateArr[1]."月";
		    		} elseif($classid == 6) {//季度
		    			$dateArr[0] = substr($tmpItem['field0'],0,4);
						$dateArr[1] = substr($tmpItem['field0'],4,strlen($tmpItem['field0'])-4);
		    			$keyValue = $dateArr[0]."年第".$dateArr[1]."季度";
		    		} elseif($classid == 7 || $classid == 9) {//年度
		    			$keyValue = $tmpItem['field0']."年";
		    		}
					
					$dataArr[$tmpItem['field1']][] = array('label'=>$keyValue, 'data'=>$tmpItem[$field]);
				}
			}
			$namesList = array_keys($dataArr);
    	}
		
    	$dataArr = array_values($dataArr);
    	
    	//print_r($dataArr);
    	//print_r($namesList);
    	
    	$result['namesList'] = $namesList;
    	$result['data']  = $dataArr;

    	return $result;
    }
    
	/**
     * 生成模板变量
     * 
     * @param int   $classid
     * @param array $quotaData
     */
    private function _createModuleVar($classid, $quotaid, $quotaData)
    {
    	//print_r($quotaData);
    	$timeData    = $quotaData['timeData'];//日期序列
    	rsort($timeData);//降序
		$quotaDatas  = $quotaData['quotaDatas'];//列表展示数据
		$tablesInfo  = $quotaData['tablesInfo'];//该指标下的所有原料表信息
		$quotaFields = $quotaData['quotaFields'];//该指标下的所有字段信息
    	
    	$selectHtml = array();
		$tableThHtml = '';
    	
		//1、生成查询条件
		if ($classid == 1) {//月度数据
			$selectHtml['firstCondition'] .= "地区：<select name=\"area\">";
			$selectHtml['firstCondition'] .= "<option>全国</option>";
			$selectHtml['firstCondition'] .= "</select>";
			
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>指标</th>";
			foreach ($timeData as $dataItem) {
				$i++;
				$dateArr = array();
				$dateArr[0] = substr($dataItem,0,4);
				$dateArr[1] = substr($dataItem,4,strlen($dataItem)-4);
				//$data = explode("/", $dataItem);
				
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dateArr[0]}\" selected=\"selected\">{$dateArr[0]}年</option>";
				} else {
					$yearList .= "<option value=\"{$dateArr[0]}\">{$dateArr[0]}年</option>";
				}
				$tableThHtml .= "<th>{$dateArr[0]}年{$dateArr[1]}月</th>";
			}
			$yearList .= "</select>";
			
			$monthList = '<select name=\"startTime1\">';
			for ($m=1; $m<=12; $m++) {
				$monthList .= "<option value=\"{$m}\">{$m}月</option>";
			}
			$monthList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= $monthList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
		} elseif ($classid == 2) {//季度数据
			$selectHtml['firstCondition'] .= "地区：<select name=\"area\">";
			$selectHtml['firstCondition'] .= "<option>全国</option>";
			$selectHtml['firstCondition'] .= "</select>";
			
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>指标</th>";
			foreach ($timeData as $dataItem) {
				$i++;
				$dateArr = array();
				$dateArr[0] = substr($dataItem,0,4);
				$dateArr[1] = substr($dataItem,4,strlen($dataItem)-4);
				//$data = explode("/", $dataItem);
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dateArr[0]}\" selected=\"selected\">{$dateArr[0]}年</option>";
				} else {
					$yearList .= "<option value=\"{$dateArr[0]}\">{$dateArr[0]}年</option>";
				}
				$tableThHtml .= "<th>{$dateArr[0]}年第{$dateArr[1]}季度</th>";
			}
			$yearList .= "</select>";
			
			$quarterList = '<select name=\"startTime1\">';
			for ($q=1; $q<=4; $q++) {
				$quarterList .= "<option value=\"{$q}\">第{$q}季度</option>";
			}
			$quarterList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= $quarterList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
			
		} elseif ($classid == 3) {//年度数据
			$selectHtml['firstCondition'] .= "地区：<select name=\"area\">";
			$selectHtml['firstCondition'] .= "<option>全国</option>";
			$selectHtml['firstCondition'] .= "</select>";
			
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>指标</th>";
			foreach ($timeData as $dataItem) {
				$i++;
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dataItem}\" selected=\"selected\">{$dataItem}年</option>";
				} else {
					$yearList .= "<option value=\"{$dataItem}\">{$dataItem}年</option>";
				}
				$tableThHtml .= "<th>{$dataItem}年</th>";
			}
			$yearList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
			
		} elseif ($classid == 5 || $classid == 8) {//分省月度数据
			$selectHtml['firstCondition'] .= "选择指标：<select id=\"field\" name=\"field\" style=\"width:120px\">";
			foreach ($quotaFields as $fieldAttr) {
				if ($fieldAttr['selected'] == 1) {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&quotaid={$quotaid}&tid={$fieldAttr['tid']}&field={$fieldAttr['fname']}\" selected=\"selected\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";	
				} else {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&quotaid={$quotaid}&tid={$fieldAttr['tid']}&field={$fieldAttr['fname']}\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";
				}
				
			}
			$selectHtml['firstCondition'] .= "</select>";
			
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>地区</th>";
			
			//print_r($timeData);
			foreach ($timeData as $dataItem) {
				$i++;
				$dateArr = array();
				$dateArr[0] = substr($dataItem,0,4);
				$dateArr[1] = substr($dataItem,4,strlen($dataItem)-4);
				//$data = explode("/", $dataItem);
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dateArr[0]}\" selected=\"selected\">{$dateArr[0]}年</option>";
				} else {
					$yearList .= "<option value=\"{$dateArr[0]}\">{$dateArr[0]}年</option>";
				}
				$tableThHtml .= "<th>{$dateArr[0]}年{$dateArr[1]}月</th>";
			}
			$yearList .= "</select>";
			
			$monthList = '<select name=\"startTime1\">';
			for ($m=1; $m<=12; $m++) {
				$monthList .= "<option value=\"{$m}\">{$m}月</option>";
			}
			$monthList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= $monthList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
			
		} elseif ($classid == 6) {//分省季度数据
			$selectHtml['firstCondition'] .= "选择指标：<select id=\"field\" name=\"field\" style=\"width:120px\">";
			foreach ($quotaFields as $fieldAttr) {
				if ($fieldAttr['selected'] == 1) {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&quotaid={$quotaid}&tid={$fieldAttr['tid']}&field={$fieldAttr['fname']}\" selected=\"selected\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";	
				} else {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&quotaid={$quotaid}&tid={$fieldAttr['tid']}&field={$fieldAttr['fname']}\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";
				}
				
			}
			$selectHtml['firstCondition'] .= "</select>";
			
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>地区</th>";
			foreach ($timeData as $dataItem) {
				$i++;
				$dateArr = array();
				$dateArr[0] = substr($dataItem,0,4);
				$dateArr[1] = substr($dataItem,4,strlen($dataItem)-4);
				//$data = explode("/", $dataItem);
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dateArr[0]}\" selected=\"selected\">{$dateArr[0]}年</option>";
				} else {
					$yearList .= "<option value=\"{$dateArr[0]}\">{$dateArr[0]}年</option>";
				}
				$tableThHtml .= "<th>{$dateArr[0]}年第{$dateArr[1]}季度</th>";
			}
			$yearList .= "</select>";
			
			$quarterList = '<select name=\"startTime1\">';
			for ($q=1; $q<=4; $q++) {
				$quarterList .= "<option value=\"{$q}\">第{$q}季度</option>";
			}
			$quarterList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= $quarterList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
			
		} elseif ($classid == 7 || $classid == 9) {//分省年度数据
			$selectHtml['firstCondition'] .= "选择指标：<select id=\"field\" name=\"field\" style=\"width:120px\">";
			foreach ($quotaFields as $fieldAttr) {
				if ($fieldAttr['selected'] == 1) {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&tid={$fieldAttr['tid']}&quotaid={$quotaid}&field={$fieldAttr['fname']}\" selected=\"selected\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";	
				} else {
					$selectHtml['firstCondition'] .= "<option value=\"index.php?app=classification&classid={$classid}&tid={$fieldAttr['tid']}&quotaid={$quotaid}&field={$fieldAttr['fname']}\">{$fieldAttr['fcomment']}({$fieldAttr['unit']})</option>";
				}
				
			}
			$selectHtml['firstCondition'] .= "</select>";
			$selectHtml['secondCondition'] .= "查询时间：";
			$yearList = '<select name=\"startTime\">';
			
			$dateCount = count($timeData);
			$i = 0;
			$tableThHtml .= "<th>地区</th>";
			foreach ($timeData as $dataItem) {
				$i++;
				if ($i == $dateCount) {
					$yearList .= "<option value=\"{$dataItem}\" selected=\"selected\">{$dataItem}年</option>";
				} else {
					$yearList .= "<option value=\"{$dataItem}\">{$dataItem}年</option>";
				}
				$tableThHtml .= "<th>{$dataItem}年</th>";
			}
			$yearList .= "</select>";
			
			$selectHtml['secondCondition'] .= $yearList;
			$selectHtml['secondCondition'] .= "-";
			$nowTime = date('Y');
			$selectHtml['secondCondition'] .= "<select name=\"endTime\"><option value=\"-1\">至今</option><option value=\"{$nowTime}\">".$nowTime."年</option><option value=\"".($nowTime-1)."\">".($nowTime-1)."年</option></select>";
			
		} 
		
		//2、生成表格
		//if (Config::$cfg['classType'][$classid] == 1) {
		$tableHtml = '<table><tbody>';
		//标题
		$tableHtml .= "<tr>{$tableThHtml}</tr>";
		//正文
		foreach ($quotaDatas as $dataRow) {
			$tableHtml .= "<tr>";
			$tableHtml .= "<td>{$dataRow['quotaName']}</td>";
			foreach ($dataRow['data'] as $value) {
				$tableHtml .= "<td>{$value}</td>";
			}
			$tableHtml .= "</tr>";
		}
		$tableHtml .= '</tbody></table>';
		
		$result = array(
				'selectHtml' => $selectHtml,
				'tableHtml'  => $tableHtml
		);
					
		return $result;
    }
    
    
    /**
     * 异步获取指标数据
     */
    public function asyncQuotaInfo()
    {
    	$quotaid	  = $this->data['get']['quotaid'];
		$startDate    = $this->data['get']['yearstart'];
		$endDate      = $this->data['get']['yearend'];
		$start        = $this->data['get']['start'];
		$end          = $this->data['get']['end'];
		$classid      = $this->data['get']['classid'];
		$areaid       = $this->data['get']['areaid']; //区域id
		$dateArr	  = $this->initialDate($classid);
		if (!$startDate || !$endDate) {
			$startDate = $dateArr['yearStart'];
			$endDate   = $dateArr['yearEnd'];
			$start     = $dateArr['start'];
			$end       = $dateArr['end'];
		}
		$htmlStr = $this->getRecordList($quotaid,$startDate,$start,$endDate,$end,$classid,$areaid);
		echo $htmlStr;
    }

	/**
	 * 根据指标id获取右侧列表信息
	 * @param string $quotaid //指标id
	 * @param string $startDate 开始日期(年份)
	 * @param string $start 开始日期(季度/月份)
	 * @param string $end 结束日期(季度/月份)
	 * @param string $endDate  结束日期(季度/月份)
	 * @param int $classid 表分类id
	 * @param string $areaid 区域id
	 * @return string 返回右侧字段列表字符串
	 **/
	public function getRecordList($quotaid,$startDate,$start,$endDate,$end,$classid,$areaid = 0)
	{
		global $selectArr;
		$areaSelect  = ' ';
		$areaname    = ' ';
		if ($areaid != 0 && $areaid != 'all' && $areaid) {
			$areaSelect = " and `field2`='" . $selectArr[$classid]['area'][$areaid] . "' ";
			$areaname   = '(' . $selectArr[$classid]['area'][$areaid] . ')';
		}
		$dateType	 = $selectArr[$classid]['type']; //日期类型 
		$quotaRecord = $this->_quota->getQuotaInfoById($quotaid);
		if (count($quotaRecord) ==0) {
			$formHtml  = '<form id="hideform" name="hideform" method="post" style="display:none;">';
			$formHtml .= '<input type="hidden" name="quotaid" id="quotaid" value="' . $quotaid . '"/></form>';
			return  '<p style="height:28px;line-height:28px;color:#333;font-weight:bold;text-align:center;">没有相关数据!</p>' . $formHtml;
			return false;
		}

		$htmlStr = '<table><th>字段名</th>';
		if ($dateType == 3) { //年份
			for ($i = $startDate; $i <=$endDate; $i++) {
				$htmlStr .= "<th>" . $i . '年</th>';
			}
		} else if ($dateType == 1) { //月份
			for ($i = $startDate; $i <= $endDate; $i ++) {
				if ($i == $startDate && $i == $endDate) {
					for ($j = $start; $j <= $end; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i == $startDate && $i < $endDate) {
					for ($j = $start; $j <= 12; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i > $startDate && $i == $endDate) {
					for ($j = 1; $j <= $end; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i > $startDate && $i < $endDate) {
					for ($j = 1; $j <= 12; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				}		
			}
		} else if ($dateType == 2) { //季度
			for ($i = $startDate; $i <= $endDate; $i ++) {
				if ($i == $startDate && $i == $endDate) {
					for ($j = $start; $j <= $end; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i == $startDate && $i < $endDate) {
					for ($j = $start; $j <= 4; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i > $startDate && $i == $endDate) {
					for ($j = 1; $j <= $end; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				} else if ($i > $startDate && $i < $endDate) {
					for ($j = 1; $j <= 4; $j ++) {
						$htmlStr .= "<th>" . $i . '/' . $j . '</th>';
					}
				}		
			}
		} 

		$quotacontent = unserialize($quotaRecord['quotacontent']);
		if ($quotacontent) {
			$selStr			= '<div id="selectDiv"><select class="quotaSelect">';
			foreach ($quotacontent as $key => $val) {
				$tableInfo  = $this->table->getTablesAttrBytid($key); //获取表信息
				$tbAttrArr  = $this->table->getFieldUnitAndKeywords($key); //获取表字段信息
				$attrArray  = array();
				foreach($tbAttrArr as $attr) {
					$attrArray[$attr['fname']] = $attr['fcomment'];
				}
				$tname        = $tableInfo['t_name'];
				foreach ($val as $field) {
					$optionV  = $tname . ',' . $field . ',' . $attrArray[$field];//option标签的值
					$optionT  = $tname . '-' . $attrArray[$field];//option标签显显示的文字
				    $selStr  .= '<option value="' . $optionV . '">' . $optionT . '</option>';
					$htmlStr .= "<tr>";
					$htmlStr .= "<td id=".$tname. "," .$field . ">" . $attrArray[$field] ."</td>";

					if ($dateType == 3) { //年份
						for ($i = $startDate; $i <= $endDate; $i++) {
							 $recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . "'" . $areaSelect); //获取对应日期的记录信息
							 if ($recordList) {
								$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
							 } else {
								 $htmlStr .= "<td>0</td>";
							 }
						}
					} else if ($dateType == 1) { //月份
						for ($i = $startDate; $i <= $endDate; $i ++) {

							if ($i == $startDate && $i == $endDate) {
								for ($j = $start; $j <= $end; $j ++) {
									 if ($j < 10) {
										 $j = '0' .$j;
									 }
									 $recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect ); //获取对应日期的记录信息
									 if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i == $startDate && $i < $endDate ) {
								for ($j = $start; $j <= 12; $j ++) {
									if ($j < 10) {
										 $j = '0' .$j;
									 }
									 $recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									 if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i > $startDate && $i == $endDate) {
								for ($j = 1; $j <= $end; $j ++) {
									if ($j < 10) {
										$j = '0' .$j;
									}
									$recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i > $startDate && $i < $endDate) {
								for ($j = 1; $j <= 12; $j ++) {
									if ($j < 10) {
										 $j = '0' .$j;
									}
									$recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									} else {
										 $htmlStr .= "<td>0</td>";
									}
								}
							}

						}
					} else if ($dateType == 2) { //season start
						for ($i = $startDate; $i <= $endDate; $i ++) {
							//遍历纵列td标签start
							if ($i == $startDate && $i == $endDate) {
								for ($j = $start; $j <= $end; $j ++) {
									 $recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									 if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i == $startDate && $i < $endDate) {
								for ($j = $start; $j <= 4; $j ++) {
									 $recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									 if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i > $startDate && $i == $endDate) {
								for ($j = 1; $j <= $end; $j ++) {
									$recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									 } else {
										 $htmlStr .= "<td>0</td>";
									 }
								}
							} else if ($i > $startDate && $i < $endDate) {
								for ($j = 1; $j <= 4; $j ++) {
									$recordList = $this->table->getTableRecords($field,$tname,"`field1`='" . $i . $j . "'" . $areaSelect); //获取对应日期的记录信息
									if ($recordList) {
										$htmlStr .= "<td>" . $recordList[0][$field] . "</td>";
									} else {
										 $htmlStr .= "<td>0</td>";
									}
								}
							}
							//遍历纵列td标签end
						}
					} 
					//season end
					$htmlStr .= "</tr>";
				}
			}
			$selStr .= '</select></div>';
		}
		$htmlStr  .= '</table>';
		$formHtml  = '<form id="hideform" name="hideform" method="post" style="display:none;">';
		$formHtml .= '<input type="hidden" name="quotaid" id="quotaid" value="' . $quotaid . '"/>';
		$formHtml .= '<input type="hidden" name="startDate" id="startDate" value="' . $startDate . '"/>';
		$formHtml .= '<input type="hidden" name="endDate" id="endDate" value="' . $endDate . '"/>';

		$formHtml .= '<input type="hidden" name="start" id="start" value="' . $start . '"/>';
		$formHtml .= '<input type="hidden" name="end" id="end" value="' . $end . '"/>';
		$formHtml .= $selStr;
		$formHtml .= '</form>';
		return $htmlStr . $formHtml;
	}

	/**
	 * 生成统计图所需数据 
	 * 根据字段和表名查询对应时间内的记录信息
	 */
	public function getchartData()
	{
		global $selectArr;
		$startDate	= $this->data['get']['yearstart'];
		$endDate    = $this->data['get']['yearend'];
		$start		= $this->data['get']['start']; //开始时间(季度/月份)
		$end        = $this->data['get']['end']; //结束时间(季度/月份)
		$tag		= $this->data['get']['tag']; //传递过来的表名和字段名  
		$type		= $this->data['get']['type']; //作图类型 1 曲线图 2柱状图 3饼状图
		$classid    = $this->data['get']['classid']; //获取表分类id
		$areaid     = $this->data['get']['areaid']; //区域id
		$areaSelect = ' ';
		$areaname   = '';
		if ($areaid != 0 && $areaid != 'all' && $areaid) {
			$areaSelect = " and `field2`='" . $selectArr[$classid]['area'][$areaid] . "' ";
			$areaname   = '(' . $selectArr[$classid]['area'][$areaid] . ')';
		}

		$dataArr    = array(); //返回数据
		if (!trim($tag)) {
			return false;
		} 
		$dateType	= $selectArr[$classid]['type']; //日期类型 
		$filedArr	= explode(',',$tag);
		$tname		= $filedArr[0]; //表名
		$fieldname	= $filedArr[1]; //字段名
		$fcomment   = $filedArr[2]; //图的label标签
		/*if (!$startDate || !$endDate) {
			$dateArr   = $this->initialDate($classid); //初始化日期
			$startDate = $dateArr['yearStart'];
			$endDate   = $dateArr['yearEnd'];
			$start     = $dateArr['start'];
			$end       = $dateArr['end'];
		}*/
		$ReturnArr = array(); //作图所需数据

		// 根据表分类查询相应的字段 start
		if ($dateType == 3) { //年份
			for ($i = $startDate; $i <=$endDate; $i++) { //年份的话直接查询对应年的记录即可
				$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . "'" . $areaSelect); //获取对应日期的记录信息
				if ($recordList) {
					$value = $recordList[0][$fieldname];
				} else {
					$value = 0;
				}
				$ReturnArr[] = array($i,$value);
			}
		} else if ($dateType == 1) { //月份 月份的话需要把月份和年份拼接到一块进行查询
			for ($i = $startDate; $i <= $endDate; $i ++) {
				if ($i == $startDate && $i == $endDate) {
					for ($j = $start; $j <= $end; $j ++) {
						if ($j < 10) {
							$j = '0' .$j;
						}
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i == $startDate && $i == $endDate) {
					for ($j = $start; $j <= 12; $j ++) {
						if ($j < 10) {
							$j = '0' .$j;
						}
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i > $startDate && $i == $endDate) {
					for ($j = 1; $j <= $end; $j ++) {
						if ($j < 10) {
							$j = '0' .$j;
						}
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i > $startDate && $i < $endDate) {
					for ($j = 1; $j <= 12; $j ++) {
						if ($j < 10) {
							$j = '0' .$j;
						}
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				}		
			}
		} else if ($dateType == 2) { //季度也需要把传递过来的年份和日期拼接到一块
			for ($i = $startDate; $i <= $endDate; $i ++) {
				if ($i == $startDate && $i == $endDate) {
					for ($j = $start; $j <= $end; $j ++) {
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i == $startDate && $i < $endDate) {
					for ($j = $start; $j <= 4; $j ++) {
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i > $startDate && $i == $endDate) {
					for ($j = 1; $j <= $end; $j ++) {
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				} else if ($i > $startDate && $i < $endDate) {
					for ($j = 1; $j <= 4; $j ++) {
						$recordList = $this->table->getTableRecords($fieldname.',field1',$tname,"`field1`='" . $i . $j . "'" . $areaSelect);
						if ($recordList) {
							$value = $recordList[0][$fieldname];
						} else {
							$value = 0;
						}
						$ReturnArr[] = array($i . $j,$value);
					}
				}		
			}
		} 

		if ($type == 2) {
			$dataArr = array('title' =>$areaname . $fcomment,'data' => $ReturnArr);
		} else if($type == 3) {
			foreach ($ReturnArr as $key=>$val) {
				$newArr[] = array('label'=>$val[0],'data' => $val[1]);
			}
			$dataArr = array('title' =>$areaname . $fcomment,'data' => $newArr);
		}
		echo json_encode($dataArr);
		exit;
	 }


	 /**
	  * 日期初始化
	  * @param string $classid 表分类id
	  * @return array $dateArr 返回处理好的日期
	  */
	public function initialDate($classid) 
	{
		 global $selectArr;
		 $dateType	   = $selectArr[$classid]['type']; //日期类型 
		 if ($dateType == 3) { //年份
			$endDate   = date('Y',time());
			$startDate = $endDate - 9;
			$start     = 0;
			$end       = 0;
		} else if ($dateType == 1) { //月份
			$endDate   = date('Y',time());
			$startDate = $endDate;
			$start     = 1;
			$end       = date('m',time());
		} else if ($dateType == 2) { //季度
			$endDate   = date('Y',time());
			$startDate = $endDate;
			$start     = 1;
			$end       = 4;
		}
		$dateArr = array(
			'yearStart' => $startDate,
			'yearEnd'   => $endDate,
			'start'     => $start,
			'end'       => $end
		);
		return $dateArr;
	 }
	
    
	/**
	* 生成菜单
	*
	* @param array $data 原始数据
	* @param integer $pid 当前分类的父id
	* @return array 处理后数据
	*/
	public function createMenuTree($data = array(), $data1, $openClassIds, $classid, $quotaid, $pid = 0)
	{
	    $html = '';
	    
		if (empty($data))
	    {
	        return $html;
	    }
	 
	    foreach ($data as $node)
	    {    	
	    	if ($node['parentid'] == $pid) {
	            $qcid = $node['qcid'];
	            $qcname = $node['qcname'];
	            $ancestors = str_replace(',',"_",$node['ancestors']);
	 			
	            if (in_array($qcid ,$openClassIds)) {
	            	$html .= "<dd id=\"class_title_{$ancestors}\" class=\"haveSons open\">{$qcname}</dd>";
	            } else {
	            	$html .= "<dd id=\"class_title_{$ancestors}\" class=\"haveSons\">{$qcname}</dd>";
	 			}
	 			
	        	if (isset($data1[$qcid])) {
        			$html .= "<dl id=\"class_content_{$ancestors}\" style=\"padding-left:15px;\">";
	        		foreach ($data1[$qcid] as $quotaInfo) {
	            		//$html .= "<dd id=\"class_title_{$ancestors}_{$quotaInfo['quotaid']}\" class=\"haveSons open\"><a href=\"index.php?app=classification&classid={$classid}&quotaid={$quotaInfo['quotaid']}\" name=\"asyncControl\" val=\"{$quotaInfo['quotaid']}\">{$quotaInfo['quotaname']}</a></dd>";
	            		if ($quotaid == $quotaInfo['quotaid']) {
	        				$html .= "<dd id=\"class_title_{$ancestors}_{$quotaInfo['quotaid']}\"><a style=\"color:#FF9900; text-decoration:underline\" href=\"index.php?app=classification&classid={$classid}&quotaid={$quotaInfo['quotaid']}\" name=\"asyncControl\" val=\"{$quotaInfo['quotaid']}\">{$quotaInfo['quotaname']}</a></dd>";
	            		} else {
	            			$html .= "<dd id=\"class_title_{$ancestors}_{$quotaInfo['quotaid']}\"><a href=\"index.php?app=classification&classid={$classid}&quotaid={$quotaInfo['quotaid']}\" name=\"asyncControl\" val=\"{$quotaInfo['quotaid']}\">{$quotaInfo['quotaname']}</a></dd>";
	            		}
	            	}

	            	$html .= "</dl>";
	            }
	            
	            if ($this->hasChild($qcid, $data))
	            {
	            	if (in_array($qcid ,$openClassIds)) {
	            		$html .= "<dl id=\"class_content_{$ancestors}\" style=\"padding-left:15px;\">";
	            	} else {
	            		$html .= "<dl id=\"class_content_{$ancestors}\" style=\"padding-left:15px; display:none\">";
	            	}
	            	$html .= $this->createMenuTree($data, $data1, $openClassIds, $classid, $quotaid, $node['qcid']);
	            }
	        }
	    }
	 	
	    $html .= "</dl>";
	    return $html;
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