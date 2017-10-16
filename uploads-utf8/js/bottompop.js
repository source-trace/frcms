//setTimeout("getMsg()",2000)
window.onload = getMsg;
window.onresize = resizeDiv;

window.onerror = function(){}
var divTop,divLeft,divWidth,divHeight,docHeight,docWidth,objTimer,i = 10;
function getMsg()
{
try{
divTop = parseInt(document.getElementById("eMeng").style.top,10)
divLeft = parseInt(document.getElementById("eMeng").style.left,10)
divHeight = parseInt(document.getElementById("eMeng").offsetHeight,10)
divWidth = parseInt(document.getElementById("eMeng").offsetWidth,10)
docWidth = document.documentElement.clientWidth;
docHeight = document.documentElement.clientHeight;
document.getElementById("eMeng").style.top = parseInt(document.documentElement.scrollTop,10) + docHeight + 10;// divHeight
document.getElementById("eMeng").style.left = parseInt(document.documentElement.scrollLeft,10) + docWidth - divWidth
document.getElementById("eMeng").style.visibility="visible"
objTimer = window.setInterval("moveDiv()",10)
}
catch(e){}
}

function resizeDiv()
{
i+=1
//if(i>1300) closeDiv() //客户想不用自动消失由用户来自己关闭所以屏蔽这句
try{
divHeight = parseInt(document.getElementById("eMeng").offsetHeight,10)
divWidth = parseInt(document.getElementById("eMeng").offsetWidth,10)
docWidth = document.documentElement.clientWidth;
docHeight = document.documentElement.clientHeight;
document.getElementById("eMeng").style.top = docHeight - divHeight + parseInt(document.documentElement.scrollTop,10);
document.getElementById("eMeng").style.left = docWidth - divWidth + parseInt(document.documentElement.scrollLeft,10)
}
catch(e){}
}

function moveDiv()
{
try
{
if(parseInt(document.getElementById("eMeng").style.top,10) <= (docHeight - divHeight + parseInt(document.documentElement.scrollTop,10)))
{
window.clearInterval(objTimer)
objTimer = window.setInterval("resizeDiv()",1)
}
divTop = parseInt(document.getElementById("eMeng").style.top,10)
document.getElementById("eMeng").style.top = divTop - 1
}
catch(e){}
}
function closeDiv()
{
document.getElementById('eMeng').innerHTML='';
document.getElementById('eMeng').style.visibility='hidden';
if(objTimer) window.clearInterval(objTimer)
}
