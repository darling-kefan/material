<?php /* Smarty version Smarty-3.1.14, created on 2013-09-02 13:38:38
         compiled from "/var/www/material/exten/admin/template/main.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:5511623815224245e8921c6-72889892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b52bb65cdade2edff21741745c42c8719a05d969' => 
    array (
      0 => '/var/www/material/exten/admin/template/main.tpl.htm',
      1 => 1378098760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5511623815224245e8921c6-72889892',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'topMenu' => 0,
    'id' => 0,
    'name' => 0,
    'leftMenu' => 0,
    'val' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5224245e9178f8_84249901',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5224245e9178f8_84249901')) {function content_5224245e9178f8_84249901($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>数据中心 - Powered By sqtang</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<link href="exten/admin/template/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<style type="text/css">
*{
	font: 12px tahoma, Arial, Verdana, sans-serif;
}
html, body {
	width: 100%;
	height: 100%;
	overflow: hidden;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $nav = $("#nav a:not(:last)");
	var $menu = $("#menu dl");
	var $menuItem = $("#menu a");
	
	$nav.click(function() {
		var $this = $(this);
		$nav.removeClass("current");
		$this.addClass("current");
		var $currentMenu = $($this.attr("href"));
		$menu.hide();
		$currentMenu.show();
		$('#iframe').attr('src','?act=welcome');
		return false;
	});
	
	$menuItem.click(function() {
		var $this = $(this);
		$menuItem.removeClass("current");
		$this.addClass("current");
	});

});
</script>
</head>
<body>
	<script type="text/javascript">
		if (self != top) {
			top.location = self.location;
		};
	</script>
	<table class="main">
		<tr>
			<th class="logo"></th>
			<th>
				<div id="nav" class="nav">

					<ul>
						
						<?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['name']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['topMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['name']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
$_smarty_tpl->tpl_vars['name']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['name']->key;
 $_smarty_tpl->tpl_vars['name']->index++;
?>
						<?php if ($_smarty_tpl->tpl_vars['name']->index==0){?>
						<li><a href="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="current"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></li>
						<?php }else{ ?>
						<li><a href="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></li>
						<?php }?>
						<?php } ?>			
						<li style="display:none">
							<a href="#" target="_blank"></a>
						</li>
					</ul>

				</div>
				<div class="exit" style="float:right;margin-right:20px;padding-top:30px;">
				<a href="?app=exit" style=" height:30px; line-height:30px;font-weight:bold;font-size:12px;color:#488BD1;display:block;">退出</a>
				</div>
			</th>
		</tr>
		<tr>
			<td id="menu" class="menu">
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['leftMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['val']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['val']->key;
 $_smarty_tpl->tpl_vars['val']->index++;
?>
				<?php if ($_smarty_tpl->tpl_vars['val']->index==0){?>
				<dl id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="default">
				<?php }else{ ?>
				<dl id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
				<?php }?>
					<dt><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</dt>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<dd>
						<a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
" target="iframe"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
					</dd>
					<?php } ?>
				</dl>
				<?php } ?>
				
				
			</td>
			<td>
				<iframe id="iframe" name="iframe" src="?app=default&act=welcome" frameborder="0"></iframe>
			</td>
		</tr>
	</table>
</body>
</html><?php }} ?>