<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
//检查和注册外部提交的变量
foreach($_REQUEST as $_k=>$_v){
	if( strlen($_k)>0 && preg_match('/^(cfg|GLOBALS)/i',$_k) ){
		exit('Request var not allow!');
	}
}
foreach(Array('_GET','_POST','_COOKIE') as $_request){
	foreach($$_request as $_k => $_v) ${$_k} = _runmagicquotes($_v);
}
function _runmagicquotes(&$svar){
	if(!get_magic_quotes_gpc()){
		if( is_array($svar) ){
			foreach($svar as $_k => $_v) $svar[$_k] = _runmagicquotes($_v);
		}else{
			$svar = addslashes($svar);
		}
	}
	return $svar;
}
function showmsg($msg,$gourl,$onlymsg=0,$limittime=0){
    global $cfg;
    $sitename=$cfg['sitename'];
    $siteurl=$cfg['siteurl'];
    $path=$cfg['path'];
	if(empty($siteurl)) $siteurl = '..';
	$htmlhead  = "<html>\r\n<head>\r\n<title>提示信息_$sitename</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$cfg['charset']}\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>";
	$htmlhead .= "*{font-size:12px;color:#2B61BA;}\r\n";
	$htmlhead .= "body{font-family:\"微软雅黑\",\"宋体\", Verdana, Arial, Helvetica, sans-serif;background:#FFFFFF;margin:0;}\r\n";
	$htmlhead .= "a:link,a:visited,a:active {color:#ABBBD6;text-decoration:none;}\r\n";
	$htmlhead .= ".msg{width:400px;text-align:left;background:#FFFFFF url('{$path}skin/default/msgbg.gif') repeat-x;margin:auto;}\r\n";
    $htmlhead .= ".head{letter-spacing:2px;line-height:29px;height:26px;overflow:hidden;font-weight:bold;}\r\n";
    $htmlhead .= ".content{padding:10px 20px 5px 20px;line-height:200%;word-break:break-all;border:#7998B7 1px solid;border-top:none;}\r\n";
    $htmlhead .= ".ml{color:#FFFFFF;background:url('{$path}skin/default/msg.gif') no-repeat 0 0;padding-left:10px;}\r\n";
    $htmlhead .= ".mr{float:right;background:url('{$path}skin/default/msg.gif') no-repeat 0 -34px;width:4px;font-size:1px;}\r\n";
    $htmlhead .= "</style></head>\r\n<body leftmargin='0' topmargin='0'>".(isset($GLOBALS['ucsynlogin']) ? $GLOBALS['ucsynlogin'] : '')."\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";
	$litime = ($limittime==0 ? 1000 : $limittime);
	$func = '';
	if($gourl=='-1'){
		if($limittime==0) $litime = 5000;
		$gourl = "javascript:history.go(-1);";
	}
	if($gourl=='0'){
		if($limittime==0) $litime = 5000;
		$gourl = "javascript:history.back();";
	}
	if($gourl=='' || $onlymsg==1){
		$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
	}else{
		if(preg_match('/close::/i',$gourl)){
			$tgobj = trim(eregi_replace('close::', '', $gourl));
			$gourl = 'javascript:;';
			$func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
		}
		
		$func .= "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
		$rmsg = $func;
		$rmsg .= "document.write(\"<br /><br /><br /><div class='msg'>";
		$rmsg .= "<div class='head'><div class='mr'> </div><div class='ml'>提示信息！</div></div>\");\r\n";
		$rmsg .= "document.write(\"<div class='content'>\");\r\n";
		$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		
		if($onlymsg==0){
			if( $gourl != 'javascript:;' && $gourl != ''){
				$rmsg .= "<br /><a href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a>";
				$rmsg .= "</div>\");\r\n";
				$rmsg .= "setTimeout('JumpUrl()',$litime);";
			}else{
				$rmsg .= "</div>\");\r\n";
			}
		}else{
			$rmsg .= "<br/></div>\");\r\n";
		}
        $msg  = $htmlhead.$rmsg.$htmlfoot;
	}
	echo $msg;
}
function replace_cfglabel($htmlstr){
    global $cfg,$Powered;
    if ($htmlstr!=''){
        //fredition(1)&&
        $Powered='';
        $htmlstr=str_replace('{$FR_网站名称}',$cfg['sitename'],$htmlstr);
        $htmlstr=str_replace('{$FR_网站标题}',$cfg['sitetitle'],$htmlstr);
        $htmlstr=str_replace('{$FR_网站网址}',$cfg['siteurl'],$htmlstr);
        $logourl=substr($cfg['logourl'],0,3)=='../'?substr($cfg['logourl'],3):$cfg['logourl'];
        $htmlstr=str_replace('{$FR_LOGO地址}',$logourl,$htmlstr);
        $htmlstr=str_replace('{$FR_网站版权}',stripslashes($cfg['copyright']).$Powered,$htmlstr);
        $htmlstr=str_replace('{$FR_网站关键字}',$cfg['keywords'],$htmlstr);
        $htmlstr=str_replace('{$FR_网站描述}',$cfg['description'],$htmlstr);
        $htmlstr=str_replace('{$FR_联系人}',$cfg['contact'],$htmlstr);
        $htmlstr=str_replace('{$FR_联系地址}',$cfg['address'],$htmlstr);
        $htmlstr=str_replace('{$FR_联系电话}',$cfg['phone'],$htmlstr);
        $htmlstr=str_replace('{$FR_联系传真}',$cfg['fax'],$htmlstr);
        $htmlstr=str_replace('{$FR_管理员名称}',$cfg['master'],$htmlstr);
        $htmlstr=str_replace('{$FR_管理员邮箱}',$cfg['email'],$htmlstr);
        $htmlstr=str_replace('{$FR_系统目录}',$cfg['path'],$htmlstr);
        $htmlstr=str_replace('{$FR_HTML目录}',$cfg['htmlpath'],$htmlstr);
        $htmlstr=str_replace('{$FR_网站样式}',$cfg['skin'],$htmlstr);
        $htmlstr=str_replace('{$FR_网站导航}',"<?php echo getsitenav();?>",$htmlstr);
        $htmlstr=str_replace('{$FR_页尾导航}',"<?php echo getsitebottomnav();?>",$htmlstr);
        $htmlstr=str_replace('{$FR_ICP备案证号}',"<a href=\"http://www.miibeian.gov.cn\" target=\"_blank\">{$cfg['icp']}</a>",$htmlstr);
        $htmlstr=str_replace('{$FR_第三方统计}',stripslashes($cfg['count']),$htmlstr);
        $htmlstr=str_replace('{$FR_其他头部信息}',stripslashes($cfg['meta']),$htmlstr);
    }
    return $htmlstr;
}
function replace_alllabel($content){
	//替换标签
    global $cfg,$db;
    $query=$db->query("SELECT `l_name`,`l_content` FROM `{$cfg['tb_pre']}label` ORDER BY `l_order` DESC");
    while($row=$db->fetch_array($query)){
        $content = str_replace($row['l_name'],$row['l_content'],$content);
    }
    return $content;
}
//格式化页面地址
function joinchar($strUrl){
    if(!$strUrl) return '';
    if(stripos($strUrl,'?')<strlen($strUrl)){
        if(stripos($strUrl,'?')>0||substr($strUrl,0,1)=='?'){
            if(stripos($strUrl,'&')<strlen($strUrl)){
                return $strUrl."&";
            }else{
                return $strUrl;
            }
        }else{
            return $strUrl."?";
        }
    }else{
        return $strUrl;
    }
}
//分页函数
function page($page,$total,$phpfile,$pagesize=3,$pagelen=3,$ishtml=0){
    $pagecode = '';
    $page = intval($page);
    $total = intval($total);
    if(!$total) return array();
    $pages = ceil($total/$pagesize);
    if($page<1) $page = 1;
    if($page>$pages) $page = $pages;
    $offset = $pagesize*($page-1);
    $init = 1;
    $max = $pages;
    $pagelen = ($pagelen%2)?$pagelen:$pagelen+1;
    $pageoffset = ($pagelen-1)/2;
    $pagecode='<div class="page">';
    $pagecode.="<span>显示{$total}条</span>";
    if($page!=1){
        if($ishtml==0){
            $pagecode.="<a href=\"".joinchar($phpfile)."page=1\">首页</a>";
            $pagecode.="<a href=\"".joinchar($phpfile)."page=".($page-1)."\">上一页</a>";
        }else{
            $phpfile0=str_replace("_Pnum",'',$phpfile);
            $phpfile0=str_replace("-Pnum",'',$phpfile0);
            $page1=$page>2?'_'.($page-1):'';$page2=$page>2?'-'.($page-1):'';
            $phpfile1=str_replace("_Pnum",$page1,$phpfile);
            $phpfile1=str_replace("-Pnum",$page2,$phpfile1);
            $pagecode.="<a href=\"".$phpfile0."\">首页</a>";
            $pagecode.="<a href=\"".$phpfile1."\">上一页</a>";
        }
    }
    if($pages>$pagelen){
        if($page<=$pageoffset){
            $init=1;
            $max = $pagelen;
        }else{
            if($page+$pageoffset>=$pages+1){
                $init = $pages-$pagelen+1;
            }else{
                $init = $page-$pageoffset;
                $max = $page+$pageoffset;
            }
        }
    }
    for($i=$init;$i<=$max;$i++){
        if($i==$page){
            $pagecode.='<span>'.$i.'</span>';
        }else{
            if($ishtml==0){
                $pagecode.="<a href=\"".joinchar($phpfile)."page={$i}\">$i</a>";
            }else{
                $pagecode.=$i==1?"<a href=\"".$phpfile0."\">$i</a>":"<a href=\"".str_replace("Pnum",$i,$phpfile)."\">$i</a>";
            }
        }
    }
    if($page!=$pages){
        if($ishtml==0){
            $pagecode.="<a href=\"".joinchar($phpfile)."page=".($page+1)."\">下一页</a>";
            $pagecode.="<a href=\"".joinchar($phpfile)."page={$pages}\">尾页</a>";
        }else{
            $pagecode.="<a href=\"".str_replace("Pnum",$page+1,$phpfile)."\">下一页</a>";
            $pagecode.="<a href=\"".str_replace("Pnum",$pages,$phpfile)."\">尾页</a>";
        }
    }
    $pagecode.="<span>页次：$page/{$pages}</span>";
    $pagecode.='</div>';
    return array('pagecode'=>$pagecode,'sqllimit'=>' LIMIT '.$offset.','.$pagesize);
}
//时间比较函数，返回两个日期相差几秒、几分钟、几小时或几天 
function datediff($date1,$date2,$unit="") {
    switch($unit){
        case 's':$dividend = 1;break;
        case 'i':$dividend = 60;break;
        case 'h':$dividend = 3600;break;
        case 'd':$dividend = 86400;break; 
        default:$dividend = 86400;
    } 
    $time1 = strtotime($date1); 
    $time2 = strtotime($date2); 
    if ($time1 && $time2) 
    return (float)($time1 - $time2) / $dividend; 
    return false;
}
function replace_strbox($str){
    if($str=="") return '';
    $str=stripslashes($str);
    $str = strip_tags($str);
    $str = str_replace("\r\n","<br>",$str);
    $str = str_replace("\r","<br>",$str);
    $str = str_replace("\n","<br>",$str);
    $str = str_replace(" ","&nbsp;",$str);
    $str = str_replace("'","’",$str);
    $str = str_replace("\"","“",$str);
    $str = addslashes($str);
    return $str;
}
function change_strbox($str){
    if($str=="") $str="&nbsp;";
    $str = str_replace("<br>","\r\n",$str);
    return $str;
}
//(去HTML代码)
function cleartags($msg){
    if(!$msg) return '';
    $msg=stripslashes($msg);
    $msg=strip_tags($msg);
    return trim(addslashes($msg));
}
//清除HTML代码、空格、回车换行符
function deletehtml($str){
    $str = trim($str); 
    $str = strip_tags($str,""); 
    $str = ereg_replace("\t","",$str); 
    $str = ereg_replace("\r\n","",$str); 
    $str = ereg_replace("\r","",$str); 
    $str = ereg_replace("\n","",$str); 
    $str = ereg_replace(" "," ",$str); 
    return trim($str); 
}
//标题颜色处理(加色截取长度)
function appendcolor($msg,$num=20){
    if(!$msg) return '';
    if(!is_numeric($num)) $num=20;
    $msgstr=strip_tags($msg,"");
    $msgstrt=substr($msgstr,0,$num);
    $msg=str_replace($msgstr,$msgstrt,$msg);
    return $msg;
}
//邮箱格式检查
function checkemail($email){
	return eregi("^[0-9a-z][a-z0-9\._-]{1,}@[a-z0-9\.-]{1,}[a-z0-9]\.[a-z\.]{1,}[a-z]$", $email);
}
function checkgbk($string) {
	return preg_match("/^([\s\S]*?)([\x81-\xfe][\x40-\xfe])([\s\S]*?)/", $string);
}
//检查是否外部提交数据
function chkpost(){
    $Server_v1=strtolower($_SERVER["HTTP_REFERER"]);
    $Server_v2=strtolower($_SERVER["HTTP_HOST"]);
    if(substr($Server_v1,7,strlen($Server_v2))!=$Server_v2){
        return false;
    }else{
        return true;
    }
}
function cachelink(){
    global $cfg,$db;
    $applink["L_0"]=$cfg['path']."index.php";
    $applinkh["L_0"]=$cfg['path']."index.".$cfg['defaultext'];
    $applinkw["L_0"]=$cfg['path']."index.html";
    $query=$db->query("SELECT * FROM `{$cfg['tb_pre']}channel` WHERE c_channeltype<>2");
    while($row=$db->fetch_array($query)){
        $createhtml=$row['c_createhtml'];$channeldir=$row['c_channeldir'];$fileext=$row['c_fileext'];
        $listfiletype=$row['c_listfiletype'];$structuretype=$row['c_structuretype'];$filenametype=$row['c_filenametype'];
        $moduletype=$row['c_moduletype'];$cid=$row['c_id'];
        $linkappUrl=$cfg['path'].$channeldir;
        $linkhappUrl=$cfg['path'].$cfg['htmlpath'].$channeldir;
        switch($fileext){
            case 0:$fileext=".html";break;
            case 1:$fileext=".htm";break;
            case 2:$fileext=".shtml";break;
            case 3:$fileext=".shtm";break;
            default:$fileext=".html";
        }
        $applink["L_$cid"]=$linkappUrl."/index.php";
        $applinkh["L_$cid"]=$linkhappUrl."/index".$fileext;
        $applinkw["L_$cid"]=$linkappUrl."/index.html";
        switch($listfiletype){
 			case 0:$applinkh["L_{$cid}_0"]=$linkhappUrl."/list/list_{Tid}{_Pnum}$fileext";break;
 			case 1:$applinkh["L_{$cid}_0"]=$linkhappUrl."/list_{Tid}{_Pnum}$fileext";break;
 			case 2:$applinkh["L_{$cid}_0"]=$linkhappUrl."/list-typeid-{Tid}{-Pnum}$fileext";break;
  		}
        switch($moduletype){
 			case 1:
                $applink["L_{$cid}_1_0"]=$linkappUrl."/cnresume_view.php?rid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_2_0"]=$linkappUrl."/pic.php?pid={Nid}{&page=Pnum}";
                $applinkh["L_{$cid}_1_0"]=$linkhappUrl."/person_{Nid}$fileext";
                $applinkh["L_{$cid}_2_0"]=$linkhappUrl."/pic_{Nid}$fileext";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/cnresume_view-rid-{Nid}.html";
                $applinkw["L_{$cid}_2_0"]=$linkappUrl."/pic-pid-{Nid}.html";
            break;
 			case 2:
                $applink["L_{$cid}_1_0"]=$linkappUrl."/company.php?comid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_2_0"]=$linkappUrl."/hires.php?comid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_3_0"]=$linkappUrl."/hire.php?hireid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_4_0"]=$linkappUrl."/pic.php?pid={Nid}{&page=Pnum}";
                $applinkh["L_{$cid}_1_0"]=$linkhappUrl."/company_{Nid}$fileext";
                $applinkh["L_{$cid}_2_0"]=$linkhappUrl."/hires_{Nid}$fileext";
                $applinkh["L_{$cid}_3_0"]=$linkhappUrl."/hire_{Nid}$fileext";
                $applinkh["L_{$cid}_4_0"]=$linkhappUrl."/pic_{Nid}$fileext";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/company-comid-{Nid}.html";
                $applinkw["L_{$cid}_2_0"]=$linkappUrl."/hires-comid-{Nid}.html";
                $applinkw["L_{$cid}_3_0"]=$linkappUrl."/hire-hireid-{Nid}.html";
                $applinkw["L_{$cid}_4_0"]=$linkappUrl."/pic-pid-{Nid}.html";
            break;
    		case 3:
                $applink["L_{$cid}_0_0"]=$linkappUrl."/school_more.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_1_0"]=$linkappUrl."/school_view.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_2_0"]=$linkappUrl."/professor_more.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_3_0"]=$linkappUrl."/professor_info.php?pid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_4_0"]=$linkappUrl."/student_more.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_5_0"]=$linkappUrl."/student_info.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_6_0"]=$linkappUrl."/department_more.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_7_0"]=$linkappUrl."/department_info.php?did={Nid}{&page=Pnum}";
                $applink["L_{$cid}_8_0"]=$linkappUrl."/require_more.php?sid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_9_0"]=$linkappUrl."/require_info.php?rid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_10_0"]=$linkappUrl."/pic.php?pid={Nid}{&page=Pnum}";
                $applinkh["L_{$cid}_0_0"]=$linkhappUrl."/school_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_1_0"]=$linkhappUrl."/school_view_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_2_0"]=$linkhappUrl."/professor_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_3_0"]=$linkhappUrl."/professor_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_4_0"]=$linkhappUrl."/student_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_5_0"]=$linkhappUrl."/student_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_6_0"]=$linkhappUrl."/department_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_7_0"]=$linkhappUrl."/department_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_8_0"]=$linkhappUrl."/require_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_9_0"]=$linkhappUrl."/require_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_10_0"]=$linkhappUrl."/pic_{Nid}$fileext";
                $applinkw["L_{$cid}_0_0"]=$linkappUrl."/school_more-sid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/school_view-sid-{Nid}.html";
                $applinkw["L_{$cid}_2_0"]=$linkappUrl."/professor_more-sid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_3_0"]=$linkappUrl."/professor_info-pid-{Nid}.html";
                $applinkw["L_{$cid}_4_0"]=$linkappUrl."/student_more-sid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_5_0"]=$linkappUrl."/student_info-sid-{Nid}.html";
                $applinkw["L_{$cid}_6_0"]=$linkappUrl."/department_more-sid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_7_0"]=$linkappUrl."/department_info-did-{Nid}.html";
                $applinkw["L_{$cid}_8_0"]=$linkappUrl."/require_more-sid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_9_0"]=$linkappUrl."/require_info-rid-{Nid}.html";
                $applinkw["L_{$cid}_10_0"]=$linkappUrl."/pic-pid-{Nid}.html";
            break;
            case 4:
                $applink["L_{$cid}_0_0"]=$linkappUrl."/index.php{?page=Pnum}";
                $applink["L_{$cid}_1_0"]=$linkappUrl."/hr.php?hrid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_2_0"]=$linkappUrl."/hr_list.php{?page=Pnum}";
                $applink["L_{$cid}_3_0"]=$linkappUrl."/hr_hire.php?id={Nid}{&page=Pnum}";
                $applinkh["L_{$cid}_0_0"]=$linkhappUrl."/index{_Pnum}$fileext";
                $applinkh["L_{$cid}_1_0"]=$linkhappUrl."/hr_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_2_0"]=$linkhappUrl."/hr_list{_Pnum}$fileext";
                $applinkh["L_{$cid}_3_0"]=$linkhappUrl."/hr_hire_{Nid}{_Pnum}$fileext";
                $applinkw["L_{$cid}_0_0"]=$linkappUrl."/index.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/hr-hrid-{Nid}.html";
                $applinkw["L_{$cid}_2_0"]=$linkappUrl."/hr_list.html";
                $applinkw["L_{$cid}_3_0"]=$linkappUrl."/hr_hire-id-{Nid}.html";
            break;
    		case 5:
                $applink["L_{$cid}_0_0"]=$linkappUrl."/train_more.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_1_0"]=$linkappUrl."/train_view.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_2_0"]=$linkappUrl."/course_more.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_3_0"]=$linkappUrl."/course_info.php?cid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_4_0"]=$linkappUrl."/trainer_more.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_5_0"]=$linkappUrl."/trainer_info.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_6_0"]=$linkappUrl."/teachers_info.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_7_0"]=$linkappUrl."/achievement_info.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_8_0"]=$linkappUrl."/contact.php?tid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_9_0"]=$linkappUrl."/pic.php?pid={Nid}{&page=Pnum}";
                $applink["L_{$cid}_10_0"]=$linkappUrl."/map.php?tid={Nid}{&page=Pnum}";
                $applinkh["L_{$cid}_0_0"]=$linkhappUrl."/train_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_1_0"]=$linkhappUrl."/train_view_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_2_0"]=$linkhappUrl."/course_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_3_0"]=$linkhappUrl."/course_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_4_0"]=$linkhappUrl."/trainer_more_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_5_0"]=$linkhappUrl."/trainer_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_6_0"]=$linkhappUrl."/teachers_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_7_0"]=$linkhappUrl."/achievement_info_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_8_0"]=$linkhappUrl."/contact_{Nid}{_Pnum}$fileext";
                $applinkh["L_{$cid}_9_0"]=$linkhappUrl."/pic_{Nid}$fileext";
                $applinkh["L_{$cid}_10_0"]=$linkhappUrl."/map_{Nid}$fileext";
                $applinkw["L_{$cid}_0_0"]=$linkappUrl."/train_more-tid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/train_view-tid-{Nid}.html";
                $applinkw["L_{$cid}_2_0"]=$linkappUrl."/course_more-tid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_3_0"]=$linkappUrl."/course_info-cid-{Nid}.html";
                $applinkw["L_{$cid}_4_0"]=$linkappUrl."/trainer_more-tid-{Nid}{-Pnum}.html";
                $applinkw["L_{$cid}_5_0"]=$linkappUrl."/trainer_info-tid-{Nid}.html";
                $applinkw["L_{$cid}_6_0"]=$linkappUrl."/teachers_info-tid-{Nid}.html";
                $applinkw["L_{$cid}_7_0"]=$linkappUrl."/achievement_info-tid-{Nid}.html";
                $applinkw["L_{$cid}_8_0"]=$linkappUrl."/contact-tid-{Nid}.html";
                $applinkw["L_{$cid}_9_0"]=$linkappUrl."/pic-pid-{Nid}.html";
                $applinkw["L_{$cid}_9_0"]=$linkappUrl."/map-tid-{Nid}.html";
            break;
            case 6:
                $applink["L_{$cid}_0_0"]=$linkappUrl."/index.php{?page=Pnum}";
                $applinkh["L_{$cid}_0_0"]=$linkappUrl."/index.html";
                $applinkh["L_{$cid}_1_0"]=$linkappUrl."/index{_Pnum}.html";
                $applinkw["L_{$cid}_0_0"]=$linkappUrl."/index.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/index-page{-Pnum}.html";
            break;
            case 10:
                switch($filenametype){
         			case 0:$htmlfilename="{Nid}{_Pnum}";break;
         			case 1:$htmlfilename="{Dates8}{_Pnum}";break;
         			case 2:$htmlfilename=$channeldir."_{Nid}{_Pnum}";break;
                    case 3:$htmlfilename=$channeldir."_{Dates8}{_Pnum}";break;
                    case 4:$htmlfilename="article-newsid-{Nid}{-Pnum}";break;
          		}
                $applink["L_{$cid}_0"]=$linkappUrl."/list.php?typeid={Tid}{&page=Pnum}";
                $applink["L_{$cid}_1_0"]=$linkappUrl."/article.php?newsid={Nid}{&page=Pnum}";
                switch($structuretype){
         			case 0:$applinkh["L_{$cid}_1_0"]=$linkhappUrl."/html/$htmlfilename$fileext";break;
         			case 1:$applinkh["L_{$cid}_1_0"]=$linkhappUrl."/{Dates7}/$htmlfilename$fileext";break;
         			case 2:$applinkh["L_{$cid}_1_0"]=$linkhappUrl."/$htmlfilename$fileext";break;
            	}
                $applinkw["L_{$cid}_0"]=$linkappUrl."/list-typeid-{Tid}{-Pnum}.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/article-newsid-{Nid}{-Pnum}.html";
            break;
            case 14:
                $applink["L_{$cid}_0_0"]=$linkappUrl."/index.php{?page=Pnum}";
                $applinkh["L_{$cid}_0_0"]=$linkappUrl."/index.html";
                $applinkh["L_{$cid}_1_0"]=$linkappUrl."/index{_Pnum}.html";
                $applinkw["L_{$cid}_0_0"]=$linkappUrl."/index.html";
                $applinkw["L_{$cid}_1_0"]=$linkappUrl."/index-page{-Pnum}.html";
            break;
    	}
    }
    if($applink) ksort($applink);
    if($applinkh) ksort($applinkh);
    if($applinkw) ksort($applinkw);
    return "<?php\n\$linkarray = ".var_export($applink, true).";\n\$linkharray = ".var_export($applinkh, true).";\n\$linkwarray = ".var_export($applinkw, true).";\n?>";
}
function formatlink($dates,$cid,$tid,$nid,$pnum){
    global $cfg,$db;
    $linkfile = CACHE_ROOT."/sys/filelink.php";
    if(!is_file($linkfile)) file_put($linkfile, cachelink());
    include $linkfile;
    if($cfg['createhtml']=='1'){
        $rs = $db->get_one("select c_createhtml from {$cfg['tb_pre']}channel where c_id=$cid");
        if($rs){$c_createhtml=$rs['c_createhtml'];}
        if($tid==0&&$nid==0) $linkurl=$c_createhtml?$linkharray["L_{$cid}"]:$linkarray["L_{$cid}"];
        if($tid!=0&&$nid==0) $linkurl=$c_createhtml?$linkharray["L_{$cid}_0"]:$linkarray["L_{$cid}_0"];
        if($tid==0&&$nid!=0) $linkurl=$c_createhtml?$linkharray["L_{$cid}_0_0"]:$linkarray["L_{$cid}_0_0"];
        if($tid!=0&&$nid!=0) $linkurl=$c_createhtml?$linkharray["L_{$cid}_{$tid}_0"]:$linkarray["L_{$cid}_{$tid}_0"];
    }elseif($cfg['createhtml']=='2'){
        if($tid==0&&$nid==0) $linkurl=$linkwarray["L_$cid"];
        if($tid!=0&&$nid==0) $linkurl=$linkwarray["L_{$cid}_0"];
        if($tid==0&&$nid!=0) $linkurl=$linkwarray["L_{$cid}_0_0"];
        if($tid!=0&&$nid!=0) $linkurl=$linkwarray["L_{$cid}_{$tid}_0"];
    }else{
        if($tid==0&&$nid==0) $linkurl=$linkarray["L_$cid"];
        if($tid!=0&&$nid==0) $linkurl=$linkarray["L_{$cid}_0"];
        if($tid==0&&$nid!=0) $linkurl=$linkarray["L_{$cid}_0_0"];
        if($tid!=0&&$nid!=0) $linkurl=$linkarray["L_{$cid}_{$tid}_0"];
    }    
    $linkurl=str_replace("{Tid}",$tid,$linkurl);
    $linkurl=str_replace("{Nid}",$nid,$linkurl);
    if($pnum>1){
        $linkurl=str_replace("{_Pnum}","_".$pnum,$linkurl);
        $linkurl=str_replace("{-Pnum}","-".$pnum,$linkurl);
        $linkurl=str_replace("{?page=Pnum}","?page=".$pnum,$linkurl);
        $linkurl=str_replace("{&page=Pnum}","&page=".$pnum,$linkurl);
    }elseif($pnum==-1){
        $linkurl=str_replace("{_Pnum}","_Pnum",$linkurl);
        $linkurl=str_replace("{-Pnum}","-Pnum",$linkurl);
        $linkurl=str_replace("{?page=Pnum}","?page=Pnum",$linkurl);
        $linkurl=str_replace("{&page=Pnum}","&page=Pnum",$linkurl);
    }else{
        $linkurl=str_replace("{_Pnum}","",$linkurl);
        $linkurl=str_replace("{-Pnum}","",$linkurl);
        $linkurl=str_replace("{?page=Pnum}","",$linkurl);
        $linkurl=str_replace("{&page=Pnum}","",$linkurl);
    }
	if($dates!=''){
        $linkurl=str_replace("{Dates8}",dtime(strtotime($dates),8),$linkurl);
        $linkurl=str_replace("{Dates7}",dtime(strtotime($dates),7),$linkurl);
	}
    return $linkurl;
}
// $rptype = 0 表示仅替换 html标记
// $rptype = 1 表示替换 html标记同时去除连续空白字符
// $rptype = 2 表示替换 html标记同时去除所有空白字符
// $rptype = -1 表示仅替换 html危险的标记
function htmlreplace($str,$rptype=0){
	$str = stripslashes($str);
	if($rptype==0){
		$str = htmlspecialchars($str);
	}else if($rptype==1){
		$str = htmlspecialchars($str);
		$str = str_replace("　",' ',$str);
		$str = ereg_replace("[\r\n\t ]{1,}",' ',$str);
	}else if($rptype==2){
		$str = htmlspecialchars($str);
		$str = str_replace("　",'',$str);
		$str = ereg_replace("[\r\n\t ]",'',$str);
	}else{
		$str = ereg_replace("[\r\n\t ]{1,}",' ',$str);
		$str = eregi_replace('script','ｓｃｒｉｐｔ',$str);
		$str = eregi_replace("<[/]{0,1}(link|meta|ifr|fra)[^>]*>",'',$str);
	}
	return addslashes($str);
}
function usertype($typeid){
    switch($typeid){
        case 1:$usertypes = 'pmember';break;
        case 2:$usertypes = 'cmember';break;
        case 3:$usertypes = 'smember';break;
        case 4:$usertypes = 'tmember';break; 
        default:$usertypes = 'pmember';
    }
    return $usertypes;
}
function outinfo($tablename,$idname,$infoname,$id,$types){
    global $cfg,$db;
    if(!is_numeric($id)){
        $rs=$db->get_one("SELECT $infoname FROM $tablename WHERE $idname='$id'");
    }else{
        if($types=='num'){
            $rs=$db->get_one("SELECT $infoname FROM $tablename WHERE $idname=$id");
        }else{
            $rs=$db->get_one("SELECT $infoname FROM $tablename WHERE $idname='$id'");
        }
    }
    if($rs){return "$rs[$infoname]";}else{return "未知";}
}
function hiretype($str){
    switch($str){
        case 1:$str="全职";break;
		case 2:$str="兼职";break;
		case 3:$str="不限";break;
    }
    return $str;
}
function hireexperience($str){
    switch($str){
        case -100:$str="无";break;
		case -1:$str="在读学生";break;
		case 0:$str="毕业生";break;
        default:$str=$str."年以上";
    }
    return $str;
}
function hiresex($str){
    switch($str){
        case 1:$str="男";break;
		case 2:$str="女";break;
        default:$str="不限";
    }
    return $str;
}
function hirenumber($str){
    switch($str){
        case 0:$str="若干人";break;
        default:$str=$str."人";
    }
    return $str;
}
function hireworkadd($str='0000',$num=0,$nums=0,$cto=0){
    global $cfg,$db;
    $cfile = CACHE_ROOT."/sys/provinceandcity.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `p_id`,`p_name` FROM `{$cfg['tb_pre']}provinceandcity`");
        while($row=$db->fetch_array($result)){
            $appprovinceandcity["$row[p_id]"]=trim($row["p_name"]);
        }
        if($appprovinceandcity) ksort($appprovinceandcity);
        file_put($cfile, "<?php\n\$provinceandcityarray = ".var_export($appprovinceandcity, true).";\n?>");
    }
    include $cfile;
    if($str=='0000'){
        return "不限";
    }else{
        $arraystr=explode(",",$str);$strs2='';$i=0;
        foreach($arraystr as $k) {
            $arraystrs=explode("*",$k);$strs1='';$i++;
            foreach($arraystrs as $v) {
                $strs1s=$cto?array_search($v,$provinceandcityarray):$provinceandcityarray[$v];
                if($nums){$strs1=$strs1s;}else{$strs1.=$strs1s."*";}
            }
            substr($strs1,-1)=="*"&&$strs1=substr($strs1,0,-1);
            if($num){$i==1&&$strs2=$strs1;}else{$strs2.=$strs1.",";}
		}
        substr($strs2,-1)==","&&$strs2=substr($strs2,0,-1);
    }
    return $strs2;
}
function hireprofession($str='0000',$num=0,$nums=0,$cto=0){
    global $cfg,$db;
    $cfile = CACHE_ROOT."/sys/profession.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `p_id`,`p_name` FROM `{$cfg['tb_pre']}profession`");
        while($row=$db->fetch_array($result)){
            $appprofession["$row[p_id]"]=trim($row["p_name"]);
        }
        if($appprofession) ksort($appprofession);
        file_put($cfile, "<?php\n\$professionarray = ".var_export($appprofession, true).";\n?>");
    }
    include $cfile;
    if($str=='0000'){
        return "不限";
    }else{
        $arraystr=explode(",",$str);$strs2='';$i=0;
        foreach($arraystr as $k) {
            $arraystrs=explode("*",$k);$strs1='';$i++;
            foreach($arraystrs as $v) {
                $strs1s=$cto?array_search($v,$professionarray):$professionarray[$v];
                if($nums){$strs1=$strs1s;}else{$strs1.=$strs1s."*";}
            }
            substr($strs1,-1)=="*"&&$strs1=substr($strs1,0,-1);
            if($num){$i==1&&$strs2=$strs1;}else{$strs2.=$strs1.",";}
		}
        substr($strs2,-1)==","&&$strs2=substr($strs2,0,-1);
    }
    return $strs2;
}
function hireposition($str='0000',$num=0,$nums=0,$cto=0){
    global $cfg,$db;
    $cfile = CACHE_ROOT."/sys/position.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `p_id`,`p_name` FROM `{$cfg['tb_pre']}position`");
        while($row=$db->fetch_array($result)){
            $appposition["$row[p_id]"]=trim($row["p_name"]);
        }
        if($appposition) ksort($appposition);
        file_put($cfile, "<?php\n\$positionarray = ".var_export($appposition, true).";\n?>");
    }
    include $cfile;
    if($str=='0000'){
        return "不限";
    }else{
        $arraystr=explode(",",$str);$strs2='';$i=0;
        foreach($arraystr as $k) {
            $arraystrs=explode("*",$k);$strs1='';$i++;
            foreach($arraystrs as $v) {
                $strs1s=$cto?array_search($v,$positionarray):$positionarray[$v];
                if($nums){$strs1=$strs1s;}else{$strs1.=$strs1s."*";}
            }
            substr($strs1,-1)=="*"&&$strs1=substr($strs1,0,-1);
            if($num){$i==1&&$strs2=$strs1;}else{$strs2.=$strs1.",";}
		}
        substr($strs2,-1)==","&&$strs2=substr($strs2,0,-1);
    }
    return $strs2;
}
function hiretrade($str='0000',$num=0,$cto=0){
    global $cfg,$db;
    $cfile = CACHE_ROOT."/sys/trade.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `t_id`,`t_name` FROM `{$cfg['tb_pre']}trade`");
        while($row=$db->fetch_array($result)){
            $apptrade["$row[t_id]"]=trim($row["t_name"]);
        }
        if($apptrade) ksort($apptrade);
        file_put($cfile, "<?php\n\$tradearray = ".var_export($apptrade, true).";\n?>");
    }
    include $cfile;
    if($str=='0000'){
        return "不限";
    }else{
        $arraystr=explode(",",$str);$strs1='';
        foreach($arraystr as $k) {
            $strs1s=$cto?array_search($k,$tradearray):$tradearray[$k];
            if($num){$strs1=$strs1s;}else{$strs1.=$strs1s.",";}
        }
        substr($strs1,-1)==","&&$strs1=substr($strs1,0,-1);
    }
    return $strs1;
}
function hireedu($str){
    global $cfg,$db;
    if($str){$str=intval($str);}else{return "不限";}
    $cfile = CACHE_ROOT."/sys/edu.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `e_id`,`e_name` FROM `{$cfg['tb_pre']}edu`");
        while($row=$db->fetch_array($result)){
            $appedu["$row[e_id]"]=trim($row["e_name"]);
        }
        if($appedu) ksort($appedu);
        file_put($cfile, "<?php\n\$eduarray = ".var_export($appedu, true).";\n?>");
    }
    include $cfile;
    return $eduarray[$str];
}
function hirepay($str){
    switch($str){
        case 0:$str="面议";break;
		case 1:$str="800元以下";break;
        case 2:$str="800～1000元";break;
        case 3:$str="1000～1200元";break;
        case 4:$str="1200～1500元";break;
        case 5:$str="1500～2000元";break;
        case 6:$str="2000～2500元";break;
        case 7:$str="2500～3000元";break;
        case 8:$str="3000～4000元";break;
        case 9:$str="4000～6000元";break;
        case 10:$str="6000～9000元";break;
        case 11:$str="9000～12000元";break;
        case 12:$str="12000～15000元";break;
        case 13:$str="15000～20000元";break;
        case 14:$str="20000元以上";break;
        default:$str=$str."元";
    }
    return $str;
}
function xreplace($str='',$num=0,$nums=0){
    global $cfg,$db;
    if($str==''){
        return "未填写";
    }else{
        $arraystr=explode(",",$str);$strs2='';$i=0;
        foreach($arraystr as $k) {
            $arraystrs=explode("*",$k);$strs1='';$i++;
            foreach($arraystrs as $v) {
                if($nums){$strs1=$v;}else{$strs1.=$v;}
            }
            if($num){$i==1&&$strs2=$strs1;}else{$strs2.=$strs1.",";}
		}
        substr($strs2,-1)==","&&$strs2=substr($strs2,0,-1);
    }
    return $strs2;
}
function ahirepay($str){
    switch($str){
		case 1:$str="800以下";break;
        case 2:$str="800～1000";break;
        case 3:$str="1000～1200";break;
        case 4:$str="1200～1500";break;
        case 5:$str="1500～2000";break;
        case 6:$str="2000～2500";break;
        case 7:$str="2500～3000";break;
        case 8:$str="3000～4000";break;
        case 9:$str="4000～6000";break;
        case 10:$str="6000～9000";break;
        case 11:$str="9000～12000";break;
        case 12:$str="12000～15000";break;
        case 13:$str="15000～20000";break;
        case 14:$str="20000以上";break;
        default:$str=$str;
    }
    return $str;
}
function addhirepay($str){
    switch($str){
		case "800以下":$str=1;break;
        case "800～1000":$str=2;break;
        case "1000～1200":$str=3;break;
        case "1200～1500":$str=4;break;
        case "1500～2000":$str=5;break;
        case "2000～2500":$str=6;break;
        case "2500～3000":$str=7;break;
        case "3000～4000":$str=8;break;
        case "4000～6000":$str=9;break;
        case "6000～9000":$str=10;break;
        case "9000～12000":$str=11;break;
        case "12000～15000":$str=12;break;
        case "15000～20000":$str=13;break;
        case "20000以上":$str=14;break;
        default:$str=$str;
    }
    return $str;
}
function memberworkdate($str){
    switch($str){
        case 0:$str="随时";break;
		case 7:$str="1周以内";break;
        case 14:$str="2周以内";break;
        case 30:$str="1个月内";break;
        case 60:$str="1～3个月";break;
        case 90:$str="3个月以后";break;
    }
    return $str;
}
function membergroup($str,$r=0){
    global $cfg,$db;
    if($str){$str=intval($str);}else{return '';}
    $cfile = CACHE_ROOT."/sys/membergroup.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `g_id`,`g_name`,`g_images` FROM `{$cfg['tb_pre']}group`");
        while($row=$db->fetch_array($result)){
            $appgroup["$row[g_id]"]=trim($row["g_name"]).','.trim($row["g_images"]);
        }
        if($appgroup) ksort($appgroup);
        file_put($cfile, "<?php\n\$grouparray = ".var_export($appgroup, true).";\n?>");
    }
    include $cfile;
    if(array_key_exists($str,$grouparray)){
        $arraystr=explode(",",$grouparray[$str]);
        $rstr=$r==1?"<img src=\"{$cfg['path']}$arraystr[1]\" alt=\"$arraystr[0]\" />":$arraystr[0];
    }else{
        $rstr='';
    }
    return $rstr;
}
function getother($table,$pre,$order,$idstr,$t=0){
    global $cfg,$db;
    $otherstr='';
    $result=$db->query("SELECT `{$pre}_id`,`{$pre}_name` FROM `{$cfg['tb_pre']}{$table}` ORDER BY $order",'CACHE');
    if($t==0){
        while($row=$db->fetch_array($result)){
            $otherstr.="<option value=\"{$row["{$pre}_id"]}\"";
            if ($row["{$pre}_id"]==$idstr) $otherstr.=" selected=\"selected\"";
            $otherstr.=">{$row["{$pre}_name"]}</option>\r\n";
        }
    }else{
        while($row=$db->fetch_array($result)){
            $otherstr.="<option value=\"{$row["{$pre}_name"]}\"";
            if ($row["{$pre}_name"]==$idstr) $otherstr.=" selected=\"selected\"";
            $otherstr.=">{$row["{$pre}_name"]}</option>\r\n";
        }
    }
    return $otherstr;
}
function getgroup($gid=0,$b=0,$id=0){
    global $cfg,$db;
    $groupstr='';$i=0;$b=intval($b);
    $result=$db->query("SELECT `g_id`,`g_name`,`g_outlay`,`g_term`,`g_unit`,`g_isdefault` FROM `{$cfg['tb_pre']}group` WHERE `g_typeid`=$gid ORDER BY `g_id` ASC",'CACHE');
    while($row=$db->fetch_array($result)){
        $i++;
        $groupstr.="<input type=\"radio\" class=\"checkbox\" style=\"width:20px;\" value=\"$row[g_id]\" name=\"group\" id=\"group\"";
        if(($row["g_isdefault"]==1&&$id==0)||$row["g_id"]==$id) $groupstr.=" checked=\"checked\"";
        $groupstr.=" />$row[g_name](";
        if($row["g_outlay"]==0){
            $groupstr.="免费";
        }else{
            $groupstr.=$row["g_outlay"]."元/";
            if($row["g_term"]==1){$groupstr.=$row["g_unit"];}else{$groupstr.=$row["g_term"].$row["g_unit"];}
        }
        $groupstr.=")\r\n";
        if($b!=0&&$i%$b==0)$groupstr.="<br>";
    }
    return $groupstr;
}
function getpaylist(){
    global $cfg,$db;
    $payliststr="<select name=\"paytype\" id=\"paytype\">\r\n";
    $payliststr.="<option value=\"\">请选择</option>\r\n";
    $result=$db->query("SELECT `p_flag`,`p_name` FROM `{$cfg['tb_pre']}payonline` WHERE `p_chk`=1 ORDER BY `p_flag` ASC");
    while($row=$db->fetch_array($result)){
        $payliststr.="<option value=\"{$row["p_flag"]}\">{$row["p_name"]}</option>\r\n";
    }
    $payliststr.="</select>\r\n";
    return $payliststr;
}
function num2str($num){
    $unit=array('','十','百','千');
    $units=array('','万','亿','兆');
    $n2s=array('零','一','二','三','四','五','六','七','八','九');
    $s2=strrev($num);//倒转字符串。
    $r="";
    $i4=-1;
    $zero="";
    for($i=0,$len=strlen($s2);$i<$len;$i++){
        if($i%4==0){
            $i4++;
            $r=$units[$i4].$r;
            $zero="";
        }
        //处理0
        if($s2{$i}=='0'){
            switch($i%4){
                case 0:                                        
                break;
                case 1:
                case 2:        
                case 3:        
                if($s2{$i-1}!='0')$zero="零";
                break;
            }
            $r=$zero.$r;
            $zero='';
        }else{
            $r= $n2s[intval($s2{$i})].$unit[$i%4] .$r;
        }
                
    }
    //处理前面的0
    $zPos=strpos($r,"零");
    if($zPos==0 && $zPos!==false)$r=substr($r,2,strlen($r)-2);
    return $r;
}

