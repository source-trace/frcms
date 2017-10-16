<?php
require(dirname(__FILE__).'/config.inc.php');
set_time_limit(1800);
if($webstateArray[0]){showmsg('网站关闭暂无法访问，原因：'.$webstateArray[1], 'javascript:;');exit();}
if(empty($do)) $do= '';
$reg='';$regtype=Array('person'=>'个人用户','company'=>'企业用户','school'=>'院校用户','train'=>'培训用户');
foreach($regtype as $key=>$value){
    if(isset($$key)){
        $reg=$key;$regarr='reg'.substr($key,0,1).'Array';$regarrs=$$regarr;
        if($regarrs[0]){showmsg('系统关闭了'.$value.'注册，原因：'.$regarrs[1].'！', 'index.php');exit();}
    }
}
if($reg=='') $reg='person';
if($do=='check'){
    $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
   	if($verifycode!=''){
   	    $svali = strtolower(getvcvalue());
       	if($verifycode=='' || $verifycode != $svali){echo "false";exit;}else{echo "true";exit;}
    }
    if(empty($login)) $login='';
    if(empty($email)) $email='';
    if(empty($opwd)) $opwd='';
    if($login!=''&&$opwd!=''){
        $c = $db->get_one("SELECT `m_login` FROM `{$cfg['tb_pre']}member` WHERE `m_login`='$login' AND `m_pwd`='".md5($opwd)."'");
        if ($c){echo "true";exit;}else{echo "false";exit;}
	}elseif($login!=''&&$email==''){
        if($cfg['charset']!='utf-8') $login=@iconv('utf-8','gb2312',$login);
        $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
        $len = strlen($login);
        if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
            echo "false";exit;
        }else{
            $c = $db->get_one("SELECT `m_login` FROM `{$cfg['tb_pre']}member` WHERE `m_login`='$login'");
            if ($c){echo "false";exit;}else{echo "true";exit;}
        }
    }elseif($email!=''){
        $email = preg_replace("/[^0-9a-zA-Z_@!\.-]/i",'',$email);
        $c = $db->get_one("SELECT `m_login` FROM `{$cfg['tb_pre']}member` WHERE `m_email`='$email'");
        if ($c){echo "false";exit;}else{echo "true";exit;}
    }else{
        echo "false";exit;
    }
}
$loginip=getip();
//检测同IP注册
if($cfg['regperiod']){
    $regperiod=$cfg['regperiod']*3600;
    $rs = $db->get_one("SELECT `m_id` FROM `{$cfg['tb_pre']}member` WHERE `m_loginip`='$loginip' AND UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`m_regdate`)<$regperiod ORDER BY `m_regdate` DESC LIMIT 1");
    if ($rs){showmsg('同一IP，每'.$cfg['regperiod'].'小时只能注册一次。', 'index.php');exit;}
}
if($do=='register'){
    if($veriArray[0]==1){
        $verifycode = empty($verifycode) ? '' : strtolower(trim($verifycode));
    	$svali = strtolower(getvcvalue());
    	if($verifycode=='' || $verifycode != $svali){
    		showmsg('验证码不正确!','0');exit();
    	}
    }
    if (chkpost()){
        if(empty($login)) $login='';
        if(empty($pwd)) $pwd='';
        $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
        $len = strlen($login);
        if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
            showmsg('用户名不合法!','0');exit();
        }
        if($login==''||$pwd=='') {showmsg('参数不全!','0');exit();}
        if($pwd!=$repwd){showmsg('两次密码输入不一致!','0');exit();}
        $ueserpwd=$pwd;$pwd=md5($pwd);$answer=md5($answer);
        $email=checkemail($email)?$email:'';
        if($email=='') {showmsg('邮箱格式不正确或未填写!','0');exit();}
        $c = $db->get_one("SELECT `m_login` FROM `{$cfg['tb_pre']}member` WHERE `m_login`='$login'");
        if ($c){showmsg('用户名重复，换一个用户名注册，请勿重复提交!','0');exit();}
        $inviteid=_getcookie('c_inviteid');$site=$cfg['site']?$cfg['site']:0;
        if($reg=='person'){
            $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_question','m_answer','m_typeid','m_groupid','m_name','m_sex','m_birth','m_cardtype','m_idcard','m_marriage','m_polity','m_hukou','m_seat','m_edu','m_tel','m_telshowflag','m_mobile','m_mobileshowflag','m_chat','m_url','m_address','m_post','m_regdate','m_logindate','m_loginip','m_loginnum','m_flag','m_startdate','m_enddate','m_mysendnum','m_myinterviewnum','m_myfavoritenum','m_contactnum','m_smsnum','m_logoflag','m_logostatus','m_inviteid','m_site','m_nameshow');
            $rsqlstr=Array('r_title','r_chinese','r_cnstatus','r_visitnum','r_personinfo','r_member','r_adddate','r_flag','r_email','r_name','r_sex','r_birth','r_cardtype','r_idcard','r_marriage','r_polity','r_hukou','r_seat','r_edu','r_tel','r_mobile','r_chat','r_url','r_address','r_post','r_mid');
            $typeid=1;$usertype='pmember';$mailsign='person_reg';$smssign='sms_person_reg';
            $hukou='';
            if(!empty($hukouprovince)) $hukou.=$hukouprovince.'*';
            if(!empty($hukoucapital)) $hukou.=$hukoucapital.'*';
            if(!empty($hukoucity)) $hukou.=$hukoucity.'*';
            $hukou=$hukou!=''?substr($hukou,0,-1):'';
            $flag=$regpArray[2]==1?0:1;$mailsend=$regpArray[5];
            $logoflag=$logostatus=$nameshow=1;
        }elseif($reg=='company'){
            $name=cleartags($name);
            $c = $db->get_one("SELECT `m_name` FROM `{$cfg['tb_pre']}member` WHERE `m_name`='$name'");
            if ($c){showmsg('错误：此公司名称已有人使用，请正确填写您的公司名称！','0');exit();}
            $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_question','m_answer','m_typeid','m_groupid','m_name','m_licence','m_trade','m_seat','m_ecoclass','m_founddate','m_fund','m_workers','m_introduce','m_contact','m_tel','m_telshowflag','m_fax','m_mobile','m_mobileshowflag','m_chat','m_url','m_address','m_post','m_regdate','m_logindate','m_loginip','m_loginnum','m_flag','m_startdate','m_enddate','m_hirenum','m_expertnum','m_myinterviewnum','m_recyclenum','m_contactnum','m_smsnum','m_logoflag','m_logostatus','m_inviteid','m_site');
            $typeid=2;$usertype='cmember';$mailsign='company_reg';$smssign='sms_company_reg';
            $flag=$regcArray[2]==1?0:1;$mailsend=$regcArray[5];
            $logoflag=$logostatus=1;
        }elseif($reg=='school'){
            $name=cleartags($name);
            $c = $db->get_one("SELECT `m_name` FROM `{$cfg['tb_pre']}member` WHERE `m_name`='$name'");
            if ($c){showmsg('错误：此院校名称已有人使用，请正确填写您的院校名称！','0');exit();}
            $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_question','m_answer','m_typeid','m_groupid','m_name','m_seat','m_ecoclass','m_introduce','m_contact','m_tel','m_telshowflag','m_fax','m_mobile','m_mobileshowflag','m_chat','m_url','m_address','m_post','m_regdate','m_logindate','m_loginip','m_loginnum','m_flag','m_startdate','m_enddate','m_hirenum','m_expertnum','m_myinterviewnum','m_recyclenum','m_contactnum','m_smsnum','m_logoflag','m_logostatus','m_inviteid','m_site');
            $typeid=3;$usertype='smember';$mailsign='school_reg';$smssign='sms_school_reg';
            $flag=$regsArray[2]==1?0:1;$mailsend=$regsArray[5];
            $logoflag=$logostatus=1;
        }elseif($reg='train'){
            $name=cleartags($name);
            $c = $db->get_one("SELECT `m_name` FROM `{$cfg['tb_pre']}member` WHERE `m_name`='$name'");
            if ($c){showmsg('错误：此机构名称已有人使用，请正确填写您的机构名称！','0');exit();}
            $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_question','m_answer','m_typeid','m_groupid','m_name','m_seat','m_ecoclass','m_founddate','m_introduce','m_contact','m_tel','m_telshowflag','m_fax','m_mobile','m_mobileshowflag','m_chat','m_url','m_address','m_post','m_regdate','m_logindate','m_loginip','m_loginnum','m_flag','m_startdate','m_enddate','m_hirenum','m_expertnum','m_myinterviewnum','m_recyclenum','m_contactnum','m_smsnum','m_logoflag','m_logostatus','m_inviteid','m_site');
            $typeid=4;$usertype='tmember';$mailsign='train_reg';$smssign='sms_train_reg';
            $flag=$regtArray[2]==1?0:1;$mailsend=$regtArray[5];
            $logoflag=$logostatus=1;
        }
        $seat='';
        if(!empty($province)) $seat.=$province.'*';
        if(!empty($capital)) $seat.=$capital.'*';
        if(!empty($city)) $seat.=$city.'*';
        $seat=$seat!=''?substr($seat,0,-1):'';
        $rs = $db->get_one("SELECT `g_id`,`g_name`,`g_term`,`g_unit`,`g_limit`,`g_integral` FROM `{$cfg['tb_pre']}group` WHERE `g_typeid`=$typeid AND `g_isdefault`=1 LIMIT 0,1");
        if($rs){
            $groupid=$rs['g_id'];$gname=$rs['g_name'];$term=$rs['g_term'];$unit=$rs['g_unit'];$limit=explode(",",$rs['g_limit']);$integral=explode(",",$rs['g_integral']);
            if($typeid==1){
                $integral2=$integral[7];$integral=$integral[5];$myfavoritenum=$limit[1];$myinterviewnum=$limit[3];$mysendnum=$limit[5];$contactnum=$limit[11];$smsnum=$limit[13];
            }else{
                $integral2=$integral[6];$integral=$integral[4];$hirenum=$limit[1];$expertnum=$limit[3];$myinterviewnum=$limit[5];$recyclenum=$limit[7];$contactnum=$limit[9];$smsnum=$limit[13];
            }
            $startdate=dtime($fr_time,3);
            switch ($unit){
                case '日':$enddate=date('Y-m-d',strtotime($startdate."+$term day"));break;
                case '月':$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                case '季':$term=$term*3;$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                case '年':$enddate=date('Y-m-d',strtotime($startdate."+$term year"));break;
            }
        }else{
            showmsg('系统配置故障，请联系管理员!','0');exit();
        }
        $regdate=$logindate=dtime($fr_time,6);$emailshowflag=$telshowflag=$mobileshowflag=$loginnum=1;
        $sqls=$sqlss='';
        foreach($sqlstr as $v){
            $v=str_replace('m_','',$v);
            if(isset($$v)){
                $sqls.="m_$v,";
                $v=='introduce'?$sqlss.="'".replace_strbox($$v)."',":$sqlss.="'".cleartags($$v)."',";
            }
        }
        $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
        //UC整合
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){
    		$uid = FR_API=='uc'?uc_user_register($login, $ueserpwd, $email):uc_user_register($login, $pwd, $email);
    		if($uid <= 0){
    			if($uid == -1){
    				showmsg("用户名不合法！","0");exit();
    			}elseif($uid == -2){
    				if(FR_API=='uc'){showmsg("包含不允许注册的词语！","0");}else{showmsg("用户名已存在！","0");}exit();
    			}elseif($uid == -3){
                    if(FR_API=='uc'){showmsg("你指定的用户名 {$login} 已存在，请使用别的用户名","0");}else{showmsg("邮箱不合法！","0");}exit();
                }elseif($uid == -4){
    				if(FR_API=='uc'){showmsg("注册失败！","0");}else{showmsg("邮箱已存在！","0");}exit();
    			}elseif($uid == -5){
    				showmsg("你使用的Email 不允许注册！","0");exit();
    			}elseif($uid == -6){
    				showmsg("你使用的Email已经被另一帐号注册，请使其它帐号","0");exit();
    			}else{
    				showmsg("注册失败！","0");exit();
    			}
    		}else{
    			$ucsynlogin = FR_API=='uc'?uc_user_synlogin($uid):uc_user_synlogin($uid,$login,$pwd);
    		}
    	}
        $db ->query("INSERT INTO {$cfg['tb_pre']}member ($sqls) VALUES($sqlss)");
       	$mid=$db ->insert_id();$operator=$login;
        require_once(FR_ROOT.'/inc/paylog.inc.php');
        servicelog('注册'.$gname,$startdate,$enddate,$mid,0,0);
		upintegral($mid,"注册为网站会员系统获赠积分+$integral",$integral);
		$inviteid?upintegral(intval($inviteid),"成功邀请好友注册为网站会员增加积分+$integral2",$integral2):'';
        
        if(isset($group)&&$group!=$groupid){
            $group=intval($group);$groupname=membergroup($group);$orderno = date('YmdHis').rand(1000,9999);
            $db ->query("INSERT INTO {$cfg['tb_pre']}orderservice (o_groupid,o_groupname,o_member,o_datetime,o_pactnum,o_content) VALUES('$group','$groupname','$login',NOW(),'$orderno','新注册申请会员服务，请尽快联系我！联系电话$tel.')");
        }
        _setcookie('user_login',$login,3600*24);
		_setcookie('user_pass',$pwd,3600*24);
        _setcookie('user_type',$usertype,3600*24);
        _setcookie('user_name',$name,3600*24);
        _setcookie('user_loginip',$loginip,3600*24);
        _setcookie('user_logindate',$logindate,3600*24);
        //发送邮件
        if(isset($sendemail)&&$sendemail==1&&$mailsend==1){
            require_once(FR_ROOT.'/inc/mail.inc.php');
            $to=$email;$from='';
            $mailtemp=load_mailtemp($mailsign);
            $subject=replace_cfglabel($mailtemp['tit']);
            $subject=str_replace('{$FR_会员用户名}',$login,$subject);
			$body=replace_cfglabel($mailtemp['con']);
            $body=str_replace('{$FR_会员用户名}',$login,$body);
            $body=str_replace('{$FR_会员密码}',$ueserpwd,$body);
            sendmail($to, $from, $subject, $body);
        }
        //发送短信
        if($mobile!=''&&$smsArray[0]==1){
            require_once(FR_ROOT.'/smsapi/smsapi.php');
            $newclient=New SMS();
            $smscon=load_smstemp($smssign);
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
        }
        //创建个人简历
        $rid='';
        if($reg=='person'){
            $title='我的求职简历';$chinese=$cnstatus=$visitnum=$personinfo=1;
            $member=$login;$adddate=dtime($fr_time,6);$flag=$regpArray[4]==1?0:1;
            $rsqls=$rsqlss='';
            foreach($rsqlstr as $v){
                $v=str_replace('r_','',$v);
                if(isset($$v)){
                    $rsqls.="r_$v,";
                    $rsqlss.="'".cleartags($$v)."',";
                }
            }
            $rsqls=substr($rsqls,0,-1);$rsqlss=substr($rsqlss,0,-1);
            $db ->query("INSERT INTO {$cfg['tb_pre']}resume ($rsqls) VALUES($rsqlss)");
            $rid=$db ->insert_id();
            $db ->query("UPDATE `{$cfg['tb_pre']}member` SET `m_resumenums`=1 WHERE `m_login`='$login'");
        }
        if($rid!=''){
            if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=person&id=$rid\"></script>";
            showmsg('注册成功,进入第二步填写求职意向!',"{$cfg['path']}member/index.php?mpage=person_addresume&show=2&rid=$rid#s8");exit();
        }
            if($cfg['createhtml']==1){
                if($typeid==2){
                    echo "<script src=\"{$cfg['path']}autohtml.php?do=company&id=$mid\"></script>";
                    echo "<script src=\"{$cfg['path']}autohtml.php?do=hires&id=$mid\"></script>";
                }
            }
            showmsg('注册成功,进入会员中心!',"{$cfg['path']}member");exit();
    }else{showmsg('请勿非法提交数据','-1');exit();}
}else{
    $inviteid&&_setcookie('c_inviteid',$inviteid,3600*24);
    $regverifycode=$veriArray[0];
    require(FR_ROOT.'/inc/common.func.php');
    include template('register',$reg);
}
?>