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
<title>��ӭ<?php echo $_SESSION['uname'];?>��½ҵ�����ϵͳ</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui��վ��̨ģ��,��̨ģ������,��̨����ϵͳģ��,HTML��̨ģ������">
<meta name="description" content="H-ui.admin v3.1����һ���ɹ��˿�������������ƽ����վ��̨ģ�壬��ȫ��ѿ�Դ����վ��̨����ϵͳģ�棬�ʺ���С��CMS��̨ϵͳ��">
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div ><font size="6" face="����" color="#F5F5F5">��������������Ƽ����޹�˾</font>
			<span class="logo navbar-slogan f-l mr-10 hidden-xs"></span> 
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
</nav>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li ><font size="4" face="���Ŀ���"><?php echo $_SESSION['ubummc'];?>:</font></li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A"><?php echo $_SESSION['uname'];?><i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" onClick="myselfinfo()">������Ϣ</a></li>
						<li><a href="#">�л��˻�</a></li>
						<li><a href="#">�˳�</a></li>
				</ul>
			</li>
				<!-- <li id="Hui-msg"> <a href="#" title="��Ϣ"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> >
				<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="����"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="Ĭ�ϣ���ɫ��">Ĭ�ϣ���ɫ��</a></li>
						<li><a href="javascript:;" data-val="blue" title="��ɫ">��ɫ</a></li>
						<li><a href="javascript:;" data-val="green" title="��ɫ">��ɫ</a></li>
						<li><a href="javascript:;" data-val="red" title="��ɫ">��ɫ</a></li>
						<li><a href="javascript:;" data-val="yellow" title="��ɫ">��ɫ</a></li>
						<li><a href="javascript:;" data-val="orange" title="��ɫ">��ɫ</a></li>
					</ul>
				</li-->
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<?php include('nav.php');?>
	</div>


</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box" style="margin-top:-32px">
	<!-- position:absolute;display:none; -->
		<div id="Hui-tabNav" class="Hui-tabNav hidden-xs" style="margin-top:-500px;position:absolute;">
			<div class="Hui-tabNav-wp">
				<ul id="min_title_list" class="acrossTab cl">
					<li class="active" style="">
						<span title="�ҵ�����" data-href="welcome.html">�ҵ�����</span>
						<em></em></li>
			</ul>
		</div>
			<div class="Hui-tabNav-more btn-group" ><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>


	<div id="iframe_box" class="Hui-article" >
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="welcome.php" id="iframe"></iframe>
	</div>
</div>
</section>

<!--_footer ��Ϊ����ģ������ȥ-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin1.js"></script>
<!--/_footer ��Ϊ����ģ������ȥ-->

<!--�����·�д��ҳ��ҵ����صĽű�-->
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
function displaynavbar(obj){
	if($(obj).hasClass("open")){
		$(obj).removeClass("open");
		$("body").removeClass("big-page");
	} else {
		$(obj).addClass("open");
		$("body").addClass("big-page");
	}
}
$(function(){
	/*$("#min_title_list li").contextMenu('Huiadminmenu', {
		bindings: {
			'closethis': function(t) {
				console.log(t);
				if(t.find("i")){
					t.find("i").trigger("click");
				}		
			},
			'closeall': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
		}
	});*/
});
/*������Ϣ*/
function myselfinfo(){
	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //���̶�
		maxmin: true,
		shade:0.4,
		title: '�鿴��Ϣ',
		content: '<div>����Ա��Ϣ</div>'
	});
}

/*��Ѷ-���*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*ͼƬ-���*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*��Ʒ-���*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*�û�-���*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}


!function($) {
	$.fn.Huifold = function(options){
		var defaults = {
			titCell:'.item .Huifold-header',
			mainCell:'.item .Huifold-body',
			type:3,//1	ֻ��һ��������ȫ���ر�;2	������һ����;3	�ɴ򿪶��
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
</body>
</html>
