var nav_wrap = "#nav_wrap";//菜单容器id
var main = "#main";//主体内容容器id
var container = "#container";//框架容器id
var nav_list = "#nav_list";//导航容器id>ul
var bottom_float = "#bottom_float";//底部浮层容器id
var goods_list = "#goods_list";//商品列表容器id
var screen_height = 0;
var screen_width = 0;
var max_screen_width = 640;//最大屏幕宽度
//$(function(){
	//var url = "js/index.json";
	//$.get(url,function(data){
function show(data){
		var json = eval('(' + data + ')');
		var category_size = json.length;
		var menulist = [];
		var navlist = [];
		var prodlist = [];
		for(var i=0;i<category_size;i++){
			var menu = {};
			//id:菜单分类id
			var menu_id = json[i]["fcategory_id"];
			//text:菜单分类id
			var menu_text = json[i]["fcategory_name"];
			menu = {
				"id":menu_id,
				"text":menu_text
			}
			menulist.push(menu);
			
			//导航列表
			var category_list = json[i]["category_list"];
			for(var j=0;j<category_list.length;j++){
				var nav = {};
				//id:导航分类id
				var nav_id = category_list[j]["scategory_id"];
				//text:导航分类id
				var nav_text = category_list[j]["scategory_name"];
				//pid:父菜单id
				var nav_pid = menu_id;
				//isShow:是否显示(菜单初始化默认显示第一个)
				var nav_is_show = (i==0)?true:false;
				nav = {
					"id":nav_id,
					"text":nav_text,
					"pid":nav_pid,
					"isShow":nav_is_show
				};
				navlist.push(nav);
				
				//商品列表
				var prod_list = category_list[j]["prodlist"];
				for(var k=0;k<prod_list.length;k++){
					var prod_id = prod_list[k]["id"];//商品id
					var prod_text = prod_list[k]["prod_name"];//商品文字
					var prod_pid = nav_id;//父导航id
					var prod_isShow = (i==0 && j==0)?true:false;//是否显示
					var prod_couponPrice = prod_list[k]["coupon_price"];//优惠单价
					var prod_price = prod_list[k]["price"];//单价
					var prod_imgPath = prod_list[k]["prod_img"];//图片
					var prod_unit = prod_list[k]["unit"];//单位
					var desc = prod_list[k]["description"];//单位
					var prod = {
						"id":prod_id,
						"text":prod_text,
						"pid":prod_pid,
						"isShow":prod_isShow,
						"couponPrice":prod_couponPrice,
						"price":prod_price,
						"desc":desc,
						"imgPath":prod_imgPath,
						"unit":prod_unit
					};
					prodlist.push(prod);
				}
			}
		}
		initNavBarList(menulist);
		initNavList(navlist);
		initProdList(prodlist);
	//});
}
//});

/* 
	添加横向菜单
	menulist{
		id:菜单分类id
		text:菜单分类文字
	}
*/
var initNavBarList = function(menulist){
	var checked_classname = "active";
	for(var i=0;i<menulist.length;i++) {
		var id = menulist[i]["id"];//菜单分类id
		var text = menulist[i]["text"];//菜单分类文字
		//初始化第一个分类为选中
		var checked = (i==0)?checked_classname:"";
		$(nav_wrap).append(
			$("<li>").addClass(checked).attr("id",id).append(
				$("<span>").text(text)
			)
		);
	}
	var nav_width = 0;
	$(nav_wrap).children("li").each(function(){
		nav_width += $(this).outerWidth();
	});
	$(nav_wrap).width(nav_width);
	$(nav_wrap + " li").click(function(){switchMenu(this)});
};

/* 
	添加导航
	navlist{
		id:导航分类id
		text:导航分类文字
		pid:父菜单id
		isShow:是否显示
	}
*/
var initNavList = function(navlist){
	var checked_classname = "active";
	var mark_checked = false;
	for(var i=0;i<navlist.length;i++) {
		var id = navlist[i]["id"];//导航分类id
		var text = navlist[i]["text"];//导航分类文字
		var pid = navlist[i]["pid"].toString();//父菜单id
		var isShow = navlist[i]["isShow"];//是否显示
		//初始化显示的第一个分类为选中
		var checked = "";
		if(isShow && !mark_checked){
			checked = checked_classname;
			mark_checked = true;
		}
		var show = isShow?"block":"none";
		var nav_html = $(nav_list).children("ul").append(
			$("<li>").addClass(checked).addClass(pid).attr("id",id).append(
				$("<span>").addClass("nav-title").text(text)
			).css("display",show)
		);
	}
	resizeScreen();
	$(nav_list + " li").click(function(){switchNav(this)});
};

