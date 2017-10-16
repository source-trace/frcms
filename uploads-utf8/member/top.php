<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
echo "<div class=\"memtop\">\r\n";
echo "  <div class=\"memtophy\"><span><a href=\"{$cfg['siteurl']}{$cfg['path']}\" target=\"_blank\">返回首页</a> <a href=\"{$cfg['siteurl']}{$cfg['path']}guestbook\" target=\"_blank\">我要提建议</a>  <a href=\"index.php\">会员中心</a>  ";
switch($user_type){
    case 'pmember':
    $c = $db->get_one("SELECT `r_id` FROM `{$cfg['tb_pre']}resume` INNER JOIN `{$cfg['tb_pre']}member` ON `r_mid`=`m_id` WHERE `m_id`=$Memberid and `r_cnstatus`=1");
    if ($c){echo "<a href=\"../person/cnresume_view.php?rid=$c[r_id]\" target=\"_blank\">【浏览求职简历】</a>";}else{echo "  您好:"._getcookie('user_name')." &raquo;";}
    break;
    case 'cmember':
    echo "<a href=\"../company/company.php?comid=$Memberid\" target=\"_blank\">【浏览招聘主页】</a>";
    break;
    default:
    echo "  您好:"._getcookie('user_name')." &raquo;";
}
echo " 账户余额:{$Mbalance}元【<a href=\"?mpage=onlinepay&m=main&show=0&p=onlinepay\">在线充值</a>】 积分:{$Mintegral}分 <a href=\"../login.php?do=loginout\" target=\"_top\">安全退出</a></span>欢迎进入{$cfg['sitename']}智聘系统</div>\r\n";
echo '</div>';
echo "  <div class=\"memmenu\"><span>客服:$ContactMan  电话:$ContactPhone  传真:$ContactFax</span>温馨提示:$MemberMsg</div>\r\n";
?>