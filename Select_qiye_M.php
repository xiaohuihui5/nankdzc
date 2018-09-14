<?php
require('./inc/xhead.php');
$xiam=current(explode('.',end(explode('/',$_SERVER['PHP_SELF'])))).'1.php';
$tit="企业选取";
?>
<html>
<head>
    <title><?php echo $tit;?></title>
    <link rel="stylesheet" href="./inc/xup.css" type="text/css">
    <link rel="stylesheet" href="./inc/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <script language="javascript" src="./inc/xSelectajax.js" type="text/javascript" charset="GB2312"></script>
</head>
<body margin="0" style="width:100%; height:380;">
<table align="center" style="width:100%; height:400;position:absolute" cellspacing="0" cellpadding="0" border="0">
    <tr><td height="25" colspan="3" align=center><b><font color=red><?php echo $tit;?></b></td></tr>
    <tr>
        <td width="49%" height="100%">
            <table style="width:100%; height:100%;" cellSpacing="0" cellPadding="0" border="0" class="table1">
                <tr>
                    <td align=center>
                        <select class="select" style="height:30px;width:250px;" id="dafl" name="dafl" onchange="ListLeft()">
                            <option value="" style="text-align: center;">企业类型选取</option>
                            <?php
                            $query="select id,fenlmc from sys_qiyefenl where yn=1 order by fenlmc";
                            $result=sqlsrv_query($conn,$query);
                            while($line=sqlsrv_fetch_array($result))
                            {
                                echo '<option value="',$line[0],'">',$line[1],'</option>';
                            }
                            sqlsrv_free_stmt($result);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align=center>
                        <input class="input-text" id="cxtj"  tabindex="1" name="cxtj"  onkeydown="if(event.keyCode==13) ListLeft()" style="width: 180px;font-family: 微软雅黑; font-size: 12px; line-height: 15px;border: 1px #000000 solid">
                        <input class="btn btn-primary radius" type="button" value="搜索" onclick="ListLeft()" style="width: 50px;">
                    </td>
                </tr>
                <tr>
                    <td align=center>
                        待选列表<br>
                        <select style="width:200px;height:260px" name="fromBox" onDblClick="LtoR_S()" id="fromBox" size="18" multiple="multiple">
                            <?php
                            $query="select top 200 qy.id,qy.usercode+'_'+qy.shortname from sys_qiye qy where qy.yn=1 order by qy.usercode,qy.shortname";
                            $result=sqlsrv_query($conn,$query);
                            while($line=sqlsrv_fetch_array($result))
                            {
                                echo '<option value="',$line[0],'">',$line[1],'</option>';
                            }
                            sqlsrv_free_stmt($result);
                            ?></select>
                    </td>
                </tr>
            </table>
        </td>
        <td width="2%" height="100%" align="center">
            <a href="javascript:LtoR_S()" title="将左边选中的右移"><b>>></b></a>
            <br>
            <br>
            <a href="JavaScript:LtoR_M()" title="将左边列表全部右移"><b>>>></b></a>
            <br>
            <br>
            <br>
            <br>
            <br>
            <a href="JavaScript:RtoL_S()" title="将右边选中的左移"><b><<</b></a>
            <br>
            <br>
            <a href="JavaScript:RtoL_M()" title="将右边列表全部左移"><b><<<</b></a>
        </td>
        <td width="49%" height="100%">
            <table style="width:100%; height:100%;" cellSpacing="0" cellPadding="0" border="0" class="table3">
                <tr><td align=center>
                        <select style="width:200px;height:98%;" name="toBox" onDblClick="RtoL_S()" id="toBox" size="12" multiple="multiple">
                        </select>
                    </td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3"><div class="tishi">&nbsp;&nbsp;&nbsp;<font color=#696969><b>>></b>将左边选中右移,<b>>>></b>将左边全部右移,可按住Ctrl键多选</div></td>
    </tr>
    <tr>
        <td align=center colspan="3">
            <div class="sos">
                <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="SelOk()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
            </div>
        </td>
    </tr>
</table>
</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript">
    function DisSelect(IdStr,cwho)
    {
        CreateSelect("<?php echo $xiam;?>",cwho,"selid="+IdStr+"&cxtj="+document.getElementById('cxtj').value+"&dafl="+document.getElementById('dafl').value);//第一个参数是ajax取值的php页面系统自动填好,第二个参数为0表示显示左边选择框,为1显示右边为2左右都显示,第三个参数为提交的查询条件
    }
    function SelOk()
    {
        var s_id="";
        var s_name="";
        for(var num=0;num<document.getElementById('toBox').length;num++)
            if(s_id=="")
            {
                s_id=document.getElementById('toBox').options[num].value;
                s_name=document.getElementById('toBox').options[num].text;
            }
            else
            {
                s_id=s_id+","+document.getElementById('toBox').options[num].value;
                s_name=s_name+","+document.getElementById('toBox').options[num].text;
            }

        if(s_id=="") s_name="企业选取";
        parent.Frm.qyid.value=s_id;
        parent.Frm.qymc.value=s_name;
        parent.Frm.qymc.title=s_name;
        parent.layer.closeAll();
    }
    function exit()
    {
        parent.layer.closeAll();
    }
    window.cxtj.focus();
</script>
