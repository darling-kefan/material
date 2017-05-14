<?php /* Smarty version Smarty-3.1.14, created on 2013-12-07 17:25:19
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/addTable.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:13943062315243d166b88d89-22797636%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5de20d306cdf06e59e9bffc874412a040f2f3126' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/addTable.tpl.htm',
      1 => 1386408523,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13943062315243d166b88d89-22797636',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5243d166c9be43_54628887',
  'variables' => 
  array (
    'basicList' => 0,
    'myId' => 0,
    'i' => 0,
    '_Title' => 0,
    '_Rank' => 0,
    'classList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5243d166c9be43_54628887')) {function content_5243d166c9be43_54628887($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/html/material/_inc/_libs/Smarty/libs/plugins/modifier.regex_replace.php';
?><?php $_smarty_tpl->_capture_stack[0][] = array('banner', null, null); ob_start(); ?><?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
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
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $specificationTable = $("#specificationTable");
	var $type = $("#type");
	var $addSpecificationValueButton = $("#addSpecificationValueButton");
	var $deleteSpecificationValue = $("a.deleteSpecificationValue");
	var $selectClassify = $("#classifyID");
	var $quotaholder = $("#quotaholder td").eq(0);
	var specificationValueIndex = 1;
	
	$("input.browserButton").browser();

	//为Select添加事件，当选择其中一项时触发
	$selectClassify.change(function(){
		var classifyID = $(this).val();
		$("#quotaholder").hide();
		//清空附加条件
		$("#additionalCondition").html('');

		var additionalCon = '';
		if (classifyID == 1) {//月度数据
			additionalCon += "<td> </td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text fieldComment\" value=\"年份/月份\" maxlength=\"300\" disabled=\"disabled\" />";
			additionalCon += "<input type=\"hidden\" name=\"fieldComment[0]\" value=\"年份/月份\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<select id=\"type\" style=\"width:100px\" disabled=\"disabled\"><option>内置</option></select>";
			additionalCon += "<input type=\"hidden\" name=\"fieldType[0]\" value=\"VARCHAR\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text unit\" value=\"\" maxlength=\"100\" disabled=\"disabled\" /> ";
			additionalCon += "<input type=\"hidden\" name=\"unit[0]\" value=\"\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<a href=\"javascript:;\" class=\"deleteSpecificationValue\">[删除]</a>";
			additionalCon += "</td> ";
		} else if (classifyID == 2) {//季度数据
			additionalCon += "<td> </td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text fieldComment\" value=\"年份/季度\" maxlength=\"300\" disabled=\"disabled\" />";
			additionalCon += "<input type=\"hidden\" name=\"fieldComment[0]\" value=\"年份/季度\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<select id=\"type\" style=\"width:100px\" disabled=\"disabled\"><option>内置</option></select>";
			additionalCon += "<input type=\"hidden\" name=\"fieldType[0]\" value=\"VARCHAR\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text unit\" value=\"\" maxlength=\"100\" disabled=\"disabled\" /> ";
			additionalCon += "<input type=\"hidden\" name=\"unit[0]\" value=\"\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<a href=\"javascript:;\" class=\"deleteSpecificationValue\">[删除]</a>";
			additionalCon += "</td> ";
		} else if (classifyID == 3) {//年度数据
			additionalCon += "<td> </td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text fieldComment\" value=\"年份\" maxlength=\"300\" disabled=\"disabled\" />";
			additionalCon += "<input type=\"hidden\" name=\"fieldComment[0]\" value=\"年份\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<select id=\"type\" style=\"width:100px\" disabled=\"disabled\"><option>内置</option></select>";
			additionalCon += "<input type=\"hidden\" name=\"fieldType[0]\" value=\"VARCHAR\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text unit\" value=\"\" maxlength=\"100\" disabled=\"disabled\" /> ";
			additionalCon += "<input type=\"hidden\" name=\"unit[0]\" value=\"\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<a href=\"javascript:;\" class=\"deleteSpecificationValue\">[删除]</a>";
			additionalCon += "</td> ";
		} else if (classifyID == 5 || classifyID == 6 || classifyID == 7) {//分省月度数据|分省季度数据|分省年度数据
			additionalCon += "<td> </td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text fieldComment\" value=\"省份\" maxlength=\"300\" disabled=\"disabled\" />";
			additionalCon += "<input type=\"hidden\" name=\"fieldComment[0]\" value=\"省份\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<select id=\"type\" style=\"width:100px\" disabled=\"disabled\"><option>内置</option></select>";
			additionalCon += "<input type=\"hidden\" name=\"fieldType[0]\" value=\"VARCHAR\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text unit\" value=\"\" maxlength=\"100\" disabled=\"disabled\" /> ";
			additionalCon += "<input type=\"hidden\" name=\"unit[0]\" value=\"\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<a href=\"javascript:;\" class=\"deleteSpecificationValue\">[删除]</a>";
			additionalCon += "</td> ";
		} else if (classifyID == 8 || classifyID == 9) {//主要城市月度数据|主要城市年度数据
			additionalCon += "<td> </td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text fieldComment\" value=\"城市\" maxlength=\"300\" disabled=\"disabled\" />";
			additionalCon += "<input type=\"hidden\" name=\"fieldComment[0]\" value=\"城市\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<select id=\"type\" style=\"width:100px\" disabled=\"disabled\"><option>内置</option></select>";
			additionalCon += "<input type=\"hidden\" name=\"fieldType[0]\" value=\"VARCHAR\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<input type=\"text\" class=\"text unit\" value=\"\" maxlength=\"100\" disabled=\"disabled\" /> ";
			additionalCon += "<input type=\"hidden\" name=\"unit[0]\" value=\"\" /> ";
			additionalCon += "</td> <td> ";
			additionalCon += "<a href=\"javascript:;\" class=\"deleteSpecificationValue\">[删除]</a>";
			additionalCon += "</td> ";
		}

		$("#additionalCondition").html(additionalCon);
		
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
					
					//var quota = "<select name=\"quotaParentID\"> <option value=\"\">---请选择---</option>";
					var quota = "<select name=\"quotaParentID\"> ";
					
					$.each(data.data, function(key,val){
						quota = quota + "<option value=\"" + val.qcid + "\">";
						for (i=1; i<=val.level; i++) {
							quota = quota + "&nbsp;&nbsp;";
						}
						quota = quota + val.qcname + "</option>";
					});
					quota = quota + "</select>";
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
		var $this = $(this);
		if ($specificationTable.find("tr.specificationValueTr").size() <= 1) {
			$.message("warn", "必须至少保留一个字段");
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
			comment: "required"
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
					<input type="text" name="comment" class="text" value="" maxlength="200" />&nbsp;&nbsp;(如：中国2011年城市排水和污水处理统计)
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>所属分类:
				</th>
				<td colspan="7">
					<select name="parentId" id="classifyID">
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
" <?php if ($_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid']==4){?>disabled="disabled"<?php }?>>
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
					&nbsp;&nbsp;<span style="color:red">(请谨慎选择所属分类，表创建完后此项将不能更改)</span>
				</td>
			</tr>
			
			<tr id="quotaholder" style="display:none">
				<th>
					<span class="requiredField">*</span>所属指标分类:
				</th>
				<td colspan="7">
					
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
					列名
				</td>
				<td>
					字段类型
				</td>
				<td>
					计量单位
				</td>
				<td>
					删除
				</td>
			</tr>
				
				
				<tr id="additionalCondition" class="specificationValueTr">
					<td>
						
					</td>
					<td>
						<input type="text" name="fieldComment[0]" class="text fieldComment" value="" maxlength="300" />
					</td>
					<td>
						<select id="type" name="fieldType[0]" style="width:100px">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['basicList']->value['FieldType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="text" name="unit[0]" class="text unit" value="" maxlength="100" />
					</td>
					<td>
							<a href="javascript:;" class="deleteSpecificationValue">[删除]</a>
					</td>
				</tr>
				
		</table>
		<table class="input">
			</tr>
				<tr>
					<th colspan="7">
						&nbsp;
					</th>
					<td>
						
					</td>
			</tr>
			</tr>
				<tr>
					<th>
						&nbsp;
					</th>
					<td colspan="7">
						<span class="tips">字段不能为id（id为表内置自增字段）</span>
					</td>
			</tr>
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