//中文截取
function sub_cnstrs($str,$slen,$startdd=0){
	$str = sub_cnstr(stripslashes($str),$slen,$startdd);
	return addslashes($str);
}

//中文截取
function sub_cnstr($str,$slen,$startdd=0){
	global $cfg;
	if($cfg['charset']=='utf-8'){
		return sub_cnstr_utf8($str,$slen,$startdd);
	}
	$restr = '';
	$c = '';
    $startdd=$startdd*2;
    $slen=$slen*2;
	$str_len = strlen($str);
	if($str_len < $startdd+1){
		return '';
	}
	if($str_len < $startdd + $slen || $slen==0){
		$slen = $str_len - $startdd;
	}
	$enddd = $startdd + $slen - 1;
	for($i=0;$i<$str_len;$i++){
		if($startdd==0){
			$restr .= $c;
		}else if($i > $startdd){
			$restr .= $c;
		}

		if(ord($str[$i])>0x80){
			if($str_len>$i+1){
				$c = $str[$i].$str[$i+1];
			}
			$i++;
		}else{
			$c = $str[$i];
		}

		if($i >= $enddd){
			if(strlen($restr)+strlen($c)>$slen){
				break;
			}else{
				$restr .= $c;
				break;
			}
		}
	}
	return $restr;
}

