<?php /* Smarty version Smarty-3.1.14, created on 2013-10-14 11:04:47
         compiled from "/var/www/html/material/exten/admin/template/_statistics/curve.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:14327333405245129e57bca9-41760562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f22910ff1b6cf33fd58d0d2660103336341175a' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_statistics/curve.tpl.htm',
      1 => 1381718972,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14327333405245129e57bca9-41760562',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5245129e5aab39_91714834',
  'variables' => 
  array (
    'tablesInfo' => 0,
    'val' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5245129e5aab39_91714834')) {function content_5245129e5aab39_91714834($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>曲线图 - Powered By SQTANG</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="plugin/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.js"></script>
<script type="text/javascript">
$(function() {

	var options = {
		lines: {
			show: true
		},
		points: {
			show: true
		},
		xaxis: {
			tickDecimals: 0,
			tickSize: 1,
			//ticks:[[0, "zero"], [1, "one mark"], [2, "two marks"]]
			//transform: function (v) { return Math.log(v); },
		},
		grid: {
			hoverable: true
		},
	};
	var data = [];
	
	$.plot("#salesAmountChart", data, options);

	// Fetch one series, adding to what we already have
	var graph=function(obj){
		var dataurl = obj.attr('value');

		function onDataReceived(series) {
			console.log(series);
			data.push(series);
			//set title
			$("#topTitle").text(series.label);
			//set curve

			var options = {
				lines: {
					show: true
				},
				points: {
					show: true
				},
				xaxis: {
					//tickDecimals: 0,
					//tickSize: 1,
					ticks:series.ticks
					//transform: function (v) { return Math.log(v); },
				},
				grid: {
					hoverable: true
				},
			};
			
			$.plot("#salesAmountChart", data, options);
			data = [];
		}

		$.ajax({
			url: dataurl,
			type: "GET",
			dataType: "json",
			success: onDataReceived
		});
	};
	
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
	$("#salesAmountChart").bind("plothover", function (event, pos, item) {
		if (item) {
			if (previousPoint != item.dataIndex) {

				previousPoint = item.dataIndex;

				$("#tooltip").remove();
				console.log(item);
				//var x = item.datapoint[0].toFixed(2), y = item.datapoint[1].toFixed(2);
				var x = item.datapoint[0], y = item.datapoint[1].toFixed(2);
				
				//showTooltip(item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
				//showTooltip(item.pageX, item.pageY, x + " : " + y);
				showTooltip(item.pageX, item.pageY, y);
			}
		} else {
			$("#tooltip").remove();
			previousPoint = null;            
		}

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
					value += "<button class=\"fetchSeries\" value=\"?app=statistics&act=needData&tableName=" + result.tableName + "&field=" + result.fieldsInfo[stock].Field + "&comment=" + result.fieldsInfo[stock].Comment + "&xaxis=" + result.fieldsInfo[stock].xaxis + "\">" + result.fieldsInfo[stock].Comment + "</button>";
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
	height: 30px; 
	line-height:30px; 
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
		图形展示 &raquo; 曲线图
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