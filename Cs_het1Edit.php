<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['qyid']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
    if (get_magic_quotes_gpc())
        $htmlData = stripslashes($_POST['content1']);
    else
        $htmlData = $_POST['content1'];
    //echo $htmlData;
$query="update sys_het set mingc='".$_POST['mingc']."',typea=".$_POST['typea'].",unit=".$_POST['qyid'].",gys='".$_POST['gys']."',zuj='".$_POST['zuj']."',usercode='".$_POST['usercode']."',qdrq='".$_POST['dt3']."',lianxr='".$_POST['lianxr']."',lianxdh='".$_POST['lianxdh']."',qsrq='".$_POST['dt1']."',jsrq='".$_POST['dt2']."'
,bz='".$htmlData."' where id=".$_POST['eid'];
	//echo $query;die;
    include('./inc/xexec.php');
    if($res)
    {
        echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('操作成功！',{shade:false});parent.layer.closeAll();</script>";//提示成功退出
    }
}

$query="select ht.bz,ht.mingc,ht.typea,unit.id,unit.shortname,ht.usercode,ht.qdy,convert(varchar(10),ht.qdrq,120),ht.lianxr,ht.lianxdh,convert(varchar(10),ht.qsrq,120),convert(varchar(10),ht.jsrq,120),ht.gys,ht.zuj from sys_het ht,sys_qiye unit where unit.id=ht.unit and ht.id=".$_GET['eid'];
//echo $query;die;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $bz=$line[0];
    $mingc=$line[1];
    $typea=$line[2];
    $unitid=$line[3];
    $unitmc=$line[4];
    $usercode=$line[5];
    $qdy=$line[6];
    $qdrq=$line[7];
    $lianxr=$line[8];
    $lianxdh=$line[9];
    $qsrq=$line[10];
    $jsrq=$line[11];
    $gys=$line[12];
    $zuj=$line[13];
}
sqlsrv_free_stmt($result);

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>合同资料管理-修改合同</title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
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
    <input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
    <table>
        <tr>
            <td align="center" width="20%" height="40">合同编号：</td><td><input readonly type="text" class="input-text"  value="<?php echo $usercode; ?>" id="usercode" name="usercode" onfocus="this.select()" onkeydown="if(event.keyCode==13) {window.forml.mingc.focus();}" style="width:30%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align=center height="40">合同分类:</td>
            <td>
                <select style="width:80%;height: 30px;" id="typea" name="typea">
                    <option value="">---选择分类---</option>
                    <?php
                    $query="select id,fenlmc from sys_hetfenl where yn=1 order by bianh,fenlmc";
                    $result=sqlsrv_query($conn,$query);
                    while($line=sqlsrv_fetch_array($result))
                    {
                        if($line[0]==$typea)
                            echo '<option selected value=',$line[0],'>',$line[1],'</option>';
                        else
                            echo '<option value=',$line[0],'>',$line[1],'</option>';
                    }
                    sqlsrv_free_stmt($result);
                    ?>
                </select><font color=red>*</td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">合同名称：</td><td><input type="text" class="input-text"  value="<?php echo $mingc; ?>" id="mingc" name="mingc" onfocus="this.select()" onkeydown="if(event.keyCode==13) {window.forml.lianxr.focus();}" style="width:80%;height:30px;"><span class="c-red">*</span></td>
        </tr>
        <!--<tr>
            <td align=center height="40">企业名称:</td>
            <td><input type="hidden" value="<?php /*echo $unitid;*/?>" id="qyid" name="qyid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" value="<?php /*echo $unitmc;*/?>" tabindex="1"  onkeyup="AutoFinish()"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13){startRequest(this.value,0);CloseTipDiv();return false;}" style="width: 80%;height: 30px;"  id="spdm" name="spdm"><font color=red>*</font></td>
        </tr>-->
        <tr>
            <td align="center" height="40">合作企业</td>
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
                            if($line[0]==$unitid)
                                echo '<option selected value=',$line[0],'>',$line[1],'</option>';
                            else
                                echo '<option value=',$line[0],'>',$line[1],'</option>';
                        }
                        sqlsrv_free_stmt($result);
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">合作单位：</td>
            <td><input type="text" class="input-text"  placeholder="" value="<?php echo $gys;?>" id="gys" name="gys" onkeydown="if(event.keyCode==13) {window.forml.zuj.focus();}" style="width:30%;height:30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合同金额：&nbsp;&nbsp;&nbsp;<input type="text" class="input-text"  placeholder="" value="<?php echo $zuj;?>" id="zuj" name="zuj" onkeydown="if(event.keyCode==13) {window.forml.lianxr.focus();}" style="width:100px;height:30px;"></td>
        </tr>
        <tr>
            <td align="center" width="20%" height="40">对方联系人: </td>
            <td><input name="lianxr" value="<?php echo $lianxr;?>" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.lianxdh.focus();return false;}" style="width:30%;height:30px;"><span class="c-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联系电话: <input name="lianxdh" value="<?php echo $lianxdh;?>" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.qdy.focus();return false;}" style="width:30%;height:30px;"><span class="c-red">*</span></td></tr>
        <tr>
        <tr>
            <td align="center" height="40">起始日期:</td>
            <td><input type="text" value="<?php echo $qsrq;?>" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="dt1" id="dt1" class="input-text Wdate" style="width:110px;height: 30px;" value="<?php echo date('Y-m-d');?>"/><span class="c-red">*</span>
                &nbsp;&nbsp;结束日期:<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="dt2" id="dt2" value="<?php echo $jsrq;?>" class="input-text Wdate" style="width:110px;height: 30px;" value="<?php echo date('Y-m-d');?>"/><span class="c-red">*</span>
                &nbsp;&nbsp;签订日期: <input name="dt3" type="text" id="dt3" value="<?php echo $qdrq;?>" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()"  class="input-text Wdate" value="<?php echo date('Y-m-d');?>"  onkeydown="if(event.keyCode==13){return false;}" onclick="calendar(this)" style="width:110px;height: 30px;"><span class="c-red">*</span></td>
        </tr>
        <tr>
            <td align="center" width="20%">备注信息↓</td>
            <td colspan=4></td>
        <tr>
            <td align="center" colspan=3><textarea id="content1" name="content1" style="width:80%;height:260px;visibility:hidden;"><?php echo $bz;?></textarea></td>
        </tr>
        <tr>
            <td align=center colspan="2" height="70">
                <input class="btn btn-primary radius" type="submit" name="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" ">
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script lanuage="javascript">
    function sub()
    {
        if(window.forml.qyid.value=="")
        {layer.msg('企业名称不能为空!');return false;}
        else if(window.forml.typea.value=="")
        {layer.msg('合同类型不能为空!');return false;}
        return true;
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.forml.usercode.focus();
</script>
