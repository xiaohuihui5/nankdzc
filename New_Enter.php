<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
require('./inc/xc_c.php');//���ݿ�����
require('./inc/xsys_lib.php');//ϵͳ������غ�����
if($_REQUEST['ver']!=8)
{
	header('location:./New_VerWrong.html');//�汾����
}
else if(Check_Pwd())
{
	insert_enterlog('�ɹ�');//������־
	update_loginnum();//���ӵ�¼����
	header('location:./New_AllIndex.php');//ת����һ��
}
else
{
	insert_enterlog('ʧ��');//������־
	header('location:./New_EnterWrong.html');//������û�������
}
?>
