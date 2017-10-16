function JumpSearchLayers(typeid,positionid,arrayid,fname,vname,tname)
{
	var objllist=document.getElementsByTagName('select');
	for(var i=0;i<objllist.length;i++)
	{
		objllist[i].style.visibility="hidden";
	} 
	document.getElementById("bodyly").style.display="block";
	document.getElementById("bodyly").style.width=document.body.clientWidth+"px";
	
	if (document.body.scrollHeight>document.body.clientHeight)
	{document.getElementById("bodyly").style.height=document.body.scrollHeight+"px";}
	else
	{document.getElementById("bodyly").style.height=document.body.clientHeight+"px";}
	
	document.getElementById("SearchDivhire").style.display='block';
	document.getElementById("SearchDivhire").style.top=(document.documentElement.scrollTop+60)+"px";;  
	document.getElementById("SearchDivhire").style.left=(document.body.clientWidth/2-280)+"px";;
	var onecount;
	if (arrayid==1)
	{
	onecount=posiArray.length;
	arraynames=posiArray;
	document.getElementById("wintit").innerHTML='请选择岗位类别';
	strs='<span style="float:left; width:530px; line-height:24px;font-weight:bold; font-size:13px;">请选择职位</span>';
	}
	if (arrayid==2)
	{
	onecount=provArray.length;
	arraynames=provArray;
	document.getElementById("wintit").innerHTML='请选择所在省会';
	strs='<span style="float:left; width:530px; line-height:24px;font-weight:bold; font-size:13px;">请选择城市</span>';
	}
	if (arrayid==3)
	{
	onecount=posiArrays.length;
	arraynames=posiArrays;
	document.getElementById("wintit").innerHTML='请选择岗位类别';
	strs='<span style="float:left; width:530px; line-height:24px;font-weight:bold; font-size:13px;">请选择职位</span>';
	}
	if (arrayid==4)
	{
	onecount=tradeArray.length;
	arraynames=tradeArray;
	document.getElementById("wintit").innerHTML='请选择行业类别';
	strs='<span style="float:left; width:530px; line-height:24px;font-weight:bold; font-size:13px;">请选择行业</span>';
	}
	if (arrayid==5)
	{
	onecount=profArray.length;
	arraynames=profArray;
	document.getElementById("wintit").innerHTML='请选择专业类别';
	strs='<span style="float:left; width:530px; line-height:24px;font-weight:bold; font-size:13px;">请选择专业</span>';
	}
	var i;
	str='';
	if (typeid==2)
	{
		str='';
	}
	else
	if (typeid==0)
	{
		str='';
	}
	else
	{
		str=strs;
	}
	for (i=0;i<onecount;i++)
	{
	if (typeid==2)
	{
		document.getElementById("hiretype").innerHTML='';
		str+='<li style="float:left;width:170px;height:20px;cursor:pointer;overflow:hidden;" onclick=document.'+fname+'.'+vname+'.value="'+arraynames[i][0]+'";document.'+fname+'.'+tname+'.value="'+arraynames[i][2]+'";unSearchLayers();>'+arraynames[i][0]+'</li>'
		document.getElementById("hiretypes").innerHTML=str+'<li style="float:left;width:170px;height:20px;cursor:pointer;color:#FF0000;" onclick=document.'+fname+'.'+vname+'.value="不限";document.'+fname+'.'+tname+'.value="";unSearchLayers();>行业不限</li>';
	}
	else
		if (arraynames[i][1] == positionid)
		{
			if (typeid==0)
			{
				document.getElementById("hiretype").innerHTML='';
				str+='<li onclick=JumpSearchLayers(1,'+arraynames[i][2]+','+arrayid+',"'+fname+'","'+vname+'","'+tname+'");InsertType('+arraynames[i][2]+',"'+fname+'","'+vname+'","'+tname+'","'+arraynames[i][0]+'"); onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" style="float:left;width:170px;height:20px;cursor:pointer;">'+arraynames[i][0]+'</li>'
				document.getElementById("hiretypes").innerHTML=str+'<li style="float:left;width:170px;height:20px;cursor:pointer;color:#FF0000;" onclick=document.'+fname+'.'+vname+'.value="不限";document.'+fname+'.'+tname+'.value="";unSearchLayers();>大类不限</li>';
			}
			//写地区的一级城市
			else if (typeid==4)
			{
				document.getElementById("hiretype").innerHTML='';
				document.getElementById("hiretypesss").innerHTML='';
				str+='<li onclick=JumpSearchLayers(5,'+arraynames[i][2]+','+arrayid+',"'+fname+'","'+vname+'","'+tname+'"); onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" style="float:left;width:170px;height:20px;cursor:pointer;">'+arraynames[i][0]+'</li>'
				document.getElementById("hiretypes").innerHTML=str;
			}
			//写地区的三级城市
			else if (typeid==5)
			{
				document.getElementById("hiretype").innerHTML='';
				str+='<li onclick=JumpSearchLayers(1,'+arraynames[i][2]+','+arrayid+',"'+fname+'","'+vname+'","'+tname+'"); onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" style="float:left;width:170px;height:20px;cursor:pointer;">'+arraynames[i][0]+'</li>'
				document.getElementById("hiretypesss").innerHTML=str;
			}
			else
			{
				document.getElementById("hiretype").innerHTML='';
				str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onclick=document.'+fname+'.'+vname+'.value="'+arraynames[i][0]+'";document.'+fname+'.'+tname+'.value="'+arraynames[i][2]+'";unSearchLayers();>'+arraynames[i][0]+'</li>'
				document.getElementById("hiretype").innerHTML=str;
			}
		}
	}
}

