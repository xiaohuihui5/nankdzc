<?php
header('Content-Type:text/html;charset=GB2312');
if(isset($_POST['uid']))
{
	//if($_POST['uid']=="admin" and $_POST['pwd']=="zy_888")
if($_POST['uid']=="admin" and $_POST['pwd']=="abc_abc")
	{
	session_start();
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	$_SESSION['empid']=1;//存放用户id
	$_SESSION['uname']="管理员";//存放用户名
	$_SESSION['DT2']=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));//后一天
	$_SESSION['DT1']=date('Y-m-d');//今天
	header("location:New_AllIndex.php");
	exit;
	}
	else
		echo '<script language=javascript>alert("用户名或密码输入错误，请重新输入！")</script>';
}
?>
<p><br>
<form action="" method="post" name="Frm"><p align=center>
账号:<input name="uid" type="text" tabindex=1 onkeydown="if(event.keyCode==13) event.keyCode=9" style="BACKGROUND: none transparent scroll repeat 0% 0%; BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: 0px; BORDER-RIGHT: 0px; BORDER-TOP: 0px;width: 100px;"><br>
密码:<input name="pwd" type="password" tabindex=2 onkeydown="if(event.keyCode==13) window.Frm.submit()" style="BACKGROUND: none transparent scroll repeat 0% 0%; BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: 0px; BORDER-RIGHT: 0px; BORDER-TOP: 0px;width: 100px;">
</p>
</form>
<script lanuage ="javascript">
window.Frm.uid.focus();
</script>
