var allgoods = {};

var todayOrderFee = 0;

getTodayTotalFee();

function goodsListPageInit() {
    if (!storageGetUid()) {
        _nologinConfirm('goodslist');
    }

    if(!storageGetUserInfo()) {
        _nologinConfirm('goodslist');
    } else if (!userInfo.custinfo.custtype) {
        return location.href = '/login';
        _nologinConfirm('goodslist');
    }

    changeCartStatusDisplay();
    var url = '';
    if(entry==songcaige.pageEntry.PAGE_ENTRY_CT) {
        url = '/goods/ctCategoryList';
    }else {
        url = '/goods/scCategoryList';
    }

    var params = {
        userid:storageGetUid(),
        token:storageGetToken()
    };
    _post(url, params, function(data) {
        menu1Display(data);
        initCart();
    });

    $("#btn_goods_list_search").click(function() {
        var k = $("#keywords").val();
        if(!k) {
            return false;
        }
        if(userIsGuest()) {
            _alert('游客用户只能搜索到部分蔬菜', function() {
                return location.href='/search?t='+songcaige.userType.USER_TYPE_GUEST+'&k='+encodeURIComponent(k);
            });
        }
        if(userIsSC()) {
            if(entry=='SC') {
                return location.href='/search?t='+songcaige.userType.USER_TYPE_SC+'&k='+encodeURIComponent(k);
            }else {
                _alert("您现在是商超用户，搜索内容只会展示商超用户的菜品", function() {
                    return location.href='/search?t='+songcaige.userType.USER_TYPE_SC+'&k='+encodeURIComponent(k);
                });
            }
        }
        if(userIsCT()) {
            if(entry=='CT') {
                return location.href='/search?t='+songcaige.userType.USER_TYPE_CT+'&k='+encodeURIComponent(k);
            }else {
                _alert("您现在是餐厅用户，搜索内容只会展示餐厅用户的菜品", function() {
                    return location.href='/search?t='+songcaige.userType.USER_TYPE_SC+'&k='+encodeURIComponent(k);
                });
            }
        }
    });
}
//menu1
function menu1Display(classData)
{
    var o1,o2,defaulClass1Id,defaulClass2Id;
    var menu1=[];
    var menu2=[];
    var member=[];

    var found1=false;
    for(id1 in classData) {
        o1 = {className:classData[id1].classname,classId:classData[id1].classid,activeClass:''};
        if(classData[id1].seq==1 && !found1) {
            //console.log(classData[id1].seq);
            o1.activeClass = 'active';
            defaulClass1Id = classData[id1].classid;
            found1 = true;
        }
        var menu1Key = '_'+o1.classId;
        menu1[menu1Key]=o1;
        menu2[menu1Key]=[];
        member = classData[id1].member;
        if(member.length>0) {
            var found2 = false;
            for(id2 in member) {
                classMap[member[id2].subclassid] = classData[id1].classid;
                o2 = {className:member[id2].subclass,classId:member[id2].subclassid,activeClass:''};
                if(!found2) {
                    o2.activeClass='active';
                    defaulClass2Id = classData[id1].classid;
                    found2 = true;
                }
                var menu2Key = '_' + o2.classId;
                menu2[menu1Key][menu2Key] = o2;
            }
            menu2[menu1Key].length = member.length;
        }
    }
    var obj = _buildList(menu1,goodsClassFields,tpl1,class1Id);
    var hashurl = location.hash;
    var flag = hashurl.substr(1,2);
    if(flag=='c1') {
        defaulClass1Id = hashurl.substr(3);
    }
    console.log(defaulClass1Id);
    menu1Tap(defaulClass1Id, menu1, menu2);

    $("#"+class1Id).children().click(function() {
        var id=$(this).attr('id').substr(6);
        menu1Tap(id, menu1, menu2);
    })
}

function menu1Tap(menu1Id, menu1, menu2)
{
    $("#"+class1Id).children(".active").removeClass('active');
    $("#class1"+menu1Id).addClass('active');
    menu2Display(menu1Id, menu2);
}

function menu2Display(menu1Id, menu2)
{
    var m = menu2['_'+menu1Id];
    if(m.length==0) {
        $("#"+class2Id).html('');
    }
    var defaultMenuId = 0;
    for(id in m) {
        if(m[id]['activeClass']=='active') {
            defaultMenuId = m[id].classId;
        }
    }
    console.log("class2:" + defaultMenuId);
    _buildList(m,goodsClassFields,tpl2,class2Id);
    menu2Tap(defaultMenuId);
    $("#"+class2Id).children().click(function() {
        var id=$(this).attr('id').substr(6);
        menu2Tap(id);
    })
}

