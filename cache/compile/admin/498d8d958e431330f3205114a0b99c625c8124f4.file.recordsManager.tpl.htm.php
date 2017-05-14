<?php /* Smarty version Smarty-3.1.14, created on 2013-12-08 22:00:19
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/recordsManager.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:21454281652438b5f71d971-43384556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '498d8d958e431330f3205114a0b99c625c8124f4' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/recordsManager.tpl.htm',
      1 => 1386511386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21454281652438b5f71d971-43384556',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438b5f876567_29906634',
  'variables' => 
  array (
    '_Title' => 0,
    'staticfields' => 0,
    'basicInfo' => 0,
    'isExistAddButton' => 0,
    'isExistDelButton' => 0,
    'fieldsInfo' => 0,
    'recordsList' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438b5f876567_29906634')) {function content_52438b5f876567_29906634($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.pie.js"></script>
<script language="javascript" type="text/javascript" src="plugin/flot/jquery.flot.categories.js"></script>
<style type="text/css">
.shapeSelect th {
	width: 150px;
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
</style>
<script type="text/javascript">
$().ready(function() {

	var $listForm = $("#listForm");
	var $moreButton = $("#moreButton");
	var $filterSelect = $("#filterSelect");
	var $filterOption = $("#filterOption a");
	var tableName = $("#tableName").val();
	var data = [];
	
	var initPage = function(){
		$("#showShape").hide();
	};
	initPage();

	//折线图
	var curve=function(obj){
		//var dataurl = obj.attr('value');
		var dataurl = "?app=materialTable&act=needCurveData&tableName=" + tableName + "&field=" + obj.val();
		
		function onDataReceived(series) {
			console.log(series);
			data.push(series);
			//set title
			$("#topTitle").text(series.label);
			//set curve

			var options = {
				lines: {
					show: true,
					fill: true
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
				legend: {
					show: false,
				},
			};
			
			$.plot("#flotholder", data, options);
			data = [];
		}

		$.ajax({
			url: dataurl,
			type: "GET",
			dataType: "json",
			success: onDataReceived
		});
	};

	//柱状图
	var graph=function(obj){
		//var dataurl = obj.attr('value');
		var dataurl = "?app=materialTable&act=needBargraphData&tableName=" + tableName + "&field=" + obj.val();
		function onDataReceived(series) {
			//data.push(series.data);
			//var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];
			//set title
			$("#topTitle").text(series.label);
			
			$.plot("#flotholder", [ series.data ], {
				series: {
					bars: {
						show: true,
						barWidth: 0.6,
						align: "center",
						fill: true,
						//fillColor: "blue",
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
			});	
		}

		$.ajax({
			url: dataurl,
			type: "GET",
			dataType: "json",
			success: onDataReceived
		});
	};

	//饼状图
	var pie=function(obj){
		//var dataurl = obj.attr('value');
		var dataurl = "?app=materialTable&act=needPieData&tableName=" + tableName + "&field=" + obj.val();
		
		function onDataReceived(series) {
			//set title
			$("#topTitle").text(series.label);
			//console.log(series.data);

			$("#flotholder").unbind();
			
			$.plot("#flotholder", series.data, {
				
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

	function showTooltip(x, y, contents) {
		$("<div id='tooltip'>" + contents + "</div>").css({
			position: "absolute",
			display: "none",
			top: y + 5,
			left: x + 5,
			border: "2px solid #4572A7",
			padding: "3px",
			"line-height": "15px",
			"background-color": "#fff",
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
				console.log(item);
				var tipsItem = null;
				if (item.series.xaxis.ticks[previousPoint].label) {
					tipsItem = item.series.xaxis.ticks[previousPoint].label;
				} 
				
				showTooltip(item.pageX, item.pageY, "<font style='font-size:12px'>" + tipsItem + "</font><br /><font style='font-weight:bold; font-size:12px'>数值：</font><font style='font-weight:bold; font-size:14px'>" + y + "</font>");
			}
		} else {
			$("#tooltip").remove();
			previousPoint = null;            
		}

	});

	// 饼状图显示相关
	function labelFormatter(label, series) {
		//console.log(series);
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + series.data[0][1] + "</div>";
	}
	
	// 图形展示
	$moreButton.click(function() {
		$.dialog({
			title: "图表设置",
			content: ' <table id="shapeSelect" class="shapeSelect"> <tr> <th> <img src="exten/admin/template/images/icon_point.jpg" \/><br \/><input type="radio" name="shape" value="1" \/>曲线图 <\/th> <th> <img src="exten/admin/template/images/icon_bar.jpg" \/><br \/><input type="radio" name="shape" value="2" \/>柱状图 <\/th> <th> <img src="exten/admin/template/images/icon_pie.jpg" \/><br \/><input type="radio" name="shape" value="3" \/>饼状图  </th> <\/tr> <\/table>',
			width: 470,
			modal: true,
			ok: "确&nbsp;&nbsp;定",
			cancel: "取&nbsp;&nbsp;消",

			
			onOk: function() {
				var shapeVal = $("input:radio[name='shape']:checked").val();
				if (shapeVal != undefined) {
					if (shapeVal == 1) {
						$("#showShape").show();
						
						//smarty是字符串，我们需要将其转换为可以利用JS操作的变量
						var staticfields = eval('<?php echo $_smarty_tpl->tpl_vars['staticfields']->value;?>
');
						var choiceContainer = $("#labelholder");
						//清空DOM
						choiceContainer.html('');
						
						var field = "";
						choiceContainer.append("<ul>");
						$.each(staticfields, function(key, val) {
							choiceContainer.append("<li><input type='radio' name='changeCurveData' value='" + val.field + "' \/>" + val.comment + "<\/li>");
						});
						choiceContainer.append("<\/ul>");
						
						//radio重新绑定事件
						$("input:radio[name='changeCurveData']").on("click",function(){
							curve($(this));
						});
						//触发第一个radio click事件
						$("input[name='changeCurveData']:first").click();
						
					} else if(shapeVal == 2) {
						$("#showShape").show();
						
						//smarty是字符串，我们需要将其转换为可以利用JS操作的变量
						var staticfields = eval('<?php echo $_smarty_tpl->tpl_vars['staticfields']->value;?>
');
						var choiceContainer = $("#labelholder");
						//清空DOM
						choiceContainer.html('');
						
						var field = "";
						choiceContainer.append("<ul>");
						$.each(staticfields, function(key, val) {
							choiceContainer.append("<li><input type='radio' name='changeGraphData' value='" + val.field + "' \/>" + val.comment + "<\/li>");
						});
						choiceContainer.append("<\/ul>");
						
						//radio重新绑定事件
						$("input:radio[name='changeGraphData']").on("click",function(){
							graph($(this));
						});
						//触发第一个radio click事件
						$("input[name='changeGraphData']:first").click();
						//graph($(this));
					} else if(shapeVal == 3) {
						$("#showShape").show();
						$("#flotholder").css("height","420px");

						//smarty是字符串，我们需要将其转换为可以利用JS操作的变量
						var staticfields = eval('<?php echo $_smarty_tpl->tpl_vars['staticfields']->value;?>
');
						var choiceContainer = $("#labelholder");
						//清空DOM
						choiceContainer.html('');
						
						var field = "";
						choiceContainer.append("<ul>");
						$.each(staticfields, function(key, val) {
							choiceContainer.append("<li><input type='radio' name='changePieData' value='" + val.field + "' \/>" + val.comment + "<\/li>");
						});
						choiceContainer.append("<\/ul>");
						
						//radio重新绑定事件
						$("input:radio[name='changePieData']").on("click",function(){
							pie($(this));
						});
						//触发第一个radio click事件
						$("input[name='changePieData']:first").click();
						//pie($(this));
					}
				}
			}
			
		});
	});
	
	// 记录筛选
	$filterSelect.mouseover(function() {
		var $this = $(this);
		var offset = $this.offset();
		var $menuWrap = $this.closest("div.menuWrap");
		var $popupMenu = $menuWrap.children("div.popupMenu");
		$popupMenu.css({left: offset.left, top: offset.top + $this.height() + 2}).show();
		$menuWrap.mouseleave(function() {
			$popupMenu.hide();
		});
	});
	
	// 筛选选项
	$filterOption.click(function() {
		var $this = $(this);
		var $dest = $("#" + $this.attr("name"));
		if ($this.hasClass("checked")) {
			$dest.val("");
		} else {
			$dest.val($this.attr("val"));
		}
		$listForm.submit();
		return false;
	});
});
</script>
</head>
<body>
	<div class="path">
		记录列表 &raquo; <?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableName'];?>
 <span>(共<span id="pageTotal"><?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['recordCount'];?>
</span>条记录)</span>
	</div>
	<form id="listForm" action="admin.php" method="get">
		<input type="hidden" id="app" name="app" value="materialTable" />
		<input type="hidden" id="act" name="act" value="viewTableRecords" />
		<input type="hidden" id="tableID" name="tableID" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
" />
		<input type="hidden" id="tableName" name="tableName" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableName'];?>
" />
		<!-- 更多选项
		<input type="hidden" id="productCategoryId" name="productCategoryId" value="" />
		<input type="hidden" id="brandId" name="brandId" value="" />
		<input type="hidden" id="promotionId" name="promotionId" value="" />
		<input type="hidden" id="tagId" name="tagId" value="" />
		-->
		<input type="hidden" id="recordStatus" name="recordStatus" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['recordStatus'];?>
" />
		<div class="bar">
			<?php if ($_smarty_tpl->tpl_vars['isExistAddButton']->value==1){?>
			<a href="admin.php?app=materialTable&act=viewInsertRecords&tableID=<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<?php }?>
			<div class="buttonWrap">
				<?php if ($_smarty_tpl->tpl_vars['isExistDelButton']->value==1){?>
				<a href="javascript:;" id="deleteButton" rel="admin.php?app=materialTable&act=deleteRecords&tableID=<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span>删除
				</a>
				<?php }?>
				<a href="javascript:;" id="refreshButton" class="iconButton">
					<span class="refreshIcon">&nbsp;</span>刷新
				</a>
				
				<a id="moreButton" class="button" href="javascript:;">图形展示</a>
				
				<div class="menuWrap">
					<a href="javascript:;" id="filterSelect" class="button">
						记录筛选<span class="arrow">&nbsp;</span>
					</a>
					<div class="popupMenu">
						<ul id="filterOption" class="check">
							<li>
								<a href="javascript:;" name="recordStatus" val="1">提交</a>
							</li>
							<li>
								<a href="javascript:;" name="recordStatus" val="2">暂存</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="menuWrap">
					<a href="javascript:;" id="pageSizeSelect" class="button">
						每页显示<span class="arrow">&nbsp;</span>
					</a>
					<div class="popupMenu">
						<ul id="pageSizeOption">
							<li>
								<a href="javascript:;" val="10" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==10){?>class="current"<?php }?>>10</a>
							</li>
							<li>
								<a href="javascript:;" val="20" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==20){?>class="current"<?php }?>>20</a>
							</li>
							<li>
								<a href="javascript:;" val="50" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==50){?>class="current"<?php }?>>50</a>
							</li>
							<li>
								<a href="javascript:;" val="100" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==100){?>class="current"<?php }?>>100</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menuWrap">
				<div class="search">
					<span id="searchPropertySelect" class="arrow">&nbsp;</span>
					<input type="text" id="searchValue" name="searchValue" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['searchValue'];?>
" maxlength="200" />
					<button type="submit">&nbsp;</button>
				</div>
				<div class="popupMenu">
					<ul id="searchPropertyOption">
						<li>
							<a href="javascript:;" val="inputer">录入者</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<table id="showShape" class="input">
			<tr>
				<td colspan="2">
					<div id="topTitle"></div>
					<div id="flotholder"></div>
					<div id="labelholder"></div>
				</td>
			</tr>
		</table>

		<table id="listTable" class="list">
			<tr>
				<th class="check">
					<input type="checkbox" id="selectAll" />
				</th>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['name'] = 'fieldInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fieldInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fieldsInfo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']!=0){?>
				<th>
					<a href="javascript:;" class="sort" name="<?php echo $_smarty_tpl->tpl_vars['fieldsInfo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Field'];?>
"><?php echo $_smarty_tpl->tpl_vars['fieldsInfo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fieldInfo']['index']]['Comment'];?>
</a>
				</th>
				<?php }?>
				<?php endfor; endif; ?>
				<th>
					<a href="javascript:;" class="sort" name="keyboarder">录入人员</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="entryTime">录入时间</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="recordStatus">状态</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['name'] = 'recordInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['recordsList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['recordInfo']['total']);
?>
				<tr>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['record']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['record']['index']++;
?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['record']['index']==0){?>
					<td>
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" />
					</td>
					<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['record']['index']>$_smarty_tpl->tpl_vars['basicInfo']->value['fieldCount']){?>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']]['attr']['uname'];?>

					</td>	
					<td>
						<?php echo $_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']]['attr']['r_time'];?>

					</td>	
					<td>
						<?php if ($_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']]['attr']['r_status']==1){?>
						<font style="color:red">提交</font>
						<?php }else{ ?>
						<font style="color:blue">暂存</font>
						<?php }?>
					</td>	
					<td>
						<?php if ($_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']]['attr']['r_status']==2&&$_smarty_tpl->tpl_vars['basicInfo']->value['gid']==2){?>
						<a href="admin.php?app=materialTable&act=viewUpdateRecords&tableID=<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
&recordID=<?php echo $_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']][0];?>
">[编辑]</a>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['gid']==1){?>
						<a href="admin.php?app=materialTable&act=viewUpdateRecords&tableID=<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
&recordID=<?php echo $_smarty_tpl->tpl_vars['recordsList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['recordInfo']['index']][0];?>
">[编辑]</a>
						<?php }?>
					</td>
					<?php }else{ ?>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['item']->value;?>

					</td>
					<?php }?>
					<?php } ?>
				</tr>
				<?php endfor; endif; ?>
		</table>
	<input type="hidden" id="pageSize" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['pageSize'];?>
" />
	<input type="hidden" id="searchProperty" name="searchProperty" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['searchProperty'];?>
" />
	<input type="hidden" id="orderProperty" name="orderProperty" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['orderProperty'];?>
" />
	<input type="hidden" id="orderDirection" name="orderDirection" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['orderDirection'];?>
" />
	<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['showPage'];?>

	</form>
</body>
</html><?php }} ?>