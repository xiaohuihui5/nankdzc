<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" /><!--$lur��ʾģ��-->
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$tit='ϵͳ���� <span class="c-gray en">&gt;</span> ��¼��־';
$lur='<div class="text-c">
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:120px;" value="'.$day.'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:120px;" value="'.$dayh.'"/>  	
 <input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="�����Ա���ơ��绰������" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></a></div>';
$lnk='<span class="l"><a href="New_MacContral.php"  class="btn radius"> ��¼����</a> <a href="New_LoginLog.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��¼��־</a> </span> <span class="r"> <a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',���,�û�����,��¼IP,������,��֤��,��¼ʱ��,�˳�ʱ��,״̬';
$wid=',5%,10%,15%,17%,18%,15%,15%,5%';
$tis='';
$xuh=',2,3,4,5,6,7,8';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>

