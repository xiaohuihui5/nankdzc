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
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=1000004";
	$UserId='JiangLiHua';
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
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<head lang="en">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>�ɹ��ƻ���  </title>
    <link rel="stylesheet" href="mobile/css/weui.min.css">
    <link rel="stylesheet" href="mobile/css/jquery-weui.min.css">
    <script type="text/javascript" src="mobile/js/jquery.min.js"></script>
    <script type="text/javascript" src="mobile/js/jquery-weui.min.js"></script>

<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script src="./js/jquery-1.7.1.min.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.sending.style.visibility="visible";parent.cover.style.visibility="visible";window.Frm.submit();}
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
<body>
<style>
  .min_head img{
    width: 2.2em;
    height: 2.2em;
  }
  .min_head{
    margin-right: .2em;
    border-radius: 3em;
  }
  .two_list li a.weui-cell{
    padding: 0;
    width: 100%;
  }
  .sign{
    border: 1px solid #D60711;
    border-radius: 4px;
    color: #D60711;
    /*border: 1px solid #d31e1e;*/
  }
  .sign a{
    color: #D60711;
  }
  .searchhead{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
  }
  .active{
    background-color: #D60711;
  }
  .active a,.active .weui-cell__ft{
    color: #fff;
  }
</style>


<div class="searchhead">
  	<div class="weui-search-bar" id="searchBar" style="height: 44px;">
	<li class="weui-cell weui-cell_access list_one">
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">���µ�<?php echo $yi_xiad;?></div></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">���µ�<?php echo $yi_xiad;?></div></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">���µ�<?php echo $yi_xiad;?></div></a>|
	</li>
	</div>

  	<div class="weui-search-bar" id="searchBar">
		<div style="text-align:center;width:7%;"><p>��</p></div>
		<div class="weui-cell__bd" style="text-align:center;width:43%;"><p>��Ʒ����</p></div>
		<div style="text-align:center;width:10%;"><p>��λ</p></div>
		<div style="text-align:center;width:20%;"><p>������</p></div>
		<div style="text-align:center;width:20%;"><p>�ɹ���</p></div>
	</div>

</div>
<p style="height: 24px;"></p>
<div id="all_list">
  <ul class="weui-cells two_list">
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" align=center>
<?php
	$row=0;
			$query='select id,fenlmc from sys_cpxiaofl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				$row++;
				$a=500+$row;
				$b=1000+$row;
				$c=1500+$row;
				$d=2000+$row;

				echo '<tr> 
					<td align=center style="width:7%;"><div><p>'.$row.'</p></div></td>
					<td style="width:43%;"><div class="weui-cell__bd"><p>'.$line[1].'</p></div></td>
					<td align=center style="height:30px;width:10%;"><div><p>��</p></div></td>
					<td style="width:20%;"><input type="hidden" name="odinghl['.$row.']" value="'.$dh_sl[$line[0]].'"><input onfocus="this.select();" id="'.$a.'" name="dinghl['.$row.']" value="'.$dh_sl[$line[0]].'" style="text-align:center;height:35px;width:100%;" type="tel"></td> 
					<td style="width:20%;"><input type="hidden" name="odinghl['.$row.']" value="'.$dh_sl[$line[0]].'"><input onfocus="this.select();" id="'.$b.'" name="dinghl['.$row.']" value="'.$dh_sl[$line[0]].'" style="text-align:center;height:35px;width:100%;" type="tel"></td> 
				</tr>';
			}       
			sqlsrv_free_stmt($result);
?>     
</table> 
    </ul>
</div>
<script>
  // �����׸���ѯ�¼�
  var active = 0;
  $('.weui-icon-search').click(function(){
    search();
  })
  function search(){
    // ��ȡ�������ֵ
    var kwds = $("#searchInput").val();
    // ��ȡ��һ���б�����
    var this_one = {};
    var real_name = '';
    // �������������б�
    var list = $("#all_list .list_one");
    // ������ҵ���ʼֵ
    var true_one = 0;

    for (var i = 0; i < list.length; i++) {
      this_one = $(list[i]);
      real_name = this_one.data('real_name').toString();
      // ִ��likeƥ��
      if(real_name.match(kwds)){
        // �����һ�����
        if(true_one == active){
          // ��ȡ���ڵĿ�͸�
          // var windows_wdh = $(window).width();
          var windows_hgt = $(window).height();
          // ��ȡ��һ������
          // var x_len = this_one.offset().left;
          var y_len = this_one.offset().top;
          // ����������������ָ����λ��
          $("html,body").animate({scrollTop:(y_len-windows_hgt/2)},500);
          // ��ǵ�ǰѡ�еĽ��
          this_one.addClass('active');
          this_one.removeClass('sign');
        }else{
          // ��Ƿ��ϵĽ��
          this_one.addClass('sign');
          this_one.removeClass('active');
        }
        // �ۼ���ʵ��ѡ��
        true_one++;
      }else{
        this_one.removeClass('sign');
        this_one.removeClass('active');
      }
    }
    // �ж��Ƿ�������� ���������� ��ӵ�һ����ʼ �������������һ��
    active = active >= true_one-1 ? 0 : active+1;

    return false;
  }
</script>
</body>
</html>
