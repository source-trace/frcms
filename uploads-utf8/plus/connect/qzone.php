<?php
/*QQ登录插件 V1.0*/
require(dirname(__FILE__).'/../../config.inc.php');
@session_start();
$_SESSION["appid"]    = $cfg["qq_appid"]; 
$_SESSION["appkey"]   = $cfg["qq_appkey"]; 
$_SESSION["callback"] = $siteurl.$path."plus/connect/qzone.php";
function get_normalized_string($params)
{
    ksort($params);
    $normalized = array();
    foreach($params as $key => $val)
    {
        $normalized[] = $key."=".$val;
    }

    return implode("&", $normalized);
}
function get_signature($str, $key)
{
    $signature = "";
    if (function_exists('hash_hmac'))
    {
        $signature = base64_encode(hash_hmac("sha1", $str, $key, true));
    }
    else
    {
        $blocksize	= 64;
        $hashfunc	= 'sha1';
        if (strlen($key) > $blocksize)
        {
            $key = pack('H*', $hashfunc($key));
        }
        $key	= str_pad($key,$blocksize,chr(0x00));
        $ipad	= str_repeat(chr(0x36),$blocksize);
        $opad	= str_repeat(chr(0x5c),$blocksize);
        $hmac 	= pack(
            'H*',$hashfunc(
                ($key^$opad).pack(
                    'H*',$hashfunc(
                        ($key^$ipad).$str
                    )
                )
            )
        );
        $signature = base64_encode($hmac);
    }

    return $signature;
} 
function get_urlencode_string($params)
{
    ksort($params);
    $normalized = array();
    foreach($params as $key => $val)
    {
        $normalized[] = $key."=".rawurlencode($val);
    }

    return implode("&", $normalized);
}
function is_valid_openid($openid, $timestamp, $sig)
{
    $key = $_SESSION["appkey"];
    $str = $openid.$timestamp;
    $signature = get_signature($str, $key);
    return $sig == $signature; 
}
function do_get($url, $appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $sigstr = "GET"."&".rawurlencode("$url")."&";
    $params = $_GET;
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $params["oauth_token"]            = $access_token;
    $params["openid"]                 = $openid;
    unset($params["oauth_signature"]);

    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);
    $key = $appkey."&".$access_token_secret;
    $signature = get_signature($sigstr, $key);
    $url      .= "?".$normalized_str."&"."oauth_signature=".rawurlencode($signature);
    return file_get_contents($url);
}
function do_multi_post($url, $appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $sigstr = "POST"."&"."$url"."&";
    $params = $_POST;
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $params["oauth_token"]            = $access_token;
    $params["openid"]                 = $openid;
    unset($params["oauth_signature"]);
    foreach ($_FILES as $filename => $filevalue)
    {
        if ($filevalue["error"] != UPLOAD_ERR_OK)
        {
            //echo "upload file error $filevalue['error']\n";
            //exit;
        } 
        $params[$filename] = file_get_contents($filevalue["tmp_name"]);
    }
    $sigstr .= get_normalized_string($params);
    $key = $appkey."&".$access_token_secret;
    $signature = get_signature($sigstr, $key);
    $params["oauth_signature"] = $signature; 
    foreach ($_FILES as $filename => $filevalue)
    {
        $tmpfile = dirname($filevalue["tmp_name"])."/".$filevalue["name"];
        move_uploaded_file($filevalue["tmp_name"], $tmpfile);
        $params[$filename] = "@$tmpfile";
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);

    curl_close($ch);
    unlink($tmpfile);
    return $ret;

}
function do_post($url, $appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $sigstr = "POST"."&".rawurlencode($url)."&";
    $params = $_POST;
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $params["oauth_token"]            = $access_token;
    $params["openid"]                 = $openid;
    unset($params["oauth_signature"]);
    $sigstr .= rawurlencode(get_normalized_string($params));
    $key = $appkey."&".$access_token_secret;
    $signature = get_signature($sigstr, $key); 
    $params["oauth_signature"] = $signature; 

    $postdata = get_urlencode_string($params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);

    curl_close($ch);
    return $ret;

}
//*********************************************************************
//以下为请求临时token
function get_request_token($appid, $appkey)
{
    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token?";
	$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token")."&";
    $params = array();
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);
    $key = $appkey."&";
    $signature = get_signature($sigstr, $key);
    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
    return file_get_contents($url);
}
//*************************************************
//跳转到QQ登录页面
function redirect_to_login($appid, $appkey, $callback)
{
    $redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=$appid&";
    $result = array();
    $request_token = get_request_token($appid, $appkey);
    parse_str($request_token, $result);
    $_SESSION["token"]        = $result["oauth_token"];
    $_SESSION["secret"]       = $result["oauth_token_secret"];

    if ($result["oauth_token"] == "")
    {
        echo $request_token;//示例代码中没有对错误情况进行处理。真实情况下网站需要自己处理错误情况
        exit;
    }
    $redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($callback);
    header("Location:$redirect");
}
//**************************************************
//以下为获取access_token
function get_access_token($appid, $appkey, $request_token, $request_token_secret, $vericode)
{
    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token?";
	$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token")."&";
    $params = array();
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;
    $params["oauth_token"]            = $request_token;
    $params["oauth_vericode"]         = $vericode;
    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);
    $key = $appkey."&".$request_token_secret;
    $signature = get_signature($sigstr, $key);
    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);
    return file_get_contents($url);
}
function get_user_info($appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $url    = "http://openapi.qzone.qq.com/user/get_user_info";
    $info   = do_get($url, $appid, $appkey, $access_token, $access_token_secret, $openid);
    $arr = array();
    $arr = json_decode($info, true);
    return $arr;
}
function add_blog($appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $url    = "http://openapi.qzone.qq.com/blog/add_one_blog";
    echo do_post($url, $appid, $appkey, $access_token, $access_token_secret, $openid);
}
function add_feeds($appid, $appkey, $access_token, $access_token_secret, $openid)
{
    $url    = "http://openapi.qzone.qq.com/feeds/add_feeds";
    echo do_post($url, $appid, $appkey, $access_token, $access_token_secret, $openid);
}


