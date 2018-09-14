<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
include("inc/xc_c.php");
if (isset($_REQUEST['mac']))
{
	$query="select count(*) from sys_mac where state=1 and mac='".$_REQUEST['mac']."'";
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if ($line[0]==1)
		echo "okok";
	else
	{
	$query="select count(*) from sys_mac where mac='".$_REQUEST['mac']."'";
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if ($line[0]==0)
		{
		$query="insert into sys_mac(mac,state) values('".$_REQUEST['mac']."',0)";
		@sqlsrv_query($conn,$query);
		}
	echo "xxxxxxxxxxxx";
	}
}
else
	echo "xxxxxxxxxxxx";
?>
