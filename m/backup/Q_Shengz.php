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
<title>����������ƶ��棩</title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<script language="javascript" src="css/mmy.js"></script>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
  body { margin:0px; }
</style>
<script language="javascript" src="../inc/xDate.js" type="text/javascript" charset="GB2312"></script>
</head>
<body onload="window.scrollTo(0,1);">
<form action="" method=post name="Frm">
<div class="s_header"><div class="s_logo" onclick="window.location='Home.php';">&nbsp;</div></div>
<div class="i_footer">ë��ɹ����ݲ�ѯ</div>
<div align=center><input name="dt1" type="text" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:75px">��<input name="dt2" type="text" id="dt2" value="<?php echo $_SESSION['DT2'];?>" onclick="calendar(this)" style="width:75px">
ģ��:<input name="cxtj" style="width:40px" value="<?php echo $_POST['cxtj'];?>">
<input type=submit id=su value="��ѯ"><input name="lie" id="lie" value="<?php echo isset($_POST['lie'])?$_POST['lie']:"";?>" type="hidden"><input name="sx" id="sx" value="<?php echo isset($_POST['sx'])?$_POST['sx']:"";?>" type="hidden"></div>
<div class="notice_front">
	<div id="news">
		<div class="i_c">
			<div class="b_05"></div>
			<div class="b_04"></div>
			<div class="b_03"></div>
			<div class="b_02"></div>
			<div class="i_cont">
<?php
$TJ=" and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.shortname like '%".$_POST['cxtj']."%' ";


if(!isset($_POST['lie']) || $_POST['lie']=="")//��ʼ����Ϊ��2���ֶ�,����
{
	$_POST['lie']=2;//��ѯ���ڶ����ֶ�
	$_POST['sx']="";//����,������desc
}
$macm="select 0,right(convert(varchar(10),dh.dhrq,120),5) as rq,unit.shortname,sum(dh.tous),cast(sum(dh.zhongl) as int),cast(sum(dh.jine)/sum(dh.zhongl) as decimal(10,2)) as dj,cast(sum(dh.jine) as int) as je from sys_maoz dh,sys_unit unit where dh.gongysid=unit.id ".$TJ." group by dh.dhrq,unit.shortname order by ".$_POST['lie'].$_POST['sx'];
$macm.="#"."2,0,0,1,1,0,1";//ǰ��2��ʾ��2����ʼ�ϼ�,���������1��ʾҪ�ϼ�
$macm.="#".",,,,,,";//�ٷֱ�
$macm.="#".",center,left,right,right,right,right";
$macm.="#".",����,��Ӧ��,ͷ��,����,����,���";
$macm.="#".",2,3,4,5,6,7";//����
$macm.="#";
include('./css/mNoCountOneRow.php');
?>
			</div>
			<div class="b_02"></div>
			<div class="b_03"></div>
			<div class="b_04"></div>
			<div class="b_05"></div>
		</div>
	</div>
</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer"><a href="../New_AllIndex.php">���԰�</a></div>
<div class="i_footer">����֧�֣���������������Ƽ����޹�˾</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
<div class="i_footer">&nbsp;</div>
</form>
</body>
</html>