if($do=='redirect'){
    redirect_to_login($_SESSION["appid"], $_SESSION["appkey"], $_SESSION["callback"]);
}elseif($do=='login'){
    $openid=$_SESSION["qq_openid"];
    if(!$openid){echo "出错啦，没有成功获得openid! <a href=\"../../\">返回</a>";exit;}
    $rs = $db->get_one("select m_id,m_login,m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_openid='$openid' limit 0,1");
    if($rs){
        $login=$rs["m_login"];$pwd=$rs["m_pwd"];$typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
        if($typeid==1){$integral=$Gintegral[6];}else{$integral=$Gintegral[5];}
        $db ->query("update {$cfg['tb_pre']}member set m_loginnum=m_loginnum+1,m_logindate=NOW(),m_loginip='$ip' where m_login='$login'");
        //UC整合
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){
            if(FR_API=='uc'){
                list($uid,$username,$email) = uc_get_user($login);
                $ucsynlogin = uc_user_synlogin($uid);
            }else{
                extract(uc_user_get($login));
                $ucsynlogin = uc_user_synlogin($uid,$login,$pwd);
            }
        }  
          
        require_once(FR_ROOT.'/inc/paylog.inc.php');
        upintegral($rs['m_id'],"登录会员中心增加积分+$integral",$integral);
    
        _setcookie('user_login',$login,3600*24);
        _setcookie('user_pass',$pwd,3600*24);
        _setcookie('user_type',usertype($typeid),3600*24);
        _setcookie('user_name',$name,3600*24);
        _setcookie('user_loginip',$loginip,3600*24);
        _setcookie('user_logindate',$logindate,3600*24);
        if(!empty($goto)){
    		showmsg('QQ成功登录，2秒后返回！',$goto,0,2000);exit();
    	}else{
    		showmsg('QQ成功登录，2秒后转向会员中心！',"{$cfg['path']}member/",0,2000);exit();
    	}
     }else{
        $resultxml=$_SESSION["qq_resultxml"];
        $nickname=trim($resultxml["nickname"]);
        if($cfg['charset']=='gbk') $nickname=@iconv('utf-8','gb2312',$nickname);
        require(FR_ROOT.'/inc/common.func.php');
        include template('qzone','plus');
     }
}elseif($do=='doreg'){
    $openid=$_SESSION["qq_openid"];
    if(!$openid){echo "出错啦，没有成功获得openid! <a href=\"../../\">返回</a>";exit;}
    if(empty($login)) $login='';
    $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
    $len = strlen($login);
    if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
        showmsg('用户名不合法!','0');exit();
    }
    if($login=='') {showmsg('参数不全!','0');exit();}
    $email=checkemail($email)?$email:'';
    if($email=='') {showmsg('邮箱格式不正确或未填写!','0');exit();}
    $c = $db->get_one("select m_login from {$cfg['tb_pre']}member where m_login='$login'");
    if ($c){showmsg('用户名重复，换一个用户名注册，请勿重复提交!','0');exit();}
    $inviteid=_getcookie('c_inviteid');$ueserpwd=substr(md5(date('YmdHis')),-6);$pwd=md5($ueserpwd);
    $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_typeid','m_groupid','m_regdate','m_logindate','m_loginip','m_loginnum','m_flag','m_startdate','m_enddate','m_mysendnum','m_myinterviewnum','m_myfavoritenum','m_hirenum','m_expertnum','m_recyclenum','m_contactnum','m_smsnum','m_logoflag','m_logostatus','m_inviteid','m_openid');
    $rsqlstr=Array('r_title','r_chinese','r_cnstatus','r_visitnum','r_personinfo','r_member','r_adddate','r_flag','r_email','r_mid');
    if($typeid==1){$usertype='pmember';$flag=$regpArray[2]==1?0:1;$logoflag=$logostatus=1;
    }elseif($typeid==2){$usertype='cmember';$flag=$regcArray[2]==1?0:1;$logoflag=$logostatus=1;
    }elseif($typeid==3){$usertype='smember';$flag=$regsArray[2]==1?0:1;$logoflag=$logostatus=1;
    }elseif($typeid==4){$usertype='tmember';$flag=$regtArray[2]==1?0:1;$logoflag=$logostatus=1;
    }
    $rs = $db->get_one("select g_id,g_name,g_term,g_unit,g_limit,g_integral from {$cfg['tb_pre']}group where g_typeid=$typeid and g_isdefault=1 limit 0,1");
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
    $regdate=$logindate=dtime($fr_time,6);$loginip=getip();$emailshowflag=$telshowflag=$mobileshowflag=$loginnum=1;
    $sqls=$sqlss='';
    foreach($sqlstr as $v){
        $v=str_replace('m_','',$v);
        if(isset($$v)){
            $sqls.="m_$v,";
            $sqlss.="'".cleartags($$v)."',";
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

        _setcookie('user_login',$login,3600*24);
		_setcookie('user_pass',$pwd,3600*24);
        _setcookie('user_type',$usertype,3600*24);
        _setcookie('user_name',$name,3600*24);
        _setcookie('user_loginip',$loginip,3600*24);
        _setcookie('user_logindate',$logindate,3600*24);
        //创建个人简历
        $rid='';
        if($typeid==1){
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
            $db ->query("update {$cfg['tb_pre']}member set m_resumenums=1 where m_login='$login'");
        }
        if($rid!=''){
            if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=person&id=$rid\"></script>";
            showmsg('QQ注册成功,进入第二步填写求职意向!',"{$cfg['path']}member/index.php?mpage=person_addresume&show=2&rid=$rid");exit();
        }
        if($cfg['createhtml']==1){
            if($typeid==2){
               echo "<script src=\"{$cfg['path']}autohtml.php?do=company&id=$mid\"></script>";
               echo "<script src=\"{$cfg['path']}autohtml.php?do=hires&id=$mid\"></script>";
            }
        }
    showmsg('QQ注册成功,进入会员中心!',"{$cfg['path']}member");exit();
}elseif($do=='blogin'){
    $openid=$_SESSION["qq_openid"];
    if(!$openid){echo "出错啦，没有成功获得openid! <a href=\"../../\">返回</a>";exit;}
    $ip=getip();
    if(!empty($login) && !empty($pwd)){
        $ueserpwd=$pwd;$pwd=md5($pwd);
        $rs1 = $db->get_one("select m_id,m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral,m_openid from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_login='$login' limit 0,1");
        if($rs1){
			if(strtolower($rs1['m_pwd'])!=$pwd){
			 $rse = -1;
			}else{
			 $rse = 1;
            }
        }else{
            $rse = 0;
        }
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){
            //检查帐号
            if(FR_API=='uc'){
                list($uid, $username, $password, $email) = uc_user_login($login, $ueserpwd);
            }else{
                extract(uc_user_login($login,$pwd,0));
            }
            if($uid > 0) {
                $rse = 1;
                //生成同步登录的代码
                $ucsynlogin = FR_API=='uc'?uc_user_synlogin($uid):$synlogin;
            } elseif($uid == -1) {
                //当UC不存在该用户时注册.
                if($rs1&&$rse==1) {
                    $uid = FR_API=='uc'?uc_user_register($login, $ueserpwd, $rs1['m_email']):uc_user_register($login, $pwd, $rs1['m_email']);
                    if($uid > 0) $ucsynlogin = FR_API=='uc'?uc_user_synlogin($uid):uc_user_synlogin($uid,$login,$pwd);
                }
            }else{
                $rse = -1;
            }
        }
        if($rse==0){
			showmsg('你的用户名['.$login.']不存在!','0');exit();
        }else if($rse==-1){
            showmsg('你的密码错误!','0',0,2000);exit();
        }
        $rs2 = $db->get_one("select * from {$cfg['tb_pre']}member where m_openid='$openid'");
		if(!$rs2&&!$rs1['m_openid']){
			$db->query("UPDATE {$cfg['tb_pre']}member SET `m_openid`='$openid',m_loginnum=m_loginnum+1,m_logindate=NOW(),m_loginip='$ip' WHERE m_login='$login'");
		}else{
			showmsg("帐号捆绑失败,因为帐号{$login}已经绑定了其它QQ号码!",'0',0,2000);exit();
		}
        $typeid=$rs1["m_typeid"];$name=$rs1['m_name'];$loginip=$rs1['m_loginip'];$logindate=$rs1['m_logindate'];$Gintegral=explode(",",$rs1['g_integral']);
        if($typeid==1){$integral=$Gintegral[6];}else{$integral=$Gintegral[5];}
        require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($rs1['m_id'],"登录会员中心增加积分+$integral",$integral);
        _setcookie('user_login',$login,3600*24);
        _setcookie('user_pass',$pwd,3600*24);
        _setcookie('user_type',usertype($typeid),3600*24);
        _setcookie('user_name',$name,3600*24);
        _setcookie('user_loginip',$loginip,3600*24);
        _setcookie('user_logindate',$logindate,3600*24);
		if(!empty($goto)){
			showmsg('帐号捆绑成功，2秒后返回！',$goto,0,2000);exit();
		}else{
			showmsg('帐号捆绑成功，2秒后转向会员中心！',"{$cfg['path']}member/",0,2000);exit();
		} 
    }else{
        showmsg('用户和密码没填写完整!','0',0,2000);exit();
    }
}else{
    if (!is_valid_openid($_REQUEST["openid"], $_REQUEST["timestamp"], $_REQUEST["oauth_signature"]))
    {
        echo "API帐号有误!\n";
        echo "sig:".$_REQUEST["oauth_signature"]."\n";
        exit;
    }
    $access_str = get_access_token($_SESSION["appid"], $_SESSION["appkey"], $_REQUEST["oauth_token"], $_SESSION["secret"], $_REQUEST["oauth_vericode"]);
    $result = array();
    parse_str($access_str, $result);
    if (isset($result["error_code"]))
    {
        echo "出错啦，没有成功获得openid! <a href=\"../../\">返回</a>";
        exit;
    }
    $resultxml= get_user_info($_SESSION["appid"], $_SESSION["appkey"], $result["oauth_token"], $result["oauth_token_secret"], $result["openid"]);
    $_SESSION["qq_resultxml"]   = $resultxml;
    $_SESSION["qq_token"]   = $result["oauth_token"];
    $_SESSION["qq_secret"]  = $result["oauth_token_secret"]; 
    $_SESSION["qq_openid"]  = $result["openid"];
    header("Location:qzone.php?do=login");
}
?>