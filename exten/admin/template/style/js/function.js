// JavaScript Document

$(function(){
	/*
	 * 公共方法，同步左部和右部高度，使其等高
	 */
	setHeight();
	
	/*左部导航相关操作*/
	actLeftBar();
	/*管理列表的全选功能*/
	actCheckbox();
})
function setHeight()
{
 	var leftHeight = $(".leftspan").height();
	var rightHeight = $(".rightspan").height();
	if(leftHeight > rightHeight)
	{
		$(".rightspan").css("min-height",leftHeight).css("height",leftHeight);
 	}
	else if(leftHeight < rightHeight)
	{
		$(".leftspan").css("min-height",rightHeight).css("height",rightHeight);
	}
}

function actLeftBar()
{
	//悬浮状态
	$(".leftspan .leftspanchild a").mouseover(function(){
		if(!$(this).parent().parent().hasClass("selected"))
		{
			if($(this).siblings("img").hasClass("listclosed"))
			{
				$(this).siblings("img").attr("src","exten/admin/template/images/images/leftwhite2.png");
			}
			else
			{
				$(this).siblings("img").attr("src","exten/admin/template/images/images/leftwhite1.png");
			}
		}
	})
	.mouseout(function(){
		if(!$(this).parent().parent().hasClass("selected"))
		{
			if($(this).siblings("img").hasClass("listclosed"))
			{
				$(this).siblings("img").attr("src","exten/admin/template/images/images/leftblue2.png");
			}
			else
			{
				$(this).siblings("img").attr("src","exten/admin/template/images/images/leftblue1.png");
			}
		}
	})
	//如果子集选中，则父级导航展开
	$(".secondchild").each(function(index, element) {
        if($(this).hasClass("selected"))
		{
			$(this).parent().siblings("label").find("img").attr("src","exten/admin/template/images/images/leftblue1.png"); 
			$(this).parent().siblings("label").find("img").addClass("listopened").removeClass("listclosed");
			var img = $(this).parent().siblings("label").find("img");
			img.unbind("click").bind("click",function(){open(img)});
			$(this).parent().show();
			setHeight();
		}
    });
	//展开
	$(".listclosed").click(function(){
		open(this);
	})
	//合并
	$(".listopened").click(function(){
		close(this);
	})
	var open = function(index){
		if(!$(index).parent().parent().hasClass("selected"))
		{
			$(index).attr("src","exten/admin/template/images/images/leftblue1.png");
		}
		else
		{
			$(index).attr("src","exten/admin/template/images/images/leftwhite1.png");
		}
		$(index).parent().siblings("ul").show();
		$(index).addClass("listopened").removeClass("listclosed");
		$(index).unbind("click").bind("click",function(){close(index);});
		setHeight();
	}
	var close = function(index){
		if(!$(index).parent().parent().hasClass("selected"))
		{
			$(index).attr("src","exten/admin/template/images/images/leftblue2.png");
		}
		else
		{
			$(index).attr("src","exten/admin/template/images/images/leftwhite2.png");
		}
		$(index).parent().siblings("ul").hide();
		$(index).addClass("listclosed").removeClass("listopened");
		$(index).unbind("click").bind("click",function(){open(index);});
		setHeight();
	}
}

function actCheckbox()
{
	//序号部分的全选功能
	$("#allCb").click(function(){
		if($(this).attr("checked") == "checked")
		{
			$(".singalCb").attr("checked","checked");
		}
		else
		{
			$(".singalCb").removeAttr("checked");
		}
	})
	//单个选择判断是否全选
	$(".singalCb").click(function(){
		if($(this).attr("checked") == "checked")
		{
			var len = $(".singalCb").length;
			var count = 0;
			$(".singalCb").each(function(index, element) {
                if($(this).attr("checked") == "checked")
				{
					count++;
				}
            });
			if(count == len)
			{
				$("#allCb").attr("checked","checked");
			}
		}
		else
		{
			$("#allCb").removeAttr("checked");
		}
	})
}

/*----------- 判断输入是否是一个由 0-9 / A-Z / a-z 组成的字符串 --------------*/ 
function isalphanumber(str) 
{ 
    var result=str.match(/^[a-zA-Z0-9]+$/); 
    if(result==null) 
	{
		return false; 
	}
    return true; 
} 

