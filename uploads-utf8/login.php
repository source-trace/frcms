<?php
require(dirname(__FILE__).'/config.inc.php');
set_time_limit(1800);
if(empty($do)) $do= '';
$reg='';
isset($person)&&$reg='person';
isset($company)&&$reg='company';
isset($school)&&$reg='school';
isset($train)&&$reg='train';
if($reg=='') $reg='person';
if($do=='login'){
    @session_start();
    if(isset($_SESSION['s_login'])){
        $login=$_SESSION['s_login'];$pwd=$_SESSION['s_pwd'];$verifycode=$_SESSION['s_verifycode'];
        unset($_SESSION['s_login']);unset($_SESSION['s_pwd']);unset($_SESSION['s_verifycode']);
    }
    if($veriArray[1]==1&&isset($verifycode)){
        $verifycode = (empty($verifycode)) ? '' : strtolower(trim($verifycode));
    	$svali = strtolower(getvcvalue());
    	if($verifycode==''||$verifycode!=$svali){
    	   if($t=='ajax'){echo 'error:验证码不正确,请重新输入！';exit();}else{showmsg('验证码不正确!','-1',0,2000);exit();}
        }
    }
    $ip=getip();
    if(!empty($login) && !empty($pwd)){
        if($cfg['charset']!='utf-8'&&$t=='ajax') $login=@iconv('utf-8','gbk',$login);
        //$login = preg_replace("/[^0-9a-zA-Z_@!\.-]/i",'',$login);
        $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
        $len = strlen($login);
        if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
            if($t=='ajax'){echo 'error:用户名不合法!';exit();}else{showmsg('用户名不合法!','-1');exit();}
        }
        $ueserpwd=$pwd;$pwd=md5($pwd);
        $rs = $db->get_one("select m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral from {$cfg['tb_pre']}member,{$cfg['tb_pre']}group where m_groupid=g_id and m_login='$login' limit 0,1");
        if($rs){
			if(strtolower($rs['m_pwd'])!=$pwd){$rse = -1;}else{$rse = 1;}
        }else{
            $rse = 0;
        }
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){
            //检查帐号
            if(FR_API=='uc'){
                list($uid, $username, $password, $email) = uc_user_login($login, $ueserpwd);
            }else{
                extract(uc_user_login($login,$pwd,0));$status!=1&&$uid=$status;
            }
            if($uid > 0) {
                if(!$rs) {
                    if(!isset($typeid)){
                        $_SESSION['s_login']=$login;$_SESSION['s_pwd']=$ueserpwd;$_SESSION['s_verifycode']=$verifycode;$acturl='?'.$_SERVER["QUERY_STRING"];
                        if($t=='ajax'){echo "error:请选择会员类型进行激活，激活后继续操作！<br>【<a href=\"javascript:Check_loginact('$cfg[path]',1);\">个人会员</a>】【<a href=\"javascript:Check_loginact('$cfg[path]',2);\">企业会员</a>】【<a href=\"javascript:Check_loginact('$cfg[path]',3);\">院校会员</a>】【<a href=\"javascript:Check_loginact('$cfg[path]',4);\">培训会员</a>】!";exit();}else{showmsg('请选择会员类型进行激活，激活后继续操作！<br>【<a href='.$acturl.'&typeid=1>个人会员</a>】【<a href='.$acturl.'&typeid=2>企业会员</a>】【<a href='.$acturl.'&typeid=3>院校会员</a>】【<a href='.$acturl.'&typeid=4>培训会员</a>】!','javascript:;');exit();}
                    }elseif($typeid==1){$flag=$regpArray[2]==1?0:1;$mailsend=$regpArray[5];$logoflag=$regpArray[3]==1?0:1;}
                    elseif($typeid==2){$flag=$regcArray[2]==1?0:1;$mailsend=$regcArray[5];$logoflag=$regcArray[3]==1?0:1;}
                    elseif($typeid==3){$flag=$regsArray[2]==1?0:1;$mailsend=$regsArray[5];$logoflag=$regsArray[3]==1?0:1;}
                    elseif($typeid==4){$flag=$regtArray[2]==1?0:1;$mailsend=$regtArray[5];$logoflag=$regtArray[3]==1?0:1;}
                    else{
                        if($t=='ajax'){echo 'error:非法操作!';exit();}else{showmsg('非法操作!','javascript:;');exit();}
                    }
                    $rsg = $db->get_one("select g_id,g_term,g_unit,g_limit,g_integral from {$cfg['tb_pre']}group where g_typeid=$typeid and g_isdefault=1 limit 0,1");
                    if($rsg){
                        $groupid=$rsg['g_id'];$term=$rsg['g_term'];$unit=$rsg['g_unit'];$limit=explode(",",$rsg['g_limit']);$integral=explode(",",$rsg['g_integral']);
                        if($typeid==1){$integral=$integral[5];$myfavoritenum=$limit[1];$myinterviewnum=$limit[3];$mysendnum=$limit[5];$contactnum=$limit[11];$smsnum=$limit[13];
                        }else{$integral=$integral[4];$hirenum=$limit[1];$expertnum=$limit[3];$myinterviewnum=$limit[5];$recyclenum=$limit[7];$contactnum=$limit[9];$smsnum=$limit[13];}
                        $startdate=dtime($fr_time,3);
                        switch ($unit){
                            case '日':$enddate=date('Y-m-d',strtotime($startdate."+$term day"));break;
                            case '月':$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                            case '季':$term=$term*3;$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                            case '年':$enddate=date('Y-m-d',strtotime($startdate."+$term year"));break;
                        }
                    }else{
                       if($t=='ajax'){echo 'error:系统配置故障，请联系管理员!';exit();}else{showmsg('系统配置故障，请联系管理员!','-1');exit();}
                    }
                    $regdate=$logindate=dtime($fr_time,6);$loginip=getip();$emailshowflag=$sendemail=$telshowflag=$mobileshowflag=$loginnum=1;
                    $sqlstr=Array('m_login','m_pwd','m_email','m_emailshowflag','m_sendemail','m_typeid','m_groupid','m_telshowflag','m_mobileshowflag','m_regdate','m_logindate','m_loginip','m_loginnum','m_integral','m_flag','m_startdate','m_enddate','m_mysendnum','m_myinterviewnum','m_myfavoritenum','m_contactnum','m_hirenum','m_expertnum','m_recyclenum','m_smsnum','m_logoflag');
                    $sqls=$sqlss='';
                    foreach($sqlstr as $v){
                        $v=str_replace('m_','',$v);
                        $sqls.="m_$v,";$sqlss.="'".cleartags($$v)."',";
                    }
                    $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
                    $db ->query("INSERT INTO {$cfg['tb_pre']}member ($sqls) VALUES($sqlss)");
                }elseif($rse == -1){$db ->query("UPDATE {$cfg['tb_pre']}member SET m_pwd='$pwd' WHERE m_login='$login'");}
                $rse = 1;
                //生成同步登录的代码
                $ucsynlogin = FR_API=='uc'?uc_user_synlogin($uid):$synlogin;
            }elseif($uid == -1) {
                //当UC不存在该用户时注册.
                if($rs&&$rse==1) {
                    $uid = FR_API=='uc'?uc_user_register($login, $ueserpwd, $rs['m_email']):uc_user_register($login, $pwd, $rs['m_email']);
                    if($uid > 0) $ucsynlogin = FR_API=='uc'?uc_user_synlogin($uid):uc_user_synlogin($uid,$login,$pwd);
                }
            }else{
                $rse = -1;
            }
        }
        if($rse==0){
			if($t=='ajax'){echo 'error:你输入的用户名['.$login.']不存在!';exit();}else{showmsg('你的用户名['.$login.']不存在!','-1');exit();}
        }else if($rse==-1){
            if($t=='ajax'){echo 'error:你输入的密码错误!';exit();}else{showmsg('你的密码错误!','-1',0,2000);exit();}
        }else{
            $rs = $db->get_one("select m_id,m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral from {$cfg['tb_pre']}member,{$cfg['tb_pre']}group where m_groupid=g_id and m_login='$login' limit 0,1");
            $typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
            if($typeid==1){$integral=$Gintegral[6];}else{$integral=$Gintegral[5];}
            $db ->query("update {$cfg['tb_pre']}member set m_loginnum=m_loginnum+1,m_logindate=NOW(),m_loginip='$ip',m_activedate=NOW() where m_login='$login'");
            $typeid==1&&$db ->query("update {$cfg['tb_pre']}resume set r_adddate=NOW() where r_mid=$rs[m_id]");
            $typeid==2&&$db ->query("update {$cfg['tb_pre']}hire set h_adddate=NOW() where h_comid=$rs[m_id] and DATEDIFF(h_enddate,'".date('Y-m-d')."')>0");
            require_once(FR_ROOT.'/inc/paylog.inc.php');
			upintegral($rs['m_id'],"登录会员中心增加积分+$integral",$integral);
            
            _setcookie('user_login',$login,3600*24);
            _setcookie('user_pass',$pwd,3600*24);
            _setcookie('user_type',usertype($typeid),3600*24);
            _setcookie('user_name',$name,3600*24);
            _setcookie('user_loginip',$loginip,3600*24);
            _setcookie('user_logindate',$logindate,3600*24);
            $goto=$goto?$goto:"{$cfg['path']}member/";
            if($t=='ajax'){echo "succeed:成功登录！".$ucsynlogin;exit();}else{showmsg('成功登录，2秒后返回！',$goto,0,2000);exit();}
        }
    }else{
        if($t=='ajax'){echo 'error:用户和密码没填写完整!';exit();}else{showmsg('用户和密码没填写完整!','-1',0,2000);exit();}
    }
}elseif($do=='loginout'){
    include_once(FR_ROOT.'/api/api_config.php');
    if(defined('UC_API')){$ucsynlogin = uc_user_synlogout();}
    _setcookie('user_login','');
    _setcookie('user_pass','');
    _setcookie('user_type','');
    _setcookie('user_name','');
    _setcookie('user_loginip','');
    _setcookie('user_logindate','');
    if($t=='ajax'){echo "succeed:退出成功！".$ucsynlogin;exit();}else{showmsg("退出成功,2秒后返回首页！","index.php",0,2000);exit();}
}
$loginverifycode=$veriArray[1];
if (isset($goto)){
    $goto=urlencode($goto);
    strpos($goto,'person')&&$reg='person';
    strpos($goto,'company')&&$reg='company';
    strpos($goto,'school')&&$reg='school';
    strpos($goto,'train')&&$reg='train';
}
require(FR_ROOT.'/inc/common.func.php');
include template('login',$reg);
?>