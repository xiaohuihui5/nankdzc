function openwindow(url,w,h)
{
	var Win = window.open(url,'','width='+w+',height='+h+',left='+(window.screen.availWidth-w)/2+',top='+(window.screen.availHeight-h)/2+',resizable=0,scrollbars=no,menubar=no,status=no');
}
function openwindow2(url,w,h)
{
	var Win = window.open(url,'','width='+w+',height='+h+',left='+(window.screen.availWidth-w)/2+',top='+(window.screen.availHeight-h)/2+',resizable=1,scrollbars=yes,menubar=no,status=no');
}
function openwindowd(url,w,h)
{
	document.getElementById("d_c").src=url;document.getElementById("d_a").style.display='block';document.getElementById("d_b").style.display='block';
}
function openwindowd(url,w,h)
{document.getElementById("d_c").src=url;document.getElementById("d_a").style.display='block';document.getElementById("d_b").style.display='block';}
function closewindowd()
{document.getElementById("d_a").style.display='none';document.getElementById("d_b").style.display='none';}
function del(id,zt)
{
if(window.Frm.edtrow.value==0)
{
	if(zt==1)
		parent.parent.layer.msg('���������,��ֹ������', {icon:2,time:1500});
	else 
	{
		parent.parent.layer.confirm('ɾ����˵�����������,��ȷ��Ҫɾ�������ô�����?',{
			btn:["ȷ��","ȡ��"],
			shade:0.2,

			yes:function(){
				window.Frm.scroll.value=document.body.scrollTop;
				window.Frm.delrow.value=id;
				window.Frm.edtrow.value=0;
				parent.parent.layer.closeAll();
				window.Frm.submit();
			},
			btn2:function(){
				parent.parent.layer.msg('�û���;ȡ��,�˴β���ʧ��!', {icon:2,time:1500});
			}

		});
	}
}
}
function mod(id,zt)
{
	if(zt==1)
		parent.parent.layer.msg('���������,��ֹ������', {icon:2,time:1500});
	else if(window.Frm.edtrow.value==0)
	{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.edtrow.value=id;
	window.Frm.submit();
	}
}
function sav()
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.submit();
}
function can()
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.edtrow.value=0;
	window.Frm.submit();
}
function yn(id)
{
if(window.Frm.edtrow.value==0)
{
	// if(confirm('ͣ�ú��ڲ�ѯѡ���в��ɼ�,��ȷ��Ҫͣ�û����ô�����?'))
	// {
	// window.Frm.scroll.value=document.body.scrollTop;
	// window.Frm.delrow.value=id;
	// window.Frm.submit()
	// }
	// else
	// 	alert('�û���;ȡ��,�˴β���ʧ��!');


	parent.parent.layer.confirm('��ȷ��Ҫͣ�û����ô�����?',{
		btn:["ȷ��","ȡ��"],
		shade:0.2,

		yes:function(){
			window.Frm.scroll.value=document.body.scrollTop;
			window.Frm.delrow.value=id;
			parent.parent.layer.closeAll();
			window.Frm.submit();
		},
		btn2:function(){
			parent.parent.layer.msg('�û���;ȡ��,�˴β���ʧ��!', {icon:2,time:1500});
		}

	});

}
}

function layer_show(title,url,w,h,par){
	if (title == null || title == '') {
		title=false;
	};
	if (url == null || url == '') {
		url="404.html";
	};
	if (w == null || w == '') {
		w=800;
	};
	if (h == null || h == '') {
		h=($(window).height() - 50);
	};

	if(par==null || par==''){
		parent.layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			end:function () 
				{
               			location.href=location.href;
		            }
		});
	}else{
		parent.parent.layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			 end:function () 
				{
					window.Frm.submit();
		              	location.href=location.href;
            		}
		});
	}
}
/*�رյ������*/
function layer_close(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
}


