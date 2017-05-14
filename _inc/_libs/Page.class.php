<?php
/**
* 当需要伪静态时，需要这几句代码：
if(strstr($_SERVER['REQUEST_URI'],'.html'))//是否使用了伪静态处理
{
	$query_string=str_replace("{$_SERVER['SCRIPT_NAME']}/",'',urldecode($_SERVER['REQUEST_URI']));//必须对URL解码
	$query_string=substr($query_string,0,strrpos($query_string,'.'));//这句是去掉尾部的.html,注意自己写的脚本都是以.html结尾的，这样便于处理
	$vars = explode("/",$query_string);
	$count=count($vars);
	for($i=0;$i<$count;$i+=2)
	{
		$_GET["{$vars[$i]}"]=$vars[$i+1];
		$_SERVER['QUERY_STRING'].="&{$vars[$i]}={$vars[$i+1]}";
	}
	$_SERVER['QUERY_STRING'][0]=null;
	$_SERVER['QUERY_STRING']=ltrim($_SERVER['QUERY_STRING']);
}

* 模式四种分页模式：
   require_once('../libs/classes/page.class.php');
   $page=new Page(array('total'=>1000,'perpage'=>20));
   echo 'mode:1'.$page->show();
   echo '<hr>mode:2'.$page->show(2);
   echo '<hr>mode:3'.$page->show(3);
   echo '<hr>mode:4'.$page->show(4);
   开启AJAX：
   $ajaxpage=new page(array('total'=>1000,'perpage'=>20,'ajax'=>'ajax_page','page_name'=>'test'));
   echo 'mode:1'.$ajaxpage->show();
   采用继承自定义分页显示模式：
   demo:[url=http://www.phpobject.net/blog]http://www.phpobject.net/blog[/url]
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
*/
class Page
{
	/**
    * config ,public
    */
	var $page_name		=	"page";	//page标签，用来控制url页。比如说xxx.php?PB_page=2中的PB_page
	var $next_page		=	'>';	//下一页
	var $pre_page		=	'<';	//上一页
	var $first_page		=	'|<';	//首页
	var $last_page		=	'>|';	//尾页
	var $pre_bar		=	'<<';	//上一分页条
	var $next_bar		=	'>>';	//下一分页条
	var $format_left	=	'';
	var $format_right	=	'';
	var $is_ajax		=	false;	//是否支持AJAX分页模式
	var $is_fstatic		=	false;	//是否使用伪静态URL方式
	var $totalSize      =   0;

	/**
    * private
    *
    */ 
	var $pagebar_num	=	10;		//控制记录条的个数。
	var $total_page		=	0;		//总页数
	var $ajax_action_name	=	'';	//AJAX动作名
	var $current_page	=	1;		//当前页
	var $url			=	"";		//url地址头
	var $offset			=	0;

	/**
    * constructor构造函数
    *
    * @param array $array['total'],$array['perpage'],$array['current_page'],$array['url'],$array['ajax']...
    */
	function __construct($array)
	{
		if(is_array($array)) {
			if(!array_key_exists('total',$array))$this->error(__FUNCTION__,'need a param of total');
			$total=intval($array['total']);
			$perpage=(array_key_exists('perpage',$array))?intval($array['perpage']):10;
			$current_page=(array_key_exists('current_page',$array))?intval($array['current_page']):'';
			$url=(array_key_exists('url',$array))?$array['url']:'';
		}
		else {
			$total   = $array;
			$perpage = 10;
			$current_page='';
			$url = '';
		}
		if((!is_int($total)) || ($total<0)) {
			return;
			$this->error(__FUNCTION__,$total.' is not a positive integer!');
		}
		if((!is_int($perpage)) || ($perpage<=0)) {
			return;
			$this->error(__FUNCTION__,$perpage.' is not a positive integer!');
		}
		//的确使用了伪静态
		if(strstr($_SERVER['REQUEST_URI'],'.html')){$this->is_fstatic = true;}
		if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//设置pagename
		$this->_set_current_page($current_page);//设置当前页
		$this->_set_url($url);//设置链接地址
		$this->totalSize  = $total;
		$this->total_page = ceil($total/$perpage);
		$this->offset     = ($this->current_page-1)*$perpage;
		if(!empty($array['ajax'])){
		    $this->open_ajax($array['ajax']);//打开AJAX模式
		}

	}
	
	/**
    * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
    *
    * @param string $var
    * @param string $value
    */
	function set($var,$value)
	{
		if(in_array($var,get_object_vars($this)))
		{
		    $this->$var=$value;
		}
		else 
		{
			$this->error(__FUNCTION__,$var." does not belong to PB_Page!");
		}

	}
	
