var Class={create:function(){return function(){this.initialize.apply(this,arguments);}}}
Object.extend=function(destination,source){for(property in source)destination[property]=source[property];return destination;}
Function.prototype.bind=function(object){var __method=this;return function(){return __method.apply(object,arguments);}}
Function.prototype.bindAsEventListener=function(object){var __method=this;return function(event){__method.call(object,event||window.event);}}
function $(){if(arguments.length==1)return get$(arguments[0]);var elements=[];$c(arguments).each(function(el){elements.push(get$(el));});return elements;function get$(el){if(typeof el=='string')el=document.getElementById(el);return el;}}
if(!window.Element)var Element=new Object();Object.extend(Element,{remove:function(element){element=$(element);element.parentNode.removeChild(element);},hasClassName:function(element,className){element=$(element);if(!element)return;var hasClass=false;element.className.split(' ').each(function(cn){if(cn==className)hasClass=true;});return hasClass;},addClassName:function(element,className){element=$(element);Element.removeClassName(element,className);element.className+=' '+className;},removeClassName:function(element,className){element=$(element);if(!element)return;var newClassName='';element.className.split(' ').each(function(cn,i){if(cn!=className){if(i>0)newClassName+=' ';newClassName+=cn;}});element.className=newClassName;},cleanWhitespace:function(element){element=$(element);$c(element.childNodes).each(function(node){if(node.nodeType==3&&!/\S/.test(node.nodeValue))Element.remove(node);});},find:function(element,what){element=$(element)[what];while(element.nodeType!=1)element=element[what];return element;}});var Position={cumulativeOffset:function(element){var valueT=0,valueL=0;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;element=element.offsetParent;}while(element);return[valueL,valueT];}};document.getElementsByClassName=function(className){var children=document.getElementsByTagName('*')||document.all;var elements=[];$c(children).each(function(child){if(Element.hasClassName(child,className))elements.push(child);});return elements;}
Array.prototype.iterate=function(func){for(var i=0;i<this.length;i++)func(this[i],i);}
if(!Array.prototype.each)Array.prototype.each=Array.prototype.iterate;function $c(array){var nArray=[];for(var i=0;i<array.length;i++)nArray.push(array[i]);return nArray;}
var fileLoadingImage="images/loading.gif";var fileBottomNavCloseImage="images/closelabel.gif";var resizeSpeed=6;var borderSize=10;var imageArray=new Array;var activeImage;if(resizeSpeed>10){resizeSpeed=10;}
if(resizeSpeed<1){resizeSpeed=1;}
resizeDuration=(11-resizeSpeed)*100;Object.extend(Element,{hide:function(){for(var i=0;i<arguments.length;i++){var element=$(arguments[i]);element.style.display='none';}},show:function(){for(var i=0;i<arguments.length;i++){var element=$(arguments[i]);element.style.display='';}},getWidth:function(element){element=$(element);return element.offsetWidth;},setWidth:function(element,w){element=$(element);element.style.width=w+"px";},getHeight:function(element){element=$(element);return element.offsetHeight;},setHeight:function(element,h){element=$(element);element.style.height=h+"px";},setTop:function(element,t){element=$(element);element.style.top=t+"px";},setSrc:function(element,src){element=$(element);element.src=src;},setInnerHTML:function(element,content){element=$(element);element.innerHTML=content;}});Array.prototype.removeDuplicates=function(){for(i=1;i<this.length;i++){if(this[i][0]==this[i-1][0]){this.splice(i,1);}}}
Array.prototype.empty=function(){for(i=0;i<=this.length;i++){this.shift();}}
var Lightbox=Class.create();Lightbox.prototype={initialize:function(){if(!document.getElementsByTagName){return;}
var anchors=document.getElementsByTagName('a');for(var i=0;i<anchors.length;i++){var anchor=anchors[i];var relAttribute=String(anchor.getAttribute('rel'));if(anchor.getAttribute('href')&&(relAttribute.toLowerCase().match('lightbox'))){anchor.onclick=function(){myLightbox.start(this);return false;}}}
var objBody=document.getElementsByTagName("body").item(0);var objOverlay=document.createElement("div");objOverlay.setAttribute('id','overlay');objOverlay.onclick=function(){myLightbox.end();return false;}
objBody.appendChild(objOverlay);var objLightbox=document.createElement("div");objLightbox.setAttribute('id','lightbox');objLightbox.style.display='none';objBody.appendChild(objLightbox);var objOuterImageContainer=document.createElement("div");objOuterImageContainer.setAttribute('id','outerImageContainer');objLightbox.appendChild(objOuterImageContainer);var objImageContainer=document.createElement("div");objImageContainer.setAttribute('id','imageContainer');objOuterImageContainer.appendChild(objImageContainer);var objLightboxImage=document.createElement("img");objLightboxImage.setAttribute('id','lightboxImage');objImageContainer.appendChild(objLightboxImage);var objHoverNav=document.createElement("div");objHoverNav.setAttribute('id','hoverNav');objImageContainer.appendChild(objHoverNav);var objPrevLink=document.createElement("a");objPrevLink.setAttribute('id','prevLink');objPrevLink.setAttribute('href','#');objHoverNav.appendChild(objPrevLink);var objNextLink=document.createElement("a");objNextLink.setAttribute('id','nextLink');objNextLink.setAttribute('href','#');objHoverNav.appendChild(objNextLink);var objLoading=document.createElement("div");objLoading.setAttribute('id','loading');objImageContainer.appendChild(objLoading);var objLoadingLink=document.createElement("a");objLoadingLink.setAttribute('id','loadingLink');objLoadingLink.setAttribute('href','#');objLoadingLink.onclick=function(){myLightbox.end();return false;}
objLoading.appendChild(objLoadingLink);var objLoadingImage=document.createElement("img");objLoadingImage.setAttribute('src',fileLoadingImage);objLoadingLink.appendChild(objLoadingImage);var objImageDataContainer=document.createElement("div");objImageDataContainer.setAttribute('id','imageDataContainer');objImageDataContainer.className='clearfix';objLightbox.appendChild(objImageDataContainer);var objImageData=document.createElement("div");objImageData.setAttribute('id','imageData');objImageDataContainer.appendChild(objImageData);var objImageDetails=document.createElement("div");objImageDetails.setAttribute('id','imageDetails');objImageData.appendChild(objImageDetails);var objCaption=document.createElement("span");objCaption.setAttribute('id','caption');objImageDetails.appendChild(objCaption);var objNumberDisplay=document.createElement("span");objNumberDisplay.setAttribute('id','numberDisplay');objImageDetails.appendChild(objNumberDisplay);var objBottomNav=document.createElement("div");objBottomNav.setAttribute('id','bottomNav');objImageData.appendChild(objBottomNav);var objBottomNavCloseLink=document.createElement("a");objBottomNavCloseLink.setAttribute('id','bottomNavClose');objBottomNavCloseLink.setAttribute('href','#');objBottomNavCloseLink.onclick=function(){myLightbox.end();return false;}
objBottomNav.appendChild(objBottomNavCloseLink);var objBottomNavCloseImage=document.createElement("img");objBottomNavCloseImage.setAttribute('src',fileBottomNavCloseImage);objBottomNavCloseLink.appendChild(objBottomNavCloseImage);overlayEffect=new fx.Opacity(objOverlay,{duration:300});overlayEffect.hide();imageEffect=new fx.Opacity(objLightboxImage,{duration:350,onComplete:function(){imageDetailsEffect.custom(0,1);}});imageEffect.hide();imageDetailsEffect=new fx.Opacity('imageDataContainer',{duration:400,onComplete:function(){navEffect.custom(0,1);}});imageDetailsEffect.hide();navEffect=new fx.Opacity('hoverNav',{duration:100});navEffect.hide();},start:function(imageLink){hideSelectBoxes();var arrayPageSize=getPageSize();Element.setHeight('overlay',arrayPageSize[1]);overlayEffect.custom(0,0.8);imageArray=[];imageNum=0;if(!document.getElementsByTagName){return;}
var anchors=document.getElementsByTagName('a');if((imageLink.getAttribute('rel')=='lightbox')){imageArray.push(new Array(imageLink.getAttribute('href'),imageLink.getAttribute('title')));}else{for(var i=0;i<anchors.length;i++){var anchor=anchors[i];if(anchor.getAttribute('href')&&(anchor.getAttribute('rel')==imageLink.getAttribute('rel'))){imageArray.push(new Array(anchor.getAttribute('href'),anchor.getAttribute('title')));}}
imageArray.removeDuplicates();while(imageArray[imageNum][0]!=imageLink.getAttribute('href')){imageNum++;}}
var arrayPageSize=getPageSize();var arrayPageScroll=getPageScroll();var lightboxTop=arrayPageScroll[1]+(arrayPageSize[3]/15);Element.setTop('lightbox',lightboxTop);Element.show('lightbox');this.changeImage(imageNum);},changeImage:function(imageNum){activeImage=imageNum;Element.show('loading');imageDetailsEffect.hide();imageEffect.hide();navEffect.hide();Element.hide('prevLink');Element.hide('nextLink');Element.hide('numberDisplay');imgPreloader=new Image();imgPreloader.onload=function(){Element.setSrc('lightboxImage',imageArray[activeImage][0]);myLightbox.resizeImageContainer(imgPreloader.width,imgPreloader.height);}
imgPreloader.src=imageArray[activeImage][0];},resizeImageContainer:function(imgWidth,imgHeight){this.wCur=Element.getWidth('outerImageContainer');this.hCur=Element.getHeight('outerImageContainer');wDiff=(this.wCur-borderSize*2)-imgWidth;hDiff=(this.hCur-borderSize*2)-imgHeight;reHeight=new fx.Height('outerImageContainer',{duration:resizeDuration});reHeight.custom(Element.getHeight('outerImageContainer'),imgHeight+(borderSize*2));reWidth=new fx.Width('outerImageContainer',{duration:resizeDuration,onComplete:function(){imageEffect.custom(0,1);}});reWidth.custom(Element.getWidth('outerImageContainer'),imgWidth+(borderSize*2));if((hDiff==0)&&(wDiff==0)){if(navigator.appVersion.indexOf("MSIE")!=-1){pause(250);}else{pause(100);}}
Element.setHeight('prevLink',imgHeight);Element.setHeight('nextLink',imgHeight);Element.setWidth('imageDataContainer',imgWidth+(borderSize*2));Element.setWidth('hoverNav',imgWidth+(borderSize*2));this.showImage();},showImage:function(){Element.hide('loading');myLightbox.updateDetails();this.preloadNeighborImages();},updateDetails:function(){Element.show('caption');Element.setInnerHTML('caption',imageArray[activeImage][1]);if(imageArray.length>1){Element.show('numberDisplay');Element.setInnerHTML('numberDisplay',"Image "+eval(activeImage+1)+" of "+imageArray.length);}
myLightbox.updateNav();},updateNav:function(){if(activeImage!=0){Element.show('prevLink');document.getElementById('prevLink').onclick=function(){myLightbox.changeImage(activeImage-1);return false;}}
if(activeImage!=(imageArray.length-1)){Element.show('nextLink');document.getElementById('nextLink').onclick=function(){myLightbox.changeImage(activeImage+1);return false;}}
this.enableKeyboardNav();},enableKeyboardNav:function(){document.onkeydown=this.keyboardAction;},disableKeyboardNav:function(){document.onkeydown='';},keyboardAction:function(e){if(e==null){keycode=event.keyCode;}else{keycode=e.which;}
key=String.fromCharCode(keycode).toLowerCase();if((key=='x')||(key=='o')||(key=='c')){myLightbox.end();}else if(key=='p'){if(activeImage!=0){myLightbox.disableKeyboardNav();myLightbox.changeImage(activeImage-1);}}else if(key=='n'){if(activeImage!=(imageArray.length-1)){myLightbox.disableKeyboardNav();myLightbox.changeImage(activeImage+1);}}},preloadNeighborImages:function(){if((imageArray.length-1)>activeImage){preloadNextImage=new Image();preloadNextImage.src=imageArray[activeImage+1][0];}
if(activeImage>0){preloadPrevImage=new Image();preloadPrevImage.src=imageArray[activeImage-1][0];}},end:function(){this.disableKeyboardNav();Element.hide('lightbox');imageEffect.toggle();overlayEffect.custom(0.8,0);showSelectBoxes();}}
function getPageScroll(){var yScroll;if(self.pageYOffset){yScroll=self.pageYOffset;}else if(document.documentElement&&document.documentElement.scrollTop){yScroll=document.documentElement.scrollTop;}else if(document.body){yScroll=document.body.scrollTop;}
arrayPageScroll=new Array('',yScroll)
return arrayPageScroll;}
function getPageSize(){var xScroll,yScroll;if(window.innerHeight&&window.scrollMaxY){xScroll=document.body.scrollWidth;yScroll=window.innerHeight+window.scrollMaxY;}else if(document.body.scrollHeight>document.body.offsetHeight){xScroll=document.body.scrollWidth;yScroll=document.body.scrollHeight;}else{xScroll=document.body.offsetWidth;yScroll=document.body.offsetHeight;}
var windowWidth,windowHeight;if(self.innerHeight){windowWidth=self.innerWidth;windowHeight=self.innerHeight;}else if(document.documentElement&&document.documentElement.clientHeight){windowWidth=document.documentElement.clientWidth;windowHeight=document.documentElement.clientHeight;}else if(document.body){windowWidth=document.body.clientWidth;windowHeight=document.body.clientHeight;}
if(yScroll<windowHeight){pageHeight=windowHeight;}else{pageHeight=yScroll;}
if(xScroll<windowWidth){pageWidth=windowWidth;}else{pageWidth=xScroll;}
arrayPageSize=new Array(pageWidth,pageHeight,windowWidth,windowHeight)
return arrayPageSize;}
function getKey(e){if(e==null){keycode=event.keyCode;}else{keycode=e.which;}
key=String.fromCharCode(keycode).toLowerCase();if(key=='x'){}}
function listenKey(){document.onkeypress=getKey;}
function showSelectBoxes(){selects=document.getElementsByTagName("select");for(i=0;i!=selects.length;i++){selects[i].style.visibility="visible";}}
function hideSelectBoxes(){selects=document.getElementsByTagName("select");for(i=0;i!=selects.length;i++){selects[i].style.visibility="hidden";}}
function pause(numberMillis){var now=new Date();var exitTime=now.getTime()+numberMillis;while(true){now=new Date();if(now.getTime()>exitTime)
return;}}
function initLightbox(){myLightbox=new Lightbox();}
var fx=new Object();fx.Base=function(){};fx.Base.prototype={setOptions:function(options){this.options={duration:500,onComplete:'',transition:fx.sinoidal}
Object.extend(this.options,options||{});},step:function(){var time=(new Date).getTime();if(time>=this.options.duration+this.startTime){this.now=this.to;clearInterval(this.timer);this.timer=null;if(this.options.onComplete)setTimeout(this.options.onComplete.bind(this),10);}
else{var Tpos=(time-this.startTime)/(this.options.duration);this.now=this.options.transition(Tpos)*(this.to-this.from)+this.from;}
this.increase();},custom:function(from,to){if(this.timer!=null)return;this.from=from;this.to=to;this.startTime=(new Date).getTime();this.timer=setInterval(this.step.bind(this),13);},hide:function(){this.now=0;this.increase();},clearTimer:function(){clearInterval(this.timer);this.timer=null;}}
fx.Layout=Class.create();fx.Layout.prototype=Object.extend(new fx.Base(),{initialize:function(el,options){this.el=$(el);this.el.style.overflow="hidden";this.iniWidth=this.el.offsetWidth;this.iniHeight=this.el.offsetHeight;this.setOptions(options);}});fx.Height=Class.create();Object.extend(Object.extend(fx.Height.prototype,fx.Layout.prototype),{increase:function(){this.el.style.height=this.now+"px";},toggle:function(){if(this.el.offsetHeight>0)this.custom(this.el.offsetHeight,0);else this.custom(0,this.el.scrollHeight);}});fx.Width=Class.create();Object.extend(Object.extend(fx.Width.prototype,fx.Layout.prototype),{increase:function(){this.el.style.width=this.now+"px";},toggle:function(){if(this.el.offsetWidth>0)this.custom(this.el.offsetWidth,0);else this.custom(0,this.iniWidth);}});fx.Opacity=Class.create();fx.Opacity.prototype=Object.extend(new fx.Base(),{initialize:function(el,options){this.el=$(el);this.now=1;this.increase();this.setOptions(options);},increase:function(){if(this.now==1&&(/Firefox/.test(navigator.userAgent)))this.now=0.9999;this.setOpacity(this.now);},setOpacity:function(opacity){if(opacity==0&&this.el.style.visibility!="hidden")this.el.style.visibility="hidden";else if(this.el.style.visibility!="visible")this.el.style.visibility="visible";if(window.ActiveXObject)this.el.style.filter="alpha(opacity="+opacity*100+")";this.el.style.opacity=opacity;},toggle:function(){if(this.now>0)this.custom(1,0);else this.custom(0,1);}});fx.sinoidal=function(pos){return((-Math.cos(pos*Math.PI)/2)+0.5);}
fx.linear=function(pos){return pos;}
fx.cubic=function(pos){return Math.pow(pos,3);}
fx.circ=function(pos){return Math.sqrt(pos);}