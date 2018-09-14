<?php
include ("../jpgraph/jpgraph.php");
include ("../jpgraph/jpgraph_line.php");
include ("../jpgraph/jpgraph_error.php");
require('../inc/xhead.php');
$query="select rq,jine from(select top 7 right(convert(varchar(10),dhrq,120),5) as rq,cast(sum(jine)/sum(zhongl) as decimal(10,2)) as jine from sys_maoz group by dhrq order by dhrq desc)a order by rq";
$result=sqlsrv_query($conn,$query);
$i=0;
while($line=sqlsrv_fetch_array($result))
{
	$datay[]=$line[1];
	if ($i==0)
		$datax[]=$line[0];
	else
		$datax[]=substr($line[0],3,2);
	$i++;
	$tmp=$line[0];
}
$datax[$i-1]=$tmp;       
sqlsrv_free_stmt($result);
//$datax = array('05-03','04:05','05:11','11:24','23:22','01:44','05:54','04:45');
//$datay = array(1.23,1.98,1.6,3.1,3.4,2.8,2.1,1.95);
$graph = new Graph(280,250,"auto");
$graph->img->SetMargin(39,10,10,50);	
$graph->img->SetAntiAliasing();
$graph->SetScale("textlin");
//
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetLabelAngle(90);
$graph->xaxis->SetColor('darkblue','black');
//
$graph->SetShadow();
//$graph->title->Set("Example of filled line centered plot");
//$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new LinePlot($datay);
//$p1->SetFillColor("yellow");
$p1->mark->SetType(MARK_FILLEDCIRCLE);
//$p1->mark->SetFillColor("red");
//$p1->mark->SetWidth(4);

$p1->value->SetFormat('%0.2f'); //格式化数据
$p1->value->Show();          //输出阴影
$p1->value->SetColor('red');       //定义颜色
//$p1->value->SetMargin(14);         //设置位置、字体大小
//$p1->SetCenter();

$p1->SetColor("blue");
$p1->SetCenter();
$graph->Add($p1);
$graph->Stroke();
?>
