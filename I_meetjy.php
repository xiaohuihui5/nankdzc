<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 14:33
 */
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
    <link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="./lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="inc/rank.js"></script>
    <script language="javascript">
        var timesi=0;//window.event.clientX;此处两函数用于审核弹出下拉框
        function show(){
            document.getElementById("menu1").style.display="block";
            if(timesi==0){
                document.getElementById("menu1").style.left=document.getElementById("menu1").offsetLeft*1-70;timesi=1;}}

        function hide(){
            document.getElementById("menu1").style.display="none";}
    </script>
</head>
<body>
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(97);//取得菜单权限
$tit='会议信息录入 <span class="c-gray en">&gt;</span> 会议录入 ';
$lur='<input name="setsh" type="hidden" value="100"><div class="text-c">日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<select class="select-box" style="width:80px;height:31px;text-align:center;" name="zt"><option value="">--状态--</option><option value="0">审核中</option><option value="1">审核通过</option><option value="2">审核不通过</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入关键字模糊搜索" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="I_meetjy.php"  class="btn radius"><img border=0 src=im/zhuy.png> 会议管理</a> </span> ';
$lnk.='<span class="r">';
if($menuright==3){
    $lnk.='<div onMouseMove="show()" onMouseOut="hide()" class="btn radius" style="background:#ffffff;" >批量审核<br>
    <div id="menu1" style="position:absolute;display:none;width:130px;text-align:left;line-height:25px;background-color:#ffffff;border:1px solid #68AF7E">
     <a href="javascript:s_all(1)"><font color="#6495ed">会议审核通过</a><br>
     <a href="javascript:s_all(2)"><font color="#6495ed">会议审核不过</a>
    </div></div>';
}
if($menuright==2){
    $lnk.='<a href="javascript:;" onclick="Add(\'会议管理--新增会议\',\''.$xiam.'Add.php\',\'780\',\'680\')" class="btn radius"><img border=0 src=im/add.png> 新增会议</a>';
    $lnk.='<a href="xExcel_meet.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
}
$cha='';
if ($menuright==2){
$lie=',序,会议类型,发起企业,会议地点,会议议题,开始时间,主持人,会议纪要,记录人,状态,修改';
$wid=',3%,8%,12%,20%,13%,10%,7%,7%,7%,7%,6%';
}else{
    $lie=',序,会议类型,发起企业,会议地点,会议议题,开始时间,主持人,会议纪要,记录人,状态';
    $wid=',5%,9%,15%,20%,15%,10%,8%,6%,5%,7%';
}
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4,5,6,7,8,9';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
    function Add(title,url,w,h)
        {
        //window.hqlist.Frm.submit();
        layer_show2(title,url,w,h);//最后一个是给标识符  需要父级打开就给  不然就空
    }
    function s_all(zt)
    {
        if(confirm('您确定要将以下所列单进行批量审核或取消审核吗?'))
        {
            //alert(zt);
            window.Frm.setsh.value=zt;
            window.Frm.submit();
            window.Frm.setsh.value=100;
        }
        else alert('用户中途取消，本次审核取消!');
    }

</script>
