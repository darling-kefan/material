<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 11:06:13
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_system\systemSet.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:14079523594a56fd8d7-91055524%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cec696df107f70ce503bccdfe5d2db08dd87b1e2' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_system\\systemSet.tpl.htm',
      1 => 1378968998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14079523594a56fd8d7-91055524',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'systemConfig' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523594a57b69e5_64676670',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523594a57b69e5_64676670')) {function content_523594a57b69e5_64676670($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>系统设置 - Powered By sqtang</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<script type="text/javascript">
$().ready(function() {
	
	var $inputForm = $("#inputForm");
	var $browserButton = $("input.browserButton");

	$browserButton.browser();
	
	$.validator.addMethod("compareLength", 
		function(value, element, param) {
			return this.optional(element) || $.trim(value) == "" || $.trim($(param).val()) == "" || parseFloat(value) >= parseFloat($(param).val());
		},
		"必须大于等于最小长度"
	);
	
	// 表单验证
	$inputForm.validate({
		rules: {
			siteName: "required",
			siteUrl: "required",
			logo: "required",
			email: "email",
			siteCloseMessage: "required"
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		系统 &raquo; 系统设置
	</div>
	<form id="inputForm" action="?app=system&act=systemSet" method="post" enctype="multipart/form-data">
		<ul id="tab" class="tab">
			<li>
				<input type="button" value="基本设置" />
			</li>
		</ul>
		<table class="input tabContent">
			<tr>
				<th>
					<span class="requiredField">*</span>网站名称:
				</th>
				<td>
					<input type="text" name="siteName" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_name'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>网站网址:
				</th>
				<td>
					<input type="text" name="siteUrl" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_url'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>logo:
				</th>
				<td>
					<span class="fieldSet">
						<input type="text" name="logo" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_logo'];?>
" maxlength="200" />
						<input type="button" class="button browserButton" value="选择文件" />
						<a href="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_logo'];?>
" target="_blank">查看</a>
					</span>
				</td>
			</tr>
			<tr>
				<th>
					联系地址:
				</th>
				<td>
					<input type="text" name="address" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_addr'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					联系电话:
				</th>
				<td>
					<input type="text" name="phone" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_tel'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					邮政编码:
				</th>
				<td>
					<input type="text" name="zipCode" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_zipcode'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					E-mail:
				</th>
				<td>
					<input type="text" name="email" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_mail'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					备案编号:
				</th>
				<td>
					<input type="text" name="certtext" class="text" value="<?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_icp'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					是否网站开启:
				</th>
				<td>
					<input type="checkbox" name="isEnabled" value="1" checked="checked" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>网站关闭消息:
				</th>
				<td>
					<textarea name="siteCloseMessage" class="text"><?php echo $_smarty_tpl->tpl_vars['systemConfig']->value['website_close_msg'];?>
</textarea>
				</td>
			</tr>
		</table>

		<table class="input">
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="history.go(-1)" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>