$(function(){
	//初始高度
	var screen_height = document.documentElement.clientHeight || window.innerHeight;
	$("body").height(screen_height);
	
	//商品图片初始化
	var _pic = "#pic_wrap_";
	var _g_pic = "#pic_list_";
	var _pic_cls = ".pic-wrap";
	var show_count = 4;//初始显示数量不能小于或等于0
	var pic_width = $(_pic_cls + " .g-pic").eq(0).outerWidth(true);
	$(_pic_cls).each(function(i,obj){
		var count = $(_g_pic + i + " img").length;
		var pic_list_width = pic_width*count;
		$(_g_pic + i).width(pic_list_width);
		var pic_show_width = pic_width*show_count;
		$(_pic + i).width(pic_show_width);
		if(count > show_count){
			$(_g_pic + i + " .right-arrow").click(function(){
				var cur_left = parseFloat($(_g_pic + i).css("margin-left").replace("px"));
				var max_left =  pic_show_width - pic_list_width;
				var left = cur_left - pic_width;
				if( max_left <= left){
					$(_g_pic + i).animate({marginLeft: left + "px"},800);
				}
			});
		}
	});
});