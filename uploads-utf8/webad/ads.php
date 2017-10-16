<?php
require_once(dirname(__FILE__).'/../config.inc.php');
$p = empty($p) ? "" : intval($p);
if($p==""||$p==0)exit("document.write(\"\");");
$hangnum=$lienum=1;
$rs = $db->get_one("SELECT `ap_id`,`ap_row`,`ap_width` FROM `{$cfg['tb_pre']}adsplace` WHERE `ap_priceid`=$p",'CACHE');
if($rs){
    $aprow=explode("*",$rs["ap_row"]);
    if(is_array($aprow)){
       	$hangnum=$aprow[0];
    	$lienum=$aprow[1];
    }
	$apwidth=explode("*",$rs["ap_width"]);
    if(is_array($apwidth)){
        $adwidth=$apwidth[0];
        $adheight=$apwidth[1];
    }
	$adsid=$rs["ap_id"];
}else{
    exit("document.write(\"\");");
}
//判断是否存在过期的广告有则更新ad_lose为1
$db ->query("UPDATE `{$cfg['tb_pre']}ad` SET `ad_lose`=1 WHERE `ad_stop`=0 AND `ad_priceid`=$adsid AND ((`ad_act`=1 AND `ad_click`<=`ad_clicks`) 
 OR (`ad_act`=2 AND `ad_show`<=`ad_shows`) 
 OR (`ad_act`=3 AND DATEDIFF(`ad_enddate`,'".date('Y-m-d')."')<0) 
 OR (`ad_act`=4 AND `ad_click`<=`ad_clicks` AND `ad_show`<=`ad_shows`) 
 OR (`ad_act`=5 AND `ad_click`<=`ad_clicks` AND DATEDIFF(`ad_enddate`,'".date('Y-m-d')."')<0) 
 OR (`ad_act`=6 AND `ad_show`<=`ad_shows` AND DATEDIFF(`ad_enddate`,'".date('Y-m-d')."')<0) 
 OR (`ad_act`=7 AND `ad_click`<=`ad_clicks` AND `ad_show`<=`ad_shows` AND DATEDIFF(`ad_enddate`,'".date('Y-m-d')."')<0))");
