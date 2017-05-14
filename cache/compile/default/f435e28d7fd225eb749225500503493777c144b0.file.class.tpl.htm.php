<?php /* Smarty version Smarty-3.1.14, created on 2013-12-09 17:55:33
         compiled from "/var/www/html/material/exten/default/template/class.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:122655040752849b5648dbe7-31750308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f435e28d7fd225eb749225500503493777c144b0' => 
    array (
      0 => '/var/www/html/material/exten/default/template/class.tpl.htm',
      1 => 1386583129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122655040752849b5648dbe7-31750308',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52849b564dabc5_27511232',
  'variables' => 
  array (
    '_Title' => 0,
    'yaxises' => 0,
    'leftMenu' => 0,
    'varModule' => 0,
    'classid' => 0,
    'quotaid' => 0,
    'tid' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52849b564dabc5_27511232')) {function content_52849b564dabc5_27511232($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/default/template/css/base.css" rel="stylesheet" type="text/css" /> 
<link href="exten/default/template/css/class.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="exten/default/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/default/template/js/common.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.pie.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.categories.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="plugin/flot/excanvas.min.js"></script><![endif]-->
<style type="text/css">
.shapeSelect th {
	width: 156px;
	line-height: 25px;
	padding: 15px 0px 10px 0px;
	text-align: center;
	font-weight: normal;
	color: #333333;
	background-color: #f8fbff;
}

#showShape {
    background: linear-gradient(#F6F6F6 0px, #FFFFFF 50px) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #DDDDDD;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    height: 450px;
    margin: 15px auto 30px;
    padding: 20px 15px 15px;
    width: 1200px;
}

#topTitle {
	height: 30px; 
	line-height:30px; 
	width:1100px; 
	margin:0 auto; 
	text-align:center; 
	font-size:14px; 
	font-weight:bold; 
	color:black;
	float:left
}
#labelholder{
	width:1110px;
	margin-left:40px;
	border:2px solid #f1f1f1;
	padding:3px;
	float:left
}
#labelholder li{
	list-style:none;
	width:157px;
	height:30px;
	float:left;
	overflow:hidden
}
#flotholder{
	height:300px; 
	width:1170px; 
	margin:0 auto; 
	float:left
}
.promotion {
	color: #cccccc;
}

/*Table选择样式(折线图)*/
.curveTable{
	width:470px;
	background-color: #FFFFFF;
	z-index:103;
	height:200px;
	overflow: auto
}
.curveTable table{
	margin:10px;
	width:450px;
}
.curveTable table th{
	background-color: #F5F5F5;
	color: #333333;
	height: 30px;
	line-height: 30px;
	padding: 0 10px;
	text-align: left;
	white-space: nowrap;
}
.curveTable table td{
	color: #333333;
	height: 25px;
	line-height: 25px;
	padding: 0 10px;
	text-align: left;
	white-space: nowrap;
	border-top: 1px solid #E9E9E9;
}
.flotArea{
	width:704px;
	height:350px;
	box-sizing: border-box;
	padding: 10px 0 15px 0;
	margin: 10px auto 15px auto;
	border: 1px solid #ddd;
	background: -webkit-linear-gradient(#f6f6f6 0, #fff 50px);
	box-shadow: 0 3px 10px rgba(0,0,0,0.15);
	-webkit-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
#flotholder {
	width:704px;
	height:280px;
	margin-bottom:10px;
}
#buttonholder{
	width:580px;
	height:40px;
	overflow:auto;
	border: 2px solid #F1F1F1;
	padding: 10px 10px;
	margin: 0 auto;
}
#buttonholder ul{
	width:580px;
	height: auto;
}
#buttonholder li{
	height:25px;
	padding-right:10px;
	float:left;
}
</style>
<script type="text/javascript">
$().ready(function() {
	//初始化隐藏图表展示区
	$("#flotArea").hide();
	//$("#flotholder").hide();
	//$("#buttonholder").hide();
	
	//左侧栏操作
	var $dds = $("dd.haveSons");
	$dds.click(function(){
		var classnames = $(this).attr("class");
		var titleAttr = $(this).attr("id");
		var contentAttr = $(this).attr("id").replace("title", "content");
		var classnameArr = classnames.split(" ");
		
		if ($.inArray('open', classnameArr) >= 0) {
			$("#" + titleAttr).removeClass("open");
			$("#" + contentAttr).hide();
		} else {
			$("#" + titleAttr).addClass("open");
			$("#" + contentAttr).show();
		}
	});

	//分类弹出层
	$("div.g-main-nav ul li").mouseover( function() {
		var $popupMenu = $(this).children("dl");
		$popupMenu.show();
		$(this).css("background-color", "#F9F9F9");
		$(this).mouseleave(function() {
			$popupMenu.hide();
		});
	});
	
	//图标管理弹出层
	$("#graphicsBtn").mouseover( function() {
		var $this = $(this);
		var $popupMenu = $this.children("dl.graphicsBtn-layer");
		$popupMenu.show();
		$this.mouseleave(function() {
			$popupMenu.hide();
		});
	});

	//指标字段切换
	$("#field").change(function(){
		//alert($(this).val());
		window.location.href = $(this).val();
	});
	
	var $plot = $("#plot");//作图按钮
	var $cancelPlot = $("#cancelPlot");//取消作图按钮
	//取消作图
	$cancelPlot.click(function(){
		$("#flotArea").hide();
	});
	
	// 图形展示
	$plot.click(function() {
		$.dialog({
			title: "图表设置",
			content: ' <table id="shapeSelect" class="shapeSelect"> <tr> <th> <img src="exten/default/template/img/icon_point.jpg" \/><br \/><input type="radio" name="shape" value="1" \/>曲线图 <\/th> <th> <img src="exten/default/template/img/icon_bar.jpg" \/><br \/><input type="radio" name="shape" value="2" \/>柱状图 <\/th> <th> <img src="exten/default/template/img/icon_pie.jpg" \/><br \/><input type="radio" name="shape" value="3" \/>饼状图  </th> <\/tr> <\/table>',
			width: 470,
			modal: true,
			ok: "确&nbsp;&nbsp;定",
			cancel: "取&nbsp;&nbsp;消",
			
			onOk: function() {
				var shapeVal = $("input:radio[name='shape']:checked").val();
				//console.log(shapeVal);
				_selectRow(shapeVal);
			}
		});
	});

	var _selectRow = function(shapeVal){
		if (shapeVal) {
			var yaxises = <?php echo $_smarty_tpl->tpl_vars['yaxises']->value;?>
;
			//console.log(yaxises);
			var classid = $("#classid").val();
			
			//var content = '<table class="curveTable"><tr><td class="curveContent"><table><tbody><tr><th>指标</th><th>是否显示</th></tr>';
			var content = '<div class="curveTable"><table><tbody><tr><th>指标</th><th>是否显示</th></tr>';
			$.each(yaxises, function(i,yaxis){
				if (yaxis.name) {
					content += '<tr><td>'+ yaxis.comment +'</td><td><input type="checkbox" name="selectedItem[]" value="'+ yaxis.name +'"></input></td></tr>';
				} else {
					content += '<tr><td>'+ yaxis +'</td><td><input type="checkbox" name="selectedItem[]" value="'+ yaxis +'"></input></td></tr>';
				}
			});
			//content += '</tbody></table></table></td></tr></table>';
			content += '</tbody></table></table></div>';
			
			$.dialog({
				title: "图表设置",
				content: content,
				width: 470,
				modal: true,
				ok: "确&nbsp;&nbsp;定",
				cancel: "取&nbsp;&nbsp;消",
				
				onOk: function() {
					var selectedItem = $("input:checkbox[name='selectedItem[]']:checked").serialize();
					var classid   = $("#classid").val();
					var quotaid   = $("#quotaid").val();
					var tid       = $("#tid").val();
					var field     = $("#field").val();
					
					//异步获取图表数据
					var dataurl = "index.php?app=classification&act=asyncPlotData&classid="+classid+"&quotaid="+quotaid+"&tid="+tid+"&field="+field+"&shapeVal="+shapeVal;
					$.ajax({
						url: dataurl,
						type: "POST",
						data: selectedItem,
						dataType: "json",
						success: handlerReceivedData
					});
				}
			});

			var handlerReceivedData = function(acceptData) {
				//console.log(acceptData);
				if (acceptData.data) {
					$("#flotArea").show();

					if (acceptData.plotType == 1) {
						$("#flotholder").show();
						$("#buttonholder").show();
						
						var buttonHolderMsg = '<ul>';
						$.each(acceptData.data, function(i,onePlotData){
							buttonHolderMsg += '<li><input type="checkbox" name="selectPlotBtn" checked="checked" value="'+ i +'">'+ onePlotData.label +'</input></li>';
						});
						buttonHolderMsg += '</ul>';
						$("#buttonholder").html(buttonHolderMsg);

						var options = {
							lines: {
								show: true,
							},
							points: {
								show: true
							},
							xaxis: {
								ticks: acceptData.xaxis.ticks,
								min: acceptData.xaxis.min,
								max: acceptData.xaxis.max,
								labelHeight:30,
							},
							grid: {
								hoverable: true,
								autoHighlight: true
							},
							legend: {
								show: true,
								noColumns: 5
							},
						};
						$.plot("#flotholder", acceptData.data, options);

						//radio重新绑定事件
						$("input:checkbox[name='selectPlotBtn']").on("click",function(){
							var selectPlotBtnVal = $("input:checkbox[name='selectPlotBtn']:checked").serialize().replace(/selectPlotBtn=/g,'').split('&');

							var newShowData = [];
							$.each(selectPlotBtnVal,function(k,v){
								newShowData.push(acceptData.data[v]);
							});

							$.plot("#flotholder", newShowData, options);
						});
						
					} else if (acceptData.plotType == 2) {
						$("#flotholder").show();
						$("#buttonholder").show();
						
						var buttonHolderMsg = '<ul>';
						$.each(acceptData.namesList, function(i,onePlotData){
							if (i == 0) {
								buttonHolderMsg += '<li><input type="radio" name="selectPlotBtn" checked="checked" value="'+ i +'">'+ onePlotData +'</input></li>';
							} else {
								buttonHolderMsg += '<li><input type="radio" name="selectPlotBtn" value="'+ i +'">'+ onePlotData +'</input></li>';
							}
						});
						buttonHolderMsg += '</ul>';
						$("#buttonholder").html(buttonHolderMsg);

						var options = {
							colors: ["#d18b2c", "#dba255", "#919733"],
							series: {
								bars: {
									show: true,
									barWidth: 0.6,
									align: "center",
									fill: true,
									fillColor: "#dba255",
								},
							},
							xaxis: {
								mode: "categories",
								tickLength: 0
							},
							grid: {
								labelMargin:10,
								borderWidth:1,
								tickLabel:3,
								hoverable: true
							},
						};
						$.plot("#flotholder", [acceptData.data[0]], options);

						//radio重新绑定事件
						$("input:radio[name='selectPlotBtn']").on("click",function(){
							var selectPlotBtnVal = $("input:radio[name='selectPlotBtn']:checked").val();
							$.plot("#flotholder", [acceptData.data[selectPlotBtnVal]], options);
						});
					} else if (acceptData.plotType == 3) {
						$("#flotholder").show();
						$("#buttonholder").show();
						
						var buttonHolderMsg = '<ul>';
						$.each(acceptData.namesList, function(i,onePlotData){
							if (i == 0) {
								buttonHolderMsg += '<li><input type="radio" name="selectPlotBtn" checked="checked" value="'+ i +'">'+ onePlotData +'</input></li>';
							} else {
								buttonHolderMsg += '<li><input type="radio" name="selectPlotBtn" value="'+ i +'">'+ onePlotData +'</input></li>';
							}
						});
						buttonHolderMsg += '</ul>';
						$("#buttonholder").html(buttonHolderMsg);

						var options = {
							series: {
								pie: { 
									show: true,
									radius: 1,
									label: {
										show: true,
										radius: 1,
										formatter: labelFormatter,
										background: {
											opacity: 0.8
										}
									}
								}
							},
							legend: {
								show: false
							}
						};
						$.plot("#flotholder", acceptData.data[0], options);

						//radio重新绑定事件
						$("input:radio[name='selectPlotBtn']").on("click",function(){
							var selectPlotBtnVal = $("input:radio[name='selectPlotBtn']:checked").val();
							$.plot("#flotholder", acceptData.data[selectPlotBtnVal], options);
						});
					}
				}
			}
		}
	};

	function showTooltip(x, y, contents) {
		$("<div id='tooltip'>" + contents + "</div>").css({
			position: "absolute",
			display: "none",
			top: y + 5,
			left: x + 5,
			border: "2px solid #4572A7",
			padding: "3px",
			"line-height": "18px",
			"background-color": "#fff",
			"padding":"0 5px",
			opacity: 0.80
		}).appendTo("body").fadeIn(200);
	}

	//绑定hover事件
	var previousPoint = null;
	$("#flotholder").bind("plothover", function (event, pos, item) {
		$("#tooltip").remove();
		if (item != undefined) {
			if (previousPoint != item.dataIndex) {
				var previousPoint = item.dataIndex;
				var x = item.datapoint[0],y = item.datapoint[1];
				
				var tipsItem = null;
				if (item.series.xaxis.ticks[previousPoint].label) {
					tipsItem = item.series.xaxis.ticks[previousPoint].label;
				} 
				var label = item.series.label;
				if (label) {
					showTooltip(item.pageX, item.pageY, "<font style='font-size:12px; font-weight:bold;'>" + label + "</font><br /><font style='font-size:12px'>" + tipsItem + "</font> <font style='font-weight:bold; font-size:12px'>数值：</font><font style='font-weight:bold; font-size:14px'>" + y + "</font>");
				} else {
					showTooltip(item.pageX, item.pageY, "<font style='font-size:12px'>" + tipsItem + "</font> <font style='font-weight:bold; font-size:12px'>数值：</font><font style='font-weight:bold; font-size:14px'>" + y + "</font>");
				}
			}
		} else {
			$("#tooltip").remove();
			previousPoint = null;            
		}
	});

	//饼状图事件
	function labelFormatter(label, series) {
		console.log(label);
		console.log(series);
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
});
</script>

</head>

<body>

<?php echo $_smarty_tpl->getSubTemplate ('_main/header.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="main-wraper">
	<div class="main">
		<div class="left-menu">
			<div class="left-menu-top">
				<span>指&nbsp;标</span>
			</div>
			<div class="left-menu-content">
			<?php echo $_smarty_tpl->tpl_vars['leftMenu']->value;?>

			</div>
		</div>
		<div class="body-right">
			<div class="relevance">
				<ul>
					<li class="selectAutoCondition">
						<?php echo $_smarty_tpl->tpl_vars['varModule']->value['selectHtml']['firstCondition'];?>

						<!-- 地区：
						<select name="area">
							<option>全国</option>
						</select>
						 -->
					</li>
					<li class="selectTime">
						<!-- <?php echo $_smarty_tpl->tpl_vars['varModule']->value['selectHtml']['secondCondition'];?>
 -->
						&nbsp;
					</li>
					<li class="refresh">
						&nbsp;
						<input name="classid" id="classid" value="<?php echo $_smarty_tpl->tpl_vars['classid']->value;?>
" type="hidden">
						<input name="quotaid" id="quotaid" value="<?php echo $_smarty_tpl->tpl_vars['quotaid']->value;?>
" type="hidden">
						<input name="tid" id="tid" value="<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
" type="hidden">
						<input name="field" id="field" value="<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
" type="hidden">
						<input name="yaxises" id="yaxises" value="<?php echo $_smarty_tpl->tpl_vars['yaxises']->value;?>
" type="hidden">
						<!-- 
						<button value="">刷新</button>
						 -->
					</li>
					<li id="graphicsBtn" class="graphicsBtn">
						图表管理
						<dl class="graphicsBtn-layer" style="display:none">
							<dd class="openGraphics" id="plot">作图</dd>
							<dd class="closeGraphics" id="cancelPlot">取消作图</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="mainContainer">
				<div id="flotArea" class="flotArea">
					<div id="flotholder" class="flotholder"></div>
					<div id="buttonholder" class="buttonholder"></div>
				</div>
				<div class="tableContainer">
					<?php echo $_smarty_tpl->tpl_vars['varModule']->value['tableHtml'];?>

					<!-- 
					<table>
						<tbody>
						<tr>
						<th>类型</th>
						<th>基础版</th>
						<th>标准版</th>
						<th>高级版</th>
						</tr>
						<tr>
						<td>商业授权(永久)</td>
						<td class="red">√</td>
						<td class="red">√</td>
						<td class="red">√</td>
						</tr>
						</tbody>
					</table>
					 -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('_main/footer.tpl.htm', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


</body>
</html><?php }} ?>