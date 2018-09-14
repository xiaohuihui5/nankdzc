<?php 
require('./inc/xhead.php');
$CS=explode("#",$_SESSION['mac']);//0语句1数值2宽度3对齐4列名5标题6中眉7右眉
$query=$CS[0];
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$LM=explode(",",$CS[4]);
$Column=count($HJ);//取的总列数
?>
<head>
<?php 
echo "<title>",$CS[5],"</title>";
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
</head>
<BODY leftMargin=1  rightMargin=1 topMargin=0 marginheight="0" marginwidth="0" width="100%">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
<tr><td>
<p align="center"><br><font size=4><b><?php echo $CS[5];?></b></font><br><?php echo $CS[6];?></p>
<p align=left><?php echo $CS[7];?></p>
</td></tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
<?php 
echo "<tr>";
for($i=1;$i<$Column-2;$i++)
	{
		echo "<td align=center height=20><b>",$LM[$i],"</b></td>";
	}
echo "</tr>";
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$i=2;
$mid=0;
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	if($line[2]!=$tp1)
	{
		if($tp1!="")
			echo $beg,$mid,$end;
		$beg="<tr><td width=".$KD[1]." align=".$AL[1].">".$row."</td><td width=".$KD[2]." align=".$AL[2]." rowspan=";
		$mid=1;
		$end=">".$line[2]."</td>";
		for($i=3;$i<$Column-2;$i++)
		{
			$end.="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
		$end.="</tr>";
	}
	else
	{
		$end.="<tr><td width=".$KD[1]." align=".$AL[1].">".$row."</td>";
		for($i=3;$i<$Column-2;$i++)
		{
			$end.="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
		$end.="</tr>";
		$mid++;
	}
$tp1=$line[2];
}
if($mid!==0)
	echo $beg,$mid,$end;
sqlsrv_free_stmt($result);
?>
</table>
</body>
<script lanuage ="javascript">
	window.print();
</script>
