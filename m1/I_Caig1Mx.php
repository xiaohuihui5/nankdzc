<?php 
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
if(isset($_SESSION['eid']))
	require('./inc/xc_c.php');
else
{
	$appId="ww7f79791c4b51cb3c";//��ҵ��id
	$appSecret="RSpXcIvf_HZEFu7R-qphui-clwwa2Ety5iHUBlPqDAw";//���������������ʾ��
	function https_request($url){$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$output=curl_exec($curl);curl_close($curl);return $output;}
	if(file_get_contents("access_token_time.txt")<time())//�����ʱ
	{
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$appId."&corpsecret=".$appSecret;$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'access_token')){$access_token=$fenk[$i+2];break;}//getAccessToken
		$fp=fopen("access_token.txt", "w");fwrite($fp,$access_token);fclose($fp);
		$fb=fopen("access_token_time.txt", "w");fwrite($fb,time()+7000);fclose($fb);
	}else
		$access_token=file_get_contents("access_token.txt");
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=3";
	$UserId='';
	$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'UserId')){$UserId=$fenk[$i+2];break;}
	if($UserId=='') {echo '�Ǳ���ҵ�û��Ƿ���¼!';exit;}
	require('./inc/xc_c.php');
	$query="select empid from sys_user where yn=1 and weixh='".$UserId."'";//һ������Ա����һ�ҵ�,ȡ�ù����ŵ�
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['eid']=$line[0];
	}
	else
	{echo '����δ��ͨ�˹��ܻ��ʺ����ô���,�������Ա��ϵ!';exit;}
	sqlsrv_free_stmt($result);
}


require('./inc/xpage_uplib_list.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<script language="javascript">window.onbeforeunload = function(){window.parent.opener.Frm.submit();}</script><!--�ر�ҳ��ˢ�µ���ҳ��-->
<STYLE type=text/css>
body{font-family:"΢���ź�";}
#th{width:100%;border:0px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 0px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:30px!important;}
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script type="text/javascript" src="I_SellxSelpmMohu.js"></script>
<script language="javascript" src="xSelkhMohu_2.js"></script>
<script language="javascript">
document.onkeydown=bb;function bb()
{var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}if(nKeyCode==120) {SelCp();}
}
</script>

