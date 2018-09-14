<?php
session_start();
//$conn=sqlsrv_connect("127.0.0.1,7777",$coninfo);
require('xc_c.php');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
//$_SESSION["empid"]=null;
//if(!isset($_SESSION['empid']))
//	header('Location:./login.html');
//if(empty($_SESSION['empid'])){
	//header('Location:./login.php');
//}
include("./backup/inc/common.php");
$day = date("Y-m-d");
$dayh = date("Y-m-d",strtotime("+1 day"));
?>