//utf-8中文截取
function sub_cnstr_utf8($str, $length, $start=0){
    $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";    
    preg_match_all($pa, $str, $t_string);   
    if(count($t_string[0]) - $start > $length) return join('', array_slice($t_string[0], $start, $length));   
    return join('', array_slice($t_string[0], $start, $length));
}
function _setcookie($var, $value = '', $time = 0) {
    global $cfg, $fr_time;
	$time = $time > 0 ? $fr_time+$time : (empty($value) ? $fr_time - 3600 : 0);
	$port = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
	$var = $cfg['cookie_pre'].$var;
	return setcookie($var, $value, $time, $cfg['cookie_path'], $cfg['cookie_domain'], $port);
}
function _getcookie($var) {
	global $cfg;
	$var = $cfg['cookie_pre'].$var;
	return isset($_COOKIE[$var]) ? $_COOKIE[$var] : '';
}
function getvcvalue()
{
	@session_start();
	return isset($_SESSION['verifycodes']) ? $_SESSION['verifycodes'] : '';
}
function getip(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else if(!empty($_SERVER["REMOTE_ADDR"])){
		$cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
		$cip = '';
	}
	preg_match("/[\d\.]{7,15}/", $cip, $cips);
	$cip = isset($cips[0]) ? $cips[0] : 'unknown';
	unset($cips);
	return $cip;
}
function dtime($time = 0, $type = 6) {
	if(!$time) {global $fr_time; $time = $fr_time;}
	$types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s', 'md', 'YmdHis');
	if(isset($types[$type])) $type = $types[$type];
	return date($type, $time);
}
//读取模版内容
function template($template = 'index', $dir = '', $cdir = '') {
	global $cfg;
    $todir = $cdir ? '/'.$cdir : '';
    if($cdir){
        $sitedir=$sitedirs='';
    }else{
        $sitedir=(array_key_exists('site',$cfg)&&$cfg['site']!='0')?($cfg['tempdir']!=''?$cfg['tempdir'].'/':'site/'):'';
        $sitedirs=(array_key_exists('site',$cfg)&&$cfg['site']!='0')?$sitedir:$cfg['template'].'/';
    }
	$to = $dir ? CACHE_ROOT.'/tpl/'.$sitedir.$dir.$todir.'-'.$template.'.php' : CACHE_ROOT.'/tpl/'.$sitedir.$template.'.php';
    $sitedir=$sitedirs;
	if($cfg['template_refresh'] || !is_file($to)) {
		if($dir){
            $dir = $dir.'/';
            if($cdir) $cdir=$cdir.'/';
        }
        $from =FR_ROOT.'/templates/'.$sitedir.$dir.$cdir.$template.'.htm';
		if($cfg['template'] != 'default' && !is_file($from)) {
                $from =FR_ROOT.'/templates/default/'.$dir.$template.'.htm';
		}
        if(!is_file($to) || filemtime($from) > filemtime($to)) {
			template_compile($from, $to);
		}
	}
	return $to;
}
function template_compile($from, $to) {
	$content = template_parse(file_get_contents($from));
	file_put($to, $content);
}

