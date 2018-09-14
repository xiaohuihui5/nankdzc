<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
    $query="delete sys_tix where id=".$_POST['delrow'];
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

    <?php
    $_SESSION['mac']="select 0,0,h.mingc,convert(varchar(10),t.tix_date,120),t.tix_neir,'<a href=javascript:del('+cast(t.id as varchar(10))+',0)><img border=0 src=im/delete.gif alt=删除此行数据></a>' from sys_tix t,sys_het h where t.het_id=h.id order by h.mingc";
    //echo $_SESSION['mac'];
    $_SESSION['mac'].="#"."5,0,0,0,0,0";
    $_SESSION['mac'].="#".",8%,20%,14%,40%,8%";
    $_SESSION['mac'].="#".",center,center,center,center,center";
    $_SESSION['mac'].="#".",序,合同名称,提醒日期,提醒事项,删除";
    $_SESSION['mac'].="#财务提醒";
    $_SESSION['mac'].="#";
    $_SESSION['mac'].="#";
    include("./inc/xNoCountdis.php");
    ?>
</form>
</body>
<script>
    function del(id)
    {
        if(window.Frm.edtrow.value==0)
        {
            parent.layer.confirm('删除后此条数据将不复存在,您确定要删除此行吗?',{
                btn:["确定","取消"],
                shade:0.2,
                yes:function(){
                    window.Frm.scroll.value=document.body.scrollTop;
                    window.Frm.delrow.value=id;
                    window.Frm.edtrow.value=0;
                    parent.layer.closeAll();
                    window.Frm.submit();
                },
                btn2:function(){
                    window.layer.msg('用户中途取消,此次操作失败!', {icon:2,time:1500});
                }
            });
        }
    }

</script>

