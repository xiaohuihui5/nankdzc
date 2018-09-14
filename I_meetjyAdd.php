<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 14:53
 */
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['yiti']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
    //echo $htmlData;
    $query="insert into sys_meet(yn,qyid,lx,yiti,fangj,ksrq,zcr,reny,jlr,xld,ds,js,zjl,gy,bz) 
values(0,'".$_POST['qyid']."',".$_POST['lx'].",'".$_POST['yiti']."','".$_POST['fangj']."','".$_POST['dt1']."','".$_POST['zcr']."','".$_POST['reny']."','".$_POST['jlr']."','".$_POST['xld']."','".$_POST['ds']."','".$_POST['js']."','".$_POST['zjl']."','".$_POST['gy']."','".$htmlData."')";
   //echo $query;
    include('./inc/xexec.php');
    if($res)
    {
        echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('操作成功！',{shade:false});parent.layer.closeAll();</script>";//提示成功退出
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>会议预定-新增会议</title>
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
       <!-- <tr>
            <td align="center" width="20%" height="40">会议编号：</td><td><input type="text" class="input-text"  placeholder="" id="bianh" name="bianh" onkeydown="if(event.keyCode==13) {window.forml.yiti.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>-->
        <tr>
            <td align=center height="40">会议类型:</td>
            <td>
                <select style="width:80%;height: 30px;" id="lx" name="lx">
                    <option value="">---选择分类---</option>
                    <?php
                    $query="select id,fenlmc from sys_meetlx where yn=1 order by bianh,fenlmc";
                    //echo $query;
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
            <td align="center" height="40">发起企业</td>
            <td>
                <select style="width:80%;height: 30px;" id="qyid" name="qyid">
                    <option value="">--选择企业--</option>
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
                </select><span class="c-red">*</span>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">会议地点：</td>
            <td><input type="text" class="input-text"  placeholder="" id="fangj" name="fangj" onkeydown="if(event.keyCode==13) {window.forml.yiti.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">会议议题：</td>
            <td><input type="text" class="input-text"  placeholder="" id="yiti" name="yiti" onkeydown="if(event.keyCode==13) {window.forml.reny.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" height="40">主持人:</td>
            <td><input type="text" class="input-text" id="zcr" name="zcr" onkeydown="if(event.keyCode==13) {window.forml.zcr.focus();}" style="width: 80px;height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始时间:&nbsp;&nbsp;&nbsp;<input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt1" id="dt1" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;记录人:&nbsp;&nbsp;&nbsp;<input type="text" class="input-text" id="jlr" name="jlr"  style="width: 80px;height: 30px;">
            </td>
        </tr>
        <tr>
            <td align=center height="40"><a href="javascript:;" onclick="Sel()"><font color=blue>参会人员：</font></a></td><td><input value="" readonly onclick="Sel()" id="chry" name="chry" style="width: 80%;height: 30px;">
                <input type="hidden" id="xld" name="xld">
                <input type="hidden" id="ds" name="ds">
                <input type="hidden" id="js" name="js">
                <input type="hidden" id="zjl" name="zjl">
                <input type="hidden" id="reny" name="reny">
            </td>
        </tr>
            <td align="center" height="80">会议概要：</td>
            <td><textarea name="gy" cols="" rows="" class="textarea"  style="width:80%;height:80px;"></textarea></td>
        </tr>
        <tr>
            <td align="center" width="20%" style="color: red;">会议信息↓</td>
            <td colspan=4></td>
        </tr>
        <tr>
            <td align="center" colspan=3><textarea id="content1" name="content1" style="width:80%;height:220px;visibility:hidden;"></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="60">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" ">
                &nbsp;&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    function Sel()
    {
        layer_show2("参会人员录入","I_meetjyAddRy.php","500","500"); //最后一个参数是给一个标识符
    }
    function sub()
    {
        if(window.forml.lx.value=="")
        {layer.msg('会议类型不能为空!');return false;}
        else if(window.forml.qyid.value=="")
        {layer.msg('发起企业不能为空!');return false;}
        else if(window.forml.fangj.value=="")
        {layer.msg('会议地点不能为空!');return false;}
        else if(window.forml.yiti.value=="")
        {layer.msg('会议议题不能为空!');return false;}
        return true;
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.forml.lx.focus();
</script>
