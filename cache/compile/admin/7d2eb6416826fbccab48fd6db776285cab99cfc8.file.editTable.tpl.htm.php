<?php /* Smarty version Smarty-3.1.14, created on 2013-12-07 17:49:41
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/editTable.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:65463834352438b824bf929-66874281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d2eb6416826fbccab48fd6db776285cab99cfc8' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/editTable.tpl.htm',
      1 => 1386409989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65463834352438b824bf929-66874281',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438b82674e19_79754034',
  'variables' => 
  array (
    'basicList' => 0,
    'myId' => 0,
    'i' => 0,
    '_Title' => 0,
    'tableAttrs' => 0,
    '_Rank' => 0,
    'fieldList' => 0,
    'classList' => 0,
    'classQuotas' => 0,
    'quotaClassItem' => 0,
    'tableFields' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438b82674e19_79754034')) {function content_52438b82674e19_79754034($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/html/material/_inc/_libs/Smarty/libs/plugins/modifier.regex_replace.php';
?><!--<?php $_smarty_tpl->_capture_stack[0][] = array('banner', null, null); ob_start(); ?><?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['basicList']->value['FieldType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option><?php } ?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>-->
<?php $_smarty_tpl->_capture_stack[0][] = array('banner', null, null); ob_start(); ?><?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['basicList']->value['FieldType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option><?php } ?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
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
	var $selectClassify = $("#classifyID");
	var $quotaholder = $("#quotaholder td").eq(0);
	var specificationValueIndex = <?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['fieldsCount']-1;?>
;
	
	$("input.browserButton").browser();

	//为Select添加事件，当选择其中一项时触发
	$selectClassify.change(function(){
		var classifyID = $(this).val();
		$("#quotaholder").hide();
		
		//异步请求数据
		$.ajax({
			url: "admin.php?app=quotaType&act=asyncQuotaClass",
			type: "POST",
			data: {id: classifyID},
			dataType: "json",
			cache: false,
			success: function(data) {
				if (data.type == 1) {
					$("#quotaholder").show();
					
					var quota = "<select name=\"quotaParentID\"> <option value=\"\">---请选择---</option>";

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
					$("#quotaholder").show();

					var quota = "<span>无指标分类，您可以在此 <a href=\"admin.php?app=quotaType&act=viewAddQuotaType\" style=\"text-decoration:underline; color:red\">创建指标分类</a></span>";
					$quotaholder.html(quota);
				}
			}
		});
	});
	
	// 增加表字段
	$addSpecificationValueButton.click(function() {
		//包含指标
		//var trHtml = '<tr class="specificationValueTr"> <td> &nbsp; <\/td> <td> <input type="text" name="fieldComment[' + specificationValueIndex + ']" class="text fieldComment" maxlength="200" \/> <\/td> <td> <span class="fieldSet"> <select id="type" name="fieldType[' + specificationValueIndex + ']" style="width:100px"><?php echo smarty_modifier_regex_replace(Smarty::$_smarty_vars['capture']['banner'],"/[\/]/","\/");?>
<\/select> <\/span> <\/td> <td> <input type="text" name="unit[' + specificationValueIndex + ']" class="text unit" maxlength="100" \/> <\/td> <td> <input type="text" name="keyWords[' + specificationValueIndex + ']" class="text keyWords" maxlength="200" \/> <\/td> <td> <a href="javascript:;" class="deleteSpecificationValue">[删除]<\/a> <\/td> <\/tr>';
		var trHtml = '<tr class="specificationValueTr"> <td> &nbsp; <\/td> <td> <input type="text" name="fieldComment[' + specificationValueIndex + ']" class="text fieldComment" maxlength="200" \/> <\/td> <td> <span class="fieldSet"> <select id="type" name="fieldType[' + specificationValueIndex + ']" style="width:100px"><?php echo smarty_modifier_regex_replace(Smarty::$_smarty_vars['capture']['banner'],"/[\/]/","\/");?>
<\/select> <\/span> <\/td> <td> <input type="text" name="unit[' + specificationValueIndex + ']" class="text unit" maxlength="100" \/> <\/td> <td> <a href="javascript:;" class="deleteSpecificationValue">[删除]<\/a> <\/td> <\/tr>';
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
			orders: "required",
			quotaParentID: "required",
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
					<input type="hidden" name="tableName" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableName'];?>
" />
					<input type="text" name="comment" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableComment'];?>
" maxlength="50" style="width:300px" />&nbsp;&nbsp;(如：中国2011年城市排水和污水处理统计)
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>所属分类:
				</th>
				<td colspan="7">
					<select name="parentId" id="classifyID" disabled="disabled">
						<option value="">选择所属分类</option>
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
					<input type="hidden" name="parentId" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['classid'];?>
" />
				</td>
			</tr>
			
			<tr id="quotaholder">
				<th>
					<span class="requiredField">*</span>所属指标分类:
				</th>
				<td colspan="7">
					<?php if (count($_smarty_tpl->tpl_vars['classQuotas']->value)!=0){?>
					<select name="quotaParentID">
						<option value="">---请选择---</option>
						<?php  $_smarty_tpl->tpl_vars['quotaClassItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quotaClassItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['classQuotas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quotaClassItem']->key => $_smarty_tpl->tpl_vars['quotaClassItem']->value){
$_smarty_tpl->tpl_vars['quotaClassItem']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['quotaClassItem']->value['qcid'];?>
" <?php if ($_smarty_tpl->tpl_vars['quotaClassItem']->value['qcid']==$_smarty_tpl->tpl_vars['tableAttrs']->value['qcid']){?>selected="selected"<?php }?>>
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
					<?php }elseif($_smarty_tpl->tpl_vars['tableAttrs']->value['qcid']){?>
					<span>该指标分类已不存在，请重新选择！</span>
					<?php }else{ ?>
					<span>无指标分类，您可以在此 <a href="admin.php?app=quotaType&act=viewAddQuotaType" style="text-decoration:underline; color:red">创建指标分类</a></span>
					<?php }?>
				</td>
			</tr>
			<!-- 
			<tr>
				<th>
					关键字:
				</th>
				<td colspan="7">
					<input type="text" name="tableKeyword[]" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['keywords'][0];?>
" maxlength="50" style="width:150px" />&nbsp;&nbsp;
					<input type="text" name="tableKeyword[]" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['keywords'][1];?>
" maxlength="50" style="width:150px" />&nbsp;&nbsp;
					<input type="text" name="tableKeyword[]" class="text" value="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['keywords'][2];?>
" maxlength="50" style="width:150px" />&nbsp;&nbsp;
				</td>
				</td>
			</tr>
			 -->
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
					列名
				</td>
				<td>
					字段类型
				</td>
				<td>
					计量单位
				</td>
				<!-- 
				<td>
					指标/关键字
				</td>
				-->
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
				<?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']!='field0'){?>
				<tr class="specificationValueTr">
					<td>
						
					</td>
					<td>
						<input type="hidden" name="fieldName[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field'];?>
" />
						<input type="text" name="fieldComment[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text fieldComment" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['comment'];?>
" maxlength="200" <?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']=='field1'){?>disabled="disabled"<?php }?> />
						<?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']=='field1'){?>
						<input type="hidden" name="fieldComment[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text fieldComment" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['comment'];?>
" />
						<?php }?>
					</td>
					<td>
						
						<?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']=='field1'){?>
						<select style="width:100px" disabled="disabled">
							<option>内置</option>
						</select>
						<input type="hidden" name="fieldType[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['type'];?>
" />
						<?php }else{ ?>
						<select name="fieldType[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" style="width:100px">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['basicList']->value['FieldType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" <?php if (strtoupper($_smarty_tpl->tpl_vars['myId']->value)==strtoupper($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['type'])){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
							<?php } ?>
						</select>
						<?php }?>
					</td>
					<td>
						<input type="text" name="unit[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" class="text unit" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['unit'];?>
" maxlength="200" <?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']=='field1'){?>disabled="disabled"<?php }?> />
						<?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']=='field1'){?>
						<input type="hidden" name="unit[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['field']['index'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['unit'];?>
" />
						<?php }?>
					</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field']!='field1'){?>
						<a href="javascript:;" class="deleteSpecificationValue" val="<?php echo $_smarty_tpl->tpl_vars['tableAttrs']->value['tableName'];?>
:<?php echo $_smarty_tpl->tpl_vars['tableFields']->value[$_smarty_tpl->getVariable('smarty')->value['section']['field']['index']]['field'];?>
">[删除]</a>
						<?php }?>
					</td>
				</tr>
				<?php }?>
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