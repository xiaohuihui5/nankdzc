<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$kehid=$_SESSION['unitid'];
$query="select shortname,typef,typea from sys_unit where id=".$kehid;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$kehmc=$line[0];$mos=$line[1];$kehflid=$line[2];//�ͻ���Ϣ
sqlsrv_free_stmt($result);
$sell_rq=date('Y-m-d',strtotime("+1 day"));//�µ�����
$id=explode(",",$_POST['prod_ids']);//ȡ�ô�������id��������
$sl=explode(",",$_POST['prod_num']);
for($i=0;$i<count($id);$i++)
	$pos[$id[$i]]=$i;
////////////////////////////�۸�,��Ӫģʽ�۸�36,�ͻ�����۸�35,���ͻ��۸�33,�ͻ��ؼ�31
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=36 and a.unitid=".$mos." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].")";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//36
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=35 and a.unitid=".$kehflid." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].")";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//35
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix in(31,33) and a.unitid=".$kehid." and '".$sell_rq."' between a.brq and a.erq and b.cpid in(".$_POST['prod_ids'].") order by a.leix desc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//33,31
{
	$jg[$line[0]]=$line[1];
}       
sqlsrv_free_stmt($result);
/////////////////////////////�۸�
?>
<!DOCTYPE html>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $kehmc;?></title>
    <link rel="stylesheet" type="text/css" href="./js/reset.css">
    <link rel="stylesheet" type="text/css" href="./js/demo.css">
    <link rel="stylesheet" type="text/css" href="./js/mktstyle.css">
    <link rel="stylesheet" type="text/css" href="./js/detail1.css">
    <link rel="stylesheet" type="text/css" href="./js/order_checkout.css">
</head>
<body>
    <header class="s-header">
        <nav>
            <h1>�����ύ</h1>
            <a class="back" id="btn_back">����</a>
        </nav>
    </header>
    <br><br><br>
    <form name="cFM" id="cFM" method="post" action="I_Add.php">
    <div class="lay_page page_order current">
        <div class="lay_page_wrap">
            <div class="mod_cell ui_p10">
                <span class="mod_select_title">��ע˵����</span>
                <div class="qb_flex">
                    <div class="mod_select input_block flex_box">
                        <textarea id="particular" name="beiz" class="special-demand" type="text" placeholder="ѡ�������д��������˵��"></textarea>
                    </div>
                </div>
            </div>

            <div class="mod_cell ui_p10" id="div_act_msg" style="display: none;">
            </div>

            <div class="mod_cell_hr"></div>
            <div class="mod_cell" style="padding-bottom:0;">
                <div class="mod_celltitle">���µ���Ʒ����</div>
                <ul class="mod_list" id="tpl_checkout_cart_list">
<?php
$query="select cp.id,cp.mc,cp.dw,cp.gg from sys_cp cp where id in(".$_POST['prod_ids'].") order by cp.bh";
$result=sqlsrv_query($conn,$query);
$row=0;$je=0;
while($line=sqlsrv_fetch_array($result))
{
	if($sl[$pos[$line[0]]]!=0)
	{
	$row+=1;
	echo '<li class="list_item" style="display: -webkit-box;">
                        <div class="order-form-menu-img">
                            <img class="tpl-stuff-image" src="./js/296.png">
                        </div>
                        <div class="bfc_c order-list-detail order-detail">
                            <p>',$line[1],'</p>
                            <p class="qb_fs_s ui_color_weak">&nbsp;&nbsp;',$line[3],'</p>
                            <p class="qb_fs_s ui_color_weak"><strong class="mod_color_strong order-blue">��',$jg[$line[0]],'/',$line[2],'  </strong> </p>
                        </div>
                        <div class="fresh-counter" opid="_109">
                            <div class="js-ctl-warp" goodsid="',$line[0],'"  price="',$jg[$line[0]],'">
                                <a class="js-minus cp font20" goodsop="-">��</a>
                                <input name="s',$row,'" type="number" class="js-count tc" value="',$sl[$pos[$line[0]]],'" goodsopid="_',$line[0],'">
                                <input name="i',$row,'" type="hidden" value="',$line[0],'"><input name="j',$row,'" type="hidden" value="',$jg[$line[0]],'"><a class="js-plus cp font20" goodsop="+">��</a>
                            </div>
                        </div></li>';
	$je+=$sl[$pos[$line[0]]]*$jg[$line[0]];
	}
}       
sqlsrv_free_stmt($result);
	$xiaos=60*date('H')+date('i');//Сʱ*60+����,840-1380Ϊ2�㵽11��

	//ȡ���Ƿ��Ѿ��µ�
	$query="select count(*) from sys_jhdh where unit=".$kehid." and (laiy=2 or lx=2) and dhrq='".$sell_rq."'";
	$result=sqlsrv_query($conn,$query);
	$yi_xiad=0;
	$line=sqlsrv_fetch_array($result);
		$yi_xiad=$line[0];
	sqlsrv_free_stmt($result);
	//ȡ���Ƿ��Ѿ��µ�
?>
                </ul>
                <div class="ui_mb10 ui_mt10 webkit-box">
                    <div class="flex1 ui_align_right">��Ʒ������<input name="row" type="hidden" value="<?php echo $row;?>"></div>
                    <div class="mod_color_strong w50">
                        <span class="total-price order-black" id="cart_goods_num"><?php echo $row;?></span>
                    </div>
                </div>
                <div class="ui_mb10 ui_mt10 webkit-box" id="">
                    <p class="ui_align_right">
                    </p><div class="flex1 ui_align_right">��</div>
                    <div class="mod_color_strong w50">
                        <span class="total-price order-red" id="cart_total_price">��<?php echo $je;?></span>
                    </div>
                    <p></p>
                </div>
            </div>

            <div class="ui_gap ui-gap-bottom-s">
                <div class="b-btn-wrapper">
                    <a class="mod_btn btn_strong btn_block btn-orange" id="btn_shopping">�����µ�</a>
                </div>
               <div class="b-btn-wrapper" style="margin-left:10%;"> 
                <a class="mod_btn btn_strong btn_block btn-blue" id="btn_order_submit">�ύ����</a>
               </div>
            </div>
        </div>
    </div>
   </form>
<script src="./js/zepto.min.js" type="text/javascript"></script>
<script>
var cartid='m_5';</script>
<script src="./js/common.js?i=1" type="text/javascript"></script>
</body></html>
<script>
var shij=<?php echo $xiaos;?>;
var has_xd=<?php echo $yi_xiad;?>;
var tims=0;//��ֹ��2���ύ
var cps=<?php echo $row;?>;//�µ���Ʒ��
$('#btn_shopping').click(function(){
 window.location.href="I_Xiad.php";
});
$('#btn_order_submit').click(function(){
	if(cps==0)
		alert('��ѡ��ò�Ʒ�����ύ��!');
	else if(shij<540 && tims==0)
		alert('����ÿ������9��������12��֮���µ�!');
	else if(has_xd>0 && tims==0)
	{
		if(confirm('�˿ͻ��������µ�,��ȷ��Ҫ�ظ�������?'))
		{
		tims=1;
		localStorage.clear();
		$("#cFM").submit();
		}
	}
	else if(tims==0)
	{
	tims=1;
	localStorage.clear();
	///var ids='';
	///var djs='';
	//var sls='';
	//for(id=1;id<=<?php echo $row;?>;id++)
	//if($('#s'+id).val()!=0 && $('#s'+id).val()!='')
	//{
	//	
	//}
	//
	//alert('�ύ�ɹ�!');
	$("#cFM").submit();
	}
});
</script>
