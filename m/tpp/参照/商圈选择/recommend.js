$(function(){
	var nav_down = $("#nav_down");//�˵�id
	var layer_bg = $("#layer_bg");//���㱳��id
	var commodity = "#commodity";//�˵���Ʒ����id
	var region = "#region";//�˵�����ѡ��id
	var commodity_list = "#commodity_list";//��Ʒ�����б�id
	var region_list = "#region_list";//����ѡ���б�id
	
	var screen_height = document.documentElement.clientHeight || window.innerHeight;
	var screen_width = document.documentElement.clientWidth || window.innerWidth;
	//��ʼ�߶�
	$("body").height(screen_height);
	
	//��ʼ���򱳾���С
	var nav_height = $(nav_down).height();
	$(layer_bg).width(screen_width);
	$(layer_bg).height(screen_height - nav_height);
	
	$(commodity).click(function(){
		if($(region_list).css("display") == "block") $(region_list).hide();
		else $(layer_bg).toggle();
		$(commodity_list).slideToggle();
	});
	$(region).click(function(){
		if($(commodity_list).css("display") == "block") $(commodity_list).hide();
		else $(layer_bg).toggle();
		$(region_list).slideToggle();
	});
	$(layer_bg).click(function(){
		$(commodity_list).slideUp();
		$(layer_bg).toggle();
		$(region_list).slideUp();
	});
});