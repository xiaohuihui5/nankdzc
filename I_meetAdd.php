<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['bianh']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
    //echo $htmlData;
    $query="insert into sys_meet(yn,bianh,fqr,lx,yiti,fangj,ksrq,jsrq,ydrq,rens,reny,bz) 
values(0,'".$_POST['bianh']."','".$_SESSION['empid']."',".$_POST['lx'].",'".$_POST['yiti']."','".$_POST['fangj']."','".$_POST['dt1']."','".$_POST['dt2']."','".$_POST['dt3']."','".$_POST['rens']."','".$_POST['reny']."','".$htmlData."')";
    //echo $query;die;
    include('./inc/xexec.php');
    if($res)
    {
        echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('�����ɹ���',{shade:false});parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>����Ԥ��-��������</title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script language="javascript" src="xSelmeet.js"></script>
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
    <link rel="stylesheet" href="./kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="./kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="./kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="./kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="./kindeditor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="content1"]', {
                cssPath : './kindeditor/plugins/code/prettify.css',
                uploadJson : './kindeditor/php/upload_json.php',
                fileManagerJson : './kindeditor/php/file_manager_json.php',
                allowFileManager : true
            });
        });
    </script>
</head>
<BODY >
<form name="forml" method="POST" action="" onsubmit="return sub()">
    <table>
        <tr>
            <td align="center" width="20%" height="40">�����ţ�</td><td><input type="text" class="input-text"  placeholder="" id="bianh" name="bianh" onkeydown="if(event.keyCode==13) {window.forml.yiti.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">��������:</td>
            <td>
                <select style="width:80%;height: 30px;" id="lx" name="lx">
                    <option value="">---ѡ�����---</option>
                    <?php
                    $query="select id,fenlmc from sys_meetlx where yn=1 order by bianh,fenlmc";
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
                        echo "<option value=".$line[0].">".$line[1]."</option>";
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select><font color=red>*</td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">�������⣺</td><td><input type="text" class="input-text"  placeholder="" id="yiti" name="yiti" onkeydown="if(event.keyCode==13) {window.forml.fqr.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">������:</td>
            <td>
                <select style="width:50%;height: 30px;" id="fangj" name="fangj" >
                    <option value="">---ѡ�������---</option>
                    <?php
                    $query="select id,fangjh+'--'+name from sys_fangj where zt=1 order by fangjh";
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
                        echo "<option value=".$line[0].">".$line[1]."</option>";
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select><font color=red>*</td>
        </tr>
        <tr>
            <td align="center" height="40">ԤԼʱ��:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt3" id="dt3" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" height="40">��ʼʱ��:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt1" id="dt1" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" height="40">����ʱ��:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt2" id="dt2" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">�λ�������</td><td><input type="text" class="input-text"  placeholder="" id="rens" name="rens" onkeydown="if(event.keyCode==13) {window.forml.reny.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center width="20%" height="100">�λ���Ա��</td>
            ������Ա:<td><textarea name="reny" cols="" rows="" class="textarea"  style="width:80%;height:80px;"></textarea></td>
        </tr>
        <tr>
            <td align="center" width="20%" style="color: red;height: 50px;">�����Ҫ��</td>
            <td colspan=4></td>
        <tr>
            <td align="center" colspan=3><textarea id="content1" name="content1" style="width:80%;height:260px;visibility:hidden;"></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="80">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" ">
                &nbsp;&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    function sub()
    {
        if(window.forml.bianh.value=="")
        {layer.msg('�����Ų���Ϊ��!');return false;}
        else if(window.forml.lx.value=="")
        {layer.msg('�������Ͳ���Ϊ��!');return false;}
        else if(window.forml.yiti.value=="")
        {layer.msg('�������ⲻ��Ϊ��!');return false;}
        else if(window.forml.fangj.value=="")
        {layer.msg('�����Ҳ���Ϊ��!');return false;}
        else if(window.forml.fqr.value=="")
        {layer.msg('����ԤԼ�˲���Ϊ��!');return false;}
        return true;
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.forml.bianh.focus();
</script>
