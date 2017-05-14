<?php /* Smarty version Smarty-3.1.14, created on 2013-09-26 09:25:30
         compiled from "/var/www/html/material/exten/admin/template/_log/operateLog.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:187728105552438d0a666183-90127393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45537138eb9fb565df2d54759ea2ec30cad30d22' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_log/operateLog.tpl.htm',
      1 => 1378957620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187728105552438d0a666183-90127393',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total_num' => 0,
    'hasDel' => 0,
    'pageArr' => 0,
    'val' => 0,
    'pageSize' => 0,
    'searchValue' => 0,
    'searchType' => 0,
    'searchProperty' => 0,
    'key' => 0,
    'logList' => 0,
    'type' => 0,
    'eventtype' => 0,
    'orderProperty' => 0,
    'orderDirection' => 0,
    'pageStr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52438d0a783ab3_49391596',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52438d0a783ab3_49391596')) {function content_52438d0a783ab3_49391596($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>操作日志 - Powered By sqtang</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/list.js"></script>
<script type="text/javascript">
$().ready(function() {
	var $clearButton = $("#clearButton");
	var $resultRow = $("#listTable tr:gt(0)");
	$clearButton.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要清空吗？",
			onOk: function() {
				$.ajax({
					url: "?app=blog&act=deleteOperateLog",
					type: "POST",
					data: {all: 'all'},
					dataType: "json",
					cache: false,
					success: function(message) {
						if (message.type == "success") {
							$resultRow.remove();
						}
						$.message(message);
					}
				});
			}
		});
		return false;
	});

	//删除单条日志记录
	var $delete = $("#listTable a.delete");// 删除
	$delete.click(function() {
		var $this = $(this);
		$.dialog({
			type: "warn",
			content: "您确定要删除吗？",
			onOk: function() {
				$.ajax({
					url: "?app=blog&act=deleteOperateLog",
					type: "POST",
					data: {bid: $this.attr("val")},
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
		日志管理 &raquo; 操作日志 <span>(共<span id="pageTotal"><?php echo $_smarty_tpl->tpl_vars['total_num']->value;?>
</span>条记录)</span>
	</div>
	<form id="listForm" action="admin.php" method="get">
	<input type="hidden" name="app" value='blog'/>
	<input type="hidden" name="act" value='getOperateLog'/>
		<div class="bar">
			<div class="buttonWrap">
			  <?php if ($_smarty_tpl->tpl_vars['hasDel']->value==1){?>
				<a href="javascript:;" id="deleteButton"  rel="?app=blog&act=deleteOperateLog" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span>删除
				</a>
				<a class="iconButton" id="clearButton" href="javascript:;">
					<span class="clearIcon">&nbsp;</span>清空
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
					<a href="javascript:;" class="sort" name="bname">用户名</a>
				</th>
				<th>
					<span>内容</span>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="occur_time">创建日期</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="eventtype">事件</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="table_name">操作的表</a>
				</th>
				<th>
					<span>操作</span>
				</th>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['total_num']->value==0){?>
				<tr><td colspan="7"><span>没有相关记录!</span></td></tr>
			<?php }else{ ?>
			   <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
				<tr>
					<td>
						<input type="checkbox" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['bid'];?>
" />
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['bname'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['event'];?>
</td>
					<td><span title="<?php echo $_smarty_tpl->tpl_vars['val']->value['occur_time'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['occur_time'];?>
</span></td>
					<?php $_smarty_tpl->tpl_vars['type'] = new Smarty_variable($_smarty_tpl->tpl_vars['val']->value['eventtype'], null, 0);?>
					<td><?php echo $_smarty_tpl->tpl_vars['eventtype']->value[$_smarty_tpl->tpl_vars['type']->value];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['val']->value['table_name'];?>
</td>
					<td>
					<?php if ($_smarty_tpl->tpl_vars['hasDel']->value==1){?>
						<a href="javascript:;"  class="delete" val="<?php echo $_smarty_tpl->tpl_vars['val']->value['bid'];?>
">[删除]</a>
					<?php }else{ ?>
						<span class="gray">[删除]</span>
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