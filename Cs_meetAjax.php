<?php
require('./inc/xhead.php');
if($_POST['id']!=0)
{
    $query = "select empid,usercode,name from sys_user where id=".$_POST['id'];//ֱ�Ӹ���idѡһ��
    $result=sqlsrv_query($conn,$query);
    $cpid=0;
    $usercode="";
    $cpmc="";
    if($line=sqlsrv_fetch_array($result))
    {
        $cpid=$line[0];
        $usercode=$line[1];
        $cpmc=$line[2];
    }
    sqlsrv_free_stmt($result);
}
else//ģ��ѡȡһ��
{
    $str=iconv("UTF-8","GBK",$_POST["spbh"]);
    $query = "select top 1 empid,usercode,name from sys_user where yn=1 and usercode+name like '%".$str."%' order by usercode";
    //echo $query;
    $result=sqlsrv_query($conn,$query);
    if($line=sqlsrv_fetch_array($result))
    {
        $cpid=$line[0];
        $usercode=$line[1];
        $cpmc=$line[2];
    }
    sqlsrv_free_stmt($result);
}
echo $cpid,"@",$usercode,"@",$cpmc,"@";
?>
