<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
error_reporting(0);
@set_magic_quotes_runtime(0);

// 以下变量请根据空间商提供的账号参数修改,如有疑问,请联系服务器提供商
$cfg['db_host'] = '#db_host';       // 数据库服务器
$cfg['db_name'] = '#db_name';       // 数据库名
$cfg['db_user'] = '#db_user';       // 数据库用户名
$cfg['db_pass'] = '#db_pass';       // 数据库密码
$cfg['db_charset'] = '#db_charset';      // MySQL 字符集, 可选 'gbk', 'big5', 'utf8', 'latin1'
$cfg['database'] = 'mysql';         // 数据库类型
$cfg['pconnect'] = '0';             // 数据库持久连接 0=关闭, 1=打开

$cfg['tb_pre'] = '#tb_pre';         // 表名前缀, 同一数据库安装多个系统请修改此处
$cfg['file_mod'] = 0777;
$cfg['cache_dir'] = '';
$cfg['db_expires'] = '300';

$cfg['sqlerr'] = '1';
$cfg['errlog'] = '1';

$cfg['cookie_pre'] = 'fr_';       // cookie 前缀
$cfg['cookie_encode'] = '#cookie_encode'; // cookie 加密字符

$cfg['timezone'] = 'PRC';   // 默认时区 PRC或者Etc/GMT-8
$cfg['timediff'] = '0';

$cfg['tag_expires'] = '600';
$cfg['cache_page'] = '1';
$cfg['page_expires'] = '600';

$cfg['template_refresh'] = '1';
$cfg['template_trim'] = '0';

$cfg['authkey'] = 'lZYwUDy4s225HdI6Y8';
$cfg['admincode']='8888';
$cfg['watermark']='finereason.com';   //水印文字 
$cfg['site_province']='';   //系统区域
$cfg['transmit_mail']='0';   //面试通知邮件转发
$cfg['thumb_comlogo']=Array(160,120);   //企业LOGO裁切缩略图大小
$cfg['thumb_perphoto']=Array(100,120);   //个人头像裁切缩略图大小

$cfg['soft_version'] = 'V3.0 20120222';
$cfg['soft_name'] = '嘉缘人才管理系统';
$cfg["qq_appid"]    = '';     //QQ同步登陆APPID
$cfg["qq_appkey"]   = '';     //QQ同步登陆APPKEY

//以下为网站配置信息,可直接在网站管理后台进行修改,开始和结束标记请勿去除

