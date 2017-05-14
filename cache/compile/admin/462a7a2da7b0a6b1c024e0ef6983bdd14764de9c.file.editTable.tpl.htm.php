<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 08:40:52
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_materialTable\editTable.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1001352357294996845-15744144%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '462a7a2da7b0a6b1c024e0ef6983bdd14764de9c' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_materialTable\\editTable.tpl.htm',
      1 => 1378890466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1001352357294996845-15744144',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basicList' => 0,
    '_Title' => 0,
    'tableAttrs' => 0,
    '_Rank' => 0,
    'fieldList' => 0,
    'classList' => 0,
    'tableFields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52357294cb8ff5_04737315',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52357294cb8ff5_04737315')) {function content_52357294cb8ff5_04737315($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'D:\\VertrigoServ\\www\\material\\_inc\\_libs\\Smarty\\libs\\plugins\\modifier.regex_replace.php';
?><?php $_smarty_tpl->_capture_stack[0][] = array('banner', null, null); ob_start(); ?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['field'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['field']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['name'] = 'field';
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['basicList']->value['FieldType']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total']);
?><option value="<?php echo $_smarty_tpl->tpl_vars['basicList']->value['FieldType'][$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['field']['index']==0){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['basicList']->value['FieldType'][$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']];?>
</option><?php endfor; endif; ?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $specificationTable = $("#specificationTable");
	var $type = $("#type");
	var $addSpecificationValueButton = $("#addSpecificationValueButton");
	var $deleteSpecificationValue = $("a.deleteSpecificationValue");
	var specificationValueIndex = <?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['fieldsCount']-1;?>
;
	
	$("input.browserButton").browser();
	
	// 增加表字段
	$addSpecificationValueButton.click(function() {
		var trHtml = '<tr class="specificationValueTr"> <td> &nbsp; <\/td> <td> <input type="text" name="fieldName[' + specificationValueIndex + ']" class="text fieldName" maxlength="200" \/> <\/td> <td> <span class="fieldSet"> <select id="type" name="fieldType[' + specificationValueIndex + ']"><?php echo smarty_modifier_regex_replace(Smarty::$_smarty_vars['capture']['banner'],"/[\/]/","\/");?>
<\/select> <\/span> <\/td> <td> <label> <input type="checkbox" checked="checked" name="isNull[' + specificationValueIndex + ']" value="1" \/> <\/label> </td> <td> <input type="text" name="defaultValue[' + specificationValueIndex + ']" class="text defaultValue" maxlength="9" style="width: 50px;" \/> <\/td> <td> <input type="text" name="fieldComment[' + specificationValueIndex + ']" class="text fieldComment" maxlength="9" \/> <\/td> <td> <a href="javascript:;" class="deleteSpecificationValue">[删除]<\/a> <\/td> <\/tr>';
		$specificationTable.append(trHtml).find("input.browserButton:last").browser();
		specificationValueIndex ++;
	});

	// 删除表字段
	$deleteSpecificationValue.live("click", function() {
		var $this  = $(this);
		//$this.closest("tr").remove();
		if (typeof $this.attr("val") != 'undefined') {
			$.dialog({
				type: "warn",
				content: "您确定要删除吗？",
				onOk: function() {
					$.ajax({
						url: "admin.php?app=materialTable&act=deleteTableField",
						type: "POST",
						data: {data: $this.attr("val")},
						dataType: "json",
						cache: false,
						success: function(message) {
							$.message(message);
							if (message.type == "success") {
								$this.closest("tr").remove();
							}
						}
					});
				}
			});
			return false;
		} else {
			$this.closest("tr").remove();
		}
		
	});

	$.validator.addClassRules({
		fieldName: {
			required: true
		},
		fieldComment: {
			//digits: true
			required: true
		}
	});
	
	// 表单验证
	$inputForm.validate({
		rules: {
			tableName: "required",
			comment: "required",
			orders: "required"
		}
	});

});
</script>
</head>
<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="inputForm" action="admin.php?app=materialTable&act=alterTable" method="post">
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['id'];?>
" />
		<input type="hidden" name="fieldList" value="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value;?>
" />
		<table id="specificationTable" class="input">
			<tr class="titleTr">
				<th>
					<span class="requiredField">*</span>数据表名:
				</th>
				<td colspan="7">
					<input type="text" name="tableName" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableName'];?>
" maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>所属分类:
				</th>
				<td>
					<select name="parentId">
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
" <?php if ($_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid']==$_smarty_tpl->tpl_vars['tableAttrs']->value['classid']){?>selected="selected"<?php }?>>
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
					<span class="requiredField">*</span>引擎类型:
				</th>
				<td colspan="7">
					<select id="type" name="storage_engine">
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['engine'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['name'] = 'engine';
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['basicList']->value['EngineType']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['engine']['total']);
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['basicList']->value['EngineType'][$_smarty_tpl->getVariable('smarty')->value['section']['engine']['index']];?>
" <?php if (mb_strtolower($_smarty_tpl->tpl_vars['basicList']->value['EngineType'][$_smarty_tpl->getVariable('smarty')->value['section']['engine']['index']], 'UTF-8')==mb_strtolower($_smarty_tpl->tpl_vars['tableAttrs']->value['engine'], 'UTF-8')){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['basicList']->value['EngineType'][$_smarty_tpl->getVariable('smarty')->value['section']['engine']['index']];?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>编码类型:
				</th>
				<td colspan="7">
					<select id="type" name="encoding_type">
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['encode'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['name'] = 'encode';
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['basicList']->value['EncodeType']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['encode']['total']);
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['basicList']->value['EncodeType'][$_smarty_tpl->getVariable('smarty')->value['section']['encode']['index']];?>
" <?php if (mb_strtolower($_smarty_tpl->tpl_vars['basicList']->value['EncodeType'][$_smarty_tpl->getVariable('smarty')->value['section']['encode']['index']], 'UTF-8')==mb_strtolower($_smarty_tpl->tpl_vars['tableAttrs']->value['encode'], 'UTF-8')){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['basicList']->value['EncodeType'][$_smarty_tpl->getVariable('smarty')->value['section']['encode']['index']];?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>表描述:
				</th>
				<td colspan="7">
					<input type="text" name="comment" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableComment'];?>
" maxlength="50" style="width:300px" />&nbsp;&nbsp;(如：中国2011年城市排水和污水处理统计)
				</td>
			</tr>
			<tr>
				<th>
					表排序:
				</th>
				<td colspan="7">
					<input type="text" name="orders" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['sort'];?>
" maxlength="200" style="width:50px" />
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td colspan="6">
					<a href="javascript:;" id="addSpecificationValueButton" class="button">增加字段</a>
				</td>
			</tr>
			<tr class="title">
				<td>
					&nbsp;
				</td>
				<td>
					字段
				</td>
				<td>
					字段类型
				</td>
				<td>
					空值
				</td>
				<td>
					默认值
				</td>
				<td>
					注释
				</td>
				<td>
					删除
				</td>
			</tr>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['field'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['field']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['name'] = 'field';
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tableFields']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['field']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['field']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['field']['total']);
?>
				<tr class="specificationValueTr">
					<td>
						
					</td>
					<td>
						<input type="hidden" name="fieldName[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text fieldName" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field'];?>
" maxlength="100" />
						<input type="text" name="disabled" class="text fieldName" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field'];?>
" maxlength="100" disabled="disabled" />
					</td>
					<td>
						<select id="type" name="fieldType[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]">
							<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['name'] = 'ftype';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['basicList']->value['FieldType']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ftype']['total']);
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['basicList']->value['FieldType'][$_smarty_tpl->getVariable('smarty')->value['section']['ftype']['index']];?>
" <?php if (mb_strtoupper($_smarty_tpl->tpl_vars['basicList']->value['FieldType'][$_smarty_tpl->getVariable('smarty')->value['section']['ftype']['index']], 'UTF-8')==mb_strtoupper($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['type'], 'UTF-8')){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['basicList']->value['FieldType'][$_smarty_tpl->getVariable('smarty')->value['section']['ftype']['index']];?>
</option>
							<?php endfor; endif; ?>
						</select>
					</td>
					<td>
						<label>
							<input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['null']=='YES'){?>checked="checked"<?php }?> name="isNull[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" value="1" />
						</label>
					</td>
					<td>
						<input type="text" name="defaultValue[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text defaultValue" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['default'];?>
" maxlength="100" style="width:50px" />
					</td>
					<td>
						<input type="text" name="fieldComment[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text fieldComment" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['comment'];?>
" maxlength="200" />
					</td>
					<td>
						<a href="javascript:;" class="deleteSpecificationValue" val="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableName'];?>
:<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field'];?>
">[删除]</a>
					</td>
				</tr>
				<?php endfor; endif; ?>
		</table>
		<table class="input">
			<tr>
				<th>
					&nbsp;
				</th>
				<td colspan="7">
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=getTablesList'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>