function template_parse($str) {
	global $cfg;
    $tempstr = replace_alllabel($str);
    $tempstr = replace_cfglabel($tempstr);
	$tempstr = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $tempstr);
	$tempstr = preg_replace("/\{template\s+(.+)\}/", "<?php include template(\\1);?>", $tempstr);
	$tempstr = preg_replace("/\{php\s+(.+)\}/", "<?php \\1?>", $tempstr);
	$tempstr = preg_replace("/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $tempstr);
	$tempstr = preg_replace("/\{else\}/", "<?php } else { ?>", $tempstr);
	$tempstr = preg_replace("/\{elseif\s+(.+?)\}/", "<?php } else if(\\1) { ?>", $tempstr);
	$tempstr = preg_replace("/\{\/if\}/", "<?php } ?>", $tempstr);
	$tempstr = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>", $tempstr);
	$tempstr = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>", $tempstr);
	$tempstr = preg_replace("/\{\/loop\}/", "<?php } } ?>", $tempstr);
	$tempstr = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $tempstr);
	$tempstr = preg_replace("/<\?php([^\?]+)\?>/es", "template_addquote('<?php\\1?>')", $tempstr);
	$tempstr = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $tempstr);
	$tempstr = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "template_addquote('<?php echo \\1;?>')", $tempstr);
	$tempstr = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $tempstr);
	$tempstr = preg_replace("/\'([A-Za-z]+)\[\'([A-Za-z\.]+)\'\](.?)\'/s", "'\\1[\\2]\\3'", $tempstr);
	$tempstr = "<?php defined('IN_FR') or exit('Access Denied');?>\r\n".$tempstr;
	if($cfg['template_trim']) return strip_nr($tempstr);
	return $tempstr;
}

