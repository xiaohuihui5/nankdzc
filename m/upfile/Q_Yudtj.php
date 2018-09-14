<?php
require('./inc/xc_c.php');
if(isset($_POST['dt1']))
	$sell_rq=$_POST['dt1'];//下单日期
else
	$sell_rq=date('Y-m-d',strtotime("+1 day"));//下单日期
if(isset($_POST['paix']))
	$paix=$_POST['paix'];
else
	$paix=" cp.bh";
if(isset($_POST['scroll'])) $scroll=$_POST['scroll']; else $scroll=0;
if($_POST['cxtj']!="") $chax=$_POST['cxtj']; else $chax="";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title><?php echo $sell_rq,'订货统计';?></title>
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
	table hd{display:none;border: 1px solid #c3c3c3;white-space: nowrap;font-size:16px;}
	table ds{display:block;border: 1px solid #c3c3c3;white-space: nowrap;font-size:16px;}
</style>
</head>
<body id="cardintegral" class="mode_webapp" style="margin:0px">
<div class="jifen-box header_highlight">
<div class="tab month_sel"><span class="jlp2"><p>可左右滑动下表,点列名排序,点品种所在行展开明细</p></span><!--<a class="jlp3" href="Jy_Main.php"></a>--></div>
<form action="" method="POST" id="tf">
<input id="paix" name="paix" type="hidden" value="<?php echo $paix;?>"></input>
<input id="scroll" name="scroll" type="hidden" value="<?php echo $scroll;?>"></input>
<ul class="round" id="notice2">
<table style="border:0px;margin:0;padding:0;">
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>送货日期:<input type="date" name="dt1" value="<?php echo $sell_rq;?>" style="font-size:16px;"></h2></td>
<td  style="border:0px;margin:0;padding:0;" align=center rowspan=2><a href="javascript:tij()"><img src="images/search.gif" border="0" height="30" width="70" align="absbottom"></a></td></tr>
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>模糊查找:<input type="text" placeholder="按关键字查产品" name="cxtj" value="<?php echo $chax;?>" style="font-size:16px;"></h2></tr>
</table>
</ul>
<div class="showtable" id="showtable"><div style="padding: 1px 0; margin: 0;">
<table align="center" cellspacing="1" cellpadding="3" border="0" style="background-color: #c6d8ee; padding: 0; margin: 0;">
<thead align="center">
<tr style="font-size: 13px; line-height: normal;">
<?php
	$lie=array('0','1','产品名称','订货量','库存量','单位','规格');
	for($i=2;$i<count($lie);$i++)//上面第3位置开始依次从左到右的列名
	{$f='';if($paix==$i.' desc') $f="↓"; else if($paix==$i) $f="↑";echo '<th onclick="javascript:s(',$i,')">',$lie[$i],$f,'</th>';}
?>
</tr>
</thead>
<tbody  id="biao" style="background-color: #eef5fd;line-height: normal;">
<?php
$TJ=" and dh.dhrq='".$sell_rq."' ";
if($chax!="")
	$TJ.=" and cp.mc like '%".$chax."%' ";
//实际库存
$query="select sj.mc,sum(sj.shisl) from sys_jhsj sj,sys_jhdh dh where dh.dhrq='".$sell_rq."' sj.dhid=dh.id and dh.lx=5 group by sj.mc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$kuc[$line[0]]=$line[1];//盘点数量
}
sqlsrv_free_stmt($result);
//实际库存

$query="select cp.id,cp.mc,sum(sj.dinghl),cp.dw,cp.gg from sys_jhdh dh,sys_jhsj sj,sys_cp cp where sj.dinghl>0 and dh.id=sj.dhid and sj.mc=cp.id and dh.lx in(2,4) ".$TJ." group by cp.id,cp.mc,cp.bh,cp.dw,cp.gg order by ".$paix;
//echo $query;
$result=sqlsrv_query($conn,$query);
$row=0;$yudl=0;$kc=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	$yudl+=$line[2];
	if(isset($kuc[$line[0]]))
		{$kc+=$kuc[$line[0]];$diskc=$kuc[$line[0]];}
	else
		$diskc=$kuc[$line[0]];
		echo '<tr id="',$line[0],'"><td>',$line[1],'</td><td align=right>',$line[2],'</td><td align=right>',$diskc,'</td><td>',$line[3],'</td><td>',$line[4],'</td></tr>
<tr><td colspan="5" id="r',$line[0],'" onclick="this.style.display=\'none\';" style="display:none;"></td></tr>';
}
sqlsrv_free_stmt($result);
echo '<tr><td colspan=1 align=center><font color=red>合计</td><td align=right><font color=red>',sprintf("%1.1f",$yudl),'</font></td><td align=right><font color=red>',sprintf("%1.1f",$kc),'</font></td><td></td><td></td></tr>';
?>
</tbody>
</table></div>
</div>
</div>
</div>
</form>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
$('#biao tr').click(function(){
	if($('#r'+$(this).attr("id")).css("display")=="none")
	{
		var tmp=$('#r'+$(this).attr("id"));
		$.post("Q_YudtjAjax.php",{cpid:$(this).attr("id"),rq:'<?php echo $sell_rq;?>'},
		function(data){
		tmp.html(data);
		tmp.css("display","block");
		}
		)
	}
	else
		$('#r'+$(this).attr("id")).css("display","none");
});
</script>
<script type="text/javascript">
function op(id)
{
		document.getElementById("r"+id).style.display="block";
}
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
