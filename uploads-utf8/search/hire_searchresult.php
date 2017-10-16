<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
$sqladd='';
$position = empty($position) ? '' :cleartags($position);
$positions = empty($positions) ? '' :cleartags($positions);
if($position!=''){
    $sqladd.=" and (";
    $positionss=explode(',',hireposition($position));
    foreach($positionss as $key){
        $sqladd.="h_position like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
$profession = empty($profession) ? '' :cleartags($profession);
$professions = empty($professions) ? '' :cleartags($professions);
if($profession!=''){
    $sqladd.=" and (";
    $professionss=explode(',',hireprofession($profession));
    foreach($professionss as $key){
        $sqladd.="h_profession like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
$workadd = empty($workadd) ? '' :cleartags($workadd);
$workadds = empty($workadds) ? '' :cleartags($workadds);
if($workadd!=''){
    $sqladd.=" and (";
    $workaddss=explode(',',hireworkadd($workadd));
    foreach($workaddss as $key){
        $sqladd.="h_workadd like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
$trade = empty($trade) ? '' :cleartags($trade);
$trades = empty($trades) ? '' :cleartags($trades);
if($trade!=''){
    $sqladd.=" and (";
    $tradess=explode(',',hiretrade($trade));
    foreach($tradess as $key){
        $sqladd.="h_trade like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
$datetime = empty($datetime) ? '' :intval($datetime);
$datetime!=''&&$sqladd.=" and DATEDIFF('".date('Y-m-d')."',h_adddate)<=$datetime";
if($keyword=="请输入搜索的关键词！") $keyword='';
$keyword=cleartags($keyword);
if($keyword!=''){
    if($keywordtype!=''){
        if($keywordtype==1){
            $sqladd.=" and (h_comname like '%$keyword%' or h_introduce like '%$keyword%')";
        }else{
            $sqladd.=" and (h_place like '%$keyword%' or h_introduce like '%$keyword%')";
        }
    }else{
        $sqladd.=" and (h_comname like '%$keyword%' or h_place like '%$keyword%' or h_introduce like '%$keyword%')";
    }
}
$strfilename="hire_searchresult.php?trade=$trade&trades=$trades&position=$position&positions=$positions&workadd=$workadd&workadds=$workadds&datetime=$datetime&datetimes=$datetimes&keyword=$keyword&keywordtype=$keywordtype";
    $sql="select h_id,h_adddate,h_place,h_introduce,h_enddate,h_workadd,h_comname,m_id,m_regdate,m_name from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login where m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and h_status=1 $sqladd order by h_adddate desc";
    $counts = $db->counter("{$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login","m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and h_status=1 $sqladd",'CACHE');
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,$strfilename,20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
        $newhirelist.="        <tr class=\"moretabmain\" align=\"center\"";
        if($row['h_comm']==1) $newhirelist.="bgcolor=\"#FDF1CA\"";
		$newhirelist.=">\r\n";
        $newhirelist.="          <td height=\"22\"><input type=\"checkbox\" name=\"hid\" value=\"$row[h_id]\" class=\"checkbox\" /></td>\r\n";
        $newhirelist.="          <td align=\"left\"><a href=\"".formatlink($row["h_adddate"],2,3,$row["h_id"],0)."\" target=\"_blank\"><b><font color=\"#0066CC\">".$row["h_place"]."</font></b></a>";
        if($row['h_comm']==1) $newhirelist.=" <img src=\"../skin/system/commend.gif\" width=\"16\" height=\"15\" align=\"absmiddle\" />";
        $newhirelist.="</td>\r\n";
        $newhirelist.="          <td align=\"left\"><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"_blank\"><b>".$row["h_comname"]."</b></a></td>\r\n";
        $newhirelist.="          <td align=\"left\">".xreplace($row["h_workadd"])."</td>\r\n";
        $newhirelist.="          <td>".dtime(strtotime($row["h_adddate"]),3)."</td>\r\n";
        $newhirelist.="          <td rowspan=\"2\"><input name=\"button\" type=\"button\" value=\"申请职位\" class=\"inputbut\" onClick=\"location.href='../member/index.php?a=hire&mpage=person_resumesend&show=3&checks=$row[h_id]'\"/></td>\r\n";
        $newhirelist.="        </tr>\r\n";
        $newhirelist.="	<tr class=\"moretabmain\" ";
        if($row['h_comm']==1) $newhirelist.="bgcolor=\"#FDF1CA\"";
		$newhirelist.=">\r\n";
        $newhirelist.="		<td colspan=\"5\">职位描述：".sub_cnstrs(deletehtml($row['h_introduce']),220)."</td>\r\n";
        $newhirelist.="	</tr>\r\n";
    }
require(FR_ROOT.'/inc/common.func.php');
include template('hire_searchresult','search');
?>