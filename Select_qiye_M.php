<?php
require('./inc/xhead.php');
$xiam=current(explode('.',end(explode('/',$_SERVER['PHP_SELF'])))).'1.php';
$tit="��ҵѡȡ";
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
                            <option value="" style="text-align: center;">��ҵ����ѡȡ</option>
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
                        <input class="input-text" id="cxtj"  tabindex="1" name="cxtj"  onkeydown="if(event.keyCode==13) ListLeft()" style="width: 180px;font-family: ΢���ź�; font-size: 12px; line-height: 15px;border: 1px #000000 solid">
                        <input class="btn btn-primary radius" type="button" value="����" onclick="ListLeft()" style="width: 50px;">
                    </td>
                </tr>
                <tr>
                    <td align=center>
                        ��ѡ�б�<br>
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
            <a href="javascript:LtoR_S()" title="�����ѡ�е�����"><b>>></b></a>
            <br>
            <br>
            <a href="JavaScript:LtoR_M()" title="������б�ȫ������"><b>>>></b></a>
            <br>
            <br>
            <br>
            <br>
            <br>
            <a href="JavaScript:RtoL_S()" title="���ұ�ѡ�е�����"><b><<</b></a>
            <br>
            <br>
            <a href="JavaScript:RtoL_M()" title="���ұ��б�ȫ������"><b><<<</b></a>
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
        <td colspan="3"><div class="tishi">&nbsp;&nbsp;&nbsp;<font color=#696969><b>>></b>�����ѡ������,<b>>>></b>�����ȫ������,�ɰ�סCtrl����ѡ</div></td>
    </tr>
    <tr>
        <td align=center colspan="3">
            <div class="sos">
                <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="SelOk()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
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
        CreateSelect("<?php echo $xiam;?>",cwho,"selid="+IdStr+"&cxtj="+document.getElementById('cxtj').value+"&dafl="+document.getElementById('dafl').value);//��һ��������ajaxȡֵ��phpҳ��ϵͳ�Զ����,�ڶ�������Ϊ0��ʾ��ʾ���ѡ���,Ϊ1��ʾ�ұ�Ϊ2���Ҷ���ʾ,����������Ϊ�ύ�Ĳ�ѯ����
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

        if(s_id=="") s_name="��ҵѡȡ";
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
