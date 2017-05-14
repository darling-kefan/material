<?php
/**
 * 获得分页的start
 *
 * @param  int    $perPage
 * @param  string $pageName
 * @return int
 */
function getStart($perPage, $pageName = 'page')
{
	$curPage = intval($_GET[$pageName]);
	if($curPage > 1){
	    $start = ($curPage-1)*$perPage;
	}else{
	    $start = 0;
	}
	return $start;
}

/**
 * 获得分页内容。
 *
 * @param  int    $totalSize  总内容数
 * @param  int    $perPage    每页数
 * @param  int    $type       分页类型(可在类里面修改增加)
 * @param  string $ajaxAction 使用AJAX分页并指定AJAX操作函数 $ajaxAction
 * @return string
 */
function getPage($totalSize, $perPage = 10, $type = 3, $ajaxAction = null)
{
	if($totalSize){
		require_once(ROOT_PATH.'/_inc/_libs/Page.class.php');
		$page = new Page(array('total' => $totalSize, 'perpage' => $perPage));
		if($ajaxAction){
			$page->open_ajax($ajaxAction);
		}
		return $page->show($type);
	}else{
		return false;
	}
}

/**
 * UTF-8编码的获得字符串长度(一个中文或者一个字母都算做1个长度)
 * @param  string $string
 * @return int
 */
function strlenUtf8($string = null)
{
    //将字符串分解为单元
    preg_match_all("/./us", $string, $match);
    //返回单元个数
    return count($match[0]);
}

?>