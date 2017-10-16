<?php
require(dirname(__FILE__).'/config.inc.php');
if(empty($do)) $do= '';
$newpwd=0;$mkey=0;$qt=0;$show=0;
if($do=='login'){
    if($veriArray[4]==1){
        $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
    	$svali = strtolower(getvcvalue());
    	if($verifycode=='' || $verifycode != $svali){
    		showmsg('验证码不正确!','-1');exit();
    	}
    }
    //$login = preg_replace("/[^0-9a-zA-Z_@!\.-]/i",'',$login);
    $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
    $len = strlen($login);
    if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
        showmsg('用户名不合法!','-1');exit();
    }
    $email = preg_replace("/[^0-9a-zA-Z_@!\.-]/i",'',$email);
    $mobile = preg_replace("/[^0-9]/i",'',$mobile);
    if($login==''||$email==''){
        showmsg('用户名密码均不能为空!','-1');exit();
    }
    $c = $db->get_one("select m_pwd,m_name,m_mobile,m_typeid from {$cfg['tb_pre']}member where m_login='$login' and m_email='$email'");
    if($c){
        //生成新密码
        $ueserpwd=substr(md5($c['m_pwd']),-6);$pwd=md5($ueserpwd);
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){
            if(FR_API=='uc'){
                $ucresult = uc_user_edit($login, '', $ueserpwd, '', 1);
            }else{
                extract(uc_user_get($login));
                $ucresult = uc_user_edit($uid, $login, '', $pwd, '');
            }
        }
        $db ->query("update {$cfg['tb_pre']}member set m_pwd='$pwd' where m_login='$login'");
        //发送邮件
        require_once(FR_ROOT.'/inc/mail.inc.php');
        $to=$email;$from='';
        $mailtemp=load_mailtemp('get_pwd');
        $subject=replace_cfglabel($mailtemp['tit']);
        $subject=str_replace('{$FR_会员用户名}',$login,$subject);
        $subject=str_replace('{$FR_会员名称}',$c['m_name'],$subject);
        $body=replace_cfglabel($mailtemp['con']);
        $body=str_replace('{$FR_会员用户名}',$login,$body);
        $body=str_replace('{$FR_会员名称}',$c['m_name'],$body);
        $body=str_replace('{$FR_会员新密码}',$ueserpwd,$body);
        sendmail($to, $from, $subject, $body);
        if($c['m_typeid']==1) $loginurl=$cfg['path']."login.php?person";
        if($c['m_typeid']==2) $loginurl=$cfg['path']."login.php?company";
        if($c['m_typeid']==3) $loginurl=$cfg['path']."login.php?school";
        if($c['m_typeid']==4) $loginurl=$cfg['path']."login.php?train";
        if($mobile==$c['m_mobile']&&$smsArray[1]==1){
            require_once(FR_ROOT.'/smsapi/smsapi.php');
            $newclient=New SMS();
            $smscon=load_smstemp('sms_get_pwd');
            foreach($smscon_arry as $k) {
                $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
            }
            $respxml=$newclient->sendSMS($mobile,$smscon,"");
            $code=$newclient->getCode($respxml);
            if($code=='000'){
                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',1,NOW(),'$smscon')");
            }else{
                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',0,NOW(),'$smscon')");
            }
            showmsg('操作成功，系统已为您生成新密码并发送到您的手机和邮箱里，请尽快使用新密码登录!',$loginurl);exit();
        }else{
            showmsg('操作成功，系统已为您生成新密码并发送到您的邮箱中，请登录邮箱查看!',$loginurl);exit();
        }
    }else{
        showmsg('您输入的用户名、邮箱不相符，请重新输入!','-1');exit();
    }
}elseif($do=='email'){
    $email = preg_replace("/[^0-9a-zA-Z_@!\.-]/i",'',$email);
    $mobile = preg_replace("/[^0-9]/i",'',$mobile);
    $question=isset($question)?intval($question):0;
    if($email==''&&$mobile==''){
        showmsg('邮箱地址或手机号码必填一项!','-1');exit();
    }
    if($email!=''&&$question==0){
        if(empty($skey)) $skey= '';
        if($skey!=''){
            $c = $db->get_one("select m_pwd,m_typeid,m_login from {$cfg['tb_pre']}member where m_email='$email'");
            if($c){
                if($c['m_typeid']==1) $loginurl=$cfg['path']."login.php?person";
                if($c['m_typeid']==2) $loginurl=$cfg['path']."login.php?company";
                if($c['m_typeid']==3) $loginurl=$cfg['path']."login.php?school";
                if($c['m_typeid']==4) $loginurl=$cfg['path']."login.php?train";
                if($skey==md5($c['m_pwd'].$email)){
                    if($pwd!=''&&$pwd==$repwd){
                        $ueserpwd=$pwd;$pwd=md5($pwd);$login=$c['m_login'];
                        include_once(FR_ROOT.'/api/api_config.php');
                        if(defined('UC_API')){
                            if(FR_API=='uc'){
                                $ucresult = uc_user_edit($login, '', $ueserpwd, '', 1);
                            }else{
                                extract(uc_user_get($login));
                                $ucresult = uc_user_edit($uid, $login, '', $pwd, '');
                            }
                        }
                        $db ->query("update {$cfg['tb_pre']}member set m_pwd='$pwd' where m_email='$email'");
                        showmsg('密码修改成功，请使用新密码登录!',$loginurl);exit();
                    }
                    $newpwd=1;
                }else{
                    showmsg('连接非法，签名验证失败!','-1');exit();
                }
            }else{
                showmsg('非法操作!','-1');exit();
            }
        }else{
            if($veriArray[4]==1){
                $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
            	$svali = strtolower(getvcvalue());
            	if($verifycode=='' || $verifycode != $svali){
            		showmsg('验证码不正确!','-1');exit();
            	}
            }
            $c = $db->get_one("select m_pwd,m_typeid,m_login,m_name from {$cfg['tb_pre']}member where m_email='$email'");
            if($c){
                //发送邮件
                require_once(FR_ROOT.'/inc/mail.inc.php');
                $to=$email;$from='';$skey=md5($c['m_pwd'].$email);
                $pwdlink=$cfg['siteurl'].$cfg['path']."getpassword.php?do=email&email=$email&skey=$skey";
                $body=$c['m_name']."您好，您在$cfg[sitename]注册的用户名为：$c[m_login]<br>请点击以下链接进行密码修改<br><a href=\"$pwdlink\" target=\"_blank\">$pwdlink</a>";
                sendmail($to, $from, '您好，请点击邮件内容中链接地址修改密码！', $body);
                showmsg('密码修改链接已发送到您的邮箱中，请登录邮箱点击密码修改连接进行修改!','getpassword.php');exit();
            }
        }
    }elseif($mobile!=''&&$question==0){
        if($smsArray[1]==1){
            $c = $db->get_one("select m_pwd,m_typeid,m_login from {$cfg['tb_pre']}member where m_mobile='$mobile'");
            if($c){
                if($c['m_typeid']==1) $loginurl=$cfg['path']."login.php?person";
                if($c['m_typeid']==2) $loginurl=$cfg['path']."login.php?company";
                if($c['m_typeid']==3) $loginurl=$cfg['path']."login.php?school";
                if($c['m_typeid']==4) $loginurl=$cfg['path']."login.php?train";
                $login=$c['m_login'];
                @session_start();
                if($mobilekey!=''&&$mobilekey==$_SESSION["mobilekey"]){
                    $ueserpwd=substr(md5($c['m_pwd']),-6);$pwd=md5($ueserpwd);
                    include_once(FR_ROOT.'/api/api_config.php');
                    if(defined('UC_API')){
                        if(FR_API=='uc'){
                            $ucresult = uc_user_edit($login, '', $ueserpwd, '', 1);
                        }else{
                            extract(uc_user_get($login));
                            $ucresult = uc_user_edit($uid, $login, '', $pwd, '');
                        }
                    }
                    $db ->query("update {$cfg['tb_pre']}member set m_pwd='$pwd' where m_login='$login'");
                    require_once(FR_ROOT.'/smsapi/smsapi.php');
                    $newclient=New SMS();
                    $smscon=load_smstemp('sms_get_pwd');
                    foreach($smscon_arry as $k) {
                        $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
                    }
                    $respxml=$newclient->sendSMS($mobile,$smscon,"");
                    $code=$newclient->getCode($respxml);
                    if($code=='000'){
                        $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',1,NOW(),'$smscon')");
                    }else{
                        $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',0,NOW(),'$smscon')");
                    }
                    $_SESSION["mobilekey"]='';
                    showmsg('操作成功，系统已为您生成新密码并发送到您的手机上，请尽快使用新密码登录!',$loginurl);exit();
                }
                if($veriArray[4]==1){
                    $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
                	$svali = strtolower(getvcvalue());
                	if($verifycode=='' || $verifycode != $svali){
                		showmsg('验证码不正确!','-1');exit();
                	}
                }
                //生成手机验证码
                $mobilekey=rand(100000,999999);
                $_SESSION["mobilekey"] = $mobilekey;
                //发送手机验证码
                require_once(FR_ROOT.'/smsapi/smsapi.php');
                $newclient=New SMS();
                $smscon=load_smstemp('sms_get_mobilekey');
                foreach($smscon_arry as $k) {
                    $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
                }
                $respxml=$newclient->sendSMS($mobile,$smscon,"");
                $code=$newclient->getCode($respxml);
                if($code=='000'){
                    $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',1,NOW(),'$smscon')");
                    $mkey=1;
                }else{
                    $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobile',0,NOW(),'$smscon')");
                    showmsg('短信服务故障处理中，验证码发送不成功，请联系网站客服人员!','-1');exit();
                }
            }
        }else{
            showmsg('本站尚未开启短信服务，请选择其他方式或者联系网站客服人员!','-1');exit();
        }
    }elseif($question==1&&($mobile!=''||$email!='')){
        if(empty($answer)) $answer= '';
        if($answer!=''){
            $answer=md5($answer);
            if($mobile!=''){
                $c = $db->get_one("select m_question,m_typeid,m_login from {$cfg['tb_pre']}member where m_mobile='$mobile' and m_answer='$answer'");
            }else{
                $c = $db->get_one("select m_question,m_typeid,m_login from {$cfg['tb_pre']}member where m_email='$email' and m_answer='$answer'");
            }
            if($c){
                if($c['m_typeid']==1) $loginurl=$cfg['path']."login.php?person";
                if($c['m_typeid']==2) $loginurl=$cfg['path']."login.php?company";
                if($c['m_typeid']==3) $loginurl=$cfg['path']."login.php?school";
                if($c['m_typeid']==4) $loginurl=$cfg['path']."login.php?train";
                if($pwd!=''&&$pwd==$repwd){
                    $ueserpwd=$pwd;$pwd=md5($pwd);$login=$c['m_login'];
                    include_once(FR_ROOT.'/api/api_config.php');
                    if(defined('UC_API')){
                        if(FR_API=='uc'){
                            $ucresult = uc_user_edit($login, '', $ueserpwd, '', 1);
                        }else{
                            extract(uc_user_get($login));
                            $ucresult = uc_user_edit($uid, $login, '', $pwd, '');
                        }
                    }
                    $db ->query("update {$cfg['tb_pre']}member set m_pwd='$pwd' where m_email='$email'");
                    $pwd=$repwd;$login=$c['m_login'];
                    $show=1;
                }else{
                    showmsg('您两次输入的密码不一致，请重新输入！','-1');exit();
                }
            }else{
                showmsg('您输入的密保答案不正确，请重新输入！','-1');exit();
            }
        }else{
            if($veriArray[4]==1){
                $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
            	$svali = strtolower(getvcvalue());
            	if($verifycode=='' || $verifycode != $svali){
            		showmsg('验证码不正确!','-1');exit();
            	}
            }
            if($mobile!=''){
                $c = $db->get_one("select m_question,m_typeid from {$cfg['tb_pre']}member where m_mobile='$mobile'");
            }else{
                $c = $db->get_one("select m_question,m_typeid from {$cfg['tb_pre']}member where m_email='$email'");
            }
            if($c){
                $qt=1;
                $question=$c['m_question'];
                if($c['m_typeid']==1) $loginurl=$cfg['path']."login.php?person";
                if($c['m_typeid']==2) $loginurl=$cfg['path']."login.php?company";
                if($c['m_typeid']==3) $loginurl=$cfg['path']."login.php?school";
                if($c['m_typeid']==4) $loginurl=$cfg['path']."login.php?train";
            }
        }
    }
}
require(FR_ROOT.'/inc/common.func.php');
include template('getpassword','common');
?>