</head>
<body>
<?php
$menuright=menuright(20);//ȡ�ò˵�Ȩ��
//ȡ�õ�����Ϣ
$query="select dh.dh,CONVERT(varchar(10),dh.dhrq,120),CONVERT(varchar(10),dh.rq,120),unit.shortname,dh.lury,dh.bz,dh.unit,unit.typeb,dh.zt from sys_jhdh dh,sys_unit unit where dh.unit=unit.id and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$_SESSION['kh_id']=$line[6];//ɸѡ����Ʒ����
$khid=$line[6];
$khflid=$line[7];
$dh_zt=$line[8];
$R_Q=$line[1];
$tis="&nbsp;&nbsp;����:<font color=black>".$line[0]."</font>";
$tis.="&nbsp;&nbsp;����:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;��Ӧ��:<font color=black>".$line[3]."</font>";
$tis.="&nbsp;&nbsp;�Ƶ�:<font color=black>".$line[4]."</font>";
$tis.="&nbsp;&nbsp;��ע:<font color=black>".$line[5]."</font>";
sqlsrv_free_stmt($result);
//ȡ�õ�����Ϣ
$tit='';
if($menuright>1 and ($dh_zt==0 or $dh_zt==9))//¼��
{
$lur='
<table class="table-row" width="100%"><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm">
<tr>
<td width="10%" algin=center onclick="SelCp()"><div class="text-c"><font color=blue>��Ʒ����</font>[F9]</div></td>
<td width="18%" algin=center><div class="text-c"><span class="c-red">*</span>��Ʒ����</div></td>
<td width="9%" algin=center><div class="text-c"><span class="c-red">*</span>�ɹ���</div></td>
<td width="9%" algin=center><div class="text-c"><span class="c-red">*</span>����</div></td>
<td width="9%" algin=center><div class="text-c"><span class="c-red">*</span>���</div></td>
<td width="15%" algin=center><div class="text-c"><span class="c-red">*</span>��Ӧ�ͻ�</div></td>
<td width="15%" algin=center><div class="text-c">��ע</div></td>
<td width="15%" algin=center></td>
</tr>
<tr>
<td algin=center><div class="text-c">
<input type="hidden" name="gysid" id="gysid">
<input type="hidden" name="dhid" value="'.$_REQUEST['dhid'].'">
<input type="hidden" name="cpid" id="cpid">
<input type="hidden" id="oldvalue" name="oldvalue">
<input type="text" class="input-text" style="width: 90px;" onkeyup="AutoFinish()"   title="������ؼ���"  onclick="this.select();CloseTipDiv();" id="spdm" name="spdm">
</div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:180px" id="cpmc" name="cpmc"></div></td> 
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="songhl" name="songhl" onkeyup="window.IFrm.jine.value=window.IFrm.dj.value*window.IFrm.songhl.value" onkeypress="check(this,2)" onkeydown="if(event.keyCode==13){window.IFrm.dj.select();}else  if(event.keyCode==39){window.IFrm.dj.select();}"> </div></td> 
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="dj" name="dj"  onkeyup="window.IFrm.jine.value=window.IFrm.dj.value*window.IFrm.songhl.value" onkeydown="if(event.keyCode==13){window.IFrm.jine.select();}else  if(event.keyCode==39){window.IFrm.jine.select();}else  if(event.keyCode==37){window.IFrm.songhl.select();}" onkeypress="check(this,2)"></div></td>

<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="jine" name="jine" onkeydown="if(event.keyCode==13){window.IFrm.spdm_2.select();}else  if(event.keyCode==39){window.IFrm.spdm_2.select();}else  if(event.keyCode==37){window.IFrm.dj.select();}"></div></td>

<td align=center><div class="text-c"><input type="hidden" name="kh_id" id="kh_id"><input type="hidden" id="oldvalue_2" name="oldvalue_2"><input type="text" class="input-text" onkeyup="AutoFinish_2()" title="������ؼ���" onclick="this.select();CloseTipDiv_2();" style="width: 150px;" id="spdm_2" name="spdm_2"></div></td>

<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:140px"  id="bz" name="bz" onkeydown="if(event.keyCode==13){sub();}else  if(event.keyCode==37){window.IFrm.dj.select();}"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-success radius" type="button" value="��&nbsp;��" onclick="sub();"></div></td>
</tr>
</IFrm>
</table>
';
}
else
{
$lur='<table width=100%><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm"><tr><td align=center><font size=5 color=red>��ѯȨ��/���������</font></td></tr></form></table>';
}
$cha='';
$lnk='<span class="r"> 
<a href="I_Sell1MxExcel.php?dhid='.$_REQUEST['dhid'].'"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>����</a> 
<a href="JavaScript:openwindow2(\'I_Sell1MxPrint.php?dhid='.$_REQUEST['dhid'].'\',850,500)" title="��ӡ��ҳ����" class="btn radius"><img border=0 src=im/dy.png>��ӡ</a> </span>';
if($menuright>1 and ($dh_zt==0 or $dh_zt==9))//¼��
{
$tis.='&nbsp;&nbsp;&nbsp;<a href="javascript:update()" class="btn btn-success radius"> F8 ����</a>';
$lie=",��,��,���,��Ʒ����,���,��λ,�ͻ�����,�ͻ�����,�ͻ�ʵ��,ʵ�ʲɹ�,����,���,��ע,ɾ";
$wid=",4%,4%,6%,16%,8%,6%,6%,12%,6%,6%,6%,8%,8%,4%";
}
else
{
$lie=",��,��,���,��Ʒ����,���,��λ,�ͻ�����,�ͻ�����,�ͻ�ʵ��,ʵ�ʲɹ�,����,���,��ע";
$wid=",4%,4%,6%,16%,8%,6%,6%,12%,6%,6%,6%,8%,12%";
}
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid'],$tis,$xuh,$yul);

?>
</body>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=cpid]").val()=="" || $("input[name=cpid]").val()==null)
	{
		layer.msg('��ѡȡ��Ʒ��', {icon:2,time:1500});
		window.IFrm.spdm.focus();
		return false;
	}
	else
	{
		window.IFrm.submit();
		window.IFrm.reset();
		window.IFrm.spdm.focus();
		//javascript:parent.location.replace(location.href);//����תˢ��
	}
}
function startRequest(spbh,id)//�������Ʒid����Cs_SellfljgAjax.phpֱ�ӵõ���Ʒ������ģ������
{
	createXMLHttpRequest();
	xmlHttp.open("post","I_SellAjax.php",true);//�ύ���ؽ����phpҳ��
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");
			window.IFrm.cpid.value=arrTmp[0];
			window.IFrm.cpmc.value=arrTmp[1];
			window.IFrm.dj.value=arrTmp[2];
			window.IFrm.gysid.value=arrTmp[3];
			window.IFrm.songhl.select();
			window.IFrm.songhl.focus();
                        CloseTipDiv();
			}
		}
	};
	xmlHttp.send("spbh="+spbh+"&id="+id+"&khid=<?php echo $khid."&khflid=".$khflid."&RQ=".$R_Q;?>");//���ݸ�phpҳ��Ĳ���
}
function startRequest_2(spbh,id)//�ͻ�
{
	createXMLHttpRequest();
	xmlHttp.open("post","xSelkhAjax.php",true);//�ύ���ؽ����phpҳ��
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");
			window.IFrm.kh_id.value=arrTmp[0];
			window.IFrm.spdm_2.value=arrTmp[1];
			window.IFrm.bz.select();
			window.IFrm.bz.focus();
		      CloseTipDiv_2();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//���ݸ�phpҳ��Ĳ���
}
var tt=document.getElementById('spdm');
if(tt){document.getElementById('spdm').select();document.getElementById('spdm').focus();}
</script>
