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
$tit='下属企业资料设置 <span class="c-gray en">&gt;</span> 下属企业资料设置';
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入企业名称模糊搜索" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="New_QiyeSet.php"  class="btn radius"><img border=0 src=im/zhuy.png> 企业管理</a> <a href="New_QiyeSetlx.php"  class="btn radius"> 企业分类管理</a> </span> ';
$lnk.='<span class="r">';
$lnk.='<a href="javascript:;" onclick="Add(\'企业管理--新增企业\',\''.$xiam.'Add.php\',\'700\',\'720\')" class="btn radius"><img border=0 src=im/add.png> 增加企业</a>';
$lnk.='<a href="xExcel_Qiye.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_Qiye.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',序,企业类型,编号,企业名称,统一社会信用代码,成立时间,认缴额(万),联系人,联系电话,法人,总经理,监事,董事会,场地投入(m2),股东信息,公司简介,禁用,修改';
$wid=',5%,7%,5%,10%,8%,5%,6%,4%,8%,6%,4%,4%,7%,4%,4%,5%,4%,4%';
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4,5,6,7,8';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
    function Add(title,url,w,h)
    {
        //window.hqlist.Frm.submit();
        layer_show2(title,url,w,h);//最后一个是给标识符  需要父级打开就给  不然就空
    }
</script>