function template_addquote($var) {
	return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
}

function file_get($filename) {
	return file_get_contents($filename);
}

function file_del($filename) {
	if(FR_FMOD) @chmod($filename, FR_FMOD);
	return @unlink($filename);
}
function file_ext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1)));
}

function file_down($file, $filename = '') {
	$filename = $filename ? $filename : basename($file);
	$filetype = file_ext($filename);
	$filesize = filesize($file);
    ob_end_clean();
	@set_time_limit(0);
	header('Cache-control: max-age=31536000');
	header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
	header('Content-Encoding: none');
	header('Content-Length: '.$filesize);
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Type: '.$filetype);
	readfile($file);
	exit;
}

function file_list($dir, $fs = array()) {
	$files = glob($dir.'/*');
	if(!is_array($files)) return $fs;
	foreach($files as $file) {
		if(is_dir($file)) {
			$fs = file_list($file, $fs);
		} else {
			$fs[] = $file;
		}
	}
	return $fs;
}

function file_copy($from, $to) {
	dir_create(dirname($to));
	if(is_file($to)) {
		if(FR_FMOD) @chmod($to, FR_FMOD);
	}
	if(@copy($from, $to)) {
		if(FR_FMOD) @chmod($to, FR_FMOD);
		return true;
	} else {
		return false;
	}
}

