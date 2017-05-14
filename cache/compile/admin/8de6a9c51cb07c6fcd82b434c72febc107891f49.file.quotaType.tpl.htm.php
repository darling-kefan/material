<?php /* Smarty version Smarty-3.1.14, created on 2013-11-22 16:42:23
         compiled from "/var/www/html/material/exten/admin/template/_quota/quotaType.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:701288490528c2b04e140f5-18032167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8de6a9c51cb07c6fcd82b434c72febc107891f49' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_quota/quotaType.tpl.htm',
      1 => 1385109708,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '701288490528c2b04e140f5-18032167',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528c2b04eb92f7_81990750',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'topBottons' => 0,
    'button' => 0,
    'quotaClasses' => 0,
    'classQuotas' => 0,
    'quotaItem' => 0,
    'rightOperates' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528c2b04eb92f7_81990750')) {function content_528c2b04eb92f7_81990750($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
					url: "admin.php?app=quotaType&act=deleteQuotaType",
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
		<?php  $_smarty_tpl->tpl_vars['button'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['button']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['topBottons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['button']->key => $_smarty_tpl->tpl_vars['button']->value){
$_smarty_tpl->tpl_vars['button']->_loop = true;
?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['button']->value['url'];?>
" class="iconButton">
			<span class="addIcon">&nbsp;</span><?php echo $_smarty_tpl->tpl_vars['button']->value['name'];?>

		</a>
		<?php } ?>
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
			<?php  $_smarty_tpl->tpl_vars['classQuotas'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['classQuotas']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quotaClasses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['classQuotas']->key => $_smarty_tpl->tpl_vars['classQuotas']->value){
$_smarty_tpl->tpl_vars['classQuotas']->_loop = true;
?>
			<tr>
				<td>
					<span style="margin-left: 0px; color: #000000; font-weight:bold"><?php echo $_smarty_tpl->tpl_vars['classQuotas']->value['name'];?>
</span>
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<?php  $_smarty_tpl->tpl_vars['quotaItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quotaItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['classQuotas']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quotaItem']->key => $_smarty_tpl->tpl_vars['quotaItem']->value){
$_smarty_tpl->tpl_vars['quotaItem']->_loop = true;
?>
			<tr>
				<td>
					<span style="margin-left: <?php echo ($_smarty_tpl->tpl_vars['quotaItem']->value['level']+1)*20;?>
px; <?php if ($_smarty_tpl->tpl_vars['quotaItem']->value['level']==0){?>color:#646464<?php }?>">
					<?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['qcname'];?>

					</span>
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['order'];?>

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
&qcid=<?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['qcid'];?>
" <?php if ($_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name']=='删除'){?>class="delete" val=<?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['qcid'];?>
<?php }?>>[<?php echo $_smarty_tpl->tpl_vars['rightOperates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['operateInfo']['index']]['name'];?>
]</a>
					<?php endfor; endif; ?>
				</td>
			</tr>
			<?php } ?>
			<?php } ?>
	</table>
</body>
</html><?php }} ?>