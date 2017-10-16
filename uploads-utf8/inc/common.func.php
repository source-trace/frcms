<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');

//函数名：GetLink
function getlink($imgs,$num,$nums,$order,$font_left,$target,$tj){
    global $cfg,$db;
    $htmlstr="";
    if($tj==0){$sqladd=" and `l_tj`=1";}elseif($tj==1){$sqladd=" and `l_tj`=0";}else{$sqladd="";}
    if($cfg['site']!=''){
        if($cfg['links']=='2'){
            $sqladd.=" and `l_site`={$cfg['site']}";
        }elseif($cfg['links']=='3'){
            $sqladd.=" AND (`l_site`={$cfg['site']} OR `l_site`=0)";
        }
    }else{
        $sqladd.=" AND `l_site`=0";
    }
    if($imgs==0||$imgs==2){
        $sql="SELECT `l_name`,`l_url`,`l_sm` FROM `{$cfg['tb_pre']}links` WHERE `l_key1`=1 AND `l_key`=0$sqladd ORDER BY $order";
        if($num!=0) $sql.=" LIMIT 0,$num";
        $query=$db->query($sql,'CACHE');
        while($row=$db->fetch_array($query)){
            $l_name=($font_left!=0)?sub_cnstrs($row['l_name'],$font_left):$row['l_name'];
            $htmlstr.= "<li><a href=\"$row[l_url]\" title=\"$row[l_sm]\" target=\"$target\">$l_name</a></li>\r\n";
        }
    }
    if($imgs==1||$imgs==2){
        $sql="SELECT `l_name`,`l_url`,`l_sm` FROM `{$cfg['tb_pre']}links` WHERE `l_key1`=1 AND `l_key`=1$sqladd ORDER BY $order";
        if($nums!=0) $sql.=" LIMIT 0,$nums";
        $query=$db->query($sql,'CACHE');
        while($row=$db->fetch_array($query)){
            $l_name="<img src=\"$row[l_name]\" width=88 height=31 border=0 alt=\"$row[l_sm]\">";
            $htmlstr.= "<li><a href=\"$row[l_url]\" title=\"$row[l_sm]\" target=\"$target\">$l_name</a></li>\r\n";
        }
    }
    return $htmlstr;
}
//函数名：GetSitenav
function getsitenav($str=0){
    global $cfg,$db,$cid;
    $sitenav="<li";
    if($cid!='') {$sitenav.=" class=\"channel\"";}else{$sitenav.=" class=\"home\"";}
    $sitenav.="><a href=\"{$cfg['path']}\" title=\"{$cfg['sitename']}首页\">首 页</a></li>\r\n";
    $sql="SELECT `c_id`,`c_name`,`c_readme`,`c_channeldir`,`c_linkurl`,`c_channeltype`,`c_opentype`,`c_createhtml`,`c_fileext` FROM `{$cfg['tb_pre']}channel` WHERE `c_shownav`=1 AND `c_disabled`=0 ORDER BY `c_order` ASC";
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
        $siteclass=$row['c_id']==$cid?"class=\"home\"":"class=\"channel\"";
        if($row['c_channeltype']!="2"){
            if($cfg['createhtml']=='1'){
                if($row['c_createhtml']!="0"){
                    switch($row["c_fileext"]){
                        case 0:$fileext=".html";break;
                        case 1:$fileext=".htm";break;
                        case 2:$fileext=".shtml";break;
                        case 3:$fileext=".shtm";break;
                        default:$fileext=".html";
                    }
                   	$sitenav.="<li $siteclass><a href=\"{$cfg['path']}{$cfg['htmlpath']}$row[c_channeldir]/index{$fileext}\"";
                }else{
                    $sitenav.="<li $siteclass><a href=\"{$cfg['path']}$row[c_channeldir]\"";
                }
            }elseif($cfg['createhtml']=='2'){
                $sitenav.="<li $siteclass><a href=\"{$cfg['path']}$row[c_channeldir]/index.{$cfg['defaultext']}\"";
            }else{
                $sitenav.="<li $siteclass><a href=\"{$cfg['path']}$row[c_channeldir]/\"";
            }
        }else{
            $sitenav.="<li $siteclass><a href=\"$row[c_linkurl]\"";
        }
        if($row['c_opentype']==1) $sitenav.=" target=\"_blank\"";
        $sitenav.=" title=\"$row[c_readme]\">$row[c_name]</a></li>\r\n";
    }
    return $sitenav;
}
//函数名：GetSitebottomnav
function getsitebottomnav($t=0){
    global $cfg,$db,$c_id;
    $sitebottomnav=$t?'':"| ";
    $sql="SELECT `c_id`,`c_title`,`c_htmlname` FROM `{$cfg['tb_pre']}common` WHERE `c_isshow`=1 ORDER BY `c_isorder` ASC";
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
        $c_class=$row['c_id']==$c_id?" class=\"bot_bt_on\"":" class=\"bot_bt\"";
        if($cfg['createhtml']=='1'){
            $sitet="<a href=\"{$cfg['path']}{$cfg['htmlpath']}about/$row[c_htmlname].{$cfg['defaultext']}\"{$c_class}>$row[c_title]</a>";
            $sitebottomnav.=$t?"<li>$sitet</li>\r\n":"$sitet | ";
        }elseif($cfg['createhtml']=='2'){
            $sitet="<a href=\"{$cfg['path']}common-cid-$row[c_id].{$cfg['defaultext']}\"{$c_class}>$row[c_title]</a>";
            $sitebottomnav.=$t?"<li>$sitet</li>\r\n":"$sitet | ";
        }else{
            $sitet="<a href=\"{$cfg['path']}common.php?cid=$row[c_id]\"{$c_class}>$row[c_title]</a>";
            $sitebottomnav.=$t?"<li>$sitet</li>\r\n":"$sitet | ";
        }
    }
    return $sitebottomnav;
}

