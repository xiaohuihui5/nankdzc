<table border="1" class="tableborder3">
    <?php
    $CS=explode('#',$_SESSION['mac']);
    $HJ=explode(',',$CS[1]);
    $KD=explode(',',$CS[2]);
    $AL=explode(',',$CS[3]);
    $Column=count($HJ);//ȡ��������
    $query=$CS[0];
    $result=sqlsrv_query($conn,$query);
    $tp1='';
    $mid=0;
    $row=0;
    while($line=sqlsrv_fetch_array($result))
    {
        $row=$row+1;
        /*if($line[2]!=$tp1)
        {
            if($tp1!='') echo $beg,$mid,$end;
            $beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'>'.$row.'</td><td width='.$KD[2].' align='.$AL[2].' rowspan=';
            $mid=1;
            $end='>'.$line[2].'</td>';
            for($i=3;$i<$Column;$i++)
            {
                $end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
            }
            $end.='</tr>';
        }
        else
        {*/
            for($i=1;$i<$Column;$i++)
            {
                echo $beg,$mid,$end;
                $beg='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
<td width='.$KD[$i].' align='.$AL[$i].'>'.$row.'</td><td width='.$KD[$i].' align='.$AL[$i].' rowspan=';
                $mid=1;
                $end.='<td width='.$KD[$i].' align='.$AL[$i].'>'.$line[$i].'</td>';
            }
            $end.='</tr>';
        }
        //$tp1=$line[2];
    if($mid!=0) echo $beg,$mid,$end;
    sqlsrv_free_stmt($result);
    ?>
</table>
