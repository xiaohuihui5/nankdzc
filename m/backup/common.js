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
    for(i in gid) {
        if(gid[i]) {
            $("input[goodsopid=_"+gid[i]+"]").val(gsl[i]);
        }
    }
    $("#cart_goods_num").html(cart.goods_id.length);
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
        var count = parseFloat($(this).val());
	var gid= cart.goods_id;
	var gsl= cart.goods_sl;
	var must_add=true;//增加新品种
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
		}	
	}
	if(must_add)
	{
		cart.goods_id.push(goodsid);
		cart.goods_sl.push(count);
		var tmp=1*cart.totalPrice+this_price*count;
		tmp=tmp.toFixed(2);
		cart.totalPrice=tmp;
		storage.set(cartid,cart);
	}
    $("#cart_goods_num").html(cart.goods_id.length);
    $("#cart_total_price").html('&yen;'+cart.totalPrice);
//alert(count);
//        for(var i in goods) {
  //          if(goods[i].goodsid==goodsid) {       
//            }
//        }
    });
//    $("input[goodsopid]").focus(function() {
//	$(this).select();
//    });
//$("input").focus(function(){
//alert($(this).val());
//	$(this).selected;
//});
$("input:number").click(function(){
$(this).select();
});
}

initCartGoods();//初始赋值各个输入框
initGoodsOp();
//alert(cart.totalPrice);
//cart.totalPrice=101;
//cart.goods_id[0]=245;
//cart.goods_id[1]=174;
//cart.goods_id[2]=122;
//cart.goods_sl[0]=2.5;
//cart.goods_sl[1]=17.4;
//cart.goods_sl[2]=22;
//storage.set(cartid,cart);