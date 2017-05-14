<?php /* Smarty version Smarty-3.1.14, created on 2013-12-09 18:17:39
         compiled from "/var/www/html/material/exten/default/template/search.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1012765833528ab870a8a977-56389834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e62b680ac95029f445a80c9fade5e0cfad05ce20' => 
    array (
      0 => '/var/www/html/material/exten/default/template/search.tpl.htm',
      1 => 1386584257,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1012765833528ab870a8a977-56389834',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528ab870ad79b2_64808504',
  'variables' => 
  array (
    'type' => 0,
    'tableCount' => 0,
    'keywords' => 0,
    'currentTable' => 0,
    'recordCount' => 0,
    'tablelist' => 0,
    'val' => 0,
    'keyword' => 0,
    'filedArr' => 0,
    'recordList' => 0,
    'item' => 0,
    'pageSize' => 0,
    'pageStr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528ab870ad79b2_64808504')) {function content_528ab870ad79b2_64808504($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>原料中心</title>
<link href="exten/default/template/css/base.css" rel="stylesheet" type="text/css" /> 
<link href="exten/default/template/css/comm.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="exten/default/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {
	
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
			<div class="search-tip">
			<?php if ($_smarty_tpl->tpl_vars['type']->value==0){?>
				共有<?php echo $_smarty_tpl->tpl_vars['tableCount']->value;?>
个表有关于“<span class="highlight"><?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
</span>”的信息
			<?php }else{ ?>
				<span style="color:#ff3300;"><?php echo $_smarty_tpl->tpl_vars['currentTable']->value['tableinfo']['tname'];?>
</span>&nbsp;表中共有<?php echo $_smarty_tpl->tpl_vars['recordCount']->value;?>
个关于“<span class="highlight"><?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
</span>”的结果
			<?php }?>
			
			</div>
			<div class="search-container">
			<table width="978" style="line-height:25px;">
				<?php if ($_smarty_tpl->tpl_vars['type']->value==0){?>
					<tr><!--<th>表id</th>--><th>指标</th><th>关联字段</th><th>创建日期</th><th>所属栏目</th></tr>
					<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tablelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
					<tr>
					<!--<td><?php echo $_smarty_tpl->tpl_vars['val']->value['tid'];?>
</td>-->
					<td><a href="index.php?app=search&keywords=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&type=1&tid=<?php echo $_smarty_tpl->tpl_vars['val']->value['tid'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['tableinfo']['tname'];?>
</a></td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['fcomment'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['tableinfo']['t_time'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['classname'];?>
</td>
					</tr>
					<?php } ?>
				<?php }else{ ?>
				<tr>
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filedArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
					<th><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</th>
				<?php } ?>
					<th>所属表</th><th>所属栏目</th>
				</tr>
				<form id="listForm" action="index.php" method="get">
				<input type="hidden" name="app" value='search'/>
				<input type="hidden" name="act" value='index'/>
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recordList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
				<tr>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['val']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</td>
					<?php } ?>
					<td><?php echo $_smarty_tpl->tpl_vars['currentTable']->value['tableinfo']['tname'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['currentTable']->value['classname'];?>
</td>
				</tr>
				<?php } ?>
				
				<?php }?>
			</table>
			       <?php if ($_smarty_tpl->tpl_vars['type']->value==1){?>
					<input type="hidden" id="pageSize" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" />
					<input type="hidden" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
					<input type="hidden" name="tid" value="<?php echo $_smarty_tpl->tpl_vars['currentTable']->value['tableinfo']['tid'];?>
" />
					<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" />
					<?php echo $_smarty_tpl->tpl_vars['pageStr']->value;?>

					</form>
					<?php }?>
		
				<!--<dl>
					<dt>
						<span class="sear-tip">指标</span>
						<span class="sear-addr">地区</span>
						<span class="sear-time">数据时间</span>
						<span class="sear-data">数值</span>
						<span class="sear-class">所属栏目</span>
						<span class="sear-baobiao">相关报表</span>
					</dt>
					<dd>
						<span class="sear-tip">指标</span>
						<span class="sear-addr">地区</span>
						<span class="sear-time">数据时间</span>
						<span class="sear-data">数值</span>
						<span class="sear-class">所属栏目</span>
						<span class="sear-baobiao"><a href="#">相关报表</a></span>
					</dd>
					
					<dd class="search-pager">
						<ul>
							<li>
							<span class="select">首页</span>
							</li>
							<li>
							<span class="select">上页 </span>
							</li>
							<li class="select">
							<span>1</span>
							</li>
							<li>
							<a class="" href="/devices?page=2">2</a>
							</li>
							<li>
							<a class="" href="/devices?page=3">3</a>
							</li>
							<li>
							<a class="" href="/devices?page=4">4</a>
							</li>
							<li>
							<a class="" href="/devices?page=5">5</a>
							</li>
							<li>
							<a class="" href="/devices?page=6">6</a>
							</li>
							<li>
							<a class="" href="/devices?page=7">7</a>
							</li>
							<li>
							<a class="" href="/devices?page=8">8</a>
							</li>
							<li>
							<a class="" href="/devices?page=9">9</a>
							</li>
							<li>
							<a class="" href="/devices?page=10">10</a>
							</li>
							<li>
							<a class="" href="/devices?page=2">下页</a>
							</li>
							<li>
							<a class="" href="/devices?page=312">尾页</a>
							</li>
						</ul>
					</dd>
				</dl>-->
				
			</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('_main/footer.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


</body>
</html><?php }} ?>