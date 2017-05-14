<?php /* Smarty version Smarty-3.1.14, created on 2013-10-14 12:01:21
         compiled from "/var/www/html/material/exten/admin/template/welcome.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:60857901552438b56305b70-71324862%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b4ac1bb8db62e74f0e53ae3d0d06f2b90623c2c' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/welcome.tpl.htm',
      1 => 1381723261,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60857901552438b56305b70-71324862',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438b56346de5_36059728',
  'variables' => 
  array (
    'basicInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438b56346de5_36059728')) {function content_52438b56346de5_36059728($_smarty_tpl) {?><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=utf-8" http-equiv="content-type">
<title>管理中心首页 - Powered By SQTANG</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<style type="text/css">
.input .powered {
	font-size: 11px;
	text-align: right;
	color: #cccccc;
}
</style>
<script type="text/javascript">
$().ready(function() {

	$.message("success", "欢迎使用原料数据管理系统!");

});
</script>
</head>
<body>
	<div class="path">
		管理中心首页
	</div>
	<table class="input" style="font-size:12px;">
		<tbody>
		<tr>
			<th>
				系统名称:
			</th>
			<td>
				生物质能源原料相关信息数据库系统
			</td>
			<th>
				系统版本:
			</th>
			<td>
				1.0 RELEASE
			</td>
		</tr>
		
		<tr>
			<td colspan="4">
				&nbsp;
			</td>
		</tr>
		<tr>
			<th>
				操作系统:
			</th>
			<td colspan="3">
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['systemRealse'];?>

			</td>
		</tr>
		<tr>
			<th>
				通信协议:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['serverProtocol'];?>

			</td>
			<th>
				域名:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['serverName'];?>

			</td>
		</tr>
		<tr>
			<th>
				服务器IP:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['serverAddr'];?>

			</td>
			<th>
				&nbsp;
			</th>
			<td>
				&nbsp;
			</td>
		</tr>
		
		<tr>
			<td colspan="4">
				&nbsp;
			</td>
		</tr>
		<tr>
			<th>
				WEB服务器:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['serverSoftware'];?>

			</td>
			<th>
				数据库:
			</th>
			<td>
				MySQL <?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['mysqlVersion'];?>

			</td>
		</tr>
		<tr>
			<th>
				开发语言:
			</th>
			<td>
				PHP <?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['phpVersion'];?>

			</td>
			<th>
				运行方式:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['phpSapiName'];?>

			</td>
		</tr>
		<tr>
			<th>
				缓存:
			</th>
			<td>
				Memcached
			</td>
			<th>
				根目录:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['documentRoot'];?>

			</td>
		</tr>
		
		<tr>
			<td colspan="4">
				&nbsp;
			</td>
		</tr>
		<tr>
			<th>
				客户端IP:
			</th>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['remoteAddr'];?>

			</td>
			<th>
				&nbsp;
			</th>
			<td>
				&nbsp;
			</td>
		</tr>
		
		<tr>
			<td colspan="4" class="powered">
				COPYRIGHT &copy; 2005-2013  ALL RIGHTS RESERVED.
			</td>
		</tr>
	</tbody>
	</table>
</body>
</html><?php }} ?>