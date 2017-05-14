// JavaScript Documen
Common = {
	url:"",
	imgurl:"",
}
$(function(){
	Common.imgurl="exten\/admin\/template\/style\/"+$("#cssstyle").val()+"\/images\/images\/";
	
	$("#navbar ul li").mouseover(function(){
		$(this).css("font-weight","600");
	})
	.mouseout(function(){
		$(this).css("font-weight","normal");
	})
})