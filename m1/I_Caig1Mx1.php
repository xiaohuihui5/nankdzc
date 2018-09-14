<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(14);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="delete from sys_jhsj  where id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['cpid']) && $_POST['cpid']!='')
{
	$_POST['bz']=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$_POST['dinghl']=$_POST['dinghl']==""?"0":"".$_POST['dinghl']."";
	$_POST['dj']=$_POST['dj']==""?"0":"".$_POST['dj']."";
	$_POST['jine']=$_POST['jine']==""?"0":"".$_POST['jine']."";

//用过的产品插入常用表
	$query = "select dh.unit from sys_jhdh dh where dh.id=".$_POST['dhid'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$khid=$line[0];	
	sqlsrv_free_stmt($result);

	$query="if exists (select id from sys_khcy where khid=".$khid." and cpid=".$_POST['cpid'].") 
update sys_khcy set num=num+1,dj=".$_POST['dj']." where  khid=".$khid." and cpid=".$_POST['cpid']." else 
insert into sys_khcy(khid,cpid,num,dj) values(".$khid.",".$_POST['cpid'].",1,".$_POST['dj'].")";
		include("./inc/xexec.php");
//用过的产品插入常用表


	$query="select max(paix)+1 from sys_jhsj where dhid=".$_POST['dhid'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$paix=$line[0]==""?"1":"".$line[0]."";
	sqlsrv_free_stmt($result);

	$query="insert into sys_jhsj(dhid,mc,songhl,dj,shisje,bz,lury,lx,gysid,khmc,zt,paix) values(".$_POST['dhid'].",".$_POST['cpid'].",".$_POST['songhl'].",".$_POST['dj'].",".$_POST['jine'].",".$_POST['bz'].",'".$_SESSION['uname']."',1,".$_POST['kh_id'].",'".$_POST['spdm_2']."',0,".$paix.")";
	include("./inc/xexec.php");
}
if(isset($_POST['row']) && $_POST['delrow']==0)
{
	for($i=1;$i<=$_POST['row'];$i++)
	{
		if($_POST['paix'][$i]!=$_POST['opaix'][$i] || $_POST['songhl'][$i]!=$_POST['osonghl'][$i] || $_POST['dj'][$i]!=$_POST['odj'][$i] || $_POST['bz'][$i]!=$_POST['obz'][$i])
		{
			$_POST['bz'][$i]=$_POST['bz'][$i]==""?"null":"'".$_POST['bz'][$i]."'";
			$_POST['songhl'][$i]=$_POST['songhl'][$i]==""?"0":"".$_POST['songhl'][$i]."";
			$_POST['dj'][$i]=$_POST['dj'][$i]==""?"0":"".$_POST['dj'][$i]."";
			$ssje=@sprintf("%1.2f",$_POST['songhl'][$i]*$_POST['dj'][$i]);

		$query="update sys_jhsj set paix=".$_POST['paix'][$i].",songhl=".$_POST['songhl'][$i].",dj=".$_POST['dj'][$i].",shisje=".$ssje.",bz=".$_POST['bz'][$i]." where id=".$_POST['id'][$i];
		$query=str_replace("=,","=null,",$query);
		$query=str_replace("=,","=null,",$query);
		include("./inc/xexec.php");
		}
	}
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}
if(nKeyCode==120) {parent.SelCp();}
else if(nKeyCode==38){tt=document.getElementById(event.srcElement.id*1-1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==40 || nKeyCode==13){tt=document.getElementById(event.srcElement.id*1+1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==37){tt=document.getElementById(event.srcElement.id*1-500);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==39){tt=document.getElementById(event.srcElement.id*1+500);if(tt){tt.select();tt.focus();}}
}
$(function(){
            $("input").focus(function(){
$(this).parents("tr").css("background-color","#DDECFE").siblings().css("background-color","#ffffff");
            });
$("tr").click(function(){
$(this).css("background-color","#DDECFE").siblings().css("background-color","#ffffff");
});
        });
</script>

</head>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="<?php echo $delrow;?>">
<input type="hidden" name="edtrow" value="0">
<table border="1" class="tableborder3">
<?php 
$menuright=menuright(20);//取得菜单权限
$query="select CONVERT(varchar(10),dh.dhrq,120),dh.unit from sys_jhdh dh where dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$dh_rq=$line[0];
$khid=$line[1];
sqlsrv_free_stmt($result);


$query="select sj.shisl,sj.mc,dh.unit from sys_jhdh dh,sys_jhsj sj,sys_cp cp,sys_unit unit where dh.id=sj.dhid and cp.id=sj.mc and dh.unit=unit.id and dh.lx=2 and dh.dhrq='".$dh_rq."'";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$shisl[$line[1]][$line[2]]=$line[0];
}
sqlsrv_free_stmt($result);
$row=0;
$query = "select sj.id,sj.paix,cp.bh,cp.mc,cp.gg,cp.dw,cast(sj.dinghl as varchar)+sj.fudw,unit.shortname,'',sj.songhl,sj.dj,sj.shisje,sj.bz,dh.zt,cp.id,sj.gysid from sys_jhsj sj,sys_cp cp,sys_jhdh dh,sys_unit unit where sj.gysid=unit.id and dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$_REQUEST['dhid']." order by sj.paix";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
$line[8]=$shisl[$line[14]][$line[15]]==0?"":$shisl[$line[14]][$line[15]];
$line[9]=$line[9]==0?"":$line[9];
$line[10]=$line[10]==0?"":$line[10];
$line[11]=$line[11]==0?"":$line[11];
	$row=$row+1;
	if($menuright>1 and ($line[13]==0 or $line[13]==9))//录入
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="4%"><input type="hidden" name="opaix[<?php echo $row;?>]" value="<?php echo $line[1];?>"><input onfocus="this.select();" id="<?php echo 1000+$row;?>" name="paix[<?php echo $row;?>]" value="<?php echo $line[1];?>" style="text-align:center;height:100%;width:100%;background-color: #EAEAEA;"></td>
		<td width="6%" align="center"><?php echo $line[2];?><input type=hidden value="<?php echo $line[0];?>" name="id[<?php echo $row;?>]"></td>
		<td width="16%"><?php echo $line[3];?></td>
		<td width="8%"><?php echo $line[4];?></td>
		<td width="6%"><?php echo $line[5];?></td>
		<td width="6%"><?php echo $line[6];?></td>
		<td width="12%"><a href="javascript:openwindow2('Q_Sell_dhmx.php?khid=<?php echo $line[15]."&cpid=".$line[14]."&shrq=".$dh_rq;?>',780,680)"><?php echo $line[7];?></a></td>
		<td width="6%"><?php echo $line[8];?></td>
		<td width="6%"><input type="hidden" name="osonghl[<?php echo $row;?>]" value="<?php echo $line[9];?>"><input onfocus="this.select();" id="<?php echo 2000+$row;?>" name="songhl[<?php echo $row;?>]" value="<?php echo $line[9];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="6%"><input type="hidden" name="odj[<?php echo $row;?>]" value="<?php echo $line[10];?>"><input onfocus="this.select();" id="<?php echo 3000+$row;?>" name="dj[<?php echo $row;?>]" value="<?php echo $line[10];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="8%" align=right><?php echo $line[11];?></td>
		<td width="8%"><input type="hidden" name="obz[<?php echo $row;?>]" value="<?php echo $line[12];?>"><input onfocus="this.select();" id="<?php echo 4000+$row;?>" name="bz[<?php echo $row;?>]" value="<?php echo $line[12];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="4%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src="im/shanc.png" title="删除此行数据"></a></td>
	</tr>
<?php
	}
else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="4%"><?php echo $line[1];?></td>
		<td width="6%"><?php echo $line[2];?></td>
		<td width="16%"><?php echo $line[3];?></td>
		<td width="8%"><?php echo $line[4];?></td>
		<td width="6%"><?php echo $line[5];?></td>
		<td width="6%"><?php echo $line[6];?></td>
		<td width="12%"><?php echo $line[7];?></td>
		<td width="6%"><?php echo $line[8];?></td>
		<td width="6%"><?php echo $line[9];?></td>
		<td width="6%"><?php echo $line[10];?></td>
		<td width="8%"><?php echo $line[11];?></td>
		<td width="12%"><?php echo $line[12];?></td>
	</tr>
<?php
	}
$hjshisl+=$line[9];
$hjjine+=$line[11]; 
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"></td>
		<td width="4%"></td>
		<td width="6%"></td>
		<td width="16%"></td>
		<td width="8%"></td>
		<td width="6%"></td>
		<td width="6%"></td>
		<td width="12%"></td>
		<td width="6%"><font color=red>合计</font></td>
		<td width="6%"><font color=red><?php echo $hjshisl;?></font></td>
		<td width="6%"></td>
		<td width="8%"><font color=red><?php echo $hjjine;?></font></td>
		<td width="12%" colspan="2"></td>
	</tr>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $row;?>" name=row></td>
</form>
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
