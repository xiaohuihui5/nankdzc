<?php
require('./inc/xhead.php');
if($_POST['id']!=0)
{
    $query = "select id,shortname,fuzy,phone  from sys_qiye where id=".$_POST['id'];//直接根据id选一个
    $result=sqlsrv_query($conn,$query);
    $cpid=0;
    $cpmc="";
    if($line=sqlsrv_fetch_array($result))
    {
        $cpid=$line[0];
        $cpmc=$line[1];
        $fuzr=$line[2];
        $phone=$line[3];
    }
    sqlsrv_free_stmt($result);
}
else//模糊选取一个
{
    $str=iconv("UTF-8","GBK",$_POST["spbh"]);
    $query = "select top 1 id,shortname,fuzy,phone from sys_qiye where yn=1 and usercode+shortname+piny like '%".$str."%' order by usercode";
    $result=sqlsrv_query($conn,$query);
    if($line=sqlsrv_fetch_array($result))
    {
        $cpid=$line[0];
        $cpmc=$line[1];
        $fuzr=$line[2];
        $phone=$line[3];
    }
    sqlsrv_free_stmt($result);
}
echo $cpid,"@",$cpmc,"@",$fuzr,"@",$phone,"@";
?>
