<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query='update sys_fangj set zt=zt^1 where id='.$_POST['delrow'];
    //echo $query;die;
    include("./inc/xexec.php");
}

?>
<head>
    <link rel="stylesheet" href="./inc/xdown.css" type="text/css">
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<body>
<form action="" method=post name="Frm">
    <input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
    <input type="hidden" name="delrow" value="0">
    <input type="hidden" name="edtrow" value="0">
    <input type="hidden" name="zhuangt" value="<?php echo isset($_POST['zhuangt'])?$_POST['zhuangt']:"8";?>">
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
    <?php
    $TJ="";
    if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
        $TJ.=" and fj.name+fj.fangjh like '%".$_POST['cxtj']."%' ";
    if(isset($_POST['paix']) and $_POST['paix']!="")//排序
        $px=$_POST['paix'];
    else
        $px="fj.fangjh";
    $_SESSION['mac']="select 0,0,fj.fangjh,fj.name,fj.beiz,case fj.zt when 0 then '<a href=javascript:yn('+cast(fj.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(fj.id as varchar(10))+')>启用</a>' end,'<a href=javascript:ed('+cast(fj.id as varchar(10))+')><img border=0 src=im/edit.gif alt=修改此行数据></a>' 
from sys_fangj fj where 2>1 ".$TJ." order by ".$px;
    $_SESSION['mac'].="#"."6,0,0,0,0,0,0";
    $_SESSION['mac'].="#".",5%,10%,20%,45%,10%,10%";
    $_SESSION['mac'].="#".",center,center,center,center,center,center";
    $_SESSION['mac'].="#".",序,房间号,会议室名称,备注,禁用,修改";
    $_SESSION['mac'].="#会议室资料";
    $_SESSION['mac'].="#";
    $_SESSION['mac'].="#";
    include("./inc/xNoCountdis.php");
    ?>
</form>
</body>
<script language=javascript>
    function xq(id)
    {
        openwindow2('<?php echo $xiam;?>Xiangq.php?eid='+id,680,450);
    }
    function ed(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("会议室管理--修改会议室资料","<?php echo $xiam;?>Edit.php?eid="+id,"400","500","parent");//最后一个是给标识符  需要父级打开就给  不然就空
    }
</script>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>
