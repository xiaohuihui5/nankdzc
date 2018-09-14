<?php
require('./inc/xc_c.php');
//实际库存
$query="select sj.mc,sum(sj.shisl) from sys_jhsj sj,sys_jhdh dh where dh.dhrq='".date('Y-m-d')."' sj.dhid=dh.id and dh.lx in(5) group by sj.mc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$kuc[$line[0]]=$line[1];//盘点数量
}
sqlsrv_free_stmt($result);
//预定总量
$query="select sj.mc,sum(sj.dinghl) from sys_jhdh dh,sys_jhsj sj,sys_cp cp where dh.dhrq='".date('Y-m-d')."' and cp.mc not in('周转筐') and cp.xiaofl<>6 and dh.id=sj.dhid and cp.id=sj.mc and dh.lx in(2,4) group by sj.mc having(sum(sj.dinghl)>0)";
$result=sqlsrv_query($conn,$query);
$cpid="0";
$zonghj=0;
while($line=sqlsrv_fetch_array($result))
{
	$yudl[$line[0]]=$line[1];//预定数量
	$cpid.=",".$line[0];
	$zonghj+=$line[1];
}
sqlsrv_free_stmt($result);

$str='';
$query="select cp.id,cp.mc from sys_cp cp where cp.id in(".$cpid.") order by cp.mc";
$result=sqlsrv_query($conn,$query);
$count=0;
while($line=sqlsrv_fetch_array($result))
{
	$count+=1;
	$str.='<div class="arrow" onclick="location.href=\'Q_YudtjMx.php?cpid='.$line[0].'\'"></div><div class="order"><font color=#999>商品：</font>'.$line[1].'</font><br><font color=#999>预定量：</font><font color=red>'.$yudl[$line[0]].'</font><br><font color=#999>库存量：</font><font color=red>'.$kuc[$line[0]].'</font></div>';
}
sqlsrv_free_stmt($result);
?>
<!DOCTYPE HTML>
<html>
<head>
<script>document.addEventListener('WeixinJSBridgeReady',function onBridgeReady(){WeixinJSBridge.call('hideOptionMenu');});</script>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<title>客户预定统计按产品汇总【<?php echo $count;?>】</title>
<meta name="Author" content="songjia">
<meta name="Keywords" content="">
<meta name="Description" content="">
<link rel="stylesheet" href="./tpp/received.css" />
<link rel="stylesheet" href="./tpp/utils6.css" />
<script src="./tpp/jquery-1.11.1.min.js"></script>
<script src="./tpp/order.js"></script>
</head>
	<body class="bar">
		<div class="top-float-layer">
			<div class="posi">
				<!--
				<div class="handle">
					<a class="back" href="/m/user/center">返回</a>
				</div>
				 -->
				<div class="nav-bar">
					<ul>
					<li class="active" id="week"><a id="a_week">总合计：<font color=red><?php echo $zonghj;?><b></b></font></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="float-height"></div>
<!--
-->
			<div class="order-list">
<?php
	echo $str;
?>
			</div>
<!--
-->
		</div>
		</body>
</html>
