<?php
if(!defined('MATERIAL')) {
	exit('Include Permission Denied!');
}

/**
 * 搜索页面管理控制器。
 *
 * @author yiluxiangbei<tsq7473281@163.com>
 */
class SearchApp extends BaseAppEx
{
    public function index()
    {
		$this->head(); //加载头部
		global $pageArr;
		$recordList = array();
		$tableInfo  = array(); //当前记录所对应的表信息
		$pageSize   = PERPAGE; //定义每页显示条数
		$totalCount = 0;
		if (trim($_GET['pageSize'])) {
			$pageSize = trim($_GET['pageSize']);
		}

		$curPage = intval($_GET['pageNumber']);
		if ($curPage > 1) {
			$start = ($curPage-1)*$pageSize;
		} else {
			$start = 0;
		}

		$keywords   = trim($this->data['get']['keywords']);
		$type       = trim($this->data['get']['type']); //列表显示表的信息还是显示记录的信息
		$tableList  = $this->table->getTableListBykeywords($keywords);
		if (empty($type)) {
			$type = 0;
		}
	
		if ($type == 1) {
			$tid        = trim($this->data['get']['tid']);
			$tableInfo  = $tableList[$tid];
			$tname      = $tableInfo['tableinfo']['t_name'];
			$select     = $tableInfo['str'];
			$recordList = $this->table->getTableRecords($select,$tname,1,1,$start,$pageSize);
			$totalCount = count($this->table->getAllRecords($tname));
		}
		$this->assigns(array(
			'keywords'		=> $keywords,
			'tablelist'		=> $tableList,
			'tableCount'	=> count($tableList),
			'filedArr'		=> explode(',',$tableInfo['fcomment']),
			'pageSize'		=> $pageSize,
			'pageArr'		=> $pageArr,
			'pageStr'		=> showPage($totalCount,$pageSize),
			'keyword'		=> $keywords,
			'type'			=> $type,
			'currentTable'  => $tableInfo,
			'recordList'    => $recordList,
			'recordCount'   => $totalCount
        ));
    	$this->setTplHtml('search');
		$this->display();
    }
}
?>