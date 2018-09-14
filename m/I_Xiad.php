<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
if(isset($_SESSION['unitid']))
	require('./inc/xc_c.php');
else
{
	$appId="wx9fc13dbd089d3519";//企业号id
	$appSecret="DbCrQb7mLJ2p38OLptdD1E1x_kmNdRam_mZQg_t4wGp8xbRC50aBqm9bqMsjjyA8";//操作管理组随机标示号
	function https_request($url){$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$output=curl_exec($curl);curl_close($curl);return $output;}
	if(file_get_contents("access_token_time.txt")<time())//口令过时
	{
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$appId."&corpsecret=".$appSecret;$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'access_token')){$access_token=$fenk[$i+2];break;}//getAccessToken
		$fp=fopen("access_token.txt", "w");fwrite($fp,$access_token);fclose($fp);
		$fb=fopen("access_token_time.txt", "w");fwrite($fb,time()+7000);fclose($fb);
	}else
		$access_token=file_get_contents("access_token.txt");
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=2";
	$UserId='';
	$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'UserId')){$UserId=$fenk[$i+2];break;}
	if($UserId=='') {echo '非本企业用户非法登录!';exit;}
	require('./inc/xc_c.php');
	$query="select id from sys_unit where yn=1 and userid='".$UserId."'";//取得empid
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['unitid']=$line[0];
	}else
	{echo '您尚未开通微信下单功能或帐号设置错误,请与管理员联系!';exit;}
	sqlsrv_free_stmt($result);
}
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
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta charset="gb2312">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $kehmc;?>下单产品列表</title>
    <link rel="stylesheet" type="text/css" href="./js/reset.css">
    <link rel="stylesheet" type="text/css" href="./js/header.css">
    <link rel="stylesheet" type="text/css" href="./js/demo.css?i=2">
    <link rel="stylesheet" type="text/css" href="./js/redskin.css">
</head>
<body>
    <div class="search-div">
        <a class="search-back-icon"></a>
        <a class="search-back-btn" href="I_List.php">查单</a>
        <input class="search-input" value="" style="left: 60px;" id="keywords" type="search">
        <a class="search-btn" id="btn_goods_list_search">搜索</a>
        <a class="common-btn" id="btn_fav">★收藏</a>
    </div>

    <div class="js-menu-bar">
        <div class="menu-task"></div>
        <ul class="menu fl" id="class1">
<?php
$dfl_id=0;//默认第一个选中的大分类id
$query="select id,fenlmc from sys_cpfenl where yn=1 and id in(select dfl from sys_cp where id in(".$cp_id.")) order by id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	if($dfl_id==0)
	{
		$dfl_id=$line[0];
		echo '<li class="active" id="d',$line[0],'" uid="',$line[0],'" btn-type="class1">',$line[1],'</li>';
	}
	else 
		echo '<li class="" id="d',$line[0],'" uid="',$line[0],'" btn-type="class1">',$line[1],'</li>';
}
sqlsrv_free_stmt($result);
?>
        </ul>
        <div class="clear"></div>
    </div>
    <!--Tips start-->
    <div class="act-tips">
        <div class="act-tips-items">
            <i class="icon-tips"></i>仅双11当天：全场9.8折。
        </div>
    </div>
    <!--Tips end-->
    <div class="js-content" style="height: 644px;">
        <div class="fl scroll-y leftSider js-slider" id="myxfl">
            <ul class="js-category" id="class2">
<?php
$xfl_id=0;//默认第一个选中的小分类id
$query="select id,fenlmc from sys_cpxiaofl where dafl=".$dfl_id." and yn=1 and id in(select xiaofl from sys_cp where id in(".$cp_id."))  order by id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	if($xfl_id==0)
	{
		$xfl_id=$line[0];
		echo '<li class="cp active" id="x',$line[0],'" uid="',$line[0],'" btn-type="class2">',$line[1],'</li>';
	}
	else 
		echo '<li class="cp " id="x',$line[0],'" uid="',$line[0],'" btn-type="class2">',$line[1],'</li>';
}
sqlsrv_free_stmt($result);
?>
            </ul>
        </div>
        <div class="fl scroll-y js-search-wrapper">
            <table class="table table-condensed js-search-table">
                <tbody class="js-category-detail ul-bottom-line" id="goods_list_tpl">
