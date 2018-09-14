<?php
require('./inc/xhead.php');
$query="select ht.usercode,unit.shortname,ht.bz,ht.mingc,ht.gys,convert(varchar(10),ht.qsrq,120),convert(varchar(10),ht.jsrq,120),convert(varchar(10),ht.qdrq,120) from sys_het ht,sys_qiye unit where ht.unit=unit.id and ht.id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $unit=$line[1];
    $usercode=$line[0];
    $shortname="合同编号：<font color=red><b>".$line[0]."</b></font>&nbsp;&nbsp;合同名称：<font color=red><b>".$line[3]."</b></font>";
    $bz=$line[2];
    $gys=$line[4];
    $qsrq=$line[5];
    $jsrq=$line[6];
    $qdrq=$line[7];
}
sqlsrv_free_stmt($result);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title><?php echo $shortname;?></title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="forml" method="POST" action="">
    <div align="center" style="width: 700px;margin:0 50px 0 50px">
        <div style="font-weight: bold;font-size: large;"><br><?php echo $shortname;?><br><br></div>
        <table width="100%" cellSpacing="1" cellPadding="0">
            <tr>
                <td style="font-weight: bold;font-size: 15px; height: 30px">合作企业：<?php echo $unit;?><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;height: 30px">合作单位：<?php echo $gys;?><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;height: 30px">有效期：<?php echo $qsrq;?>&nbsp;至&nbsp;<?php echo $jsrq;?></td>
            </tr>
            <tr>
                <td colspan=5 style="font-weight: normal;font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bz;?></td>
            </tr>
            <tr>
                <td colspan=5 align=center><br>&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;退出&nbsp;&nbsp;" onclick="exit()"></td>
            </tr>
        </table>
        </center>
    </div>
</form>
</body>
</html>
<script lanuage="javascript">
    function exit()
    {
        parent.layer.closeAll();
    }
</script>
