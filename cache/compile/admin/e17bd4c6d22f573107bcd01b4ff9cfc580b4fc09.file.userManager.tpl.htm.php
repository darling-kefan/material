<?php /* Smarty version Smarty-3.1.14, created on 2013-09-26 09:18:28
         compiled from "/var/www/html/material/exten/admin/template/_user/userManager.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:212003492452438b6416e400-84345869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e17bd4c6d22f573107bcd01b4ff9cfc580b4fc09' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_user/userManager.tpl.htm',
      1 => 1379300978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212003492452438b6416e400-84345869',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total_num' => 0,
    'hasEdit' => 0,
    'hasDel' => 0,
    'pageArr' => 0,
    'val' => 0,
    'pageSize' => 0,
    'searchValue' => 0,
    'searchType' => 0,
    'searchProperty' => 0,
    'key' => 0,
    'userlist' => 0,
    'orderProperty' => 0,
    'orderDirection' => 0,
    'pageStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438b642c2103_48196334',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438b642c2103_48196334')) {function content_52438b642c2103_48196334($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>用户列表 - Powered By sqtang</title>
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
					url: "?app=user&act=delUser",
					type: "POST",
					data: {uid: $this.attr("val")},
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
		用户管理 &raquo; 用户列表 <span>(共<span id="pageTotal"><?php echo $_smarty_tpl->tpl_vars['total_num']->value;?>
</span>条记录)</span>
	</div>
	<form id="listForm" action="admin.php" method="get">
	<input type="hidden" name="app" value='user'/>
	<input type="hidden" name="act" value='getUserList'/>
		<div class="bar">
		    <?php if ($_smarty_tpl->tpl_vars['hasEdit']->value==1){?>
			<a href="?app=user&act=viewAddUser" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<?php }?>
			<div class="buttonWrap">
				<?php if ($_smarty_tpl->tpl_vars['hasDel']->value==1){?>
				<a href="javascript:;" id="deleteButton" rel="?app=user&act=delUser" class="iconButton disabled">
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
				<th class="check">
					<input type="checkbox" id="selectAll" />
				</th>
				<th>
					<a href="javascript:;" class="sort" name="uname">用户名</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="uemail">E-mail</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="truename">姓名</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="last_login_time">最后登录日期</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="last_login_ip">最后登录IP</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="wether_to_enable">状态</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="create_time">创建日期</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
				<?php if ($_smarty_tpl->tpl_vars['total_num']->value==0){?>
			<tr><td colspan="9"><span>没有相关记录!</span></td></tr>
			<?php }else{ ?>
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
				<tr>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['val']->value['gid']==1){?>
						<input type="checkbox" title="系统内置用户不能删除" disabled="disabled" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['uid'];?>
" />
						<?php }else{ ?>
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['uid'];?>
" />
						<?php }?>
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['val']->value['uname'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['val']->value['uemail'];?>

					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['val']->value['truename'];?>

					</td>
					<td>
							<span title="<?php echo $_smarty_tpl->tpl_vars['val']->value['last_login_time'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['last_login_time'];?>
</span>
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['val']->value['last_login_ip'];?>

					</td>
					<td>
					<?php if ($_smarty_tpl->tpl_vars['val']->value['wether_to_enable']){?>
						<span class="green">正常</span>
					<?php }else{ ?>
						<span class="gray">禁用</span>
					<?php }?>
					</td>
					<td>
						<span title="<?php echo $_smarty_tpl->tpl_vars['val']->value['create_time'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['create_time'];?>
</span>
					</td>
					<td>
					    <?php if ($_smarty_tpl->tpl_vars['hasEdit']->value==1){?>
						<a href="?app=user&act=viewEditUser&uid=<?php echo $_smarty_tpl->tpl_vars['val']->value['uid'];?>
">[编辑]</a>
						<?php }else{ ?>
						<span class="gray">[编辑]</span>
					   <?php }?> 

					   <?php if ($_smarty_tpl->tpl_vars['val']->value['gid']==1){?>
					       <span class="gray">[删除]</span>
					   <?php }else{ ?>
							<?php if ($_smarty_tpl->tpl_vars['hasDel']->value==1){?>
								<a href="javascript:;"  class="delete" val="<?php echo $_smarty_tpl->tpl_vars['val']->value['uid'];?>
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