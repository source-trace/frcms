<?php
if(!file_exists(dirname(__FILE__).'/config.inc.php')){
    header('Location:install/index.php');exit();
}
require(dirname(__FILE__).'/config.inc.php');
if($webstateArray[0]){
    showmsg('网站关闭暂无法访问，原因：'.$webstateArray[1], 'javascript:;');exit();
}
require(FR_ROOT.'/inc/common.func.php');
include template('index');
?>