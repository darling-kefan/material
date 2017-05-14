<?php /* Smarty version Smarty-3.1.14, created on 2013-09-27 11:44:09
         compiled from "/var/www/html/material/exten/admin/template/_materialTableClass/addTableClass.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:11665552955244ff098258b2-93483734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc7593d165b00e9dd7a7e89d5ddbf4ee630f4feb' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTableClass/addTableClass.tpl.htm',
      1 => 1378347242,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11665552955244ff098258b2-93483734',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'classList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5244ff098856a1_85683704',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5244ff098856a1_85683704')) {function content_5244ff098856a1_85683704($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<style type="text/css">
.brands label {
	width: 150px;
	display: block;
	float: left;
	padding-right: 6px;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	

	// 表单验证
	$inputForm.validate({
		rules: {
			name: "required",
			order: "digits"
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="inputForm" action="admin.php?app=materialTableClass&act=addTableClass" method="post">
		<table class="input">
			<tr>
				<th>
					<span class="requiredField">*</span>名称:
				</th>
				<td>
					<input type="text" id="name" name="name" class="text" value="" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					上级分类:
				</th>
				<td>
					<select name="parentId">
						<option value="">顶级分类</option>
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['name'] = 'classinfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['classList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total']);
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid'];?>
">
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['name'] = 'classLevel';
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['classLevel']['total']);
?>
										&nbsp;&nbsp;
									<?php endfor; endif; ?>
									<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['className'];?>

							</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					排序:
				</th>
				<td>
					<input type="text" name="order" class="text" value="1" maxlength="9" />
				</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTableClass&act=getTableClassList'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>