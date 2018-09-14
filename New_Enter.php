<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
require('./inc/xc_c.php');//数据库连接
require('./inc/xsys_lib.php');//系统控制相关函数库
if($_REQUEST['ver']!=8)
{
	header('location:./New_VerWrong.html');//版本不对
}
else if(Check_Pwd())
{
	insert_enterlog('成功');//插入日志
	update_loginnum();//增加登录次数
	header('location:./New_AllIndex.php');//转向下一步
}
else
{
	insert_enterlog('失败');//插入日志
	header('location:./New_EnterWrong.html');//密码或用户名错误
}
?>
