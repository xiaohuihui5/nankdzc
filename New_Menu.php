<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<html>
<head>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<link rel="stylesheet" href="./inc/iconfont.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<?php
$tit='ϵͳ�˵�����';
$lur='';
$lnk='<span class="r"><a href="javascript:add()" class="btn btn-primary radius"><IMG border=0 src=im/add.gif>�����˵�</a></span>';
$cha='';
$lie=',��,�˵�����,���ӵ�ַ,����˵��,��,����,��ѯ,¼��,���,��,��,�޸�,״̬';
$wid=',4%,20%,25%,17%,6%,4%,4%,4%,4%,2%,2%,4%,4%';
$tis='���˵�Ϊ���˵�ʱ�����ӵ�ַ��գ��˵���ξ������������(2)��!����ѯ��¼�롢��ˡ�ָ���Ǳ��˵��ɷ�����û���Ȩ�ޡ�';
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 

<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<script>
function add(){
	layer_show("��Ӳ˵�","<?php echo $xiam;?>Add.php","800","600"); //���һ�������Ǹ�һ����ʶ�� 
}
</script>
