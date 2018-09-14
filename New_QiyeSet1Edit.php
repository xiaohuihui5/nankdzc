<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname'])){
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
   function uploadFile( $fileInfo,$path="./upfile/excel",$maxSize=10485760
    ){
        $filename=$fileInfo["name"];
        $tmp_name=$fileInfo["tmp_name"];
        $size=$fileInfo["size"];
        $error=$fileInfo["error"];

//服务器端设定限制

        $ext=pathinfo($filename,PATHINFO_EXTENSION);

//目的信息
        if (!file_exists($path)) {
            mkdir($path,0777,true);
            chmod($path, 0777);
        }
        $uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
        $destination=$path."/".$uniName;
        if ($error==0) {
            if ($size>$maxSize) {
                exit("上传文件过大！");
            }
            if (!is_uploaded_file($tmp_name)) {
                exit("上传方式有误，请使用post方式");
            }
            if (@move_uploaded_file($tmp_name, $destination)) {//@错误抑制符，不让用户看到警告
            }else{
                echo "文件".$filename."上传失败!";
            }
        }else{
            switch ($error){
                case 1:
                    echo "超过了上传文件的最大值，请上传2M以下文件";
                    break;
                case 2:
                    echo "上传文件过多，请一次上传20个及以下文件！";
                    break;
                case 3:
                    echo "文件并未完全上传，请再次尝试！";
                    break;
                case 4:
                    echo "未选择上传文件！";
                    break;
                case 7:
                    echo "没有临时文件夹";
                    break;
            }
        }
        return $uniName;
    }
    foreach ($_FILES as $fileInfo){
        $file[]=uploadFile($fileInfo);
    }
    $query = "update sys_qiye set yn=1,usercode='" . $_POST['usercode'] . "',lx=" . $_POST['qylx'] . ",shortname='" . $_POST['shortname'] . "',piny='" . Get_Piny($_POST['shortname']) . "',xydm='" . $_POST['xydm'] . "',clsj='" . $_POST['clsj'] . "',zczb='" . $_POST['zczb'] . "',fuzy='" . $_POST['fuzy'] . "',phone='" . $_POST['phone'] . "',fr='" . $_POST['fr'] . "',zjl='" . $_POST['zjl'] . "',js='" . $_POST['js'] . "',dsh='" . $_POST['dsh'] . "',cd='" . $_POST['cd'] . "',address='" . $_POST['address'] . "',zhangc='".$file[0]."',zhid='".$file[1]."',bz='" . $htmlData . "' where id=" . $_POST['id'];
    //echo $query;die;
    $query = str_replace("=,", "=null,", $query);
    include("./inc/xexec.php");
    if($res)
    {
        echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('操作成功！',{shade:false});parent.layer.closeAll();</script>";//提示成功退出
    }
}

