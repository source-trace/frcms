<?php
require(dirname(__FILE__).'/config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
if(_getcookie('user_login')!=""){
    $logincode="<li>欢迎"._getcookie('user_login')."登录会员中心。</li>";
    $logincode.="<ul>";
    $logincode.="<li><a href=\"".$cfg['path']."member\">会员中心</a>&nbsp;&nbsp;<a href=\"".$cfg['path']."member/?mpage=onlinepay&m=main&show=0&p=onlinepay\">在线充值</a>&nbsp;&nbsp;<a href=\"".$cfg['path']."login.php?do=loginout\">安全退出</a></li>";
    $logincode.="</ul>";
}else{
?>
function fnRemoveBrank(strSource){
 return strSource.replace(/^\s*/,'').replace(/\s*$/,'');
}
function check(myform){
	if(fnRemoveBrank(myform.login.value)==""){
		alert("请输入用户名！");
		myform.login.focus();
		return(false);
	}
	if(myform.pwd.value==""){
		alert("请输入密码！");
		myform.pwd.focus();
		return(false);
	}
}
function loginout(){
	if(confirm("确定要退出吗？")){
    	location.href ="<?php echo $cfg['path'];?>login.php?do=loginout";
    }
}
function getpwd(){
	location.href="<?php echo $cfg['path'];?>getpassword.php";
}
function regmember(){
	location.href ="<?php echo $cfg['path'];?>register.php?<?php echo $reg;?>";
}
<?php
    $logincode="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"logintab\">";
    $logincode.="<form action=\"{$cfg['path']}login.php?do=login\" method=\"post\" name=\"loginform\" id=\"loginform\" onSubmit=\"return check(this);\">";
    $logincode.="<tr>";
    $logincode.="<td width=\"170\">用户名：<input name=\"login\" type=\"text\" class=\"inputl\"  /></td>";
    $logincode.="</tr>";
    $logincode.="<tr>";
    $logincode.="<td>密　码：<input name=\"pwd\" type=\"password\" class=\"inputl\" /></td>";
    $logincode.="</tr>";
//    if($veriArray[1]==1){
//        $logincode.="<tr>";
//        $logincode.="<td>验证码：<input type=\"text\" name=\"verifycode\" class=\"veribgs\" tabindex=\"3\" title=\"输入右侧图片所示字符,不区分大小写\"> <img id=\"v\" src=\"{$cfg['path']}inc/verifycode.php\"  alt=\"验证码,看不清楚?请点击刷新验证码\" align=\"absmiddle\" style=\"cursor : pointer;\" onClick=\"this.src=this.src+'?'+Math.random();\" /></td>";
//        $logincode.="</tr>";
//    }
    $logincode.="<tr>";
    $logincode.="<td><input type=\"submit\" name=\"button\" id=\"button\" value=\"立即登录\" /></td>";
    $logincode.="</tr>";
    $logincode.="<tr>";
    $logincode.="<td><a href=\"#\" onclick=\"regmember();\">免费注册会员</a> <a href=\"#\" onclick=\"getpwd();\">忘记密码</a></td>";
    $logincode.="</tr>";
    $logincode.="</form>";
    $logincode.="</table>";
}
$logincode=addslashes($logincode);
$logincode=str_replace("\'","'",$logincode);

echo "document.write(\"$logincode\");";
?>