<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
if(isset($_POST['paix'])) $paix=$_POST['paix']; else $paix="dh.dhrq desc";
if(isset($_POST['scroll'])) $scroll=$_POST['scroll']; else $scroll=0;
$chax="";
if(isset($_GET['del']))
{
	$query="update sys_jhdh set laiy=0 where lx is null and id=".$_GET['del'];
	sqlsrv_query($conn,$query);
}
if(isset($_POST['dt1']))
{
	//$rq1=$_POST['dt1'];$rq2=$_POST['dt2'];
	//$TJ=" and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
$_SESSION['DT1']=$_REQUEST['dt1'];$_SESSION['DT2']=$_REQUEST['dt2'];
	$TJ=" and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";

	$yxd="";$yqr="";$ysh="";//选中的checked
	if($_POST['zt']!="")
	{
		if($_POST['zt']==7)
		{
			$TJ.=" and dh.laiy=2 and dh.lx is null ";
			$yxd="checked";
		}
		else if($_POST['zt']==8)
		{
			$TJ.=" and dh.lx=2 and dh.zt in(0,2) ";
			$yqr="checked";
		}
		else if($_POST['zt']==9)
		{
			$TJ.=" and dh.zt=1 ";
			$ysh="checked";
		}
	}
	$top="";
}
else
{
	//$rq1=date("Y-m-d");$rq2=date('Y-m-d',strtotime("+1 day"));
	$_SESSION['DT1']=date("Y-m-d");$_SESSION['DT2']=date('Y-m-d',strtotime("+1 day"));
	$top=" top 10 ";//没选条件默认前10
	$TJ="";
}
$kehid=$_SESSION['unitid'];
$query="select shortname,typef,typea from sys_unit where id=".$kehid;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$kehmc=$line[0];$mos=$line[1];$kehflid=$line[2];//客户信息
sqlsrv_free_stmt($result);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title><?php echo $kehmc,'-订单查询';?></title>
<script>document.addEventListener('WeixinJSBridgeReady',function onBridgeReady(){WeixinJSBridge.call('hideOptionMenu');});</script>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="./js/style_sz.css" rel="stylesheet" type="text/css">
    <style>
        .showtable {overflow-x:scroll;margin:0;padding:0;background-color: #ecf7fd; -webkit-overflow-scrolling: touch; }
	table {width: auto; border-collapse: collapse; border: 1px solid #c3c3c3;font-size:16px;}
	table td, table th { border: 1px solid #c3c3c3;white-space: nowrap;font-size:16px;}
	table td input{font-size:20px;}
</style>
</head>
<body id="cardintegral" class="mode_webapp" style="margin:0px">
<div class="jifen-box header_highlight">
<div class="tab month_sel"><span class="jlp2">&nbsp;<p>可左右滑动下表,点列名排序,点对应行查明细</p></span><a class="jlp3" href="I_Xiad.php"></a></div>
<form action="" method="POST" id="tf">
<input id="paix" name="paix" type="hidden" value="<?php echo $paix;?>"></input>
<input id="scroll" name="scroll" type="hidden" value="<?php echo $scroll;?>"></input>
<ul class="round" id="notice2">
<table style="border:0px;margin:0;padding:0;">
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>起始日期:<input type="date" name="dt1" value="<?php echo $_SESSION['DT1'];?>" style="font-size:16px;"></h2></td><td  style="border:0px;margin:0;padding:0;" align=center rowspan=3><a href="javascript:tij()"><img src="images/search.gif" border="0" height="30" width="70" align="absbottom"></a></td></tr>
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>终止日期:<input type="date" name="dt2" value="<?php echo $_SESSION['DT2'];?>" style="font-size:16px;"></h2></td></tr>
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>单据状态:&nbsp;&nbsp;已下单<input type="radio" name="zt" value="7" <?php echo $yxd;?>>&nbsp;&nbsp;&nbsp;&nbsp;已确认<input type="radio" name="zt" value="8" <?php echo $yqr;?>>&nbsp;&nbsp;&nbsp;&nbsp;已审核<input type="radio" name="zt" value="9" <?php echo $ysh;?>></h2></td></tr>
</table>
</ul>
<div class="showtable" id="showtable"><div style="padding: 1px 0; margin: 0;">
<table align="center" cellspacing="1" cellpadding="3" border="0" style="background-color: #c6d8ee; padding: 0; margin: 0;">
<thead align="center">
<tr style="font-size: 13px; line-height: normal;">
<?php
	$lie=array('0','1','状态','日期','单号','订量','配送','实收','金额');
	for($i=2;$i<count($lie);$i++)//上面第3位置开始依次从左到右的列名
	{$f='';if($paix==$i.' desc') $f="↓"; else if($paix==$i) $f="↑";echo '<th onclick="javascript:s(',$i,')">',$lie[$i],$f,'</th>';}
?>
</tr>
</thead>
<tbody style="background-color: #eef5fd;line-height: normal;">
<?php
$query="select ".$top." dh.id,case when dh.laiy=2 and dh.lx is null then '已下单' when dh.zt=1 then '<font color=red>已审核' else '<font color=blue>已确认' end,CONVERT(varchar(10),dh.dhrq,120),dh.dh,sum(sj.dinghl),sum(sj.songhl),sum(sj.shisl),sum(sj.shisje) from sys_jhdh dh,sys_jhsj sj,sys_cp cp
where cp.id=sj.mc and cp.mc not in('周转筐') and dh.id=sj.dhid and (dh.lx=2 or dh.laiy=2) and dh.unit=".$kehid.$TJ." group by dh.id,dh.dh,dh.laiy,dh.lx,dh.zt,dh.dhrq order by ".$paix;
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
		echo '<tr onclick="mx(',$line[0],')"><td>',$line[1],'</td><td>',$line[2],'</td><td>',$line[3],'</td><td align=right>',$line[4],'</td><td align=right>',$line[5],'</td><td>',$line[6],'</td><td>',$line[7],'</td></tr>';
}
sqlsrv_free_stmt($result);
?>
</tbody>
</table></div>
</div>
</div>
</div>
</form>
<script type="text/javascript">
function tij()
{
		document.getElementById("tf").submit();
}
function s(lie){
if(lie==document.getElementById("paix").value)
	document.getElementById("paix").value=lie+' desc';
else
	document.getElementById("paix").value=lie;
document.getElementById("scroll").value=document.getElementById("showtable").scrollLeft;//记录滚动位置
document.getElementById("tf").submit();
}
function mx(id)
{
	//location.href="I_ListMx.php?dhid="+id;
	location.href="I_ListMx.php?dhid="+id+"&dt1=<?php echo $_SESSION['DT1']."&dt2=".$_SESSION['DT2'];?>";

}
document.getElementById("showtable").scrollLeft=<?php echo $scroll;?>;
</script>
</body>
</html>
