<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=12;
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
require(FR_ROOT.'/inc/common.func.php');
$i=0;
$counts = $db->counter($cfg['tb_pre']."zph","DATEDIFF(`z_deadline`,'".date('Y-m-d')."')>0");
$getpageinfo = page($page,$counts,$cfg['path']."zph/",20,5);
$sql="SELECT * FROM `".$cfg['tb_pre']."zph` WHERE DATEDIFF(`z_deadline`,'".date('Y-m-d')."')>0 ORDER BY `z_deadline` ASC";
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);$zlist=array();
while($row=$db->fetch_array($query)){
    $i++;
    if($i==1&&!$id){$id=$row['z_id'];}
    $zlist[]=$row;
}
if($id){
    $db->query("UPDATE `".$cfg['tb_pre']."zph` SET `z_views`=`z_views`+1 WHERE `z_id`=$id");
    $rs = $db->get_one("SELECT * FROM `".$cfg['tb_pre']."zph` WHERE `z_id`=$id LIMIT 0,1");
}
include template('index','zph');
?>