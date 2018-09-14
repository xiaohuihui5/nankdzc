<?php
require('../inc/xhead.php');
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
}
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
<div class="s_header"><div class="s_logo" onclick="window.location='Home.php';">&nbsp;</div></div>
<div class="i_footer">分割配送数据对比</div>
<div align=center><input name="dt1" type="text" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:75px">至<input name="dt2" type="text" id="dt2" value="<?php echo $_SESSION['DT2'];?>" onclick="calendar(this)" style="width:75px">
<input type=submit id=su value="查询"></div>

<?php
$TJ="and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
$QQ="and fg.fgrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";

//冷库出库量
$query="select sum(sj.shisl) from sys_jhdh dh,sys_jhsj sj where dh.lx=25 and dh.id=sj.dhid ".$TJ;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$Lengkckl=$line[0];
sqlsrv_free_stmt($result);
//冷库出库量
//外采量
$query="select sum(sj.shisl) from sys_jhdh dh,sys_jhsj sj where dh.lx=1 and dh.id=sj.dhid ".$TJ;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$Waicl=$line[0];
sqlsrv_free_stmt($result);
//外采量
//当天分割猪、小线边猪量
$query="select sum(dh.fengzl),sum(dh.xiaoxzl) from sys_maozjg dh where dh.lx=42 ".$TJ;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$Fengzl=$line[0];
	$Xiaoxzl=$line[1];
sqlsrv_free_stmt($result);
//当天分割猪、小线边猪量
//冷库进库量
$query="select sum(sj.shisl) from sys_jhdh dh,sys_jhsj sj where dh.lx=15 and dh.id=sj.dhid ".$TJ;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$Lengkjkl=$line[0];
sqlsrv_free_stmt($result);
//冷库进库量

$query="select sum(fg.fengl) from sys_fengsj fg where 2>1 ".$QQ;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$fengl=$line[0];
sqlsrv_free_stmt($result);


$query="select sum(sj.songhl) from sys_jhdh dh,sys_jhsj sj where dh.lx=2 and dh.id=sj.dhid ".$TJ;//每个分类包含的客户数
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$fahl=$line[0];
sqlsrv_free_stmt($result);

?>
<div class="notice_front">
	<div id="news">
		<div class="i_c">
			<div class="b_05"></div>
			<div class="b_04"></div>
			<div class="b_03"></div>
			<div class="b_02"></div>
			<div class="i_cont">
<TABLE class="tableborder3">
<tr><th colspan=2>&nbsp;&nbsp;&nbsp;</th></tr>
<tr onclick="k(this)"><td width=70% align=right>冷库出库量:</td><td width=30%><?php echo $Lengkckl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>外采量:</td><td width=30%><?php echo $Waicl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>当天分割猪:</td><td width=30%><?php echo $Fengzl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>小线边猪:</td><td width=30%><?php echo $Xiaoxzl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>冷库进库量:</td><td width=30%><?php echo $Lengkjkl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>车间成本:</td><td width=30%><?php echo @sprintf("%1.2f",$Lengkckl+$Waicl+$Fengzl+$Xiaoxzl-$Lengkjkl);?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>分割量:</td><td width=30%><?php echo $fengl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>分割差量:</td><td width=30%><?php echo @sprintf("%1.2f",$fengl-($Lengkckl+$Waicl+$Fengzl+$Xiaoxzl-$Lengkjkl));?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>分割差量率:</td><td width=30%><?php echo @sprintf("%1.2f",100*($fengl-($Lengkckl+$Waicl+$Fengzl+$Xiaoxzl-$Lengkjkl))/($Lengkckl+$Waicl+$Fengzl+$Xiaoxzl-$Lengkjkl));?>%</td></tr>
<tr onclick="k(this)"><td width=70% align=right>发货量:</td><td width=30%><?php echo $fahl;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>发货差量:</td><td width=30%><?php echo @sprintf("%1.2f",$fahl-$fengl);?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>发货差量率:</td><td width=30%><?php echo @sprintf("%1.2f",100*($fahl-$fengl)/$fengl);?>%</td></tr>
<tr onclick="k(this)"><td colspan=2>备注:&nbsp;&nbsp;&nbsp;
<br><font color=red>
车间成本=冷库出库量+外采量+当天分割猪+小线边猪-冷库进库量<br>
分割差量=分割量-车间成本<br>
分割差量率=100*(分割量-车间成本)/车间成本<br>
发货差量=发货量-分割量<br>
发货差量率=100*(发货量-分割量)/分割量
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
<div class="i_footer">&nbsp;</div> <div class="i_footer"><a href="../New_AllIndex.php">电脑版</a></div>
<div class="i_footer">技术支持：深圳市中用软件科技有限公司</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