function InsertType(positionid,fname,vname,tname,nname)
{
document.getElementById("hiretype").innerHTML=document.getElementById("hiretype").innerHTML+'<li style="float:left;width:170px;height:20px;cursor:pointer;color:#FF0000;" onclick=document.'+fname+'.'+vname+'.value="'+nname+'-不限";document.'+fname+'.'+tname+'.value="'+positionid+'";unSearchLayers();>'+nname+'-不限</li>'
}

function JumpSearchDate(fname,vname,tname)
{
	var objllist=document.getElementsByTagName('select');
	for(var i=0;i<objllist.length;i++)
	{
		objllist[i].style.visibility="hidden";
	} 
document.getElementById("wintit").innerHTML='请选择查询日期';
document.getElementById("hiretypes").innerHTML='';
document.getElementById("hiretype").innerHTML='';
document.getElementById("SearchDivhire").style.display = "block";
document.getElementById("bodyly").style.display="block";
document.getElementById("bodyly").style.width=document.body.clientWidth+"px";   
document.getElementById("bodyly").style.height=document.body.clientHeight+"px";
document.getElementById("SearchDivhire").style.display='block';
document.getElementById("SearchDivhire").style.top=(document.documentElement.scrollTop+60)+"px";   
document.getElementById("SearchDivhire").style.left=(document.body.clientWidth/2-270)+"px";
str='';
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="1";document.'+fname+'.'+vname+'.value="近一天";unSearchLayers();>·近一天</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="2";document.'+fname+'.'+vname+'.value="近两天";unSearchLayers();>·近两天</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="3";document.'+fname+'.'+vname+'.value="近三天";unSearchLayers();>·近三天</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="7";document.'+fname+'.'+vname+'.value="近一周";unSearchLayers();>·近一周</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="14";document.'+fname+'.'+vname+'.value="近两周";unSearchLayers();>·近两周</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="30";document.'+fname+'.'+vname+'.value="近一月";unSearchLayers();>·近一月</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="42";document.'+fname+'.'+vname+'.value="近六周";unSearchLayers();>·近六周</li>'
str+='<li style="float:left;width:170px;height:20px;cursor:pointer;" onmouseover=this.style.background="#F1F8FC" onmouseout=this.style.background="" onclick=document.'+fname+'.'+tname+'.value="60";document.'+fname+'.'+vname+'.value="近两月";unSearchLayers();>·近两月</li>'
document.getElementById("hiretypes").innerHTML=str;
}
function unSearchLayers()
{
	var objllist=document.getElementsByTagName('select');
	for(var i=0;i<objllist.length;i++)
	{
		objllist[i].style.visibility="";
	} 
	document.getElementById("SearchDivhire").style.display  = "none";
	document.getElementById("bodyly").style.display="none";
}

<!--实现层移动-->
var Obj;
 document.onmouseup=MUp;
 document.onmousemove=MMove;
 document.onmousedown=MDown;
function down(objs){
    Obj = document.getElementById(objs);
}
function MDown(event) {
 if(Obj){
      if (window.event) {/*IE*/
       event = window.event;
       Obj.setCapture();
      }
      else {/*Firefox*/
       window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
      }
      pX=event.clientX-Obj.offsetLeft;
      pY=event.clientY-Obj.offsetTop;
    }
 }
 function MMove(event) {
  if (window.event) event = window.event;
  if(Obj){
   Obj.style.left=event.clientX-pX + "px";
   Obj.style.top=event.clientY-pY + "px";
  }
 }
 function MUp(event) {
  if(Obj){
   if (window.event) Obj.releaseCapture();
   else window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
   Obj=null;
  }
 }