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
//���մ���
$query="select sum(a.jiagts),sum(a.jiagzl) from sys_maozjg a where a.zhuz='����' and a.lx in(42) and a.dhrq+1='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrtsa=$line[0];
	$zrzla=$line[1];
}
sqlsrv_free_stmt($result);
$query="select sum(a.jiagts),sum(a.jiagzl) from sys_maozjg a where a.zhuz='����' and a.lx in(42) and a.dhrq+1='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$zrtsb=$line[0];
	$zrzlb=$line[1];
}
sqlsrv_free_stmt($result);
//���մ���

//����ɹ�ë��
$query="select sum(a.tous),sum(a.zhongl)  from sys_maoz a where a.zhuz='����' and a.lx in(41) and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$maoztsa=$line[0];
	$maozzla=$line[1];
}
sqlsrv_free_stmt($result);
$query="select sum(a.tous),sum(a.zhongl)  from sys_maoz a where a.zhuz='����' and a.lx in(41) and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$maoztsb=$line[0];
	$maozzlb=$line[1];
}
sqlsrv_free_stmt($result);
//����ɹ�ë��


//����ӹ�����
$query="select sum(a.jiagts),sum(a.jiagzl),sum(a.fengts),sum(a.fengzl),sum(a.xiaoxts),sum(a.xiaoxzl),sum(a.jiests),sum(a.jieszl) from sys_maozjg a where a.lx in(42) and a.zhuz='����' and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cltsa=$line[0];//�������ͷ��
	$clzla=$line[1];//�����������
	$fgtsa=$line[2];
	$fgzla=$line[3];
	$xxtsa=$line[4];
	$xxzla=$line[5];
	$jstsa=$line[6];
	$jszla=$line[7];
}
sqlsrv_free_stmt($result);

$query="select sum(a.jiagts),sum(a.jiagzl),sum(a.fengts),sum(a.fengzl),sum(a.xiaoxts),sum(a.xiaoxzl),sum(a.jiests),sum(a.jieszl) from sys_maozjg a where a.lx in(42) and a.zhuz='����' and a.dhrq='".$_SESSION['DT1']."' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$cltsb=$line[0];//�������ͷ��
	$clzlb=$line[1];//�����������
	$fgtsb=$line[2];
	$fgzlb=$line[3];
	$xxtsb=$line[4];
	$xxzlb=$line[5];
	$jstsb=$line[6];
	$jszlb=$line[7];
}
sqlsrv_free_stmt($result);
//����ӹ�����


$dangttsa=@sprintf("%1.2f",$zrtsa+$maoztsa-$cltsa);//���ֵ���ӹ�ͷ��
$dangtzla=@sprintf("%1.2f",$zrzla+$maozzla-$clzla);//���ֵ���ӹ�����

$dangttsb=@sprintf("%1.2f",$zrtsb+$maoztsb-$cltsb);//������ӹ�ͷ��
$dangtzlb=@sprintf("%1.2f",$zrzlb+$maozzlb-$clzlb);//������ӹ�����


$hjtsa=$fgtsa+$xxtsa+$jstsa;
$hjzla=$fgzla+$xxzla+$jszla;

$hjtsb=$fgtsb+$xxtsb+$jstsb;
$hjzlb=$fgzlb+$xxzlb+$jszlb;
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
<tr><th></th><th colspan=2>����</th><th colspan=2>����</th></tr>
<tr onclick="k(this)">
	<td width=20% align=center></td>
	<td width=20% align=center>ͷ��</td>
	<td width=20% align=center>����</td>
	<td width=20% align=center>ͷ��</td>
	<td width=20% align=center>����</td>
</tr>

<tr onclick="k(this)">
	<td width=20% align=center>���տ��</td>
	<td width=20% align=right><?php echo $zrtsa;?></td>
	<td width=20% align=right><?php echo $zrzla;?></td>
	<td width=20% align=right><?php echo $zrtsb;?></td>
	<td width=20% align=right><?php echo $zrzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>����ɹ�</td>
	<td width=20% align=right><?php echo $maoztsa;?></td>
	<td width=20% align=right><?php echo $maozzla;?></td>
	<td width=20% align=right><?php echo $maoztsb;?></td>
	<td width=20% align=right><?php echo $maozzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>�������</td>
	<td width=20% align=right><?php echo $cltsa;?></td>
	<td width=20% align=right><?php echo $clzla;?></td>
	<td width=20% align=right><?php echo $cltsb;?></td>
	<td width=20% align=right><?php echo $clzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>��������</td>
	<td width=20% align=right><?php echo $dangttsa;?></td>
	<td width=20% align=right><?php echo $dangtzla;?></td>
	<td width=20% align=right><?php echo $dangttsb;?></td>
	<td width=20% align=right><?php echo $dangtzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>�ָ�����</td>
	<td width=20% align=right><?php echo $fgtsa;?></td>
	<td width=20% align=right><?php echo $fgzla;?></td>
	<td width=20% align=right><?php echo $fgtsb;?></td>
	<td width=20% align=right><?php echo $fgzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>С������</td>
	<td width=20% align=right><?php echo $xxtsa;?></td>
	<td width=20% align=right><?php echo $xxzla;?></td>
	<td width=20% align=right><?php echo $xxtsb;?></td>
	<td width=20% align=right><?php echo $xxzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>��������</td>
	<td width=20% align=right><?php echo $jstsa==0?"":$jstsa;?></td>
	<td width=20% align=right><?php echo $jszla;?></td>
	<td width=20% align=right><?php echo $jstsb;?></td>
	<td width=20% align=right><?php echo $jszlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>�ϼ�</td>
	<td width=20% align=right><?php echo $hjtsa;?></td>
	<td width=20% align=right><?php echo $hjzla;?></td>
	<td width=20% align=right><?php echo $hjtsb;?></td>
	<td width=20% align=right><?php echo $hjzlb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>��ͷ��</td>
	<td width=20% align=center colspan=2><?php echo $hjtsa-$dangttsa;?></td>
	<td width=20% align=center colspan=2><?php echo $hjtsb-$dangttsb;?></td>
</tr>
<tr onclick="k(this)">
	<td width=20% align=center>����</td>
	<td width=20% align=center colspan=2><?php echo @sprintf("%1.2f",$hjzla/$dangtzla);?></td>
	<td width=20% align=center colspan=2><?php echo @sprintf("%1.2f",$hjzlb/$dangtzlb);?></td>
</tr>
<tr onclick="k(this)"><td colspan=5>��ע:&nbsp;&nbsp;&nbsp;
<br><font color=red>
��������=���տ��+����ɹ�-�������<br>
�ϼ�=�ָ�����+С������+��������<br>
��ͷ��=�ϼ�ͷ��-��������ͷ��<br>
����=�ϼ�����/������������
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
<div class="i_footer"><a href="../New_AllIndex.php">���԰�</a></div>
<div class="i_footer">����֧�֣���������������Ƽ����޹�˾</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
