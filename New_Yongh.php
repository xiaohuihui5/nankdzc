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
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$tit='ϵͳ���� <span class="c-gray en">&gt;</span> �û�����';
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="�����û������ʺ�ģ������" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="New_Yongh.php"  class="btn radius"><img border=0 src=im/zhuy.png> �û�����</a> <a href="New_Bum.php"  class="btn radius"> ���Ź���</a> </span> ';
$lnk.='<span class="r">';
$lnk.='<a href="javascript:;" onclick="Add(\'�û�����--�����û�\',\''.$xiam.'Add.php\',\'600\',\'600\')" class="btn radius"><img border=0 src=im/add.png> ����û�</a> <a href="javascript:;" onclick="layer_show(\'�û�����--Ȩ��ͬ��\',\''.$xiam.'Copy.php\',\'500\',\'500\')" class="btn radius">Ȩ��ͬ��</a> ';
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',��,���ڲ���,�û�����,��¼�˺�,��¼��,��Ͻ��ҵ,ְ��,��ϵ�绰,����,�޸�';
$wid=',8%,10%,10%,10%,8%,15%,8%,15%,8%,8%';
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
function Add(title,url,w,h)
{
	//window.hqlist.Frm.submit();
	layer_show2(title,url,w,h);//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
}
</script>
