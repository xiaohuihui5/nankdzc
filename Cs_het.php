<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
    <link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script language="javascript" src="./inc/xmy.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="inc/rank.js"></script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
//$menuright=menuright(87);//取得菜单权限
$tit='合同管理 <span class="c-gray en">&gt;</span> 合同资料管理';
$lur='<input name="setsh" type="hidden" value="100"><div class="text-c">日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<select class="select-box" style="width:80px;height:31px;text-align:center;" name="zt"><option value="">--状态--</option><option value="1">有效</option><option value="2">终止</option><option value="3">结束</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入关键字模糊搜索" id="cxtj"  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_het.php"  class="btn radius"><img border=0 src=im/zhuy.png> 合同管理</a> <a href="Cs_hetfenl.php"  class="btn radius"> 合同分类管理</a> </span> ';
$lnk.='<span class="r">';
//if($menuright>1)//录入
$lnk.='<a href="javascript:;" onclick="Add(\'合同管理--新增合同\',\''.$xiam.'Add.php\',\'650\',\'700\')" class="btn radius"><img border=0 src=im/add.png> 新增合同</a>';
$lnk.='<a href="xExcel_het.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',序,合同分类,编号,合同名称,合作企业,合作单位,合同金额,对方联系人,联系电话,起始日期,结束日期,签订日期,状态,财务提醒,详,改,删';
$wid=',3%,7%,6%,9%,9%,7%,5%,6%,7%,7%,7%,7%,4%,4%,4%,4%,4%';
$tis='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>';
$xuh=',2,3,4,5,6,7,8,9,10,11,12,13,14,15';
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
</script>
