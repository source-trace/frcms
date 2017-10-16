<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=10;
if(empty($do)) $do='';
if($do=='add'){
    if($veriArray[3]==1){
        $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
    	$svali = strtolower(getvcvalue());
    	if($verifycode=='' || $verifycode != $svali){
    		showmsg('验证码不正确!','-1');exit();
    	}
    }
    $title=cleartags($title);$content=replace_strbox($content);
    if($cfg['gbmanagerubbish']!=''){
        $gbmanagerubbish=explode("|",$cfg['gbmanagerubbish']);
        $gbcount=count($gbmanagerubbish);
        for($i=0;$i<$gbcount;$i++){
            if(stripos($gbmanagerubbish[$i],$content)>0){
                showmsg("留言内容包含非法词：$gbmanagerubbish[$i]。返回修改！",'-1');exit();
            }
        }
    }
    if (chkpost()){
        if($title==''||$content==''){
            showmsg('留言主题及内容不能为空！！！','-1');exit();
        }else{
            $username=cleartags($username);
            $email=cleartags($email);
            $emailok=$emailok;
            if($emailok!=1) $emailok=0;
            if(_getcookie("user_login")!=''){$ismember=1;}else{$ismember=0;}
            $db ->query("INSERT INTO {$cfg['tb_pre']}guestbook (g_title,g_content,g_username,g_useremail,g_addtime,g_email,g_ismember,g_type) VALUES('$title','$content','$username','$useremail',NOW(),'$emailok','$ismember',0)");
            showmsg('留言成功！','index.php');exit();
        }
    }else{
        showmsg('请勿非法提交数据','-1');exit();
    }
}
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$memberlogin='匿名';
if(_getcookie("user_login")!=''){
    $disabled=" readonly";
    $rs=$db->get_one("select m_email from {$cfg['tb_pre']}member where m_login='"._getcookie("user_login")."'");
    if($rs){
        $memberlogin=_getcookie("user_login");
        $memberemail=$rs['m_email'];
    }
}
require(FR_ROOT.'/inc/common.func.php');
include template('index','guestbook');
?>