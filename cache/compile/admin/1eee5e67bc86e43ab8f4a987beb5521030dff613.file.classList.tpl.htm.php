<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 09:20:53
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_materialTableClass\classList.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:2595052357bf5e480c4-15193167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1eee5e67bc86e43ab8f4a987beb5521030dff613' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_materialTableClass\\classList.tpl.htm',
      1 => 1378364428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2595052357bf5e480c4-15193167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'isExistAddButton' => 0,
    'classList' => 0,
    'rightOperates' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52357bf6017c49_14171836',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52357bf6017c49_14171836')) {function content_52357bf6017c49_14171836($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

	var $delete = $("#listTable a.delete");
	
	// 删除
	$delete.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要删除吗？",
			onOk: function() {
				$.ajax({
					url: "admin.php?app=materialTableClass&act=deleteTableClass",
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
	<div class="bar">
		<?php if ($_smarty_tpl->tpl_vars['isExistAddButton']->value==1){?>
		<a href="admin.php?app=materialTableClass&act=viewAddTableClass" class="iconButton">
			<span class="addIcon">&nbsp;</span>添加
		</a>
		<?php }?>
		<a href="javascript:;" id="refreshButton" class="iconButton">
			<span class="refreshIcon">&nbsp;</span>刷新
		</a>
	</div>
	<table id="listTable" class="list">
		<tr>
			<th>
				<span>分类名称</span>
			</th>
			<th>
				<span>排序</span>
			</th>
			<th>
				<span>操作</span>
			</th>
		</tr>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['name'] = 'classinfo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['classList']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['classinfo']['total']);
?>
			<tr>
				<td>
					<span <?php if ($_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['level']==0){?>style="margin-left: 0px; color: #000000;"<?php }else{ ?>style="margin-left: <?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['level']*20;?>
px;"<?php }?>>
					<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['className'];?>

					</span>
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['order'];?>

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
&classid=<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid'];?>
" <?php if ($_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name']=='删除'){?>class="delete" val=<?php echo $_smarty_tpl->tpl_vars['classList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['classinfo']['index']]['classid'];?>
<?php }?>>[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
					<?php endfor; endif; ?>
				</td>
			</tr>
			<?php endfor; endif; ?>
	</table>
</body>
</html><?php }} ?>