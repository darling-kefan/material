<?php /* Smarty version Smarty-3.1.14, created on 2013-11-26 18:34:09
         compiled from "/var/www/html/material/exten/admin/template/_quota/quota.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:470170576528c2b031138c2-72587512%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f7c9e57866532eef03686a5f423ee457d22847a' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_quota/quota.tpl.htm',
      1 => 1385462041,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '470170576528c2b031138c2-72587512',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528c2b0324b208_71062395',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'topBottons' => 0,
    'basicInfo' => 0,
    'quotasList' => 0,
    'quota' => 0,
    'rightOperates' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528c2b0324b208_71062395')) {function content_528c2b0324b208_71062395($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	
	// 删除
	$delete.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要删除吗？",
			onOk: function() {
				$.ajax({
					url: "admin.php?app=quota&act=deleteQuota",
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

});
</script>
</head>

<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="listForm" action="admin.php" method="get">
		<div class="bar">
			<a href="<?php echo $_smarty_tpl->tpl_vars['topBottons']->value['add']['url'];?>
" class="iconButton">
				<span class="addIcon">&nbsp;</span><?php echo $_smarty_tpl->tpl_vars['topBottons']->value['add']['name'];?>

			</a>
			<div class="buttonWrap">
				<a href="javascript:;" id="deleteButton" rel="<?php echo $_smarty_tpl->tpl_vars['topBottons']->value['del']['url'];?>
" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span><?php echo $_smarty_tpl->tpl_vars['topBottons']->value['del']['name'];?>

				</a>
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
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==10){?>class="current"<?php }?> val="10">10</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==20){?>class="current"<?php }?> val="20">20</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==50){?>class="current"<?php }?> val="50">50</a>
							</li>
							<li>
								<a href="javascript:;" <?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['pageSize']==100){?>class="current"<?php }?> val="100">100</a>
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
					<a href="javascript:;" class="sort" name="quotaname">指标名称</a>
				</th>
				<th>
					<a href="javascript:;" name="tableCategory">绑定分类</a>
				</th>
				<th>
					<a href="javascript:;" name="creator">指标内容</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
				<?php  $_smarty_tpl->tpl_vars['quota'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quota']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quotasList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quota']->key => $_smarty_tpl->tpl_vars['quota']->value){
$_smarty_tpl->tpl_vars['quota']->_loop = true;
?>
				<tr>
					<td>
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['quota']->value['quotaid'];?>
" />
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['quota']->value['name'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['quota']->value['classes'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['quota']->value['content'];?>

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
						<a href="javascript:;" class="delete" val="<?php echo $_smarty_tpl->tpl_vars['quota']->value['quotaid'];?>
">[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['url'];?>
&quotaid=<?php echo $_smarty_tpl->tpl_vars['quota']->value['quotaid'];?>
">[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
						<?php }?>
						<?php endfor; endif; ?>
					</td>
				</tr>
				<?php } ?>
		</table>
	<input type="hidden" id="app" name="app" value="quota" />
	<input type="hidden" id="act" name="act" value="quotaManager" />
	<input type="hidden" id="pageSize" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['pageSize'];?>
" />
	<input type="hidden" id="orderProperty" name="orderProperty" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['orderProperty'];?>
" />
	<input type="hidden" id="orderDirection" name="orderDirection" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['orderDirection'];?>
" />
	<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['showPage'];?>

	</form>
</body>
</html><?php }} ?>