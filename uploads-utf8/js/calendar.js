var agt = navigator.userAgent.toLowerCase();
var is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
var months = new Array("一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"); 
var daysInMonth = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
var days = new Array("日","一", "二", "三", "四", "五", "六"); 
var today; 
function getDays(month, year){ 
	//下面的这段代码是判断当前是否是闰年的 
	if (1 == month){ 
		return ((0 == year % 4) && (0 != (year % 100))) || (0 == year % 400) ? 29 : 28; 
	}else {
		return daysInMonth[month]; 
	}
} 

function getToday() { 
	//得到今天的年,月,日 
	this.now = new Date(); 
	this.year = this.now.getFullYear(); 
	this.month = this.now.getMonth(); 
	this.day = this.now.getDate(); 
}

function getStringDay(str) { 
	//得到输入框的年,月,日
	var str=str.split("-")
	
	this.now = new Date(parseFloat(str[0]),parseFloat(str[1])-1,parseFloat(str[2])); 
	this.year = this.now.getFullYear(); 
	this.month = this.now.getMonth(); 
	this.day = this.now.getDate(); 
}

function newCalendar() { 
	var parseYear = parseInt(getObj('Year').options[getObj('Year').selectedIndex].value); 
	var newCal = new Date(parseYear, getObj('Month').selectedIndex, 1); 
	var day = -1; 
	var startDay = newCal.getDay(); 
	var daily = 0; 

	if ((today.year == newCal.getFullYear()) &&(today.month == newCal.getMonth())) {
		day = today.day; 
	}
	var tableCal = getObj('Day'); 
	var intDaysInMonth =getDays(newCal.getMonth(), newCal.getFullYear());

	for (var intWeek = 1; intWeek < tableCal.rows.length;intWeek++) {
		for (var intDay = 0;intDay < tableCal.rows[intWeek].cells.length;intDay++) { 
			var cell = tableCal.rows[intWeek].cells[intDay]; 
			if(intDay == startDay && 0 == daily){
                daily = 1;
			}
            if(daily > 0 && daily <= intDaysInMonth){
				if(day==daily){ //今天，调用今天的Class 
					cell.style.background='#6699CC';
					cell.style.color='#FFFFFF';
					//cell.style.fontWeight='bold';
				}else if(intDay==6){ //周六 
					cell.style.color='green'; 
				}else if (intDay==0){ //周日 
					cell.style.color='red';
				}
				cell.innerHTML = daily; 
				daily++; 
			}else{
				cell.innerHTML = " "; 
			}
		} 
	}
}

function GetDate(idname,e){ 
    var sDate;
	var getElement = is_ie ? event.srcElement : e.target;
    if(getElement.tagName == "TD"){
        if(getElement.innerHTML != ""){
			inYear=getObj('Year').value;
			inMonth=getObj('Month').value;
			if(inMonth<10){inMonth="0"+inMonth;}
			inDay=getElement.innerHTML;
			if(inDay<10){inDay="0"+inDay;}
			sDate = inYear + "-" + inMonth + "-" + inDay;
			getObj(idname).value=sDate;
			getObj(idname).onblur && getObj(idname).onblur();
           	HiddenCalendar();
        }
	}
} 

function HiddenCalendar(){
	//关闭选择窗口
	getObj("Calendar").style.visibility='hidden';
	var objllist=document.getElementsByTagName('select');
	for(var i=0;i<objllist.length;i++)
	{
		objllist[i].style.visibility="";
	}
}

