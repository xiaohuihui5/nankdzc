<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$kehid=$_SESSION['unitid'];
	$query="select linkman from sys_unit where id=".$kehid;
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
		$lury=$line[0];
	sqlsrv_free_stmt($result);
if(isset($_POST['row']))
{
	$laiy=2;
	$rq=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
	$R_Q=explode('-',$rq);
	$dh='W'.substr($R_Q[0],-2).substr('0'.$R_Q[1],-2).substr('0'.$R_Q[2],-2);
	$query="select right(max(dh),4)+1 from sys_jhdh where dhrq='".$rq."' and laiy=".$laiy;
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{		
		if($line[0]!="") $dh.=substr('000'.$line[0],-4); else $dh.='0001';
	}
	else
		$dh.='0001';

	$query="insert into sys_jhdh(dh,dhrq,unit,lury,bz,zf,laiy,zt,chk,cangk) 
values('".$dh."','".$rq."',".$kehid.",'".$lury."','".$_POST['beiz']."',-1,2,0,0,1)";
sqlsrv_query($conn,$query);
	$d_id=0;$d_dh='';$d_bz='';
	$query="select id,dh,bz,convert(varchar(10),dhrq,120) from sys_jhdh where id=(select max(id) from sys_jhdh where unit=".$kehid." and laiy=2 and dhrq='".$rq."')";
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
	$d_id=$line[0];
	$d_dh=$line[1];
	$d_bz=$line[2];
	$d_rq=$line[3];
	}
	sqlsrv_free_stmt($result);
}

	$query = "select id from sys_cp where dfl=3";//物料
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{	
		$wl[$line[0]]=1;
	}
	sqlsrv_free_stmt($result);

for($i=1;$i<=$_POST['row'];$i++)
{
	if(isset($wl[$_POST['i'.$i]]))
		$ck=3;
	else
		$ck=1;
	$query="insert into sys_jhsj(dhid,mc,shul,dinghl,chengbdj,zhuangdj,dj,jiesdj,bz,lury,ck) 
values(".$d_id.",".$_POST['i'.$i].",null,".$_POST['s'.$i].",null,null,".$_POST['j'.$i].",null,null,'".$lury."',".$ck.")";
	sqlsrv_query($conn,$query);
}
//echo '单号id是:',$d_id,'<br>';
//for($i=1;$i<=$_POST['row'];$i++)
//	echo $_POST['i'.$i],'-',$_POST['s'.$i],'-',$_POST['j'.$i],'<br>';
?>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <title>订单提交成功!</title>
    <link rel="stylesheet" type="text/css" href="./js/detail1.css">
    <link rel="stylesheet" type="text/css" href="./js/mktstyle.css">
</head>
<body>
<div class="lay_page page_order_result">
    <div class="lay_page_wrap" id="order_info_tpl">
        <div class="mod_cell ui_mt15">
            <dl class="mod_dl dl_tabel">
                <dt class="ui_color_weak ui_align_right">订单编号：</dt>
                <dd><?php echo $d_dh;?></dd>
                <dt class="ui_color_weak ui_align_right">送货日期：</dt>
                <dd><?php echo $d_rq;?></dd>
                  <dt class="ui_color_weak ui_align_right">订单状态：</dt>
                <dd><span class="ui_color_strong order-blue">提交成功-待确认</span></dd>
            </dl>
            <div class="mod_cell_hr"></div>
        </div>
        <div class="mod_cell">
            <dl class="mod_dl dl_tabel">
                <dt class="ui_align_right">品种数：</dt>
                <dd id="txt_payfee"><?php echo $_POST['row'];?></dd>
<dt class=" ui_align_right">备注信息：</dt>
                <dd id="txt_deratefee"><?php echo $_POST['beiz'];?></dd>
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
$query="select 0,cp.mc,cp.gg,sj.dj,sj.dinghl,sj.songhl,sj.shisl from sys_jhsj sj,sys_cp cp where sj.mc=cp.id and sj.dhid=".$d_id." order by sj.id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
	echo '<tr><td>',$line[1],'</td><td>',$line[2],'</td><td>',$line[3],'</td><td>',$line[4],'</td><td>',$line[5],'</td><td>',$line[6],'</td></tr>';
sqlsrv_free_stmt($result);
?>
</tbody></table>
        </div>
    </div>
<?php
    echo '<div class="ui_gap ui-gap-bottom-s" align="center">
        <a id="aa" href="javascript:sc(',$d_id,')" class="mod_btn"><font color=red><b>删除此单</font></a>
    </div>';
?>

    <div class="ui_gap ui-gap-bottom-s">
        <a id="btn_back" href="I_Xiad.php" class="mod_btn btn_block btn-transparent">返回</a>
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
