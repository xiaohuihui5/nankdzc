<?php
require('./inc/xhead.php');
$tmp="";
$str=iconv("UTF-8","GBK",$_POST["inputkey"]);
$query = "select top 15 usercode,name from sys_user where yn=1 and usercode+name like '%".$str."%' order by usercode";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
    $tmp.="<tr style=\"cursor:pointer\" onmouseover=\"this.bgColor='#8FF2E5';\" onmouseout=\"this.bgColor='';\"><td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[0]."</td><td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[1]."</td></tr>";
}
sqlsrv_free_stmt($result);
if($tmp!="")
    echo '<table id="lstab" name="lstab" class=seldiv>',$tmp,'</table>';
else
    echo "no";
?>
