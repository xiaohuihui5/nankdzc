<?php
function Check_Pwd()
{
	$query="select a.empid,a.name,b.bummc from sys_user a,sys_bum b where a.bumid=b.id and a.userid='".$_REQUEST['uid']."' and a.passwd='".$_REQUEST['pwd']."' and a.yn=1";
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['empid']=$line[0];//存放用户id
		$_SESSION['uname']=$line[1];//存放用户名
		$_SESSION['ubummc']=$line[2];//存放部门
		$_SESSION['DT1']=date('Y-m-d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));//前一天
		$_SESSION['DT2']=date('Y-m-d');//今天
		return true;
	}
	else
		return false;
}
function insert_enterlog($lx)
{
	$query="insert into sys_login(logintime,empid,uid,vip,nam,mac,state,logouttime) select getdate(),u.empid,'".$_REQUEST['uid']."','".$_REQUEST['vip']."','".$_REQUEST['nam']."','".$_REQUEST['mac']."','".$lx."',getdate() from sys_user u where u.userid='".$_REQUEST['uid']."'";
	$query = strip_tags($query,"");
	sqlsrv_query($GLOBALS['conn'],$query);
}
function update_loginnum()
{
	$query='update sys_user set loginnums=loginnums+1 where empid='.$_SESSION['empid'];
	sqlsrv_query($GLOBALS['conn'],$query);
}
function Refresh_Online()
{
	$query='update sys_login set logouttime=getdate() where id=(select max(id) from sys_login where uid=(select userid from sys_user where empid='.$_SESSION['empid'].'))';
	sqlsrv_query($GLOBALS['conn'],$query);
}
function Get_OnlineUser()
{
	$query='select count(*) from sys_user where userid in(select uid from sys_login where DATEDIFF(ss,logouttime,getdate())<95) ';
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	$line=sqlsrv_fetch_array($result);
	return $line[0];
}
function getinitial($str) 
{ 
$asc=ord(substr($str,0,1)); 
if ($asc<160) //非中文 
{ 
if ($asc>=48 && $asc<=57){ 
return chr($asc); //数字 
}elseif ($asc>=65 && $asc<=90){ 
return chr($asc); // A--Z 
}elseif ($asc>=97 && $asc<=122){ 
return chr($asc-32); // a--z 
}else{ 
return ''; //其他 
} 
} 
else //中文 
{ 
$asc=$asc*1000+ord(substr($str,1,1)); 
//获取拼音首字母A--Z 
if ($asc>=176161 && $asc<176197){ 
return 'A'; 
}elseif ($asc>=176197 && $asc<178193){ 
return 'B'; 
}elseif ($asc>=178193 && $asc<180238){ 
return 'C'; 
}elseif ($asc>=180238 && $asc<182234){ 
return 'D'; 
}elseif ($asc>=182234 && $asc<183162){ 
return 'E'; 
}elseif ($asc>=183162 && $asc<184193){ 
return 'F'; 
}elseif ($asc>=184193 && $asc<185254){ 
return 'G'; 
}elseif ($asc>=185254 && $asc<187247){ 
return 'H'; 
}elseif ($asc>=187247 && $asc<191166){ 
return 'J'; 
}elseif ($asc>=191166 && $asc<192172){ 
return 'K'; 
}elseif ($asc>=192172 && $asc<194232){ 
return 'L'; 
}elseif ($asc>=194232 && $asc<196195){ 
return 'M'; 
}elseif ($asc>=196195 && $asc<197182){ 
return 'N'; 
}elseif ($asc>=197182 && $asc<197190){ 
return 'O'; 
}elseif ($asc>=197190 && $asc<198218){ 
return 'P'; 
}elseif ($asc>=198218 && $asc<200187){ 
return 'Q'; 
}elseif ($asc>=200187 && $asc<200246){ 
return 'R'; 
}elseif ($asc>=200246 && $asc<203250){ 
return 'S'; 
}elseif ($asc>=203250 && $asc<205218){ 
return 'T'; 
}elseif ($asc>=205218 && $asc<206244){ 
return 'W'; 
}elseif ($asc>=206244 && $asc<209185){ 
return 'X'; 
}elseif ($asc>=209185 && $asc<212209){ 
return 'Y'; 
}elseif ($asc>=212209){ 
return 'Z'; 
}else{ 
return ''; 
} 
} 
}
function Get_Piny($str)
{
$pingy='';
$strlen=strlen($str);
for($i=0;$i<$strlen;$i++)
{
	if(ord(substr($str,$i,1))>0xa0)
	{
	$pingy.=getinitial(substr($str,$i,2));
       $i++ ;
	}
	else
	{
	$pingy.=getinitial(substr($str,$i,1));
	}
}
return $pingy;
}
?>

