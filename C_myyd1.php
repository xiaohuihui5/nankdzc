<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/7
 * Time: 14:35
 */
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
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
    <input type="hidden" name="shid" value="0">
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
    <?php
    if(isset($_POST['paix']) and $_POST['paix']!="")
        $px=$_POST['paix'];
    else
        $px=" b.fenlmc+a.bianh+a.yiti+convert(varchar(10),a.ksrq,120)+convert(varchar(10),a.jsrq,120)+convert(varchar(10),a.ydrq,120)+f.fangjh";
    $_SESSION['mac']="select 0,0,b.fenlmc,a.bianh,a.yiti,convert(varchar(10),a.ksrq,120),
convert(varchar(10),a.jsrq,120),convert(varchar(10),a.ydrq,120),f.fangjh,a.rens,a.reny,'<a href=javascript:xq('+cast(a.id as varchar(10))+')><img border=0  src=im/select.gif></a>',
case a.yn when 0 then '<font color=red>预定中...' when 1 then '<font color=blue>审核通过' else '预定失败' end,
'<a href=javascript:ed('+cast(a.id as varchar(10))+','+cast(a.yn as varchar(10))+')><img border=0 src=im/edit.gif alt=修改此行数据></a>' 
from sys_meet a,sys_meetlx b,sys_fangj f where a.lx=b.id and a.fangj=f.id and a.fqr=".$_SESSION['empid']." order by ".$px;
         //echo $_SESSION['mac'];
        $_SESSION['mac'].="#"."13,0,0,0,0,0,0,0,0,0,0,0,0,0";
        $_SESSION['mac'].="#".",5%,10%,5%,15%,8%,8%,8%,6%,5%,15%,5%,5%,5%";
        $_SESSION['mac'].="#".",center,center,left,left,center,center,center,left,right,left,center,center,center";
        $_SESSION['mac'].="#".",序,会议类型,编号,会议议题,开始时间,结束时间,预约时间,会议室,参会人数,参会人员,会议纪要,状态,修改";
        $_SESSION['mac'].="#会议预定";
        $_SESSION['mac'].="#";
        $_SESSION['mac'].="#";
        include("./inc/xNoCountdis.php");
    ?>

</form>
</body>
<script language=javascript>
    function xq(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        layer_show3("会议预定--会议纪要","<?php echo $xiam;?>Xiangq.php?eid="+id,"680","450","parent");
    }
    function sh(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        window.Frm.shid.value=id;
        window.Frm.submit();
    }
    function ed(id,yn)
    {
        if(yn==1)
       {layer.msg('已审核通过会议不能修改,如需修改请取消审核后再修改!');return false;}
        else{
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("会议预定--修改会议资料","<?php echo $xiam;?>Edit.php?eid="+id,"780","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
            }
    }
</script>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>