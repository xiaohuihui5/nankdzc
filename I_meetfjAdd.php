<?php
require('./inc/xhead.php');
if (isset($_POST['fanjh']))
{
    $query="insert into sys_fangj(zt,fangjh,name,beiz) values(1,'".$_POST['fanjh']."','".$_POST['name']."','".$_POST['beiz']."')";
    $query=str_replace(",,",",null,",$query);
    $query=str_replace(",,",",null,",$query);
    include('./inc/xexec.php');
    if($res)
    {
        echo "<script language=javascript>window.parent.forml.submit();parent.layer.msg('�����ɹ���',{shade:false});parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>�����ҹ���--����������</title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
<BODY >
<form name="forml" method="POST" action="">
    <table>
                <tr>
                    <td align=right width="20%" height="60"> ����ţ� </td>
                    <td ><input name="fanjh" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.name.focus();return false;}" style="width:50%;height: 40px;"><font color=red>*</td>
                </tr>
                <tr>
                    <td align=right width="20%" height="60"> ���������ƣ� </td>
                    <td><input name="name" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.beiz.focus();return false;}" style="width:80%;height: 40px;"><font color=red>*</td>
                </tr>
        <tr>
            <td align=right width="20%" height="80"> ������������</td>
            <td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:200px;"></textarea></td>
        </tr>

        <tr>
            <td align=center colspan="2" height="80">
                <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    function sub() {
        if (window.forml.fanjh.value == "") {
            layer.msg('����Ų���Ϊ��!', {shade: false});
        }
       else if (window.forml.name.value == ""){
            layer.msg('���������Ʋ���Ϊ��!', {shade: false});}
        else {
            window.forml.submit();
        }
    }
    function exit()
    {
        parent.layer.closeAll();
    }
</script>
