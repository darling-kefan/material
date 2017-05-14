// JavaScript Document
//异步发送数据
function sentDate(url,data,functionName,obj)
{
	$.ajax({
		 	type: "POST",
			url: url,
			data: data,
			dataType: "json",
			success: function(data)
			{
				functionName(data,obj);
			},
			error:function(data){
				error(data);
			}
		});
}
//错误页面
function error(data)
{
	
}