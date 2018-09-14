<table border="0" class="tableborder3">
<?php
$CS=explode('#',$macmac);
$HJ=explode(',',$CS[1]);
$KD=explode(',',$CS[2]);
$AL=explode(',',$CS[3]);
$Qh=explode(',',$CS[6]);
$Column2=count($Qh);//取的总列数

$Column=count($HJ);//取的总列数
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1='';
$mid=0;
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	if($line[2]!=$tp1)
	{
		if($tp1!='') echo $beg,$mid,$end;
		$beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td><td width='.$KD[2].' align='.$AL[2].' rowspan=';
		$mid=1;
		$end='>'.$line[2].'</td>';
		for($i=3;$i<$Column;$i++)
		{
		if($HJ[$i]==1)
			$end.='<td onclick=\'javascript:mx('.$line[0].')\' width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
		else
			$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
		}
		$end.='</tr>';
	}
	else
	{
		$end.='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td>';
		for($i=3;$i<$Column;$i++)
		{
		if($HJ[$i]==1)
			$end.='<td onclick=\'javascript:mx('.$line[0].')\' width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
		else
			$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
		}
		$end.='</tr>';
		$mid++;
	}
$tp1=$line[2];
for($i=1;$i<$Column;$i++)
	{
	if($Qh[$i]==1)
		{
		$ZJ[$i]+=$line[$i];
		}
	}

}
if($mid!=0) echo $beg,$mid,$end;

if($tp1!="")
{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td align=center colspan=',$Qh[0],'><font color=red>总 计</td>';
		for($i=$Qh[0]+1;$i<$Column;$i++)
			{
			if($Qh[$i]==1)
				echo "<td align=right><font color=red>",$ZJ[$i],"</td>";
			else
				echo "<td></td>";
			}
		echo "</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>

