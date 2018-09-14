<table border="0" class="tableborder3">
<?php
$CS=explode('#',$macmac);
$HJ=explode(',',$CS[1]);
$KD=explode(',',$CS[2]);
$AL=explode(',',$CS[3]);
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
}
if($mid!=0) echo $beg,$mid,$end;
sqlsrv_free_stmt($result);
?>
</table>

