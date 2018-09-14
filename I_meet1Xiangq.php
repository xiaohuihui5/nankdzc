<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 16:31
 */
require('./inc/xhead.php');
$query="select bianh,yiti,fqr,bz from sys_meet where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $bianh=$line[0];
    $yiti=$line[1];
    $fqr=$line[2];
    $shortname="会议编号：<font color=red><b>".$line[0]."</b></font>&nbsp;&nbsp;议题：<font color=red><b>".$line[1]."</b></font>&nbsp;&nbsp;发起人：<font color=red><b>".$line[2]."</b></font>";
    $bz=$line[3];
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
    <div align="center">
        <center>
            <table width="430" hieght="510" cellSpacing="1" cellPadding="0">
                <tr>
                    <td align="center" colspan="5"><br><?php echo $shortname;?><br><br></td>
                </tr>
                <tr>
                    <td colspan=5><?php echo $bz;?></td>
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
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
