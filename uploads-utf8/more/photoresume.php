<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
$rsdb=array();$newresumelist='';
$numberss=isset($numberss)?intval($numberss):40;
$numbers=isset($numbers)?intval($numbers):$numberss;
if($numbers==0) $numbers=40;
$taxiss=isset($numberss)?intval($taxiss):1;
$taxis=isset($taxis)?intval($taxis):$taxiss;
if($taxis==0) $taxis=1;
$strfilename="photoresume.php?numberss=$numbers&taxiss=$taxis";
$pagesize=$numbers;
$sqladd='';
$sql="select r_id,r_adddate,r_name,r_sex,m_logo,m_nameshow from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id where ";
$sqladd=" r_cnstatus=1 and r_flag=1 and r_openness=0 and m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and m_logo!='' and m_logo!='error.gif' and m_logoflag=1 and r_personinfo=1 and r_careerwill=1".$sqladd;
$sql.=$sqladd;
if($taxis==1){$sql.=" order by r_adddate desc";}
if($taxis==2){$sql.=" order by r_adddate asc";}
if($taxis==3){$sql.=" order by r_visitnum desc";}
$counts = $db->counter("{$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id","$sqladd");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"$strfilename",$pagesize,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
$r_name=$row['r_name'];$m_nameshow=$row['m_nameshow'];$r_sex=$row['r_sex'];
$r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'女士');
$newresumelist.="<li><a href=\"".formatlink($row["r_adddate"],1,1,$row["r_id"],0)."\" target=\"_blank\"><img src=\"$row[m_logo]\" width=\"100\" height=\"120\" border=\"0\" align=\"absmiddle\" /><br>$r_name</a></li>\r\n";
}
include template('photoresume','more');
?>