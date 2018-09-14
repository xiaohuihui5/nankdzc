<?php
require('./inc/xc_c.php');
if(isset($_POST['paix'])) $paix=$_POST['paix']; else $paix=" unit.shortname";
if(isset($_POST['scroll'])) $scroll=$_POST['scroll']; else $scroll=0;
if($_POST['cxtj']!="")
	$chax=$_POST['cxtj'];
$query="select cp.mc from sys_cp cp where cp.id=".$_GET['cpid'];
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$mc=$line[0];
}
sqlsrv_free_stmt($result);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title><?php echo '当前商品:' .$mc;?></title>
<script>document.addEventListener('WeixinJSBridgeReady',function onBridgeReady(){WeixinJSBridge.call('hideOptionMenu');});</script>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="./js/style_sz.css" rel="stylesheet" type="text/css">
    <style>
        .showtable {overflow-x:scroll;margin:0;padding:0;background-color: #ecf7fd; -webkit-overflow-scrolling: touch; }
	table {width: auto; border-collapse: collapse; border: 1px solid #c3c3c3;font-size:16px;}
	table td, table th { border: 1px solid #c3c3c3;white-space: nowrap;font-size:16px;}
	table td input{font-size:20px;}
</style>
</head>
<body id="cardintegral" class="mode_webapp" style="margin:0px">
<div class="jifen-box header_highlight">
<div class="tab month_sel"><span class="jlp2">&nbsp;<p>可左右滑动下表,点列名排序</p></span><!--<a class="jlp3" href="Jy_Main.php"></a>--></div>
<form action="" method="POST" id="tf">
<input id="paix" name="paix" type="hidden" value="<?php echo $paix;?>"></input>
<input id="scroll" name="scroll" type="hidden" value="<?php echo $scroll;?>"></input>
<ul class="round" id="notice2">
<table style="border:0px;margin:0;padding:0;">
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>模糊查找:<input type="text" name="cxtj" value="<?php echo $chax;?>" style="font-size:16px;"></h2><td  style="border:0px;margin:0;padding:0;" align=center><a href="javascript:tij()"><img src="images/search.gif" border="0" height="30" width="70" align="absbottom"></a></td></tr>
</table>
</ul>
<div class="showtable" id="showtable"><div style="padding: 1px 0; margin: 0;">
<table align="center" cellspacing="1" cellpadding="3" border="0" style="background-color: #c6d8ee; padding: 0; margin: 0;">
<thead align="center">
<tr style="font-size: 13px; line-height: normal;">
<?php
	$lie=array('0','1','客户名称','订货量','备注','录入员');
	for($i=2;$i<count($lie);$i++)//上面第3位置开始依次从左到右的列名
	{$f='';if($paix==$i.' desc') $f="↓"; else if($paix==$i) $f="↑";echo '<th onclick="javascript:s(',$i,')">',$lie[$i],$f,'</th>';}
?>
</tr>
</thead>
<tbody style="background-color: #eef5fd;line-height: normal;">
<?php
$query="select 0,unit.shortname,sj.dinghl,sj.bz,dh.lury from sys_jhdh dh,sys_jhsj sj,sys_unit unit where sj.dinghl>0 and unit.shortname like '%".$chax."%' and sj.mc=".$_GET['cpid']." and dh.id=sj.dhid and dh.unit=unit.id and dh.dhrq='".date('Y-m-d')."' and dh.lx in(2,4) order by ".$paix;
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	$yudl+=$line[2];
		echo '<tr><td>',$line[1],'</td><td align=right>',$line[2],'</td><td>',$line[3],'</td><td align=center>',$line[4],'</td></tr>';
}
sqlsrv_free_stmt($result);
echo '<tr><td colspan=6 align=left><font color=red>合计:',sprintf("%1.2f",$yudl),'</font></td></tr>';
?>
</tbody>
</table></div>
</div>
</div>
</div>
</form>
<script type="text/javascript">
function tij()
{
		document.getElementById("tf").submit();
}
function s(lie){
if(lie==document.getElementById("paix").value)
	document.getElementById("paix").value=lie+' desc';
else
	document.getElementById("paix").value=lie;
document.getElementById("scroll").value=document.getElementById("showtable").scrollLeft;//记录滚动位置
document.getElementById("tf").submit();
}
function mx(id){
	location.href="Jy_Mx.php?dhid="+id;
}
document.getElementById("showtable").scrollLeft=<?php echo $scroll;?>;
</script>
</body>
</html>
