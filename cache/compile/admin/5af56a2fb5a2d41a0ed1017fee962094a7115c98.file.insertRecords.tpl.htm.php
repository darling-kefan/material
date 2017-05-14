<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 09:12:34
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_materialTable\insertRecords.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:2956652357a026672b6-70590399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5af56a2fb5a2d41a0ed1017fee962094a7115c98' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_materialTable\\insertRecords.tpl.htm',
      1 => 1378893556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2956652357a026672b6-70590399',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fieldList' => 0,
    '_Title' => 0,
    '_Rank' => 0,
    'tableID' => 0,
    'cols' => 0,
    'titleList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52357a0287c2f2_70739586',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52357a0287c2f2_70739586')) {function content_52357a0287c2f2_70739586($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'D:\\VertrigoServ\\www\\material\\_inc\\_libs\\Smarty\\libs\\plugins\\modifier.regex_replace.php';
?><?php $_smarty_tpl->_capture_stack[0][] = array('banner', null, null); ob_start(); ?><tr class="specificationValueTr"> <td> &nbsp; </td> <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['name'] = 'fieldInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fieldList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total']);
?><td><?php if ((mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='date')||(mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='datetime')){?> <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text Wdate<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100" onfocus="WdatePicker();"  /> <?php }elseif(mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='int'){?><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100" style="width:100px;"  /> <?php }else{ ?><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100"  /> <?php }?></td> <?php endfor; endif; ?><td> <a href="javascript:;" class="deleteSpecificationValue">[删除]</a> </td> </tr><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
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
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<script type="text/javascript" src="exten/admin/template/js/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $specificationTable = $("#specificationTable");
	var $type = $("#type");
	var $addSpecificationValueButton = $("#addSpecificationValueButton");
	var $deleteSpecificationValue = $("a.deleteSpecificationValue");
	var specificationValueIndex = 1;
	
	// 修改记录
	$type.change(function() {
		if ($(this).val() == "text") {
			$("input.specificationValuesImage").val("").prop("disabled", true);
			$("input.browserButton").prop("disabled", true);
		} else {
			$("input.specificationValuesImage").prop("disabled", false);
			$("input.browserButton").prop("disabled", false);
		}
	});
	
	$("input.browserButton").browser();
	
	// 增加记录
	$addSpecificationValueButton.click(function() {
		var trHtml = '<?php echo smarty_modifier_regex_replace(Smarty::$_smarty_vars['capture']['banner'],"/[\/]/","\/");?>
';
		$specificationTable.append(trHtml).find("input.browserButton:last").browser();
		specificationValueIndex ++;
	});
	
	// 删除记录
	$deleteSpecificationValue.live("click", function() {
		var $this = $(this);
		if ($specificationTable.find("tr.specificationValueTr").size() <= 1) {
			$.message("warn", "必须至少保留一条记录");
		} else {
			$this.closest("tr").remove();
		}
	});
	
	$.validator.addClassRules({
		specificationValues: {
			required: true
		},
		specificationValuesImage: {
			required: true
		},
		specificationValuesOrder: {
			digits: true
		}
	});
	
	// 表单验证
	$inputForm.validate({
		rules: {
			name: "required",
			order: "digits"
		}
	});


	//提交表单
	var $submit1 = $("#submit1");
	var $submit2 = $("#submit2");

	$submit1.click(function(){
		$("#storageType").val("1");
		$inputForm.submit();
	});
	$submit2.click(function(){
		$("#storageType").val("2");
		$inputForm.submit();
	});
});
</script>
</head>
<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="inputForm" action="admin.php?app=materialTable&act=insertRecords" method="post">
		<input type="hidden" name="tableID" value="<?php echo $_smarty_tpl->tpl_vars['tableID']->value;?>
" />
		<input type="hidden" name="storageType" id="storageType" value="" />
		<table id="specificationTable" class="input">
			<tr>
				<td>
					&nbsp;
				</td>
				<td colspan="<?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
">
					<a href="javascript:;" id="addSpecificationValueButton" class="button">增加记录</a>
				</td>
			</tr>
			<tr class="title">
				<td>
					&nbsp;
				</td>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['name'] = 'titleInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['titleList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['titleInfo']['total']);
?>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['titleList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['titleInfo']['index']];?>

				</td>
				<?php endfor; endif; ?>
				<td>
					操作
				</td>
			</tr>
			<tr class="specificationValueTr">
				<td>
					&nbsp;
				</td>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['name'] = 'fieldInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fieldList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['total']);
?>
				<td>
					<?php if ((mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='date')||(mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='datetime')){?>
					<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text Wdate<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100" onfocus="WdatePicker();"  />
					<?php }elseif(mb_strtolower($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Type'], 'UTF-8')=='int'){?>
					<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100" style="width:100px;"  />
					<?php }else{ ?>
					<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
[]" class="text<?php if ($_smarty_tpl->tpl_vars['fieldList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Null']=='NO'){?> specificationValues<?php }?>" value="" maxlength="100"  />
					<?php }?>
				</td>
				<?php endfor; endif; ?>
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
				<td colspan="4">
					<input type="button" id="submit1" class="button" value="提&nbsp;&nbsp;交" />
					<input type="button" id="submit2" class="button" value="暂&nbsp;&nbsp;存" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=getTablesList'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>