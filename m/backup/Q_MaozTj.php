<?php
require('../inc/xhead.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>中用软件（移动版）</title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="css/mmy.js"></script>
<style type="text/css"> 
  body { margin:0px; }
</style>
<script language="javascript" src="../inc/xDate.js" type="text/javascript" charset="GB2312"></script>
</head>
<body onload="window.scrollTo(0,1);">
<form action="" method=post name="Frm">
<?php
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
}
//昨日存栏
$query="select sum(a.jiagts),sum(a.jiagzl) from sys_maozjg a where a.zhuz='良种' and a.lx in(42) and a.dhrq+1='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrtsa=$line[0];
	$zrzla=$line[1];
}
sqlsrv_free_stmt($result);
$query="select sum(a.jiagts),sum(a.jiagzl) from sys_maozjg a where a.zhuz='家猪' and a.lx in(42) and a.dhrq+1='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrtsb=$line[0];
	$zrzlb=$line[1];
}
sqlsrv_free_stmt($result);
//昨日存栏

//当天采购毛猪
$query="select sum(a.tous),sum(a.zhongl)  from sys_maoz a where a.zhuz='良种' and a.lx in(41) and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$maoztsa=$line[0];
	$maozzla=$line[1];
}
sqlsrv_free_stmt($result);
$query="select sum(a.tous),sum(a.zhongl)  from sys_maoz a where a.zhuz='家猪' and a.lx in(41) and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$maoztsb=$line[0];
	$maozzlb=$line[1];
}
sqlsrv_free_stmt($result);
//当天采购毛猪


//当天加工存栏
$query="select sum(a.jiagts),sum(a.jiagzl),sum(a.fengts),sum(a.fengzl),sum(a.xiaoxts),sum(a.xiaoxzl),sum(a.jiests),sum(a.jieszl) from sys_maozjg a where a.lx in(42) and a.zhuz='良种' and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cltsa=$line[0];//当天存栏头数
	$clzla=$line[1];//当天存栏重量
	$fgtsa=$line[2];
	$fgzla=$line[3];
	$xxtsa=$line[4];
	$xxzla=$line[5];
	$jstsa=$line[6];
	$jszla=$line[7];
}
sqlsrv_free_stmt($result);

$query="select sum(a.jiagts),sum(a.jiagzl),sum(a.fengts),sum(a.fengzl),sum(a.xiaoxts),sum(a.xiaoxzl),sum(a.jiests),sum(a.jieszl) from sys_maozjg a where a.lx in(42) and a.zhuz='家猪' and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cltsb=$line[0];//当天存栏头数
	$clzlb=$line[1];//当天存栏重量
	$fgtsb=$line[2];
	$fgzlb=$line[3];
	$xxtsb=$line[4];
	$xxzlb=$line[5];
	$jstsb=$line[6];
	$jszlb=$line[7];
}
sqlsrv_free_stmt($result);
//当天加工存栏


$dangttsa=@sprintf("%1.2f",$zrtsa+$maoztsa-$cltsa);//良种当天加工头数
$dangtzla=@sprintf("%1.2f",$zrzla+$maozzla-$clzla);//良种当天加工重量

$dangttsb=@sprintf("%1.2f",$zrtsb+$maoztsb-$cltsb);//家猪当天加工头数
$dangtzlb=@sprintf("%1.2f",$zrzlb+$maozzlb-$clzlb);//家猪当天加工重量


$hjtsa=$fgtsa+$xxtsa+$jstsa;
$hjzla=$fgzla+$xxzla+$jszla;

$hjtsb=$fgtsb+$xxtsb+$jstsb;
$hjzlb=$fgzlb+$xxzlb+$jszlb;
?>
<div class="s_header"><div class="s_logo" onclick="window.location='Home.php';">&nbsp;</div></div>
<div class="i_footer">总利润按日报表</div>
<div align=center>日期:<input name="dt1" type="text" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:75px">
<input type=submit id=su value="查询"></div>
<div class="notice_front">
	<div id="news">
		<div class="i_c">
			<div class="b_05"></div>
			<div class="b_04"></div>
			<div class="b_03"></div>
			<div class="b_02"></div>
			<div class="i_cont">
