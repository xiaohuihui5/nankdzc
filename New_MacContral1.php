<?php
require('./inc/xhead.php');require('./inc/xpage_downlib.php');
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="delete from sys_mac where id=".$_POST['delrow'];
	require('./inc/xexec.php');
}
$ed_row=0;
if(isset($_POST['mob']) and $_POST['mob']!=0)
{
	$query='update sys_mac set state=state^1 where id='.$_POST['mob'];
	include('./inc/xexec.php');
}
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
	if(isset($_POST['bz_']))
	{
	$query="update sys_mac set bz='".$_POST['bz_']."' where id=".$_POST['edtrow'];
	require("./inc/xexec.php");
	$ed_row=0;
	}
	else $ed_row=$_POST['edtrow'];
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:'';?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="selid" value="">
<input type="hidden" name="mob" value="0">
<table border="0" class="tableborder3">
<?php 
$TJ="";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and a.mac+isnull(a.bz,'') like '%".$_POST['cxtj']."%' ";

$query="select 0,a.id,a.mac,case len(a.bz) when 0 then null else a.bz end,case  a.state when 1 then '‘ &nbsp;–Ì'  else '<font color=gray>≤ª‘ –Ì</a>'  end from sys_mac a where id>0 ".$TJ." order by a.id";
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	if($ed_row==$line[1])
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="10%" height=20><?php echo $row;?></td>
	<td width="20%"><?php echo $line[2];?></td>
	<td width="40%"><input onkeydown="if(event.keyCode==13)sav()" name="bz_" value="<?php echo $line[3];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
	<td width="10%"><?php echo $line[4];?></td>                     
	<td width="10%" align="center"><a href="javascript:sav()"><img border=0 src=im/baoc.png></a></td>
	<td width="10%" align="center"><a href="javascript:can()"><img border=0 src=im/fanh.png></a></td>
	</tr>
<?php 
	}
	else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="10%" height=20><?php echo $row;?></td>
	<td width="20%"><?php echo $line[2];?></td>
	<td width="40%"><?php echo $line[3];?></td>
	<td width="10%" align="center"><a href="javascript:mob(<?php echo $line[1];?>,0)"><?php echo $line[4];?></a></td>
	<td width="10%" align="center"><a href="javascript:mod(<?php echo $line[1];?>,0)"><img border=0 src=im/xiug.png></a></td>
	<td width="10%" align="center"><a href="javascript:del(<?php echo $line[1];?>,0)"><img border=0 src=im/shanc.png></a></td>
	</tr>
<?php 
	}
}
sqlsrv_free_stmt($result);
?>
</table>
</form>
</body>
<script lanuage="javascript">
function mob(eid)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.mob.value=eid;
	window.Frm.submit();
}
	window.Frm.bz_.select();

</script>

<script defer="defer">setscroll();</script>
