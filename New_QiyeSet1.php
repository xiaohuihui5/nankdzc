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
    $_SESSION['mac']="select 0,0,a.fenlmc,q.usercode,q.shortname,q.xydm,convert(varchar(10),q.clsj,120),q.zczb,q.fuzy,q.phone,q.fr,q.zjl,q.js,q.dsh,q.cd,'<a href=javascript:gud('+cast(q.id as varchar(10))+')><img border=0 src=im/gud.png></a>','<a href=javascript:xq('+cast(q.id as varchar(10))+')><img border=0 src=im/select.gif></a>',case q.yn when 0 then '<a href=javascript:yn('+cast(q.id as varchar(10))+')><font color=gray>ͣ��</a>' else '<a href=javascript:yn('+cast(q.id as varchar(10))+')>����</a>' end,
'<a href=javascript:ed('+cast(q.id as varchar(10))+')><img border=0 src=im/xiug.png alt=�޸Ĵ˵�></a>' from sys_qiye q,sys_qiyefenl a where q.lx=a.id ".$TJ." order by ".$px;
  //echo $_SESSION['mac'];
    $_SESSION['mac'].="#"."18,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
    $_SESSION['mac'].="#".",5%,7%,5%,10%,8%,5%,6%,4%,8%,6%,4%,4%,7%,4%,4%,5%,4%,4%";
    $_SESSION['mac'].="#".",center,left,left,center,center,center,left,left,left,left,center,center,center,center,center,center,center,center,center,center,center,center";
    $_SESSION['mac'].="#".",��,��ҵ����,���,��ҵ����,ͳһ������ô���,����ʱ��,�Ͻɶ�(��),��ϵ��,��ϵ�绰,����,�ܾ���,����,���»�,����Ͷ��(m2),�ɶ���Ϣ,��˾���,����,�޸�";
    $_SESSION['mac'].="#������ҵ��������";
    $_SESSION['mac'].="#";
    $_SESSION['mac'].="#";
    include('./inc/xNoCountdis.php');
    ?>
</form>
</body>
<script language=javascript>
    function gud(id) {
        window.Frm.scroll.value=document.body.scrollTop;
        layer_show3("��ҵ���Ϲ���--�ɶ���Ϣ","<?php echo $xiam;?>Gud.php?qyid="+id,"700","650","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
    }
    function xq(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("��ҵ���Ϲ���--��˾���","<?php echo $xiam;?>Xiangq.php?eid="+id,"700","650","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
    }
    function ed(id)
    {
        window.Frm.scroll.value=document.body.scrollTop;
        //window.Frm.submit();
        layer_show3("��ҵ���Ϲ���--�޸���ҵ����","<?php echo $xiam;?>Edit.php?eid="+id,"700","720","parent");//���һ���Ǹ���ʶ��  ��Ҫ�����򿪾͸�  ��Ȼ�Ϳ�
    }
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
