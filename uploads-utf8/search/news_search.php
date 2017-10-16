<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
$cid=$cid?intval($cid):0;
if($cid==0){showmsg('参数错误！','-1');exit();}
@session_start();
$_SESSION["channelid"] = $cid;
$tid=$typeid?intval($typeid):0;
if($tid!=0){$_SESSION["typeid"] = $tid;}
$s_tit=$s_tit?cleartags($s_tit):'title';
$keywords=$keywords?cleartags($keywords):'';
if($keywords=="%"||strpos($keywords,"select")>0||strpos($keywords,"delete")>0){
    showmsg('请勿非法提交数据！','-1');exit();
}
if($keywords==''){showmsg('请输入要查找的关键词！','-1');exit();}
$strfilename="news_search.php?cid=$cid&s_tit=$s_tit&typeid=$tid&keywords=$keywords";
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
$sqladd='';
if($tid!=0) $sqladd.=" and n_sid=$tid";
if($s_tit=="title") {
    $sqladd.=" and n_title like '%$keywords%'";
}else{
    $sqladd.=" and (n_title like '%$keywords%' or n_content like '%$keywords%')";
}
$sql="select n_id,n_cid,n_addtime,n_title,n_content,n_from from {$cfg['tb_pre']}news where n_cid=$cid $sqladd order by n_addtime desc";
$searchlist='';
$query=$db->query($sql);
$counts = $db->num_rows($query);
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,$strfilename,20,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
    $searchlist.="<div style=\"float:left;width:100%;margin:0;padding:10px 0 0 0; font-size:12px; color:#999999;border-bottom:1px #CCCCCC dashed;\">\r\n";
    $searchlist.="  <div style=\"margin:4px; width:100px; height:100px; float:left;\"><a href=\"".formatlink($row['n_addtime'],$row['n_cid'],1,$row['n_id'],0)."\" target=\"_blank\">";
    $pictureurl=$row['n_pic']?$cfg['path'].substr($row['n_pic'],3):$cfg['path']."upfiles/article/nopicture.gif";
	$searchlist.="<img src=\"$pictureurl\" border=\"1\" width=\"100\" height=\"90\" /></a></div>\r\n";
	$searchlist.="<span style=\"font-size:14px; font-weight:bold; line-height:30px;\"><a href=\"".formatlink($row['n_addtime'],$row['n_cid'],1,$row['n_id'],0)."\">$row[n_title]</a><a href=\"".formatlink($row['n_addtime'],$row['n_cid'],1,$row['n_id'],0)."\" style='font-size:12px; font-weight:normal' target='_blank'>[在新窗口打开]</a></span>\r\n";
	$searchlist.="<ul style=\"margin:0 10px 0 0; padding:0;\">".sub_cnstrs(deletehtml($row['n_content']),200)."...</ul>\r\n";
	$searchlist.="<ul style=\"margin:0 10px 0 0; padding:0;\">来源：$row[n_from]  日期：$row[n_addtime]</ul></div>\r\n";
}
require(FR_ROOT.'/inc/common.func.php');
include template('news_search','search');
?>