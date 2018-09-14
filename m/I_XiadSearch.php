<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$search=iconv('UTF-8','gb2312',$_GET['k']);
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>产品搜索</title>
    <meta charset="gb2312">
    <meta name="author" content="">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="./js/reset.css">
    <link rel="stylesheet" type="text/css" href="./js/header.css">
    <link rel="stylesheet" type="text/css" href="./js/demo.css?i=1">
    <link rel="stylesheet" type="text/css" href="./js/footer.css">
    <link rel="stylesheet" type="text/css" href="./js/index.css">
</head>
<body>
<div class="patrick-box">
    <div class="search-div">
        <a class="search-back-icon"></a>
        <a class="search-back-btn" id="btn_back">返回</a>
        <input class="search-input" value="<?php echo $search;?>" style="left: 60px;" id="keywords" type="search">
        <a class="search-btn" id="btn_goods_list_search">搜索</a>
        <a class="common-btn" id="btn_fav">★收藏</a>
    </div>
    <!--Tips start-->
    <div class="act-tips">
        <div class="act-tips-items">
            <i class="icon-tips"></i>仅双11当天。
        </div>
    </div>
    <!--Tips end-->
    <div class="content">
        <div class="content-fav">
            <ul class="fresh-ul" id="search_list_tpl">
<?php
$kehid=$_SESSION['unitid'];
$query="select shortname,typef,typea from sys_unit where id=".$kehid;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$kehmc=$line[0];$mos=$line[1];$kehflid=$line[2];//客户信息
sqlsrv_free_stmt($result);
$sell_rq=date('Y-m-d',strtotime("+1 day"));//下单日期
////////////////////////////价格,经营模式价格36,客户分类价格35,按客户价格33,客户特价31
$cp_id="0";
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=36 and a.unitid=".$mos." and '".$sell_rq."' between a.brq and a.erq";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//36
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=35 and a.unitid=".$kehflid." and '".$sell_rq."' between a.brq and a.erq";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//35
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix in(31,33) and a.unitid=".$kehid." and '".$sell_rq."' between a.brq and a.erq order by a.leix desc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//33,31
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
/////////////////////////////价格
//常用
$query="select cpid from weix_changy where useid=".$kehid;
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
	$cy[$line[0]]=1;
sqlsrv_free_stmt($result);
//常用
$query="select id,mc,dw,gg from sys_cp where mc like '%".$search."%' and yn=1 and id in(".$cp_id.") order by bh";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	if(isset($cy[$line[0]])) $changy='clicked'; else $changy='';//常用
	echo '<li class="fresh-li" data-id="',$line[0],'">
                    <div class="order-form-menu-img" img_src_id="',$line[0],'">
                        <img class="tpl-stuff-image" src="./js/296.png">
                        <div class="sold-out" data-goodsid="',$line[0],'" style="display: none">已售完</div>
                    </div>
                    <div class="fresh-wrap">
                        <div class="fresh-name-wrap">
                            <a class="fresh-little-star ',$changy,'" starid="',$line[0],'"></a>
                            <p class="fresh-name" id="n',$line[0],'">',$line[1],'</p>
                        </div>
                        <div class="fresh-name-wrap">
                            <p class="fresh-discription" id="s',$line[0],'">&nbsp;&nbsp;',$line[3],'</p>
                        </div>
                        <p class="fresh-price" style="font-size:14px;" id="p',$line[0],'">￥',$jg[$line[0]],'元/',$line[2],'</p>
                    </div>
                    <div class="fresh-counter">
                        <div class="js-ctl-warp" goodsid="',$line[0],'" opid="_',$line[0],'" price="',$jg[$line[0]],'">
                            <a class="js-minus cp font20" goodsop="-">－</a>
                            <input type="text" class="js-count tc" value="0" goodsopid="_',$line[0],'">
                            <a class="js-plus cp font20" goodsop="+">＋</a>
                        </div>
                    </div>
                </li>';
}
sqlsrv_free_stmt($result);
?>
          </ul>
        </div>
    </div>
    <div class="bottom">
<form action="I_Jies.php" method="POST" id="tform">
<input id="prod_ids" name="prod_ids" type="hidden" value=""></input>
<input id="prod_num" name="prod_num" type="hidden" value=""></input>
        <div class="back"><p class="back_s"></p></div>
        <div class="bottom_bod">
            <p class="bottom_img"><span class="hint" id="cart_goods_num">0</span></p>
            <p class="bottom_time"><span class="bottom_time_sapn" id="cart_total_price">￥0</span></p>
        </div>
        <a class="bottom_je" id="order_checkout">去结算</a>
        <br>
</form>
    </div>
    <div class="pop-bg hide" id="cover"></div>
    <div class="pop-window m-window hide" id="cover_area">
        <div class="body">
            <div class="img-wrapper">
                <img src="./img/05.gif" alt="图片加载中...">
            </div>
            <div class="v-title">新鲜白菜</div>
            <div class="v-price"><span>5.00</span></div>
            <div class="v-detail"><span>描述:</span>白菜</div>
        </div>
    </div>
</div>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
var cartid='m_5';</script>
<script src="./js/common.js?i=12" type="text/javascript"></script>
<script>
$('body').on('tap', '.order-form-menu-img .tpl-stuff-image' , function() {
    var $this = $(this);
    var id = $this.parent().attr('img_src_id');
        $('#cover_area img').attr('src',$(this).attr("src"));
        $("#cover_area .v-title").text($('#n'+id).text());
        $('#cover_area .v-price span').text($('#p'+id).text());
        $('#cover_area .v-detail').html('<span>描述：</span>'+$('#s'+id).text());
        $('#cover, #cover_area').show();
}).on('tap', '#cover, #cover_area', function() {
    $('#cover, #cover_area').hide();
});
</script>
</body></html>
