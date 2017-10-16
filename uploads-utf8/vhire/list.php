<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=11;
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$keyword=cleartags($keyword);$sqladd="";
if($keyword!='') $sqladd=" and (v_comname like '%$keyword%' or v_place like '%$keyword%')";
require(FR_ROOT.'/inc/common.func.php');
include template('list','vhire');
?>