<?php

!defined('P_W') && exit('Forbidden');
//api mode 1

define('API_USER_USERNAME_NOT_UNIQUE', 100);

class User {

	var $base;
	var $db;

	function User($base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function getInfo($uids, $fields = array()) {
		if (!$uids) {
			return new ApiResponse(false);
		}
		require_once(R_P.'require/showimg.php');

		$uids = is_numeric($uids) ? array($uids) : explode(",",$uids);

		if (!$fields) $fields = array('uid', 'username', 'icon', 'gender', 'location', 'bday');
		
		$userService = L::loadClass('UserService', 'user'); /* @var $userService PW_UserService */
		$users = array();
		foreach ($userService->getByUserIds($uids) as $rt) {
			list($rt['icon']) = showfacedesign($rt['icon'], 1, 'm');
			$rt_a = array();
			foreach ($fields as $field) {
				if (isset($rt[$field])) {
					$rt_a[$field] = $rt[$field];
				}
			}
			$users[$rt['uid']] = $rt_a;
		}
		return new ApiResponse($users);
	}

	function alterName($uid, $newname, $oldname) {
		$userService = L::loadClass('UserService', 'user'); /* @var $userService PW_UserService */
		$userName = $userService->getUserNameByUserId($uid);
		if (!$userName || $userName == $newname) {
			return new ApiResponse(1);
		}
		$existUserId = $userService->getUserIdByUserName($newname);
		if ($existUserId) {
			return new ApiResponse(API_USER_USERNAME_NOT_UNIQUE);
		}
		$userService->update($uid, array('username' => $newname));

		$user = L::loadClass('ucuser', 'user');
		$user->alterName($uid, $userName, $newname);

		return new ApiResponse(1);
	}

	function deluser($uids) {
		$user = L::loadClass('ucuser', 'user');
		$user->delUserByIds($uids);

		return new ApiResponse(1);
	}

	function synlogin($user) {
		global $timestamp,$uc_key,$cfg,$db;
		list($winduid, $windid, $windpwd) = explode("\t", $this->base->strcode($user, false));
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        $username=$windid;
        $rs = $db->get_one("select m_pwd,m_typeid,m_name,m_loginip,m_logindate,g_integral from {$cfg['tb_pre']}member,{$cfg['tb_pre']}group where m_groupid=g_id and m_login='$username' limit 1");
        if($rs){
            $ip=getip();$pwd=$rs["m_pwd"];$typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
            if($typeid==1){$integral=$Gintegral[6];}else{$integral=$Gintegral[5];}
            $db->query("update {$cfg['tb_pre']}member set m_loginnum=m_loginnum+1,m_integral=m_integral+$integral,m_logindate=NOW(),m_loginip='$ip' where m_login='$username'");
            _setcookie('user_login',$username,3600*24);
            _setcookie('user_pass',$pwd,3600*24);
            _setcookie('user_type',usertype($typeid),3600*24);
            _setcookie('user_name',$name,3600*24);
            _setcookie('user_loginip',$loginip,3600*24);
            _setcookie('user_logindate',$logindate,3600*24);
        }
		return '';
	}

	function synlogout() {
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		_setcookie('user_login','');
        _setcookie('user_pass','');
        _setcookie('user_type','');
        _setcookie('user_name','');
        _setcookie('user_loginip','');
        _setcookie('user_logindate','');
		return '';
	}
    function getusergroup() {
        $usergroup = array();
        $query = $this->db->query("SELECT gid,gptype,grouptitle FROM pw_usergroups ");
        while($rt= $this->db->fetch_array($query)) {
            $usergroup[$rt['gid']] = $rt;
        }
        return new ApiResponse($usergroup);
    }
}
?>