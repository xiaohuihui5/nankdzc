<?php
require('./inc/xhead.php');
if (isset($_POST['name']))
{
	if($_POST['passwd']!=$_POST['oldpasswd'])
		$PWD=md5($_POST['passwd']);
	else
		$PWD=$_POST['passwd'];
	$query="update sys_user set userid='".$_POST['userid']."',passwd='".$PWD."',name='".$_POST['name']."',sex=".$_POST['sex'].",qyid=".$_POST['qyid'].",bumid=".$_POST['bumid'].",zhiw='".$_POST['zhiw']."',phone='".$_POST['phone']."',beiz='".$_POST['beiz']."',yn=".$_POST['yn']." where empid=".$_POST['eid'];
	//echo $query;die;
	include('./inc/xexec.php');
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
	}
}
$query='select usercode,name,sex,userid,passwd,qyid,bumid,case len(zhiw) when 0 then null else zhiw end,case len(phone) when 0 then null else phone end,case len(beiz) when 0 then null else beiz end,yn from sys_user where empid='.$_GET['eid'];
//echo $query;
$result=sqlsrv_query($conn,$query);
/*echo "<pre>";
print_r($line=sqlsrv_fetch_array($result));die;*/
if($line=sqlsrv_fetch_array($result))
{
	$usercode=$line[0];
	$name=$line[1];
	$sex=$line[2];
	$userid=$line[3];
	$passwd=$line[4];
	$qyid=$line[5];
	$bumid=$line[6];
	$zhiw=$line[7];
	$phone=$line[8];
	$beiz=$line[9];
	$yn=$line[10];
}
sqlsrv_free_stmt($result);
?>
<html>
<head>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<body >
<form name="Frm" method="POST" action="">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<table>
<!--<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>���ţ�</td>
	<td><input readonly type="text" class="input-text"  id="usercode" name="usercode" value="<?php /*echo $usercode;*/?>" onkeydown="if(event.keyCode==13) window.Frm.name.select();" style="width:80%;height:30px;"></td>
</tr>-->
<tr>
    <td align=right width="20%" height="40"><span class="c-red">*</span>�û�������</td>
    <td><input type="text" class="input-text"  id="name" name="name" value="<?php echo $name;?>" onkeydown="if(event.keyCode==13) window.Frm.userid.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
    <td align=right width="20%" height="40"><span class="c-red">*</span>�Ա�</td>
    <td><input  type="radio" id="sex"  name="sex" value="0" <?php echo $sex==0?"checked":"";?>>
         <label for="sex-1">�� </label>
         <input type="radio" id="sex" name="sex" value="1"  <?php echo $sex==1?"checked":"";?>>
         <label for="sex-2">Ů</label>
    </td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��¼�ʺţ�</td>
	<td><input type="text" class="input-text" id="userid"  name="userid" value="<?php echo $userid;?>" onkeydown="if(event.keyCode==13) window.Frm.passwd.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��ʼ���ܣ�</td>
	<td><input type="password" class="input-text"  id="passwd" name="passwd"  value="<?php echo $passwd;?>" onkeydown="if(event.keyCode==13) window.Frm.qyid.focus();" style="width:80%;height:30px;"></td>
</tr>
    <tr>
        <td align=right width="20%" height="40"><span class="c-red">*</span>������ҵ��</td>
        <td>
            <select class="select" size="1" id="qyid" name="qyid" onkeydown="if(event.keyCode==13) window.Frm.bumid.focus();" style="width:80%;height:30px;">
                <?php
                $query='select id,shortname from sys_qiye where yn=1 order by shortname';
                $result=sqlsrv_query($conn,$query);
                while($line=sqlsrv_fetch_array($result))
                {
                    if($line[0]==$qyid)
                        echo '<option selected value=',$line[0],'>',$line[1],'</option>';
                    else
                        echo '<option value=',$line[0],'>',$line[1],'</option>';
                }
                sqlsrv_free_stmt($result);
                ?>
            </select>
        </td>
    </tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>���ڲ��ţ�</td>
	<td>
		<select class="select" size="1" id="bumid" name="bumid" onkeydown="if(event.keyCode==13) window.Frm.zhiw.select();" style="width:80%;height:30px;">
			<?php
			$query='select id,bummc from sys_bum where yn=1 order by bummc';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				if($line[0]==$bumid)
                    echo '<option selected value=',$line[0],'>',$line[1],'</option>';
                else
                    echo '<option value=',$line[0],'>',$line[1],'</option>';
			}
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
    <tr>
        <td align=right width="20%" height="40">&nbsp;��λְ��</td>
        <td><input type="text" class="input-text"  id="zhiw"  name="zhiw" type="text" value="<?php echo $zhiw;?>" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;height:30px;"></td>
    </tr>
<tr>
	<td align=right width="20%" height="40">&nbsp;��ϵ�绰��</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" type="text" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13)window.Frm.beiz.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�Ƿ�ͣ�ã�</td>
	<td><input type="radio" id="yn" name="yn" value="1"  <?php echo $yn==1?"checked":"";?> >
		<label for="sex-1">��</label>
		<input type="radio" id="yn" name="yn" value="0"  <?php echo $yn==0?"checked":"";?> >
		<label for="sex-2">��</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="100">��ע��</td>
	<td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:80px;"><?php echo $beiz;?></textarea></td>
</tr>

<tr>
<td align=center colspan="2" height="40">
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.Frm.name.value==""){
		layer.msg('�û���������Ϊ��!',{shade:false});}
	else if(window.Frm.bumid.value==""){
		layer.msg('�û����ڲ��Ų���Ϊ��!',{shade:false});}
	else if(window.Frm.userid.value==""){
		layer.msg('�û��ʺŲ���Ϊ��!',{shade:false});}
	else{
        window.Frm.submit();
    }
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.name.select();
</script>


