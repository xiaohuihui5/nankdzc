<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query='update sys_qiye set yn=yn^1 where id='.$_POST['delrow'];
    include('./inc/xexec.php');
}
?>
<head>
    <link rel="stylesheet" href="./inc/xdown.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<form action="" method=post name="Frm">
    <input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
    <input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
    <input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
    <input type="hidden" name="delrow" value="0">
    <input type="hidden" name="edtrow" value="0">

    <?php
    if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
        $TJ.=" and (q.shortname like '%".$_POST['cxtj']."%' or q.piny like '%".$_POST['cxtj']."%') ";
    if(isset($_POST['paix']) and $_POST['paix']!="")
        $px=$_POST['paix'];
    else
        $px.=" q.usercode";
    $_SESSION['mac']="select 0,0,a.fenlmc,q.usercode,q.shortname,q.xydm,convert(varchar(10),q.clsj,120),q.zczb,q.fuzy,q.phone,q.fr,q.zjl,q.js,q.dsh,q.cd,'<a href=javascript:gud('+cast(q.id as varchar(10))+')><img border=0 src=im/gud.png></a>','<a href=javascript:xq('+cast(q.id as varchar(10))+')><img border=0 src=im/select.gif></a>',case q.yn when 0 then '<a href=javascript:yn('+cast(q.id as varchar(10))+')><font color=gray>停用</a>' else '<a href=javascript:yn('+cast(q.id as varchar(10))+')>启用</a>' end,
'<a href=javascript:ed('+cast(q.id as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' from sys_qiye q,sys_qiyefenl a where q.lx=a.id ".$TJ." order by ".$px;
  //echo $_SESSION['mac'];
    $_SESSION['mac'].="#"."18,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
    $_SESSION['mac'].="#".",5%,7%,5%,10%,8%,5%,6%,4%,8%,6%,4%,4%,7%,4%,4%,5%,4%,4%";
    $_SESSION['mac'].="#".",center,left,left,center,center,center,left,left,left,left,center,center,center,center,center,center,center,center,center,center,center,center";
    $_SESSION['mac'].="#".",序,企业类型,编号,企业名称,统一社会信用代码,成立时间,认缴额(万),联系人,联系电话,法人,总经理,监事,董事会,场地投入(m2),股东信息,公司简介,禁用,修改";
    $_SESSION['mac'].="#下属企业资料设置";
    $_SESSION['mac'].="#";
    $_SESSION['mac'].="#";
    include('./inc/xNoCountdis.php');
    ?>
</form>
</body>
<script language=javascript>
    function gud(id) {
        window.Frm.scroll.value=document.body.scrollTop;
        layer_show3("企业资料管理--股东信息","<?php echo $xiam;?>Gud.php?qyid="+id,"700","650","parent");//最后一个是给标识符  需要父级打开就给  不然就空
    }
    function xq(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("企业资料管理--公司简介","<?php echo $xiam;?>Xiangq.php?eid="+id,"700","650","parent");//最后一个是给标识符  需要父级打开就给  不然就空
    }
    function ed(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("企业资料管理--修改企业资料","<?php echo $xiam;?>Edit.php?eid="+id,"700","720","parent");//最后一个是给标识符  需要父级打开就给  不然就空
    }
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
