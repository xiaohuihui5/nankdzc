<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<html>
<head>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
</head>
<style>
body{font-family:"΢���ź�";}
</style>
<BODY>
<?php
$query='select title from sys_menu where menuid='.$_GET['menuid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$menuname=$line[0];
sqlsrv_free_stmt($result);
$tit=$menuname.'-����Ȩ������';
$lur='';
$lnk='';
$cha='<input name="paix" id="paix" type="hidden">';
$lie=',��,�û�����,��ѯ,¼��/�޸�,���';
$wid=',8%,35%,18%,24%,15%';
$tis='��ɫ��,��ʾ��ѡ�˵�û�д�Ȩ�޿�����';
$xuh=',,3,4,5,6';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php?menuid='.$_GET['menuid'],$tis,$xuh,$yul);
?>
</body>
</html>
