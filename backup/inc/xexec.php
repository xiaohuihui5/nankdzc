<?php
$res=sqlsrv_query($conn,$query);
if($res)
{
	echo "<script language=javascript>parent.layer.msg('�����ɹ���',{icon:1,time:1500});</script>";//��ʾ�ɹ��˳�
}
?>