function ShowCalendar(idname){
	var objllist=document.getElementsByTagName('select');
	for(var i=0;i<objllist.length;i++)
	{
		objllist[i].style.visibility="hidden";
	} 
	var x,y,intLoop,intWeeks,intDays;
	var DivContent;
	var year,month,day;
	var o=getObj(idname);
	var thisyear; //真正的今年年份
	
	thisyear=new Date();
    thisyear=thisyear.getFullYear();

	today = o.value;
	if(isDate(today)){
		today = new getStringDay(today);
	}else{
		today = new getToday(); 
	}
	//显示的位置
/*	x=o.offsetLeft;
	y=o.offsetTop;
	while(o=o.offsetParent)
	{
	x+=o.offsetLeft;
	y+=o.offsetTop;
	}*/
	if (getObj('Calendar')) {
		var Cal=getObj('Calendar');
	} else {
		var Cal = elementBind('div','Calendar','','border-collapse: collapse;position:absolute; z-index:9999; visibility: hidden; filter:\"progid:DXImageTransform.Microsoft.Shadow(direction=135,color=#999999,strength=3)\"');
		document.body.appendChild(Cal);
	}

	//var Cal=getObj('Calendar');
	var rect = o.getBoundingClientRect();
    Cal.style.left=rect.left+2+ietruebody().scrollLeft+'px';
    Cal.style.top=rect.top+ietruebody().scrollTop+20+'px';
    Cal.style.visibility="visible";

	//下面开始输出日历表格(border-color:#9DBAF7)
	DivContent="<table border='0' cellspacing='0' style=' border: 1px solid #999;  background-color:#F1F8FC'>";
	DivContent+="<tr>";
	DivContent+="<td style='border-bottom:1px solid #ABCEE2; background-color:#C7D8FA'>";
	
	//年
	DivContent+="<select name='Year' id='Year' onChange='newCalendar()' style='font-family:Verdana; font-size:12px'>";
	for (intLoop = thisyear - 80; intLoop <= (thisyear + 20); intLoop++) {
		DivContent+="<option value= " + intLoop + " " + (today.year == intLoop ? "Selected" : "") + ">" + intLoop + "</option>"; 
	}
	DivContent+="</select>";

	//月
	DivContent+="<select name='Month' id='Month' onChange='newCalendar()' style='font-family:Verdana; font-size:12px'>";
	for (intLoop = 0; intLoop < months.length; intLoop++){ 
		DivContent+="<option value= " + (intLoop + 1) + " " + (today.month == intLoop ? "Selected" : "") + ">" + months[intLoop] + "</option>"; 
	}
	DivContent+="</select>";
	
	DivContent+="</td>";

	DivContent+="<td style='border-bottom:1px solid #ABCEE2; background-color:#C7D8FA; font-weight:bold; font-family:Wingdings 2,Wingdings,Webdings; font-size:16px; padding-top:2px; color:#4477FF; cursor:hand' align='center' title='关闭' onClick='javascript:HiddenCalendar()'>S</td>";
	DivContent+="</tr>";
	
	DivContent+="<tr><td align='center' colspan='2'>";
	DivContent+="<table id='Day' border='0' width='100%'>";

	//星期
	DivContent+="<tr>";
	for (intLoop = 0; intLoop < days.length; intLoop++) 
	DivContent+="<td align='center' style='font-size:12px'>" + days[intLoop] + "</td>"; 
	DivContent+="</tr>";

	//天
	for (intWeeks = 0; intWeeks < 6; intWeeks++){ 
		DivContent+="<tr>"; 
		for (intDays = 0; intDays < days.length; intDays++) {
			DivContent+="<td onClick='GetDate(\"" + idname + "\",event)' style='cursor:pointer; border-right:1px solid #BBBBBB; border-bottom:1px solid #BBBBBB; color:#215DC6; font-family:Verdana;line-height:16px;height:16px; font-size:12px' align='center'></td>"; 
		}
		DivContent+="</tr>"; 
	} 
	DivContent+="</table></td></tr></table>";

	getObj("Calendar").innerHTML=DivContent;
	newCalendar();
}

function isDate(dateStr){ 
	var datePat = /^(\d{4})(\-)(\d{1,2})(\-)(\d{1,2})$/;
	var matchArray = dateStr.match(datePat);
	if (matchArray == null) return false; 
	var month = matchArray[3];
	var day = matchArray[5]; 
	var year = matchArray[1]; 
	if (month < 1 || month > 12) return false; 
	if (day < 1 || day > 31) return false; 
	if ((month==4 || month==6 || month==9 || month==11) && day==31) return false; 
	if (month == 2){
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0)); 
		if (day > 29 || (day==29 && !isleap)) return false; 
	} 
	return true;
}
function getObj(id) {
	return document.getElementById(id);
}
function elementBind(type,id,stylename,csstext){
	var element = document.createElement(type);
	if (id) {
		element.id = id;
	}
	if (typeof(stylename) == 'string') {
		element.className = stylename;
	}
	if (typeof(csstext) == 'string') {
		element.style.cssText = csstext;
	}
	return element;
}
function ietruebody() {
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}