/*------------------------------获取url参数--------------------------------*/
function getParam(paramName)
{
    paramValue = "";
    isFound = false;
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=")>1)
    {
        arrSource = unescape(this.location.search).substring(1,this.location.search.length).split("&");
        i = 0;
        while (i < arrSource.length && !isFound)
        {
            if (arrSource[i].indexOf("=") > 0)
            {
                 if (arrSource[i].split("=")[0].toLowerCase()==paramName.toLowerCase())
                 {
                    paramValue = arrSource[i].split("=")[1];
                    isFound = true;
                 }
            }
            i++;
        }   
    }
    return paramValue;
}

/*------------------------邮箱格式验证----------------------------------*/
function isEmail(strEmail) {
   if (strEmail.search(/^[\w\-]+@[\w\-]+\.\w{2,}(\.\w{2,})?$/) != -1)
   {
       return true;
   }
   else
   {
       return false;
   }
}

/*-------------------------手机格式验证-------------------------*/
function isCellphone(strPhone)
{
	  var tmp = /^1[3-9]\d{9}$/;     
      var flag=tmp.test(strPhone); 
	  return flag; 
      
}
/*-- 异步传输验证 --*/
function ajaxPost(url,doFunction,pars)
{
	$.ajax({
	    type:"post",
	    url:url,
		data:pars,
		dataType:"json",
		success:function(msg)
	    {
		   doFunction(msg);
		},
		error:function()
	    {
		   alert("验证失败！");
	    }
	})
}

/*
 * Ajax获取厂商，类型，类别列表
 * url      : ajax传输地址
 * boxid    ：添加列表的容器id
 * pars     : 传输参数
 * dataname ：传输类型的名称
 * flag     : 标志位，用于表示是否选中新增加的选项  
 */
function ajaxGetList(url,boxid,pars,dataname,flag)
{
	var data = "";
	if(dataname != "")
	{
		data = dataname+"="+pars;
    }
	 $.ajax({
		type:"post",
	    url:url,
		data:data,
		dataType:"json",
		success:function(msg)
	    {
		    var List = msg.data;
		    //将获取的厂商添加到列表中
            appendtoSelect(List,boxid,flag);
		},
		error:function()
	    {
		   alert("验证失败！");
		   return;
	    }
	})
}

/*--将获取到的id，和name添加到页面的select表单中--*/
/*
 * list:      ajax获取的数据列表
 * selectId： 需要添加数据的下拉框的id
 * type:      factory:表示厂商列表
              type   :类别
			         :类型
 */
function appendtoSelect(list,selectId,flag)
{
	var id = "";
	var name = "";
	var strhtml = "";
	var length = 0;
	var isEdit = false;
	var dataId = "";
	//解析
	var type = selectId.slice(0,-6);
	length = list.length;
	//清楚原有的select选项
	$("#"+selectId).find("option:gt(0)").remove();
	//判断是否为修改型号页面
	if($("#isEdit").val() == "edit")
	{
		isEdit = true;
		dataId = $("#"+selectId).attr("data-id");
	}
	 //厂商
	if(type == "DeviceFactory")
	{
		
	    for(var index=0; index<length; index++)
	    {
	    	id = list[index].DeviceFactoryID;
	    	name = list[index].DeviceFactoryName;
			if(dataId == id)
			{
				strhtml = strhtml+"<option value="+id+" selected='selected'>"+name+"</option>";
			}
			else
			{
				strhtml = strhtml+"<option value="+id+">"+name+"</option>";
			}
	    }
	   
	}
	//类别
	else if(type == "DeviceCategory")
	{
		for(var index=0; index<length; index++)
	    {
	    	id = list[index].DeviceCategoryID;
	    	name = list[index].DeviceCategoryName;
			if(dataId == id)
			{
				strhtml = strhtml+"<option value="+id+" selected='selected'>"+name+"</option>";
			}
			else
			{
				strhtml = strhtml+"<option value="+id+">"+name+"</option>";
			}
	    }
	}
	//类型
	else
	{
		for(var index=0; index<length; index++)
	    {
	    	id = list[index].DeviceTypeID;
	    	name = list[index].DeviceTypeName;
			if(dataId == id)
			{
				strhtml = strhtml+"<option value="+id+" selected='selected'>"+name+"</option>";
			}
			else
			{
				strhtml = strhtml+"<option value="+id+">"+name+"</option>";
			}
	    }
	}
	//判断是否选中新添加的选项
	if(flag != true)
	{
		$("#"+selectId).append(strhtml);
	}
	//关闭弹出窗口后选中新添加的厂商、或类型或类别
	else
	{
		$(parent.document.body).find("#"+selectId).html("");
		$(parent.document.body).find("#"+selectId).append(strhtml);
	    $(parent.document.body).find("#"+selectId).find("option:last").attr("selected","selected");
	}
}

