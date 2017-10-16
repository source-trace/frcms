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
function getltarticle($id=0){
	 global $cfg,$db;
	 $sqladd=$id?" and c_id=$id ":'';
	 $sql="select * from {$cfg['tb_pre']}common where c_type =2 $sqladd order by c_isorder desc";
	
	if($id){
		
		$rsdb=$db->get_one($sql);
		}else{
			 $query=$db->query($sql,'CACHE');
			 while($row=$db->fetch_array($query)){
				 
				$rsdb[]=$row; 
			 }
		}
	 return $rsdb;

}

//var_dump();
$rsdb=getltarticle();
//$rs11=getltarticle(11);

include template('hr_hirelist','hr');
?>