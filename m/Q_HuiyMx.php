<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
if(!isset($_SESSION['empid']))
	{echo '��ͨ��΢����ҵ�ŵ�¼!';exit;}
	$query="select a.id,a.yiti,a.fangj,convert(varchar(16),a.ksrq,120),a.zcr,a.reny,a.bz from sys_meet a,sys_meetlx b,sys_qiye q where a.lx=b.id and a.qyid=q.id and a.id=".$_GET['id'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$yiti=$line[1];
	$fangj=$line[2];
	$shij=$line[3];

	$zcr=$line[4];
	$reny=$line[5];
	$bz=$line[6];
	sqlsrv_free_stmt($result);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>������ϸ��Ϣ</title>
<script>document.addEventListener('WeixinJSBridgeReady',function onBridgeReady(){WeixinJSBridge.call('hideOptionMenu');});</script>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="./js/style_sz.css?id=3" rel="stylesheet" type="text/css">
<link href="./js/index.css?i=1" type="text/css" rel="stylesheet" media="all" />
</head>
<body>
<div class="qiandaobanner" onclick="javascript:history.go(-1)"><img src="./images/user2.jpg" ></div>
<div class="cardexplain" >
<ul class="round" id="notice">
<h1>��������Ϣ��</h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#777777>����:</font><?php echo $yiti;?></h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#777777>�ص�:</font><?php echo $fangj;?></h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#777777>ʱ��:</font><?php echo $shij;?></h1><li class="none"></li>
</ul>
<ul class="round" id="notice2">
<h1>�������Ϣ��</h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#777777>������:</font><?php echo $zcr;?></h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#777777>�λ���:</font><?php echo $reny;?></h1><li class="none"></li>
</ul>
<ul class="round" id="notice2">
<h1>�����顿</h1><li class="none"></li>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bz;?></h1><li class="none"></li>
</ul>
      </div>
<div style="width:100%">
<form action="" method="post" name="IFrm" align="center">
<table width="100%">
<tr>
<td colspan="2" ><a href="javascript:history.go(-1)" id="close_btn2" class="f60_btn">�� ��</a></td>
</tr>
</table></form></div>
<div id="plug-wrap" onclick="closeall()" style="display: none;"></div>
</body>
</html>
