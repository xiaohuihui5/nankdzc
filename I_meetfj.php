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
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<body >
<?php
$tit='������� <span class="c-gray en">&gt;</span> �����ҹ���-- '.$_SESSION['empid'];
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="����ؼ���ģ������" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="I_meetfj.php"  class="btn radius"><img border=0 src=im/zhuy.png> �����ҹ���</a></span> ';
$lnk.='<span class="r">';
//if($menuright>1)//¼��
$lnk.='<a href="javascript:;" onclick="Add(\'�����ҹ���--����������\',\''.$xiam.'Add.php\',\'450\',\'550\')" class="btn radius"><img border=0 src=im/add.png> ����������</a>';
$lnk.='<a href="xExcel_NoCountdis.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=",��,�����,����������,��ע,����,�޸�";
$wid=",5%,10%,20%,45%,10%,10%";
$tis="!";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
    function Add(title,url,w,h)
    {
        //window.hqlist.Frm.submit();
        layer_show2(title,url,w,h);//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
    }
</script>
