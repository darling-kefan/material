<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 11:51:23
         compiled from "/var/www/material/exten/admin/template/_materialTable/addTable.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:7807979075228314c91eb16-34876761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e782e4bd147e0725a97d33f60d580d6bce8eeab' => 
    array (
      0 => '/var/www/material/exten/admin/template/_materialTable/addTable.tpl.htm',
      1 => 1378439793,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7807979075228314c91eb16-34876761',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5228314c964494_26906989',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'classList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5228314c964494_26906989')) {function content_5228314c964494_26906989($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $specificationTable = $("#specificationTable");
	var $type = $("#type");
	var $addSpecificationValueButton = $("#addSpecificationValueButton");
	var $deleteSpecificationValue = $("a.deleteSpecificationValue");
	var specificationValueIndex = 1;
	
	$("input.browserButton").browser();
	
	// 增加表字段
	$addSpecificationValueButton.click(function() {
		var trHtml = '<tr class="specificationValueTr"> <td> &nbsp; <\/td> <td> <input type="text" name="fieldName[' + specificationValueIndex + ']" class="text fieldName" maxlength="200" \/> <\/td> <td> <span class="fieldSet"> <select id="type" name="fieldType[' + specificationValueIndex + ']"><option value="INT" selected="selected">INT<\/option><option value="VARCHAR">VARCHAR<\/option><option value="TEXT">TEXT<\/option><option value="DATE">DATE<\/option><option value="DATETIME">DATETIME<\/option><option value="BOOL">BOOL<\/option><\/select> <\/span> <\/td> <td> <label> <input type="checkbox" checked="checked" name="isNull[' + specificationValueIndex + ']" value="1" \/> <\/label> </td> <td> <input type="text" name="defaultValue[' + specificationValueIndex + ']" class="text defaultValue" maxlength="9" style="width: 50px;" \/> <\/td> <td> <input type="text" name="fieldComment[' + specificationValueIndex + ']" class="text fieldComment" maxlength="9" \/> <\/td> <td> <a href="javascript:;" class="deleteSpecificationValue">[删除]<\/a> <\/td> <\/tr>';
		$specificationTable.append(trHtml).find("input.browserButton:last").browser();
		specificationValueIndex ++;
	});

	// 删除表字段
	$deleteSpecificationValue.live("click", function() {
		var $this = $(this);
		$this.closest("tr").remove();
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
	<form id="inputForm" action="admin.php?app=materialTable&act=createTable" method="post">
		<table id="specificationTable" class="input">
			<tr class="titleTr">
				<th>
					<span class="requiredField">*</span>数据表名:
				</th>
				<td colspan="7">
					<input type="text" name="tableName" class="text" value="" maxlength="200" />
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
					<span class="requiredField">*</span>引擎类型:
				</th>
				<td colspan="7">
					<select id="type" name="storage_engine">
							<option value="InnoDB" selected="selected">InnoDB</option>
							<option value="MyISAM">MyISAM</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>编码类型:
				</th>
				<td colspan="7">
					<select id="type" name="encoding_type">
							<option value="utf8" selected="selected">utf8</option>
							<option value="gbk">gbk</option>
							<option value="gb2312">gb2312</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>表描述:
				</th>
				<td colspan="7">
					<input type="text" name="comment" class="text" value="" maxlength="50" style="width:300px" />&nbsp;&nbsp;(如：中国2011年城市排水和污水处理统计)
				</td>
			</tr>
			<tr>
				<th>
					表排序:
				</th>
				<td colspan="7">
					<input type="text" name="orders" class="text" value="1" maxlength="200" style="width:50px" />
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
				<tr class="specificationValueTr">
					<td>
						
					</td>
					<td>
						<input type="text" name="fieldName[0]" class="text fieldName" value="" maxlength="100" />
					</td>
					<td>
						<select id="type" name="fieldType[0]">
							<option value="INT" selected="selected">INT</option>
							<option value="VARCHAR">VARCHAR</option>
							<option value="TEXT">TEXT</option>
							<option value="DATE">DATE</option>
							<option value="DATETIME">DATETIME</option>
							<option value="BOOL">BOOL</option>
						</select>
					</td>
					<td>
						<label>
							<input type="checkbox" checked="checked" name="isNull[0]" value="1" />
						</label>
					</td>
					<td>
						<input type="text" name="defaultValue[0]" class="text defaultValue" value="" maxlength="100" style="width:50px" />
					</td>
					<td>
						<input type="text" name="fieldComment[0]" class="text fieldComment" value="" maxlength="200" />
					</td>
					<td>
							<a href="javascript:;" class="deleteSpecificationValue">[删除]</a>
					</td>
				</tr>
				
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