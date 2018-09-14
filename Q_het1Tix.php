<?php
require ('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['het_id']) || $_POST['het_id']!="")
{
    $query="insert into sys_tix(het_id,tix_date,tix_neir) values(".$_POST['het_id'].",'".$_POST['tix_date']."','".$_POST['tix_neir']."')";
    //echo $query;die;
    require("./inc/xexec.php");
}
?>
<html>
<head>
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
</head>
<body>
<form action="" method="post" name="forml">
    <div style="margin:25px;font-size: 15px">
        <input name="het_id" value="<?php echo $_GET['het_id'];?>" type="hidden">
        提醒日期：<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" ocus="WdatePicker()" name="tix_date" id="tix_date" class="input-text Wdate" style="width:100px;height: 30px;" value="<?php echo date('Y-m-d');?>"/>
        &nbsp;&nbsp;<font color="red">提醒事项：</font><input type="text" name="tix_neir" id="tix_neir" style="height: 30px;width: 50%;">
        &nbsp;&nbsp;<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;增加&nbsp;&nbsp;" onclick="sub();">
    </div></form>
<?php
$tit='';
$lur='';
$lnk='';
$cha='';
$lie=',序,合同名称,提醒日期,提醒事项,删除';
$wid=',8%,20%,14%,40%,8%';
$tis='';
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script lanuage ="javascript">
    function sub()
    {
        if($("input[name=tix_neir]").val()=="" || $("input[name=tix_neir]").val()==null)
        {
            parent.layer.msg('提醒事项不能为空哦！', {icon:2,time:1500});
            return false;
        }
        else
        {
            window.forml.submit();
            window.forml.reset();
        }
    }

</script>
