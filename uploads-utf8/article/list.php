<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=6;
@session_start();
$_SESSION["channelid"] = $cid;
$typeid=intval($_GET['typeid']);
if($typeid==0){
    echo "<script language=JavaScript>alert('该页面不存在，请访问其他内容！');window.close();</script>";exit;
}else{
    $rs = $db->get_one("select s_name from {$cfg['tb_pre']}newssort where s_id={$typeid}");
    if($rs){
        $s_name=$rs['s_name'];
        $_SESSION["typeid"] = $typeid;
    }else{
        echo "<script language=JavaScript>alert('该栏目不存在，请访问其他内容！');window.close();</script>";exit;
    }
}
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id={$cid}");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
$page= isset($_GET['page'])?$_GET['page']:1;
$_SESSION["page"] = $page;
require(FR_ROOT.'/inc/common.func.php');
include template('list','article');
?>