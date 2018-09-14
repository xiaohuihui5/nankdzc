<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
if(isset($_SESSION['empid']))
	require('xc_c.php');
else
{
	$appId="ww971169be969f5217";//企业号id
	$appSecret="Cs9wp5aSl0TLKUXHCCC166S4ATTgMle67fqD9NaZ0Xw";//操作管理组随机标示号
	function https_request($url){$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$output=curl_exec($curl);curl_close($curl);return $output;}
	if(file_get_contents("access_token_time.txt")<time())//口令过时
	{
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$appId."&corpsecret=".$appSecret;$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'access_token')){$access_token=$fenk[$i+2];break;}//getAccessToken
		$fp=fopen("access_token.txt", "w");fwrite($fp,$access_token);fclose($fp);
		$fb=fopen("access_token_time.txt", "w");fwrite($fb,time()+7000);fclose($fb);
	}else
		$access_token=file_get_contents("access_token.txt");
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=2";
	$UserId='';
	$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'UserId')){$UserId=$fenk[$i+2];break;}
	if($UserId=='') {echo '非本企业用户非法登录!';exit;}
	require('xc_c.php');
	$query="select empid,name from sys_user where yn=1 and weixh='".$UserId."'";//一个促销员管理一家店,取得管理门店
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['empid']=$line[0];
		$_SESSION['uname']=$line[1];
		$_SESSION['DT1']=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));//前一天
		$_SESSION['DT2']=date('Y-m-d');//今天
	}else
	{echo '您尚未开通业务系统登录或帐号设置错误,请与管理员联系!';exit;}
	sqlsrv_free_stmt($result);
}
?>
