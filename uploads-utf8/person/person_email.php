<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='saveemail'){
	if(empty($email)){
		showmsg('请输入新邮箱地址！',"-1",0,2000);exit();
	}else{
        $rs = $db->get_one("select m_login from {$cfg['tb_pre']}member where m_email='$email' and m_login!='$username' limit 0,1");
	       if($rs){
	           showmsg('新邮箱地址已被占用，请重新输入！',"-1",0,2000);exit();
            }else{
                //UC整合
                include_once(FR_ROOT.'/api/api_config.php');
                if(defined('UC_API')){
                    if(FR_API=='uc'){
                        $ucresult = uc_user_edit($username, '', '', $email, 1);
                    }else{
                        extract(uc_user_get($username));
                        $ucresult = uc_user_edit($uid, $username, '', '', $email);
                    }
                }
                if(isset($sendmail)&&$sendmail==1){$sendemail=1;}else{$sendemail=0;}
                $db ->query("update {$cfg['tb_pre']}member set m_email='$email',m_sendemail=$sendemail where m_login='$username'");
                //同步简历中的邮箱
                $db ->query("update {$cfg['tb_pre']}resume set r_email='$email' where r_member='$username'");
                showmsg('邮箱修改成功!',"?mpage=person_email&show=$show",0,2000);exit();
	       }
	}
}
$rs = $db->get_one("select m_email from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
if($rs){
    $useremail=$rs['m_email'];
}
?>
<script type="text/javascript">
$().ready(function() {
	$("#addform").validate({
		success: function(label) {
			label.text("输入正确!").addClass("success");
		}, 
		rules: {
			email: {required: true,email: true,maxlength: 100,remote: {url: "<?php echo $cfg['path'];?>register.php?do=check",type: "post",dataType: "json", data: {email: function() {return $("#email").val();}}}}
		},
		messages: {
			email: {
				required: "E-mail地址为必填项",
				email: "请填写有效的E-mail地址",
				maxlength: "E-mail地址不得超出100个字符",
				remote: "E-mail已被占用，请重新输入"
			}
		}
	});
});
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>修改Email</div>
    <div class="memrightbox">
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="addform" id="addform" action="?do=saveemail&mpage=person_email&show=<?php echo $show;?>">
        <ul>
        	<li class="t">修改Email <span style="color:#F00">*为必填</span></li>
            <hr />
            <li class="l"><span style="color:#F00">*</span> 原邮箱地址：</li>
            <li class="r"><?php echo $useremail;?></li>
            <li class="l"><span style="color:#F00">*</span> 新邮箱地址：</li>
            <li class="r"><input name="email" type="text" id="email" value="" /><br />
            1、请填写有效的E-mail地址</li>
            <li class="l"></li>
            <li class="r"><input name="sendmail" type="checkbox" style="width:20px;" value="1" checked="checked" />接受来自本站的消息邮件 。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="修改邮箱" /></label></li>            
        </ul>
        </form>
        </div>
    </div>
</div>