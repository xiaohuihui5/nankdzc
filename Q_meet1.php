<?php
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
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
    <?php
    $TJ="";
    if(isset($_POST['dt1']) and $_POST['dt1']!="")
    {
        $TJ.=" and a.ksrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
    }
    else
        $TJ.=" and a.ksrq between '".date('Y-m-d')."' and '".date('Y-m-d ',strtotime("+1 day"))."' ";
    if(isset($_POST['zt']) and $_POST['zt']!="")
        $TJ.=" and a.yn in(".$_POST['zt'].") ";

    if(isset($_POST['paix']) and $_POST['paix']!="")
        $px=$_POST['paix'];
    else
        $px=" a.bianh+b.fenlmc+a.yiti+convert(varchar(20),a.ksrq,120)";

    $_SESSION['mac']="select 0,0,b.fenlmc,q.shortname,a.fangj,a.yiti,convert(varchar(20),a.ksrq,120),a.zcr,'<a href=javascript:xq('+cast(a.id as varchar(10))+')><img border=0  src=im/select.gif></a>',a.jlr,case a.yn when 0 then '<font color=red>审核中...' when 1 then '<font color=blue>审核通过' else '审核不通过' end as yn from sys_meet a,sys_meetlx b,sys_qiye q where a.lx=b.id and a.qyid=q.id".$TJ." order by ".$px;
    //echo $_SESSION['mac'];
    $_SESSION['mac'].="#"."10,0,0,0,0,0,0,0,0,0,0";
    $_SESSION['mac'].="#".",5%,9%,15%,20%,15%,10%,8%,6%,5%,7%";
    $_SESSION['mac'].="#".",center,center,center,center,center,left,center,center,center,center";
    $_SESSION['mac'].="#会议信息";
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
        layer_show3("会议资料--会议纪要","<?php echo $xiam;?>Xiangq.php?eid="+id,"770","720","parent");
    }
</script>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>
