<?php
require_once(dirname(__FILE__).'/../config.inc.php');
$id = empty($id) ? "" : intval($id);
if($id!=""||$id!=0){
    $db ->query("update {$cfg['tb_pre']}ad set ad_clicks=ad_clicks+1 where ad_lose=0 and ad_stop=0 and ad_id=$id");
    $db ->close();
}
header("Location: $geturl");exit;
?>