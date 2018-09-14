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
$TJ="";
if(isset($_POST['gongsid']) and $_POST['gongsid']!="")
	$TJ.=" and gongsid in(".$_POST['gongsid'].") ";
$sl='';
$query="select sum(tous) from sys_cunl where rq='".$_SESSION['DT1']."' ".$TJ;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$sl=$line[0];
}       
sqlsrv_free_stmt($result);

$query="select sum(isnull(shiss,0)),sum(isnull(shisl,0)),sum(isnull(je,0)) from sys_shengz where unit>0 and dhrq+1='".$_SESSION['DT1']."' ".$TJ;//采购生猪
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$junz=sprintf("%1.1f",$line[1]/$line[0]);//均重
	$junj=sprintf("%1.2f",$line[2]/$line[1]);//均价
}       
sqlsrv_free_stmt($result);
?>
<div class="s_header"><div class="s_logo" onclick="window.location='Home.php';">&nbsp;</div></div>
<div class="i_footer">生猪存栏情况查询</div>
<div align=center>存栏日期:<input name="dt1" type="text" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:75px">
<select style="width:70px" name="gongsid"><option value="">公司不限</option><option value=1 <?php echo isset($_POST['gongsid'])&&$_POST['gongsid']==1?"selected":"";?>>瑞昌</option><option value=2 <?php echo isset($_POST['gongsid'])&&$_POST['gongsid']==2?"selected":"";?>>龙岗</option></select>
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
<tr><th colspan=2>&nbsp;&nbsp;&nbsp;</th></tr>
<tr onclick="k(this)"><td align="right"><b>头数：</b></th><td><?php echo $sl;?></td></tr>
<tr onclick="k(this)"><td align="right"><b>头均重：</b></th><td><?php echo $junz;?></td></tr>
<tr onclick="k(this)"><td align="right"><b>总重：</b></th><td><?php echo $sl*$junz;?></td></tr>
<tr onclick="k(this)"><td align="right"><b>头均价：</b></th><td><?php echo $junj;?></td></tr>
<tr onclick="k(this)"><td align="right"><b>存栏金额：</b></th><td><?php echo $sl*$junz*$junj;?></td></tr>
</table>
			</div>
			<div class="b_02"></div>
			<div class="b_03"></div>
			<div class="b_04"></div>
			<div class="b_05"></div>
		</div>
	</div>
</div>
<div class="i_footer">&nbsp;</div>

<div class="i_footer"><a href="../New_AllIndex.php">电脑版</a></div>
<div class="i_footer">技术支持：深圳市中用软件科技有限公司</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
