<?php 
require('./inc/xhead.php');
if (isset($_POST['title']))
{
	if($_POST['url']=='')
		$IURL='null';
	else
		$IURL="'".$_POST['url']."'";
	if($_POST['chax'])
		$ICHAX=1;
	else
		$ICHAX='null';
	if($_POST['lur'])
		$ILUR=1;
	else
		$ILUR='null';
	if($_POST['shenh'])
		$ISHENH=1;
	else
		$ISHENH='null';
	$query="update sys_menu set title='".$_POST['title']."',url=".$IURL.",layer=".$_POST['layer'].",topmenuid=".$_POST['topmenuid'].",description='".$_POST['description']."',chax=".$ICHAX.",lur=".$ILUR.",shenh=".$ISHENH.",display=".$_POST['display']." where menuid=".$_POST['eid'];
	include('./inc/xexec.php');
	echo "<script language=javascript>parent.layer.closeAll();</script>";
}
$query="select title,case len(url) when 0 then null else url end,layer,topmenuid,case len(description) when 0 then null else description end,chax,lur,shenh,display,top_id from sys_menu where menuid=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$title=$line[0];
	$url=$line[1];
	$layer=$line[2];
	$topmenuid=$line[3];
	$description=$line[4];
	$chax=$line[5];
	$lur=$line[6];
	$shenh=$line[7];
	$display=$line[8];
	$top_id =$line[9];
}
/*上级菜单*/
$query = "select top 1 menuid,title,layer from sys_menu where menuid=".$top_id;
$result = sqlsrv_query($conn,$query);
$top_menu = sqlsrv_fetch_array($result);
$top_menu_name = $top_menu['title'];
$top_menu_layer = $top_menu['layer'];
$top_menu_menuid = $top_menu['menuid'];
$query = "select menuid,title from sys_menu where layer = ".$top_menu_layer;
$result = sqlsrv_query($conn,$query);
$res = 0;
while($line=sqlsrv_fetch_array($result)){
	$menu_list[$res]['menuid'] = $line['menuid'];
	$menu_list[$res]['title'] = $line['title'];
	$res++;
}
sqlsrv_free_stmt($result);
?>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>修改菜单</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>菜单名称:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
				<input type="text" class="input-text"  placeholder="" value="<?php echo $title;?>" id="username" name="title" onkeydown="if(event.keyCode==13)event.keyCode=9">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否停用：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="sex-1"  name="display" value="0" <?php echo $display==0?"checked":"";?>>
					<label for="sex-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="display" value="1" <?php echo $display==0?"":"checked";?>>
					<label for="sex-2">否</label>
				</div>
			
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>链接地址:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" id="mobile" value="<?php echo $url;?>" name="url" onkeydown="if(event.keyCode==13)event.keyCode=9"  onkeyup="window.forml.passwd.value=window.forml.userid.value" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>菜单等级:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select class="select" size="1" name="layer" onclick="top_menu(this.value)">
						<option value="0" <?php echo $layer==0?"selected":"";?>>一级菜单</option>
						<option value="1" <?php echo $layer==1?"selected":"";?>>二级菜单</option>
						<option value="2" <?php echo $layer==2?"selected":"";?>>三级菜单</option>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级菜单:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select class="select" size="1" name="top_id" id="top_id">
						<option value="<?php echo $top_menu_menuid;?>"><?php echo $top_menu_name;?></option>
						<?php 
							foreach($menu_list as $key=>$value){
						?>
						<option value="<?php echo $value['id'];?>"><?php echo $value['title'];?></option>
						<?php }?>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">排序号:</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="text" class="input-text" value="<?php echo $topmenuid;?>" id="email"  name="topmenuid" type="text"  onkeydown="if(event.keyCode==13)event.keyCode=9" >
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">开通权限:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="checkbox-box">
					<input name="chax" class="radio-box" type=checkbox <?php echo $chax==1?"checked":"";?>>
					<label for="sex-1">查</label>
				</div>
				<div class="checkbox-box">
					<input name="lur"  class="radio-box" type=checkbox <?php echo $lur==1?"checked":"";?>>
					<label for="sex-2">录</label>
				</div>
				<div class="checkbox-box">
					<input name="shenh"  class="radio-box" type=checkbox <?php echo $shenh==1?"checked":"";?>>
					<label for="sex-2">审</label>
				</div>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
			</div>
		</div>


	</form>



</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script lanuage="javascript">

function sub()
{
	if(window.forml.title.value=="")
		alert('菜单名称不能为空!');
	else if(window.forml.topmenuid.value=="")
		alert('排序号不能不能为空!');
	else
		window.forml.submit();
}

function exit(){
	parent.layer.closeAll();
}
function top_menu(e){
	console.log(e);
	$.ajax({
		type: "POST",
		url: 'New_MenuAdd1.php',
		data: {layer:e},
		dataType: "json",
		success: function(data){
			$('#top_id').empty();   //清空resText里面的所有内容
			var html = ''; 
			$.each(data, function(commentIndex, comment){
				html += '<option value='+comment['menuid']+'>' + comment['title'] + '<option>'
			});
			$('#top_id').html(html);
		}
	})
}
</script>
