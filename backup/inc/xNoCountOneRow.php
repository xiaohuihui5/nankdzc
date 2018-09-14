<table border="0" class="tableborder3">
<?php 
$CS=explode("#",$_SESSION['mac']);
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	$TMP="<tr onclick='k(this)' onMouseOver='v(this)' onMouseOut='o(this)'><td width=".$KD[1]." align=".$AL[1].">".$row."</td>";
	for($i=2;$i<$Column;$i++)
	{
		$TMP.="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
	}
	echo $TMP,"</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
