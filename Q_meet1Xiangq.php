<?php
require('./inc/xhead.php');

$query="select yiti,convert(varchar(20),ksrq,120),fangj,zcr,xld,js,ds,zjl,reny,bz,jlr,gy from sys_meet where id=".$_GET['eid'];
//echo $query;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $yiti=$line[0];
    $ksrq=$line[1];
    $fangj=$line[2];
    $zcr=$line[3];
    $xld=$line[4];
    $js=$line[5];
    $ds=$line[6];
    $zjl=$line[7];
    $reny=$line[8];
    $bz=$line[9];
    $jlr=$line[10];
    $gy=$line[11];
}
sqlsrv_free_stmt($result);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title><?php echo $yiti;?></title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="forml" method="POST" action="">
    <div align="center" style="width: 700px;margin:0 50px 0 50px">
        <div style="font-weight: bold;font-size: large;"><br><?php echo $yiti;?><br><br></div>
        <table width="100%" cellSpacing="1" cellPadding="0">
            <tr>
                <td style="font-weight: bold;font-size: 15px;">时间：<?php echo $ksrq;?><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">地点：<?php echo $fangj;?><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">主持人：<?php echo $zcr;?><br></td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: bold;font-size: 15px;">出席人：
                        <div style="margin-left: 60px;font-size: 13px;font-weight: bold;">
                            <div>校领导：<?php echo $xld;?></div>
                            <div>董事：<?php echo $ds;?></div>
                            <div>监事：<?php echo $js;?></div>
                            <div>总经理：<?php echo $zjl;?></div>
                            <div>其他人员：<?php echo $reny;?></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td  style="font-weight: bold;font-size: 15px;">会议概要：<div style="margin-left: 60px;font-size: 13px"><?php echo $gy;?></div></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">记录人：<?php echo $jlr;?><br><br></td>
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
