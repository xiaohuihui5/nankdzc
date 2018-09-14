<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 14:45
 */
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['shid'])){
    $query="update sys_meet set yn=case yn when 1 then 0 when 2 then 1 else 2 end where id=".$_POST['shid'];
    //echo $query;
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
    <input type="hidden" name="shid" value="0">
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
    if(isset($_POST['cxtj']) and $_POST['cxtj']!=""){
        $TJ.=" and (q.shortname+a.yiti+b.fenlmc+a.zcr+a.jlr like '%".$_POST['cxtj']."%')";
    }
    if(isset($_POST['paix']) and $_POST['paix']!="")
        $px=$_POST['paix'];
    else
        $px=" b.fenlmc+a.yiti+convert(varchar(20),a.ksrq,120)";

    if(isset($_POST['setsh']) and $_POST['setsh']!=100)//批量审核
    {
        $query="update sys_meet set yn=".$_POST['setsh']." where id in(select a.id from sys_meet a where 2>1 ".$TJ.")";
        //echo $query;
        require("inc/xexec.php");
    }
    $menuright=menuright(97);
    if ($menuright==3){
        $shenh="case a.yn when 0 then '<a href=javascript:sh('+cast(a.id as varchar(10))+')><font color=red>审核中...' when 1 then '<a href=javascript:sh('+cast(a.id as varchar(10))+')><font color=blue>审核通过' when 2 then '<a href=javascript:sh('+cast(a.id as varchar(10))+')><font color=grey>审核不通过' end as yn";
    }else{
        $shenh="case a.yn when 0 then '<font color=red>审核中...' when 1 then '<font color=blue>审核通过' else '审核不通过' end as yn";
    }
        $_SESSION['mac']="select 0,0,b.fenlmc,q.shortname,a.fangj,a.yiti,convert(varchar(20),a.ksrq,120),a.zcr,'<a href=javascript:xq('+cast(a.id as varchar(10))+')><img border=0  src=im/select.gif></a>',a.jlr,
".$shenh.",'<a href=javascript:ed('+cast(a.id as varchar(10))+','+cast(a.yn as varchar(10))+')><img border=0 src=im/edit.gif alt=修改此行数据></a>' 
from sys_meet a,sys_meetlx b,sys_qiye q where a.lx=b.id and a.qyid=q.id ".$TJ." order by ".$px;
        //echo $_SESSION['mac'];
    if ($menuright==3){
        $_SESSION['mac'].="#"."10,0,0,0,0,0,0,0,0,0,0";
        $_SESSION['mac'].="#".",5%,9%,15%,20%,15%,10%,8%,6%,5%,7%";
    }else{
        $_SESSION['mac'].="#"."11,0,0,0,0,0,0,0,0,0,0,0";
        $_SESSION['mac'].="#".",3%,8%,12%,20%,13%,10%,7%,7%,7%,7%,6%";
    }
        $_SESSION['mac'].="#".",center,center,center,center,center,left,left,center,center,center,center";
        $_SESSION['mac'].="#".",序,会议类型,发起企业,会议地点,会议议题,开始时间,主持人,会议纪要,记录人,状态,修改";
        $_SESSION['mac'].="#会议纪要";
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

    function sh(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        window.Frm.shid.value=id;
        window.Frm.submit();
    }
    function ed(id,yn)
    {
        if(yn==1)
       //{layer.msg('已审核通过会议不能修改,如需修改请取消审核后再修改!');return false;}
        {layer.msg('已审核通过会议不能修改,如需修改请取消审核后再修改!',{shade:false});}
        else{
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("会议预定--修改会议资料","<?php echo $xiam;?>Edit.php?eid="+id,"780","680","parent");//最后一个是给标识符  需要父级打开就给  不然就空
            }
    }
</script>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>
