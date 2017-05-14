<?php /* Smarty version Smarty-3.1.14, created on 2013-10-14 09:52:03
         compiled from "/var/www/html/material/exten/admin/template/_statistics/statisticSet.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:4180142465258f36d08c7d7-78096800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8abf36c0499c75c94d1aa7a14093350d8c99322' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_statistics/statisticSet.tpl.htm',
      1 => 1381715484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4180142465258f36d08c7d7-78096800',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5258f36d0e1971_09886904',
  'variables' => 
  array (
    'tablesInfo' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5258f36d0e1971_09886904')) {function content_5258f36d0e1971_09886904($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>统计设置 - Powered By SQTANG</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<script type="text/javascript">
$(function() {
	var $inputForm = $("#inputForm");

	//原料表切换操作
	$("#type").change(function(){
		//移除DOM元素
		//$("#openHolder").empty();
		$("#openStatistic").removeAttr("checked")
		$("#fieldHolder").empty();

		var url="?app=statistics&act=asyncSetChange&tableName=" + $(this).val();
		var value = "";
		
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			success: function(result){
				//console.log(result);
				if (result.statisticStatus == 1) {
					//$("#openHolder").append("<input type=\"checkbox\" id=\"openStatistic\" name=\"openStatistic\" value=\"1\">开启");
					$("#openStatistic").attr("checked", true);
					
					for (stock in result.fieldsInfo) {
						if (result.fieldsInfo[stock].Field == result.xAxis) 
							value += "<input type=\"radio\" name=\"fieldName\" value=\"" + result.fieldsInfo[stock].Field + "\" checked>" + result.fieldsInfo[stock].Comment + "&nbsp;&nbsp;";
						else
							value += "<input type=\"radio\" name=\"fieldName\" value=\"" + result.fieldsInfo[stock].Field + "\">" + result.fieldsInfo[stock].Comment + "&nbsp;&nbsp;";
					}
					$("#fieldHolder").append(value);
				}
			}
		});
	});

	//开启统计按钮操作
	$("#openStatistic").click(function(){
		var checkedOpen = $(this).attr("checked");
		var tableName = $("#type").val();
		
		if (tableName) {
			var value = "";
			var url = "?app=statistics&act=asyncSetChecked&tableName=" + tableName;

			$.ajax({
				url: url,
				type: "GET",
				dataType: "json",
				success: function(result){
					//console.log(result);
					$("#fieldHolder").empty();

					if (result) {
						for (stock in result) {
							value += "<input type=\"radio\" name=\"fieldName\" value=\"" + result[stock].Field + "\">" + result[stock].Comment + "&nbsp;&nbsp;";
						}
						$("#fieldHolder").append(value);
					}

					//绑定事件（由于fieldName单选按钮是新增加的DOM，所以click事件必须提前绑定，请务必注意）
					$(this).on("click",function(){
						if ($(this).attr("checked") == undefined) {
							$("[name='fieldName']").removeAttr("checked");
						}
					});
				}
			});
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		图形展示 &raquo; 统计设置
	</div>
		<form id="inputForm" action="?app=statistics&act=statisticSetSave" method="post" enctype="multipart/form-data">
		<table class="input">
			<tr>
				<th>
					<span class="requiredField">*</span>原料表:
				</th>
				<td>
					<select id="type" name="tableName">
						<option value="" selected="selected">选择表</option>
						<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['tablesInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['t_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['tname'];?>
</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>开启统计:
				</th>
				<td id="openHolder">
					<input type="checkbox" id="openStatistic" name="openStatistic" value="1">开启
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>X轴:
				</th>
				<td id="fieldHolder">
					
				</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='?app=default&act=welcome'" />
				</td>
			</tr>
		</table>
		</form>
</body>
</html><?php }} ?>