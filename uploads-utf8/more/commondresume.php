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
$rsdb=array();$newresumelist='';
$numberss=isset($numberss)?intval($numberss):20;
$numbers=isset($numbers)?intval($numbers):$numberss;
if($numbers==0) $numbers=20;
$taxiss=isset($numberss)?intval($taxiss):1;
$taxis=isset($taxis)?intval($taxis):$taxiss;
if($taxis==0) $taxis=1;
$item1=isset($item1)?(intval($item1)?intval($item1):0):0;
$item2=isset($item2)?(intval($item2)?intval($item2):0):0;
$item3=isset($item3)?(intval($item3)?intval($item3):0):0;
$item4=isset($item4)?(intval($item4)?intval($item4):0):0;
$item5=isset($item5)?(intval($item5)?intval($item5):0):0;
if(isset($t)&&$t==1){$usergroup=2;}else{$usergroup=$usergroup?2:'';}
$strfilename="commondresume.php?position=$position&workadd=$workadd&numberss=$numbers&taxiss=$taxis&usergroup=$usergroup&item1=$item1&item2=$item2&item3=$item3&item4=$item4&item5=$item5";
$pagesize=$numbers;
$sqladd='';
if($position!=''){
    $sqladd.=" and (";
    $positionss=explode(',',hireposition($position));
    foreach($positionss as $key){
        $sqladd.="r_position like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
if($workadd!=''){
    $sqladd.=" and (";
    $workaddss=explode(',',hireworkadd($workadd));
    foreach($workaddss as $key){
        $sqladd.="r_workadd like '%$key%' or ";
    }
    if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
    $sqladd.=")";
}
if($item1) $sqladd.=" and r_sex=$item1";
if($item2) $sqladd.=" and r_edu=$item2";
if($item3&&$item3!=3) $sqladd.=" and r_jobtype=$item3";
if($item4) $sqladd.=" and r_pay=$item4";
if($item5) $sqladd.=" and DATEDIFF('".date('Y-m-d')."',r_adddate)<=$item5";
$sql="select r_id,r_adddate,r_name,r_position,r_edu,r_sex,r_pay,r_appraise,r_jobtype,r_workadd,m_nameshow from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id where ";
$sqladd=" r_cnstatus=1 and r_flag=1 and r_openness=0 and m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and m_comm=1 and r_personinfo=1 and r_careerwill=1".$sqladd;
if($usergroup==2) $sqladd.=" and r_usergroup=2";
$sql.=$sqladd;
if($taxis==1){$sql.=" order by r_adddate desc";}
if($taxis==2){$sql.=" order by r_adddate asc";}
if($taxis==3){$sql.=" order by r_visitnum desc";}
$counts = $db->counter("{$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id","$sqladd");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"$strfilename",$pagesize,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
$newresumelist.="<tr class=\"moretabhead\" align=\"center\">\r\n";
$newresumelist.=" <td width=\"3%\"><input name=\"checkSelect\" type=\"checkbox\" class=\"checkbox\" onClick=\"javascript: checkAll(this)\" value=\"checkbox\"></td>\r\n";
$newresumelist.=" <td width=\"7%\" height=\"21\">姓名</td>\r\n";
$newresumelist.=" <td width=\"20%\">意向职位</td>\r\n";
$newresumelist.=" <td width=\"20%\">意向工作地</td>\r\n";
$newresumelist.=" <td width=\"8%\"><select name=\"item1\" size=\"1\" style=\"width:60px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>性别</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item1==1)  $newresumelist.="selected";
$newresumelist.=">男</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item1==2)  $newresumelist.="selected";
$newresumelist.=">女</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"10%\"><select name=\"item2\" size=\"1\" style=\"width:80px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>学历</option>\r\n";
$newresumelist.=getother('edu','e','e_id asc',$item2);
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"10%\"><select name=\"item3\" size=\"1\" style=\"width:80px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>职位类别</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item3==1)  $newresumelist.="selected";
$newresumelist.=">全职</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item3==2)  $newresumelist.="selected";
$newresumelist.=">兼职</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item3==3)  $newresumelist.="selected";
$newresumelist.=">不限</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"12%\"><select name=\"item4\" size=\"1\" style=\"width:90px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>期望月薪</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item4==1)  $newresumelist.="selected";
$newresumelist.=">800以下</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item4==2)  $newresumelist.="selected";
$newresumelist.=">800～1000</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item4==3)  $newresumelist.="selected";
$newresumelist.=">1000～1200</option>\r\n";
$newresumelist.="<option value=\"4\"";
if($item4==4)  $newresumelist.="selected";
$newresumelist.=">1200～1500</option>\r\n";
$newresumelist.="<option value=\"5\"";
if($item4==5)  $newresumelist.="selected";
$newresumelist.=">1500～2000</option>\r\n";
$newresumelist.="<option value=\"6\"";
if($item4==6)  $newresumelist.="selected";
$newresumelist.=">2000～2500</option>\r\n";
$newresumelist.="<option value=\"7\"";
if($item4==7)  $newresumelist.="selected";
$newresumelist.=">2500～3000</option>\r\n";
$newresumelist.="<option value=\"8\"";
if($item4==8)  $newresumelist.="selected";
$newresumelist.=">3000～4000</option>\r\n";
$newresumelist.="<option value=\"9\"";
if($item4==9)  $newresumelist.="selected";
$newresumelist.=">4000～6000</option>\r\n";
$newresumelist.="<option value=\"10\"";
if($item4==10)  $newresumelist.="selected";
$newresumelist.=">6000～9000</option>\r\n";
$newresumelist.="<option value=\"11\"";
if($item4==11)  $newresumelist.="selected";
$newresumelist.=">9000～12000</option>\r\n";
$newresumelist.="<option value=\"12\"";
if($item4==12)  $newresumelist.="selected";
$newresumelist.=">12000～15000</option>\r\n";
$newresumelist.="<option value=\"13\"";
if($item4==13)  $newresumelist.="selected";
$newresumelist.=">15000～20000</option>\r\n";
$newresumelist.="<option value=\"14\"";
if($item4==14)  $newresumelist.="selected";
$newresumelist.=">20000以上</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"10%\"><select name=\"item5\" size=\"1\" style=\"width:90px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>更新时间</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item5==1)  $newresumelist.="selected";
$newresumelist.=">今天</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item5==3)  $newresumelist.="selected";
$newresumelist.=">三天内</option>\r\n";
$newresumelist.="<option value=\"7\"";
if($item5==7)  $newresumelist.="selected";
$newresumelist.=">一周内</option>\r\n";
$newresumelist.="<option value=\"15\"";
if($item5==15)  $newresumelist.="selected";
$newresumelist.=">半月内</option>\r\n";
$newresumelist.="<option value=\"30\"";
if($item5==30)  $newresumelist.="selected";
$newresumelist.=">一月内</option>\r\n";
$newresumelist.="</select></td>\r\n";
$newresumelist.="</tr>\r\n";
while($row=$db->fetch_array($query)){
$r_name=$row['r_name'];$m_nameshow=$row['m_nameshow'];$r_sex=$row['r_sex'];
$r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'女士');
$newresumelist.="        <tr class=\"moretabmain\" align=\"center\">\r\n";
$newresumelist.="          <td><input type=\"checkbox\" name=\"id\" value=\"$row[r_id]\" class=\"checkbox\" /></td>\r\n";
$newresumelist.="          <td height=\"22\"><a href=\"".formatlink($row["r_adddate"],1,1,$row["r_id"],0)."\" target=\"_blank\" title=\"".change_strbox($row['r_appraise'])."\">$r_name</a>&nbsp;</td>\r\n";
$newresumelist.="          <td><a href=\"".formatlink($row["r_adddate"],1,1,$row["r_id"],0)."\" target=\"_blank\">".xreplace($row["r_position"],1)."</a>&nbsp;</td>\r\n";
$newresumelist.="          <td>".xreplace($row["r_workadd"],1)."&nbsp;</td>\r\n";
$newresumelist.="          <td>".hiresex($row['r_sex'])."&nbsp;</td>\r\n";
$newresumelist.="          <td>".hireedu($row['r_edu'])."&nbsp;</td>\r\n";
$newresumelist.="          <td>".hiretype($row['r_jobtype'])."&nbsp;</td>\r\n";
$newresumelist.="          <td>".hirepay($row['r_pay'])."&nbsp;</td>\r\n";
$newresumelist.="          <td>".dtime(strtotime($row["r_adddate"]),3)."&nbsp;</td>\r\n";
$newresumelist.="        </tr>\r\n";
}
include template('commondresume','more');
?>