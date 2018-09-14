<table border="0" class="tableborder3">
<?php 
$CS=explode("#",$_SESSION['mac']);
$ZJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$XJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$i=2;
$mid[1]=0;
while($line=sqlsrv_fetch_array($result))
{
	if($line[1]!=$tp1)
	{
		if($tp1!="")
		{
		echo $beg[1],$mid[1],$end[1];
		if($mid[1]>=1)
		{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td align=center colspan=',$HJ[0],'><font color=red>',$tp1,'小计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo '<td align=right><font color=red>',$XJ[$i],'</td>';
			else
				echo '<td></td>';
			}
		echo '</tr>';
		}
		for($i=$HJ[0]+1;$i<$Column;$i++)
			$XJ[$i]=0;
	}
	$beg[1]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].' rowspan=';
	$mid[1]=1;
	$end[1]='>'.$line[1].'</td>';
	for($i=2;$i<$Column;$i++)
		{
		$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	}
	else
	{
	$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">';
	for($i=2;$i<$Column;$i++)
		{
		$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	$mid[1]++;
	}
$tp1=$line[1];
for($i=1;$i<$Column;$i++)
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		}
	}
}
if($mid[1]!==0)
	echo $beg[1],$mid[1],$end[1];
if($mid[1]>=1)
{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td align=center colspan=',$HJ[0],'><font color=red>',$tp1,'小计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo "<td align=right><font color=red>",$XJ[$i],"</td>";
			else
				echo "<td></td>";
			}
		echo "</tr>";
}
if($tp1!="")
{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td align=center colspan=',$HJ[0],'><font color=red>总 计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo "<td align=right><font color=red>",$ZJ[$i],"</td>";
			else
				echo "<td></td>";
			}
		echo "</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
