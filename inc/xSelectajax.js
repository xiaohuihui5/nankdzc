var xmlHttp;
var xmlHttp2;
function createXMLHttpRequest()
{
	if (window.ActiveXObject)
	{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");	
	}
	else if (window.XMLHttpRequest)
	{
		xmlHttp=new XMLHttpRequest();
	}
}
function createXMLHttpRequest2()
{
	if (window.ActiveXObject)
	{
		xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");	
	}
	else if (window.XMLHttpRequest)
	{
		xmlHttp2=new XMLHttpRequest();
	}
}
function CreateSelect(xiam,cwho,query)//����ҳ��url,cwho=0�������=1�����ұ�,queryΪajax����Ĳ���
{
	if(cwho>0)//�����ұ�
	{
	createXMLHttpRequest();
	xmlHttp.open("post",xiam,true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("context-type","text/html;charset=GB2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState==4)
		{
			if (xmlHttp.status == 200)
			{
			document.getElementById('toBox').options.length = 0;
			var ob= document.getElementById('toBox');
			eval(xmlHttp.responseText);
			}
		}
	}
	xmlHttp.send(query+"&cwho=1");
	}
	if(cwho!=1)//�������
	{
	createXMLHttpRequest2();
	xmlHttp2.open("post",xiam,true);
	xmlHttp2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp2.setRequestHeader("context-type","text/html;charset=GB2312");
	xmlHttp2.onreadystatechange = function ()
	{
	if (xmlHttp2.readyState==4)
		{
			if (xmlHttp2.status == 200)
			{
			document.getElementById('fromBox').options.length = 0;
			var ob = document.getElementById('fromBox');
			eval(xmlHttp2.responseText);
			}
		}
	}
	xmlHttp2.send(query+"&cwho=0");
	}
}
function LtoR_S()
{
	var str="0";
	for(var num=0;num<document.getElementById('toBox').length;num++)
		str=str+","+document.getElementById('toBox').options[num].value;
	for(var num=0;num<document.getElementById('fromBox').length;num++)
	if(document.getElementById('fromBox').options[num].selected)
		str=str+","+document.getElementById('fromBox').options[num].value;
	DisSelect(str,2);
}
function LtoR_M()
{
	var str="0";
	for(var num=0;num<document.getElementById('toBox').length;num++)
		str=str+","+document.getElementById('toBox').options[num].value;
	for(var num=0;num<document.getElementById('fromBox').length;num++)
		str=str+","+document.getElementById('fromBox').options[num].value;
	document.getElementById('fromBox').options.length = 0;
	DisSelect(str,1);
}
function ListLeft()
{
	var str="0";
	for(var num=0;num<document.getElementById('toBox').length;num++)
		str=str+","+document.getElementById('toBox').options[num].value;
	DisSelect(str,0);
}

function RtoL_S()
{
	var str="0";
	for(var num=0;num<document.getElementById('toBox').length;num++)
	if(!document.getElementById('toBox').options[num].selected)
		str=str+","+document.getElementById('toBox').options[num].value;
	DisSelect(str,2);
}
function RtoL_M()
{
	var str="0";
	document.getElementById('toBox').options.length = 0;
	DisSelect(str,0);
}