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
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<?php
$tit='系统管理<span class="c-gray en">&gt;</span>部门管理';
$lur='<div class="text-c">编号:&nbsp;<input type="text" class="input-text" style="width:80px" id="bianh" name="bianh" onkeydown="if(event.keyCode==13){window.Frm.fenlmc.select();}else  if(event.keyCode==39){window.IFrm.fenlmc.select();}">&nbsp;部门名称:&nbsp;<input type="text" class="input-text" style="width:120px"  id="fenlmc" name="fenlmc" onkeydown="if(event.keyCode==13) sub();">&nbsp; <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;增加&nbsp;&nbsp;" onclick="sub();">';
$lnk='<span class="l"><a href="New_Yongh.php"  class="btn radius"> 用户管理</a> 
<a href="New_Bum.php"  class="btn radius"><img border=0 src=im/zhuy.png> 部门管理</a> </span>';
$cha='';
$lie=",序,编号,部门名称,禁用,修改";
$wid=",10%,10%,60%,10%,10%";
$tis="";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=fenlmc]").val()=="" || $("input[name=fenlmc]").val()==null)
	{
		parent.layer.msg('新增部门名称不得为空', {icon:2,time:1500});
		return false;
	}
	else
	{
		window.Frm.submit();
		window.Frm.reset();
		window.Frm.bianh.focus();
	}
}
window.Frm.bianh.focus();
</script>