//配置开始
$cfg['sitename'] = '#sitename';
$cfg['siteurl'] = '#siteurl';
$cfg['logourl'] = 'images/logo.gif';
$cfg['copyright'] = '本站信息均由求职者、招聘者自由发布,{$FR_网站名称}不承担因内容的合法性及真实性所引起的一切争议和法律责任 <br />地址:{$FR_联系地址} 客服:{$FR_联系人} 电话:{$FR_联系电话} 传真:{$FR_联系传真}<br /> Copyright 2004-2011 FineReason.com Inc All Rights Reserved.<script src=\"/plus/count/mycount.php\"></script>';
$cfg['icp'] = '备案中';
$cfg['count'] = '';
$cfg['webstate'] = '0,网站关闭中';
$cfg['path'] = '#path';
$cfg['admindir'] = 'admin';
$cfg['template'] = 'default';
$cfg['skin'] = 'default';
$cfg['charset'] = 'utf-8';
$cfg['percontact'] = '0';
$cfg['comcontact'] = '0';
$cfg['seecontact'] = '0';
$cfg['smssend'] = '1,1,1,1,1,1';
$cfg['verifycode'] = '1,1,1,1,0,1';
$cfg['cookie_path'] = '/';
$cfg['cookie_domain'] = '';
$cfg['sitetitle'] = '#sitename';
$cfg['keywords'] = '求职 招聘 招聘网站 人事代理 社会保险 人才租赁 劳务派遣 人才网站 工作 猎头 人力资源 培训 短信求职 无线求职 移动求职 英语 简历 招聘会 毕业生 大学生 外企招聘 HR专家咨询 职业顾问 短期员工聘用 大学生实习  job career hire employee recruitment headhunting training HR zhaopinwang gongzuo';
$cfg['description'] = '求职 招聘 招聘网站 人事代理 社会保险 人才租赁 劳务派遣 人才网站 工作 猎头 人力资源 培训 短信求职 无线求职 移动求职 英语 简历 招聘会 毕业生 大学生 外企招聘 HR专家咨询 职业顾问 短期员工聘用 大学生实习  job career hire employee recruitment headhunting training HR zhaopinwang gongzuo';
$cfg['meta'] = '';
$cfg['createhtml'] = '0';
$cfg['htmlpath'] = 'html/';
$cfg['defaultext'] = 'html';
$cfg['createtime'] = '20';
$cfg['sitemap'] = '0';
$cfg['sitemaptime'] = '12';
$cfg['master'] = '嘉缘';
$cfg['email'] = '#email';
$cfg['contact'] = '赵小姐';
$cfg['address'] = '陕西西安';
$cfg['phone'] = '400-6606-156';
$cfg['fax'] = '029-85460076';
$cfg['regperson'] = '0,,0,0,0,1';
$cfg['regcompany'] = '0,,0,0,0,1';
$cfg['regschool'] = '0,,0,0,0,1';
$cfg['regtrain'] = '0,,0,0,0,1';
$cfg['mailobject'] = '1';
$cfg['mailserver'] = 'smtp.ym.163.com';
$cfg['mailport'] = '25';
$cfg['mailvali'] = '1';
$cfg['mailadd'] = 'service@91rencai.com';
$cfg['username'] = 'service@91rencai.com';
$cfg['password'] = 'dfgfde';
$cfg['mailcrlf'] = '0';
$cfg['comment'] = '1';
$cfg['commentcheck'] = '1';
$cfg['gbenablevisitor'] = '1';
$cfg['gbmanagerubbish'] = '';
$cfg['serviceqq'] = '822922400';
$cfg['regperiod'] = '1';
//配置结束

define('IN_FR', true);
define('FR_ROOT', str_replace("\\", '/', dirname(__FILE__)));
define('CACHE_ROOT', $cfg['cache_dir'] ? $cfg['cache_dir'] : FR_ROOT.'/cache');
define('DATA_ROOT', FR_ROOT.'/data');
define('FR_FMOD', $cfg['file_mod'] ? $cfg['file_mod'] : '');
$sessSavePath = DATA_ROOT."/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath)){session_save_path($sessSavePath);}
require_once(FR_ROOT.'/inc/common.inc.php');
require_once(FR_ROOT.'/inc/db_'.$cfg['database'].'.class.php');
$db = new db_mysql();
$db->halt = $cfg['sqlerr'];
$db->connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name'], $cfg['pconnect']);
$fr_time = time() + $cfg['timediff'];
if(function_exists('date_default_timezone_set')) date_default_timezone_set($cfg['timezone']);
header("Content-Type: text/html; charset={$cfg['charset']}");
$sysgroup = array ('1'=>'个人会员','2'=>'企业会员');
$siteurl = $cfg['siteurl'];
$sitename = $cfg['sitename'];
$path = $cfg['path'];
$webstateArray=$cfg['webstate']?explode(",",$cfg['webstate']):Array();
$veriArray=$cfg['verifycode']?explode(",",$cfg['verifycode']):Array();
$smsArray=$cfg['smssend']?explode(",",$cfg['smssend']):Array();
$regpArray=$cfg['regperson']?explode(",",$cfg['regperson']):Array();
$regcArray=$cfg['regcompany']?explode(",",$cfg['regcompany']):Array();
$regsArray=$cfg['regschool']?explode(",",$cfg['regschool']):Array();
$regtArray=$cfg['regtrain']?explode(",",$cfg['regtrain']):Array();

$smscon_arry=Array('sitename','login','ueserpwd','r_name','comname','mobilekey','place');

?>