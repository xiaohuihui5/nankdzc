<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='update sys_user set yn=yn^1 where empid='.$_POST['delrow'];
	include('./inc/xexec.php');
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">

<?php
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and a.name like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="")
    $px=$_POST['paix'];
else
    $px.=" a.usercode,a.name";

$_SESSION['mac']="select 0,0,b.bummc,case sex when 0 then '<IMG border=0 src=im/man.gif>' else '<IMG border=0 src=im/woman.gif>' end+a.name,a.userid,a.loginnums,a.qymc,a.zhiw,a.phone,case a.yn when 0 then '<a href=javascript:yn('+cast(a.empid as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(a.empid as varchar(10))+')>已启用</a>' end,'<a href=javascript:ed('+cast(a.empid as varchar(10))+') ><img border=0 src=im/xiug.png alt=修改></a>'
from sys_user a,sys_bum b where a.bumid=b.id ".$TJ." order by ".$px;
//echo $_SESSION['mac'];die;
$_SESSION['mac'].="#"."10,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",8%,10%,10%,10%,8%,15%,8%,15%,8%,8%";
$_SESSION['mac'].="#".",center,center,center,left,left,left,center,center,center,center";
$_SESSION['mac'].="#".",序,所在部门,用户姓名,登录账号,登录数,管辖企业,职务,联系电话,禁用,修改";
$_SESSION['mac'].="#系统用户资料表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";

include('./inc/xNoCountdis.php');
?>
</form>
</body>
<script language=javascript>
function ed(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	//window.Frm.submit();
	layer_show3("用户管理--修改用户","<?php echo $xiam;?>Edit.php?eid="+id,"780","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
function mob(eid)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.mob.value=eid;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
