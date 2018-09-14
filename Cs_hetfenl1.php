<?php
require('./inc/xhead.php');require('./inc/xpage_downlib.php');
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query="update sys_hetfenl set yn=yn^1 where id=".$_POST['delrow'];
    require('./inc/xexec.php');
}
if(isset($_POST['fenlmc']))
{
    $query="insert into sys_hetfenl(bianh,fenlmc,yn) values('".$_POST['bianh']."','".$_POST['fenlmc']."',1)";
    //echo $query;die;
    require("./inc/xexec.php");
}
$ed_row=0;
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
    if(isset($_POST['bh_']))
    {
        $query="update sys_hetfenl set bianh='".$_POST['bh_']."',fenlmc='".$_POST['fenlmc_']."' where id=".$_POST['edtrow'];
        require("./inc/xexec.php");
        $ed_row=0;
    }
    else $ed_row=$_POST['edtrow'];
}
?>
<head><link rel="stylesheet" href="./inc/xdown.css" type="text/css">
    <script language="javascript" src="./inc/xmy.js?i=2"></script></head>
<BODY>
<form action="" method=post name="Frm">
    <input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:'';?>">
    <input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
    <input type="hidden" name="delrow" value="0">
    <input type="hidden" name="selid" value="">
    <table border="0" class="tableborder3">
        <?php
        $query="select 0,a.id,case len(a.bianh) when 0 then null else a.bianh end,a.fenlmc,case a.yn when 1 then '在用' else '<font color=red>禁用</font>' end from sys_hetfenl a  order by a.bianh,a.fenlmc";
        $result=sqlsrv_query($conn,$query);
        $row=0;
        while($line=sqlsrv_fetch_array($result))
        {
            $row++;
            if($ed_row==$line[1])
            {
                ?>
                <tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
                    <td width="10%" align="center" height=20><?php echo $row;?></td>
                    <td width="10%"><input onfocus="this.select()" onkeydown="if(event.keyCode==13)window.Frm.fenlmc_.focus();" name="bh_" value="<?php echo $line[2];?>" style="width:100%;"></td>
                    <td width="50%"><input onfocus="this.select()" onkeydown="if(event.keyCode==37)window.Frm.bh_.focus();else if(event.keyCode==13)sav();" name="fenlmc_" value="<?php echo $line[3];?>" style="width:100%;"></td>
                    <td width="10%" height=20><?php echo $dat[$line[1]];?></td>
                    <td width="10%" align="center"><a href="javascript:can()"><img border=0 src="im/fanh.png" alt="取消修改此行数据"></a></td>
                    <td width="10%" align="center"><a href="javascript:sav()"><img border=0 src="im/baoc.png" alt="把修改后数据保存"></a></td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr onMouseOver="v(this)" onMouseOut="o(this)">
                    <td onclick="dis(<?php echo $line[1];?>)" width="10%" align="center" height=20><?php echo $row;?></td>
                    <td onclick="dis(<?php echo $line[1];?>)" width="10%"  height=20><?php echo $line[2];?></td>
                    <td onclick="dis(<?php echo $line[1];?>)" width="50%"><?php echo $line[3];?></td>
                    <td onclick="dis(<?php echo $line[1];?>)" width="10%" align="center" height=20><?php echo isset($dat[$line[1]])?$dat[$line[1]]:"";?></td>
                    <td width="10%" align="center"><a href="javascript:yn(<?php echo $line[1];?>)"><?php echo $line[4];?></td>
                    <td width="10%" align="center"><a href="javascript:mod(<?php echo $line[1];?>,0)"><img border=0 src="im/edit.gif" width=15 height=15 alt="修改此行数据"></a></td>
                </tr>
                <?php
            }
        }
        sqlsrv_free_stmt($result);
        ?>
    </table>
</form>
</body>
<script language=javascript>
    function dis(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        window.Frm.selid.value=id;
        window.Frm.submit();
    }
</script>
<script defer="defer">setscroll();</script>
