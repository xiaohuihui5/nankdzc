<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
if(isset($_POST['uid']))
{
	session_start();
	include("inc/xc_c.php");
	$query="select empid,name from sys_user where userid='".$_POST['uid']."' and passwd='".md5($_REQUEST['pwd'])."'";
//echo $query;
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		$_SESSION['empid']=$line[0];//存放用户id
		$_SESSION['uname']=$line[1];//存放用户名
		$_SESSION['DT1']=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));//前一天
		$_SESSION['DT2']=date('Y-m-d');//今天
		header("location:S_AllIndex.php");
		exit;
	}
	else
		echo '<script language=javascript>alert("用户名或密码输入错误，请重新输入！")</script>';
}
?>
<html lang="en">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>信息管理系统</title>
        <link rel="stylesheet" href="fonts/iconfont.css"/>
        <link rel="stylesheet" href="css/font.css"/>
        <link rel="stylesheet" href="css/mui.css"/>
        <link rel="stylesheet" href="css/weui.min.css"/>
        <link rel="stylesheet" href="css/jquery-weui.min.css"/>
        <link rel="stylesheet" href="css/animate.css"/>
        <link rel="stylesheet" href="css/pages/login.css"/>
        <script>(function (doc, win) {
          var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
              var clientWidth = docEl.clientWidth;
              if (!clientWidth) return;
              docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
            };

          if (!doc.addEventListener) return;
          win.addEventListener(resizeEvt, recalc, false);
          doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);

        function goto(url){

            window.location.href=url;

        }

        </script>
    </head>
    <body>
		<form  method="post" name="form">

        <div class="header">
            <h2><img src="images/logo.png" width="60" height="60" align="middle">ERP业务管理系统</h2>
        </div>
        <div class="login-wrap">
            <div class="login-box">
                    <div class="input-wrap">
                        <input type="text" name="uid" placeholder="账号/手机号码" onkeydown="if(event.keyCode==13)window.form.pwd.focus();">
                    </div>
                    <div class="input-wrap">
                        <input type="password" name="pwd" placeholder="密码" onkeydown="if(event.keyCode==13)showSend()">
                    </div>
            </div>

            <div class="btns">
                <a href="javascript:;" class="current">采购商</a>
                <a href="javascript:;">供应商</a>
            </div>

            <a href="javascript:showSend();" class="weui_btn login-btn weui_btn_primary">登录</a>
                    
        </div>
        <div class="footer">
            技术支持:中用软件
        </div>
                </form>

    </body>
</html>
<script lanuage ="javascript">
window.form.uid.value=getCookie('chinause');
window.moveTo(0,0);
window.resizeTo(window.screen.availWidth,window.screen.availHeight);
if(window.form.uid.value=='')
	window.form.uid.focus();
else
	window.form.pwd.focus();
function getCookie(name)
{
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	window.form.pwd.focus();
	if(arr != null) return unescape(arr[2]);
	window.form.uid.focus();
	return '';
}
function showSend()
{
	if(window.form.uid.value=="")
		alert('登录帐号不能为空,请您重新录入!');
	else if(window.form.pwd.value=="")
		alert('密码不能为空,请您重新录入!');
	else
	{
		form.submit();
	}
}
</script>
