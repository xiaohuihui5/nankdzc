<table border="0" class="tableborder3">
<?php 
$CS=explode("#",$_SESSION['mac']);
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$ZJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$XJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$DJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$tp2="";
$mid[1]=0;
while($line=sqlsrv_fetch_array($result))
{
	if($line[1]!=$tp1)
	{
	$tw=8;
	if($tp1!="")
	{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";


				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr  onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td  width=".$KD[$i]." align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];

	for($i=$HJ[0]+1;$i<$Column;$i++)
		{
		$XJ[$i]=0;
		$ZJ[$i]=0;
		}
	}
	$beg[1]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'  rowspan=';
	$mid[1]=1;
	$beg[3]=">".$line[1]."</td>";
	$beg[3].="<td width=".$KD[2]." align=".$AL[2]." rowspan=";
	$mid[3]=1;
	$end[3]=">".$line[2]."</td>";
	$end[1]="";
	for($i=3;$i<$Column;$i++)
		{
			$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	$tp2=$line[2];
	$beg[2]="";
	$mid[2]="";
	$end[2]="";
	}
	else
	{
		if($line[2]!=$tp2)
		{
			if(($mid[3]>1)and($tw==8))//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			for($i=$HJ[0]+1;$i<$Column;$i++)
				$XJ[$i]=0;
			if($tp2!="")
				$end[1].=$beg[2].$mid[2].$end[2];

	$beg[2]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[2].' align='.$AL[2].' rowspan=';
	$mid[2]=1;
	$mid[1]++;
	$end[2]=">".$line[2]."</td>";

	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$tw=0;
		}
		else
		{
	$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">';
	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$mid[1]++;
	if($tw==8)
		$mid[3]++;
	else
		$mid[2]++;
		}
	$tp2=$line[2];
	}
$tp1=$line[1];
for($i=1;$i<$Column;$i++)//小计,中计,总计
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		$DJ[$i]+=$line[$i];
		}
	}
}//while语句结束
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td width=".$KD[$i]."  align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];
if($tp1!="")
	{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan=',$HJ[0],'  align=center><font color=red>总合计</font></td>';

			for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					echo "<td width=",$KD[$i],"  align=right><font color=red>",$DJ[$i],"</td>";
				else
					echo "<td width=",$KD[$i]," ></td>";
				}
				echo "</tr>";
	}
}
?>
</table>
