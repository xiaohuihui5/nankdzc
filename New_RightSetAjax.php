<?php
require('./inc/xhead.php');
$query='delete sys_menuright where menuid='.$_POST['mid'].' and empid='.$_POST['eid'];
sqlsrv_query($conn,$query);
	$query='select layer,topmenuid from sys_menu where menuid='.$_POST['mid'];
	$result=sqlsrv_query($conn,$query);
	$layer=0;
	$topmenuid=0;
	if($line=sqlsrv_fetch_array($result))
	{
	$layer=$line[0];
	$topmenuid=$line[1];
	}
	sqlsrv_free_stmt($result);
if($_POST['lx']!=0)
{
	$query='insert into sys_menuright values('.$_POST['eid'].','.$_POST['mid'].','.$_POST['lx'].')';
	sqlsrv_query($conn,$query);
	for($i=0;$i<$layer;$i++)//自动上级菜单
	{
	$query='insert into sys_menuright select '.$_POST['eid'].',menuid,1 from sys_menu where menuid not in(select menuid from sys_menuright where empid='.$_POST['eid'].') and topmenuid in(select max(topmenuid) from sys_menu where display=1 and layer='.$i.' and topmenuid<'.$topmenuid.')';
	sqlsrv_query($conn,$query);
	}
}
else
{
	//自动删除上级菜单
	$query='select top 1 menuid,topmenuid from sys_menu where  display=1 and url is null and topmenuid<'.$topmenuid.' and menuid in(select menuid from sys_menuright where empid='.$_POST['eid'].') order by topmenuid desc';
	echo $query.'<br>';
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$pre_id=$line[0];
	$pre_topmenuid=$line[1];
	$query='select top 1 menuid,topmenuid from sys_menu where  display=1 and url is null and topmenuid>'.$topmenuid.' and menuid in(select menuid from sys_menuright where empid='.$_POST['eid'].') order by topmenuid';
	echo $query.'<br>';
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]!="")
		$next_topmenuid=$line[1];
	else
		$next_topmenuid=9999;

	$query='select count(*) from sys_menu where display=1 and topmenuid>'.$pre_topmenuid.' and topmenuid<'.$next_topmenuid.' and menuid in(select menuid from sys_menuright where empid='.$_POST['eid'].') ';
	echo $query.'<br>';
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]==0)
	{
	$query='delete sys_menuright where menuid='.$pre_id.' and empid='.$_POST['eid'];
	echo $query.'<br>';
	sqlsrv_query($conn,$query);
	}
	//自动删除上级菜单
}
?>
