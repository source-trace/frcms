// JavaScript Document
function sendc(){
	showsendsms.style.display='none';
}
function send(){
	showsendsms.style.display='none';
	member=formsms.member.value;
	mobno=formsms.mobno.value;
	smsmsg=formsms.msg.value;
	url=formsms.url.value;
	var xmlhttp;
	try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}
	catch (e){
		try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
		catch (e){
			try{xmlhttp=new XMLHttpRequest();}
			catch (e)
				{}
		}
	}
	//创建请求，并使用escape对email编码，以避免乱码
	xmlhttp.open("get",url+"inc/sms.php?member="+member+ "&mobno="+escape(mobno)+ "&smsmsg="+smsmsg+ "&t=" + new Date().getTime());
	xmlhttp.onreadystatechange=function()
	{if(4==xmlhttp.readyState)
	{if(200==xmlhttp.status)
	{msg=xmlhttp.responseText;}
	else{msg="失败！";}
	var ch=document.getElementById("s_"+member);
	ch.innerHTML=msg; 
	}else{msg="发送中";
	var ch=document.getElementById("s_"+member);
	ch.innerHTML=msg; 
	}
}
xmlhttp.send(null); 
return false;
}

function loadsms()
{
	s = '<div id="showsendsms" style="position:absolute;padding:0; border:1px #CCCCCC solid; z-index:99999; background:#FFFFFF; display:none;">';
	s += '<table border="0" cellpadding="4" style="width:320px;">';
	s += '<tr>';
	s += '<td style="border-bottom:1px #CCCCCC solid;color:#135294;font-weight:bold;background:#E0EEF5;"><span style=" float:right; cursor:pointer;" onClick="sendc();">关闭</span>发送通知短信</td>';
	s += '</tr>';
	s += '<form name="formsms" action="" method="post">';
	s += '<tr>';
	s += '<td id="msgcon"></td>';
	s += '</tr>';
	s += '<tr>';
	s += '<td><textarea name="msg" cols="50" rows="5" style="border:1px #CCCCCC solid" onpropertychange="msgfnum.value=this.value.length"></textarea></td>';
	s += '</tr>';
	s += '<tr>';
	s += '<td>每70个字为一条 已填写：<input name="msgfnum" type="text" value="0" size="2" readonly="readonly"  />个</td>';
	s += '</tr>';
	s += '<tr>';
	s += '<td><input type="hidden" name="member" value=""><input type="hidden" name="url" value=""><input type="hidden" name="mobno" value=""><input name="Submit" type="button" onClick="send();" class="inputs" value="立即发送" /></td>';
	s += '</tr>';
	s += '</form>';
	s += '</table>';
	s += '</div>';
	document.write(s);
}

function sendsms(member,membertype,mobno,name,url,evt) {
	evt=evt||window.event;
	var sTop;
	if (document.compatMode == "BackCompat") {
	   sTop = document.body.scrollTop;
	}else {
	   sTop = document.documentElement.scrollTop == 0 ? document.body.scrollTop : document.documentElement.scrollTop;
	}
	document.formsms.msg.value = name+',您好！';
	document.formsms.member.value=member;
	document.formsms.mobno.value=mobno;
	document.formsms.url.value=url;
	var msgcon=document.getElementById("msgcon")
	if (membertype==1){
		msgcon.innerHTML='<input name="msgtype" type="radio" value="'+name+',您好！您的账号已审核通过，可以使用我们提供的各项服务啦！请尽快完善您的简历，祝您天天有个好心情！" onclick="msg.value=this.value" />审核通知<input name="msgtype" type="radio" value="'+name+',您好！您的简历已推荐，推荐的简历可以被更多的企业浏览，祝您求职愉快！" onclick="msg.value=this.value" />精英推荐<input name="msgtype" type="radio" value="'+name+',您好！今天是您的生日，祝您生日快乐，笑口常开！" onclick="msg.value=this.value" />生日祝福<input name="msgtype" type="radio" value="温馨提醒：您的会员服务已过期，如您对我们服务满意或仍有求职需求，请联系客服人员！" onclick="msg.value=this.value" />到期提醒';}
	else if(membertype==2){
		msgcon.innerHTML='<input name="msgtype" type="radio" value="您好！账号已审核通过，可以使用我们提供的招聘服务啦！请尽快完善基本资料并发布招聘职位！" onclick="msg.value=this.value" />审核通知<input name="msgtype" type="radio" value="温馨提醒：您的会员服务已过期，如您对我们服务满意或仍有招聘需求，请联系客服人员！" onclick="msg.value=this.value" />到期提醒';}
	else if(membertype==3){
		msgcon.innerHTML='<input name="msgtype" type="radio" value="您好！账号已审核通过，可以使用我们提供的各项服务啦！" onclick="msg.value=this.value" />审核通知';}
	else if(membertype==4){
		msgcon.innerHTML='<input name="msgtype" type="radio" value="您好！账号已审核通过，可以使用我们提供的各项服务啦！" onclick="msg.value=this.value" />审核通知';}
	showsendsms.style.display="";
	showsendsms.style.left=evt.clientX-10; //鼠标目前的位置
	showsendsms.style.top=evt.clientY + sTop-5; 
}  
loadsms();