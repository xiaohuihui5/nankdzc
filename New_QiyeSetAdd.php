<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
    //echo $htmlData;
    function uploadFile( $fileInfo,$path="./upfile/excel",$maxSize=10485760
    ){
        $filename=$fileInfo["name"];
        $tmp_name=$fileInfo["tmp_name"];
        $size=$fileInfo["size"];
        $error=$fileInfo["error"];

//���������趨����

        $ext=pathinfo($filename,PATHINFO_EXTENSION);

//Ŀ����Ϣ
        if (!file_exists($path)) {
            mkdir($path,0777,true);
            chmod($path, 0777);
        }
        $uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
        $destination=$path."/".$uniName;
        if ($error==0) {
            if ($size>$maxSize) {
                exit("�ϴ��ļ�����");
            }
            if (!is_uploaded_file($tmp_name)) {
                exit("�ϴ���ʽ������ʹ��post��ʽ");
            }
            if (@move_uploaded_file($tmp_name, $destination)) {//@�������Ʒ��������û���������
            }else{
                echo "�ļ�".$filename."�ϴ�ʧ��!";
            }
        }else{
            switch ($error){
                case 1:
                    echo "�������ϴ��ļ������ֵ�����ϴ�2M�����ļ�";
                    break;
                case 2:
                    echo "�ϴ��ļ����࣬��һ���ϴ�20���������ļ���";
                    break;
                case 3:
                    echo "�ļ���δ��ȫ�ϴ������ٴγ��ԣ�";
                    break;
                case 4:
                    echo "δѡ���ϴ��ļ���";
                    break;
                case 7:
                    echo "û����ʱ�ļ���";
                    break;
            }
        }
        return $uniName;
    }
    foreach ($_FILES as $fileInfo){
        $file[]=uploadFile($fileInfo);
    }
    $query="insert into sys_qiye(yn,lx,usercode,shortname,xydm,clsj,zczb,phone,fuzy,address,dsh,cd,fr,zjl,js,zhangc,zhid,bz)
values(1,".$_POST['qylx'].",'".$_POST['usercode']."','".$_POST['shortname']."','".$_POST['xydm']."','".$_POST['clsj']."','".$_POST['zczb']."','".$_POST['phone']."','".$_POST['fuzy']."','".$_POST['address']."','".$_POST['dsh']."','".$_POST['cd']."','".$_POST['fr']."','".$_POST['zjl']."','".$_POST['js']."','".$file[0]."','".$file[1]."','".$htmlData."')";
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
    <meta name="format-detection" content="telephone=no" />
    <title>��ҵ����-������ҵ</title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
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
<BODY>
<form name="Frm" method="POST" action="" enctype="multipart/form-data" onsubmit="return sub()">
    <table style="font-size: 25px">
        <tr>
            <td align=center width="20%" height="40">��ҵ���ͣ�</td>
            <td>
                <select class="select" id="qylx" name="qylx" onkeydown="if(event.keyCode==13) window.Frm.usercode.focus();" style="width:80%;height:30px;">
                    <?php
                    $query='select id,fenlmc from sys_qiyefenl where yn=1 order by fenlmc';
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
                        echo '<option value=',$line[0],'>',$line[1],'</option>';
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select><span class="c-red">*</span>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">��ҵ��ţ�</td><td><input type="text" class="input-text"  placeholder="" id="usercode" name="usercode" onkeydown="if(event.keyCode==13) {window.Frm.shortname.focus();}" style="width:20%;height:30px;"><span class="c-red">*</span>��ҵ���ƣ�<input type="text" class="input-text"  placeholder="" id="shortname" name="shortname" onkeydown="if(event.keyCode==13) {window.Frm.xydm.focus();}" style="width:50%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="30">ͳһ������ô��룺</td><td><input type="text" class="input-text"  placeholder="" id="xydm" name="xydm" onkeydown="if(event.keyCode==13) {window.Frm.zczb.focus();}" style="width:25%;height:30px;"><span class="c-red">*</span>
                ����ʱ�䣺<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="clsj" id="clsj" class="input-text Wdate" style="width:100px;height: 30px;" value="<?php echo date('Y-m-d');?>"/>
                &nbsp;�Ͻɶ<input type="text" id="zczb" name="zczb" onkeydown="if(event.keyCode==13) {window.Frm.fuzy.focus();}" style="width: 20%;height: 30px"><font color="red">(��Ԫ)</font>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">��ϵ�ˣ�</td><td><input type="text" class="input-text"  placeholder="" id="fuzy" name="fuzy" onkeydown="if(event.keyCode==13) {window.Frm.phone.focus();}" style="width:25%;height:30px;">
                &nbsp;��ϵ�绰��<input type="text" class="input-text"  placeholder="" id="phone" name="phone" onkeydown="if(event.keyCode==13) {window.Frm.gud.focus();}" style="width:40%;height:30px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">��˾λ�ã�</td><td><input type="text" class="input-text"  placeholder="" id="address" name="address" onkeydown="if(event.keyCode==13) {window.Frm.dsh.focus(); }" style="width:80%;height:30px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">���»᣺</td>
            <td><input type="text" class="input-text"  placeholder="" id="dsh" name="dsh" onkeydown="if(event.keyCode==13) {window.Frm.cd.focus(); }" style="width:60%;height:30px;">
                ���أ�<input type="text" id="cd" name="cd" onkeydown="if(event.keyCode==13) {window.Frm.fr.focus();}" style="height: 30px;width: 20%"><font color="red">(m2)</font>
            </td>
        </tr>
        <tr>
            <td align="center" height="35" width="20%">���ˣ�</td>
            <td><input type="text" id="fr" name="fr" onkeydown="if(event.keyCode==13) {window.Frm.zjl.focus();}" style="width: 20%;height: 30px">
                �ܾ���<input type="text" id="zjl" name="zjl" onkeydown="if(event.keyCode==13) {window.Frm.js.focus();}" style="width: 20%;height: 30px">
                ���£�<input type="text" id="js" name="js" onkeydown="if(event.keyCode==13) {window.Frm.content1.focus();}" style="width: 20%;height: 30px">
            </td>
        </tr>
        <tr>
            <td align=center width="20%" height="40">�ϴ��³̣�</td>
            <td colspan="2"><input name="zhangc" type="file" size="32" style="width:80%;height:30px;"></td>
        </tr>
        <tr>
            <td align=center width="20%" height="40">�ϴ������ƶȣ�</td>
            <td colspan="2"><input name="zhid" type="file" size="32" style="width:80%;height:30px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="100">��ע-> </td>
            <td><textarea id="content1" name="content1" style="width:80%;height:250px;visibility:hidden;"></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="80">
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
        if(window.Frm.qylx.value=="")
        {layer.msg('��ҵ���Ͳ���Ϊ��!');return false;}
        else if(window.Frm.usercode.value=="")
        {layer.msg('��ҵ��Ų���Ϊ��!');return false;}
        else if(window.Frm.shortname.value=="")
        {layer.msg('��ҵ���Ʋ���Ϊ��!');return false;}
        return true;
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.Frm.usercode.focus();
</script>
