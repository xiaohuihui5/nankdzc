<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['bianh']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
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
        <tr>
            <td align="center" width="20%" height="40">会议编号：</td><td><input type="text" class="input-text"  placeholder="" id="bianh" name="bianh" onkeydown="if(event.keyCode==13) {window.forml.yiti.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">会议类型:</td>
            <td>
                <select style="width:80%;height: 30px;" id="lx" name="lx">
                    <option value="">---选择分类---</option>
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
            <td align="center" width="20%" height="40">会议议题：</td><td><input type="text" class="input-text"  placeholder="" id="yiti" name="yiti" onkeydown="if(event.keyCode==13) {window.forml.fqr.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">会议室:</td>
            <td>
                <select style="width:50%;height: 30px;" id="fangj" name="fangj" >
                    <option value="">---选择会议室---</option>
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
            <td align="center" height="40">预约时间:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt3" id="dt3" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" height="40">起始时间:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt1" id="dt1" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" height="40">结束时间:</td>
            <td><input type="text" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:00',onpicked:null})" name="dt2" id="dt2" class="input-text Wdate" style="width:160px;" value="<?php echo date('Y-m-d H:m:s');?>"/><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">参会人数：</td><td><input type="text" class="input-text"  placeholder="" id="rens" name="rens" onkeydown="if(event.keyCode==13) {window.forml.reny.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center width="20%" height="100">参会人员：</td>
            其他人员:<td><textarea name="reny" cols="" rows="" class="textarea"  style="width:80%;height:80px;"></textarea></td>
        </tr>
        <tr>
            <td align="center" width="20%" style="color: red;height: 50px;">会议纪要↓</td>
            <td colspan=4></td>
        <tr>
            <td align="center" colspan=3><textarea id="content1" name="content1" style="width:80%;height:260px;visibility:hidden;"></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="80">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" ">
                &nbsp;&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
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
        {layer.msg('会议编号不能为空!');return false;}
        else if(window.forml.lx.value=="")
        {layer.msg('会议类型不能为空!');return false;}
        else if(window.forml.yiti.value=="")
        {layer.msg('会议议题不能为空!');return false;}
        else if(window.forml.fangj.value=="")
        {layer.msg('会议室不能为空!');return false;}
        else if(window.forml.fqr.value=="")
        {layer.msg('会议预约人不能为空!');return false;}
        return true;
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.forml.bianh.focus();
</script>
