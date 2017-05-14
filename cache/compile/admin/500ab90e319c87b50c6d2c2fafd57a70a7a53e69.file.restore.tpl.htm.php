<?php /* Smarty version Smarty-3.1.14, created on 2013-09-27 14:32:41
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/restore.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:46776456752452689354ed5-08334208%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '500ab90e319c87b50c6d2c2fafd57a70a7a53e69' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/restore.tpl.htm',
      1 => 1379297168,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46776456752452689354ed5-08334208',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'tableID' => 0,
    'tableName' => 0,
    'tableComment' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_524526893a3c69_09213746',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524526893a3c69_09213746')) {function content_524526893a3c69_09213746($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common1.js"></script>
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
	<form id="inputForm" action="admin.php?app=materialTable&act=restore" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
" />
		<table class="input tabContent">
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
					选择SQL文件:
				</th>
				<td>
					<span class="fieldSet">
						<input type="text" name="restoreFile" class="text" maxlength="200" title="非专业人员不要使用本地上传，还原操作之前最好先备份！" />
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
						<span class="tips">还原操作不可恢复，此操作慎重！</span>
					</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=getTablesList'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>