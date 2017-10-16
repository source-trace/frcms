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
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
if(isset($pid)&&is_numeric($pid)){
    $pid=intval($pid);
    $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_seat','m_birth','m_edu','m_sex','m_template','p_name','p_info','p_filename','p_type');
    $sqls='';
    foreach($sqlstr as $v) $sqls.="$v,";
    $sqls=substr($sqls,0,-1);
    $rs = $db->get_one("select $sqls from {$cfg['tb_pre']}member,{$cfg['tb_pre']}picture where m_login=p_member and p_id=$pid and p_status=1 and p_flag=1 and (p_type=21 or p_type=22) limit 0,1");
    if($rs){
        foreach($sqlstr as $v) $$v=$rs[$v];
        $m_logo=($m_logo==''||$m_logo=='error.gif')?'/upfiles/person/nophoto.gif':$m_logo;
        $m_logo=substr($m_logo,0,3)=="../"?$cfg['path'].substr($m_logo,3):$m_logo;
        if($m_introduce=='') $m_introduce="暂无简介！";
        $m_sex=hiresex($m_sex);
        $m_seat=hireworkadd($m_seat);
        $m_edu=hireedu($m_edu);
        $pic=substr($p_filename,0,3)=="../"?$cfg['path'].substr($p_filename,3):$p_filename;
        if($p_type==21){$p_type="资格证书";}else{$p_type="职场风采";}
    }else{
        echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
    }
}else{
echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
include template('pic','person');
?>