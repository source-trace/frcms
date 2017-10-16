<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
$rsdb=array();$vipcomlist='';
$numberss=isset($numberss)?intval($numberss):30;
$numbers=isset($numbers)?intval($numbers):$numberss;
if($numbers==0) $numbers=40;
$taxiss=isset($numberss)?intval($taxiss):1;
$taxis=isset($taxis)?intval($taxis):$taxiss;
if($taxis==0) $taxis=1;
$t=isset($t)?intval($t):2;
$g=isset($g)?intval($g):0;
$flag=isset($flag)?intval($flag):1;
$flogo=isset($flogo)?intval($flogo):1;
$blogo=isset($blogo)?intval($blogo):1;
$tlogo=isset($tlogo)?intval($tlogo):0;
$c=isset($c)?intval($c):0;
$strfilename="vipcom.php?numberss=$numbers&taxiss=$taxis&t=$t&g=$g&flag=$flag&flogo=$flogo&blogo=$blogo&tlogo=$tlogo&c=$c";
$pagesize=$numbers;
$sqladd='';
$sqladd.=" DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0";
$t&&$sqladd.=" and m_typeid=$t";
$g&&$sqladd.=" and m_groupid=$g";
$flag&&$sqladd.=" and m_flag=1";
$flogo&&$sqladd.=" and m_logoflag=1";
if($flogo==1&&$blogo==1) $sqladd.=" and m_logo<>'' and m_logo<>'nologo.gif' and m_logo<>'error.gif'";
if($flogo==1&&$tlogo==1) $sqladd.=" and m_logocomm=1 and DATEDIFF(m_logostartdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_logoenddate,'".date('Y-m-d')."')>=0";
$c&&$sqladd.=" and m_comm=1 and DATEDIFF(m_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(m_commend,'".date('Y-m-d')."')>=0";
$sql="select m_id,m_regdate,m_logo,m_name,m_activedate from {$cfg['tb_pre']}member where $sqladd";
if($taxis==1){$sql.=" order by m_activedate desc";}
if($taxis==2){$sql.=" order by m_activedate asc";}
if($taxis==3){$sql.=" order by m_hits desc";}
$counts = $db->counter("{$cfg['tb_pre']}member","$sqladd");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"$strfilename",$pagesize,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
    $picstr=$row["m_logo"] ? str_replace("../",$cfg['path'],$row["m_logo"]) : $cfg['path']."upfiles/company/nologo.gif";
    $vipcomlist.="<ul>";
    $vipcomlist.="<li class=\"comlistlogo\"><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"_blank\"><img src=\"$picstr\" border=0 style=\"padding:1px; border:1px #F0F0F0 solid;\" height=\"100\" width=\"140\" title=\"$row[m_name]\" /></a></li>\r\n";
    $vipcomlist.="<li class=\"comlisttit\"><a href=\"".formatlink($row["m_regdate"],2,1,$row["m_id"],0)."\" target=\"_blank\"  title=\"$row[m_name]\" >".sub_cnstrs($row["m_name"],12)."</a></li>";
    $vipcomlist.="</ul>";
}
include template('vipcom','more');
?>