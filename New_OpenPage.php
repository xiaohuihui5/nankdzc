<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
$Url=$_GET['url'];
$Width=$_GET['width'];
$Height=$_GET['height'];
?>
<script language="javascript">
var openfrm = window.open("<?php echo $Url;?>","", "scrollbars=yes,status=yes,menubar=no,resizable=1,width=1600,height=900");
l=(window.screen.availWidth-<?php echo $Width;?>)/2;
t=(window.screen.availHeight-<?php echo $Height;?>)/2;
openfrm.window.moveTo(l,t);
openfrm.window.resizeTo(<?php echo $Width;?>,<?php echo $Height;?>);
openfrm.focus();
window.opener =null;
window.close();
</script>
