<?php /* Smarty version Smarty-3.1.14, created on 2013-09-05 15:15:11
         compiled from "/var/www/material/exten/admin/template/tablesManager.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:193488693852282f7fd40b92-29080597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ce8ceca4d2d2a7ab33dfb5a5843677b48dcd675' => 
    array (
      0 => '/var/www/material/exten/admin/template/tablesManager.tpl.htm',
      1 => 1377979438,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193488693852282f7fd40b92-29080597',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52282f7fda8a52_13356308',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52282f7fda8a52_13356308')) {function content_52282f7fda8a52_13356308($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>数据库表列表</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {


});
</script>
</head>
<body>
	<div class="path">
		原料数据中心 &raquo; 表管理 
	</div>
	<form id="listForm" action="list.jhtml" method="get">
		<div class="bar">
			<a href="tableOperate.html" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<div class="buttonWrap">
				<a href="javascript:;" id="deleteButton" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span>删除
				</a>
				<a href="javascript:;" id="refreshButton" class="iconButton">
					<span class="refreshIcon">&nbsp;</span>刷新
				</a>
				<div class="menuWrap">
					<a href="javascript:;" id="pageSizeSelect" class="button">
						每页显示<span class="arrow">&nbsp;</span>
					</a>
					<div class="popupMenu">
						<ul id="pageSizeOption">
							<li>
								<a href="javascript:;" val="10">10</a>
							</li>
							<li>
								<a href="javascript:;" class="current" val="20">20</a>
							</li>
							<li>
								<a href="javascript:;" val="50">50</a>
							</li>
							<li>
								<a href="javascript:;" val="100">100</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menuWrap">
				
			</div>
		</div>
		<table id="listTable" class="list">
			<tr>
				<th class="check">
					<input type="checkbox" id="selectAll" />
				</th>
				<th>
					<a href="javascript:;" class="sort" name="name">名称</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="productCategory">绑定分类</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="name">排序</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
				<tr>
					<td>
						<input type="checkbox" name="ids" value="3" />
					</td>
					<td>
						中国2011年城市排水和污水处理统计
					</td>
					<td>
						默认分类/环境年鉴
					</td>
					<td>
						3
					</td>
					<td>
						<a href="showRecords.html">[查看]</a>
						<a href="tableOperate.html">[编辑]</a>
						<a href="addRecords.html">[手工录入]</a>
						<a href="importExcel.html">[Excel导入]</a>
						<a href="exportExcel.html">[Excel导出]</a>
						<a href="javascript:;" class="delete" val="1">[删除]</a>
						<a href="javascript:;" class="backup" val="1">[备份]</a>
						<a href="javascript:;" class="restore" val="1">[还原]</a>
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="ids" value="4" />
					</td>
					<td>
						中国2011年城市液化石油气统计
					</td>
					<td>
						默认分类/环境年鉴
					</td>
					<td>
						4
					</td>
					<td>
						<a href="showRecords.html">[查看]</a>
						<a href="tableOperate.html">[编辑]</a>
						<a href="addRecords.html">[手工录入]</a>
						<a href="importExcel.html">[Excel导入]</a>
						<a href="exportExcel.html">[Excel导出]</a>
						<a href="javascript:;" class="delete" val="1">[删除]</a>
						<a href="javascript:;" class="backup" val="1">[备份]</a>
						<a href="javascript:;" class="restore" val="1">[还原]</a>
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="ids" value="5" />
					</td>
					<td>
						中国环境年鉴2012  环境统计表部分
					</td>
					<td>
						默认分类/环境年鉴
					</td>
					<td>
						5
					</td>
					<td>
						<a href="showRecords.html">[查看]</a>
						<a href="tableOperate.html">[编辑]</a>
						<a href="addRecords.html">[手工录入]</a>
						<a href="importExcel.html">[Excel导入]</a>
						<a href="exportExcel.html">[Excel导出]</a>
						<a href="javascript:;" class="delete" val="1">[删除]</a>
						<a href="javascript:;" class="backup" val="1">[备份]</a>
						<a href="javascript:;" class="restore" val="1">[还原]</a>
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="ids" value="6" />
					</td>
					<td>
						中国历年城市排水和污水处理情况统计(1978-2011)
					</td>
					<td>
						默认分类/环境年鉴
					</td>
					<td>
						6
					</td>
					<td>
						<a href="showRecords.html">[查看]</a>
						<a href="tableOperate.html">[编辑]</a>
						<a href="addRecords.html">[手工录入]</a>
						<a href="importExcel.html">[Excel导入]</a>
						<a href="exportExcel.html">[Excel导出]</a>
						<a href="javascript:;" class="delete" val="1">[删除]</a>
						<a href="javascript:;" class="backup" val="1">[备份]</a>
						<a href="javascript:;" class="restore" val="1">[还原]</a>
					</td>
				</tr>
		</table>
<input type="hidden" id="pageSize" name="pageSize" value="20" />
<input type="hidden" id="searchProperty" name="searchProperty" value="" />
<input type="hidden" id="orderProperty" name="orderProperty" value="" />
<input type="hidden" id="orderDirection" name="orderDirection" value="" />
	<div class="pagination">
			<span class="firstPage">&nbsp;</span>
			<span class="previousPage">&nbsp;</span>
				<span class="currentPage">1</span>
				<a href="javascript: $.pageSkip(2);">2</a>
				<a href="javascript: $.pageSkip(3);">3</a>
			<a class="nextPage" href="javascript: $.pageSkip(2);">&nbsp;</a>
			<a class="lastPage" href="javascript: $.pageSkip(4);">&nbsp;</a>
		<span class="pageSkip">
			共4页 到第<input id="pageNumber" name="pageNumber" value="1" maxlength="9" onpaste="return false;" />页<button type="submit">&nbsp;</button>
		</span>
	</div>
	</form>
</body>
</html><?php }} ?>