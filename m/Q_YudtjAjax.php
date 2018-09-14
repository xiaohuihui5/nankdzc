<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
</head>
<?php
require('./inc/xc_c.php');
//echo $_POST['rq'],$_POST['cpid'];
if($_POST['lx']==1)
{
$query="select 0,unit.shortname,sj.dinghl,sj.bz from sys_jhdh dh,sys_jhsj sj,sys_unit unit 
where sj.dinghl>0 and sj.mc=".$_POST['cpid']." and dh.id=sj.dhid and dh.unit=unit.id
 and dh.dhrq='".$_POST['rq']."' and dh.lx in(2,4) order by sj.dinghl desc";
$result=sqlsrv_query($conn,$query);
$str='<font color=blue>';
while($line=sqlsrv_fetch_array($result))
{
	$str=$str.'&nbsp;&nbsp;'.$line[1].'<font color=red>'.$line[2].'</font>'.$line[3].'<br>';
}
sqlsrv_free_stmt($result);
}else
{
$query="select 0,cp.mc,sj.dinghl,sj.bz from sys_jhdh dh,sys_jhsj sj,sys_cp cp 
where sj.dinghl>0 and dh.unit=".$_POST['cpid']." and dh.id=sj.dhid and sj.mc=cp.id
 and dh.dhrq='".$_POST['rq']."' and dh.lx in(2,4) order by sj.dinghl desc";
$result=sqlsrv_query($conn,$query);
$str='<font color=blue>';
while($line=sqlsrv_fetch_array($result))
{
	$str=$str.'&nbsp;&nbsp;'.$line[1].'<font color=red>'.$line[2].'</font>'.$line[3].'<br>';
}
sqlsrv_free_stmt($result);
}
echo $str;
?>
