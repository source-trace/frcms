<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
if(empty($do)) $do= '';
if($do=="article"){
	$newsid=isset($id)?intval($id):0;
	if($newsid!=0){
        $db ->query("update {$cfg['tb_pre']}news set n_hits=n_hits+1 where n_id=$newsid");
		$rs = $db->get_one("select n_hits from {$cfg['tb_pre']}news where n_id=$newsid limit 0,1");
		echo $rs['n_hits'];
		exit;
	}
}
?>