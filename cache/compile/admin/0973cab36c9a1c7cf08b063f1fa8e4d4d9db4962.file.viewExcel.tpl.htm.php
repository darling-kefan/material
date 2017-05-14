<?php /* Smarty version Smarty-3.1.14, created on 2013-11-07 16:42:21
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/viewExcel.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:17064901605244ef6dbd1429-61278948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0973cab36c9a1c7cf08b063f1fa8e4d4d9db4962' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/viewExcel.tpl.htm',
      1 => 1383813700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17064901605244ef6dbd1429-61278948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5244ef6dc4bac4_55717407',
  'variables' => 
  array (
    'tableID' => 0,
    'tmpFile' => 0,
    'bannerArr' => 0,
    'cell_id' => 0,
    'excelData' => 0,
    'rowId' => 0,
    'rowInfo' => 0,
    'cellInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5244ef6dc4bac4_55717407')) {function content_5244ef6dc4bac4_55717407($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>选择要导入的Excel内容</title>
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
	<form id="form" action="admin.php?app=materialTable&act=importExcel" method="POST">
		<input type="hidden" id="tableID" name="tableID" value="<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
" />
		<input type="hidden" id="tmpFile" name="tmpFile" value="<?php echo $_smarty_tpl->tpl_vars['tmpFile']->value;?>
" />
		<table id="listTable" class="list">
			<tr>
				<td colspan="100" style="height:60px">
					<ul style="float:right">
						<li style="width:30px; float:left; height:35px; line-height:25px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_off.gif)">1</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#BCBCBC; line-height:28px">选择Excel文件</li>
						<li style="width:11px; height:21px; float:left; margin:5px 20px 0px 20px; background-image:url(exten/admin/template/images/pub_arrow.gif)"></li>
						<li style="width:30px; float:left; height:35px; line-height:25px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_on.gif)">2</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#4484DB; line-height:28px">选择非标题数据</li>
						<li style="width:11px; height:21px; float:left; margin:5px 20px 0px 20px; background-image:url(exten/admin/template/images/pub_arrow.gif)"></li>
						<li style="width:30px; float:left; height:35px; line-height:25px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_off.gif)">3</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#BCBCBC; line-height:28px">点击确定，导入成功</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th class="check">
					<input type="checkbox" id="selectAll" />
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
				<?php  $_smarty_tpl->tpl_vars['rowInfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rowInfo']->_loop = false;
 $_smarty_tpl->tpl_vars['rowId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['excelData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rowInfo']->key => $_smarty_tpl->tpl_vars['rowInfo']->value){
$_smarty_tpl->tpl_vars['rowInfo']->_loop = true;
 $_smarty_tpl->tpl_vars['rowId']->value = $_smarty_tpl->tpl_vars['rowInfo']->key;
?>
				<tr>
					<td>
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['rowId']->value;?>
" />
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
			</tr>
				<tr>
					<th>
						&nbsp;
					</th>
					<td>
						<span class="tips">请选择需要导入的数据</span>
					</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=viewImportExcel&tableID=<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
'" />
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