function menu2Tap(menu2Id)
{
    $("#"+class2Id).children(".active").removeClass('active');
    $("#class2"+menu2Id).addClass('active');

    goodsDisplay(menu2Id);
}
function goodsDisplay(menu2Id)
{
    if(menu2Id==0) {
        $("#"+goodsListId).html('');
        return false;
    }
    var url='/goods/getGoods';
    var params = {classId:menu2Id};
    var userid=storageGetUid();
    var token=storageGetToken()
    if(userid && token) {
        params.userid = userid;
        params.token = token;
    }
    params.sw=window.screen.width;
    _post(url,params, function(data) {
        var goods = formatGoodsListData(data.member);
        _buildList(goods,goodsListFields,goodsListTpl,goodsListId);

        if(entry==songcaige.pageEntry.PAGE_ENTRY_CT) {
            if(userIsCT()) {
                $("[name=user_type_item]").show();
            }else {
                $("[name=user_type_item]").each(function() {
                    if($(this).attr('tag')=='price_info') {
                        $(this).show();
                    }else {
                        $(this).remove();
                    }
                });
            }
        }else {
            if(entry==songcaige.pageEntry.PAGE_ENTRY_SC) {
                if (userIsSC()) {
                    $("[name=user_type_item]").show();
                } else {
                    $("[name=user_type_item]").remove();
                }
            }
        }
        if(goods[0] && typeof(goods[0].price)=='undefined') {
            $("[name=user_type_item]").remove();
        }

        for(i in goods) {
            allgoods['_'+goods[i].goodsid] = goods[i];
        }
        setGoodsStock(goods);
        for(var i in goodsStock) {
            $("[goods_stock_id="+i+"]").html(goodsStock[i]);
            $("[goods_stock_id="+i+"]").parent().show();
            if(goodsStock[i]<=0) {
                var goodsid = i.substr(1);
                $('.sold-out[data-goodsid="'+goodsid+'"]').show();
            }
        }

        initCartOp(goods);
        initFavoriteOp();
    });
}
function formatGoodsListData(data)
{
    for(id in data) {
        data[id]['measure2'] = data[id]['measure'];
    }
    return data;
}

function initCartOp(goods)
{
    $("[goodsopid]").each(function(index) {
        $(this).change(function() {
            var goodsid = $(this).parent().attr("goodsid");
            var price = $(this).parent().attr("price");
            //price = parseFloat(price);
            var versionID = $(this).parent().attr("versionID");
            var num = parseFloat($(this).val());

            var gg = allgoods['_'+goodsid];
            var gbuylimit = parseFloat(gg.buylimit);
            gg.todayOrderNum = parseFloat(gg.todayOrderNum);
            var todayNum = parseFloat(gg.todayOrderNum)+num;
            if(gg.isreserve && gg.reserve && gg.todayOrderNum>0 && todayNum>gbuylimit) {
                var gname = gg.goodsname;
                var gtodayOrderNum = gg.todayOrderNum;
                num = gbuylimit-gg.todayOrderNum;
                if(num<0) num = 0;
                $(this).val(num);
                _alert('亲，您购买的商品［'+gname+'］已经超过每日限购量了！请选购其他菜品吧！');
            }
            var count = cart.modify(gg, num);
            if(count==false) {
                count = 0;
            }
            $(this).val(count);
            changeCartStatusDisplay();
            console.log("changeCartStatusDisplay");
        });
    });

    $("[goodsop]").each(function(index) {
        $(this).on('tap',function() {
            var op = $(this).attr('goodsop');
            var field = $(this).parent().children("input")
            var val = parseInt(field.val());
            if(isNaN(val)) {
                val = 0;
            }
            console.log('value is '+ val);
            switch(op) {
                case '+':
                    val++
                    break;
                case '-':
                    if(val>0) {
                        val--;
                    }
                    break;
            }
            field.val(val);
            field.trigger('change');
        });
    });

    $("[goodsopid]").each(function(){
        var goodsid = $(this).attr('goodsopid');
        goodsid = goodsid.substr(1);
        var info = cart.getGoodsInfo(goodsid);
        if(false!==info) {
            $(this).val(info.booknum);
            if(goodsStock["_"+goodsid]) {
                $("[goods_stock_id=_"+goodsid+"]").html(goodsStock["_"+goodsid]-info.booknum);
            }
        }
    });
    initCartInputEvent();
}

function initCart()
{
    changeCartStatusDisplay();
}

$("#car_submit").click(function() {
    return submitOrder();
})
function submitOrder()
{
    var goods = cart.goods;
    if(goods.length==0) {
        return alert('请重新购买商品');
    }
    var price = cart.totalPrice;
    if(!price) {
        return alert('请选择商品后再提交订单');
    }
    var url = '/order/submit';
    var userid = storageGetUid();
    var token = storageGetToken();
    var params = {r:JSON.stringify(goods),p:price,userid:userid,token:token};

    $.post(url, params, function(resp) {
        if(resp.code==0) {
            storageSetCartInfo(storageGetUid(), undefined);
            cart.reset();
            alert("订单提交成功");
        }else {
            alert(resp.msg);
        }
    });
}

$(document).on('tap','#goods_list_tpl .product-img-wrapper', function(){
    var _goodsid = $(this).attr("img_src_id");
    var goods = allgoods[_goodsid];
    $("#cover_area .img-wrapper img").attr('src', goods.imageURL).attr('alt', goods.goodsname);
    $("#cover_area .v-title").html(goods.goodsname);
    $("#cover_area .v-price span").html(goods.price);
    $("#cover_area .v-detail").html("<span>描述：</span>"+goods.descpt);
    $('#cover').show();
    $('#cover_area').show(400);
}).on('tap', '#cover, #cover_area', function() {
    $('#cover_area').hide();
    $('#cover').hide();
});