function file_put($filename, $data) {
	dir_create(dirname($filename));
	file_put_contents($filename, $data);
	if(FR_FMOD) @chmod($filename, FR_FMOD);
	return is_file($filename);
}

function dir_path($dirpath) {
	$dirpath = str_replace('\\', '/', $dirpath);
	if(substr($dirpath, -1) != '/') $dirpath = $dirpath.'/';
	return $dirpath;
}

function dir_create($path) {
	if(is_dir($path)) return true;
	if(CACHE_ROOT != FR_ROOT.'/cache' && strpos($path, CACHE_ROOT) !== false) {
		$dir = str_replace(CACHE_ROOT.'/', '', $path);
		$dir = dir_path($dir);
		$temp = explode('/', $dir);
		$cur_dir = CACHE_ROOT.'/';
		$max = count($temp) - 1;
		for($i = 0; $i < $max; $i++) {
			$cur_dir .= $temp[$i].'/';
			if(is_dir($cur_dir)) continue;
			@mkdir($cur_dir);
			if(FR_FMOD) @chmod($cur_dir, FR_FMOD);
		}
	} else {
		$dir = str_replace(FR_ROOT.'/', '', $path);
		$dir = dir_path($dir);
		$temp = explode('/', $dir);
		$cur_dir = FR_ROOT.'/';
		$max = count($temp) - 1;
		for($i = 0; $i < $max; $i++) {
			$cur_dir .= $temp[$i].'/';
			if(is_dir($cur_dir)) continue;
			@mkdir($cur_dir);
			if(FR_FMOD) @chmod($cur_dir, FR_FMOD);
		}
	}
	return is_dir($path);
}

