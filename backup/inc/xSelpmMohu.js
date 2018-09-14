var autoFlag="N";
var searchFlag="N";
var xmlHttp;
var now_index=-1;//方向键滚动位置
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
function OpenTipDiv(l,t,w,z)
	{
		var div=document.createElement("div");
		div.id="SearchTipDiv";
		var mOffsetTop=document.getElementById("spdm").offsetTop;
		var mOffsetParent=document.getElementById("spdm").offsetParent;	
		while(mOffsetParent){
mOffsetTop += mOffsetParent.offsetTop;
mOffsetParent = mOffsetParent.offsetParent;
}
		div.style.position="absolute";
		div.style.top=mOffsetTop+25+"px";
		div.style.left=document.getElementById("spdm").offsetLeft+2+"px";
//		div.style.top=document.getElementById("spdm").offsetTop+102+"px";
		div.className = "seldiv";
		//div.style.background="#ffffff";
		//div.style.borderTop="1px solid #cccccc";
		//div.style.borderBottom="1px solid #cccccc";
		//div.style.borderLeft="1px solid #cccccc";
		//div.style.borderRight="1px solid #cccccc";
		//div.style.filter="Alpha(opacity=100)";
		div.style.width="150px";
		div.style.zIndex=z;
		document.body.appendChild(div);
		autoFlag="Y";
}
	function CloseTipDiv()
	{
		var div=document.getElementById("SearchTipDiv"); 
		if (div!=null)
		{
			document.body.removeChild(div);
			autoFlag="N";
		}
	}
	function AutoFinish()
	{
		switch (event.keyCode) {
				case 13:
				if(document.getElementById("spdm").value!='')
					startRequest(document.getElementById("spdm").value,0);
				return false;
				break;
				case 38: //up
					if(now_index<1)
					{
						now_index=document.getElementById("lstab").rows.length-1;
						document.getElementById("lstab").rows[now_index].bgColor="#93CDDD";
						document.getElementById("lstab").rows[0].bgColor="";
						//document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText+document.getElementById("lstab").rows[now_index].cells[1].innerText;
						document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText;
					}
					else
					{
						document.getElementById("lstab").rows[now_index-1].bgColor="#93CDDD";
						document.getElementById("lstab").rows[now_index].bgColor="";
						now_index=now_index-1;
						//document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText+document.getElementById("lstab").rows[now_index].cells[1].innerText;
						document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText;
					}
					return false;
					break;
				case 40: //down
					if(now_index==document.getElementById("lstab").rows.length-1)
					{
						document.getElementById("lstab").rows[0].bgColor="#93CDDD";
						document.getElementById("lstab").rows[now_index].bgColor="";
						now_index=0;
						//document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText+document.getElementById("lstab").rows[now_index].cells[1].innerText;
						document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText;
					}
					else
					{
						document.getElementById("lstab").rows[now_index+1].bgColor="#93CDDD";
						if(now_index!=-1) document.getElementById("lstab").rows[now_index].bgColor="";
						now_index=now_index+1;
						//document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText+document.getElementById("lstab").rows[now_index].cells[1].innerText;
						document.getElementById("spdm").value=document.getElementById("lstab").rows[now_index].cells[0].innerText;
					}
					return false;
					break;	
		}
		if(document.getElementById("spdm").value==document.getElementById("oldvalue").value)
			return 0;
		document.getElementById("oldvalue").value=document.getElementById("spdm").value;
		if (document.getElementById("spdm").value!="")
		{
		CloseTipDiv();
		AutoFinishRequest();
		}
		else if (document.getElementById("spdm").value=="")
		{
			CloseTipDiv();
		}
	}
	 function AutoFinishRequest()
	 {
		createXMLHttpRequest();
		var url="xSelpmMohu.php";
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-Type","text/xml");
		xmlHttp.setRequestHeader("Content-Type","gb2312");
		xmlHttp.onreadystatechange=AutoFinishCallback;
		xmlHttp.send("inputkey="+document.getElementById("spdm").value);
	}
	 function AutoFinishCallback()
	 {
		if (xmlHttp.readyState==4)
		{
			if (xmlHttp.status==200)
			{
				var str=xmlHttp.responseText;
				if (autoFlag=="N" && str!="no")
				{
					OpenTipDiv(91,415,397,100);
					now_index=-1;
					document.getElementById("SearchTipDiv").innerHTML=str;
				}
				if (str=="no")
				{
					CloseTipDiv();	
				}
			}
		}
	}