<?php
require('../inc/xhead.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>����������ƶ��棩</title>
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
//��ɽ��
$caig=0;
$query="select sum(sj.shisje)  from sys_jhdh dh,sys_jhsj sj,sys_cp cp where sj.mc=cp.id and cp.mc not in('����') and dh.id=sj.dhid and dh.lx in(1) and dh.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$caig=$line[0];
}
sqlsrv_free_stmt($result);
//��ɽ��
//�����ܽ�
$sell=0;
$chengb=0;
$query="select sum(sj.shisje),cast(sum(sj.songhl*sj.chengbdj) as decimal(9,2))  from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid and dh.lx in(2) and dh.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$sell=$line[0];
	$chengb=$line[1];
}
sqlsrv_free_stmt($result);
//�����ܽ�

//ë�����տ��
$query="select sum(a.jine),sum(a.jiagts) from sys_maozjg a where a.lx in(42) and a.dhrq+1='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrcunlje=$line[0];
	$zrcunlts=$line[1];
}
//ë�����տ��
//ë����ɹ�
$query="select cast(sum(a.jine) as decimal(9,2)),sum(a.tous) from sys_maoz a where a.lx in(41) and a.dhrq='".$_SESSION['DT1']."'";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$maozje=$line[0];
	$maozts=$line[1];
}
//ë����ɹ�
//ë�������
$query="select sum(a.jine),sum(a.jiagts) from sys_maozjg a where a.lx in(42) and a.dhrq='".$_SESSION['DT1']."'";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cunlje=$line[0];
	$cunlts=$line[1];
}
//ë�������

$query="select sum(shisje)  from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid and dh.lx in(5) and dh.dhrq+1='".$_SESSION['DT1']."'";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrkucje=$line[0];
}
//���ն�����

//���춳����
$query="select sum(shisje)  from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid and dh.lx in(5) and dh.dhrq='".$_SESSION['DT1']."'";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$dtkucje=$line[0];
}
//���춳����

$jzts=$zrcunlts+$maozts-$cunlts;
$jzje=$zrcunlje+$maozje-$cunlje;
//$zuotrq=date("Y-m-d",strtotime($_SESSION['DT1']."   -1   day"));//��������
?>
<div class="s_header"><div class="s_logo" onclick="window.location='Home.php';">&nbsp;</div></div>
<div class="i_footer">�������ձ���</div>
<div align=center>����:<input name="dt1" type="text" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:75px">
<input type=submit id=su value="��ѯ"></div>
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
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>�����ܽ�:</td><td width=30%><?php echo $sell;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right>���տ��:</td><td width=30%><?php echo $zrkucje;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>���տ��:</td><td width=30%><?php echo $dtkucje;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>�ɱ��ܽ�:</td><td width=30%><?php echo $chengb;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>����ͷ��:</td><td width=30%><?php echo $jzts;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>����ɱ�:</td><td width=30%><?php echo $jzje;?></td></tr>
<tr onclick="k(this)"><td width="70%" align=right><?php echo $_SESSION['DT1'];?>����ܽ�:</td><td width="30%"><?php echo $caig;?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>����ë��:</td><td width=30%><?php echo @sprintf("%1.2f",($chengb+$dtkucje-$zrkucje)-$caig-$jzje);?></td></tr>
<tr onclick="k(this)"><td width=70% align=right><?php echo $_SESSION['DT1'];?>����ë��:</td><td width=30%><?php echo @sprintf("%1.2f",$dtkucje-$zrkucje+$sell-$caig-$jzje);?></td></tr>
<tr onclick="k(this)"><td colspan=2>��ע:&nbsp;&nbsp;&nbsp;
<br><font color=red>
����ë��=(�ɱ��ܽ�+���տ��)�����տ�桪��ɡ�����ɱ�<br>
����ë��=(�����ܽ�+���տ��)�����տ�桪��ɡ�����ɱ�
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
<div class="i_footer">&nbsp;</div> <div class="i_footer"><a href="../New_AllIndex.php">���԰�</a></div>
<div class="i_footer">����֧�֣���������������Ƽ����޹�˾</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
