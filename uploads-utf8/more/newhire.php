<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
if(empty($workadd)) $workadd= $cfg['site_province'];
$workadd=str_replace("'","",trim($workadd));
if($workadd!=''){
    $TitProvinceName=csysnames(hireworkadd($workadd));
}else{
    $TitProvinceName='';
}
$position=str_replace("'","",trim($position));
if($position!=''){
    $TitPosionName=csysnames(hireposition($position));
}else{
    $TitPosionName='';
}
require(FR_ROOT.'/inc/common.func.php');
if($workadd!=''&&$position!=''&&isSpider()) exit('nofollow！');
    $rsdb=array();
    $sqladd='';$newhirelist='';
    if($position!=''){
        $sqladd.=" AND (";
        $positionss=explode(',',hireposition($position));
        foreach($positionss as $key){
            $sqladd.="`h_position` LIKE '%$key%' OR ";
        }
        if(substr($sqladd,-3)=='OR ') $sqladd=substr($sqladd,0,-4);
        $sqladd.=")";
    }
    if($workadd!=''){
        $sqladd.=" AND (";
        $workaddss=explode(',',hireworkadd($workadd));
        foreach($workaddss as $key){
            $sqladd.="`h_workadd` like '%$key%' OR ";
        }
        if(substr($sqladd,-3)=='OR ') $sqladd=substr($sqladd,0,-4);
        $sqladd.=")";
    }
    $sql="SELECT `h_id`,`h_adddate`,`h_place`,`h_number`,`h_enddate`,`h_workadd`,`h_comname`,`h_comm`,`h_introduce`,`m_id`,`m_regdate`,`m_name` FROM `{$cfg['tb_pre']}hire` INNER JOIN `{$cfg['tb_pre']}member` on `h_comid`=`m_id` WHERE `m_flag`=1 and DATEDIFF(`m_startdate`,'".date('Y-m-d')."')<=0 AND DATEDIFF(`m_enddate`,'".date('Y-m-d')."')>=0 AND DATEDIFF(`h_enddate`,'".date('Y-m-d')."')>=0 AND `h_status`=1 $sqladd ORDER BY `h_adddate` DESC";
    $counts = $db->counter("`{$cfg['tb_pre']}hire` INNER JOIN `{$cfg['tb_pre']}member` on `h_comid`=`m_id`","`m_flag`=1 and DATEDIFF(`m_startdate`,'".date('Y-m-d')."')<=0 AND DATEDIFF(`m_enddate`,'".date('Y-m-d')."')>=0 AND DATEDIFF(`h_enddate`,'".date('Y-m-d')."')>=0 AND `h_status`=1 $sqladd");
    //$counts=1000;
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"newhire.php?workadd=$workadd&position=$position",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
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
        $newhirelist.="          <td>".hirenumber($row["h_number"])."</td>\r\n";
        $newhirelist.="          <td>".dtime(strtotime($row["h_adddate"]),3)."</td>\r\n";
        $newhirelist.="          <td>$row[h_enddate]</td>\r\n";
        $newhirelist.="          <td rowspan=\"2\"><input name=\"button\" type=\"button\" value=\"申请职位\" class=\"inputbut\" onClick=\"location.href='../member/index.php?a=hire&mpage=person_resumesend&show=3&checks=$row[h_id]'\"/></td>\r\n";
        $newhirelist.="        </tr>\r\n";
        $newhirelist.="	<tr class=\"moretabmain\" ";
        if($row['h_comm']==1) $newhirelist.="bgcolor=\"#FDF1CA\"";
		$newhirelist.=">\r\n";
        $newhirelist.="		<td colspan=\"7\">职位描述：".sub_cnstrs(deletehtml($row['h_introduce']),100)."</td>\r\n";
        $newhirelist.="	</tr>\r\n";
    }
include template('newhire','more');
?>