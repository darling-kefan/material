<?php /* Smarty version Smarty-3.1.14, created on 2013-11-22 14:14:05
         compiled from "/var/www/html/material/exten/default/template/login.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:85401515752849ce67a4db4-47001940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12f74e79951f6b899b3f90d6a0f246f0083357b5' => 
    array (
      0 => '/var/www/html/material/exten/default/template/login.tpl.htm',
      1 => 1385100842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85401515752849ce67a4db4-47001940',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52849ce67ddaa6_42900140',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52849ce67ddaa6_42900140')) {function content_52849ce67ddaa6_42900140($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>原料中心---登录</title>
<link href="exten/default/template/css/base.css" rel="stylesheet" type="text/css" /> 
<link href="exten/default/template/css/comm.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="exten/default/template/js/jquery.js"></script>
<script type="text/javascript">
$().ready(function() {
	//弹出框操作
	jQuery.navlevel2 = function(level1,dytime) {
		$(level1).hover(function(){
			$(level1).find('dl').show();
		},
		function(){
			$(level1).find('dl').hide();
		});
	};
	//导航栏弹出框
	$.navlevel2("li.firstMenu",200);

	// 更换验证码
	var $captchaImage = $("#captchaImage");
	$captchaImage.click( function() {
		$captchaImage.attr("src", "?app=login&act=getAuthImage&timestamp=" + (new Date()).valueOf());
	});
	//登陆验证
	$('#submit').click(function(){
		if (trim($('#passport').val()) =='') {
		   $('#passport').parent().siblings('.reg-note').text('用户名不能为空!');
		   $('#passport').focus();
		   return false;	
		}

		if (trim($('#password').val()) =='') {
		   $('#password').parent().siblings('.reg-note').text('密码不能为空!');
		    $('#password').focus();
		   return false;	
		}

		if (trim($('#authcode').val()) =='') {
		   $('#authcode').parent().siblings('.reg-note').text('验证码不能为空!');
		    $('#authcode').focus();
		   return false;	
		}
		var pars =$("#loginForm").serialize();
		var url ="index.php?app=login&act=asyncLogin";
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
					window.location.href="index.php";
				}
				//失败
				else if(error == 1)
				{
					$captchaImage.attr("src", "index.php?app=login&act=getAuthImage&timestamp=" + (new Date()).valueOf());
					return; 
				}
				//登陆超时
				else
				{
					window.location.href="index.php?app=login&act=loginShow"; 
				}
			},
			error:function(aa,bb,cc)
			{
				alert("提交失败！");
			}
		})
	});
});

//删除左右两端的空格
function trim(str){ 
	return str.replace(/(^\s*)|(\s*$)/g, "");
}

</script>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ('_main/header.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="main-wraper">
	<div class="main">
		<div class="reg-hot-title">登录</div>
		<div class="container">
			<div class="reg-left-side">
				<div class="reg-content">
				<form id="loginForm" method="post">
					<ul>
						<li>
							<div class="reg-name">用户名：</div>
							<div class="reg-input"><input type="text"  id="passport" name="passport" /></div>
							<div class="reg-note"></div>
						
						</li>
						<li>
							<div class="reg-name">密码：</div>
							<div class="reg-input"><input type="password"  id="password" name="password" /></div>
							<div class="reg-note"></div>
						</li>
						<li>
							<div class="reg-name">验证码：</div>
							<div class="reg-input"><input type="text"  name="authcode" id="authcode" style="width:100px" /><img id="captchaImage" class="captchaImage" src="index.php?app=login&act=getAuthImage" title="点击更换验证码" /></div>
							<div class="reg-note"></div>
						</li>
						<li>
							<div class="reg-name"></div>
							<div><input class="my-btn-big" type="button" id="submit" class="loginButton" value="登录"></div>
						</li>
					</ul>
					</form>
				</div>
			</div>
			<div class="reg-right-side">
				<h2>帐号与您的设备</h2>
				<p> 感谢您的关注并准备注册为Yeelink用户。 </p>
				<p>
				作为一家传感器云网络提供商，我们致力于将您身边的物体接入互联网，并使您能方便地通过互联网或者移动设备了解他们的状态、控制他们。除了我们提供的硬件设备外，您也可以设计自己的传感器硬件，并通过
				<a target="_blank" href="http://www.yeelink.net/developer/doc?id=12">开放API</a>
				免费接入。
				</p>
				<p>
				当您成功注册帐号后，请使用
				<a target="_blank" href="/user">用户中心</a>
				提供的功能管理您的设备。
				</p>
				<p>
				已有账户？
				<a href="/login">立即登录</a>
				</p>
			</div>
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('_main/footer.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


</body>
</html><?php }} ?>