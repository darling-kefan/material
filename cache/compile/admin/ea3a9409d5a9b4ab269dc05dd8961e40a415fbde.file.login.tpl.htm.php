<?php /* Smarty version Smarty-3.1.14, created on 2013-12-04 10:44:26
         compiled from "/var/www/html/material/exten/admin/template/login.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:45118183152438a245aae23-80332304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea3a9409d5a9b4ab269dc05dd8961e40a415fbde' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/login.tpl.htm',
      1 => 1386124745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45118183152438a245aae23-80332304',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438a245f43b3_97535928',
  'variables' => 
  array (
    '_Title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438a245f43b3_97535928')) {function content_52438a245f43b3_97535928($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<link href="exten/admin/template/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript">
	$().ready( function() {
		
		var $submit = $("#submit");
		var $username = $("#username");
		var $password = $("#password");
		var $captcha = $("#captcha");
		var $captchaImage = $("#captchaImage");
		
		// 更换验证码
		$captchaImage.click( function() {
			$captchaImage.attr("src", "http://58.30.229.107/material/admin.php?app=login&act=getAuthImage&timestamp=" + (new Date()).valueOf());
		});
		
		// 表单验证
		$submit.click( function() {
			if ($username.val() == "") {
				$.message("warn", "请输入您的用户名");
				return false;
			}
			if ($password.val() == "") {
				$.message("warn", "请输入您的密码");
				return false;
			}
			if ($captcha.val() == "") {
				$.message("warn", "请输入您的验证码");
				return false;
			}
			
			var pars =$("#loginForm").serialize();
			var url ="admin.php?app=login&act=asyncLogin";
			$.ajax({
				url:url,
				type:"post",
				dataType:"json",
				data:pars,
				success:function(msg){
				    var error = msg.error;
					//成功
					if(error == 0)
					{
						window.location.href="admin.php";
					}
					//失败
					else if(error == 1)
					{
						$captchaImage.attr("src", "admin.php?app=login&act=getAuthImage&timestamp=" + (new Date()).valueOf());
						return; 
					}
					//登陆超时
					else
					{
						window.location.href="?app=login&act=loginShow"; 
					}
				},
				error:function(aa,bb,cc)
				{
					alert("提交失败！");
				}
			})
		});
	});
</script>
</head>

<body>
	<div class="login">
		<form id="loginForm" method="post">
			<table>
				<tr>
					<td width="190" rowspan="2" align="center" valign="bottom">
						<img src="exten/admin/template/images/login_logo.gif" alt="生物质能源原料相关信息数据库系统" />
					</td>
					<th>
						用户名:
					</th>
					<td>
						<input type="text" id="username" name="passport" class="text" value="" maxlength="20" />
					</td>
				</tr>
				<tr>
					<th>
						密&nbsp;&nbsp;&nbsp;码:
					</th>
					<td>
						<input type="password" id="password" name="password" class="text" value="" maxlength="20" autocomplete="off" />
					</td>
				</tr>
				
					<tr>
						<td>
							&nbsp;
						</td>
						<th>
							验证码:
						</th>
						<td>
							<input type="text" id="captcha" name="authCode" class="text captcha" maxlength="4" autocomplete="off" /><img id="captchaImage" class="captchaImage" src="?app=login&act=getAuthImage" title="点击更换验证码" />
						</td>
					</tr>
				
				<tr>
					<td>
						&nbsp;
					</td>
					<th>
						&nbsp;
					</th>
					<td>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						&nbsp;
					</td>
					<th>
						&nbsp;
					</th>
					<td>
						<input type="button" class="homeButton" value="" onclick="location.href='admin.php'" /><input type="button" id="submit" class="loginButton" value="登录" />
					</td>
				</tr>
			</table>
			<div class="powered">COPYRIGHT © 2005-2013 SHOPXX.NET ALL RIGHTS RESERVED.</div>
			<div class="link">
				<a href="admin.php">网站首页</a> |
				<a href="#">关于我们</a> |
				<a href="#">联系我们</a>
			</div>
		</form>
	</div>
</body>
</html>
<?php }} ?>