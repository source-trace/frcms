<?php
include_once (dirname(__FILE__)."/../config.inc.php");
define('UC_CLIENT_VERSION', '1.5.0');	//note UCenter 版本标识
define('UC_CLIENT_RELEASE', '20081212');

define('API_DELETEUSER', 1);		//用户删除 API 接口开关
define('API_RENAMEUSER', 1);		//用户名修改 API 接口开关
define('API_GETTAG', 1);		//获取标签 API 接口开关
define('API_SYNLOGIN', 1);		//同步登录 API 接口开关
define('API_SYNLOGOUT', 1);		//同步登出 API 接口开关
define('API_UPDATEPW', 1);		//更改用户密码 开关
define('API_UPDATEBADWORDS', 1);	//更新关键字列表 开关
define('API_UPDATEHOSTS', 1);		//更新HOST文件 开关
define('API_UPDATEAPPS', 1);		//更新应用列表 开关
define('API_UPDATECLIENT', 1);		//更新客户端缓存 开关
define('API_UPDATECREDIT', 1);		//更新用户积分 开关
define('API_GETCREDIT', 1);	//向 UC 提供积分 开关
define('API_GETCREDITSETTINGS', 1);	//向 UC 提供积分设置 开关
define('API_UPDATECREDITSETTINGS', 1);	//更新应用积分设置 开关

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');

define('UC_CLIENT_ROOT', FR_ROOT.'/uc_client');
include_once(FR_ROOT.'/api/api_config.php');
if(defined('IN_UC')) {
	exit('Invalid Request');
} else {

	error_reporting(0);
	set_magic_quotes_runtime(0);

	defined('MAGIC_QUOTES_GPC') || define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	$get = $post = array();

	$code = @$_GET['code'];
	parse_str(_authcode($code, 'DECODE', UC_KEY), $get);
	if(MAGIC_QUOTES_GPC) {
		$get = _stripslashes($get);
	}

	if(time() - $get['time'] > 3600) {
		exit('Authracation has expiried');
	}
	if(empty($get)) {
		exit('Invalid Request');
	}

	include_once (dirname(__FILE__)."/../uc_client/lib/xml.class.php");
	$post = xml_unserialize(file_get_contents('php://input'));
	if(in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcredit', 'getcreditsettings', 'updatecreditsettings'))) {
		$uc_note = new uc_note();
		echo $uc_note->$get['action']($get, $post);
		exit();
	} else {
		exit(API_RETURN_FAILED);
	}
}


class uc_note {

	var $dbconfig = '';
	var $db = '';
	var $tablepre = 'job_';
	var $appdir = '';

	function _serialize($arr, $htmlon = 0) {
		if(!function_exists('xml_serialize')) {
			include_once UC_CLIENT_ROOT.'./lib/xml.class.php';
		}
		return xml_serialize($arr, $htmlon);
	}

	function uc_note() {
		global $cfg;
		$this->appdir = FR_ROOT;
		$this->dbconfig = FR_ROOT.'./config.inc.php';
		$this->db = $GLOBALS['db'];
		$this->tablepre = $cfg['tb_pre'];
	}
    
	function get_uids($uids) {
		include UC_CLIENT_ROOT.'/client.php';
		$members = explode(",", $uids);
		empty($members) && exit(API_RETURN_FORBIDDEN);
		$members_username = array();
		foreach($members as $id){
			$row = uc_get_user($id,1);
			$members_username[] =  $row[1];		
		}
		$comma_temps = implode(",", $members_username);
		empty($comma_temps) && exit(API_RETURN_FORBIDDEN);
		return $comma_temps;
	}
    
	function test($get, $post) {
		return API_RETURN_SUCCEED;
	}
	