	/**
    * 打开倒AJAX模式
    *
    * @param string $action 默认ajax触发的动作。
    */
	public function open_ajax($action)
	{
		$this->is_ajax = true;
		$this->ajax_action_name = $action;
	}
	
	/**
    * 获取显示"下一页"的代码
    * 
    * @param string $style
    * @return string
    */
	function next_page($cur_style='page_txt', $style='page_txt')
	{    
		if($this->current_page < $this->total_page)
		{
			return $this->_get_link($this->_get_url($this->current_page+1), $this->next_page, '下一页', $style);
		}
		return '<span class="'.$cur_style.'">'.$this->next_page.'</span>';
	}

	/**
    * 获取显示“上一页”的代码
    *
    * @param string $style
    * @return string
    */
	function pre_page($cur_style='page_txt', $style='page_txt')
	{
		if($this->current_page > 1)
		{
			return $this->_get_link($this->_get_url($this->current_page - 1), $this->pre_page, '上一页', $style);
		}
		return '<span class="'.$cur_style.'">'.$this->pre_page.'</span>';
	}

	/**
    * 获取显示“首页”的代码
    *
    * @return string
    */
	function first_page($cur_style='page_txt', $style='page_txt')
	{
		if($this->current_page == 1)
		{
			return '<span class="'.$cur_style.'">'.$this->first_page.'</span>';
		}
		return $this->_get_link($this->_get_url(1), $this->first_page, '第一页', $style);
	}

	/**
    * 获取显示“尾页”的代码
    *
    * @return string
    */
	function last_page($cur_style='page_txt', $style='page_txt')
	{
		if($this->current_page == $this->total_page)
		{
			return '<span class="'.$cur_style.'">'.$this->last_page.'</span>';
		}
		return $this->_get_link($this->_get_url($this->total_page), $this->last_page, '最后页', $style);
	}

	/**
	 * 获得分页条。
	 *
	 * @param 当前页码 $cur_style
	 * @param 连接CSS $style
	 * @return 分页条字符串
	 */
	function nowbar($cur_style='page_num', $style='page_num')
	{
		$plus = ceil($this->pagebar_num/2);
		if($this->pagebar_num - $plus + $this->current_page > $this->total_page)
		{
			$plus = ($this->pagebar_num - $this->total_page + $this->current_page);
		}
		$begin  = $this->current_page - $plus + 1;
		$begin  = ($begin>=1) ? $begin : 1;
		$return = '';
		for($i = $begin; $i < $begin + $this->pagebar_num; $i++)
		{
			if($i <= $this->total_page)
			{
				if($i != $this->current_page)
				{
					$return .= $this->_get_text($this->_get_link($this->_get_url($i), $i, '',$style));
				}
				else
				{
					$return .= $this->_get_text('<span class="'.$cur_style.'">'.$i.'</span>');
				}
			}
			else
			{
				break;
			}
			$return .= "\n";
		}
		unset($begin);
		return $return;
	}
	/**
    * 获取显示跳转按钮的代码
    *
    * @return string
    */
	function select()
	{
		$return = '<select name="PB_Page_Select">';
		for($i=1; $i <= $this->total_page; $i++)
		{
			if($i==$this->current_page)
			{
				$return.='<option value="'.$i.'" selected>'.$i.'</option>';
			}
			else
			{
				$return.='<option value="'.$i.'">'.$i.'</option>';
			}
		}
		unset($i);
		$return.='</select>';
		return $return;
	}

	/**
    * 获取mysql 语句中limit需要的值
    *
    * @return string
    */
	function offset()
	{
		return $this->offset;
	}

	/**
    * 控制分页显示风格（你可以增加相应的风格）
    * 
    * @param int $mode
    * @return string
    */
	function show($mode=1)
	{
		switch ($mode)
		{
			case '1':
				$this->next_page = '下一页';
				$this->pre_page  = '上一页';
				return $this->pre_page().$this->nowbar().$this->next_page().'第'.$this->select().'页';
				break;
			case '2':
				$this->next_page  = '下一页';
				$this->pre_page   = '上一页';
				$this->first_page = '首页';
				$this->last_page  = '尾页';
				return $this->first_page().$this->pre_page().'[第'.$this->current_page.'页]'.$this->next_page().$this->last_page().'第'.$this->select().'页';
				break;
				
			case '3':
				$this->next_page  = '下一页';
				$this->pre_page   = '上一页';
				$this->first_page = '首页';
				$this->last_page  = '尾页';
				$pageStr = $this->first_page()." ".$this->pre_page();
				$pageStr .= ' '.$this->nowbar('page_cur');
				$pageStr .= ' '.$this->next_page()." ".$this->last_page();
				$pageStr .= " 当前页{$this->current_page}/{$this->total_page} 共{$this->totalSize}条";
				return $pageStr;
				break;
				
			case '4':
				$pageStr          = null;
				$this->next_page  = '下一页';
				$this->pre_page   = '上一页';
				$this->first_page = '首页';
				$this->last_page  = '尾页';
				$temp_page = $this->first_page();
				if(stristr($temp_page, '<a ')){
					$pageStr .= $temp_page." ";
				}
				$temp_page = $this->pre_page();
				if(stristr($temp_page, '<a ')){
					$pageStr .= "$temp_page ";
				}
				$pageStr .= $this->nowbar('page_cur').' ';
				$temp_page = $this->next_page(null, 'next_page');
				if(stristr($temp_page, '<a ')){
					$pageStr .= "$temp_page ";
				}
				
				$temp_page = $this->last_page();
				if(stristr($temp_page, '<a ')){
					$pageStr .= $temp_page;
				}
				$pageStr .= " 当前页{$this->current_page}/{$this->total_page} 共{$this->totalSize}条";
				return $pageStr;
				break;
		}

	}
	
	
	
