<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 14:25
 */
require('./inc/xhead.php');
$tit="参会人员";
$query="select xld,ds,js,zjl,reny from sys_meet where id=".$_GET['eid'];
//echo $query;
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result)){
    $xld=$line[0];
    $ds=$line[1];
    $js=$line[2];
    $zjl=$line[3];
    $reny=$line[4];
}sqlsrv_free_stmt($result);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body>
<form name="forml" method="POST" action="">
    <table width="100%">
        <tr><td height="25" colspan="3" align=center><b><font color=red><?php echo $tit;?></b></td></tr>
        <tr><td align="center" height="40">校领导:&nbsp;&nbsp;&nbsp;<input name="xld" id="xld" value="<?php echo $xld;?>" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">董事:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="ds" id="ds" value="<?php echo $ds;?>" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">监事:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="js" id="js" value="<?php echo $js;?>" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">总经理:&nbsp;&nbsp;&nbsp;<input name="zjl" id="zjl" value="<?php echo $zjl;?>" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="60">其他人员:<textarea id="reny" name="reny" cols="" rows="" class="textarea"  style="width:80%;height:60px;"><?php echo $reny;?></textarea></td></tr>
        <tr>
            <td align=center colspan="2" height="70">
                <input class="btn btn-primary radius" type="button" name="button" onclick="sub();" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" >
                &nbsp;&nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
            </td>
        </tr>
    </table>
</body>
</html>
<script>
    function sub(){
        var xld=window.document.getElementById('xld').value;
       var ds=window.document.getElementById('ds').value;
       var js=window.document.getElementById('js').value;
       var zjl=window.document.getElementById('zjl').value;
       var reny=window.document.getElementById('reny').value;
       //var chry=window.document.getElementById('chry').value;
        /*window.opener.forml.xld.value=xld;
        window.opener.forml.ds.value=ds;
        window.opener.forml.js.value=js;
        window.opener.forml.zjl.value=zjl;
        window.opener.forml.reny.value=reny;
        window.opener.forml.chry.value=xld+','+ds+','+js+','+zjl+','+reny;
       window.close();*/
        window.parent.document.getElementById('xld').value=xld;
        window.parent.document.getElementById('ds').value=ds;
        window.parent.document.getElementById('js').value=js;
        window.parent.document.getElementById('zjl').value=zjl;
        window.parent.document.getElementById('reny').value=reny;
        window.parent.document.getElementById('chry').value=xld+','+ds+','+js+','+zjl+','+reny;
        parent.layer.closeAll();
    }
    function exit()
    {
        //window.close();
        parent.layer.closeAll();
    }
</script>