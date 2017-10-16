<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=4;
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    extract($rs);
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
$id=intval($hrid);
$rsc=getltarticle($id);
extract($rsc);
include template('hr','hr');
?>