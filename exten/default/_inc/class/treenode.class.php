<?php
class treenode extends BaseApp{
	public $m_postid; //id
	public $m_title; //name
	public $m_children; //haschild 1|0
	public $m_childlist; //treenode对象
	public $m_depth;//深度

	//构造函数
	public function __construct($postid, $title, $children,$expand, $depth, $expanded, $sublist){
		$this->m_postid = $postid;
		$this->m_title = $title; 
		$this->m_children =$children;
		$this->m_childlist = array();
		$this->m_depth = $depth;
		if (($sublist || $expand) && $children) {
			$sql    =  "SELECT * FROM `material_table_class` WHERE `parentid` = '" . $postid . "' ORDER BY parentid";
			$result =  self::$db_app->getAll($sql);
			$count  = 0;
			foreach ($result as $val) {
				if ($sublist || $expanded[$val['classid']] == true) {
					$expand = true;
				} else {
					$expand = false;
				}

				$subRecord = self::$db_app->getOne("select classid from material_table_class where parentid=" . $val['classid']);
				if (count($subRecord) > 0) {
					$haschild = 1;
				} else {
					$haschild = 0;
				}
				$this->m_childlist[$count]= new treenode($val['classid'],$val['class_name'],$haschild, $expand,$depth+1, $expanded, $sublist);
				$count++;
			}
		}
	}

	public function display($row, $sublist = false)
	{
		if ($this->m_depth>-1) {
			echo "<tr><td>";
			/*if ($row%2) {
				echo "#cccccc\">";
			} else {
				echo "#ffffff\">";
			}*/

			for($i = 0; $i < $this->m_depth; $i++)  {
				echo '&nbsp;&nbsp;';
			}
		    if (!$sublist && $this->m_children && sizeof($this->m_childlist)) {
				echo "<a href=\"index.php?app=classification&classid=1&collapse=" . $this->m_postid."\">-</a>\n";
			} else if(!$sublist && $this->m_children) {
				echo "<a href=\"index.php?app=classification&classid=1&expand=".$this->m_postid."\">+</a>\n";
			} else {
				echo "&nbsp;\n";
			}
			echo "<a name=\"".$this->m_postid."\"><a href=\"index.php?app=classification&classid=1&zbid=".$this->m_postid."\">" . $this->m_title . "</a></td></tr>";
			$row++;
		}
		$num_children = count($this->m_childlist);
		for($i = 0; $i<$num_children; $i++) {
		  $row = $this->m_childlist[$i]->display($row, $sublist);
		}
		return $row;
	}
}
?>
