<?php /* Smarty version Smarty-3.1.14, created on 2013-09-02 13:38:28
         compiled from "/var/www/material/exten/admin/template/show.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:43367648152242454ceff38-87032224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2280ac8da2f7517401ee3f536a60b61432c24ec' => 
    array (
      0 => '/var/www/material/exten/admin/template/show.tpl.htm',
      1 => 1378092009,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43367648152242454ceff38-87032224',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52242454d5dff7_41564290',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52242454d5dff7_41564290')) {function content_52242454d5dff7_41564290($_smarty_tpl) {?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="cache-control" content="no-cache">
<title>提示信息</title>
<style type="text/css">
<!--
* {
margin:0;
padding:0;
}
body {
text-align:center;font-family:Arial, Helvetica, sans-serif,"宋体";
}
p {
font-size: 12px;
line-height:150%;
margin:5px;
background-color:#fff;
padding:8px;
}
h1 {
height:16px;
line-height:16px;
font-size:12px;
text-align:center;
background-color:#fafafa;

padding-top:5px;
}
.box_border {
margin:0 auto;
margin-top:80px;
border:1px solid #ddd;
width:450px;
background-color:#fafafa;
}
A:link {
	COLOR: #006;
	TEXT-DECORATION: none
}
A:visited {
	COLOR: #006;
	TEXT-DECORATION: none
}
A:hover {
	COLOR: #0033cc;
	TEXT-DECORATION: underline
}
-->
</style>
</head>
<body>
<div class="box_border">
<?php if ($_SESSION['MsgType']===1){?>

<h1>错误提示信息</h1>
<p><img src="exten/admin/resource/images/error.gif"><br><?php echo $_SESSION['MsgContent'];?>
<br />
<a href="<?php echo $_SESSION['Referer'];?>
">[点这里返回上一页]</a>

<?php }elseif($_SESSION['MsgType']===0){?>

<h1>操作完成提示信息</h1>
<p><img src='exten/admin/resource/images/success.gif'><br><?php echo $_SESSION['MsgContent'];?>
<br />
<a href='<?php echo $_SESSION['Referer'];?>
'>[如果您的浏览器没有刷新，请点击这里]</a>
<meta http-equiv='Refresh' content='3; URL=<?php echo $_SESSION['Referer'];?>
' />

<?php }else{ ?>
<h1>错误提示信息</h1>
<p><img src="exten/admin/resource/images/error.gif"><br>页面已过期<br />
<a href="javascript:history.go(-1);">[点这里返回上一页]</a>
<?php }?>
</div>
</body>
</html>
<?php }} ?>