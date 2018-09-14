<?php
session_start();header('Cache-Control: no-cache, must-revalidate');header('Pragma: no-cache');header('Content-Type:text/html;charset=GB2312');
require('./inc/xc_c.php');
$kehid=$_SESSION['unitid'];
$query="select shortname,typef,typea from sys_unit where id=".$kehid;
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
	$kehmc=$line[0];$mos=$line[1];$kehflid=$line[2];//客户信息
sqlsrv_free_stmt($result);
$sell_rq=date('Y-m-d',strtotime("+1 day"));//下单日期
////////////////////////////价格,经营模式价格36,客户分类价格35,按客户价格33,客户特价31
$cp_id="0";
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=36 and a.unitid=".$mos." and '".$sell_rq."' between a.brq and a.erq";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//36
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix=35 and a.unitid=".$kehflid." and '".$sell_rq."' between a.brq and a.erq";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//35
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
$query="select cpid,b.sellprice from sys_selljg a,sys_selljgsj b where a.id=b.dhid and a.leix in(31,33) and a.unitid=".$kehid." and '".$sell_rq."' between a.brq and a.erq order by a.leix desc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))//33,31
{
	$jg[$line[0]]=$line[1];
	$cp_id.=",".$line[0];
}       
sqlsrv_free_stmt($result);
/////////////////////////////价格
//常用
$query="select cpid from weix_changy where useid=".$kehid;
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
	$cy[$line[0]]=1;
sqlsrv_free_stmt($result);
//常用
if(isset($_POST['dfl']))//点击大分类名称
{	
	$str='';//ajax返回的内容
	$query="select id,fenlmc from sys_cpxiaofl where dafl=".$_POST['dfl']." and yn=1 and id in(select xiaofl from sys_cp where id in(".$cp_id.")) order by id";
	$result=sqlsrv_query($conn,$query);
	$first_xfl=0;
	while($line=sqlsrv_fetch_array($result))
	{
		if($str=='')
		{
			$first_xfl=$line[0];//存第一个小分类id
			$str.='<li class="cp active" id="x'.$line[0].'" uid="'.$line[0].'" btn-type="class2">'.$line[1].'</li>';
		}
		else 
			$str.='<li class="cp " id="x'.$line[0].'" uid="'.$line[0].'" btn-type="class2">'.$line[1].'</li>';
	}
	sqlsrv_free_stmt($result);
	$str.='@@@';//分割符号
	$query="select id,mc,dw,gg from sys_cp where xiaofl=".$first_xfl." and yn=1 and id in(".$cp_id.")  order by bh";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
	if(isset($cy[$line[0]])) $changy='clicked'; else $changy='';//常用
	$str.='<tr data-goodsid="'.$line[0].'">
                        <td>
                            <span class="js-c-name" id="n'.$line[0].'">'.$line[1].'</span>
                            <a class="ml5 font16 js-favorite '.$changy.'" starid="'.$line[0].'"></a>
                            <br>
                            <span class="js-subject" id="s'.$line[0].'">'.$line[3].'</span>
                            <br>
                            <span class="js-price-ref" name="user_type_item" tag="price_info"><span class="price" id="p'.$line[0].'">￥'.$jg[$line[0]].'元/'.$line[2].'</span></span>
                        </td>
                        <td class="v-m js-pic-wrapper">
                            <div class="ml10 product-img-wrapper" img_src_id="'.$line[0].'"><img src="./js/296.png"></div>
                            <div name="user_type_item">
                                <div class="js-ctl-warp" goodsid="'.$line[0].'" price="'.$jg[$line[0]].'">
                                    <div class="js-minus cp font20" goodsop="-">－</div>
                                    <input class="js-count tc" value="0" goodsopid="_'.$line[0].'" type="number">
                                    <div class="js-plus cp font20" goodsop="+">＋</div>
                                </div>
                            </div>
                        </td>
                    </tr>';
	}
	sqlsrv_free_stmt($result);
	echo $str;
}
else if(isset($_POST['xfl']))//点击小分类名称
{
	$str='';//ajax返回的内容
	$query="select id,mc,dw,gg from sys_cp where xiaofl=".$_POST['xfl']." and yn=1 and id in(".$cp_id.") order by bh";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
	if(isset($cy[$line[0]])) $changy='clicked'; else $changy='';//常用
	$str.='<tr data-goodsid="'.$line[0].'">
                        <td>
                            <span class="js-c-name" id="n'.$line[0].'">'.$line[1].'</span>
                            <a class="ml5 font16 js-favorite '.$changy.'" starid="'.$line[0].'"></a>
                            <br>
                            <span class="js-subject" id="s'.$line[0].'">'.$line[3].'</span>
                            <br>
                            <span class="js-price-ref" name="user_type_item" tag="price_info"><span class="price" id="p'.$line[0].'">￥'.$jg[$line[0]].'元/'.$line[2].'</span></span>
                        </td>
                        <td class="v-m js-pic-wrapper">
                            <div class="ml10 product-img-wrapper" img_src_id="'.$line[0].'"><img src="./js/296.png"></div>
                            <div name="user_type_item">
                                <div class="js-ctl-warp" goodsid="'.$line[0].'" price="'.$jg[$line[0]].'">
                                    <div class="js-minus cp font20" goodsop="-">－</div>
                                    <input class="js-count tc" value="0" goodsopid="_'.$line[0].'" type="number">
                                    <div class="js-plus cp font20" goodsop="+">＋</div>
                                </div>
                            </div>
                        </td>
                    </tr>';
	}
	sqlsrv_free_stmt($result);
	echo $str;
}
?>