/*
 * 弹出iframe层
 *
 * dialogObj = {
			'width' : width,  //弹出层宽度
			'height': height, //弹出层高度
			'boxid' : box,    //弹出层容器
			'url'   : url,    //要显示在iframe中的页面地址
			'title' : title   //标题
		}
 *
 */
function showifDialog(dialogObj)
{
	//弹出层居中
	var scrollHeight = $(document).scrollTop(),
	windowHeight = $(window).height(),
	windowWidth = $(window).width(),
	boxHeight = dialogObj.height,
	boxWeight = dialogObj.width;
	posiTop = (windowHeight - boxHeight)/2 + scrollHeight;
	posiLeft = (windowWidth - boxWeight)/2;
	//设置position
	$("#frmePanel").css("width",dialogObj.width).css("height",dialogObj.height);
	$("#frmePanel").css({"left": posiLeft + "px","top":posiTop + "px","display":"block"});
	$("#iframebox").css("min-height",dialogObj.height)
	$("#titlediv").css("width",dialogObj.width-24);
	$("#frmePanel .bottombg").css("width",dialogObj.width-20);
	
	$("#frmePanel").show();
	$("#iframebox").attr("src",dialogObj.url);
	//隐藏继续添加按钮和头部按钮;
	$("#iframebox").load(function(){
		var iframedoc = $("#iframebox").contents();
		iframedoc.find(".continueAddBtn").hide();
		iframedoc.find(".main_header").hide();
		//设置标志位class="inframe"用于表示此页面是在弹出层的iframe框架中
		iframedoc.find("#isIframe").attr("value","inframe");
		iframedoc.find(".main").css("width","auto");
		//为按钮添加样式
		if(!iframedoc.find(".btn").hasClass(".btnmargin"))
		{
			iframedoc.find(".btn").addClass("btnmargin");
		}
	})
	$("#frmePanel").find("#title").html(dialogObj.title);
	
	$("#closebtn").click(function(){
		$("#frmePanel").hide();
		$("#coverlayer").hide();
		$("#iframebox").attr("src","");
	})
	$("#coverlayer").css("height",document.body.scrollHeight+"px");
	$("#coverlayer").show();
	//alert(document.body.scrollHeight);
}

//重新发送邮件
/*
 * passport :  新建的用户名 
 * email    ：  邮件地址
 * password ：  新建用户时生成的随机密码
 * failCount：  发送邮件失败的次数，如果大于3次，则不再提示重新发送
 */
function reSendMail(passport,email,password,failCount)
{
	$('#dialog p .blueUnderLine').html("邮件正在发送..."); 
	var pars = "passport="+passport+"&email="+email+"&password="+password;
	 $.ajax({
		type:"post",
		url:"?app=user&act=sendMailForUserAgain",
		data:pars,
		dataType:"json",
		success:function(msg){
			$('#dialog').dialog('close');
			if(msg.error == 0)
			{
				$('#mailDialog p').html(msg.msg);
				$('#mailDialog').dialog('open');
			}
			else if(msg.error == 1)
			{
				if(failCount<3)
				{
					$('#dialog p').html(msg.msg);
					$('#dialog p').append("<span class='blueUnderLine' onclick='reSendMail(\""+passport+"\",\""+email+"\",\""+password+"\","+failCount+1+")'>重新发送</span>");
					$('#dialog').dialog('open');
				}
				//结束邮件发送进程
				else
				{
					$('#mailDialog p').html("邮件发送不成功，请联系管理员");
					$('#mailDialog').dialog('open');
				}
			}
			else if(msg.msg == 2)
			{
				window.location.href="?app=login&act=loginShow";
			}
			
		}
	})
}

