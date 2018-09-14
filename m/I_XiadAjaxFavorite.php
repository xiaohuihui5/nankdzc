<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$kehid=$_SESSION['unitid'];
if(isset($_POST['cpid']))
{
		$query="if exists (select id from weix_changy where useid=".$kehid." and cpid=".$_POST['cpid'].") 
delete weix_changy where useid=".$kehid." and cpid=".$_POST['cpid']." else 
insert into weix_changy(useid,cpid) values(".$kehid.",".$_POST['cpid'].")";
sqlsrv_query($conn,$query);
}
?>
