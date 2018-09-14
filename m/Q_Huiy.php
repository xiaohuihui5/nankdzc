<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
if(isset($_SESSION['empid']))//已经登录根据empid取出管辖企业id
	{
		$query="select 0,qyid from sys_user where empid=".$_SESSION['empid'];
		$result=sqlsrv_query($conn,$query);
		$line=sqlsrv_fetch_array($result);
			$qyid=$line[1];
		sqlsrv_free_stmt($result);
	}
else if(isset($_GET['code']))//首次从企业号菜单登录
{
	$appId="wx591791bdaca6994a";//企业号id
	$appSecret="pqv4dbf1gs4cuAV1Qio0xbrG6hrOhTNREtgiTHGQR78";//操作管理组随机标示号
	function https_request($url){$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$output=curl_exec($curl);curl_close($curl);return $output;}
	if(file_get_contents("access_token_time.txt")<time())//口令过时
	{
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$appId."&corpsecret=".$appSecret;$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'access_token')){$access_token=$fenk[$i+2];break;}//getAccessToken
		$fp=fopen("access_token.txt", "w");fwrite($fp,$access_token);fclose($fp);
		$fb=fopen("access_token_time.txt", "w");fwrite($fb,time()+7000);fclose($fb);
	}else
		$access_token=file_get_contents("access_token.txt");
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=1000002";
	$UserId='';
	$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'UserId')){$UserId=$fenk[$i+2];break;}
	if($UserId=='')
		{echo '非本企业用户非法登录!';exit;}
	else//根据企业号帐户匹配系统帐号
		{
		$query="select empid,qyid from sys_user where userid='".$UserId."'";
		$result=sqlsrv_query($conn,$query);
		$line=sqlsrv_fetch_array($result);
			$qyid=$line[1];$_SESSION['empid']=$line[0];
		sqlsrv_free_stmt($result);
		}
}
else {echo '非本企业用户非法登录!';exit;}

if(isset($_POST['paix']))
	$paix=$_POST['paix'];
else
	$paix=" 2";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>会议信息查询</title>
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
<div class="tab month_sel"><span class="jlp2"><p>可左右滑动下表,点列名排序,点会议名称所在行查看详情</p></span><!--<a class="jlp3" href="Jy_Main.php"></a>--></div>
<form action="" method="POST" id="tf">
<input id="paix" name="paix" type="hidden" value="<?php echo $paix;?>"></input>
<input id="scroll" name="scroll" type="hidden" value="<?php echo $scroll;?>"></input>
<ul class="round" id="notice2">
<table style="border:0px;margin:0;padding:0;">
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>会议类型:
<select id="qylx" name="qylx"  style="width:160px;font-size:16px;">
<option value="">--不限--</option>
                    <?php
                    $query='select id,fenlmc from sys_meetlx where yn=1 order by bianh,fenlmc';
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
			if(isset($_POST['qylx']) && $_POST['qylx']==$line[0])
                        	echo '<option selected value=',$line[0],'>',$line[1],'</option>';
			else 
                        	echo '<option value=',$line[0],'>',$line[1],'</option>';
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select></td><td  style="border:0px;margin:0;padding:0;" rowspan="2"><a href="javascript:tij()"><img src="images/search.gif" border="0" height="30" width="70" align="absbottom"></a></td></tr>
<tr style="border:0px;margin:0;padding:0;"><td style="border:0px;margin:0;padding:0;"><h2>模糊查找:<input type="text" placeholder="按关键字查询结果" name="cxtj" value="<?php echo $_POST['cxtj'];?>" style="width:160px;font-size:16px;"></h2></tr>
</table>
</ul>
<div class="showtable" id="showtable"><div style="padding: 1px 0; margin: 0;">
<table align="center" cellspacing="1" cellpadding="3" border="0" style="background-color: #c6d8ee; padding: 0; margin: 0;">
<thead align="center">
<tr style="font-size: 13px; line-height: normal;">
<?php
	$lie=array('0','1','序','会议议题','地点','开始时间','主持人','参与人员');
	for($i=2;$i<count($lie);$i++)//上面第3位置开始依次从左到右的列名
	{$f='';if($paix==$i.' desc') $f="↓"; else if($paix==$i) $f="↑";echo '<th onclick="javascript:s(',$i,')">',$lie[$i],$f,'</th>';}
?>
</tr>
</thead>
<tbody  id="biao" style="background-color: #eef5fd;line-height: normal;">
<?php
$TJ=" ";//查询条件

if(isset($_POST['cxtj']) && $_POST['cxtj']!="")
	$TJ.=" and a.yiti like '%".$_POST['cxtj']."%' ";
if(isset($_POST['qylx']) && $_POST['qylx']!="")
	$TJ.=" and a.lx=".$_POST['qylx'];

if($qyid!="")
	$TJ.=" and q.id in(".$qyid.") ";

$query="select 0,a.id,a.yiti,a.fangj,convert(varchar(16),a.ksrq,120),a.zcr,a.reny from sys_meet a,sys_meetlx b,sys_qiye q where a.lx=b.id and a.qyid=q.id  ".$TJ." order by ".$paix;
echo $query;
$result=sqlsrv_query($conn,$query);
$row=0;$yudl=0;$kc=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	echo '<tr id="',$line[1],'"><td align=center>',$row,'</td><td>',$line[2],'</td><td>',$line[3],'</td><td>',$line[4],'</td><td>',$line[5],'</td><td>',$line[6],'</td></tr>';
}
sqlsrv_free_stmt($result);
?>
</tbody>
</table></div>
</div>
</div>
</div>
</form>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
$('#lxa').click(function(){
	$('#paix').val(" cp.bh");
});
$('#lxb').click(function(){
	$('#paix').val(" aa desc");
});
$('#biao tr').click(function(){
	location.href="Q_HuiyMx.php?id="+$(this).attr("id");
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
</script>
</body>
</html>