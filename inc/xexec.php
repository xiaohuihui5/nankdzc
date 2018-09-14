<?php
$res=sqlsrv_query($conn,$query);
if($res)
{
	echo "<script language=javascript>parent.layer.msg('操作成功！',{icon:1,time:1500});</script>";//提示成功退出
}
?>
