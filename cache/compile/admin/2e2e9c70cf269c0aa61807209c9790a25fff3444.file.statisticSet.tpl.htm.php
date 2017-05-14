<?php /* Smarty version Smarty-3.1.14, created on 2013-10-31 17:53:41
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/statisticSet.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:12631520105271f19c45b959-91621245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e2e9c70cf269c0aa61807209c9790a25fff3444' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/statisticSet.tpl.htm',
      1 => 1383213206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12631520105271f19c45b959-91621245',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5271f19c498454_56400741',
  'variables' => 
  array (
    'tablesInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5271f19c498454_56400741')) {function content_5271f19c498454_56400741($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>图形展示设置 - Powered By Rabbit</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<script type="text/javascript">
$(function() {
	var $inputForm = $("#inputForm");
	
	var dbc = function(){
		var tableName = $('input[name="tableName"]').val();
		//移除DOM元素
		$('input:radio[name="openStatistic"]').removeAttr("checked")
		$("#fieldHolder").empty();

		var url="?app=materialTable&act=asyncSetChange&tableName=" + tableName;
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
	};

	dbc();
	
	//开启统计按钮操作
	$('input:radio[name="openStatistic"]').click(function(){
		var val=$('input:radio[name="openStatistic"]:checked').val();
		
		var checkedOpen = $(this).val();
		var tableName = $('input[name="tableName"]').val();
		var radioLength = $('input:radio[name="fieldName"]').length;

		if (val == 1) {
			if (radioLength==0) {
				var value = "";
				var url = "?app=materialTable&act=asyncSetChecked&tableName=" + tableName;
	
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
						$('input:radio[name="openStatistic"]').on("click",function(){
							var val_new=$('input:radio[name="openStatistic"]:checked').val();
							if (val_new != 1) {
								$("[name='fieldName']").attr("checked", false);
								$("[name='fieldName']").attr("disabled", true);
							}
						});
					}
				});
			} else {
				$("[name='fieldName']").removeAttr("disabled");
			}
		} else {
			$("[name='fieldName']").attr("disabled", true);
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		图形展示设置 &raquo; <?php echo $_smarty_tpl->tpl_vars['tablesInfo']->value['tname'];?>

	</div>
		<form id="inputForm" action="?app=materialTable&act=statisticSetSave" method="post" enctype="multipart/form-data">
		<input type="hidden" name="tid" value="<?php echo $_smarty_tpl->tpl_vars['tablesInfo']->value['tid'];?>
" />
		<input type="hidden" name="tableName" value="<?php echo $_smarty_tpl->tpl_vars['tablesInfo']->value['t_name'];?>
" />
		<table class="input">
			<tr>
				<th>
					<span class="requiredField">*</span>开启统计:
				</th>
				<td id="openHolder">
					<input type="radio" id="openStatistic" name="openStatistic" value="1">开启
					<input type="radio" id="closeStatistic" name="openStatistic" value="0">关闭
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