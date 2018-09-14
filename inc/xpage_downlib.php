<?php
function menuright($menuid)
{
	$query="select menuright from sys_menuright where empid=".$_SESSION['empid']." and menuid=".$menuid;
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	if($result===false)
		return 0;
	else
	{
		$line=sqlsrv_fetch_array($result);
		return $line[0];
	}
}
?>
