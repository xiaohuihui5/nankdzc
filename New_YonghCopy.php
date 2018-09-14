<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['empid']))
{
	$query="delete sys_menuright where empid=".$_POST['empidb'];
	include("./inc/xexec.php");
	$query="insert into sys_menuright(empid,menuid,menuright) select ".$_POST['empidb'].",menuid,menuright from sys_menuright where empid=".$_POST['empid'];
	include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>layer_show('温馨提示','I_Tis.php?tis=1','','');</script>";//提示成功退出
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr><td align=center height="40">&nbsp;</td></tr>
<tr>
<td align=center height="40"><span class="c-red">*</span>选取用户姓名：</font>
		<select class="select" size="1" id="empid" name="empid" style="width:210px;height:30px;">
			<option value=''>选取用户姓名</option>
			<?php 
			$query='select empid,name from sys_user where yn=1 order by bumid';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
					echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
</td>
</tr>
<tr><td align=center height="40">||</td></tr>
<tr><td align=center height="40">||</td></tr>
<tr><td align=center height="40">V</td></tr>
<tr>
<td align=center height="40"><span class="c-red">*</span>创建权限姓名：</font>
		<select class="select" size="1" id="empidb" name="empidb" style="width:210px;height:30px;">
			<option value=''>创建权限姓名</option>
			<?php 
			$query='select empid,name from sys_user where yn=1 and empid not in(1) order by bumid';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
					echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
</td>
</tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>&nbsp;</td></tr>

<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	if(window.Frm.empid.value=="")
		layer.msg('选取用户姓名不能为空!',{shade:false});
	else if(window.Frm.empidb.value=="")
		layer.msg('创建权限姓名不能为空!',{shade:false});
	else
	{
		window.Frm.submit();
      }
} 
function exit()
{
	parent.layer.closeAll();
}
window.Frm.empid.focus();
window.Frm.empid.select();
</script>
