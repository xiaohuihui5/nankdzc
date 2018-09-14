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
$tit='系统管理 <span class="c-gray en">&gt;</span> 用户管理';
$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入用户名、帐号模糊搜索" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="New_Yongh.php"  class="btn radius"><img border=0 src=im/zhuy.png> 用户管理</a> <a href="New_Bum.php"  class="btn radius"> 部门管理</a> </span> ';
$lnk.='<span class="r">';
$lnk.='<a href="javascript:;" onclick="Add(\'用户管理--新增用户\',\''.$xiam.'Add.php\',\'600\',\'600\')" class="btn radius"><img border=0 src=im/add.png> 添加用户</a> <a href="javascript:;" onclick="layer_show(\'用户管理--权限同步\',\''.$xiam.'Copy.php\',\'500\',\'500\')" class="btn radius">权限同步</a> ';
$lnk.='<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',序,所在部门,用户姓名,登录账号,登录数,管辖企业,职务,联系电话,禁用,修改';
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
	layer_show2(title,url,w,h);//最后一个是给标识符  需要父级打开就给  不然就空
}
</script>
