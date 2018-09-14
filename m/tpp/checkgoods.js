$(function(){
	var screen_height = document.documentElement.clientHeight || window.innerHeight;
	$("body").height(screen_height);
	
	//changeProdCount(1);
	$(".radio-wrap .radio").click(function(){
		$(this).toggleClass("check");
		getCheckTotal();
	});
	//$(".btn-account").click(getCheckGoods);
});