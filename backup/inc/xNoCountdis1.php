<table border="0" class="tableborder3" id="con">
<?php
$CS=explode('#',$_SESSION['mac']);
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
		$beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" data="'.$line['menuid'].'"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td><td width='.$KD[2].' align='.$AL[2].' rowspan=';
		$mid=1;
		$end='>'.$line[2].'</td>';
		for($i=3;$i<$Column;$i++)
		{
			if($i==3){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line['url'].'</td>';
			}else
			if($i==4){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line['description'].'</td>';
			}else
			if($i==5){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line['level'].'</td>';
			}else
			if($i==6){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line['ordermenuid'].'</td>';
			}else
			if($i==7){
				if($line['chax']==true){
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kc('.$line['menuid'].')></td>';
				}else{
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kc('.$line['menuid'].')></td>';
				}
			}elseif($i==8){
				if($line['lur']==true){
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kl('.$line['menuid'].')></td>';
				}else{
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kl('.$line['menuid'].')></td>';
				}
			}elseif($i==9){
				if($line['shenh']){
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=ks('.$line['menuid'].')></td>';
				}else{
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=ks('.$line['menuid'].')></td>';
				}
			}elseif($i==10){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ss('.$line['menuid'].')><IMG border=0 src=im/up.gif></a></td>';
			}elseif($i==11){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:xx('.$line['menuid'].')><IMG border=0 src=im/down.gif></a></td>';
			}elseif($i==12){
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ed('.$line['menuid'].')><img border=0 src=im/edit.gif alt=修改此行数据></a></td>';
			}elseif($i==13){
				if($line['display']==true){
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line['menuid'].')>在用</td>';								
				}else{
					$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line['menuid'].')><font color=red>已停</td>';								
				}
			}
			else{
				$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].$i.'</td>';
			}
		}
		$end.='</tr>';
		$tp1=$line[2];
		if($line['layer']<3){
			$sql1 = "select * from sys_menu_new where top_id=".$line['menuid']." order by ordermenuid asc";
			$reslut1 = sqlsrv_query($conn,$sql1);
			while($line1=sqlsrv_fetch_array($reslut1)){
				$row=$row+1;
				if($line1[2]!=$tp1)
				{
					if($tp1!='') echo $beg,$mid,$end;
					$beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" data="'.$line1['menuid'].'"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td><td width='.$KD[2].' align='.$AL[2].' rowspan=';
					$mid=1;
					$end='>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>|__</sup>'.$line1[2].'</td>';
					for($i=3;$i<$Column;$i++)
					{
						if($i==3){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line1['url'].'</td>';
						}else
						if($i==4){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line1['description'].'</td>';
						}else
						if($i==5){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line1['level'].'</td>';
						}else
						if($i==6){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line1['ordermenuid'].'</td>';
						}else
						if($i==7){
							if($line1['chax']==true){
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kc('.$line1['menuid'].')></td>';
							}else{
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kc('.$line1['menuid'].')></td>';
							}
						}elseif($i==8){
							if($line1['lur']==true){
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kl('.$line1['menuid'].')></td>';
							}else{
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kl('.$line1['menuid'].')></td>';
							}
						}elseif($i==9){
							if($line1['shenh']){
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=ks('.$line1['menuid'].')></td>';
							}else{
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=ks('.$line1['menuid'].')></td>';
							}
						}elseif($i==10){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ss('.$line1['menuid'].')><IMG border=0 src=im/up.gif></a></td>';
						}elseif($i==11){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:xx('.$line1['menuid'].')><IMG border=0 src=im/down.gif></a></td>';
						}elseif($i==12){
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ed('.$line1['menuid'].')><img border=0 src=im/edit.gif alt=修改此行数据></a></td>';
						}elseif($i==13){
							if($line1['display']==true){
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line1['menuid'].')>在用</td>';								
							}else{
								$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line1['menuid'].')><font color=red>已停</td>';								
							}
						}
						else{
							$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line1[$i].$i.'</td>';
						}
					}
					$end.='</tr>';
					
					if($line1['layer']<3){
						$sql2 = "select * from sys_menu_new where top_id=".$line1['menuid']." order by ordermenuid asc";
						$reslut2 = sqlsrv_query($conn,$sql2);
						while($line2=sqlsrv_fetch_array($reslut2)){
							$row=$row+1;
							if($line2[2]!=$tp1)
							{
								if($tp1!='') echo $beg,$mid,$end;
								$beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" data="'.$line2['menuid'].'"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td><td width='.$KD[2].' align='.$AL[2].' rowspan=';
								$mid=1;
								$end='>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>|__</sup>'.$line2[2].'</td>';
								for($i=3;$i<$Column;$i++)
								{
									if($i==3){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2['url'].'</td>';
									}else
									if($i==4){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2['description'].'</td>';
									}else
									if($i==5){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2['level'].'</td>';
									}else
									if($i==6){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2['ordermenuid'].'</td>';
									}else
									if($i==7){
										if($line2['chax']==true){
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kc('.$line2['menuid'].')></td>';
										}else{
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kc('.$line2['menuid'].')></td>';
										}
									}elseif($i==8){
										if($line2['lur']==true){
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=kl('.$line2['menuid'].')></td>';
										}else{
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=kl('.$line2['menuid'].')></td>';
										}
									}elseif($i==9){
										if($line2['shenh']){
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox checked onclick=ks('.$line2['menuid'].')></td>';
										}else{
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><input style=height:18 type=checkbox onclick=ks('.$line2['menuid'].')></td>';
										}
									}elseif($i==10){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ss('.$line2['menuid'].')><IMG border=0 src=im/up.gif></a></td>';
									}elseif($i==11){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:xx('.$line2['menuid'].')><IMG border=0 src=im/down.gif></a></td>';
									}elseif($i==12){
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:ed('.$line2['menuid'].')><img border=0 src=im/edit.gif alt=修改此行数据></a></td>';
									}elseif($i==13){
										if($line2['display']==true){
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line2['menuid'].')>在用</td>';								
										}else{
											$end.='<td width='.$KD[$i].' align='.$AL[$i].'><a href=javascript:yn('.$line2['menuid'].')><font color=red>已停</td>';								
										}
									}
									else{
										$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2[$i].$i.'</td>';
									}
								}
								$end.='</tr>';
							}else
							{
								$end.='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td>';
								for($i=3;$i<$Column;$i++)
								{
									$end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line2[$i].'</td>';
								}
								$end.='</tr>';
								$mid++;
							}
						}
						$tp1=$line2[2];
					}
				}
				$tp1=$line1[2];
			}
		}
	}
	else
	{
		$end.='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td>';
		for($i=3;$i<$Column;$i++)
		{
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
