<?php
require('./inc/xhead.php');
$query="select shortname,fr,xydm,convert (varchar (10),clsj,120),convert (varchar (10),zczb,120),address,bz,zhangc,zhid from sys_qiye where id=".$_GET['eid'];
//echo $query;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result)){
    $shortname=$line[0];
    $fr=$line[1];
    $xydm=$line[2];
    $clsj=$line[3];
    $zczb=$line[4];
    $address=$line[5];
    $bz=$line[6];
    $zhangc=$line[7];
    $zhid=$line[8];
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
    <div style="margin-left: 50px;margin-right: 50px">
        <div align="center" style="font-weight: bold;font-size: large;"><br><?php echo $shortname;?><br><br></div>
        <table width="100%" cellSpacing="1" cellPadding="0">
            <tr>
                <td style="font-weight: bold;font-size: 15px;">���������ˣ�<font color="#136ec2"><?php echo $fr;?></font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">ͳһ������ô��룺<font color="#136ec2"><?php echo $xydm;?></font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">�Ͻ�ע���ʱ���<font color="#136ec2"><?php echo $zczb;?>��Ԫ</font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">����ʱ�䣺<font color="#136ec2"><?php echo $clsj;?></font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">��ַ��<font color="#136ec2"><?php echo $address;?></font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;" type="file">�³̣�<font color="#136ec2"><a class="button border-main" href="./upfile/excel/<?php echo $zhangc;?>"><?php echo $zhangc;?></a>
                        </font><br></td>
            </tr>
            <tr>
                <td style="font-weight: bold;font-size: 15px;">�����ƶȣ�<font color="#136ec2"><a class="button border-main" href="./upfile/excel/<?php echo $zhid;?>"><?php echo $zhid;?></a></font><br></td>
            </tr>
            <tr>
                <td colspan=5 style="font-weight: normal;font-size: 15px;" height="100">&nbsp;&nbsp;&nbsp;&nbsp;��˾���<?php echo $bz;?></td>
            </tr>
            <tr>
                <td colspan=5 align=center><br>&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;�˳�&nbsp;&nbsp;" onclick="exit()"></td>
            </tr>
        </table>
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
