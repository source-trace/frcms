<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=1;
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
    $c_createhtml=$rs['c_createhtml'];
}else{
    echo "<script language=JavaScript>alert('模块参数错误！');window.close();</script>";exit;
}
if(!isset($rid)||!is_numeric($rid)){
    echo "<script language=JavaScript>alert('信息参数错误！');window.close();</script>";exit;
}
$rid=intval($rid);
$rsqlstr=array('r_member','r_id','r_adddate','r_name','r_sex','r_birth',
'r_cardtype','r_idcard','r_nation','r_marriage','r_height','r_polity',
'r_weight','r_hukou','r_seat','r_school','r_graduate','r_edu','r_zhicheng','r_sumup',
'r_appraise','r_jobtype','r_trade','r_position','r_workadd','r_pay','r_stay','r_workdate',
'r_request','r_tel','r_chat','r_email','r_url','r_address','r_post','r_visitnum',
'r_usergroup','r_openness','r_title','r_template','r_ability','m_logo','m_logoflag','m_logostatus','m_nameshow','m_qzstate','m_groupid');
$sqlss='';
foreach($rsqlstr as $v) $sqlss.="$v,";
$sqlss=substr($sqlss,0,-1);
$rs=$db->get_one("select $sqlss from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_member=m_login where r_id=$rid");
if($rs){
    foreach($rsqlstr as $v) $$v=$rs[$v];
    $rsg = $db->get_one("select g_hide from {$cfg['tb_pre']}group where g_id=$m_groupid");
    if($rsg){$g_hide=$rsg['g_hide'];}
    $r_graduate=$r_graduate=='0000-00-00'?"":$r_graduate;
    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0||$m_logostatus==0)?$cfg['path'].'upfiles/person/nophoto.gif':$m_logo;
    $r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'小姐/女士');
}else{
    echo "<script language=JavaScript>alert('内容不存在或已删除！');window.close();</script>";exit;
}
$query=$db->query("select * from {$cfg['tb_pre']}education where e_rid=$rid");
while($row=$db->fetch_array($query)){
    $edudb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}training where t_rid=$rid");
while($row=$db->fetch_array($query)){
    $trainingdb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}lang where l_rid=$rid");
while($row=$db->fetch_array($query)){
    $langdb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}work where w_rid=$rid");
while($row=$db->fetch_array($query)){
    $workdb[]=$row;
}
require(FR_ROOT.'/inc/common.func.php');
include template('cnresume_view','person');
?>