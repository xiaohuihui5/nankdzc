var nav_wrap = "#nav_wrap";//�˵�����id
var main = "#main";//������������id
var container = "#container";//�������id
var nav_list = "#nav_list";//��������id>ul
var bottom_float = "#bottom_float";//�ײ���������id
var goods_list = "#goods_list";//��Ʒ�б�����id
var screen_height = 0;
var screen_width = 0;
var max_screen_width = 640;//�����Ļ���
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
			//id:�˵�����id
			var menu_id = json[i]["fcategory_id"];
			//text:�˵�����id
			var menu_text = json[i]["fcategory_name"];
			menu = {
				"id":menu_id,
				"text":menu_text
			}
			menulist.push(menu);
			
			//�����б�
			var category_list = json[i]["category_list"];
			for(var j=0;j<category_list.length;j++){
				var nav = {};
				//id:��������id
				var nav_id = category_list[j]["scategory_id"];
				//text:��������id
				var nav_text = category_list[j]["scategory_name"];
				//pid:���˵�id
				var nav_pid = menu_id;
				//isShow:�Ƿ���ʾ(�˵���ʼ��Ĭ����ʾ��һ��)
				var nav_is_show = (i==0)?true:false;
				nav = {
					"id":nav_id,
					"text":nav_text,
					"pid":nav_pid,
					"isShow":nav_is_show
				};
				navlist.push(nav);
				
				//��Ʒ�б�
				var prod_list = category_list[j]["prodlist"];
				for(var k=0;k<prod_list.length;k++){
					var prod_id = prod_list[k]["id"];//��Ʒid
					var prod_text = prod_list[k]["prod_name"];//��Ʒ����
					var prod_pid = nav_id;//������id
					var prod_isShow = (i==0 && j==0)?true:false;//�Ƿ���ʾ
					var prod_couponPrice = prod_list[k]["coupon_price"];//�Żݵ���
					var prod_price = prod_list[k]["price"];//����
					var prod_imgPath = prod_list[k]["prod_img"];//ͼƬ
					var prod_unit = prod_list[k]["unit"];//��λ
					var desc = prod_list[k]["description"];//��λ
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
	��Ӻ���˵�
	menulist{
		id:�˵�����id
		text:�˵���������
	}
*/
var initNavBarList = function(menulist){
	var checked_classname = "active";
	for(var i=0;i<menulist.length;i++) {
		var id = menulist[i]["id"];//�˵�����id
		var text = menulist[i]["text"];//�˵���������
		//��ʼ����һ������Ϊѡ��
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
	��ӵ���
	navlist{
		id:��������id
		text:������������
		pid:���˵�id
		isShow:�Ƿ���ʾ
	}
*/
var initNavList = function(navlist){
	var checked_classname = "active";
	var mark_checked = false;
	for(var i=0;i<navlist.length;i++) {
		var id = navlist[i]["id"];//��������id
		var text = navlist[i]["text"];//������������
		var pid = navlist[i]["pid"].toString();//���˵�id
		var isShow = navlist[i]["isShow"];//�Ƿ���ʾ
		//��ʼ����ʾ�ĵ�һ������Ϊѡ��
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
	��ӵ���
	prodlist{
		id:��Ʒid
		text:��Ʒ����
		pid:������id
		isShow:�Ƿ���ʾ
		couponPrice:�Żݵ���
		price:����
		imgPath:ͼƬ
		unit:��λ
	}
*/
var initProdList = function(prodlist){
	for(var i=0;i<prodlist.length;i++) {
		var id = prodlist[i]["id"];//��Ʒid
		var text = prodlist[i]["text"];//��Ʒ����
		var pid = prodlist[i]["pid"].toString();//������id
		var isShow = prodlist[i]["isShow"];//�Ƿ���ʾ
		var couponPrice = prodlist[i]["couponPrice"];//�Żݵ���
		var price = prodlist[i]["price"];//����
		var imgPath = prodlist[i]["imgPath"];//ͼƬ
		var unit = prodlist[i]["unit"];//��λ
		var desc = '';//����
		var show = isShow?"block":"none";
		var text_split = "/";//Ʒ���뵥λ�ָ��ַ�
		if(prodlist[i]["desc"]){
			desc = ("<B>������</B>"+prodlist[i]["desc"]);
			
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
						$("<div>").addClass("price").text("��").append(
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
	�л��˵�
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
		//ѡ�е�ǰ
		$(obj).siblings("li").removeClass("active");
		$(obj).addClass("active");
		//��ʾ��Ӧ����
		var menu_id = "." + $(obj).attr("id");
		$(nav_list + " ul li").hide();
		$(nav_list + " ul li" + menu_id).show();
		//�л���������һ��
		if($(nav_list + " ul li" + menu_id).length < 1) $(goods_list + " .simple-goods").show();
		$(nav_list + " ul li").removeClass("active");
		$(nav_list + " ul li" + menu_id).eq(0).click();
	}
};

/*
	�л�����
*/
var switchNav = function(obj){
	//ѡ�е�ǰ
	$(obj).siblings("li").removeClass("active");
	$(obj).addClass("active");
	//��ʾ��Ӧ����
	var nav_id = " ." + $(obj).attr("id");
	$(goods_list + " .simple-goods").css("display","none");
	$(goods_list + nav_id).show();

};
