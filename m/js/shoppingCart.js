/**
 * Created by maxteng on 15/5/10.
 */
//total price

var goodsStock = goodsStock||{};
var userid = storageGetUid();

if(!userid) {
    userid=0;
}
var cartid = 'cart_'+userid;

function storageGetCartInfo(userid) {
    cartid = 'cart_'+userid;
    console.log(cartid);
    var cart = storage.get(cartid);
    if(!cart) {
        cart = {
            userid:userid,
            totalPrice:0,
            goods:[],
            goodsCnt:0
        };
    }
    storageSetCartInfo(userid, cart);
    return cart;
}
function storageSetCartInfo(userid, cart) {
    var cartid = 'cart_'+userid;
    return storage.set(cartid, cart);
}

cart = storageGetCartInfo(userid);

cart.clear = function() {
    var cartid = 'cart_'+userid;
    return storage.clear(cartid);
}

cart.reset = function()
{
    cart.goods = [];
    cart.goodsCnt = 0;
    cart.totalPrice = 0;
}
/**
 * goodsid
 *  count
 *  price
 *  priceversion
 *  totalPrice
 * @param goodsid
 * @param price
 * @param priceVersion
 */

cart.modify = function(goods, count) {
    var goodsid = goods.goodsid;
    var price = goods.price;
    var priceVersion = goods.versionID;

    var id = cart.findGoods(goodsid);
    count = parseInt(count);
    if(count<0 || isNaN(count)) {
        count = 0;
    }
    if(id===false && count<=0) {
        console.log('no goods id'+goodsid);
        return false;
    }
    var isnew = false;
    if(id===false) {
        if(count>0) {
            //初始化一个商品 count=0
            cart._initOneGoods(goods);
            id=cart.findGoods(goodsid);
            isnew = true;
        }else {
            //不合法的操作
            count = 0;
            return false;
        }
    }

    //库存不够
    if(goodsStock['_'+goodsid]!=undefined && goodsStock['_'+goodsid]<count) {
        count = goodsStock['_'+goodsid];
        _alert("商品库存不足");
    }

    //超过购买数量
    if(count>goods.buylimit) {
        count = goods.buylimit;
        _alert("超过最大购买数量 " + count);
    }

    if(count==0) {
        cart._remove(id, price, priceVersion);
        if(goodsStock["_"+goodsid]) {
            $("[goods_stock_id=_"+goodsid+"]").html(goodsStock["_"+goodsid]-count);
        }
    }else {
        if(isnew || cart.goods[id].price!=price || cart.goods[id].booknum != count) {
            if(cart.goods[id].booknum != count) {
                cart.goods[id].booknum = count;
            }
            cart._updateGoodsTotalPrice(id, price, priceVersion);
        }
    }


    changeCartStatusDisplay();
    if(goodsStock["_"+goodsid]) {
        $("[goods_stock_id=_"+goodsid+"]").html(goodsStock["_"+goodsid]-count);
    }
    return count;
}

cart._initOneGoods = function(goods) {
    /*
    var o = {
        booknum:0,
        totalPrice:0,
        goodsid:goods.goodsid,
        goodsname:goods.goodsname,
        price:goods.price,
        versionID:goods.versionID,
        isreserve:goods.isreserve,
        imageURL:goods.imageURL,
        buylimit:goods.buylimit,
        todayOrderNum:goods.todayOrderNum
    };
    */
    var o = goods;
    o.booknum = 0;
    o.totalPrice = 0;

    if(goods.scid) {
        o.scid = goods.scid;
    }else {
        o.scid = 0;
    }
    cart.goods.push(o);
    cart.goodsCnt = cart.goods.length;
    console.log("goods cnt:"+cart.goodsCnt);
}

cart._remove = function(id,price,priceVersion) {
    cart.goods[id].booknum=0;
    cart._updateGoodsTotalPrice(id,price,priceVersion);
    goodsid = cart.goods[id].goodsid;

    cart.goods = removeByIndex(cart.goods, id);
    cart.goodsCnt = cart.goods.length;
    cart.updateCart(cart);
}

cart._updateGoodsTotalPrice = function(id, newPrice, priceVersion) {
    if(cart.goods[id].booknum==0) {
        cart.goods[id].totalPrice = 0;
    }else {
        cart.goods[id].price = newPrice;
        cart.goods[id].versionID = priceVersion;
        var suffix=newPrice.substr(newPrice.indexOf('.')+1);
        newPrice = parseFloat(newPrice);
        console.log("suffix:"+suffix);
        if(suffix==='00') {
            cart.goods[id].totalPrice = newPrice*(cart.goods[id].booknum*100)/100;
        }else {
            cart.goods[id].totalPrice = newPrice*cart.goods[id].booknum;
        }
    }
    cart._updateTotalPrice();
}

cart._updateTotalPrice = function() {
    var totalPrice = 0;

    console.log('update total price');
    for(id=0;id<cart.goods.length;id++) {
        totalPrice += cart.goods[id].totalPrice;
    }
    cart.totalPrice = totalPrice.toFixed(2);
    var ret = cart.updateCart(cart);
    if(!ret) {
        _alert('save shopping cart failure');
    }
}
cart.updateCart = function (cart) {
    var userid = storageGetUid();
    var cartid = 'cart_'+userid;
    return storageSetCartInfo(userid, cart);
}
cart.findGoods = function(goodsid) {
    for(i=0;i<cart.goods.length;i++) {
        console.log(cart.goods[i]);
        if(cart.goods[i].goodsid==goodsid) {
            return i;
        }
    }
    return false;
}
cart.getGoodsInfo = function(goodsid)
{
    id = cart.findGoods(goodsid);
    //console.log("log:"+goodsid+":id:"+id);
    if(false===id) {
        return false;
    }
    return cart.goods[id];
}