//函数名：GetArticletype
function getarticletype($cid,$nums=0){
    global $cfg,$db;
    $nums=intval($nums);$newssortstr='';
    $sql="SELECT `s_id`,`s_name` FROM `{$cfg['tb_pre']}newssort` WHERE `s_cid`=$cid ORDER BY `s_order` ASC";
    if($nums!=0) $sql.=" LIMIT 0,$nums";
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
        $newssortstr.="<li><a href=\"".formatlink(0,$cid,$row['s_id'],0,0)."\">$row[s_name]</a></li>";
    }
    return $newssortstr?$newssortstr:'暂无分类';
}
//函数：GetArticleList
//功能：文章列表函数
//参数：cid:专题、频道编号;tid:专题类别编号;imgs:小图片名称：如1.gif；num:读取文章条数
//styles:显示方式()；iscomm：是否小类推荐;ispic:是否图片文章;ishome:是否首页推荐
//order:排序（按id正，反，按点击数，按时间）；font_left:标题截取字数
//target:打开方式；istit:是否显示完整的标题;
//dates：是否显示发布时间(0为不显示，其他的为代表的显示方式：1：2008-8-7；2：2008\2\8等);
//picw:图片宽度；pich：图片高度
//showtype:是否显示文章类别;con_left:内容简介字数
//例如：GetArticleList(10,0,0,20,1,0,0,0,"I_id desc",20,1,0,0,0,0,0,0)
//显示方式：（1、图片加下标题；2、图片+右上标题+右下内容；3、[图片]【类别】【标题】【时间】...；4、标题+下内容）
function getarticlelist($cid,$tid,$imgs,$num=10,$styles,$iscomm,$ispic,$ishome,$order,$font_left,$target,$istit,$dates,$picw,$pich,$showtype,$con_left){
    global $cfg,$db,$fr_time;
    $funarr=func_get_args();
    $cache_id=implode(",",$funarr);
    $sqlstr=$titles=$articlestr=$picss=$linkss=$textss='';
    @session_start();
   	if ($cid=="-1"&&isset($_SESSION["channelid"])){
   	    $cid = $_SESSION["channelid"];
    }elseif($cid=="-1"&&!isset($_SESSION["channelid"])){
        $cid = 0;
    }
	if($tid=="-1"&&isset($_SESSION["typeid"])){
	   if($_SESSION["typeid"]==''){
	       $tid=0;
	   }else{
	       $tid=$_SESSION["typeid"];
	   }
	}elseif($tid=="-1"&&!isset($_SESSION["typeid"])){
		$tid=0;
	}
	if($cid!=0) $sqlstr.=" AND `n_cid`=$cid";
	if($tid!=0) $sqlstr.=" AND `n_sid`=$tid";
	if($iscomm==1) $sqlstr.=" AND `n_iscomm`=1";
	if($ispic==1) $sqlstr.=" AND `n_ispic`=1";
	if($ishome==1) $sqlstr.=" AND `n_ishome`=1";
    if($styles==3||$styles==4){
        $sql="SELECT `n_id`,`n_sid`,`n_cid`,`n_pic`,`n_title`,`n_sorttit`,`n_overview`,`n_color`,`n_addtime`,`n_content`,`s_name` FROM `{$cfg['tb_pre']}news` INNER JOIN `{$cfg['tb_pre']}newssort` ON `n_sid`=`s_id` $sqlstr";
    }else{
        $sql="SELECT `n_id`,`n_sid`,`n_cid`,`n_pic`,`n_title`,`n_sorttit`,`n_overview`,`n_color`,`n_addtime`,`s_name` FROM `{$cfg['tb_pre']}news` INNER JOIN `{$cfg['tb_pre']}newssort` ON `n_sid`=`s_id` $sqlstr";
    }
    $sql.=" ORDER BY $order LIMIT 0,$num";
    $cache_id=md5($sql.','.$cache_id);
    $cache_file = CACHE_ROOT.'/lab/'.substr($cache_id, 0, 2).'/'.$cache_id.'.htm';
    $cache_expires=$cfg['tag_expires'] ? $cfg['tag_expires'] + mt_rand(-9, 9) : 0;
    if($cache_expires>0){
        if(!is_file($cache_file) || ($fr_time - @filemtime($cache_file) > $cache_expires)) {
            $tocache=1;
        }else{
            $tocache=0;
        }
    }else{
        $tocache=2;
    }
    if($tocache>0){
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
            $title=$row["n_sorttit"].$row["n_title"];
            if(strlen($title)>$font_left) $title=sub_cnstrs($title,$font_left)."...";
    		if($istit==1) $titles="title=\"$row[n_title]\"";
    		$infolink=formatlink($row["n_addtime"],$row["n_cid"],1,$row["n_id"],0);
    		switch($styles){
                case 1: //简单的文章标题列表
                $articlestr.="<li>";
    			if($dates!=0) $articlestr.="<span>[".dtime(strtotime($row["n_addtime"]),$dates)."]</span>";
    			if($showtype==1) $articlestr.="[<a href=\"{$cfg['path']}article/list.php?typeid=$row[n_sid]\">$row[s_name]</a>] ";
    			if($imgs!="0") $articlestr.="<img src=\"{$cfg['path']}skin/system/$imgs\" /> ";
    			$articlestr.="<a href=\"$infolink\" target=\"$target\"><font color=\"$row[n_color]\" $titles>$title</font></a>";		
    			$articlestr.="</li>\r\n";
                break;
                case 2: //图片加下标题的显示方式
                $articlestr.="<li class=\"link_pic\">";
                $picstr=str_replace("../",$cfg['path'],$row["n_pic"]);
    			$articlestr.="<a href=\"$infolink\" target=\"$target\"><img src=\"$picstr\" width=\"$picw\" height=\"$pich\" /></a><br /><a href=\"$infolink\" $titles target=\"$target\"><font color=\"$row[n_color]\">$title</font></a>";		
    			$articlestr.="</li>\r\n";
                break;
                case 3: //图片加右上标题加右下内容
    			$articlestr.="<dl>\r\n<dt>";
    			if($imgs!="0") $articlestr.="<img src=\"{$cfg['path']}skin/system/$imgs\" /> ";
    			$articlestr.="<a href=\"$infolink\" $titles target=\"$target\"><font color=\"$row[n_color]\">$title</font></a></dt>\r\n";
    			$picstr=str_replace("../",$cfg['path'],$row["n_pic"]);
                $articlestr.="<dd class=\"pic\"><a href=\"$infolink\" target=\"$target\"><img src=\"$picstr\" width=\"$picw\" height=\"$pich\" /></a></dd>\r\n";
    			$articlestr.="<dd class=\"text\">".sub_cnstrs(deletehtml($row["n_content"]),$con_left)."</dd>\r\n";
    			$articlestr.="</dl>\r\n";
                break;
                case 4: //标题加下内容简介
    			$articlestr.="<dl>\r\n<dt>";
    			if($dates!=0) $articlestr.="<span>[".dtime($row["n_addtime"],$dates)."]</span>";
    			if($imgs!="0") $articlestr.="<img src=\"{$cfg['path']}skin/system/$imgs\" /> ";
    			$articlestr.="<a href=\"$infolink\" $titles target=\"$target\"><font color=\"$row[n_color]\">$title</font></a></dt>\r\n";
    			$articlestr.="<dd class=\"text\">".sub_cnstrs(deletehtml($row["n_content"]),$con_left)."</dd>\r\n";
    			$articlestr.="</dl>\r\n";
                break;
                case 5: //幻灯篇文章显示
                $picstr=str_replace("../",$cfg['path'],$row["n_pic"]);
                $textss.="  <a href=\"$infolink\" target=\"$target\"><img src=\"$picstr\" alt=\"$title\" width=\"$picw\" height=\"$pich\" /></a>\r\n";
                break;
            }
        }
        if($styles==5&&$textss!=''){
            $articlestr.="<script type=\"text/javascript\">\r\n";
            $articlestr.="  $(function(){\r\n";
            $articlestr.="      $(\"#FRS_$cache_id\").KinSlideshow({titleBar:{titleBar_height:30}});\r\n";
            $articlestr.="  })\r\n";
            $articlestr.="</script>\r\n";
            $articlestr.="<div id=\"FRS_$cache_id\" style=\"visibility:hidden;\">\r\n";
            $articlestr.= $textss;
            $articlestr.="</div>\r\n";
        }
    }
    if($tocache<2){
        $tocache==1&&file_put($cache_file, $articlestr);
        return file_get_contents($cache_file);
    }else{
        return $articlestr;
    }
}
//函数名：GetLastArticleList
function getlastarticlelist($cid,$tid,$imgs,$order,$font_left,$target,$dates,$pagesize=20){
    global $cfg,$db;
    @session_start();
    $sqlstr=$sqlss='';
    if($cid=="-1"&&isset($_SESSION["channelid"])){
   	    $cid = $_SESSION["channelid"];
    }
    if($cid=="-1") return '';
    if($tid=="-1"&&isset($_SESSION["typeid"])){
   	    $tid = $_SESSION["typeid"];
    }
    if($tid=="-1") return '';
    if($cid!=0) $sqlstr.=" AND `n_cid`=$cid";
    if($tid!=0) $sqlstr.=" AND `n_sid`=$tid";
    if($sqlstr!=''){
        $sqlss=substr($sqlstr,4);
        $sqlstr=" WHERE".substr($sqlstr,4);
    }
    $sqlstr.=" ORDER BY $order";
    $sql="SELECT `n_id`,`n_cid`,`n_title`,`n_addtime`,`n_sorttit`,`n_color` FROM `{$cfg['tb_pre']}news` $sqlstr";
    $counts = $db->counter("{$cfg['tb_pre']}news","$sqlss");
    $page=isset($_SESSION["page"])?$_SESSION["page"]:1;
    $getpageinfo = page($page,$counts,formatlink(0,$cid,$tid,0,-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    $artlist="<ul>\r\n";
    while($row=$db->fetch_array($query)){
        $i++;
        $artlist.="<li>\r\n";
		if($dates!=0) $artlist.="<span>[".dtime(strtotime($row['n_addtime']),$dates)."]</span>\r\n";
        if($imgs==1) $artlist.="<img src=\"{$cfg['path']}skin/system/icon.gif\" align=\"absmiddle\">&nbsp;";
		$artlist.="<a href=\"".formatlink($row["n_addtime"],$row["n_cid"],1,$row["n_id"],0)."\" target=\"$target\">";
		$title=$row["n_sorttit"].$row["n_title"];
        if(strlen($title)>$font_left) $title=sub_cnstrs($title,$font_left)."...";
        $artlist.="<font color=\"$row[n_color]\">$title</font>";
        $artlist.="</a>\r\n";
		$artlist.="</li>\r\n";
        if($i%5 == 0) $artlist.="</ul><ul>\r\n";
    }
    if(substr(trim($artlist),-9)=="</ul><ul>") $artlist=substr(trim($artlist),0,-9);
    $artlist.="</ul>";
    $artlist.=$getpageinfo['pagecode'];
    return $artlist;
}
//函数名GetCirArticleList
function getcirarticlelist($cid,$tnum,$torder,$num,$imgs,$order,$font_left,$target,$dates){
    global $cfg,$db;
    session_start();
    if($cid=="-1"&&isset($_SESSION["channelid"])){
   	    $cid = $_SESSION["channelid"];
    }
    if($cid=="-1") return '';
    $sqlstr=" ORDER BY $torder";$cirstr='';
    if($tnum!=0) $sqlstr.=" LIMIT 0,$tnum";
    $sql="SELECT `s_id`,`s_name` FROM `{$cfg['tb_pre']}newssort` WHERE `s_cid`=$cid $sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $cirstr.="<div class=\"newstmain\">\r\n";
        $cirstr.="<div class=\"tit\"'><span><a href=\"{$cfg['path']}rss.php?a=news&s={$row["s_id"]}\" target=\"_blank\"><img src=\"{$cfg['path']}images/rss.jpg\" align=\"absmiddle\"></a> <a href=\"".formatlink(0,$cid,$row["s_id"],0,0)."\">更多...</a></span>$row[s_name]</div>\r\n";
        $cirstr.="<div class=\"con\">".getarticlelist($cid,$row["s_id"],$imgs,$num,1,0,0,0,$order,$font_left,$target,0,$dates,133,100,0,70)."</div>\r\n";
        $cirstr.="</div>\r\n";
    }
    return $cirstr;
}
//函数名：GetArticleSearch
function getarticlesearch($cid,$tid){
    global $cfg,$db;
    session_start();
    if($cid=="-1"&&isset($_SESSION["channelid"])){
   	    $cid = $_SESSION["channelid"];
    }
    if($cid=="-1") return '';
    $searchstr="<form action=\"{$cfg['path']}search/news_search.php?cid=$cid\" name=search_form method=post>\r\n";
    $searchstr.="<b>站内资讯搜索:</b> <input name=keywords id=keywords size=28 value=''>\r\n";
    $searchstr.="<select name=\"s_tit\">\r\n";
    $searchstr.="<option value=\"title\">标题检索</option>\r\n";
    $searchstr.="<option value=\"content\">全文检索</option>\r\n";
    $searchstr.="</select>\r\n";
    $searchstr.="<select name=\"typeid\">\r\n";
    $searchstr.="<option value=\"\" selected>全部</option>\r\n";
    $sql="SELECT `s_id`,`s_name` FROM `{$cfg['tb_pre']}newssort` WHERE `s_cid`=$cid ORDER BY `s_order` ASC";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $searchstr.="<option value=\"$row[s_id]\"";
        if($tid!=0&&$tid=$row["s_id"]) $searchstr.=" selected";
        $searchstr.=">$row[s_name]</option>\r\n";
    }
    $searchstr.="</select>\r\n";
    $searchstr.="<input name=\"submit\" type=\"submit\" value=\"搜索\">\r\n";
    $searchstr.="</from>\r\n";
    return $searchstr;
}
//函数名：GetResumeList
function getresumelist($nums,$rows,$sqlfield,$flag,$cnstatus,$commands,$groupid,$usergroup,$jobtype,$order,$target,$ppic,$bxpic,$picw,$pich,$cityid,$trade,$position=0){
    global $cfg,$db,$fr_time;
    $funarr=func_get_args();
    $cache_id=implode(",",$funarr);
    $sqlstr='';$i=0;$resumefield=explode("|",$sqlfield);
    $resumestr="<table width=100% border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
	$resumestr.="<tr>\r\n";
	if($ppic==0||$ppic==1){
        for($t=1;$t<=$rows;$t++){
            if($ppic==1) $resumestr.="<td></td>\r\n";
            $resumefield[0]&&$resumestr.="<td><b>编号</b></td>\r\n";
            $resumefield[1]&&$resumestr.="<td><b>用户名</b></td>\r\n";
            $resumefield[2]&&$resumestr.="<td><b>姓名</b></td>\r\n";
            $resumefield[3]&&$resumestr.="<td><b>性别</b></td>\r\n";
            $resumefield[4]&&$resumestr.="<td><b>出生日期</b></td>\r\n";
            $resumefield[5]&&$resumestr.="<td><b>学历</b></td>\r\n";
            $resumefield[6]&&$resumestr.="<td><b>意向工作职位</b></td>\r\n";
            $resumefield[7]&&$resumestr.="<td><b>工作性质</b></td>\r\n";
            $resumefield[8]&&$resumestr.="<td><b>意向工作地</b></td>\r\n";
            $resumefield[9]&&$resumestr.="<td><b>更新日期</b></td>\r\n";
        }
        $resumestr.="</tr><tr>\r\n";
	}
    $flag&&$sqlstr.=" AND `r_flag`=1";
	$cnstatus&&$sqlstr.=" AND `r_cnstatus`=1";
	if($usergroup!=3) $sqlstr.=" AND `r_usergroup`=$usergroup";
    if($jobtype!=3) $sqlstr.=" AND `r_jobtype`=$jobtype";
    $commands&&$sqlstr.=" AND `m_comm`=1";
    if($ppic!=0&&$bxpic==1) $sqlstr.=" AND `m_logostatus`=1 AND `m_logoflag`=1 AND `m_logo`<>'' AND `m_logo`<>'nologo.gif' AND `m_logo`<>'error.gif'";
	if($groupid!=0)$sqlstr.=" AND `m_groupid`=$groupid";
    session_start();
    if($cityid=="-1"&&isset($_SESSION["cityid"])){
   	    $cityid = $_SESSION["cityid"];
    }
    $cityid=="-1"&&$cityid=0;
    if($cityid!=0){
        $sqlstr.=" AND `m_seat` LIKE '%".hireworkadd($cityid)."%'";
    }else{
        //分站信息判断
        if($cfg['site']!=''){
            if($cfg['person']=='2'){
                $sqlstr.=" AND `m_seat` LIKE '%".hireworkadd($cfg['site'])."%'";
            }elseif($cfg['person']=='3'){
                $sqlstr.=" AND (`m_seat` LIKE '%".hireworkadd($cfg['site'])."%' OR `m_site`=0)";
            }
        }
    }
    if($trade=="-1"&&isset($_SESSION["trade"])){
   	    $trade = $_SESSION["trade"];
    }
    $trade=="-1"&&$trade=0;
    if($trade!=0) $sqlstr.=" AND `r_trade` LIKE '%$trade%'";
    if($position!=0){
        $sqlstr.=" AND (";
        $positions=explode(',',$position);
        foreach($positions as $key){
            $sqlstr.="`r_position` LIKE '%$key%' OR ";
        }
        if(substr($sqlstr,-3)=='OR ') $sqlstr=substr($sqlstr,0,-4);
        $sqlstr.=")";
    }
    $sqlstr.=" ORDER BY $order";
    $nums&&$sqlstr.=" LIMIT 0,$nums";
    $sql="SELECT `r_id`,`r_sex`,`r_birth`,`r_edu`,`r_position`,`r_jobtype`,`r_workadd`,`r_adddate`,`r_member`,`r_name`,`m_logo`,`m_nameshow` FROM `{$cfg['tb_pre']}resume` INNER JOIN `{$cfg['tb_pre']}member` ON `r_mid`=`m_id` AND `m_flag`=1 AND `r_openness`=0 AND `r_personinfo`=1 AND `r_careerwill`=1 $sqlstr";
    $cache_id=md5($sql.','.$cache_id);
    $cache_file = CACHE_ROOT.'/lab/'.substr($cache_id, 0, 2).'/'.$cache_id.'.htm';
    $cache_expires=$cfg['tag_expires'] ? $cfg['tag_expires'] + mt_rand(-9, 9) : 0;
    if($cache_expires>0){
        if(!is_file($cache_file) || ($fr_time - @filemtime($cache_file) > $cache_expires)) {
            $tocache=1;
        }else{
            $tocache=0;
        }
    }else{
        $tocache=2;
    }
    if($tocache>0){
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
            $i++;
            $r_name=$row['r_name'];$m_nameshow=$row['m_nameshow'];$r_sex=$row['r_sex'];
            $r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'女士');
            $resumelink=formatlink($row["r_adddate"],1,1,$row["r_id"],0);
            if($ppic!=0){
                $picstr=$row["m_logo"] ? str_replace("../",$cfg['path'],$row["m_logo"]) : "upfiles/person/nophoto.gif";
                $title="我想在".xreplace($row["r_workadd"],0,1)."等地找".xreplace($row["r_position"],0,1)."及相关的工作";
                $resumestr.="<td><li class=\"perlistlogo\"><a href=\"$resumelink\" target=\"$target\" title=\"$title\"><img src=\"$picstr\" style=\"padding:1px; border:1px #F0F0F0 solid;\" height=\"$pich\" width=\"$picw\" /></a>";
                if($ppic==4){$resumestr.="<br><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$r_name</a>";}
                $resumestr.="</li></td>\r\n";
            }
            //if($dates!=''){
                $datestr=dtime(strtotime($row["r_adddate"]),3);
            //}else{$datestr='';}
            if($ppic==0||$ppic==1){
                $resumefield[0]&&$resumestr.="<td><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$row[r_id]</a></td>\r\n";
                $resumefield[1]&&$resumestr.="<td><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$row[r_member]</a></td>\r\n";
                $resumefield[2]&&$resumestr.="<td><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$r_name</a></td>\r\n";
                $resumefield[3]&&$resumestr.="<td>".hiresex($row["r_sex"])."</td>\r\n";
                $resumefield[4]&&$resumestr.="<td>$row[r_birth]</td>\r\n";
                $resumefield[5]&&$resumestr.="<td>".hireedu($row["r_edu"])."</td>\r\n";
                $resumefield[6]&&$resumestr.="<td><a href=\"$resumelink\" target=\"$target\" title=\"$title\">".xreplace($row["r_position"],1,1)."</a></td>\r\n";
                $resumefield[7]&&$resumestr.="<td>".hiretype($row["r_jobtype"])."</td>\r\n";
                $resumefield[8]&&$resumestr.="<td>".xreplace($row["r_workadd"],1,1)."</td>\r\n";
                $resumefield[9]&&$resumestr.="<td>$datestr</td>\r\n";
            }elseif($ppic==2){
                $resumestr.="<td><div class=perlistinfo>\r\n";
                $resumefield[0]&&$resumestr.="<li><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$row[r_id]</a></li>\r\n";
                $resumefield[1]&&$resumestr.="<li><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$row[r_member]</a></li>\r\n";
                $resumefield[2]&&$resumestr.="<li><a href=\"$resumelink\" target=\"$target\" title=\"$title\">$r_name</a></li>\r\n";
                $resumefield[3]&&$resumestr.="<li>".hiresex($row["r_sex"])."</li>\r\n";
                $resumefield[4]&&$resumestr.="<li>$row[r_birth]</li>\r\n";
                $resumefield[5]&&$resumestr.="<li>".hireedu($row["r_edu"])."</li>\r\n";
                $resumefield[6]&&$resumestr.="<li><a href=\"$resumelink\" target=\"$target\" title=\"$title\">".xreplace($row["r_position"],1,1)."</a></li>\r\n";
                $resumefield[7]&&$resumestr.="<li>".hiretype($row["r_jobtype"])."</li\r\n";
                $resumefield[8]&&$resumestr.="<li>".xreplace($row["r_workadd"],1,1)."</li>\r\n";
                $resumefield[9]&&$resumestr.="<li>$datestr</li>\r\n";
                $resumestr.="</div></td>\r\n";
            }
            if($i%$rows == 0) $resumestr.="</tr><tr>\r\n";
        }
        $resumestr=trim($resumestr);
        $resumestr=(substr($resumestr,-9)=="</tr><tr>")?substr($resumestr,0,-9):$resumestr;
        $resumestr.="</tr></table>\r\n";
    }
    if($tocache<2){
        $tocache==1&&file_put($cache_file, $resumestr);
        return file_get_contents($cache_file);
    }else{
        return $resumestr;
    }
}

