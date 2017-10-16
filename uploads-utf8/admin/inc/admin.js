// JavaScript Document
// 关闭/打开左菜单
var status = 1;
function switchSysBar(){
     if (1 == window.status){
		  window.status = 0;
          document.getElementById('switchPoint').innerHTML = '<img src="Images/lere01.gif">';
          document.getElementById("frmleft").style.display="none"
     }
     else{
		  window.status = 1;
          document.getElementById('switchPoint').innerHTML = '<img src="Images/lere.gif">';
          document.getElementById("frmleft").style.display=""
     }
}
// 获取管理菜单标题
function getleftbar(obj,id_num,maxs,num){
	var titleobj=obj.getElementsByTagName("a");
	if (titleobj[0]){
		document.getElementById("leftmenu_title").innerHTML = titleobj[0].innerHTML;
	}
	for(var i=0;i<maxs;i++){document.getElementById("menu_"+id_num+i).className=""}
	document.getElementById("menu_"+id_num+num).className="tabms";
}
with (document) {
write("<Div id='VicPopCal' style='POSITION:absolute;VISIBILITY:hidden;border:0px ridge;width:100%;height:100%;top:0;left:0;z-index:100;overflow:hidden;dlsplay:none'>");
write("</Div>");
}

// ******************************默认设置定义******************************
var TipsPop = null;
var TipsoffsetX = 10; // 提示框位于鼠标左侧或者右侧的距离；3-12 合适
var TipsoffsetY = 15; // 提示框位于鼠标下方的距离；3-12 合适
var TipsPopbg = "#FFFFFF"; // 提示框背景色
var TipsPopfg = "infotext"; // 提示框前景色
var TipsAlpha = 90; // 提示框透明度，100为不透明
var Tipsshadowcolor = "threedlightshadow"; // 提示框阴影颜色
var Tipsshadowdirection = 135; // 提示框阴影方向
var TipsTitlebg = "activecaption"; // 提示框标题文字背景
var TipsTitlefg = "captiontext"; // 提示框标题文字颜色
var TipsBorderColor = "activecaption"; // 提示框标题边框颜色
var TipsBorder	= 0; // 提示框标题边框宽度
var TipsBaseWidth = 200; // 提示框最小宽度 注意这个值最好不要小于提示框的象素宽度
var TipsTitle = ""; // 提示框标题文字
var TipsSmallTitle = "系统提示";	// 提示框副标题文字 
var TipsTitleCt = " " // 标题文字和副标题文字之间的连接符

var FormObj;
var UsedForm="none";
var TipsLayer;
// ==================================================================================

document.write('<div id=TipsLayers style="display: none;position: absolute; z-index:10001"></div>');

function Tips(ev){
    var Event=window.event||ev;
    var o=Event.srcElement || Event.target;
    if(o.alt!=null && o.alt!=""){o.dypop=o.alt;o.alt=""};
    if(o.title!=null && o.title!=""){o.dypop=o.title;o.title=""};
	TipsPop=o.dypop;
    TipsLayer=document.getElementById('TipsLayers');
	if(TipsPop!=null && TipsPop!="" && typeof(TipsPop)!="undefined"){
		TipsLayer.style.left=-1000;
		TipsLayer.style.display='';
		var Msg = TipsPop.replace(/\n/g,"<br>"); // 换行符
		Msg = Msg.replace(/\r/g,"<br>"); // 回车符
		if(TipsSmallTitle==""){TipsTitleCt="";}
		var attr=(document.location.toString().toLowerCase().indexOf("list.asp")>0?"nowrap":"");
		var content = '<table style="FILTER:alpha(opacity='+TipsAlpha+') shadow(color='+Tipsshadowcolor+',direction='+Tipsshadowdirection+');" id=toolTipTalbes border=0><tr><td width="100%"><table border=0 cellspacing="'+TipsBorder+'" cellpadding="2" style="width:100%;background-color:'+TipsBorderColor+';">'+
		'<tr id=TipsPoptops><th style="width:100%; color:'+TipsTitlefg+'; background-color:'+TipsTitlebg+';" class=s><b><p id=toplefts align=left>↖ '+TipsTitle+TipsTitleCt+TipsSmallTitle+'</p><p id=toprights align=right style="display:none" class=s>'+TipsSmallTitle+TipsTitleCt+TipsTitle+' ↗</font></b></th></tr>'+
		'<tr><td '+attr+' style="width:100%; background-color:'+TipsPopbg+'; color:'+TipsPopfg+'; padding-left:10px; padding-right:10px; padding-top: 4px; padding-bottom:4px; line-height:135%;font-family: Verdana, Arial, Helvetica, sans-serif, "宋体";" class=s>'+Msg+'</td></tr>'+
		'<tr id=TipsPopbots style="display:none" class=s><th style="width:100%;color:'+TipsTitlefg+';background-color:'+TipsTitlebg+';" class=s><b><p id=botlefts align=left>↙ '+TipsTitle+TipsTitleCt+TipsSmallTitle+'</p><p id=botrights align=right style="display:none">'+TipsSmallTitle+TipsTitleCt+TipsTitle+' ↘</font></b></th></tr>'+
		'</table></td></tr></table>';
		TipsLayer.innerHTML = content;
		var toolTipwidth = Math.min(TipsLayer.clientWidth, document.body.clientWidth/2.2);
		if(toolTipwidth<TipsBaseWidth){toolTipwidth=TipsBaseWidth;}
		document.getElementById('toolTipTalbes').style.width=toolTipwidth;
		MoveToMouseLoc(ev);
		return true;
	}else{
		TipsLayer.innerHTML='';
		TipsLayer.style.display='none';
		return true;
	}
}

function MoveToMouseLoc(ev){
	if(TipsLayer.innerHTML==''){return true;}
	var Event=window.event||ev;
	var MouseX=Event.clientX;
	var MouseY=Event.clientY;
	//window.status="x:"+event.offsetX;
	//window.status+=" y:"+event.offsetY;
	var popHeight=TipsLayer.clientHeight;
	var popWidth=TipsLayer.clientWidth;
    TipsPoptop=document.getElementById('TipsPoptops');
    TipsPopbot=document.getElementById('TipsPopbots');
    topleft=document.getElementById('toplefts');
    botleft=document.getElementById('botlefts');
    topright=document.getElementById('toprights');
    botright=document.getElementById('botrights');
	if(MouseY+TipsoffsetY+popHeight>document.body.clientHeight){
		popTopAdjust=-popHeight-TipsoffsetY*1.5;
		TipsPoptop.style.display="none";
		TipsPopbot.style.display="none";
	}else{
		popTopAdjust=0;
		TipsPoptop.style.display="none";
		TipsPopbot.style.display="none";
	}
	if(MouseX+TipsoffsetX+popWidth>document.body.clientWidth){
		popLeftAdjust=-popWidth-TipsoffsetX*2;
		topleft.style.display="none";
		botleft.style.display="none";
		topright.style.display="none";
		botright.style.display="none";
	}else{
		popLeftAdjust=0;
		topleft.style.display="none";
		botleft.style.display="none";
		topright.style.display="none";
		botright.style.display="none";
	}
	TipsLayer.style.left=MouseX+TipsoffsetX+document.documentElement.scrollLeft+popLeftAdjust+"px";
	TipsLayer.style.top=MouseY+TipsoffsetY+document.documentElement.scrollTop+popTopAdjust+"px";
	return true;
}

document.onmousemove = Tips;