<?php /* Smarty version Smarty-3.1.14, created on 2013-09-26 09:19:04
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/viewExportExcel.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:68983663952438b88b5c886-98402582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51eb44b3bc21907325c1453d78e1635bfbfd5721' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/viewExportExcel.tpl.htm',
      1 => 1380089226,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68983663952438b88b5c886-98402582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tableID' => 0,
    'tmpFile' => 0,
    'bannerArr' => 0,
    'cell_id' => 0,
    'tableComment' => 0,
    'titleArr' => 0,
    'title' => 0,
    'records' => 0,
    'rowInfo' => 0,
    'cellInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438b88bf9838_78687809',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438b88bf9838_78687809')) {function content_52438b88bf9838_78687809($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>导出Excel预览</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<style type="text/css">
.moreTable th {
	width: 80px;
	line-height: 25px;
	padding: 5px 10px 5px 0px;
	text-align: right;
	font-weight: normal;
	color: #333333;
	background-color: #f8fbff;
}

.moreTable td {
	line-height: 25px;
	padding: 5px;
	color: #666666;
}

.promotion {
	color: #cccccc;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $listForm = $("#listForm");

});
</script>
</head>
<body>
	<div class="path">
		导出Excel预览
	</div>
	<form id="form" action="admin.php?app=materialTable&act=exportExcel" method="POST">
		<input type="hidden" id="tableID" name="tableID" value="<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
" />
		<input type="hidden" id="tmpFile" name="tmpFile" value="<?php echo $_smarty_tpl->tpl_vars['tmpFile']->value;?>
" />
		<table id="listTable" class="list">
			<tr>
				<th>
					&nbsp;
				</th>
				<?php  $_smarty_tpl->tpl_vars['cell_id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cell_id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bannerArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cell_id']->key => $_smarty_tpl->tpl_vars['cell_id']->value){
$_smarty_tpl->tpl_vars['cell_id']->_loop = true;
?>
				<th>
					<a href="javascript:;" name="<?php echo $_smarty_tpl->tpl_vars['cell_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['cell_id']->value;?>
</a>
				</th>
				<?php } ?>
			</tr>
				<tr>
					<td>
						1
					</td>
					<td colspan="100">
						<input type="text" name="captain" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableComment']->value;?>
" maxlength="200" style="width:400px"  />
					</td>
				</tr>
				<tr>
					<td>
						2
					</td>
					<?php  $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['titleArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title']->key => $_smarty_tpl->tpl_vars['title']->value){
$_smarty_tpl->tpl_vars['title']->_loop = true;
?>
					<td>
						<input type="text" name="title[]" class="text" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" maxlength="100"  />
					</td>
					<?php } ?>
				</tr>
				<?php  $_smarty_tpl->tpl_vars['rowInfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rowInfo']->_loop = false;
 $_smarty_tpl->tpl_vars['rowId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['allData']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['rowInfo']->key => $_smarty_tpl->tpl_vars['rowInfo']->value){
$_smarty_tpl->tpl_vars['rowInfo']->_loop = true;
 $_smarty_tpl->tpl_vars['rowId']->value = $_smarty_tpl->tpl_vars['rowInfo']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['allData']['index']++;
?>
				<tr>
					<td>
						<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['allData']['index']+3;?>

					</td>
					<?php  $_smarty_tpl->tpl_vars['cellInfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cellInfo']->_loop = false;
 $_smarty_tpl->tpl_vars['cellId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cellInfo']->key => $_smarty_tpl->tpl_vars['cellInfo']->value){
$_smarty_tpl->tpl_vars['cellInfo']->_loop = true;
 $_smarty_tpl->tpl_vars['cellId']->value = $_smarty_tpl->tpl_vars['cellInfo']->key;
?>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['cellInfo']->value;?>

					</td>
					<?php } ?>
				</tr>
				<?php } ?>
		</table>
		
		<table class="input">
			</tr>
				<tr>
					<th>
						&nbsp;
					</th>
					<td>
						
					</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="导出/下载" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=getTablesList'" />
				</td>
			</tr>
			</tr>
				<tr>
					<th>
						&nbsp;
					</th>
					<td>
						
					</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>