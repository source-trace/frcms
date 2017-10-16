<?php
if(!file_exists(dirname(__FILE__).'/config.inc.php'))
{
    header('Location:install/index.php');
    exit();
}
require(dirname(__FILE__).'/config.inc.php');
if(isset($cid)&&is_numeric($cid)){
    $c_id=intval($cid);
    unset($cid);
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}

$rs = $db->get_one("select c_title,c_content,c_template from {$cfg['tb_pre']}common where c_id=$c_id");
if($rs){
    $commontitle=$rs['c_title'];
    $commoncontent=$rs['c_content'];
    $commoncontent=replace_alllabel($commoncontent);
    $commoncontent=replace_cfglabel($commoncontent);
    $commontemplate=$rs['c_template'];
}else{
    echo "<script language=JavaScript>alert('内容不存在！');window.close();</script>";exit;
}
require(FR_ROOT.'/inc/common.func.php');
$commonlist=getsitebottomnav(1);
include template($commontemplate,'common');
?>