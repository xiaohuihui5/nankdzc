$(function(){
	var nav_down = $("#nav_down");//菜单id
	var layer_bg = $("#layer_bg");//浮层背景id
	var commodity = "#commodity";//菜单商品分类id
	var region = "#region";//菜单区域选择id
	var commodity_list = "#commodity_list";//商品分类列表id
	var region_list = "#region_list";//区域选择列表id
	
	var screen_height = document.documentElement.clientHeight || window.innerHeight;
	var screen_width = document.documentElement.clientWidth || window.innerWidth;
	//初始高度
	$("body").height(screen_height);
	
	//初始浮框背景大小
	var nav_height = $(nav_down).height();
	$(layer_bg).width(screen_width);
	$(layer_bg).height(screen_height - nav_height);
	
	$(commodity).click(function(){
		if($(region_list).css("display") == "block") $(region_list).hide();
		else $(layer_bg).toggle();
		$(commodity_list).slideToggle();
	});
	$(region).click(function(){
		if($(commodity_list).css("display") == "block") $(commodity_list).hide();
		else $(layer_bg).toggle();
		$(region_list).slideToggle();
	});
	$(layer_bg).click(function(){
		$(commodity_list).slideUp();
		$(layer_bg).toggle();
		$(region_list).slideUp();
	});
});