<?php /* Smarty version Smarty-3.1.14, created on 2013-12-08 19:53:04
         compiled from "/var/www/html/material/exten/admin/template/_materialTable/editRecord.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:14168127415243f9ae578c37-29736308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd3c30b11a53877a26016f995441761514db9d01' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_materialTable/editRecord.tpl.htm',
      1 => 1386502565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14168127415243f9ae578c37-29736308',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5243f9ae665724_74074792',
  'variables' => 
  array (
    '_Title' => 0,
    'fieldsInfo' => 0,
    'myId' => 0,
    'record' => 0,
    'basicInfo' => 0,
    'months' => 0,
    'month' => 0,
    'years' => 0,
    'year' => 0,
    'quarters' => 0,
    'quarter' => 0,
    'provinces' => 0,
    'province' => 0,
    'cities' => 0,
    'city' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5243f9ae665724_74074792')) {function content_5243f9ae665724_74074792($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<meta name="author" content="sqtang" />
<meta name="copyright" content="sqtang" />
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.tools.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
<style type="text/css">
.roles label {
	width: 150px;
	display: block;
	float: left;
	padding-right: 6px;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");

	// 表单验证
	$inputForm.validate({
		rules: {
			<?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fieldsInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
$_smarty_tpl->tpl_vars['record']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['record']->key;
?><?php if ($_smarty_tpl->tpl_vars['myId']->value>0){?><?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
:{
				<?php if ($_smarty_tpl->tpl_vars['record']->value['Null']=='NO'){?>required: true,<?php }?><?php if (strtolower($_smarty_tpl->tpl_vars['record']->value['Type'])=='varchar'||strtolower($_smarty_tpl->tpl_vars['record']->value['Type'])=='text'){?>pattern: /^[0-9a-z_A-Z\u4e00-\u9fa5]+$/,<?php }?><?php if (strtolower($_smarty_tpl->tpl_vars['record']->value['Type'])=='int'||strtolower($_smarty_tpl->tpl_vars['record']->value['Type'])=='float'||strtolower($_smarty_tpl->tpl_vars['record']->value['Type'])=='double'){?>pattern: /^[0-9.]+$/,<?php }?>maxlength: <?php echo $_smarty_tpl->tpl_vars['record']->value['length'];?>

			}<?php }?><?php } ?>
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		原料数据中心 &raquo; <?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableName'];?>
 &raquo; 更新数据
	</div>
	<form id="inputForm" action="admin.php?app=materialTable&act=updateRecords" method="post">
		<ul id="tab" class="tab">
			<li>
				<input type="button" value="数据" />
			</li>
			<li>
				<input type="button" value="属性" />
			</li>
		</ul>
		<table class="input tabContent">
			<input type="hidden" name="tableID" class="text" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
" />
			<?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fieldsInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
$_smarty_tpl->tpl_vars['record']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['record']->key;
?>
			<?php if ($_smarty_tpl->tpl_vars['myId']->value==0){?>
			<input type="hidden" name="recordID" class="text" value="<?php echo $_smarty_tpl->tpl_vars['record']->value['value'];?>
" />
			<?php }else{ ?>
			<tr>
				<th style="width:200px">
					<span class="requiredField">*</span><?php echo $_smarty_tpl->tpl_vars['record']->value['Comment'];?>
（<?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
）
				</th>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['record']->value['Field']=='field0'){?>
						<?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==5||$_smarty_tpl->tpl_vars['basicInfo']->value['classid']==8){?>
							<select name="<?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
">
								<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['month']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['month']->value['value']==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['month']->value['name'];?>
</option>
								<?php } ?>
							</select>
						<?php }elseif($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==7||$_smarty_tpl->tpl_vars['basicInfo']->value['classid']==9){?>
							<select name="<?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
">
								<?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['year']->value==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</option>
								<?php } ?>
							</select>
						<?php }else{ ?>
							<select name="<?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
">
								<?php  $_smarty_tpl->tpl_vars['quarter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quarter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quarters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quarter']->key => $_smarty_tpl->tpl_vars['quarter']->value){
$_smarty_tpl->tpl_vars['quarter']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['quarter']->value['value'];?>
"  <?php if ($_smarty_tpl->tpl_vars['quarter']->value['value']==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['quarter']->value['name'];?>
</option>
								<?php } ?>
							</select>
						<?php }?>
					<?php }elseif($_smarty_tpl->tpl_vars['record']->value['Field']=='field1'){?>
						<?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==1){?>
							<select name="field1">
								<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value){
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['month']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['month']->value['value']==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['month']->value['name'];?>
</option>
								<?php } ?>
							</select>
						<?php }elseif($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==2){?>
							<select name="field1">
								<?php  $_smarty_tpl->tpl_vars['quarter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quarter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quarters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quarter']->key => $_smarty_tpl->tpl_vars['quarter']->value){
$_smarty_tpl->tpl_vars['quarter']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['quarter']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['quarter']->value['value']==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['quarter']->value['name'];?>
</option>
								<?php } ?>
							</select>
						<?php }elseif($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==3){?>
							<select name="field1">
								<?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['year']->value==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</option>
								<?php } ?>
							</select>
						<?php }elseif($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==5||$_smarty_tpl->tpl_vars['basicInfo']->value['classid']==6||$_smarty_tpl->tpl_vars['basicInfo']->value['classid']==7){?>
							<select name="field1">
								<?php  $_smarty_tpl->tpl_vars['province'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['province']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['provinces']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['province']->key => $_smarty_tpl->tpl_vars['province']->value){
$_smarty_tpl->tpl_vars['province']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['province']->value==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['province']->value;?>
</option>
								<?php } ?>
							</select>
						<?php }elseif($_smarty_tpl->tpl_vars['basicInfo']->value['classid']==8||$_smarty_tpl->tpl_vars['basicInfo']->value['classid']==9){?>
							<select name="field1">
								<?php  $_smarty_tpl->tpl_vars['city'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['city']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['city']->key => $_smarty_tpl->tpl_vars['city']->value){
$_smarty_tpl->tpl_vars['city']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['city']->value==$_smarty_tpl->tpl_vars['record']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['city']->value;?>
</option>
								<?php } ?>
							</select>
						<?php }?>
					<?php }else{ ?>
					<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['record']->value['Field'];?>
" class="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['record']->value['value'];?>
" />
					<?php }?>
				</td>
			</tr>
			<?php }?>
			<?php } ?>
		</table>
		<table class="input tabContent">
			<tr>
				<th style="width:200px">
					原料表
				</th>
				<td>
					<input type="text" name="tableName" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableName1'];?>
" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<th style="width:200px">
					录入者
				</th>
				<td>
					<input type="text" name="creator" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['uname'];?>
" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<th style="width:200px">
					状态
				</th>
				<td>
					<input type="text" name="r_status" class="text" maxlength="200" value="<?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['r_status']==1){?>提交<?php }else{ ?>暂存<?php }?>" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<th style="width:200px">
					录入时间:
				</th>
				<td>
					<input type="text" name="r_time" class="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['r_time'];?>
" disabled="disabled" />
				</td>
			</tr>
			<!-- 
			<?php if ($_smarty_tpl->tpl_vars['basicInfo']->value['gid']==1){?>
			<tr class="authorities">
				<th>
					<a href="javascript:;" class="selectAll" title="全选此组权限">写入权限</a>
				</th>
				<td>
					<span class="fieldSet">
						<label>
							<input type="checkbox" class="module" name="writer[]" value="1" />check2
						</label>
					</span>
				</td>
			</tr>
			
			<tr class="authorities">
				<th>
					<a href="javascript:;" class="selectAll" title="全选此组权限">只读权限</a>
				</th>
				<td>
					<span class="fieldSet">
						<label>
							<input type="checkbox" class="module" name="reader[]" value="1" />test
						</label>
					</span>
				</td>
			</tr>
			<?php }?>
			 -->
		</table>
		<table class="input">
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="提&nbsp;&nbsp;交" />
					<input type="submit" class="button" value="暂&nbsp;&nbsp;存" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=materialTable&act=viewTableRecords&tableID=<?php echo $_smarty_tpl->tpl_vars['basicInfo']->value['tableID'];?>
'" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html><?php }} ?>