	function deleteuser($get, $post) {
		global $db;
        if(!API_DELETEUSER) {
			return API_RETURN_FORBIDDEN;
		}
		//note 用户删除 API 接口
        $uids = $this->get_uids($get['ids']);
        $query = $db->query("SELECT m_login,m_logo FROM ".$this->tablepre."member WHERE m_login IN ($uids)");
		while ($rs = $db->fetch_array($query)) {
            $db->query("delete from ".$this->tablepre."myexpert where m_pmember='$rs[m_login]' or m_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."myreceive where m_pmember='$rs[m_login]' or m_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."interview where i_pmember='$rs[m_login]' or i_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."recycle where r_pmember='$rs[m_login]' or r_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."myinterview where i_pmember='$rs[m_login]' or i_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."education where e_pmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."training where t_pmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."lang where l_pmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."work where w_pmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."letter where l_member='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."resume where r_member='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."dept where d_cmember='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."hire where h_member='$rs[m_login]'");
            //删LOGO
            $logo=$rs['m_logo'];
    		if($logo!=''&&$logo!='error.gif') unlink(FR_ROOT.$logo);
            //删形象
            $querys=$db->query("SELECT `p_filename` FROM `".$this->tablepre."picture` WHERE `p_member`='$rs[m_login]'");
            while($row=$db->fetch_array($querys)){
                $filename=$row['p_filename'];
    		    if($filename!=''&&$filename!='error.gif') unlink(FR_ROOT.$filename);
            }
            $db ->query("delete from ".$this->tablepre."picture where p_member='$rs[m_login]'");
            $db->query("delete from ".$this->tablepre."member where m_login='$rs[m_login]'");
		}
		return API_RETURN_SUCCEED;
	}
	
	function renameuser($get, $post) {
		global $db;
        if(!API_RENAMEUSER) {
			return API_RETURN_FORBIDDEN;
		}
	
		//编辑用户
		$old_username = $get['oldusername'];
		$new_username = $get['newusername'];
        
        $db->query("UPDATE ".$this->tablepre."member SET m_login='$new_username' WHERE m_login='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myexpert SET m_pmember='$new_username' WHERE m_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myexpert SET m_cmember='$new_username' WHERE m_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myreceive SET m_pmember='$new_username' WHERE m_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myreceive SET m_cmember='$new_username' WHERE m_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."interview SET i_pmember='$new_username' WHERE i_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."interview SET i_cmember='$new_username' WHERE i_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."recycle SET r_pmember='$new_username' WHERE r_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."recycle SET r_cmember='$new_username' WHERE r_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myinterview SET i_pmember='$new_username' WHERE i_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."myinterview SET i_cmember='$new_username' WHERE i_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."education SET e_pmember='$new_username' where e_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."training SET t_pmember='$new_username' where t_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."lang SET l_pmember='$new_username' where l_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."work SET w_pmember='$new_username' where w_pmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."letter SET l_member='$new_username' where l_member='$old_username'");
        $db->query("UPDATE ".$this->tablepre."resume SET r_member='$new_username' where r_member='$old_username'");
        $db->query("UPDATE ".$this->tablepre."dept SET d_cmember='$new_username' where d_cmember='$old_username'");
        $db->query("UPDATE ".$this->tablepre."hire SET h_member='$new_username' where h_member='$old_username'");
        $db->query("UPDATE ".$this->tablepre."picture SET p_member='$new_username' where p_member='$old_username'");
		return API_RETURN_SUCCEED;
	}
	
	function gettag($get, $post) {
		global $_SGLOBAL;
		
		if(!API_GETTAG) {
			return API_RETURN_FORBIDDEN;
		}
	
		$name = trim($get['id']);
		if(empty($name) || !preg_match('/^([\x7f-\xff_-]|\w)+$/', $name) || strlen($name) > 20) {
			return API_RETURN_FAILED;
		}
	
		$tag = $_SGLOBAL['db']->fetch_array($_SGLOBAL['db']->query("SELECT * FROM ".tname('tag')." WHERE tagname='$name'"));
		if($tag['closed']) {
			return API_RETURN_FAILED;
		}
	
		$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		$siteurl = 'http:'.$_SERVER['HTTP_HOST'].preg_replace("/\/+(api)?\/*$/i", '', substr($PHP_SELF, 0, strrpos($PHP_SELF, '/'))).'/';
	
		$query = $_SGLOBAL['db']->query("SELECT b.*
			FROM ".tname('tagblog')." tb, ".tname('blog')." b
			WHERE b.blogid=tb.blogid AND tb.tagid='$tag[tagid]' AND b.friend=0
			ORDER BY b.dateline DESC
			LIMIT 0,10");
		$bloglist = array();
		while($value = $_SGLOBAL['db']->fetch_array($query)) {
			$bloglist[] = array(
				'subject' => $value['subject'],
				'uid' => $value['uid'],
				'username' => $value['username'],
				'dateline' => $value['dateline'],
				'url' => $siteurl."space.php?uid=$value[uid]&amp;do=blog&amp;id=$value[blogid]",
				'spaceurl' => $siteurl."space.php?uid=$value[uid]"
			);
		}
	
		$return = array($name, $bloglist);
		return $this->_serialize($return, 1);
	}
	
	function synlogin($get, $post) {
        global $db;
		if(!API_SYNLOGIN) {
			return API_RETURN_FORBIDDEN;
		}
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        $username = $this->get_uids($get['uid']);
        $rs = $db->get_one("select m_pwd,m_typeid,m_name,m_loginip,m_logindate,g_integral from ".$this->tablepre."member,".$this->tablepre."group where m_groupid=g_id and m_login='$username' limit 1");
		if($rs){
            $ip=getip();$pwd=$rs["m_pwd"];$typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
            if($typeid==1){$integral=$Gintegral[6];}else{$integral=$Gintegral[5];}
            $db->query("update ".$this->tablepre."member set m_loginnum=m_loginnum+1,m_integral=m_integral+$integral,m_logindate=NOW(),m_loginip='$ip' where m_login='$username'");
            _setcookie('user_login',$username,3600*24);
            _setcookie('user_pass',$pwd,3600*24);
            _setcookie('user_type',usertype($typeid),3600*24);
            _setcookie('user_name',$name,3600*24);
            _setcookie('user_loginip',$loginip,3600*24);
            _setcookie('user_logindate',$logindate,3600*24);
        }
	}
	
	function synlogout($get, $post) {
        if(!API_SYNLOGOUT) {
			return API_RETURN_FORBIDDEN;
		}
		//note 同步登出 API 接口
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		_setcookie('user_login','');
        _setcookie('user_pass','');
        _setcookie('user_type','');
        _setcookie('user_name','');
        _setcookie('user_loginip','');
        _setcookie('user_logindate','');
	}
	
	function updatepw($get, $post) {
		global $db;
		if(!API_UPDATEPW) {
			return API_RETURN_FORBIDDEN;
		}
		$username = $get['username'];
        $password = $get['password'];
        $newpw = md5($password);
		$db->query("UPDATE ".$this->tablepre."member SET m_pwd='$newpw' WHERE m_login='$username'");
		return API_RETURN_SUCCEED;
	}
	
	function updatebadwords($get, $post) {
		if(!API_UPDATEBADWORDS) {
			return API_RETURN_FORBIDDEN;
		}
	
		$data = array();
		if(is_array($post)) {
			foreach($post as $k => $v) {
				$data['findpattern'][$k] = $v['findpattern'];
				$data['replace'][$k] = $v['replacement'];
			}
		}
		$cachefile = UC_CLIENT_ROOT.'./data/cache/badwords.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'badwords\'] = '.var_export($data, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);
	
		return API_RETURN_SUCCEED;
	}
	
	function updatehosts($get, $post) {
		if(!API_UPDATEHOSTS) {
			return API_RETURN_FORBIDDEN;
		}
	
		$cachefile = UC_CLIENT_ROOT.'./data/cache/hosts.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'hosts\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);
	
		return API_RETURN_SUCCEED;
	}
	
	function updateapps($get, $post) {
		if(!API_UPDATEAPPS) {
			return API_RETURN_FORBIDDEN;
		}
	
		$UC_API = '';
		if($post['UC_API']) {
			$UC_API = $post['UC_API'];
			unset($post['UC_API']);
		}
		
		$cachefile = UC_CLIENT_ROOT.'./data/cache/apps.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'apps\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		
		return API_RETURN_SUCCEED;
	}
	
	function updateclient($get, $post) {
		if(!API_UPDATECLIENT) {
			return API_RETURN_FORBIDDEN;
		}
	
		$cachefile = UC_CLIENT_ROOT.'./data/cache/settings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'settings\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);
	
		return API_RETURN_SUCCEED;
	}