function sh(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.shrow.value=id;
	window.Frm.submit()
}
function k(t)
{
	if(t.bgColor=='#c4d2ea') t.bgColor='#ffffff'; else t.bgColor='#c4d2ea';
}
function v(t)
{
	if(t.bgColor!='#c4d2ea') t.bgColor='#d9edf7';
}
function o(t)
{
	if(t.bgColor!='#c4d2ea') t.bgColor='#ffffff';
}
function dl(t)
{
	if(t.parentNode.style.borderLeft=='4px solid rgb(25, 170, 141)') {
		t.parentNode.style.borderLeft='none';
	}else if(t.parentNode.style.borderLeft=='none'){
		t.parentNode.style.borderLeft='4px solid #19aa8d';
	}
	if(t.parentNode.style.borderLeft==false){
		t.parentNode.style.borderLeft='4px solid #19aa8d';
	}
	
}
function setscroll()
{
	document.body.scrollTop=window.Frm.scroll.value;
}
function s(lie)
{
	if(document.getElementById("paix").value==lie || document.getElementById("paix").value==''){
		document.getElementById("paix").value=lie+'desc';
	} else {
		document.getElementById("paix").value=lie;
	}
	for (var i=2;i<20;i++)
	{
		var tt=document.getElementById('m'+i);
		if(tt)
		{
		tt.innerHTML='';
		if(i==lie && document.getElementById("paix").value==lie)
			tt.innerHTML='<font color=red>��';
		else if(i==lie)
			tt.innerHTML='<font color=red>��';
		}
	}
	window.Frm.submit();
}
function check(e,lx)
{
	var k = window.event.keyCode;
	if (lx == 1 && (k < 48 || k > 57) && k!=13)
	{
		alert("�������ֻ����������!");
		window.event.keyCode = 0 ;
	}
	else if (lx == 2 && (k < 46 || k > 57) && k!=13)
	{
		alert("�������ֻ���������ֺ͵��!");
		window.event.keyCode = 0 ;
	}
}
function s_all(zt)
{
	if(confirm('��ȷ��Ҫ���������е�����������˻�ȡ�������?')) 
	{
	window.Frm.setsh.value=zt;
	window.Frm.submit();
	window.Frm.setsh.value=100;
	}
	else alert('�û���;ȡ�����������ȡ��!');
}
function mxclose()
{
	window.opener.Frm.submit();
}
function openload()
{
	//sending.style.visibility="visible";
	//cover.style.visibility="visible";
}
function closeload()
{
//parent.sending.style.visibility="hidden";
//parent.cover.style.visibility="hidden";

}
function layer_show2(title,url,w,h,par){
	if (title == null || title == '') {
		title=false;
	};
	if (url == null || url == '') {
		url="404.html";
	};
	if (w == null || w == '') {
		w=800;
	};
	if (h == null || h == '') {
		h=($(window).height() - 50);
	};

	if(par==null || par==''){
		layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			end:function () {
				
			
				
               location.href=Cs_kh.php;

            }
		});
	}else{
		layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			 end:function () {

				
				
               location.href=Cs_kh.php;

            }
		});
	}
}




function layer_show3(title,url,w,h,par){
	if (title == null || title == '') {
		title=false;
	};
	if (url == null || url == '') {
		url="404.html";
	};
	if (w == null || w == '') {
		w=800;
	};
	if (h == null || h == '') {
		h=($(window).height() - 50);
	};

	if(par==null || par==''){
		parent.layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			end:function () 
				{
               			location.href=location.href;
		            }
		});
	}else{
		parent.layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: true, //���̶�
			maxmin: true,//�����С��
			shade:0.2,//����
			move: false,//��ֹ�϶�
			// offset:,offset,   ��������
			title: title,
			content: url,
			 end:function () 
				{
					window.Frm.submit();
		              	location.href=location.href;
            		}
		});
	}
}
function Tis()
{
	parent.layer.msg('�ף���ҳ�治֧�ִ˹���',{icon:2,time:1500});
}
function sh(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.shid.value=id;
	window.Frm.submit();
}
function SelCp()//������Ʒѡȡ
{
	layer_show2("��Ʒѡȡ","I_Sell1Mx_Cp.php","500","500"); //���һ�������Ǹ�һ����ʶ�� 
}
function update()//�ύ��ϸ����
{
	window.hqlist.Frm.submit();
	javascript:location.replace(location.href);//����תˢ��
} 
//document.write('<div id="sending" style="position:absolute; width:460; top:220; left:20; z-index:10; visibility:hidden"><TABLE WIDTH=460 BORDER=0 CELLSPACING=0 CELLPADDING=0><TR><td width=30%></td><TD bgcolor=#ff9900><TABLE WIDTH=100% height=60 BORDER=0 CELLSPACING=2 CELLPADDING=0><TR><td bgcolor=#eeeeee align=center>���ݴ�����, ���Ժ�...<img src="im/loading.gif" border=0 align="center"></td></tr></table></td><td width=30%></td></tr></table></div><div id="cover" style="position:absolute; top:0; left:0; z-index:9; visibility:hidden"><TABLE WIDTH=100% height=300 BORDER=0 CELLSPACING=0 CELLPADDING=0><TR><TD align=center><br></td></tr></table></div>');








































