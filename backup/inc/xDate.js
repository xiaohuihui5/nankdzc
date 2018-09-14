<!--
String.prototype.trim = function(){return this.replace(/(^\s+)|(\s+$)/g,"");}
var cal_Width = 165;
document.write("<html><body><div id='meizzCalendarLayer' style='position: absolute; z-index: 9999; width: " + (cal_Width+4).toString() + "px; height: 206px; display: none'>");
document.write("<iframe name='meizzCalendarIframe' scrolling='no' frameborder='0' width='100%' height='100%'></iframe></div></body></html>");
var WebCalendar = new cal_WebCalendar();
document.onclick = function(e){
    var ev = cal_SearchEvent();
    if(ev)
       e = ev; 
    if(e && e.srcElement)e = e.srcElement;   
    if(WebCalendar.eventSrc != e) cal_hiddenCalendar();
}
function cal_WebCalendar(){
    this.regInfo    = "�رտ�ݼ���[Esc]";
    this.dayShow    = 38;
    this.daysMonth  = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    this.day        = new Array(this.dayShow);
    this.dayObj     = new Array(this.dayShow);
    this.dateStyle  = null;
    this.objExport  = null;
    this.eventSrc   = null;
    this.inputDate  = null;
    this.thisYear   = new Date().getFullYear();
    this.thisMonth  = new Date().getMonth()+ 1;
    this.thisDay    = new Date().getDate();
    this.today      = this.thisDay +"/"+ this.thisMonth +"/"+ this.thisYear;
    this.iframe     = window.frames["meizzCalendarIframe"];
    this.calendar   = cal_getObjectById("meizzCalendarLayer");
    this.dateReg    = "";
    this.yearFall   = 50;
    this.format     = "yyyy-mm-dd";
    this.timeShow   = false;
    this.drag       = true;
    this.darkColor  = "#95B7F3";
    this.lightColor = "#FFFFFF";
    this.btnBgColor = "#E6E6FA";
    this.wordColor  = "#000080";
    this.wordDark   = "#DCDCDC";
    this.dayBgColor = "#F5F5FA";
    this.todayColor = "#FF0000";
    this.DarkBorder = "#D4D0C8";
    this.yearOption = "";
    var yearNow = new Date().getFullYear();
    yearNow = (yearNow <= 1000)? 1000 : ((yearNow >= 9999)? 9999 : yearNow);
    this.yearMin = (yearNow - this.yearFall >= 1000) ? yearNow - this.yearFall : 1000;
    this.yearMax = (yearNow + this.yearFall <= 9999) ? yearNow + this.yearFall : 9999;
    this.yearMin = (this.yearMax == 9999) ? this.yearMax-this.yearFall*2 : this.yearMin;
    this.yearMax = (this.yearMin == 1000) ? this.yearMin+this.yearFall*2 : this.yearMax;
    for (var i=this.yearMin; i<=this.yearMax; i++) this.yearOption += "<option value='"+i+"'>"+i+"��</option>";
}
function calendar(obj){
    var e;
    var ev = cal_SearchEvent();
    if(ev)
       e = ev; 
    if(e.srcElement)e = e.srcElement;   
    cal_writeIframe();
    var o = WebCalendar.calendar.style; 
    WebCalendar.eventSrc = e;
	if (arguments.length == 0) 
	    WebCalendar.objExport = e;
    else 
        WebCalendar.objExport = eval(arguments[0]);
    WebCalendar.iframe.document.getElementById('tableWeek').style.cursor = WebCalendar.drag ? "move" : "default";
    if(!e.offsetTop && arguments[0]){
        e = arguments[0];
    }
	var t = e.offsetTop!=undefined?e.offsetTop:e.clientY;
	var h = e.clientHeight!=undefined?e.clientHeight:0;
	var l = e.offsetLeft!=undefined?e.offsetLeft:e.clientX;
	var p = e.type;
	while (e = e.offsetParent){
	    if(e.offsetTop)t += e.offsetTop; 
	    if(e.offsetLeft)l += e.offsetLeft;
	}
    o.display = ""; WebCalendar.iframe.document.body.focus();
    var cw = WebCalendar.calendar.clientWidth, ch = WebCalendar.calendar.clientHeight;
    var dw = document.body.clientWidth, dl = document.body.scrollLeft, dt = document.body.scrollTop;
    if (document.body.clientHeight + dt - t - h >= ch) 
        o.top = (p=="image")? (t + h)+'px' : (t + h + 6)+'px';
    else 
        o.top  = (t - dt < ch) ? ((p=="image")? (t + h)+'px' : (t + h + 6)+'px') : (t - ch)+'px';
    if (dw + dl - l >= cw) 
        o.left = l+"px"; 
    else 
        o.left = (dw >= cw) ? (dw - cw + dl)+"px" : dl+"px";
    if  (!WebCalendar.timeShow) WebCalendar.dateReg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/;
    else WebCalendar.dateReg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
    try{
        if (WebCalendar.objExport.value.trim() != ""){
            WebCalendar.dateStyle = WebCalendar.objExport.value.trim().match(WebCalendar.dateReg);
            if (WebCalendar.dateStyle == null)
            {
                WebCalendar.thisYear   = new Date().getFullYear();
                WebCalendar.thisMonth  = new Date().getMonth()+ 1;
                WebCalendar.thisDay    = new Date().getDate();
                alert("ԭ�ı��������д���\n�������㶨�����ʾʱ�����г�ͻ��");
                cal_writeCalendar(); return false;
            }
            else
            {
                WebCalendar.thisYear   = parseInt(WebCalendar.dateStyle[1], 10);
                WebCalendar.thisMonth  = parseInt(WebCalendar.dateStyle[3], 10);
                WebCalendar.thisDay    = parseInt(WebCalendar.dateStyle[4], 10);
                WebCalendar.inputDate  = parseInt(WebCalendar.thisDay, 10) +"/"+ parseInt(WebCalendar.thisMonth, 10) +"/"+ 
                parseInt(WebCalendar.thisYear, 10); cal_writeCalendar();
            }
        } else {
          WebCalendar.thisYear   = new Date().getFullYear();
          WebCalendar.thisMonth  = new Date().getMonth()+ 1;
          WebCalendar.thisDay    = new Date().getDate();
          cal_writeCalendar();
        }
    } catch(e) {
      WebCalendar.thisYear   = new Date().getFullYear();
      WebCalendar.thisMonth  = new Date().getMonth()+ 1;
      WebCalendar.thisDay    = new Date().getDate();
      cal_writeCalendar();
    }
}
function cal_writeIframe(){
    var strIframe = "<html><head>\r\n<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>\r\n<style>"+
    "*{font-size: 12px; font-family: ����}"+
    ".bg{  color: "+ WebCalendar.lightColor +"; cursor: default; background-color: "+ WebCalendar.darkColor +";}"+
    "table#tableMain{ width: "+ (cal_Width+2).toString() +"px; height: 180px;}"+
    "table#tableWeek td{ width:14%;color: "+ WebCalendar.lightColor +";}"+
    "table#tableDay  td{ width:14%;font-weight: bold;}"+
    "td#meizzYearHead, td#meizzYearMonth{color: "+ WebCalendar.wordColor +"}"+
    ".out { height:19px;text-align: center; border-top: 1px solid "+ WebCalendar.DarkBorder +"; border-left: 1px solid "+ WebCalendar.DarkBorder +";"+
    "border-right: 1px solid "+ WebCalendar.lightColor +"; border-bottom: 1px solid "+ WebCalendar.lightColor +";}"+
    ".over{ text-align: center; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF;"+
    "border-bottom: 1px solid "+ WebCalendar.DarkBorder +"; border-right: 1px solid "+ WebCalendar.DarkBorder +"}"+
    "input{ border: 1px solid "+ WebCalendar.darkColor +"; padding-top: 1px; height: 18px; cursor: hand;"+
    "       color:"+ WebCalendar.wordColor +"; background-color: "+ WebCalendar.btnBgColor +"}"+
    "\r\n</style></head>\r\n<body onselectstart='return false' style='margin: 0px' oncontextmenu='return false'>\r\n<form name=meizz>\r\n";
    if (WebCalendar.drag){ 
        strIframe += "<scr"+"ipt type='text/javascript'>\r\n"+
            "var drag=false, cx=0, cy=0, o = parent.WebCalendar.calendar; " +
            "document.onmousemove=function(evt){\r\n"+
            "if(parent.WebCalendar.drag && drag){if(o.style.left=='')o.style.left=0+'px'; if(o.style.top=='')o.style.top=0+'px';"+
            "o.style.left = (parseInt(o.style.left,10) + cal_SearchEvent().clientX-cx)+'px';"+
            "o.style.top  = (parseInt(o.style.top,10)  + cal_SearchEvent().clientY-cy)+'px';}}\r\n"+
            "document.onkeydown=function(evt){switch(cal_SearchEvent().keyCode){  case 27 : parent.cal_hiddenCalendar(); break;"+
            "case 37 : parent.cal_prevM(); break; case 38 : parent.cal_prevY(); break; case 39 : parent.cal_nextM(); break; case 40 : parent.cal_nextY(); break;"+
            "case 84 : document.forms[0].today.click(); break;} " +
            "try{cal_SearchEvent().keyCode = 0; cal_SearchEvent().returnValue= false;}catch(ee){}}\r\n"+
            "function dragStart(){cx=cal_SearchEvent().clientX; cy=cal_SearchEvent().clientY; drag=true;}" +
            "function cal_SearchEvent(){if(document.all || window.event){return window.event;}var func=cal_SearchEvent.caller;while(func!=null){var arg0=func.arguments[0];if(arg0){var tmp = arg0.constructor.toString();if(tmp.indexOf('Event')>=0){return arg0;}}func=func.caller;}return null;}" +
            "\r\n</scr"+"ipt>"
    }
    strIframe += "<table id=tableMain class=bg border=0 cellspacing=2 cellpadding=0>"+
    "   <tbody><tr><td width='"+ cal_Width +"px' height='19px' bgcolor='"+ WebCalendar.lightColor +"'>"+
    "    <table width='"+ cal_Width +"px' id='tableHead' border='0' cellspacing='1' cellpadding='0'><tbody><tr align='center'>"+
    "    <td width='10%' height='19px' class='bg' title='��ǰ�� 1 ��&#13;��ݼ�����' style='cursor: hand' onclick='parent.cal_prevM()'><b>&lt;</b></td>"+
    "    <td width='45%' id=meizzYearHead "+
    "        onmouseover='this.bgColor=parent.WebCalendar.darkColor; this.style.color=parent.WebCalendar.lightColor'"+
    "        onmouseout='this.bgColor=parent.WebCalendar.lightColor; this.style.color=parent.WebCalendar.wordColor'>" + 
    "<select name=tmpYearSelect  onblur='parent.cal_hiddenSelect(this)' style='width:100%;'"+
    "        onchange='parent.WebCalendar.thisYear =this.value; parent.cal_hiddenSelect(this); parent.cal_writeCalendar();'>";
    strIframe += WebCalendar.yearOption + "</select>"+
    "</td>"+
    "    <td width='35%' id=meizzYearMonth "+
    "        onmouseover='this.bgColor=parent.WebCalendar.darkColor; this.style.color=parent.WebCalendar.lightColor'"+
    "        onmouseout='this.bgColor=parent.WebCalendar.lightColor; this.style.color=parent.WebCalendar.wordColor'>" +
    "<select name=tmpMonthSelect onblur='parent.cal_hiddenSelect(this)' style='width:100%;'" +    
    "        onchange='parent.WebCalendar.thisMonth=this.value; parent.cal_hiddenSelect(this); parent.cal_writeCalendar();'>";
    for (var i=1; i<13; i++) strIframe += "<option value='"+i+"'>"+i+"��</option>";
    strIframe += "</select>"+
    "</td>"+
    "    <td width='10%' class=bg title='��� 1 ��&#13;��ݼ�����' onclick='parent.cal_nextM()' style='cursor: hand'><b>&gt;</b></td></tr></tbody></table>"+
    "</td></tr><tr><td height='20px'>"+
    "<table id=tableWeek border=1 width='"+ cal_Width +"px' cellpadding=0 cellspacing=0 ";
    if(WebCalendar.drag){
        strIframe += "onmousedown='dragStart()' onmouseup='drag=false' ";
    }
    strIframe += " borderColorLight='"+ WebCalendar.darkColor +"' borderColorDark='"+ WebCalendar.lightColor +"'>"+
    "    <tbody><tr align=center><td height='20px'>��</td><td>һ</td><td>��</td><td>��</td><td>��</td><td>��</td><td>��</td></tr></tbody></table>"+
    "</td></tr><tr><td valign=top width='"+ cal_Width +"px' bgcolor='"+ WebCalendar.lightColor +"'>"+
    "    <table id=tableDay height='120px' width='"+ cal_Width +"px' border=0 cellspacing=1 cellpadding=0><tbody>";
         for(var x=0; x<5; x++){
           strIframe += "<tr>";
           for(var y=0; y<7; y++)
             strIframe += "<td class=out id='meizzDay"+ (x*7+y) +"'></td>"; 
           strIframe += "</tr>";
         }
         strIframe += "<tr>";
         for(var x=35; x<WebCalendar.dayShow; x++)
           strIframe += "<td class=out id='meizzDay"+ x +"'></td>";
         strIframe +="<td colspan="+(42-WebCalendar.dayShow).toString()+" class=out style='text-align:center;' title='"+ WebCalendar.regInfo +"'>" + 
         "&nbsp;" + 
         "<input style=' background-color: " + WebCalendar.btnBgColor +";cursor: hand; padding-top: 2px; width: 43%;height:19px;' onfocus='this.blur()'"+
         " type=button value='�ر�' onclick='parent.cal_hiddenCalendar()'>" + 
         "</td></tr></tbody></table>"+
    "</td></tr><tr><td height='20px' width='"+ cal_Width +"px' bgcolor='"+ WebCalendar.lightColor +"' style='vertical-align:top;'>"+
    "    <table border=0 cellpadding=1 cellspacing=0 width='"+ cal_Width +"px'>"+
    "    <tbody><tr><td><input name=prevYear title='��ǰ�� 1 ��&#13;��ݼ�����' onclick='parent.cal_prevY()' type=button value='&lt;&lt;'"+
    "    onfocus='this.blur()' style='width:25px;meizz:expression(this.disabled=parent.WebCalendar.thisYear==1000)'>&nbsp;<input"+
    "    onfocus='this.blur()' name=prevMonth title='��ǰ�� 1 ��&#13;��ݼ�����' onclick='parent.cal_prevM()' type=button value='&lt;&nbsp;' style='width:22px;'>"+
    "    </td><td align=center><input name=today type=button value='����' onfocus='this.blur()' style='width: 50px;' title='��ǰ����&#13;��ݼ���T'"+
    "    onclick=\"parent.cal_returnDate(new Date().getDate() +'/'+ (new Date().getMonth() +1) +'/'+ new Date().getFullYear())\">"+
    "    </td><td align=right><input title='��� 1 ��&#13;��ݼ�����' name=nextMonth onclick='parent.cal_nextM()' type=button value='&nbsp;&gt;'"+
    "    onfocus='this.blur()' style='width:22px;'>&nbsp;<input name=nextYear title='��� 1 ��&#13;��ݼ�����' onclick='parent.cal_nextY()' type=button value='&gt;&gt;'"+
    "    onfocus='this.blur()' style='width:25px;meizz:expression(this.disabled=parent.WebCalendar.thisYear==9999)'></td></tr></tbody></table>"+
    "</td></tr></tbody></table></form></body></html>";
    with(WebCalendar.iframe)
    {
        document.writeln(strIframe); document.close();
        for(var i=0; i<WebCalendar.dayShow; i++)
        {
            WebCalendar.dayObj[i] = document.getElementById("meizzDay"+ i);
            WebCalendar.dayObj[i].onmouseover = cal_dayMouseOver;
            WebCalendar.dayObj[i].onmouseout  = cal_dayMouseOut;
            WebCalendar.dayObj[i].onclick     = cal_returnDate;
        }
    }
}
function cal_MonthSelect(){
    var m = isNaN(parseInt(WebCalendar.thisMonth, 10)) ? new Date().getMonth() + 1 : parseInt(WebCalendar.thisMonth, 10);
    var e = WebCalendar.iframe.document.forms[0].tmpMonthSelect;
    e.value = m;
}
function cal_YearSelect(){
    var e = WebCalendar.iframe.document.forms[0].tmpYearSelect;
    var y = isNaN(parseInt(WebCalendar.thisYear, 10)) ? new Date().getFullYear() : parseInt(WebCalendar.thisYear, 10);
    if(y < WebCalendar.yearMin || y > WebCalendar.yearMax){
        var html = e.innerHTML;
        var optn = document.createElement("OPTION");
        if(y < WebCalendar.yearMin){
            e.insertBefore(optn, e.options[0]);
            WebCalendar.yearMin--;
        }else{
            e.appendChild(optn);
            WebCalendar.yearMax++;
        }
        optn.text = y+"��";
        optn.value = y;
        WebCalendar.yearOption = e.innerHTML;
    }
    e.value = y;
}
function cal_prevM(){
    WebCalendar.thisDay = 1;
    if (WebCalendar.thisMonth==1)
    {
        WebCalendar.thisYear--;
        WebCalendar.thisMonth=13;
    }
    WebCalendar.thisMonth--; cal_writeCalendar();
}
function cal_nextM(){
    WebCalendar.thisDay = 1;
    if (WebCalendar.thisMonth==12)
    {
        WebCalendar.thisYear++;
        WebCalendar.thisMonth=0;
    }
    WebCalendar.thisMonth++; cal_writeCalendar();
}
function cal_prevY(){
    WebCalendar.thisDay = 1; WebCalendar.thisYear--; cal_writeCalendar();
}
function cal_nextY(){
    WebCalendar.thisDay = 1; WebCalendar.thisYear++; cal_writeCalendar();
}
function cal_hiddenSelect(e){
}
function cal_getObjectById(id){ 
    if(document.all) return(eval("document.all."+ id));
    var tmp = document.getElementById(id);
    if(tmp)
        return tmp;
    return(eval(id)); 
}
function cal_hiddenCalendar(){
    cal_getObjectById("meizzCalendarLayer").style.display = "none";
}
function cal_appendZero(n){
    return(("00"+ n).substr(("00"+ n).length-2));
}
function cal_dayMouseOver(){
    this.className = "over";
    this.style.backgroundColor = WebCalendar.darkColor;
    if(WebCalendar.day[this.id.substr(8)].split("/")[1] == WebCalendar.thisMonth)
    this.style.color = WebCalendar.lightColor;
}
function cal_dayMouseOut(){
    this.className = "out"; var d = WebCalendar.day[this.id.substr(8)], a = d.split("/");
    this.style.backgroundColor = '';//WebCalendar.dayBgColor;
    if(a[1] == WebCalendar.thisMonth && d != WebCalendar.today)
    {
        if(WebCalendar.dateStyle && a[0] == parseInt(WebCalendar.dateStyle[4], 10))
        this.style.color = WebCalendar.lightColor;
        this.style.color = WebCalendar.wordColor;
    }
}
function cal_writeCalendar(){
    var y = WebCalendar.thisYear;
    var m = WebCalendar.thisMonth; 
    var d = WebCalendar.thisDay;
    WebCalendar.daysMonth[1] = (0==y%4 && (y%100!=0 || y%400==0)) ? 29 : 28;
    if (!(y<=9999 && y >= 1000 && parseInt(m, 10)>0 && parseInt(m, 10)<13 && parseInt(d, 10)>0)){
        WebCalendar.thisYear   = new Date().getFullYear();
        WebCalendar.thisMonth  = new Date().getMonth()+ 1;
        WebCalendar.thisDay    = new Date().getDate(); }
    y = WebCalendar.thisYear;
    m = WebCalendar.thisMonth;
    d = WebCalendar.thisDay;
    cal_YearSelect(parseInt(y, 10));
    cal_MonthSelect(parseInt(m,10));
    WebCalendar.daysMonth[1] = (0==y%4 && (y%100!=0 || y%400==0)) ? 29 : 28;
    var w = new Date(y, m-1, 1).getDay();
    var prevDays = m==1  ? WebCalendar.daysMonth[11] : WebCalendar.daysMonth[m-2];
    for(var i=(w-1); i>=0; i--)
    {
        WebCalendar.day[i] = prevDays +"/"+ (parseInt(m, 10)-1) +"/"+ y;
        if(m==1) WebCalendar.day[i] = prevDays +"/"+ 12 +"/"+ (parseInt(y, 10)-1);
        prevDays--;
    }
    for(var i=1; i<=WebCalendar.daysMonth[m-1]; i++) WebCalendar.day[i+w-1] = i +"/"+ m +"/"+ y;
    for(var i=1; i<WebCalendar.dayShow-w-WebCalendar.daysMonth[m-1]+1; i++)
    {
        WebCalendar.day[WebCalendar.daysMonth[m-1]+w-1+i] = i +"/"+ (parseInt(m, 10)+1) +"/"+ y;
        if(m==12) WebCalendar.day[WebCalendar.daysMonth[m-1]+w-1+i] = i +"/"+ 1 +"/"+ (parseInt(y, 10)+1);
    }
    for(var i=0; i<WebCalendar.dayShow; i++)
    {
        var a = WebCalendar.day[i].split("/");
        WebCalendar.dayObj[i].innerHTML    = a[0];
        WebCalendar.dayObj[i].title        = a[2] +"-"+ cal_appendZero(a[1]) +"-"+ cal_appendZero(a[0]);
        WebCalendar.dayObj[i].bgColor      = WebCalendar.dayBgColor;
        WebCalendar.dayObj[i].style.color  = WebCalendar.wordColor;
        if ((i<10 && parseInt(WebCalendar.day[i], 10)>20) || (i>27 && parseInt(WebCalendar.day[i], 10)<12))
            WebCalendar.dayObj[i].style.color = WebCalendar.wordDark;
        if (WebCalendar.inputDate==WebCalendar.day[i])
        {WebCalendar.dayObj[i].bgColor = WebCalendar.darkColor; WebCalendar.dayObj[i].style.color = WebCalendar.lightColor;}
        if (WebCalendar.day[i] == WebCalendar.today)
        {WebCalendar.dayObj[i].bgColor = WebCalendar.todayColor; WebCalendar.dayObj[i].style.color = WebCalendar.lightColor;}
    }
}
function cal_returnDate(){
    if(WebCalendar.objExport)
    {
        var a;
        if(arguments.length==0 || arguments[0].constructor != String)
            a = WebCalendar.day[this.id.substr(8)].split("/");
        else
            a = arguments[0].split("/");
        var d = WebCalendar.format.match(/^(\w{4})(-|\/)(\w{1,2})\2(\w{1,2})$/);
        if(d==null){alert("���趨�����������ʽ���ԣ�\r\n\r\n�����¶��� WebCalendar.format ��"); return false;}
        var flag = d[3].length==2 || d[4].length==2;
        var returnValue = flag ? a[2] +d[2]+ cal_appendZero(a[1]) +d[2]+ cal_appendZero(a[0]) : a[2] +d[2]+ a[1] +d[2]+ a[0];
        if(WebCalendar.timeShow)
        {
            var h = new Date().getHours(), m = new Date().getMinutes(), s = new Date().getSeconds();
            returnValue += flag ? " "+ cal_appendZero(h) +":"+ cal_appendZero(m) +":"+ cal_appendZero(s) : " "+  h  +":"+ m +":"+ s;
        }
        WebCalendar.objExport.value = returnValue;
        cal_hiddenCalendar();
    }
}
function cal_SearchEvent(){
    if(document.all || window.event){
        return window.event;
    }
    var func=cal_SearchEvent.caller;
    while(func!=null){
        var arg0=func.arguments[0];
        if(arg0){
            var tmp = arg0.constructor.toString();
            if(tmp.indexOf("Event") >= 0){//tmp==Event || tmp == MouseEvent || tmp == KeyboardEvent){
                return arg0;
            }
        }
        func=func.caller;
    }
    return null;
}
//-->