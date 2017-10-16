<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
$username=_getcookie('user_login');
$usertype=_getcookie('user_type');
//取权限
$Glimit=$Gintegral=Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
if($username!=''){
    $rs = $db->get_one("select m_id,m_flag,DATEDIFF(m_enddate,'".date('Y-m-d')."') as end,m_contactnums,m_contactnum,g_limit,g_integral from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_login='$username' limit 0,1");
    if($rs){
        $mflag=$rs['m_flag'];$mend=$rs['end'];$Mcontactnums=$rs['m_contactnums'];$Mcontactnum=$rs['m_contactnum'];$Memberid=$rs['m_id'];
        $Glimit=explode(",",$rs['g_limit']);$Gintegral=explode(",",$rs['g_integral']);
        if($mend<0){
            echo "<font color='#ff0000'><b>您的会员服务已过期，未续费升级前您将无法查看联系方式，请尽快续费升级!</b></font>";exit();
        }
    }
}
$companyid=isset($companyid)?intval($companyid):0;
$hireid=isset($hireid)?intval($hireid):0;
$resumeid=isset($resumeid)?intval($resumeid):0;
$issee=isset($issee)?intval($issee):0;
if($companyid!=0){    
    if($hireid!=0){
        $db ->query("update {$cfg['tb_pre']}hire set h_visitcount=h_visitcount+1 where h_id=$hireid and h_comid=$companyid");
        $goto=$cfg['path']."company/hire.php?hireid=$hireid";
        $rs = $db->get_one("select h_address,h_post,h_contact,h_telshowflag,h_tel,h_fax,h_emailshowflag,h_email,h_member,m_mobile,m_mobileshowflag,m_url,m_chat from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_comid=m_id where h_id=$hireid and h_comid=$companyid");
		if($rs){
            $Comaddress=$rs['h_address'];$Compost=$rs['h_post'];$Comcontact=$rs['h_contact'];
			$Comtelshowflag=$rs['h_telshowflag'];$Comtel=$rs['h_tel'];$Comfax=$rs['h_fax'];
            $Comemailshowflag=$rs['h_emailshowflag'];$Comemail=$rs['h_email'];$ComMemberlogin=$rs['h_member'];
            $Commobile=$rs['m_mobile'];$Commobileshowflag=$rs['m_mobileshowflag'];$Comurl=$rs['m_url'];$Comchat=$rs['m_chat'];
		}else{
            echo "联系方式读取出错!";exit;
		}
    }else{
        $db ->query("update {$cfg['tb_pre']}member set m_hits=m_hits+1 where m_id=$companyid");
        $goto=$cfg['path']."company/company.php?comid=$companyid";
        $rs = $db->get_one("select m_address,m_post,m_contact,m_telshowflag,m_tel,m_fax,m_emailshowflag,m_email,m_mobile,m_mobileshowflag,m_url,m_chat from {$cfg['tb_pre']}member where m_id=$companyid");
		if($rs){
            $Comaddress=$rs['m_address'];$Compost=$rs['m_post'];$Comcontact=$rs['m_contact'];
			$Comtelshowflag=$rs['m_telshowflag'];$Comtel=$rs['m_tel'];$Comfax=$rs['m_fax'];
            $Comemailshowflag=$rs['m_emailshowflag'];$Comemail=$rs['m_email'];$ComMemberlogin=$rs['m_login'];
            $Commobile=$rs['m_mobile'];$Commobileshowflag=$rs['m_mobileshowflag'];$Comurl=$rs['m_url'];$Comchat=$rs['m_chat'];
		}else{
            echo "联系方式读取出错!";exit;
		}
    }
    $member_name=_getcookie("user_name");$Show=0;$bid=$hireid!=0?$hireid:$companyid;$type=$hireid!=0?3:2;
    if($username==''){$member_login="访客";$member_name="访客";}else{$member_login=$username;}
    $db ->query("Insert into {$cfg['tb_pre']}rbrower(r_bid,r_bmember,r_member,r_adddate,r_name,r_type) values('$bid','$ComMemberlogin','$member_login',NOW(),'$member_name',$type)");
    if($cfg['comcontact']==1){
        $Show=1;
    }else{
        if($username!=""&&$usertype=='pmember'){
            if($mflag==0){
                echo "<font color='#ff0000'>您的帐号还没有通过审核，无权查看联系方式!请联系客服中心进行帐号审核!</font>";exit();
            }
            if($Glimit[10]&&(($Glimit[11]&&$Mcontactnum>0)||$Glimit[11]==0)){
                if($cfg['seecontact']==1&&$issee==0){
                    if($hireid!=0){
                        echo "<li><font color='#ff0000'>友情提醒：请确定您要查看该职位的联系方式，请点击<a style=\"cursor:pointer\" onClick=\"Contact($companyid,$hireid,1);\"><img src=\"../skin/system/seebtn.gif\" width=\"127\" height=\"31\" border=\"0\" /></a></font></li>";exit();
                    }else{
                        echo "<li><font color='#ff0000'>友情提醒：请确定您要查看该企业联系方式，请点击<a style=\"cursor:pointer\" onClick=\"Contact($companyid,1);\"><img src=\"../skin/system/seebtn.gif\" width=\"127\" height=\"31\" border=\"0\" /></a></font></li>";exit();
                    }
                }else{
                    $sqladd=$Glimit[11]?",m_contactnum=m_contactnum-1":'';
                    $db ->query("update {$cfg['tb_pre']}member set m_contactnums=m_contactnums+1$sqladd where m_login='$username'");
                    $Show=1;
                }
            }else{
                echo "<font color='#ff0000'><b>您所在的用户组无权查看联系方式或者您的系统服务已经达到上限!请联系客服中心进行帐号升级!</b></font>";exit;
            }
		}else{
			echo "<li><font color=\"#ff0000\"><B>个人会员登录查看联系方式：</B></font></li>";
			echo "<form name=\"form1\">";
			echo "<li>用户名：<input name=login id=\"login\" style=\"FONT-SIZE: 12px; FONT-FAMILY: Verdana\" size=18 maxlength=20>&nbsp;&nbsp;&nbsp;&nbsp;密&nbsp;&nbsp;码：<input name=pwd type=password id=\"pwd\" style=\"FONT-SIZE: 12px; FONT-FAMILY: Verdana\" size=18 maxlength=20>&nbsp;&nbsp;&nbsp;<input name=submit type=\"button\" class=\"inputs\" value=\"登录\" onclick=\"check(this.form,$companyid,$hireid);\"></li></form>";
			echo "<li>如果您还没有注册，请点击右侧按钮进行注册！<input name=regnow type='button' class='inputs' value='个人会员注册' onClick=\"window.location='$cfg[path]register.php?person'\"></li>";
            exit;
		}
    }
    if($Show==1){
        if($Comaddress!='') echo "<li>通信地址：$Comaddress($Compost)</li>\r\n";
        if($Comcontact!='') echo "<li>联 系 人：$Comcontact</li>\r\n";
        if($Commobile!=''&&$Commobileshowflag!=0) echo "<li>手机号码：$Commobile</li>\r\n";
        if($Comtel!=''){
            echo "<li>联系电话：";
            if($Comtelshowflag==0){
                echo "（合则约见、谢绝来电）";
            }else{
                echo $Comtel;
            }
            echo "</li>\r\n";
        }
        if($Comfax!='') echo "<li>传　　真：$Comfax</li>\r\n";
        if($Comemail!=''){
            echo "<li>电子邮件：";
            if($Comemailshowflag==0){
                echo "（请通过系统发送应聘意向）";
            }else{
                echo $Comemail;
            }
            echo "</li>\r\n";
        }
        if($Comurl!='') echo "<li>网站地址：<a href=\"$Comurl\" target=\"_blank\">$Comurl</a></li>\r\n";
        if($Comchat!='') echo "<li>QQ 咨 询：<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=$Comchat&site=$cfg[sitename]&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:$Comchat:42\" alt=\"点击这里给我发消息\" title=\"点击这里给我发消息\"></a></li>\r\n";
        echo "<li>注：请在邮件中注明应聘职位的名称或编号，并注明该招聘信息来源于$cfg[sitename]。</li>\r\n";
    }
}
if($resumeid!=0){
    $db ->query("update {$cfg['tb_pre']}resume set r_visitnum=r_visitnum+1 where r_id=$resumeid");
    $goto=$cfg['path']."person/cnresume_view.php?rid=$resumeid";
    $rs = $db->get_one("select r_member,r_name,r_sex,r_birth,r_edu,r_tel,r_mobile,r_chat,r_email,r_url,r_address,r_post from {$cfg['tb_pre']}resume where r_id=$resumeid");
	if($rs){
	   $PerResumetel=$rs['r_tel'];$PerResumemobile=$rs['r_mobile'];$PerResumechat=$rs['r_chat'];$PerResumeemail=$rs['r_email'];
       $PerResumeurl=$rs['r_url'];$PerResumeaddress=$rs['r_address'];$PerResumepost=$rs['r_post'];
       $PerMemberlogin=$rs['r_member'];$PerResumename=$rs['r_name'];$PerResumesex=$rs['r_sex'];
       $PerResumebirth=$rs['r_birth'];$PerResumeedu=$rs['r_edu'];
	}else{
	   echo "联系方式读取出错!";exit;
	}
    //记录简历被浏览
    $member_name=_getcookie("user_name");$Show=0;
    if($username==''){$member_login="访客";$member_name="访客";}else{$member_login=$username;}
    $db ->query("Insert into {$cfg['tb_pre']}rbrower(r_bid,r_bmember,r_member,r_adddate,r_name,r_type) values('$resumeid','$PerMemberlogin','$member_login',NOW(),'$member_name',1)");
    if($cfg['percontact']==1){
        $Show=1;
    }else{
        if($username!=''&&$usertype=='cmember'){
            if($mflag==0){
                echo "<font color='#ff0000'>您的帐号还没有通过审核，无权查看联系方式!请联系客服中心进行帐号审核!</font>";exit();
            }
            $rs = $db->get_one("select * from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_rid=$resumeid and m_down=1");
            if($rs){
                $Show=1;
            }else{
                if($Glimit[8]&&(($Glimit[9]&&$Mcontactnum>0)||$Glimit[9]==0)){
                    if($cfg['seecontact']==1&&$issee==0){
                        echo "<li><font color='#ff0000'>友情提醒：如果该人才符合贵公司招聘要求，请点击<a style=\"cursor:pointer\" onClick=\"Contact($resumeid,1);\"><img src=\"../skin/system/seebtn.gif\" width=\"127\" height=\"31\" border=\"0\" /></a></font></li>";exit();
                    }else{
                        $sqladd=$Glimit[9]?",m_contactnum=m_contactnum-1":'';
                        $db ->query("update {$cfg['tb_pre']}member set m_contactnums=m_contactnums+1$sqladd where m_login='$username'");
                        $integral=$Gintegral[3];
                		require_once(FR_ROOT.'/inc/paylog.inc.php');
                		upintegral($Memberid,"查看并下载【{$PerResumename}】的简历获得积分+$integral",$integral);
						$drs=$db->get_one("select * from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_rid=$resumeid");
                        if($drs){
                            $db ->query("update {$cfg['tb_pre']}myexpert set m_down=1,m_downdate=NOW() where m_cmember='$username' and m_rid=$resumeid and m_down!=1");
                        }else{
                            $db ->query("Insert into {$cfg['tb_pre']}myexpert (m_rid,m_name,m_sex,m_birth,m_edu,m_cmember,m_pmember,m_adddate,m_down,m_downdate)
                             values('$resumeid','$PerResumename','$PerResumesex','$PerResumebirth','$PerResumeedu','$username','$PerMemberlogin',NOW(),1,NOW())");
                        }
                        $Show=1;
                    }
                }else{
                    echo "<font color='#ff0000'>您现在所购买的服务无权查看联系方式!请联系客服中心进行帐号升级!</font>";exit();
                }
            }
        }else{
            echo "<li><font color=\"#ff0000\"><B>企业会员登录查看联系方式：</B></font></li>";
            echo "<form name=\"form1\">";
            echo "<li>用户名：<input name=\"login\" id=\"login\" style=\"FONT-SIZE: 12px; FONT-FAMILY: Verdana\" size=18 maxlength=20>&nbsp;&nbsp;&nbsp;&nbsp;密&nbsp;&nbsp;码：<input name=pwd type=password id=\"pwd\" style=\"FONT-SIZE: 12px; FONT-FAMILY: Verdana\" size=18 maxlength=20>&nbsp;&nbsp;&nbsp;<input name=submit type=\"button\" class=\"inputs\" value=\"登录\" onclick=\"check(this.form,$resumeid);\"></li></form>";
            echo "<li>如果您还没有注册，请点击右侧按钮进行注册！<input name=regnow type='button' class='inputa2' value='　企业会员注册　' onClick=\"window.location='$cfg[path]register.php?company'\"></li>";
            exit;
        }
    }
    if($Show==1){
        if($PerResumetel!='') echo "<li>联系电话：$PerResumetel</li>\r\n";
        if($PerResumemobile!='') echo "<li>手机号码：$PerResumemobile</li>\r\n";
        if($PerResumeemail!='') echo "<li>电子邮件：$PerResumeemail</li>\r\n";
        if($PerResumeurl!='') echo "<li>个人主页：<a href=\"$PerResumeurl\" target=\"_blank\">$PerResumeurl</a></li>";
        if($PerResumeaddress!='') echo "<li>联系地址：$PerResumeaddress($PerResumepost)</li>\r\n";
        if($PerResumechat!='') echo "<li>QQ 交 谈：<a target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=$PerResumechat&site=$cfg[sitename]&menu=yes\"><img border=\"0\" src=\"http://wpa.qq.com/pa?p=2:$PerResumechat:42\" alt=\"点击这里给我发消息\" title=\"点击这里给我发消息\"></a></li>\r\n";
    }
}
?>