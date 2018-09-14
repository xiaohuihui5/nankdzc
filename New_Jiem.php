<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
$filename = '../new_tz.php';
if (file_exists($filename)) 
{
	Header("HTTP/1.1 303 See Other"); 
	Header("Location:../new_tz.php"); 
	exit;
}
else 
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<script language="javascript">		
            function OpenWnd(iflag)
            {
		alert('制作中,请稍后访问!');
            }			
</script>
</head>
<body  oncontextmenu=self.event.returnValue=false onselectstart="return false" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" scroll="no"  bgcolor="#FFFFFF">
<table width="461" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span style='padding-left:1px'>
<SCRIPT>
var widths=461;
var heights=262;
var counts=3;
img1=new Image();
img1.src='./im/8.jpg';
img2=new Image();
img2.src='./im/3.jpg';
img3=new Image();
img3.src='./im/login_main1.jpg';
url1=new Image();
url1.src='http://www.chinause.cn';
url2=new Image ();
url2.src='http://www.chinause.cn';
url3=new Image ();
url3.src='http://www.chinause.cn';
var nn=1;
var key=0;
function change_img(){
if(key==0){key=1;}
else if(document.all)
{
document.getElementById("pic").filters[0].Apply();
document.getElementById("pic").filters[0].Play(duration=2);
}
eval('document.getElementById("pic").src=img'+nn+'.src');
eval('document.getElementById("url").href=url'+nn+'.src');
//for (var i=1;i<=counts;i++){document.getElementById("xxjdjj"+i).className='axx';}
//	document.getElementById("xxjdjj"+nn).className='bxx';
nn++;
if(nn>counts){nn=1;}
var tt=setTimeout('change_img()',4000);
}
function changeimg(n){
nn=n;
window.clearInterval(tt);
change_img();
}
document.write('<style>');
document.write('.axx{padding:1px 7px;border-left:#cccccc 1px solid;}');
document.write('a.axx:link,a.axx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#666;}');
document.write('a.axx:active,a.axx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#999;}');
document.write('.bxx{padding:1px 7px;border-left:#cccccc 1px solid;}');
document.write('a.bxx:link,a.bxx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}');
document.write('a.bxx:active,a.bxx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}');
document.write('</style>');document.write('<div style="width:'+widths+'px;height:'+heights+'px;overflow:hidden;text-overflow:clip;">');
document.write('<div><a id="url" target="_blank"><img id="pic" style="border:0px;filter:progid:dximagetransform.microsoft.wipe(gradientsize=1.0,wipestyle=4, motion=forward)" width='+widths+' height='+heights+' /></a></div>');
//document.write('<div style="filter:alpha(style=1,opacity=10,finishOpacity=80);background: #888888;width:100%-2px;text-align:right;top:-12px;position:relative;margin:1px;height:12px;padding:0px;margin:0px;border:0px;">');
//for(var i=1;i<counts+1;i++){
//document.write('<a href="javascript:changeimg('+i+');" id="xxjdjj'+i+'" class="axx" target="_self">'+i+'</a>');
//}
document.write('</div></div>');
change_img();
</SCRIPT>
</span></td>
  </tr>
</table>
<map name="FPMap0Map">
  <area shape="rect" coords="146,3,195,25" href="javascript:OpenWnd(4)">
  <area shape="rect" coords="229,2,281,26" href="javascript:OpenWnd(2)">
  <area shape="rect" coords="300,2,360,25" href="javascript:OpenWnd(1)"> 
  <area shape="rect" coords="378,4,448,22" href="javascript:OpenWnd(3)">
</map>
</body>
</html>
<?php 
}
?>
