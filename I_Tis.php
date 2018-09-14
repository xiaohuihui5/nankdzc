<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>

<?php 
if(isset($_REQUEST['tis']) and $_REQUEST['tis']==1)
{
	echo "<script language=javascript>parent.layer.msg('操作成功！',{shade:false});parent.layer.closeAll();</script>";
}
?>
</html>
