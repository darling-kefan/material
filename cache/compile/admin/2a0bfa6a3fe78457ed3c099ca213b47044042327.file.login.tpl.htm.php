<?php /* Smarty version Smarty-3.1.14, created on 2013-09-02 13:38:30
         compiled from "/var/www/material/exten/admin/template/login.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1070274848522424567d4122-28328895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a0bfa6a3fe78457ed3c099ca213b47044042327' => 
    array (
      0 => '/var/www/material/exten/admin/template/login.tpl.htm',
      1 => 1377965468,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1070274848522424567d4122-28328895',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_Title' => 0,
    '_Setting' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52242456824753_17197218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52242456824753_17197218')) {function content_52242456824753_17197218($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_Title']->value;?>
</title>
<link type="text/css" rel="stylesheet" href="exten/admin/template/style/default/images/style.css">
<link type="text/css" rel="stylesheet" href="exten/admin/template/style/default/images/login.css">
<script type="text/javascript" src="exten/admin/template/style/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="exten/admin/template/style/js/jquery-md5.js"></script>
<script type="text/javascript" src="exten/admin/template/style/js/function.js"></script>
<script type="text/javascript" src="exten/admin/template/style/js/common.js"></script>
<script type="text/javascript" src="exten/admin/template/style/js/login.js"></script>
</head>

<body>
<div id="loginContent">
	<div id="header">
    	<div id="loginLogo"></div>
    </div>
    <div id="loginBody">
    	<div id="loginPic"></div>
        <div id="loginForm">
            <div id="headerTitle">
                <span id="firstloginMsg"></span>
            </div>
            <form method="post" id="form1" name="form1">
            <table id="loginTable">
                    <tr>
                        <td class="formtype">用户名：</td>
                        <td class="formelements">
                            <input type="text" name="passport" maxlength="24"  id="username" class="textinput">
                            <span id="usernameMsg" class="textMsg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="formtype">密码：</td>
                        <td class="formelements">
                            <input type="hidden" name="password" id="pwmd5">
                            <input type="password" id="pwinput" class="textinput" ><span  id="pwMsg" class="textMsg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="formtype">验证码：</td>
                        <td class="formelements">
                            <input type="text" name="authcode" size="5" class="textinput" id="randcode">
                            <img id="verPic" src="?app=login&act=getAuthImage" class="vertical"/> <a href="#" id="changekCode" class="vertical">看不清，换一张</a>
                            <span class="textMsg" id="randcodeMsg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="formtype"></td>
                        <td class="formelements"></span><input type="button" onclick="loginSubmit('form1')" id="subBtn"></td>
                    </tr>
                </table>
                </form>
        </div>
    </div>
    <div id="footer">
    	<?php echo $_smarty_tpl->tpl_vars['_Setting']->value['Footer'];?>

    </div>
</div>
</body>
</html><?php }} ?>