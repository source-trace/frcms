<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=11;
if(empty($do)) $do='';
if($do=='add'){
    $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
    $svali = strtolower(getvcvalue());
    if($verifycode=='' || $verifycode != $svali){
    	showmsg('验证码不正确!','-1');exit();
    }
    unset($_POST['verifycode'],$_POST['Submit']);
    $tv=$tvs='';$ip=getip();
    foreach($_POST as $key=>$value){
		if($value==''){
			continue;
		}else{
            $tv.="$key,";
            $tvs.="'".cleartags($value)."',";
		}
    }
    $tv=substr($tv,0,-1);	
	$tvs=substr($tvs,0,-1);	
    if($_POST['v_place']==''||$_POST['v_tel']==''){
        showmsg('职位名称及联系电话不能为空！！！','-1');exit();
    }else{
        $db ->query("INSERT INTO {$cfg['tb_pre']}vhire ($tv,v_adddate,v_ip) VALUES($tvs,NOW(),'$ip')");
        showmsg('发布成功！','index.php');exit();
    }
}
require(FR_ROOT.'/inc/common.func.php');
include template('index','vhire');
?>