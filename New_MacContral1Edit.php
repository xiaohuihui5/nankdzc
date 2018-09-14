<?php
require('./inc/xhead.php');
if (isset($_POST['beiz']))
{
	$query="update sys_mac set state=".$_POST['state'].",bz='".$_POST['beiz']."' where id=".$_POST['eid'];
	include('./inc/xexec.php');
	if($res)
	{
		$_SESSION['layer']="aa"; //当数据写进数据库成功的时候  在session里放一个aa 
		echo "<script language=javascript>parent.layer.closeAll();</script>";	
	}
}
$query='select a.mac,case len(a.bz) when 0 then null else a.bz end,state from sys_mac a where a.id='.$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$mac=$line[0];
	$bz=$line[1];
	$state=$line[2];
}       
sqlsrv_free_stmt($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>登录控制--修改控制</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">

<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body >
	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电脑验证码:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
				<input type="text" name="name" readonly class="input-text"  placeholder="" id="mac" value="<?php echo $mac;?>" onkeydown="if(event.keyCode==13) window.forml.beiz.select();">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否允许登录系统</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="sex-1"  name="state" value="0" <?php echo $state==0?"checked":"";?>>
					<label for="sex-1">不允许 </label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="state" value="1"  <?php echo $state==1?"checked":"";?>>
					<label for="sex-2">允许</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">电脑及使用人说明</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13) sub();"><?php echo $bz;?></textarea>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;确定修改&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
			</div>
		</div>


	</form>
</center>
</div>
</form>
</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script lanuage="javascript">
$("input[type=text],input[type=password],.select-box,textarea").css("width","80%");
function sub()
{
		window.forml.submit();	
}
window.forml.beiz.focus();
function exit()
{
	parent.layer.closeAll();
}
</script>


