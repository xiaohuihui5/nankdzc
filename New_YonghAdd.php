<?php
require('./inc/xhead.php');
if (isset($_POST['name']))
{
    if($_POST['qyid']=="")
		{$qyid="null";$qymc="'---全部---'";}
	else
		{$qyid="'".$_POST['qyid']."'";$qymc="'".$_POST['qymc']."'";}
    /*$query="insert into sys_user(usercode,userid,passwd,name,sex,qyid,qymc,bumid,zhiw,loginnums,phone,beiz,yn)
	values('".$_POST['usercode']."','".$_POST['userid']."','".md5($_POST['passwd'])."','".$_POST['name']."',".$_POST['sex'].",".$qyid.",".$qymc.",".$_POST['bumid'].",'".$_POST['zhiw']."',0,'".$_POST['phone']."','".$_POST['beiz']."',1)";*/
    $query="insert into sys_user(userid,passwd,name,sex,qyid,qymc,bumid,zhiw,loginnums,phone,beiz,yn) 
	values('".$_POST['userid']."','".md5($_POST['passwd'])."','".$_POST['name']."',".$_POST['sex'].",".$qyid.",".$qymc.",".$_POST['bumid'].",'".$_POST['zhiw']."',0,'".$_POST['phone']."','".$_POST['beiz']."',1)";
	//echo $query;die;
    include('./inc/xexec.php');
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('操作成功！',{shade:false});parent.layer.closeAll();</script>";//提示成功退出
	}
}
//解决名称、编号重复
/*$nowname=",";
$query="select usercode from sys_user where yn=1";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
    $nowname=$nowname.$line[0].",";
}
sqlsrv_free_stmt($result);*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>用户管理--增加用户</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
    <!--<tr>
        <td align=right width="20%" height="40"><span class="c-red">*</span>工号：</td>
        <td><input type="text" class="input-text"  placeholder="" id="usercode" name="usercode" onkeydown="if(event.keyCode==13) window.Frm.name.focus();" style="width:80%;height:30px;"></td>
    </tr>-->
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>人员姓名：</td>
	<td><input type="text" class="input-text"  placeholder="" id="name" name="name" onkeydown="if(event.keyCode==13) window.Frm.userid.focus();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>性别：</td>
	<td><input  type="radio" id="sex"  name="sex" value="0" checked>
		<label for="sex-1">男</label>
		<input type="radio" id="sex" name="sex" value="1">
		<label for="sex-2">女</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>登录帐号：</td>
	<td><input type="text" class="input-text" value="" placeholder="" id="userid"  name="userid" onkeydown="if(event.keyCode==13) window.Frm.passwd.focus();"  onkeyup="window.Frm.passwd.value=window.Frm.userid.value" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>初始密码：</td>
	<td><input type="text" class="input-text"  id="passwd" name="passwd"  value="" onkeydown="if(event.keyCode==13) window.Frm.qyid.focus();" style="width:80%;height:30px;"></td>
</tr>
    <tr><input id="qyid" name="qyid" type="hidden"><td align=right height="40"><span class="c-red">*</span><a href="javascript:;" onclick="Sel()"><font color=blue>管辖企业：</font></a></td><td><input value="---全部---" readonly onclick="Sel()" id="qymc" name="qymc" style="width: 80%;height: 30px;color: blue;text-align: center;"></td></tr>
    <tr><td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=#696969>如用户管辖所有企业,无需选择!</td></tr>
    <tr>
        <td align=right width="20%" height="40"><span class="c-red">*</span>所在部门：</td>
        <td>
            <select class="select" id="bumid" name="bumid" onkeydown="if(event.keyCode==13) window.Frm.zhiw.focus();" style="width:80%;height:30px;">
                <?php
                $query='select id,bummc from sys_bum where yn=1 order by bummc';
                $result=sqlsrv_query($conn,$query);
                while($line=sqlsrv_fetch_array($result))
                {
                    echo '<option value=',$line[0],'>',$line[1],'</option>';
                }
                sqlsrv_free_stmt($result);
                ?>
            </select>
        </td>
    </tr>
    <tr>
	<td align=right width="20%" height="40">&nbsp;岗位职务 </td>
	<td><input type="text" class="input-text"  id="zhiw"  name="zhiw" type="text"  onkeydown="if(event.keyCode==13) window.Frm.phone.focus();" style="width:80%;height:30px;"></td>
</tr>

<tr>
	<td align=right width="20%" height="40">&nbsp;联系电话：</td>
	<td><input class="input-text" value="" placeholder="" id="phone"  name="phone" type="text" onkeydown="if(event.keyCode==13)window.Frm.beiz.focus();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="100">备注：</td>
	<td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:80px;"></textarea></td>
</tr>
<tr>
<td align=center colspan="2" height="40">
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>
</body>
</html>
<script lanuage="javascript">
function sub() {
    /*var nowname = "";
    if (window.Frm.usercode.value == "") {
        layer.msg('用户工号不能为空!', {shade: false});
    }
    else if (nowname.indexOf(',' + window.Frm.usercode.value + ',') != -1){
            layer.msg('用户工号已存在，请仔细检查后录入!', {shade: false});}*/
    if (window.Frm.name.value == ""){
            layer.msg('用户姓名不能为空!', {shade: false});}
        else if (window.Frm.bumid.value == ""){
            layer.msg('用户所在部门不能为空!', {shade: false});}
        else if (window.Frm.userid.value == ""){
            layer.msg('用户帐号不能为空!', {shade: false});}
        else {
            window.Frm.submit();
        }
}
function Sel()
{
    layer_show2("管辖企业选取","Select_qiye_M.php","500","500"); //最后一个参数是给一个标识符
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.name.focus();
</script>
