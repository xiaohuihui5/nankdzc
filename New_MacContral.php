<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$tit='ϵͳ���� <span class="c-gray en">&gt;</span> ��¼����';
$lur='<div class="text-c"> <input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="����ؼ���ģ������" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="New_MacContral.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��¼����</a> <a href="New_LoginLog.php"  class="btn radius"> ��¼��־</a> </span> ';
//$lnk.='<span class="r"><a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',���,������֤��,���Լ�ʹ����˵��,�Ƿ������¼ϵͳ,�޸�,ɾ��';
$wid=',10%,20%,40%,10%,10%,10%';
$tis='ע:ֻ������Ϊ�����¼�ĵ��Բ���ʹ�õ�¼�����¼��ϵͳ!';
$xuh=',2,3,4,5,6,7,8';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