<TABLE class="tableborder3">
<tr><th></th><th colspan=2>良种</th><th colspan=2>家猪</th></tr>
<tr onclick="k(this)">
	<td width=20% align=center></td>
	<td width=20% align=center>头数</td>
	<td width=20% align=center>重量</td>
	<td width=20% align=center>头数</td>
	<td width=20% align=center>重量</td>
</tr>

<tr onclick="k(this)">
	<td width=20% align=center>昨日库存</td>
	<td width=20% align=right><?php echo $zrtsa;?></td>
	<td width=20% align=right><?php echo $zrzla;?></td>
	<td width=20% align=right><?php echo $zrtsb;?></td>
	<td width=20% align=right><?php echo $zrzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>当天采购</td>
	<td width=20% align=right><?php echo $maoztsa;?></td>
	<td width=20% align=right><?php echo $maozzla;?></td>
	<td width=20% align=right><?php echo $maoztsb;?></td>
	<td width=20% align=right><?php echo $maozzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>当天存栏</td>
	<td width=20% align=right><?php echo $cltsa;?></td>
	<td width=20% align=right><?php echo $clzla;?></td>
	<td width=20% align=right><?php echo $cltsb;?></td>
	<td width=20% align=right><?php echo $clzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>当天屠宰</td>
	<td width=20% align=right><?php echo $dangttsa;?></td>
	<td width=20% align=right><?php echo $dangtzla;?></td>
	<td width=20% align=right><?php echo $dangttsb;?></td>
	<td width=20% align=right><?php echo $dangtzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>分割屠宰</td>
	<td width=20% align=right><?php echo $fgtsa;?></td>
	<td width=20% align=right><?php echo $fgzla;?></td>
	<td width=20% align=right><?php echo $fgtsb;?></td>
	<td width=20% align=right><?php echo $fgzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>小线屠宰</td>
	<td width=20% align=right><?php echo $xxtsa;?></td>
	<td width=20% align=right><?php echo $xxzla;?></td>
	<td width=20% align=right><?php echo $xxtsb;?></td>
	<td width=20% align=right><?php echo $xxzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>接市屠宰</td>
	<td width=20% align=right><?php echo $jstsa==0?"":$jstsa;?></td>
	<td width=20% align=right><?php echo $jszla;?></td>
	<td width=20% align=right><?php echo $jstsb;?></td>
	<td width=20% align=right><?php echo $jszlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>合计</td>
	<td width=20% align=right><?php echo $hjtsa;?></td>
	<td width=20% align=right><?php echo $hjzla;?></td>
	<td width=20% align=right><?php echo $hjtsb;?></td>
	<td width=20% align=right><?php echo $hjzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>差头数</td>
	<td width=20% align=center colspan=2><?php echo $hjtsa-$dangttsa;?></td>
	<td width=20% align=center colspan=2><?php echo $hjtsb-$dangttsb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>成数</td>
	<td width=20% align=center colspan=2><?php echo @sprintf("%1.2f",$hjzla/$dangtzla);?></td>
	<td width=20% align=center colspan=2><?php echo @sprintf("%1.2f",$hjzlb/$dangtzlb);?></td>
</tr>
<tr onclick="k(this)"><td colspan=5>备注:&nbsp;&nbsp;&nbsp;
<br><font color=red>
当天屠宰=昨日库存+当天采购-当天存栏<br>
合计=分割屠宰+小线屠宰+接市屠宰<br>
差头数=合计头数-当天屠宰头数<br>
成数=合计重量/当天屠宰重量
</td></tr>
</table>
			</div>
			<div class="b_02"></div>
			<div class="b_03"></div>
			<div class="b_04"></div>
			<div class="b_05"></div>
		</div>
	</div>
</div>
<div class="i_footer"><a href="../New_AllIndex.php">电脑版</a></div>
<div class="i_footer">技术支持：深圳市中用软件科技有限公司</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
