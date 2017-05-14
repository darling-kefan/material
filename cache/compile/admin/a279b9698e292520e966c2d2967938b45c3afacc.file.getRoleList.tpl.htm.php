<?php /* Smarty version Smarty-3.1.14, created on 2013-09-15 10:25:47
         compiled from "D:\VertrigoServ\www\material\exten\admin\template\_role\getRoleList.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1680152358b2bcf1807-67407828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a279b9698e292520e966c2d2967938b45c3afacc' => 
    array (
      0 => 'D:\\VertrigoServ\\www\\material\\exten\\admin\\template\\_role\\getRoleList.tpl.htm',
      1 => 1378882854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1680152358b2bcf1807-67407828',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total_num' => 0,
    'hasAdd' => 0,
    'pageArr' => 0,
    'val' => 0,
    'pageSize' => 0,
    'searchValue' => 0,
    'searchType' => 0,
    'searchProperty' => 0,
    'key' => 0,
    'rolelist' => 0,
    'hasEdit' => 0,
    'hasDel' => 0,
    'orderProperty' => 0,
    'orderDirection' => 0,
    'pageStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52358b2beaa9c2_70568044',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52358b2beaa9c2_70568044')) {function content_52358b2beaa9c2_70568044($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>角色列表 - Powered By sqtang</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $delete = $("#listTable a.delete");// 删除
	$delete.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要删除吗？",
			onOk: function() {
				$.ajax({
					url: "?app=role&act=delRole",
					type: "POST",
					data: {gid: $this.attr("val")},
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
		角色管理 &raquo; 角色列表 <span>(共<span id="pageTotal"><?php echo $_smarty_tpl->tpl_vars['total_num']->value;?>
</span>条记录)</span>
	</div>
	<form id="listForm" action="admin.php" method="get">
	<input type="hidden" name="app" value='role'/>
	<input type="hidden" name="act" value='getRoleList'/>
		<div class="bar">
		    <?php if ($_smarty_tpl->tpl_vars['hasAdd']->value==1){?>
			<a href="?app=role&act=viewAddRole" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<?php }?>
			<div class="buttonWrap">
				<a href="javascript:;" id="refreshButton" class="iconButton">
					<span class="refreshIcon">&nbsp;</span>刷新
				</a>
				<div class="menuWrap">
					<a href="javascript:;" id="pageSizeSelect" class="button">
						每页显示<span class="arrow">&nbsp;</span>
					</a>
					<div class="popupMenu">
						<ul id="pageSizeOption">
							<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pageArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['pageSize']->value){?>
							<li>
								<a href="javascript:;" class="current" val="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a>
							</li>
							<?php }else{ ?>
							<li>
								<a href="javascript:;"  val="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a>
							</li>
							<?php }?>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="menuWrap">
				<div class="search">
					<span id="searchPropertySelect" class="arrow">&nbsp;</span>
					<input type="text" id="searchValue" name="searchValue" value="<?php echo $_smarty_tpl->tpl_vars['searchValue']->value;?>
" maxlength="200" />
					<button type="submit">&nbsp;</button>
				</div>
				<div class="popupMenu">
					<ul id="searchPropertyOption">
						 <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['searchType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
						  <?php if ($_smarty_tpl->tpl_vars['searchProperty']->value==$_smarty_tpl->tpl_vars['key']->value){?>
						  <li><a href="javascript:;" class="current" val="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a></li>
						  <?php }else{ ?>
						  <li><a href="javascript:;" val="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a></li>
						  <?php }?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<table id="listTable" class="list">
			<tr>
				<th>
					<a href="javascript:;" class="sort" name="gname">名称</a>
				</th>
				
				<th>
					<a href="javascript:;" class="sort" name="is_buildin">是否内置</a>
				</th>
				<th>
					<span>描述</span>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="create_time">创建日期</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['total_num']->value==0){?>
			<tr><td colspan="5"><span>没有相关记录!</span></td></tr>
			<?php }else{ ?>
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rolelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
				<tr>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['val']->value['gname'];?>

					</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['val']->value['is_buildin']){?>
						是
						<?php }else{ ?>
						否
						<?php }?>
					</td>
					<td>
							<span title="<?php echo $_smarty_tpl->tpl_vars['val']->value['gdescription'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['gdescription'];?>
</span>
					</td>
					<td>
						<span title="<?php echo $_smarty_tpl->tpl_vars['val']->value['create_time'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['create_time'];?>
</span>
					</td>
					<td>
					   <?php if ($_smarty_tpl->tpl_vars['hasEdit']->value==1){?>
					   <a href="?app=role&act=viewEditRole&gid=<?php echo $_smarty_tpl->tpl_vars['val']->value['gid'];?>
">[编辑]</a>
						<?php }else{ ?>
						<span class="gray">[编辑]</span>
					   <?php }?>
						<?php if ($_smarty_tpl->tpl_vars['val']->value['is_buildin']){?>
						<span class="gray">[删除]</span>
						<?php }else{ ?>
						<?php if ($_smarty_tpl->tpl_vars['hasDel']->value==1){?>
						<a href="javascript:;"  class="delete" val="<?php echo $_smarty_tpl->tpl_vars['val']->value['gid'];?>
">[删除]</a>
						<?php }else{ ?>
						<span class="gray">[删除]</span>
						<?php }?>
						<?php }?>
					</td>
				</tr>
			<?php } ?>
			<?php }?>
		</table>
<input type="hidden" id="pageSize" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" />
<input type="hidden" id="searchProperty" name="searchProperty" value="<?php echo $_smarty_tpl->tpl_vars['searchProperty']->value;?>
" />
<input type="hidden" id="orderProperty" name="orderProperty" value="<?php echo $_smarty_tpl->tpl_vars['orderProperty']->value;?>
" />
<input type="hidden" id="orderDirection" name="orderDirection" value="<?php echo $_smarty_tpl->tpl_vars['orderDirection']->value;?>
" />
<?php echo $_smarty_tpl->tpl_vars['pageStr']->value;?>

	</form>
</body>
</html><?php }} ?>