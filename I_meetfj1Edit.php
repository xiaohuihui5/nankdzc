<?php
require('./inc/xhead.php');
if (isset($_POST['fanjh']))
{
    $query="update sys_fangj set fangjh='".$_POST['fanjh']."',name='".$_POST['name']."',beiz='".$_POST['beiz']."',zt=".$_POST['zt']." where id=".$_POST['eid'];
    include('./inc/xexec.php');
    if($res)
    {
        echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
    }

}
$query="select id,fangjh,name,beiz,zt from sys_fangj where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
    $fangjh=$line[1];
   $name=$line[2];
   $beiz=$line[3];
   $zt=$line[4];
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
<BODY >
<form name="forml" method="POST" action="">
    <div align="center">
        <center>
            <table cellSpacing="1" cellPadding="0">
                <tr>
                    <td align=right width="20%" height="60"> 房间号： </td>
                    <td ><input name="fanjh" value="<?php echo $fangjh;?>" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.name.focus();return false;}" style="width:50%;height: 40px;"><font color=red>*</td>
                </tr>
                <tr>
                    <td align=right width="20%" height="60"> 会议室名称： </td>
                    <td><input name="name" value="<?php echo $name;?>" onfocus="this.select()" onkeydown="if(event.keyCode==13){window.forml.beiz.focus();return false;}" style="width:80%;height: 40px;"><font color=red>*</td>
                </tr>
                <tr>
                    <td align=right width="20%" height="80"> 会议室描述：</td>
                    <td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:200px;"><?php echo $beiz;?></textarea></td>
                </tr>
                <tr>
                    <td align=right width="20%" height="40"><span class="c-red">*</span>是否停用：</td>
                    <td><input type="radio" id="zt" name="zt" value="1"  <?php echo $zt==1?"checked":"";?> >
                        <label for="sex-1">否</label>
                        <input type="radio" id="zt" name="zt" value="0"  <?php echo $zt==0?"checked":"";?> >
                        <label for="sex-2">是</label>
                    </td>
                </tr>
                <tr>
                    <td align=center colspan="2" height="80">
                        <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
                        <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
                    </td>
                </tr>
            </table>
        </center>
    </div>
</form>
</body>
</html>
<script lanuage="javascript">
    function sub() {
        if (window.forml.fanjh.value == "") {
            layer.msg('房间号不能为空!', {shade: false});
        }
        else if (window.forml.name.value == ""){
            layer.msg('会议室名称不能为空!', {shade: false});}
        else {
            window.forml.submit();
        }
    }
    function exit()
    {
        parent.layer.closeAll();
    }
</script>
