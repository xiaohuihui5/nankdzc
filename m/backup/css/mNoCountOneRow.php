<table class="tableborder3">
<?php 
$CS=explode("#",$macm);
$HJ=explode(",",$CS[1]);//是否合计
$KD=explode(",",$CS[2]);//百分比
$AL=explode(",",$CS[3]);//对齐
$BT=explode(",",$CS[4]);//列标题
$PX=explode(",",$CS[5]);//排序
$Column=count($HJ);
$tmp='<tr>';
for($i=1;$i<$Column;$i++)
{
	if($PX[$i]!='')//此列需要排序
	{
		$BT[$i]="<a href=javascript:s(".$PX[$i].")><font color=white>".$BT[$i];
		if(isset($_POST['lie']) and $_POST['lie']==$PX[$i])
		{
			if($_POST['sx']=="desc")
				$BT[$i]=$BT[$i]."</font><font color=red>↓";
			else
				$BT[$i]=$BT[$i]."</font><font color=red>↑";
		}
	}
	if($KD[$i]=='')
		$tmp.='<th align="center" height="20"><b>'.$BT[$i].'</b></th>';
	else
		$tmp.='<th align="center" width="'.$KD[$i].'" height="20"><b>'.$BT[$i].'</b></th>';
	if($HJ[$i]==1)	$XJ[$i]=0;//置0
}
echo $tmp,'</tr>';
$dishj=0;//是否显示合计
$result=sqlsrv_query($conn,$CS[0]);
while($line=sqlsrv_fetch_array($result))
{
	$tmp='<tr onclick="k(this)">';
	for($i=1;$i<$Column;$i++)
	{
		$tmp.="<td align=".$AL[$i].">".$line[$i]."</td>";
		if($HJ[$i]==1)	{$XJ[$i]+=$line[$i];$dishj=1;}
	}
	echo $tmp,"</tr>";
}
sqlsrv_free_stmt($result);
if($dishj==1)
{
	echo '<tr><td align=center colspan=',$HJ[0],'><font color=red>合 计</td>';
	for($i=$HJ[0]+1;$i<$Column;$i++)
	{
		if($HJ[$i]==1)
			echo "<td align=right><font color=red>",$XJ[$i],"</td>";
		else
			echo "<td></td>";
	}
	echo "</tr>";
}
?>
</table>