function dir_chmod($dir, $mode = '', $require = 0) {
	if(!$require) $require = substr($dir, -1) == '*' ? 2 : 0;
	if($require) {
		if($require == 2) $dir = substr($dir, 0, -1);
	    $dir = dir_path($dir);
		$list = glob($dir.'*');
		foreach($list as $v) {
			if(is_dir($v)) {
				dir_chmod($v, $mode, 1);
			} else {
				@chmod(basename($v), $mode);
			}
		}
	}
	if(is_dir($dir)) {
		@chmod($dir, $mode);
	} else {
		@chmod(basename($dir), $mode);
	}
}

function dir_copy($fromdir, $todir) {
	$fromdir = dir_path($fromdir);
	$todir = dir_path($todir);
	if(!is_dir($fromdir)) return false;
	if(!is_dir($todir)) dir_create($todir);
	$list = glob($fromdir.'*');
	foreach($list as $v) {
		$path = $todir.basename($v);
		if(is_file($path) && !is_writable($path)) {
			if(FR_FMOD) @chmod($path, FR_FMOD);
		}
		if(is_dir($v)) {
		    dir_copy($v, $path);
		} else {
			@copy($v, $path);
			if(FR_FMOD) @chmod($path, FR_FMOD);
		}
	}
    return true;
}

function dir_delete($dir) {
	$dir = dir_path($dir);
	if(!is_dir($dir)) return false;
	$sysdirs = array(FR_ROOT.'/admin/', FR_ROOT.'/api/', CACHE_ROOT.'/', FR_ROOT.'/company/', FR_ROOT.'/person/', FR_ROOT.'/school/', FR_ROOT.'/train/', FR_ROOT.'/editor/', FR_ROOT.'/upfiles/', FR_ROOT.'/inc/', FR_ROOT.'/js/', FR_ROOT.'/member/', FR_ROOT.'/skin/', FR_ROOT.'/templates/', FR_ROOT.'/wap/');
	if(substr($dir, 0, 1) == '.' || in_array($dir, $sysdirs)) die("Cannot remove system dir $dir ");
	$list = glob($dir.'*');
	if($list) {
		foreach($list as $v) {
			is_dir($v) ? dir_delete($v) : @unlink($v);
		}
	}
    return @rmdir($dir);
}
//编写日志
function log_write($message, $type = 'php') {
	global $cfg, $fr_time, $username;
	$userip = getip();
    $fr_time or $fr_time = time();
	$user = $username ? $username : 'guest';
    dir_create(DATA_ROOT.'/log/');
    $log_file = DATA_ROOT.'/log/'.$type.'_'.md5($cfg['cookie_encode']).'.txt';
	$log = date('Y-m-d H:i:s', $fr_time)."||$userip||$user||".$_SERVER['SCRIPT_NAME']."||".str_replace('&', '&amp;', $_SERVER['QUERY_STRING'])."||$message\r\n";
    $olog=file_get_contents($log_file);
    fputs(fopen($log_file,"w"), $log.$olog);
}
function getip_from($ip,$txt=null){
	if ($ip=='Unknown') return 'Unknown';
	$d_ip = explode('.',$ip);
	if ($txt!='0.txt') {
		$onlineip = $ip;
		$ip = substr($ip,strpos($ip,'.')+1);
		$txt = $d_ip[0].'.txt';
		$d_ip[0] = $d_ip[1]; $d_ip[1] = $d_ip[2]; $d_ip[2] = $d_ip[3]; $d_ip[3] = '';
	}
	if ($db = @fopen(FR_ROOT.'/ipdata/'.$txt,'rb')) {
		flock($db,LOCK_SH);
		$f = $l_d = '';
		$d = "\n".fread($db,filesize(FR_ROOT.'/ipdata/'.$txt));
		$wholeIP = $d_ip[0].'.'.$d_ip[1].'.'.$d_ip[2];
		$d_ip[3] && $wholeIP .= '.'.$d_ip[3];
		$wholeIP = str_replace('255','*',$wholeIP);
		if (($s = strpos($d,"\n$wholeIP\t"))!==false) {
			fseek($db,$s,SEEK_SET);
			$l_d = substr(fgets($db,100),0,-1); fclose($db);
			$ip_a = explode("\t",$l_d);
			$ip_a[3] && $ip_a[2] .= ' '.$ip_a[3];
			return $ip_a[2];
		}
		$ip = d_ip($d_ip);
		while (!$f && !$l_d && $wholeIP) {
			if (($s = strpos($d,"\n".$wholeIP.'.'))!==false) {
				list($l_d,$f) = s_ip($db,$s,$ip);
				if ($f) return $f;
				while ($l_d && preg_match("/^\n$wholeIP/i","\n".$l_d)!==false) {
					list($l_d,$f) = s_ip($db,$s,$ip,$l_d);
					if ($f) return $f;
				}
			}
			if (strpos($wholeIP,'.')!==false) {
				$wholeIP = substr($wholeIP,0,strrpos(substr($wholeIP,0,-1),'.'));
			} else {
				if ($txt=='0.txt') return 'Unknown';
				$wholeIP--;
			}
		}
		fclose($db);
	}
	if ($txt!='0.txt') {
		$f = getip_from($onlineip,'0.txt');
		if (!$f) return 'Unknown';
		return $f;
	}
	return 'Unknown';
}
function s_ip($db,$s,$ip,$l_d=null){
	if (empty($l_d)) {
		fseek($db,$s,SEEK_SET);
		$l_d = fgets($db,100);
	}
	$ip_a = explode("\t",$l_d);
	$ip_a[0] = d_ip(explode('.',$ip_a[0]));
	$ip_a[1] = d_ip(explode('.',$ip_a[1]));
	if ($ip<$ip_a[0]) {
		$f = $l_d = '';
	} elseif ($ip>=$ip_a[0] && $ip<=$ip_a[1]) {
		fclose($db);
		$ip_a[3] && $ip_a[2] .= ' '.$ip_a[3];
		$f = $ip_a[2]; $l_d = '';
	} else {
		$f = '';
		$l_d = fgets($db,100);
	}
	return array($l_d,$f);
}
function d_ip($d_ip){
	$d_ips = '';
	foreach ($d_ip as $value) {
		$d_ips .= '.'.sprintf("%03d",str_replace('*','255',$value));
	}
	return substr($d_ips,1);
}
function load_mailtemp($strsign='mail_mb'){
    global $cfg,$db;
    $rs = $db->get_one("SELECT `m_tit`,`m_con` FROM `{$cfg['tb_pre']}mailtemp` WHERE `m_sign`='$strsign' LIMIT 0,1");
    if($rs){
        return array('tit'=>$rs['m_tit'],'con'=>stripslashes($rs['m_con']));
    }else{
        return array();
    }
}
function CSysName($str='',$table,$pre){
    global $cfg,$db;
    $cfile = CACHE_ROOT."/sys/$table.php";
    if(!is_file($cfile)){
        $result=$db->query("SELECT `{$pre}_id`,`{$pre}_name` FROM `{$cfg['tb_pre']}{$table}`");
        while($row=$db->fetch_array($result)){
            $app[$row[$pre.'_id']]=trim($row["{$pre}_name"]);
        }
        if($app) ksort($app);
        file_put($cfile, "<?php\n\${$table}array = ".var_export($app, true).";\n?>");
        unset($app);
    }
    include $cfile;
    $SysName='';$sysarray=$table.'array';$sysarray=$$sysarray;
    if($str!=''){
        $strs=explode(',',$str);
		for ($i=0;$i<count($strs);$i++){
            $strid=$strs[$i]?substr($strs[$i],-4):'';
            if($strid!=''){
                if($i==count($strs)-1){
                    $SysName.=$sysarray[$strid];
                }else{
                    $SysName.=$sysarray[$strid].'+';
                }
            }
		}
    }
    return $SysName;
}
function csysnames($str=''){
    $SysName='';
    if($str!=''){
        $strs=explode(',',$str);
		for ($i=0;$i<count($strs);$i++){
            $strid=$strs[$i];
            if($strid!=''){
                $strids=explode('*',$strid);
                if($i==count($strs)-1){
                    $SysName.=$strids[count($strids)-1];
                }else{
                    $SysName.=$strids[count($strids)-1].'+';
                }
            }
		}
    }
    return $SysName;
}
function fredition($s=0){
    global $cfg;
    $domain=$cfg['siteurl'];$domain=str_replace('http://','',$domain);
    $domain=str_replace('www','',$domain);$edition=base64_decode('z7XNs7nK1c8=');
    $opts = array('http'=>array('method'=>"GET",'timeout'=>2));
    $context = stream_context_create($opts);
    $responseXML=@file_get_contents(base64_decode('aHR0cDovL3d3dy5maW5lcmVhc29uLmNvbS9saWNlbmNlLnBocA==').'?domain='.$domain.'&a=liecnce',false, $context);
    if($cfg['charset']=='gbk') $responseXML=@iconv('utf-8','gb2312',$responseXML);
    if(strlen($responseXML)>37){
        if(substr($responseXML,-37,5)=='sign:'){
            $edition=md5(substr($responseXML,0,-37))==substr($responseXML,-32)?base64_decode(substr($responseXML,0,-37)):base64_decode('ytTTw7DmzrTK2sio');
            if($cfg['charset']=='gbk') $edition=@iconv('utf-8','gb2312',$edition);
        }
    }
    if($s==0){
        $edition.=" <a href=\"".base64_decode('aHR0cDovL3d3dy5maW5lcmVhc29uLmNvbS9saWNlbmNlLnBocA==')."?domain=".$domain."\" target=\"_blank\">[查询]</a>";
        return $edition;
    }else{
        if($edition==base64_decode('z7XNs7nK1c8=')||$edition==base64_decode('ytTTw7DmzrTK2sio')){return false;}else{return true;}
    }
}
function membermap($str='',$w=600,$h=450){
    if($str!=''){
        return "http://searchbox.mapbar.com/publish/template/template1010/index.jsp?CID=finereason&tid=tid1010&nid=$str&width=$w&height=$h&control=1&infopoi=0&infoname=1&zoom=10&showSearchDiv=0";
    }else{
        return '';
    }
}

