<?php
require('./inc/xhead.php');require('./inc/xpage_downlib.php');
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query="update sys_meetlx set yn=yn^1 where id=".$_POST['delrow'];
    require('./inc/xexec.php');
}
if(isset($_POST['fenlmc']) || $_POST['fenlmc']!="")
{
    $query="insert into sys_meetlx(bianh,fenlmc,yn) values('".$_POST['bianh']."','".$_POST['fenlmc']."',1)";
    require("./inc/xexec.php");
}
$ed_row=0;
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
    if(isset($_POST['fenlmc_']))
    {
        $query="update sys_meetlx set bianh='".$_POST['bianh_']."',fenlmc='".$_POST['fenlmc_']."' where id=".$_POST['edtrow'];
        require("./inc/xexec.php");
        $ed_row=0;
    }
    else $ed_row=$_POST['edtrow'];
}
?>
<head>
    <link rel="stylesheet" href="./inc/xdown.css" type="text/css">
    <script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<form action="" method=post name="Frm">
    <input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:'';?>">
    <input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
    <input type="hidden" name="delrow" value="0">
    <input type="hidden" name="selid" value="">
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <table border="0" class="tableborder3">
        <?php
        $TJ="";
        if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
            $TJ=" and dfl.fenlmc like '%".$_POST['cxtj']."%' ";
        $query="select 0,m.id,m.bianh,m.fenlmc,case m.yn when 1 then '启用' else '<font color=gray>停用' end from sys_meetlx m where m.id>0 ".$TJ." order by m.bianh";
        $result=sqlsrv_query($conn,$query);
        $row=0;
        while($line=sqlsrv_fetch_array($result))
        {
            $row++;
            if($ed_row==$line[1])
            {
                ?>
                <tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
                    <td width="10%"  height=20><?php echo $row;?></td>
                    <td width="10%"><input onkeydown="if(event.keyCode==13)window.Frm.fenlmc_.select();" name="bianh_" value="<?php echo $line[2];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td width="60%"><input onkeydown="if(event.keyCode==13)sav()" name="fenlmc_" value="<?php echo $line[3];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
                    <td width="10%" align="center"><a href="javascript:can()"><img border=0 src="im/fanh.png" alt="取消修改此行数据"></a></td>
                    <td width="10%" align="center"><a href="javascript:sav()"><img border=0 src="im/baoc.png" alt="把修改后数据保存"></a></td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
                    <td width="10%"  height=20><?php echo $row;?></td>
                    <td width="10%"><?php echo $line[2];?></td>
                    <td width="60%"><?php echo $line[3];?></td>
                    <td width="10%" align="center"><a href="javascript:yn(<?php echo $line[1];?>)"><?php echo $line[4];?></td>
                    <td width="10%" align="center"><a href="javascript:mod(<?php echo $line[1];?>,0)"><img border=0 src=im/xiug.png alt=修改此单></a></td>
                </tr>
                <?php
            }
        }
        sqlsrv_free_stmt($result);
        ?>
    </table>
</form>
</body>
<script language="javascript">
    window.Frm.bianh_.select();
</script>

<script defer="defer">setscroll();</script>
