function k(t)
{
	if(t.bgColor=='#c4d2ea') t.bgColor='#ffffff'; else t.bgColor='#c4d2ea';
}
function s(lie)
{
	if(document.getElementById("lie").value==lie)
	{
		if(document.getElementById("sx").value=='')
			document.getElementById("sx").value='desc';
		else
			document.getElementById("sx").value='';		
	}
	else
	{
		document.getElementById("lie").value=lie;
		document.getElementById("sx").value='';
	}
	window.Frm.submit();
}