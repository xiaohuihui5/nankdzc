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
//$menuright=menuright(87);//ȡ�ò˵�Ȩ��
$tit='��ͬ���� <span class="c-gray en">&gt;</span> ��ͬ���Ϲ���';
$lur='<input name="setsh" type="hidden" value="100"><div class="text-c">���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<select class="select-box" style="width:80px;height:31px;text-align:center;" name="zt"><option value="">--״̬--</option><option value="1">��Ч</option><option value="2">��ֹ</option><option value="3">����</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="����ؼ���ģ������" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="Cs_het.php"  class="btn radius"><img border=0 src=im/zhuy.png> ��ͬ����</a> <a href="Cs_hetfenl.php"  class="btn radius"> ��ͬ�������</a> </span> ';
$lnk.='<span class="r">';
//if($menuright>1)//¼��
$lnk.='<a href="javascript:;" onclick="Add(\'��ͬ����--������ͬ\',\''.$xiam.'Add.php\',\'650\',\'700\')" class="btn radius"><img border=0 src=im/add.png> ������ͬ</a>';
$lnk.='<a href="xExcel_het.php"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;��&nbsp;&nbsp;ӡ</a> </span> ';
$cha='';
$lie=',��,��ͬ����,���,��ͬ����,������ҵ,������λ,��ͬ���,�Է���ϵ��,��ϵ�绰,��ʼ����,��������,ǩ������,״̬,��������,��,��,ɾ';
$wid=',3%,7%,6%,9%,9%,7%,5%,6%,7%,7%,7%,7%,4%,4%,4%,4%,4%';
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4,5,6,7,8,9,10,11,12,13,14,15';
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
