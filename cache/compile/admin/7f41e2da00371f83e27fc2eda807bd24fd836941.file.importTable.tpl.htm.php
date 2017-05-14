<?php /* Smarty version Smarty-3.1.14, created on 2013-11-07 16:42:12
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/importTable.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:58336823752438d38eaa741-00634933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f41e2da00371f83e27fc2eda807bd24fd836941' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/importTable.tpl.htm',
      1 => 1383813711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58336823752438d38eaa741-00634933',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438d38f06505_70152170',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'tableID' => 0,
    'tableName' => 0,
    'tableComment' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438d38f06505_70152170')) {function content_52438d38f06505_70152170($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common2.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $browserButton = $("#browserButton");
	
	$browserButton.browser();
	
	// 表单验证
	$inputForm.validate({
		rules: {
			restoreFile: "required",
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="inputForm" action="admin.php?app=materialTable&act=selectExcelData" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
" />
		<table class="input tabContent">
			<tr>
				<td colspan="2" style="height:70px">
					<ul style="float:right">
						<li style="width:30px; float:left; height:35px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_on.gif)">1</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#4484DB; line-height:28px">选择Excel文件</li>
						<li style="width:11px; height:21px; float:left; margin:5px 20px 0px 20px; background-image:url(exten/admin/template/images/pub_arrow.gif)"></li>
						<li style="width:30px; float:left; height:35px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_off.gif)">2</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#BCBCBC; line-height:28px">选择非标题数据</li>
						<li style="width:11px; height:21px; float:left; margin:5px 20px 0px 20px; background-image:url(exten/admin/template/images/pub_arrow.gif)"></li>
						<li style="width:30px; float:left; height:35px; font-size:14px; color:white; text-align:center; font-weight:bold; background-image:url(exten/admin/template/images/pubflow_off.gif)">3</li>
						<li style="float:left; padding-left:15px; font-size:14px; color:#BCBCBC; line-height:28px">点击确定，导入成功</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th>
					原料表:
				</th>
				<td>
					<span class="fieldSet">
						<?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
（<?php echo $_smarty_tpl->tpl_vars['tableComment']->value;?>
）
					</span>
				</td>
			</tr>
			<tr>
				<th>
					选择excel文件:
				</th>
				<td>
					<span class="fieldSet">
						<input type="text" name="importFile" class="text" maxlength="200" title="非专业人员不要使用本地上传，还原操作之前最好先备份！" />
						<input type="button" id="browserButton" class="button" value="选择文件" />
					</span>
				</td>
			</tr>
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
						<span class="tips">导入操作不可恢复，此操作慎重！</span>
					</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="下一步" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=getTablesList'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>