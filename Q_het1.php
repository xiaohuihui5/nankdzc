<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query="delete sys_het where id=".$_POST['delrow'];
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
    <input type="hidden" name="zhuangt" value="<?php echo isset($_POST['zhuangt'])?$_POST['zhuangt']:"";?>">
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
    <?php
    $TJ="";
    if(isset($_POST['dt1']) and $_POST['dt1']!="")
    {
        $TJ.=" and ht.qsrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
    }
    else
        $TJ.=" and a.qsrq between '".date('Y-m-d')."' and '".date('Y-m-d ',strtotime("+1 day"))."' ";

    if(isset($_POST['typea']) && $_POST['typea']!="")//有效期
        $TJ.=" and ht.typea=".$_POST['typea'];
    if(isset($_POST['zt']) && $_POST['zt']==1)//有效期
        $TJ.=" and '".date('Y-m-d')."'<=jsrq and ht.yn<>0 ";
    else if(isset($_POST['zt']) && $_POST['zt']==2)//终止
        $TJ.=" and ht.yn=0 ";
    else if(isset($_POST['zt']) && $_POST['zt']==3)//结束
        $TJ.=" and '".date('Y-m-d')."'>jsrq and ht.yn<>0 ";
    if(isset($_POST['cxtj']) && $_POST['cxtj']<>"")
        $TJ.=" and (f.fenlmc+ht.mingc+ht.usercode+qy.shortname+ht.lianxr+ht.qdy like '%".$_POST['cxtj']."%')";
    if(isset($_POST['paix']) and $_POST['paix']!="")//排序
        $px=$_POST['paix'];
    else
        $px="ht.usercode";
    $_SESSION['mac']="select 0,0,f.fenlmc,ht.usercode,ht.mingc,qy.shortname,ht.gys,ht.zuj,ht.lianxr,ht.lianxdh,convert(varchar(10),ht.qsrq,120),
convert(varchar(10),ht.jsrq,120),convert(varchar(10),ht.qdrq,120),case ht.yn when 2 then '终止' else case when datediff(day,getdate(),ht.jsrq)<0 then '结束' else '有效' end end,'<a href=javascript:xq('+cast(ht.id as varchar(10))+')><img border=0  src=im/select.gif></a>','<a href=javascript:tix('+cast(ht.id as varchar(10))+',0)><img border=0 src=im/tixi.jpg alt=财务提醒></a>' from sys_het ht,sys_hetfenl f,sys_qiye qy where qy.id=ht.unit and ht.typea=f.id ".$TJ." order by ".$px;
    // echo $_SESSION['mac'];
    $_SESSION['mac'].="#"."15,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
    $_SESSION['mac'].="#".",4%,8%,6%,10%,10%,8%,5%,7%,8%,7%,7%,7%,5%,4%,4%";
    $_SESSION['mac'].="#".",center,center,left,left,left,center,center,center,left,right,center,center,center,center,center";
    $_SESSION['mac'].="#".",序,合同分类,编号,合同名称,合作企业,合作单位,合同金额,对方联系人,联系电话,起始日期,结束日期,签订日期,状态,详情,财务提醒";
    $_SESSION['mac'].="#客户合同资料";
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
        layer_show3("合同资料管理--合同明细","<?php echo $xiam;?>Xiangq.php?eid="+id,"770","720","parent");
    }
    function tix(id) {
        window.Frm.scroll.value=document.body.scrollTop;
        layer_show3("财务提醒","<?php echo $xiam;?>Tix.php?het_id="+id,"820","680","parent");
    }
</script>
<script type="text/javascript" defer="defer">setscroll()</script>
<script type="text/javascript" defer="defer">closeload()</script>
