<?php /* Smarty version Smarty-3.1.14, created on 2013-10-14 10:56:29
         compiled from "/var/www/html/material/exten/admin/template/_statistics/pie.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:8310323825245129c2558e5-87779242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f4f8cf65042b8c6f885626431f062a70c793993' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_statistics/pie.tpl.htm',
      1 => 1381718979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8310323825245129c2558e5-87779242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5245129c2979b9_70306738',
  'variables' => 
  array (
    'tablesInfo' => 0,
    'val' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5245129c2979b9_70306738')) {function content_5245129c2979b9_70306738($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>饼状图 - Powered By SQTANG</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="plugin/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.pie.js"></script>
<script type="text/javascript">
$(function() {

	var graph=function(obj){
		var dataurl = obj.attr('value');
		function onDataReceived(series) {
			//set title
			$("#topTitle").text(series.label);
			console.log(series.data);

			$("#salesAmountChart").unbind();
			
			$.plot("#salesAmountChart", series.data, {
				
				series: {
					pie: { 
						show: true,
						radius: 1,
						tilt: 0.5,
						label: {
							show: true,
							radius: 1,
							formatter: labelFormatter,
							background: {
								opacity: 0.8
							}
						},
						combine: {
							color: "#999",
							label: 'Other',
							threshold: 0.01
						}
					}
				},
				legend: {
					show: false
				}

			});
			
		}

		$.ajax({
			url: dataurl,
			type: "GET",
			dataType: "json",
			success: onDataReceived
		});
	};
	
	function labelFormatter(label, series) {
		console.log(series);
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + series.data[0][1] + "</div>";
	}

	//button绑定click事件
	$("button.fetchSeries").on("click",function(){
		graph($(this));
	});
	//触发第一个button click事件
	$("button.fetchSeries:first").click();

	function showTooltip(x, y, contents) {
		$("<div id='tooltip'>" + contents + "</div>").css({
			position: "absolute",
			display: "none",
			top: y + 5,
			left: x + 5,
			border: "1px solid #fdd",
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body").fadeIn(200);
	}

	var previousPoint = null;
	$("#salesAmountChart").bind("plothover", function(event, pos, obj) {
		console.log(obj);
		if (!obj) {
			return;
		}
		
		var percent = parseFloat(obj.series.percent).toFixed(2);
		
		$("#hover").html("<span style='font-weight:bold; color:" + obj.series.color + "'>" + obj.series.label + " (" + percent + "%)</span>");

	});
	
	//原料表切换操作
	$("#type").change(function(){
		//删除现有的button元素
		$("button.fetchSeries").remove();
		
		var url = "?app=statistics&act=getTableData&tableName=" + $(this).val();

		//ajax为异步请求（不管success是否执行成功，直接执行ajax后面的代码）
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			success: function(result){
				//console.log(result);
				var value = "";
				for (stock in result.fieldsInfo) {
					value += "<button class=\"fetchSeries\" value=\"?app=statistics&act=needPieData&tableName=" + result.tableName + "&field=" + result.fieldsInfo[stock].Field + "&comment=" + result.fieldsInfo[stock].Comment + "&xaxis=" + result.fieldsInfo[stock].xaxis + "\">" + result.fieldsInfo[stock].Comment + "</button>";
				}
				//console.log(value);
				$("#fieldHolder").append(value);
	
				//button重新绑定事件
				$("button.fetchSeries").on("click",function(){
					graph($(this));
				});
				//触发第一个button click事件
				$("button.fetchSeries:first").click();
			}
		});
	});
	$("#type").change();
	
});
</script>
<style type="text/css">
#topTitle {
	height: 40px; 
	line-height:40px; 
	width:1100px; 
	margin:0 auto; 
	text-align:center; 
	font-size:14px; 
	font-weight:bold; 
	color:black;
}
</style>
</head>
<body>
	<div class="path">
		图形展示 &raquo; 饼状图
	</div>
		<table class="input">
			<tr>
				<td colspan="2">
					<div id="topTitle"></div>
					<div id="salesAmountChart" style="height: 420px; width:1100px; margin:0 auto"></div>
					<div style="height:30px; width:100%"></div>
				</td>
			</tr>
			<tr>
				<th>
					原料表:
				</th>
				<td>
					<select id="type" name="tableName">
						<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['tablesInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['t_name'];?>
"<?php if ($_smarty_tpl->tpl_vars['key']->value==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['tname'];?>
</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					数据:
				</th>
				<td id="fieldHolder">
					
				</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='?app=default&act=welcome'" />
				</td>
			</tr>
		</table>
</body>
</html><?php }} ?>