<?php
require(dirname(__FILE__).'/../config.inc.php');
if(!empty($login)&&!empty($pwd)&&$at=='a'){
    $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
    $len = strlen($login);
    if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
        showmsg('用户名不合法!','-1');exit();
    }
    $rs = $db->get_one("select m_pwd,m_typeid,m_name,m_loginip,m_logindate from {$cfg['tb_pre']}member where m_login='$login' limit 0,1");
    if($rs){
        $pwd=preg_replace("/[^0-9a-zA-Z]/i",'',$pwd);
        if(strtolower(md5($rs['m_pwd']))==strtolower($pwd)){
            $typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];
            _setcookie('user_login',$login,3600*24);
            _setcookie('user_pass',$rs['m_pwd'],3600*24);
            _setcookie('user_type',usertype($typeid),3600*24);
            _setcookie('user_name',$name,3600*24);
            _setcookie('user_loginip',$loginip,3600*24);
            _setcookie('user_logindate',$logindate,3600*24);
            showmsg('成功登录，2秒后转向会员中心！',"{$cfg['path']}member/",0,2000);exit();
        }else{
            _setcookie('user_login','');
            _setcookie('user_pass','');
            _setcookie('user_type','');
            _setcookie('user_name','');
            _setcookie('user_loginip','');
            _setcookie('user_logindate','');
            showmsg('成功失败，2秒后转向首页！',"{$cfg['path']}index.php",0,2000);exit();
        }
    }
}      
require('check.php');
if(empty($do)) $do= '';
$titstr="会员中心";     
$user_type=_getcookie('user_type');
$user_type=='pmember'&&$ut='person';
$user_type=='cmember'&&$ut='company';
$user_type=='smember'&&$ut='school';
$user_type=='tmember'&&$ut='train'; 
if(isset($mpage)&&$mpage!=''){
    if($m=='main'){
        $mpage = FR_ROOT.'/member/'.$mpage;
    }else{
        switch($user_type){
            case 'pmember':$mpage = FR_ROOT.'/person/'.$mpage;break;
            case 'cmember':$mpage = FR_ROOT.'/company/'.$mpage;break;
            case 'smember':$mpage = FR_ROOT.'/school/'.$mpage;break;
            case 'tmember':$mpage = FR_ROOT.'/train/'.$mpage;break; 
            default:$mpage = FR_ROOT.'/member/main';
        }
    } 
}else{
    $mpage='main';
}
if($do!=''&&$do!='main'){
    include $mpage.'.php';
}
$ContactMan=$ContactMan?$ContactMan:$cfg['contact'];
$ContactPhone=$ContactPhone?$ContactPhone:$cfg['phone'];
$ContactQq=$ContactQq?$ContactQq:$cfg['serviceqq'];
$ContactFax=$cfg['fax'];
$MemMsg="您在使用各项功能的过程中若碰到问题请与客服联系 电话：<span style=\"color:#FF6100; font-weight:bold; font-size:14px;\">$ContactPhone</span>";
include template('index','member');
?>