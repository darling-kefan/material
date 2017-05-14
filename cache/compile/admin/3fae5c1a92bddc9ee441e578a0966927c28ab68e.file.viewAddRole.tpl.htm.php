<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 11:13:39
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_role\viewAddRole.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:182535235966346fae1-36744111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fae5c1a92bddc9ee441e578a0966927c28ab68e' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_role\\viewAddRole.tpl.htm',
      1 => 1378889128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182535235966346fae1-36744111',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'groupinfo' => 0,
    'modulelist' => 0,
    'val' => 0,
    'key' => 0,
    'item' => 0,
    'aclList' => 0,
    'acls' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52359663581e67_55353249',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52359663581e67_55353249')) {function content_52359663581e67_55353249($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>添加角色 - 原料数据中心</title>
<meta name="author" content="SHOP++ Team" />
<meta name="copyright" content="SHOP++" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<style type="text/css">
.authorities label {
	min-width: 120px;
	_width: 120px;
	display: block;
	float: left;
	padding-right: 4px;
	_white-space: nowrap;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $selectAll = $("#inputForm .selectAll");
	var $act       = $('.acts');
	var $module    = $('.module');
	
	//如果模块取消，下面的操作权限也取消
	$module.click(function(){
		var name = $(this).attr("name");
		if($(this).prop("checked") == false){
			$("input[pid='" +name + "']").prop("checked", false);
		}
	});

	//如果操作权限选中，则模块权限自动选中
	$act.click(function(){
		var parentNode = $(this).attr("pid");
		if($(this).prop("checked") == true){
			$("input[name='" +parentNode + "']").prop("checked", true);
		}
	});
	
	
	$selectAll.click(function() {
		var $this = $(this);
		var $thisCheckbox = $this.closest("tr").find(":checkbox");
		if ($thisCheckbox.filter(":checked").size() > 0) {
			$thisCheckbox.prop("checked", false);
		} else {
			$thisCheckbox.prop("checked", true);
		}
		return false;
	});
	
	// 表单验证
	$inputForm.validate({
		rules: {
			name: "required",
			authorities: "required"
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		角色管理&raquo; 添加角色
	</div>
	
	<form id="inputForm" action="?app=role&act=addRole" method="post">
		<ul id="tab" class="tab">
			<li>
				<input type="button" value="基本" />
			</li>
			<li>
				<input type="button" value="显示" />
			</li>
			<li>
				<input type="button" value="操作" />
			</li>
		</ul>
		<table class="input tabContent">
			<tr>
				<th>
					<span class="requiredField">*</span>名称:
				</th>
				<td>
					<input type="text" name="name" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['groupinfo']->value['gname'];?>
" />
				</td>
			</tr>
			<tr>
				<th>
					描述:
				</th>
				<td>
					<input type="text" name="description" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['groupinfo']->value['gdescription'];?>
" />
				</td>
			</tr>
		</table>
		<table class="input tabContent">
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['modulelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
			<tr class="authorities">
				<th>
					<a href="javascript:;" class="selectAll" title="全选此组权限"><?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
</a>
				</th>
				<td>
					<span class="fieldSet">
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<label>
							<input type="checkbox" class="module" name="authorities[<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
]" value="1" /><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

						</label>
						<?php } ?>
					</span>
				</td>
			</tr>
			<?php } ?>
		
		</table>
		<table class="input tabContent">
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aclList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
			<tr class="authorities">
				<th>
					<a href="javascript:;" class="selectAll" title="全选此组权限"><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</a>
				</th>
				<td>
					<span class="fieldSet">
						<?php  $_smarty_tpl->tpl_vars['acls'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['acls']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['operates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['acls']->key => $_smarty_tpl->tpl_vars['acls']->value){
$_smarty_tpl->tpl_vars['acls']->_loop = true;
?>
						<label>
							<input type="checkbox" pid="authorities[<?php echo $_smarty_tpl->tpl_vars['val']->value['pid'];?>
][<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
]" class="acts" name="authorities[<?php echo $_smarty_tpl->tpl_vars['val']->value['pid'];?>
][<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['acls']->value['type'];?>
]" value="1" /><?php echo $_smarty_tpl->tpl_vars['acls']->value['name'];?>

						</label>
						<?php } ?>
					</span>
				</td>
			</tr>
			<?php } ?>

		</table>
		<table class="input">
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="提&nbsp;&nbsp;交" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="history.go(-1)" />
				</td>
			</tr>
		</table>
	</form>
	
	
	
	
</body>
</html><?php }} ?>