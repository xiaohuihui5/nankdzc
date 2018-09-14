<?php
require('./inc/xhead.php');
$tmp=iconv("UTF-8","GBK",$_POST["cxtj"]);
if($_POST['cwho']==1)//生成选中的右边
    $query="select qy.id,qy.usercode+'_'+qy.shortname from sys_qiye qy where qy.yn=1 and qy.id in(".$_POST['selid'].") order by qy.usercode,qy.shortname";
else if($_POST['cwho']==0)//生成左边
{
    $TJ="";
    if($tmp!="")
        $TJ.=" and qy.usercode+qy.shortname+qy.piny like '%".$tmp."%' ";
    if(isset($_POST['dafl']) and $_POST['dafl']!="")
        $TJ.=" and qy.lx in(".$_POST['dafl'].") ";
    $query="select qy.id,qy.usercode+'_'+qy.shortname from sys_qiye qy where qy.yn=1 ".$TJ." and  qy.id not in(".$_POST['selid'].") order by qy.usercode,qy.shortname";
}
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
    echo "ob.options[ob.options.length] = new Option('".$line[1]."','".$line[0]."');\n";
}
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
