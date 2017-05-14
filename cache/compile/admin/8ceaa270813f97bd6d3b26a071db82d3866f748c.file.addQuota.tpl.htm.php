<?php /* Smarty version Smarty-3.1.14, created on 2013-11-26 18:36:05
         compiled from "/var/www/html/material/exten/admin/template/_quota/addQuota.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1430207670528f2904388f25-12896176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ceaa270813f97bd6d3b26a071db82d3866f748c' => 
    array (
      0 => '/var/www/html/material/exten/admin/template/_quota/addQuota.tpl.htm',
      1 => 1385462147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1430207670528f2904388f25-12896176',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_528f29043f7ac3_93414078',
  'variables' => 
  array (
    '_Title' => 0,
    '_Rank' => 0,
    'allQuotaClassList' => 0,
    'classQuotas' => 0,
    'quotaItem' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f29043f7ac3_93414078')) {function content_528f29043f7ac3_93414078($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link href="exten/admin/template/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="exten/admin/template/js/jquery.js"></script>
<script type="text/javascript" src="exten/admin/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="exten/admin/template/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/js/input.js"></script>
</style>
<style type="text/css">
	.specificationSelect {
		min-height: 260px;
		padding: 5px;
		overflow-y: scroll;
		border: 1px solid #cccccc;
	}
	.specificationSelect dl {
		diplay:block;
		width:181px;
		height:250px;	
		float:left;
		margin-left:10px;
		margin-right:10px;
		margin-bottom:5px;
		margin-top:5px;
		border:1px solid #cccccc;
		overflow:auto
	}
	.specificationSelect dt {
		height: 30px;
		line-height: 30px;
		width: 160px;
		padding: 0 10px;
		font-weight:bold;
		overflow: hidden;
		text-align:center;
		background-color: #F1F8FF;
		border-bottom:1px solid #cccccc;
	}
	.specificationSelect dd {
		height: 30px;
		line-height: 30px;
		width: 170px;
		padding:0 5px;
		overflow: hidden;
	}
</style>
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $quotaholder = $("#quotaholder");
	var $quotaParentIds = $("#quotaParentID");
	
	var $specificationProductTable = $("#specificationProductTable");
	
	$quotaParentIds.change(function(){
		var quotaParentId = $(this).val();
		$("#specificationSelect").html('');
		var selectTables = '';
		
		//异步请求数据
		$.ajax({
			url: "admin.php?app=quota&act=asyncGetTablesByQType",
			type: "POST",
			data: {id: quotaParentId},
			dataType: "json",
			cache: false,
			success: function(data) {
				console.log(data);

				$.each(data, function(key,val){
					selectTables = selectTables + "<dl> <dt>"+ val.comment +"<input type=\"hidden\" name=\"tid[]\" value=\""+ val.tid +"\" /></dt>";
					console.log(val.data);
					$.each(val.data, function(i,fieldInfo){
						selectTables = selectTables + "<dd> <input type=\"checkbox\" name=\"table"+ val.tid +"_fields[]\" value=\""+ fieldInfo.fname +"\" />"+ fieldInfo.fcomment +"</dd>";
					});
					
					selectTables = selectTables + "</dl>";
					//selectTables = selectTables + "<dt> <input type=\"checkbox\" name=\"specificationIds\" value=\""+ val.name +"\" />"+ val.comment +" </label> </li>";
				});

				$("#specificationSelect").html(selectTables);

			}
		});
	});

	// 表单验证
	$inputForm.validate({
		rules: {
			quotaCId: "required",
			quotaName: "required"
		}
	});
	
});
</script>
</head>
<body>
	<div class="path">
		<?php echo $_smarty_tpl->tpl_vars['_Rank']->value;?>

	</div>
	<form id="inputForm" action="admin.php?app=quota&act=addQuota" method="post">
		
		<table class="input tabContent">
			<tr class="title">
				<th>
					<span class="requiredField">*</span>请选择指标类别:
				</th>
			</tr>
			<tr>
				<td>
				<select name="quotaCId" id="quotaParentID">
					<option value="">---请选择---</option>
					<?php  $_smarty_tpl->tpl_vars['classQuotas'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['classQuotas']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['allQuotaClassList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['classQuotas']->key => $_smarty_tpl->tpl_vars['classQuotas']->value){
$_smarty_tpl->tpl_vars['classQuotas']->_loop = true;
?>
						<option value="" disabled="disabled"><?php echo $_smarty_tpl->tpl_vars['classQuotas']->value['name'];?>
</option>
						<?php  $_smarty_tpl->tpl_vars['quotaItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['quotaItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['classQuotas']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['quotaItem']->key => $_smarty_tpl->tpl_vars['quotaItem']->value){
$_smarty_tpl->tpl_vars['quotaItem']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['qcid'];?>
"><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['name'] = 'quotaLevel';
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['quotaItem']->value['level']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['quotaLevel']['total']);
?>&nbsp;&nbsp;<?php endfor; endif; ?><?php echo $_smarty_tpl->tpl_vars['quotaItem']->value['qcname'];?>
</option>
						<?php } ?>
					<?php } ?>
				</select>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
				
				</td>
			</tr>
		
			<tr class="title">
				<th>
					<span class="requiredField">*</span>请选择原料数据表字段:
				</th>
			</tr>
			<tr>
				<td>
					<div id="specificationSelect" class="specificationSelect"></div>
				</td>
			</tr>
			
			<tr class="title">
				<th>
					<span class="requiredField">*</span>请填写指标名称:
				</th>
			</tr>
			<tr>
				<td>
					<input type="text" name="quotaName" style="width:300px" value="" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='admin.php?app=quota&act=quotaManager'" />
				</td>
			</tr>
		</table>
		

	</form>
</body>
</html><?php }} ?>