	function updatecredit($get, $post) {
		global $_SGLOBAL;
		
		if(!API_UPDATECREDIT) {
			return API_RETURN_FORBIDDEN;
		}
	
		$amount = $get['amount'];
		$uid = intval($get['uid']);
	
		$_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit=credit+'$amount' WHERE uid='$uid'");
	
		return API_RETURN_SUCCEED;
	}
	
	function getcredit($get, $post) {
		global $_SGLOBAL;
		
		if(!API_GETCREDIT) {
			return API_RETURN_FORBIDDEN;
		}
	
		$uid = intval($get['uid']);
		$credit = getcount('space', array('uid'=>$uid), 'credit');
		return $credit;
	}
	
	function getcreditsettings($get, $post) {
		global $_SGLOBAL;
		
		if(!API_GETCREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}
	
		$credits = array();
		$credits[1] = array(lang('credit'), lang('credit_unit'));
	
		return $this->_serialize($credits);
	}
	
	function updatecreditsettings($get, $post) {
		global $_SGLOBAL;
		
		if(!API_UPDATECREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}
	
		$outextcredits = array();
	
		foreach($get['credit'] as $appid => $credititems) {
			if($appid == UC_APPID) {
				foreach($credititems as $value) {
					$outextcredits[$value['appiddesc'].'|'.$value['creditdesc']] = array(
						'creditsrc' => $value['creditsrc'],
						'title' => $value['title'],
						'unit' => $value['unit'],
						'ratio' => $value['ratio']
					);
				}
			}
		}
	
		$cachefile = UC_CLIENT_ROOT.'./data/cache/creditsettings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'creditsettings\'] = '.var_export($outextcredits, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);
	
		return API_RETURN_SUCCEED;
	}
}
function _authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
				return '';
			}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}

function _stripslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = _stripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}
?>