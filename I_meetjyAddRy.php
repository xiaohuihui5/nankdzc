<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 14:25
 */
require('./inc/xhead.php');
$tit="参会人员";
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body>
<form name="forml" method="POST" action="">
    <table width="100%">
        <tr><td height="25" colspan="3" align=center><b><font color=red><?php echo $tit;?></b></td></tr>
        <tr><td align="center" height="40">校领导:&nbsp;&nbsp;&nbsp;<input name="xld" value="" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">董事:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="ds" value="" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">监事:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="js" value="" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="40">总经理:&nbsp;&nbsp;&nbsp;<input name="zjl" value="" style="width: 80%;height: 30px;"></td></tr>
        <tr><td align="center" height="60">其他人员:<textarea id="reny" name="reny" cols="" rows="" class="textarea"  style="width:80%;height:60px;"></textarea></td></tr>
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
        window.parent.document.getElementById('xld').value=window.forml.xld.value;
        window.parent.document.getElementById('ds').value=window.forml.ds.value;
        window.parent.document.getElementById('js').value=window.forml.js.value;
        window.parent.document.getElementById('zjl').value=window.forml.zjl.value;
        window.parent.document.getElementById('reny').value=window.forml.reny.value;
        window.parent.document.getElementById('chry').value=window.forml.xld.value+','+window.forml.ds.value+','+window.forml.js.value+','+window.forml.zjl.value+','+window.forml.reny.value;
        parent.layer.closeAll();
    }
    function exit()
{
    parent.layer.closeAll();
}
</script>