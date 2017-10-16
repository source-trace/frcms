<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=2;
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
if(!isset($hireid)||!is_numeric($hireid)){
    echo "<script language=JavaScript>alert('信息参数错误！');window.close();</script>";exit;
}
$hireid=intval($hireid);
$hsqlstr=array('h_id','h_place','h_comid','h_type','h_dept','h_adddate','h_enddate','h_experience','h_edu','h_number','h_profession','h_position','h_pay','h_sex','h_age1','h_age2','h_workadd','h_introduce');
$sqlss='';
foreach($hsqlstr as $v) $sqlss.="$v,";
$sqlss=substr($sqlss,0,-1);
$rs=$db->get_one("select $sqlss,DATEDIFF(h_enddate,'".date('Y-m-d')."') as end from {$cfg['tb_pre']}hire where h_id=$hireid and h_status=1");
if($rs){
    foreach($hsqlstr as $v) $$v=$rs[$v];
    $end=$rs['end'];
}else{
    echo "<script language=JavaScript>alert('内容不存在或已删除！');window.close();</script>";exit;
}
$sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_template','m_confirm','g_name','g_hide');
$sqls='';
foreach($sqlstr as $v) $sqls.="$v,";
$sqls=substr($sqls,0,-1);
$rs = $db->get_one("select $sqls from {$cfg['tb_pre']}member LEFT JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_id=$h_comid");
if($rs){
    foreach($sqlstr as $v) $$v=$rs[$v];
    $m_founddate=$m_founddate=='0000-00-00'?"":$m_founddate;
    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?'/upfiles/company/nologo.gif':$m_logo;
    $m_logo=substr($m_logo,0,3)=="../"?$cfg['path'].substr($m_logo,3):$m_logo;
    if($m_introduce=='') $m_introduce="暂无公司简介！";
    $m_seat=xreplace($m_seat);
    $m_group=membergroup($m_groupid,1);
    if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
include template('hire','company',$m_template);
?>