<?php
$query="select id,mc,dw,gg from sys_cp where xiaofl=".$xfl_id." and yn=1 and id in(".$cp_id.") order by bh";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	if(isset($cy[$line[0]])) $changy='clicked'; else $changy='';//常用
	echo '<tr data-goodsid="',$line[0],'">
                        <td>
                            <span class="js-c-name" id="n',$line[0],'">',$line[1],'</span>
                            <a class="ml5 font16 js-favorite ',$changy,'" starid="',$line[0],'"></a>
                            <br>
                            <span class="js-subject" id="s',$line[0],'">',$line[3],'</span>
                            <br>
                            <span class="js-price-ref" name="user_type_item" tag="price_info"><span class="price" id="p',$line[0],'">￥',$jg[$line[0]],'元/',$line[2],'</span></span>
                        </td>
                        <td class="v-m js-pic-wrapper">
                            <div class="ml10 product-img-wrapper" img_src_id="',$line[0],'"><img src="./js/296.png"></div>
                            <div name="user_type_item">
                                <div class="js-ctl-warp" goodsid="',$line[0],'" price="',$jg[$line[0]],'">
                                    <div class="js-minus cp font20" goodsop="-">－</div>
 <input class="js-count tc" value="0" onfocus="this.select();" goodsopid="_',$line[0],'" type="text">
                                    <div class="js-plus cp font20" goodsop="+">＋</div>
                                </div>
                            </div>
                        </td>
                    </tr>';
}
sqlsrv_free_stmt($result);
?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div>
    <div class="bottom" name="user_type_item">
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
                <img src="./js/05.gif" alt="图片加载中...">
            </div>
            <div class="v-title">菜名</div>
            <div class="v-price" tag="price_info" name="user_type_item"><span></span></div>
            <div class="v-detail"><span>描述：</span>白菜。</div>
        </div>
    </div>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
var cartid='m_5';</script>
<script src="./js/common.js?i=11" type="text/javascript"></script>
<script>
$('#class1 li').click(function(){
	$(this).siblings("li").attr("class","");
	$(this).attr("class","active");
	$.post("I_XiadAjax.php",{dfl:$(this).attr('uid')},
	function(data){
	str=data.split('@@@')
	$('#class2').html(str[0]);
	$('#goods_list_tpl').html(str[1]);
	initCartGoods();initGoodsOp();initFavoriteOp();
	}
	)
});
$("#myxfl ul").on("click","li",function(){
	$(this).siblings("li").attr("class","cp ");
	$(this).attr("class","cp active");
	$.post("I_XiadAjax.php",{xfl:$(this).attr('uid')},
	function(data){
	$('#goods_list_tpl').html(data);
	initCartGoods();initGoodsOp();initFavoriteOp();
	}
	)
});
$(document).ready(function() {
    $(".js-content").css("height",($(window).height()-$(".search-div").height()-$(".js-menu-bar").height()-2-$(".act-tips").height()+"px"));
});
$(document).on('tap','#goods_list_tpl .product-img-wrapper', function(){
    var _goodsid = $(this).attr("img_src_id");
    $("#cover_area .img-wrapper img").attr('src',$(this).children("img").attr("src")).attr('alt',$('#n'+_goodsid).text());
    $("#cover_area .v-title").html($('#n'+_goodsid).text());
    $("#cover_area .v-price span").html($('#p'+_goodsid).html());
    $("#cover_area .v-detail").html("<span>描述：</span>"+$('#s'+_goodsid).text());
    $('#cover').show();
    $('#cover_area').show(400);
}).on('tap', '#cover, #cover_area', function() {
    $('#cover_area').hide();
    $('#cover').hide();
});
</script>
</body></html>
