<?php 
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
if(isset($_SESSION['eid']))
	require('./inc/xc_c.php');
else
{
	$appId="ww7f79791c4b51cb3c";//企业号id
	$appSecret="RSpXcIvf_HZEFu7R-qphui-clwwa2Ety5iHUBlPqDAw";//操作管理组随机标示号
	function https_request($url){$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$output=curl_exec($curl);curl_close($curl);return $output;}
	if(file_get_contents("access_token_time.txt")<time())//口令过时
	{
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$appId."&corpsecret=".$appSecret;$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'access_token')){$access_token=$fenk[$i+2];break;}//getAccessToken
		$fp=fopen("access_token.txt", "w");fwrite($fp,$access_token);fclose($fp);
		$fb=fopen("access_token_time.txt", "w");fwrite($fb,time()+7000);fclose($fb);
	}else
		$access_token=file_get_contents("access_token.txt");
	$url="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token."&code=".$_GET['code']."&agentid=1000004";
	$UserId='JiangLiHua';
	$str=https_request($url);$fenk=explode('"',$str);for($i=1;$i<count($fenk);$i++)if(strstr($fenk[$i],'UserId')){$UserId=$fenk[$i+2];break;}
	if($UserId=='') {echo '非本企业用户非法登录!';exit;}
	require('./inc/xc_c.php');
	$query="select empid from sys_user where yn=1 and weixh='".$UserId."'";//一个促销员管理一家店,取得管理门店
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['eid']=$line[0];
	}
	else
	{echo '您尚未开通此功能或帐号设置错误,请与管理员联系!';exit;}
	sqlsrv_free_stmt($result);
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<head lang="en">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>采购计划表  </title>
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
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">已下单<?php echo $yi_xiad;?></div></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">啊下单<?php echo $yi_xiad;?></div></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="I_Xiad.php?has=1"><div class="weui-cell__bd">个下单<?php echo $yi_xiad;?></div></a>|
	</li>
	</div>

  	<div class="weui-search-bar" id="searchBar">
		<div style="text-align:center;width:7%;"><p>序</p></div>
		<div class="weui-cell__bd" style="text-align:center;width:43%;"><p>产品名称</p></div>
		<div style="text-align:center;width:10%;"><p>单位</p></div>
		<div style="text-align:center;width:20%;"><p>订货量</p></div>
		<div style="text-align:center;width:20%;"><p>采购量</p></div>
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
					<td align=center style="height:30px;width:10%;"><div><p>斤</p></div></td>
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
  // 定义首个查询下键
  var active = 0;
  $('.weui-icon-search').click(function(){
    search();
  })
  function search(){
    // 获取搜索框的值
    var kwds = $("#searchInput").val();
    // 获取第一个列表内容
    var this_one = {};
    var real_name = '';
    // 定义两个数据列表
    var list = $("#all_list .list_one");
    // 定义查找的起始值
    var true_one = 0;

    for (var i = 0; i < list.length; i++) {
      this_one = $(list[i]);
      real_name = this_one.data('real_name').toString();
      // 执行like匹配
      if(real_name.match(kwds)){
        // 处理第一个结果
        if(true_one == active){
          // 获取窗口的宽和高
          // var windows_wdh = $(window).width();
          var windows_hgt = $(window).height();
          // 获取第一个坐标
          // var x_len = this_one.offset().left;
          var y_len = this_one.offset().top;
          // 驱动滚动条滚动到指定的位置
          $("html,body").animate({scrollTop:(y_len-windows_hgt/2)},500);
          // 标记当前选中的结果
          this_one.addClass('active');
          this_one.removeClass('sign');
        }else{
          // 标记符合的结果
          this_one.addClass('sign');
          this_one.removeClass('active');
        }
        // 累加真实的选择
        true_one++;
      }else{
        this_one.removeClass('sign');
        this_one.removeClass('active');
      }
    }
    // 判断是否搜索完毕 如果搜索完毕 则从第一个开始 否则继续搜索下一个
    active = active >= true_one-1 ? 0 : active+1;

    return false;
  }
</script>
</body>
</html>
