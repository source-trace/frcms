<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='savelogin'){
	if(empty($login)||empty($pass)){
		showmsg('请输入用户名密码！',"-1",0,2000);exit();
	}else{
		if($login==$username){
			showmsg('新用户名与原用户名相同，请重新输入！',"-1",0,2000);exit();
		}else{
			$rs = $db->get_one("select m_login from {$cfg['tb_pre']}member where m_login='$login' limit 0,1");
			if($rs){
				showmsg('新用户名已被占用，请重新输入！',"-1",0,2000);exit();
			}
			$rs = $db->get_one("select m_login from {$cfg['tb_pre']}member where m_login='$username' and m_pwd='".md5($pass)."' limit 0,1");
			if($rs){
				$db ->query("update {$cfg['tb_pre']}myfavorite set f_pmember='$login' where f_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}interview set i_pmember='$login' where i_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}mysend set s_pmember='$login' where s_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}education set e_pmember='$login' where e_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}training set t_pmember='$login' where t_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}lang set l_pmember='$login' where l_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}work set w_pmember='$login' where w_pmember='$username'");
				$db ->query("update {$cfg['tb_pre']}picture set p_member='$login' where p_member='$username'");
				$db ->query("update {$cfg['tb_pre']}letter set l_member='$login' where l_member='$username'");
				$db ->query("update {$cfg['tb_pre']}resume set r_member ='$login' where r_member ='$username'");
				$db ->query("update {$cfg['tb_pre']}member set m_login='$login' where m_login='$username'");
				_setcookie('user_login',$login,3600*24);	
				showmsg('用户名修改成功!',"?mpage=person_pwd&show=$show",0,2000);exit();
			}else{
				showmsg('原密码错误，请重新输入！',"-1",0,2000);exit();
			}
		}
	}
}elseif($do=='savepwd'){
	if(empty($opwd)||empty($pwd)){
		showmsg('用户名密码输入不完整！',"-1",0,2000);exit();
	}else{
		if($opwd==$pwd){
			showmsg('新密码与原密码相同，请重新输入！',"-1",0,2000);exit();
		}else{
			if($pwd!=$repwd){
				showmsg('新密码与确认密码不同，请重新输入！',"-1",0,2000);exit();
			}else{
				$rs = $db->get_one("select m_login from {$cfg['tb_pre']}member where m_login='$username' and m_pwd='".md5($opwd)."' limit 0,1");
				if($rs){
				    //UC整合
				    include_once(FR_ROOT.'/api/api_config.php');
                    if(defined('UC_API')){
                        if(FR_API=='uc'){
                            $ucresult = uc_user_edit($username, $opwd, $pwd, '');
                        }else{
                            extract(uc_user_get($username));
                            $ucresult = uc_user_edit($uid, $username, '', md5($pwd), '');
                        }
                    }
					$db ->query("update {$cfg['tb_pre']}member set m_pwd='".md5($pwd)."' where m_login='$username'");
					_setcookie('user_pass',md5($pwd),3600*24);
                    showmsg('用户密码修改成功！',"?mpage=person_pwd&show=$show",0,2000);exit();
                exit();
				}else{
					showmsg('原密码错误，请重新输入！',"-1",0,2000);exit();
				}
			}
		}
	}
}
?>
<script type="text/javascript">
$.validator.methods.islogin=function(value, element) {    
	var tel = /^([A-Za-z0-9_@.-]|[\u4e00-\u9fa5]){4,20}$/;
	return tel.test(value);}
$().ready(function() {
	$("#loginform").validate({
		success: function(label) {
			label.text("输入正确!").addClass("success");
		}, 
		rules: {
			login: {islogin: true,remote: {url: "<?php echo $cfg['path'];?>register.php?do=check",type: "post",dataType: "json", data: {login: function() {return $("#login").val();}}}},
			pass: {required: true,minlength: 4,maxlength: 20}
		},
		messages: {
			login: {
				islogin:"用户名要求长度为4-20位(可用汉字、字母、数字、下划线;)",
				remote:"用户用已被占用，请重新输入"
			},
			pass: "用户密码须4-20位之间，区分大小写"
		}
	});
	$("#pwdform").validate({
		success: function(label) {
			label.text("输入正确!").addClass("success");
		}, 
		rules: {
			opwd: {required: true},
			pwd: {required: true,minlength: 4,maxlength: 20},
			repwd: {required: true,minlength: 4,maxlength: 20,equalTo: "#pwd"}
		},
		messages: {
			opwd: "用户密码须4-20位之间，区分大小写",
			pwd: "用户密码须4-20位之间，区分大小写",
			repwd: {
				required: "请再次输入密码",
				minlength: "用户密码须4-20位之间，区分大小写",
				equalTo: "两次输入密码必须一致"
			}
		}
	});
});
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>修改用户名/密码</div>
    <div class="memrightbox">
    	<div class="msg"><li></li></div>
    	<div class="con">
        <?php 
        include_once(FR_ROOT.'/api/api_config.php');
        if(defined('UC_API')){}else{?>
        <form method="post" name="loginform" id="loginform" action="?do=savelogin&mpage=person_pwd&show=<?php echo $show;?>">
        <ul>
        	<li class="t">修改用户名 <span style="color:#F00">*为必填</span></li>
            <hr />
            <li class="l"><span style="color:#F00">*</span> 原用户名：</li>
            <li class="r"><?php echo $username;?></li>
            <li class="l"><span style="color:#F00">*</span> 新用户名：</li>
            <li class="r"><input name="login" type="text" id="login" value="" /><br />
            1、建议您不要轻易修改用户名；如果确实需要修改，请牢记；<br /> 
			2、用户名要求长度为4-20位；<br />
			3、用户名只能使用汉字、字母、数字以及 - 和_。</li>
            <li class="l"><span style="color:#F00">*</span> 原密码：</li>
            <li class="r"><input name="pass" type="password" id="pass"  value="" /></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="修改用户名" /></label></li>            
        </ul>
        </form>
        <?php }?>
        <form method="post" name="pwdform" id="pwdform" action="?do=savepwd&mpage=person_pwd&show=<?php echo $show;?>">
        <ul>
        	<li class="t">修改密码</li>
        	<hr />
            <li class="l"><span style="color:#F00">*</span> 原密码：</li>
            <li class="r"><input name="opwd" type="password" id="opwd"  value="" /><br />
            1、请输入原来的密码以便进行帐户确认。</li>
            <li class="l"><span style="color:#F00">*</span> 新密码：</li>
            <li class="r"><input name="pwd" type="password" id="pwd"  value="" /><br />
            1、用户密码须4-20位之间，区分大小写；<br />
            2、新密码只能使用字母、数字以及 - 和 _ ，并且不能使用汉字。</li>
            <li class="l"><span style="color:#F00">*</span> 确认密码：</li>
            <li class="r"><input name="repwd" type="password" id="repwd" value="" /></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="修改密码" /></label></li>            
        </ul>
        </form>
        </div>
        </div>
</div>