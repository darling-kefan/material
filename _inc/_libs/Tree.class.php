<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}
/**
* 通用的树型类，可以生成任何树型结构
*/
class Tree
{
	/**
	* 生成树型结构所需要的2维数组
	* @var array
	*/
	var $arr = array();

	/**
	* 生成树型结构所需修饰符号，可以换成图片
	* @var array
	*/
	var $icon = array('│','├','└');

	/**
	* @access private
	*/
	var $ret = '';

	/**
	* 构造函数，初始化类
	* @param array 2维数组，例如：
	* array(
	*      1 => array('id'=>'1','PCatID'=>0,'name'=>'一级栏目一'),
	*      2 => array('id'=>'2','PCatID'=>0,'name'=>'一级栏目二'),
	*      3 => array('id'=>'3','PCatID'=>1,'name'=>'二级栏目一'),
	*      4 => array('id'=>'4','PCatID'=>1,'name'=>'二级栏目二'),
	*      5 => array('id'=>'5','PCatID'=>2,'name'=>'二级栏目三'),
	*      6 => array('id'=>'6','PCatID'=>3,'name'=>'三级栏目一'),
	*      7 => array('id'=>'7','PCatID'=>3,'name'=>'三级栏目二')
	*      )
	*/
	function set_array($arr=array())
	{
       $this->arr = $arr;
	   $this->ret = '';
	   return is_array($arr);
	}

    /**
	* 得到父级数组
	* @param int
	* @return array
	*/
	function get_parent($myid)
	{
		$newarr = array();
		if(!isset($this->arr[$myid])) return false;
		$pid = $this->arr[$myid]['PCatID'];
		$pid = $this->arr[$pid]['PCatID'];
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['PCatID'] == $pid) $newarr[$id] = $a;
			}
		}
		return $newarr;
	}

    /**
	* 得到子级数组
	* @param int
	* @return array
	*/
	function get_child($myid)
	{
		$a = $newarr = array();
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['PCatID'] == $myid) $newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}

    /**
	* 得到当前位置数组
	* @param int
	* @return array
	*/
	function get_pos($myid,&$newarr)
	{
		$a = array();
		if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
		$pid = $this->arr[$myid]['PCatID'];
		if(isset($this->arr[$pid]))
		{
		    $this->get_pos($pid,$newarr);
		}
		if(is_array($newarr))
		{
			krsort($newarr);
			foreach($newarr as $v)
			{
				$a[$v['CatID']] = $v;
			}
		}
		return $a;
	}

    /**
	* 得到树型结构
	* @param int ID，表示获得这个ID下的所有子级
	* @param string 生成树型结构的基本代码，例如："<option value=\$id \$selected>\$spacer\$name</option>"
	* @param int 被选中的ID，比如在做树型下拉框的时候需要用到
	* @return string
	*/
	function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '')
	{
		$number=1;
		$child = $this->get_child($myid);
		if(is_array($child))
		{
		    $total = count($child);
			foreach($child as $id => $a)
			{
				$j = $k = '';
				if($number==$total){
					$j .= $this->icon[2];
				}else{
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds.$j : '';
				$selected = $id==$sid ? 'selected' : '';
				@extract($a);
				$parent_id == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				
				//允许父ID与自身ID为同一值，这样表示该节点为孤立的
				if($CatID == $PCatID)
				{
					$number++;
					continue;
				}else{
					//递归获取
					$this->get_tree($CatID, $str, $sid, $adds.$k.'&nbsp;',$str_group);
				}
				
				$number++;
			}
		}
		return $this->ret;
	}
    /**
	* 同上一方法类似,但允许多选
	*/
	function get_tree_multi($myid, $str, $sid = 0, $adds = '')
	{
		$number = 1;
		$child  = $this->get_child($myid);
		if(is_array($child)){
		    $total = count($child);
			foreach($child as $id=>$a){
				$j=$k='';
				if($number==$total){
					$j .= $this->icon[2];
				}else{
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds.$j : '';
				
				$selected = $this->have($sid,$id) ? 'selected' : '';
				//echo $sid.'=>'.$id.' : '.$selected.' . <br/>';
				@extract($a);
				eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->get_tree_multi($CatID, $str, $sid, $adds.$k.'&nbsp;');
				$number++;
			}
		}
		return $this->ret;
	}
	
	function have($list,$item){
		return(strpos(',,'.$list.',',','.$item.','));
	}
}
?>
