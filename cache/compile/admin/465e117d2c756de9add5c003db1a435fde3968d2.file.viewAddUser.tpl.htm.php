<?php /* Smarty version Smarty-3.1.14, created on 2013-10-28 16:34:43
         compiled from "/var/www/html/material/exten/admin/template/_user/viewAddUser.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:175950380952438e583dac59-39182575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '465e117d2c756de9add5c003db1a435fde3968d2' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_user/viewAddUser.tpl.htm',
      1 => 1382949173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175950380952438e583dac59-39182575',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438e58439028_26001461',
  'variables' => 
  array (
    'roleList' => 0,
    'val' => 0,
    'tableList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438e58439028_26001461')) {function content_52438e58439028_26001461($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>添加用户 - Powered By sqtang</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<style type="text/css">
.roles label {
	width: 150px;
	display: block;
	float: left;
	padding-right: 6px;
}
div.xxDialog .dialoglistIcon {
    line-height: 24px;
    margin: 15px 0 40px 0px;
    padding-left: 15px;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	$("#selectTable").click(function(){
		$("#tableinfo").show();
	});
	$("#tableinfo .closeButton").click(function(){
		$("#tableinfo").hide();
	});
	
	
	// 表单验证
	$inputForm.validate({
		rules: {
			username: {
				required: true,
				pattern: /^[0-9a-z_A-Z\u4e00-\u9fa5]+$/,
				minlength: 2,
				maxlength: 20,
				remote: {
					url: "?app=user&act=isExistUsername",
					cache: false
				}
			},
			password: {
				required: true,
				pattern: /^[^\s&\"<>]+$/,
				minlength: 4,
				maxlength: 20
			},
			rePassword: {
				required: true,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			role: "required"
		},
		messages: {
			username: {
				pattern: "非法字符",
				remote: "用户名已存在"
			},
			password: {
				pattern: "非法字符"
			}
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		用户管理 &raquo; 添加用户
	</div>
	<form id="inputForm" action="?app=user&act=addUser" method="post">
		<ul id="tab" class="tab">
			<li>
				<input type="button" value="基本信息" />
			</li>
			
		</ul>
		<table class="input tabContent">
			<tr>
				<th>
					<span class="requiredField">*</span>用户名:
				</th>
				<td>
					<input type="text" name="username" class="text" maxlength="20" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>密码:
				</th>
				<td>
					<input type="password" id="password" name="password" class="text" maxlength="20" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>确认密码:
				</th>
				<td>
					<input type="password" name="rePassword" class="text" maxlength="20" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>E-mail:
				</th>
				<td>
					<input type="text" name="email" class="text" maxlength="200" />
				</td>
			</tr>

			<tr>
				<th>
					姓名:
				</th>
				<td>
					<input type="text" name="truename" class="text" maxlength="200" />
				</td>
			</tr>
			<tr class="roles">
				<th>
					<span class="requiredField">*</span>角色:
				</th>
				<td>
					<select id="type" name="role">
						<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['roleList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['gid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['gname'];?>
</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					表:
				</th>
				<td>
					<input type="button"  class="button" id="selectTable" value="选择表"/>
				</td>
				
			</tr>
			<tr>
				<th>
					设置:
				</th>
				<td>
					<label>
						<input type="checkbox" name="isEnabled" value="1" checked="checked" />是否启用
					</label>
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
		<div class="xxDialog" id="tableinfo" style="width: 600px; height: auto; margin-left: -300px; z-index: 100;display:none;">
		<div class="dialogClose closeButton"></div>
		<div class="dialogTitle">用户操作的表</div>
		<div class="dialogContent dialoglistIcon">
			  <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tableList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
				<label>
					<input type="checkbox" name="tid[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['tid'];?>
" /><?php echo $_smarty_tpl->tpl_vars['val']->value['t_name'];?>

				</label>
			 <?php } ?>
		</div>
		<div class="dialogBottom"><input type="button" class="button closeButton" value="确定"/></div>
	</div>
	</form>
</body>
</html><?php }} ?>