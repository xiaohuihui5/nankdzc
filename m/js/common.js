/**
* localStorage数据缓存
*/
var storage = {
    //数据存入
    set: function(key, val) {
        if (!key) {
            return false;
        }
        localStorage.setItem(key, JSON.stringify(val));
        return true;
    },
    //数据获取
    get: function(key) {
        if (!key) {
            return;
        }
        var val = localStorage.getItem(key);
        try {
            return JSON.parse(val);
        } catch (ex) {}
    },
    //清除一项数据
    clear: function(key) {
        if (!key) return false;
        localStorage.removeItem(key);
        return 
    },
    //清楚全部数据
    clearAll: function() {
        localStorage.clear();
    }
};
    var cart = storage.get(cartid);
    if(!cart) {
        cart = {
            totalPrice:0,
            goods_id:[],
            goods_sl:[]
        };
    }
function initCartGoods() {
    var gid= cart.goods_id;
    var gsl= cart.goods_sl;
    var add_sl=0;//订货量非0品种数
    for(i in gid) {
        if(gid[i]) {
            $("input[goodsopid=_"+gid[i]+"]").val(gsl[i]);
        }
	if(gsl[i]!=0)
		add_sl+=1;
    }
    $("#cart_goods_num").html(add_sl);
    $("#cart_total_price").html('&yen;'+cart.totalPrice);
}
function initGoodsOp()//绑定事件
{
$("[goodsop]").on('tap',function() {
        var op = $(this).attr('goodsop');
	var goodsid = $(this).parent().attr('goodsid');
	var o = $("input[goodsopid=_"+goodsid+"]");
	var val = parseFloat(o.val());
	if(!val) val=0;
	switch (op) {
		case '+':
			val++;
			break;
		case '-':
			val--;
		if(val<=0) val=0;
			break;
		}
	o.val(val);
	o.trigger('change');
});
    $("input[goodsopid]").on('change', function() {
        var goodsid = $(this).attr('goodsopid').substr(1);
        var this_price= $(this).parent().attr('price');
	if($(this).val()=='')
		$(this).val(0);
        var count = parseFloat($(this).val());
	var gid= cart.goods_id;
	var gsl= cart.goods_sl;
	var must_add=true;//增加新品种
	var add_sl=0;//订货量非0品种数
	for(i in gid)
	{
	        if(gid[i]==goodsid)
		{
		var tmp=1*cart.totalPrice+(count-cart.goods_sl[i])*this_price;
		tmp=tmp.toFixed(2);
		cart.totalPrice=tmp;
		//cart.totalPrice=cart.totalPrice.toFixed(2);
		cart.goods_sl[i]=count;
		storage.set(cartid,cart);
		must_add=false;
		if(count!=0) add_sl+=1;
		}
		else if(gsl[i]!=0)
			add_sl+=1;
	}
	if(must_add)
	{
		add_sl+=1;
		cart.goods_id.push(goodsid);
		cart.goods_sl.push(count);
		var tmp=1*cart.totalPrice+this_price*count;
		tmp=tmp.toFixed(2);
		cart.totalPrice=tmp;
		storage.set(cartid,cart);
	}
	$("#cart_goods_num").html(add_sl);
//$("#cart_goods_num").html(cart.goods_id.length);
	$("#cart_total_price").html('&yen;'+cart.totalPrice);
//alert(count);
//        for(var i in goods) {
  //          if(goods[i].goodsid==goodsid) {       
//            }
//        }
    });
//$("input").focus(function(){
//alert($(this).val());
//	$(this).select();
//});
//    $("input[goodsopid]").focus(function() {
//	$(this).select();
//    });
//$("input:text").click(function(){
//$(this).select();
//});
}
function initFavoriteOp() {
    $("a[starid]").click(function() {
	var localIsFavorite = $(this).hasClass('clicked');
            if(localIsFavorite) {
                $(this).removeClass('clicked');
            }else {
                $(this).addClass('clicked');
            }
	$.post("I_XiadAjaxFavorite.php",{cpid:$(this).attr('starid')},
	function(data){
	}
	)
    });
}
initCartGoods();//初始赋值各个输入框
initGoodsOp();
initFavoriteOp();//常用
$('#order_checkout').click(function(){
//	var p_id='3,28,85,161,266';
//	var p_sl='5,100,56.5,58,56.5';
	var p_id='0';
	var p_sl='0';
	var gid= cart.goods_id;
	var gsl= cart.goods_sl;
	for(i in gid)
	{
		p_id=p_id+','+gid[i];
		p_sl=p_sl+','+gsl[i];
	}
	$('#prod_ids').val(p_id);
	$('#prod_num').val(p_sl);
	if(p_id=='')
		alert('请选择好品种下完单后再结算!'+p_id);
	else
		$("#tform").submit();
});
$("#btn_goods_list_search").click(function() {
        var k = $("#keywords").val();
        if(!k) {
            return false;
        }
        return location.href='./I_XiadSearch.php?k='+encodeURIComponent(k);
});
$("#btn_back").on('click', function() {
//        history.go(-1);
location.href='./I_Xiad.php';
});
$("#btn_fav").on('click', function() {
        location.href='./I_XiadFavorite.php';
})
//alert(cart.totalPrice);
//cart.totalPrice=101;
//cart.goods_id[0]=245;
//cart.goods_id[1]=174;
//cart.goods_id[2]=122;
//cart.goods_sl[0]=2.5;
//cart.goods_sl[1]=17.4;
//cart.goods_sl[2]=22;
//storage.set(cartid,cart);