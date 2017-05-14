<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 08:40:43
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_materialTable\tablesManager.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:311155235728b6ea401-96325568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce2ccecd7170863d54ec87704631bcd092020e7b' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_materialTable\\tablesManager.tpl.htm',
      1 => 1378953070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '311155235728b6ea401-96325568',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'isExistAddButton' => 0,
    'isExistDelButton' => 0,
    'listInfo' => 0,
    'tablesList' => 0,
    'rightOperates' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5235728b8b3250_09413576',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5235728b8b3250_09413576')) {function content_5235728b8b3250_09413576($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	var $delete = $("#listTable a.delete");
	var $selectAll = $("#selectAll");
	var $ids = $("#listTable input[name='ids[]']");
	var $backup = $("#listTable a.backup");
	var $backupAll = $("#backupAll");
	
	// 删除
	$delete.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要删除吗？",
			onOk: function() {
				$.ajax({
					url: "admin.php?app=materialTable&act=deleteTable",
					type: "POST",
					data: {id: $this.attr("val")},
					dataType: "json",
					cache: false,
					success: function(message) {
						$.message(message);
						if (message.type == "success") {
							$this.closest("tr").remove();
						}
					}
				});
			}
		});
		return false;
	});

	// 单表备份
	$backup.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要备份吗？",
			ok: "确&nbsp;&nbsp;定",
			cancel: "取&nbsp;&nbsp;消",
			onOk: function() {
				$.ajax({
					url: "admin.php?app=materialTable&act=backup",
					type: "POST",
					data: {id: $this.attr("val")},
					dataType: "json",
					cache: false,
					success: function(message) {
						$.message(message);
						if (message.type == "success") {
							//$this.closest("tr").remove();
						}
					}
				});
			}
		});
		return false;
	});
	
	// 可进行多个表备份
	$backupAll.click(function() {
		if ($backupAll.hasClass("disabled")) {
			return false;
		}
		var $checkedIds = $ids.filter(":enabled:checked");
		$.dialog({
			type: "warn",
			content: "您确定要备份吗？",
			ok: "确&nbsp;&nbsp;定",
			cancel: "取&nbsp;&nbsp;消",
			onOk: function() {
				$.ajax({
					url: "admin.php?app=materialTable&act=backup",
					type: "POST",
					data: $checkedIds.serialize(),
					dataType: "json",
					cache: false,
					success: function(message) {
						$.message(message);
						if (message.type == "success") {
							//$checkedIds.closest("td").siblings(".hasSent").html('<span title="已发送" class="trueIcon">&nbsp;<\/span>');
						}
					}
				});
			}
		});
	});
	
	// 全选
	$selectAll.click(function() {
		var $this = $(this);
		var $enabledIds = $ids.filter(":enabled");
		if ($this.prop("checked")) {
			if ($enabledIds.filter(":checked").size() > 0) {
				$backupAll.removeClass("disabled");
			} else {
				$backupAll.addClass("disabled");
			}
		} else {
			$backupAll.addClass("disabled");
		}
	});
	
	// 选择
	$ids.click(function() {
		var $this = $(this);
		if ($this.prop("checked")) {
			$backupAll.removeClass("disabled");
		} else {
			if ($ids.filter(":enabled:checked").size() > 0) {
				$backupAll.removeClass("disabled");
			} else {
				$backupAll.addClass("disabled");
			}
		}
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
				<a href="javascript:;" id="backupAll" class="button disabled">
					备份
				</a>
				<?php if ($_smarty_tpl->tpl_vars['isExistDelButton']->value==1){?>
				<a href="javascript:;" id="deleteButton" rel="admin.php?app=materialTable&act=deleteTable" class="iconButton disabled">
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
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['listInfo']->value['pageSize']==10){?>class="current"<?php }?> val="10">10</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['listInfo']->value['pageSize']==20){?>class="current"<?php }?> val="20">20</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['listInfo']->value['pageSize']==50){?>class="current"<?php }?> val="50">50</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['listInfo']->value['pageSize']==100){?>class="current"<?php }?> val="100">100</a>
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
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
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
						<?php if ($_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name']=='删除'){?>
						<a href="javascript:;" class="delete" val="<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
">[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php }elseif($_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name']=='备份'){?>
						<a href="javascript:;" class="backup" val="<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
">[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['url'];?>
&tableID=<?php echo $_smarty_tpl->tpl_vars['tablesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tableInfo']['index']]['tableId'];?>
">[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php }?>
						<?php endfor; endif; ?>
					</td>
				</tr>
				<?php endfor; endif; ?>
		</table>
	<input type="hidden" id="app" name="app" value="materialTable" />
	<input type="hidden" id="act" name="act" value="getTablesList" />
	<input type="hidden" id="pageSize" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['listInfo']->value['pageSize'];?>
" />
	<input type="hidden" id="orderProperty" name="orderProperty" value="<?php echo $_smarty_tpl->tpl_vars['listInfo']->value['orderProperty'];?>
" />
	<input type="hidden" id="orderDirection" name="orderDirection" value="<?php echo $_smarty_tpl->tpl_vars['listInfo']->value['orderDirection'];?>
" />
	<?php echo $_smarty_tpl->tpl_vars['listInfo']->value['showPage'];?>

	</form>
</body>
</html><?php }} ?>