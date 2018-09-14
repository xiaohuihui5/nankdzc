<?php 
require('./inc/xhead.php');
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<script language=javascript>
var xmlHttp;
function createXMLHttpRequest()
{
	if (window.ActiveXObject)
	{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");	
	}
	else if (window.XMLHttpRequest)
	{
		xmlHttp=new XMLHttpRequest();
	}
}
function UpdateData(query)
{
	createXMLHttpRequest();
	xmlHttp.open("post","New_RightSetAjax.php",true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("context-type","text/html;charset=GB2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState==4)
		{
			if (xmlHttp.status == 200)
			{
			//
			}
		}
	}
	xmlHttp.send(query);
}
function cks(obj,lx,mid,eid)
{
	if(obj.checked)
		UpdateData('lx='+lx+'&mid='+mid+'&eid='+eid);
	else
		UpdateData('lx=0&mid='+mid+'&eid='+eid);
	var boxArray = document.getElementsByName(obj.name);
       for(var i=0;i<=boxArray.length-1;i++)
	{
	if(boxArray[i]==obj && obj.checked)
		{
		boxArray[i].checked = true; 
		}else
		{
		boxArray[i].checked = false;
		}
       }
} 
</Script>
</head>
<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
if(isset($_POST['paix']) and $_POST['paix']!="")//ÅÅÐò
	$px=$_POST['paix'];
else
	$px="a.name";
$_SESSION['mac']="select 0,0,a.name,
case menu.chax when 1 then case a.menuright when 1 then '<input style=\"height:18px\" type=checkbox checked onclick=\"cks(this,1,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' else '<input style=\"height:18px\" type=checkbox onclick=\"cks(this,1,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' end else '' end as cx,
case menu.lur when 1 then case a.menuright when 2 then '<input style=\"height:18px\" type=checkbox checked onclick=\"cks(this,2,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' else '<input style=\"height:18px\" type=checkbox onclick=\"cks(this,2,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' end else '' end as cx,
case menu.shenh when 1 then case a.menuright when 3 then '<input style=\"height:18px\" type=checkbox checked onclick=\"cks(this,3,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' else '<input style=\"height:18px\" type=checkbox onclick=\"cks(this,3,".$_GET['menuid'].",'+cast(a.empid as varchar(8))+')\" name=id'+cast(a.empid as varchar(8))+'>' end else '' end as cx
 from
(
select menur.menuid,menur.menuright,emp.name,
emp.empid,emp.yn from sys_user emp left join sys_menuright menur on emp.empid=menur.empid and menur.menuid=".$_GET['menuid']."
)a,sys_menu menu where a.yn=1 and menu.menuid=".$_GET['menuid']." order by ".$px;

$_SESSION['mac'].="#"."5,0,0,0,0,0";
$_SESSION['mac'].="#".",8%,35%,18%,24%,15%";
$_SESSION['mac'].="#".",center,left,center,center,center";
$_SESSION['mac'].="#"."";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include('./inc/xNoCountOneRow.php');
?>
</form>
</body>
</html> 
