<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}
/**
 * 统计页面控制器
 * @author  Rabbit
 */
class statisticsApp extends BaseAppEx
{
	public function init()
	{
    	$this->_material    = &$this->getModel('materialTable');
    	$this->_user        = &$this->getModel('user');
        $this->_userSession = &self::$ses->get('user');
	}
	
 	
    
    /**
     * 柱状图
     */
    public function bargraph()
    {
		//获取所有原料表
		$tablesInfo = $this->_material->getAllTablesAttr();

		$tmpTablesInfo = array();
		foreach ($tablesInfo as $item) {
			if ($item['open_statistics'] == 1) {
				$tmpTablesInfo[] = $item;
			}
		}
		
		$this->assign('tablesInfo',$tmpTablesInfo);
    	$this->setTplHtml('_statistics/bargraph');
		$this->display();
    }

	/**
	 * 饼状图
	 */
	public function pie()
	{
		//获取所有原料表
		$tablesInfo = $this->_material->getAllTablesAttr();
		
		$tmpTablesInfo = array();
		foreach ($tablesInfo as $item) {
			if ($item['open_statistics'] == 1) {
				$tmpTablesInfo[] = $item;
			}
		}
		
		$this->assign('tablesInfo',$tmpTablesInfo);
		$this->setTplHtml('_statistics/pie');
		$this->display();
	}

	/**
	 * 曲线图
	 */
	public function curve()
	{
		//获取所有原料表
		$tablesInfo = $this->_material->getAllTablesAttr();

		$tmpTablesInfo = array();
		foreach ($tablesInfo as $item) {
			if ($item['open_statistics'] == 1) {
				$tmpTablesInfo[] = $item;
			}
		}
		
		$this->assign('tablesInfo',$tmpTablesInfo);
		$this->setTplHtml('_statistics/curve');
		$this->display();
	}
	
	/**
	 * 获取原料表相关信息
	 */
	public function getTableData()
	{
		$tableName = $this->data['get']['tableName'];
		$tableInfo = $this->_material->getFieldInfo($tableName);
		//$XAxis     = 'field1';
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		
		$fieldsInfo = array();
		if (!empty($tableInfo)) {
			foreach ($tableInfo as $key=>$fieldInfo) {
				if ($fieldInfo['Field'] != 'id' 
					&& $fieldInfo['Field'] != $XAxis) { //X轴字段
					$item['Field']   = $fieldInfo['Field'];
					$item['Comment'] = $fieldInfo['Comment'];
					array_push($fieldsInfo, $item);
				}
			}
		}
		
		$result['fieldsInfo'] = $fieldsInfo;
		$result['tableName']  = $tableName;
		
		$resultJson = json_encode($result);
		
		echo $resultJson;
	}
	
	/**
	 * 获取数据（曲线图）
	 */
	public function needData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = trim($_GET['field']);
		$comment   = trim($_GET['comment']);
		
		file_put_contents('/var/www/html/material/log', $tableName."\n".$field."\n".$field."\n", FILE_APPEND);
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);
		$i = 0;
		foreach ($statisticData as $item) {
			$data[$i]  = array($i, $item[$field]);
			$ticks[$i] = array($i,$item[$XAxis]);
			$i++;
		}
		$label = $comment;

		$row = array('label' => $label, 'data' => $data, 'ticks'=>$ticks);
		
		file_put_contents('/var/www/html/material/log', var_export($row,true), FILE_APPEND);
		
		echo json_encode($row);
		exit;
	}
	
	/**
	 * 获取数据（柱状图）
	 */
	public function needBargraphData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = trim($_GET['field']);
		$comment   = trim($_GET['comment']);
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);

		foreach ($statisticData as $item) {
			$data[]  = array($item[$XAxis], $item[$field]);
		}
		$label = $comment;

		$row = array('label' => $label, 'data' => $data);
		echo json_encode($row);
		exit;
	}
	
	/**
	 * 获取数据（饼状图）
	 */
	public function needPieData()
	{
		$tableName = trim($_GET['tableName']);
		$field     = trim($_GET['field']);
		$comment   = trim($_GET['comment']);
		
		$data = array();
		
		//获取X轴
		$tableAttr = $this->_material->getTablesAttrByName($tableName);
		$XAxis = $tableAttr['xaxis'];
		
		$statisticData = $this->_material->getStatisticsData($XAxis,$field,$tableName);

		foreach ($statisticData as $i=>$item) {
			//$data[]  = array($item[$XAxis], $item[$field]);
			$tmpItem['label'] = $item[$XAxis];
			$tmpItem['data']  = $item[$field];
			array_push($data, $tmpItem);
		}
		$label = $comment;

		$row = array('label' => $label, 'data' => $data);
		echo json_encode($row);
		exit;
	}
}
?>