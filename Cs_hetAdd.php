<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['qyid']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
    //echo $htmlData;
    $query="insert into sys_het(yn,mingc,typea,unit,gys,zuj,usercode,qdy,qdrq,lianxr,lianxdh,qsrq,jsrq,bz) 
values(1,'".$_POST['mingc']."',".$_POST['typea'].",'".$_POST['qyid']."','".$_POST['gys']."','".$_POST['zuj']."','".$_POST['usercode']."','".$_POST['qdy']."','".$_POST['dt3']."','".$_POST['lianxr']."','".$_POST['lianxdh']."','".$_POST['dt1']."','".$_POST['dt2']."','".$htmlData."')";
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
    <STYLE type=text/css>
        .seldiv {text-align:left;line-height:25px;background-color:#C0E4D0;border:1px solid #C2C2C2}
        .seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
    </STYLE>
    <title>��ͬ���Ϲ���-������ͬ</title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script language="javascript" src="xSelkhMohu.js"></script>
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
            <td align="center" width="20%" height="40">��ͬ��ţ�</td><td><input type="text" class="input-text"  placeholder="" id="usercode" name="usercode" onkeydown="if(event.keyCode==13) {window.forml.shortname.select();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">��ͬ����:</td>
            <td>
                <select style="width:80%;height: 30px;" id="typea" name="typea">
                    <option value="">---ѡ�����---</option>
                    <?php
                    $query="select id,fenlmc from sys_hetfenl where yn=1 order by bianh,fenlmc";
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
            <td align="center" width="20%" height="40">��ͬ���ƣ�</td><td><input type="text" class="input-text"  placeholder="" id="mingc" name="mingc" onkeydown="if(event.keyCode==13) {window.forml.gys.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
       <!-- <tr>
            <td align=center height="40">��ҵ����:</td>
            <td><input type="hidden" value="" id="qyid" name="qyid"><input type="hidden" id="oldvalue" name="oldvalue"><input value="--������ҵ��Ż�����ģ������--" type="text" tabindex="1"  onkeyup="AutoFinish()"   title="������ؼ���"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13){startRequest(this.value,0);CloseTipDiv();return false;}" style="width: 80%;height: 30px;"  id="spdm" name="spdm"><font color=red>*</font></td>
        </tr>-->
        <tr>
            <td align="center" height="40">������ҵ</td>
            <td>
                <select style="width:80%;height: 30px;" id="qyid" name="qyid">
                    <option value="">--ѡ����ҵ--</option>
                    <?php
                    $query="select qyid from sys_user where empid=".$_SESSION['empid'];
                    $result=sqlsrv_query($conn,$query);
                    $line=sqlsrv_fetch_array($result);
                    $aa=$line[0];
                    //sqlsrv_free_stmt($result);
                    //$query="declare @qyid nvarchar(1000) select @qyid=qyid from sys_user where empid=".$_SESSION['empid']. "exec('select id,shortname from sys_qiye where id in('+@qyid+')')";
                    //echo $query;
                    if($aa!==NULL){
                        $query=" select id,shortname from sys_qiye where id in(".$aa.")";
                        //echo $query;
                        $result=sqlsrv_query($conn,$query);
                        /* echo '<pre>';
                         print_r($line=sqlsrv_fetch_array($result));*/
                        while($line=sqlsrv_fetch_array($result))
                        {
                            echo "<option value=".$line[0].">".$line[1]."</option>";
                        }
                        sqlsrv_free_stmt($result);}
                    else{
                        $query="select id,shortname from sys_qiye";
                        $result=sqlsrv_query($conn,$query);
                        while($line=sqlsrv_fetch_array($result))
                        {
                            echo "<option value=".$line[0].">".$line[1]."</option>";
                        }
                        sqlsrv_free_stmt($result);
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">������λ��</td>
            <td><input type="text" class="input-text"  placeholder="" id="gys" name="gys" onkeydown="if(event.keyCode==13) {window.forml.zuj.focus();}" style="width:30%;height:30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͬ��&nbsp;&nbsp;&nbsp;<input type="text" class="input-text"  placeholder="" id="zuj" name="zuj" onkeydown="if(event.keyCode==13) {window.forml.lianxr.focus();}" style="width:100px;height:30px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">�Է���ϵ��: </td>
            <td><input name="lianxr" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.lianxdh.focus();return false;}" style="width:30%;height:30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ϵ�绰: <input name="lianxdh" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.qdy.focus();return false;}" style="width:30%;height:30px;"></td></tr>
        <!--<tr>
            <td align=center height="40">ǩ����:</td>
            <td><input name="qdy" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.dt3.focus();return false;}" style="width:30%; height: 30px;"><span class="c-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ǩ������: <input name="dt3" type="text" id="dt3"  onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()"  class="input-text Wdate" value="<?php /*echo date('Y-m-d');*/?>"  onkeydown="if(event.keyCode==13){return false;}" onclick="calendar(this)" style="width:30%;height: 30px;text-align: center;"><span class="c-red">*</span></td>
        </tr>-->
        <tr>
            <td align="center" height="40">��ʼ����:</td>
            <td><input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="dt1" id="dt1" class="input-text Wdate" style="width:110px;height: 30px;" value="<?php echo date('Y-m-d');?>"/><span class="c-red">*</span>
                &nbsp;��������:<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="dt2" id="dt2" class="input-text Wdate" style="width:110px;height: 30px;" value="<?php echo date('Y-m-d');?>"/><span class="c-red">*</span>
                &nbsp;ǩ������: <input name="dt3" type="text" id="dt3"  onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()"  class="input-text Wdate" value="<?php echo date('Y-m-d');?>"  onkeydown="if(event.keyCode==13){return false;}" onclick="calendar(this)" style="width:110px;height: 30px;"><span class="c-red">*</span></td>
        </tr>
        <!--<tr>
            <td >��������:</td>
            <td><input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="dt2" id="dt2" class="input-text Wdate" style="width:100px;" value="<?php /*echo date('Y-m-d');*/?>"/><span class="c-red">*</span></td>
        </tr>-->
        <tr>
            <td align="center" width="20%">��ע�����</td>
            <td colspan=4></td>
        <tr>
            <td align="center" colspan=3><textarea id="content1" name="content1" style="width:80%;height:260px;visibility:hidden;"></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="70">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" ">
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    function sub()
    {
        if(window.forml.usercode.value=="")
        {layer.msg('��ͬ��Ų���Ϊ��!');return false;}
        else if(window.forml.qyid.value=="")
        {layer.msg('��ҵ���Ʋ���Ϊ��!');return false;}
        else if(window.forml.typea.value=="")
        {layer.msg('��ͬ���Ͳ���Ϊ��!');return false;}
        return true;
    }
    function startRequest(spbh,id)//�������Ʒid����ֱ�ӵõ�������ģ������
    {
        createXMLHttpRequest();
        xmlHttp.open("post","Cs_hetAjax.php",true);//�ύ���ؽ����phpҳ��
        xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-Type","text/xml");
        xmlHttp.setRequestHeader("Content-Type","gb2312");
        xmlHttp.onreadystatechange = function ()
        {
            if (xmlHttp.readyState == 4)
            {
                if (xmlHttp.status == 200)
                {
                    var arrTmp= xmlHttp.responseText.split("@");
                    window.forml.qyid.value=arrTmp[0];
                    window.forml.spdm.value=arrTmp[1];
                    window.forml.lianxr.value=arrTmp[2];
                    window.forml.lianxdh.value=arrTmp[3];
                    window.forml.qdy.value=arrTmp[2];
                }
            }
        }
        xmlHttp.send("spbh="+spbh+"&id="+id);//���ݸ�phpҳ��Ĳ���
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.forml.usercode.focus();
</script>
