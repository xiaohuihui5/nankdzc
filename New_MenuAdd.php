<?php 
require('./inc/xhead.php');
if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
	$query = "select menuid,title from sys_menu where layer = ".$_POST['layer']."-1 order by menuid";
	$result = sqlsrv_query($conn,$query);
	$res = 0;
	while($line=sqlsrv_fetch_array($result)){
		$data[$res]['menuid'] = iconv("GB2312", "UTF-8", $line['menuid']);
		$data[$res]['title'] = iconv("GB2312", "UTF-8", $line['title']);
		$res++;
	}
	echo json_encode($data);
	exit;
}
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
	$query="insert into sys_menu(title,url,layer,topmenuid,description,chax,lur,shenh,display,top_id) 
	values('".$_POST['title']."',".$IURL.",".$_POST['layer'].",".$_POST['topmenuid'].",'".$_POST['description']."',".$ICHAX.",".$ILUR.",".$ISHENH.",".$_POST['display'].",".$_POST['top_id'].")";
	include('./inc/xexec.php');
	echo '<script language=javascript>window.opener.hqlist.Frm.submit();window.close();</script>';
}
?>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��Ӳ˵�</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>�˵�����:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  placeholder="" id="username" name="title" onkeydown="if(event.keyCode==13)event.keyCode=9">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>�Ƿ�ͣ�ã�</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="sex-1"  name="display" value="1" checked>
					<label for="sex-1">��</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="display" value="0">
					<label for="sex-2">��</label>
				</div>
			
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>���ӵ�ַ:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="mobile"  name="url" onkeydown="if(event.keyCode==13)event.keyCode=9"  onkeyup="window.forml.passwd.value=window.forml.userid.value" >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>�˵��ȼ�:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select class="select" size="1" name="layer" onclick="top_menu(this.value)">
						<option value="0">һ���˵�</option>
						<option value="1">�����˵�</option>
						<option value="2">�����˵�</option>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>�ϼ��˵�:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select class="select" size="1" name="top_id" id="top_id">
				<?php 
				$query="select menuid,title from sys_menu where display=1 and [level]=1 order by topmenuid";
				$result=sqlsrv_query($conn,$query);
				while($line=sqlsrv_fetch_array($result))
				{
					echo '<option value="',$line[0],'">',$line[1],'</option>';
				}       
				sqlsrv_free_stmt($result);
				;?>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">�����:</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="text" class="input-text"  id="email"  name="topmenuid" type="text"  onkeydown="if(event.keyCode==13)event.keyCode=9" >
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">��ͨȨ��:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="checkbox-box">
					<input name="chax" class="radio-box" type=checkbox checked>
					<label for="sex-1">��</label>
				</div>
				<div class="checkbox-box">
					<input name="lur"  class="radio-box" type=checkbox>
					<label for="sex-2">¼</label>
				</div>
				<div class="checkbox-box">
					<input name="shenh"  class="radio-box" type=checkbox>
					<label for="sex-2">��</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
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
		alert('�˵����Ʋ���Ϊ��!');
	else if(window.forml.topmenuid.value=="")
		alert('����Ų��ܲ���Ϊ��!');
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
			$('#top_id').empty();   //���resText�������������
			var html = ''; 
			$.each(data, function(commentIndex, comment){
				html += '<option value='+comment['menuid']+'>' + comment['title'] + '<option>'
			});
			$('#top_id').html(html);
		}
	})
}
</script>