$num=$lienum*$hangnum;
$s = empty($s) ? "d" : $s;
$adstr=$viewads=$viewadssj=$addivstr="";
$isfloat=$isfloats=0;
$sqladd='';
//添加分站信息判断
if($cfg['site']!=''){
    if($cfg['ads']=='2'){
        $sqladd.=" AND `ad_site`={$cfg['site']}";
    }elseif($cfg['ads']=='3'){
        $sqladd.=" AND (`ad_site`={$cfg['site']} OR `ad_site`=0)";
    }
}else{
    $sqladd.=" AND `ad_site`=0";
}
$query=$db->query("SELECT * FROM `{$cfg['tb_pre']}ad` WHERE `ad_lose`=0 AND `ad_stop`=0 AND `ad_priceid`=$adsid $sqladd ORDER BY `ad_showtime` ASC,`ad_id` ASC LIMIT 0,$num");
$i=0;$upid='';
while($row=$db->fetch_array($query)){
    $i++;
    //记录广告ID
    $upid.=$i==1?$row['ad_id']:",".$row['ad_id'];
    switch($row["ad_type"]){
        case "image":
        $geturl=urlencode($row["ad_url"]);$ad_pic=substr($row['ad_pic'],0,3)=='../'?substr($row['ad_pic'],3):$row['ad_pic'];
        $adstr="<a href=\"{$cfg['siteurl']}{$cfg['path']}webad/adsurl.php?id=$row[ad_id]&geturl=$geturl\" target=\"_blank\"><img border=0 width=\"$adwidth\" height=\"$adheight\" alt=\"$row[ad_text]\" src=\"$ad_pic\" /></a>";
        break;
        case "text":
        $geturl=urlencode($row["ad_url"]);
        $adstr="<a href=\"{$cfg['siteurl']}{$cfg['path']}webad/adsurl.php?id=$row[ad_id]&geturl=$geturl\" target=\"_blank\">$row[ad_text]</a>";
        break;
        case "flash":
        $adstr="<embed src=\"$row[ad_pic]\" quality=\"high\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"$adwidth\" height=\"$adheight\" wmode=\"transparent\"></embed>";
        break;
        case "code":
        $adstr=$row["ad_text"];
        break;
        case "float":
        $geturl=urlencode($row["ad_url"]);$ad_pic=substr($row['ad_pic'],0,3)=='../'?substr($row['ad_pic'],3):$row['ad_pic'];
        $adstr="<a href=\"{$cfg['siteurl']}{$cfg['path']}webad/adsurl.php?id=$row[ad_id]&geturl=$geturl\" target=\"_blank\"><img border=0 width=\"$adwidth\" height=\"$adheight\" alt=\"$row[ad_text]\" src=\"$ad_pic\" /></a>";
        break;
        case "floats":
        $geturl=urlencode($row["ad_url"]);$ad_pic=substr($row['ad_pic'],0,3)=='../'?substr($row['ad_pic'],3):$row['ad_pic'];
        $adstr="<a href=\"{$cfg['siteurl']}{$cfg['path']}webad/adsurl.php?id=$row[ad_id]&geturl=$geturl\" target=\"_blank\"><img border=0 width=\"$adwidth\" height=\"$adheight\" alt=\"$row[ad_text]\" src=\"$ad_pic\" /></a>";
        break;
    }
    if($row["ad_type"]=='float'){
        $isfloat=1;$addivstr.="'float_div$i',";
        if($i==1){
            $left="left";$top=40;
        }elseif($i==2){
            $left="right";$top=40;
        }elseif($i==3){
            $left="left";$top=400;
        }elseif($i==4){
            $left="right";$top=400;
        }
        $viewads.="<div id=\"float_div$i\" style=\"top: {$top}px; $left: 5px;\">";
        
        $viewads.="<div class=\"itemFloat\">$adstr<br><a href=\"javascript:close_flat('float_div$i');\" title=\"关闭上面的广告\">×关闭</a><br></div></div>";
    }elseif($row["ad_type"]=='floats'){
        $viewads="<div id=\"img_{$p}_$i\" style=\"z-index: 100; left: 2px; width: 59px; position: absolute; top: 43px; height: 61px;\">$adstr</div>";
        $viewadssj="var xPos=300;var yPos=200;var step=1;var delay=30;var height=0;var Hoffset=0;var Woffset=0;var yon=0;var xon=0;var pause=true;var interval;var img1=document.getElementById('img_{$p}_$i');img1.style.top=yPos;function changePos(){var width=document.body.clientWidth;var height=document.body.clientHeight;var Hoffset=img1.offsetHeight;var Woffset=img1.offsetWidth;img1.style.left=xPos+document.body.scrollLeft+'px';img1.style.top=yPos+document.body.scrollTop+'px';if(yon){yPos=yPos+step}else{yPos=yPos-step}if(yPos<0){yon=1;yPos=0}if(yPos>=(height-Hoffset)){yon=0;yPos=(height-Hoffset)}if(xon){xPos=xPos+step}else{xPos=xPos-step}if(xPos<0){xon=1;xPos=0}if(xPos>=(width-Woffset)){xon=0;xPos=(width-Woffset)}}function start(){interval=setInterval('changePos()',delay)}function pause_resume(){if(pause){clearInterval(interval);pause=false}else{interval=setInterval('changePos()',delay);pause=true}}start();";
    }else{
        if($s=="t"){
            $tdwidth=floor(100/$lienum)."%";
            $viewads.="<td width=\"$tdwidth\">$adstr</td>";
            if($i%$lienum == 0) $viewads.="</tr><tr>";
        }else{
            if($i%$lienum == 1){
                $viewads.="<li class=adleft>$adstr</li>";
    		}elseif($i%$lienum == 0){
                $viewads.="<li class=adright>$adstr</li>";
    		}else{
                $viewads.="<li class=adstyle>$adstr</li>";
    		}
        }
    }
}
//更新广告显示次数及显示时间
$i&&$db ->query("UPDATE `{$cfg['tb_pre']}ad` SET `ad_shows`=`ad_shows`+1,`ad_showtime`=now() WHERE `ad_id` IN ($upid)");
if($s=="t"){
    if(substr($viewads,-9)=="</tr><tr>") $viewads=substr($viewads,0,-9);
    $viewads="<table cellpadding=\"0\" cellspacing=\"1\"><tr>".$viewads."</tr></table>";
}
if($isfloat==1){
    $addivstr=substr($addivstr,0,-1);
    $viewadscss="<style type=\"text/css\">";
    $viewadscss.="#float_div1,#float_div2,#float_div3,#float_div4{width:80px;height:80px;position:absolute;}";
    $viewadscss.=".itemFloat{width:80px;height:auto;line-height:12px;text-align:center;}";
    $viewadscss.=".itemFloat a{color:#333; font-size:12px;text-decoration:none;}";
    $viewadscss.="</style>";
    $viewads=$viewadscss.$viewads;
    $viewadssj="lastScrollY=0;function heartBeat(objid1,objid2,objid3,objid4){var diffY;if(document.documentElement&&document.documentElement.scrollTop){diffY=document.documentElement.scrollTop;}else if(document.body){diffY=document.body.scrollTop;}else{}percent=.1*(diffY-lastScrollY);if(percent>0)percent=Math.ceil(percent);else percent=Math.floor(percent);for(i=0;i<arguments.length;i++){document.getElementById(arguments[i]).style.top=parseInt(document.getElementById(arguments[i]).style.top)+percent+\"px\"}lastScrollY=lastScrollY+percent}function close_flat(objid){document.getElementById(objid).style.visibility='hidden'}window.setInterval(\"heartBeat($addivstr)\",1);";
}
$viewads=addslashes($viewads);
echo "document.write(\"$viewads\");";
echo $viewadssj;
?>