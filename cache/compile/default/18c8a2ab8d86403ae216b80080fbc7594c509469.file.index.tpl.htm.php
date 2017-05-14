<?php /* Smarty version Smarty-3.1.14, created on 2013-12-07 10:59:35
         compiled from "/var/www/html/material/exten/default/template/index.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:18292293452849b51d29d15-17627310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18c8a2ab8d86403ae216b80080fbc7594c509469' => 
    array (
      0 => '/var/www/html/material/exten/default/template/index.tpl.htm',
      1 => 1386385389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18292293452849b51d29d15-17627310',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52849b51d6a130_18503615',
  'variables' => 
  array (
    'quotaRecords' => 0,
    'val' => 0,
    'key' => 0,
    'item' => 0,
    'LatestArr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52849b51d6a130_18503615')) {function content_52849b51d6a130_18503615($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>原料中心</title>
<link href="exten/default/template/css/base.css" rel="stylesheet" type="text/css" /> 
<link href="exten/default/template/css/comm.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="exten/default/template/js/jquery.js"></script>
<script type="text/javascript">
$().ready(function() {
	var $tipli = $("#selectTips li");
	var $tipContent = $("ul[class='tipContent']");
	
	$("#selectTips li:first").show();
	$("ul[class='tipContent']:first").show();
	
	$tipli.each(function(i){
		$(this).bind('click',function(){
			//alert($(this).text());
			$tipContent.hide();
			$tipli.removeClass("selected-fasttip");
			$(this).addClass("selected-fasttip");
			$("#tip_" + i).show();
		});
	});
	
	//分类弹出层
	$("div.g-main-nav ul li").mouseover( function() {
		var $popupMenu = $(this).children("dl");
		$popupMenu.show();
		$(this).css("background-color", "#F9F9F9");
		$(this).mouseleave(function() {
			$popupMenu.hide();
		});
	});
});

</script>
</head>

<body>

<?php echo $_smarty_tpl->getSubTemplate ('_main/header.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="main-wraper">
	<div class="main">
		
		<div class="container">
			<div class="left-side">
				<div class="fasttips">
					<div class="fasttips-banner">
						<span>快速查询</span>
						<ul id="selectTips">
							<li class="selected-fasttip">月度数据</li>
							<li>季度数据</li>
							<li>年度数据</li>
						</ul>
					</div>
					<div class="fasttips-content">
					 <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['quotaRecords']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
					 <?php if ($_smarty_tpl->tpl_vars['val']->value!=''){?>
						<ul id="tip_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="tipContent" style="display:none">
							 <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
							<li><a href="index.php?app=classification&quotaid=<?php echo $_smarty_tpl->tpl_vars['item']->value['quotaid'];?>
&amp;classid=<?php echo $_smarty_tpl->tpl_vars['item']->value['classid'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['quotaname'];?>
</a></li>
							<?php } ?>
						</ul>
						<?php }?>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="right-side">
				<div class="hotupdate">
					<div class="hd">
						<h2>数据更新</h2>
					</div>
					<?php if ($_smarty_tpl->tpl_vars['LatestArr']->value){?>
					<ul>
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LatestArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['tname']==''){?>
						<?php continue 1?>
						<?php }?>
						<li><a href="index.php?app=classification&tid=<?php echo $_smarty_tpl->tpl_vars['item']->value['tid'];?>
&classid=<?php echo $_smarty_tpl->tpl_vars['item']->value['classid'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['tname'];?>
</a><span>
						(<?php echo $_smarty_tpl->tpl_vars['item']->value['t_time'];?>
)</span></li>
						<?php } ?>
					</ul>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('_main/footer.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


</body>
</html><?php }} ?>