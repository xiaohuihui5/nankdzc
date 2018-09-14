<?php
require('./inc/xhead.php');

?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<form action="" method=post name="Frm">
<table border="1" class="tableborder3">
<?php
require('Q_Sell-1.php');
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and gys.id in(".$_POST['gysid'].") ";
if(isset($_POST['paix']) and $_POST['paix']!="")//排序
	$px=$_POST['paix'];
else
	$px="gys.shortname,xfl.fenlmc,cp.mc";
$_SESSION['mac']="select 0,0,gys.shortname,xfl.fenlmc,cp.mc,cp.gg,sum(sj.dinghl-isnull(sj.jiad,0)),case when sj.fudw is null then cp.dw else sj.fudw end from sys_jhdh dh,sys_jhsj sj,sys_cp cp,sys_unit unit,sys_cpxiaofl xfl,sys_unit gys where sj.gysid=gys.id and dh.id=sj.dhid and cp.id=sj.mc and cp.xiaofl=xfl.id and dh.unit=unit.id ".$TJ." and dh.lx=2 and cp.laiy not in(2) group by gys.shortname,xfl.fenlmc,cp.mc,cp.gg,sj.fudw,cp.dw having CAST(sum(sj.dinghl-isnull(sj.jiad,0)) as decimal(12,2))>0 order by ".$px;
//echo $_SESSION['mac']; 
$_SESSION['mac'].="#"."5,0,0,0,0,0,1,0";
$_SESSION['mac'].="#".",10%,15%,15%,15%,15%,15%,15%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",序,供应商,二级分类,产品名称,规格,订货合计,单位";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."预采购汇总单";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xNoCountdis.php");
?>
</form>	
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