function getposition($p_fid=0,$p_id=''){
    global $cfg,$db;
    $otherstr='';
    $result=$db->query("SELECT * FROM `{$cfg['tb_pre']}position` WHERE `p_fid`=$p_fid ORDER BY `p_fid` asc ,`p_order` asc");
    while($row=$db->fetch_array($result)){
		if($p_fid==0){
			$otherstr.="<option value=\"{$row['p_id']}\"";
			if ($row["p_id"]=="$p_id") $otherstr.=" selected=\"selected\"";
			$otherstr.=">===={$row['p_name']}====</option>\r\n";
			$otherstr.=getposition($row['p_id'],$p_id);
		}else{
			$otherstr.="<option value=\"$p_fid*{$row['p_id']}\"";
			if ("$p_fid*{$row['p_id']}"=="$p_id") $otherstr.=" selected=\"selected\"";
			$otherstr.=">{$row['p_name']}</option>\r\n";			
			}
    }
    return $otherstr;
}

//$Powered未经授权不得擅自去除
$Powered="<br>Powered ";$Powered.="by <strong><a hr";$Powered.="ef=\"http://ww"."w."."fi";$Powered.="ne"."reason.com\" targ";
$Powered.="et=\"_blank\">FRhrC";$Powered.="ms</a></strong> <em>";$Powered.="$cfg[soft_version]</em>";

function cachesite($cfile=''){
    global $cfg,$db;
    if($cfile!=''){
        $result=$db->query("SELECT * FROM `{$cfg['tb_pre']}site`");
        while($row=$db->fetch_array($result)){
            $sitestr="<?php\n";
            $sitestr.="\$cfg['site']='$row[s_site]';\n";
            $sitestr.="\$cfg['siten']='$row[s_siten]';\n";
            $sitestr.="\$cfg['sitename']='$row[s_name]';\n";
            $sitestr.="\$cfg['siteurl']='$row[s_url]';\n";
            $sitestr.="\$cfg['logourl']='$row[s_logourl]';\n";
            $sitestr.="\$cfg['sitetitle']='$row[s_title]';\n";
            $sitestr.="\$cfg['keywords']='$row[s_meta_keywords]';\n";
            $sitestr.="\$cfg['description']='$row[s_meta_description]';\n";
            $sitestr.="\$cfg['htmldir']='$row[s_htmldir]';\n";
            $sitestr.="\$cfg['tempdir']='$row[s_tempdir]';\n";
            $sitestr.="\$cfg['links']='$row[s_links]';\n";
            $sitestr.="\$cfg['ads']='$row[s_ads]';\n";
            $sitestr.="\$cfg['company']='$row[s_company]';\n";
            $sitestr.="\$cfg['person']='$row[s_person]';\n";
            $sitestr.="\$cfg['school']='$row[s_school]';\n";
            $sitestr.="\$cfg['train']='$row[s_train]';\n";
            $sitestr.="\$cfg['announce']='$row[s_announce]';\n";
            $sitestr.="?>";
            $sfile = CACHE_ROOT."/sys/site_$row[s_site].php";
            file_put($sfile, $sitestr);
            $appsite["$row[s_site]"]=trim($row["s_url"]);
        }
        if($appsite) ksort($appsite);
        file_put($cfile, "<?php\n\$sitearray = ".var_export($appsite, true).";\n?>");
    }
}
//V2.4增加
function time_tran($the_time){
    $now_time = date("Y-m-d H:i:s",time()); 
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if($dur < 0){
        return $the_time; 
    }else{
        if($dur < 60){
            return $dur.'秒前'; 
        }else{
            if($dur < 3600){
                return floor($dur/60).'分钟前'; 
            }else{
               if($dur < 86400){
                    return floor($dur/3600).'小时前'; 
               }else{
                    if($dur < 259200){//3天内
                        return floor($dur/86400).'天前';
                    }else{
                        return $the_time; 
                    }
                }
            }
        }
    }
}
//加载短信模板
function load_smstemp($strsign=''){
    global $cfg,$db;
    $strsign&&$rs = $db->get_one("SELECT `s_con` FROM `{$cfg['tb_pre']}smstemp` WHERE `s_sign`='$strsign' LIMIT 0,1");
    if($rs){
        return stripslashes($rs['s_con']);
    }else{
        return '';
    }
}

function hirecardtype($str){
    switch($str){
        case 0:$str="身份证";break;
        case 1:$str="驾证";break;
		case 2:$str="军官证";break;
		case 3:$str="护照";break;
        case 3:$str="其它";break;
    }
    return $str;
}
function isSpider() { 
    $agent= strtolower($_SERVER['HTTP_USER_AGENT']); 
    if (!empty($agent)) { 
        $spiderSite= array(
            "TencentTraveler",
            "Baiduspider+",
            "BaiduGame", 
            "Googlebot", 
            "msnbot", 
            "Sosospider+", 
            "Sogou web spider", 
            "ia_archiver", 
            "Yahoo! Slurp", 
            "YoudaoBot", 
            "Yahoo Slurp", 
            "MSNBot", 
            "Java (Often spam bot)", 
            "BaiDuSpider", 
            "Voila", 
            "Yandex bot", 
            "BSpider", 
            "twiceler", 
            "Sogou Spider", 
            "Speedy Spider", 
            "Google AdSense", 
            "Heritrix", 
            "Python-urllib", 
            "Alexa (IA Archiver)", 
            "Ask", 
            "Exabot", 
            "Custo", 
            "OutfoxBot/YodaoBot", 
            "yacy", 
            "SurveyBot", 
            "legs", 
            "lwp-trivial", 
            "Nutch", 
            "StackRambler", 
            "The web archive (IA Archiver)", 
            "Perl tool", 
            "MJ12bot", 
            "Netcraft", 
            "MSIECrawler", 
            "WGet tools", 
            "larbin", 
            "Fish search", 
        );
        foreach($spiderSite as $val) { 
            $str = strtolower($val); 
            if (strpos($agent, $str) !== false) { 
                return true; 
            } 
        } 
    } else { 
        return false; 
    } 
}
?>