function resizeScreen(){
	var bottom_float_height = $(bottom_float).outerHeight();
	var nav_wrap_height = $(nav_wrap + " li").outerHeight();
	$(container).height(screen_height - nav_wrap_height - bottom_float_height);
	$(main).height(screen_height - nav_wrap_height - bottom_float_height);
	$("body").height(screen_height - bottom_float_height);
}

/* 
	添加导航
	prodlist{
		id:商品id
		text:商品文字
		pid:父导航id
		isShow:是否显示
		couponPrice:优惠单价
		price:单价
		imgPath:图片
		unit:单位
	}
*/
var initProdList = function(prodlist){
	for(var i=0;i<prodlist.length;i++) {
		var id = prodlist[i]["id"];//商品id
		var text = prodlist[i]["text"];//商品文字
		var pid = prodlist[i]["pid"].toString();//父导航id
		var isShow = prodlist[i]["isShow"];//是否显示
		var couponPrice = prodlist[i]["couponPrice"];//优惠单价
		var price = prodlist[i]["price"];//单价
		var imgPath = prodlist[i]["imgPath"];//图片
		var unit = prodlist[i]["unit"];//单位
		var desc = '';//描述
		var show = isShow?"block":"none";
		var text_split = "/";//品名与单位分割字符
		if(prodlist[i]["desc"]){
			desc = ("<B>描述：</B>"+prodlist[i]["desc"]);
			
		}
		$(goods_list).append(
			$("<div>").addClass("goods").addClass("simple-goods").addClass(pid).attr("id",id).append(
				$("<div>").addClass("pic-wrap").append(
					$("<img>").attr("src",imgPath)
				)
			).append(
				$("<div>").addClass("goods-info").append(
					$("<div>").addClass("title").text(
						text
					)
				).append(
					$("<div>").addClass("price-info").append(
						$("<div>").addClass("price").text("￥").append(
							//$("<span>").addClass("num").text(price)
								$("<span>").addClass("num").text(couponPrice + text_split + unit)
						).append(
							//$("<span>").addClass("coupon").text(couponPrice)
								//$("<span>").addClass("coupon").text(price)
						)
					).append(
						$("<span>").addClass("count").append(
							$("<a>").addClass("plus")
						).append(
							$("<span>").addClass("count-input").append(
								$("<input>").attr("type","text").addClass("txt")
							).append(
								$("<a>").addClass("minus")
							)
								//).css("display","none")
						)
					).append(
						$("<div>").addClass("clearfix")
					)
				)
			).append(
					$("<div>").addClass("desc").html(desc).css({'color':'#666','font-size':'x-small','float':'left','padding-top':'5px'})
			).append(
				$("<div>").addClass("clearfix")
			).css("display",show)
		);
	}
	//changeProdCount(0);
};

/*
	切换菜单
*/
var switchMenu = function(obj){
	var pos_left = $(obj).position().left;
	var width = $(obj).outerWidth();
	var currentLeft = pos_left + width;
	if(currentLeft > screen_width) {
		var currScrollLeft = $(nav_wrap).parent(".nav-bar").scrollLeft();
		var scrollLeft = currScrollLeft + (currentLeft - screen_width);
		$(nav_wrap).parent(".nav-bar").scrollLeft(scrollLeft);
	}
	else if(pos_left < 0) {
		var currScrollLeft = $(nav_wrap).parent(".nav-bar").scrollLeft();
		var scrollLeft = currScrollLeft + pos_left;
		$(nav_wrap).parent(".nav-bar").scrollLeft(scrollLeft);
	}
	
	if(!$(obj).hasClass("active")){
		//选中当前
		$(obj).siblings("li").removeClass("active");
		$(obj).addClass("active");
		//显示对应导航
		var menu_id = "." + $(obj).attr("id");
		$(nav_list + " ul li").hide();
		$(nav_list + " ul li" + menu_id).show();
		//切换到导航第一个
		if($(nav_list + " ul li" + menu_id).length < 1) $(goods_list + " .simple-goods").show();
		$(nav_list + " ul li").removeClass("active");
		$(nav_list + " ul li" + menu_id).eq(0).click();
	}
};

/*
	切换导航
*/
var switchNav = function(obj){
	//选中当前
	$(obj).siblings("li").removeClass("active");
	$(obj).addClass("active");
	//显示对应导航
	var nav_id = " ." + $(obj).attr("id");
	$(goods_list + " .simple-goods").css("display","none");
	$(goods_list + nav_id).show();

};
