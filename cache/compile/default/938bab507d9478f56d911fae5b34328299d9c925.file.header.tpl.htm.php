<?php /* Smarty version Smarty-3.1.14, created on 2013-12-09 18:20:07
         compiled from "/var/www/html/material/exten/default/template/_main/header.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:139137876052849b51d6d759-59396049%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '938bab507d9478f56d911fae5b34328299d9c925' => 
    array (
      0 => '/var/www/html/material/exten/default/template/_main/header.tpl.htm',
      1 => 1386584610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139137876052849b51d6d759-59396049',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52849b51d703e6_69400770',
  'variables' => 
  array (
    'uname' => 0,
    'keywordsArr' => 0,
    'val' => 0,
    'item' => 0,
    'classid' => 0,
    'tableclassArr' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52849b51d703e6_69400770')) {function content_52849b51d703e6_69400770($_smarty_tpl) {?><div id="header">
	<div class="g-toolbar">
		<div class="wrapper">
			<div class="quick-link">
				<?php if ($_smarty_tpl->tpl_vars['uname']->value!=''){?>
				<span id="toolBarWelcome" class="welcome child-node"><?php echo $_smarty_tpl->tpl_vars['uname']->value;?>
&nbsp;你好，欢迎来原料中心！</span>
			
				<span id="logReg">
					<a class="child-node" rel="nofollow" href="index.php?app=exit">退出</a>
				</span>
				<?php }else{ ?>
				<span id="logReg">
					<a class="child-node" rel="nofollow" href="index.php?app=login" name="homepage_toubu_toolbar02">登录</a>
					<a class="child-node" rel="nofollow" href="index.php?app=registration" name="homepage_toubu_toolbar03">注册</a>
				</span>
				<?php }?>
			</div>
		</div>
	</div>
	<div id="headerContent">
		<div class="g-logo">
			<a href="index.php"><h1>原料中心</h1></a>
		</div>
		<div class="g-search">
			<form onsubmit="return SFE.base.onSubmitSearch(this)" method="get" action="index.php">
			    <input type="hidden" name="app" value='search'/>
				<input type="hidden" name="act" value='index'/>
				<span class="left-sidebar"></span>
				<input id="searchKeywords" class="search-keyword" type="text" name="keywords" autocomplete="off" value="" tabindex="0" style="color: rgb(153, 153, 153);">
				<input id="searchSubmit" class="search-btn" type="submit" value="">
				<span class="right-sidebar"></span>
				<div id="snKeywordNew" style="display:none;"></div>
			</form>
			<div id="ac_results" class="g-ac-results hide" style="display: none;"></div>
		</div>
		<div class="g-keywords">
		    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['keywordsArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
			<a href="index.php?app=search&keywords=<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</a>&nbsp;&nbsp;
			<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div id="menu">
		<div class="g-main-nav">
			<ul>
			   <?php if ($_smarty_tpl->tpl_vars['classid']->value==''){?>
				<li class="current"><a href="index.php">首&nbsp;页</a></li>
				<?php }else{ ?>
					<li><a href="index.php">首&nbsp;页</a></li>
				<?php }?>
				
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tableclassArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
					<?php if (is_array($_smarty_tpl->tpl_vars['val']->value['item'])){?>
				<li class="firstMenu"><a href="javascript:void(0)"><?php echo $_smarty_tpl->tpl_vars['val']->value['class_name'];?>
</a>
					<dl class="second-menu">
					    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
						<dd><a href="index.php?app=classification&classid=<?php echo $_smarty_tpl->tpl_vars['v']->value['classid'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['class_name'];?>
</a></dd>
						<?php } ?>
					</dl>
				</li>
				<?php }else{ ?>
				<?php if ($_smarty_tpl->tpl_vars['classid']->value==$_smarty_tpl->tpl_vars['val']->value['classid']){?>
				<li class="current"><a href="index.php?app=classification&classid=<?php echo $_smarty_tpl->tpl_vars['val']->value['classid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['class_name'];?>
</a>
				<?php }else{ ?>
				<li><a href="index.php?app=classification&classid=<?php echo $_smarty_tpl->tpl_vars['val']->value['classid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['class_name'];?>
</a>
				<?php }?>
				<?php }?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php }} ?>