	/*----------------private function (私有方法)-----------------------------------------------------------*/
	/**
    * 设置url头地址
    * @param: String $url
    * @return boolean
    */
	function _set_url($url="")
	{
		if($this->is_fstatic)
		{
			if(!empty($url)) 
			{
				//手动设置
				//$this->url = $url.((stristr($url, '/')) ? '' : '/' ).$this->page_name."/";
			}
			else 
			{
				//自动获取
				if(empty($_SERVER['QUERY_STRING']))	
				{
					//不存在QUERY_STRING时
					$this->url=$_SERVER['REQUEST_URI']."_";
				}
				else 
				{
					if(stristr($_SERVER['QUERY_STRING'], $this->page_name.'='))	
					{
						//地址存在页面参数
						$this->url = str_replace('_'.$this->current_page.'.html', '', $_SERVER['REQUEST_URI']);
						$last = $this->url[strlen($this->url)-1];
						if($last != '/') 
						{
							$this->url .= '_';
						}
					}
					else 
					{
						$this->url = substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],'.')).'_';
					}
				}
			}
		}
		else 
		{
			if(!empty($url)) 
			{
				//手动设置
				$this->url=$url.((stristr($url,'?'))?'&':'?').$this->page_name."=";
			}
			else 
			{
				//自动获取
				if(empty($_SERVER['QUERY_STRING']))	
				{
					//不存在QUERY_STRING时
					$last=$_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI'])-1];
					//型如 xxx.php? 的情况的判断
					if($last=='?') 
					$this->url=$_SERVER['REQUEST_URI'].$this->page_name."=";
					else
					$this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
				}
				else 
				{
					if(stristr($_SERVER['QUERY_STRING'], $this->page_name.'='))	
					{
						//地址存在页面参数
						$this->url=str_replace($this->page_name.'='.$this->current_page,'',$_SERVER['REQUEST_URI']);
						$last=$this->url[strlen($this->url)-1];
						if($last=='?'||$last=='&') 
						{
							$this->url.=$this->page_name."=";
						}
						else 
						{
							$this->url.='&'.$this->page_name."=";
						}
					}
					else 
					{
						$this->url=$_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';
					}
				}
			}
		}
	}

   /**
   * 设置当前页面
   */
	function _set_current_page($current_page)
	{
		if(empty($current_page))
		{
			//系统获取
			if(isset($_GET[$this->page_name]))
			{
				$this->current_page=intval($_GET[$this->page_name]);
			}
		}
		else
		{
			//手动设置
			$this->current_page=intval($current_page);
		}
	}

	/**
   * 为指定的页面返回地址值
   *
   * @param int $pageno
   * @return string $url
   */
	function _get_url($pageno=1)
	{
		if($this->is_fstatic)
		return $this->url.$pageno.'.html';
		else
		return $this->url.$pageno;
	}

   /**
   * 获取分页显示文字，比如说默认情况下_get_text('<a href="">1</a>')将返回[<a href="">1</a>]
   *
   * @param String $str
   * @return string $url
   */ 
	function _get_text($str)
	{
		return $this->format_left.$str.$this->format_right;
	}

    //获取链接地址
	function _get_link($url, $text, $title='', $style='')
	{
		$style=(empty($style))?'':'class="'.$style.'"';
		if($this->is_ajax)
		{
			//如果是使用AJAX模式
			return "<a $style  href='#' onclick=\"{$this->ajax_action_name}('$url');\">$text</a>";
		}
		else
		{
			return "<a $style  href='$url' title='$title'>$text</a>";
		}
	}

    //出错处理方式
	function error($function,$errormsg)
	{
		die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
	}
}
?>