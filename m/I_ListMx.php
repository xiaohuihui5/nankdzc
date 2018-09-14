<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$query="select 0,dh.dh,case when dh.laiy=2 and dh.lx is null then '已下单' when dh.zt=1 then '已审核' else '已确认' end,dh.bz from sys_jhdh dh where id=".$_GET['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$dh=$line[1];$zt=$line[2];$bz=$line[3];
sqlsrv_free_stmt($result);
$query="select count(*) from sys_jhsj where dhid=".$_GET['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$shul=$line[0];
sqlsrv_free_stmt($result);

?>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <title>订单详情</title>
    <link rel="stylesheet" type="text/css" href="./js/detail1.css">
    <link rel="stylesheet" type="text/css" href="./js/mktstyle.css?i=a">
</head>
<body>
<div class="lay_page page_order_result">
    <div class="lay_page_wrap" id="order_info_tpl">
        <div class="mod_cell ui_mt15">
            <dl class="mod_dl dl_tabel">
                <dt class="ui_color_weak ui_align_right">订单编号：</dt>
                <dd><?php echo $dh;?></dd>
                  <dt class="ui_color_weak ui_align_right">订单状态：</dt>
                <dd><span class="ui_color_strong order-blue"><?php echo $zt;?></span></dd>
            </dl>
            <div class="mod_cell_hr"></div>
        </div>
        <div class="mod_cell">
            <dl class="mod_dl dl_tabel">
                <dt class="ui_align_right">品种数：</dt>
                <dd id="txt_payfee"><?php echo $shul;?></dd>
<dt class=" ui_align_right">备注信息：</dt>
                <dd id="txt_deratefee"><?php echo $bz;?></dd>
<!--                <dt class=" ui_align_right">优惠减免：</dt>
                <dd id="txt_deratefee">-￥10</dd>
                <dt class=" ui_align_right" name="act11_fields" style="display: none;">双11优惠：</dt>
                <dd name="act11_fields" id="act11_discount" style="display: none;">-￥</dd>
                <dt class="ui_align_right" name="txt_deliveryfee">总金额：</dt>
                <dd id="today_txt_deliveryfee" style="display: ;" name="txt_deliveryfee" class="checkout-order-msg">￥107.51</dd>
                <dd id="txt_deliveryfee" style="display: none;" name="txt_deliveryfee" class="checkout-order-msg"></dd>
-->
            </dl>
        </div>
        <div class="mod_cell qb_gap" style="padding:10px;">
            <table class="order-list-table" id="order_goods_list">
                <tbody><tr>
                    <th>商品名称</th>
                    <th>规格</th>
                    <th>单价</th>
                    <th>订货量</th>
                    <th>配送量</th>
                    <th>实收量</th>
                </tr>
            </tbody><tbody>
<?php

$query="select 0,cp.mc,cp.gg,sj.dj,sj.dinghl,sj.songhl,sj.shisl,sj.shisje from sys_jhsj sj,sys_cp cp where sj.mc=cp.id and sj.dhid=".$_GET['dhid']." order by sj.id";
$result=sqlsrv_query($conn,$query);
$je=0;
while($line=sqlsrv_fetch_array($result))
{
	if($line[1]!='周转筐')
	{$je+=$line[7];}
	echo '<tr><td>',$line[1],'</td><td>',$line[2],'</td><td>',$line[3],'</td><td>',$line[4],'</td><td>',$line[5],'</td><td>',$line[6],'</td></tr>';

}
sqlsrv_free_stmt($result);
     echo '<tr><td colspan=4 align=center><font color=red>合计金额</td><td align=right><font color=red>',sprintf("%1.1f",$je),'</font></td></tr>';

?>
</tbody></table>
        </div>
    </div>
<?php
if($zt=='已下单')
    echo '<div class="ui_gap ui-gap-bottom-s" align="center">
        <a id="aa" href="javascript:sc(',$_GET['dhid'],')" class="mod_btn"><font color=red><b>删除此单</font></a>
    </div>';
?>

    <div class="ui_gap ui-gap-bottom-s">
	  <a id="btn_back" href="I_List.php?dt1=<?php echo $_SESSION['DT1']."&dt2=".$_SESSION['DT2'];?>" class="mod_btn btn_block btn-transparent">返回</a>
    </div>
</div>
<script>
function sc(id)
{
	if(confirm('您确定要删除此未审批的微信下单吗?'))
		window.location.href="I_List.php?del="+id;
}
</script>
</body></html>
