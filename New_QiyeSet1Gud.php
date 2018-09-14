<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/31
 * Time: 15:36
 */
require ('./inc/xhead.php');
if(isset($_POST['name']) || $_POST['name']!="")
{
    $query="insert into sys_gud(qyid,name,cze,czxs,gfbl) values(".$_POST['qyid'].",'".$_POST['name']."','".$_POST['cze']."','".$_POST['czxs']."','".$_POST['gfbl']."')";
    //echo $query;die;
    require("./inc/xexec.php");
}
$ed_row=0;
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
    if(isset($_POST['name1']))
    {
        $query="update sys_gud set name='".$_POST['name1']."',cze='".$_POST['cze1']."',czxs='".$_POST['czxs1']."',gfbl='".$_POST['gfbl1']."' where id=".$_POST['edtrow'];
        require("./inc/xexec.php");
        $ed_row=0;
    }
    else $ed_row=$_POST['edtrow'];
}
?>
<html>
<head>
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
</head>
<body>
<form action="" method="post" name="forml">
    <input name="qyid" value="<?php echo $_GET['qyid'];?>" type="hidden">
    <div style="margin: 30px">
        <div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;股东：<input name="name" style="height: 30px"><font color=red>*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出资额：<input name="cze" style="height: 30px"><font color="red">(万元)</font>
        </div>
        <div style="margin-top: 10px">
            出资形式：<input name="czxs" style="height: 30px;width: 80%">
        </div>
        <div style="margin-top: 10px">
            股份比例：<input name="gfbl" style="height: 30px;width: 80%">
        </div>
    </div>
    <div align="center">
        <input class="btn btn-primary radius" type="button" name="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
        &nbsp;&nbsp;&nbsp;<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></div>
</form>
<form action="" method=post name="Frm">
    <input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
    <input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
    <input name="qyid" value="<?php echo $_GET['qyid'];?>" type="hidden">
    <table border="1px solid black" class="tableborder3" style="margin-top: 20px">
        <tr align="center">
            <td width="8%">序</td>
            <td width="20%">股东</td>
            <td width="14%">出资额</td>
            <td width="20%">出资形式</td>
            <td width="30%">股份比例</td>
            <td width="8%">修改</td>
        </tr>
        <?php
        $query="select id,name,cze,czxs,gfbl from sys_gud where qyid=".$_GET['qyid'];
        //echo $query;
        $result=sqlsrv_query($conn,$query);
        $row=0;
        while($line=sqlsrv_fetch_array($result)) {
            $row++;
            if ($ed_row == $line[0]) {
                ?>
                <tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" align="center">
                    <td width="8%"  height=20><?php echo $row;?></td>
                    <td width="20%"><input onkeydown="if(event.keyCode==13)window.Frm.cze.select();" name="name1" id="name1" value="<?php echo $line[1];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td width="14%"><input onkeydown="if(event.keyCode==13)window.Frm.czxs.select();" name="cze1" value="<?php echo $line[2];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td width="20%"><input onkeydown="if(event.keyCode==13)window.Frm.gfbl.select();" name="czxs1" value="<?php echo $line[3];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td width="20%"><input onkeydown="if(event.keyCode==13)sav();" name="gfbl1" value="<?php echo $line[4];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td align="9%"><a href="javascript:can()"><img border=0 src="im/fanh.png" alt="取消修改此行数据"></a></td>
                    <td align="9%"><a href="javascript:sav()"><img border=0 src="im/baoc.png" alt="把修改后数据保存"></a></td>
                </tr>
                <?php
            }
            else{
                ?>
                <tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" align="center">
                    <td width="8%"  height=20><?php echo $row;?></td>
                    <td width="20%"><?php echo $line[1];?></td>
                    <td width="14%"><?php echo $line[2];?></td>
                    <td width="20%"><?php echo $line[3];?></td>
                    <td width="30%"><?php echo $line[4];?></td>
                    <td width="8%" align="center"><a href="javascript:xg(<?php echo $line[0];?>)"><img border=0 src=im/xiug.png alt=修改此单></a></td>
                </tr>
                <?php
            }
        }
        sqlsrv_free_stmt($result);
        ?>
    </table>
</form>
</body>
<script lanuage="javascript">
    function sub(){
        if(window.forml.name.value == ""){
            layer.msg('股东名称不能为空!', {shade: false});
        }else {
            window.forml.submit();
        }
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    function xg(id)
    {
        if(window.Frm.edtrow.value==0)
        {
            window.Frm.scroll.value=document.body.scrollTop;
            window.Frm.edtrow.value=id;
            window.Frm.submit();
        }
    }
</script>

<script defer="defer">setscroll();</script>
