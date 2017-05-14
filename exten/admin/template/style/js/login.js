// JavaScript Document
/*
 * 登陆页面
 * author:hxzhen
 * mail:hxzhen@email.biigrou
 */


$(function(){
	
	/*-----------------------------------------登陆页面--------------------------------------------------*/
	
	/*判断是否为第一次登陆
	  首次登陆提示邮箱激活，并显示用户名
	*/
	var paramvalue = getParam("longincount");
	if(paramvalue == "")
	{
		$("#firstloginMsg").html("");  //首次登陆提示邮箱激活，并显示用户名
	}
	else if(paramvalue == 0) 
	{ 
	    $("#firstloginMsg").html("连结已激活，请登录！"); 
		var checkname = getParam("checkname");
		$("#username").attr("value",checkname);
	}
	$("#loginContent input[type='text']").focus(function(){
		$(this).parent().find("span").html("");
	})
	$("#loginContent input[type='password']").focus(function(){
		$(this).parent().find("span").html("");
	})
	//刷新验证码
	$("#changekCode").click(function(){
		refreshCode();
	})
	//回车登录
	document.onkeydown=function(event) {
       e = event ? event :(window.event ? window.event : null);
       if(e.keyCode==13){  loginSubmit('form1'); }
  } 	
})

/*--登陆页面点击确定--*/
function loginSubmit(str)
{
	$(".formelements span").html("");//将错误提示信息置空
	var name = $("#username").val();
	var randCode = $("#randcode").val();
	var password = $("#pwinput").val();
	var timeNow=new Date().getTime();
	var passWord =$.md5(password);
	$("#pwmd5").attr("value",passWord);
	if(name == "请输入用户名" || name == "")
	{
		$("#usernameMsg").html("用户名不能为空");
		return;
	}
	else if(password == "")
	{
		$("#pwMsg").html("密码不能为空");
		return;
	}
	else if(randCode == "")
	{
		$("#randcodeMsg").html("验证码不能为空");
		return;
	}
	else
	{
		var pars =$("#"+str).serialize();
		var url ="?app=login&act=asyncLogin";
		$.ajax({
			url:url,
			type:"post",
			dataType:"json",
			data:pars,
			success:function(msg){
			    var error = msg.error;
				//成功
				if(error == 0)
				{
					//判断url，首次登陆需在首页显示修改密码提示
					var paramvalue = getParam("longincount");
					//非首次登陆
					if(paramvalue == "")
					{
						window.location.href="admin.php";
					}
					//首次登陆
					else
					{
				    	window.location.href="admin.php?longincount=0";
					}
				}
				//失败
				else if(error == 1)
				{
					$("#randcodeMsg").html(msg.data.ErrorMsg);
					//刷新验证码
					refreshCode(); 
					return; 
				}
				//登陆超时
				else
				{
					window.location.href="?app=login&act=loginShow"; 
				}
			},
			error:function(aa,bb,cc)
			{
				alert("提交失败！");
			}
		})
	}
}

/*刷新验证码*/
function refreshCode()
{
	var timeNow=new Date().getTime();
	var url = "?app=login&act=getAuthImage&t="+timeNow;
	$("#verPic").attr("src",url);
}  