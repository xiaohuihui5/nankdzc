<?php 
require('./inc/xhead.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)//���ã�����
{
	$query='update sys_menu set display=case display when 1 then 0 else 1 end where menuid='.$_POST['delrow'];
	include('./inc/xexec.php');
}
if(isset($_POST['kaitc']) and $_POST['kaitc']!=0)//��ͨ��ֹ��ѯ
{
	$query='update sys_menu set chax=case chax when 1 then null else 1 end where menuid='.$_POST['kaitc'];
	include('./inc/xexec.php');
}
if(isset($_POST['kaitl']) and $_POST['kaitl']!=0)//��ͨ��ֹ¼��
{
	$query='update sys_menu set lur=case lur when 1 then null else 1 end where menuid='.$_POST['kaitl'];
	include('./inc/xexec.php');
}
if(isset($_POST['kaits']) and $_POST['kaits']!=0)//��ͨ��ֹ���
{
	$query='update sys_menu set shenh=case shenh when 1 then null else 1 end where menuid='.$_POST['kaits'];
	include('./inc/xexec.php');
}
if(isset($_POST['shang']) and $_POST['shang']!=0)//��
{
	$query='select max(topmenuid) from sys_menu where topmenuid<'.$_POST['shang'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]!='')
	{
	$query='update sys_menu set topmenuid=topmenuid-1 where topmenuid<'.$line[0];
	include('./inc/xexec.php');
	$query='update sys_menu set topmenuid='.$line[0].'-1 where topmenuid='.$_POST['shang'];
	include('./inc/xexec.php');
	}
	sqlsrv_free_stmt($result);
}
if(isset($_POST['xia']) and $_POST['xia']!=0)//��
{
	$query='select min(topmenuid) from sys_menu where topmenuid>'.$_POST['xia'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]!='')
	{
	$query='update sys_menu set topmenuid=topmenuid+1 where topmenuid>'.$line[0];
	include('./inc/xexec.php');
	$query='update sys_menu set topmenuid='.$line[0].'+1 where topmenuid='.$_POST['xia'];
	include('./inc/xexec.php');
	}
	sqlsrv_free_stmt($result);
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<style>
	#con tr td:nth-child(2){text-align:left;}
</style>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="kaitc" value="0">
<input type="hidden" name="kaitl" value="0">
<input type="hidden" name="kaits" value="0">
<input type="hidden" name="shang" value="0">
<input type="hidden" name="xia" value="0">
<?php
$_SESSION['mac']="select * from sys_menu order by topmenuid asc";
$_SESSION['mac'].="#"."13,0,0,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",4%,20%,25%,17%,6%,4%,4%,4%,4%,2%,2%,4%,4%";
$_SESSION['mac'].="#".",center,left,left,left,center,right,center,center,center,center,center,center,center";
$_SESSION['mac'].="#".",��,�˵�����,���ӵ�ַ,����˵��,���ڲ�,����,��ѯ,¼��,���,��,��,�޸�,״̬";
$_SESSION['mac'].="#ϵͳ�˵�";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include('./inc/xNoCountdis1.php');
?>
</form>
</body>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script language=javascript>
function ed(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show("�༭�˵�",'<?php echo $xiam;?>Edit.php?eid='+id,800,600,"parent");
}
function kc(id)//��ͨ���ֹ���˲˵��Ĳ�ѯȨ��
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.kaitc.value=id;
	window.Frm.submit()
}
function kl(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.kaitl.value=id;
	window.Frm.submit()
}
function ks(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.kaits.value=id;
	window.Frm.submit()
}
function ss(topmenuid)//��
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.shang.value=topmenuid;
	window.Frm.submit()
}
function xx(topmenuid)//��
{
	alert($(this).attr("href"));
	//window.Frm.scroll.value=document.body.scrollTop;
	//window.Frm.xia.value=topmenuid;
	//window.Frm.submit()
}
function yn(topmenuid)//״̬
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.delrow.value=topmenuid;
	window.Frm.submit()
}
</script>
<script defer="defer">setscroll();</script>
