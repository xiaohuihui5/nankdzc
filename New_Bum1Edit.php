<?php
require('./inc/xhead.php');
if (isset($_POST['bummc']))
{
	$query="update sys_bum set bummc='".$_POST['bummc']."',yn=".$_POST['yn']." where id=".$_POST['eid'];
	include('./inc/xexec.php');
	if($res)
	{
		$_SESSION['layer']="aa"; //当数据写进数据库成功的时候  在session里放一个aa 
		echo "<script language=javascript>parent.layer.closeAll();</script>";
	}
}
$query='select case len(bummc) when 0 then null else bummc end,yn from sys_bum where id='.$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$bummc=$line[0];
	$yn=$line[1];
}       
sqlsrv_free_stmt($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>部门管理--修改部门</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">

<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body >
	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>部门名称:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
				<input type="text" name="bummc" class="input-text"  placeholder="" id="bummc" value="<?php echo $bummc;?>" onkeydown="if(event.keyCode==13)event.keyCode=9">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>禁用</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="sex-1"  name="yn" value="0" <?php echo $yn==0?"checked":"";?>>
					<label for="sex-1">停用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="yn" value="1"  <?php echo $yn==1?"checked":"";?>>
					<label for="sex-2">已启用</label>
				</div>
			
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
	if(window.forml.bummc.value=="")
		layer.msg('部门名称不能为空!',{shade:false});
	else
		window.forml.submit();	
}
window.forml.bummc.focus();

function exit()
{
	parent.layer.closeAll();
}
</script>


