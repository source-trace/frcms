<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
$rsdb=array();$courselist='';
$numberss=isset($numberss)?intval($numberss):20;
$numbers=isset($numbers)?intval($numbers):$numberss;
if($numbers==0) $numbers=20;
$taxiss=isset($numberss)?intval($taxiss):1;
$taxis=isset($taxis)?intval($taxis):$taxiss;
if($taxis==0) $taxis=1;
$strfilename="course_searchresult.php?numberss=$numbers&taxiss=$taxis&type=$type&keywordtype=$keywordtype&keyword=$keyword";
$pagesize=$numbers;
$sqladd='';
if ($type<>""){
    $type=intval($type)?intval($type):'';
	$type&&$sqladd.=" and c_type='$type'";
}
if($keyword=="请输入搜索的关键词！") $keyword='';
$keyword=cleartags($keyword);
if($keyword!=''){
    if($keywordtype!=''){
        if($keywordtype==1){
            $sqladd.=" and (c_name like '%$keyword%' or c_introduce like '%$keyword%')";
        }else{
            $sqladd.=" and (c_train like '%$keyword%' or c_introduce like '%$keyword%')";
        }
    }else{
        $sqladd.=" and (c_name like '%$keyword%' or c_train like '%$keyword%' or c_introduce like '%$keyword%')";
    }
}
$sql="select * from {$cfg['tb_pre']}course INNER JOIN {$cfg['tb_pre']}member on c_tid=m_id where ";
$sqladd=" m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0".$sqladd;
$sql.=$sqladd;
if($taxis==1){$sql.=" order by c_adddate desc";}
if($taxis==2){$sql.=" order by c_adddate asc";}
if($taxis==3){$sql.=" order by c_type desc";}
$counts = $db->counter("{$cfg['tb_pre']}course INNER JOIN {$cfg['tb_pre']}member on c_tid=m_id","$sqladd");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"$strfilename",$pagesize,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
$courselist.="        <tr class=\"moretabmain\" align=\"center\" onmouseover=\"this.style.background='#F7F8FE'\" onmouseout=\"this.style.background=''\">\r\n";
$courselist.="          <td height=\"22\" align=\"left\"><a href=\"".formatlink($row["c_adddate"],5,3,$row["c_id"],0)."\" target=\"_blank\" title=\"".$row['c_name']."\">$row[c_name]</a>&nbsp;</td>\r\n";
$courselist.="          <td>".$row['c_type']."&nbsp;</td>\r\n";
$courselist.="          <td>".$row["c_period"]."课时&nbsp;</td>\r\n";
$courselist.="          <td>".$row['c_fee']."元&nbsp;</td>\r\n";
$courselist.="          <td>".$row['c_trainer']."&nbsp;</td>\r\n";
$courselist.="          <td>".$row['c_train']."&nbsp;</td>\r\n";
$courselist.="          <td>".dtime(strtotime($row["c_adddate"]),3)."&nbsp;</td>\r\n";
$courselist.="          <td><input name=\"button\" type=\"button\" value=\"立即报名\" class=\"inputbut\" onClick=\"window.open('../train/signup.php?cid=$row[c_id]&amp;ctit=$row[c_name]&tid=$row[c_tid]');\"/></td>\r\n";
$courselist.="        </tr>\r\n";
}
include template('course_searchresult','search');
?>