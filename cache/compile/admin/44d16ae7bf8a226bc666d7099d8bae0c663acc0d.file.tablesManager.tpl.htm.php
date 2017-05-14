<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 16:09:39
         compiled from "/var/www/material/exten/admin/template/_materialTable/tablesManager.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:51546704452283148b4a1f9-67910118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44d16ae7bf8a226bc666d7099d8bae0c663acc0d' => 
    array (
      0 => '/var/www/material/exten/admin/template/_materialTable/tablesManager.tpl.htm',
      1 => 1378455283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51546704452283148b4a1f9-67910118',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52283148b8fe10_18022179',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'isExistAddButton' => 0,
    'isExistDelButton' => 0,
    'tablesList' => 0,
    'rightOperates' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52283148b8fe10_18022179')) {function content_52283148b8fe10_18022179($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $listForm = $("#listForm");
	var $moreButton = $("#moreButton");
	var $filterSelect = $("#filterSelect");
	var $filterOption = $("#filterOption a");
	
	
	// 更多选项
	$moreButton.click(function() {
		$.dialog({
			title: "更多选项",
content: ' <table id="moreTable" class="moreTable"> <tr> <th> 商品分类: <\/th> <td> <select name="productCategoryId"> <option value="">请选择...<\/option> <option value="1"> 时尚女装 <\/option> <option value="11"> &nbsp;&nbsp; 连衣裙 <\/option> <option value="12"> &nbsp;&nbsp; 针织衫 <\/option> <option value="13"> &nbsp;&nbsp; 短外套 <\/option> <option value="14"> &nbsp;&nbsp; 小西装 <\/option> <option value="15"> &nbsp;&nbsp; 牛仔裤 <\/option> <option value="16"> &nbsp;&nbsp; T恤 <\/option> <option value="17"> &nbsp;&nbsp; 衬衫 <\/option> <option value="18"> &nbsp;&nbsp; 风衣 <\/option> <option value="19"> &nbsp;&nbsp; 卫衣 <\/option> <option value="20"> &nbsp;&nbsp; 裤子 <\/option> <option value="2"> 精品男装 <\/option> <option value="21"> &nbsp;&nbsp; 针织衫 <\/option> <option value="22"> &nbsp;&nbsp; POLO衫 <\/option> <option value="23"> &nbsp;&nbsp; 休闲裤 <\/option> <option value="24"> &nbsp;&nbsp; 牛仔裤 <\/option> <option value="25"> &nbsp;&nbsp; T恤 <\/option> <option value="26"> &nbsp;&nbsp; 衬衫 <\/option> <option value="27"> &nbsp;&nbsp; 西服 <\/option> <option value="28"> &nbsp;&nbsp; 西裤 <\/option> <option value="29"> &nbsp;&nbsp; 风衣 <\/option> <option value="30"> &nbsp;&nbsp; 卫衣 <\/option> <option value="3"> 精致内衣 <\/option> <option value="31"> &nbsp;&nbsp; 女式内裤 <\/option> <option value="32"> &nbsp;&nbsp; 男式内裤 <\/option> <option value="33"> &nbsp;&nbsp; 保暖内衣 <\/option> <option value="34"> &nbsp;&nbsp; 塑身衣 <\/option> <option value="35"> &nbsp;&nbsp; 连裤袜 <\/option> <option value="36"> &nbsp;&nbsp; 打底袜 <\/option> <option value="37"> &nbsp;&nbsp; 文胸 <\/option> <option value="38"> &nbsp;&nbsp; 睡衣 <\/option> <option value="39"> &nbsp;&nbsp; 泳装 <\/option> <option value="40"> &nbsp;&nbsp; 浴袍 <\/option> <option value="4"> 服饰配件 <\/option> <option value="41"> &nbsp;&nbsp; 女士腰带 <\/option> <option value="42"> &nbsp;&nbsp; 男士皮带 <\/option> <option value="43"> &nbsp;&nbsp; 女士围巾 <\/option> <option value="44"> &nbsp;&nbsp; 男士围巾 <\/option> <option value="45"> &nbsp;&nbsp; 帽子 <\/option> <option value="46"> &nbsp;&nbsp; 手套 <\/option> <option value="47"> &nbsp;&nbsp; 领带 <\/option> <option value="48"> &nbsp;&nbsp; 领结 <\/option> <option value="49"> &nbsp;&nbsp; 发饰 <\/option> <option value="50"> &nbsp;&nbsp; 袖扣 <\/option> <option value="5"> 时尚女鞋 <\/option> <option value="51"> &nbsp;&nbsp; 高帮鞋 <\/option> <option value="52"> &nbsp;&nbsp; 雪地靴 <\/option> <option value="53"> &nbsp;&nbsp; 中筒靴 <\/option> <option value="54"> &nbsp;&nbsp; 单鞋 <\/option> <option value="55"> &nbsp;&nbsp; 凉鞋 <\/option> <option value="56"> &nbsp;&nbsp; 靴子 <\/option> <option value="57"> &nbsp;&nbsp; 短靴 <\/option> <option value="58"> &nbsp;&nbsp; 雨靴 <\/option> <option value="6"> 流行男鞋 <\/option> <option value="59"> &nbsp;&nbsp; 低帮鞋 <\/option> <option value="60"> &nbsp;&nbsp; 高帮鞋 <\/option> <option value="61"> &nbsp;&nbsp; 休闲鞋 <\/option> <option value="62"> &nbsp;&nbsp; 正装鞋 <\/option> <option value="7"> 潮流女包 <\/option> <option value="63"> &nbsp;&nbsp; 单肩包 <\/option> <option value="64"> &nbsp;&nbsp; 双肩包 <\/option> <option value="65"> &nbsp;&nbsp; 手提包 <\/option> <option value="66"> &nbsp;&nbsp; 手拿包 <\/option> <option value="8"> 精品男包 <\/option> <option value="67"> &nbsp;&nbsp; 单肩男 <\/option> <option value="68"> &nbsp;&nbsp; 双肩包 <\/option> <option value="69"> &nbsp;&nbsp; 手提包 <\/option> <option value="70"> &nbsp;&nbsp; 手拿包 <\/option> <option value="9"> 童装童鞋 <\/option> <option value="71"> &nbsp;&nbsp; 运动鞋 <\/option> <option value="72"> &nbsp;&nbsp; 牛仔裤 <\/option> <option value="73"> &nbsp;&nbsp; 套装 <\/option> <option value="74"> &nbsp;&nbsp; 裤子 <\/option> <option value="10"> 时尚饰品 <\/option> <option value="75"> &nbsp;&nbsp; 项链 <\/option> <option value="76"> &nbsp;&nbsp; 手链 <\/option> <option value="77"> &nbsp;&nbsp; 戒指 <\/option> <option value="78"> &nbsp;&nbsp; 耳饰 <\/option> <\/select> <\/td> <\/tr> <tr> <th> 品牌: <\/th> <td> <select name="brandId"> <option value="">请选择...<\/option> <option value="1"> 梵希蔓 <\/option> <option value="2"> 伊芙丽 <\/option> <option value="3"> 尚都比拉 <\/option> <option value="4"> 森马 <\/option> <option value="5"> 以纯 <\/option> <option value="6"> 李宁 <\/option> <option value="7"> 耐克 <\/option> <option value="8"> 阿迪达斯 <\/option> <option value="9"> Jack Jones <\/option> <option value="10"> 七匹狼 <\/option> <option value="11"> 恒源祥 <\/option> <option value="12"> 圣得西 <\/option> <option value="13"> 猫人 <\/option> <option value="14"> 北极绒 <\/option> <option value="15"> 美特斯·邦威 <\/option> <option value="16"> 真维斯 <\/option> <option value="17"> 唐狮 <\/option> <\/select> <\/td> <\/tr> <tr> <th> 促销: <\/th> <td> <select name="promotionId"> <option value="">请选择...<\/option> <option value="1"> 限时抢购 <\/option> <option value="2"> 双倍积分 <\/option> <\/select> <\/td> <\/tr> <tr> <th> 标签: <\/th> <td> <select name="tagId"> <option value="">请选择...<\/option> <option value="1"> 热销 <\/option> <option value="2"> 最新 <\/option> <\/select> <\/td> <\/tr> <\/table>',			width: 470,
			modal: true,
			ok: "确&nbsp;&nbsp;定",
			cancel: "取&nbsp;&nbsp;消",
			onOk: function() {
				$("#moreTable :input").each(function() {
					var $this = $(this);
					$("#" + $this.attr("name")).val($this.val());
				});
				$listForm.submit();
			}
		});
	});
	
	// 商品筛选
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
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="listForm" action="admin.php" method="get">
		<div class="bar">
			<?php if ($_smarty_tpl->tpl_vars['isExistAddButton']->value==1){?>
			<a href="admin.php?app=materialTable&act=viewCreateTable" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<?php }?>
			<div class="buttonWrap">
				<?php if ($_smarty_tpl->tpl_vars['isExistDelButton']->value==1){?>
				<a href="javascript:;" id="deleteButton" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span>删除
				</a>
				<?php }?>
				<a href="javascript:;" id="refreshButton" class="iconButton">
					<span class="refreshIcon">&nbsp;</span>刷新
				</a>
				<div class="menuWrap">
					<a href="javascript:;" id="pageSizeSelect" class="button">
						每页显示<span class="arrow">&nbsp;</span>
					</a>
					<div class="popupMenu">
						<ul id="pageSizeOption">
							<li>
								<a href="javascript:;" val="10">10</a>
							</li>
							<li>
								<a href="javascript:;" class="current" val="20">20</a>
							</li>
							<li>
								<a href="javascript:;" val="50">50</a>
							</li>
							<li>
								<a href="javascript:;" val="100">100</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menuWrap">
				
			</div>
		</div>
		<table id="listTable" class="list">
			<tr>
				<th class="check">
					<input type="checkbox" id="selectAll" />
				</th>
				<th>
					<a href="javascript:;" name="name">名称</a>
				</th>
				<th>
					<a href="javascript:;" name="tableCategory">绑定分类</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="creator">创建者</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="order">排序</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['name'] = 'tableInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tablesList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['tableInfo']['total']);
?>
				<tr>
					<td>
						<input type="checkbox" name="ids" value="<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
" />
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableName'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableMenu'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['userName'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableSort'];?>

					</td>
					<td>
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['name'] = 'operateInfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['rightOperates']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['operateInfo']['total']);
?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['url'];?>
&classid=<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
" <?php if ($_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name']=='删除'){?>class="delete" val="<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
"<?php }?>>[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php endfor; endif; ?>
					</td>
				</tr>
				<?php endfor; endif; ?>
		</table>
	<input type="hidden" id="app" name="app" value="materialTable" />
	<input type="hidden" id="act" name="act" value="getTablesList" />
	<input type="hidden" id="pageSize" name="pageSize" value="20" />
	<input type="hidden" id="orderProperty" name="orderProperty" value="" />
	<input type="hidden" id="orderDirection" name="orderDirection" value="" />
	<div class="pagination">
			<span class="firstPage">&nbsp;</span>
			<span class="previousPage">&nbsp;</span>
				<span class="currentPage">1</span>
				<a href="javascript: $.pageSkip(2);">2</a>
				<a href="javascript: $.pageSkip(3);">3</a>
			<a class="nextPage" href="javascript: $.pageSkip(2);">&nbsp;</a>
			<a class="lastPage" href="javascript: $.pageSkip(4);">&nbsp;</a>
		<span class="pageSkip">
			共4页 到第<input id="pageNumber" name="pageNumber" value="1" maxlength="9" onpaste="return false;" />页<button type="submit">&nbsp;</button>
		</span>
	</div>
	</form>
</body>
</html><?php }} ?>