//函数名：GetComList
function getcomlist($nums=0,$rows,$groupid,$name_left,$ishire,$hireyes,$hire_left,$hire_nums,$hireflag,$comflag,$commands,$order,$target,$clogo,$yeslogo,$bxlogo,$tjlogo,$logow,$logoh,$trade,$cityid,$dates=0,$new=0,$hot=0,$type=0){
    global $cfg,$db,$fr_time;
    $funarr=func_get_args();
    $cache_id=implode(",",$funarr);
    
    $sqlstr='';$i=0;$hsqls='';$isqlstr='';
    if($type!=0){
        $sqlstr.=" AND `m_typeid`=$type";
    }else{
        $sqlstr.=" AND `m_typeid`<>1";
    }
    if($groupid!=0)$sqlstr.=" AND `m_groupid`=$groupid";
    $comflag&&$sqlstr.=" AND `m_flag`=1";
    $clogo&&$sqlstr.=" AND `m_logoflag`=1";
    if($clogo==1&&$bxlogo==1) $sqlstr.=" AND `m_logo`<>'' AND `m_logo`<>'nologo.gif' AND `m_logo`<>'error.gif'";
    if($clogo==1&&$tjlogo==1) $sqlstr.=" AND `m_logocomm`=1 AND DATEDIFF(m_logostartdate,'".date('Y-m-d')."')<=0 AND DATEDIFF(m_logoenddate,'".date('Y-m-d')."')>=0";
    $commands&&$sqlstr.=" AND `m_comm`=1 and DATEDIFF(m_commstart,'".date('Y-m-d')."')<=0 AND DATEDIFF(m_commend,'".date('Y-m-d')."')>=0";
    @session_start();
    if($cityid=="-1"&&isset($_SESSION["cityid"])){
   	    $cityid = $_SESSION["cityid"];
    }
    $cityid=="-1"&&$cityid=0;
    if($cityid!=0){
        $sqlstr.=" AND `m_seat` LIKE '%".hireworkadd($cityid)."%'";
    }else{
        //分站信息判断
        if($cfg['site']!=''){
            if($cfg['company']=='2'){
                $sqlstr.=" AND (`m_seat` LIKE '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site'].")";
            }elseif($cfg['company']=='3'){
                $sqlstr.=" AND (`m_seat` LIKE '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site']." OR `m_site`=0)";
            }
        }
    }
    if($trade=="-1"&&isset($_SESSION["trade"])){
   	    $trade = $_SESSION["trade"];
    }
    $trade=="-1"&&$trade=0;
    if($trade!=0){
        $sqlstr.=" AND `t_id`=$trade";
        $isqlstr=" INNER JOIN `{$cfg['tb_pre']}trade` ON `t_name`=`m_trade`";
    }
    $ishire&&$sqlstr.=" AND `m_ishire`>0";
    $sqlstr.=" AND DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 AND DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    $sqlstr.=" ORDER BY $order";
    $nums&&$sqlstr.=" LIMIT 0,$nums";
    $sql="SELECT `m_id`,`m_regdate`,`m_logo`,`m_name`,`m_activedate`,DATEDIFF('".date('Y-m-d')."',m_activedate) as new,`m_comm`,DATEDIFF(m_commend,'".date('Y-m-d')."') as commend FROM `{$cfg['tb_pre']}member` $isqlstr WHERE `m_name`<>'' $sqlstr";
    $cache_id=md5($sql.','.$cache_id);
    $cache_file = CACHE_ROOT.'/lab/'.substr($cache_id, 0, 2).'/'.$cache_id.'.htm';
    $cache_expires=$cfg['tag_expires'] ? $cfg['tag_expires'] + mt_rand(-9, 9) : 0;
    if($cache_expires>0){
        if(!is_file($cache_file) || ($fr_time - @filemtime($cache_file) > $cache_expires)) {
            $tocache=1;
        }else{
            $tocache=0;
        }
    }else{
        $tocache=2;
    }
    if($tocache>0){
        $query=$db->query($sql);
        $comstr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
    	$comstr.="<tr>\r\n";
        $i=0;
        while($row=$db->fetch_array($query)){
            $i++;
        	$comstr.="<td width=\"".round(100/$rows)."%\">\r\n";
            $picstr=$row["m_logo"] ? str_replace("../",$cfg['path'],$row["m_logo"]) : $cfg['path']."upfiles/company/nologo.gif";
        	$clogo&&$comstr.="<li class=\"comlistlogo\"><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"$target\"><img src=\"$picstr\" border=0 style=\"padding:1px; border:1px #F0F0F0 solid;\" height=\"$logoh\" width=\"$logow\" title=\"$row[m_name]\" /></a></li>\r\n";
        	if(!$yeslogo){
                if($clogo==1&&$name_left==0){
                }else{
                    if($dates!=0){
                        $datestr=dtime(strtotime($row["m_activedate"]),intval($dates));
                    }else{$datestr='';}
                    $comstr.="<li class=\"comlisttit\"><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"$target\"  title=\"$row[m_name]\" >".sub_cnstrs($row["m_name"],$name_left)."</a><span>$datestr</span>";
                    if($hot&&$row['m_comm']==1&&$row['commend']>=0){
                        $comstr.="<img src=\"$cfg[path]skin/system/hot.gif\" align=\"absmiddle\" >";
                    }else{
                        if($new&&$row['new']<=3){
                            $comstr.="<img src=\"$cfg[path]skin/system/new.gif\" align=\"absmiddle\" >";
                        }
                    }
                    $comstr.="</li>\r\n";
                }
                if($hireyes){
                    $comstr.="<li class=\"comhirelist\">\r\n";
                    $hsqls='';
                    if($hireflag!=0) $hsqls.=" AND `h_status`=1";
                    $hsqls.=" ORDER BY `h_adddate` DESC";
                    if($hire_nums!=0) $hsqls.=" LIMIT 0,$hire_nums";
                    $hsql="SELECT `h_id`,`h_adddate`,`h_place` FROM `{$cfg['tb_pre']}hire` WHERE `h_comid`={$row[m_id]} $hsqls";
                    $hirestr='';
                    $querys=$db->query($hsql);
                    while($rs=$db->fetch_array($querys)){
                        $hirestr.="<a href=\"".formatlink($rs["h_adddate"],2,3,$rs["h_id"],0)."\" target=\"$target\" title=\"招聘$rs[h_place]\">".sub_cnstrs($rs["h_place"],$hire_left)."</a> ";
                    }
                    $comstr.=$hirestr==''?"尚未发布职位信息!":$hirestr;
                    $comstr.="</li>\r\n";
                }
        	}
            $comstr.="</td>\r\n";
            if($i%$rows == 0) $comstr.="</tr><tr>\r\n";
        }
        $comstr=trim($comstr);
        $comstr=(substr($comstr,-9)=="</tr><tr>")?substr($comstr,0,-9):$comstr;
        $comstr.="</tr></table>\r\n";
    }
    if($tocache<2){
        $tocache==1&&file_put($cache_file, $comstr);
        return file_get_contents($cache_file);
    }else{
        return $comstr;
    }
}              
//函数名：GetComHireList：
function getcomhirelist($cid='',$st=0){
    global $cfg,$db;
    if($st==1){
        $hirestr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
    	$hirestr.="<tr class=\"hiretit\">\r\n";
    	$hirestr.="<td>职位名称</td>\r\n";
        $hirestr.="<td>招聘人数</td>\r\n";
        $hirestr.="<td>工作地区</td>\r\n";
        $hirestr.="<td>发布日期</td>\r\n";
        $hirestr.="<td>截止日期</td>\r\n";
        $hirestr.="</tr>\r\n";
    }
    $sql="SELECT `h_id`,`h_place`,`h_number`,`h_adddate`,`h_workadd`,`h_enddate`,DATEDIFF(h_enddate,'".date('Y-m-d')."') as end FROM `{$cfg['tb_pre']}hire` WHERE `h_comid`=$cid AND `h_status`=1 ORDER BY `h_adddate` DESC";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        if($st==1){
            $hirestr.="<tr><td><a href=\"".formatlink($row["h_adddate"],2,3,$row["h_id"],0)."\">$row[h_place]</a></td>\r\n";
            $hirestr.="<td>".hirenumber($row["h_number"])."</td>\r\n";
            $hirestr.="<td>".xreplace($row["h_workadd"],1)."</td>\r\n";
            $hirestr.="<td>".dtime(strtotime($row["h_adddate"]),$dates)."</td>\r\n";
            $hirestr.="<td>$row[h_enddate]</td></tr>\r\n";
            
        }else{
            $hirestr.="<li><a href=\"".formatlink($row["h_adddate"],2,3,$row["h_id"],0)."\">$row[h_place](".hirenumber($row["h_number"]).")</a>";
            if($row["end"]<0) $hirestr.=" <font color=red>过期</font>";
            $hirestr.="</li>\r\n";
        }
    }
    if($st==1) $hirestr.="</table>\r\n";
    return $hirestr;
}
//函数名：GetMemberPic
function getmemberpic($com='',$st=0,$num=10,$t=12,$w=100,$h=100){
    global $cfg,$db;
    $sqlstr='';
    session_start();
    if ($com=="-1"&&isset($_SESSION["companyid"])){
   	    $com = $_SESSION["companyid"];
    }
    if($com=="-1") $com='';
    if($com!='') $sqlstr.=" AND `p_member`='$com'";
    $t&&$sqlstr.=" AND `p_type`=$t";
    $st&&$sqlstr.=" GROUP BY `p_member`";
    $sqlstr.=" ORDER BY `p_adddate` DESC";
    $num&&$sqlstr.=" LIMIT 0,$num";
    $sql="SELECT `p_id`,`p_filename`,`p_name` FROM `{$cfg['tb_pre']}picture` WHERE `p_status`=1 AND `p_flag`=1 $sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $pic=$cfg['siteurl'].str_replace("../",$cfg['path'],$row["p_filename"]);
        if(substr($t,0,1)==2) $link=formatlink(0,1,2,$row["p_id"],0);
        if(substr($t,0,1)==1) $link=formatlink(0,2,4,$row["p_id"],0);
        if(substr($t,0,1)==3) $link=formatlink(0,3,10,$row["p_id"],0);
        if(substr($t,0,1)==4) $link=formatlink(0,5,9,$row["p_id"],0);
        $picstr.="<li><a href=\"{$link}\" target=\"_blank\" ><img src=\"$pic\" width=\"$w\" height=\"$h\" border=0 ></a></li>\r\n";
    }
    return $picstr;
}
//函数名：GetHireList
function gethirelist($nums,$rows,$sqlfield,$comflag,$commands,$groupid,$hireflag,$hirecommands,$usergroup,$hirestype,$order,$target,$position=0,$name_left,$cname_left,$dates=0){
    global $cfg,$db;
    $sqlstr='';$i=0;$hirefield=explode("|",$sqlfield);
    $hirestr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
	$hirestr.="<tr class=\"hiretit\">\r\n";
	for($t=1;$t<=$rows;$t++){
        $hirefield[0]&&$hirestr.="<td>职位名称</td>\r\n";
        $hirefield[1]&&$hirestr.="<td>公司名称</td>\r\n";
        $hirefield[2]&&$hirestr.="<td>人数</td>\r\n";
        $hirefield[3]&&$hirestr.="<td>招聘类别</td>\r\n";
        $hirefield[4]&&$hirestr.="<td>招聘部门</td>\r\n";
        $hirefield[5]&&$hirestr.="<td>工作地区</td>\r\n";
        $hirefield[6]&&$hirestr.="<td>薪资待遇</td>\r\n";
        $hirefield[7]&&$hirestr.="<td>专业要求</td>\r\n";
        $hirefield[8]&&$hirestr.="<td>学历要求</td>\r\n";
        $hirefield[9]&&$hirestr.="<td>工作经验</td>\r\n";
        $hirefield[10]&&$hirestr.="<td>性别要求</td>\r\n";
        $hirefield[11]&&$hirestr.="<td>年龄要求</td>\r\n";
        $hirefield[12]&&$hirestr.="<td>截止日期</td>\r\n";
        $hirefield[13]&&$hirestr.="<td>更新日期</td>\r\n";
	}
    $hirestr.="</tr><tr>\r\n";
    $comflag&&$sqlstr.=" and m_flag=1";
    $commands&&$sqlstr.=" and m_comm=1 and DATEDIFF(m_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(m_commend,'".date('Y-m-d')."')>=0";
    $groupid&&$sqlstr.=" and m_groupid=$groupid";
    if($usergroup!=3) $sqlstr.=" and h_usergroup=$usergroup";
    if($hirestype==1) $sqlstr.=" and h_type<>2";
    if($hirestype==2) $sqlstr.=" and h_type<>1";
    if($hireflag==1){$sqlstr.=" and h_status=1";}else{$sqlstr.=" and (h_status=0 or h_status=1)";}
    $hirecommands&&$sqlstr.=" and h_comm=1 and DATEDIFF(h_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(h_commend,'".date('Y-m-d')."')>=0";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    //分站信息判断
    if($cfg['site']!=''){
        if($cfg['company']=='2'){
            $sqlstr.=" and m_seat like '%".hireworkadd($cfg['site'])."%'";
        }elseif($cfg['company']=='3'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' or m_site=0)";
        }
    }
    @session_start();
   	if ($position=="-1"&&isset($_SESSION["position"])){
   	    $position = $_SESSION["position"];
    }
    if($position!=''){
        $sqlstr.=" and (";
        $positions=explode(',',$position);
        foreach($positions as $key){
            $sqlstr.="h_position like '%$key%' or ";
        }
        if(substr($sqlstr,-3)=='or ') $sqlstr=substr($sqlstr,0,-4);
        $sqlstr.=")";
    }
    if(substr($sqlstr,0,4)==" and") $sqlstr=" where".substr($sqlstr,4);
    $sqlstr.=" order by $order limit 0,$nums";
    $sql = "select h_id,h_adddate,h_place,h_number,h_type,h_enddate,h_workadd,h_edu,h_pay,h_dept,h_profession,h_sex,h_age1,h_age2,h_comname,h_experience,m_id,m_regdate,m_name from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_comid=m_id $sqlstr";
    $query=$db->query($sql,"CACHE");
    while($row=$db->fetch_array($query)){
        $i++;
        $hirefield[0]&&$hirestr.="<td><a href=\"".formatlink($row["h_adddate"],2,3,$row["h_id"],0)."\" target=\"$target\">".sub_cnstrs($row["h_place"],$name_left)."</a></td>\r\n";
        $hirefield[1]&&$hirestr.="<td><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"$target\" title=\"$row[m_name]\">".sub_cnstrs($row["h_comname"],$cname_left)."</a></td>\r\n";
        $hirefield[2]&&$hirestr.="<td>".hirenumber($row["h_number"])."</td>\r\n";
        $hirefield[3]&&$hirestr.="<td>".hiretype($row["h_type"])."</td>\r\n";
        $hirefield[4]&&$hirestr.="<td>$row[h_dept]</td>\r\n";
        $hirefield[5]&&$hirestr.="<td>".xreplace($row["h_workadd"],1)."</td>\r\n";
        $hirefield[6]&&$hirestr.="<td>".hirepay($row["h_pay"])."</td>\r\n";
        $hirefield[7]&&$hirestr.="<td>".xreplace($row["h_profession"])."</td>\r\n";
        $hirefield[8]&&$hirestr.="<td>".hireedu($row["h_edu"])."</td>\r\n";
        $hirefield[9]&&$hirestr.="<td>".xreplace($row["h_experience"])."</td>\r\n";
        $hirefield[10]&&$hirestr.="<td>".hiresex($row["h_sex"])."</td>\r\n";
        if($row["h_age1"]==0&&$row["h_age2"]==0){
            $h_age="不限";
        }elseif($row["h_age1"]!=0&&$row["h_age2"]==0){
            $h_age=$row["h_age1"]."～不限";
        }else{
            $h_age=$row["h_age1"]."～".$row["h_age2"];
        }
        $hirefield[11]&&$hirestr.="<td>$h_age</td>\r\n";
        $hirefield[12]&&$hirestr.="<td>$row[h_enddate]</td>\r\n";
        $hirefield[13]&&$hirestr.="<td>".dtime(strtotime($row["h_adddate"]),$dates)."</td>\r\n";
        if($i%$rows == 0) $hirestr.="</tr><tr>\r\n";
    }
    $hirestr=trim($hirestr);
    $hirestr=(substr($hirestr,-9)=="</tr><tr>")?substr($hirestr,0,-9):$hirestr;
    $hirestr.="</tr></table>\r\n";
    return $hirestr;
}
//函数名：GetHrzwList
function gethrzwlist($nums=20,$rows,$name_left,$com_left,$order,$target,$shownum,$show){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $hrstr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$hrstr.="<tr>\r\n";
    $sql="select h_id,h_job,h_cname,h_cnum,h_adddate,h_comtype from {$cfg['tb_pre']}hrzp where h_flag=1 order by $order limit 0,$nums";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $hrstr.="<td width=\"".round(100/$rows)."%\">";
        $hrlink=formatlink($row["h_adddate"],4,3,$row["h_id"],0);
        $hrstr.="<a href=\"$hrlink\" target=\"$target\">";
        if($show==1){$hrstr.=sub_cnstrs($row["h_cname"],$com_left);}else{$hrstr.=sub_cnstrs($row["h_comtype"],$com_left);}
        $hrstr.="诚聘".sub_cnstrs($row["h_job"],$name_left);
        if($shownum==1) $hrstr.="($row[h_cnum]人)";
        $schstr.="</a></td>\r\n";
        if($i%$rows == 0) $hrstr.="</tr><tr>\r\n";
    }
    $hrstr=trim($hrstr);
    $hrstr=(substr($hrstr,-9)=="</tr><tr>")?substr($hrstr,0,-9):$hrstr;
    $hrstr.="</tr></table>\r\n";
    return $hrstr;
}
//函数名：GetLastHrHireList
function getlasthrhirelist($pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $reqstr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
    $sql="select h_id,h_job,h_cname,h_cnum,h_adddate from {$cfg['tb_pre']}hrzp where h_flag=1 order by h_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,4,2,1,-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $reqstr.="<tr>\r\n";
        $reqlink=formatlink($row["h_adddate"],4,3,$row["h_id"],0);
        $reqstr.="<td bgcolor=\"#FFFFff\">·<a href=\"$reqlink\" target=\"_blank\"><font style=\"font-size:14px;\">$row[h_name]诚聘$row[h_job]</font></a> （$row[h_cnum]人） $row[h_adddate]</td>\r\n";
        $reqstr.="</tr>\r\n";
    }
    $reqstr.="</table>\r\n";
    $reqstr.=$getpageinfo['pagecode'];
    return $reqstr;
}
//函数名：GetSchList
function getschlist($nums=0,$rows,$groupid,$styles,$schpic,$logow,$logoh,$name_left,$info_left,$schflag,$schmands,$order,$target){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $schstr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$schstr.="<tr>\r\n";
    if($groupid!=0) $sqlstr.=" and m_groupid=$groupid";
    if($schflag==1) $sqlstr.=" and m_flag=1";
    if(($styles==1||$styles==2)&&$schpic==1) $sqlstr.=" and m_logo<>'' and m_logo<>'nologo.gif' and m_logo<>'error.gif'";
    if($schmands==1) $sqlstr.=" and m_comm=1 and DATEDIFF(m_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(m_commend,'".date('Y-m-d')."')>=0";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    //分站信息判断
    if($cfg['site']!=''){
        if($cfg['school']=='2'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site'].")";
        }elseif($cfg['school']=='3'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site']." or m_site=0)";
        }
    }
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select m_id,m_regdate,m_name,m_logo,m_introduce from {$cfg['tb_pre']}member where m_typeid=3$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $schstr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $schlink=formatlink($row["m_regdate"],3,1,$row["m_id"],0);
        $picstr=$row["m_logo"] ? str_replace("../",$cfg['path'],$row["m_logo"]) : "upfiles/school/nologo.gif";
        switch($styles){
            case 1:
            $schstr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $schstr.="<tr><td rowspan=\"2\" width=\"10%\"><li class=schlistlogos><a href=\"$schlink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $schstr.="<td><li class=schlisttits><a href=\"$schlink\" target=\"$target\">".sub_cnstrs($row["m_name"],$name_left)."</a></li></td>\r\n";
            $schstr.="</tr><tr>\r\n";
            $schstr.="<td>".sub_cnstrs($row["m_introduce"],$info_left)."...</td>\r\n";
            $schstr.="</tr></table>\r\n";
            break;
            case 2:
            $schstr.="<li class=schlistlogo><a href=\"$schlink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li>\r\n";
            break;
            case 3:
            $schstr.="<li class=schlisttit style=\"padding-left:12px;\"><a href=\"$schlink\" target=\"$target\">".sub_cnstrs($row["m_name"],$name_left)."</a></li>\r\n";
            break;
        }
        $tschstr.="</td>\r\n";
        if($i%$rows == 0) $schstr.="</tr><tr>\r\n";
    }
    $schstr=trim($schstr);
    $schstr=(substr($schstr,-9)=="</tr><tr>")?substr($schstr,0,-9):$schstr;
    $schstr.="</tr></table>\r\n";
    return $schstr;
}
//函数名：GetProList
function getprolist($nums=20,$rows,$styles,$schpic,$logow,$logoh,$name_left,$info_left,$schmands,$order,$target){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $prostr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$prostr.="<tr>\r\n";
    if(($styles==1||$styles==2)&&$schpic==1) $sqlstr.=" and p_photo<>''";
    if($schmands==1) $sqlstr.=" and p_commflag=1";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    //分站信息判断
    if($cfg['site']!=''){
        if($cfg['school']=='2'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site'].")";
        }elseif($cfg['school']=='3'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site']." or m_site=0)";
        }
    }
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select p_id,p_name,p_adddate,p_photo,p_introduce,p_position from {$cfg['tb_pre']}member,{$cfg['tb_pre']}professor where m_login=p_member and m_flag=1 and m_typeid=3$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $prostr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $prolink=formatlink($row["p_adddate"],3,3,$row["p_id"],0);
        $picstr=$row["p_photo"] ? str_replace("../",$cfg['path'],$row["p_photo"]) : "upfiles/school/nologo.gif";
        switch($styles){
            case 1:
            $prostr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $prostr.="<tr><td rowspan=\"2\"><li class=schlistlogos><a href=\"$prolink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $prostr.="<td><li class=schlisttits><a href=\"$prolink\" target=\"$target\">".sub_cnstrs($row["p_name"],$name_left)."</a><font style=\"font-size:12px;color:#666;\">($row[p_position])</font></li></td>\r\n";
            $prostr.="</tr><tr>\r\n";
            $prostr.="<td>".sub_cnstrs($row["p_introduce"],$info_left)."...</td>\r\n";
            $prostr.="</tr></table>\r\n";
            break;
            case 2:
            $prostr.="<li class=schlistlogo><a href=\"$prolink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li>\r\n";
            break;
            case 3:
            $prostr.="<li class=schlisttit style=\"padding-left:12px;\"><a href=\"$prolink\" target=\"$target\">".sub_cnstrs($row["p_name"],$name_left)."</a></li>\r\n";
            break;
        }
        $prostr.="</td>\r\n";
        if($i%$rows == 0) $prostr.="</tr><tr>\r\n";
    }
    $prostr=trim($prostr);
    $prostr=(substr($prostr,-9)=="</tr><tr>")?substr($prostr,0,-9):$prostr;
    $prostr.="</tr></table>\r\n";
    return $prostr;
}
//函数名：GetStuList
function getstulist($nums=0,$rows,$styles,$schpic,$logow,$logoh,$name_left,$info_left,$tj_left,$order,$target){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $stustr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$stustr.="<tr>\r\n";
    if(($styles==1||$styles==2)&&$schpic==1) $sqlstr.=" and s_photo<>''";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select s_id,s_adddate,s_name,s_photo,s_jobintent,s_profile from {$cfg['tb_pre']}member,{$cfg['tb_pre']}student where m_login=s_member and m_flag=1 and m_typeid=3$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $stustr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $stulink=formatlink($row["s_adddate"],3,5,$row["s_id"],0);
        $picstr=$row["s_photo"] ? str_replace("../",$cfg['path'],$row["s_photo"]) : "upfiles/school/nologo.gif";
        switch($styles){
            case 1:
            $stutr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $stustr.="<tr><td rowspan=\"3\"><li class=schlistlogos><a href=\"$stulink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $stustr.="<td><li class=schlisttits><a href=\"$stulink\" target=\"$target\">".sub_cnstrs($row["s_name"],$name_left)."</a></li></td>\r\n";
            $stustr.="</tr><tr>\r\n";
            $stustr.="<td>".sub_cnstrs($row["s_jobintent"],$info_left)."</td>\r\n";
            $stustr.="</tr><tr>\r\n";
            $stustr.="<td>".sub_cnstrs($row["s_profile"],$tj_left)."...</td>\r\n";
            $stustr.="</tr></table>\r\n";
            break;
            case 2:
            $stustr.="<li class=schlistlogo><a href=\"$stulink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li>\r\n";
            break;
            case 3:
            $stustr.="<li class=schlisttit style=\"padding-left:12px;\"><a href=\"$stulink\" target=\"$target\">".sub_cnstrs($row["s_name"],$name_left)."</a></li>\r\n";
            break;
        }
        $stustr.="</td>\r\n";
        if($i%$rows == 0) $stustr.="</tr><tr>\r\n";
    }
    $stustr=trim($stustr);
    $stustr=(substr($stustr,-9)=="</tr><tr>")?substr($stustr,0,-9):$stustr;
    $stustr.="</tr></table>\r\n";
    return $stustr;   
}
//函数名：GetLastStudentList
function getlaststudentlist($sid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $stustr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
	$stustr.="<tr>\r\n";
    $stustr.="<td width=\"10%\" align=\"center\"><strong>编号</strong></td>\r\n";
	$stustr.="<td width=\"15%\" align=\"center\"><strong>姓名</strong></td>\r\n";
	$stustr.="<td width=\"10%\" align=\"center\"><strong>性别</strong></td>\r\n";
	$stustr.="<td width=\"15%\" align=\"center\"><strong>学历</strong></td>\r\n";
	$stustr.="<td width=\"15%\" align=\"center\"><strong>专业</strong></td>\r\n";
	$stustr.="<td width=\"25%\" align=\"center\"><strong>求职意向</strong></td>\r\n";
    $stustr.="<td width=\"10%\" align=\"center\"><strong>详情</strong></td>\r\n";
	$stustr.="</tr>\r\n";
    $sql="select s_id,s_adddate,s_jobintent,s_profession,s_edu,s_sex,s_name from {$cfg['tb_pre']}student where s_sid=$sid order by s_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,3,4,$row["s_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $stustr.="<tr>\r\n";
        $stustr.="<td align=\"center\">$row[s_id]</td>\r\n";
        $stustr.="<td align=\"center\"><a href=\"".formatlink($row["s_adddate"],3,5,$row["s_id"],0)."\" target=\"_blank\">$row[s_name]</a></td>\r\n";
        $stustr.="<td align=\"center\">$row[s_sex]</td>\r\n";
        $stustr.="<td align=\"center\">$row[s_edu]</td>\r\n";
        $stustr.="<td align=\"center\">".xreplace($row["s_profession"],1,1)."</td>\r\n";
        $stustr.="<td align=\"center\">$row[s_jobintent]</td>\r\n";
        $stustr.="<td align=\"center\"><a href=\"".formatlink($row["s_adddate"],3,5,$row["s_id"],0)."\" target=\"_blank\">查看</a></td>\r\n";
        $stustr.="</tr>\r\n";
    }
    $stustr.="</table>\r\n";
    $stustr.=$getpageinfo['pagecode'];
    return $stustr;
}
//函数名：GetLastProfessorList
function getlastprofessorlist($sid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $prostr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
	$prostr.="<tr>\r\n";
    $sql="select p_id,p_name,p_position,p_photo,p_adddate from {$cfg['tb_pre']}professor where p_sid=$sid and p_flag=1 order by p_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,3,2,$row["p_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $p_photo=$row["p_photo"] ? $cfg['path'].str_replace("../",$cfg['path'],$row["p_photo"]) : $cfg['path']."upfiles/school/nologo.gif";
        $prolink=formatlink($row["p_adddate"],3,3,$row["p_id"],0);
        $prostr.="<td align=\"center\" bgcolor=\"#FFFFff\"><a href=\"$prolink\" target=\"_blank\"><img src=\"$p_photo\" border=0 height=\"120\" width=\"90\" /></a><br><a href=\"$prolink\" target=\"_blank\">$row[p_name]($row[p_position])</a></td>\r\n";
        if($i%6 == 0) $prostr.="</tr><tr>\r\n";
    }
    $prostr=trim($prostr);
    $prostr=(substr($prostr,-9)=="</tr><tr>")?substr($prostr,0,-9):$prostr;
    $prostr.="</tr></table>\r\n";
    $prostr.=$getpageinfo['pagecode'];
    return $prostr;
}
//函数名：GetLastDepartmentList
function getlastdepartmentlist($sid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $depstr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
	$depstr.="<tr>\r\n";
    $depstr.="<td width=\"10%\" align=\"center\"><strong>编号</strong></td>\r\n";
	$depstr.="<td width=\"25%\" align=\"center\"><strong>专业名称</strong></td>\r\n";
	$depstr.="<td width=\"15%\" align=\"center\"><strong>学历</strong></td>\r\n";
	$depstr.="<td width=\"15%\" align=\"center\"><strong>学制</strong></td>\r\n";
	$depstr.="<td width=\"25%\" align=\"center\"><strong>授课形式</strong></td>\r\n";
	$depstr.="<td width=\"10%\" align=\"center\"><strong>详情</strong></td>\r\n";
	$depstr.="</tr>\r\n";
    $sql="select d_id,d_name,d_adddate,d_edu,d_eduyear,d_teachtype,e_name from {$cfg['tb_pre']}department,{$cfg['tb_pre']}edu where d_edu=e_id and d_sid=$sid and d_flag=1 order by d_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,3,6,$row["d_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $depstr.="<tr>\r\n";
        $depstr.="<td align=\"center\">$row[d_id]</td>\r\n";
        $depstr.="<td align=\"center\"><a href=\"".formatlink($row["d_adddate"],3,7,$row["d_id"],0)."\" target=\"_blank\">$row[d_name]</a></td>\r\n";
        $depstr.="<td align=\"center\">$row[e_name]</td>\r\n";
        $depstr.="<td align=\"center\">$row[d_eduyear]年</td>\r\n";
        $depstr.="<td align=\"center\">$row[d_teachtype]</td>\r\n";
        $depstr.="<td align=\"center\"><a href=\"".formatlink($row["d_adddate"],3,7,$row["d_id"],0)."\" target=\"_blank\">查看</a></td>\r\n";
        $depstr.="</tr>\r\n";
    }
    $depstr.="</table>\r\n";
    $depstr.=$getpageinfo['pagecode'];
    return $depstr;
}
//函数名：GetLastRequireList
function getlastrequirelist($sid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $reqstr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
    $sql="select r_id,r_title,r_adddate from {$cfg['tb_pre']}require where r_sid=$sid and r_flag=1 order by r_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,3,8,$row["r_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $reqstr.="<tr>\r\n";
        $reqlink=formatlink($row["r_adddate"],3,9,$row["r_id"],0);
        $reqstr.="<td bgcolor=\"#FFFFff\">·<a href=\"$reqlink\" target=\"_blank\"><font style=\"font-size:14px;\">$row[r_title]</font></a> $row[r_adddate]</td>\r\n";
        $reqstr.="</tr>\r\n";
    }
    $reqstr.="</table>\r\n";
    $reqstr.=$getpageinfo['pagecode'];
    return $reqstr;
}
//函数名：GetTraList
function gettralist($nums=20,$rows,$groupid,$styles,$schpic,$logow,$logoh,$name_left,$info_left,$schflag,$schmands,$order,$target){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $trastr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$trastr.="<tr>\r\n";
    if($groupid!=0) $sqlstr.=" and m_groupid=$groupid";
    if($schflag==1) $sqlstr.=" and m_flag=1";
    if(($styles==1||$styles==2)&&$schpic==1) $sqlstr.=" and m_logo<>''";
    if($schmands==1) $sqlstr.=" and m_comm=1 and DATEDIFF(m_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(m_commend,'".date('Y-m-d')."')>=0";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    //分站信息判断
    if($cfg['site']!=''){
        if($cfg['train']=='2'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site'].")";
        }elseif($cfg['train']=='3'){
            $sqlstr.=" and (m_seat like '%".hireworkadd($cfg['site'])."%' OR `m_site`=".$cfg['site']." or m_site=0)";
        }
    }
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select m_id,m_regdate,m_name,m_logo,m_introduce from {$cfg['tb_pre']}member where m_typeid=4$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $trastr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $tralink=formatlink($row["m_regdate"],5,1,$row["m_id"],0);
        $picstr=$row["m_logo"] ? str_replace("../",$cfg['path'],$row["m_logo"]) : "upfiles/train/nologo.gif";
        switch($styles){
            case 1:
            $trastr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $trastr.="<tr><td rowspan=\"2\" width=\"10%\"><li class=schlistlogos><a href=\"$tralink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $trastr.="<td><li class=schlisttits><a href=\"$tralink\" target=\"$target\">".sub_cnstrs($row["m_name"],$name_left)."</a></li></td>\r\n";
            $trastr.="</tr><tr>\r\n";
            $trastr.="<td>".sub_cnstrs($row["m_introduce"],$info_left)."...</td>\r\n";
            $trastr.="</tr></table>\r\n";
            break;
            case 2:
            $trastr.="<li class=schlistlogo><a href=\"$tralink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li>\r\n";
            break;
            case 3:
            $trastr.="<li class=schlisttit style=\"padding-left:12px;\"><a href=\"$tralink\" target=\"$target\">".sub_cnstrs($row["m_name"],$name_left)."</a></li>\r\n";
            break;
        }
        $trastr.="</td>\r\n";
        if($i%$rows == 0) $trastr.="</tr><tr>\r\n";
    }
    $trastr=trim($trastr);
    $trastr=(substr($trastr,-9)=="</tr><tr>")?substr($trastr,0,-9):$trastr;
    $trastr.="</tr></table>\r\n";
    return $trastr;
}
//函数名：GetCouList
function getcoulist($nums=20,$rows,$styles,$schpic,$logow,$logoh,$name_left,$com_left,$info_left,$order,$target,$typeid,$commands){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $coustr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$coustr.="<tr>\r\n";
    if($styles==1&&$schpic==1) $sqlstr.=" and t_photo<>''";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    //if($commands==1) $sqlstr.=" and c_comm=1 and DATEDIFF(c_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(c_commend,'".date('Y-m-d')."')>=0";
    if($commands==1) $sqlstr.=" and c_comm=1";
    if($typeid!=0) $sqlstr.=" and c_type='$typeid'";
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select c_id,c_adddate,t_photo,c_name,c_fee,c_introduce,c_trainer,c_train from {$cfg['tb_pre']}course INNER JOIN {$cfg['tb_pre']}member on c_tid=m_id left JOIN {$cfg['tb_pre']}trainer on c_trainer=t_name where m_flag=1 and m_typeid=4 and m_id=t_tid$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $coustr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $coulink=formatlink($row["c_adddate"],5,3,$row["c_id"],0);
        $picstr=$row["t_photo"] ? str_replace("../",$cfg['path'],$row["t_photo"]) : $cfg['path']."upfiles/train/nophoto.gif";
        switch($styles){
            case 1:
            $coustr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $coustr.="<tr><td rowspan=\"4\" width=\"10%\"><li class=tralistlogos><a href=\"$coulink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $coustr.="<td><li class=tralisttits><a href=\"$coulink\" target=\"$target\">".sub_cnstrs($row["c_name"],$name_left)."</a></li></td>\r\n";
            $coustr.="</tr><tr>\r\n";
            $coustr.="<td>培训费用:$row[c_fee]元</td>\r\n";
            $coustr.="</tr><tr>\r\n";
            $coustr.="<td>培训机构:".sub_cnstrs($row["c_train"],$com_left)."</td>\r\n";
            $coustr.="</tr><tr>\r\n";
            $coustr.="<td>课程介绍:".sub_cnstrs($row["c_introduce"],$info_left)."...</td>\r\n";
            $coustr.="</tr></table>\r\n";
            break;
            case 2:
            $coustr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 class=\"line\">\r\n";
            $coustr.="<tr><td width=\"40%\"><a href=\"$coulink\" target=\"$target\">".sub_cnstrs($row["c_name"],$name_left)."</a></li></td>\r\n";
            $coustr.="<td width=\"20%\">$row[c_trainer]</td>\r\n";
            $coustr.="<td>".sub_cnstrs($row["c_train"],$com_left)."</td>\r\n";
            $coustr.="</tr></table>\r\n";
            break;
        }
        $coustr.="</td>\r\n";
        if($i%$rows == 0) $coustr.="</tr><tr>\r\n";
    }
    $coustr=trim($coustr);
    $coustr=(substr($coustr,-9)=="</tr><tr>")?substr($coustr,0,-9):$coustr;
    $coustr.="</tr></table>\r\n";
    return $coustr;
}
//函数名：GetTrarList
function gettrarlist($nums=20,$rows,$styles,$schpic,$logow,$logoh,$name_left,$info_left,$schmands,$order,$target){
    global $cfg,$db;
    $sqlstr='';$i=0;
    $trarstr="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0>\r\n";
	$trarstr.="<tr>\r\n";
    if($styles==1||$styles==2) $sqlstr.=" and t_photo<>''";
    if($schmands==1) $sqlstr.=" and t_commflag=1";
    $sqlstr.=" and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
    $sqlstr.=" order by $order limit 0,$nums";
    $sql="select t_id,t_name,t_adddate,t_photo,t_introduce,t_position from {$cfg['tb_pre']}member,{$cfg['tb_pre']}trainer where m_login=t_member and m_flag=1 and m_typeid=4$sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $trarstr.="<td width=\"".round(100/$rows)."%\">\r\n";
        $trarlink=formatlink($row["t_adddate"],5,5,$row["t_id"],0);
        $picstr=$row["t_photo"] ? str_replace("../",$cfg['path'],$row["t_photo"]) : $cfg['path']."upfiles/train/nologo.gif";
        switch($styles){
            case 1:
            $trarstr.="<table width=\"100%\" border=0 align=center cellpadding=0 cellspacing=0 >\r\n";
            $trarstr.="<tr><td rowspan=\"2\"><li class=tralistlogos><a href=\"$trarlink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li></td>\r\n";
            $trarstr.="<td><li class=tralisttits><a href=\"$trarlink\" target=\"$target\">".sub_cnstrs($row["t_name"],$name_left)."</a><font style=\"font-size:12px;color:#666;\">($row[t_position])</font></li></td>\r\n";
            $trarstr.="</tr><tr>\r\n";
            $trarstr.="<td>".sub_cnstrs($row["t_introduce"],$info_left)."...</td>\r\n";
            $trarstr.="</tr></table>\r\n";
            break;
            case 2:
            $trarstr.="<li class=tralistlogo><a href=\"$trarlink\" target=\"$target\"><img src=\"$picstr\" border=0 height=\"$logoh\" width=\"$logow\" /></a></li>\r\n";
            break;
            case 3:
            $trarstr.="<li class=tralisttit style=\"padding-left:12px;\"><a href=\"$trarlink\" target=\"$target\">".sub_cnstrs($row["t_name"],$name_left)."</a></li>\r\n";
            break;
        }
        $trarstr.="</td>\r\n";
        if($i%$rows == 0) $trarstr.="</tr><tr>\r\n";
    }
    $trarstr=trim($trarstr);
    $trarstr=(substr($trarstr,-9)=="</tr><tr>")?substr($trarstr,0,-9):$trarstr;
    $trarstr.="</tr></table>\r\n";
    return $trarstr;
}
//函数名：GetLastCourseList
function getlastcourselist($tid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $coursestr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
	$coursestr.="<tr>\r\n";
    $coursestr.="<td width=\"10%\" align=\"center\"><strong>编号</strong></td>\r\n";
	$coursestr.="<td width=\"30%\" align=\"center\"><strong>课程名称</strong></td>\r\n";
	$coursestr.="<td width=\"10%\" align=\"center\"><strong>课程类别</strong></td>\r\n";
	$coursestr.="<td width=\"10%\" align=\"center\"><strong>培训费用</strong></td>\r\n";
	$coursestr.="<td width=\"10%\" align=\"center\"><strong>培训讲师</strong></td>\r\n";
	$coursestr.="<td width=\"30%\" align=\"center\"><strong>开课时间</strong></td>\r\n";
	$coursestr.="</tr>\r\n";
    $sql="select c_id,c_name,c_type,c_fee,c_trainer,c_train,c_adddate,c_begin from {$cfg['tb_pre']}course where c_tid=$tid order by c_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,5,2,$row["c_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $coursestr.="<tr>\r\n";
        $coursestr.="<td align=\"center\">$row[c_id]</td>\r\n";
        $coursestr.="<td align=\"center\"><a href=\"".formatlink($row["c_adddate"],5,3,$row["c_id"],0)."\" target=\"_blank\">$row[c_name]</a></td>\r\n";
        $coursestr.="<td align=\"center\">$row[c_type]</td>\r\n";
        $coursestr.="<td align=\"center\">$row[c_fee]元</td>\r\n";
        $coursestr.="<td align=\"center\">$row[c_trainer]</td>\r\n";
        $coursestr.="<td align=\"center\">$row[c_begin]</td>\r\n";
        $coursestr.="</tr>\r\n";
    }
    $coursestr.="</table>\r\n";
    $coursestr.=$getpageinfo['pagecode'];
    return $coursestr;
}
//函数名：GetLastTrainerList
function getlasttrainerlist($tid,$pagesize=20,$page=1){
    global $cfg,$db;
    $i=0;
    $trarstr="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n";
	$trarstr.="<tr>\r\n";
    $sql="select t_id,t_name,t_position,t_photo,t_adddate from {$cfg['tb_pre']}trainer where t_tid=$tid and t_flag=1 order by t_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $getpageinfo = page($page,$counts,formatlink(0,5,4,$row["t_id"],-1),$pagesize,5,1);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $i++;
        $t_photo=$row["t_photo"] ? str_replace("../","",$row["t_photo"]) : $cfg['path']."upfiles/train/nophoto.gif";
        $trarlink=formatlink($row["t_adddate"],5,5,$row["t_id"],0);
        $trarstr.="<td align=\"center\" bgcolor=\"#FFFFff\"><a href=\"$trarlink\" target=\"_blank\"><img src=\"$t_photo\" border=0 height=\"120\" width=\"90\" /></a><br><a href=\"$trarlink\" target=\"_blank\">$row[t_name]($row[t_position])</a></td>\r\n";
        if($i%6 == 0) $trarstr.="</tr><tr>\r\n";
    }
    $trarstr=trim($trarstr);
    $trarstr=(substr($trarstr,-9)=="</tr><tr>")?substr($trarstr,0,-9):$trarstr;
    $trarstr.="</tr></table>\r\n";
    $trarstr.=$getpageinfo['pagecode'];
    return $trarstr;
}
//函数名：ShowHead
//参  数：typeid   类别ID号
//        newsid   当前文章ID号
//返回值：返回上一篇文章的链接
function showhead($typeid,$newsid){
    global $cfg,$db;
    $c = $db->get_one("SELECT `n_addtime`,`n_cid`,`n_sid`,`n_id`,`n_title` FROM `{$cfg['tb_pre']}news` WHERE `n_id` > $newsid AND `n_sid` = $typeid ORDER BY `n_id` ASC LIMIT 0,1");
    if ($c){
        return "<a href=\"".formatlink($c["n_addtime"],$c["n_cid"],1,$c["n_id"],0)."\">".cleartags($c["n_title"])."</a>";
    }else{
        return "没有了";
    }
}
//函数名：ShowNext
//参  数：typeid   类别ID号
//        newsid   当前文章ID号
//返回值：返回下一篇文章的链接
function shownext($typeid,$newsid){
    global $cfg,$db;
    $c = $db->get_one("SELECT `n_addtime`,`n_cid`,`n_sid`,`n_id`,`n_title` FROM `{$cfg['tb_pre']}news` WHERE `n_id` < $newsid AND `n_sid` = $typeid ORDER BY `n_id` DESC LIMIT 0,1");
    if ($c){
        return "<a href=\"".formatlink($c["n_addtime"],$c["n_cid"],1,$c["n_id"],0)."\">".cleartags($c["n_title"])."</a>";
    }else{
        return "没有了";
    }
}
//函数名：GetPoistionList
function getpoistionlist($linkurl,$nums,$order,$target,$fid){
    global $cfg,$db;
    $poistionstr="<ul>\r\n";
    $query=$db->query("SELECT `p_id`,`p_name` FROM `{$cfg['tb_pre']}position` WHERE `p_fid`=$fid ORDER BY $order LIMIT 0,$nums");
    while($row=$db->fetch_array($query)){
        if($fid!=0){
            $poistionstr.="<li><a href=\"".joinchar($linkurl)."position=$fid*$row[p_id]\" target=\"$target\" rel=\"nofollow\">$row[p_name]</a></li>\r\n";
        }else{
            $poistionstr.="<li><a href=\"".joinchar($linkurl)."position=$row[p_id]\" target=\"$target\">$row[p_name]</a></li>\r\n";
        }
    }
    $poistionstr.="</ul>\r\n";
    return $poistionstr;
}
//函数名：GetProvinceList
function getprovincelist($linkurl,$nums,$order,$target,$fid){
    global $cfg,$db;
    $provincestr="<ul>\r\n";
    if(strlen($fid)>4){
        $fids=intval(substr($fid,-4));
    }else{
        $fids=intval($fid);
    }
    $query=$db->query("SELECT `p_id`,`p_name` FROM `{$cfg['tb_pre']}provinceandcity` WHERE `p_fid`=$fids ORDER BY $order LIMIT 0,$nums");
    while($row=$db->fetch_array($query)){
        if($fid!=0){
            $provincestr.="<li><a href=\"".joinchar($linkurl)."workadd=$fid*$row[p_id]\" target=\"$target\" rel=\"nofollow\">$row[p_name]</a></li>\r\n";
        }else{
            $provincestr.="<li><a href=\"".joinchar($linkurl)."workadd=$row[p_id]\" target=\"$target\">$row[p_name]</a></li>\r\n";
        }
    }
    $provincestr.="</ul>\r\n";
    return $provincestr;
}
//函数名：GetTradeList
function gettradelist($linkurl,$nums,$order,$target){
    global $cfg,$db;
    $tradestr="<ul>\r\n";
    $query=$db->query("SELECT `t_id`,`t_name` FROM `{$cfg['tb_pre']}trade` ORDER BY $order LIMIT 0,$nums");
    while($row=$db->fetch_array($query)){
        $tradestr.="<li><a href=\"".joinchar($linkurl)."trade=$row[t_id]\" target=\"$target\">$row[t_name]</a></li>\r\n";
    }
    $tradestr.="</ul>\r\n";
    return $tradestr;
}
function getannounce($cid=0,$showtype=0,$num=10,$font=20,$target='_blank'){
    global $cfg,$db;
    $sqladd='';
    if($cfg['site']!=''){
        if($cfg['announce']=='2'){
            $sqladd.=" AND `a_site`={$cfg['site']}";
        }elseif($cfg['announce']=='3'){
            $sqladd.=" AND (`a_site`={$cfg['site']} OR `a_site`=0)";
        }
    }else{
        $sqladd.=" AND `a_site`=0";
    }
    if($cid==0){
        $sqls="SELECT `a_id`,`a_title` FROM `{$cfg['tb_pre']}announce` WHERE (`a_channelid`=$cid OR `a_isnew`=1)";
    }else{
        $sqls="SELECT `a_id`,`a_title` FROM `{$cfg['tb_pre']}announce` WHERE (`a_channelid`=$cid OR `a_channelid`=0)";
    }
    $sqls.="$sqladd AND DATEDIFF('".date('Y-m-d')."',a_dateandtime)<=a_outtime";
    $sql=$sqls." AND (`a_showtype`=0 OR `a_showtype`=1) ORDER BY `a_dateandtime` DESC";
    $sql.=" LIMIT 0,$num";
    $query=$db->query($sql);
    $annstr='';
    while($row=$db->fetch_array($query)){
        $annstr.="<li><a href=\"{$cfg['path']}announce.php?aid=$row[a_id]\" target=\"$target\" title=\"$row[a_title]\">".sub_cnstrs($row['a_title'],$font)."</a></li>\r\n";
    }
    $sql=$sqls." AND (`a_showtype`=0 OR `a_showtype`=2) ORDER BY `a_dateandtime` DESC";
    $sql.=" LIMIT 0,$num";
    $query=$db->query($sql);
    $annstrtc='';
    $i=0;
    while($row=$db->fetch_array($query)){
        $i++;$tl=$i*10;
        $annstrtc.="window.open ('{$cfg['path']}annpop.php?aid=$row[a_id]', 'newwindow$i', 'height=600, width=620, top=$tl,left=$tl,toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no');\r\n";
    }
    if($annstrtc!=''){
        $annstrtc="<script language=\"javascript\">\r\n<!--\r\n{\r\n".$annstrtc;
        $annstrtc.="}\r\n//-->\r\n</script>\r\n";
    }
    if($showtype==1){
        return $annstr;
    }elseif($showtype==2){
        return $annstrtc;
    }else{
        return $annstr.$annstrtc;
    }
}
function getmembercount($s){
    global $cfg,$db;
    switch($s){
       case 1:
       return $db->counter("{$cfg['tb_pre']}member",'m_typeid=1','CACHE',86400);
       break;
       case 2:
       return $db->counter("{$cfg['tb_pre']}member",'m_typeid=2','CACHE',86400);
       break;
       case 3:
       return $db->counter("{$cfg['tb_pre']}resume","DATEDIFF('".date('Y-m-d')."',r_adddate)=0",'CACHE');
       break;
       case 4:
       return $db->counter("{$cfg['tb_pre']}hire","DATEDIFF('".date('Y-m-d')."',h_adddate)=0",'CACHE');
       break;
       default:
       return 0;
    }
}
function getsite($t=0,$f=0){
    global $cfg,$db,$siteurl;
    $sitetemp='';
    $f==0&&$sitestr="总站";
    $f==1&&$sitestr="分站列表";
    $f==2&&$sitestr="旗下网站";
    if($t==0){
        $sitetemp.="<script type=\"text/javascript\">\r\n";
        $sitetemp.="<!--\r\n";
        $sitetemp.="function MM_jumpMenu(targ,selObj,restore){ //v3.0\r\n";
        $sitetemp.="eval(targ+\".location='\"+selObj.options[selObj.selectedIndex].value+\"'\");\r\n";
        $sitetemp.="if (restore) selObj.selectedIndex=0;\r\n";
        $sitetemp.="}\r\n";
        $sitetemp.="//-->\r\n";
        $sitetemp.="</script>\r\n";
        $sitetemp.="<select name=\"sitelist\" id=\"sitelist\" onchange=\"MM_jumpMenu('parent',this,0)\">\r\n";
        $sitetemp.="<option value=\"$siteurl\">$sitestr</option>\r\n";
    }else{
        $sitetemp.="<li class=\"s\"><a href=\"$siteurl\" target=\"_blank\" class=\"red\">$sitestr</a></li>\r\n";
    }
    $t==0&&$sitetemp.="</select>\r\n";
    return $sitetemp;
}
function getltarticle($id=0){
	global $cfg,$db;
	$sqladd=$id?" and c_id=$id ":'';
	$sql="select * from {$cfg['tb_pre']}common where c_type =2 $sqladd order by c_isorder desc";
	if($id){
		$rsdb=$db->get_one($sql);
	}else{
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
            $rsdb[]=$row; 
        }
    }
    return $rsdb;
}
?>