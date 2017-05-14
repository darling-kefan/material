<?php /* Smarty version Smarty-3.1.14, created on 2013-10-28 16:34:32
         compiled from "/var/www/html/material/exten/admin/template/_user/viewEditUser.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:55958682352438d2d57cf87-71702585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40ca8075032764ed0edceab8d0a72142e7650c7d' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_user/viewEditUser.tpl.htm',
      1 => 1382949263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55958682352438d2d57cf87-71702585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438d2d604b78_49726935',
  'variables' => 
  array (
    'userInfo' => 0,
    'roleList' => 0,
    'val' => 0,
    'tableList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438d2d604b78_49726935')) {function content_52438d2d604b78_49726935($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>编辑用户 - Powered By sqtang</title>
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
			password: {
				pattern: /^[^\s&\"<>]+$/,
				minlength: 4,
				maxlength: 20
			},
			rePassword: {
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			role: "required"
		},
		messages: {
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
		用户管理 &raquo; 编辑用户
	</div>
	<form id="inputForm" action="?app=user&act=editUser" method="post">
	<input type="hidden" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['uid'];?>
"/>
		<ul id="tab" class="tab">
			<li>
				<input type="button" value="基本信息" />
			</li>
			
		</ul>
		<table class="input tabContent">
			<tr>
				<th>用户名:</th>
				<td><input type="text" name="username" class="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['uname'];?>
" /></td>
			</tr>
			<tr>
				<th>
					密码:
				</th>
				<td>
					<input type="password" id="password" value="" name="password" class="text" maxlength="20" title="若留空则密码将保持不变"  />
				</td>
			</tr>
			<tr>
				<th>
					确认密码:
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
					<input type="text" name="email" class="text" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['uemail'];?>
" maxlength="200" />
				</td>
			</tr>

			<tr>
				<th>
					姓名:
				</th>
				<td>
					<input type="text" name="truename" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['truename'];?>
"/>
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
						    <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['gid']==$_smarty_tpl->tpl_vars['val']->value['gid']){?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['gid'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['val']->value['gname'];?>
</option>
							<?php }else{ ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['gid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['gname'];?>
</option>
							<?php }?>
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
						<?php if ($_smarty_tpl->tpl_vars['userInfo']->value['wether_to_enable']){?>
						<input type="checkbox" name="isEnabled" value="1" checked="checked" />是否启用
						<?php }else{ ?>
						<input type="checkbox" name="isEnabled" value="1" />是否启用
						<?php }?>
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
					<input type="button" class="button" value="返&nbsp;&nbsp;回"  onclick="history.go(-1)" />
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
" <?php echo $_smarty_tpl->tpl_vars['val']->value['checktxt'];?>
 /><?php echo $_smarty_tpl->tpl_vars['val']->value['t_name'];?>

				</label>
			 <?php } ?>
		</div>
		<div class="dialogBottom"><input type="button" class="button closeButton" value="确定"/></div>
	</form>
</body>
</html><?php }} ?>