<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=4;
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
$id=intval($id);
$hrzp=$db->get_one("select * from {$cfg['tb_pre']}hrzp where h_flag=1 and h_id=$id");
extract($hrzp);
include template('hr_hire','hr');
?>