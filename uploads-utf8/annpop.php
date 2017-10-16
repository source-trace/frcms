<?php
if(!file_exists(dirname(__FILE__).'/config.inc.php'))
{
    header('Location:install/index.php');
    exit();
}
require(dirname(__FILE__).'/config.inc.php');
if(isset($aid)&&is_numeric($aid)){
    $aid=intval($aid);
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
$rs = $db->get_one("select a_title,a_content from {$cfg['tb_pre']}announce where a_id=$aid");
if($rs){
    $title=$rs['a_title'];
    $content=$rs['a_content'];
}else{
    echo "<script language=JavaScript>alert('内容不存在！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
include template('annpop','common');
?>