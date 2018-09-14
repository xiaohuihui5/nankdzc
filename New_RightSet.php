<?php
	require('./inc/xhead.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="inc/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>深圳市中用软件科技有限公司</title>
</head>
<body>
<aside class="Hui-aside" style="top:0px;background:#d5f3ff;">
	<div class="menu_dropdown bk_2">
		<?php include('nav1.php');?>
	</div>
</aside>
<section class="Hui-article-box" style="margin-top:-32px;top:0px;">
	<div id="iframe_box" class="Hui-article" >
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="New_RightSet2.php?menuid=2" id="iframe1"></iframe>
		</div>
	</div>
</section>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin1.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
function href_data(url){
	$('#iframe1').attr("src","New_RightSet2.php?menuid="+url+"");
}
!function($) {
	$.fn.Huifold = function(options){
		var defaults = {
			titCell:'.item .Huifold-header',
			mainCell:'.item .Huifold-body',
			type:3,//1	只打开一个，可以全部关闭;2	必须有一个打开;3	可打开多个
			trigger:'click',
			className:"selected",
			speed:'first',
		}
		var options = $.extend(defaults, options);
		this.each(function(){	
			var that = $(this);
			that.find(options.titCell).on(options.trigger,function(){
				if ($(this).next().is(":visible")) {
					if (options.type == 2) {
						return false;
					} else {
						$(this).next().slideUp(options.speed).end().removeClass(options.className);
						if ($(this).find("b")) {
							$(this).find("b").html("+");
						}
					}
				}else {
					if (options.type == 3) {
						$(this).next().slideDown(options.speed).end().addClass(options.className);
						if ($(this).find("b")) {
							$(this).find("b").html("-");
						}
					} else {
						that.find(options.mainCell).slideUp(options.speed);
						that.find(options.titCell).removeClass(options.className);
						if (that.find(options.titCell).find("b")) {
							that.find(options.titCell).find("b").html("+");
						}
						$(this).next().slideDown(options.speed).end().addClass(options.className);
						if ($(this).find("b")) {
							$(this).find("b").html("-");
						}
					}
				}
			});
			
		});
	}
} (window.jQuery);
</script> 
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>
