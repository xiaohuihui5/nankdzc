<?php include("inc/xhead.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="jquery/jquery.treeview.css" />
<link rel="stylesheet" href="jquery/screen.css" />
<script src="jquery/lib/jquery.js" type="text/javascript"></script>
<script src="jquery/lib/jquery.cookie.js" type="text/javascript"></script>
<script src="jquery/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery/demo.js"></script>
<style type='text/css'>
body{
	background:#FFffff;
}
a {
	color: #000000;
	text-decoration:none;
}
</style>
</head>
<body leftmargin="0" topmargin="0">
	<ul id="browser" class="filetree">
<?php
	$query="select a.menuid,a.layer,a.title,a.url,a.target from sys_menu a where a.display=1 order by a.topmenuid";
	$result=sqlsrv_query($conn,$query);
	$up_layer=-1;
	while($line=sqlsrv_fetch_array($result))
	{
		if($line[1]<$up_layer)
		{
			echo '</ul></li>';
			$up_layer=$up_layer-1;
		}
		if($line[1]<$up_layer)
		{
			echo '</ul></li>';
			$up_layer=$up_layer-1;
		}
		if($line[1]<$up_layer)
		{
			echo '</ul></li>';
			$up_layer=$up_layer-1;
		}
		if($line[3]=='')//菜单
		{
			if($line[4]=='')
				echo '<li class="closed"><span class="folder">',$line[2],'</span><ul>';
			else
				echo '<li class="folder"><span class="folder">',$line[2],'</span><ul>';
		}
		else
		{
			echo '<li><span class="file"><a href="New_RightSet2.php?menuid=',$line[0],'" target="mainframe">',$line[2],'</a></span></li>';
		}
	$up_layer=$line[1];
	}
?>
	</ul>
	</li>
</ul>
</body>
</html>
