<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$kehid=$_SESSION['unitid'];
$query="select shortname,typef,typea from sys_unit where id=".$kehid;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$kehmc=$line[0];$mos=$line[1];$kehflid=$line[2];//客户信息
sqlsrv_free_stmt($result);
$sell_rq=date('Y-m-d',strtotime("+1 day"));//下单日期
$id=explode(",",$_POST['prod_ids']);//取得传进来的id及订货量
$sl=explode(",",$_POST['prod_num']);
for($i=0;$i<count($id);$i++)
	$pos[$id[$i]]=$i;
////////////////////////////价格,经营模式价格36,客户分类价格35,按客户价格33,客户特价31
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=36 and a.unitid=".$mos." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].")";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//36
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=35 and a.unitid=".$kehflid." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].")";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//35
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix in(31,33) and a.unitid=".$kehid." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].") order by a.leix desc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//33,31
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
/////////////////////////////价格
?>
<!DOCTYPE html>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $kehmc;?></title>
    <link rel="stylesheet" type="text/css" href="./js/reset.css">
    <link rel="stylesheet" type="text/css" href="./js/demo.css">
    <link rel="stylesheet" type="text/css" href="./js/mktstyle.css">
    <link rel="stylesheet" type="text/css" href="./js/detail1.css">
    <link rel="stylesheet" type="text/css" href="./js/order_checkout.css">
</head>
<body>
    <header class="s-header">
        <nav>
            <h1>订单提交</h1>
            <a class="back" id="btn_back">返回</a>
        </nav>
    </header>
    <br><br><br>
    <form name="cFM" id="cFM" method="post" action="I_Add.php">
    <div class="lay_page page_order current">
        <div class="lay_page_wrap">
            <div class="mod_cell ui_p10">
                <span class="mod_select_title">备注说明：</span>
                <div class="qb_flex">
                    <div class="mod_select input_block flex_box">
                        <textarea id="particular" name="beiz" class="special-demand" type="text" placeholder="选填，可以填写您的其它说明"></textarea>
                    </div>
                </div>
            </div>

            <div class="mod_cell ui_p10" id="div_act_msg" style="display: none;">
            </div>

            <div class="mod_cell_hr"></div>
            <div class="mod_cell" style="padding-bottom:0;">
                <div class="mod_celltitle">已下单商品详情</div>
                <ul class="mod_list" id="tpl_checkout_cart_list">
<?php
$query="select cp.id,cp.mc,cp.dw,cp.gg from sys_cp cp where id in(".$_POST['prod_ids'].") order by cp.bh";
$result=sqlsrv_query($conn,$query);
$row=0;$je=0;
while($line=sqlsrv_fetch_array($result))
{
	if($sl[$pos[$line[0]]]!=0)
	{
	$row+=1;
	echo '<li class="list_item" style="display: -webkit-box;">
                        <div class="order-form-menu-img">
                            <img class="tpl-stuff-image" src="./js/296.png">
                        </div>
                        <div class="bfc_c order-list-detail order-detail">
                            <p>',$line[1],'</p>
                            <p class="qb_fs_s ui_color_weak">&nbsp;&nbsp;',$line[3],'</p>
                            <p class="qb_fs_s ui_color_weak"><strong class="mod_color_strong order-blue">￥',$jg[$line[0]],'/',$line[2],'  </strong> </p>
                        </div>
                        <div class="fresh-counter" opid="_109">
                            <div class="js-ctl-warp" goodsid="',$line[0],'"  price="',$jg[$line[0]],'">
                                <a class="js-minus cp font20" goodsop="-">－</a>
                                <input name="s',$row,'" type="number" class="js-count tc" value="',$sl[$pos[$line[0]]],'" goodsopid="_',$line[0],'">
                                <input name="i',$row,'" type="hidden" value="',$line[0],'"><input name="j',$row,'" type="hidden" value="',$jg[$line[0]],'"><a class="js-plus cp font20" goodsop="+">＋</a>
                            </div>
                        </div></li>';
	$je+=$sl[$pos[$line[0]]]*$jg[$line[0]];
	}
}       
sqlsrv_free_stmt($result);
	$xiaos=60*date('H')+date('i');//小时*60+分钟,840-1380为2点到11点

	//取得是否已经下单
	$query="select count(*) from sys_jhdh where unit=".$kehid." and (laiy=2 or lx=2) and dhrq='".$sell_rq."'";
	$result=sqlsrv_query($conn,$query);
	$yi_xiad=0;
	$line=sqlsrv_fetch_array($result);
		$yi_xiad=$line[0];
	sqlsrv_free_stmt($result);
	//取得是否已经下单
?>
                </ul>
                <div class="ui_mb10 ui_mt10 webkit-box">
                    <div class="flex1 ui_align_right">商品总数：<input name="row" type="hidden" value="<?php echo $row;?>"></div>
                    <div class="mod_color_strong w50">
                        <span class="total-price order-black" id="cart_goods_num"><?php echo $row;?></span>
                    </div>
                </div>
                <div class="ui_mb10 ui_mt10 webkit-box" id="">
                    <p class="ui_align_right">
                    </p><div class="flex1 ui_align_right">金额：</div>
                    <div class="mod_color_strong w50">
                        <span class="total-price order-red" id="cart_total_price">￥<?php echo $je;?></span>
                    </div>
                    <p></p>
                </div>
            </div>

            <div class="ui_gap ui-gap-bottom-s">
                <div class="b-btn-wrapper">
                    <a class="mod_btn btn_strong btn_block btn-orange" id="btn_shopping">继续下单</a>
                </div>
               <div class="b-btn-wrapper" style="margin-left:10%;"> 
                <a class="mod_btn btn_strong btn_block btn-blue" id="btn_order_submit">提交订单</a>
               </div>
            </div>
        </div>
    </div>
   </form>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
var cartid='m_5';</script>
<script src="./js/common.js?i=1" type="text/javascript"></script>
</body></html>
<script>
var shij=<?php echo $xiaos;?>;
var has_xd=<?php echo $yi_xiad;?>;
var tims=0;//防止点2次提交
var cps=<?php echo $row;?>;//下单产品数
$('#btn_shopping').click(function(){
 window.location.href="I_Xiad.php";
});
$('#btn_order_submit').click(function(){
	if(cps==0)
		alert('请选择好产品后再提交单!');
	else if(shij<540 && tims==0)
		alert('请在每天上午9点至晚上12点之间下单!');
	else if(has_xd>0 && tims==0)
	{
		if(confirm('此客户当天已下单,您确定要重复增加吗?'))
		{
		tims=1;
		localStorage.clear();
		$("#cFM").submit();
		}
	}
	else if(tims==0)
	{
	tims=1;
	localStorage.clear();
	///var ids='';
	///var djs='';
	//var sls='';
	//for(id=1;id<=<?php echo $row;?>;id++)
	//if($('#s'+id).val()!=0 && $('#s'+id).val()!='')
	//{
	//	
	//}
	//
	//alert('提交成功!');
	$("#cFM").submit();
	}
});
</script>