$query="select a.fenlmc,q.usercode,q.shortname,q.xydm,convert(varchar(10),q.clsj,120),q.zczb,q.fuzy,q.phone,q.fr,q.zjl,q.js,q.dsh,q.cd,q.address,q.bz,q.zhangc,q.zhid from sys_qiye q,sys_qiyefenl a where q.lx=a.id and q.id=".$_GET['eid'];
//echo $query;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $fenlmc=$line[0];
    $usercode=$line[1];
    $shortname=$line[2];
    $xydm=$line[3];
    $clsj=$line[4];
    $zczb=$line[5];
    $fuzy=$line[6];
    $phone=$line[7];
    $fr=$line[8];
    $zjl=$line[9];
    $js=$line[10];
    $dsh=$line[11];
    $cd=$line[12];
    $address=$line[13];
    $bz=$line[14];
    $zhangc=$line[15];
    $zhid=$line[16];
}
sqlsrv_free_stmt($result);

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
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
<form name="Frm" method="POST" action="" enctype="multipart/form-data">
    <input name="id" value="<?php echo $_GET['eid'];?>" type="hidden">
    <table style="font-size: 25px">
        <tr>
            <td align="center" width="20%" height="35">企业编号：</td><td><input type="text" class="input-text" readonly id="usercode" name="usercode" value="<?php echo $usercode;?>" onkeydown="if(event.keyCode==13) {window.Frm.shortname.focus();}" style="width:20%;height:25px;"><span class="c-red">*</span>企业名称：<input type="text" class="input-text" value="<?php echo $shortname;?>" id="shortname" name="shortname" onkeydown="if(event.keyCode==13) {window.Frm.xydm.focus();}" style="width:50%;height:25px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center width="20%" height="40">企业类型：</td>
            <td>
                <select class="select" id="qylx" name="qylx" onkeydown="if(event.keyCode==13) window.Frm.usercode.focus();" style="width:80%;height:25px;">
                    <?php
                    $query='select id,fenlmc from sys_qiyefenl where yn=1 order by fenlmc';
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
                        if($line[0]==$qylx)
                            echo '<option selected value=',$line[0],'>',$line[1],'</option>';
                        else
                            echo '<option value=',$line[0],'>',$line[1],'</option>';
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select><span class="c-red">*</span>
            </td>
        </tr>

        <tr>
            <td align="center" width="20%" height="30">统一社会信用代码：</td><td><input type="text" class="input-text" value="<?php echo $xydm;?>" id="xydm" name="xydm" onkeydown="if(event.keyCode==13) {window.Frm.zczb.focus();}" style="width:25%;height:25px;"><span class="c-red">*</span>
                成立时间：<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="clsj" id="clsj" class="input-text Wdate" style="width:100px;height: 25px;" value="<?php echo $clsj;?>"/>
                &nbsp;认缴额：<input type="text" id="zczb" name="zczb" value="<?php echo $zczb;?>" onkeydown="if(event.keyCode==13) {window.Frm.fuzy.focus();}" style="width: 20%;height: 25px"><font color="red">(万元)</font>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">联系人：</td><td><input type="text" class="input-text"  placeholder="" id="fuzy" name="fuzy" value="<?php echo $fuzy;?>" onkeydown="if(event.keyCode==13) {window.Frm.phone.focus();}" style="width:25%;height:25px;">
                &nbsp;联系电话：<input type="text" class="input-text"  placeholder="" id="phone" name="phone" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13) {window.Frm.gud.focus();}" style="width:40%;height:25px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">公司位置：</td><td><input type="text" class="input-text"  value="<?php echo $address;?>" id="address" name="address" onkeydown="if(event.keyCode==13) {window.Frm.dsh.focus(); }" style="width:80%;height:25px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="35">董事会：</td>
            <td><input type="text" class="input-text"  placeholder="" id="dsh" name="dsh" value="<?php echo $dsh;?>" onkeydown="if(event.keyCode==13) {window.Frm.cd.focus(); }" style="width:60%;height:25px;">
                场地：<input type="text" id="cd" name="cd" value="<?php echo $cd;?>" onkeydown="if(event.keyCode==13) {window.Frm.fr.focus();}" style="height: 25px;width: 20%"><font color="red">(m2)</font>
            </td>
        </tr>
        <tr>
            <td align="center" height="35" width="20%">法人：</td>
            <td><input type="text" id="fr" name="fr" value="<?php echo $fr;?>" onkeydown="if(event.keyCode==13) {window.Frm.zjl.focus();}" style="width: 20%;height: 25px">
                总经理：<input type="text" id="zjl" name="zjl" value="<?php echo $zjl;?>" onkeydown="if(event.keyCode==13) {window.Frm.js.focus();}" style="width: 20%;height: 25px">
                监事：<input type="text" id="js" name="js" value="<?php echo $js;?>" onkeydown="if(event.keyCode==13) {window.Frm.content1.focus();}" style="width: 20%;height: 25px">
            </td>
        </tr>
        <tr>
            <td align=center width="20%" height="40">上传章程：</td>
            <td colspan="2"><input type="text" value="<?php echo $zhangc;?>" id="fileName">
                <input name="zhangc" value="" type="file" size= "32" id="zhangc" style="height:30px;" onchange="handleFile()">
            </td>
            <!--<td colspan="2"><input name="zhangc" value="<?php /*echo $zhangc;*/?>" type="text" size="32" style="height:30px;"></td>-->
        </tr>
        <tr>
            <td align=center width="20%" height="40">上传规章制度：</td>
            <td colspan="2"><input name="zhid" value="<?php echo $zhid;?>" type="file" size="32" style="height:30px;"></td>
            <!--<td colspan="2"><input name="zhid" value="<?php /*echo $zhid;*/?>" type="text" size="32" style="height:30px;"></td>-->
        </tr>
        <tr>
            <td align="center" width="20%" height="100">备注-> </td>
            <td><textarea id="content1" name="content1" style="width:80%;height:300px;visibility:hidden;"><?php echo $bz;?></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="60">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" ">
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    var zhangc = document.getElementById("zhangc");
    var fileName = document.getElementById("fileName");
    function handleFile(){
        fileName.value = zhangc.value;
    }
    function sub()
    {
        if(window.Frm.qylx.value==""){
            layer.msg('企业类型不能为空!',{shade:false});}
        else if(window.Frm.shortname.value==""){
            layer.msg('企业名称不能为空!',{shade:false});}
        else{
            window.Frm.submit();}

    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.Frm.qylx.select();
</script>
