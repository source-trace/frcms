<?php
require(dirname(__FILE__).'/config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
if(_getcookie('user_login')!=""){
    $logincode="<li>欢迎"._getcookie('user_login')."登录会员中心。</li>";
    $logincode.="<li>上次登录IP为："._getcookie('user_loginip')."</li>";
    $logincode.="<li>上次登录时间："._getcookie('user_logindate')."</li>";
    if($t=='ajax'){
        $logincode.="<li>请选择您需要的操作： <img src=\"{$cfg['path']}skin/system/loginout.gif\" style=\"cursor: pointer;\" width=\"79\" height=\"30\" border=\"0\" align=\"absmiddle\" onclick=\"Check_loginout('{$cfg['path']}');\" /></li>";
    }else{
        $logincode.="<li>请选择您需要的操作： <a href=\"{$cfg['path']}login.php?do=loginout\"><img src=\"{$cfg['path']}skin/system/loginout.gif\" width=\"79\" height=\"30\" border=\"0\" align=\"absmiddle\" /></a></li>";
    }
    if(_getcookie('user_type')=='pmember'){
        $logincode.="<ul>";
        $logincode.="<li><a href=\"{$cfg['path']}member\">进入会员中心</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?do=refresh\">刷新简历</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=person_resume&show=1\">修改简历</a></li>";
        $logincode.="<li><a href=\"{$cfg['path']}member/?mpage=person_interview&show=2\">查看面试通知</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=person_searchhire&show=3\">查询职位</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=person_info&show=0\">修改资料</a></li>";
        $logincode.="</ul>";
    }elseif(_getcookie('user_type')=='cmember'){
        $logincode.="<ul>";
        $logincode.="<li><a href=\"{$cfg['path']}member\">进入会员中心</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=company_pwd&show=4\">修改密码</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=company_info&show=0\">修改资料</a></li>";
        $logincode.="<li><a href=\"{$cfg['path']}member/?mpage=company_works&show=1\">查看应聘简历</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=company_hirelist&show=1\">职位管理</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=onlinepay&m=main&show=0\">充值管理</a></li>";
        $logincode.="</ul>";
    }elseif(_getcookie('user_type')=='smember'){
        $logincode.="<ul>";
        $logincode.="<li><a href=\"{$cfg['path']}member\">进入会员中心</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=school_pwd&show=5\">修改密码</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=school_info&show=0\">修改资料</a></li>";
        $logincode.="<li><a href=\"{$cfg['path']}member/?mpage=requires_list&show=4\">招生简章管理</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=department_list&show=1\">专业管理</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=onlinepay&m=main&show=0\">充值管理</a></li>";
        $logincode.="</ul>";
    }elseif(_getcookie('user_type')=='tmember'){
        $logincode.="<ul>";
        $logincode.="<li><a href=\"{$cfg['path']}member\">进入会员中心</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=train_pwd&show=4\">修改密码</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=train_info&show=0\">修改资料</a></li>";
        $logincode.="<li><a href=\"{$cfg['path']}member/?mpage=signup_list&show=3\">查看报名信息</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=course_list&show=1\">课程管理</a>&nbsp;&nbsp;<a href=\"{$cfg['path']}member/?mpage=onlinepay&m=main&show=0\">充值管理</a></li>";
        $logincode.="</ul>";
    }
            
}else{
    $logincode="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
    if($t=='ajax'){
        $logincode.="<form name=\"loginform\">";
    }else{
        $logincode.="<form name=\"loginform\" action=\"{$cfg['path']}login.php?do=login&goto={$cfg['path']}index.php\" method=\"post\" onsubmit=\"return check();\">";
    }
    $logincode.="<tr>";
    $logincode.="<td>用户名 <input name=\"login\" type=\"text\" class=\"loginbgs\" id=\"login\" tabindex=\"1\" /></td>";
    if($t=='ajax'){
        $logincode.="<td width=\"60\" rowspan=\"2\"><input type=\"button\" name=\"Submit\" class=\"loginbg\" tabindex=\"4\" value=\"登录\" onclick=\"Check_login('{$cfg['path']}',$veriArray[1]);\"/></td>";
    }else{
        $logincode.="<td width=\"60\" rowspan=\"2\"><input type=\"submit\" name=\"Submit\" class=\"loginbg\" tabindex=\"4\" value=\"登录\"/></td>";
    }
    $logincode.="</tr>";
    $logincode.="<tr>";
    $logincode.="<td>密　码 <input name=\"pwd\" type=\"password\" class=\"pwdbg\" id=\"pwd\" tabindex=\"2\" /></td>";
    $logincode.="</tr>";
    if($veriArray[1]==1){
        $logincode.="<tr>";
        $logincode.="<td>验证码 <input type=\"text\" name=\"verifycode\" class=\"veribgs\" tabindex=\"3\" title=\"输入右侧图片所示字符,不区分大小写\"> <img id=\"v\" src=\"{$cfg['path']}inc/verifycode.php\"  alt=\"验证码,看不清楚?请点击刷新验证码\" align=\"absmiddle\" style=\"cursor : pointer;\" onClick=\"this.src=this.src+'?'+Math.random();\" /></td>";
        $logincode.="<td><a href=\"{$cfg['path']}plus/connect/qzone.php?do=redirect\"><img src=\"{$cfg['path']}plus/connect/img/Connect_logo_7.png\"></a></td>";
        $logincode.="</tr>";
    }else{
        
    }
    $logincode.="<tr>";
    $logincode.="<td height=\"48\" colspan=\"2\" align=\"left\"><a href=\"{$cfg['path']}register.php?person\"><img src=\"{$cfg['path']}skin/{$cfg['skin']}/perreg.gif\" width=\"110\" height=\"32\" border=\"0\" /></a>&nbsp;&nbsp;<a href=\"{$cfg['path']}register.php?company\"><img src=\"{$cfg['path']}skin/{$cfg['skin']}/comreg.gif\" width=\"110\" height=\"32\" border=\"0\" /></a></td>";
    $logincode.="</tr>";
    $logincode.="<tr>";
    $logincode.="<td height=\"48\" colspan=\"2\" align=\"left\"><div class=\"membercount\">";
    $logincode.="<li>个人会员：<font color=\"#FF0000\">".getmembercount(1)."</font></li>";
    $logincode.="<li>企业会员：<font color=\"#FF0000\">".getmembercount(2)."</font></li>";
    $logincode.="<li>今日新增简历：<font color=\"#FF0000\">".getmembercount(3)."</font></li>";
    $logincode.="<li>今日新增职位：<font color=\"#FF0000\">".getmembercount(4)."</font></li>";
    $logincode.="</div></td>";
    $logincode.="</tr>";
    $logincode.="</form>";
    $logincode.="</table>";
}
if($t=='ajax'){
    echo $logincode;
}else{
    $logincode=addslashes($logincode);
    $logincode=str_replace("\'","'",$logincode);
    echo "document.write(\"$logincode\");";
}
?>