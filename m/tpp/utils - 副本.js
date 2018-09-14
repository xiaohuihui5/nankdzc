var screen_height = 0;
var screen_width = 0;
var max_screen_width = 640;//�����Ļ���
$(function(){
	screen_height = document.documentElement.clientHeight || window.innerHeight;
	screen_width = document.documentElement.clientWidth || window.innerWidth;
	$("body").height(screen_height);
	if(typeof(resizeScreen)!="undefined" && $.isFunction(resizeScreen)){
		$(window).resize(function () {          //���������С�仯ʱ
			screen_height = document.documentElement.clientHeight || window.innerHeight;
			screen_width = document.documentElement.clientWidth || window.innerWidth;
			$("body").height(screen_height);
			resizeScreen();
		});
	}
});

/*
	�ı���Ʒ����
*/
//	$(".count .plus").click(function(){
//		var count_input = $(this).parent(".count").children(".count-input");
//			var val = $(count_input).children("input[type=text]").val();
//				val = parseInt(val) + 1;
//			$(count_input).children("input[type=text]").val(val);
//			getCheckTotal();
//			
//			var prod_id = $(count_input).children("input[type=hidden]").val();
//			modifyAjax(val,prod_id);
//	});
//	$(".count .minus").click(function(){
//		var input = $(this).siblings("input[type=text]");
//		var val = input.val();
//		if(val>0) val = parseInt(val) - 1;
//		if(val==0){
//			val = 1;
//			alert("��������Ϊ1")
//		}
//		$(input).val(val);
//		getCheckTotal();
//		var prod_id = $(this).siblings("input[type=hidden]").val();
//		modifyAjax(val,prod_id);
//	});
//};

function modifyAjax(num,prod_id){
	 jQuery.ajax( {
			url : '/m/shopping/modifyCartNum',
			type : 'GET',
			data : {
				isAjax : true,
				num : num,
				prod_id : prod_id
			},
			dataType : 'json',
			error : function() {
				showMsg('�������ִ���');
			},
			success : function(data) {
				
			}
		});
}
/*
	��ȡ��Ʒ�ܼ�
*/
function getCheckTotal(){
	var total = 0.00;
	var totalCount = 0;
	var isRadio = $(".goods-wrap .radio").length>0?true:false;
	$(".goods-wrap").each(function(){
		if(isRadio){
			var shop_total = 0;
			$(this).find(".radio.check").each(function(){
				var count = parseInt($(this).parents(".goods").find(".count .count-input input[type=text]").val());
				var price = parseFloat($(this).parents(".goods").find(".price .num").text()).toFixed(2);
				shop_total += price*count;
			});
			$(this).find(".shop-total").text(parseFloat(shop_total).toFixed(2));
			total += shop_total;
		}else{
			$(this).find(".goods").each(function(){
				var count = parseInt($(this).find(".count .count-input input[type=text]").val());
				totalCount += count;
				var price = parseFloat($(this).find(".price .num").text()).toFixed(2);
				total += price*count;
			});
		}
	});
	$(".total").text(parseFloat(total).toFixed(2));
	$('#total_price').val(parseFloat(total).toFixed(2));
	$(".cart .count").text(totalCount);
}

//��ȡѡ�е���Ʒ
function getCheckGoods(){
	var account_info = {};
	var shopping_info = [];
	$(".goods-wrap").each(function(){
		var shopping_id = $(this).attr("value");//�̵�id
		var account = 0;//һ�����ڣ��ϼ�
		var goods = [];//һ���̶����Ʒ
		var goods_info = {};//��Ʒ��Ϣ
		var shopping = {};//������Ϣ
		$(this).find(".radio.check").each(function(){
			var price =  parseFloat($(this).parents(".goods").find(".price>span").text());//����
			var count = $(this).parents(".goods").find(".count>.count-input>input[type=text]");
			goods_info["goodsId"] = $(this).parents(".goods").attr("value");
			goods_info["price"] = price;
			goods_info["count"] = count;
			account += (price*count);
			goods.push(goods_info);
		});
		shopping["shoppingId"] = shopping_id;
		shopping["total"] = parseFloat(account).toFixed(2);
		shopping["goodsinfo"] = goods;
		shopping_info.push(shopping);
	});
	account_info["info"] = shopping_info;
	return account_info;
}