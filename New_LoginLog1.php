<?php
require('./inc/xhead.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:'';?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
if(isset($_POST['paix']) and $_POST['paix']!="")
	$px=$_POST['paix'];
else
	$px="1 desc";
$TJ="";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and emp.name+login.vip+login.nam+login.mac like '%".$_POST['cxtj']."%' ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
	$TJ.=" and login.logintime>'".$_POST['dt1']."' and login.logintime-1<'".$_POST['dt2']."' ";
else
	$TJ.=" and login.logintime+2>'".date('Y-m-d')."' ";
$_SESSION['mac']="select login.id,0,case emp.sex when 0 then '<IMG border=0 src=im/man.gif>' else '<IMG border=0 src=im/woman.gif>' end+emp.name,login.vip,login.nam,login.mac,CONVERT(varchar(19),login.logintime,120),CONVERT(varchar(19),login.logouttime,120),login.state from sys_user emp,sys_login login where emp.empid=login.empid ".$TJ." order by ".$px;
$_SESSION['mac'].="#"."8,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,10%,15%,17%,18%,15%,15%,5%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序号,用户姓名,登录IP,机器名,验证码,登录时间,退出时间,状态";
$_SESSION['mac'].="#用户登录日志";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include('./inc/xNoCountdis.php');
?>
</form>	
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>