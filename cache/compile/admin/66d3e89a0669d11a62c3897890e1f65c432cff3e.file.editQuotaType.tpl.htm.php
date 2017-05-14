<?php /* Smarty version Smarty-3.1.14, created on 2013-11-22 16:03:05
         compiled from "/var/www/html/material/exten/admin/template/_quota/editQuotaType.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1494430263528ef4122a5db4-42433397%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66d3e89a0669d11a62c3897890e1f65c432cff3e' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_quota/editQuotaType.tpl.htm',
      1 => 1385107363,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1494430263528ef4122a5db4-42433397',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528ef412326840_58684963',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'quotaInfo' => 0,
    'classList' => 0,
    'classQuotas' => 0,
    'quotaClassItem' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528ef412326840_58684963')) {function content_528ef412326840_58684963($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	var $selectClassify = $("#classifyID");
	var $quotaholder = $("#quotaholder");
	
	//为Select添加事件，当选择其中一项时触发
	$selectClassify.change(function(){
		var classifyID = $(this).val();
		$quotaholder.html('');
		
		//异步请求数据
		$.ajax({
			url: "admin.php?app=quotaType&act=asyncQuotaClass",
			type: "POST",
			data: {id: classifyID},
			dataType: "json",
			cache: false,
			success: function(data) {
				if (data.type == 1) {
					var quota = "<select name=\"quotaParentID\" disabled=\"disabled\"> <option value=\"0\">---顶级分类---</option> ";
					console.log(data.data);
					$.each(data.data, function(key,val){
						quota = quota + "<option value=\"" + val.qcid + "\">";
						for (i=1; i<=val.level; i++) {
							quota = quota + "&nbsp;&nbsp;";
						}
						quota = quota + val.qcname + "</option>";
					});
					quota = quota + "</select>";
					$quotaholder.html(quota);
					
				} else if (data.type == 2) {
					$quotaholder.html("<select name=\"quotaParentID\"> <option value=\"0\">---顶级分类---</option> </select>");
				}
			}
		});
	});
	
	
	// 表单验证
	$inputForm.validate({
		rules: {
			name: "required",
			classifyID: "required",
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
	<form id="inputForm" action="admin.php?app=quotaType&act=editQuotaType" method="post">
		<input type="hidden" name="qcid" value="<?php echo $_smarty_tpl->tpl_vars['quotaInfo']->value['qcid'];?>
" />
		<table class="input">
			<tr>
				<th>
					<span class="requiredField">*</span>所属分类:
				</th>
				<td>
					<input type="hidden" name="classifyID" value="<?php echo $_smarty_tpl->tpl_vars['quotaInfo']->value['classid'];?>
" />
					<select id="classifyID" name="classifyID"  disabled="disabled">
						<option value="">---请选择---</option>
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
" <?php if ($_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['leaf']==0){?>disabled="true"<?php }?> <?php if ($_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid']==$_smarty_tpl->tpl_vars['quotaInfo']->value['classid']){?>selected="selected"<?php }?>>
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
					<span class="requiredField">*</span>所属指标分类:
				</th>
				<td id="quotaholder">
					<select name="quotaParentID">
						<option value="0">---顶级分类---</option>
						<?php  $_smarty_tpl->tpl_vars['quotaClassItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quotaClassItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['classQuotas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quotaClassItem']->key => $_smarty_tpl->tpl_vars['quotaClassItem']->value){
$_smarty_tpl->tpl_vars['quotaClassItem']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['quotaClassItem']->value['qcid'];?>
" <?php if ($_smarty_tpl->tpl_vars['quotaClassItem']->value['qcid']==$_smarty_tpl->tpl_vars['quotaInfo']->value['parentid']){?>selected="selected"<?php }?>>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['name'] = 'quotaLevel';
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['quotaClassItem']->value['level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total']);
?>
									&nbsp;&nbsp;
								<?php endfor; endif; ?>
								<?php echo $_smarty_tpl->tpl_vars['quotaClassItem']->value['qcname'];?>

							</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					&nbsp;
				</td>
			</tr>
			
			<tr>
				<th>
					<span class="requiredField">*</span>指标分类名称:
				</th>
				<td>
					<input type="text" id="name" name="name" class="text" value="<?php echo $_smarty_tpl->tpl_vars['quotaInfo']->value['qcname'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					排序:
				</th>
				<td>
					<input type="text" name="order" class="text" value="<?php echo $_smarty_tpl->tpl_vars['quotaInfo']->value['qsort'];?>
" maxlength="9" />
				</td>
			</tr>
			
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					&nbsp;
				</td>
			</tr>
			
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=quotaType&act=quotaTypeManager'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>