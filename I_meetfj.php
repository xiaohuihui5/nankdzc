<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
    <link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" /><!--$lur显示模块-->
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<body >
<?php
$tit='会议管理 <span class="c-gray en">&gt;</span> 会议室管理-- '.$_SESSION['empid'];
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入关键字模糊搜索" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="I_meetfj.php"  class="btn radius"><img border=0 src=im/zhuy.png> 会议室管理</a></span> ';
$lnk.='<span class="r">';
//if($menuright>1)//录入
$lnk.='<a href="javascript:;" onclick="Add(\'会议室管理--新增会议室\',\''.$xiam.'Add.php\',\'450\',\'550\')" class="btn radius"><img border=0 src=im/add.png> 新增会议室</a>';
$lnk.='<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=",序,房间号,会议室名称,备注,禁用,修改";
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
        layer_show2(title,url,w,h);//最后一个是给标识符  需要父级打开就给  不然就空
    }
</script>
