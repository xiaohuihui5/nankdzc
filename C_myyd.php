<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/7
 * Time: 14:28
 */
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
$tit='������� <span class="c-gray en">&gt;</span> �ҵ�Ԥ��-- '.$_SESSION['empid'];
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="����ؼ���ģ������" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="I_meet.php"  class="btn radius"><img border=0 src=im/zhuy.png> �ҵ�Ԥ��</a> </span> ';
$lnk.='<span class="r">';
/*if($menuright==3){
    $lnk.='<a class="btn radius">�������</a>
    <div id="menu1" style="position:absolute;display:none;width:130px;text-align:left;line-height:25px;background-color:#ffffff;border:1px solid #3980AF">
     <a href="javascript:s_all(1)">�����鶼���ͨ��</a><br>
     <a href="javascript:s_all(0)">�����鶼��˲���</a>
    </div></div></td>';
}*/
$cha='';
$lie=',��,��������,���,��������,��ʼʱ��,����ʱ��,ԤԼʱ��,������,�λ�����,�λ���Ա,�����Ҫ,״̬,�޸�';
$wid=',5%,10%,5%,15%,8%,8%,8%,6%,5%,15%,5%,5%,5%';
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4,5,6,7,8,9';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
