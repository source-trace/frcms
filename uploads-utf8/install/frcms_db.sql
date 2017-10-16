#
# Finereason bakfile
# Version: 
# Time: 2011-11-25 12:48
# Finereason: http://www.finereason.com
# --------------------------------------------------------


DROP TABLE IF EXISTS `job_ad`;
CREATE TABLE `job_ad` (
  `ad_id` int(10) unsigned NOT NULL auto_increment,
  `ad_name` varchar(50) NOT NULL,
  `ad_url` varchar(100) NOT NULL,
  `ad_contactman` varchar(50) NOT NULL,
  `ad_tel` varchar(50) NOT NULL,
  `ad_width` varchar(20) NOT NULL,
  `ad_pic` varchar(100) NOT NULL,
  `ad_text` text NOT NULL,
  `ad_type` varchar(10) NOT NULL,
  `ad_act` tinyint(1) NOT NULL default '0',
  `ad_click` int(10) NOT NULL default '0',
  `ad_show` int(10) NOT NULL default '0',
  `ad_enddate` date NOT NULL default '0000-00-00',
  `ad_clicks` int(10) NOT NULL default '0',
  `ad_shows` int(10) NOT NULL default '0',
  `ad_stop` tinyint(1) NOT NULL default '0',
  `ad_other` varchar(50) NOT NULL,
  `ad_priceid` int(10) NOT NULL default '0',
  `ad_placeid` int(10) NOT NULL default '0',
  `ad_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `ad_showtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `ad_lose` tinyint(1) NOT NULL default '0',
  `ad_site` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_admin`;
CREATE TABLE `job_admin` (
  `a_id` int(10) unsigned NOT NULL auto_increment,
  `a_user` varchar(20) NOT NULL,
  `a_pass` varchar(32) NOT NULL,
  `a_flag` varchar(3000) NOT NULL,
  `a_type` varchar(20) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_tel` varchar(20) NOT NULL,
  `a_qq` varchar(12) NOT NULL,
  `a_kf` tinyint(1) NOT NULL default '0',
  `a_mobile` varchar(15) NOT NULL,
  `a_site` SMALLINT( 4 ) NOT NULL DEFAULT '0',
  `a_flags` VARCHAR( 20 ) NOT NULL DEFAULT '1,1,1,1',
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_adplace`;
CREATE TABLE `job_adplace` (
  `adplace_id` int(10) unsigned NOT NULL auto_increment,
  `adplace_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`adplace_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_adsplace`;
CREATE TABLE `job_adsplace` (
  `ap_id` int(10) unsigned NOT NULL auto_increment,
  `ap_name` varchar(50) default NULL,
  `ap_placeid` int(10) default NULL,
  `ap_priceid` int(10) default NULL,
  `ap_price` int(10) default NULL,
  `ap_unit` varchar(4) default NULL,
  `ap_row` varchar(50) default NULL,
  `ap_width` varchar(50) default NULL,
  PRIMARY KEY  (`ap_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_announce`;
CREATE TABLE `job_announce` (
  `a_id` int(10) unsigned NOT NULL auto_increment,
  `a_title` varchar(255) NOT NULL,
  `a_content` text NOT NULL,
  `a_author` varchar(50) NOT NULL,
  `a_dateandtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `a_isnew` tinyint(1) NOT NULL default '0',
  `a_channelid` smallint(4) NOT NULL default '0',
  `a_showtype` tinyint(1) NOT NULL default '0',
  `a_outtime` int(10) NOT NULL default '0',
  `a_site` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_card`;
CREATE TABLE `job_card` (
  `c_id` int(10) unsigned NOT NULL auto_increment,
  `c_num` varchar(30) NOT NULL,
  `c_pass` varchar(20) NOT NULL,
  `c_validnum` int(10) NOT NULL default '0',
  `c_enddate` date NOT NULL default '0000-00-00',
  `c_username` varchar(50) NOT NULL,
  `c_usetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_createtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_channel`;
CREATE TABLE `job_channel` (
  `c_id` smallint(4) unsigned NOT NULL auto_increment,
  `c_name` varchar(20) NOT NULL,
  `c_shortname` varchar(20) NOT NULL,
  `c_itemunit` varchar(20) NOT NULL,
  `c_readme` varchar(255) NOT NULL,
  `c_keywords` varchar(255) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_order` smallint(4) NOT NULL default '0',
  `c_opentype` tinyint(1) NOT NULL default '0',
  `c_channeltype` tinyint(1) NOT NULL default '0',
  `c_linkurl` varchar(200) NOT NULL,
  `c_channeldir` varchar(50) NOT NULL,
  `c_moduletype` tinyint(2) NOT NULL default '0',
  `c_disabled` tinyint(1) NOT NULL default '0',
  `c_shownav` tinyint(1) NOT NULL default '0',
  `c_createhtml` tinyint(1) NOT NULL default '0',
  `c_fileext` tinyint(1) NOT NULL default '0',
  `c_listfiletype` tinyint(1) NOT NULL default '0',
  `c_structuretype` tinyint(1) NOT NULL default '0',
  `c_filenametype` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_comment`;
CREATE TABLE `job_comment` (
  `c_id` int(10) unsigned NOT NULL auto_increment,
  `c_username` varchar(50) NOT NULL,
  `c_content` mediumtext NOT NULL,
  `c_nid` int(10) NOT NULL default '0',
  `c_title` varchar(100) NOT NULL,
  `c_pass` tinyint(1) NOT NULL default '0',
  `c_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_ip` varchar(15) NOT NULL default '000.000.000.000',
  `c_type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_common`;
CREATE TABLE `job_common` (
  `c_id` int(10) unsigned NOT NULL auto_increment,
  `c_title` varchar(50) NOT NULL,
  `c_content` text NOT NULL,
  `c_template` varchar(20) NOT NULL,
  `c_htmlname` varchar(50) NOT NULL,
  `c_isdefault` tinyint(1) NOT NULL default '0',
  `c_isorder` int(10) NOT NULL default '0',
  `c_dateandtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_isshow` tinyint(1) NOT NULL default '0',
  `c_type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_consume`;
CREATE TABLE `job_consume` (
  `c_id` int(10) unsigned NOT NULL auto_increment,
  `c_member` varchar(50) NOT NULL,
  `c_content` mediumtext NOT NULL,
  `c_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_ip` varchar(15) NOT NULL,
  `c_type` varchar(10) NOT NULL,
  `c_operator` varchar(20) NOT NULL,
  `c_stype` TINYINT( 1 ) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_count`;
CREATE TABLE `job_count` (
  `c_id` int(10) unsigned NOT NULL auto_increment,
  `c_year` smallint(4) NOT NULL default '0',
  `c_month` tinyint(2) NOT NULL default '0',
  `c_day` tinyint(2) NOT NULL default '0',
  `c_hour` tinyint(2) NOT NULL default '0',
  `c_time` datetime NOT NULL,
  `c_week` tinyint(1) NOT NULL,
  `c_ip` varchar(15) NOT NULL,
  `c_where` varchar(100) NOT NULL,
  `c_come` varchar(255) NOT NULL,
  `c_page` varchar(255) NOT NULL,
  `c_brower` varchar(100) NOT NULL,
  `c_os` varchar(100) NOT NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_countnum`;
CREATE TABLE `job_countnum` (
  `n_today` int(10) NOT NULL default '0',
  `n_todayip` int(10) NOT NULL default '0',
  `n_yesterday` int(10) NOT NULL default '0',
  `n_yesterdayip` int(10) NOT NULL default '0',
  `n_total` int(10) NOT NULL default '0',
  `n_time` date NOT NULL default '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;


DROP TABLE IF EXISTS `job_dept`;
CREATE TABLE `job_dept` (
  `d_id` int(10) unsigned NOT NULL auto_increment,
  `d_name` varchar(50) default NULL,
  `d_principal` varchar(50) default NULL,
  `d_email` varchar(100) default NULL,
  `d_cmember` varchar(50) NOT NULL,
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_ecoclass`;
CREATE TABLE `job_ecoclass` (
  `e_id` int(4) unsigned NOT NULL auto_increment,
  `e_name` varchar(50) NOT NULL,
  `e_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`e_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_edu`;
CREATE TABLE `job_edu` (
  `e_id` tinyint(2) NOT NULL auto_increment,
  `e_name` varchar(50) NOT NULL,
  `e_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`e_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_education`;
CREATE TABLE `job_education` (
  `e_id` int(10) unsigned NOT NULL auto_increment,
  `e_startyear` smallint(4) NOT NULL,
  `e_startmonth` tinyint(2) NOT NULL,
  `e_endyear` smallint(4) NOT NULL,
  `e_endmonth` tinyint(2) NOT NULL,
  `e_school` varchar(100) NOT NULL,
  `e_profession` varchar(50) NOT NULL,
  `e_edu` varchar(10) NOT NULL,
  `e_detail` mediumtext NOT NULL,
  `e_adddate` datetime NOT NULL,
  `e_pmember` varchar(50) NOT NULL,
  `e_rid` int(10) NOT NULL,
  `e_language` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`e_id`),
  KEY `e_profession` (`e_profession`),
  KEY `e_school` (`e_school`),
  KEY `e_rid` (`e_rid`),
  KEY `e_pmember` (`e_pmember`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_foreigndegree`;
CREATE TABLE `job_foreigndegree` (
  `f_id` tinyint(2) unsigned NOT NULL auto_increment,
  `f_name` varchar(20) NOT NULL,
  `f_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_foreignlanguage`;
CREATE TABLE `job_foreignlanguage` (
  `f_id` tinyint(2) unsigned NOT NULL auto_increment,
  `f_name` varchar(20) NOT NULL,
  `f_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_group`;
CREATE TABLE `job_group` (
  `g_id` tinyint(3) unsigned NOT NULL auto_increment,
  `g_name` varchar(20) NOT NULL,
  `g_typeid` tinyint(1) NOT NULL,
  `g_outlay` float NOT NULL default '0',
  `g_term` tinyint(3) NOT NULL default '0',
  `g_unit` varchar(2) NOT NULL,
  `g_images` varchar(50) NOT NULL,
  `g_limit` varchar(200) NOT NULL default '0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `g_integral` varchar(200) NOT NULL default '0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `g_isdefault` tinyint(1) NOT NULL default '0',
  `g_hide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_guestbook`;
CREATE TABLE `job_guestbook` (
  `g_id` int(10) unsigned NOT NULL auto_increment,
  `g_username` varchar(50) NOT NULL,
  `g_useremail` varchar(20) NOT NULL,
  `g_title` varchar(100) NOT NULL,
  `g_content` mediumtext NOT NULL,
  `g_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `g_pass` tinyint(1) NOT NULL default '0',
  `g_answer` tinyint(1) NOT NULL default '0',
  `g_email` tinyint(1) NOT NULL default '0',
  `g_ismember` tinyint(1) NOT NULL default '0',
  `g_type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_help`;
CREATE TABLE `job_help` (
  `h_id` int(10) unsigned NOT NULL auto_increment,
  `h_title` varchar(50) NOT NULL,
  `h_content` text NOT NULL,
  `h_sortid` int(10) NOT NULL default '0',
  `h_addname` varchar(20) NOT NULL,
  `h_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_helpsort`;
CREATE TABLE `job_helpsort` (
  `s_id` smallint(4) unsigned NOT NULL auto_increment,
  `s_name` varchar(50) NOT NULL,
  `s_order` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_hire`;
CREATE TABLE `job_hire` (
  `h_id` int(10) unsigned NOT NULL auto_increment,
  `h_place` varchar(150) NOT NULL,
  `h_number` mediumint(6) NOT NULL default '0',
  `h_sex` tinyint(1) NOT NULL default '0',
  `h_type` tinyint(1) NOT NULL default '0',
  `h_trade` varchar(50) NOT NULL,
  `h_position` varchar(255) NOT NULL,
  `h_dept` varchar(50) NOT NULL,
  `h_workadd` varchar(255) NOT NULL,
  `h_zhicheng` varchar(50) NOT NULL,
  `h_pay` int(10) NOT NULL default '0',
  `h_introduce` mediumtext NOT NULL,
  `h_usergroup` tinyint(1) NOT NULL default '0',
  `h_profession` varchar(255) NOT NULL,
  `h_edu` tinyint(2) NOT NULL default '0',
  `h_experience` int(10) NOT NULL default '0',
  `h_age1` tinyint(2) NOT NULL default '0',
  `h_age2` tinyint(2) NOT NULL default '0',
  `h_language1` varchar(50) NOT NULL,
  `h_level1` varchar(50) NOT NULL,
  `h_language2` varchar(50) NOT NULL,
  `h_level2` varchar(50) NOT NULL,
  `h_comname` varchar(100) NOT NULL,
  `h_address` varchar(150) NOT NULL,
  `h_post` varchar(50) NOT NULL,
  `h_contact` varchar(100) NOT NULL,
  `h_tel` varchar(100) NOT NULL,
  `h_telshowflag` tinyint(1) NOT NULL default '0',
  `h_fax` varchar(100) NOT NULL,
  `h_email` varchar(100) NOT NULL,
  `h_emailshowflag` tinyint(1) NOT NULL default '0',
  `h_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `h_enddate` date NOT NULL default '0000-00-00',
  `h_status` tinyint(1) default '0',
  `h_visitcount` int(10) default '0',
  `h_receiveresume` int(10) default '0',
  `h_sendinterview` int(10) default '0',
  `h_comid` int(10) NOT NULL default '0',
  `h_member` varchar(50) NOT NULL,
  `h_operator` varchar(20) NOT NULL,
  `h_comm` tinyint(1) NOT NULL default '0',
  `h_commstart` date NOT NULL default '0000-00-00',
  `h_commend` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`h_id`),
  KEY `h_comid` (`h_comid`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_hrzp`;
CREATE TABLE `job_hrzp` (
  `h_id` int(10) unsigned NOT NULL auto_increment,
  `h_cname` varchar(100) NOT NULL,
  `h_job` varchar(100) NOT NULL,
  `h_gangwei` varchar(255) NOT NULL,
  `h_cnum` smallint(4) NOT NULL,
  `h_jobtype` varchar(10) NOT NULL,
  `h_enddate` date NOT NULL,
  `h_workadd` varchar(100) NOT NULL,
  `h_comtype` varchar(20) NOT NULL,
  `h_requisition` text NOT NULL,
  `h_yearpay` smallint(4) NOT NULL,
  `h_welfare` text NOT NULL,
  `h_jobdesc` text NOT NULL,
  `h_duty` text NOT NULL,
  `h_address` varchar(100) NOT NULL,
  `h_contact` varchar(50) NOT NULL,
  `h_email` varchar(100) NOT NULL,
  `h_tel` varchar(100) NOT NULL,
  `h_fax` varchar(100) NOT NULL,
  `h_click` int(10) NOT NULL,
  `h_flag` tinyint(1) NOT NULL,
  `h_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_interview`;
CREATE TABLE `job_interview` (
  `i_id` int(10) unsigned NOT NULL auto_increment,
  `i_rid` int(10) NOT NULL default '0',
  `i_name` varchar(50) NOT NULL,
  `i_sex` tinyint(1) NOT NULL default '0',
  `i_birth` date NOT NULL default '0000-00-00',
  `i_edu` tinyint(2) NOT NULL default '0',
  `i_hid` int(10) NOT NULL default '0',
  `i_place` varchar(50) NOT NULL,
  `i_cmember` varchar(50) NOT NULL,
  `i_pmember` varchar(50) NOT NULL,
  `i_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_label`;
CREATE TABLE `job_label` (
  `l_id` smallint(5) unsigned NOT NULL auto_increment,
  `l_name` varchar(50) NOT NULL,
  `l_type` tinyint(1) NOT NULL default '0',
  `l_intro` varchar(50) NOT NULL,
  `l_content` mediumtext NOT NULL,
  `l_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `l_editdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `l_order` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`l_id`),
  KEY `l_order` (`l_order`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_lang`;
CREATE TABLE `job_lang` (
  `l_id` int(10) unsigned NOT NULL auto_increment,
  `l_name` varchar(10) NOT NULL,
  `l_master` varchar(10) NOT NULL,
  `l_adddate` datetime NOT NULL,
  `l_pmember` varchar(50) NOT NULL,
  `l_rid` int(10) NOT NULL,
  `l_language` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_letter`;
CREATE TABLE `job_letter` (
  `l_id` int(10) unsigned NOT NULL auto_increment,
  `l_title` varchar(100) NOT NULL,
  `l_content` mediumtext NOT NULL,
  `l_member` varchar(50) NOT NULL,
  `l_adddate` datetime NOT NULL,
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_level`;
CREATE TABLE `job_level` (
  `l_id` int(10) unsigned NOT NULL auto_increment,
  `l_name` varchar(100) NOT NULL,
  `l_integral` int(10) NOT NULL default '0',
  `l_images` varchar(20) NOT NULL,
  `l_num` int(10) NOT NULL default '0',
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_links`;
CREATE TABLE `job_links` (
  `l_id` int(10) unsigned NOT NULL auto_increment,
  `l_name` varchar(255) NOT NULL,
  `l_url` varchar(255) NOT NULL,
  `l_sm` varchar(255) NOT NULL,
  `l_key` tinyint(1) NOT NULL default '0',
  `l_key1` tinyint(1) NOT NULL default '0',
  `l_tj` tinyint(1) NOT NULL default '0',
  `l_order` int(10) NOT NULL default '0',
  `l_site` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_mail`;
CREATE TABLE `job_mail` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_title` varchar(50) NOT NULL,
  `m_content` mediumtext NOT NULL,
  `m_cycle` tinyint(2) NOT NULL default '0',
  `m_member` varchar(50) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `m_number` tinyint(2) NOT NULL default '0',
  `m_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_update` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_senddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_mailtemp`;
CREATE TABLE `job_mailtemp` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_tit` varchar(255) NOT NULL,
  `m_con` text NOT NULL,
  `m_info` varchar(100) NOT NULL,
  `m_sign` varchar(20) NOT NULL,
  `m_order` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_manage_log`;
CREATE TABLE `job_manage_log` (
  `l_id` int(10) unsigned NOT NULL auto_increment,
  `l_username` varchar(20) NOT NULL,
  `l_ip` varchar(20) NOT NULL,
  `l_dat` text NOT NULL,
  `l_datetime` datetime NOT NULL,
  `l_cs` tinyint(1) NOT NULL,
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_marriage`;
CREATE TABLE `job_marriage` (
  `m_id` tinyint(2) unsigned NOT NULL auto_increment,
  `m_name` varchar(20) NOT NULL,
  `m_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_member`;
CREATE TABLE `job_member` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_login` varchar(50) NOT NULL,
  `m_pwd` varchar(32) NOT NULL,
  `m_sendemail` tinyint(1) NOT NULL default '0',
  `m_question` varchar(50) NOT NULL,
  `m_answer` varchar(50) NOT NULL,
  `m_typeid` tinyint(1) NOT NULL default '0',
  `m_groupid` tinyint(2) NOT NULL default '0',
  `m_email` varchar(100) NOT NULL,
  `m_emailshowflag` tinyint(1) NOT NULL default '0',
  `m_name` varchar(200) NOT NULL,
  `m_sex` tinyint(1) NOT NULL default '0',
  `m_birth` date NOT NULL default '0000-00-00',
  `m_cardtype` tinyint(1) NOT NULL default '0',
  `m_idcard` varchar(20) NOT NULL,
  `m_marriage` varchar(10) NOT NULL,
  `m_polity` varchar(10) NOT NULL,
  `m_hukou` varchar(100) NOT NULL,
  `m_seat` varchar(100) NOT NULL,
  `m_edu` tinyint(2) NOT NULL,
  `m_address` varchar(200) NOT NULL,
  `m_post` varchar(6) NOT NULL,
  `m_contact` varchar(50) NOT NULL,
  `m_chat` varchar(20) NOT NULL,
  `m_tel` varchar(100) NOT NULL,
  `m_telshowflag` tinyint(1) NOT NULL default '0',
  `m_fax` varchar(50) NOT NULL,
  `m_url` varchar(100) NOT NULL,
  `m_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_logindate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_loginip` varchar(15) NOT NULL default '000.000.000.000',
  `m_loginnum` int(10) NOT NULL,
  `m_level` varchar(50) NOT NULL,
  `m_balance` int(10) NOT NULL default '0',
  `m_integral` int(10) NOT NULL default '0',
  `m_flag` tinyint(1) NOT NULL default '0',
  `m_startdate` date NOT NULL default '0000-00-00',
  `m_enddate` date NOT NULL default '0000-00-00',
  `m_resumenums` mediumint(6) NOT NULL default '0',
  `m_mysendnums` mediumint(6) NOT NULL default '0',
  `m_myinterviewnums` mediumint(6) NOT NULL default '0',
  `m_myfavoritenums` mediumint(6) NOT NULL default '0',
  `m_letternums` tinyint(2) NOT NULL default '0',
  `m_hirenums` mediumint(6) NOT NULL default '0',
  `m_interviewnums` mediumint(6) NOT NULL default '0',
  `m_expertnums` mediumint(6) NOT NULL default '0',
  `m_comm` tinyint(1) NOT NULL default '0',
  `m_commstart` date NOT NULL default '0000-00-00',
  `m_commend` date NOT NULL default '0000-00-00',
  `m_logo` varchar(50) NOT NULL,
  `m_logostatus` tinyint(1) NOT NULL default '0',
  `m_logoflag` tinyint(1) NOT NULL default '0',
  `m_logocomm` tinyint(1) NOT NULL default '0',
  `m_logostartdate` date NOT NULL default '0000-00-00',
  `m_logoenddate` date NOT NULL default '0000-00-00',
  `m_licence` varchar(100) NOT NULL,
  `m_trade` varchar(50) NOT NULL,
  `m_ecoclass` varchar(20) NOT NULL,
  `m_fund` mediumint(6) NOT NULL default '0',
  `m_workers` varchar(10) NOT NULL,
  `m_founddate` date NOT NULL default '0000-00-00',
  `m_introduce` mediumtext NOT NULL,
  `m_teachers` mediumtext NOT NULL,
  `m_achievement` mediumtext NOT NULL,
  `m_hits` int(10) NOT NULL default '0',
  `m_template` varchar(20) NOT NULL,
  `m_activedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_mobile` varchar(20) NOT NULL,
  `m_mobileshowflag` tinyint(1) NOT NULL default '0',
  `m_smsnum` smallint(4) NOT NULL default '0',
  `m_hirenum` smallint(4) NOT NULL default '0',
  `m_myinterviewnum` smallint(4) NOT NULL default '0',
  `m_expertnum` smallint(4) NOT NULL default '0',
  `m_recyclenums` mediumint(6) NOT NULL default '0',
  `m_recyclenum` smallint(4) NOT NULL default '0',
  `m_contactnums` mediumint(6) NOT NULL default '0',
  `m_contactnum` smallint(4) NOT NULL default '0',
  `m_smsnums` mediumint(6) NOT NULL default '0',
  `m_mysendnum` smallint(4) NOT NULL default '0',
  `m_myfavoritenum` smallint(4) NOT NULL default '0',
  `m_ishire` smallint(4) NOT NULL default '0',
  `m_operator` varchar(20) NOT NULL,
  `m_map` varchar(50) NOT NULL,
  `m_confirm` tinyint(1) NOT NULL default '0',
  `m_inviteid` int(10) NOT NULL default '0',
  `m_site` smallint(4) NOT NULL default '0',
  `m_nameshow` TINYINT( 1 ) NOT NULL DEFAULT '0',
  `m_qzstate` VARCHAR( 255 ) NOT NULL,
  `m_openid` VARCHAR( 100 ) NOT NULL,
  PRIMARY KEY  (`m_id`),
  KEY `m_regdate` (`m_regdate`),
  KEY `m_enddate` (`m_enddate`),
  KEY `m_logindate` (`m_logindate`),
  KEY `m_login` (`m_login`),
  KEY `m_activedate` (`m_activedate`),
  KEY `m_startdate` (`m_startdate`),
  KEY `m_ishire` (`m_ishire`),
  KEY `m_logoflag` (`m_logoflag`),
  KEY `m_logostatus` (`m_logostatus`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_myexpert`;
CREATE TABLE `job_myexpert` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_rid` int(10) NOT NULL default '0',
  `m_name` varchar(50) NOT NULL,
  `m_sex` tinyint(1) NOT NULL default '0',
  `m_birth` date NOT NULL default '0000-00-00',
  `m_edu` tinyint(2) NOT NULL,
  `m_cmember` varchar(50) NOT NULL,
  `m_pmember` varchar(50) NOT NULL,
  `m_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_down` tinyint(1) NOT NULL default '0',
  `m_downdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_exp` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_myfavorite`;
CREATE TABLE `job_myfavorite` (
  `f_id` int(10) unsigned NOT NULL auto_increment,
  `f_hid` int(10) NOT NULL,
  `f_comname` varchar(200) NOT NULL,
  `f_place` varchar(100) NOT NULL,
  `f_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `f_pmember` varchar(50) NOT NULL,
  `f_cmember` varchar(50) NOT NULL,
  PRIMARY KEY  (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_myinterview`;
CREATE TABLE `job_myinterview` (
  `i_id` int(10) unsigned NOT NULL auto_increment,
  `i_hid` int(10) NOT NULL,
  `i_comname` varchar(200) NOT NULL,
  `i_place` varchar(100) NOT NULL,
  `i_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `i_pmember` varchar(50) NOT NULL,
  `i_cmember` varchar(50) NOT NULL,
  `i_read` tinyint(1) NOT NULL default '0',
  `i_title` varchar(100) NOT NULL,
  `i_content` mediumtext NOT NULL,
  PRIMARY KEY  (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_myreceive`;
CREATE TABLE `job_myreceive` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_rid` int(10) NOT NULL default '0',
  `m_name` varchar(50) NOT NULL,
  `m_sex` tinyint(1) NOT NULL default '0',
  `m_birth` date NOT NULL,
  `m_edu` tinyint(2) NOT NULL default '0',
  `m_hid` int(10) NOT NULL default '0',
  `m_place` varchar(50) NOT NULL,
  `m_cmember` varchar(50) NOT NULL,
  `m_pmember` varchar(50) NOT NULL,
  `m_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_read` tinyint(1) NOT NULL default '0',
  `m_content` mediumtext NOT NULL,
  `m_lang` tinyint(1) NOT NULL default '0',
  `m_reply` TINYINT( 1 ) NOT NULL DEFAULT '0',
  `m_sendnum` SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_mysend`;
CREATE TABLE `job_mysend` (
  `s_id` int(10) unsigned NOT NULL auto_increment,
  `s_hid` int(10) NOT NULL,
  `s_comname` varchar(200) NOT NULL,
  `s_place` varchar(50) NOT NULL,
  `s_rid` int(10) NOT NULL,
  `s_resumename` varchar(50) NOT NULL,
  `s_lang` varchar(10) NOT NULL,
  `s_adddate` datetime NOT NULL,
  `s_interview` smallint(1) NOT NULL default '0',
  `s_favorite` tinyint(1) NOT NULL default '0',
  `s_response` tinyint(1) NOT NULL default '0',
  `s_deny` tinyint(1) NOT NULL default '0',
  `s_pmember` varchar(50) NOT NULL,
  `s_cmember` varchar(50) NOT NULL,
  `s_sendnum` SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_nation`;
CREATE TABLE `job_nation` (
  `n_id` int(4) unsigned NOT NULL auto_increment,
  `n_name` varchar(50) NOT NULL,
  `n_enname` varchar(100) NOT NULL,
  PRIMARY KEY  (`n_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_news`;
CREATE TABLE `job_news` (
  `n_id` int(10) unsigned NOT NULL auto_increment,
  `n_title` varchar(100) NOT NULL,
  `n_content` mediumtext NOT NULL,
  `n_overview` varchar(255) NOT NULL,
  `n_sorttit` varchar(100) NOT NULL,
  `n_color` varchar(10) NOT NULL,
  `n_cid` smallint(4) NOT NULL,
  `n_sid` int(10) NOT NULL,
  `n_author` varchar(50) NOT NULL,
  `n_editor` varchar(50) NOT NULL,
  `n_from` varchar(100) NOT NULL,
  `n_pic` varchar(50) NOT NULL,
  `n_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `n_hits` int(10) NOT NULL default '0',
  `n_iscomm` tinyint(1) NOT NULL default '0',
  `n_ispic` tinyint(1) NOT NULL default '0',
  `n_ishome` tinyint(1) NOT NULL default '0',
  `n_keywords` varchar(255) NOT NULL,
  `n_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`n_id`),
  KEY `n_addtime` (`n_addtime`),
  KEY `n_hits` (`n_hits`),
  KEY `n_sid` (`n_sid`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_newssort`;
CREATE TABLE `job_newssort` (
  `s_id` int(10) unsigned NOT NULL auto_increment,
  `s_name` varchar(50) NOT NULL,
  `s_cid` smallint(4) NOT NULL default '0',
  `s_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `s_order` int(10) NOT NULL default '0',
  `s_fid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_orderservice`;
CREATE TABLE `job_orderservice` (
  `o_id` int(10) unsigned NOT NULL auto_increment,
  `o_groupid` tinyint(3) NOT NULL,
  `o_groupname` varchar(20) NOT NULL,
  `o_member` varchar(50) NOT NULL,
  `o_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `o_pactnum` varchar(20) NOT NULL,
  `o_result` tinyint(1) NOT NULL default '0',
  `o_dealdatetime` datetime NOT NULL,
  `o_content` varchar(255) NOT NULL,
  `o_revert` varchar(255) NOT NULL,
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_payback`;
CREATE TABLE `job_payback` (
  `p_id` int(10) unsigned NOT NULL auto_increment,
  `p_mid` varchar(20) NOT NULL,
  `p_amount` varchar(10) NOT NULL,
  `p_type` varchar(10) NOT NULL,
  `p_pmode` varchar(20) NOT NULL,
  `p_oid` varchar(14) NOT NULL,
  `p_content` varchar(100) NOT NULL,
  `p_member` varchar(50) NOT NULL,
  `p_class` varchar(10) NOT NULL,
  `p_address` varchar(100) NOT NULL,
  `p_email` varchar(50) NOT NULL,
  `p_tel` varchar(50) NOT NULL,
  `p_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `p_userip` varchar(15) NOT NULL,
  `p_isucceed` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_payonline`;
CREATE TABLE `job_payonline` (
  `p_id` tinyint(2) unsigned NOT NULL auto_increment,
  `p_key` varchar(200) NOT NULL,
  `p_no` varchar(50) NOT NULL,
  `p_shid` varchar(50) NOT NULL,
  `p_flag` tinyint(2) NOT NULL default '0',
  `p_chk` tinyint(1) NOT NULL default '0',
  `p_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_picture`;
CREATE TABLE `job_picture` (
  `p_id` int(10) unsigned NOT NULL auto_increment,
  `p_type` tinyint(2) NOT NULL,
  `p_filename` varchar(100) NOT NULL,
  `p_status` tinyint(1) NOT NULL default '0',
  `p_member` varchar(50) NOT NULL,
  `p_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `p_flag` tinyint(1) NOT NULL default '0',
  `p_name` varchar(20) NOT NULL,
  `p_info` varchar(255) NOT NULL,
  `p_hits` int(10) NOT NULL default '0',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_polity`;
CREATE TABLE `job_polity` (
  `p_id` smallint(4) unsigned NOT NULL auto_increment,
  `p_name` varchar(20) NOT NULL,
  `p_enname` varchar(50) NOT NULL,
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_position`;
CREATE TABLE `job_position` (
  `p_id` smallint(4) unsigned NOT NULL auto_increment,
  `p_name` varchar(100) NOT NULL,
  `p_enname` varchar(100) NOT NULL,
  `p_fid` smallint(4) NOT NULL default '0',
  `p_order` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_prices`;
CREATE TABLE `job_prices` (
  `p_id` int(10) unsigned NOT NULL auto_increment,
  `p_name` varchar(50) NOT NULL,
  `p_value` smallint(4) NOT NULL default '0',
  `p_useday` smallint(4) NOT NULL default '0',
  `p_picture` varchar(100) NOT NULL,
  `p_type` tinyint(2) NOT NULL default '0',
  `p_content` varchar(255) NOT NULL,
  `p_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_profession`;
CREATE TABLE `job_profession` (
  `p_id` smallint(4) unsigned NOT NULL auto_increment,
  `p_name` varchar(100) NOT NULL,
  `p_enname` varchar(100) NOT NULL,
  `p_fid` smallint(4) NOT NULL default '0',
  `p_order` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_provinceandcity`;
CREATE TABLE `job_provinceandcity` (
  `p_id` smallint(4) unsigned NOT NULL auto_increment,
  `p_name` varchar(100) NOT NULL,
  `p_enname` varchar(100) NOT NULL,
  `p_fid` smallint(4) NOT NULL default '0',
  `p_order` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_rbrower`;
CREATE TABLE `job_rbrower` (
  `r_id` int(10) unsigned NOT NULL auto_increment,
  `r_bid` int(10) NOT NULL default '0',
  `r_bmember` varchar(50) NOT NULL,
  `r_member` varchar(50) NOT NULL,
  `r_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_name` varchar(200) NOT NULL,
  `r_type` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_recycle`;
CREATE TABLE `job_recycle` (
  `r_id` int(10) unsigned NOT NULL auto_increment,
  `r_rid` int(10) NOT NULL default '0',
  `r_name` varchar(50) NOT NULL,
  `r_sex` tinyint(1) NOT NULL default '0',
  `r_birth` date NOT NULL default '0000-00-00',
  `r_edu` tinyint(2) NOT NULL default '0',
  `r_hid` int(10) NOT NULL default '0',
  `r_place` varchar(50) NOT NULL,
  `r_cmember` varchar(50) NOT NULL,
  `r_pmember` varchar(50) NOT NULL,
  `r_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_content` mediumtext NOT NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_reply`;
CREATE TABLE `job_reply` (
  `r_id` int(10) unsigned NOT NULL auto_increment,
  `r_username` varchar(50) NOT NULL,
  `r_content` mediumtext NOT NULL,
  `r_addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_gid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_resume`;
CREATE TABLE `job_resume` (
  `r_id` int(10) unsigned NOT NULL auto_increment,
  `r_usergroup` tinyint(1) NOT NULL default '0',
  `r_openness` tinyint(1) NOT NULL default '0',
  `r_title` varchar(50) NOT NULL,
  `r_chinese` tinyint(1) NOT NULL default '0',
  `r_english` tinyint(1) NOT NULL default '0',
  `r_cnstatus` tinyint(1) NOT NULL default '0',
  `r_enstatus` tinyint(1) NOT NULL default '0',
  `r_name` varchar(50) NOT NULL,
  `r_sex` tinyint(1) NOT NULL default '0',
  `r_birth` date NOT NULL,
  `r_cardtype` tinyint(1) NOT NULL default '0',
  `r_idcard` varchar(50) NOT NULL,
  `r_nation` varchar(20) NOT NULL,
  `r_polity` varchar(10) NOT NULL,
  `r_marriage` varchar(10) NOT NULL,
  `r_height` smallint(4) NOT NULL default '0',
  `r_weight` smallint(4) NOT NULL default '0',
  `r_hukou` varchar(100) NOT NULL,
  `r_seat` varchar(100) NOT NULL,
  `r_edu` tinyint(2) NOT NULL default '0',
  `r_tel` varchar(100) NOT NULL,
  `r_mobile` varchar(20) NOT NULL,
  `r_chat` varchar(20) NOT NULL,
  `r_email` varchar(100) NOT NULL,
  `r_url` varchar(100) NOT NULL,
  `r_address` varchar(200) NOT NULL,
  `r_post` varchar(6) NOT NULL,
  `r_sumup` varchar(50) NOT NULL,
  `r_appraise` mediumtext NOT NULL,
  `r_jobtype` tinyint(1) NOT NULL default '0',
  `r_trade` varchar(255) NOT NULL,
  `r_position` varchar(255) NOT NULL,
  `r_workadd` varchar(255) NOT NULL,
  `r_pay` mediumint(8) NOT NULL default '0',
  `r_stay` tinyint(1) NOT NULL default '0',
  `r_workdate` tinyint(2) NOT NULL default '0',
  `r_request` mediumtext NOT NULL,
  `r_personinfo` tinyint(1) NOT NULL default '0',
  `r_education` tinyint(1) NOT NULL default '0',
  `r_train` tinyint(1) NOT NULL default '0',
  `r_lang` tinyint(1) NOT NULL default '0',
  `r_work` tinyint(1) NOT NULL default '0',
  `r_careerwill` tinyint(1) NOT NULL default '0',
  `r_visitnum` int(10) NOT NULL default '0',
  `r_member` varchar(50) NOT NULL,
  `r_adddate` datetime NOT NULL,
  `r_flag` tinyint(1) NOT NULL default '0',
  `r_school` varchar(100) NOT NULL,
  `r_graduate` date NOT NULL,
  `r_zhicheng` varchar(50) NOT NULL,
  `r_template` varchar(100) NOT NULL,
  `r_ability` mediumtext NOT NULL,
  `r_mid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`r_id`),
  KEY `r_adddate` (`r_adddate`),
  KEY `r_member` (`r_member`),
  KEY `r_usergroup` (`r_usergroup`),
  KEY `r_seat` (`r_seat`),
  KEY `r_position` (`r_position`),
  KEY `r_jobtype` (`r_jobtype`),
  KEY `r_visitnum` (`r_visitnum`),
  KEY `r_mid` (`r_mid`),
  FULLTEXT KEY `r_title` (`r_title`,`r_name`,`r_appraise`,`r_request`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_sendresume`;
CREATE TABLE `job_sendresume` (
  `s_id` int(10) unsigned NOT NULL auto_increment,
  `s_comname` varchar(200) NOT NULL,
  `s_tel` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_place` varchar(100) NOT NULL,
  `s_adddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `s_member` varchar(50) NOT NULL,
  `s_contact` varchar(50) NOT NULL,
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_service_log`;
CREATE TABLE `job_service_log` (
`s_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
`s_gname` VARCHAR( 200 ) NOT NULL ,
`s_startdate` DATE NOT NULL ,
`s_enddate` DATE NOT NULL ,
`s_mid` INT NOT NULL ,
`s_operator` VARCHAR( 50 ) NOT NULL ,
`s_adddate` DATETIME NOT NULL ,
`s_type` TINYINT( 1 ) NOT NULL ,
`s_ip` VARCHAR( 20 ) NOT NULL ,
`s_money` SMALLINT NOT NULL ,
PRIMARY KEY ( `s_id` ) 
) ENGINE = MYISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_siteconfig`;
CREATE TABLE `job_siteconfig` (
  `s_id` smallint(4) unsigned NOT NULL auto_increment,
  `s_sitename` varchar(100) NOT NULL,
  `s_sitetitle` varchar(255) NOT NULL,
  `s_siteurl` varchar(255) NOT NULL,
  `s_icp` varchar(20) NOT NULL,
  `s_count` text NOT NULL,
  `s_webstate` varchar(255) NOT NULL,
  `s_key` varchar(255) NOT NULL,
  `s_logourl` varchar(255) NOT NULL,
  `s_template` varchar(20) NOT NULL,
  `s_skin` varchar(20) NOT NULL,
  `s_charset` varchar(5) NOT NULL,
  `s_master` varchar(20) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_copyright` text NOT NULL,
  `s_keywords` varchar(255) NOT NULL,
  `s_description` varchar(255) NOT NULL,
  `s_meta` text NOT NULL,
  `s_path` varchar(20) NOT NULL,
  `s_admindir` varchar(20) NOT NULL,
  `s_contact` varchar(20) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_phone` varchar(50) NOT NULL,
  `s_fax` varchar(50) NOT NULL,
  `s_regperson` varchar(255) NOT NULL,
  `s_regcompany` varchar(255) NOT NULL,
  `s_regschool` varchar(255) NOT NULL,
  `s_regtrain` varchar(255) NOT NULL,
  `s_regdisabled` varchar(255) NOT NULL,
  `s_mailobject` tinyint(1) NOT NULL default '0',
  `s_mailserver` varchar(50) NOT NULL,
  `s_mailport` smallint(4) NOT NULL default '0',
  `s_mailvali` tinyint(1) NOT NULL default '0',
  `s_mailadd` varchar(100) NOT NULL,
  `s_mailcrlf` tinyint(1) NOT NULL default '0',
  `s_username` varchar(50) NOT NULL,
  `s_password` varchar(50) NOT NULL,
  `s_gbenablevisitor` tinyint(1) NOT NULL default '0',
  `s_gbmanagerubbish` varchar(255) NOT NULL,
  `s_createhtml` tinyint(1) NOT NULL default '0',
  `s_htmlpath` varchar(10) NOT NULL,
  `s_createtime` tinyint(2) NOT NULL default '0',
  `s_defaultext` varchar(10) NOT NULL,
  `s_sitemap` tinyint(1) NOT NULL default '0',
  `s_sitemaptime` tinyint(3) NOT NULL default '0',
  `s_percontact` tinyint(1) NOT NULL default '0',
  `s_comcontact` tinyint(1) NOT NULL default '0',
  `s_seecontact` tinyint(1) NOT NULL default '0',
  `s_smssend` varchar(20) NOT NULL,
  `s_verifycode` varchar(20) NOT NULL,
  `s_cookiepath` varchar(50) NOT NULL,
  `s_cookiedomain` varchar(100) NOT NULL,
  `s_comment` tinyint(1) NOT NULL default '0',
  `s_commentcheck` tinyint(1) NOT NULL default '0',
  `s_serviceqq` VARCHAR( 100 ) NOT NULL ,
  `s_regperiod` TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_sms`;
CREATE TABLE `job_sms` (
  `s_id` int(10) unsigned NOT NULL auto_increment,
  `s_memberlogin` varchar(50) NOT NULL,
  `s_tomobile` varchar(20) NOT NULL,
  `s_issuccess` tinyint(1) NOT NULL default '0',
  `s_sendtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `s_content` varchar(200) NOT NULL,
  `s_tomemberlogin` varchar(50) NOT NULL,
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_smstemp`;
CREATE TABLE `job_smstemp` (
  `s_id` int(10) unsigned NOT NULL auto_increment,
  `s_con` varchar(255) NOT NULL,
  `s_info` varchar(100) NOT NULL,
  `s_sign` varchar(20) NOT NULL,
  `s_default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_trade`;
CREATE TABLE `job_trade` (
  `t_id` smallint(4) unsigned NOT NULL auto_increment,
  `t_name` varchar(100) NOT NULL,
  `t_enname` varchar(100) NOT NULL,
  `t_order` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_training`;
CREATE TABLE `job_training` (
  `t_id` int(10) unsigned NOT NULL auto_increment,
  `t_startyear` smallint(4) NOT NULL,
  `t_startmonth` tinyint(2) NOT NULL,
  `t_endyear` smallint(4) NOT NULL,
  `t_endmonth` tinyint(2) NOT NULL,
  `t_train` varchar(100) NOT NULL,
  `t_address` varchar(100) NOT NULL,
  `t_course` varchar(100) NOT NULL,
  `t_certificate` varchar(100) NOT NULL,
  `t_detail` mediumtext NOT NULL,
  `t_adddate` datetime NOT NULL,
  `t_pmember` varchar(50) NOT NULL,
  `t_rid` int(10) NOT NULL,
  `t_language` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_vote`;
CREATE TABLE `job_vote` (
  `v_id` int(10) unsigned NOT NULL auto_increment,
  `v_title` varchar(255) NOT NULL,
  `v_start` date NOT NULL default '0000-00-00',
  `v_end` date NOT NULL default '0000-00-00',
  `v_style` varchar(20) NOT NULL,
  `v_ing` tinyint(1) NOT NULL default '0',
  `v_color` varchar(10) NOT NULL,
  `v_count` int(10) NOT NULL default '0',
  `v_class` int(10) NOT NULL default '0',
  PRIMARY KEY  (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_work`;
CREATE TABLE `job_work` (
  `w_id` int(10) unsigned NOT NULL auto_increment,
  `w_startyear` smallint(4) NOT NULL,
  `w_startmonth` tinyint(2) NOT NULL,
  `w_endyear` smallint(4) NOT NULL,
  `w_endmonth` tinyint(2) NOT NULL,
  `w_comname` varchar(100) NOT NULL,
  `w_ecoclass` varchar(20) NOT NULL,
  `w_trade` varchar(50) NOT NULL,
  `w_dept` varchar(50) NOT NULL,
  `w_position` varchar(50) NOT NULL,
  `w_place` varchar(100) NOT NULL,
  `w_introduce` mediumtext NOT NULL,
  `w_leftreason` varchar(100) NOT NULL,
  `w_adddate` datetime NOT NULL,
  `w_pmember` varchar(50) NOT NULL,
  `w_rid` int(10) NOT NULL,
  `w_language` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`w_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_vhire`;
CREATE TABLE `job_vhire` (
  `v_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_place` varchar(50) NOT NULL,
  `v_number` smallint(4) NOT NULL DEFAULT '0',
  `v_comname` varchar(100) NOT NULL,
  `v_contact` varchar(20) NOT NULL,
  `v_tel` varchar(20) NOT NULL,
  `v_address` varchar(50) NOT NULL,
  `v_request` varchar(255) NOT NULL,
  `v_validity` smallint(4) NOT NULL DEFAULT '0',
  `v_adddate` datetime NOT NULL,
  `v_ip` varchar(15) NOT NULL,
  `v_flag` tinyint(4) NOT NULL DEFAULT '0',
  `v_top` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_location`;
CREATE TABLE `job_location` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_location` varchar(100) NOT NULL,
  `l_address` varchar(100) NOT NULL,
  `l_map` varchar(50) NOT NULL,
  `l_bus` varchar(255) NOT NULL,
  `l_tel` varchar(100) NOT NULL,
  `l_email` varchar(100) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

DROP TABLE IF EXISTS `job_zph`;
CREATE TABLE `job_zph` (
  `z_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `z_name` varchar(255) NOT NULL,
  `z_content` text NOT NULL,
  `z_date` varchar(50) NOT NULL,
  `z_location` varchar(100) NOT NULL,
  `z_address` varchar(100) NOT NULL,
  `z_map` varchar(50) NOT NULL,
  `z_deadline` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `z_tel` varchar(50) NOT NULL,
  `z_email` varchar(50) NOT NULL,
  `z_bus` varchar(255) NOT NULL,
  `z_views` int(11) NOT NULL,
  `z_adddate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`z_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;


INSERT INTO job_ad VALUES('7','足不出户找工作','http://www.91rencai.com','嘉挚科技','','970*60','../upfiles/webads/20100831152724_653.gif','足不出户找工作','image','0','0','0','0000-00-00','0','3090','0','','1','1','2010-08-31 15:27:46','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('10','品牌广告B2','http://www.91rencai.com','品牌广告B2','','317*60','../upfiles/webads/20100831160751_222.gif','品牌广告B2','image','0','0','0','0000-00-00','1','3078','0','','2','1','2010-08-31 16:08:04','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('9','品牌广告B1','http://www.91rencai.com','品牌广告B1','','317*60','../upfiles/webads/20100831160415_381.gif','品牌广告B1','image','0','0','0','0000-00-00','2','3084','0','','2','1','2010-08-31 16:04:31','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('8','品牌广告B','http://www.91rencai.com','品牌广告B','','317*60','../upfiles/webads/20100831160224_361.gif','品牌广告B','image','0','0','0','0000-00-00','5','3086','0','','2','1','2010-08-31 16:03:04','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('11','品牌广告B3','http://www.91rencai.com','品牌广告B3','','317*60','../upfiles/webads/20100831160902_792.gif','品牌广告B3','image','0','0','0','0000-00-00','1','3077','0','','2','1','2010-08-31 16:09:13','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('39','yjys','http://192.168.1.200','yjys','','155*60','../upfiles/webads/20101231141113_733.gif','','image','0','0','0','0000-00-00','0','209','0','','7','1','2010-12-31 14:11:23','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('6','注册页面广告','http://p.finereason.com','网站','','270*270','../upfiles/webads/20100830091419_167.gif','注册页面广告','image','0','0','0','0000-00-00','1','287','0','','5','3','2010-08-30 09:14:42','2011-01-04 11:41:16','0','0');
INSERT INTO job_ad VALUES('12','品牌广告B4','http://www.91rencai.com','品牌广告B4','','317*60','../upfiles/webads/20100831161706_781.gif','品牌广告B4','image','0','0','0','0000-00-00','0','3070','0','','2','1','2010-08-31 16:17:19','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('13','品牌广告B5','http://www.91rencai.com','品牌广告B5','','317*60','../upfiles/webads/20100831161740_140.gif','品牌广告B5','image','0','0','0','0000-00-00','0','3070','0','','2','1','2010-08-31 16:17:52','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('14','品牌广告B6','http://www.91rencai.com','品牌广告B6','','317*60','../upfiles/webads/20100831162012_245.gif','品牌广告B6','image','0','0','0','0000-00-00','0','3069','0','','2','1','2010-08-31 16:20:25','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('15','品牌广告B7','http://www.91rencai.com','品牌广告B7','','317*60','../upfiles/webads/20100831162046_248.gif','品牌广告B7','image','0','0','0','0000-00-00','0','3069','0','','2','1','2010-08-31 16:21:00','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('16','品牌广告B9','http://www.91rencai.com','品牌广告B9','','317*60','../upfiles/webads/20100831162226_748.gif','品牌广告B9','image','0','0','0','0000-00-00','0','3068','0','','2','1','2010-08-31 16:22:37','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('17','品牌广告B10','http://www.91rencai.com','品牌广告B10','','317*60','../upfiles/webads/20100831162305_994.gif','品牌广告B10','image','0','0','0','0000-00-00','0','3068','0','','2','1','2010-08-31 16:23:20','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('18','品牌广告C1','http://www.91rencai.com','品牌广告C1','','155*60','../upfiles/webads/20100831163146_955.gif','品牌广告C2','image','0','0','0','0000-00-00','0','3068','0','','6','1','2010-08-31 16:31:57','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('19','品牌广告C2','http://www.91rencai.com','品牌广告C3','','155*60','../upfiles/webads/20100831163223_496.gif','品牌广告C3','image','0','0','0','0000-00-00','0','3066','0','','6','1','2010-08-31 16:32:37','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('20','品牌广告C3','http://www.91rencai.com','品牌广告C3','','155*60','../upfiles/webads/20100831163424_388.gif','品牌广告C3','image','0','0','0','0000-00-00','0','3064','0','','6','1','2010-08-31 16:34:35','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('21','品牌广告C4','http://www.91rencai.com','品牌广告C4','','155*60','../upfiles/webads/20100831163612_866.gif','品牌广告C4','image','0','0','0','0000-00-00','0','3063','0','','6','1','2010-08-31 16:36:46','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('22','品牌广告C5','http://www.91rencai.com','品牌广告C5','','155*60','../upfiles/webads/20100831163935_632.gif','品牌广告C5','image','0','0','0','0000-00-00','0','3061','0','','6','1','2010-08-31 16:39:49','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('23','品牌广告C6','http://www.91rencai.com','品牌广告C6','','155*60','../upfiles/webads/20100831164050_400.gif','品牌广告C6','image','0','0','0','0000-00-00','0','3061','0','','6','1','2010-08-31 16:41:03','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('24','品牌广告C7','http://www.91rencai.com','品牌广告C7','','155*60','../upfiles/webads/20100831164440_846.gif','品牌广告C7','image','0','0','0','0000-00-00','0','3061','0','','6','1','2010-08-31 16:44:51','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('25','品牌广告C8','http://www.91rencai.com','品牌广告C8','','155*60','../upfiles/webads/20100831164639_869.gif','品牌广告C8','image','0','0','0','0000-00-00','0','3061','0','','6','1','2010-08-31 16:46:54','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('26','品牌广告C9','http://www.91rencai.com','品牌广告C9','','155*60','../upfiles/webads/20100831164849_730.gif','品牌广告C9','image','0','0','0','0000-00-00','0','3060','0','','6','1','2010-08-31 16:49:00','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('27','品牌广告C10','http://www.91rencai.com','品牌广告C10','','155*60','../upfiles/webads/20100831164938_557.gif','品牌广告C10','image','0','0','0','0000-00-00','0','3060','0','','6','1','2010-08-31 16:49:49','2011-01-04 12:52:05','0','0');
INSERT INTO job_ad VALUES('28','品牌广告D1','http://www.91rencai.com','品牌广告D1','','155*60','../upfiles/webads/20100831165936_290.gif','品牌广告D1','image','0','0','0','0000-00-00','0','3060','0','','7','1','2010-08-31 16:59:50','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('29','品牌广告D2','http://www.91rencai.com','品牌广告D2','','155*60','../upfiles/webads/20100831170058_769.gif','品牌广告D2','image','0','0','0','0000-00-00','1','3058','0','','7','1','2010-08-31 17:01:11','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('30','品牌广告D3','http://www.91rencai.com','品牌广告D3','','155*60','../upfiles/webads/20100831170146_710.gif','品牌广告D3','image','0','0','0','0000-00-00','1','3058','0','','7','1','2010-08-31 17:01:56','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('31','品牌广告D4','http://www.91rencai.com','品牌广告D4','','155*60','../upfiles/webads/20100831170728_473.gif','品牌广告D4','image','0','0','0','0000-00-00','0','3050','0','','7','1','2010-08-31 17:07:40','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('32','品牌广告D5','http://www.91rencai.com','品牌广告D5','','155*60','../upfiles/webads/20100831170811_707.gif','品牌广告D5','image','0','0','0','0000-00-00','0','3050','0','','7','1','2010-08-31 17:08:21','2011-01-04 12:52:07','0','0');
INSERT INTO job_ad VALUES('33','品牌广告F01','http://www.finereason.com','品牌广告','','318*60','../upfiles/webads/20101011035201_883.gif','品牌广告F01','image','0','0','0','0000-00-00','1','1678','0','','8','1','2010-10-11 03:52:31','2011-01-04 12:52:09','0','0');
INSERT INTO job_ad VALUES('34','品牌广告F02','http://www.finereason.com','品牌广告','','318*60','../upfiles/webads/20101011035304_963.gif','品牌广告F02','image','0','0','0','0000-00-00','0','1678','0','','8','1','2010-10-11 03:53:25','2011-01-04 12:52:09','0','0');
INSERT INTO job_ad VALUES('35','s','http://p.finereason.com','s','','290*117','../upfiles/webads/20101011174010_252.gif','s','image','0','0','0','0000-00-00','0','1624','0','','9','1','2010-10-11 17:40:26','2011-01-04 12:52:09','0','0');
INSERT INTO job_ad VALUES('40','yjys','http://192.168.1.200','yjys','','700*60','../upfiles/webads/20101231155343_328.jpg','','image','0','0','0','0000-00-00','0','896','0','','4','1','2010-12-31 15:50:28','2011-01-04 13:05:53','0','0');
INSERT INTO job_ad VALUES('43','撒的撒旦','http://192.168.1.200','是','','100*100','../upfiles/webads/20110109184533_122.gif','','float','0','0','0','0000-00-00','0','1011','0','','11','1','2011-01-09 18:45:43','2011-03-13 22:19:00','0','0');
INSERT INTO job_ad VALUES('44','大股东是风光的 ','','内存才','','100*100','../upfiles/webads/20110109190141_888.gif','','float','0','0','0','0000-00-00','3','1001','0','','11','1','2011-01-09 19:01:48','2011-03-13 22:19:00','0','0');
INSERT INTO job_ad VALUES('46','yjys','http://192.168.1.200','yjys','','700*60','../upfiles/webads/20110301132858_142.jpg','','image','0','0','0','0000-00-00','0','1524','0','','4','1','2011-03-01 13:29:12','2011-03-11 11:25:27','0','0');
INSERT INTO job_ad VALUES('49','资讯页面广告','http://192.168.1.200/admin/index.php','稍等','','260*200','/upfiles/webads/20110305142018_262.jpg','资讯页面广告','image','0','0','0','0000-00-00','0','55','0','','12','4','2011-03-05 14:13:34','2011-03-11 17:09:52','0','0');
INSERT INTO job_ad VALUES('50','head', 'http://www.91rencai.com/', 'head', '', '779*90', '../upfiles/webads/20110412102223_642.jpg', '', 'image', 0, 0, 0, '2011-04-16', 0, 102, 0, '', 18, 1, '2011-04-12 10:22:54', '2011-04-13 14:54:34', 0, 0);
INSERT INTO job_ad VALUES('51','red 中间大ad', 'http://www.91rencai.com/', 'red 中间大ad', '', '962*91', '../upfiles/webads/20110412102824_653.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 91, 0, '', 15, 1, '2011-04-12 10:28:39', '2011-04-13 14:54:36', 0, 0);
INSERT INTO job_ad VALUES('52','品牌广告B2', 'http://www.91rencai.com', '品牌广告B2', '', '310*60', '../upfiles/webads/20100831160751_222.gif', '品牌广告B2', 'image', 0, 0, 0, '0000-00-00', 1, 4747, 0, '', 14, 1, '2010-08-31 16:08:04', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('53','red ad', 'http://www.91rencai.com/', 'red ad', '', '962*91', '../upfiles/webads/20110412104444_889.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 1370, 0, '', 13, 1, '2011-04-12 10:44:56', '2011-04-13 14:54:35', 0, 0);
INSERT INTO job_ad VALUES('54','品牌广告B1', 'http://www.91rencai.com', '品牌广告B1', '', '310*60', '../upfiles/webads/20100831160415_381.gif', '品牌广告B1', 'image', 0, 0, 0, '0000-00-00', 3, 4753, 0, '', 14, 1, '2010-08-31 16:04:31', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('55','品牌广告B', 'http://www.91rencai.com', '品牌广告B', '', '310*60', '../upfiles/webads/20100831160224_361.gif', '品牌广告B', 'image', 0, 0, 0, '0000-00-00', 7, 4755, 0, '', 14, 1, '2010-08-31 16:03:04', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('56','品牌广告B3', 'http://www.91rencai.com', '品牌广告B3', '', '310*60', '../upfiles/webads/20100831160902_792.gif', '品牌广告B3', 'image', 0, 0, 0, '0000-00-00', 1, 4746, 0, '', 14, 1, '2010-08-31 16:09:13', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('57','品牌广告B4', 'http://www.91rencai.com', '品牌广告B4', '', '310*60', '../upfiles/webads/20100831161706_781.gif', '品牌广告B4', 'image', 0, 0, 0, '0000-00-00', 0, 4739, 0, '', 14, 1, '2010-08-31 16:17:19', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('58','品牌广告B5', 'http://www.91rencai.com', '品牌广告B5', '', '310*60', '../upfiles/webads/20100831161740_140.gif', '品牌广告B5', 'image', 0, 0, 0, '0000-00-00', 2, 4738, 0, '', 14, 1, '2010-08-31 16:17:52', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('59','品牌广告B6', 'http://www.91rencai.com', '品牌广告B6', '', '310*60', '../upfiles/webads/20100831162012_245.gif', '品牌广告B6', 'image', 0, 0, 0, '0000-00-00', 0, 4738, 0, '', 14, 1, '2010-08-31 16:20:25', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('60','品牌广告B7', 'http://www.91rencai.com', '品牌广告B7', '', '310*60', '../upfiles/webads/20100831162046_248.gif', '品牌广告B7', 'image', 0, 0, 0, '0000-00-00', 1, 4738, 0, '', 14, 1, '2010-08-31 16:21:00', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('61','品牌广告B9', 'http://www.91rencai.com', '品牌广告B9', '', '310*60', '../upfiles/webads/20100831162226_748.gif', '品牌广告B9', 'image', 0, 0, 0, '0000-00-00', 0, 4737, 0, '', 14, 1, '2010-08-31 16:22:37', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('62','品牌广告B10', 'http://www.91rencai.com', '品牌广告B10', '', '310*60', '../upfiles/webads/20100831162305_994.gif', '品牌广告B10', 'image', 0, 0, 0, '0000-00-00', 0, 4737, 0, '', 14, 1, '2010-08-31 16:23:20', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('63','one', 'http://www.91rencai.com/', 'one', '', '258*58', '../upfiles/webads/20110412112630_454.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 55, 0, '', 16, 1, '2011-04-12 11:26:43', '2011-04-13 14:54:34', 0, 0);
INSERT INTO job_ad VALUES('64','two', 'http://www.91rencai.com/', 'two', '', '258*58', '../upfiles/webads/20110412112707_682.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 35, 0, '', 17, 1, '2011-04-12 11:27:15', '2011-04-13 14:54:35', 0, 0);
INSERT INTO job_ad VALUES('65','a', 'http://www.91rencai.com/', 'a', '', '962*74', '../upfiles/webads/20110412134938_253.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 335, 0, '', 19, 1, '2011-04-12 13:49:49', '2011-04-13 15:44:13', 0, 0);
INSERT INTO job_ad VALUES('66','b', 'http://www.91rencai.com/', 'b', '', '962*74', '../upfiles/webads/20110412135006_999.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 325, 0, '', 20, 1, '2011-04-12 13:50:20', '2011-04-13 15:44:14', 0, 0);
INSERT INTO job_ad VALUES('67','c', 'http://www.91rencai.com/', 'c', '', '240*93', '../upfiles/webads/20110412135358_225.jpg', '', 'image', 0, 0, 0, '0000-00-00', 0, 318, 0, '', 21, 1, '2011-04-12 13:54:16', '2011-04-13 15:44:15', 0, 0);

INSERT INTO job_adplace VALUES('1','网站首页');
INSERT INTO job_adplace VALUES('2','企业招聘');
INSERT INTO job_adplace VALUES('3','会员注册');
INSERT INTO job_adplace VALUES('4','人力资讯');

INSERT INTO job_adsplace VALUES('1','品牌广告A','1','1','1000','月','1*1','970*60');
INSERT INTO job_adsplace VALUES('2','品牌广告B','1','2','1000','月','6*2','318*60');
INSERT INTO job_adsplace VALUES('3','品牌广告E','2','5','1000','月','3*9','100*100');
INSERT INTO job_adsplace VALUES('4','TOP广告A','1','3','1000','月','1*1','700*60');
INSERT INTO job_adsplace VALUES('5','注册广告A','1','4','1000','月','1*1','260*260');
INSERT INTO job_adsplace VALUES('6','品牌广告C','1','6','1000','月','6*2','155*60');
INSERT INTO job_adsplace VALUES('7','品牌广告D','1','7','1000','月','3*6','155*60');
INSERT INTO job_adsplace VALUES('8','品牌广告F','1','8','1000','月','1*2','330*60');
INSERT INTO job_adsplace VALUES('9','品牌广告G','1','9','1000','月','1*1','290*117');
INSERT INTO job_adsplace VALUES('10','漂浮广告','1','10','1000','月','1*1','80*80');
INSERT INTO job_adsplace VALUES('11','对联广告','1','11','1000','月','2*2','80*80');
INSERT INTO job_adsplace VALUES('12','资讯广告A','4','12','1000','月','1*1','260*200');
INSERT INTO job_adsplace VALUES('14','red品牌广告A', 1, 21, 1000, '月', '1*1', '962*91');
INSERT INTO job_adsplace VALUES('15','red品牌广告B', 1, 22, 1000, '月', '6*2', '310*60');
INSERT INTO job_adsplace VALUES('16','red中间大广告', 1, 23, 1000, '月', '1*1', '962*91');
INSERT INTO job_adsplace VALUES('17','red左上第一个', 1, 33, 1000, '月', '1*1', '258*58');
INSERT INTO job_adsplace VALUES('18','red左上第二个', 1, 44, 1000, '月', '1*1', '258*58');
INSERT INTO job_adsplace VALUES('19','red头部ad', 1, 99, 1000, '月', '1*1', '779*90');
INSERT INTO job_adsplace VALUES('20','blue 中间广告a', 1, 66, 1000, '月', '1*1', '962*74');
INSERT INTO job_adsplace VALUES('21','blue 中间广告b', 1, 67, 1000, '月', '1*1', '962*74');
INSERT INTO job_adsplace VALUES('22','blue 底部右边', 1, 69, 1000, '月', '1*1', '218*71');

INSERT INTO job_channel VALUES('1','个人求职','简历','简历','个人求职','个人求职','个人求职','0','0','0','','person','1','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('2','企业招聘','职位','职位','企业招聘','企业招聘','企业招聘','1','0','0','','company','2','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('4','猎头服务','猎头','猎头','猎头服务','猎头服务','猎头服务','3','0','0','','hr','4','0','1','0','0','0','0','0');
INSERT INTO job_channel VALUES('6','人力资讯','新闻','新闻','人力资讯','人力资讯','人力资讯','6','0','0','','article','10','0','1','1','0','0','2','0');
INSERT INTO job_channel VALUES('7','高级人才','人才','人才','高级人才','高级人才','高级人才','7','0','0','','besthr','1','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('8','兼职人才','人才','人才','兼职人才','兼职人才','兼职人才','8','0','0','','sideline','1','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('9','常见问题','帮助','帮助','常见问题','常见问题','常见问题','9','0','0','','help','14','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('10','留言反馈','留言','留言','留言反馈','留言反馈','留言反馈','10','0','0','','guestbook','6','0','1','1','0','0','0','0');
INSERT INTO job_channel VALUES('11','微招聘','','','微招聘,一句话招聘','','','13','0','2','/vhire/','','0','0','1','0','0','0','0','0');
INSERT INTO job_channel VALUES('12','招聘会','','','现场招聘会','','','13','0','2','/zph/','','0','0','1','0','0','0','0','0');

INSERT INTO job_common VALUES('1','关于我们','<div class=\"main_con\"><span style=\"font-family: Verdana;\">\r\n<p>　　上海嘉挚网络科技发展有限公司成立于2006年，业务始于2004年（前身为嘉缘设计工作室），是一家主营网络软件开发、销售及服务等业务的高新技术企业，拥有互联网著名品牌&ldquo;嘉缘&reg;&rdquo;和&ldquo;FineReason&reg;&rdquo;。公司的网站（finereason.com）和技术论坛(bbs.finereason.com)是目前国内极具影响力的服务型网站和论坛。</p>\r\n<p>　　公司拥有一流的软件产品设计和开发团队，具有丰富的网络应用软件设计开发经验，尤其在网络人才招聘网站管理系统开发及相关领域，经过长期创新性开发，掌握了一整套从算法、数据结构到产品安全性方面的领先技术，使得产品无论在稳定性、代码优化、运行效率、负载能力、安全等级、功能可操控性和权限严密性等方面都居国内外同类产品领先地位。公司始终专注于研发具有自主核心技术和知识产权的软件产品，主要产品嘉缘&reg;人才系列产品是当前国内最具性价比、最受欢迎的HRCMS和电子商务系统，目前已有超过数万个网站的应用规模，并拥有上千名商业用户，涉及到政府、企业、科研教育和媒体等各个行业领域，拥有国内近30%的市场份额，牢牢占据行业第一的席位。</p>\r\n<p>　　公司以&ldquo;用心服务　诚信付出&rdquo;为核心理念，致力为用户提供最优秀的网站建设和网络招聘平台解决方案及相关咨询、培训和实施服务。公司视服务为企业生命，视客户为企业之本，以服务客户为企业宗旨，努力提升服务水平，以优秀服务为客户节约成本、创造价值，赢得了广大用户的信赖与支持。公司拥有一批资深的专业技术人员、企业咨询顾问和项目管理专家，建立了规模化的产品研发、咨询、销售和服务体系，并基于先进的项目管理和知识管理模式，为客户提供优质的产品和服务。</p>\r\n</span></div>','about','aboutus','1','0','2010-12-27 14:30:40','1','0');
INSERT INTO job_common VALUES('2','服务条款','<p><span class=\"l_14\">1. 服务条款的接受</span><br />　　本服务条款所称的用户是指完全同意所有条款并完成注册程序或未经注册而使用嘉缘人才网的服务的用户。<br /><span class=\"l_14\">2. 服务条款的变更和修改</span><br />　　嘉缘人才网有权随时对服务条款进行修改，并且一旦发生服务条款的变动，嘉缘人才网将在页面上提示修改的内容；当用户使用嘉缘人才网的特殊服务时，应接受嘉缘人才网随时提供的与该特殊服务相关的规则或说明，并且此规则或说明均构成本服务条款的一部分。用户如果不同意服务条款的修改，可以主动取消已经获得的网络服务；如果用户继续享用网络服务，则视为用户已经接受服务条款的修改。<br /><span class=\"l_14\">3. 服务说明</span><br />　　（1） 嘉缘人才网运用自己的操作系统通过国际互联网向用户提供丰富的网上资源，包括各种信息工具、网上论坛、个性化内容等（以下简称本服务）。除非另有明确规定，增强或强化目前服务的任何新功能，包括新产品，均无条件地适用本服务条款。<br />　　（2） 嘉缘人才网对网络服务不承担任何责任，即用户对网络服务的使用承担风险。嘉缘人才网不保证服务一定会满足用户的使用要求，也不保证服务不会受中断，对服务的及时性、安全性、准确性也不作担保。<br />　　（3） 为使用本服务，用户必须：<br />　　　　　a自行配备进入国际互联网所必需的设备，包括计算机、数据机或其他存取装置；<br />　　　　　b自行支付与此服务有关的费用。<br />　　（4）用户接受本服务须同意：<br />　　　　　a. 提供完整、真实、准确、最新的个人资料；<br />　　　　　b. 不断更新注册资料，以符合上述（4）.a的要求。<br />　　若用户提供任何错误、不实、过时或不完整的资料，并为嘉缘人才网所确知；或者嘉缘人才网有合理理由怀疑前述资料为错误、不实、过时或不完整，嘉缘人才网有权暂停或终止用户的帐号，并拒绝现在或将来使用本服务的全部或一部分。<br /><span class=\"l_14\">4. 用户应遵守以下法律及法规：</span><br />　　用户同意遵守《中华人民共和国保守国家秘密法》、《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》等有关计算机及互联网规定的法律和法规、实施办法。在任何情况下，嘉缘人才网合理地认为用户的行为可能违反上述法律、法规，嘉缘人才网可以在任何时候，不经事先通知终止向该用户提供服务。<br />用户应了解国际互联网的无国界性，应特别注意遵守当地所有有关的法律和法规。<br /><span class=\"l_14\">5. 用户隐私权制度</span><br />　　当用户注册嘉缘人才网的服务时，用户须提供相关个人信息。嘉缘人才网收集个人信息的目的是为用户提供尽可能多的个人化网上服务以及为广告商提供一个方便的途径来接触到适合的用户，并且可以发送具有相关性的内容和广告。<br />在以下（包括但不限于）几种情况下，嘉缘人才网有权使用用户的个信息：<br />　　（1）在进行促销或抽奖时，嘉缘人才网可能会与赞助商共享用户的个人信息。<br />　　（2）嘉缘人才网可以将用户信息与第三方数据匹配。<br />　　（3）嘉缘人才网会通过透露合计用户统计数据，向未来的合作伙伴、广告商及其他第三方以及为了其他合法目的而描述嘉缘人才网的服务。<br />　　（5）嘉缘人才网不能确信或保证任何个人信息的安全性，用户须自己承担风险。比如用户联机公布可被公众访问的个人信息时，用户有可能会收到未经用户同意的消息；嘉缘人才网的合作伙伴和可通过嘉缘人才网访问的第三方因特网站点和服务或通过抽奖、促销等活动得知用户个人信息的其他第三方会进行独立的数据收集工作等活动，嘉缘人才网对用户及其他任何第三方的上述行为，不负担任何责任。<br /><span class=\"l_14\">6. 用户帐号、密码和安全</span><br />　　用户一旦注册成功，便成为嘉缘人才网的合法用户，将得到一个密码和帐号。用户有义务保证密码和帐号的安全。用户对利用该密码和帐号所进行的一切活动负全部责任；因此所衍生的任何损失或损害，嘉缘人才网无法也不负担任何责任。<br />用户的密码和帐号遭到未授权的使用或发生其他任何安全问题，用户可以立即通知嘉缘人才网，并且用户在每次连线结束，应结束帐号使用，否则用户可能得不到嘉缘人才网的安全保护。<br /><span class=\"l_14\">7. 对用户信息的存储和限制</span><br />　　嘉缘人才网不对用户所发布信息的删除或储存失败负责。嘉缘人才网有权判断用户的行为是否符合嘉缘人才网服务条款规定的权利，如果嘉缘人才网认为用户违背了服务条款的规定，嘉缘人才网有中断向其提供网络服务的权利。<br /><span class=\"l_14\">8. 禁止用户从事以下行为：</span><br />　　（1） 上载、张贴、发送电子邮件或传送任何非法、有害、胁迫、骚扰、侵害、中伤、粗俗、猥亵、诽谤、淫秽、侵害他人因隐私、种族歧视或其他另人不快的包括但不限于资讯、资料、文字、软件、音乐、照片、图形、信息或其他资料（以下简称内容）。<br />　　（2） 以任何方式危害未成年人。<br />　　（3） 冒充任何人或机构，或以虚伪不实的方式谎称或使人误认为与任何人或任何机构有关。<br />　　（4） 伪造标题或以其他方式操控识别资料，使人误认为该内容为嘉缘人才网所传送。<br />　　（5） 将无权传送的内容（例如内部资料、机密资料）进行上载、张贴、发送电子邮件或以其他方式传送。<br />　　（6） 将侵犯任何人的专利、商标、著作权、商业秘密或其他专属权利之内容加以上载、张贴、发送电子邮件或以其他方式传送。<br />　　（7） 将广告函件、促销资料、\"垃圾邮件\"等，加以上载、张贴、发送电子邮件或以其他方式传送。供前述目的使用的专用区域除外。<br />　　（8） 将有关干扰、破坏或限制任何计算机软件、硬件或通讯设备功能的软件病毒或其他计算机代码、档案和程序之资料，加以上载、张贴、发送电子邮件或以其他方式传送。<br />　　（9） 干扰或破坏本服务或与本服务相连的服务器和网络，或不遵守本服务网络使用之规定。<br />　　（10） 故意或非故意违反任何相关的中国法律、法规、规章、条例等其他具有法律效力的规范。<br />　　（11） 跟踪或以其他方式骚扰他人。<br />用户对经由本服务上载、张贴、发送电子邮件或传送的内容负全部责任对于经由本服务而传送的内容，嘉缘人才网不保证前述内容的正确性、完整性或品质。用户在接受本服务时，有可能会接触到令人不快、不适当或令人厌恶的内容。在任何情况下，嘉缘人才网均不对任何内容负责，包括但不限于任何内容发生任何错误或纰漏以及衍生的任何损失或损害。嘉缘人才网有权（但无义务）自行拒绝或删除经由本服务提供的任何内容。用户使用上述内容，应自行承担风险。<br />嘉缘人才网有权利在下述情况下，对内容进行保存或披露：<br />　　（1） 法律程序所规定；<br />　　（2） 本服务条款规定；<br />　　（3） 被侵害的第三人提出权利主张；<br />　　（4） 为保护嘉缘人才网、其使用者及社会公众的权利、财产或人身安全。<br />　　（5） 其他嘉缘人才网认为有必要的情况。<br /><span class=\"l_14\">9. 关于用户在嘉缘人才网的公开使用区域发布内容：</span><br />　　（1）\"公开使用区域\"指一般公众可以使用的区域；<br />　　（2）用户在本服务公开的使用区域发布的内容，则视为用户授权嘉缘人才网免费使用权及非独家使用权，嘉缘人才网有权为展示、散布及推广前述发布的内容之服务目的，对上述内容进行复制、修改、出版。本使用权持续到用户将上述内容在本服务中删除。<br />　　（3）因用户进行上述发布，而导致任何第三方提出索赔要求或衍生的任何损害或损失，用户承担全部责任。<br /><span class=\"b_12\">10 用户不得对本服务进行复制、出售或用作其他商业用途。</span><br /><span class=\"b_12\">11 嘉缘人才网有权规定并修改使用本服务的一般措施，如嘉缘人才网未能储存或删除本服务的内容或其他讯息，嘉缘人才网不负担任何责任。对于用户长时间未使用的帐号，嘉缘人才网有权予以关闭。</span><br /><span class=\"l_14\">12 与广告商的商业交易</span><br />　　用户经由本服务与广告商进行通讯联系或商业往来或参与促销活动，完全属于用户与广告商之间的行为，与嘉缘人才网没有任何关系，对于前述交易或前述广告商因本服务所生之任何损害或损失，嘉缘人才网不承担任何责任。嘉缘人才网没有义务对广告及广告商进行甄别或审查。<br /><span class=\"l_14\">13 关于链接</span><br />　　本服务可能会提供与其他国际互联网网站或资源进行链接。对于前述网站或资源是否可以利用，嘉缘人才网不予担保。因使用或依赖上述网站或资源所生的损失或损害，嘉缘人才网也不负担任何责任。<br /><span class=\"l_14\">14 嘉缘人才网的知识产权及其他权利</span><br />　　（1）嘉缘人才网对本服务及本服务所使用的软件包含受知识产权或其他法律保护的资料享有相应的权利；<br />　　（2）经由本服务传送的资讯及内容，受到著作权法、商标法、专利法或其他法律的保护；未经嘉缘人才网明示授权许可，用户不得进行修改、出租、散布或衍生其他作品。<br />　　（3）用户对本服务所使用的软件有非专属性使用权，但自己不得或许可任何第三方复制、修改、出售或衍生产品。<br />　　（4） 嘉缘人才网，嘉缘人才网设计图样以及其他嘉缘人才网图样、产品及服务名称，任何人不得使用、复制或用作其他用途。<br /><span class=\"l_14\">15 免责声明</span><br />　　（1） 嘉缘人才网对于任何包含、经由或连接、下载或从任何与有关本服务所获得的任何内容、信息或广告，不声明或保证其正确性或可靠性；并且对于用户经本服务上的广告、展示而购买、取得的任何产品、信息或资料，嘉缘人才网不负保证责任。用户自行负担使用本服务的风险。<br />　　（2） 嘉缘人才网有权但无义务，改善或更正本服务任何部分之任何疏漏、错误。<br />　　（3） 嘉缘人才网不保证（包括但不限于）：<br />　　本服务适合用户的使用要求；b本服务不受干扰，及时、安全、可靠或不出现错误；c用户经由本服务取得的任何产品、服务或其他材料符合用户的期望；<br />　　（4） 用户使用经由本服务下载的或取得的任何资料，其风险自行负担；因该使用而导致用户电脑系统损坏或资料流失，用户应负完全责任；<br />　　（5） 基于以下原因而造成的利润、商业信誉、资料损失或其他有形或无形损失，嘉缘人才网不承担任何直接、间接、附带、衍生或惩罚性的赔偿：a本服务使用或无法使用；b经由本服务购买或取得的任何产品、资料或服务；c用户资料遭到未授权的使用或修改；d其他与本服务相关的事宜。<br />　　（6） 用户在浏览网际网路时自行判断使用嘉缘人才网的检索目录。该检索目录可能会引导用户进入到被认为具有攻击性或不适当的网站，嘉缘人才网没有义务查看检索目录所列网站的内容，因此，对其正确性、合法性、正当性不负任何责任。<br /><span class=\"b_12\">16 赔偿由于用户经由本服务张贴或传送内容、与本服务连线、违反本服务条款或侵害其他人的任何权利导致任何第三人提出权利主张，用户同意赔偿嘉缘人才网及其分公司、关联公司、代理人或其他合作伙伴及员工，并使其免受损害。</span><br /><span class=\"l_14\">17 服务的修改和终止</span><br />　　嘉缘人才网有权在任何时候，暂时或永久地修改或终止本服务（或任何一部分），无论是否通知。嘉缘人才网对本服务的修改或终止对用户和任何第三人不承担任何责任。嘉缘人才网有权基于任何理由，终止用户的帐号、密码或使用本服务，或删除、转移用户存储、发布在本服务的内容，嘉缘人才网采取上述行为均不需通知，并且对用户和任何第三人不承担任何责任。<br /><span class=\"l_14\">18 通知</span><br />　　嘉缘人才网向用户发出的通知，采用电子邮件或页面公告或常规信件的形式。服务条款的修改或其他事项变更时，嘉缘人才网将以上述形式进行通知。<br /><span class=\"b_12\">19 本服务条款规范用户使用本服务，将取代用户先前与嘉缘人才网签署的任何协议。本服务条款和嘉缘人才网的其他服务条款、协议构成完整的协议。</span><br /><span class=\"l_14\">20 法律的适用和管辖</span><br />　　本服务条款的生效、履行、解释及争议的解决均适用中华人民共和国法律，仲裁裁决是终局的。本服务条款因与中华人民共和国现行法律相抵触而导致部分无效，不影响其他部分的效力。</p>','about','service','1','0','2010-12-27 14:33:41','1','0');
INSERT INTO job_common VALUES('3','法律声明','<p>　　若要访问和使用嘉缘人才网站，您必须不加修改地完全接受本协议中所包含的条款、条件和嘉缘人才网站即时刊登的通告，并且遵守有关互联网、万维网及/或本网站的相关法律、规定与规则。一旦您访问、使用了嘉缘人才网站，即表示您同意并接受了所有该等条款、条件及通告。 <br /><span class=\"l_14\">本网站上的信息</span><br />　　本网站上关于嘉缘人才网站会员或他们的产品（包括但不限于公司名称、联系人及联络信息，产品的描述和说明，相关图片、视讯等）的信息均由会员自行提供，会员依法应对其提供的任何信息承担全部责任。嘉缘人才网站对此等信息的准确性、完整性、合法性或真实性均不承担任何责任。此外，嘉缘人才网站对任何使用或提供本网站信息的商业活动及其风险不承担任何责任。</p>\r\n<p>　　未经合法权利人的书面许可，任何人严禁在本网站展示产品图片。任何未经授权便在本网站上使用该图片都可能违反国际法，商标法，隐私权法，通讯、通信等法律法规。 浏览者可以下载本网站上显示的资料，但这些资料只限用于个人学习研究使用，不得用于任何商业用途，无论是否在资料上明示，所有此等资料都是受到版权法的法律保护。</p>\r\n<p>　　浏览者没有获得嘉缘人才网站或各自的版权所有者明确的书面同意下，不得分发、修改、散布、再使用、再传递或使用本网站的内容用于任何公众商业用途。 <br /><span class=\"l_14\">免责声明</span><br />　　嘉缘人才网站公司在此特别声明对如下事宜不承担任何法律责任： <br />　　（一）嘉缘人才网站在此声明，对您使用网站、与本网站相关的任何内容、服务或其它链接至本网站的站点、内容均不作直接、间接、法定、约定的保证。 <br />　　（二） 无论在任何原因下（包括但不限于疏忽原因），对您或任何人通过使用本网站上的信息或由本网站链接的信息，或其他与本网站链接的网站信息所导致的损失或损害（包括直接、间接、特别或后果性的损失或损害，例如收入或利润之损失，电脑系统之损坏或数据丢失等后果），责任均由使用者自行承担（包括但不限于疏忽责任）</p>\r\n<p>　　使用者对本网站的使用即表明同意承担浏览本网站的全部风险，由于嘉缘人才网站、嘉缘人才网站运营商或嘉缘人才网站关联公司未参与建设、制作或发展本网站或提供内容，对使用者在本网站存取资料所导致的任何直接、相关的、后果性的、间接的或金钱上的损失不承担任何责任。</p>\r\n<p><span class=\"l_14\">网站使用 </span><br />　　不要在简历中心公布不完整、虚假或不准确的简历资料，不要公布不是简历的资料，如意见、通知、商业广告或其他内容。 <br />任何一位使用者经嘉缘人才网管理员确定已违反了网站使用规则某一项规定，我们将暂停或终止对该使用者的服务。 <br />　　嘉缘人才网?在不公开姓名的情况下，可以向第三方提供综合性的资料。在没有本人事先同意的情况下，嘉缘人才网不会向第三方公开你的姓名、地址、电子邮件和电话。</p>','about','enactment','1','0','2010-12-27 14:34:52','1','0');
INSERT INTO job_common VALUES('4','隐私声明','<p>　　尊重用户的隐私权是嘉缘人才网的基本原则。以下即是当用户使用嘉缘人才网提供的各种服务时，嘉缘人才网的隐私策略。以下策略可能会因为嘉缘人才网为用户提供更多不同的服务而有所改动，有关条款一旦发生变动，将会在重要页面上进行说明并立即生效。如果不同意被修改内容，用户可以主动取消已获得的网络服务。如果用户继续享用网络服务，则视为接受隐私策略的变动。故建议用户定期查阅。</p>\r\n<p><span class=\"b_12\">嘉缘人才网收集会员的个人信息</span>　　<br />嘉缘人才网主要收集用户在嘉缘人才网注册为会员时所提交的个人信息。通过这些注册信息，对会员进行综合统计分析。依据相关统计分析结果，对我们的会员进行分类，例如：行业、国家等，以便有针对性的为我们的会员提供更新更有效的服务。我们将通过会员提供的的电子邮件地址与会员联系而提供以上服务。对会员的了解，将有助于嘉缘人才网为会员提供更好的服务。</p>\r\n<p><span class=\"b_12\">嘉缘人才网收集的个人信息内容　</span>　<br />嘉缘人才网与会员之间、会员与会员之间的信息传递等活动需要我们收集会员的姓名与电子邮件地址。会员亦应提供相关公司信息：公司名称、地址、电话和传真号码、网址、公司描述、行业以及员工数等。会员可以通过在嘉缘人才网注册的登录名和密码登录嘉缘人才网，随时更新维护以上信息。</p>\r\n<p><span class=\"b_12\">嘉缘人才网会收集有关用户的其他信息</span>　　<br />除以上会员注册信息外，我们还收集可供嘉缘人才网及其商业伙伴参考或使用的隐含信息。这不是对个人身份识别所用的信息，但有助于市场分析和提高我们的服务质量，另外，也是防止嘉缘人才网受到恶意攻击的必要措施。此类信息来自\"用户访问记录\"，因而有必要使用\"Cookies\"，\"IP 地址\"或其它数字识别用于识别用户。在嘉缘人才网的注册、登录或个性化定制均要求用户接受\"Cookies\"。</p>\r\n<p><span class=\"b_12\">会员的个人信息会处理</span>　　<br />嘉缘人才网的会员信息储存在安全的不向公众公开的系统中。嘉缘人才网尊重会员的个人信息隐私，不会向第三方公开。<br />但不排除以下必需情况：<br />（1）相应的法律或程序要求嘉缘人才网提供用户的个人资料；<br />（2）在需要保障嘉缘人才网的正当权益情况下；<br />（3）执行嘉缘人才网的服务条款的需要；<br />（4）在维护嘉缘人才网用户和社会公众的正当利益要求下。 　　 <br />嘉缘人才网在注册会员信息的基础上会进行相关行业、地理等统计分析操作。这样的工作是为了更好的了解客户的需求及为会员提供更好的服务。嘉缘人才网保留将此类统计分析提供给收费客户及商业伙伴的权利。</p>\r\n<p><span class=\"b_12\">第三方信息</span>　　<br />在尊重用户个人隐私的基本原则下，我们不会向第三方公开会员的个人信息，除非我们得到会员的授权或在某些特殊情况要求时。我们仅将此类信息提供给我们的商业合作伙伴和赞助人作为市场用途。另外，嘉缘人才网在法律要求的情况下或进行必要的管理、维护、服务等工作时，可以提供相关会员信息。</p>\r\n<p><span class=\"b_12\">承担的责任</span><br />用户一旦在嘉缘人才网注册成功，我们将尽力保障会员的个人信息在嘉缘人才网系统中的安全，不向第三方泄露。嘉缘人才网不承担因网络传输不可保障100％的安全性而引起的风险，也不对此作任何类型的担保。</p>\r\n<p><span class=\"b_12\">保障个人信息的安全</span>　　<br />用户在嘉缘人才网注册成为会员，将得到仅供会员使用的登录名和密码。会员可以随时通过登录名和密码登录嘉缘人才网，对这些信息进行修改。故我们建议会员不要泄漏登录名和密码给他（她）人，以保障个人信息的安全。 　　<br />会员在嘉缘人才网上提交的供商业用途的信息会对所有用户公开。</p>\r\n<p><span class=\"b_14\">故请注意：</span><span class=\"b_12\">会员应谨慎在公共区域公布相关个人信息。</span></p>','about','secret','1','0','2010-12-27 14:35:33','1','0');
INSERT INTO job_common VALUES('5','广告服务','<p><strong><span class=\"l_14\">广告互换 </span></strong><br />您可以利用现有的广告资源（如：广告位，资讯，新闻，业界动态等）与我们互换。在合理调整资源的同时，达到良好的宣传效果。 广告资源互换合作协议书 <br /><strong></strong></p>\r\n<p><strong><span class=\"l_14\">广告发布 </span></strong><br />&ldquo;就要人才网&rdquo; 向所有有需求的客户提供广告服务，广告收费标准参见 广告资源收费标准。</p>\r\n<p><span class=\"b_12\">　　　　　　　　　　　　　　　　<strong>　广告资源互换合作协议书 </strong></span></p>\r\n<p><span class=\"b_12\"><strong></strong></span><br />甲方：上海嘉挚网络科技发展有限公司（嘉缘人才网） <br />乙方：　　　</p>\r\n<p>　　为了推动中国互联网事业，促进合作双方的企业发展，更好地为广大行业互联网用户服务，甲乙双方本着平等互利，共同发展，优势互补的原则，甲方版权所属网站：嘉缘人才网上海嘉挚网络科技发展有限公司（<a href=\"http://www.finereason.com\">http://www.finereason.com</a>）与乙方版权所属网站：<span style=\"text-decoration: underline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>经友好协商，在合作意向上达成一致，结为合作伙伴，甲方以协议规定的方式，向乙方免费提供人才职业信息，乙方完善频道建设，充分保证双方的权益。现就双方合作的具体事宜及双方的权力与义务达成如下协议： <br />第一条：合作内容　 <br />1. 甲方将其网站&ldquo;嘉缘人才网&rdquo; 与乙方版权所属网站&ldquo;<span style=\"text-decoration: underline;\">　　　　</span>&rdquo;进行合作，合作期内甲方在首页 &ldquo;<span style=\"text-decoration: underline;\">　　　　</span>&rdquo;和乙方进行广告互换合作。尺寸为<span style=\"text-decoration: underline;\">　　　，</span>时间为<span style=\"text-decoration: underline;\">　　　</span>至<span style=\"text-decoration: underline;\">　　　</span>。价值为<span style=\"text-decoration: underline;\">　　　</span>。<br />2. 经平等协商所有互换合作广告都为免费的合作。<br />3. 上述所有图形LOGO均由双方自行设计，版权归制作方所有。</p>\r\n<p>第二条：乙方的职责　　 <br />1． 在乙方网站\"<span style=\"text-decoration: underline;\">　　　　　</span>\"中为甲方\"嘉缘人才网\"增加广告尺寸为<span style=\"text-decoration: underline;\">　　　　</span>，时间为<span style=\"text-decoration: underline;\">　　　　</span>至<span style=\"text-decoration: underline;\">　　　　</span>，价值为<span style=\"text-decoration: underline;\">　　　　</span>。设置嘉缘人才网提供的网络路径；　<br />2． 负责合作页面的页眉及页脚模板的制作；</p>\r\n<p>第三条：商业秘密<br />1. 甲乙双方应对其通过工作接触和通过其他渠道得知的有关对方的商业秘密严格保密，未经对方事先书面同意，不得向其他人披露。 　　 <br />2. 除本协议规定之工作所需外未经对方事先同意，不得擅自使用、复制对方的商标、标志、商业信息、技术及其他资料。　　</p>\r\n<p>第五条：声明　　<br />1.甲乙双方之间结为战略合作伙伴关系。<br />2. 甲乙双方信息资源互享，各自保证其网站内信息来源的真实性、准确性与时效性。　　<br />3. 甲乙双方在网站或频道的推广和宣传过程中同行共勉、紧密合作。　　<br />4. 甲乙双方就各自的经营和提供的服务内容承担责任，享有收益和版权。　　<br />5. 如果由于网站版面更新或改动。原来的链接位置不再存在，双方必须将新的链接摆放位置调整至保证与原本效果相当的位置。　　<br />6.本协议期限满，双方优先考虑与对方续约合作。　　<br />7. 双方的合作关系是互利互惠的，所有内容与服务提供均为相互免费。</p>\r\n<p>第六条：协议执行期限　　 <br />本协议书有效期为壹年，自　　 年　　月　　日至　　 年　　月　　日为本协议商定合作方案的执行期限。　　</p>\r\n<p>第七条：协议的终止　　 <br />本协议因以下任何原因而终止：　　 <br />1. 本协议期限届满。　　 <br />2. 双方协商同意终止本合同。如有任何一方欲终止此合同，需提前一个月通知对方。　　</p>\r\n<p>第八条：争议的解决 　　 <br />如甲乙双方在本协议的条款范围内发生纠纷，应尽量协商解决，协商不能达成一致意见时，提请仲裁委员会仲裁解决。　　</p>\r\n<p>第九条：不可抗力　　 <br />因地震、火灾等自然灾害、战争、罢工、停电、政府行为等造成双方不能履行本协议义务，双方通过书而后形式通知对方，本协议即告中止。 　　 <br />第十条：本协议一式二份，双方各执一份，经双方签字盖章有效。本协议及其相关附件具有同等法律效力。</p>\r\n<p>甲方：（嘉缘人才网）上海嘉挚公司 乙方：</p>\r\n<p><br />代表签字：　　　　　　　　　　　　　 代表签字：</p>\r\n<p><br />盖章：　　　　　　　　　　　　　　　　盖章：</p>\r\n<p><br />日期：　年　月　日　　　　　　　　　　日期：　年　月　日</p>','about','ads','1','0','2010-12-27 14:41:19','1','0');
INSERT INTO job_common VALUES('6','合作代理','<p><strong><span class=\"b_14\">加盟代理</span></strong></p>\r\n<p><strong></strong><br />　　 企业人力资源服务体系的领航者,个人求职者的乐园,最专业的人才网站---一个不断为企业和个人创造价值的商务传媒</p>\r\n<p><span class=\"l_14\">一、网络产业，事业平台 ：</span><br />网络以其成本低、传播范围广、服务时间长、信息容量大、信息检索方便、即时性和交互性等突出特点，飞速改变着我们的世界。 <br />作为最具发展力的新锐传媒和商务平台，网络都有广阔的市场前景。</p>\r\n<p><span class=\"l_14\">二、超低投入，打开财富之门 ：</span><br />　　 如果你具有在某地区、某行业的资源优势和市场拓展能力，嘉缘人才网将免费输出\"业务整体运营方案\"，通过连锁合作，您将高起点运作一个带来财富的商务网站！ <br />　　 1、无须承担网站建设、开发、升级的费用! <br />　　 2、无须承受服务器、带宽之困扰! <br />　　 3、无须承受设计赢利点的绞尽脑汁! <br />　　 4、无须承担网络投入的风险! <br />　　 5、无须承受经营之道探索之曲折!</p>\r\n<p class=\"b_14\">嘉缘人才网简介</p>\r\n<p><span class=\"l_14\">1、 市场广阔</span><br />　　 当前中国有1800万家企业，每家企业都有招聘需求，而网上招聘正日益受到现代企业的重视和青睐。根据iresesrch艾瑞市场咨询（2003年中国网上招聘研究报告）的研究数据显示，2003年中国网上招聘的市场规模为3.1亿元人民币左右，到2006年将增长为16.5亿元人民币，平均增长率为75.35％。<br />嘉缘人才网的受众群体为具有大中专以上学历层次的个人以及广大的企业等。嘉缘人才网的业务集合了当前国际人力资源发展趋势中最具盈利潜力的种类。</p>\r\n<p><span class=\"l_14\">三、代理嘉缘人才网业务的运营成本极低</span><br /><span class=\"b_12\">业务可快速发展：</span><br />网上招聘的运营模式简单，业务发展成本很低，所以可快速的发展更大的客户群。<br /><span class=\"b_12\">充分利用现有客户资源：</span><br />嘉缘的人力资源系列产品，代理商可充分利用现有的客户群，无须投入太多的成本开发。<br /><span class=\"b_12\">无压货成本：</span><br />解决企业人力资源相关的需求及人才招聘的所有环节都可以通过信息化流程实现，代理商无须仓储，不存在任何压货、压资金成本，经营风险非常小。<br /><span class=\"b_12\">售后服务成本极低 </span><br />嘉缘完善的售后体系向代理商提供快速、高效、优良的服务支持，保证代理商的售后服务成本最小。<br />　　 <br /><span class=\"l_14\">四、加盟条件 ： </span><br />1、经工商注册的独立法人单位；可以独立承担民事责任的法人机构。<br />2、具有市场运作能力，与某地区或各行业有着良好的业务沟通渠道。<br />3、了解并熟悉嘉缘人才网站所提供的各项产品服务概念及动作流程。　　<br />4、明确承诺和严格执行协议和合同中的有关保密条款，尊重和保护\"嘉缘人才网体系\"的知识产权，不得与第三方发展连锁加盟关系。<br />5、具有连锁经营管理费用支付能力，保证业务能正常开展。<br />6、拥有正常经营所需的电脑等设备设施。 <br />7、能独立开合法的服务性票据。<br />8、具有懂网络、能开拓市场的营销人员。</p>\r\n<p><span class=\"l_14\">五、申请加盟成为连锁经营商的步骤</span><br />1、直接致电或致函嘉缘人才网营销中心提出申请，并提供相关的资质文件。<br />2、与嘉缘人才网营销负责人进行洽谈，了解和认同连锁经营代理政策、产品内容和价格体系。<br />3、在认可连锁经营政策、产品内容和价格体系的基础上，与嘉缘人才网签署正式合同及相关文件。<br />4、按照合同规定，以指定方式向嘉缘人才网指定帐户支付加盟连锁经营代理预付款。<br />5、嘉缘人才网在确认收到上述预付款后，以电子邮件方式向对方发出使用权限和密码，同时发放&ldquo;嘉缘人才网连锁经营代理授权书&rdquo;。<br /><span class=\"l_14\">嘉缘人才网加盟及代理协议</span><br /><span class=\"b_12\">甲方：</span> 　　　　　　　　　　　　　　　　　　　　　　　乙方：<br />法定地址：　　　　　　　　　　　　　　　　　　　　　 法定地址：</p>\r\n<p>双方根据中华人民共和国合同法的相关精神，本着互利互惠、资源互补、合作共赢的原则，经充分协商，一致同意签订如下嘉缘人才网加盟代理经营协议条款。本合同所指的网站是嘉缘热线嘉缘人才网。<br /><span class=\"b_12\">一、合作内容：</span><br />经双方协商一致，乙方在指定期限内代理甲方所有&ldquo;人力资源&rdquo;服务产品的推广及在**专区的销售业务，产品及服务说明以甲方的公告为准。<br /><span class=\"b_12\">二、权利与义务： </span><br />（一）、甲方的权利与义务<br />1、 甲方在签署本协议后二个工作日内，在乙方向甲方缴纳加盟费后，甲方发给授权书；并赋予乙方编辑权限，但编辑后的信息，需经甲方审核后再开通；<br />2、甲方负责网站经营、更新、管理，并拥有网站的全部自主权。有权对乙方发布的信息进行审核，对认为不适宜在网站发布的信息，可拒绝发布；<br />3、合作期间，配合乙方进行市场宣传，在甲方嘉缘人才网的首页开设：嘉缘人才网－ 分站，并加上乙方的链接； <br />3、甲方保证网站正常、高效、不间断的运转，并协助乙方开展市场推广；<br />4、甲方确定专人负责与乙方的指导协调工作，以保证代理工作 高效有序的进行；<br />5、甲方有义务对乙方进行业务培训，原则上甲方开展的所有业务培训均是免费（教材工本费例外）；　　<br />6、甲方对乙方提交的业务订单，甲方确认乙方在收到客户的款项后，按照客户缴费情况在一个工作日内开通服务（法定节假日或公休日顺延）；<br />7、负责处理客户对产品功能性问题的投诉，提供热线电话021－51699591；<br />8、根据产品开通的统计情况，负责每月对乙方提供的缴费客户数据、缴费总费用进行校对；<br />9、甲方持续完善代理服务系统，以方便和支持乙方开展代理业务；<br />10、甲方根据市场情况不定期举办代理商研讨会、培训活动。<br />11、甲方为乙方的客户开具相关发票。乙方每月5日前应向甲方结清上月的业务订单金额；<br />12、乙方向甲方提供代理人资质证件或身份证复印件及担保单位担保书。<br />　 （二）、乙方的权利与义务<br />1、 乙方为甲方授权的地区二级代理商，乙方有权在**市所属县/区范围内，开展甲方授权的的经营活动，促进甲方的业务在当地发展； <br />2、 在本合同有效期内，甲方在 地区不得发展第二家二级代理商；<br />3、乙方在甲方的网页上开设：嘉缘人才网－ 分站，并加上乙方的链接；乙方的网页版面风格保持与嘉缘人才网首页版面风格类同；<br />4、乙方向客户进行甲方产品的销售，在维护甲方品牌的条件下，自行负责开拓市场与发展客户；<br />5、在代理业务中保证向客户提供良好的服务，不得以欺诈、肋迫等不正当手段损害客户及甲方的利益及声誉；<br />6、按照甲方审定同意的收费标准向终端客户收取服务费用；<br />7、乙方网页上发布的所有信息，必须真实可靠，否则,由此造成的一切后果,均由乙方承担其法律责任，并且甲方有权单方面撤除其在本网站上发布的信息，并不退相关费用； <br />8、 乙方应确保自己客户及时付款，当乙方在收到客户的服务费用后，方能为客户办理发布信息手续；<br />9、 每天汇总当天缴费信息，包括注册客户资料、缴费客户名、服务期限、缴费金额，通过代理管理平台把缴费信息传递给甲，方便甲方系统对缴客房及时开通；<br />10、 负责对客户关于产品缴费、服务、开通等问题的咨询或投诉在一个工作日内处理，并且提供咨询电话 ；<br />11、 乙方填写的资料为有效联系依据，如乙方的电子邮件、地址、联系人等资料变动时，须及时以传真方式（单位代理加盖公章、个人代理签名并附身份证复印件）通知甲方更新；<br />12、 乙方将应邀参加甲方组织的不定期的代理商探讨会、培训等，并协助甲方处理相关问题；<br />13、向甲方提供合法的代理人资质证件或身份证复印件及担保单位证明书。<br />14、乙方必须每月5日前向甲方结清上月的所有业务款项。 <br /><span class=\"b_12\">三、　　乙方代理的&ldquo;人力资源&rdquo; 服务产品</span><br />（一）、个人服务商品<br />1、 嘉缘求职直通车：为全省各地希望来蓉工作的人员，通过嘉缘人才网的服务体系推荐到**地区的各招聘单位，首次可一周推荐工作5次，直至其找到工作为止。一次性收费为100元/年；<br />2、 嘉缘求职卡：为当地需个性化服务的求职者提供网络在线求职服务，每张卡费为30－100元；<br />3、 跨省劳务输出：为全川民工到全国主要城市务工提供真实有效的用工信息，及资质认证联系，同时提供法律代理服务。每人收费为100元～300元（根据具体情况定价收费）；<br />4、 代理招生：全国各大院校在川的招生代理工作；<br />5、 学生实习：为高校应届毕业生提供实习服务，每人收费为每次200～400元。（根据具体情况定价收费）<br />（二）、企业人力资源服务产品<br />1、招聘会员：为企业在网上招聘提供服务，收费为800元～8000元/年。<br />2、中介会员：为人才、培训、咨询等中介机构提供信息发布服务，收费为600元～8000元/年；<br />3、网络广告：招聘广告、商务广告、培训广告、网站链接等，收费为1000元～150000元；（根据收费标准或具体情况定）<br />4、企业商务邮件：为企业单位提供邮件发送服务，每条收费0.2元～2.00元；<br />5、企业人事外包：为发展中的企业提供完整的人力资源解决方案，包括管理咨询、人才推荐、员工培训、员工档案管理、职称评审、政务代办、社保代办等，收费为50元～500元/人.月；<br />6、 培训会员：为广大企业提供员工培训服务，收费为3000元～20000元；（根据具体情况定价收费）<br />7、 猎头服务：为企业提供高级管理人才和技术人才，以及人才租赁服务。收费标准为年薪的20％～30％；<br />8、 网站建设：借助电信的资源优势以及一流的技术设计开发能力，为企业提供建站和专题网页服务，收费为3000元～50000元。（根据具体情况定价收费）<br />上述部分项目标准可根据当地实际情况作适当地调整，调整后的标准需经甲方同意。<br /><span class=\"b_12\">四、代理合作期限：</span><br />二年，即 　　　　年 　　月 　　日　至 　年 　　　月 　　　日<br /><span class=\"b_12\">五、费用及利益分配 </span><br />1、嘉缘人才网加盟管理费总额为 元，乙方在本协议签订后10日内支付清；<br />2、乙方代理甲方现有的人力资源服务产品和相关的服务产品，甲乙双方按照不同的商品类别分配利益。 　（1）个人服务商品：双方按实收金额扣除税费后的比例分配，该比例为乙方60％，甲方40％。<br />（2）企业服务商品：<br />1、2、3、4、5、五类业务：双方按实收金额扣除税费后的比例分配，该比例为乙方60％，甲方40％。<br />6、7、8三类商品：双方按扣除成本后，各按50％分配。具体项目可商议定夺。<br /><span class=\"b_12\">六、 税费：</span><br />双方按实际收入的分成比例各自承担。<br /><span class=\"b_12\">七、结算方式：</span><br />1、 乙方将每月业务所产生的收入，按甲方应分配的金额，划款到甲方的帐户。同时乙方应根据自己所得的60％或50％的业务收入向甲方出据收据； <br />2、 结算时间：每月5日前乙方必须向甲方结清所有业务款项。<br /><span class=\"b_12\">八、特别约定 </span><br />1、 乙方未经甲方书面许可，不得以甲方的名义从事一切经营活动，否则由此引起的一切后果由乙方自行承担；<br />2、 协议有效期内，除非依据本协议的明确规定，乙方不得擅自使用甲方的品牌和标识。本协议终止之后，乙方无权继续使用甲方的任何资料包括商标、商号、域名以及网站名称等；<br />3、 本协议期满后，在同等条件下，乙方续签有优先权。<br /><span class=\"b_12\">九、保密义务</span><br />1、 一方必须对另一方所获取的商业秘密严格保密，在未事先取得另一方书面同意的情况下，不得向任何第三方披露；<br />2、 甲乙双方对所有的网络产品客户的真实资料负有保密义务，不得向第三方披露或允许第三方使用；3、签约双方对本协议负有保密义务。<br /><span class=\"b_12\">十、违约责任： </span><br />1、 乙方不及时与甲方结清上月款项，逾期3天后，每天按应付款的万分之五点八向甲方支付滞纳金；2、乙方未经甲方同意的价格进行产品销售，甲方有权单方面直接取消乙方的代理资格，并追究乙方违约责任；<br />3、由于甲方过错原因没有把乙方已缴费客户的服务及时开通，或者由于甲方过错原因造成系统不正常运行，由此造成的损失由甲方承担；<br />4、违反&ldquo;保密义务&rdquo;条款，按损失价值的3倍赔偿对方；<br />5、未经甲方同意，以甲方名义从事本协议以外的经营活动，乙方按其收入所得的3倍支付甲方违约金；<br />6、由于一方原因违反本协议其他条款而给另一方造成损失的，违约方应承担由此给另一方造成的一切损失。<br /><span class=\"b_12\">十一、争议的解决方式：</span><br />如发生争议，双方协商解决；若协商不能达成，在原告方所在地法院诉讼解决。<br /><span class=\"b_12\">十二、协议的终止</span><br />　　 本协议有下列任一种情形出现时即终止：<br />1、代理合作期限届满而双方决定不再继续；<br />2、如不可抗力持续30日以上，任何一方均可发出终止本协议的书面通知终止本协议；<br /><span class=\"b_12\">十三、附则</span><br />1、 本协议所涉及金额均为人民币；<br />2、 本协议未尽之事宜，双方另行协商； <br />3、本协议经双方代表签字盖章后生效；<br />4、本协议一式四份，双方各执二份，具有同等法律效力。<br />甲方： 　　　　　　　　　　　　　　　　　 乙方：<br />代表签字（盖章）：　　　　　　　　　　　 代表签字（盖章）：<br />联系电话： 　　　　　　　　　　　　 　　 联系电话：<br />电子邮件： 　　　　　　　　　　　　　 　 电子邮件：<br />日期：　　　　　　　　　　　　　　　　　　　　　 日期：</p>','about','agent','1','0','2010-12-27 14:42:48','1','0');
INSERT INTO job_common VALUES('7','联系我们','<p><span class=\"l_14\"><span style=\"font-family: Verdana;\">公司名称：上海嘉挚网络科技发展有限公司（Chinese Jiazhi Network Tech Corp.）<br />公司地址：中国上海嘉定区宝嘉公路1022号（201800）<br />西安分公司地址：陕西省西安市太白南路5号紫薇尚层西2号楼2201室</span></span></p>\r\n<p><span class=\"l_14\"></span><span class=\"l_14\"><span style=\"font-family: Verdana;\">咨询电话：029-85460076&nbsp; 400-6606-156（免长途费）<br />公司传真：400-6606-156-600</span></span></p>\r\n<p><span class=\"l_14\"><span style=\"font-family: Verdana;\">咨询信箱：<a href=\"mailto:web@finereason.com\">web#finereason.com</a>&nbsp; #换成@<br />技术支持：support#finereason.com&nbsp; #换成@<br />官方网址：<a href=\"http://www.finereason.com/\">http://www.finereason.com</a>&nbsp;&nbsp;&nbsp; <a href=\"http://bbs.finereason.com/\">http://bbs.finereason.com</a></span></span></p>\r\n<p><span class=\"l_14\"><span style=\"font-family: Verdana;\">OICQ咨询：320133800&nbsp; &nbsp;&nbsp; 320133801&nbsp;&nbsp;&nbsp; 320133802&nbsp;&nbsp;&nbsp; 320133803&nbsp;&nbsp;&nbsp; 320133804&nbsp;&nbsp;&nbsp; &nbsp;822922400<br /></span></span></p>','about','contact','1','0','2010-12-27 14:45:35','1','0');
INSERT INTO job_common VALUES('8','会员协议','<p><span style=\"font-family: Verdana;\">{$FR_网站名称}会员协议</span></p>\r\n<p><span style=\"font-family: Verdana;\">{$FR_网站名称}，仅提供求职、招聘、培训信息发布及其他与此相关联之服务。求职者、招聘单位以及因其他任何目的进入本网站的访问者接受本协议书条款，注册成为企业会员，并遵守本协议所述之条款使用本网站所提供之服务。如果你不接受本声明之条款，请勿使用本网站。接受本声明之条款，你将遵守本协议之规定。 <br />1.信息的发布</span></p>\r\n<p><span style=\"font-family: Verdana;\">?不得发布任何违反有关法律规定信息；<br />?不得发布任何与本网站求职、招聘、培训目的不适之信息；<br />?不得发布任何不完整、虚假的信息；<br />?用户对所发布的任何信息承担全部法律责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">2.信息的使用</span></p>\r\n<p><span style=\"font-family: Verdana;\">?招聘单位仅可就招聘目的使用求职者之简历信息；<br />?求职者仅可因应聘某职位，使用招聘单位发布之招聘信息；<br />?本网站提供的其他信息，仅与其相应内容有关的目的而被使用；<br />?不得将任何本网站的信息用作任何商业目的。</span></p>\r\n<p><span style=\"font-family: Verdana;\">3.信息的公开</span></p>\r\n<p><span style=\"font-family: Verdana;\">{$FR_网站名称}所登录的任何信息，均有可能被任何本网站的访问者浏览，也可能被错误使用。本网站对此将不予承担任何责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">4.信息的准确性</span></p>\r\n<p><span style=\"font-family: Verdana;\">任何在本网站发布的信息，均必须符合合法、准确、及时、完整的原则。但本网站将不能保证所有由第三方提供的信息，或本网站自行采集的信息完全准确。使用者了解，对这些信息的使用，需要经过进一步核实。本网站对访问者未经自行核实误用本网站信息造成的任何损失不予承担任何责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">5.信息更改与删除</span></p>\r\n<p><span style=\"font-family: Verdana;\">除了信息的发布者外，任何访问者不得更改或删除他人发布的任何信息。本网站有权根据其判断保留修改或删除任何不适信息之权利。</span></p>\r\n<p><span style=\"font-family: Verdana;\">6.版权、商标权</span></p>\r\n<p><span style=\"font-family: Verdana;\">本网站的图形、图像、文字及其程序等均属{$FR_网站名称}之版权，受商标法及相关知识产权法律保护，未经{$FR_网站名称}书面许可，任何人不得下载、复制、再使用。在本网发布信息之商标，归其相应的商标所有权人，受商标法保护。</span></p>\r\n<p><span style=\"font-family: Verdana;\">7、注册信息使用</span></p>\r\n<p><span style=\"font-family: Verdana;\">注册会员所提供的个人资料将会被{$FR_网站名称}统计、汇总，在我们的严格管理下，为{$FR_网站名称}的广告商及合作者提供依据。{$FR_网站名称}会不定期地通过注册会员留下的电子邮件同该会员保持联系。 </span></p>\r\n<p><span style=\"font-family: Verdana;\">{$FR_网站名称}承诺：在未经访问者授权同意的情况下，{$FR_网站名称}不会将访问者的个人资料泄露给第三方。但以下情况除外。<br />1 ) 根据执法单位之要求或为公共之目的向相关单位提供个人资料；<br />2 ) 由于你将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人资料泄露；<br />3 ) 由于计算机2000年问题、黑客攻击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被窜改等； <br />4 ) 由于与{$FR_网站名称}链接的其他网站所造成之个人资料泄露及由此而导致的任何法律争议和后果；<br />5 ) 为免除访问者在生命、身体或财产方面之急迫危险。</span></p>\r\n<p><span style=\"font-family: Verdana;\">8.自责</span></p>\r\n<p><span style=\"font-family: Verdana;\">所有使用本网站的用户，对使用本网站信息和在本网站发布信息的被使用，承担完全法律责任。本网站对任何因使用本网站而产生的第三方之间的纠纷，不负任何责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">9.服务终止</span></p>\r\n<p><span style=\"font-family: Verdana;\">本网站有权在预先通知或不予通知的情况下终止任何免费服务。</span></p>\r\n<p><span style=\"font-family: Verdana;\">10.争议处理</span></p>\r\n<p><span style=\"font-family: Verdana;\">本网站因正常的系统维护、系统升级，或者因网络拥塞而导致网站不能访问，本网站不承担任何责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">11.免责条款</span></p>\r\n<p><span style=\"font-family: Verdana;\">本网并无随时监视此网址，但保留对其实施实时监视的权利。对于他方输入的，不是本网发布的材料，本网概不负任何法律责任。应聘信息发布方必须对其存入简历中心的个人简历及材料的格式、内容的准确性和合法性独立承担一切法律责任。招聘信息的发布方对其在职位数据库公布的材料独立承担一切法律责任。</span></p>\r\n<p><span style=\"font-family: Verdana;\">本网不保证对某一种职位描述会有一定数目的使用者来浏览，也不保证会有一位特定的使用者来浏览。对于其他网址链接在本网址的内容，本网概不负法律责任。</span></p>','about','agreement','1','0','2010-12-27 14:46:24','1','0');
INSERT INTO job_common VALUES('9','会员服务','<p>会员服务</p>','about','service','1','0','2010-08-28 12:13:59','1','0');
INSERT INTO job_common VALUES('10','付款方式','<div class=\"main_con\">\r\n<div style=\"border: #333333 1px dashed;\"><span style=\"color: #ff0000;\"><strong>付款说明：</strong></span><br /><span style=\"color: #555;\">汇款后即表明您已完全接受我们的产品及服务,我们不办理退款工作<span style=\"color: #000000;\">。</span>我们提供的付款方式基本上均为马上到款，汇款金额请加个零头以方便确认（如：0.13元），需要发票的请将发票税点7%一并汇出，您付完款以后请及时联系我们做汇款确认！以免引起不必要的麻烦。您也可以将汇款底单扫描传真到400-6606-156-600或者发电邮到web<a href=\"mailto:service@finereason.com\">@finereason.com</a> 谨防网络骗子，请客户按照以下方式和帐户付款！！</span></div>\r\n<p><span style=\"color: #0000ff;\">○ 本公司帐户（供企业购买时转帐使用,个人请不要往以下账号汇）：</span></p>\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"250\">\r\n<p><img style=\"width: 160px; height: 59px;\" src=\"http://www.finereason.com/Onlinepay/pay_img/banklogo_01.gif\" border=\"0\" alt=\"\" hspace=\"0\" width=\"160\" height=\"59\" /></p>\r\n</td>\r\n<td>开户行：<span style=\"font-family: Verdana;\">中国工商银行上海市嘉定支行</span> <br />户&nbsp;&nbsp; 名：上海嘉挚网络科技发展有限公司 <br />卡&nbsp; &nbsp;号：<strong><span style=\"font-family: Verdana;\">1001 7008 0930 0147 897</span></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>说 明：同一银行内转帐或汇款，24小时到帐。不同银行间转帐，48小时到帐。</p>\r\n<p>注意：此帐号只接受企业转帐，汇款用途请注明＂软件服务费＂！</p>\r\n<p><span style=\"color: #0000ff;\">○ 个人用户汇款方式：</span></p>\r\n<table id=\"table1\" style=\"margin-top: 8px;\" border=\"1\" cellspacing=\"0\" width=\"700\" align=\"center\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr align=\"center\">\r\n<td width=\"200\" height=\"32\" align=\"center\" bgcolor=\"#1941a5\"><span style=\"color: #ffffff;\">银行</span></td>\r\n<td width=\"200\" height=\"32\" align=\"center\" bgcolor=\"#1941a5\"><span style=\"color: #ffffff;\">开户银行</span></td>\r\n<td height=\"32\" align=\"center\" bgcolor=\"#1941a5\"><span style=\"color: #ffffff;\">卡号</span></td>\r\n<td width=\"120\" height=\"32\" align=\"center\" bgcolor=\"#1941a5\"><span style=\"color: #ffffff;\">收款人</span></td>\r\n</tr>\r\n<tr align=\"center\">\r\n<td id=\"table1\" height=\"58\" align=\"center\"><img style=\"width: 160px; height: 59px;\" src=\"http://www.finereason.com/Onlinepay/pay_img/banklogo_01.gif\" border=\"0\" alt=\"\" hspace=\"0\" width=\"160\" height=\"59\" /></td>\r\n<td id=\"table1\" align=\"center\">中国工商银行</td>\r\n<td id=\"table1\" align=\"center\">9558820405000568730</td>\r\n<td id=\"table1\" align=\"center\">赵丽伟</td>\r\n</tr>\r\n<tr align=\"center\">\r\n<td id=\"table1\" height=\"58\" align=\"center\">\r\n<div><img src=\"http://www.finereason.com/Onlinepay/pay_img/banklogo_02.gif\" alt=\"\" width=\"160\" height=\"59\" /></div>\r\n</td>\r\n<td id=\"table1\" align=\"center\">中国建设银行</td>\r\n<td id=\"table1\" align=\"center\">4367420110228229223</td>\r\n<td id=\"table1\" align=\"center\">赵丽伟</td>\r\n</tr>\r\n<tr align=\"center\">\r\n<td id=\"table6\" height=\"58\" align=\"center\">\r\n<div><img src=\"http://www.finereason.com/Onlinepay/pay_img/banklogo_03.gif\" alt=\"\" width=\"160\" height=\"59\" /></div>\r\n</td>\r\n<td id=\"table6\" align=\"center\">中国农业银行</td>\r\n<td id=\"table6\" align=\"center\">6228481720560433411</td>\r\n<td id=\"table6\" align=\"center\">侯智荣</td>\r\n</tr>\r\n<tr align=\"center\">\r\n<td id=\"table9\" height=\"58\" align=\"center\">\r\n<div><img src=\"http://www.finereason.com/Onlinepay/pay_img/banklogo_05.gif\" alt=\"\" width=\"160\" height=\"59\" /></div>\r\n</td>\r\n<td id=\"table9\" align=\"center\">中国银行</td>\r\n<td id=\"table9\" align=\"center\">6013825008002060922</td>\r\n<td id=\"table9\" align=\"center\">侯智荣</td>\r\n</tr>\r\n<tr align=\"center\">\r\n<td id=\"table8\" height=\"58\" align=\"center\"><img src=\"http://www.kesion.com/Images/1197629054194800251.gif\" alt=\"\" width=\"198\" height=\"76\" /></td>\r\n<td id=\"table8\" align=\"center\"><a href=\"https://www.alipay.com/\" target=\"_blank\">www.alipay.com</a></td>\r\n<td id=\"table8\" align=\"center\"><a href=\"mailto:pay@finereason.com\">pay@finereason.com</a></td>\r\n<td id=\"table8\" align=\"center\">张敬娥</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>','about','pay','1','0','2010-12-27 14:50:06','1','0');
INSERT INTO job_common VALUES('11','猎头服务介绍','<p><strong>&nbsp;</strong></p>\r\n<p><strong>嘉缘猎头</strong><strong>&nbsp;</strong></p>\r\n<p>主要代理企业招聘高级管理人员及高级专业技术人员</p>\r\n<p>服务对象：</p>\r\n<p>各领域的优秀企业（有偿服务）</p>\r\n<p>综合素质优秀的职业经理人（免费服务）</p>\r\n<p>具核心竞争优势的专业人才（免费服务）</p>\r\n<p>潜质丰富、追求卓越的个人（免费服务）</p>\r\n<p>&nbsp;</p>\r\n<p>服务公约：</p>\r\n<p>客户机密至上&mdash;&mdash;确保客户信息安全</p>\r\n<p>全面有效沟通&mdash;&mdash;协助客户明确需求</p>\r\n<p>连续跟踪服务&mdash;&mdash;提供增值服务保障</p>\r\n<p>操作严谨规范&mdash;&mdash;确保客户目标达成</p>\r\n<p>&nbsp;</p>\r\n<p>推荐成功率95%</p>\r\n<p>收费标准：招聘职位年薪的30%（对招聘单位单项收费）</p>\r\n<p>完成单个项目平均周期15&mdash;30天</p>\r\n<p>首批推荐侯选人平均周期7天</p>\r\n<p>嘉缘猎头热线：400 6606 156</p>\r\n<p>&nbsp;</p>\r\n<p><strong>猎头服务流程：</strong><strong></strong></p>\r\n<p>签订《猎头/委托招聘协议》&mdash;&mdash;确定招聘岗位职责与任职条件&mdash;&mdash;多渠道寻访、甄选、测评人才&mdash;&mdash;向企业推荐2到5倍侯选人资料&mdash;&mdash;协助企业对侯选人进行面试&mdash;&mdash;面试未通过，继续推荐人才&mdash;&mdash;再次面试，直至面试成功，上岗试用&mdash;&mdash;进入保证期&mdash;&mdash;保证期内侯选人被辞退或主动离职，重新推荐人才&mdash;&mdash;侯选人合格，项目结束。</p>\r\n<p>嘉缘猎头热线：400 6606 156</p>','','','0','3','2010-12-30 23:16:50','0','2');
INSERT INTO job_common VALUES('12','服务收费标准 ','<p>收费标准：招聘职位年薪的30%（对招聘单位单项收费）</p>\r\n<p>完成单个项目平均周期15&mdash;30天</p>\r\n<p>首批推荐侯选人平均周期7天</p>\r\n<p>嘉缘猎头热线：400 6606 156</p>\r\n<p>&nbsp;</p>\r\n<p><strong>嘉缘猎头</strong><strong></strong></p>\r\n<p>主要代理企业招聘高级管理人员及高级专业技术人员</p>\r\n<p>服务对象：</p>\r\n<p>各领域的优秀企业（有偿服务）</p>\r\n<p>综合素质优秀的职业经理人（免费服务）</p>\r\n<p>具核心竞争优势的专业人才（免费服务）</p>\r\n<p>潜质丰富、追求卓越的个人（免费服务）</p>','','','0','4','2010-12-30 23:17:00','0','2');
INSERT INTO job_common VALUES('13','在线猎头顾问 ','<p><span style=\"font-size: medium;\"><strong>&nbsp;</strong></span><strong>顾问团队</strong></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;由一批较早从事猎头行业的专业资深猎头顾问组成，具有本科以上多样化的教育背景和成熟的咨询工作经验，熟谙中西方企业文化，具有众多的猎头成功案例。行业知识</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 和 HR经验丰富，判断侯选人时比较准确。</p>\r\n<p><br /><strong>助理顾问团队&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 所有助理顾问全部毕业于国际、国内名牌大学、接受正规本科教育。</p>\r\n<p><br /><strong>兼职猎手顾问团队</strong>&nbsp;&nbsp; 全部来自国际国内知名企业HR、总监、公司高层主管、经理及各行业资深人士和其他高层人脉关系较广的精英人士。</p>\r\n<p><span style=\"font-size: medium;\"><strong>&nbsp;</strong></span></p>\r\n<p><span style=\"font-size: medium;\"><strong>嘉缘兼职猎手</strong></span></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 如果您在某个领域拥有广泛的人脉关系，如果您身边有众多需求高级人才的大中型企业，如果您在某个行业属于专家、资深或权威人士，那这些都是您宝贵的资源，做我们的兼职猎手，嘉缘猎头将帮助您把这些无形资源转化为有形价值，同时使您的朋友或相关企业从中受益。</p>\r\n<p><strong>报名条件：</strong><br />&nbsp;&nbsp;&nbsp;&nbsp; 1、在某个行业领域具有广泛的人脉关系，可提供高级人才个人简历；<br />&nbsp;&nbsp;&nbsp;&nbsp;2、在某个行业领域具有广泛的企业高层资源，并可就猎头服务与其进行初步接洽。<br /><strong>岗位职责：</strong><strong> </strong><strong><br /><strong>&nbsp;&nbsp;&nbsp; </strong></strong>协助猎头顾问开发企业客户或搜寻目标人选，即：介绍有猎头需求的企业或提供专业精英人才个人资料。<br /><strong>薪酬回报：</strong> <br />&nbsp;&nbsp;&nbsp; 无底薪，项目运作成功后，按照服务费总额的15%-20%提取劳务费，一次性兑现。<br /><strong>其他说明：</strong> <br />&nbsp;&nbsp;&nbsp;&nbsp;1、嘉缘猎头将与您本人签订《兼职猎手协议》；<br />&nbsp;&nbsp;&nbsp;&nbsp;2、嘉缘猎头将免费对兼职猎手进行项目培训；<br />&nbsp;&nbsp;&nbsp;&nbsp;3、嘉缘猎头将对兼职猎手信息严格保密。<br /><strong>报名方法：</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话报名：请拨打专线咨询电话，直接预约面谈。<br /><strong>咨询电话：</strong><strong>029</strong><strong>&mdash;</strong><strong>85460076</strong></p>','','','0','2','2010-12-30 23:17:08','0','2');
INSERT INTO job_common VALUES('14','猎头服务机构','<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 嘉缘猎头是提供专业猎头服务的机构之一，旨在&ldquo;为企业寻聘一流的中高级人才、为优秀人才搭建理想的职业发展平台&rdquo;。业务范围涉及房地产、通信、IT、广告、服务等行业，业务区域覆盖北京、天津、上海、陕西、南京、广州、深圳等十几个城市及地区。嘉缘猎头在长期实践中积累了丰富的信息搜集、甄选鉴别和人事调查运作经验，我们的专业猎头顾问能为客户提供迅速、准确和高度个性化的服务。</p>\r\n<p>猎头热线：400 6606 156</p>\r\n<p>&nbsp;</p>\r\n<p>我们的优势</p>\r\n<p>强大的信息资源依托：</p>\r\n<p>嘉缘猎头以自己的独立网站&mdash;&mdash;嘉缘人才网为依托，并有多年的人才积淀为后盾，现有注册人才信息15余万，其中中高级人才2W余人，为快速搜选的猎头人才提供了必要和较充分的条件。</p>\r\n<p>&nbsp;</p>\r\n<p>先进科学的测评系统：</p>\r\n<p>嘉缘人才网具备有智能化人才素质测评系统、结合知名人力资源专家的性格类型测试，可对</p>\r\n<p>侯选人进行全面、科学的评估，为迅速、准备推荐侯选人提供了必要的有力支持。</p>\r\n<p>真诚而专业化的服务：</p>\r\n<p>不论是资深的猎头顾问，还是遍布各行各业的兼职猎手，嘉缘猎头时刻不忘自己公司的理念&ldquo;企业要有品牌，服务要有品质，员工要有品德&rdquo;，嘉缘猎头永远铭记自己的社会职责&ldquo;为人才提供最佳的发展机会，为企业组建最优秀的人才团队&rdquo;。</p>\r\n<p>&nbsp;</p>\r\n<p>嘉缘猎头热线：400 6606 156</p>','','','0','1','2010-12-30 23:17:24','0','2');
INSERT INTO job_common VALUES('15','嘉缘猎头优势','<p>强大的信息资源依托：</p>\r\n<p>嘉缘猎头以自己的独立网站&mdash;&mdash;嘉缘人才网为依托，并有多年的人才积淀为后盾，现有注册人才信息15余万，其中中高级人才2W余人，为快速搜选的猎头人才提供了必要和较充分的条件。</p>\r\n<p>&nbsp;</p>\r\n<p>先进科学的测评系统：</p>\r\n<p>嘉缘人才网具备有智能化人才素质测评系统、结合知名人力资源专家的性格类型测试，可对</p>\r\n<p>侯选人进行全面、科学的评估，为迅速、准备推荐侯选人提供了必要的有力支持。</p>\r\n<p>真诚而专业化的服务：</p>\r\n<p>不论是资深的猎头顾问，还是遍布各行各业的兼职猎手，嘉缘猎头时刻不忘自己公司的理念&ldquo;企业要有品牌，服务要有品质，员工要有品德&rdquo;，嘉缘猎头永远铭记自己的社会职责&ldquo;为人才提供最佳的发展机会，为企业组建最优秀的人才团队&rdquo;。</p>\r\n<p>&nbsp;</p>\r\n<p>嘉缘猎头热线：400 6606 156</p>','','','0','5','2010-12-30 23:17:34','0','2');
INSERT INTO job_common VALUES('16','友情链接','<strong> <hr />\r\n<p>连接网站要求</strong>：内容健康，美观大方，页面整洁，无不良代码。<br />\r\n<strong>内页连接要求</strong>：PR3或日IP1000以上，百度收录1万以上。<br />\r\n<strong>首页链接要求</strong>：PR4以上或百度收录3万以上。<br />\r\n</p>','links','links','0','0','2011-03-10 17:52:35','1','0');

INSERT INTO job_ecoclass VALUES('10','国有企业','State-owned Enterprise');
INSERT INTO job_ecoclass VALUES('11','集体企业','Collective Enterprise');
INSERT INTO job_ecoclass VALUES('12','外商独资','Wholly Foreign-owned Enterprise');
INSERT INTO job_ecoclass VALUES('13','中外合资','Chinese-foreign Joint Venture');
INSERT INTO job_ecoclass VALUES('14','民营企业','Non-government Enterprise');
INSERT INTO job_ecoclass VALUES('15','股份制企业','Joint-equity Enterprise');
INSERT INTO job_ecoclass VALUES('16','行政机关','Administrative Organ');
INSERT INTO job_ecoclass VALUES('17','社会团体','Social Organization');
INSERT INTO job_ecoclass VALUES('18','事业单位','Institution');
INSERT INTO job_ecoclass VALUES('19','其他','Other');

INSERT INTO job_edu VALUES('1','初中','Junior High School');
INSERT INTO job_edu VALUES('2','高中','Senior High School');
INSERT INTO job_edu VALUES('3','职高/技校','Vocational high school/Technical School');
INSERT INTO job_edu VALUES('4','中专','Technical Secondary School');
INSERT INTO job_edu VALUES('5','大专','Junior College');
INSERT INTO job_edu VALUES('6','大学本科','Bachelor');
INSERT INTO job_edu VALUES('7','硕士','Master');
INSERT INTO job_edu VALUES('8','博士','Doctorate');

INSERT INTO job_foreigndegree VALUES('1','一般','Ordinary ');
INSERT INTO job_foreigndegree VALUES('2','良好','Good');
INSERT INTO job_foreigndegree VALUES('3','熟练','Skilled');
INSERT INTO job_foreigndegree VALUES('4','精通','Versed');

INSERT INTO job_foreignlanguage VALUES('1','英语','English');
INSERT INTO job_foreignlanguage VALUES('2','日语','Japanese');
INSERT INTO job_foreignlanguage VALUES('3','俄语','Russian');
INSERT INTO job_foreignlanguage VALUES('4','法语','French');
INSERT INTO job_foreignlanguage VALUES('5','德语','German');
INSERT INTO job_foreignlanguage VALUES('6','意大利语','Italian');
INSERT INTO job_foreignlanguage VALUES('7','西班牙语','Spanish');
INSERT INTO job_foreignlanguage VALUES('8','朝鲜语','Korean');
INSERT INTO job_foreignlanguage VALUES('9','蒙古语','Mongolian');
INSERT INTO job_foreignlanguage VALUES('10','葡萄牙语','Portuguese');
INSERT INTO job_foreignlanguage VALUES('11','阿拉伯语','Arabic');
INSERT INTO job_foreignlanguage VALUES('12','其他','Others');

INSERT INTO job_group VALUES('2','试用会员','1','0','1','月','skin/system/group1.gif','1,3,1,3,1,3,3,3,1,1,1,3,0,0','0,0,0,0,0,0,0,0','1','0');
INSERT INTO job_group VALUES('3','普通会员','1','50','1','年','skin/system/group2.gif','1,0,1,0,1,0,5,0,1,1,1,0,0,0','0,0,0,0,0,0,0,0','0','0');
INSERT INTO job_group VALUES('4','免费试用会员','2','0','1','月','skin/system/group1.gif','1,3,1,1,1,1,1,1,0,1,1,1,0,0','2,2,2,2,2,1,10','1','0');
INSERT INTO job_group VALUES('5','VIP月度会员','2','300','1','月','skin/system/group2.gif','1,100,1,500,1,0,1,500,1,0,1,1,1,100','2,2,2,2,2,1,10','0','0');
INSERT INTO job_group VALUES('8','普通会员','3','0','1','年','skin/system/group1.gif','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','0,0,0,0,0,0,0,0','1','0');
INSERT INTO job_group VALUES('10','普通会员','4','300','1','年','skin/system/group1.gif','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','0,0,0,0,0,0,0,0','1','0');
INSERT INTO job_group VALUES('16','合作院校','3','0','30','年','skin/system/group0.gif','0,0,0,0,0,0,0,0,0,0,0,0,0,0','0,0,0,0,0,0,0','0','0');
INSERT INTO job_group VALUES('18','VIP季度会员','2','800','3','月','skin/system/group2.gif','1,300,1,1000,1,0,1,1000,1,0,1,1,1,300','2,2,2,2,2,1,10','0','0');
INSERT INTO job_group VALUES('19','VIP半年会员','2','1500','6','月','skin/system/group2.gif','1,1000,1,0,1,0,1,0,1,0,1,1,1,600','2,2,2,2,2,1,10','0','0');
INSERT INTO job_group VALUES('20','VIP年度会','2','2800','1','年','skin/system/group2.gif','1,0,1,0,1,0,1,0,1,0,1,1,1,1500','2,2,2,2,2,1,10','0','0');

INSERT INTO job_help VALUES('2','我为什么看不到企业的联系方式？','<p>&nbsp;&nbsp;&nbsp; 如果求职者第一次来登陆网站，首先需要注册个人会员。个人只有在注册后登录网站才能看到网站企业会员的联系方式。没有经过我们网站审核的企业看不到联系方式，你可以在线投递简历，企业如果想联系你，需要传真营业执照副本才可以，这样我们就可以审核这家公司的真实性。</p>','2','admin','2010-12-28 16:38:28');
INSERT INTO job_help VALUES('3','忘记了密码或用户名怎么办？','<blockquote>\r\n<p><span class=\\\"STYLE2\\\">&nbsp;&nbsp;&nbsp; 嘉缘人才网提供了快捷找回密码功能，只需提供您在注册时登记的E-mail地址，我们会自动将密码发送至您的邮箱。如果收到密码还是不能登录，或多次登陆错误帐户被限制，请联系客服：电话：029-85460076&nbsp;&nbsp; 400-6606-156</span></p>\r\n</blockquote>','1','admin','2010-12-28 16:37:54');
INSERT INTO job_help VALUES('4','如何修改密码？','<p>&nbsp;&nbsp;&nbsp; 登录个人会员中心，找到左下侧简历维护下面的登陆密码修改，即可重新设置新密码。</p>','1','admin','2010-12-28 16:37:32');
INSERT INTO job_help VALUES('5','个人注册后有什么好处？需要多长时间？个人注册需要交费吗？','<p><br />&nbsp;&nbsp;&nbsp; 个人完成注册后，需要先通过网站的审核然后就会进入网站的简历库，个人可以随时进行修改。企业在招聘时可以检索简历库，与您主动联系，您将有更多的机会。另外，注册后，可以使用搜索、职位综合查询、收藏等功能。个人注册很简单，只要填上用户名、密码、电子邮件几秒钟即可完成，但完成整个简历的注册取决于您写简历的速度。建议您事先写好，然后粘贴到简历中，个人注册简历是不需要交费的，是完全免费的。</p>','1','admin','2010-12-28 16:37:21');
INSERT INTO job_help VALUES('6','有没有虚假的招聘广告？','<p>&nbsp;&nbsp;&nbsp; 您可以看一下单位是否通过我们的证实，经过证实的企业会出现一个VIP 标志，那些没有经过我们证实的企业就不会出现，您还需要注意一下风险提示。可以坚持的一个原则是：任何收取报名费、培训费、上岗费等费用都是违法的，有实力的公司不会在意这些小的费用。不要因为求职心切而轻易上当，由此而造成的损失，我们概不负责，请求职者慎重。</p>','3','admin','2010-12-28 16:25:45');
INSERT INTO job_help VALUES('7','我填写了简历，怎么一点反应也没有？','<p>&nbsp;&nbsp;&nbsp; 您好！也许您的经历太平淡，也许您的简历写的不够吸引人，所以无法引起企业的注意。事实上，很多人因为太多的企业与之联系而烦恼，其实您可以主动出击主动向企业投递简历，这样可以提高企业对您简历的认识度。</p>','2','admin','2010-12-28 16:26:41');
INSERT INTO job_help VALUES('8','感觉好象是招聘的总是那么几家公司？','<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！因为经常来登录网站的公司，能得到更多的露脸的机会，所以您会经常看到他们。这部分公司经常使用我们网站，因此露脸的机会比较多容易使人误解，建议您到职位查询中查询，有更多的职位等着您。</p>','2','admin','2010-12-28 16:31:52');
INSERT INTO job_help VALUES('9','怎样刷新我的简历？','<p>&nbsp;&nbsp;&nbsp;&nbsp; 简历上显示的&ldquo;最近登录时间&rdquo;是根据您每次登录的时间自动更改的，您无需自己修改，只要经常登录网站即可。简历上显示的&ldquo;简历更新时间&rdquo;是指您最近一次修改简历内容的时间。</p>','2','admin','2010-12-28 16:32:55');
INSERT INTO job_help VALUES('10','我感觉网上求职成功率不高，有什么秘诀吗？','<p>&nbsp;&nbsp;&nbsp; 您可以按照以下建议来进行网上求职看一下是否对您有帮助：<br />&nbsp;&nbsp; (1)详细而且真实地填写个人简历，用人单位对你的初步了解是从简历开始的，必要时可以上传自己的照片。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; (2)将自己姓名填写全称，这将使招聘者有安全感，更有助于您的求职。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; (3)使用预览简历功能，排版要美观大方，可以反复不断地修改。<br />&nbsp;&nbsp;&nbsp; (4)杜绝盲目投递简历，在投递简历前请仔细查看职位要求，否则会引起招聘单位反感。&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; (5)尝试使用智能职位搜索器。</p>','2','admin','2010-12-28 16:39:50');
INSERT INTO job_help VALUES('11','我已经注册了简历，但目前已经找到工作，能删除简历吗？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们提供给个人的是终身的服务，目前不找工作并不表示您以后不找工作。如果您的简历不想被单位看到，可以到&ldquo;保密设置&rdquo;中采用&ldquo;不公开我的联系方式&rdquo;功能将简历隐藏起来。</p>','2','admin','2010-12-28 16:40:37');
INSERT INTO job_help VALUES('12','投递简历时系统提示不符合要求无法投递是什么原因？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp; &nbsp;可能是您的学历，或者工作经验不符合此公司的设置，并非网站设置。请选择其它单位投递您的简历。</p>','2','admin','2010-12-28 16:41:33');
INSERT INTO job_help VALUES('13','为什么有的企业带有VIP标志也看不到联系方式呢？','<p>&nbsp;&nbsp;&nbsp; 那是我们的储值型会员，也是经过我们审核的，这种会员类型你们看不到他的联系方式，但可以在线投递简历，企业可以看到你的联系方式。企业收到你的简历后，感觉你合适他们会和你联系的。</p>','2','admin','2010-12-29 09:00:59');
INSERT INTO job_help VALUES('14','我刚刚修改了我的简历，我需要给前几天投递简历的单位重新投递吗？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp; 您不用重新投递，这些单位可以看到最新版的简历。</p>','2','admin','2010-12-28 16:43:09');
INSERT INTO job_help VALUES('15','如何发布招聘广告？能不能将我的招聘广告放到首页，并停留一段时间？ ','<p><span class=\\\"tgray\\\">&nbsp;&nbsp;&nbsp; 任何经过政府批准、合法的企业都可以免费发布招聘广告。如果企业还没有注册，需要花5分钟左右的时间完成注册。注册过的企业使用用户名与密码登录，就可以发布招聘职位了，每次登录网站职位会自动出现在网站首页。（1小时内重复登录不会重复出现）</span></p>','3','admin','2010-12-28 16:44:09');
INSERT INTO job_help VALUES('16','免费注册企业发布招聘广告是否收费？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp; 发布招聘广告是完全免费的。在企业注册成功后，使用用户名/密码登录就可以随时发布、修改、删除招聘职位，但免费注册的企业最多能同时发布5个职位。</p>','3','admin','2010-12-28 16:44:56');
INSERT INTO job_help VALUES('17','收费会员与免费会员的主要区别？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp;&nbsp;收费的会员我们称为正式企业会员,主要区别有以下几点：<br />(1)正式企业会员可以查看所有简历的联系方式，而免费企业会员只能查看求职者的基本资料。<br />(2)正式企业会员登录网站后，显示在上面的推荐VIP会员区；免费会员显示在下面的最新企业职位区。<br />(3)免费企业会员最多只能同时发布5个招聘职位；正式企业会员不限制发布招聘职位的数量。</p>','3','admin','2010-12-28 16:45:36');
INSERT INTO job_help VALUES('18','我们是一家很小的公司，每年只招聘几个人，而且时间不固定，怎么才能省钱？ ','<p style=\\\"display: block;\\\"><span class=\\\"tgray\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 如果贵公司一年内招聘的人数不是很多，并且时间不是很固定的话，建议贵公司参加我们&ldquo;储值型&rdquo;企业会员，这种会员可以按使用次数来收费，类似于神州行的手机卡。具体资费请到首页下方&ldquo;资费标准&rdquo;查看。</span></p>','3','admin','2010-12-28 16:47:18');
INSERT INTO job_help VALUES('19','如何交费？交费后我想立即使用，能行吗？发票是否能一定给我？','<p>&nbsp;&nbsp;&nbsp; 如要您要办理正式会员，请查看VIP申请流程,付款后您需要将银行回单和公司营业执照副本，发传真到0532－88789113，我们收到您的传真后，在工作时间10分钟内开通服务，并进行电话通知。款到账后,您可以索取发票，我们会在3个工作日内会将发票以挂号信形式寄出。开通、发票寄出都有电子邮件通知您，以便您进行监督和查询。</p>','3','admin','2010-12-28 16:54:43');
INSERT INTO job_help VALUES('20','好长时间不用了，我忘记了用户名与密码，怎么办？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;首页上有&ldquo;忘记密码&rdquo;功能。只要输入您注册时的用户名、Email之一，用户名与密码将发到您的邮箱中。如果您的邮箱已经不用了，请将公司营业执照传真给我们，并在营业执照上注明&ldquo;索取用户名和密码&rdquo;，然后拨打客服电话查询。</p>','1','admin','2010-12-28 16:55:23');
INSERT INTO job_help VALUES('21','我是新的人力主管。我的前任什么也没留下，我该怎么办？','<p><span class=\\\"tgray\\\">&nbsp;&nbsp;&nbsp; 请您将公司营业执照传真给我们，并在营业执照上注明&ldquo;索取用户名和密码，然后拨打客服电话查询。我们帮您查到用户名/密码后，您务必尽快登录网站修改以下信息：用户名、密码、联系人、电话、传真、电子邮件。</span></p>','1','admin','2010-12-28 16:56:09');
INSERT INTO job_help VALUES('22','我感觉网上招聘成功率不高，有什么秘诀吗？ ','<p>&nbsp;&nbsp;&nbsp; 您可以尝试以下方法，将对您有很大帮助：<br />(1)公司简介尽量详实可靠，使求职者通过公司简介能基本了解您的公司，并吸引有能力的求职者投递简历。<br />(2)准确描述招聘职位，包括工作内容，所在部门，上级下级，及对求职者的要求（不要限制性别、民族、宗教信仰），避免求职者盲目投递简历。<br />(3)及时删除过期的招聘职位。<br />(4)主动搜索简历库，有能力的人才往往不能主动投递简历，而这正是你所需要的人，必要的时候使用&ldquo;智能简历查询&rdquo;。<br />(5)及时回复收到的应聘简历，不要让求职者的求职信石沉大海，您公司的口碑也是成功的关键。如果简历不符合，请使用礼貌谢绝功能。<br />(6)将有意向的简历放进收藏夹，现在不用，并不代表以后不用。<br />(7)尽可能多的登录到本网站，这样贵单位就有可能在首页多出现。</p>','3','admin','2010-12-28 16:57:04');
INSERT INTO job_help VALUES('23','所有的个人资料是真实的吗？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;由于简历众多，我们并不保证所有简历内容的真实性，请招聘单位务必通过相关证件自己鉴别。由此而造成的一切责任，网站概不负责。</p>','3','admin','2010-12-28 16:57:36');
INSERT INTO job_help VALUES('24','我公司招聘已经结束，我想删除我的账户，如何办理？ ','<p class=\\\"tgray\\\" style=\\\"display: block;\\\">&nbsp;&nbsp;&nbsp;&nbsp;我们给单位用户提供的是终身服务，招聘结束后您将招聘职位全部暂停或删除，求职者就查询不到贵公司的信息了，您无需删除您的账户，这样避免了贵公司下次招聘时再次注册，可以为您节省不少时间。</p>','3','admin','2010-12-28 16:58:25');
INSERT INTO job_help VALUES('25','如何填写登录名和密码？','<p>会员登录名:&nbsp;<br />&nbsp;&nbsp; 不接受中文，请选择2-16个字符，可以是英文字母（大小写均可）、下划线或者数字，也可以英文、下划线与数字结合<br />友情提示：<br />&nbsp;&nbsp;1、建议您选择与公司名相关的会员登录名，不容易忘记；<br />&nbsp;&nbsp;2、请不要轻易在会员登录名中透露重要的个人资料，比如您的信用卡号或者您的密码。<br /><br />密码：<br />&nbsp; 不能与登录名相同，以保证密码安全。请选择4-16个字符，可以是英文字母（请注意区分大小写）、或者数字，也可以英文与数字结合<br /><br />友情提示：<br />&nbsp; 1、设置密码时请您尽量慎重，请不要使用不安全、容易被人猜到的密码，如1111111或aaaaaaa，以保证密码安全；<br />&nbsp; 2、一旦您认为有人知道您的密码，请立即修改密码。</p>','1','admin','2010-12-28 17:31:53');
INSERT INTO job_help VALUES('26','怎样搜索职位？','<p>&nbsp;&nbsp;&nbsp; 您可以在希望的工作岗位选择你所需要的工作类型，希望工作地区选择你需要的地区，职位发布日期选择发布时间，在关键字中填写你所要找寻的职位就名称，然后进行搜索</p>','3','admin','2010-12-28 17:31:35');

INSERT INTO job_helpsort VALUES('1','会员注册、登陆、密码找回','1');
INSERT INTO job_helpsort VALUES('2','个人求职常见问题','2');
INSERT INTO job_helpsort VALUES('3','招聘企业常见问题','3');
INSERT INTO job_helpsort VALUES('4','猎头常见问题','4');
INSERT INTO job_helpsort VALUES('5','培训机构常见问题','5');
INSERT INTO job_helpsort VALUES('6','院校联盟常见问题','6');
INSERT INTO job_helpsort VALUES('7','人力资讯常见问题','7');

INSERT INTO job_label VALUES('1','{$FR_人才搜索}','4','人才搜索','<div class=\"resumesearch\">\r\n<form name=\"resumesimplesearch\" action=\"{$FR_系统目录}search/resume_searchresult.php\" method=\"post\" target=\"_blank\" class=\"search\">\r\n<li>专　业 <input type=\"hidden\" value=\"\" name=\"profession\"><input type=\"text\" name=\"professions\" value=\"请选择人才专业\" class=\"search_case\" onclick=\"JumpSearchLayers(0,0,5,\'resumesimplesearch\',\'professions\',\'profession\');\" readonly /></li>\r\n<li>职　位 <input type=\"hidden\" value=\"\" name=\"position\"><input type=\"text\" name=\"positions\" value=\"请选择人才职位\" class=\"search_case\" onclick=\"JumpSearchLayers(0,0,1,\'resumesimplesearch\',\'positions\',\'position\');\" readonly />\r\n</li>\r\n<li>意向地 <input type=\"hidden\" value=\"\" name=\"workadd\"><input type=\"text\" name=\"workadds\" value=\"请选择求职意向地\" class=\"search_case\" onclick=\"JumpSearchLayers(0,0,2,\'resumesimplesearch\',\'workadds\',\'workadd\');\" readonly /></li>\r\n<li>日　期 <input type=\"hidden\" value=\"\" name=\"datetime\"><input type=\"text\" name=\"datetimes\" value=\"请选择日期\" class=\"search_case\" onclick=\"JumpSearchDate(\'resumesimplesearch\',\'datetimes\',\'datetime\');\" readonly />\r\n</li>\r\n<li>关键字 <input name=\"keyword\" type=\"text\" size=\"20\" class=\"input165\" onblur=\"if(this.value==\'\') this.value=\'请输入搜索的关键词！\';\" onfocus=\"if(this.value==\'请输入搜索的关键词！\') this.value=\'\';\" value=\"请输入搜索的关键词！\" /></li>\r\n<li><input type=\"submit\" name=\"Submit3\" value=\"搜 索\" class=\"inputs\" /> [<a href=\"{$FR_系统目录}search/resume_searchresult.php\" target=\"_blank\">高级搜索</a>]</li>\r\n</form>\r\n</div>','2008-11-08 16:48:00','2010-10-11 02:31:56','0');
INSERT INTO job_label VALUES('2','{$FR_职位搜索}','4','职位搜索','<div class=\"hiresearch\">\r\n<form name=\"hiresimplesearch\" action=\"{$FR_系统目录}search/hire_searchresult.php\" method=\"post\" target=\"_blank\" class=\"search\">\r\n<li>行　业:<input type=\"hidden\" value=\"\" name=\"trade\"><input type=\"text\" name=\"trades\" value=\"选择行业类别\" class=\"search_case\" onclick=\"JumpSearchLayers(2,0,4,\'hiresimplesearch\',\'trades\',\'trade\');\" readonly /></li> \r\n<li>职　位:<input type=\"hidden\" value=\"\" name=\"position\"><input type=\"text\" name=\"positions\" value=\"选择职位名称\" class=\"search_case\" onclick=\"JumpSearchLayers(0,0,1,\'hiresimplesearch\',\'positions\',\'position\');\" readonly /></li>\r\n<li>工作地:<input type=\"hidden\" value=\"\" name=\"workadd\"><input type=\"text\" name=\"workadds\" value=\"选择工作地点\" class=\"search_case\" onclick=\"JumpSearchLayers(0,0,2,\'hiresimplesearch\',\'workadds\',\'workadd\');\" readonly /></li>     \r\n<li>日　期:<input type=\"hidden\" value=\"\" name=\"datetime\"><input type=\"text\" name=\"datetimes\" value=\"选择发布日期\" class=\"search_case\" onclick=\"JumpSearchDate(\'hiresimplesearch\',\'datetimes\',\'datetime\');\" readonly />\r\n</li>\r\n<li>关键字:<input name=\"keyword\" type=\"text\" size=\"20\" class=\"input165\" onblur=\"if(this.value==\'\') this.value=\'请输入搜索的关键词！\';\" onfocus=\"if(this.value==\'请输入搜索的关键词！\') this.value=\'\';\" value=\"请输入搜索的关键词！\" /></li>\r\n<li>　　　　<input type=\"submit\" name=\"Submit3\" value=\" 搜 索 \" class=\"inputs\" /> | 高级搜索</li>\r\n</form></div>','2008-11-10 09:18:00','2010-10-11 02:33:13','0');
INSERT INTO job_label VALUES('5','{$FR_最新企业招聘}','6','首页最新企业招聘','{getcomlist(72,3,0,12,1,1,4,2,1,1,0,\'m_activedate desc\',\'_blank\',0,0,0,0,180,60,0,0,0,0,1,2)}','2008-11-14 17:31:00','2010-09-29 00:56:35','0');
INSERT INTO job_label VALUES('6','{$FR_推荐精英人才}','6','推荐精英人才','{getresumelist(10,2,\'0|0|1|0|0|0|1|0|0|0\',1,1,1,0,3,3,\'r_adddate desc\',\'_blank\',0,0,90,99,0,0)}','2008-11-14 17:36:00','2010-08-15 00:32:38','0');
INSERT INTO job_label VALUES('7','{$FR_热点企业招聘}','6','首页热点企业招聘','{getcomlist(48,4,0,14,0,0,4,3,0,1,0,\'m_id desc\',\'_blank\',0,0,0,0,180,60,0,0,0,1,0,2)}','2008-11-15 10:21:00','2010-08-31 18:40:13','0');
INSERT INTO job_label VALUES('8','{$FR_网站标准头}','5','网站标准头','<SCRIPT src=\"{$FR_系统目录}js/tit.js\" type=\"text/javascript\"></SCRIPT>\r\n<div class=\"container\">\r\n<div class=\"headtop\">\r\n<li class=\"topl\">好工作 上{$FR_网站名称}</li>\r\n<li class=\"topr\"><a href=\"javascript:void(0);\" onclick=\"this.style.behavior=\'url(#default#homepage)\'; this.setHomePage(\'{$FR_网站网址}\');\">设置首页</a> | <a href=\"javascript:window.external.addFavorite(\'{$FR_网站网址}\',\'{$FR_网站名称}\')\">收藏本站</a> | <a href=\"{$FR_系统目录}common.php?cid=7\">联系我们</a> | <script src=\"{$FR_网站网址}{$FR_系统目录}js/language.js\" language=\"javascript\"></script>{getsite(0,2)}</li>\r\n</div>\r\n	<div class=\"head\">\r\n		<div id=\"logo\"><a href=\"{$FR_网站网址}\"><img src=\"{$FR_系统目录}{$FR_LOGO地址}\" alt=\"欢迎访问{$FR_网站名称}\" /></a></div>\r\n		<div class=\"banner\"><script language=\'javascript\' src=\'{$FR_系统目录}webad/ads.php?p=3\'></script></div>\r\n        <div class=\"linedh\">\r\n        <!-- <li class=\"dh\">客服热线：{$FR_联系电话}</li> --></div>\r\n	</div>\r\n</div>\r\n	<div class=\"nav\"><div class=\"navr\"> </div><div class=\"navl\">{$FR_网站导航}</div></div>','2008-11-15 17:19:00','2011-03-10 14:14:44','0');
INSERT INTO job_label VALUES('9','{$FR_最新人才}','6','最新人才','{getresumelist(10,2,\'0|0|0|0|0|0|0|0|0|0\',1,1,0,0,3,3,\'r_adddate desc\',\'_blank\',3,1,90,99,0,0)}','2008-11-15 10:43:00','2010-08-15 00:35:04','0');
INSERT INTO job_label VALUES('10','{$FR_友情链接}','6','友情链接','{getlink(0,30,20,\'l_id desc\',8,\'_blank\',2)}','2008-11-15 11:16:00','2010-08-15 14:11:02','0');
INSERT INTO job_label VALUES('11','{$FR_版权信息}','5','版权信息','<ul>\r\n<li>{$FR_页尾导航}</li>\r\n</ul>\r\n<span>{$FR_网站版权}<br>{$FR_ICP备案证号} {$FR_第三方统计}</span>\r\n<!-- JiaThis Button BEGIN -->\r\n<script type=\"text/javascript\" src=\"http://v2.jiathis.com/code/jiathis_r.js?move=0&amp;uid=896604\" charset=\"utf-8\"></script>\r\n<!-- JiaThis Button END -->','2008-11-15 11:30:00','2010-12-28 20:45:33','0');
INSERT INTO job_label VALUES('12','{$FR_搜索弹出层}','4','搜索弹出层','<div id=\"bodyly\" style=\"position:absolute;top:0px;z-index:0;left:0px;display:none;\"></div>\r\n<script language = \"JavaScript\" src=\"{$FR_系统目录}js/gettrade.js\"></script>\r\n<script language = \"JavaScript\" src=\"{$FR_系统目录}js/getposition.js\"></script>\r\n<script language = \"JavaScript\" src=\"{$FR_系统目录}js/getprovince.js\"></script>\r\n<script language = \"JavaScript\" src=\"{$FR_系统目录}js/getprofession.js\"></script>\r\n<div id=\"SearchDivhire\" style=\"border:1px #8BC3F6 solid; position:absolute;background-color:#FFFFFF;width:560px;font-size:12px;  z-index:999; display:none;\">\r\n	<div class=\"memmenul\">\r\n		<div style=\"width:538px; font-size:13px;color:#166AB6; font-weight:bold;\" class=\"leftmenutit\"><span style=\"float:right;font-size:12px; padding-right:10px; font-weight:normal; cursor:pointer;\" onClick=\"unSearchLayers();\">[关闭]</span><span id=\"wintit\"></span></div>\r\n		<div style=\"width:100%;\">\r\n			<div id=\"hiretypes\" style=\"margin-left:20px; margin-top:10px;\"></div>\r\n			<div id=\"hiretype\" style=\"margin-left:20px; width:540px;\"></div>\r\n		</div>\r\n	</div>\r\n</div>','2008-11-14 15:44:00','2010-10-11 02:33:59','0');
INSERT INTO job_label VALUES('13','{$FR_首页公告下方幻灯片}','6','请输入标签介绍...','{getarticlelist(6,-1,0,5,5,0,1,1,\'n_id desc\',0,\'_blank\',0,0,290,118,0,0)}','2010-09-01 11:53:14','2010-09-01 11:54:43','0');
INSERT INTO job_label VALUES('14','{$FR_兼职招聘}','6','高级人才页面兼职招聘模块','{gethirelist(10,1,\'1|0|1|0|0|0|0|0|0|0|0|0|0|0\',1,0,0,1,0,3,3,\'h_adddate desc\',\'_blank\',0,6,20,2)}','2010-09-04 21:27:48','2010-09-04 21:27:48','0');
INSERT INTO job_label VALUES('15','{$FR_最新高级人才}','6','最新高级人才','{getresumelist(20,2,\'0|0|1|1|0|1|1|0|0|0\',1,1,0,0,2,3,\'r_adddate desc\',\'_blank\',0,0,0,0,0,0)}','2010-09-04 21:29:37','2010-09-04 21:29:37','0');
INSERT INTO job_label VALUES('16','{$FR_最新高级职位}','6','最新高级职位','{gethirelist(20,1,\'1|1|1|0|0|1|1|0|0|0|0|0|0|1\',1,0,0,1,0,2,3,\'h_adddate desc\',\'_blank\',0,6,10,2)}','2010-09-04 21:35:04','2010-09-04 21:35:04','0');
INSERT INTO job_label VALUES('17','{$FR_热招职位}','6','热招职位','{gethirelist(10,1,\'1|0|1|0|0|0|0|0|0|0|0|0|0|0\',1,0,0,1,0,3,3,\'h_visitcount desc\',\'_blank\',0,6,0,2)}','2010-09-04 21:38:51','2010-09-04 21:39:47','0');
INSERT INTO job_label VALUES('18','{$FR_推荐企业}','6','请输入标签介绍...','{getcomlist(10,1,0,12,0,0,0,0,0,1,1,\'m_regdate desc\',\'_blank\',0,0,0,0,\'\',\'\',0,0,0,1,0,2)}','2010-09-04 21:46:58','2010-09-04 21:46:58','0');
INSERT INTO job_label VALUES('19','{$FR_最新兼职人才}','6','最新兼职人才','{getresumelist(20,2,\'0|0|1|1|0|1|1|0|0|0\',1,1,0,0,3,2,\'r_adddate desc\',\'_blank\',0,0,\'\',\'\',0,0)}','2010-09-04 21:48:57','2010-09-04 21:48:57','0');
INSERT INTO job_label VALUES('20','{$FR_头条热点图片}','6','请输入标签介绍...','{getarticlelist(-1,-1,0,10,2,1,1,0,\'n_id desc\',9,\'_blank\',1,0,120,90,0,10)}','2010-09-04 23:02:32','2010-09-05 00:13:05','0');
INSERT INTO job_label VALUES('21','{$FR_推荐文章}','6','请输入标签介绍...','{getarticlelist(-1,0,\'icon.gif\',10,1,1,0,0,\'n_id desc\',12,\'_blank\',1,0,0,0,0,10)}','2010-09-04 23:05:41','2010-09-04 23:05:41','0');
INSERT INTO job_label VALUES('22','{$FR_最新文章}','6','请输入标签介绍...','{getarticlelist(-1,0,\'icon.gif\',10,1,0,0,0,\'n_addtime desc\',13,\'_blank\',1,0,0,0,0,10)}','2010-09-04 23:07:45','2010-09-04 23:13:19','0');
INSERT INTO job_label VALUES('23','{$FR_热点文章}','6','请输入标签介绍...','{getarticlelist(-1,0,\'icon.gif\',10,1,0,0,0,\'n_hits asc\',13,\'_blank\',1,0,0,0,0,0)}','2010-09-04 23:09:03','2010-09-04 23:09:03','0');
INSERT INTO job_label VALUES('24','{$FR_栏目图片资讯}','6','栏目图片资讯','{getarticlelist(-1,-1,0,5,2,0,1,0,\'n_addtime desc\',10,\'_blank\',1,0,120,90,0,0)}','2010-09-04 23:41:38','2010-09-05 00:43:00','0');
INSERT INTO job_label VALUES('25','{$FR_推荐相片人才}','6','请输入标签介绍...','{getresumelist(20,5,\'0|0|1|0|0|1|0|1|0|0\',1,1,0,0,3,3,\'r_adddate desc\',\'_blank\',2,1,60,72,0,0)}','2010-09-05 09:50:04','2010-10-11 02:50:20','0');
INSERT INTO job_label VALUES('26','{$FR_推荐人才}','6','请输入标签介绍...','{getresumelist(40,2,\'0|0|1|1|0|1|1|0|0|1\',1,1,0,0,3,3,\'r_adddate desc\',\'_blank\',0,0,0,0,0,0)}','2010-09-05 11:19:09','2010-09-05 11:19:09','0');
INSERT INTO job_label VALUES('27','{$FR_推荐名企招聘}','6','请输入标签介绍...','{getcomlist(12,6,0,0,1,1,5,2,1,1,1,\'m_activedate desc\',\'_blank\',1,0,1,0,144,100,0,0,0,0,0,2)}','2010-09-05 11:32:41','2010-10-11 02:09:27','0');
INSERT INTO job_label VALUES('30','{$FR_政策法规}','6','请输入标签介绍...','{getarticlelist(6,-1,\'icon.gif\',24,1,0,0,0,\'n_id desc\',20,\'_blank\',1,2,0,0,0,0)}','2010-10-11 01:41:25','2010-10-11 01:53:59','0');
INSERT INTO job_label VALUES('31','{$FR_优秀相片人才推荐}','6','优秀相片人才推荐','{getresumelist(10,10,\'0|0|0|0|0|0|0|0|0|0\',1,1,1,0,3,3,\'r_adddate desc\',\'_blank\',4,1,60,72,0,0)}','2010-10-11 02:58:23','2010-12-31 10:17:22','0');
INSERT INTO job_label VALUES('32','{$FR_优秀人才推荐}','6','请输入标签介绍...','{getresumelist(30,5,\'0|0|1|1|0|1|0|0|0|0\',1,1,1,0,3,3,\'r_adddate desc\',\'_blank\',0,0,0,0,0,\'\')}','2010-10-11 03:04:10','2010-10-11 03:04:10','0');
INSERT INTO job_label VALUES('33','{$FR_首页创业之路}','6','请输入标签介绍...','{getarticlelist(6,1,\'icon.gif\',10,1,0,0,1,\'n_id desc\',20,\'_blank\',1,2,0,0,0,0)}','2010-10-11 03:31:20','2010-10-11 03:31:20','0');
INSERT INTO job_label VALUES('34','{$FR_首页求职面试}','6','请输入标签介绍...','{getarticlelist(6,6,\'icon.gif\',10,1,0,0,1,\'n_id desc\',20,\'_blank\',1,2,0,0,0,0)}','2010-10-11 03:32:14','2010-10-11 03:32:14','0');
INSERT INTO job_label VALUES('35','{$FR_首页最新资讯}','6','首页最新资讯','{getarticlelist(6,0,\'icon.gif\',10,1,0,0,1,\'n_id desc\',20,\'_blank\',1,2,0,0,0,0)}','2010-10-11 03:58:02','2010-10-11 03:58:02','0');
INSERT INTO job_label VALUES('36','{$FR_首页最新头条资讯}','6','请输入标签介绍...','{getarticlelist(6,0,0,2,3,1,1,1,\'n_id desc\',12,\'_blank\',1,0,60,58,0,30)}','2010-10-11 16:53:15','2010-10-11 16:53:15','0');
INSERT INTO job_label VALUES('37','{$FR_院校排行榜}','6','请输入标签介绍...','{getschlist(10,1,9,3,0,\'\',\'\',20,\'\',1,1,\'m_id desc\',\'_blank\')}','2010-12-17 17:07:37','2010-12-17 17:07:37','0');
INSERT INTO job_label VALUES('38','{$FR_优秀毕业生}','6','请输入标签介绍...','{getstulist(10,2,3,0,\'\',\'\',10,\'\',\'\',\'s_id desc\',\'_blank\')}','2010-12-17 17:20:56','2010-12-17 17:20:56','0');
INSERT INTO job_label VALUES('39','{$FR_最新院校}','6','请输入标签介绍...','{getschlist(15,3,0,3,0,120,72,30,200,1,0,\'m_id desc\',\'_blank\')}','2010-12-17 17:22:28','2010-12-29 18:28:12','0');
INSERT INTO job_label VALUES('40','{$FR_专家教授}','6','请输入标签介绍...','{getprolist(4,2,1,1,127,72,30,50,0,\'p_id desc\',\'_blank\')}','2010-12-17 17:28:23','2010-12-17 17:28:23','0');
INSERT INTO job_label VALUES('41','{$FR_院校展示}','6','请输入标签介绍...','{getschlist(5,1,0,2,0,180,80,\'\',\'\',1,1,\'m_id desc\',\'_blank\')}','2010-12-17 17:32:23','2010-12-17 17:32:23','0');
INSERT INTO job_label VALUES('42','{$FR_全国院校联盟}','6','请输入标签介绍...','{getschlist(30,5,0,3,0,\'\',\'\',\'\',\'\',1,1,\'m_id desc\',\'_blank\')}','2010-12-17 17:33:23','2010-12-17 17:33:23','0');
INSERT INTO job_label VALUES('43','{$FR_培训资讯}','6','请输入标签介绍...','{getarticlelist(6,15,0,15,1,0,0,0,\'n_id desc\',20,\'_blank\',0,0,\'\',\'\',0,\'\')}','2010-12-29 10:07:59','2010-12-29 10:07:59','0');
INSERT INTO job_label VALUES('44','{$FR_培训搜索}','5','请输入标签介绍...','         \r\n            \r\n           \r\n<form id=\"form1\" name=\"form1\" method=\"post\" action=\"/search/course_searchresult.php\" onsubmit=\'return Juge(this)\'>\r\n\r\n<table align=\"center\" cellpadding=\"5\" cellspacing=\"0\">\r\n  <tr>\r\n    <td  align=\"left\">\r\n    <select id=\"select\" name=\"type\">\r\n\r\n         <option>&nbsp;请选择课程类别&nbsp;</option>\r\n          <?php echo getother(\'coursetype\',\'t\',\'t_id asc\',$c_type);?>\r\n      \r\n    </select></td>\r\n  </tr>\r\n  \r\n\r\n  <tr>\r\n    <td  align=\"left\"><input id=\"keyword\"   onfocus=\"return Juges(this.form)\" value=\"输入课程/机构关键字\" type=\"text\" name=\"keyword\" /></td>\r\n  </tr>\r\n  <tr>\r\n    <td align=\"left\"><input value=\"0\" type=\"radio\" name=\"keywordtype\" />\r\n      机构&nbsp;&nbsp;\r\n      <input value=\"1\" checked=\"checked\" type=\"radio\" name=\"keywordtype\" />\r\n      课程&nbsp;</td>\r\n  </tr>\r\n   <tr>\r\n    <td align=\"center\">\r\n    <input name=\'login\' type=\'submit\' class=\'inputs\' id=\'login\' value=\'搜 索\'>\r\n    </td>\r\n  </tr>\r\n  \r\n</table>\r\n\r\n</form>\r\n\r\n\r\n\r\n<script language = \"JavaScript\"> \r\n\r\n\r\nfunction Juge(theForm)\r\n{\r\nif (theForm.type.value==\"\")\r\n  {	\r\n	alert(\"请选择课程类别!\");\r\n    theForm.type.focus();\r\n    return (false);	\r\n  }\r\n	\r\nif (theForm.keyword.value==\"\" || theForm.keyword.value==\"输入课程/机构关键字\")\r\n  {\r\n    alert(\"请输入关键词!\");\r\n    theForm.keyword.focus();\r\n	theForm.keyword.value=\"\";\r\n    return (false);\r\n  }\r\n}\r\nfunction Juges(theForm)\r\n{\r\nif (theForm.keyword.value==\"输入课程/机构关键字\")\r\n  {\r\n	theForm.keyword.value=\"\";\r\n  }\r\n}\r\n\r\n</script> ','2010-12-29 13:58:00','2010-12-29 13:58:00','0');
INSERT INTO job_label VALUES('45','{$FR_精品课程推荐}','6','请输入标签介绍...','{getcoulist(4,2,1,0,80,100,20,20,30,\'c_id desc\',\'_blank\',0,0)}','2010-12-29 14:01:18','2010-12-29 14:01:18','0');
INSERT INTO job_label VALUES('46','{$FR_培训机构推荐}','6','请输入标签介绍...','{gettralist(8,1,0,3,0,\'\',\'\',20,\'\',1,0,\'m_id desc\',\'_blank\')}','2010-12-29 14:10:42','2010-12-29 14:14:50','0');
INSERT INTO job_label VALUES('47','{$FR_培训师推荐}','6','请输入标签介绍...','{gettrarlist(8,4,1,0,80,100,20,20,1,\'t_id desc\',\'_blank\',0,0)}','2010-12-29 14:17:31','2010-12-29 14:17:31','0');
INSERT INTO job_label VALUES('48','{$FR_最新培训课程}','6','请输入标签介绍...','{getcoulist(12,1,2,0,\'\',\'\',\'\',\'\',\'\',\'c_adddate asc\',\'_blank\',0,0)}','2010-12-29 14:21:17','2010-12-29 14:21:17','0');
INSERT INTO job_label VALUES('49','{$FR_最新培训机构}','6','请输入标签介绍...','{gettralist(12,1,0,3,0,\'\',\'\',\'\',\'\',0,0,\'m_regdate asc\',\'_blank\')}','2010-12-29 14:21:45','2010-12-29 14:21:45','0');
INSERT INTO job_label VALUES('50','{$FR_高级猎头职位}','6','请输入标签介绍...','{gethrzwlist(20,1,20,20,\'h_id desc\',\'_blank\',0,1)}','2010-12-30 11:10:02','2010-12-30 11:15:16','0');
INSERT INTO job_label VALUES('51','{$FR_品牌企业招聘}','6','请输入标签介绍...','{getcomlist(12,6,0,12,0,0,5,2,1,1,0,\'m_activedate desc\',\'_blank\',1,0,1,0,144,100,0,0,0,0,0,2)}','2010-12-31 04:27:29','2010-12-31 11:54:04','0');
INSERT INTO job_label VALUES('52','{$FR_首页右上方幻灯片}','6','请输入标签介绍...','{getarticlelist(6,0,0,5,5,0,1,0,\'n_id desc\',0,\'_blank\',0,0,290,238,0,0)}','2010-12-31 09:57:11','2010-12-31 09:57:11','0');
INSERT INTO job_label VALUES('53','{$FR_首页猎头职位}','6','请输入标签介绍...','{gethrzwlist(16,2,6,12,\'h_id desc\',\'_blank\',0,0)}','2010-12-31 10:22:27','2011-01-03 15:22:07','0');
INSERT INTO job_label VALUES('54','{$FR_首页职业指导}','6','请输入标签介绍...','{getarticlelist(6,5,0,8,1,0,0,1,\'n_id desc\',20,\'_blank\',1,2,0,0,1,0)}','2010-12-31 11:23:51','2011-01-03 15:21:40','0');
INSERT INTO job_label VALUES('55','{$FR_首页急聘专区}','6','请输入标签介绍...','{gethirelist(7,1,\'1|1|0|0|0|0|0|0|0|0|0|0|0|1\',0,0,0,0,0,3,3,\'h_adddate desc\',\'_blank\',0,6,10,2)}','2010-12-31 12:04:27','2011-03-05 09:45:48','0');
INSERT INTO job_label VALUES('62','{$FR_导航搜索}','5','请输入标签介绍...','请输入标签内容...','2011-03-04 10:07:39','2011-03-04 10:07:39','0');
INSERT INTO job_label VALUES('63','{$FR_合作伙伴}','6','首页合作伙伴','{getlink(0,100,0,\'l_order asc\',10,\'_blank\',0)}','2011-03-05 09:47:04','2011-03-05 09:47:04','0');
INSERT INTO job_label VALUES('64','{$FR_全部图片链接}','6','全部图片链接','{getlink(1,0,1000,\'l_id desc\',0,\'_blank\',2)}','2011-03-05 09:56:20','2011-03-05 09:56:20','0');
INSERT INTO job_label VALUES('65','{$FR_全部文字链接}','6','全部文字链接','{getlink(0,1000,0,\'l_id desc\',10,\'_blank\',2)}','2011-03-05 09:56:49','2011-03-05 09:56:49','0');
INSERT INTO job_label VALUES('66','{$FR_资讯页名企招聘}','6','请输入标签介绍...','{getcomlist(20,2,0,9,1,0,0,0,0,1,1,\'m_activedate desc\',\'_blank\',0,0,0,0,0,0,\'\',\'\',0,0,0,2)}','2011-03-05 13:45:20','2011-03-05 14:07:48','0');
INSERT INTO job_label VALUES('67','{$FR_最新精彩推荐图片}','6','请输入标签介绍...','{getarticlelist(0,-1,0,5,3,1,1,0,\'n_id desc\',10,\'_blank\',1,0,80,60,0,30)}','2011-03-05 13:52:04','2011-03-05 14:01:15','0');
INSERT INTO job_label VALUES('69','{$FR_高级猎头职位}','6','请输入标签介绍...','{gethrzwlist(16,1,10,12,\'h_adddate desc\',\'_blank\',1,0)}','2011-03-05 21:13:30','2011-03-05 21:13:30','0');

INSERT INTO job_level VALUES('1','小学生','0','level/level1.gif','0');
INSERT INTO job_level VALUES('2','初中生','100','level/level2.gif','0');
INSERT INTO job_level VALUES('3','高中生','1000','level/level3.gif','0');
INSERT INTO job_level VALUES('4','大学生','3000','level/level4.gif','0');
INSERT INTO job_level VALUES('5','研究生','6000','level/level5.gif','0');
INSERT INTO job_level VALUES('6','助理工程师','10000','level/level6.gif','0');
INSERT INTO job_level VALUES('7','工程师','15000','level/level7.gif','0');
INSERT INTO job_level VALUES('8','高级工程师','20000','level/level8.gif','0');
INSERT INTO job_level VALUES('9','专家','28000','level/level9.gif','0');
INSERT INTO job_level VALUES('10','资深专家','36000','level/level10.gif','0');

INSERT INTO job_mailtemp VALUES('1','个人会员注册通知','<p>欢迎注册{$FR_网站名称}个人求职会员！</p>\r\n<p>您注册的用户名是：{$FR_会员用户名}，密码是：{$FR_会员密码}　　您的第一份简历已成功创建，请及时登陆{$FR_网站名称}更新简历内容，以便更快的找到最合适的工作！</p>','个人会员注册通知','person_reg','1');
INSERT INTO job_mailtemp VALUES('2','企业会员注册通知','<p>欢迎注册{$FR_网站名称}企业招聘会员！</p>\r\n<p>您注册的用户名是：{$FR_会员用户名}，密码是：{$FR_会员密码}！</p>','企业会员注册通知','company_reg','2');
INSERT INTO job_mailtemp VALUES('3','院校会员注册通知','院校会员注册通知','院校会员注册通知','school_reg','0');
INSERT INTO job_mailtemp VALUES('4','教育会员注册通知','教育会员注册通知','教育会员注册通知','train_reg','0');
INSERT INTO job_mailtemp VALUES('5','找回密码邮件','<p>{$FR_会员名称},您好！您的新密码设置成功，新密码为:{$FR_会员新密码}请尽快登陆<a href=\"{$FR_网站网址}\">{$FR_网站名称}</a>进行修改。</p>','找回密码邮件','get_pwd','0');
INSERT INTO job_mailtemp VALUES('6','您的好友{$FR_发件人名称}，推荐职位给您，快来看看哦！','<p>{$FR_收件人名称}，您好！</p>\r\n<p>{$FR_邮件正文}</p>\r\n<p>此邮件由系统代发，发件人：{$FR_发件人名称}，邮箱地址：{$FR_发件人邮箱}</p>','给好友推荐职位','to_friend','0');
INSERT INTO job_mailtemp VALUES('7','企业会员审核通知','<p>尊敬的{$FR_会员用户名}：</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 您在<a target=\"_blank\" href=\"{$FR_网站网址}\">{$FR_网站名称}</a>注册提交的企业资料已审核通过，请尽快登陆发布招聘职位！</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 顺祝</p>\r\n<p>商祺！</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$FR_网站名称}</p>','企业会员审核通知','company_flag','0');
INSERT INTO job_mailtemp VALUES('8','个人会员审核通知','<p>尊敬的{$FR_会员用户名}：</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 您在<a target=\"_blank\" href=\"{$FR_网站网址}\">{$FR_网站名称}</a>注册提交的个人资料已审核通过，请尽快登陆填写简历！</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 顺祝</p>\r\n<p>商祺！</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$FR_网站名称}</p>','个人会员审核通知','person_flag','0');
INSERT INTO job_mailtemp VALUES('9','邀请面试：{$FR_单位名称}邀请您面试{$FR_职位名称}','<p>{$FR_应聘者名称}：</p>\r\n<p>您好，{$FR_单位名称}邀请您面试&ldquo;{$FR_职位名称}&rdquo;职位！</p>\r\n<p>职位介绍网址：{$FR_职位地址}</p>\r\n<p>附言如下：</p>\r\n<p>{$FR_留言内容}</p>\r\n<p>&nbsp;</p>','面试邀请通知','in_send','0');
INSERT INTO job_mailtemp VALUES('10','{$FR_应聘者名称}应聘贵公司的“{$FR_职位名称}”职位！','<p>尊敬的{$FR_会员用户名}：</p>\r\n<p>{$FR_应聘者名称}应聘贵公司的&ldquo;{$FR_职位名称}&rdquo;职位！附言如下：</p>\r\n<p>{$FR_求职信内容}</p>\r\n<p>{$FR_应聘者名称}的详细简历地址为：{$FR_简历地址}</p>','职位应聘通知','re_send','0');
INSERT INTO job_mailtemp VALUES('11','应聘“{$FR_职位名称}”，{$FR_应聘者名称}通过“{$FR_网站名称}”给您发送求职简历','<div style=\"font-size: 14px; line-height: 150%; text-align: left;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 您好：{$FR_应聘者名称}对贵公司&ldquo;{$FR_职位名称}&rdquo;职位很感兴趣，通过&ldquo;{$FR_网站名称}&rdquo;&ldquo;外发简历&rdquo;平台向您投递个人简历，简历地址：{$FR_简历地址}<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 如果您对投递者有意向，可直接按简历中联系方式和{$FR_应聘者名称}联系。<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 我们期望与您合作，为您提供大量的优秀人才！ 如您有意向，请<a href=\"{$FR_网站网址}{$FR_系统目录}\" target=\"_blank\">登陆我们网站，筛选更多优秀人才！</a>。<br />{$FR_求职信内容}</div>\r\n<p>&nbsp;</p>','外发简历邮件模版','send_out','0');
INSERT INTO job_mailtemp VALUES('12','{$FR_会员名称},您的留言管理员已回复！','<p>尊敬的{$FR_会员名称}：</p>\r\n<p>您好，您在{$FR_网站名称}提交的主题为{$FR_留言主题}的留言，管理员已回复，<a href=\"{$FR_网站网址}{$FR_系统目录}guestbook\">现在就登陆查看</a>！</p>','留言回复通知','answer_gb','0');
INSERT INTO job_mailtemp VALUES('13','通用邮件模版','<p>尊敬的{$FR_会员用户名}：</p>\r\n<p>{$FR_邮件正文}</p>\r\n<p>&nbsp;</p>','通用邮件模版','mail_mb','0');

INSERT INTO job_marriage VALUES('1','未婚','Single');
INSERT INTO job_marriage VALUES('2','已婚','Married');
INSERT INTO job_marriage VALUES('3','离异','Divorced');
INSERT INTO job_marriage VALUES('4','保密','keep secret');

INSERT INTO job_nation VALUES('1000','汉族','Hanzu');
INSERT INTO job_nation VALUES('1001','蒙古族','Mongol');
INSERT INTO job_nation VALUES('1002','回族','Huizu');
INSERT INTO job_nation VALUES('1003','藏族','Zangzu');
INSERT INTO job_nation VALUES('1004','维吾尔族','Uygur');
INSERT INTO job_nation VALUES('1005','苗族','Miaozu');
INSERT INTO job_nation VALUES('1006','彝族','Yizu');
INSERT INTO job_nation VALUES('1007','壮族','Zhuangzu');
INSERT INTO job_nation VALUES('1008','不依族','Bouyei');
INSERT INTO job_nation VALUES('1009','朝鲜族','Chaoxian');
INSERT INTO job_nation VALUES('1010','满族','Manzu');
INSERT INTO job_nation VALUES('1011','侗族','Dongzu');
INSERT INTO job_nation VALUES('1012','瑶族','Yaozu');
INSERT INTO job_nation VALUES('1013','白族','Baizu');
INSERT INTO job_nation VALUES('1014','土家族','Tujia');
INSERT INTO job_nation VALUES('1015','哈尼族','Hani');
INSERT INTO job_nation VALUES('1016','哈萨克族','Kazak');
INSERT INTO job_nation VALUES('1017','傣族','Daizu');
INSERT INTO job_nation VALUES('1018','黎族','Lizu');
INSERT INTO job_nation VALUES('1019','傈僳族','Lisu');
INSERT INTO job_nation VALUES('1020','佤族','Vazu');
INSERT INTO job_nation VALUES('1021','畲族','Shezu');
INSERT INTO job_nation VALUES('1022','高山族','Gaoshan');
INSERT INTO job_nation VALUES('1023','拉祜','Lahu');
INSERT INTO job_nation VALUES('1024','水族','Suizu');
INSERT INTO job_nation VALUES('1025','东乡族','Dongxiang');
INSERT INTO job_nation VALUES('1026','纳西族','Naxi');
INSERT INTO job_nation VALUES('1027','景颇族','Jingpo');
INSERT INTO job_nation VALUES('1028','柯尔克孜族','Kirgiz');
INSERT INTO job_nation VALUES('1029','土族','Tuzu');
INSERT INTO job_nation VALUES('1030','达斡尔族','Daur');
INSERT INTO job_nation VALUES('1031','仫佬族','Mulam');
INSERT INTO job_nation VALUES('1032','羌族','Qiangzu');
INSERT INTO job_nation VALUES('1033','布朗族','Blang');
INSERT INTO job_nation VALUES('1034','撒拉族','Salar');
INSERT INTO job_nation VALUES('1035','毛难族','Maonan');
INSERT INTO job_nation VALUES('1036','仡佬族','Gelao');
INSERT INTO job_nation VALUES('1037','锡伯族','Xibe');
INSERT INTO job_nation VALUES('1038','阿昌族','Achang');
INSERT INTO job_nation VALUES('1039','普米族','Primi');
INSERT INTO job_nation VALUES('1040','塔吉克族','Tajik');
INSERT INTO job_nation VALUES('1041','怒族','Nuzu');
INSERT INTO job_nation VALUES('1042','乌孜别克族','Uzbek');
INSERT INTO job_nation VALUES('1043','俄罗斯族','Russ');
INSERT INTO job_nation VALUES('1044','鄂温克族','Ewenki');
INSERT INTO job_nation VALUES('1045','崩龙族','Benglong');
INSERT INTO job_nation VALUES('1046','保安族','Bonan');
INSERT INTO job_nation VALUES('1047','裕固族','Yugur');
INSERT INTO job_nation VALUES('1048','京族','Ginzu');
INSERT INTO job_nation VALUES('1049','塔塔尔族','Tatar');
INSERT INTO job_nation VALUES('1050','独龙族','Derung');
INSERT INTO job_nation VALUES('1051','鄂伦春族','Oroqen');
INSERT INTO job_nation VALUES('1052','赫哲族','Hezhen');
INSERT INTO job_nation VALUES('1053','门巴族','Monba');
INSERT INTO job_nation VALUES('1054','珞巴族','Lhoba');
INSERT INTO job_nation VALUES('1055','基诺族','Jino');
INSERT INTO job_nation VALUES('1056','外国血统中国籍','Foreigners with Chinese Nationality');
INSERT INTO job_nation VALUES('1057','其他','Others');

INSERT INTO job_newssort VALUES('1','创业之路','6','2010-11-04 20:18:34','0','0');
INSERT INTO job_newssort VALUES('2','职场动态','6','2008-11-13 16:32:40','1','0');
INSERT INTO job_newssort VALUES('3','政策法规','6','2008-11-13 16:42:29','2','0');
INSERT INTO job_newssort VALUES('5','就业指导','6','2008-11-13 16:54:48','3','0');
INSERT INTO job_newssort VALUES('6','求职面试','6','2008-11-13 16:54:57','4','0');
INSERT INTO job_newssort VALUES('7','人事动态','6','2008-11-13 16:55:03','5','0');
INSERT INTO job_newssort VALUES('8','薪酬福利','6','2008-11-13 16:55:08','6','0');
INSERT INTO job_newssort VALUES('9','绩效考核','6','2008-11-13 16:55:17','7','0');
INSERT INTO job_newssort VALUES('10','职场测试','6','2008-11-13 16:56:25','8','0');
INSERT INTO job_newssort VALUES('11','综合新闻','6','2008-11-13 16:56:55','9','0');
INSERT INTO job_newssort VALUES('12','员工管理','6','2008-11-14 09:33:16','10','0');
INSERT INTO job_newssort VALUES('13','经典案例','6','2008-11-14 09:33:23','11','0');
INSERT INTO job_newssort VALUES('14','职业经理','6','2008-11-14 09:33:29','12','0');
INSERT INTO job_newssort VALUES('15','创业培训','6','2008-11-14 09:33:35','13','0');
INSERT INTO job_newssort VALUES('16','疑难解答','6','2008-11-14 09:37:13','14','0');
INSERT INTO job_newssort VALUES('22','猎头资讯','6','2010-12-28 10:45:19','0','0');


INSERT INTO job_payonline VALUES('1','YW92NzU1YnF0YWw2OWQ3MTJkYm54YTlldnJ1aXRlZ3c=','cGF5QGZpbmVyZWFzb24uY29t','MjA4ODEwMjc3NDI0NjUzMw==','1','0','支付宝担保交易');
INSERT INTO job_payonline VALUES('2','Y2hpbmFiYW5rNDg3NDA5NDc4','MTEzOTM=','','2','1','网银支付');
INSERT INTO job_payonline VALUES('3','NjUwNWIwMGFhNzFmNDY4MTI0NDgwNWI0OGE0NmMzZDI=','MTIwNDYyMTkwMQ==','','3','1','财付通支付');
INSERT INTO job_payonline VALUES('4','MzRUdEMxazI4MWVudXIxNTBQNTM5cDV4RXU4UTYxNDVENmtaRTE0dTQxWnFsQzJ4Rks0SjdweHRQNk1D','MTAwMDE1MDE5NTI=','','4','1','易宝支付');
INSERT INTO job_payonline VALUES('5','M250dGN1cGw2c2lqZncwOGdzZWU0NnpjdGZ3dDNkYmw=','YWxpcGF5QGZpbmVyZWFzb24uY29t','MjA4ODUwMTcxMzk3MDQwOQ==','5','1','支付宝即时到账');

INSERT INTO job_polity VALUES('1','党员','Party Member');
INSERT INTO job_polity VALUES('2','团员','League Member');
INSERT INTO job_polity VALUES('3','民主党派','Other Party Member');
INSERT INTO job_polity VALUES('4','群众','Non-Party Member');
INSERT INTO job_polity VALUES('5','其他','Other');

INSERT INTO job_position VALUES('1000','IT-软件开发','IT Software Development','0','0');
INSERT INTO job_position VALUES('1001','IT-硬件开发','IT Hardware Development','0','1');
INSERT INTO job_position VALUES('1002','IT-网络及通讯','IT Network and Communication','0','2');
INSERT INTO job_position VALUES('1003','IT-管理','IT Management','0','3');
INSERT INTO job_position VALUES('1004','IT-品管、技术支持及其它','IT Quality Control, Technical Support and Others','0','4');
INSERT INTO job_position VALUES('1005','营销-管理','Marketing and Management','0','5');
INSERT INTO job_position VALUES('1006','营销-销售','Sales','0','6');
INSERT INTO job_position VALUES('1007','营销-技术服务及客服','Sales, Technical Service and Customer Service','0','7');
INSERT INTO job_position VALUES('1008','营销-其他','Others about Sales','0','8');
INSERT INTO job_position VALUES('1009','物流/贸易/采购','Logistics/Trade/ Purchasing','0','9');
INSERT INTO job_position VALUES('1010','市场/公关/广告','Marketing/Public Relation/Advertising','0','10');
INSERT INTO job_position VALUES('1011','财务/审计/统计/金融','Finance/ Accounting/Statistic','0','11');
INSERT INTO job_position VALUES('1012','行政/人事/后勤','Administration/ Personnel/ Logistics','0','12');
INSERT INTO job_position VALUES('1013','高级管理','Senior Management','0','13');
INSERT INTO job_position VALUES('1014','文字/艺术/设计','Art/Design','0','14');
INSERT INTO job_position VALUES('1015','律师/法务','Lawyer/Justice','0','15');
INSERT INTO job_position VALUES('1016','教师 ','Teachers','0','16');
INSERT INTO job_position VALUES('1017','卫生医疗/护理/保健','Medical Treatment/ Nursing/Health','0','17');
INSERT INTO job_position VALUES('1018','咨询/顾问','Consultant/ Adviser','0','18');
INSERT INTO job_position VALUES('1019','在校学生','Students','0','19');
INSERT INTO job_position VALUES('1020','培训生','Trained Person','0','20');
INSERT INTO job_position VALUES('1021','服务 ','Service','0','21');
INSERT INTO job_position VALUES('1022','房地产/建筑/建材/装潢','Real Estate/ Architecture /Building Materials/ Dec','0','22');
INSERT INTO job_position VALUES('1023','翻译类','Translators','0','23');
INSERT INTO job_position VALUES('1024','纺织服装类','Textile and Clothing','0','24');
INSERT INTO job_position VALUES('1025','化工类','Chemical Industry','0','25');
INSERT INTO job_position VALUES('1026','食品类','Food','0','26');
INSERT INTO job_position VALUES('1027','酒店/餐饮类','Hotel/Food & Beverage','0','27');
INSERT INTO job_position VALUES('1028','包装/印刷/造纸类','Packaging/Printing/Paper','0','28');
INSERT INTO job_position VALUES('1029','机械设备类','Machine and Equipment','0','29');
INSERT INTO job_position VALUES('1030','农林渔牧类','Agriculture','0','30');
INSERT INTO job_position VALUES('1031','交通运输类','Traffic & Transportation','0','31');
INSERT INTO job_position VALUES('1032','电力/电气/能源类','Electric Power/Energy','0','32');
INSERT INTO job_position VALUES('1033','生产/营运/工程','Production/Operation/Project','0','33');
INSERT INTO job_position VALUES('1034','科研人员','Researchers','0','34');
INSERT INTO job_position VALUES('1035','公务员','Civil Servant','0','35');
INSERT INTO job_position VALUES('1036','其他','Others','0','36');
INSERT INTO job_position VALUES('1037','系统分析员','Systems Analyst','1000','37');
INSERT INTO job_position VALUES('1038','高级软件工程师','Senior Software Engineer','1000','38');
INSERT INTO job_position VALUES('1039','软件工程师','Software Engineer','1000','39');
INSERT INTO job_position VALUES('1040','系统工程师','Systematic Engineer','1000','40');
INSERT INTO job_position VALUES('1041','ERP技术/应用顾问','ERP Technical/Application Consultant','1000','41');
INSERT INTO job_position VALUES('1042','数据库工程师','Database Engineer','1000','42');
INSERT INTO job_position VALUES('1043','高级硬件工程师','Senior Hardware Engineer','1001','43');
INSERT INTO job_position VALUES('1044','硬件工程师','Hardware Engineer','1001','44');
INSERT INTO job_position VALUES('1045','单片机/OLC/DSP/底层工程师','Mono-Chip Computers / OLC/DSP /Bottom Engineer','1001','45');
INSERT INTO job_position VALUES('1046','信息技术经理','IT Manager','1002','46');
INSERT INTO job_position VALUES('1047','信息技术主管','IT Supervisor','1002','47');
INSERT INTO job_position VALUES('1048','信息技术专员','IT Specialist','1002','48');
INSERT INTO job_position VALUES('1049','通信技术工程师','Communications Engineer','1002','49');
INSERT INTO job_position VALUES('1050','信息安全工程师','Information Security Engineer','1002','50');
INSERT INTO job_position VALUES('1051','网站营运经理/主管','Web Operations Manager/ Supervisor','1002','51');
INSERT INTO job_position VALUES('1052','网络工程师','Network engineer','1002','52');
INSERT INTO job_position VALUES('1053','网站工程师','Website engineer','1002','53');
INSERT INTO job_position VALUES('1054','系统管理员/网管','System Manager / Webmaster','1002','54');
INSERT INTO job_position VALUES('1055','网页设计/制作','WebPages Designer / Maker','1002','55');
INSERT INTO job_position VALUES('1056','电子商务师','E-commerce Engineer','1002','56');
INSERT INTO job_position VALUES('1057','网站策划','Website Planner','1002','57');
INSERT INTO job_position VALUES('1058','智能大厦/综合布线/弱电','Intelligent Building/Generic Cabling/Light Current','1002','58');
INSERT INTO job_position VALUES('1059','通讯工程师','Communications Engineer','1002','59');
INSERT INTO job_position VALUES('1060','首席技术执行官（CTO）','Chief Technical Officer','1003','60');
INSERT INTO job_position VALUES('1061','技术总监/经理','Technical Director/Manager','1003','61');
INSERT INTO job_position VALUES('1062','项目经理/主管','Project Manager/ Supervisor','1003','62');
INSERT INTO job_position VALUES('1063','项目执行/协调人员','Project Operational Staff/Coordinator','1003','63');
INSERT INTO job_position VALUES('1064','软件工程管理','Software Project Manager','1003','64');
INSERT INTO job_position VALUES('1065','技术支持经理','Technical Support Manager','1004','65');
INSERT INTO job_position VALUES('1066','技术支持工程师','Technical Support Engineer','1004','66');
INSERT INTO job_position VALUES('1067','品质经理','QA Manager','1004','67');
INSERT INTO job_position VALUES('1068','软件测试工程师','Software QA Engineer','1004','68');
INSERT INTO job_position VALUES('1069','硬件测试工程师','Hardware QA Engineer','1004','69');
INSERT INTO job_position VALUES('1070','测试员','QA Inspector','1004','70');
INSERT INTO job_position VALUES('1071','多媒体设计与开发','Multi-media Designer and Developer','1004','71');
INSERT INTO job_position VALUES('1072','计算机辅助设计与绘图','Computer Associate Design and Drawing','1004','72');
INSERT INTO job_position VALUES('1073','系统集成与支持','System Integration and Support','1004','73');
INSERT INTO job_position VALUES('1074','技术文员/助理','Technical Clerk/Assistant','1004','74');
INSERT INTO job_position VALUES('1075','其他','Others','1004','75');
INSERT INTO job_position VALUES('1076','营销总监','Sales director','1005','76');
INSERT INTO job_position VALUES('1077','营销经理','Sales Manager','1005','77');
INSERT INTO job_position VALUES('1078','营销主管','Sales Supervisor','1005','78');
INSERT INTO job_position VALUES('1079','商务经理','Commercial Manager','1005','79');
INSERT INTO job_position VALUES('1080','渠道/分销经理','Channel/Distribution Manager','1005','80');
INSERT INTO job_position VALUES('1081','客户经理','Account Manager','1005','81');
INSERT INTO job_position VALUES('1082','营销行政经理','Sales Administration Manager','1005','82');
INSERT INTO job_position VALUES('1083','营销行政主管','Sales Administration Supervisor','1005','83');
INSERT INTO job_position VALUES('1084','渠道主管','Distribution Supervisor','1005','84');
INSERT INTO job_position VALUES('1085','区域营销经理','Regional Marketing Manager','1005','85');
INSERT INTO job_position VALUES('1086','销售代表','Sales Representative','1006','86');
INSERT INTO job_position VALUES('1087','经销商','General Distributor','1006','87');
INSERT INTO job_position VALUES('1088','医药代表','Pharmaceutical Sales Representative','1006','88');
INSERT INTO job_position VALUES('1089','保险代理','Insurance Agent','1006','89');
INSERT INTO job_position VALUES('1090','销售工程师','Sales Engineer','1006','90');
INSERT INTO job_position VALUES('1091','电话营销员','Telephone Sales Executive','1006','91');
INSERT INTO job_position VALUES('1092','售前/售后技术服务经理','Technical Service Manager','1007','92');
INSERT INTO job_position VALUES('1093','售前/售后技术服务主管','Technical Service Supervisor','1007','93');
INSERT INTO job_position VALUES('1094','售前/售后技术服务工程师','Technical Service Engineer','1007','94');
INSERT INTO job_position VALUES('1095','售后/客服经理（非技术）','Customer Service Manager','1007','95');
INSERT INTO job_position VALUES('1096','售后/客服主管（非技术）','Customer Service Supervisor','1007','96');
INSERT INTO job_position VALUES('1097','售后/客服专员（非技术）','Customer Service Specialist','1007','97');
INSERT INTO job_position VALUES('1098','客户关系管理','Customer Relationship Management','1007','98');
INSERT INTO job_position VALUES('1099','客户分析','Customer Analyst','1007','99');
INSERT INTO job_position VALUES('1100','投诉管理','Customer Complaint Management','1007','100');
INSERT INTO job_position VALUES('1101','客户培训','Customer Training','1007','101');
INSERT INTO job_position VALUES('1102','热线人员','Hotline Staff','1007','102');
INSERT INTO job_position VALUES('1103','销售助理','Sales Assistant','1008','103');
INSERT INTO job_position VALUES('1104','商务专员/助理','Business Specialist /Assistant','1008','104');
INSERT INTO job_position VALUES('1105','其他','Others','1008','105');
INSERT INTO job_position VALUES('1106','物流经理','Logistics Manager','1009','106');
INSERT INTO job_position VALUES('1107','物流主管','Logistics Supervisor','1009','107');
INSERT INTO job_position VALUES('1108','物流专员/助理','Logistics Specialist /Assistant','1009','108');
INSERT INTO job_position VALUES('1109','物料经理','Materials Manager','1009','109');
INSERT INTO job_position VALUES('1110','物料主管','Materials Supervisor','1009','110');
INSERT INTO job_position VALUES('1111','采购经理','Purchasing Manager','1009','111');
INSERT INTO job_position VALUES('1112','采购主管','Purchasing Supervisor','1009','112');
INSERT INTO job_position VALUES('1113','采购员','Purchasing Executive','1009','113');
INSERT INTO job_position VALUES('1114','外贸/贸易经理/主管','Trading Manager/Supervisor','1009','114');
INSERT INTO job_position VALUES('1115','外贸/贸易专员/助理','Trading Specialist /Assistant','1009','115');
INSERT INTO job_position VALUES('1116','业务跟单经理','Merchandiser Manager','1009','116');
INSERT INTO job_position VALUES('1117','高级业务跟单','Senior Merchandiser','1009','117');
INSERT INTO job_position VALUES('1118','业务跟单','Merchandiser','1009','118');
INSERT INTO job_position VALUES('1119','助理业务跟单','Assistant Merchandiser','1009','119');
INSERT INTO job_position VALUES('1120','仓库经理/主管','Warehouse Manager','1009','120');
INSERT INTO job_position VALUES('1121','仓库管理员','Warehouse Specialist','1009','121');
INSERT INTO job_position VALUES('1122','运输经理/主管','Distribution Manager/Supervisor','1009','122');
INSERT INTO job_position VALUES('1123','报关员','Declarant','1009','123');
INSERT INTO job_position VALUES('1124','单证员','Documentation Specialist','1009','124');
INSERT INTO job_position VALUES('1125','船务人员','Shipping Service Staff','1009','125');
INSERT INTO job_position VALUES('1126','快递员','Courier','1009','126');
INSERT INTO job_position VALUES('1127','理货员','Stockman','1009','127');
INSERT INTO job_position VALUES('1128','其他','Others','1009','128');
INSERT INTO job_position VALUES('1129','市场/广告总监','Marketing/ Advertising Director','1010','129');
INSERT INTO job_position VALUES('1130','市场/营销经理','Marketing Manager','1010','130');
INSERT INTO job_position VALUES('1131','市场/营销主管','Marketing Supervisor','1010','131');
INSERT INTO job_position VALUES('1132','市场/营销专员','Marketing Executive','1010','132');
INSERT INTO job_position VALUES('1133','市场助理','Marketing Assistant','1010','133');
INSERT INTO job_position VALUES('1134','市场分析/调研','Market Analyst/Researcher','1010','134');
INSERT INTO job_position VALUES('1135','产品/品牌经理','Product/Brand Manager','1010','135');
INSERT INTO job_position VALUES('1136','产品/品牌主管','Product/Brand Supervisor','1010','136');
INSERT INTO job_position VALUES('1137','市场通路经理','Trade Marketing Manager','1010','137');
INSERT INTO job_position VALUES('1138','市场通路主管','Trade Marketing Supervisor','1010','138');
INSERT INTO job_position VALUES('1139','促销经理','Promotions Manager','1010','139');
INSERT INTO job_position VALUES('1140','促销主管','Promotions Supervisor','1010','140');
INSERT INTO job_position VALUES('1141','促销员','Promotions Specialist','1010','141');
INSERT INTO job_position VALUES('1142','市场分析/调研人员','Market Analyst/Researcher','1010','142');
INSERT INTO job_position VALUES('1143','公关/会务经理','Public Relations Manager','1010','143');
INSERT INTO job_position VALUES('1144','公关/会务主管','Public Relations Supervisor','1010','144');
INSERT INTO job_position VALUES('1145','公关/会务专员','Public Relations Executive','1010','145');
INSERT INTO job_position VALUES('1146','媒介经理','Media Manager','1010','146');
INSERT INTO job_position VALUES('1147','媒介人员','Media Staff','1010','147');
INSERT INTO job_position VALUES('1148','企业/业务发展经理','Business Development Manager','1010','148');
INSERT INTO job_position VALUES('1149','企业策划人员','Corporate Planner','1010','149');
INSERT INTO job_position VALUES('1150','广告策划/设计/文案','Advertising Creative/Design/Copy writer','1010','150');
INSERT INTO job_position VALUES('1151','营业员','Shop-assistant','1010','151');
INSERT INTO job_position VALUES('1152','收银员','Cashier','1010','152');
INSERT INTO job_position VALUES('1153','拍卖师','Auctioneer','1010','153');
INSERT INTO job_position VALUES('1154','典当业务员','Pawnshop Businessman','1010','154');
INSERT INTO job_position VALUES('1155','租赁业务员','Renting Businessman','1010','155');
INSERT INTO job_position VALUES('1156','出版物发行员','Publishing Staff','1010','156');
INSERT INTO job_position VALUES('1157','其他','Others','1010','157');
INSERT INTO job_position VALUES('1158','财务总监','Financial Controller','1011','158');
INSERT INTO job_position VALUES('1159','财务经理/副经理/主任','Financial Manager/Deputy Manager/ Treasurer','1011','159');
INSERT INTO job_position VALUES('1160','财务主管/总账主管','Finance Executive','1011','160');
INSERT INTO job_position VALUES('1161','会计经理/会计主管','Accounting Manager','1011','161');
INSERT INTO job_position VALUES('1162','会计','Accountant','1011','162');
INSERT INTO job_position VALUES('1163','出纳员','Treasurer','1011','163');
INSERT INTO job_position VALUES('1164','财务/会计助理','Finance / Accounting Assistant','1011','164');
INSERT INTO job_position VALUES('1165','财务分析经理/主管','Financial Analysis Manager/Supervisor','1011','165');
INSERT INTO job_position VALUES('1166','财务分析员','Financial Analyst','1011','166');
INSERT INTO job_position VALUES('1167','成本经理/成本主管','Cost Accounting Manager/Supervisor','1011','167');
INSERT INTO job_position VALUES('1168','成本管理员','Cost Accounting Specialist','1011','168');
INSERT INTO job_position VALUES('1169','审计经理/主管','Audit Manager/ Supervisor','1011','169');
INSERT INTO job_position VALUES('1170','审计专员/助理','Audit Specialist /Assistant','1011','170');
INSERT INTO job_position VALUES('1171','预核算人员','Budgeter','1011','171');
INSERT INTO job_position VALUES('1172','稽核员','Audit Clerk','1011','172');
INSERT INTO job_position VALUES('1173','资产评估','Assets Appraisal','1011','173');
INSERT INTO job_position VALUES('1174','税务经理/税务主管','Tax Manager/ Supervisor','1011','174');
INSERT INTO job_position VALUES('1175','税务专员','Tax Specialist','1011','175');
INSERT INTO job_position VALUES('1176','证券经纪人','Stock Broker','1011','176');
INSERT INTO job_position VALUES('1177','期货经纪人','Future Broker','1011','177');
INSERT INTO job_position VALUES('1178','投资顾问','Investment Advisor','1011','178');
INSERT INTO job_position VALUES('1179','注册分析师','Chartered Financial Analyst','1011','179');
INSERT INTO job_position VALUES('1180','投资/基金项目经理','Investment Manager','1011','180');
INSERT INTO job_position VALUES('1181','融资经理/融资主管','Treasury Supervisor','1011','181');
INSERT INTO job_position VALUES('1182','融资专员','Treasury Specialist','1011','182');
INSERT INTO job_position VALUES('1183','行长/副行长','President/ Vice President','1011','183');
INSERT INTO job_position VALUES('1184','风险控制','Risk Control','1011','184');
INSERT INTO job_position VALUES('1185','进出口/信用证结算','Import & Export Credit Settlement','1011','185');
INSERT INTO job_position VALUES('1186','清算人员','Settlement Officer','1011','186');
INSERT INTO job_position VALUES('1187','外汇主管','Exchange Manager','1011','187');
INSERT INTO job_position VALUES('1188','外汇经纪人','Exchange Broker','1011','188');
INSERT INTO job_position VALUES('1189','高级客户经理/客户经理','Senior Account Manager/ Account Manager','1011','189');
INSERT INTO job_position VALUES('1190','客户主管/专员','Account Supervisor / Specialist','1011','190');
INSERT INTO job_position VALUES('1191','信贷/信用调查/分析人员','Credit/Research/ Analyst','1011','191');
INSERT INTO job_position VALUES('1192','银行柜台出纳','Cashier','1011','192');
INSERT INTO job_position VALUES('1193','统计员','Statistical Clerk','1011','193');
INSERT INTO job_position VALUES('1194','其他','Others','1011','194');
INSERT INTO job_position VALUES('1195','行政/人事总监','Administrative/ Personnel Director','1012','195');
INSERT INTO job_position VALUES('1196','人力资源经理','Human Resource Manager','1012','196');
INSERT INTO job_position VALUES('1197','人事主管','Human Resource Supervisor','1012','197');
INSERT INTO job_position VALUES('1198','人事专员','Human Resource Specialist','1012','198');
INSERT INTO job_position VALUES('1199','人事助理','Assistant HR Supervisor','1012','199');
INSERT INTO job_position VALUES('1200','招聘经理/主管/专员','Recruiting Manager/Supervisor/ Specialist','1012','200');
INSERT INTO job_position VALUES('1201','薪资福利经理/主管','Compensation & Benefits Mgr./Supervisor','1012','201');
INSERT INTO job_position VALUES('1202','薪资福利专员/助理','Compensation & Benefits Specialist/Assistant','1012','202');
INSERT INTO job_position VALUES('1203','绩效考核经理/主管/专员','Performance Check Manager/Supervisor/ Specialist','1012','203');
INSERT INTO job_position VALUES('1204','培训经理/主管','Training Manager/Supervisor','1012','204');
INSERT INTO job_position VALUES('1205','培训专员/助理','Training Specialist/ Assistant','1012','205');
INSERT INTO job_position VALUES('1206','行政经理/主管/办公室主任','Administration Manager/ Supervisor/Office Manager','1012','206');
INSERT INTO job_position VALUES('1207','行政专员/助理','Administration Specialist/ Assistant','1012','207');
INSERT INTO job_position VALUES('1208','经理助理','Manager Assistant','1012','208');
INSERT INTO job_position VALUES('1209','行政秘书','Executive Secretary','1012','209');
INSERT INTO job_position VALUES('1210','商务文秘','Commercial Secretarial Clerk','1012','210');
INSERT INTO job_position VALUES('1211','前台接待/总机','Front Reception/ Operator','1012','211');
INSERT INTO job_position VALUES('1212','后勤','Logistics','1012','212');
INSERT INTO job_position VALUES('1213','图书情报/资料/文档管理','Library Information/ Facilities/Documents Manageme','1012','213');
INSERT INTO job_position VALUES('1214','电脑操作员/打字员','Computer Typist','1012','214');
INSERT INTO job_position VALUES('1215','其他','Others','1012','215');
INSERT INTO job_position VALUES('1216','首席执行官/总经理','CEO/ General Manager','1013','216');
INSERT INTO job_position VALUES('1217','副总经理','Assistant GM','1013','217');
INSERT INTO job_position VALUES('1218','总监','Director','1013','218');
INSERT INTO job_position VALUES('1219','合伙人','Copartner','1013','219');
INSERT INTO job_position VALUES('1220','总裁/副总裁/总经理助理','President / Vice President /Assistant to General M','1013','220');
INSERT INTO job_position VALUES('1221','其他','Others','1013','221');
INSERT INTO job_position VALUES('1222','编辑/作家/撰稿人','Editor/ Writer','1014','222');
INSERT INTO job_position VALUES('1223','记者','Reporter','1014','223');
INSERT INTO job_position VALUES('1224','校对/录入','Proofreader/ Data Entry Staff','1014','224');
INSERT INTO job_position VALUES('1225','排版设计','Layout Designer','1014','225');
INSERT INTO job_position VALUES('1226','艺术/设计总监','Art/Design Director','1014','226');
INSERT INTO job_position VALUES('1227','影视策划/制作人员','Movies & TV Planning/Programming Staff','1014','227');
INSERT INTO job_position VALUES('1228','导演','Director','1014','228');
INSERT INTO job_position VALUES('1229','摄影师','Photographer','1014','229');
INSERT INTO job_position VALUES('1230','音效师/DJ','Sound Effect Controller / DJ','1014','230');
INSERT INTO job_position VALUES('1231','演员/模特/主持人','Actor/Actress/ Model/Anchor person','1014','231');
INSERT INTO job_position VALUES('1232','播音','Announcer','1014','232');
INSERT INTO job_position VALUES('1233','平面设计/美术设计','Graphic Designer/Fine Arts Designer','1014','233');
INSERT INTO job_position VALUES('1234','工业/产品设计','Industry Product Designer','1014','234');
INSERT INTO job_position VALUES('1235','工艺品/珠宝设计','Artwork/Jewelry Designer','1014','235');
INSERT INTO job_position VALUES('1236','室内外装修/装潢设计','Interior and Exterior Decoration/Upholstery Design','1014','236');
INSERT INTO job_position VALUES('1237','家具设计','Furniture Designer','1014','237');
INSERT INTO job_position VALUES('1238','形象设计','Image Designer','1014','238');
INSERT INTO job_position VALUES('1239','舞蹈设计','Dance Designer','1014','239');
INSERT INTO job_position VALUES('1240','其他','Others','1014','240');
INSERT INTO job_position VALUES('1241','律师','Lawyer','1015','241');
INSERT INTO job_position VALUES('1242','律师助理','Lawyer’s Assistant','1015','242');
INSERT INTO job_position VALUES('1243','法律顾问','Counselor','1015','243');
INSERT INTO job_position VALUES('1244','法务助理','Justice Assistant','1015','244');
INSERT INTO job_position VALUES('1245','书记员','Clerk of the Court','1015','245');
INSERT INTO job_position VALUES('1246','其他','Others','1015','246');
INSERT INTO job_position VALUES('1247','幼儿教育','Early Childhood Education','1016','247');
INSERT INTO job_position VALUES('1248','小学教育（数学）','Primary Education(Math)','1016','248');
INSERT INTO job_position VALUES('1249','小学教育（语文）','Primary Education(Chinese)','1016','249');
INSERT INTO job_position VALUES('1250','小学教育（英语）','Primary Education(English)','1016','250');
INSERT INTO job_position VALUES('1251','小学教育（自然）','Primary Education(Nature)','1016','251');
INSERT INTO job_position VALUES('1252','小学教育（体育）','Primary Education(PE)','1016','252');
INSERT INTO job_position VALUES('1253','小学教育（音乐）','Primary Education(Music)','1016','253');
INSERT INTO job_position VALUES('1254','小学教育（综合）','Primary Education(Integration)','1016','254');
INSERT INTO job_position VALUES('1255','小学教育（其他）','Primary Education(Other)','1016','255');
INSERT INTO job_position VALUES('1256','中等教育（数学）','Secondary Education(Math)','1016','256');
INSERT INTO job_position VALUES('1257','中等教育（语文）','Secondary Education(Chinese)','1016','257');
INSERT INTO job_position VALUES('1258','中等教育（物理）','Secondary Education(Physics)','1016','258');
INSERT INTO job_position VALUES('1259','中等教育（化学）','Secondary Education(Chemistry)','1016','259');
INSERT INTO job_position VALUES('1260','中等教育（生物）','Secondary Education(Biology)','1016','260');
INSERT INTO job_position VALUES('1261','中等教育（外语）','Secondary Education(Foreign Language )','1016','261');
INSERT INTO job_position VALUES('1262','中等教育（地理）','Secondary Education(Geography)','1016','262');
INSERT INTO job_position VALUES('1263','中等教育（历史）','Secondary Education(History)','1016','263');
INSERT INTO job_position VALUES('1264','中等教育（体育和保健）','Secondary Education(PE & Health)','1016','264');
INSERT INTO job_position VALUES('1265','中等教育（计算机）','Secondary Education(Computer)','1016','265');
INSERT INTO job_position VALUES('1266','中等教育（音乐）','Secondary Education(Music)','1016','266');
INSERT INTO job_position VALUES('1267','中等教育（美术）','Secondary Education(Fine Arts)','1016','267');
INSERT INTO job_position VALUES('1268','中等教育（思想政治）','Secondary Education(Ideology)','1016','268');
INSERT INTO job_position VALUES('1269','中等教育（电子学）','Secondary Education(Electronics)','1016','269');
INSERT INTO job_position VALUES('1270','中等教育（机械）','Secondary Education(Machinery)','1016','270');
INSERT INTO job_position VALUES('1271','中等教育（化工）','Secondary Education(Chemical Industry)','1016','271');
INSERT INTO job_position VALUES('1272','中等教育（食品）','Secondary Education(Food)','1016','272');
INSERT INTO job_position VALUES('1273','中等教育（烹饪）','Secondary Education(Cuisine)','1016','273');
INSERT INTO job_position VALUES('1274','中等教育（驾驶）','Secondary Education(Driving)','1016','274');
INSERT INTO job_position VALUES('1275','中等教育（服装）','Secondary Education(Clothing)','1016','275');
INSERT INTO job_position VALUES('1276','中等教育（装潢）','Secondary Education(Decoration)','1016','276');
INSERT INTO job_position VALUES('1277','中等教育（建筑）','Secondary Education(Architecture)','1016','277');
INSERT INTO job_position VALUES('1278','中等教育（农学）','Secondary Education(Agriculture)','1016','278');
INSERT INTO job_position VALUES('1279','中等教育（林学）','Secondary Education(Forestry)','1016','279');
INSERT INTO job_position VALUES('1280','中等教育（畜牧）','Secondary Education(Animal Husbandry)','1016','280');
INSERT INTO job_position VALUES('1281','中等教育（养殖）','Secondary Education(Aquaculture)','1016','281');
INSERT INTO job_position VALUES('1282','中等教育（金融）','Secondary Education(Finance )','1016','282');
INSERT INTO job_position VALUES('1283','中等教育（财会）','Secondary Education(Accounting)','1016','283');
INSERT INTO job_position VALUES('1284','中等教育（教育技术）','Secondary Education(Educational Technology)','1016','284');
INSERT INTO job_position VALUES('1285','中等教育（医学护理）','Secondary Education(Medical Nursing)','1016','285');
INSERT INTO job_position VALUES('1286','中等教育（文秘）','Secondary Education(Secretary)','1016','286');
INSERT INTO job_position VALUES('1287','中等教育（表演）','Secondary Education(Acting)','1016','287');
INSERT INTO job_position VALUES('1288','中等教育（综合）','Secondary Education(Integration)','1016','288');
INSERT INTO job_position VALUES('1289','中等教育（其他）','Secondary Education(Others)','1016','289');
INSERT INTO job_position VALUES('1290','高等教育（计算机）','Higher Education(Computer)','1016','290');
INSERT INTO job_position VALUES('1291','高等教育（电子学）','Higher Education(Electronics)','1016','291');
INSERT INTO job_position VALUES('1292','高等教育（微电子）','Higher Education(Microelectronics)','1016','292');
INSERT INTO job_position VALUES('1293','高等教育（机械）','Higher Education(Machinery)','1016','293');
INSERT INTO job_position VALUES('1294','高等教育（化工）','Higher Education(Chemical Industry)','1016','294');
INSERT INTO job_position VALUES('1295','高等教育（食品）','Higher Education(Food)','1016','295');
INSERT INTO job_position VALUES('1296','高等教育（生物）','Higher Education(Biology)','1016','296');
INSERT INTO job_position VALUES('1297','高等教育（服装）','Higher Education(Clothing)','1016','297');
INSERT INTO job_position VALUES('1298','高等教育（建筑）','Higher Education(Architecture)','1016','298');
INSERT INTO job_position VALUES('1299','高等教育（农学）','Higher Education(Agriculture)','1016','299');
INSERT INTO job_position VALUES('1300','高等教育（林学）','Higher Education(Forestry)','1016','300');
INSERT INTO job_position VALUES('1301','高等教育（畜牧）','Higher Education(Animal Husbandry)','1016','301');
INSERT INTO job_position VALUES('1302','高等教育（水产）','Higher Education(Aquaculture)','1016','302');
INSERT INTO job_position VALUES('1303','高等教育（遥感）','Higher Education(Remote Sensing)','1016','303');
INSERT INTO job_position VALUES('1304','高等教育（管理）','Higher Education(Management)','1016','304');
INSERT INTO job_position VALUES('1305','高等教育（数学）','Higher Education(Math)','1016','305');
INSERT INTO job_position VALUES('1306','高等教育（物理学）','Higher Education(Physics)','1016','306');
INSERT INTO job_position VALUES('1307','高等教育（化学）','Higher Education(Chemistry)','1016','307');
INSERT INTO job_position VALUES('1308','高等教育（城市规划）','Higher Education(Urban Planning)','1016','308');
INSERT INTO job_position VALUES('1309','高等教育（英语）','Higher Education(English)','1016','309');
INSERT INTO job_position VALUES('1310','高等教育（法语）','Higher Education(French)','1016','310');
INSERT INTO job_position VALUES('1311','高等教育（日语）','Higher Education(Japanese)','1016','311');
INSERT INTO job_position VALUES('1312','高等教育（德语）','Higher Education(Germany)','1016','312');
INSERT INTO job_position VALUES('1313','高等教育（俄语）','Higher Education(Russian)','1016','313');
INSERT INTO job_position VALUES('1314','高等教育（西班牙语）','Higher Education(Spanish)','1016','314');
INSERT INTO job_position VALUES('1315','高等教育（其他外语）','Higher Education(Other Foreign Languages)','1016','315');
INSERT INTO job_position VALUES('1316','高等教育（法学）','Higher Education(Law)','1016','316');
INSERT INTO job_position VALUES('1317','高等教育（经济学）','Higher Education(Economics)','1016','317');
INSERT INTO job_position VALUES('1318','高等教育（新闻学）','Higher Education(Journalism)','1016','318');
INSERT INTO job_position VALUES('1319','高等教育（心理学）','Higher Education(Psychology)','1016','319');
INSERT INTO job_position VALUES('1320','高等教育（哲学）','Higher Education(Philosophy)','1016','320');
INSERT INTO job_position VALUES('1321','高等教育（文学）','Higher Education(Literature)','1016','321');
INSERT INTO job_position VALUES('1322','高等教育（历史学）','Higher Education(History)','1016','322');
INSERT INTO job_position VALUES('1323','高等教育（考古学）','Higher Education(Archaeology)','1016','323');
INSERT INTO job_position VALUES('1324','高等教育（汉语言学）','Higher Education(Chinese Language)','1016','324');
INSERT INTO job_position VALUES('1325','高等教育（教育技术）','Higher Education(Educational Technology)','1016','325');
INSERT INTO job_position VALUES('1326','高等教育（临床医学）','Higher Education(Basic Medicine)','1016','326');
INSERT INTO job_position VALUES('1327','高等教育（基础医学）','Higher Education(Basic Medicine)','1016','327');
INSERT INTO job_position VALUES('1328','高等教育（医学免疫学）','Higher Education(Medical Immunology)','1016','328');
INSERT INTO job_position VALUES('1329','高等教育（外科学）','Higher Education(Surgery)','1016','329');
INSERT INTO job_position VALUES('1330','高等教育（内科学）','Higher Education(Internal medicine)','1016','330');
INSERT INTO job_position VALUES('1331','高等教育（非典型性肺炎）','Higher Education(SARS)','1016','331');
INSERT INTO job_position VALUES('1332','高等教育（中医学）','Higher Education(Chinese Medicine)','1016','332');
INSERT INTO job_position VALUES('1333','高等教育（体育与健身）','Higher Education(PE and Health)','1016','333');
INSERT INTO job_position VALUES('1334','高等教育（哲学）','Higher Education(Philosophy)','1016','334');
INSERT INTO job_position VALUES('1335','高等教育（美术）','Higher Education(Fine Arts)','1016','335');
INSERT INTO job_position VALUES('1336','高等教育（音乐）','Higher Education(Music)','1016','336');
INSERT INTO job_position VALUES('1337','高等教育（戏曲）','Higher Education(Opera)','1016','337');
INSERT INTO job_position VALUES('1338','高等教育（舞蹈）','Higher Education(Dance)','1016','338');
INSERT INTO job_position VALUES('1339','高等教育（其他）','Higher Education(Others)','1016','339');
INSERT INTO job_position VALUES('1340','教学/教务管理人员','Teaching/ Academic Affairs Manager','1016','340');
INSERT INTO job_position VALUES('1341','家教','Home Tutor','1016','341');
INSERT INTO job_position VALUES('1342','企业内部培训','Enterprise Trainer','1016','342');
INSERT INTO job_position VALUES('1343','其他教师','Others','1016','343');
INSERT INTO job_position VALUES('1344','内科医师 ','Physician','1017','344');
INSERT INTO job_position VALUES('1345','外科医师','Surgeon','1017','345');
INSERT INTO job_position VALUES('1346','儿科医师','Pediatrician','1017','346');
INSERT INTO job_position VALUES('1347','妇产科医师','Obstetrician-gynecologist','1017','347');
INSERT INTO job_position VALUES('1348','眼科医师','Oculist','1017','348');
INSERT INTO job_position VALUES('1349','耳鼻喉科医师','E.N.T. Doctor','1017','349');
INSERT INTO job_position VALUES('1350','口腔科医师','Stomatologist','1017','350');
INSERT INTO job_position VALUES('1351','皮肤科医师','Dermatologist','1017','351');
INSERT INTO job_position VALUES('1352','精神科医师','Psychiatrist','1017','352');
INSERT INTO job_position VALUES('1353','心理医师','Psychiatrist','1017','353');
INSERT INTO job_position VALUES('1354','传染病科医师','Infectious Disease Doctor','1017','354');
INSERT INTO job_position VALUES('1355','急诊科医师','Emergency Doctor','1017','355');
INSERT INTO job_position VALUES('1356','康复科医师','Rehabilitation Doctor','1017','356');
INSERT INTO job_position VALUES('1357','麻醉科医师','Analgesist','1017','357');
INSERT INTO job_position VALUES('1358','病理科医师','Pathology Doctor','1017','358');
INSERT INTO job_position VALUES('1359','放射科医师','Radiologist','1017','359');
INSERT INTO job_position VALUES('1360','核医学医师','Nuclear Medicine Doctor','1017','360');
INSERT INTO job_position VALUES('1361','超声诊断科医师','Ultrasonic Diagnosis Doctor','1017','361');
INSERT INTO job_position VALUES('1362','放射肿瘤科医师','Radiation Oncology Doctor','1017','362');
INSERT INTO job_position VALUES('1363','整形医师','Plastic Surgery Doctor','1017','363');
INSERT INTO job_position VALUES('1364','全科医师','Generalist','1017','364');
INSERT INTO job_position VALUES('1365','乡村医师','Country Doctor','1017','365');
INSERT INTO job_position VALUES('1366','妇幼保健医师','Maternity and Child Care Doctor','1017','366');
INSERT INTO job_position VALUES('1367','输(采供)血医师','Blood Collecting and Supply Doctor','1017','367');
INSERT INTO job_position VALUES('1368','其他西医医师','Other Western Medical Doctor','1017','368');
INSERT INTO job_position VALUES('1369','中医内科医师','Traditional Chinese Medicine Physician','1017','369');
INSERT INTO job_position VALUES('1370','中医外科医师','Traditional Chinese Medicine Surgeon','1017','370');
INSERT INTO job_position VALUES('1371','中医妇科医师','Traditional Chinese Medicine Gynecologist','1017','371');
INSERT INTO job_position VALUES('1372','中医儿科医师','Traditional Chinese Medicine Pediatrician','1017','372');
INSERT INTO job_position VALUES('1373','劳动(职业)卫生医师','Occupational Health Doctor','1017','373');
INSERT INTO job_position VALUES('1374','中医眼科医师','Traditional Chinese Medicine Oculist','1017','374');
INSERT INTO job_position VALUES('1375','放射卫生医师','Radiohygiene Doctor','1017','375');
INSERT INTO job_position VALUES('1376','中医皮肤科医师','Traditional Chinese Medicine Dermatologist','1017','376');
INSERT INTO job_position VALUES('1377','少儿和学校卫生医师','Children and School Health Doctor','1017','377');
INSERT INTO job_position VALUES('1378','中医骨伤科医师','Traditional Chinese Medicine Traumatology & Orthop','1017','378');
INSERT INTO job_position VALUES('1379','中医肛肠科医师','Traditional Chinese Medicine Anus and Intestine Do','1017','379');
INSERT INTO job_position VALUES('1380','中医耳鼻喉科医师','Traditional Chinese Medicine E.N.T. Doctor','1017','380');
INSERT INTO job_position VALUES('1381','针灸科医师','Chinese Acuponcture & Moxibustion Doctor','1017','381');
INSERT INTO job_position VALUES('1382','推拿按摩科医师','Massage Doctor','1017','382');
INSERT INTO job_position VALUES('1383','其他中医医师','Other Traditional Chinese Medicine Doctor','1017','383');
INSERT INTO job_position VALUES('1384','中西医结合医师','Integrated Traditional Chinese and Western Medicin','1017','384');
INSERT INTO job_position VALUES('1385','民族医师','Nationality Doctor','1017','385');
INSERT INTO job_position VALUES('1386','流行病学医师','Epidemiologist','1017','386');
INSERT INTO job_position VALUES('1387','营养与食品卫生医师','Nutrition and Food Health Doctor','1017','387');
INSERT INTO job_position VALUES('1388','环境卫生医师','Environmental Sanitation Doctor','1017','388');
INSERT INTO job_position VALUES('1389','职业病医师','Occupational Disease Doctor','1017','389');
INSERT INTO job_position VALUES('1390','西药剂师','Western Medicine Pharmacist','1017','390');
INSERT INTO job_position VALUES('1391','中药剂师','Traditional Chinese Medicine Pharmacist','1017','391');
INSERT INTO job_position VALUES('1392','其他药剂人员','Other Pharmacists','1017','392');
INSERT INTO job_position VALUES('1393','影像技师','Imaging Technician','1017','393');
INSERT INTO job_position VALUES('1394','麻醉技师','Anesthesia Technician','1017','394');
INSERT INTO job_position VALUES('1395','病理技师',' Pathology Technician','1017','395');
INSERT INTO job_position VALUES('1396','临床检验技师','Clinical Test Technician','1017','396');
INSERT INTO job_position VALUES('1397','公卫检验技师','Public Health Test Technician','1017','397');
INSERT INTO job_position VALUES('1398','卫生工程技师','Sanitary Engineering Technician','1017','398');
INSERT INTO job_position VALUES('1399','输（采供）血技师','Blood Collecting and Supply Technician','1017','399');
INSERT INTO job_position VALUES('1400','其他医疗技术人员','Other Medical Technician','1017','400');
INSERT INTO job_position VALUES('1401','病房护士','Ward Nurse','1017','401');
INSERT INTO job_position VALUES('1402','门诊护士','Clinic Nurse','1017','402');
INSERT INTO job_position VALUES('1403','急诊护士','Emergency Nurse','1017','403');
INSERT INTO job_position VALUES('1404','手术室护士','Operating Nurse','1017','404');
INSERT INTO job_position VALUES('1405','供应室护士','Supply Nurse','1017','405');
INSERT INTO job_position VALUES('1406','社区护士','Community Nurse','1017','406');
INSERT INTO job_position VALUES('1407','助产士','Midwife','1017','407');
INSERT INTO job_position VALUES('1408','其他护理人员','Other Nurses','1017','408');
INSERT INTO job_position VALUES('1409','其他卫生专业技术人员','Other Health Technicians','1017','409');
INSERT INTO job_position VALUES('1410','医学管理人员','Medical Management','1017','410');
INSERT INTO job_position VALUES('1411','医药技术人员','Medicine Technician','1017','411');
INSERT INTO job_position VALUES('1412','化妆/美容师','Cosmetician /Beautician','1017','412');
INSERT INTO job_position VALUES('1413','卫生防疫','Sanitation and Epidemic Prevention','1017','413');
INSERT INTO job_position VALUES('1414','兽医/宠物医生','Veterinarian/ Pet Doctor','1017','414');
INSERT INTO job_position VALUES('1415','其他卫生医疗人员','Other Health and Medical Staff','1017','415');
INSERT INTO job_position VALUES('1416','专业顾问','Professional Adviser','1018','416');
INSERT INTO job_position VALUES('1417','咨询总监','Consulting Director','1018','417');
INSERT INTO job_position VALUES('1418','咨询经理','Consulting Manager','1018','418');
INSERT INTO job_position VALUES('1419','咨询员','Advisory','1018','419');
INSERT INTO job_position VALUES('1420','其他','Others','1018','420');
INSERT INTO job_position VALUES('1421','在校学生(工科)','Students (Engineering)','1019','421');
INSERT INTO job_position VALUES('1422','在校学生(理科)','Students (Science)','1019','422');
INSERT INTO job_position VALUES('1423','在校学生(文科)','Students (Liberal Art)','1019','423');
INSERT INTO job_position VALUES('1424','在校学生(营销)','Students(Sales)','1019','424');
INSERT INTO job_position VALUES('1425','在校学生(艺术)','Students(Art)','1019','425');
INSERT INTO job_position VALUES('1426','在校学生(管理)','Students(Management)','1019','426');
INSERT INTO job_position VALUES('1427','在校学生(师范)','Students(Normal)','1019','427');
INSERT INTO job_position VALUES('1428','在校学生(体育)','Students(PE)','1019','428');
INSERT INTO job_position VALUES('1429','应届毕业生(工科)','Graduating Students(Engineering)','1019','429');
INSERT INTO job_position VALUES('1430','应届毕业生(理科)','Graduating Students(Science)','1019','430');
INSERT INTO job_position VALUES('1431','应届毕业生(文科)','Graduating Students(Liberal Art)','1019','431');
INSERT INTO job_position VALUES('1432','应届毕业生(营销)','Graduating Students(Sales)','1019','432');
INSERT INTO job_position VALUES('1433','应届毕业生(艺术)','Graduating Students(Art)','1019','433');
INSERT INTO job_position VALUES('1434','应届毕业生(管理)','Graduating Students(Management)','1019','434');
INSERT INTO job_position VALUES('1435','应届毕业生(师范)','Graduating Students(Normal)','1019','435');
INSERT INTO job_position VALUES('1436','应届毕业生(体育)','Graduating Students(PE)','1019','436');
INSERT INTO job_position VALUES('1437','实习生(工科)','Interns(Engineering)','1019','437');
INSERT INTO job_position VALUES('1438','实习生(理科)','Interns(Science)','1019','438');
INSERT INTO job_position VALUES('1439','实习生(文科)','Interns(Liberal Art)','1019','439');
INSERT INTO job_position VALUES('1440','实习生(营销)','Interns(Sales)','1019','440');
INSERT INTO job_position VALUES('1441','实习生(艺术)','Interns(Art)','1019','441');
INSERT INTO job_position VALUES('1442','实习生(管理)','Interns(Management)','1019','442');
INSERT INTO job_position VALUES('1443','实习生(师范)','Interns(Normal)','1019','443');
INSERT INTO job_position VALUES('1444','实习生(体育)','Interns(PE)','1019','444');
INSERT INTO job_position VALUES('1445','其他','Others','1019','445');
INSERT INTO job_position VALUES('1446','培训生','Trained Person','1020','446');
INSERT INTO job_position VALUES('1447','美容/健身顾问','Beauty/Exercise Adviser','1021','447');
INSERT INTO job_position VALUES('1448','餐饮/娱乐经理','Food & Beverage / Amusement Manager','1021','448');
INSERT INTO job_position VALUES('1449','宾馆/酒店经理','Hotel Manager','1021','449');
INSERT INTO job_position VALUES('1450','领班','Head Waiter','1021','450');
INSERT INTO job_position VALUES('1451','服务员','Attendant','1021','451');
INSERT INTO job_position VALUES('1452','营业员/收银员/理货员','Salesman/Cashier/ Stockman','1021','452');
INSERT INTO job_position VALUES('1453','厨师','Cook','1021','453');
INSERT INTO job_position VALUES('1454','导游','Tourist Guide','1021','454');
INSERT INTO job_position VALUES('1455','司机','Driver','1021','455');
INSERT INTO job_position VALUES('1456','保安','Security Guard','1021','456');
INSERT INTO job_position VALUES('1457','寻呼员/话务员','Paging Person / Telephonist','1021','457');
INSERT INTO job_position VALUES('1458','其他','Others','1021','458');
INSERT INTO job_position VALUES('1459','建筑设计工程师','Architectural Design Engineer','1022','459');
INSERT INTO job_position VALUES('1460','结构/土建工程师','Structural / Civil Engineer','1022','460');
INSERT INTO job_position VALUES('1461','道路与桥梁设计工程师','Highway and Bridge Design Engineer','1022','461');
INSERT INTO job_position VALUES('1462','道路建筑工程技术人员','Road Construction Engineering Technician','1022','462');
INSERT INTO job_position VALUES('1463','港口与航道工程师','Harbours and Water Channels Engineer','1022','463');
INSERT INTO job_position VALUES('1464','机场工程技术人员','Airport Engineering Technician','1022','464');
INSERT INTO job_position VALUES('1465','电气工程师','Electrical Engineer','1022','465');
INSERT INTO job_position VALUES('1466','给排水/制冷暖通工程师','Drainage/ HVAC Engineer','1022','466');
INSERT INTO job_position VALUES('1467','工程造价师/预结算','Budgeting Specialist/Budgeter','1022','467');
INSERT INTO job_position VALUES('1468','建筑工程管理','Construction Manager','1022','468');
INSERT INTO job_position VALUES('1469','工程监理','Construction Supervisor','1022','469');
INSERT INTO job_position VALUES('1470','室内外装潢设计','Interior and Exterior Decoration Designer','1022','470');
INSERT INTO job_position VALUES('1471','室内外装修','Interior and Exterior Decoration','1022','471');
INSERT INTO job_position VALUES('1472','城市规划与设计','Urban Planning and Design','1022','472');
INSERT INTO job_position VALUES('1473','建筑制图','Architectural Drawer','1022','473');
INSERT INTO job_position VALUES('1474','施工员','Builder Technician','1022','474');
INSERT INTO job_position VALUES('1475','房地产开发/策划','Real Estate Development and Planning Staff','1022','475');
INSERT INTO job_position VALUES('1476','房地产评估','Real Estate Appraisal','1022','476');
INSERT INTO job_position VALUES('1477','房地产中介/交易','Real Estate Agent/Trade','1022','477');
INSERT INTO job_position VALUES('1478','物业管理','Property Management','1022','478');
INSERT INTO job_position VALUES('1479','风景园林工程技术人员','Landscape Engineering Technician','1022','479');
INSERT INTO job_position VALUES('1480','水利水电建筑工程技术人员','Water Conservancy and Hydropower Engineering Techn','1022','480');
INSERT INTO job_position VALUES('1481','硅酸盐工程技术人员','Silicate Engineering Technician','1022','481');
INSERT INTO job_position VALUES('1482','非金属矿及制品工程技术人员','Nonmetallic Minerals and Its Products Engineering ','1022','482');
INSERT INTO job_position VALUES('1483','无机非金属新材料工程技术人员','Inorganic Nonmetallic Materials Engineering Techni','1022','483');
INSERT INTO job_position VALUES('1484','其他','Others','1022','484');
INSERT INTO job_position VALUES('1485','英语翻译','English Translator','1023','485');
INSERT INTO job_position VALUES('1486','俄语翻译','Russian Translator','1023','486');
INSERT INTO job_position VALUES('1487','德语翻译','German Translator','1023','487');
INSERT INTO job_position VALUES('1488','法语翻译','French Translator','1023','488');
INSERT INTO job_position VALUES('1489','西班牙语翻译','Spanish Translator','1023','489');
INSERT INTO job_position VALUES('1490','阿拉伯语翻译','Arabic Translator','1023','490');
INSERT INTO job_position VALUES('1491','日语翻译','Japanese Translator','1023','491');
INSERT INTO job_position VALUES('1492','波斯语翻译','Farsi Translator','1023','492');
INSERT INTO job_position VALUES('1493','朝鲜语翻译','Korean Translator','1023','493');
INSERT INTO job_position VALUES('1494','菲律宾语翻译','Tagalog Translator','1023','494');
INSERT INTO job_position VALUES('1495','梵语巴利语翻译','Sanskrit and Pali Translator','1023','495');
INSERT INTO job_position VALUES('1496','印度尼西亚语翻译','Indonesian Translator','1023','496');
INSERT INTO job_position VALUES('1497','印地语翻译','Hindi Translator','1023','497');
INSERT INTO job_position VALUES('1498','柬埔寨语翻译','Kampuchean Translator','1023','498');
INSERT INTO job_position VALUES('1499','老挝语翻译','Lao Translator','1023','499');
INSERT INTO job_position VALUES('1500','缅甸语翻译','Burmese Translator','1023','500');
INSERT INTO job_position VALUES('1501','马来语翻译','Malay Translator','1023','501');
INSERT INTO job_position VALUES('1502','蒙古语翻译','Mongolian Translator','1023','502');
INSERT INTO job_position VALUES('1503','僧加罗语翻译','Singhalese Translator','1023','503');
INSERT INTO job_position VALUES('1504','泰语翻译','Thai Translator','1023','504');
INSERT INTO job_position VALUES('1505','乌尔都语翻译','Urdu Translator','1023','505');
INSERT INTO job_position VALUES('1506','希伯莱语翻译','Rabbini Translator','1023','506');
INSERT INTO job_position VALUES('1507','越南语翻译','Vietnamese Translator','1023','507');
INSERT INTO job_position VALUES('1508','豪萨语翻译','Chadic Translator','1023','508');
INSERT INTO job_position VALUES('1509','斯瓦希里语翻译','Swahili Translator','1023','509');
INSERT INTO job_position VALUES('1510','阿尔巴尼亚语翻译','Albanian Translator','1023','510');
INSERT INTO job_position VALUES('1511','保加利亚语翻译','Bulgarian Translator','1023','511');
INSERT INTO job_position VALUES('1512','波兰语翻译','Polish Translator','1023','512');
INSERT INTO job_position VALUES('1513','捷克语翻译','Czech Translator','1023','513');
INSERT INTO job_position VALUES('1514','罗马尼亚语翻译','Romanian Translator','1023','514');
INSERT INTO job_position VALUES('1515','葡萄牙语翻译','Portuguese Translator','1023','515');
INSERT INTO job_position VALUES('1516','瑞典语翻译','Swedish Translator','1023','516');
INSERT INTO job_position VALUES('1517','塞尔维亚?克罗地亚语翻译','Serbo ? Croatian Translator','1023','517');
INSERT INTO job_position VALUES('1518','土耳其语翻译','Turkish Translator','1023','518');
INSERT INTO job_position VALUES('1519','希腊语翻译','Greek Translator','1023','519');
INSERT INTO job_position VALUES('1520','匈牙利语翻译','Mungarian Translator','1023','520');
INSERT INTO job_position VALUES('1521','意大利语翻译','Italian Translator','1023','521');
INSERT INTO job_position VALUES('1522','其它语种翻译','Other Translators','1023','522');
INSERT INTO job_position VALUES('1523','纺纱工程师','Textile Engineer','1024','523');
INSERT INTO job_position VALUES('1524','织造工程师','Weaving Engineer','1024','524');
INSERT INTO job_position VALUES('1525','染整工程师','Dyeing and Finishing Engineer','1024','525');
INSERT INTO job_position VALUES('1526','服装设计师','Clothing Designer','1024','526');
INSERT INTO job_position VALUES('1527','服装设计师助理','Assistant Clothing Designer','1024','527');
INSERT INTO job_position VALUES('1528','面料设计师','Fabric Designer','1024','528');
INSERT INTO job_position VALUES('1529','皮革及皮毛工艺师','Leather and Fur Technologist','1024','529');
INSERT INTO job_position VALUES('1530','纺织机械及器材工程师','Textile Machinery Engineer','1024','530');
INSERT INTO job_position VALUES('1531','服装工艺师','Clothing Technologist','1024','531');
INSERT INTO job_position VALUES('1532','服装CAD/CAM','Clothing CAD/CAM','1024','532');
INSERT INTO job_position VALUES('1533','制版师','Plate-maker','1024','533');
INSERT INTO job_position VALUES('1534','服装陈列师','Clothing Displayer','1024','534');
INSERT INTO job_position VALUES('1535','样板师','Pattern Cutter','1024','535');
INSERT INTO job_position VALUES('1536','板房主管','Pattern Room Supervisor','1024','536');
INSERT INTO job_position VALUES('1537','印染工','Dyeing and Printing Worker','1024','537');
INSERT INTO job_position VALUES('1538','针织裁床工','Knitting Cutter','1024','538');
INSERT INTO job_position VALUES('1539','服装打样','Proofing Worker','1024','539');
INSERT INTO job_position VALUES('1540','缝纫工','Sewer','1024','540');
INSERT INTO job_position VALUES('1541','裁剪工','Cutting Worker','1024','541');
INSERT INTO job_position VALUES('1542','熨烫工','Pressing Worker','1024','542');
INSERT INTO job_position VALUES('1543','熟手平车位','Flat Machine Worker','1024','543');
INSERT INTO job_position VALUES('1544','服装车版','Pattern Sewer','1024','544');
INSERT INTO job_position VALUES('1545','纸样排版员','Pattern Composition Staff','1024','545');
INSERT INTO job_position VALUES('1546','车位人员','Flat Machine Staff','1024','546');
INSERT INTO job_position VALUES('1547','服装模特','Model','1024','547');
INSERT INTO job_position VALUES('1548','服装专卖店店长','Clothes Shop Manager','1024','548');
INSERT INTO job_position VALUES('1549','服装加盟部主管/经理','Clothes Leaguing Department Supervisor/Manager','1024','549');
INSERT INTO job_position VALUES('1550','服装品牌部主管/经理','Clothes Brand Department Supervisor/Manager','1024','550');
INSERT INTO job_position VALUES('1551','服装出口部主管/经理','Clothes Export Department Supervisor/Manager','1024','551');
INSERT INTO job_position VALUES('1552','纺织服装QC','Textile and Garment QC','1024','552');
INSERT INTO job_position VALUES('1553','纺织服装其它','Others ','1024','553');
INSERT INTO job_position VALUES('1554','化工实验工程师','Chemical Industry Experiment Engineer','1025','554');
INSERT INTO job_position VALUES('1555','化工设计工程师','Chemical Industry Design Engineer','1025','555');
INSERT INTO job_position VALUES('1556','化工生产工程师','Chemical Production Engineer','1025','556');
INSERT INTO job_position VALUES('1557','工原料准备工','Industry Material Preparation Operator','1025','557');
INSERT INTO job_position VALUES('1558','压缩机工','Compressor Operator','1025','558');
INSERT INTO job_position VALUES('1559','气体净化工','Gas Purification Operator','1025','559');
INSERT INTO job_position VALUES('1560','过滤工','Filter Operator','1025','560');
INSERT INTO job_position VALUES('1561','油加热工','Oil Heating Operator','1025','561');
INSERT INTO job_position VALUES('1562','制冷工','Refrigeration Operator','1025','562');
INSERT INTO job_position VALUES('1563','蒸发工','Evaporation Operator','1025','563');
INSERT INTO job_position VALUES('1564','蒸馏工','Distillation Operator','1025','564');
INSERT INTO job_position VALUES('1565','萃取工','Extraction Operator','1025','565');
INSERT INTO job_position VALUES('1566','吸收工','Absorption Operator','1025','566');
INSERT INTO job_position VALUES('1567','吸附工','Absorption Operator','1025','567');
INSERT INTO job_position VALUES('1568','干燥工','Drying Operator','1025','568');
INSERT INTO job_position VALUES('1569','结晶工','Crystallization Operator','1025','569');
INSERT INTO job_position VALUES('1570','造粒工','Granulation Operator','1025','570');
INSERT INTO job_position VALUES('1571','防腐蚀工','Corrosion Protection Operator','1025','571');
INSERT INTO job_position VALUES('1572','化工工艺试验工','Chemical Process Tester','1025','572');
INSERT INTO job_position VALUES('1573','化工总控工','Chemical Industry General Controller','1025','573');
INSERT INTO job_position VALUES('1574','燃料油生产工','Fuel Oil Producer','1025','574');
INSERT INTO job_position VALUES('1575','润滑油、脂生产工','Lubricant Producer','1025','575');
INSERT INTO job_position VALUES('1576','石油产品精制工','Petroleum Product Refiner','1025','576');
INSERT INTO job_position VALUES('1577','油制气工','Oil Gas Producer','1025','577');
INSERT INTO job_position VALUES('1578','备煤筛焦工','Coal Preparing and Screening Worker','1025','578');
INSERT INTO job_position VALUES('1579','焦炉调温工','Coke Oven Temperature Controller','1025','579');
INSERT INTO job_position VALUES('1580','焦炉机车司机','Coke Oven Engine Driver','1025','580');
INSERT INTO job_position VALUES('1581','煤制气工','Coal Gas Producer','1025','581');
INSERT INTO job_position VALUES('1582','燃气储运工','Fuel Gas Storage and Transport Worker','1025','582');
INSERT INTO job_position VALUES('1583','合成氨生产工','Synthetic Ammonia Producer','1025','583');
INSERT INTO job_position VALUES('1584','尿素生产工','Urea Producer','1025','584');
INSERT INTO job_position VALUES('1585','硝酸铵生产工','Ammonium Nitrate Producer','1025','585');
INSERT INTO job_position VALUES('1586','碳酸氢铵生产工','Ammonium Bicarbonate Producer','1025','586');
INSERT INTO job_position VALUES('1587','硫酸铵生产工','Ammonium Sulfate Producer','1025','587');
INSERT INTO job_position VALUES('1588','过磷酸钙生产工','Superphosphate Producer','1025','588');
INSERT INTO job_position VALUES('1589','复合磷肥生产工','Compound Phosphoric Fertilizer Producer','1025','589');
INSERT INTO job_position VALUES('1590','钙镁磷肥生产工','Ca & Mg Phosphoric Fertilizer Producer','1025','590');
INSERT INTO job_position VALUES('1591','氯化钾生产工','Potassium Chloride Producer','1025','591');
INSERT INTO job_position VALUES('1592','微量元素混肥生产工','Microelement Mixed Fertilizer Producer','1025','592');
INSERT INTO job_position VALUES('1593','硫酸生产工','Sulphuric Acid Producer','1025','593');
INSERT INTO job_position VALUES('1594','硝酸生产工','Nitric Acid Producer','1025','594');
INSERT INTO job_position VALUES('1595','盐酸生产工','Muriatic Acid Producer','1025','595');
INSERT INTO job_position VALUES('1596','磷酸生产工','Phosphoric Acid Producer','1025','596');
INSERT INTO job_position VALUES('1597','纯碱生产工','Soda Producer','1025','597');
INSERT INTO job_position VALUES('1598','烧碱生产工','Caustic Soda Producer','1025','598');
INSERT INTO job_position VALUES('1599','氟化盐生产工','Fluoride Salt Producer','1025','599');
INSERT INTO job_position VALUES('1600','缩聚磷酸盐生产工','Condensed Phosphate Producer','1025','600');
INSERT INTO job_position VALUES('1601','无机化学反应工','Inorganic Chemical Reaction Worker','1025','601');
INSERT INTO job_position VALUES('1602','高频等离子工','High-frequency Plasma Worker','1025','602');
INSERT INTO job_position VALUES('1603','气体深冷分离工','Gas Cryogenic Separating Worker','1025','603');
INSERT INTO job_position VALUES('1604','工业气体液化工','Industry Gas Liquefying Worker','1025','604');
INSERT INTO job_position VALUES('1605','炭黑制造工','Charcoal Black Producer','1025','605');
INSERT INTO job_position VALUES('1606','聚乙烯生产工','Polyethylene Producer','1025','606');
INSERT INTO job_position VALUES('1607','聚丙烯生产工','Polypropylene Producer','1025','607');
INSERT INTO job_position VALUES('1608','聚苯乙烯生产工','Polystyrene Producer','1025','608');
INSERT INTO job_position VALUES('1609','聚丁二烯生产工','Polybutadiene Producer','1025','609');
INSERT INTO job_position VALUES('1610','聚氯乙烯生产工','PVC Producer','1025','610');
INSERT INTO job_position VALUES('1611','环氧树脂生产工','Araldite Producer','1025','611');
INSERT INTO job_position VALUES('1612','丙烯腈-丁二烯-苯乙烯共聚物（ABS）生产工','ABS Producer','1025','612');
INSERT INTO job_position VALUES('1613','顺丁橡胶生产工','Cis1,4polybutadiene Rubber Producer','1025','613');
INSERT INTO job_position VALUES('1614','乙丙橡胶生产工','Ethylene Propylene Rubber Producer','1025','614');
INSERT INTO job_position VALUES('1615','异戊橡胶生产工','Isoprene Producer','1025','615');
INSERT INTO job_position VALUES('1616','丁腈橡胶生产工','Nitrile-butadiene Rubber Producer','1025','616');
INSERT INTO job_position VALUES('1617','丁苯橡胶生产工','Styrene Butadiene Rubber Producer','1025','617');
INSERT INTO job_position VALUES('1618','氯丁橡胶生产工','Neoprene Producer','1025','618');
INSERT INTO job_position VALUES('1619','化纤聚合工','Polymerization Worker','1025','619');
INSERT INTO job_position VALUES('1620','湿纺液制造工','','1025','620');
INSERT INTO job_position VALUES('1621','纺丝工','Spinner','1025','621');
INSERT INTO job_position VALUES('1622','化纤后处理工','Chemical Fiber After-treating Worker','1025','622');
INSERT INTO job_position VALUES('1623','纺丝凝固浴液配制工','Precipitated Coagulating Bath Liquid Mixer','1025','623');
INSERT INTO job_position VALUES('1624','无纺布制造工','Non-Woven Fabric Producer','1025','624');
INSERT INTO job_position VALUES('1625','化纤纺丝精密组件工','Chemical Fiber Precision Component Worker','1025','625');
INSERT INTO job_position VALUES('1626','合成革制造工','Synthetic Leather Producer','1025','626');
INSERT INTO job_position VALUES('1627','有机合成工','Organic Synthesis Worker','1025','627');
INSERT INTO job_position VALUES('1628','农药物测试试验工','Pesticide Tester','1025','628');
INSERT INTO job_position VALUES('1629','感光材料试验工','Sensitive Material Tester','1025','629');
INSERT INTO job_position VALUES('1630','染料标准工','Dye Standard Worker','1025','630');
INSERT INTO job_position VALUES('1631','暗盒制造工','Cassette Producer','1025','631');
INSERT INTO job_position VALUES('1632','染料应用试验工','Dye Application Tester','1025','632');
INSERT INTO job_position VALUES('1633','染料拼混工','Dye Mixer','1025','633');
INSERT INTO job_position VALUES('1634','研磨分散工','Grinding and Separating Worker','1025','634');
INSERT INTO job_position VALUES('1635','催化剂试验工','Activator Tester','1025','635');
INSERT INTO job_position VALUES('1636','催化剂试工','Activator Worker','1025','636');
INSERT INTO job_position VALUES('1637','涂料合成树脂工','Dope Vinylite Worker','1025','637');
INSERT INTO job_position VALUES('1638','制漆配色调制工','Lacquer Colour Mixer','1025','638');
INSERT INTO job_position VALUES('1639','溶剂制造工','Solvent Producer','1025','639');
INSERT INTO job_position VALUES('1640','化学度剂制造工','Chemical Preparation Producer','1025','640');
INSERT INTO job_position VALUES('1641','化工添加剂制造工','Chemical Additive Producer','1025','641');
INSERT INTO job_position VALUES('1642','片基制造工','Film Base Producer','1025','642');
INSERT INTO job_position VALUES('1643','感光材料制造工','Producer','1025','643');
INSERT INTO job_position VALUES('1644','废片、白银回收工','Waste Film and Silver Recycler','1025','644');
INSERT INTO job_position VALUES('1645','磁粉制造工','Magnetic Powder Producer','1025','645');
INSERT INTO job_position VALUES('1646','磁记录材料制造工','Magnetic Record Material Producer','1025','646');
INSERT INTO job_position VALUES('1647','磁记录材料试验工','Magnetic Record Material Tester','1025','647');
INSERT INTO job_position VALUES('1648','感光鼓涂敷工','Sensitive Drum Dauber','1025','648');
INSERT INTO job_position VALUES('1649','单基火药制造工','Single-base Powder Producer','1025','649');
INSERT INTO job_position VALUES('1650','双基火药制造工','Double-base Powder Producer','1025','650');
INSERT INTO job_position VALUES('1651','多基火药制造工','Multi-base Powder Producer','1025','651');
INSERT INTO job_position VALUES('1652','黑火药制造工','Black Powder Producer','1025','652');
INSERT INTO job_position VALUES('1653','含水炸药制造人员','Slurry Explosive Producer','1025','653');
INSERT INTO job_position VALUES('1654','混合火药制造工','Mixed Powder Producer','1025','654');
INSERT INTO job_position VALUES('1655','其他火药制造人员','Other Powder Producer','1025','655');
INSERT INTO job_position VALUES('1656','单质炸药制造工','Explosive Compound Producer','1025','656');
INSERT INTO job_position VALUES('1657','混合炸药制造工','Mixed Explosive Producer','1025','657');
INSERT INTO job_position VALUES('1658','起爆药制造工','Burster Producer','1025','658');
INSERT INTO job_position VALUES('1659','松香工','Colophony Worker','1025','659');
INSERT INTO job_position VALUES('1660','松节油制品工','Terebinth Producer','1025','660');
INSERT INTO job_position VALUES('1661','活性炭生产工',' Active Carbon Producer','1025','661');
INSERT INTO job_position VALUES('1662','栳胶生产工','','1025','662');
INSERT INTO job_position VALUES('1663','紫胶生产工','Lac Producer','1025','663');
INSERT INTO job_position VALUES('1664','栓皮制品工','Cork Producer','1025','664');
INSERT INTO job_position VALUES('1665','木材水解工','Wood Hydrolyzing Worker','1025','665');
INSERT INTO job_position VALUES('1666','树脂基复合材料工','Resin Composite Material Worker','1025','666');
INSERT INTO job_position VALUES('1667','橡胶基复合材料工','Rubber Composite Material Worker','1025','667');
INSERT INTO job_position VALUES('1668','碳基复合材料工','Carbon Composite Material Worker','1025','668');
INSERT INTO job_position VALUES('1669','陶瓷基复合材料工','Ceramics Composite Material Worker','1025','669');
INSERT INTO job_position VALUES('1670','复合固体推进剂成型工','Composite Solid Propellant Shaper','1025','670');
INSERT INTO job_position VALUES('1671','复合固体发动机装药工','Composite Solid Engine Charger','1025','671');
INSERT INTO job_position VALUES('1672','飞机复合材料制品工','Airplane Composite Material Product Maker','1025','672');
INSERT INTO job_position VALUES('1673','制皂工','Soap Producer','1025','673');
INSERT INTO job_position VALUES('1674','甘油工','Glycerol Producer','1025','674');
INSERT INTO job_position VALUES('1675','脂肪酸工','Fatty Acid Producer','1025','675');
INSERT INTO job_position VALUES('1676','洗衣粉成型工','Washing Powder Producer','1025','676');
INSERT INTO job_position VALUES('1677','合成洗涤剂制造工','Synthetic Detergent Producer','1025','677');
INSERT INTO job_position VALUES('1678','香料制造工','Perfume Producer','1025','678');
INSERT INTO job_position VALUES('1679','香精配制工','Perfume Mixer','1025','679');
INSERT INTO job_position VALUES('1680','化妆品配制工','Cosmetic Mixer','1025','680');
INSERT INTO job_position VALUES('1681','牙膏制造工','Toothpaste Producer','1025','681');
INSERT INTO job_position VALUES('1682','油墨制造工','Ink Producer','1025','682');
INSERT INTO job_position VALUES('1683','制胶工','Glue Producer','1025','683');
INSERT INTO job_position VALUES('1684','电子绝缘与介质材料制造工','Electronic Conductive and Medium Materials Produce','1025','684');
INSERT INTO job_position VALUES('1685','化工其他','Others','1025','685');
INSERT INTO job_position VALUES('1686','食品工程师','Food Engineer','1026','686');
INSERT INTO job_position VALUES('1687','食品加工工艺师','Food Processing Technologist','1026','687');
INSERT INTO job_position VALUES('1688','食品化学分析师','Food Chemical Analyst','1026','688');
INSERT INTO job_position VALUES('1689','食品检测员','Food Surveyor','1026','689');
INSERT INTO job_position VALUES('1690','食品认证员','Food Certificating Staff','1026','690');
INSERT INTO job_position VALUES('1691','食品包装设计师','Food Packaging Designer','1026','691');
INSERT INTO job_position VALUES('1692','食品机械维修员','Food Mechanic ','1026','692');
INSERT INTO job_position VALUES('1693','食品卫生管理','Food Sanitary Management','1026','693');
INSERT INTO job_position VALUES('1694','食品品质控制','Food Quality Control','1026','694');
INSERT INTO job_position VALUES('1695','粮油管理员','Grain and oil Manager','1026','695');
INSERT INTO job_position VALUES('1696','保鲜员','Keeping-fresh Staff','1026','696');
INSERT INTO job_position VALUES('1697','冷藏工','Cold Storage Staff','1026','697');
INSERT INTO job_position VALUES('1698','酿造发酵工程师','Brewage and Fermentation Engineer','1026','698');
INSERT INTO job_position VALUES('1699','品酒师','Wine Taster ','1026','699');
INSERT INTO job_position VALUES('1700','营养师','Nutritionist','1026','700');
INSERT INTO job_position VALUES('1701','面包师','Baker','1026','701');
INSERT INTO job_position VALUES('1702','糕点师','Cake Maker','1026','702');
INSERT INTO job_position VALUES('1703','果脯蜜饯加工工艺师','Candied Fruit Processing Technologist','1026','703');
INSERT INTO job_position VALUES('1704','米面加工工艺师','Grain Processing Technologist','1026','704');
INSERT INTO job_position VALUES('1705','饮料加工工艺师','Beverage Processing Technologist','1026','705');
INSERT INTO job_position VALUES('1706','糖与巧克力加工工艺师','Sweet and Chocolate Processing Technologist','1026','706');
INSERT INTO job_position VALUES('1707','干果加工工艺师','Dried Fruit Processing Technologist','1026','707');
INSERT INTO job_position VALUES('1708','水果加工工艺师','Fruit Processing Technologist','1026','708');
INSERT INTO job_position VALUES('1709','蔬菜加工工艺师','Vegetable Processing Technologist','1026','709');
INSERT INTO job_position VALUES('1710','水产加工工艺师','Aquatic Product Processing Technologist','1026','710');
INSERT INTO job_position VALUES('1711','乳制品加工工艺师','Dairy Product Processing Technologist','1026','711');
INSERT INTO job_position VALUES('1712','肉制品加工工艺师','Meat Product Processing Technologist','1026','712');
INSERT INTO job_position VALUES('1713','豆制品加工工艺师','Bean Product Processing Technologist','1026','713');
INSERT INTO job_position VALUES('1714','茶叶加工工艺师','Tea Processing Technologist','1026','714');
INSERT INTO job_position VALUES('1715','卷烟加工工艺师','Tobacco Processing Technologist','1026','715');
INSERT INTO job_position VALUES('1716','淀粉加工工艺师','Starch Processing Technologist','1026','716');
INSERT INTO job_position VALUES('1717','菌藻加工工艺师','Fungus and Algae Processing Technologist','1026','717');
INSERT INTO job_position VALUES('1718','调味品加工工艺师','Spice Processing Technologist','1026','718');
INSERT INTO job_position VALUES('1719','油脂加工工艺师','Oil Processing Technologist','1026','719');
INSERT INTO job_position VALUES('1720','罐头加工工艺师','Canned Food Processing Technologist','1026','720');
INSERT INTO job_position VALUES('1721','烘焙食品加工工艺师','Baked Food Processing Technologist','1026','721');
INSERT INTO job_position VALUES('1722','休闲食品加工工艺师','Snack Food Processing Technologist','1026','722');
INSERT INTO job_position VALUES('1723','方便食品加工工艺师','Instant Food Processing Technologist','1026','723');
INSERT INTO job_position VALUES('1724','保健食品加工工艺师','Health Food Processing Technologist','1026','724');
INSERT INTO job_position VALUES('1725','冷冻食品加工工艺师','Frozen Food Processing Technologist','1026','725');
INSERT INTO job_position VALUES('1726','地方特产加工工艺师','Local Product Processing Technologist','1026','726');
INSERT INTO job_position VALUES('1727','食品其它','Others','1026','727');
INSERT INTO job_position VALUES('1728','酒店公关销售部总监','Hotel Public Relation and Sales Director','1027','728');
INSERT INTO job_position VALUES('1729','酒店公关销售部经理','Hotel Public Relation and Sales Manager','1027','729');
INSERT INTO job_position VALUES('1730','酒店公关销售部基层管理','Hotel Public Relation and Sales Front-line Managem','1027','730');
INSERT INTO job_position VALUES('1731','酒店公关销售部员工','Hotel Public Relation and Sales Staff','1027','731');
INSERT INTO job_position VALUES('1732','餐饮部总监','Food & Beverage Director','1027','732');
INSERT INTO job_position VALUES('1733','餐饮部经理','Food & Beverage Manager','1027','733');
INSERT INTO job_position VALUES('1734','餐饮部基层管理','Food & Beverage Front-line Management','1027','734');
INSERT INTO job_position VALUES('1735','调酒师','Wine Mixer','1027','735');
INSERT INTO job_position VALUES('1736','茶艺师','Tea Technologist','1027','736');
INSERT INTO job_position VALUES('1737','行政总厨','Executive Head Cook','1027','737');
INSERT INTO job_position VALUES('1738','中厨师长','Chief Cook of Chinese Food','1027','738');
INSERT INTO job_position VALUES('1739','西厨师长','Chief Cook of Western Food','1027','739');
INSERT INTO job_position VALUES('1740','中餐厨师','Chinese Food Cook','1027','740');
INSERT INTO job_position VALUES('1741','西餐厨师','Western Food Cook','1027','741');
INSERT INTO job_position VALUES('1742','中式面点师','Chinese Baker','1027','742');
INSERT INTO job_position VALUES('1743','西式面点师','Western Baker','1027','743');
INSERT INTO job_position VALUES('1744','食雕','Food Carving Staff','1027','744');
INSERT INTO job_position VALUES('1745','冷菜','Cold Dish Staff','1027','745');
INSERT INTO job_position VALUES('1746','砧板','Block Staff','1027','746');
INSERT INTO job_position VALUES('1747','打荷','','1027','747');
INSERT INTO job_position VALUES('1748','炉灶','Stove Staff','1027','748');
INSERT INTO job_position VALUES('1749','宴会','Party Staff','1027','749');
INSERT INTO job_position VALUES('1750','上什','','1027','750');
INSERT INTO job_position VALUES('1751','烧烤','Roasting Staff','1027','751');
INSERT INTO job_position VALUES('1752','房务总监','Room Service Director','1027','752');
INSERT INTO job_position VALUES('1753','客房部经理','Room Service Manager','1027','753');
INSERT INTO job_position VALUES('1754','客房部基层管理','Room Service Front-line Management','1027','754');
INSERT INTO job_position VALUES('1755','客房部员工','Room Service Staff','1027','755');
INSERT INTO job_position VALUES('1756','前厅部经理','Front Office Manager','1027','756');
INSERT INTO job_position VALUES('1757','大堂副理','Lobby Deputy Manager','1027','757');
INSERT INTO job_position VALUES('1758','商场部经理','Store Manager','1027','758');
INSERT INTO job_position VALUES('1759','商场部员工','Store Staff','1027','759');
INSERT INTO job_position VALUES('1760','前厅部基层管理','Front Office Front-line Management','1027','760');
INSERT INTO job_position VALUES('1761','前厅部员工','Front Office','1027','761');
INSERT INTO job_position VALUES('1762','娱乐部总监','Amusement Department Director','1027','762');
INSERT INTO job_position VALUES('1763','娱乐部经理','Amusement Department Manager','1027','763');
INSERT INTO job_position VALUES('1764','娱乐部基层管理','Amusement Department Front-line Management','1027','764');
INSERT INTO job_position VALUES('1765','按摩师','Masseur','1027','765');
INSERT INTO job_position VALUES('1766','技师','Technician','1027','766');
INSERT INTO job_position VALUES('1767','DJ','DJ','1027','767');
INSERT INTO job_position VALUES('1768','健身教练','Exercise Coach','1027','768');
INSERT INTO job_position VALUES('1769','游泳教练','Swimming Coach','1027','769');
INSERT INTO job_position VALUES('1770','娱乐部员工','Amusement Department Staff','1027','770');
INSERT INTO job_position VALUES('1771','酒店保安部经理','Hotel Security Agent Manager','1027','771');
INSERT INTO job_position VALUES('1772','酒店保安部基层管理','Hotel Security Agent Front-line Management','1027','772');
INSERT INTO job_position VALUES('1773','酒店保安部员工','Hotel Security Agent Staff','1027','773');
INSERT INTO job_position VALUES('1774','酒店采购部经理','Hotel Procurement Division Manager','1027','774');
INSERT INTO job_position VALUES('1775','酒店采购部员工','Hotel Procurement Division Staff','1027','775');
INSERT INTO job_position VALUES('1776','酒店工程部经理','Hotel Engineering Department Manager','1027','776');
INSERT INTO job_position VALUES('1777','酒店工程部基层管理','Hotel Engineering Department Front-line Management','1027','777');
INSERT INTO job_position VALUES('1778','酒店工程部员工','Hotel Engineering Department Staff','1027','778');
INSERT INTO job_position VALUES('1779','服务员','Waiter/ Waitress','1027','779');
INSERT INTO job_position VALUES('1780','包装设计师','Packaging Designer','1028','780');
INSERT INTO job_position VALUES('1781','印刷工艺师','Printing technologist','1028','781');
INSERT INTO job_position VALUES('1782','材料工程师','Material Engineer','1028','782');
INSERT INTO job_position VALUES('1783','包装机械设计','Packaging Machine Designer','1028','783');
INSERT INTO job_position VALUES('1784','包装结构设计','Packaging Structural Designer','1028','784');
INSERT INTO job_position VALUES('1785','缓冲包装设计','Buffer Packaging Designer','1028','785');
INSERT INTO job_position VALUES('1786','包装检测','Packaging Inspector','1028','786');
INSERT INTO job_position VALUES('1787','平版制版工','Flat Plate Maker','1028','787');
INSERT INTO job_position VALUES('1788','凸版制版工','Letterpress Plate Maker','1028','788');
INSERT INTO job_position VALUES('1789','凹版制版工','Gravure Plate Maker','1028','789');
INSERT INTO job_position VALUES('1790','孔版制版工','Porous Plate Maker','1028','790');
INSERT INTO job_position VALUES('1791','平版印刷工','Flat Plate Printer','1028','791');
INSERT INTO job_position VALUES('1792','凸版印刷工','Letterpress Plate Printer','1028','792');
INSERT INTO job_position VALUES('1793','凹版印刷工','Gravure Plate Printer','1028','793');
INSERT INTO job_position VALUES('1794','孔版印刷工','Porous Plate Printer','1028','794');
INSERT INTO job_position VALUES('1795','木刻水印印制工','Wooden-Block Printer','1028','795');
INSERT INTO job_position VALUES('1796','丝网印刷技术员','Screen Printing Technician','1028','796');
INSERT INTO job_position VALUES('1797','珂罗印制工','Collotype Printer','1028','797');
INSERT INTO job_position VALUES('1798','盲文印制工','Braille Printer','1028','798');
INSERT INTO job_position VALUES('1799','装订工','Bookbinder','1028','799');
INSERT INTO job_position VALUES('1800','印品整饰工','Printed Matter Decorator','1028','800');
INSERT INTO job_position VALUES('1801','印刷机操作工','Printing Machine Operator','1028','801');
INSERT INTO job_position VALUES('1802','机长?领机','Machine Master','1028','802');
INSERT INTO job_position VALUES('1803','副手','Second Fiddle','1028','803');
INSERT INTO job_position VALUES('1804','扫描','Scanning Operator','1028','804');
INSERT INTO job_position VALUES('1805','调墨工','Ink Mixer','1028','805');
INSERT INTO job_position VALUES('1806','调色员','Colour Mixer','1028','806');
INSERT INTO job_position VALUES('1807','复合','Compounder','1028','807');
INSERT INTO job_position VALUES('1808','涂布','Dauber','1028','808');
INSERT INTO job_position VALUES('1809','折页压痕装订','Page Folding, Pressing and Binding','1028','809');
INSERT INTO job_position VALUES('1810','流延','Flow Casting Worker','1028','810');
INSERT INTO job_position VALUES('1811','吹膜','Blown Film Worker','1028','811');
INSERT INTO job_position VALUES('1812','分切工','Parting Cutter','1028','812');
INSERT INTO job_position VALUES('1813','切纸工','Paper Cutter','1028','813');
INSERT INTO job_position VALUES('1814','制袋','Bag Maker','1028','814');
INSERT INTO job_position VALUES('1815','模压','Coining Worker','1028','815');
INSERT INTO job_position VALUES('1816','割膜','Film Cutter','1028','816');
INSERT INTO job_position VALUES('1817','切袋','Bag Cutter','1028','817');
INSERT INTO job_position VALUES('1818','裁切','Cutter','1028','818');
INSERT INTO job_position VALUES('1819','糊盒','Box Plaster','1028','819');
INSERT INTO job_position VALUES('1820','注塑','Injection Worker','1028','820');
INSERT INTO job_position VALUES('1821','瓦线调试','Line Debugger','1028','821');
INSERT INTO job_position VALUES('1822','瓦线记录员','Line Recorder','1028','822');
INSERT INTO job_position VALUES('1823','其他包装/印刷/造纸类人员','Others','1028','823');
INSERT INTO job_position VALUES('1824','机械设计工程技术人员','Machine Design Engineering Technician','1029','824');
INSERT INTO job_position VALUES('1825','机械制造工程技术人员','Machine Manufacture Engineering Technician','1029','825');
INSERT INTO job_position VALUES('1826','仪器仪表工程技术人员','Instrument Engineering Technician','1029','826');
INSERT INTO job_position VALUES('1827','设备工程技术人员','Equipment Engineering Technician','1029','827');
INSERT INTO job_position VALUES('1828','机械设备安装工','Machine Erector','1029','828');
INSERT INTO job_position VALUES('1829','电气设备安装工','Electric Equipment Erector','1029','829');
INSERT INTO job_position VALUES('1830','管工','Plumber','1029','830');
INSERT INTO job_position VALUES('1831','车工','Latheman','1029','831');
INSERT INTO job_position VALUES('1832','锻造工','Forging Worker','1029','832');
INSERT INTO job_position VALUES('1833','铣工','Miller','1029','833');
INSERT INTO job_position VALUES('1834','冲压工','Presser','1029','834');
INSERT INTO job_position VALUES('1835','刨插工','Planer','1029','835');
INSERT INTO job_position VALUES('1836','剪切工','Cutter','1029','836');
INSERT INTO job_position VALUES('1837','磨工','Grinder','1029','837');
INSERT INTO job_position VALUES('1838','焊工','Welder','1029','838');
INSERT INTO job_position VALUES('1839','镗工','Boring Machine Operator','1029','839');
INSERT INTO job_position VALUES('1840','金属热处理工','Metal Heat-treating Worker','1029','840');
INSERT INTO job_position VALUES('1841','钻床工','Driller','1029','841');
INSERT INTO job_position VALUES('1842','组合机床操作工','Operator of Unit Built Machine Tool ','1029','842');
INSERT INTO job_position VALUES('1843','加工中心操作工','Operator of Machining Center','1029','843');
INSERT INTO job_position VALUES('1844','制齿工','Tooth Maker','1029','844');
INSERT INTO job_position VALUES('1845','螺丝纹挤形工','Thread Pusher','1029','845');
INSERT INTO job_position VALUES('1846','抛磨光工','Polishing Worker','1029','846');
INSERT INTO job_position VALUES('1847','拉床工','Broaching Machine Worker','1029','847');
INSERT INTO job_position VALUES('1848','锯床工','Sawing Machine Worker','1029','848');
INSERT INTO job_position VALUES('1849','刃具扭制工','Cutlery Winder','1029','849');
INSERT INTO job_position VALUES('1850','弹性元件制造工','Elastic Cell Maker','1029','850');
INSERT INTO job_position VALUES('1851','其他机械冷加工人员','Other Cold-working Worker','1029','851');
INSERT INTO job_position VALUES('1852','电切削工','Electrical Cutting Worker','1029','852');
INSERT INTO job_position VALUES('1853','冷作钣金工','Sheet Metal Worker','1029','853');
INSERT INTO job_position VALUES('1854','其他冷作钣金加工人员','Other Sheet Metal Workers','1029','854');
INSERT INTO job_position VALUES('1855','镀层工','Coating Worker','1029','855');
INSERT INTO job_position VALUES('1856','涂装工','Painting Dressing Worker','1029','856');
INSERT INTO job_position VALUES('1857','磨料制造工','Abrasive Maker','1029','857');
INSERT INTO job_position VALUES('1858','磨具制造工','Sharpener Maker','1029','858');
INSERT INTO job_position VALUES('1859','金属软管、波纹管工','Metal Soft Pipe and Bellows Worker','1029','859');
INSERT INTO job_position VALUES('1860','卫星光学冷加工工','Satellite Optical Cold-working Worker','1029','860');
INSERT INTO job_position VALUES('1861','航天器件高温处理工','Spacecraft Components Heat-treating Worker','1029','861');
INSERT INTO job_position VALUES('1862','电焊条制造工','Welding Electrode Maker','1029','862');
INSERT INTO job_position VALUES('1863','仪器仪表无件制造工','Instrument Maker','1029','863');
INSERT INTO job_position VALUES('1864','真空干燥处理工','Vacuum Drying Treating Worker','1029','864');
INSERT INTO job_position VALUES('1865','人造宝石制造工','Synthetic Cut Stone Maker','1029','865');
INSERT INTO job_position VALUES('1866','机修钳工','Machine Maintenance Locksmith','1029','866');
INSERT INTO job_position VALUES('1867','汽车修理工','Motorcar Repairman','1029','867');
INSERT INTO job_position VALUES('1868','船舶修理工','Ship Repairman','1029','868');
INSERT INTO job_position VALUES('1869','工业自动化仪器仪表与装置修理工','Industrial Automation Instrument and Equipment Rep','1029','869');
INSERT INTO job_position VALUES('1870','电工仪器仪表修理工','Electrical Instrument Repairman','1029','870');
INSERT INTO job_position VALUES('1871','精密仪器仪表修理工','Precise Instrument Repairman','1029','871');
INSERT INTO job_position VALUES('1873','中小型施工机械操作工','Small and Medium-sized Construction Machine Operat','1029','873');
INSERT INTO job_position VALUES('1874','林业生态环境工程技术人员','Forest Ecological Environment Engineering Technici','1030','874');
INSERT INTO job_position VALUES('1875','森林培育工程技术人员','Silviculture Engineering Technician','1030','875');
INSERT INTO job_position VALUES('1876','园林绿化工程技术人员','Landscaping Engineering Technician','1030','876');
INSERT INTO job_position VALUES('1877','野生动物保护与繁殖利用工程技术人员','Engineering Technician of Wildlife Conservation an','1030','877');
INSERT INTO job_position VALUES('1878','自然保护区工程技术人员','Natural Reserve Engineering Technician','1030','878');
INSERT INTO job_position VALUES('1879','森林保护工程技术人员','Forest Resources Conservation Engineering Technici','1030','879');
INSERT INTO job_position VALUES('1880','木、竹材加工工程技术人员','Wood and Bamboo Processing Engineering Technician','1030','880');
INSERT INTO job_position VALUES('1881','森林采伐和运输工程技术人员','Forest Felling and Transport Engineering Technicia','1030','881');
INSERT INTO job_position VALUES('1882','经济林和林特产品加工工程技术人员','Economic forests and Forest Products Processing En','1030','882');
INSERT INTO job_position VALUES('1883','森林资源管理与监测工程技术人员','Forest Resources Management and Monitoring Enginee','1030','883');
INSERT INTO job_position VALUES('1884','水产养殖工程技术人员','Aquaculture Engineering Technician','1030','884');
INSERT INTO job_position VALUES('1885','渔业资源开发利用工程技术人员','Fishing Resource Development and Utilization Engin','1030','885');
INSERT INTO job_position VALUES('1886','农艺工','Agronomic Worker','1030','886');
INSERT INTO job_position VALUES('1887','作物种子繁育工','Seed Planter','1030','887');
INSERT INTO job_position VALUES('1888','啤酒花生产工','Hop Producer','1030','888');
INSERT INTO job_position VALUES('1889','农作物植保工','Crop Planter','1030','889');
INSERT INTO job_position VALUES('1890','农业实验工','Agriculture Tester','1030','890');
INSERT INTO job_position VALUES('1891','农情测报员','Agriculture Information Reporter','1030','891');
INSERT INTO job_position VALUES('1892','蔬菜园艺工','Vegetable Gardener','1030','892');
INSERT INTO job_position VALUES('1893','花卉园艺工','Flower Gardener','1030','893');
INSERT INTO job_position VALUES('1894','果、茶、桑园艺工','Fruit/Tea/ Mulberry Gardener','1030','894');
INSERT INTO job_position VALUES('1895','天然橡胶生产工','Natural Rubber Producer','1030','895');
INSERT INTO job_position VALUES('1896','剑麻生产工','Sisal Producer','1030','896');
INSERT INTO job_position VALUES('1897','棉花加工工','Cotton Processor','1030','897');
INSERT INTO job_position VALUES('1898','茶叶加工工','Tea Processor','1030','898');
INSERT INTO job_position VALUES('1899','蔬菜加工工','Vegetable Gardener','1030','899');
INSERT INTO job_position VALUES('1900','竹、藤、麻、棕、草制品加工工','Bamboo/Bine/ Hemp/ Palm/Grass Product Processor','1030','900');
INSERT INTO job_position VALUES('1901','特种植物原料加工工','Special Plant Material Processor','1030','901');
INSERT INTO job_position VALUES('1902','林木种苗工','Forest Planter','1030','902');
INSERT INTO job_position VALUES('1903','抚育采伐工','Cultivating and Felling Worker','1030','903');
INSERT INTO job_position VALUES('1904','森林病虫害防治员','Forest Insect Pest Prevention Worker','1030','904');
INSERT INTO job_position VALUES('1905','标本员','Sample Maker','1030','905');
INSERT INTO job_position VALUES('1906','木材采伐工','Wood Feller','1030','906');
INSERT INTO job_position VALUES('1907','家畜饲养工','Livestock Feeder','1030','907');
INSERT INTO job_position VALUES('1908','家畜繁殖工','Livestock Breeder','1030','908');
INSERT INTO job_position VALUES('1909','蜜蜂饲养工','Bee Feeder','1030','909');
INSERT INTO job_position VALUES('1910','动物疫病防治员','Animal Plague Preventing Worker','1030','910');
INSERT INTO job_position VALUES('1911','兽医化验员','Veterinary Analyst','1030','911');
INSERT INTO job_position VALUES('1912','动物检疫检验员','Animal Quarantine Checker','1030','912');
INSERT INTO job_position VALUES('1913','草地监护员','Lawn Guarder','1030','913');
INSERT INTO job_position VALUES('1914','草坪建植工','Lawn Planter','1030','914');
INSERT INTO job_position VALUES('1915','牧草工','Grazing Worker','1030','915');
INSERT INTO job_position VALUES('1916','水生动物苗种繁育工','Aquatic Animal Offspring Propagating Worker','1030','916');
INSERT INTO job_position VALUES('1917','水生动物苗种培育工','Aquatic Animal Offspring Feeder','1030','917');
INSERT INTO job_position VALUES('1918','水生动物饲养工','Aquatic Animal Feeder','1030','918');
INSERT INTO job_position VALUES('1919','水生植物栽培工','Hydrophyte Planter','1030','919');
INSERT INTO job_position VALUES('1920','珍珠养殖工','Pearl Cultivator','1030','920');
INSERT INTO job_position VALUES('1921','生物饵料培养工','Biological Feedstuff Foster','1030','921');
INSERT INTO job_position VALUES('1922','水产养殖潜水工','Aquaculture Diver','1030','922');
INSERT INTO job_position VALUES('1923','水产捕捞工','Aquatic Product Fisher','1030','923');
INSERT INTO job_position VALUES('1924','渔业生产船员','Fishing Production Shipman','1030','924');
INSERT INTO job_position VALUES('1925','渔网具装配工','Fishing Net and Gear Assembler','1030','925');
INSERT INTO job_position VALUES('1926','水产品原料处理工','Raw Aquatic Product Treating Worker','1030','926');
INSERT INTO job_position VALUES('1927','水产品腌熏烤制工','Smoked and Salted Aquatic Product Processor','1030','927');
INSERT INTO job_position VALUES('1928','鱼糜及鱼糜制品加工工','Minced Fillet and Its Product Processor','1030','928');
INSERT INTO job_position VALUES('1929','鱼粉加工工','Fish Meal Processor','1030','929');
INSERT INTO job_position VALUES('1930','鱼肝油及制品加工工','Fish-liver Oil and Its Product Processor','1030','930');
INSERT INTO job_position VALUES('1931','海藻制碘工','Seaweed Iodine Producer','1030','931');
INSERT INTO job_position VALUES('1932','海藻制醇工','Seaweed Alcohols Producer','1030','932');
INSERT INTO job_position VALUES('1933','海藻制胶工','Seaweed Glue Producer','1030','933');
INSERT INTO job_position VALUES('1934','贝类净化工','Shellfish Cleaner','1030','934');
INSERT INTO job_position VALUES('1935','中药材种植员','Chinese Medicinal Material Planter','1030','935');
INSERT INTO job_position VALUES('1936','海藻食品加工工','Seaweed Food Processor','1030','936');
INSERT INTO job_position VALUES('1937','水文勘测工','Hydrologic Surveyor','1030','937');
INSERT INTO job_position VALUES('1938','拖拉机驾驶员','Tractor Driver','1030','938');
INSERT INTO job_position VALUES('1939','联合收割机驾驶员','Combine Harvester Driver','1030','939');
INSERT INTO job_position VALUES('1940','农用运输车驾驶员','Farm-Transporter Driver','1030','940');
INSERT INTO job_position VALUES('1941','飞行驾驶员','Pilot','1031','941');
INSERT INTO job_position VALUES('1942','飞行机械员','Flight Engineer','1031','942');
INSERT INTO job_position VALUES('1943','飞行领航员','Flight Navigator','1031','943');
INSERT INTO job_position VALUES('1944','飞行通信员','Flight Radioman','1031','944');
INSERT INTO job_position VALUES('1945','甲板部技术人员','Deck Technician','1031','945');
INSERT INTO job_position VALUES('1946','轮机部技术人员','Engine Technician','1031','946');
INSERT INTO job_position VALUES('1947','船舶引航员','Ship Pilot','1031','947');
INSERT INTO job_position VALUES('1948','汽车运用工程技术人员','Automobile Application Engineering Technician','1031','948');
INSERT INTO job_position VALUES('1949','船舶运用工程技术人员','Ship Application Engineering Technician','1031','949');
INSERT INTO job_position VALUES('1950','海上救助打捞工程技术人员','Ocean Rescue and Salvage Engineering Technician','1031','950');
INSERT INTO job_position VALUES('1951','船舶检验工程技术人员','Ship Inspection Engineering Technician','1031','951');
INSERT INTO job_position VALUES('1952','其他交通工程技术人员','Other Traffic Engineering Technician','1031','952');
INSERT INTO job_position VALUES('1953','A类汽车驾驶员','A License Driver','1031','953');
INSERT INTO job_position VALUES('1954','B类汽车驾驶员','B License Driver','1031','954');
INSERT INTO job_position VALUES('1955','C类汽车驾驶员','C License Driver','1031','955');
INSERT INTO job_position VALUES('1956','特种车辆驾驶员','Special Vehicle Driver','1031','956');
INSERT INTO job_position VALUES('1957','汽车维修','Automotive Maintenance Personnel','1031','957');
INSERT INTO job_position VALUES('1958','汽车装饰','Automotive Decoration Personnel','1031','958');
INSERT INTO job_position VALUES('1959','火车驾驶员','Train Driver','1031','959');
INSERT INTO job_position VALUES('1960','火车调度员','Train Dispatcher','1031','960');
INSERT INTO job_position VALUES('1961','火车维修','Train Maintenance Personnel','1031','961');
INSERT INTO job_position VALUES('1962','扳道工','Switchman','1031','962');
INSERT INTO job_position VALUES('1963','列车长','Conductor','1031','963');
INSERT INTO job_position VALUES('1964','列车员','Train Attendant','1031','964');
INSERT INTO job_position VALUES('1965','船长','Captain','1031','965');
INSERT INTO job_position VALUES('1966','大副','First Mate','1031','966');
INSERT INTO job_position VALUES('1967','二副','Second Mate','1031','967');
INSERT INTO job_position VALUES('1968','船舶驾驶','Ship Driver','1031','968');
INSERT INTO job_position VALUES('1969','船舶维修','Ship Maintenance Personnel','1031','969');
INSERT INTO job_position VALUES('1970','船员','Sailor','1031','970');
INSERT INTO job_position VALUES('1971','售票员','Conductor','1031','971');
INSERT INTO job_position VALUES('1972','公交调度员','Buses Dispatcher','1031','972');
INSERT INTO job_position VALUES('1973','其他交通运输人员','Other Traffic and Transportation Staff','1031','973');
INSERT INTO job_position VALUES('1974','发电工程技术人员','Power Generation Engineering Technician','1032','974');
INSERT INTO job_position VALUES('1975','输变电工程技术人员','Engineering Technician','1032','975');
INSERT INTO job_position VALUES('1976','供用电工程技术人员','Engineering Technician','1032','976');
INSERT INTO job_position VALUES('1977','电力电气工程师','Electrical Engineer','1032','977');
INSERT INTO job_position VALUES('1978','电力电气预算师','Electrical Budgeter','1032','978');
INSERT INTO job_position VALUES('1979','电力电气监理工程师','Electrical Supervision Engineer','1032','979');
INSERT INTO job_position VALUES('1980','电力系统及其自动化','Electrical system and Automation','1032','980');
INSERT INTO job_position VALUES('1981','电厂电气运行专工','Power Plant Electrical Operator','1032','981');
INSERT INTO job_position VALUES('1982','电力软硬件工程师','Electrical Software and Hardware Engineer','1032','982');
INSERT INTO job_position VALUES('1983','动力能源技术人员','Power Technician','1032','983');
INSERT INTO job_position VALUES('1984','热能动力工程师','Thermal Power Engineer','1032','984');
INSERT INTO job_position VALUES('1985','电化学工程师','Electrochemical Engineer','1032','985');
INSERT INTO job_position VALUES('1986','质量安全工程师','Quality and Safety Engineer','1032','986');
INSERT INTO job_position VALUES('1987','发动机开发工程师','Engine Development Engineer','1032','987');
INSERT INTO job_position VALUES('1988','空气动力工程师','Aerodynamic Engineer','1032','988');
INSERT INTO job_position VALUES('1989','汽机运行专工','Steamer Operation Specialized Worker','1032','989');
INSERT INTO job_position VALUES('1990','汽机检修专工','Steamer Specialized Repairman','1032','990');
INSERT INTO job_position VALUES('1991','电厂锅炉检修专工','Power Plant Boiler Specialized Repairman','1032','991');
INSERT INTO job_position VALUES('1992','发电厂巡操','Power Plant Inspector','1032','992');
INSERT INTO job_position VALUES('1993','水电设计工程师','Hydroelectric Design Engineer','1032','993');
INSERT INTO job_position VALUES('1994','调度保温工程师','Attempering and Insulation','1032','994');
INSERT INTO job_position VALUES('1995','高压变频器应用工程师','High-pressure Converter Application Engineer','1032','995');
INSERT INTO job_position VALUES('1996','谐波治理系统应用工程师','Harmonic Abatement System Application Engineer','1032','996');
INSERT INTO job_position VALUES('1997','水处理设计人员','Water Treatment Designer','1032','997');
INSERT INTO job_position VALUES('1998','水利水电施工安装工程师','Water Conservancy and Hydropower Construction and ','1032','998');
INSERT INTO job_position VALUES('1999','锅炉工程师','Boiler Engineer','1032','999');
INSERT INTO job_position VALUES('2000','汽机工程师','Steam Engine Engineer','1032','1000');
INSERT INTO job_position VALUES('2001','燃机、热机机务工程师','Engine and Heat Engine Locomotive Engineer','1032','1001');
INSERT INTO job_position VALUES('2002','司机','Driver','1032','1002');
INSERT INTO job_position VALUES('2003','司助、司水员','Driver Assistant','1032','1003');
INSERT INTO job_position VALUES('2004','司炉','','1032','1004');
INSERT INTO job_position VALUES('2005','电子电力变压器工程师','Electronic Transformer Engineer','1032','1005');
INSERT INTO job_position VALUES('2006','开关电源研发工程师','Switch and Power R & D Engineer','1032','1006');
INSERT INTO job_position VALUES('2007','安防系统工程师','Safety and Protection System Engineer','1032','1007');
INSERT INTO job_position VALUES('2008','焚烧发电工程师','Fire Power Generation Engineer','1032','1008');
INSERT INTO job_position VALUES('2009','结构工艺设计师','Structure Process Designer','1032','1009');
INSERT INTO job_position VALUES('2010','继电保护产品研发工程师','Relay Protection Product R & D Engineer','1032','1010');
INSERT INTO job_position VALUES('2011','脱硫除尘工程师','Sulfur and Dust Removal Engineer','1032','1011');
INSERT INTO job_position VALUES('2012','油水工程师','Oil and Water Engineer','1032','1012');
INSERT INTO job_position VALUES('2013','核电工程师','Nuclear Power Engineer','1032','1013');
INSERT INTO job_position VALUES('2014','强电工程师','Strong Electricity Engineer','1032','1014');
INSERT INTO job_position VALUES('2015','电测、电能检校','Power Check','1032','1015');
INSERT INTO job_position VALUES('2016','电力通讯设计','Electric Communication Designer','1032','1016');
INSERT INTO job_position VALUES('2017','水工机械工程师','Hydraulic Machinery Engineer','1032','1017');
INSERT INTO job_position VALUES('2018','电能表技术支持工程师','Power Instrument Technology Supply Engineer','1032','1018');
INSERT INTO job_position VALUES('2019','高压电工','High-pressure Electrician','1032','1019');
INSERT INTO job_position VALUES('2020','电工','Electrician','1032','1020');
INSERT INTO job_position VALUES('2021','其他电力/电气/能源人员','Others','1032','1021');
INSERT INTO job_position VALUES('2022','工厂经理/厂长/副厂长/厂长助理','Factory Manager/ Director/ Deputy Director/Directo','1033','1022');
INSERT INTO job_position VALUES('2023','总工程师/副总工程师','Chief Engineer/ Deputy Chief Engineer','1033','1023');
INSERT INTO job_position VALUES('2024','项目经理/主管','Project Manager/Director','1033','1024');
INSERT INTO job_position VALUES('2025','项目工程师','Project Engineer','1033','1025');
INSERT INTO job_position VALUES('2026','营运经理','Operation Manager','1033','1026');
INSERT INTO job_position VALUES('2027','营运主管','Operation Director','1033','1027');
INSERT INTO job_position VALUES('2028','生产经理/车间主任','Production Manager/Workshop Director','1033','1028');
INSERT INTO job_position VALUES('2029','生产计划协调员','Production Plan Coordinator','1033','1029');
INSERT INTO job_position VALUES('2030','生产主管/督导/领班','Production Director/ Supervisor/ Foreman','1033','1030');
INSERT INTO job_position VALUES('2031','技术/工艺设计经理/主管','Technology/ Process Design Manager/Director','1033','1031');
INSERT INTO job_position VALUES('2032','技术/工艺设计工程师','Technology/ Process Design Engineer','1033','1032');
INSERT INTO job_position VALUES('2033','实验室负责人/工程师','Laboratory Director/ Engineer','1033','1033');
INSERT INTO job_position VALUES('2034','工程/设备经理','Project / Equipment Manager','1033','1034');
INSERT INTO job_position VALUES('2035','工程/设备主管','Project / Equipment Director','1033','1035');
INSERT INTO job_position VALUES('2036','工程/设备工程师','Project / Equipment Engineer','1033','1036');
INSERT INTO job_position VALUES('2037','电气/电子工程师','Electrical /Electronics Engineer','1033','1037');
INSERT INTO job_position VALUES('2038','机械工程师','Mechanical Engineer','1033','1038');
INSERT INTO job_position VALUES('2039','机电工程师','Electromechanical Engineer','1033','1039');
INSERT INTO job_position VALUES('2040','模具工程师','Mould Engineer','1033','1040');
INSERT INTO job_position VALUES('2041','维修工程师','Maintenance Engineer','1033','1041');
INSERT INTO job_position VALUES('2042','质量经理','Quality Manager','1033','1042');
INSERT INTO job_position VALUES('2043','质量主管','Quality Director','1033','1043');
INSERT INTO job_position VALUES('2044','质量工程师','Quality Engineer','1033','1044');
INSERT INTO job_position VALUES('2045','质量检验员/测试员','Quality Inspector/ Tester','1033','1045');
INSERT INTO job_position VALUES('2046','认证工程师','Certification Engineer','1033','1046');
INSERT INTO job_position VALUES('2047','安全/健康/环境经理/主管','Safety/Health/Environment Manager/Director','1033','1047');
INSERT INTO job_position VALUES('2048','安全/健康/环境工程师','Safety/Health/Environment Engineer','1033','1048');
INSERT INTO job_position VALUES('2049','工程绘图员','Engineering Drawer','1033','1049');
INSERT INTO job_position VALUES('2050','机械制图员','Mechanical Drawer','1033','1050');
INSERT INTO job_position VALUES('2051','化验员','Analyst','1033','1051');
INSERT INTO job_position VALUES('2052','电工','Electrician','1033','1052');
INSERT INTO job_position VALUES('2053','钳工','Locksmith','1033','1053');
INSERT INTO job_position VALUES('2054','机修工','Mechanic','1033','1054');
INSERT INTO job_position VALUES('2055','钣金工','Sheet Metal Worker','1033','1055');
INSERT INTO job_position VALUES('2056','电焊工','Welder','1033','1056');
INSERT INTO job_position VALUES('2057','铆焊工','Rivet Welder','1033','1057');
INSERT INTO job_position VALUES('2058','车工','Latheman','1033','1058');
INSERT INTO job_position VALUES('2059','磨工','Grinder','1033','1059');
INSERT INTO job_position VALUES('2060','铣工','Miller','1033','1060');
INSERT INTO job_position VALUES('2061','冲床','Punch Worker','1033','1061');
INSERT INTO job_position VALUES('2062','锣床','','1033','1062');
INSERT INTO job_position VALUES('2063','模具工','Mould Worker','1033','1063');
INSERT INTO job_position VALUES('2064','水工','Water Worker','1033','1064');
INSERT INTO job_position VALUES('2065','木工','Carpenter','1033','1065');
INSERT INTO job_position VALUES('2066','油漆工','Painter','1033','1066');
INSERT INTO job_position VALUES('2067','叉车工','Forklift Driver','1033','1067');
INSERT INTO job_position VALUES('2068','空调工','Air-conditioner Worker','1033','1068');
INSERT INTO job_position VALUES('2069','电梯工','Liftman','1033','1069');
INSERT INTO job_position VALUES('2070','锅炉工','Stillman','1033','1070');
INSERT INTO job_position VALUES('2071','普工','Unskilled Man','1033','1071');
INSERT INTO job_position VALUES('2072','其他','Others','1033','1072');
INSERT INTO job_position VALUES('2073','科研管理人员','Research Manager','1034','1073');
INSERT INTO job_position VALUES('2074','科研人员','Researcher','1034','1074');
INSERT INTO job_position VALUES('2075','公务员','Civil Servant','1035','1075');
INSERT INTO job_position VALUES('2076','安全消防','Safety and Fire Fighting','1036','1076');
INSERT INTO job_position VALUES('2077','声光学技术','Acoustic and Optic Technology','1036','1077');
INSERT INTO job_position VALUES('2078','测绘技术','Surveying & Mapping Technology','1036','1078');
INSERT INTO job_position VALUES('2079','地质/矿产','Geology/ Minerals','1036','1079');
INSERT INTO job_position VALUES('2080','冶金/喷涂/金属材料','metallurgy/ sputtering/ Metal material','1036','1080');
INSERT INTO job_position VALUES('2081','其他','Others','1036','1081');

INSERT INTO job_prices VALUES('1','个人简历固顶','30','30','','1','个人简历固顶显示','2010-09-08 16:49:42');
INSERT INTO job_prices VALUES('2','个人照片推荐','30','30','','2','个人照片显示在自荐人才列表','2010-09-08 16:49:42');
INSERT INTO job_prices VALUES('3','企业LOGO推荐','100','30','','3','企业LOGO推荐显示','2010-09-08 16:49:42');
INSERT INTO job_prices VALUES('4','企业固顶显示','300','30','','4','企业信息固顶显示在招聘列表里边','2010-09-08 16:49:42');
INSERT INTO job_prices VALUES('5','职位固顶推荐','50','30','','5','固顶推荐的职位信息将在职位列表顶部显示','2010-09-08 16:49:42');
INSERT INTO job_prices VALUES('6','短信通个人版','10','100','','6','可用短信通知100条','2012-02-18 16:03:33');
INSERT INTO job_prices VALUES('7','短信通企业版','99','1000','','6','可用短信通知1000条','2012-02-18 16:03:33');

INSERT INTO job_profession VALUES('1000','计算机类','Computer','0','0');
INSERT INTO job_profession VALUES('1001','电子通信自控技术类','Electronic Communication and Automation Technology','0','1');
INSERT INTO job_profession VALUES('1002','仪器仪表类','Lnstrument and Apparatus','0','2');
INSERT INTO job_profession VALUES('1003','动力电气类','Power and Electric','0','3');
INSERT INTO job_profession VALUES('1004','食品餐饮类','Food and Beverage','0','4');
INSERT INTO job_profession VALUES('1005','农林牧渔类','Agricultural Sciences','0','5');
INSERT INTO job_profession VALUES('1006','机械类','Machinery','0','6');
INSERT INTO job_profession VALUES('1007','化学工程类','Chemical Engineering','0','7');
INSERT INTO job_profession VALUES('1008','轻工类','Light Industry ','0','8');
INSERT INTO job_profession VALUES('1009','加工制造类','Processing and Manufacturing','0','9');
INSERT INTO job_profession VALUES('1010','测绘','Surveying & Mapping','0','10');
INSERT INTO job_profession VALUES('1011','材料类','Materials','0','11');
INSERT INTO job_profession VALUES('1012','建筑类','Architecture','0','12');
INSERT INTO job_profession VALUES('1013','交通运输类','Science of Traffic & Transportation','0','13');
INSERT INTO job_profession VALUES('1014','能源水利类','Energy and Water Conservancy','0','14');
INSERT INTO job_profession VALUES('1015','生物工程类','Biotechnology','0','15');
INSERT INTO job_profession VALUES('1016','医药学类','Medicine','0','16');
INSERT INTO job_profession VALUES('1017','地矿冶金类','Mining and Metallurgy','0','17');
INSERT INTO job_profession VALUES('1018','环境保护类','Environmental Protection','0','18');
INSERT INTO job_profession VALUES('1019','管理类','Management','0','19');
INSERT INTO job_profession VALUES('1020','理科类','Natural Sciences','0','20');
INSERT INTO job_profession VALUES('1021','技工类','Technician','0','21');
INSERT INTO job_profession VALUES('1022','经济学类','Economics Sciences','0','22');
INSERT INTO job_profession VALUES('1023','财会类','Finance and Accounting','0','23');
INSERT INTO job_profession VALUES('1024','审计统计类','Auditing and Statistics ','0','24');
INSERT INTO job_profession VALUES('1025','财政税务类','Finance and Taxation','0','25');
INSERT INTO job_profession VALUES('1026','金融证券类','Finance and Securities','0','26');
INSERT INTO job_profession VALUES('1027','财经类','Finance','0','27');
INSERT INTO job_profession VALUES('1028','营销类','Sale ','0','28');
INSERT INTO job_profession VALUES('1029','哲学类','Philosophical Sciences','0','29');
INSERT INTO job_profession VALUES('1030','心理学类','Psychological Sciences','0','30');
INSERT INTO job_profession VALUES('1031','历史考古类','History','0','31');
INSERT INTO job_profession VALUES('1032','法学类','Law','0','32');
INSERT INTO job_profession VALUES('1033','社会政治类','Society and politics','0','33');
INSERT INTO job_profession VALUES('1034','艺术类','Arts','0','34');
INSERT INTO job_profession VALUES('1035','语言文学与新闻传播学类','Language & Literatur and News','0','35');
INSERT INTO job_profession VALUES('1036','外语类','Foreign Languages','0','36');
INSERT INTO job_profession VALUES('1037','教育类','Education','0','37');
INSERT INTO job_profession VALUES('1038','航空航天类','Aeronautics and Astronautics','0','38');
INSERT INTO job_profession VALUES('1039','军事公安武器类','Military, Public Security and Weapons','0','39');
INSERT INTO job_profession VALUES('1040','商务与旅游类','Business and Tourist','0','40');
INSERT INTO job_profession VALUES('1041','社会公共事务类','Public Affairs','0','41');
INSERT INTO job_profession VALUES('1042','公关文秘类','Public Relations and Secretary','0','42');
INSERT INTO job_profession VALUES('1043','计算机科学与技术','Computer Science and Technology','1000','43');
INSERT INTO job_profession VALUES('1044','计算机软件','Computer Software','1000','44');
INSERT INTO job_profession VALUES('1045','计算机硬件','Computer Hardware','1000','45');
INSERT INTO job_profession VALUES('1046','计算机及外设维修','Computer and Maintenance of Peripheral Equipment','1000','46');
INSERT INTO job_profession VALUES('1047','计算机应用','Computer Applied Technology','1000','47');
INSERT INTO job_profession VALUES('1048','计算机及应用','Computer and Applications','1000','48');
INSERT INTO job_profession VALUES('1049','计算机工程','Computer Engineering','1000','49');
INSERT INTO job_profession VALUES('1050','人工智能','Artificial Intelligence','1000','50');
INSERT INTO job_profession VALUES('1051','计算机网络','Computer Network','1000','51');
INSERT INTO job_profession VALUES('1052','计算机网络技术','Computer Network Technology','1000','52');
INSERT INTO job_profession VALUES('1053','计算机绘图','Computer Produced Drawing','1000','53');
INSERT INTO job_profession VALUES('1054','计算机维修','Computer Maintenance','1000','54');
INSERT INTO job_profession VALUES('1055','信息工程','Information Engineering','1000','55');
INSERT INTO job_profession VALUES('1056','信息管理与信息系统','Information Management & Information System','1000','56');
INSERT INTO job_profession VALUES('1057','电子商务','Electronic Commerce','1000','57');
INSERT INTO job_profession VALUES('1058','办公自动化','Office Automation','1000','58');
INSERT INTO job_profession VALUES('1059','图书信息管理','Library Information Management','1000','59');
INSERT INTO job_profession VALUES('1060','电子科学与技术','Electronic Science and Technology','1001','60');
INSERT INTO job_profession VALUES('1061','电子与信息技术','Electronic and Information Technology','1001','61');
INSERT INTO job_profession VALUES('1062','电子技术应用','Electronic Applied Technology','1001','62');
INSERT INTO job_profession VALUES('1063','电子工程','Electronic engineering','1001','63');
INSERT INTO job_profession VALUES('1064','微电子学','Microelectronics ','1001','64');
INSERT INTO job_profession VALUES('1065','电子材料与元器件','Electronic Materials and Components','1001','65');
INSERT INTO job_profession VALUES('1066','光信息工程与技术','Optical Information Engineering and Technology','1001','66');
INSERT INTO job_profession VALUES('1067','无线电技术','Radio Technology','1001','67');
INSERT INTO job_profession VALUES('1068','半导体集成技术','Semiconductor Integration Technology','1001','68');
INSERT INTO job_profession VALUES('1069','信息处理','Information Processing','1001','69');
INSERT INTO job_profession VALUES('1070','通信技术','Communications Technology','1001','70');
INSERT INTO job_profession VALUES('1071','通信电源技术','Communications Power Supply Technology','1001','71');
INSERT INTO job_profession VALUES('1072','通信运营管理','Communications Operation Administration','1001','72');
INSERT INTO job_profession VALUES('1073','智能控制','Intelligent Control','1001','73');
INSERT INTO job_profession VALUES('1074','广播电视工程','Radio and Television Engineering','1001','74');
INSERT INTO job_profession VALUES('1075','自动控制','Automatic Control','1001','75');
INSERT INTO job_profession VALUES('1076','自动化','Automation','1001','76');
INSERT INTO job_profession VALUES('1077','应用电子技术','Electronic and Information Engineering','1001','77');
INSERT INTO job_profession VALUES('1078','电子信息工程','Electronic and Information Engineering','1001','78');
INSERT INTO job_profession VALUES('1079','通信工程','Telecommunications Engineering','1001','79');
INSERT INTO job_profession VALUES('1080','铁道信号','Railway Signal','1001','80');
INSERT INTO job_profession VALUES('1081','船舶通信与导航','Naval Architecture Communications and Navigation','1001','81');
INSERT INTO job_profession VALUES('1082','邮政通信管理 ','Post Communications Administration','1001','82');
INSERT INTO job_profession VALUES('1083','邮政自动化技术','Post Automation Technology','1001','83');
INSERT INTO job_profession VALUES('1084','广播电视应用技术','Radio and Television Applied Technology','1001','84');
INSERT INTO job_profession VALUES('1085','飞行器电子设备维修','Flight Vehicle Electronic Equipment Maintenance','1001','85');
INSERT INTO job_profession VALUES('1086','船舶电子设备','Naval Architecture Electronic Equipment','1001','86');
INSERT INTO job_profession VALUES('1087','电子通信其它','Others','1001','87');
INSERT INTO job_profession VALUES('1088','测控技术与仪器','Measuring & Control Technology and Instrumentation','1002','88');
INSERT INTO job_profession VALUES('1089','传感器','Sensors','1002','89');
INSERT INTO job_profession VALUES('1090','精密仪器','Precision Instrument','1002','90');
INSERT INTO job_profession VALUES('1091','测试仪器','Test Instrument','1002','91');
INSERT INTO job_profession VALUES('1092','光学仪器','Optical Instrument','1002','92');
INSERT INTO job_profession VALUES('1093','其它仪器','Others','1002','93');
INSERT INTO job_profession VALUES('1094','热能与动力工程','Thermal Energy and Power Engineering','1003','94');
INSERT INTO job_profession VALUES('1095','核工程与核技术','Nuclear Engineering and Technology','1003','95');
INSERT INTO job_profession VALUES('1096','电机学','Electromechanics','1003','96');
INSERT INTO job_profession VALUES('1097','电力拖动','Electric Traction','1003','97');
INSERT INTO job_profession VALUES('1098','发配电工程','Electricity Generation and Distribution Engineerin','1003','98');
INSERT INTO job_profession VALUES('1099','供用电技术','Electricity Supply and Applied Technology','1003','99');
INSERT INTO job_profession VALUES('1100','发电厂及电力系统','Power Plant and Power System','1003','100');
INSERT INTO job_profession VALUES('1101','电工学','Electrical Engineering','1003','101');
INSERT INTO job_profession VALUES('1102','电力电子技术','Power Electronics Technology','1003','102');
INSERT INTO job_profession VALUES('1103','工业电气自动化','Industry Electric Automation','1003','103');
INSERT INTO job_profession VALUES('1104','电气工程及其自动化','Electrical Engineering and Automation','1003','104');
INSERT INTO job_profession VALUES('1105','电气技术','Electric Technology','1003','105');
INSERT INTO job_profession VALUES('1106','电气其他','Others','1003','106');
INSERT INTO job_profession VALUES('1107','食品科学与工程','Food Science and Engineering','1004','107');
INSERT INTO job_profession VALUES('1108','食品质量与安全','Food Chemistry and Analysis','1004','108');
INSERT INTO job_profession VALUES('1109','食品加工工艺','Food Processing Technology','1004','109');
INSERT INTO job_profession VALUES('1110','食品贮运与保鲜','Food Storage,Transport and Freshness','1004','110');
INSERT INTO job_profession VALUES('1111','食品营养与卫生','Food Nutrition and Hygiene','1004','111');
INSERT INTO job_profession VALUES('1112','食品检测','Food Detection','1004','112');
INSERT INTO job_profession VALUES('1113','食品认证','Food Certification','1004','113');
INSERT INTO job_profession VALUES('1114','食品微生物学','Food Microbiology','1004','114');
INSERT INTO job_profession VALUES('1115','食品机械','Food Machinery','1004','115');
INSERT INTO job_profession VALUES('1116','食品包装','Food Packaging','1004','116');
INSERT INTO job_profession VALUES('1117','粮食、油脂及植物蛋白工程','Cereals, Oils and Vegetable Protein Engineering','1004','117');
INSERT INTO job_profession VALUES('1118','酿酒工程','Wine-making Engineering','1004','118');
INSERT INTO job_profession VALUES('1119','发酵工程','Fermentation Engineering','1004','119');
INSERT INTO job_profession VALUES('1120','蔬菜学','Olericulture','1004','120');
INSERT INTO job_profession VALUES('1121','制糖工程','Sugar Engineering','1004','121');
INSERT INTO job_profession VALUES('1122','农产品加工及贮藏工程','Processing and Storage of Agriculture Products','1004','122');
INSERT INTO job_profession VALUES('1123','烟草化学与工程','Tobacco Chemistry and Engineering','1004','123');
INSERT INTO job_profession VALUES('1124','烹饪','Cuisine','1004','124');
INSERT INTO job_profession VALUES('1125','西餐','Western Food','1004','125');
INSERT INTO job_profession VALUES('1126','面点','Pastry','1004','126');
INSERT INTO job_profession VALUES('1127','糕点','Cake','1004','127');
INSERT INTO job_profession VALUES('1128','品/评/调酒','Wine Taster/Bartender','1004','128');
INSERT INTO job_profession VALUES('1129','饭馆/酒店/餐饮管理','Restaurant/Hotel/Catering Business Management','1004','129');
INSERT INTO job_profession VALUES('1130','食品其它','Others','1004','130');
INSERT INTO job_profession VALUES('1131','农学','Agronomy','1005','131');
INSERT INTO job_profession VALUES('1132','农艺','Agronomy','1005','132');
INSERT INTO job_profession VALUES('1133','种植','Planting','1005','133');
INSERT INTO job_profession VALUES('1134','农业机械化及其自动化','Agricultural mechanization and automation','1005','134');
INSERT INTO job_profession VALUES('1135','农业机械化','Agricultural mechanization','1005','135');
INSERT INTO job_profession VALUES('1136','农业电气化与自动化','Agricultural electrification and automation','1005','136');
INSERT INTO job_profession VALUES('1137','农业建筑环境与能源工程','Agricultural Structure Environment and Energy Engi','1005','137');
INSERT INTO job_profession VALUES('1138','农业生物环境与能源工程','Agricultural Biological Environmental and Energy E','1005','138');
INSERT INTO job_profession VALUES('1139','农业资源与环境','Agricultural Resources and Environment','1005','139');
INSERT INTO job_profession VALUES('1140','农业水利工程','Agricultural Water Conservancy Engineering','1005','140');
INSERT INTO job_profession VALUES('1141','农田水利工程','Farmland Water Conservancy Engineering','1005','141');
INSERT INTO job_profession VALUES('1142','农副产品加工','Agriculture Products Processing','1005','142');
INSERT INTO job_profession VALUES('1143','农村经济管理','Rural Economy Management','1005','143');
INSERT INTO job_profession VALUES('1144','棉花检验加工与管理','Cotton Inspection,Processing and Management','1005','144');
INSERT INTO job_profession VALUES('1145','果树学','Pomology','1005','145');
INSERT INTO job_profession VALUES('1146','茶学','Tea science','1005','146');
INSERT INTO job_profession VALUES('1147','蚕学','Sericulture','1005','147');
INSERT INTO job_profession VALUES('1148','蚕桑','Sericulture','1005','148');
INSERT INTO job_profession VALUES('1149','园艺','Horticulture','1005','149');
INSERT INTO job_profession VALUES('1150','植物保护','Plant Protection','1005','150');
INSERT INTO job_profession VALUES('1151','植物营养学','Plant Nutrition','1005','151');
INSERT INTO job_profession VALUES('1152','草业科学','Prataculture Science','1005','152');
INSERT INTO job_profession VALUES('1153','林学','Forestry','1005','153');
INSERT INTO job_profession VALUES('1154','林业','Forestry','1005','154');
INSERT INTO job_profession VALUES('1155','林特产品加工','Forest Products Processing','1005','155');
INSERT INTO job_profession VALUES('1156','森林资源保护与游憩','Forest Resources Conservation and Recreation','1005','156');
INSERT INTO job_profession VALUES('1157','森林资源与林政管理','Forest Resources and Administration','1005','157');
INSERT INTO job_profession VALUES('1158','森林采运管理','Forest Felling and Transport Management','1005','158');
INSERT INTO job_profession VALUES('1159','园林','Landscape gardening','1005','159');
INSERT INTO job_profession VALUES('1160','森林工程','Forest Logging Engineering','1005','160');
INSERT INTO job_profession VALUES('1161','木材科学与工程','Wood Science and Engineering','1005','161');
INSERT INTO job_profession VALUES('1162','木材加工','Wood Processing','1005','162');
INSERT INTO job_profession VALUES('1163','林产化工','Chemical Processing of Forest Products','1005','163');
INSERT INTO job_profession VALUES('1164','野生动物与自然保护区管理','Wildlife and Natural Reserve Management','1005','164');
INSERT INTO job_profession VALUES('1165','野生动植物保护','Wildlife Conservation','1005','165');
INSERT INTO job_profession VALUES('1166','水土保护与荒漠化防治','Soil and Water Conservation and Combating Desertif','1005','166');
INSERT INTO job_profession VALUES('1167','动物科学','Animal Science','1005','167');
INSERT INTO job_profession VALUES('1168','动物医学','Veterinary Medicine','1005','168');
INSERT INTO job_profession VALUES('1169','畜牧兽医学','Veterinary Medicine','1005','169');
INSERT INTO job_profession VALUES('1170','动物遗传育种与繁殖','Animal Genetics, Breeding and Reproduction Science','1005','170');
INSERT INTO job_profession VALUES('1171','动物营养与饲料科学','Animal Nutrition and Feed Science','1005','171');
INSERT INTO job_profession VALUES('1172','养殖','Aquaculture','1005','172');
INSERT INTO job_profession VALUES('1173','水产学','Fisheries Science','1005','173');
INSERT INTO job_profession VALUES('1174','水产养殖学','Aquaculture Science','1005','174');
INSERT INTO job_profession VALUES('1175','海洋渔业科学与技术','Marine fishery science and technology','1005','175');
INSERT INTO job_profession VALUES('1176','航海捕捞','Marne Fishing','1005','176');
INSERT INTO job_profession VALUES('1177','海洋生物','Marne Biology','1005','177');
INSERT INTO job_profession VALUES('1178','海洋科学','Marne Science','1005','178');
INSERT INTO job_profession VALUES('1179','机械设计制造及其自动化','Machine Design & Manufacturing and Automation','1006','179');
INSERT INTO job_profession VALUES('1180','材料成型及控制工程','Material Processing and Control','1006','180');
INSERT INTO job_profession VALUES('1181','工业设计','Industrial Design','1006','181');
INSERT INTO job_profession VALUES('1182','过程装备与控制工程','Process Equipment and Control','1006','182');
INSERT INTO job_profession VALUES('1183','塑性加工','Plastic Working','1006','183');
INSERT INTO job_profession VALUES('1184','制冷设备','Refrigeration Equipment','1006','184');
INSERT INTO job_profession VALUES('1185','精密机械','Precision Machinery','1006','185');
INSERT INTO job_profession VALUES('1186','机械设计','Machine Design','1006','186');
INSERT INTO job_profession VALUES('1187','机械制造工艺','Mechanical Manufacturing Technology','1006','187');
INSERT INTO job_profession VALUES('1188','机电一体化','Mechanical & Electrical Integration','1006','188');
INSERT INTO job_profession VALUES('1189','机床刀具','Machine and cutting Tools','1006','189');
INSERT INTO job_profession VALUES('1190','机械自动化','Machine Automation','1006','190');
INSERT INTO job_profession VALUES('1191','化工设备与机械','Chemical Equipment and Machinery','1006','191');
INSERT INTO job_profession VALUES('1192','冶金机械','Metallurgical Machinery','1006','192');
INSERT INTO job_profession VALUES('1193','冶金工程','Metallurgical Engineering','1006','193');
INSERT INTO job_profession VALUES('1194','模具设计与制造','Mold Design and Manufacturing','1006','194');
INSERT INTO job_profession VALUES('1195','铸造','Foundry','1006','195');
INSERT INTO job_profession VALUES('1196','锅炉','Boiler','1006','196');
INSERT INTO job_profession VALUES('1197','焊接工艺及设备','Welding Technology and Equipment','1006','197');
INSERT INTO job_profession VALUES('1198','液压传动','Hydraulic Transmission','1006','198');
INSERT INTO job_profession VALUES('1199','热处理机械','Heat Treatment Machinery','1006','199');
INSERT INTO job_profession VALUES('1200','纺织机械设备','Textile Machinery','1006','200');
INSERT INTO job_profession VALUES('1201','内燃机','Internal Combustion Engine','1006','201');
INSERT INTO job_profession VALUES('1202','汽车制造','Automotive Manufacturing','1006','202');
INSERT INTO job_profession VALUES('1203','船舶与海洋工程','Naval Architecture and Ocean Engineering','1006','203');
INSERT INTO job_profession VALUES('1204','机械其它','Others','1006','204');
INSERT INTO job_profession VALUES('1205','化学工程与工艺','Chemical Engineering and Technology','1007','205');
INSERT INTO job_profession VALUES('1206','制药工程   ','Pharmaceutical Engineering','1007','206');
INSERT INTO job_profession VALUES('1207','无机化工','Inorganic Chemical Engineering','1007','207');
INSERT INTO job_profession VALUES('1208','有机化工','Organic Chemical Engineering','1007','208');
INSERT INTO job_profession VALUES('1209','电化工','Electric Chemical Engineering','1007','209');
INSERT INTO job_profession VALUES('1210','精细化工','Superfine Chemical Engineering','1007','210');
INSERT INTO job_profession VALUES('1211','生物化工','Biological Chemical Engineering','1007','211');
INSERT INTO job_profession VALUES('1212','日用化工','Daily Chemical Engineering','1007','212');
INSERT INTO job_profession VALUES('1213','分离反应工程','Separation Reaction Engineering','1007','213');
INSERT INTO job_profession VALUES('1214','石油煤化化工','Petroleum Coalification Chemical Engineering','1007','214');
INSERT INTO job_profession VALUES('1215','高分子','Macromolecular','1007','215');
INSERT INTO job_profession VALUES('1216','化学分析','Chemical Analysis','1007','216');
INSERT INTO job_profession VALUES('1217','硅酸盐工程','Silicate Engineering','1007','217');
INSERT INTO job_profession VALUES('1218','油脂','Grease','1007','218');
INSERT INTO job_profession VALUES('1219','化工其它','Others','1007','219');
INSERT INTO job_profession VALUES('1220','轻化工程','Light Chemical Engineering','1008','220');
INSERT INTO job_profession VALUES('1221','纺织工程','Textile Engineering','1008','221');
INSERT INTO job_profession VALUES('1222','纺织材料','Textile Material','1008','222');
INSERT INTO job_profession VALUES('1223','纺织技术','Textile Technology','1008','223');
INSERT INTO job_profession VALUES('1224','纤维制造 ','Fabrics Manufacturing','1008','224');
INSERT INTO job_profession VALUES('1225','染整技术','Dyeing and Finishing Technology','1008','225');
INSERT INTO job_profession VALUES('1226','服装设计与工程','Clothing Design and Engineering','1008','226');
INSERT INTO job_profession VALUES('1227','纺织其它','Textile Others','1008','227');
INSERT INTO job_profession VALUES('1228','皮革技术','Leather Technology','1008','228');
INSERT INTO job_profession VALUES('1229','印刷工程','Printing Engineering','1008','229');
INSERT INTO job_profession VALUES('1230','包装工程','Packaging Engineering','1008','230');
INSERT INTO job_profession VALUES('1231','造纸工程','Paper Engineering','1008','231');
INSERT INTO job_profession VALUES('1232','钢铁冶炼 ','Ferrous Metallurgy','1009','232');
INSERT INTO job_profession VALUES('1233','金属压力加工技术','Metal Mechanical Treatment Technology','1009','233');
INSERT INTO job_profession VALUES('1234','冶金热能技术','Metallurgy Thermal Energy Technology','1009','234');
INSERT INTO job_profession VALUES('1235','碳素材料技术','Carbon Material Technology','1009','235');
INSERT INTO job_profession VALUES('1236','粉末冶金','Powder Metallurgy','1009','236');
INSERT INTO job_profession VALUES('1237','有色金属冶炼','Mon-ferrous Metals Metallurgy','1009','237');
INSERT INTO job_profession VALUES('1238','机械制造与控制','Machinery Manufacture and Control','1009','238');
INSERT INTO job_profession VALUES('1239','汽车制造与维修','Automobile Manufacture and Maintenance','1009','239');
INSERT INTO job_profession VALUES('1240','机械加工技术','Mechanical Working Technology','1009','240');
INSERT INTO job_profession VALUES('1241','机电设备安装与维修','Electromechanical Equipment Installation and Maint','1009','241');
INSERT INTO job_profession VALUES('1242','数控技术应用','Numerical Control Technology and Application','1009','242');
INSERT INTO job_profession VALUES('1243','模具设计与制造','Mould Design and Manufacture','1009','243');
INSERT INTO job_profession VALUES('1244','机电技术应用','Electromechanical Technology and Application','1009','244');
INSERT INTO job_profession VALUES('1245','制冷和空调设备运用与维修','Refrigeration and Air-conditioning Equipment Appli','1009','245');
INSERT INTO job_profession VALUES('1246','电气运行与控制','Electronic Operation and Control','1009','246');
INSERT INTO job_profession VALUES('1247','电气技术与应用','Electronic Technology and Application','1009','247');
INSERT INTO job_profession VALUES('1248','电机与电器','Electronic Machinery and Equipment','1009','248');
INSERT INTO job_profession VALUES('1249','船体建造与修理','Ship Manufacture and Maintenance','1009','249');
INSERT INTO job_profession VALUES('1250','船舶机械装置','Ship Mechanism','1009','250');
INSERT INTO job_profession VALUES('1251','船舶电气技术','Ship Electric Technology','1009','251');
INSERT INTO job_profession VALUES('1252','金属热加工','Metal Hot-working','1009','252');
INSERT INTO job_profession VALUES('1253','焊接','Welding','1009','253');
INSERT INTO job_profession VALUES('1254','金属表面处理','Metal Surface Treatment','1009','254');
INSERT INTO job_profession VALUES('1255','水工金属结构制作与安装','Manufacture and Installation of Hydraulic Metal-St','1009','255');
INSERT INTO job_profession VALUES('1256','仪器仪表','Equipment and Instrument','1009','256');
INSERT INTO job_profession VALUES('1257','光电仪器制造与维护','Photoelectric Instrument Manufacture and Maintenan','1009','257');
INSERT INTO job_profession VALUES('1258','飞行器制造工艺','Flight Vehicle Manufacturing Technology','1009','258');
INSERT INTO job_profession VALUES('1259','飞行器控制设备与仪表','Flight Vehicle Control Equipment and Instrument','1009','259');
INSERT INTO job_profession VALUES('1260','飞行器非金属材料成型','Flight Vehicle Non-Metal Material Molding','1009','260');
INSERT INTO job_profession VALUES('1261','电子电器应用与维修','Electronic Equipment Application and Maintenance','1009','261');
INSERT INTO job_profession VALUES('1262','电子材料与元器件','Electronic Material and Components','1009','262');
INSERT INTO job_profession VALUES('1263','微电子技术与器件','Microelectronics Technology and Devices','1009','263');
INSERT INTO job_profession VALUES('1264','化学工艺','Chemical Technology','1009','264');
INSERT INTO job_profession VALUES('1265','工业分析与检验','Industrial Analysis and Inspection','1009','265');
INSERT INTO job_profession VALUES('1266','石油炼制','Petroleum Processing','1009','266');
INSERT INTO job_profession VALUES('1267','石油与天然气贮运 ','Oil & Gas Storage and Transportation','1009','267');
INSERT INTO job_profession VALUES('1268','化工过程装备技术','Chemical Process Equipment Technology','1009','268');
INSERT INTO job_profession VALUES('1269','化工过程监测与控制','Chemical Process Monitoring and Control','1009','269');
INSERT INTO job_profession VALUES('1270','精细化工工艺','Superfine Chemical Engineering','1009','270');
INSERT INTO job_profession VALUES('1271','生物化工','Biochemical Engineering','1009','271');
INSERT INTO job_profession VALUES('1272','林产化工','Chemical Processing of Forest Products','1009','272');
INSERT INTO job_profession VALUES('1273','高分子材料加工工艺','Macromolecular Material Processing Technology','1009','273');
INSERT INTO job_profession VALUES('1274','核技术应用','Nuclear Technology and Application','1009','274');
INSERT INTO job_profession VALUES('1275','核化学化工','Nuclear Chemical Engineering','1009','275');
INSERT INTO job_profession VALUES('1276','炸药技术','Explosive Technology','1009','276');
INSERT INTO job_profession VALUES('1277','食品生物工艺','Food Biological Technology','1009','277');
INSERT INTO job_profession VALUES('1278','粮油饲料加工与储检','Grain & Oil & Feed Processing and Storage & Inspec','1009','278');
INSERT INTO job_profession VALUES('1279','皮革工艺及制品','Leather Technology and Manufacture','1009','279');
INSERT INTO job_profession VALUES('1280','印刷技术','Printing Technology','1009','280');
INSERT INTO job_profession VALUES('1281','制浆造纸工艺','Pulp & Paper Technology','1009','281');
INSERT INTO job_profession VALUES('1282','塑料成型','Plastic Molding','1009','282');
INSERT INTO job_profession VALUES('1283','橡胶工艺','Rubber Technology','1009','283');
INSERT INTO job_profession VALUES('1284','假肢与矫形器制造','Artificial Limb & Orthotics Manufacture','1009','284');
INSERT INTO job_profession VALUES('1285','染整技术','Dyeing and Finishing Technology','1009','285');
INSERT INTO job_profession VALUES('1286','纺织技术','Textile Technology','1009','286');
INSERT INTO job_profession VALUES('1287','化学纤维工艺','Chemical Fiber Technology','1009','287');
INSERT INTO job_profession VALUES('1288','丝绸工艺','Silk Technology','1009','288');
INSERT INTO job_profession VALUES('1289','针织工艺','Knitting Technology','1009','289');
INSERT INTO job_profession VALUES('1290','纺织复合材料工艺','Textile Composite Materials Technology','1009','290');
INSERT INTO job_profession VALUES('1291','服装制作与营销','Clothing Manufacture and Sales','1009','291');
INSERT INTO job_profession VALUES('1292','建筑与工程材料','Architecture and Engineering Material','1009','292');
INSERT INTO job_profession VALUES('1293','硅酸盐工艺及工业控制','Silicate Technology and Industrial Control','1009','293');
INSERT INTO job_profession VALUES('1294','交通运输类','Traffic and Transportation','1009','294');
INSERT INTO job_profession VALUES('1295','铁道运输管理','Railway Transportation Management','1009','295');
INSERT INTO job_profession VALUES('1296','电力机车运用与检修','Electric Locomotive Application and Maintenance','1009','296');
INSERT INTO job_profession VALUES('1297','内燃机车运用与检修','Diesel Locomotive Application and Maintenance','1009','297');
INSERT INTO job_profession VALUES('1298','铁道车辆运用与检修','Railway cars Application and Maintenance','1009','298');
INSERT INTO job_profession VALUES('1299','船舶驾驶','Ship Handling','1009','299');
INSERT INTO job_profession VALUES('1300','轮机管理','Motorship Engine Management','1009','300');
INSERT INTO job_profession VALUES('1301','船舶水手与机工','Ship Sailor and Machinist','1009','301');
INSERT INTO job_profession VALUES('1302','外轮理货','Ocean Shipping Tally','1009','302');
INSERT INTO job_profession VALUES('1303','船舶检验','Ship Inspection','1009','303');
INSERT INTO job_profession VALUES('1304','工程潜水','Technical Diving','1009','304');
INSERT INTO job_profession VALUES('1305','民航运输','Civil Aviaton Transportation','1009','305');
INSERT INTO job_profession VALUES('1306','飞机及发动机维修','Aircraft and Engine Maintenance','1009','306');
INSERT INTO job_profession VALUES('1307','航空服务','Aviation Service','1009','307');
INSERT INTO job_profession VALUES('1308','航空油料管理','Aviation Oil Management','1009','308');
INSERT INTO job_profession VALUES('1309','汽车运用与维修','Automobile Application and Maintenance','1009','309');
INSERT INTO job_profession VALUES('1310','交通运输管理','Communication and Transportation Management','1009','310');
INSERT INTO job_profession VALUES('1311','高等级公路养护与管理','Highway Maintenance and Management','1009','311');
INSERT INTO job_profession VALUES('1312','测绘工程','Surveying & Mapping Engineering','1010','312');
INSERT INTO job_profession VALUES('1313','测量工程技术','Surveying Engineering Technology','1010','313');
INSERT INTO job_profession VALUES('1314','测量遥感技术','Surveying & Remote Sensing Technology','1010','314');
INSERT INTO job_profession VALUES('1315','航空摄影测量','Aerial Surveying','1010','315');
INSERT INTO job_profession VALUES('1316','海洋测绘','Marine Surveying','1010','316');
INSERT INTO job_profession VALUES('1317','测绘仪器','Surveying Instrument','1010','317');
INSERT INTO job_profession VALUES('1318','地图制图','Cartography','1010','318');
INSERT INTO job_profession VALUES('1319','地图制图与地理信息','Cartography and Geographic Information','1010','319');
INSERT INTO job_profession VALUES('1320','测绘其它','Others','1010','320');
INSERT INTO job_profession VALUES('1321','冶金工程','Metallurgical Engineering','1011','321');
INSERT INTO job_profession VALUES('1322','金属材料工程','Metallic Materials Engineering','1011','322');
INSERT INTO job_profession VALUES('1323','无机非金属材料工程','Inorganic Nonmetallic Materials Engineering','1011','323');
INSERT INTO job_profession VALUES('1324','高分子材料与工程','Macromolecular Materials and Engineering','1011','324');
INSERT INTO job_profession VALUES('1325','金属材料及热处理','Metal Material and Heat Treatment','1011','325');
INSERT INTO job_profession VALUES('1326','材料物理','Materials Physics','1011','326');
INSERT INTO job_profession VALUES('1327','材料化学','Materials Chemistry','1011','327');
INSERT INTO job_profession VALUES('1328','腐蚀与防护','Cankerous and Protection ','1011','328');
INSERT INTO job_profession VALUES('1329','复合材料','Composite Material','1011','329');
INSERT INTO job_profession VALUES('1330','材料其它','Others','1011','330');
INSERT INTO job_profession VALUES('1331','建筑学','Architecture','1012','331');
INSERT INTO job_profession VALUES('1332','城市规划','Urban Planning','1012','332');
INSERT INTO job_profession VALUES('1333','市政工程','Municipal Engineering','1012','333');
INSERT INTO job_profession VALUES('1334','市政工程施工','Municipal Engineering Construction','1012','334');
INSERT INTO job_profession VALUES('1335','城镇建设','Urban Construction','1012','335');
INSERT INTO job_profession VALUES('1336','土木工程','Civil Engineering','1012','336');
INSERT INTO job_profession VALUES('1337','建筑环境与设备工程','Building Environment and Equipment Engineering','1012','337');
INSERT INTO job_profession VALUES('1338','工程施工机械运用与维护','Construction Machinery Application and Maintenance','1012','338');
INSERT INTO job_profession VALUES('1339','建筑设备安装','Architectural Equipment Installation','1012','339');
INSERT INTO job_profession VALUES('1340','工程力学','Engineering Mechanics','1012','340');
INSERT INTO job_profession VALUES('1341','给水排水工程','Water Supply and Sewerage Engineering ','1012','341');
INSERT INTO job_profession VALUES('1342','水利水电工程','Water Conservancy and Hydropower Engineering','1012','342');
INSERT INTO job_profession VALUES('1343','水利水电工程技术','Water Conservancy and Hydropower Engineering','1012','343');
INSERT INTO job_profession VALUES('1344','水电工程建筑施工','Hydropower Engineering Construction','1012','344');
INSERT INTO job_profession VALUES('1345','农业水利技术','Agricultural Hydraulic Technology','1012','345');
INSERT INTO job_profession VALUES('1346','水文与水资源工程','Hydrology and Water Resources Engineering','1012','346');
INSERT INTO job_profession VALUES('1347','港口航道与海岸工程','Harbours, Water Channels and Coast Engineering','1012','347');
INSERT INTO job_profession VALUES('1348','港口与航道工程技术','Harbours and Water Channels Engineering Technology','1012','348');
INSERT INTO job_profession VALUES('1349','公路与桥梁','Highway and Bridge','1012','349');
INSERT INTO job_profession VALUES('1350','铁道施工与养护','Railway Construction and Maintenance','1012','350');
INSERT INTO job_profession VALUES('1351','工业与民用建筑','Industrial and Civil Buildings','1012','351');
INSERT INTO job_profession VALUES('1352','矿井建设','Mines Construction','1012','352');
INSERT INTO job_profession VALUES('1353','供热通风','Heat Supply and Ventilation','1012','353');
INSERT INTO job_profession VALUES('1354','供热通风与空调','Heat Supply & Ventilation and Air-conditioning','1012','354');
INSERT INTO job_profession VALUES('1355','建筑材料与制品','Building Materials and Products','1012','355');
INSERT INTO job_profession VALUES('1356','水泥制造','Cement Manufacture','1012','356');
INSERT INTO job_profession VALUES('1357','房地产','Real Estate','1012','357');
INSERT INTO job_profession VALUES('1358','装饰设计','Decorative Design','1012','358');
INSERT INTO job_profession VALUES('1359','建筑装饰','Architectural Decoration','1012','359');
INSERT INTO job_profession VALUES('1360','工程预决算','Budget and Final Account of Construction','1012','360');
INSERT INTO job_profession VALUES('1361','建筑工程设计','Architectural Engineering Design','1012','361');
INSERT INTO job_profession VALUES('1362','建筑电气设计','Building Electrical Design','1012','362');
INSERT INTO job_profession VALUES('1363','电气设备安装','Electric Equipment Installation','1012','363');
INSERT INTO job_profession VALUES('1364','测绘工程','Surveying & Mapping Engineering','1012','364');
INSERT INTO job_profession VALUES('1365','环境工程','Environmental Engineering','1012','365');
INSERT INTO job_profession VALUES('1366','管道工程','Pipeline Engineering','1012','366');
INSERT INTO job_profession VALUES('1367','隧道工程','Tunnel Engineering','1012','367');
INSERT INTO job_profession VALUES('1368','桥梁工程','Bridge Engineering','1012','368');
INSERT INTO job_profession VALUES('1369','园林设计','Landscape Design','1012','369');
INSERT INTO job_profession VALUES('1370','建筑经济管理','Architectural Economy Management','1012','370');
INSERT INTO job_profession VALUES('1371','古建筑营造与修缮','Ancient Architecture Building and Repair','1012','371');
INSERT INTO job_profession VALUES('1372','土建工程与材料质量检测','Civil Engineering and Material Inspection','1012','372');
INSERT INTO job_profession VALUES('1373','建筑其他','Others','1012','373');
INSERT INTO job_profession VALUES('1374','交通运输','Traffic and Transportation','1013','374');
INSERT INTO job_profession VALUES('1375','交通工程','Traffic Engineering','1013','375');
INSERT INTO job_profession VALUES('1376','油气储运工程','Petroleum and Gas Storage and Transportation Engin','1013','376');
INSERT INTO job_profession VALUES('1377','飞行技术','Aviation Technology','1013','377');
INSERT INTO job_profession VALUES('1378','航海技术','Navigation Technology','1013','378');
INSERT INTO job_profession VALUES('1379','轮机工程','Marine Engineering','1013','379');
INSERT INTO job_profession VALUES('1380','道路工程','Highway Engineering','1013','380');
INSERT INTO job_profession VALUES('1381','铁路运输','Railway Transportation','1013','381');
INSERT INTO job_profession VALUES('1382','航空运输','Air Transportation','1013','382');
INSERT INTO job_profession VALUES('1383','水路运输','Waterway Transportation','1013','383');
INSERT INTO job_profession VALUES('1384','公路运输','Highway Transportation','1013','384');
INSERT INTO job_profession VALUES('1385','桥梁工程','Bridge Engineering','1013','385');
INSERT INTO job_profession VALUES('1386','船舶与海洋工程','Naval Architecture and Ocean Engineering','1013','386');
INSERT INTO job_profession VALUES('1387','运输其它','Others','1013','387');
INSERT INTO job_profession VALUES('1388','水利水电工程','Water Conservancy and Hydropower Engineering','1014','388');
INSERT INTO job_profession VALUES('1389','水文与水资源工程','Hydrology and Water Resources Engineering','1014','389');
INSERT INTO job_profession VALUES('1390','港口航道与海岸工程','Harbours, Water Channels and Coast Engineering','1014','390');
INSERT INTO job_profession VALUES('1391','储能','Energy Storage','1014','391');
INSERT INTO job_profession VALUES('1392','节能','Energy Saving','1014','392');
INSERT INTO job_profession VALUES('1393','核能','Nuclear Energy','1014','393');
INSERT INTO job_profession VALUES('1394','水利施工','Water Conservancy Construction','1014','394');
INSERT INTO job_profession VALUES('1395','石油开采','Petroleum Exploitation','1014','395');
INSERT INTO job_profession VALUES('1396','铀矿开采','Uranium Ore Exploitation','1014','396');
INSERT INTO job_profession VALUES('1397','选煤','Coal Preparation','1014','397');
INSERT INTO job_profession VALUES('1398','电厂热力设备运行','Thermodynamics Equipment Operation of Power Plant','1014','398');
INSERT INTO job_profession VALUES('1399','水电厂机电设备运行','Electromechanical Equipment Operation of Hydropowe','1014','399');
INSERT INTO job_profession VALUES('1400','电厂热工仪表及自动装置','Heat Engineering Instrument and Automation Equipme','1014','400');
INSERT INTO job_profession VALUES('1401','电厂水处理及化学监督','Water Treatment and Chemical Supervision of Power ','1014','401');
INSERT INTO job_profession VALUES('1402','电厂热力设备安装与检测','Thermodynamics Equipment Installation and Inspecti','1014','402');
INSERT INTO job_profession VALUES('1403','水电厂动力设备安装与维护','Power Equipment Installation and Maintenance of Hy','1014','403');
INSERT INTO job_profession VALUES('1404','电厂及变电站电气运行','Electrical Operation of Electric Plant and Substat','1014','404');
INSERT INTO job_profession VALUES('1405','继电保护及自动装置维护','Relay Protection and Automation Equipment Maintena','1014','405');
INSERT INTO job_profession VALUES('1406','电厂及变电站电所设备','Electric Plant and Substation Equipment','1014','406');
INSERT INTO job_profession VALUES('1407','水电站与水泵站电力设备','Electrical Equipment of Hydropower Station and Pum','1014','407');
INSERT INTO job_profession VALUES('1408','输配电线路施工、检修','Electric line Construction and Maintenance','1014','408');
INSERT INTO job_profession VALUES('1409','电力电缆运行与施工','Electric Power Cable Operation and Construction','1014','409');
INSERT INTO job_profession VALUES('1410','供用电技术','Electricity Supply and Applied Technology','1014','410');
INSERT INTO job_profession VALUES('1411','电气化铁道供电','Electrified Railway Power Supply','1014','411');
INSERT INTO job_profession VALUES('1412','农村能源开发与利用','Rural Energy Development and Utilization','1014','412');
INSERT INTO job_profession VALUES('1413','电力营销','Electric Power Marketing','1014','413');
INSERT INTO job_profession VALUES('1414','电气设备安装','Electric Equipment Installation','1014','414');
INSERT INTO job_profession VALUES('1415','供热通风与空调','Heat Supply & Ventilation and Air-conditioning','1014','415');
INSERT INTO job_profession VALUES('1416','水利水电工程技术','Water Conservancy and Hydropower Engineering Techn','1014','416');
INSERT INTO job_profession VALUES('1417','农业水利技术','Agricultural Water Conservancy Technology','1014','417');
INSERT INTO job_profession VALUES('1418','水电工程建筑施工','Hydropower Engineering Construction','1014','418');
INSERT INTO job_profession VALUES('1419','海洋工程','Ocean Engineering','1014','419');
INSERT INTO job_profession VALUES('1420','能源其他','Others','1014','420');
INSERT INTO job_profession VALUES('1421','生物','Biology','1015','421');
INSERT INTO job_profession VALUES('1422','植物','Botany','1015','422');
INSERT INTO job_profession VALUES('1423','生物技术','Biological Technology','1015','423');
INSERT INTO job_profession VALUES('1424','生物工程','Biotechnology','1015','424');
INSERT INTO job_profession VALUES('1425','生物遗传','Biological Heritage','1015','425');
INSERT INTO job_profession VALUES('1426','生物医学工程','Biomedical Engineering','1015','426');
INSERT INTO job_profession VALUES('1427','生物其他','Others','1015','427');
INSERT INTO job_profession VALUES('1428','基础医学','Basic Medical Sciences','1016','428');
INSERT INTO job_profession VALUES('1429','预防医学','Public Health','1016','429');
INSERT INTO job_profession VALUES('1430','临床医学','Clinical Medicine','1016','430');
INSERT INTO job_profession VALUES('1431','麻醉学','Anesthesiology','1016','431');
INSERT INTO job_profession VALUES('1432','医学影像学','Medical Imaging','1016','432');
INSERT INTO job_profession VALUES('1433','医学影像技术','Medical Imaging Technology','1016','433');
INSERT INTO job_profession VALUES('1434','医学检验','Medical Laboratory Tests and Analyses','1016','434');
INSERT INTO job_profession VALUES('1435','医学检验技术','Medical Laboratory Tests and Analyses Technology','1016','435');
INSERT INTO job_profession VALUES('1436','口腔医学','Stomatology ','1016','436');
INSERT INTO job_profession VALUES('1437','口腔工艺技术','Stomatology Technology','1016','437');
INSERT INTO job_profession VALUES('1438','中医学','Chinese Medicine','1016','438');
INSERT INTO job_profession VALUES('1439','中医骨伤','Chinese Medical Traumatology & Orthopedics','1016','439');
INSERT INTO job_profession VALUES('1440','中医护理','Chinese Medical Nursing','1016','440');
INSERT INTO job_profession VALUES('1441','西医学','Western Medicine','1016','441');
INSERT INTO job_profession VALUES('1442','针炙推拿学','Acupuncture Moxibustion and Massage','1016','442');
INSERT INTO job_profession VALUES('1443','蒙医学','Mongolian Medicine','1016','443');
INSERT INTO job_profession VALUES('1444','蒙医医疗与蒙药','Mongolian Medical Service and Medicine','1016','444');
INSERT INTO job_profession VALUES('1445','维医医疗','Uygur Medical Service','1016','445');
INSERT INTO job_profession VALUES('1446','藏医学','Tibetan Medicine','1016','446');
INSERT INTO job_profession VALUES('1447','藏药医疗','Tibetan Medical Service','1016','447');
INSERT INTO job_profession VALUES('1448','法医学','Medical Jurisprudence','1016','448');
INSERT INTO job_profession VALUES('1449','护理学','Nursing','1016','449');
INSERT INTO job_profession VALUES('1450','护理','Nursing','1016','450');
INSERT INTO job_profession VALUES('1451','助产','Midwifery','1016','451');
INSERT INTO job_profession VALUES('1452','药学','Pharmacy','1016','452');
INSERT INTO job_profession VALUES('1453','药剂','Pharmaceutical Preparations','1016','453');
INSERT INTO job_profession VALUES('1454','中药学','Traditional Chinese Pharmacy','1016','454');
INSERT INTO job_profession VALUES('1455','中药制药','Chinese Pharmaceutical Science','1016','455');
INSERT INTO job_profession VALUES('1456','中药康复保健','Chinese Medical Rehabilitation and Health','1016','456');
INSERT INTO job_profession VALUES('1457','西药学','Western Pharmacy','1016','457');
INSERT INTO job_profession VALUES('1458','特种医学','Special Medicine','1016','458');
INSERT INTO job_profession VALUES('1459','药物制剂','Pharmaceutical Preparations','1016','459');
INSERT INTO job_profession VALUES('1460','制药工程','Pharmaceutical Engineering','1016','460');
INSERT INTO job_profession VALUES('1461','生物医药工程','Biological Medicine Engineering','1016','461');
INSERT INTO job_profession VALUES('1462','医学生物技术','Biomedical Engineering','1016','462');
INSERT INTO job_profession VALUES('1463','检疫','Quarantine','1016','463');
INSERT INTO job_profession VALUES('1464','放射','Radiology','1016','464');
INSERT INTO job_profession VALUES('1465','卫生保健','Health Care','1016','465');
INSERT INTO job_profession VALUES('1466','计划生育技术','Family Planning Technology','1016','466');
INSERT INTO job_profession VALUES('1467','人口与计划生育管理','Population and Family Planning Management','1016','467');
INSERT INTO job_profession VALUES('1468','卫生信息管理','Health Information Management','1016','468');
INSERT INTO job_profession VALUES('1469','眼视光技术','Eye Technology','1016','469');
INSERT INTO job_profession VALUES('1470','康复技术','Rehabilitation Technology','1016','470');
INSERT INTO job_profession VALUES('1471','医药学其他','Others','1016','471');
INSERT INTO job_profession VALUES('1472','采矿工程','Mining Engineering','1017','472');
INSERT INTO job_profession VALUES('1473','采矿技术','Mining Technology','1017','473');
INSERT INTO job_profession VALUES('1474','石油工程','Petroleum Engineering','1017','474');
INSERT INTO job_profession VALUES('1475','矿物加工工程','Minerals Processing Engineering','1017','475');
INSERT INTO job_profession VALUES('1476','勘查技术与工程','Prospecting Techniques and Engineering','1017','476');
INSERT INTO job_profession VALUES('1477','资源勘查工程','Natural Resources Prospecting Engineering','1017','477');
INSERT INTO job_profession VALUES('1478','国土资源调查','Land and Resources Investigation','1017','478');
INSERT INTO job_profession VALUES('1479','地质','Geology','1017','479');
INSERT INTO job_profession VALUES('1480','地质调查与找矿','Geological Survey and Prospecting','1017','480');
INSERT INTO job_profession VALUES('1481','矿山机械运行与维修','Mining Equipment Operation and Maintenance','1017','481');
INSERT INTO job_profession VALUES('1482','矿井通风与安全','Mine Ventilation and Safety','1017','482');
INSERT INTO job_profession VALUES('1483','勘探','Geological Prospecting','1017','483');
INSERT INTO job_profession VALUES('1484','放射性矿产普查与勘探','Radioactive Minerals Prospecting','1017','484');
INSERT INTO job_profession VALUES('1485','水文地质与工程地质勘探','Prospecting of Hydrogeology and Engineering Geolog','1017','485');
INSERT INTO job_profession VALUES('1486','勘探与掘进','Prospecting and Tunneling','1017','486');
INSERT INTO job_profession VALUES('1487','地球物理与地球化学探测','Detection of Geophysics and Geochemistry','1017','487');
INSERT INTO job_profession VALUES('1488','岩土工程','Geotechnical Engineering','1017','488');
INSERT INTO job_profession VALUES('1489','岩土工程技术','Geotechnical Engineering Technology','1017','489');
INSERT INTO job_profession VALUES('1490','冶金工程','Metallurgical Engineering','1017','490');
INSERT INTO job_profession VALUES('1491','珠宝及工艺','Jewellery Technology','1017','491');
INSERT INTO job_profession VALUES('1492','地震监测技术','Seismic monitoring Technology','1017','492');
INSERT INTO job_profession VALUES('1493','宝玉石鉴定与加工','Gemological Qualification and Processing','1017','493');
INSERT INTO job_profession VALUES('1494','地质其他','Others about Geology','1017','494');
INSERT INTO job_profession VALUES('1495','矿山冶金其他','Others about Metallurgy','1017','495');
INSERT INTO job_profession VALUES('1496','环境科学','Environmental Science','1018','496');
INSERT INTO job_profession VALUES('1497','环境工程','Environmental Engineering','1018','497');
INSERT INTO job_profession VALUES('1498','环境监理','Environmental Supervision','1018','498');
INSERT INTO job_profession VALUES('1499','安全工程','Safety Engineering','1018','499');
INSERT INTO job_profession VALUES('1500','环境监测','Environmental Monitoring','1018','500');
INSERT INTO job_profession VALUES('1501','环境保护与监测','Environmental Protection and Monitoring','1018','501');
INSERT INTO job_profession VALUES('1502','环境治理技术','Environment Improvement Technology','1018','502');
INSERT INTO job_profession VALUES('1503','辐射测量与防护','Radiation Measurement and Protection','1018','503');
INSERT INTO job_profession VALUES('1504','生态学','Ecology','1018','504');
INSERT INTO job_profession VALUES('1505','生态环境保护','Ecological Environment Protection','1018','505');
INSERT INTO job_profession VALUES('1506','水文与水资源','Hydrology and Water Resources','1018','506');
INSERT INTO job_profession VALUES('1507','水土保护与荒漠化防治','Soil and Water Conservation and Desertification Co','1018','507');
INSERT INTO job_profession VALUES('1508','水土保持生态环境','Soil and Water Conservation and Ecological Environ','1018','508');
INSERT INTO job_profession VALUES('1509','气象','Meteorology','1018','509');
INSERT INTO job_profession VALUES('1510','高空气象探测','Radiosonde-radiowind Ascents','1018','510');
INSERT INTO job_profession VALUES('1511','海洋观测','Ocean Observation','1018','511');
INSERT INTO job_profession VALUES('1512','环境保护其他','Others','1018','512');
INSERT INTO job_profession VALUES('1513','管理科学','Management Science','1019','513');
INSERT INTO job_profession VALUES('1514','信息管理与信息系统','Information Management & Information System','1019','514');
INSERT INTO job_profession VALUES('1515','工业工程','Industrial Engineering','1019','515');
INSERT INTO job_profession VALUES('1516','工程管理','Project Management','1019','516');
INSERT INTO job_profession VALUES('1517','工商管理','Business Administration','1019','517');
INSERT INTO job_profession VALUES('1518','市场营销','Marketing','1019','518');
INSERT INTO job_profession VALUES('1519','会计学','Accounting','1019','519');
INSERT INTO job_profession VALUES('1520','会计电算化','Accounting Computerization','1019','520');
INSERT INTO job_profession VALUES('1521','财务管理','Financial Management','1019','521');
INSERT INTO job_profession VALUES('1522','人力资源管理','Human Resource Management','1019','522');
INSERT INTO job_profession VALUES('1523','旅游管理','Tourism management','1019','523');
INSERT INTO job_profession VALUES('1524','行政管理','General Administration','1019','524');
INSERT INTO job_profession VALUES('1525','公共事业管理','Public Utilities Management','1019','525');
INSERT INTO job_profession VALUES('1526','劳动与社会保障','Labor and Social Security','1019','526');
INSERT INTO job_profession VALUES('1527','土地资源管理','Land Resources Management','1019','527');
INSERT INTO job_profession VALUES('1528','农业经济管理','Agricultural/forest economy management','1019','528');
INSERT INTO job_profession VALUES('1529','农村区域发展','Rural regional development','1019','529');
INSERT INTO job_profession VALUES('1530','图书馆学','Library Science','1019','530');
INSERT INTO job_profession VALUES('1531','档案学','Archive Science','1019','531');
INSERT INTO job_profession VALUES('1532','企业管理','Enterprise Management','1019','532');
INSERT INTO job_profession VALUES('1533','经济管理','Economic Management','1019','533');
INSERT INTO job_profession VALUES('1534','物资管理','Material Management','1019','534');
INSERT INTO job_profession VALUES('1535','行政管理','Administrative Management','1019','535');
INSERT INTO job_profession VALUES('1536','酒店管理','Hotel Management','1019','536');
INSERT INTO job_profession VALUES('1537','物业管理','Property Management','1019','537');
INSERT INTO job_profession VALUES('1538','企业策划','Business Planning','1019','538');
INSERT INTO job_profession VALUES('1539','管理其他','Others','1019','539');
INSERT INTO job_profession VALUES('1540','数学','Mathematics','1020','540');
INSERT INTO job_profession VALUES('1541','应用数学','Applied Mathematics','1020','541');
INSERT INTO job_profession VALUES('1542','数学与应用数学','Mathematics and Applied Mathematics','1020','542');
INSERT INTO job_profession VALUES('1543','信息与计算科学','Information and Computing Science','1020','543');
INSERT INTO job_profession VALUES('1544','物理学','Physics','1020','544');
INSERT INTO job_profession VALUES('1545','应用物理学','Applied Physics','1020','545');
INSERT INTO job_profession VALUES('1546','化学','Chemistry','1020','546');
INSERT INTO job_profession VALUES('1547','应用化学','Applied Chemistry','1020','547');
INSERT INTO job_profession VALUES('1548','生物科学','Biological Science','1020','548');
INSERT INTO job_profession VALUES('1549','微生物学','Microbiology','1020','549');
INSERT INTO job_profession VALUES('1550','细胞生物学','Cell Biology','1020','550');
INSERT INTO job_profession VALUES('1551','分子生物学','Molecular Biology','1020','551');
INSERT INTO job_profession VALUES('1552','生物化学','Biochemistry','1020','552');
INSERT INTO job_profession VALUES('1553','生物技术','Biotechnology','1020','553');
INSERT INTO job_profession VALUES('1554','天文学','Astronomy','1020','554');
INSERT INTO job_profession VALUES('1555','地质学','Geology','1020','555');
INSERT INTO job_profession VALUES('1556','地球化学','Geochemistry','1020','556');
INSERT INTO job_profession VALUES('1557','地理科学','Geography','1020','557');
INSERT INTO job_profession VALUES('1558','资源环境与城乡规划管理','Urban and Rural Planning & Resource management','1020','558');
INSERT INTO job_profession VALUES('1559','地理信息系统','Geographical Information System','1020','559');
INSERT INTO job_profession VALUES('1560','地球物理学','Geophysics','1020','560');
INSERT INTO job_profession VALUES('1561','大气科学','Atmospheric Science','1020','561');
INSERT INTO job_profession VALUES('1562','应用气象学','Applied Meteorology','1020','562');
INSERT INTO job_profession VALUES('1563','海洋科学','Marne Science','1020','563');
INSERT INTO job_profession VALUES('1564','海洋技术','Marine Technology','1020','564');
INSERT INTO job_profession VALUES('1565','理论与应用力学','Theoretical and Applied Mechanics','1020','565');
INSERT INTO job_profession VALUES('1566','电子信息科学与技术','Electronic and Information Science and Technology','1020','566');
INSERT INTO job_profession VALUES('1567','微电子学','Microelectronics','1020','567');
INSERT INTO job_profession VALUES('1568','光信息科学与技术','Optical Information Science and Technology','1020','568');
INSERT INTO job_profession VALUES('1569','材料物理','Material Physics','1020','569');
INSERT INTO job_profession VALUES('1570','材料化学','Material Chemistry','1020','570');
INSERT INTO job_profession VALUES('1571','环境科学','Environmental Science','1020','571');
INSERT INTO job_profession VALUES('1572','生态学','Ecology','1020','572');
INSERT INTO job_profession VALUES('1573','心理学','Psychology','1020','573');
INSERT INTO job_profession VALUES('1574','应用心理学','Applied Psychology','1020','574');
INSERT INTO job_profession VALUES('1575','统计学','Statistics','1020','575');
INSERT INTO job_profession VALUES('1576','力学','Mechanics','1020','576');
INSERT INTO job_profession VALUES('1577','信息学','Informatics','1020','577');
INSERT INTO job_profession VALUES('1578','机加工','Machine Working','1021','578');
INSERT INTO job_profession VALUES('1579','电器维修','Electric Appliance Repairing','1021','579');
INSERT INTO job_profession VALUES('1580','舞台灯光音响控制','Stage Lights and Acoustics Control','1021','580');
INSERT INTO job_profession VALUES('1581','锅炉工','Boiler Worker','1021','581');
INSERT INTO job_profession VALUES('1582','保安','Security Guard','1021','582');
INSERT INTO job_profession VALUES('1583','电焊工','Welding Worker','1021','583');
INSERT INTO job_profession VALUES('1584','司机及维修','Driving and Maintenance','1021','584');
INSERT INTO job_profession VALUES('1585','电工','Electrician','1021','585');
INSERT INTO job_profession VALUES('1586','美发美容','Hair & Beauty','1021','586');
INSERT INTO job_profession VALUES('1587','服务员','Waiter','1021','587');
INSERT INTO job_profession VALUES('1588','排版','Composition','1021','588');
INSERT INTO job_profession VALUES('1589','微机录入','Typist','1021','589');
INSERT INTO job_profession VALUES('1590','技工其他','Others','1021','590');
INSERT INTO job_profession VALUES('1591','经济学','Economics','1022','591');
INSERT INTO job_profession VALUES('1592','国际经济与贸易','International Economics & Trade','1022','592');
INSERT INTO job_profession VALUES('1593','财政学','Public Finance','1022','593');
INSERT INTO job_profession VALUES('1594','金融学','Finance and Banking','1022','594');
INSERT INTO job_profession VALUES('1595','国际经济','International Economics','1022','595');
INSERT INTO job_profession VALUES('1596','工业经济','Industry Economics','1022','596');
INSERT INTO job_profession VALUES('1597','商业经济','Business Economics','1022','597');
INSERT INTO job_profession VALUES('1598','保险学','Insurance','1022','598');
INSERT INTO job_profession VALUES('1599','工商会计','Business Accounting','1023','599');
INSERT INTO job_profession VALUES('1600','出纳','Cashier','1023','600');
INSERT INTO job_profession VALUES('1601','银行会计','Bank Accounting','1023','601');
INSERT INTO job_profession VALUES('1602','外贸会计','Foreign Trade Accounting','1023','602');
INSERT INTO job_profession VALUES('1603','会计电算化','Accounting Computerization','1023','603');
INSERT INTO job_profession VALUES('1604','审计学','Auditing','1024','604');
INSERT INTO job_profession VALUES('1605','统计学','Statistics','1024','605');
INSERT INTO job_profession VALUES('1606','财政管理','Finance Management','1025','606');
INSERT INTO job_profession VALUES('1607','税务管理','Taxation Management','1025','607');
INSERT INTO job_profession VALUES('1608','信贷','Credit','1026','608');
INSERT INTO job_profession VALUES('1609','投资','Investment','1026','609');
INSERT INTO job_profession VALUES('1610','金融','Finance','1026','610');
INSERT INTO job_profession VALUES('1611','财政金融','Finance and Banking','1026','611');
INSERT INTO job_profession VALUES('1612','国际金融','International Finance','1026','612');
INSERT INTO job_profession VALUES('1613','证券','Securities','1026','613');
INSERT INTO job_profession VALUES('1614','期货','Futures','1026','614');
INSERT INTO job_profession VALUES('1615','保险','Insurance','1026','615');
INSERT INTO job_profession VALUES('1616','财政事务','Public Finance Affairs','1027','616');
INSERT INTO job_profession VALUES('1617','会计','Accounting','1027','617');
INSERT INTO job_profession VALUES('1618','审计事务','Auditing Affairs','1027','618');
INSERT INTO job_profession VALUES('1619','金融事务','Finance Affairs','1027','619');
INSERT INTO job_profession VALUES('1620','税务事务','Taxation Affairs','1027','620');
INSERT INTO job_profession VALUES('1621','统计','Statistics','1027','621');
INSERT INTO job_profession VALUES('1622','统计调查与信息服务','Statistic Investigation and Information Service','1027','622');
INSERT INTO job_profession VALUES('1623','物价','Prices','1027','623');
INSERT INTO job_profession VALUES('1624','营销业务','Sales Business','1028','624');
INSERT INTO job_profession VALUES('1625','哲学','Philosophy','1029','625');
INSERT INTO job_profession VALUES('1626','马列哲学','Philosophy of Marxism & Leninism','1029','626');
INSERT INTO job_profession VALUES('1627','自然辨证法','Natural Dialectics','1029','627');
INSERT INTO job_profession VALUES('1628','东方哲学','Eastern Philosophy','1029','628');
INSERT INTO job_profession VALUES('1629','西方哲学','Western Philosophy','1029','629');
INSERT INTO job_profession VALUES('1630','现代哲学','Modern Philosophy','1029','630');
INSERT INTO job_profession VALUES('1631','逻辑学','Logic','1029','631');
INSERT INTO job_profession VALUES('1632','伦理学','Ethics','1029','632');
INSERT INTO job_profession VALUES('1633','美学','Aesthetics','1029','633');
INSERT INTO job_profession VALUES('1634','宗教学','Science of Religion','1029','634');
INSERT INTO job_profession VALUES('1635','心理学','Psychology','1030','635');
INSERT INTO job_profession VALUES('1636','应用心理学','Applied Psychology','1030','636');
INSERT INTO job_profession VALUES('1637','历史学','Historical','1031','637');
INSERT INTO job_profession VALUES('1638','世界历史','World History','1031','638');
INSERT INTO job_profession VALUES('1639','考古学','Archaeology','1031','639');
INSERT INTO job_profession VALUES('1640','博物馆学','Museology','1031','640');
INSERT INTO job_profession VALUES('1641','民族学','Ethnology','1031','641');
INSERT INTO job_profession VALUES('1642','中国历史','Chinese History','1031','642');
INSERT INTO job_profession VALUES('1643','历史考古其他','Others','1031','643');
INSERT INTO job_profession VALUES('1644','法学','Law','1032','644');
INSERT INTO job_profession VALUES('1645','科学社会主义与国际共产主义运动','Scientific Socialism & International Communist Mov','1032','645');
INSERT INTO job_profession VALUES('1646','中国革命史与中国共产党党史','History of the Chinese Revolution & History of the','1032','646');
INSERT INTO job_profession VALUES('1647','社会学','Sociology','1032','647');
INSERT INTO job_profession VALUES('1648','社会工作','Social Work','1032','648');
INSERT INTO job_profession VALUES('1649','政治学类','Political Sciences','1032','649');
INSERT INTO job_profession VALUES('1650','政治学与行政学','Political Science & Public Administration','1032','650');
INSERT INTO job_profession VALUES('1651','国际政治','International Politics','1032','651');
INSERT INTO job_profession VALUES('1652','外交学','Science of Diplomacy','1032','652');
INSERT INTO job_profession VALUES('1653','思想政治教育','Idea logical & Political Education','1032','653');
INSERT INTO job_profession VALUES('1654','治安学','Science of Public Order','1032','654');
INSERT INTO job_profession VALUES('1655','侦查学','Science of Criminal Investigation','1032','655');
INSERT INTO job_profession VALUES('1656','边防管理','Management of Frontier Order','1032','656');
INSERT INTO job_profession VALUES('1657','理论法学','Jurisprudence','1032','657');
INSERT INTO job_profession VALUES('1658','部门法学','Department Law','1032','658');
INSERT INTO job_profession VALUES('1659','国际法学','International law','1032','659');
INSERT INTO job_profession VALUES('1660','经济法','Economic Law','1032','660');
INSERT INTO job_profession VALUES('1661','法学其他','Others','1032','661');
INSERT INTO job_profession VALUES('1662','社会学','Sociology','1033','662');
INSERT INTO job_profession VALUES('1663','人口学','Demography','1033','663');
INSERT INTO job_profession VALUES('1664','民族学','Ethnology','1033','664');
INSERT INTO job_profession VALUES('1665','政治学','Political Science','1033','665');
INSERT INTO job_profession VALUES('1666','社会政治其他','Others','1033','666');
INSERT INTO job_profession VALUES('1667','音乐学','Musicology','1034','667');
INSERT INTO job_profession VALUES('1668','音乐','Music','1034','668');
INSERT INTO job_profession VALUES('1669','作曲与作曲技术理论','Composition and Theories of Composition','1034','669');
INSERT INTO job_profession VALUES('1670','音乐表演','Music Performance','1034','670');
INSERT INTO job_profession VALUES('1671','声乐','Vocal Music','1034','671');
INSERT INTO job_profession VALUES('1672','器乐','Instrumental Music','1034','672');
INSERT INTO job_profession VALUES('1673','绘画','Painting','1034','673');
INSERT INTO job_profession VALUES('1674','雕塑','Sculpture','1034','674');
INSERT INTO job_profession VALUES('1675','美术学','Research of Fine Arts','1034','675');
INSERT INTO job_profession VALUES('1676','工艺美术','Arts and Crafts','1034','676');
INSERT INTO job_profession VALUES('1677','美术绘画','Fine Arts and Painting','1034','677');
INSERT INTO job_profession VALUES('1678','美术设计','Aesthetic Design','1034','678');
INSERT INTO job_profession VALUES('1679','艺术设计学','Artistic Design Theories','1034','679');
INSERT INTO job_profession VALUES('1680','艺术设计','Artistic Designing','1034','680');
INSERT INTO job_profession VALUES('1681','舞蹈学','Dancology','1034','681');
INSERT INTO job_profession VALUES('1682','舞蹈编导','Choreography','1034','682');
INSERT INTO job_profession VALUES('1683','戏剧学','Dramaturgy','1034','683');
INSERT INTO job_profession VALUES('1684','表演','Acting','1034','684');
INSERT INTO job_profession VALUES('1685','舞蹈表演','Dance Performance','1034','685');
INSERT INTO job_profession VALUES('1686','戏曲表演','Opera Performance','1034','686');
INSERT INTO job_profession VALUES('1687','曲艺表演','Quyi Performance','1034','687');
INSERT INTO job_profession VALUES('1688','戏剧表演','Drama Performance','1034','688');
INSERT INTO job_profession VALUES('1689','杂技与魔术表演','Acrobatics & Magic Performance','1034','689');
INSERT INTO job_profession VALUES('1690','木偶与皮影表演及制作','Puppet & Shadow Puppet Performance and Manufacture','1034','690');
INSERT INTO job_profession VALUES('1691','导演','Directing','1034','691');
INSERT INTO job_profession VALUES('1692','戏剧影视文学','Literature of Theatre Film & Television','1034','692');
INSERT INTO job_profession VALUES('1693','戏剧影视美术设计','Artistic Design of Theatre Film & Television','1034','693');
INSERT INTO job_profession VALUES('1694','摄影','Photography','1034','694');
INSERT INTO job_profession VALUES('1695','录音艺术','Recording Arts','1034','695');
INSERT INTO job_profession VALUES('1696','动画','Science of Animated Cartoon','1034','696');
INSERT INTO job_profession VALUES('1697','播音与主持艺术','Techniques of Broadcasting & Anchoring','1034','697');
INSERT INTO job_profession VALUES('1698','广告影视节目制作','Programming of Film & Television Advertisement ','1034','698');
INSERT INTO job_profession VALUES('1699','播音与节目制作','Broadcasting and Programming','1034','699');
INSERT INTO job_profession VALUES('1700','影像与影视艺术','Imaging and Film & Television Arts','1034','700');
INSERT INTO job_profession VALUES('1701','广播电视编导','Radio & Television Editing & Directing','1034','701');
INSERT INTO job_profession VALUES('1702','模特','Model','1034','702');
INSERT INTO job_profession VALUES('1703','礼仪','Etiquette','1034','703');
INSERT INTO job_profession VALUES('1704','群众文化艺术','Folk Culture and Arts','1034','704');
INSERT INTO job_profession VALUES('1705','文化影视事业管理','Culture and Film & Television Management','1034','705');
INSERT INTO job_profession VALUES('1706','文物保护','Culture Relic Protection','1034','706');
INSERT INTO job_profession VALUES('1707','服装设计与工艺','Apparel Design and Engineering','1034','707');
INSERT INTO job_profession VALUES('1708','服装表演','Fashion Show','1034','708');
INSERT INTO job_profession VALUES('1709','民间传统工艺','Traditional Arts','1034','709');
INSERT INTO job_profession VALUES('1710','艺术其他','Others','1034','710');
INSERT INTO job_profession VALUES('1711','汉语言文学','Chinese Language & Literature','1035','711');
INSERT INTO job_profession VALUES('1712','汉语言','Chinese Language','1035','712');
INSERT INTO job_profession VALUES('1713','对外汉语','Chinese as a Second Language','1035','713');
INSERT INTO job_profession VALUES('1714','中国少数民族语言文学','Chinese Minority Language & Literatures','1035','714');
INSERT INTO job_profession VALUES('1715','古典文献 ','Chinese Classics And Classical Bibliography','1035','715');
INSERT INTO job_profession VALUES('1716','中国文学','Chinese Literature','1035','716');
INSERT INTO job_profession VALUES('1717','东方文学','Eastern Literature','1035','717');
INSERT INTO job_profession VALUES('1718','西方文学','Western Literature','1035','718');
INSERT INTO job_profession VALUES('1719','新闻学','Journalism','1035','719');
INSERT INTO job_profession VALUES('1720','广播电视新闻学','Radio & Television Science','1035','720');
INSERT INTO job_profession VALUES('1721','新闻采编','News Acquisition and Cataloguing','1035','721');
INSERT INTO job_profession VALUES('1722','新闻写作评论','News Composition and Commentary','1035','722');
INSERT INTO job_profession VALUES('1723','新闻摄影','News Photography','1035','723');
INSERT INTO job_profession VALUES('1724','广告学','Advertising','1035','724');
INSERT INTO job_profession VALUES('1725','编辑出版学','Editing & Publishing Science','1035','725');
INSERT INTO job_profession VALUES('1726','出版与发行','Publishing and Distribution','1035','726');
INSERT INTO job_profession VALUES('1727','图书资料','LiBrary Facilities','1035','727');
INSERT INTO job_profession VALUES('1728','科技情报','Technological Imformation','1035','728');
INSERT INTO job_profession VALUES('1729','档案','Archives','1035','729');
INSERT INTO job_profession VALUES('1730','博物馆','Museum','1035','730');
INSERT INTO job_profession VALUES('1731','中文其他','Others','1035','731');
INSERT INTO job_profession VALUES('1732','英语','English','1036','732');
INSERT INTO job_profession VALUES('1733','俄语','Russian','1036','733');
INSERT INTO job_profession VALUES('1734','德语','German','1036','734');
INSERT INTO job_profession VALUES('1735','法语','French','1036','735');
INSERT INTO job_profession VALUES('1736','西班牙语','Spanish','1036','736');
INSERT INTO job_profession VALUES('1737','阿拉伯语','Arabic','1036','737');
INSERT INTO job_profession VALUES('1738','日语','Japanese','1036','738');
INSERT INTO job_profession VALUES('1739','波斯语','Farsi','1036','739');
INSERT INTO job_profession VALUES('1740','朝鲜语','Korean','1036','740');
INSERT INTO job_profession VALUES('1741','菲律宾语','Tagalog','1036','741');
INSERT INTO job_profession VALUES('1742','梵语','Sanskrit','1036','742');
INSERT INTO job_profession VALUES('1743','巴利语','Pali','1036','743');
INSERT INTO job_profession VALUES('1744','印度尼西亚语','Indonesian','1036','744');
INSERT INTO job_profession VALUES('1745','印地语','Hindi','1036','745');
INSERT INTO job_profession VALUES('1746','柬埔寨语','Kampuchean','1036','746');
INSERT INTO job_profession VALUES('1747','老挝语','Lao','1036','747');
INSERT INTO job_profession VALUES('1748','缅甸语','Burmese','1036','748');
INSERT INTO job_profession VALUES('1749','马来语','Malay','1036','749');
INSERT INTO job_profession VALUES('1750','蒙古语','Mongolian','1036','750');
INSERT INTO job_profession VALUES('1751','僧加罗语','Singhalese','1036','751');
INSERT INTO job_profession VALUES('1752','泰语','Thai','1036','752');
INSERT INTO job_profession VALUES('1753','乌尔都语','Urdu','1036','753');
INSERT INTO job_profession VALUES('1754','希伯莱语','Rabbinic','1036','754');
INSERT INTO job_profession VALUES('1755','越南语','Vietnamese','1036','755');
INSERT INTO job_profession VALUES('1756','豪萨语','Chadic','1036','756');
INSERT INTO job_profession VALUES('1757','斯瓦希里语','Swahili','1036','757');
INSERT INTO job_profession VALUES('1758','阿尔巴尼亚语','Albanian','1036','758');
INSERT INTO job_profession VALUES('1759','保加利亚语','Bulgarian','1036','759');
INSERT INTO job_profession VALUES('1760','波兰语','Polish','1036','760');
INSERT INTO job_profession VALUES('1761','捷克语','Czech','1036','761');
INSERT INTO job_profession VALUES('1762','罗马尼亚语','Romanian','1036','762');
INSERT INTO job_profession VALUES('1763','葡萄牙语','Portuguese','1036','763');
INSERT INTO job_profession VALUES('1764','瑞典语','Swedish','1036','764');
INSERT INTO job_profession VALUES('1765','塞尔维亚-克罗地亚语','Serbo - Croatian','1036','765');
INSERT INTO job_profession VALUES('1766','土耳其语','Turkish','1036','766');
INSERT INTO job_profession VALUES('1767','希腊语','Greek','1036','767');
INSERT INTO job_profession VALUES('1768','匈牙利语','Mungarian','1036','768');
INSERT INTO job_profession VALUES('1769','意大利语','Italian','1036','769');
INSERT INTO job_profession VALUES('1770','外语其它','Others','1036','770');
INSERT INTO job_profession VALUES('1771','教育学','Education','1037','771');
INSERT INTO job_profession VALUES('1772','学前教育','Preschool Education','1037','772');
INSERT INTO job_profession VALUES('1773','特殊教育','Special Education','1037','773');
INSERT INTO job_profession VALUES('1774','教育技术学','Educational Technology','1037','774');
INSERT INTO job_profession VALUES('1775','体育教育','Physical Education','1037','775');
INSERT INTO job_profession VALUES('1776','运动训练','Sports Training','1037','776');
INSERT INTO job_profession VALUES('1777','社会体育','Social Sports','1037','777');
INSERT INTO job_profession VALUES('1778','运动人体科学','Human Kinesiology','1037','778');
INSERT INTO job_profession VALUES('1779','体育保障康复','Sports Support and Rehabilitation','1037','779');
INSERT INTO job_profession VALUES('1780','民族传统体育','Traditional Sports of Nationalities','1037','780');
INSERT INTO job_profession VALUES('1781','飞行器设计与工程','Flight Vehicle Design and Engineering','1038','781');
INSERT INTO job_profession VALUES('1782','飞行器动力工程','Flight Vehicle Propulsion Engineering','1038','782');
INSERT INTO job_profession VALUES('1783','飞行器制造工程','Flight Vehicle Manufacturing Engineering','1038','783');
INSERT INTO job_profession VALUES('1784','飞行器环境与生命保障工程','Flight Vehicle Environment and Life Support System','1038','784');
INSERT INTO job_profession VALUES('1785','飞行器结构设计','Flight Vehicle Structural Design','1038','785');
INSERT INTO job_profession VALUES('1786','飞行器材料','Flight Vehicle Materiacl','1038','786');
INSERT INTO job_profession VALUES('1787','飞行器导航设备','Flight Vehicle Navigation Instrument','1038','787');
INSERT INTO job_profession VALUES('1788','飞行器系统工程','Flight Vehicle System Engineering','1038','788');
INSERT INTO job_profession VALUES('1789','飞行器其他','Others','1038','789');
INSERT INTO job_profession VALUES('1790','刑事科学技术','Criminal Science and Technology','1039','790');
INSERT INTO job_profession VALUES('1791','治安学','Science of Public Order','1039','791');
INSERT INTO job_profession VALUES('1792','侦察学','Science of Criminal Investigation','1039','792');
INSERT INTO job_profession VALUES('1793','边防管理','Management of Frontier Order','1039','793');
INSERT INTO job_profession VALUES('1794','消防工程','Fire Prevention Engineering','1039','794');
INSERT INTO job_profession VALUES('1795','武器系统与发射工程','Weapon Systems and Launching Engineering','1039','795');
INSERT INTO job_profession VALUES('1796','探测制导与控制技术','Detection, guidance and Control Technology','1039','796');
INSERT INTO job_profession VALUES('1797','弹药工程与爆炸技术','Ammunition Engineering and Explosion technology','1039','797');
INSERT INTO job_profession VALUES('1798','特种能源工程与烟火技术','Special energy and Pyrotechnics','1039','798');
INSERT INTO job_profession VALUES('1799','地面武器机动工程','Ground Motor Weapon Engineering','1039','799');
INSERT INTO job_profession VALUES('1800','信息对抗技术','Information Countermeasure/Warfare Technology','1039','800');
INSERT INTO job_profession VALUES('1801','军事指挥','Science of Command','1039','801');
INSERT INTO job_profession VALUES('1802','商务经营','Commerce Management','1040','802');
INSERT INTO job_profession VALUES('1803','市场经营','Marketing','1040','803');
INSERT INTO job_profession VALUES('1804','电子商务','Electronic Commerce','1040','804');
INSERT INTO job_profession VALUES('1805','国际商务','International Commerce','1040','805');
INSERT INTO job_profession VALUES('1806','商务英语','Commerce English','1040','806');
INSERT INTO job_profession VALUES('1807','纺织品检测与贸易','Textile Inspection and Trade','1040','807');
INSERT INTO job_profession VALUES('1808','物资经营与管理','Materials Management','1040','808');
INSERT INTO job_profession VALUES('1809','烟草专场管理','Tobacco Management','1040','809');
INSERT INTO job_profession VALUES('1810','商品储运与配送','Commodity Storage and Distribution','1040','810');
INSERT INTO job_profession VALUES('1811','房地产经营与管理','Real Estate Management','1040','811');
INSERT INTO job_profession VALUES('1812','烹饪','Cuisine','1040','812');
INSERT INTO job_profession VALUES('1813','美容美发与形象设计','Beauty and Image Design','1040','813');
INSERT INTO job_profession VALUES('1814','首饰加工与经营','Jewelry Processing and Management','1040','814');
INSERT INTO job_profession VALUES('1815','钟表眼镜配制与修理','Clock & Watch and Glasses Fitting and Repair','1040','815');
INSERT INTO job_profession VALUES('1816','饭店服务与管理','Restaurant Service and Management','1040','816');
INSERT INTO job_profession VALUES('1817','旅游服务与管理','Tourist Service and Management','1040','817');
INSERT INTO job_profession VALUES('1818','休闲体育服务与管理','Leisure Sports Service and Management','1040','818');
INSERT INTO job_profession VALUES('1819','体育设施经营','Sports Facilities Business','1040','819');
INSERT INTO job_profession VALUES('1820','法律事务','Law Affairs','1041','820');
INSERT INTO job_profession VALUES('1821','公安保卫','Public Security','1041','821');
INSERT INTO job_profession VALUES('1822','治安管理','Security Management','1041','822');
INSERT INTO job_profession VALUES('1823','侦察','Criminal Investigation','1041','823');
INSERT INTO job_profession VALUES('1824','监狱管理','Prison Management','1041','824');
INSERT INTO job_profession VALUES('1825','劳教管理','Reforming Education Management','1041','825');
INSERT INTO job_profession VALUES('1826','保安','Security Guard','1041','826');
INSERT INTO job_profession VALUES('1827','道路交通管理','Highway Traffic Management','1041','827');
INSERT INTO job_profession VALUES('1828','工商行政管理事务','Industry and Commerce Administration','1041','828');
INSERT INTO job_profession VALUES('1829','人力资源管理事务','Human Resource Management','1041','829');
INSERT INTO job_profession VALUES('1830','社会保障事务','Social Security','1041','830');
INSERT INTO job_profession VALUES('1831','民政服务与管理','Civil Service and Management','1041','831');
INSERT INTO job_profession VALUES('1832','社会福利事业管理','Social Welfare Programs Management','1041','832');
INSERT INTO job_profession VALUES('1833','计量与测试技术','Measurement and Test Technology','1041','833');
INSERT INTO job_profession VALUES('1834','产品质量监督检测','Products Quality Supervision and Inspection','1041','834');
INSERT INTO job_profession VALUES('1835','标准化及质量监督','Standardization and Quality Supervision','1041','835');
INSERT INTO job_profession VALUES('1836','文秘','Secretary','1041','836');
INSERT INTO job_profession VALUES('1837','公关礼仪','Public Relations Etiquette','1041','837');
INSERT INTO job_profession VALUES('1838','物业管理','Property Management','1041','838');
INSERT INTO job_profession VALUES('1839','家政与社区服务','Housekeeping and Community Service','1041','839');
INSERT INTO job_profession VALUES('1840','老年人服务与管理','Service and Management for Old People','1041','840');
INSERT INTO job_profession VALUES('1841','现代殡仪技术与管理','Modern Funeral Technology and Management','1041','841');
INSERT INTO job_profession VALUES('1842','其他','Others','1041','842');
INSERT INTO job_profession VALUES('1843','公共关系','Public Relations','1042','843');
INSERT INTO job_profession VALUES('1844','文秘','Secretary','1042','844');
INSERT INTO job_profession VALUES('1845','导游','Tourist Guide','1042','845');
INSERT INTO job_profession VALUES('1847','修理类','xiulilei','0','847');
INSERT INTO job_profession VALUES('1848','汽车修理','Qcxl','1847','848');
INSERT INTO job_profession VALUES('1849','电脑维修','Dnwx','1847','849');
INSERT INTO job_profession VALUES('1850','其它','Qt','1847','850');

INSERT INTO job_provinceandcity VALUES('1000','北京','Beijing','0','0');
INSERT INTO job_provinceandcity VALUES('1001','上海','Shanghai','0','1');
INSERT INTO job_provinceandcity VALUES('1002','天津','Tianjin','0','2');
INSERT INTO job_provinceandcity VALUES('1003','重庆','Chongqing','0','3');
INSERT INTO job_provinceandcity VALUES('1004','浙江省','Zhejiang','0','4');
INSERT INTO job_provinceandcity VALUES('1005','广东省','Guangdong','0','5');
INSERT INTO job_provinceandcity VALUES('1006','江苏省','Jiangsu','0','6');
INSERT INTO job_provinceandcity VALUES('1007','河北省','Hebei','0','7');
INSERT INTO job_provinceandcity VALUES('1008','山西省','Shanxi','0','8');
INSERT INTO job_provinceandcity VALUES('1009','四川省','Sichuan','0','9');
INSERT INTO job_provinceandcity VALUES('1010','河南省','Henan','0','10');
INSERT INTO job_provinceandcity VALUES('1011','辽宁省','Liaoning','0','11');
INSERT INTO job_provinceandcity VALUES('1012','吉林省','Jilin','0','12');
INSERT INTO job_provinceandcity VALUES('1013','黑龙江省','Heilongjiang','0','13');
INSERT INTO job_provinceandcity VALUES('1014','山东省','Shandong','0','14');
INSERT INTO job_provinceandcity VALUES('1015','安徽省','Anhui','0','15');
INSERT INTO job_provinceandcity VALUES('1016','福建省','Fujian','0','16');
INSERT INTO job_provinceandcity VALUES('1017','湖北省','Hubei','0','17');
INSERT INTO job_provinceandcity VALUES('1018','湖南省','Hunan','0','18');
INSERT INTO job_provinceandcity VALUES('1019','海南省','Hainan','0','19');
INSERT INTO job_provinceandcity VALUES('1020','江西省','Jiangxi','0','20');
INSERT INTO job_provinceandcity VALUES('1021','贵州省','Guizhou','0','21');
INSERT INTO job_provinceandcity VALUES('1022','云南省','Yunnan','0','22');
INSERT INTO job_provinceandcity VALUES('1023','陕西省','Shanxi','0','23');
INSERT INTO job_provinceandcity VALUES('1024','甘肃省','Gansu','0','24');
INSERT INTO job_provinceandcity VALUES('1025','广西区','Guangxi','0','25');
INSERT INTO job_provinceandcity VALUES('1026','宁夏区','Ningxia','0','26');
INSERT INTO job_provinceandcity VALUES('1027','青海省','Qinghai','0','27');
INSERT INTO job_provinceandcity VALUES('1028','新疆区','Xinjiang','0','28');
INSERT INTO job_provinceandcity VALUES('1029','西藏区','Tibet','0','29');
INSERT INTO job_provinceandcity VALUES('1030','内蒙古区','Inner Mongolia','0','30');
INSERT INTO job_provinceandcity VALUES('1031','香港','Hongkong','0','31');
INSERT INTO job_provinceandcity VALUES('1032','澳门','Macao','0','32');
INSERT INTO job_provinceandcity VALUES('1033','台湾','Taiwan','0','33');
INSERT INTO job_provinceandcity VALUES('1034','马鞍山市','Maanshan','1015','34');
INSERT INTO job_provinceandcity VALUES('1035','六安市','Liuan','1015','35');
INSERT INTO job_provinceandcity VALUES('1036','宣城市','Xuancheng','1015','36');
INSERT INTO job_provinceandcity VALUES('1037','宿州市','Suzhou','1015','37');
INSERT INTO job_provinceandcity VALUES('1038','铜陵市','Tongling','1015','38');
INSERT INTO job_provinceandcity VALUES('1039','芜湖市','Wuhu','1015','39');
INSERT INTO job_provinceandcity VALUES('1040','亳州市','Bozhou','1015','40');
INSERT INTO job_provinceandcity VALUES('1041','蚌埠市','Bengbu','1015','41');
INSERT INTO job_provinceandcity VALUES('1042','安庆市','Anqing','1015','42');
INSERT INTO job_provinceandcity VALUES('1043','滁州市','Chuzhou','1015','43');
INSERT INTO job_provinceandcity VALUES('1044','巢湖市','Caohu','1015','44');
INSERT INTO job_provinceandcity VALUES('1045','阜阳市','Fuyang','1015','45');
INSERT INTO job_provinceandcity VALUES('1046','池州市','Chizhou','1015','46');
INSERT INTO job_provinceandcity VALUES('1047','合肥市','Hefei','1015','47');
INSERT INTO job_provinceandcity VALUES('1048','黄山市','Huangshan','1015','48');
INSERT INTO job_provinceandcity VALUES('1049','淮南市','Huainan','1015','49');
INSERT INTO job_provinceandcity VALUES('1050','淮北市','Huaibei','1015','50');
INSERT INTO job_provinceandcity VALUES('1051','龙岩市','Longyan','1016','51');
INSERT INTO job_provinceandcity VALUES('1052','三明市','Sanming','1016','52');
INSERT INTO job_provinceandcity VALUES('1053','泉州市','Quanzhou','1016','53');
INSERT INTO job_provinceandcity VALUES('1054','厦门市','Xiamen','1016','54');
INSERT INTO job_provinceandcity VALUES('1055','漳州市','Zhangzhou','1016','55');
INSERT INTO job_provinceandcity VALUES('1056','莆田市','Putian','1016','56');
INSERT INTO job_provinceandcity VALUES('1057','南平市','Manping','1016','57');
INSERT INTO job_provinceandcity VALUES('1058','宁德市','Ningde','1016','58');
INSERT INTO job_provinceandcity VALUES('1059','福州市','Fuzhou','1016','59');
INSERT INTO job_provinceandcity VALUES('1060','临夏回族自治州','Linxia','1024','60');
INSERT INTO job_provinceandcity VALUES('1061','陇南地区','Longnan','1024','61');
INSERT INTO job_provinceandcity VALUES('1062','兰州市','Lanzhou','1024','62');
INSERT INTO job_provinceandcity VALUES('1063','天水市','Tianshui','1024','63');
INSERT INTO job_provinceandcity VALUES('1064','武威市','Wuwei','1024','64');
INSERT INTO job_provinceandcity VALUES('1065','庆阳市','Qingyang','1024','65');
INSERT INTO job_provinceandcity VALUES('1066','张掖市','Zhangye','1024','66');
INSERT INTO job_provinceandcity VALUES('1067','平凉市','Pingliang','1024','67');
INSERT INTO job_provinceandcity VALUES('1068','白银市','Baiyin','1024','68');
INSERT INTO job_provinceandcity VALUES('1069','定西市','Dingxi','1024','69');
INSERT INTO job_provinceandcity VALUES('1070','甘南藏族自治州','Gannan','1024','70');
INSERT INTO job_provinceandcity VALUES('1071','嘉峪关市','Jiayuguan','1024','71');
INSERT INTO job_provinceandcity VALUES('1072','金昌市','Jinchang','1024','72');
INSERT INTO job_provinceandcity VALUES('1073','酒泉市','Jiuquan','1024','73');
INSERT INTO job_provinceandcity VALUES('1074','茂名市','Maoming','1005','74');
INSERT INTO job_provinceandcity VALUES('1075','梅州市','Meizhou','1005','75');
INSERT INTO job_provinceandcity VALUES('1076','清远市','Qingyuan','1005','76');
INSERT INTO job_provinceandcity VALUES('1077','汕尾市','Shanwei','1005','77');
INSERT INTO job_provinceandcity VALUES('1078','汕头市','Shantou','1005','78');
INSERT INTO job_provinceandcity VALUES('1079','深圳市','Shenzhen','1005','79');
INSERT INTO job_provinceandcity VALUES('1080','韶关市','Shaoguan','1005','80');
INSERT INTO job_provinceandcity VALUES('1081','阳江市','Yangjiang','1005','81');
INSERT INTO job_provinceandcity VALUES('1082','云浮市','Yunfu','1005','82');
INSERT INTO job_provinceandcity VALUES('1083','湛江市','Zhanjiang','1005','83');
INSERT INTO job_provinceandcity VALUES('1084','肇庆市','Zhaoqing','1005','84');
INSERT INTO job_provinceandcity VALUES('1085','中山市','Zhongshan','1005','85');
INSERT INTO job_provinceandcity VALUES('1086','珠海市','Zhuhai','1005','86');
INSERT INTO job_provinceandcity VALUES('1087','潮州市','Chaozhou','1005','87');
INSERT INTO job_provinceandcity VALUES('1088','东莞市','Dongguan','1005','88');
INSERT INTO job_provinceandcity VALUES('1089','佛山市','Foshan','1005','89');
INSERT INTO job_provinceandcity VALUES('1090','广州市','Guangzhou','1005','90');
INSERT INTO job_provinceandcity VALUES('1091','河源市','Heyuan','1005','91');
INSERT INTO job_provinceandcity VALUES('1092','惠州市','Huizhou','1005','92');
INSERT INTO job_provinceandcity VALUES('1093','揭阳市','Jieyang','1005','93');
INSERT INTO job_provinceandcity VALUES('1094','江门市','Jiangmen','1005','94');
INSERT INTO job_provinceandcity VALUES('1095','柳州市','Liuzhou','1025','95');
INSERT INTO job_provinceandcity VALUES('1096','崇左市','Congzuo','1025','96');
INSERT INTO job_provinceandcity VALUES('1097','钦州市','Qinzhou','1025','97');
INSERT INTO job_provinceandcity VALUES('1098','梧州市','Wuzhou','1025','98');
INSERT INTO job_provinceandcity VALUES('1099','玉林市','Yulin','1025','99');
INSERT INTO job_provinceandcity VALUES('1100','南宁市','Nanning','1025','100');
INSERT INTO job_provinceandcity VALUES('1101','来宾市','Laibin','1025','101');
INSERT INTO job_provinceandcity VALUES('1102','百色市','Baise','1025','102');
INSERT INTO job_provinceandcity VALUES('1103','北海市','Beihai','1025','103');
INSERT INTO job_provinceandcity VALUES('1104','防城港市','Fangchengguang','1025','104');
INSERT INTO job_provinceandcity VALUES('1105','桂林市','Guilin','1025','105');
INSERT INTO job_provinceandcity VALUES('1106','贵港市','Guigang','1025','106');
INSERT INTO job_provinceandcity VALUES('1107','河池地区','Hechi','1025','107');
INSERT INTO job_provinceandcity VALUES('1108','贺州地区','Hezhou','1025','108');
INSERT INTO job_provinceandcity VALUES('1109','六盘水市','Liupanshui','1021','109');
INSERT INTO job_provinceandcity VALUES('1110','黔西南布依族苗族自治州','Qian Southwest','1021','110');
INSERT INTO job_provinceandcity VALUES('1111','黔南布依族苗族自治州','Qian South','1021','111');
INSERT INTO job_provinceandcity VALUES('1112','黔东南苗族侗族自治州','Qian Southeast','1021','112');
INSERT INTO job_provinceandcity VALUES('1113','铜仁地区','Tongren','1021','113');
INSERT INTO job_provinceandcity VALUES('1114','安顺市','Anshun','1021','114');
INSERT INTO job_provinceandcity VALUES('1115','毕节地区','Bijie','1021','115');
INSERT INTO job_provinceandcity VALUES('1116','贵阳市','Guiyang','1021','116');
INSERT INTO job_provinceandcity VALUES('1117','遵义市','Zunyi','1021','117');
INSERT INTO job_provinceandcity VALUES('1118','三亚市','Sanya','1019','118');
INSERT INTO job_provinceandcity VALUES('1119','海口市','Haikou','1019','119');
INSERT INTO job_provinceandcity VALUES('1120','廊坊市','Langfang','1007','120');
INSERT INTO job_provinceandcity VALUES('1121','秦皇岛市','Qinhuangdao','1007','121');
INSERT INTO job_provinceandcity VALUES('1122','邢台市','Xingtai','1007','122');
INSERT INTO job_provinceandcity VALUES('1123','石家庄市','Shijiazhuang','1007','123');
INSERT INTO job_provinceandcity VALUES('1124','唐山市','Tangshan','1007','124');
INSERT INTO job_provinceandcity VALUES('1125','张家口市','Zhangjiakou','1007','125');
INSERT INTO job_provinceandcity VALUES('1126','保定市','Baoding','1007','126');
INSERT INTO job_provinceandcity VALUES('1127','沧州市','Cangzhou','1007','127');
INSERT INTO job_provinceandcity VALUES('1128','承德市','Chengde','1007','128');
INSERT INTO job_provinceandcity VALUES('1129','衡水市','Hengshui','1007','129');
INSERT INTO job_provinceandcity VALUES('1130','邯郸市','Handan','1007','130');
INSERT INTO job_provinceandcity VALUES('1131','洛阳市','Luoyang','1010','131');
INSERT INTO job_provinceandcity VALUES('1132','新乡市','Xinxiang','1010','132');
INSERT INTO job_provinceandcity VALUES('1133','许昌市','Xuchang','1010','133');
INSERT INTO job_provinceandcity VALUES('1134','信阳市','Xinyang','1010','134');
INSERT INTO job_provinceandcity VALUES('1135','商丘市','Shangqiu','1010','135');
INSERT INTO job_provinceandcity VALUES('1136','三门峡市','Sanmenxia','1010','136');
INSERT INTO job_provinceandcity VALUES('1137','濮阳市','Puyang','1010','137');
INSERT INTO job_provinceandcity VALUES('1138','漯河市','Luohe','1010','138');
INSERT INTO job_provinceandcity VALUES('1139','南阳市','Nanyang','1010','139');
INSERT INTO job_provinceandcity VALUES('1140','平顶山市','Pingdingshan','1010','140');
INSERT INTO job_provinceandcity VALUES('1141','周口市','Zhoukou','1010','141');
INSERT INTO job_provinceandcity VALUES('1142','郑州市','Zhengzhou','1010','142');
INSERT INTO job_provinceandcity VALUES('1143','安阳市','Anyang','1010','143');
INSERT INTO job_provinceandcity VALUES('1144','鹤壁市','Hebi','1010','144');
INSERT INTO job_provinceandcity VALUES('1145','焦作市','Jiaozuo','1010','145');
INSERT INTO job_provinceandcity VALUES('1146','开封市','Kaifeng','1010','146');
INSERT INTO job_provinceandcity VALUES('1147','驻马店市','Zhumadian','1010','147');
INSERT INTO job_provinceandcity VALUES('1148','绥化市','Suihua','1013','148');
INSERT INTO job_provinceandcity VALUES('1149','双鸭山市','Shuangyashan','1013','149');
INSERT INTO job_provinceandcity VALUES('1150','伊春市','Yichun','1013','150');
INSERT INTO job_provinceandcity VALUES('1151','齐齐哈尔市','Qiqihar','1013','151');
INSERT INTO job_provinceandcity VALUES('1152','牡丹江市','Mudanjiang','1013','152');
INSERT INTO job_provinceandcity VALUES('1153','七台河市','Qitaihe','1013','153');
INSERT INTO job_provinceandcity VALUES('1154','大庆市','Daqing','1013','154');
INSERT INTO job_provinceandcity VALUES('1155','大兴安岭地区','Daxinganling','1013','155');
INSERT INTO job_provinceandcity VALUES('1156','哈尔滨市','Harbing','1013','156');
INSERT INTO job_provinceandcity VALUES('1157','黑河市','Heihe','1013','157');
INSERT INTO job_provinceandcity VALUES('1158','鹤岗市','Hegang','1013','158');
INSERT INTO job_provinceandcity VALUES('1159','佳木斯市','Jiamusi','1013','159');
INSERT INTO job_provinceandcity VALUES('1160','鸡西市','Jixi','1013','160');
INSERT INTO job_provinceandcity VALUES('1161','孝感市','Xiaogan','1017','161');
INSERT INTO job_provinceandcity VALUES('1162','随州市','Suizhou','1017','162');
INSERT INTO job_provinceandcity VALUES('1163','十堰市','Shiyan','1017','163');
INSERT INTO job_provinceandcity VALUES('1164','咸宁市','Xianning','1017','164');
INSERT INTO job_provinceandcity VALUES('1165','襄樊市','Xiangfan','1017','165');
INSERT INTO job_provinceandcity VALUES('1166','武汉市','Wuhan','1017','166');
INSERT INTO job_provinceandcity VALUES('1167','宜昌市','Yichang','1017','167');
INSERT INTO job_provinceandcity VALUES('1168','鄂州市','Ezhou','1017','168');
INSERT INTO job_provinceandcity VALUES('1169','恩施市','Enshi','1017','169');
INSERT INTO job_provinceandcity VALUES('1170','黄石市','Huangshi','1017','170');
INSERT INTO job_provinceandcity VALUES('1171','黄冈市','Huanggang','1017','171');
INSERT INTO job_provinceandcity VALUES('1172','荆门市','Jingmen','1017','172');
INSERT INTO job_provinceandcity VALUES('1173','荆州市','Jingzhou','1017','173');
INSERT INTO job_provinceandcity VALUES('1174','娄底市','Loudi','1018','174');
INSERT INTO job_provinceandcity VALUES('1175','邵阳市','Shaoyang','1018','175');
INSERT INTO job_provinceandcity VALUES('1176','湘潭市','Xiangtan','1018','176');
INSERT INTO job_provinceandcity VALUES('1177','湘西土家族苗族自治州','Xiangxi','1018','177');
INSERT INTO job_provinceandcity VALUES('1178','岳阳市','Yueyang','1018','178');
INSERT INTO job_provinceandcity VALUES('1179','永州市','Yongzhou','1018','179');
INSERT INTO job_provinceandcity VALUES('1180','张家界市','Zhangjiajie','1018','180');
INSERT INTO job_provinceandcity VALUES('1181','益阳市','Yiyang','1018','181');
INSERT INTO job_provinceandcity VALUES('1182','株洲市','Zhuzhou','1018','182');
INSERT INTO job_provinceandcity VALUES('1183','常德市','Changde','1018','183');
INSERT INTO job_provinceandcity VALUES('1184','长沙市','Changsha','1018','184');
INSERT INTO job_provinceandcity VALUES('1185','郴州市','Chenzhou','1018','185');
INSERT INTO job_provinceandcity VALUES('1186','衡阳市','Hengyang','1018','186');
INSERT INTO job_provinceandcity VALUES('1187','怀化市','Huaihua','1018','187');
INSERT INTO job_provinceandcity VALUES('1188','辽源市','Liaoyuan','1012','188');
INSERT INTO job_provinceandcity VALUES('1189','松原市','Songyuan','1012','189');
INSERT INTO job_provinceandcity VALUES('1190','四平市','Siping','1012','190');
INSERT INTO job_provinceandcity VALUES('1191','通化市','Tonghua','1012','191');
INSERT INTO job_provinceandcity VALUES('1192','延边朝鲜族自治州','Yanbian','1012','192');
INSERT INTO job_provinceandcity VALUES('1193','白山市','Baishan','1012','193');
INSERT INTO job_provinceandcity VALUES('1194','白城市','Baicheng','1012','194');
INSERT INTO job_provinceandcity VALUES('1195','长春市','Changchun','1012','195');
INSERT INTO job_provinceandcity VALUES('1196','吉林市','Jilin','1012','196');
INSERT INTO job_provinceandcity VALUES('1197','连云港市','Lianyungang','1006','197');
INSERT INTO job_provinceandcity VALUES('1198','徐州市','Xuzhou','1006','198');
INSERT INTO job_provinceandcity VALUES('1199','苏州市','Suzhou','1006','199');
INSERT INTO job_provinceandcity VALUES('1200','宿迁市','Suqian','1006','200');
INSERT INTO job_provinceandcity VALUES('1201','泰州市','Taizhou','1006','201');
INSERT INTO job_provinceandcity VALUES('1202','无锡市','Wuxi','1006','202');
INSERT INTO job_provinceandcity VALUES('1203','扬州市','Yangzhou','1006','203');
INSERT INTO job_provinceandcity VALUES('1204','盐城市','Yancheng','1006','204');
INSERT INTO job_provinceandcity VALUES('1205','镇江市','Zhenjiang','1006','205');
INSERT INTO job_provinceandcity VALUES('1206','南通市','Nantong','1006','206');
INSERT INTO job_provinceandcity VALUES('1207','南京市','Nanjing','1006','207');
INSERT INTO job_provinceandcity VALUES('1208','常州市','Changzhou','1006','208');
INSERT INTO job_provinceandcity VALUES('1209','淮安市','Huaian','1006','209');
INSERT INTO job_provinceandcity VALUES('1210','新余市','Xinyu','1020','210');
INSERT INTO job_provinceandcity VALUES('1211','上饶市','Shangrao','1020','211');
INSERT INTO job_provinceandcity VALUES('1212','宜春市','Yichun','1020','212');
INSERT INTO job_provinceandcity VALUES('1213','鹰潭市','Yingtan','1020','213');
INSERT INTO job_provinceandcity VALUES('1214','南昌市','Nanchang','1020','214');
INSERT INTO job_provinceandcity VALUES('1215','萍乡市','Pingxiang','1020','215');
INSERT INTO job_provinceandcity VALUES('1216','赣州市','Ganzhou','1020','216');
INSERT INTO job_provinceandcity VALUES('1217','抚州市','Fuzhou','1020','217');
INSERT INTO job_provinceandcity VALUES('1218','吉安市','Jian','1020','218');
INSERT INTO job_provinceandcity VALUES('1219','九江市','Jiujiang','1020','219');
INSERT INTO job_provinceandcity VALUES('1220','景德镇市','Jingdezhen','1020','220');
INSERT INTO job_provinceandcity VALUES('1221','辽阳市','Liaoyang','1011','221');
INSERT INTO job_provinceandcity VALUES('1222','沈阳市','Shenyang','1011','222');
INSERT INTO job_provinceandcity VALUES('1223','铁岭市','Tieling','1011','223');
INSERT INTO job_provinceandcity VALUES('1224','营口市','Yingkou','1011','224');
INSERT INTO job_provinceandcity VALUES('1225','盘锦市','Panjin','1011','225');
INSERT INTO job_provinceandcity VALUES('1226','鞍山市','Anshan','1011','226');
INSERT INTO job_provinceandcity VALUES('1227','本溪市','Benxi','1011','227');
INSERT INTO job_provinceandcity VALUES('1228','朝阳市','Chaoyang','1011','228');
INSERT INTO job_provinceandcity VALUES('1229','大连市','Dalian','1011','229');
INSERT INTO job_provinceandcity VALUES('1230','丹东市','Dandong','1011','230');
INSERT INTO job_provinceandcity VALUES('1231','抚顺市','Fushun','1011','231');
INSERT INTO job_provinceandcity VALUES('1232','阜新市','Fuxin','1011','232');
INSERT INTO job_provinceandcity VALUES('1233','葫芦岛市','Huludao','1011','233');
INSERT INTO job_provinceandcity VALUES('1234','锦州市','Jinzhou','1011','234');
INSERT INTO job_provinceandcity VALUES('1235','兴安盟','Xingan','1030','235');
INSERT INTO job_provinceandcity VALUES('1236','乌兰察布市','Wulanchabu','1030','236');
INSERT INTO job_provinceandcity VALUES('1237','乌海市','Wuhai','1030','237');
INSERT INTO job_provinceandcity VALUES('1238','锡林郭勒盟','Xilinguole','1030','238');
INSERT INTO job_provinceandcity VALUES('1239','通辽市','Tongliao','1030','239');
INSERT INTO job_provinceandcity VALUES('1240','巴彦淖尔市','Bayanzhuoer','1030','240');
INSERT INTO job_provinceandcity VALUES('1241','包头市','Baotou','1030','241');
INSERT INTO job_provinceandcity VALUES('1242','阿拉善盟','Alashan','1030','242');
INSERT INTO job_provinceandcity VALUES('1243','赤峰市','Chifeng','1030','243');
INSERT INTO job_provinceandcity VALUES('1244','鄂尔多斯市','Erduosi','1030','244');
INSERT INTO job_provinceandcity VALUES('1245','呼伦贝尔市','Hulunbeir','1030','245');
INSERT INTO job_provinceandcity VALUES('1246','呼和浩特市','Huhehaote','1030','246');
INSERT INTO job_provinceandcity VALUES('1247','石嘴山市','Shizuishan','1026','247');
INSERT INTO job_provinceandcity VALUES('1248','吴忠市','Wuzhong','1026','248');
INSERT INTO job_provinceandcity VALUES('1249','银川市','Yinchuan','1026','249');
INSERT INTO job_provinceandcity VALUES('1250','固原市','Guyuan','1026','250');
INSERT INTO job_provinceandcity VALUES('1251','西宁市','Xining','1027','251');
INSERT INTO job_provinceandcity VALUES('1252','玉树藏族自治州','Yushu','1027','252');
INSERT INTO job_provinceandcity VALUES('1253','果洛藏族自治州','Guoluo','1027','253');
INSERT INTO job_provinceandcity VALUES('1254','海西蒙古族藏族自治州','Haixi','1027','254');
INSERT INTO job_provinceandcity VALUES('1255','海南藏族自治州','Hainan','1027','255');
INSERT INTO job_provinceandcity VALUES('1256','海北藏族自治州','Haibei','1027','256');
INSERT INTO job_provinceandcity VALUES('1257','海东地区','Haidong','1027','257');
INSERT INTO job_provinceandcity VALUES('1258','黄南藏族自治州','Huangnan','1027','258');
INSERT INTO job_provinceandcity VALUES('1259','临沂市','Linyi','1014','259');
INSERT INTO job_provinceandcity VALUES('1260','聊城市','Liaocheng','1014','260');
INSERT INTO job_provinceandcity VALUES('1261','莱芜市','Laiwu','1014','261');
INSERT INTO job_provinceandcity VALUES('1262','青岛市','Qingdao','1014','262');
INSERT INTO job_provinceandcity VALUES('1263','日照市','Rizhao','1014','263');
INSERT INTO job_provinceandcity VALUES('1264','泰安市','Taian','1014','264');
INSERT INTO job_provinceandcity VALUES('1265','潍坊市','Weifang','1014','265');
INSERT INTO job_provinceandcity VALUES('1266','威海市','Weihai','1014','266');
INSERT INTO job_provinceandcity VALUES('1267','烟台市','Yantai','1014','267');
INSERT INTO job_provinceandcity VALUES('1268','枣庄市','Zaozhuang','1014','268');
INSERT INTO job_provinceandcity VALUES('1269','滨州市','Binzhou','1014','269');
INSERT INTO job_provinceandcity VALUES('1270','德州市','Dezhou','1014','270');
INSERT INTO job_provinceandcity VALUES('1271','东营市','Dongying','1014','271');
INSERT INTO job_provinceandcity VALUES('1272','菏泽市','Heze','1014','272');
INSERT INTO job_provinceandcity VALUES('1273','济南市','Jinan','1014','273');
INSERT INTO job_provinceandcity VALUES('1274','济宁市','Jining','1014','274');
INSERT INTO job_provinceandcity VALUES('1275','淄博市','Zibo','1014','275');
INSERT INTO job_provinceandcity VALUES('1276','吕梁市','Lvliang','1008','276');
INSERT INTO job_provinceandcity VALUES('1277','临汾市','Linfen','1008','277');
INSERT INTO job_provinceandcity VALUES('1278','忻州市','Xinzhou','1008','278');
INSERT INTO job_provinceandcity VALUES('1279','朔州市','Shuozhou','1008','279');
INSERT INTO job_provinceandcity VALUES('1280','太原市','Taiyuan','1008','280');
INSERT INTO job_provinceandcity VALUES('1281','阳泉市','Yangquan','1008','281');
INSERT INTO job_provinceandcity VALUES('1282','运城市','Yuncheng','1008','282');
INSERT INTO job_provinceandcity VALUES('1283','长治市','Changzhi','1008','283');
INSERT INTO job_provinceandcity VALUES('1284','大同市','Datong','1008','284');
INSERT INTO job_provinceandcity VALUES('1285','晋中市','Jinzhong','1008','285');
INSERT INTO job_provinceandcity VALUES('1286','晋城市','Jincheng','1008','286');
INSERT INTO job_provinceandcity VALUES('1287','商洛市','Shangluo','1023','287');
INSERT INTO job_provinceandcity VALUES('1288','咸阳市','Xianyang','1023','288');
INSERT INTO job_provinceandcity VALUES('1289','铜川市','Tongchuan','1023','289');
INSERT INTO job_provinceandcity VALUES('1290','渭南市','Weinan','1023','290');
INSERT INTO job_provinceandcity VALUES('1291','西安市','Xian','1023','291');
INSERT INTO job_provinceandcity VALUES('1292','延安市','Yanan','1023','292');
INSERT INTO job_provinceandcity VALUES('1293','榆林市','Yulin','1023','293');
INSERT INTO job_provinceandcity VALUES('1294','安康市','Ankang','1023','294');
INSERT INTO job_provinceandcity VALUES('1295','宝鸡市','Baoji','1023','295');
INSERT INTO job_provinceandcity VALUES('1296','汉中市','Hanzhong','1023','296');
INSERT INTO job_provinceandcity VALUES('1297','绵阳市','Mianyang','1009','297');
INSERT INTO job_provinceandcity VALUES('1298','泸州市','Luzhou','1009','298');
INSERT INTO job_provinceandcity VALUES('1299','乐山市','Leshan','1009','299');
INSERT INTO job_provinceandcity VALUES('1300','凉山彝族自治州','Liangshan','1009','300');
INSERT INTO job_provinceandcity VALUES('1301','眉山市','Meishan','1009','301');
INSERT INTO job_provinceandcity VALUES('1302','遂宁市','Suining','1009','302');
INSERT INTO job_provinceandcity VALUES('1303','雅安市','Yaan','1009','303');
INSERT INTO job_provinceandcity VALUES('1304','宜宾市','Yibin','1009','304');
INSERT INTO job_provinceandcity VALUES('1305','攀枝花市','Panzhihua','1009','305');
INSERT INTO job_provinceandcity VALUES('1306','南充市','Nanchong','1009','306');
INSERT INTO job_provinceandcity VALUES('1307','内江市','Neijiang','1009','307');
INSERT INTO job_provinceandcity VALUES('1308','巴中市','Bazhong','1009','308');
INSERT INTO job_provinceandcity VALUES('1309','阿坝藏族羌族自治州','Aba','1009','309');
INSERT INTO job_provinceandcity VALUES('1310','成都市','Chengdu','1009','310');
INSERT INTO job_provinceandcity VALUES('1311','达州市','Dazhou','1009','311');
INSERT INTO job_provinceandcity VALUES('1312','德阳市','Deyang','1009','312');
INSERT INTO job_provinceandcity VALUES('1313','甘孜藏族自治州','Ganzi','1009','313');
INSERT INTO job_provinceandcity VALUES('1314','广元市','Guangyuan','1009','314');
INSERT INTO job_provinceandcity VALUES('1315','广安市','Guangan','1009','315');
INSERT INTO job_provinceandcity VALUES('1316','资阳市','Ziyang','1009','316');
INSERT INTO job_provinceandcity VALUES('1317','自贡市','Zigong','1009','317');
INSERT INTO job_provinceandcity VALUES('1318','林芝地区','Linzhi','1029','318');
INSERT INTO job_provinceandcity VALUES('1319','拉萨市','Lasa','1029','319');
INSERT INTO job_provinceandcity VALUES('1320','日喀则地区','Rikaze','1029','320');
INSERT INTO job_provinceandcity VALUES('1321','山南地区','Shannan','1029','321');
INSERT INTO job_provinceandcity VALUES('1322','那曲地区','Naqu','1029','322');
INSERT INTO job_provinceandcity VALUES('1323','阿里地区','Ali','1029','323');
INSERT INTO job_provinceandcity VALUES('1324','昌都地区','Changdu','1029','324');
INSERT INTO job_provinceandcity VALUES('1325','吐鲁番市','Tulufan','1028','325');
INSERT INTO job_provinceandcity VALUES('1326','乌鲁木齐市','Wulumuqi','1028','326');
INSERT INTO job_provinceandcity VALUES('1327','伊宁市','Yining','1028','327');
INSERT INTO job_provinceandcity VALUES('1328','阿图什市','Atushi','1028','328');
INSERT INTO job_provinceandcity VALUES('1329','阿克苏市','Akesu','1028','329');
INSERT INTO job_provinceandcity VALUES('1330','昌吉市','Changji','1028','330');
INSERT INTO job_provinceandcity VALUES('1331','博乐市','Bole','1028','331');
INSERT INTO job_provinceandcity VALUES('1332','哈密市','Hami','1028','332');
INSERT INTO job_provinceandcity VALUES('1333','和田市','Hetian','1028','333');
INSERT INTO job_provinceandcity VALUES('1334','库尔勒市','Kuerle','1028','334');
INSERT INTO job_provinceandcity VALUES('1335','克拉玛依市','Kelamayi','1028','335');
INSERT INTO job_provinceandcity VALUES('1336','喀什市','Kashi','1028','336');
INSERT INTO job_provinceandcity VALUES('1337','临沧市','Lincang','1022','337');
INSERT INTO job_provinceandcity VALUES('1338','丽江市','Lijiang','1022','338');
INSERT INTO job_provinceandcity VALUES('1339','昆明市','Kunming','1022','339');
INSERT INTO job_provinceandcity VALUES('1340','潞西市','Luxi','1022','340');
INSERT INTO job_provinceandcity VALUES('1341','曲靖市','Qujing','1022','341');
INSERT INTO job_provinceandcity VALUES('1342','思茅市','Simao','1022','342');
INSERT INTO job_provinceandcity VALUES('1343','文山壮族苗族自治州','Wenshan','1022','343');
INSERT INTO job_provinceandcity VALUES('1344','昭通市','Zhaotong','1022','344');
INSERT INTO job_provinceandcity VALUES('1345','玉溪市','Yuxi','1022','345');
INSERT INTO job_provinceandcity VALUES('1346','怒江傈僳族自治州','Nujiang','1022','346');
INSERT INTO job_provinceandcity VALUES('1347','保山市','Baoshan','1022','347');
INSERT INTO job_provinceandcity VALUES('1348','楚雄市','Chuxiong','1022','348');
INSERT INTO job_provinceandcity VALUES('1349','大理市','Dali','1022','349');
INSERT INTO job_provinceandcity VALUES('1350','迪庆藏族自治州','Diqing','1022','350');
INSERT INTO job_provinceandcity VALUES('1351','个旧市','Gejiu','1022','351');
INSERT INTO job_provinceandcity VALUES('1352','景洪市','Jinghong','1022','352');
INSERT INTO job_provinceandcity VALUES('1353','衢州市','Quzhou','1004','353');
INSERT INTO job_provinceandcity VALUES('1354','丽水市','Lishui','1004','354');
INSERT INTO job_provinceandcity VALUES('1355','绍兴市','Shaoxing','1004','355');
INSERT INTO job_provinceandcity VALUES('1356','温州市','Wenzhou','1004','356');
INSERT INTO job_provinceandcity VALUES('1357','台州市','Taizhou','1004','357');
INSERT INTO job_provinceandcity VALUES('1358','宁波市','Ningbo','1004','358');
INSERT INTO job_provinceandcity VALUES('1359','舟山市','Zhoushan','1004','359');
INSERT INTO job_provinceandcity VALUES('1360','杭州市','Hangzhou','1004','360');
INSERT INTO job_provinceandcity VALUES('1361','湖州市','Huzhou','1004','361');
INSERT INTO job_provinceandcity VALUES('1362','嘉兴市','Jiaxing','1004','362');
INSERT INTO job_provinceandcity VALUES('1363','金华市','Jinhua','1004','363');
INSERT INTO job_provinceandcity VALUES('1364','石河子市','Shihezi','1028','364');
INSERT INTO job_provinceandcity VALUES('1365','阿拉尔市','Alaer','1028','365');
INSERT INTO job_provinceandcity VALUES('1366','图木舒克市','Tumushuke','1028','366');
INSERT INTO job_provinceandcity VALUES('1367','五加渠市','Wujiaqu','1028','367');
INSERT INTO job_provinceandcity VALUES('1368','北京市','Beijing','1000','368');
INSERT INTO job_provinceandcity VALUES('1369','上海市','Shanghai','1001','369');
INSERT INTO job_provinceandcity VALUES('1370','天津市','Tianjin','1002','370');
INSERT INTO job_provinceandcity VALUES('1371','重庆市','Chongqing','1003','371');
INSERT INTO job_provinceandcity VALUES('1372','香港','Hongkong','1372','372');
INSERT INTO job_provinceandcity VALUES('1373','澳门','Macao','1373','373');
INSERT INTO job_provinceandcity VALUES('1374','台湾','Taiwan','1374','374');
INSERT INTO job_provinceandcity VALUES('1375','白沙黎族自治县','Baisha','1019','375');
INSERT INTO job_provinceandcity VALUES('1376','保亭黎族苗族自治县','Baoting','1019','376');
INSERT INTO job_provinceandcity VALUES('1377','昌江黎族自治县','Changjiang','1019','377');
INSERT INTO job_provinceandcity VALUES('1378','澄迈县','Chengmai','1019','378');
INSERT INTO job_provinceandcity VALUES('1379','定安县','Dingan','1019','379');
INSERT INTO job_provinceandcity VALUES('1380','东方市','Dongfang','1019','380');
INSERT INTO job_provinceandcity VALUES('1381','乐东黎族自治县','Ledong','1019','381');
INSERT INTO job_provinceandcity VALUES('1382','临高县','Lingao','1019','382');
INSERT INTO job_provinceandcity VALUES('1383','陵水黎族自治县','Lingshui','1019','383');
INSERT INTO job_provinceandcity VALUES('1384','琼海市','Qionghai','1019','384');
INSERT INTO job_provinceandcity VALUES('1385','琼中黎族苗族自治县','Qiongzhong','1019','385');
INSERT INTO job_provinceandcity VALUES('1386','屯昌县','Tunchang','1019','386');
INSERT INTO job_provinceandcity VALUES('1387','万宁市','Wanning','1019','387');
INSERT INTO job_provinceandcity VALUES('1388','文昌市','Wenchang','1019','388');
INSERT INTO job_provinceandcity VALUES('1389','五指山市','Wuzhishan','1019','389');
INSERT INTO job_provinceandcity VALUES('1390','儋州市','Danzhou','1019','390');
INSERT INTO job_provinceandcity VALUES('1391','济源市','Jiyuan','1010','391');
INSERT INTO job_provinceandcity VALUES('1392','潜江市','Qianjiang','1017','392');
INSERT INTO job_provinceandcity VALUES('1393','神农架林区','Shennongjia','1017','393');
INSERT INTO job_provinceandcity VALUES('1394','天门市','Tianmen','1017','394');
INSERT INTO job_provinceandcity VALUES('1395','仙桃市','Xiantao','1017','395');
INSERT INTO job_provinceandcity VALUES('1396','凭祥市','Pinxiang','1025','396');
INSERT INTO job_provinceandcity VALUES('1397','东城区','Dongcheng','1368','397');
INSERT INTO job_provinceandcity VALUES('1398','西城区','Xicheng','1368','398');
INSERT INTO job_provinceandcity VALUES('1399','崇文区','Chongwen','1368','399');
INSERT INTO job_provinceandcity VALUES('1400','宣武区','Xuanwu','1368','400');
INSERT INTO job_provinceandcity VALUES('1401','朝阳区','Chaoyang','1368','401');
INSERT INTO job_provinceandcity VALUES('1402','海淀区','Haidian','1368','402');
INSERT INTO job_provinceandcity VALUES('1403','丰台区','Fengtai','1368','403');
INSERT INTO job_provinceandcity VALUES('1404','石景山区','Shijingshan','1368','404');
INSERT INTO job_provinceandcity VALUES('1405','房山区','Fangshan','1368','405');
INSERT INTO job_provinceandcity VALUES('1406','通州区','Tongzhou','1368','406');
INSERT INTO job_provinceandcity VALUES('1407','顺义区','Shunyi','1368','407');
INSERT INTO job_provinceandcity VALUES('1408','门头沟区','Mentougou','1368','408');
INSERT INTO job_provinceandcity VALUES('1409','昌平区','Changping','1368','409');
INSERT INTO job_provinceandcity VALUES('1410','大兴区','Daxing','1368','410');
INSERT INTO job_provinceandcity VALUES('1411','怀柔区','Huairou','1368','411');
INSERT INTO job_provinceandcity VALUES('1412','平谷区','Pinggu','1368','412');
INSERT INTO job_provinceandcity VALUES('1413','密云县','Miyun','1368','413');
INSERT INTO job_provinceandcity VALUES('1414','延庆县','Yanqing','1368','414');
INSERT INTO job_provinceandcity VALUES('1415','和平区','Heping','1370','415');
INSERT INTO job_provinceandcity VALUES('1416','河东区','Hedong','1370','416');
INSERT INTO job_provinceandcity VALUES('1417','河西区','Hexi','1370','417');
INSERT INTO job_provinceandcity VALUES('1418','南开区','Nankai','1370','418');
INSERT INTO job_provinceandcity VALUES('1419','河北区','Hebei','1370','419');
INSERT INTO job_provinceandcity VALUES('1420','红桥区','Hongqiao','1370','420');
INSERT INTO job_provinceandcity VALUES('1421','塘沽区','Tanggu','1370','421');
INSERT INTO job_provinceandcity VALUES('1422','汉沽区','Hangu','1370','422');
INSERT INTO job_provinceandcity VALUES('1423','大港区','Dagang','1370','423');
INSERT INTO job_provinceandcity VALUES('1424','东丽区','Dongli','1370','424');
INSERT INTO job_provinceandcity VALUES('1425','西青区','Xiqing','1370','425');
INSERT INTO job_provinceandcity VALUES('1426','北辰区','Beichen','1370','426');
INSERT INTO job_provinceandcity VALUES('1427','津南区','Jinnan','1370','427');
INSERT INTO job_provinceandcity VALUES('1428','武清区','Wuqing','1370','428');
INSERT INTO job_provinceandcity VALUES('1429','宝坻区','Baodi','1370','429');
INSERT INTO job_provinceandcity VALUES('1430','静海县','Jinghai','1370','430');
INSERT INTO job_provinceandcity VALUES('1431','宁河县','Ninghe','1370','431');
INSERT INTO job_provinceandcity VALUES('1432','蓟县','Jixian','1370','432');
INSERT INTO job_provinceandcity VALUES('1433','黄浦区','Huangpu','1369','433');
INSERT INTO job_provinceandcity VALUES('1434','卢湾区','Luwan','1369','434');
INSERT INTO job_provinceandcity VALUES('1435','徐汇区','Xuhui','1369','435');
INSERT INTO job_provinceandcity VALUES('1436','长宁区','Changning','1369','436');
INSERT INTO job_provinceandcity VALUES('1437','静安区','Jingan','1369','437');
INSERT INTO job_provinceandcity VALUES('1438','普陀区','Putuo','1369','438');
INSERT INTO job_provinceandcity VALUES('1439','闸北区','Zhabei','1369','439');
INSERT INTO job_provinceandcity VALUES('1440','虹口区','Hongkou','1369','440');
INSERT INTO job_provinceandcity VALUES('1441','杨浦区','Yangpu','1369','441');
INSERT INTO job_provinceandcity VALUES('1442','宝山区','Baoshan','1369','442');
INSERT INTO job_provinceandcity VALUES('1443','闵行区','Minxing','1369','443');
INSERT INTO job_provinceandcity VALUES('1444','嘉定区','Jiading','1369','444');
INSERT INTO job_provinceandcity VALUES('1445','松江区','Songjiang','1369','445');
INSERT INTO job_provinceandcity VALUES('1446','金山区','Jinshan','1369','446');
INSERT INTO job_provinceandcity VALUES('1447','青浦区','Qingpu','1369','447');
INSERT INTO job_provinceandcity VALUES('1448','浦东新区','Pudong','1369','448');
INSERT INTO job_provinceandcity VALUES('1449','南汇区','Nanhui','1369','449');
INSERT INTO job_provinceandcity VALUES('1450','奉贤区','Fengxian','1369','450');
INSERT INTO job_provinceandcity VALUES('1451','崇明县','Chongming','1369','451');
INSERT INTO job_provinceandcity VALUES('1452','渝中区','Yuzhong','1371','452');
INSERT INTO job_provinceandcity VALUES('1453','大渡口区','Dadukou','1371','453');
INSERT INTO job_provinceandcity VALUES('1454','江北区','Jiangbei','1371','454');
INSERT INTO job_provinceandcity VALUES('1455','沙坪坝区','Shapingba','1371','455');
INSERT INTO job_provinceandcity VALUES('1456','九龙坡区','Jiulongpo','1371','456');
INSERT INTO job_provinceandcity VALUES('1457','南岸区','Nanan','1371','457');
INSERT INTO job_provinceandcity VALUES('1458','北碚区','Beibei','1371','458');
INSERT INTO job_provinceandcity VALUES('1459','万盛区','Wansheng','1371','459');
INSERT INTO job_provinceandcity VALUES('1460','双桥区','Shuangqiao','1371','460');
INSERT INTO job_provinceandcity VALUES('1461','渝北区','Yubei','1371','461');
INSERT INTO job_provinceandcity VALUES('1462','巴南区','Banan','1371','462');
INSERT INTO job_provinceandcity VALUES('1463','万州区','Wanzhou','1371','463');
INSERT INTO job_provinceandcity VALUES('1464','涪陵区','Fuling','1371','464');
INSERT INTO job_provinceandcity VALUES('1465','黔江区','Qianjiang','1371','465');
INSERT INTO job_provinceandcity VALUES('1466','长寿区','Changshou','1371','466');
INSERT INTO job_provinceandcity VALUES('1467','永川市','Yongzhou','1371','467');
INSERT INTO job_provinceandcity VALUES('1468','合川市','Hezhou','1371','468');
INSERT INTO job_provinceandcity VALUES('1469','江津市','Jiangjin','1371','469');
INSERT INTO job_provinceandcity VALUES('1470','南川市','Nanchuan','1371','470');
INSERT INTO job_provinceandcity VALUES('1471','綦江县','Qijiang','1371','471');
INSERT INTO job_provinceandcity VALUES('1472','潼南县','Tongnan','1371','472');
INSERT INTO job_provinceandcity VALUES('1473','荣昌县','Rongchang','1371','473');
INSERT INTO job_provinceandcity VALUES('1474','璧山县','Bishan','1371','474');
INSERT INTO job_provinceandcity VALUES('1475','大足县','Dazu','1371','475');
INSERT INTO job_provinceandcity VALUES('1476','铜梁县','Tongliang','1371','476');
INSERT INTO job_provinceandcity VALUES('1477','梁平县','Liangping','1371','477');
INSERT INTO job_provinceandcity VALUES('1478','城口县','Chengkou','1371','478');
INSERT INTO job_provinceandcity VALUES('1479','垫江县','Dianjiang','1371','479');
INSERT INTO job_provinceandcity VALUES('1480','武隆县','Wulong','1371','480');
INSERT INTO job_provinceandcity VALUES('1481','丰都县','Fengdu','1371','481');
INSERT INTO job_provinceandcity VALUES('1482','奉节县','Fengjie','1371','482');
INSERT INTO job_provinceandcity VALUES('1483','开县','Kaixian','1371','483');
INSERT INTO job_provinceandcity VALUES('1484','云阳县','Yunyang','1371','484');
INSERT INTO job_provinceandcity VALUES('1485','忠县','Zhongxian','1371','485');
INSERT INTO job_provinceandcity VALUES('1486','巫溪县','Wuxi','1371','486');
INSERT INTO job_provinceandcity VALUES('1487','巫山县','Wushan','1371','487');
INSERT INTO job_provinceandcity VALUES('1488','石柱土家族自治县','Shizhu','1371','488');
INSERT INTO job_provinceandcity VALUES('1489','秀山土家族苗族自治县','Xiushan','1371','489');
INSERT INTO job_provinceandcity VALUES('1490','酉阳土家族苗族自治县','Youyang','1371','490');
INSERT INTO job_provinceandcity VALUES('1491','彭水苗族土家族自治县','Pengshui','1371','491');
INSERT INTO job_provinceandcity VALUES('1492','长安区','Changan','1123','492');
INSERT INTO job_provinceandcity VALUES('1493','桥东区','Qiaodong','1123','493');
INSERT INTO job_provinceandcity VALUES('1494','桥西区','Qiaoxi','1123','494');
INSERT INTO job_provinceandcity VALUES('1495','新华区','Xinhua','1123','495');
INSERT INTO job_provinceandcity VALUES('1496','裕华区','Yuhua','1123','496');
INSERT INTO job_provinceandcity VALUES('1497','井陉矿区','Jingxing Mining Area','1123','497');
INSERT INTO job_provinceandcity VALUES('1498','辛集市','Xinji','1123','498');
INSERT INTO job_provinceandcity VALUES('1499','藁城市','Gaocheng','1123','499');
INSERT INTO job_provinceandcity VALUES('1500','晋州市','Jinzhou','1123','500');
INSERT INTO job_provinceandcity VALUES('1501','新乐市','Xinle','1123','501');
INSERT INTO job_provinceandcity VALUES('1502','鹿泉市','Luquan','1123','502');
INSERT INTO job_provinceandcity VALUES('1503','平山县','Pingshan','1123','503');
INSERT INTO job_provinceandcity VALUES('1504','井陉县','Jingxing','1123','504');
INSERT INTO job_provinceandcity VALUES('1505','栾城县','Luancheng','1123','505');
INSERT INTO job_provinceandcity VALUES('1506','正定县','Zhengding','1123','506');
INSERT INTO job_provinceandcity VALUES('1507','行唐县','Xingtang','1123','507');
INSERT INTO job_provinceandcity VALUES('1508','灵寿县','Lingshou','1123','508');
INSERT INTO job_provinceandcity VALUES('1509','高邑县','Gaoyi','1123','509');
INSERT INTO job_provinceandcity VALUES('1510','赵县','Zhaoxian','1123','510');
INSERT INTO job_provinceandcity VALUES('1511','赞皇县','Zanhuang','1123','511');
INSERT INTO job_provinceandcity VALUES('1512','深泽县','Shenze','1123','512');
INSERT INTO job_provinceandcity VALUES('1513','无极县','Wuji','1123','513');
INSERT INTO job_provinceandcity VALUES('1514','元氏县','Yuanshi','1123','514');
INSERT INTO job_provinceandcity VALUES('1515','路北区','Lubei','1124','515');
INSERT INTO job_provinceandcity VALUES('1516','路南区','Lunan','1124','516');
INSERT INTO job_provinceandcity VALUES('1517','古冶区','Guzhi','1124','517');
INSERT INTO job_provinceandcity VALUES('1518','开平区','Kaiping','1124','518');
INSERT INTO job_provinceandcity VALUES('1519','丰南区','Fengnan','1124','519');
INSERT INTO job_provinceandcity VALUES('1520','丰润区','Fengrun','1124','520');
INSERT INTO job_provinceandcity VALUES('1521','遵化市','Zunhua','1124','521');
INSERT INTO job_provinceandcity VALUES('1522','迁安市','Qianan','1124','522');
INSERT INTO job_provinceandcity VALUES('1523','迁西县','Qianxi','1124','523');
INSERT INTO job_provinceandcity VALUES('1524','滦南县','Luannan','1124','524');
INSERT INTO job_provinceandcity VALUES('1525','玉田县','Yutian','1124','525');
INSERT INTO job_provinceandcity VALUES('1526','唐海县','Tanghai','1124','526');
INSERT INTO job_provinceandcity VALUES('1527','乐亭县','Leting','1124','527');
INSERT INTO job_provinceandcity VALUES('1528','滦县','Luanxian','1124','528');
INSERT INTO job_provinceandcity VALUES('1529','海港区','Hanggang','1121','529');
INSERT INTO job_provinceandcity VALUES('1530','山海关区','Shanhaiguan','1121','530');
INSERT INTO job_provinceandcity VALUES('1531','北戴河区','Beidaihe','1121','531');
INSERT INTO job_provinceandcity VALUES('1532','昌黎县','Changli','1121','532');
INSERT INTO job_provinceandcity VALUES('1533','卢龙县','Lulong','1121','533');
INSERT INTO job_provinceandcity VALUES('1534','抚宁县','Funing','1121','534');
INSERT INTO job_provinceandcity VALUES('1535','青龙满族自治县','Qinglong','1121','535');
INSERT INTO job_provinceandcity VALUES('1536','丛台区','Congtai','1130','536');
INSERT INTO job_provinceandcity VALUES('1537','复兴区','Fuxing','1130','537');
INSERT INTO job_provinceandcity VALUES('1538','邯山区','Hanshan','1130','538');
INSERT INTO job_provinceandcity VALUES('1539','峰峰矿区','Fengfeng Mining Area','1130','539');
INSERT INTO job_provinceandcity VALUES('1540','武安市','Wuan','1130','540');
INSERT INTO job_provinceandcity VALUES('1541','邯郸县','Handan','1130','541');
INSERT INTO job_provinceandcity VALUES('1542','永年县','Yongnian','1130','542');
INSERT INTO job_provinceandcity VALUES('1543','曲周县','Quzhou','1130','543');
INSERT INTO job_provinceandcity VALUES('1544','馆陶县','Guantao','1130','544');
INSERT INTO job_provinceandcity VALUES('1545','魏县','Weixian','1130','545');
INSERT INTO job_provinceandcity VALUES('1546','成安县','Chengan','1130','546');
INSERT INTO job_provinceandcity VALUES('1547','大名县','Daming','1130','547');
INSERT INTO job_provinceandcity VALUES('1548','涉县','Shexian','1130','548');
INSERT INTO job_provinceandcity VALUES('1549','鸡泽县','Jize','1130','549');
INSERT INTO job_provinceandcity VALUES('1550','邱县','Qiuxian','1130','550');
INSERT INTO job_provinceandcity VALUES('1551','广平县','Guangping','1130','551');
INSERT INTO job_provinceandcity VALUES('1552','肥乡县','Feixiang','1130','552');
INSERT INTO job_provinceandcity VALUES('1553','临漳县','Linzhang','1130','553');
INSERT INTO job_provinceandcity VALUES('1554','磁县','Cixian','1130','554');
INSERT INTO job_provinceandcity VALUES('1555','桥东区','Qiaodong','1122','555');
INSERT INTO job_provinceandcity VALUES('1556','桥西区','Qiaoxi','1122','556');
INSERT INTO job_provinceandcity VALUES('1557','南宫市','Nangong','1122','557');
INSERT INTO job_provinceandcity VALUES('1558','沙河市','Shahe','1122','558');
INSERT INTO job_provinceandcity VALUES('1559','邢台县','Xingtai','1122','559');
INSERT INTO job_provinceandcity VALUES('1560','柏乡县','Baixiang','1122','560');
INSERT INTO job_provinceandcity VALUES('1561','任县','Renxian','1122','561');
INSERT INTO job_provinceandcity VALUES('1562','清河县','Qinghe','1122','562');
INSERT INTO job_provinceandcity VALUES('1563','宁晋县','Ningjin','1122','563');
INSERT INTO job_provinceandcity VALUES('1564','威县','Weixian','1122','564');
INSERT INTO job_provinceandcity VALUES('1565','隆尧县','Longyao','1122','565');
INSERT INTO job_provinceandcity VALUES('1566','临城县','Lincheng','1122','566');
INSERT INTO job_provinceandcity VALUES('1567','广宗县','Guangzong','1122','567');
INSERT INTO job_provinceandcity VALUES('1568','临西县','Linxi','1122','568');
INSERT INTO job_provinceandcity VALUES('1569','内丘县','Neiqiu','1122','569');
INSERT INTO job_provinceandcity VALUES('1570','平乡县','Pingxiang','1122','570');
INSERT INTO job_provinceandcity VALUES('1571','巨鹿县','Julu','1122','571');
INSERT INTO job_provinceandcity VALUES('1572','新河县','Xinhe','1122','572');
INSERT INTO job_provinceandcity VALUES('1573','南和县','Nanhe','1122','573');
INSERT INTO job_provinceandcity VALUES('1574','新市区','Xinshi','1126','574');
INSERT INTO job_provinceandcity VALUES('1575','南市区','Nanshi','1126','575');
INSERT INTO job_provinceandcity VALUES('1576','北市区','Beishi','1126','576');
INSERT INTO job_provinceandcity VALUES('1577','涿州市','Zhuozhou','1126','577');
INSERT INTO job_provinceandcity VALUES('1578','定州市','Dingzhou','1126','578');
INSERT INTO job_provinceandcity VALUES('1579','安国市','Anguo','1126','579');
INSERT INTO job_provinceandcity VALUES('1580','高碑店市','Gaobeidian','1126','580');
INSERT INTO job_provinceandcity VALUES('1581','满城县','Mancheng','1126','581');
INSERT INTO job_provinceandcity VALUES('1582','清苑县','Qingyuan','1126','582');
INSERT INTO job_provinceandcity VALUES('1583','涞水县','Laishui','1126','583');
INSERT INTO job_provinceandcity VALUES('1584','阜平县','Fuping','1126','584');
INSERT INTO job_provinceandcity VALUES('1585','徐水县','Xushui','1126','585');
INSERT INTO job_provinceandcity VALUES('1586','定兴县','Dingxing','1126','586');
INSERT INTO job_provinceandcity VALUES('1587','唐县','Tangxian','1126','587');
INSERT INTO job_provinceandcity VALUES('1588','高阳县','Gaoyang','1126','588');
INSERT INTO job_provinceandcity VALUES('1589','容城县','Rongcheng','1126','589');
INSERT INTO job_provinceandcity VALUES('1590','涞源县','Laiyuan','1126','590');
INSERT INTO job_provinceandcity VALUES('1591','望都县','Wangdu','1126','591');
INSERT INTO job_provinceandcity VALUES('1592','安新县','Anxin','1126','592');
INSERT INTO job_provinceandcity VALUES('1593','易县','Yixian','1126','593');
INSERT INTO job_provinceandcity VALUES('1594','曲阳县','Quyang','1126','594');
INSERT INTO job_provinceandcity VALUES('1595','蠡县','Lixian','1126','595');
INSERT INTO job_provinceandcity VALUES('1596','顺平县','Shunping','1126','596');
INSERT INTO job_provinceandcity VALUES('1597','博野县','Boye','1126','597');
INSERT INTO job_provinceandcity VALUES('1598','雄县','Xiongxian','1126','598');
INSERT INTO job_provinceandcity VALUES('1599','桥西区','Qiaoxi','1125','599');
INSERT INTO job_provinceandcity VALUES('1600','桥东区','Qiaodong','1125','600');
INSERT INTO job_provinceandcity VALUES('1601','宣化区','Xuanhua','1125','601');
INSERT INTO job_provinceandcity VALUES('1602','下花园区','Xiahuayuan','1125','602');
INSERT INTO job_provinceandcity VALUES('1603','宣化县','Xuanhua','1125','603');
INSERT INTO job_provinceandcity VALUES('1604','阳原县','Yangyuan','1125','604');
INSERT INTO job_provinceandcity VALUES('1605','赤城县','Chicheng','1125','605');
INSERT INTO job_provinceandcity VALUES('1606','沽源县','Guyuan','1125','606');
INSERT INTO job_provinceandcity VALUES('1607','怀安县','Huaian','1125','607');
INSERT INTO job_provinceandcity VALUES('1608','怀来县','Huailai','1125','608');
INSERT INTO job_provinceandcity VALUES('1609','崇礼县','Chongli','1125','609');
INSERT INTO job_provinceandcity VALUES('1610','尚义县','Shangyi','1125','610');
INSERT INTO job_provinceandcity VALUES('1611','蔚县','Weixian','1125','611');
INSERT INTO job_provinceandcity VALUES('1612','涿鹿县','Zhuolu','1125','612');
INSERT INTO job_provinceandcity VALUES('1613','万全县','Wanquan','1125','613');
INSERT INTO job_provinceandcity VALUES('1614','康保县','Kangbao','1125','614');
INSERT INTO job_provinceandcity VALUES('1615','张北县','Zhangbei','1125','615');
INSERT INTO job_provinceandcity VALUES('1616','双桥区','Shuangqiao','1128','616');
INSERT INTO job_provinceandcity VALUES('1617','双滦区','Shuangluan','1128','617');
INSERT INTO job_provinceandcity VALUES('1618','鹰手营子矿区','Yingshouyingzi ','1128','618');
INSERT INTO job_provinceandcity VALUES('1619','承德县','Chengde','1128','619');
INSERT INTO job_provinceandcity VALUES('1620','兴隆县','Xinglong','1128','620');
INSERT INTO job_provinceandcity VALUES('1621','隆化县','Longhua','1128','621');
INSERT INTO job_provinceandcity VALUES('1622','平泉县','Pingquan','1128','622');
INSERT INTO job_provinceandcity VALUES('1623','滦平县','Luanping','1128','623');
INSERT INTO job_provinceandcity VALUES('1624','丰宁满族自治县','Fengning','1128','624');
INSERT INTO job_provinceandcity VALUES('1625','围场满族蒙古族自治县','Weichang','1128','625');
INSERT INTO job_provinceandcity VALUES('1626','宽城满族自治县','Kuancheng','1128','626');
INSERT INTO job_provinceandcity VALUES('1627','运河区','Yunhe','1127','627');
INSERT INTO job_provinceandcity VALUES('1628','新华区','Xinhua','1127','628');
INSERT INTO job_provinceandcity VALUES('1629','泊头市','Botou','1127','629');
INSERT INTO job_provinceandcity VALUES('1630','任丘市','Renqiu','1127','630');
INSERT INTO job_provinceandcity VALUES('1631','黄骅市','Huanghua','1127','631');
INSERT INTO job_provinceandcity VALUES('1632','河间市','Hejian','1127','632');
INSERT INTO job_provinceandcity VALUES('1633','沧县','Cangxian','1127','633');
INSERT INTO job_provinceandcity VALUES('1634','青县','Qingxian','1127','634');
INSERT INTO job_provinceandcity VALUES('1635','献县','Xianxian','1127','635');
INSERT INTO job_provinceandcity VALUES('1636','东光县','Dongguang','1127','636');
INSERT INTO job_provinceandcity VALUES('1637','海兴县','Haixing','1127','637');
INSERT INTO job_provinceandcity VALUES('1638','盐山县','Yanshan','1127','638');
INSERT INTO job_provinceandcity VALUES('1639','肃宁县','Suning','1127','639');
INSERT INTO job_provinceandcity VALUES('1640','南皮县','Nanpi','1127','640');
INSERT INTO job_provinceandcity VALUES('1641','吴桥县','Wuqiao','1127','641');
INSERT INTO job_provinceandcity VALUES('1642','孟村回族自治县','Mengcun','1127','642');
INSERT INTO job_provinceandcity VALUES('1643','安次区','Anci','1120','643');
INSERT INTO job_provinceandcity VALUES('1644','广阳区','Guangyang','1120','644');
INSERT INTO job_provinceandcity VALUES('1645','霸州市','Bazhou','1120','645');
INSERT INTO job_provinceandcity VALUES('1646','三河市','Sanhe ','1120','646');
INSERT INTO job_provinceandcity VALUES('1647','固安县','Guan','1120','647');
INSERT INTO job_provinceandcity VALUES('1648','永清县','Yongqing','1120','648');
INSERT INTO job_provinceandcity VALUES('1649','香河县','Xianghe','1120','649');
INSERT INTO job_provinceandcity VALUES('1650','大城县','Dacheng','1120','650');
INSERT INTO job_provinceandcity VALUES('1651','文安县','Wenan','1120','651');
INSERT INTO job_provinceandcity VALUES('1652','大厂回族自治县','Daguang','1120','652');
INSERT INTO job_provinceandcity VALUES('1653','桃城区','Taocheng','1129','653');
INSERT INTO job_provinceandcity VALUES('1654','冀州市','Jizhou','1129','654');
INSERT INTO job_provinceandcity VALUES('1655','深州市','Shenzhou','1129','655');
INSERT INTO job_provinceandcity VALUES('1656','饶阳县','Raoyang','1129','656');
INSERT INTO job_provinceandcity VALUES('1657','枣强县','Zaoqiang','1129','657');
INSERT INTO job_provinceandcity VALUES('1658','故城县','Gucheng','1129','658');
INSERT INTO job_provinceandcity VALUES('1659','阜城县','Fucheng','1129','659');
INSERT INTO job_provinceandcity VALUES('1660','安平县','Anping','1129','660');
INSERT INTO job_provinceandcity VALUES('1661','武邑县','Wuyi','1129','661');
INSERT INTO job_provinceandcity VALUES('1662','景县','Jingxian','1129','662');
INSERT INTO job_provinceandcity VALUES('1663','武强县','Wuqiang','1129','663');
INSERT INTO job_provinceandcity VALUES('1664','杏花岭区','Xinhualing','1280','664');
INSERT INTO job_provinceandcity VALUES('1665','小店区','Xiaodian','1280','665');
INSERT INTO job_provinceandcity VALUES('1666','迎泽区','Yingze','1280','666');
INSERT INTO job_provinceandcity VALUES('1667','尖草坪区','Jiancaoping','1280','667');
INSERT INTO job_provinceandcity VALUES('1668','万柏林区','Wanbailin','1280','668');
INSERT INTO job_provinceandcity VALUES('1669','晋源区','Jinyuan','1280','669');
INSERT INTO job_provinceandcity VALUES('1670','古交市','Gujiao','1280','670');
INSERT INTO job_provinceandcity VALUES('1671','阳曲县','Yangqu','1280','671');
INSERT INTO job_provinceandcity VALUES('1672','清徐县','Qingxu','1280','672');
INSERT INTO job_provinceandcity VALUES('1673','娄烦县','Loufan','1280','673');
INSERT INTO job_provinceandcity VALUES('1674','城区','Urban Area','1284','674');
INSERT INTO job_provinceandcity VALUES('1675','矿区','Mining Area','1284','675');
INSERT INTO job_provinceandcity VALUES('1676','南郊区','Nanjiao','1284','676');
INSERT INTO job_provinceandcity VALUES('1677','新荣区','Xinrong','1284','677');
INSERT INTO job_provinceandcity VALUES('1678','大同县','Datong','1284','678');
INSERT INTO job_provinceandcity VALUES('1679','天镇县','Tianzhen','1284','679');
INSERT INTO job_provinceandcity VALUES('1680','灵丘县','Lingqiu','1284','680');
INSERT INTO job_provinceandcity VALUES('1681','阳高县','Yanggao','1284','681');
INSERT INTO job_provinceandcity VALUES('1682','左云县','Zuoyun','1284','682');
INSERT INTO job_provinceandcity VALUES('1683','广灵县','Guangling','1284','683');
INSERT INTO job_provinceandcity VALUES('1684','浑源县','Hunyuan','1284','684');
INSERT INTO job_provinceandcity VALUES('1685','城区','Urban Area','1281','685');
INSERT INTO job_provinceandcity VALUES('1686','矿区','Mining Area','1281','686');
INSERT INTO job_provinceandcity VALUES('1687','郊区','Suburb','1281','687');
INSERT INTO job_provinceandcity VALUES('1688','平定县','Pingding','1281','688');
INSERT INTO job_provinceandcity VALUES('1689','盂县','Yuxian','1281','689');
INSERT INTO job_provinceandcity VALUES('1690','城区','Urban Area','1283','690');
INSERT INTO job_provinceandcity VALUES('1691','郊区','Suburb','1283','691');
INSERT INTO job_provinceandcity VALUES('1692','潞城市','Lucheng','1283','692');
INSERT INTO job_provinceandcity VALUES('1693','长治县','Changzhi','1283','693');
INSERT INTO job_provinceandcity VALUES('1694','长子县','Zhangzi','1283','694');
INSERT INTO job_provinceandcity VALUES('1695','平顺县','Pingshun','1283','695');
INSERT INTO job_provinceandcity VALUES('1696','襄垣县','Xiangyuan','1283','696');
INSERT INTO job_provinceandcity VALUES('1697','沁源县','Qinyuan','1283','697');
INSERT INTO job_provinceandcity VALUES('1698','屯留县','Tunliu','1283','698');
INSERT INTO job_provinceandcity VALUES('1699','黎城县','Licheng','1283','699');
INSERT INTO job_provinceandcity VALUES('1700','武乡县','Wuxiang','1283','700');
INSERT INTO job_provinceandcity VALUES('1701','沁县','Qinxian','1283','701');
INSERT INTO job_provinceandcity VALUES('1702','壶关县','Huguan','1283','702');
INSERT INTO job_provinceandcity VALUES('1703','城区','Urban Area','1286','703');
INSERT INTO job_provinceandcity VALUES('1704','高平市','Gaoping','1286','704');
INSERT INTO job_provinceandcity VALUES('1705','泽州县','Zezhou','1286','705');
INSERT INTO job_provinceandcity VALUES('1706','陵川县','Lingchuan','1286','706');
INSERT INTO job_provinceandcity VALUES('1707','阳城县','Yangcheng','1286','707');
INSERT INTO job_provinceandcity VALUES('1708','沁水县','Qinshui','1286','708');
INSERT INTO job_provinceandcity VALUES('1709','朔城区','Shuocheng','1279','709');
INSERT INTO job_provinceandcity VALUES('1710','平鲁区','Pinglu','1279','710');
INSERT INTO job_provinceandcity VALUES('1711','山阴县','Shanyin','1279','711');
INSERT INTO job_provinceandcity VALUES('1712','右玉县','Youyu','1279','712');
INSERT INTO job_provinceandcity VALUES('1713','应县','Yingxian','1279','713');
INSERT INTO job_provinceandcity VALUES('1714','怀仁县','Huairen','1279','714');
INSERT INTO job_provinceandcity VALUES('1715','榆次区','Yuci','1285','715');
INSERT INTO job_provinceandcity VALUES('1716','介休市','Jiexiu','1285','716');
INSERT INTO job_provinceandcity VALUES('1717','昔阳县','Xiyang','1285','717');
INSERT INTO job_provinceandcity VALUES('1718','灵石县','Lingshi','1285','718');
INSERT INTO job_provinceandcity VALUES('1719','祁县','Qixian','1285','719');
INSERT INTO job_provinceandcity VALUES('1720','左权县','Zuoquan','1285','720');
INSERT INTO job_provinceandcity VALUES('1721','寿阳县','Shouyang','1285','721');
INSERT INTO job_provinceandcity VALUES('1722','太谷县','Taigu','1285','722');
INSERT INTO job_provinceandcity VALUES('1723','和顺县','Heshun','1285','723');
INSERT INTO job_provinceandcity VALUES('1724','平遥县','Pingyao','1285','724');
INSERT INTO job_provinceandcity VALUES('1725','榆社县','Yushe','1285','725');
INSERT INTO job_provinceandcity VALUES('1726','忻府区','Xinfu','1278','726');
INSERT INTO job_provinceandcity VALUES('1727','原平市','Yuanping','1278','727');
INSERT INTO job_provinceandcity VALUES('1728','代县','Daixian','1278','728');
INSERT INTO job_provinceandcity VALUES('1729','神池县','Shenchi','1278','729');
INSERT INTO job_provinceandcity VALUES('1730','五寨县','Wuzhai','1278','730');
INSERT INTO job_provinceandcity VALUES('1731','五台县','Wutai','1278','731');
INSERT INTO job_provinceandcity VALUES('1732','偏关县','Pianguan','1278','732');
INSERT INTO job_provinceandcity VALUES('1733','宁武县','Ningwu','1278','733');
INSERT INTO job_provinceandcity VALUES('1734','静乐县','Jingle','1278','734');
INSERT INTO job_provinceandcity VALUES('1735','繁峙县','Fanshi','1278','735');
INSERT INTO job_provinceandcity VALUES('1736','河曲县','Hequ','1278','736');
INSERT INTO job_provinceandcity VALUES('1737','保德县','Baode','1278','737');
INSERT INTO job_provinceandcity VALUES('1738','定襄县','Dingxiang','1278','738');
INSERT INTO job_provinceandcity VALUES('1739','岢岚县','Kelan','1278','739');
INSERT INTO job_provinceandcity VALUES('1740','尧都区','Yaodu','1277','740');
INSERT INTO job_provinceandcity VALUES('1741','侯马市','Houma','1277','741');
INSERT INTO job_provinceandcity VALUES('1742','霍州市','Huozhou','1277','742');
INSERT INTO job_provinceandcity VALUES('1743','汾西县','Fenxi','1277','743');
INSERT INTO job_provinceandcity VALUES('1744','吉县','Jixian','1277','744');
INSERT INTO job_provinceandcity VALUES('1745','安泽县','Anze','1277','745');
INSERT INTO job_provinceandcity VALUES('1746','大宁县','Daning','1277','746');
INSERT INTO job_provinceandcity VALUES('1747','浮山县','Fushan','1277','747');
INSERT INTO job_provinceandcity VALUES('1748','古县','Guxian','1277','748');
INSERT INTO job_provinceandcity VALUES('1749','隰县','Xixian','1277','749');
INSERT INTO job_provinceandcity VALUES('1750','襄汾县','Xiangfen','1277','750');
INSERT INTO job_provinceandcity VALUES('1751','翼城县','Yicheng','1277','751');
INSERT INTO job_provinceandcity VALUES('1752','永和县','Yonghe','1277','752');
INSERT INTO job_provinceandcity VALUES('1753','乡宁县','Xiangning','1277','753');
INSERT INTO job_provinceandcity VALUES('1754','曲沃县','Quwo','1277','754');
INSERT INTO job_provinceandcity VALUES('1755','洪洞县','Hongdong','1277','755');
INSERT INTO job_provinceandcity VALUES('1756','蒲县','Puxian','1277','756');
INSERT INTO job_provinceandcity VALUES('1757','盐湖区','Yanhu','1282','757');
INSERT INTO job_provinceandcity VALUES('1758','河津市','Hejin','1282','758');
INSERT INTO job_provinceandcity VALUES('1759','永济市','Yongji','1282','759');
INSERT INTO job_provinceandcity VALUES('1760','闻喜县','Wenxi','1282','760');
INSERT INTO job_provinceandcity VALUES('1761','新绛县','Xinjiang','1282','761');
INSERT INTO job_provinceandcity VALUES('1762','平陆县','Pinglu','1282','762');
INSERT INTO job_provinceandcity VALUES('1763','垣曲县','Yuanqu','1282','763');
INSERT INTO job_provinceandcity VALUES('1764','绛县','Jiangxian','1282','764');
INSERT INTO job_provinceandcity VALUES('1765','稷山县','Jishan','1282','765');
INSERT INTO job_provinceandcity VALUES('1766','芮城县','Ruicheng','1282','766');
INSERT INTO job_provinceandcity VALUES('1767','夏县','Xiaxian','1282','767');
INSERT INTO job_provinceandcity VALUES('1768','万荣县','Wanrong','1282','768');
INSERT INTO job_provinceandcity VALUES('1769','临猗县','Linyi','1282','769');
INSERT INTO job_provinceandcity VALUES('1770','离石区','Lishi','1276','770');
INSERT INTO job_provinceandcity VALUES('1771','孝义市','Xiaoyi','1276','771');
INSERT INTO job_provinceandcity VALUES('1772','汾阳市','Fenyang','1276','772');
INSERT INTO job_provinceandcity VALUES('1773','文水县','Wenshui','1276','773');
INSERT INTO job_provinceandcity VALUES('1774','中阳县','Zhongyang','1276','774');
INSERT INTO job_provinceandcity VALUES('1775','兴县','Xingxian','1276','775');
INSERT INTO job_provinceandcity VALUES('1776','临县','Linxian','1276','776');
INSERT INTO job_provinceandcity VALUES('1777','方山县','Fangshan','1276','777');
INSERT INTO job_provinceandcity VALUES('1778','柳林县','Liulin','1276','778');
INSERT INTO job_provinceandcity VALUES('1779','岚县','Lanxian','1276','779');
INSERT INTO job_provinceandcity VALUES('1780','交口县','Jiaokou','1276','780');
INSERT INTO job_provinceandcity VALUES('1781','交城县','Jiaocheng','1276','781');
INSERT INTO job_provinceandcity VALUES('1782','石楼县','Shilou','1276','782');
INSERT INTO job_provinceandcity VALUES('1783','沈河区','Shenhe','1222','783');
INSERT INTO job_provinceandcity VALUES('1784','皇姑区','Huanggu','1222','784');
INSERT INTO job_provinceandcity VALUES('1785','和平区','Heping','1222','785');
INSERT INTO job_provinceandcity VALUES('1786','大东区','Dadong','1222','786');
INSERT INTO job_provinceandcity VALUES('1787','铁西区','Tiexi','1222','787');
INSERT INTO job_provinceandcity VALUES('1788','苏家屯区','Sujiatun','1222','788');
INSERT INTO job_provinceandcity VALUES('1789','东陵区','Dongling','1222','789');
INSERT INTO job_provinceandcity VALUES('1790','新城子区','Xianchengzi','1222','790');
INSERT INTO job_provinceandcity VALUES('1791','于洪区','Yuhong','1222','791');
INSERT INTO job_provinceandcity VALUES('1792','新民市','Xinmin','1222','792');
INSERT INTO job_provinceandcity VALUES('1793','法库县','Faku','1222','793');
INSERT INTO job_provinceandcity VALUES('1794','辽中县','Liaozhong','1222','794');
INSERT INTO job_provinceandcity VALUES('1795','康平县','Kangpping','1222','795');
INSERT INTO job_provinceandcity VALUES('1796','西岗区','Xigang','1229','796');
INSERT INTO job_provinceandcity VALUES('1797','中山区','Zhongshan','1229','797');
INSERT INTO job_provinceandcity VALUES('1798','沙河口区','Shahekou','1229','798');
INSERT INTO job_provinceandcity VALUES('1799','甘井子区','Ganjingzi','1229','799');
INSERT INTO job_provinceandcity VALUES('1800','旅顺口区','Lvshunkou','1229','800');
INSERT INTO job_provinceandcity VALUES('1801','金州区','Jinzhou','1229','801');
INSERT INTO job_provinceandcity VALUES('1802','瓦房店市','Wafangdian','1229','802');
INSERT INTO job_provinceandcity VALUES('1803','普兰店市','Pulandian','1229','803');
INSERT INTO job_provinceandcity VALUES('1804','庄河市','Zhuanghe','1229','804');
INSERT INTO job_provinceandcity VALUES('1805','长海县','Changhai','1229','805');
INSERT INTO job_provinceandcity VALUES('1806','铁东区','Tiedong','1226','806');
INSERT INTO job_provinceandcity VALUES('1807','铁西区','Tiexi','1226','807');
INSERT INTO job_provinceandcity VALUES('1808','立山区','Lishan','1226','808');
INSERT INTO job_provinceandcity VALUES('1809','千山区','Qianshan','1226','809');
INSERT INTO job_provinceandcity VALUES('1810','海城市','Haicheng','1226','810');
INSERT INTO job_provinceandcity VALUES('1811','台安县','Taian','1226','811');
INSERT INTO job_provinceandcity VALUES('1812','岫岩满族自治县','Xiuyan','1226','812');
INSERT INTO job_provinceandcity VALUES('1813','新抚区','Xinfu','1231','813');
INSERT INTO job_provinceandcity VALUES('1814','东洲区','Dongzhou','1231','814');
INSERT INTO job_provinceandcity VALUES('1815','望花区','Wanghua','1231','815');
INSERT INTO job_provinceandcity VALUES('1816','顺城区','Shuncheng','1231','816');
INSERT INTO job_provinceandcity VALUES('1817','抚顺县','Fushun','1231','817');
INSERT INTO job_provinceandcity VALUES('1818','清原满族自治县','Qingyuan','1231','818');
INSERT INTO job_provinceandcity VALUES('1819','新宾满族自治县','Xinbin','1231','819');
INSERT INTO job_provinceandcity VALUES('1820','平山区','Pingshan','1227','820');
INSERT INTO job_provinceandcity VALUES('1821','明山区','Mingshan','1227','821');
INSERT INTO job_provinceandcity VALUES('1822','溪湖区','Xihu','1227','822');
INSERT INTO job_provinceandcity VALUES('1823','南芬区','Nanfen','1227','823');
INSERT INTO job_provinceandcity VALUES('1824','本溪满族自治县','Benxi','1227','824');
INSERT INTO job_provinceandcity VALUES('1825','桓仁满族自治县','Huanren','1227','825');
INSERT INTO job_provinceandcity VALUES('1826','振兴区','Zhenxing','1230','826');
INSERT INTO job_provinceandcity VALUES('1827','元宝区','Yuanbao','1230','827');
INSERT INTO job_provinceandcity VALUES('1828','振安区','Zhenan','1230','828');
INSERT INTO job_provinceandcity VALUES('1829','东港市','Donggang','1230','829');
INSERT INTO job_provinceandcity VALUES('1830','凤城市','Fengcheng','1230','830');
INSERT INTO job_provinceandcity VALUES('1831','宽甸满族自治县','Kuandian','1230','831');
INSERT INTO job_provinceandcity VALUES('1832','太和区','Taihe','1234','832');
INSERT INTO job_provinceandcity VALUES('1833','古塔区','Kuta','1234','833');
INSERT INTO job_provinceandcity VALUES('1834','凌河区','Linghe','1234','834');
INSERT INTO job_provinceandcity VALUES('1835','凌海市','Linghai','1234','835');
INSERT INTO job_provinceandcity VALUES('1836','北宁市','Beining','1234','836');
INSERT INTO job_provinceandcity VALUES('1837','黑山县','Heishan','1234','837');
INSERT INTO job_provinceandcity VALUES('1838','义县','Yixian','1234','838');
INSERT INTO job_provinceandcity VALUES('1839','龙港区','Longgang','1233','839');
INSERT INTO job_provinceandcity VALUES('1840','南票区','Nanpiao','1233','840');
INSERT INTO job_provinceandcity VALUES('1841','连山区','Lianshan','1233','841');
INSERT INTO job_provinceandcity VALUES('1842','兴城市','Xingcheng','1233','842');
INSERT INTO job_provinceandcity VALUES('1843','绥中县','Suizhong','1233','843');
INSERT INTO job_provinceandcity VALUES('1844','建昌县','Jianchang','1233','844');
INSERT INTO job_provinceandcity VALUES('1845','站前区','Zhanqian','1224','845');
INSERT INTO job_provinceandcity VALUES('1846','西市区','Xishi','1224','846');
INSERT INTO job_provinceandcity VALUES('1847','鲅鱼圈区','Bayuquan','1224','847');
INSERT INTO job_provinceandcity VALUES('1848','老边区','Laobian','1224','848');
INSERT INTO job_provinceandcity VALUES('1849','大石桥市','Dashiqiao','1224','849');
INSERT INTO job_provinceandcity VALUES('1850','盖州市','Gaizhou','1224','850');
INSERT INTO job_provinceandcity VALUES('1851','双台子区','Shuangtaizi','1225','851');
INSERT INTO job_provinceandcity VALUES('1852','兴隆台区','Xinglongtai','1225','852');
INSERT INTO job_provinceandcity VALUES('1853','盘山县','Panshan','1225','853');
INSERT INTO job_provinceandcity VALUES('1854','大洼县','Dawa','1225','854');
INSERT INTO job_provinceandcity VALUES('1855','海州区','Haizhou','1232','855');
INSERT INTO job_provinceandcity VALUES('1856','新邱区','Xinqiu','1232','856');
INSERT INTO job_provinceandcity VALUES('1857','太平区','Taiping','1232','857');
INSERT INTO job_provinceandcity VALUES('1858','清河门区','Qinghemen','1232','858');
INSERT INTO job_provinceandcity VALUES('1859','细河区','Xihe','1232','859');
INSERT INTO job_provinceandcity VALUES('1860','彰武县','Zhangwu','1232','860');
INSERT INTO job_provinceandcity VALUES('1861','阜新蒙古族自治县','Fuxin','1232','861');
INSERT INTO job_provinceandcity VALUES('1862','白塔区','Baita','1221','862');
INSERT INTO job_provinceandcity VALUES('1863','文圣区','Wensheng','1221','863');
INSERT INTO job_provinceandcity VALUES('1864','宏伟区','Hongwei','1221','864');
INSERT INTO job_provinceandcity VALUES('1865','太子河区','Taizihe','1221','865');
INSERT INTO job_provinceandcity VALUES('1866','弓长岭区','Gongchangling','1221','866');
INSERT INTO job_provinceandcity VALUES('1867','灯塔市','Dengta','1221','867');
INSERT INTO job_provinceandcity VALUES('1868','辽阳县','Liaoyang','1221','868');
INSERT INTO job_provinceandcity VALUES('1869','银州区','Yinzhou','1223','869');
INSERT INTO job_provinceandcity VALUES('1870','清河区','Qinghe','1223','870');
INSERT INTO job_provinceandcity VALUES('1871','调兵山市','Diaobingshan','1223','871');
INSERT INTO job_provinceandcity VALUES('1872','开原市','Kaiyuan','1223','872');
INSERT INTO job_provinceandcity VALUES('1873','铁岭县','Tieling','1223','873');
INSERT INTO job_provinceandcity VALUES('1874','昌图县','Changtu','1223','874');
INSERT INTO job_provinceandcity VALUES('1875','西丰县','Xifeng','1223','875');
INSERT INTO job_provinceandcity VALUES('1876','双塔区','Shuangta','1228','876');
INSERT INTO job_provinceandcity VALUES('1877','龙城区','Longcheng','1228','877');
INSERT INTO job_provinceandcity VALUES('1878','凌源市','Lingyuan','1228','878');
INSERT INTO job_provinceandcity VALUES('1879','北票市','Beipiao','1228','879');
INSERT INTO job_provinceandcity VALUES('1880','朝阳县','Chaoyang','1228','880');
INSERT INTO job_provinceandcity VALUES('1881','建平县','Jianping','1228','881');
INSERT INTO job_provinceandcity VALUES('1882','喀喇沁左翼蒙古族自治县','Kalaqin','1228','882');
INSERT INTO job_provinceandcity VALUES('1883','朝阳区','Chaoyang','1195','883');
INSERT INTO job_provinceandcity VALUES('1884','宽城区','Kuancheng','1195','884');
INSERT INTO job_provinceandcity VALUES('1885','二道区','Erdao','1195','885');
INSERT INTO job_provinceandcity VALUES('1886','南关区','Nanguan','1195','886');
INSERT INTO job_provinceandcity VALUES('1887','绿圆区','Lvyuan','1195','887');
INSERT INTO job_provinceandcity VALUES('1888','双阳区','Shuangyang','1195','888');
INSERT INTO job_provinceandcity VALUES('1889','九台市','Jiutai','1195','889');
INSERT INTO job_provinceandcity VALUES('1890','榆树市','Yushu','1195','890');
INSERT INTO job_provinceandcity VALUES('1891','德惠市','Dehui','1195','891');
INSERT INTO job_provinceandcity VALUES('1892','农安县','Nongan','1195','892');
INSERT INTO job_provinceandcity VALUES('1893','船营区','Chuanying','1196','893');
INSERT INTO job_provinceandcity VALUES('1894','昌邑区','Changyi','1196','894');
INSERT INTO job_provinceandcity VALUES('1895','龙潭区','Longtan','1196','895');
INSERT INTO job_provinceandcity VALUES('1896','丰满区','Fengman','1196','896');
INSERT INTO job_provinceandcity VALUES('1897','舒兰市','Shulan','1196','897');
INSERT INTO job_provinceandcity VALUES('1898','桦甸市','Huadian','1196','898');
INSERT INTO job_provinceandcity VALUES('1899','蛟河市','Jiaohe','1196','899');
INSERT INTO job_provinceandcity VALUES('1900','磐石市','Panshi','1196','900');
INSERT INTO job_provinceandcity VALUES('1901','永吉县','Yongji','1196','901');
INSERT INTO job_provinceandcity VALUES('1902','铁西区','Tiexi','1190','902');
INSERT INTO job_provinceandcity VALUES('1903','铁东区','Tiedong','1190','903');
INSERT INTO job_provinceandcity VALUES('1904','公主岭市','Gongzhuling','1190','904');
INSERT INTO job_provinceandcity VALUES('1905','双辽市','Shuangliao','1190','905');
INSERT INTO job_provinceandcity VALUES('1906','梨树县','Lishu','1190','906');
INSERT INTO job_provinceandcity VALUES('1907','伊通满族自治县','Yitong','1190','907');
INSERT INTO job_provinceandcity VALUES('1908','龙山区','Longshan','1188','908');
INSERT INTO job_provinceandcity VALUES('1909','西安区','Xian','1188','909');
INSERT INTO job_provinceandcity VALUES('1910','东辽县','Dongliao','1188','910');
INSERT INTO job_provinceandcity VALUES('1911','东丰县','Dongfeng','1188','911');
INSERT INTO job_provinceandcity VALUES('1912','东昌区','Dongchang','1191','912');
INSERT INTO job_provinceandcity VALUES('1913','二道江区','Erdaojiang','1191','913');
INSERT INTO job_provinceandcity VALUES('1914','梅河口市','Meihekou','1191','914');
INSERT INTO job_provinceandcity VALUES('1915','集安市','Jian','1191','915');
INSERT INTO job_provinceandcity VALUES('1916','通化县','Tonghua','1191','916');
INSERT INTO job_provinceandcity VALUES('1917','辉南县','Huinan','1191','917');
INSERT INTO job_provinceandcity VALUES('1918','柳河县','Liuhe','1191','918');
INSERT INTO job_provinceandcity VALUES('1919','八道江区','Badaojiang','1193','919');
INSERT INTO job_provinceandcity VALUES('1920','临江市','Linjiang','1193','920');
INSERT INTO job_provinceandcity VALUES('1921','靖宇县','Jingyu','1193','921');
INSERT INTO job_provinceandcity VALUES('1922','抚松县','Fusong','1193','922');
INSERT INTO job_provinceandcity VALUES('1923','江源县','Songyuan','1193','923');
INSERT INTO job_provinceandcity VALUES('1924','长白朝鲜族自治县','Changbai','1193','924');
INSERT INTO job_provinceandcity VALUES('1925','宁江区','Ningjiang','1189','925');
INSERT INTO job_provinceandcity VALUES('1926','乾安县','Qianan','1189','926');
INSERT INTO job_provinceandcity VALUES('1927','长岭县','Changling','1189','927');
INSERT INTO job_provinceandcity VALUES('1928','扶余县','Fuyu','1189','928');
INSERT INTO job_provinceandcity VALUES('1929','前郭尔罗斯蒙古族自治县','Qianguoerluosi','1189','929');
INSERT INTO job_provinceandcity VALUES('1930','洮北区','Taobei','1194','930');
INSERT INTO job_provinceandcity VALUES('1931','大安市','Daan','1194','931');
INSERT INTO job_provinceandcity VALUES('1932','洮南市','Taonan','1194','932');
INSERT INTO job_provinceandcity VALUES('1933','镇赉县','Zhenlai','1194','933');
INSERT INTO job_provinceandcity VALUES('1934','通榆县','Tongyu','1194','934');
INSERT INTO job_provinceandcity VALUES('1935','延吉市','Yanji','1192','935');
INSERT INTO job_provinceandcity VALUES('1936','图们市','Tumen','1192','936');
INSERT INTO job_provinceandcity VALUES('1937','敦化市','Dunhua','1192','937');
INSERT INTO job_provinceandcity VALUES('1938','龙井市','Longjing','1192','938');
INSERT INTO job_provinceandcity VALUES('1939','珲春市','Hunchun','1192','939');
INSERT INTO job_provinceandcity VALUES('1940','和龙市','Helong','1192','940');
INSERT INTO job_provinceandcity VALUES('1941','安图县','Antu','1192','941');
INSERT INTO job_provinceandcity VALUES('1942','汪清县','Wangqing','1192','942');
INSERT INTO job_provinceandcity VALUES('1943','道里区','Daoli','1156','943');
INSERT INTO job_provinceandcity VALUES('1944','南岗区','Nangang','1156','944');
INSERT INTO job_provinceandcity VALUES('1945','动力区','Dongli','1156','945');
INSERT INTO job_provinceandcity VALUES('1946','平房区','Pingfang','1156','946');
INSERT INTO job_provinceandcity VALUES('1947','香坊区','Xiangfang','1156','947');
INSERT INTO job_provinceandcity VALUES('1948','松北区','Songbei','1156','948');
INSERT INTO job_provinceandcity VALUES('1949','呼兰区','Hulan','1156','949');
INSERT INTO job_provinceandcity VALUES('1950','道外区','Daowai','1156','950');
INSERT INTO job_provinceandcity VALUES('1951','阿城市','Acheng','1156','951');
INSERT INTO job_provinceandcity VALUES('1952','尚志市','Shangzhi','1156','952');
INSERT INTO job_provinceandcity VALUES('1953','双城市','Shuangcheng','1156','953');
INSERT INTO job_provinceandcity VALUES('1954','五常市','Wuchang','1156','954');
INSERT INTO job_provinceandcity VALUES('1955','方正县','Fangzheng','1156','955');
INSERT INTO job_provinceandcity VALUES('1956','宾县','Binxian','1156','956');
INSERT INTO job_provinceandcity VALUES('1957','依兰县','Yilan','1156','957');
INSERT INTO job_provinceandcity VALUES('1958','巴彦县','Bayan','1156','958');
INSERT INTO job_provinceandcity VALUES('1959','通河县','Tonghe','1156','959');
INSERT INTO job_provinceandcity VALUES('1960','木兰县','Mulan','1156','960');
INSERT INTO job_provinceandcity VALUES('1961','延寿县','Yanshou','1156','961');
INSERT INTO job_provinceandcity VALUES('1962','龙沙区','Longsha','1151','962');
INSERT INTO job_provinceandcity VALUES('1963','昂昂溪区','Angangxi','1151','963');
INSERT INTO job_provinceandcity VALUES('1964','铁峰区','Tiefeng','1151','964');
INSERT INTO job_provinceandcity VALUES('1965','建华区','Jianhua','1151','965');
INSERT INTO job_provinceandcity VALUES('1966','富拉尔基区','Fulaerji','1151','966');
INSERT INTO job_provinceandcity VALUES('1967','碾子山区','Nianzishan','1151','967');
INSERT INTO job_provinceandcity VALUES('1968','梅里斯达斡尔区','Meilisidawoer','1151','968');
INSERT INTO job_provinceandcity VALUES('1969','讷河市','Nehe','1151','969');
INSERT INTO job_provinceandcity VALUES('1970','富裕县','Fuyu','1151','970');
INSERT INTO job_provinceandcity VALUES('1971','拜泉县','Baiquan','1151','971');
INSERT INTO job_provinceandcity VALUES('1972','甘南县','Gannan','1151','972');
INSERT INTO job_provinceandcity VALUES('1973','依安县','Yian','1151','973');
INSERT INTO job_provinceandcity VALUES('1974','克山县','Keshan','1151','974');
INSERT INTO job_provinceandcity VALUES('1975','泰来县','Tailai','1151','975');
INSERT INTO job_provinceandcity VALUES('1976','克东县','Kedong','1151','976');
INSERT INTO job_provinceandcity VALUES('1977','龙江县','Longjiang','1151','977');
INSERT INTO job_provinceandcity VALUES('1978','兴山区','Xingshan','1158','978');
INSERT INTO job_provinceandcity VALUES('1979','工农区','Gongnong','1158','979');
INSERT INTO job_provinceandcity VALUES('1980','南山区','Nanshan','1158','980');
INSERT INTO job_provinceandcity VALUES('1981','兴安区','Xingan','1158','981');
INSERT INTO job_provinceandcity VALUES('1982','向阳区','Xiangyang','1158','982');
INSERT INTO job_provinceandcity VALUES('1983','东山区','Dongshan','1158','983');
INSERT INTO job_provinceandcity VALUES('1984','萝北县','Luobei','1158','984');
INSERT INTO job_provinceandcity VALUES('1985','绥滨县','Suibin','1158','985');
INSERT INTO job_provinceandcity VALUES('1986','尖山区','Jianshan','1149','986');
INSERT INTO job_provinceandcity VALUES('1987','岭东区','Lingdong','1149','987');
INSERT INTO job_provinceandcity VALUES('1988','四方台区','Sifangtai','1149','988');
INSERT INTO job_provinceandcity VALUES('1989','宝山区','Baoshan','1149','989');
INSERT INTO job_provinceandcity VALUES('1990','集贤县','Jixian','1149','990');
INSERT INTO job_provinceandcity VALUES('1991','宝清县','Baoqing','1149','991');
INSERT INTO job_provinceandcity VALUES('1992','友谊县','Youyi','1149','992');
INSERT INTO job_provinceandcity VALUES('1993','饶河县','Raohe','1149','993');
INSERT INTO job_provinceandcity VALUES('1994','鸡冠区','Jiguan','1160','994');
INSERT INTO job_provinceandcity VALUES('1995','恒山区','Hengshan','1160','995');
INSERT INTO job_provinceandcity VALUES('1996','城子河区','Chengzihe','1160','996');
INSERT INTO job_provinceandcity VALUES('1997','滴道区','Didao','1160','997');
INSERT INTO job_provinceandcity VALUES('1998','梨树区','Lishu','1160','998');
INSERT INTO job_provinceandcity VALUES('1999','麻山区','Mashan','1160','999');
INSERT INTO job_provinceandcity VALUES('2000','密山市','Mishan','1160','1000');
INSERT INTO job_provinceandcity VALUES('2001','虎林市','Hulin','1160','1001');
INSERT INTO job_provinceandcity VALUES('2002','鸡东县','Jidong','1160','1002');
INSERT INTO job_provinceandcity VALUES('2003','萨尔图区','Saertu','1154','1003');
INSERT INTO job_provinceandcity VALUES('2004','红岗区','Honggang','1154','1004');
INSERT INTO job_provinceandcity VALUES('2005','龙凤区','Longfeng','1154','1005');
INSERT INTO job_provinceandcity VALUES('2006','让胡路区','Ranghulu','1154','1006');
INSERT INTO job_provinceandcity VALUES('2007','大同区','Datong','1154','1007');
INSERT INTO job_provinceandcity VALUES('2008','林甸县','Lindian','1154','1008');
INSERT INTO job_provinceandcity VALUES('2009','肇州县','Zhaozhou','1154','1009');
INSERT INTO job_provinceandcity VALUES('2010','肇源县','Zhaoyuan','1154','1010');
INSERT INTO job_provinceandcity VALUES('2011','杜尔伯特蒙古族自治县','Duerbote','1154','1011');
INSERT INTO job_provinceandcity VALUES('2012','伊春区','Yichun','1150','1012');
INSERT INTO job_provinceandcity VALUES('2013','带岭区','Dailing','1150','1013');
INSERT INTO job_provinceandcity VALUES('2014','南岔区','Nancha','1150','1014');
INSERT INTO job_provinceandcity VALUES('2015','金山屯区','Jinshantun','1150','1015');
INSERT INTO job_provinceandcity VALUES('2016','西林区','Xilin','1150','1016');
INSERT INTO job_provinceandcity VALUES('2017','美溪区','Meixi','1150','1017');
INSERT INTO job_provinceandcity VALUES('2018','乌马河区','Wumahe','1150','1018');
INSERT INTO job_provinceandcity VALUES('2019','翠峦区','Cuiluan','1150','1019');
INSERT INTO job_provinceandcity VALUES('2020','友好区','Youhao','1150','1020');
INSERT INTO job_provinceandcity VALUES('2021','上甘岭区','Shanganling','1150','1021');
INSERT INTO job_provinceandcity VALUES('2022','五营区','Wuying','1150','1022');
INSERT INTO job_provinceandcity VALUES('2023','红星区','Hongxing','1150','1023');
INSERT INTO job_provinceandcity VALUES('2024','新青区','Xinqing','1150','1024');
INSERT INTO job_provinceandcity VALUES('2025','汤旺河区','Tangwanghe','1150','1025');
INSERT INTO job_provinceandcity VALUES('2026','乌伊岭区','Wuyiling','1150','1026');
INSERT INTO job_provinceandcity VALUES('2027','铁力市','Tieli','1150','1027');
INSERT INTO job_provinceandcity VALUES('2028','嘉荫县','Jiayin','1150','1028');
INSERT INTO job_provinceandcity VALUES('2029','爱民区','Aimin','1152','1029');
INSERT INTO job_provinceandcity VALUES('2030','东安区','Dongan','1152','1030');
INSERT INTO job_provinceandcity VALUES('2031','阳明区','Yangming','1152','1031');
INSERT INTO job_provinceandcity VALUES('2032','西安区','Xian','1152','1032');
INSERT INTO job_provinceandcity VALUES('2033','绥芬河市','Suifenhe','1152','1033');
INSERT INTO job_provinceandcity VALUES('2034','宁安市','Ningan','1152','1034');
INSERT INTO job_provinceandcity VALUES('2035','海林市','Hailin','1152','1035');
INSERT INTO job_provinceandcity VALUES('2036','穆棱市','Muleng','1152','1036');
INSERT INTO job_provinceandcity VALUES('2037','林口县','Linkou','1152','1037');
INSERT INTO job_provinceandcity VALUES('2038','东宁县','Dongning','1152','1038');
INSERT INTO job_provinceandcity VALUES('2039','前进区','Qianjin','1159','1039');
INSERT INTO job_provinceandcity VALUES('2040','永红区','Yonghong','1159','1040');
INSERT INTO job_provinceandcity VALUES('2041','向阳区','Xiangyang','1159','1041');
INSERT INTO job_provinceandcity VALUES('2042','东风区','Dongfeng','1159','1042');
INSERT INTO job_provinceandcity VALUES('2043','郊区','Suburb','1159','1043');
INSERT INTO job_provinceandcity VALUES('2044','同江市','Tongjiang','1159','1044');
INSERT INTO job_provinceandcity VALUES('2045','富锦市','Fujin','1159','1045');
INSERT INTO job_provinceandcity VALUES('2046','桦川县','Huachuan','1159','1046');
INSERT INTO job_provinceandcity VALUES('2047','抚远县','Fuyuan','1159','1047');
INSERT INTO job_provinceandcity VALUES('2048','桦南县','Huanan','1159','1048');
INSERT INTO job_provinceandcity VALUES('2049','汤原县','Tangyuan','1159','1049');
INSERT INTO job_provinceandcity VALUES('2050','桃山区','Taoshan','1153','1050');
INSERT INTO job_provinceandcity VALUES('2051','新兴区','Xinxing','1153','1051');
INSERT INTO job_provinceandcity VALUES('2052','茄子河区','Qiezihe','1153','1052');
INSERT INTO job_provinceandcity VALUES('2053','勃利县','Boli','1153','1053');
INSERT INTO job_provinceandcity VALUES('2054','爱辉区','Aihui','1157','1054');
INSERT INTO job_provinceandcity VALUES('2055','北安市','Beian','1157','1055');
INSERT INTO job_provinceandcity VALUES('2056','五大连池市','Wudalianchi','1157','1056');
INSERT INTO job_provinceandcity VALUES('2057','逊克县','Xunke','1157','1057');
INSERT INTO job_provinceandcity VALUES('2058','嫩江县','Nenjiang','1157','1058');
INSERT INTO job_provinceandcity VALUES('2059','孙吴县','Sunwu','1157','1059');
INSERT INTO job_provinceandcity VALUES('2060','北林区','Beilin','1148','1060');
INSERT INTO job_provinceandcity VALUES('2061','安达市','Anda','1148','1061');
INSERT INTO job_provinceandcity VALUES('2062','肇东市','Zhaodong','1148','1062');
INSERT INTO job_provinceandcity VALUES('2063','海伦市','Hailun','1148','1063');
INSERT INTO job_provinceandcity VALUES('2064','绥棱县','Suileng','1148','1064');
INSERT INTO job_provinceandcity VALUES('2065','兰西县','Lanxi','1148','1065');
INSERT INTO job_provinceandcity VALUES('2066','明水县','Mingshui','1148','1066');
INSERT INTO job_provinceandcity VALUES('2067','青冈县','Qinggang','1148','1067');
INSERT INTO job_provinceandcity VALUES('2068','庆安县','Qingan','1148','1068');
INSERT INTO job_provinceandcity VALUES('2069','望奎县','Wangkui','1148','1069');
INSERT INTO job_provinceandcity VALUES('2070','呼玛县','Huma','1155','1070');
INSERT INTO job_provinceandcity VALUES('2071','塔河县','Tahe','1155','1071');
INSERT INTO job_provinceandcity VALUES('2072','漠河县','Mohe','1155','1072');
INSERT INTO job_provinceandcity VALUES('2073','回民区','Huimin','1246','1073');
INSERT INTO job_provinceandcity VALUES('2074','玉泉区','Yuquan','1246','1074');
INSERT INTO job_provinceandcity VALUES('2075','新城区','Xincheng','1246','1075');
INSERT INTO job_provinceandcity VALUES('2076','赛罕区','Saihan','1246','1076');
INSERT INTO job_provinceandcity VALUES('2077','托克托县','Tuoketuo','1246','1077');
INSERT INTO job_provinceandcity VALUES('2078','清水河县','Qingshuihe','1246','1078');
INSERT INTO job_provinceandcity VALUES('2079','武川县','Wuchuan','1246','1079');
INSERT INTO job_provinceandcity VALUES('2080','和林格尔县','Helingeer','1246','1080');
INSERT INTO job_provinceandcity VALUES('2081','土默特左旗','Tumotezuo','1246','1081');
INSERT INTO job_provinceandcity VALUES('2082','昆都仑区','Kundulun','1241','1082');
INSERT INTO job_provinceandcity VALUES('2083','青山区','Qingshan','1241','1083');
INSERT INTO job_provinceandcity VALUES('2084','东河区','Donghe','1241','1084');
INSERT INTO job_provinceandcity VALUES('2085','九原区','Jiuyuan','1241','1085');
INSERT INTO job_provinceandcity VALUES('2086','石拐区','Shiguai','1241','1086');
INSERT INTO job_provinceandcity VALUES('2087','白云矿区','Baiyun Mining Area','1241','1087');
INSERT INTO job_provinceandcity VALUES('2088','固阳县','Guyang','1241','1088');
INSERT INTO job_provinceandcity VALUES('2089','土默特右旗','Tumoteyou','1241','1089');
INSERT INTO job_provinceandcity VALUES('2090','达尔罕茂明安联合旗','Daerhan','1241','1090');
INSERT INTO job_provinceandcity VALUES('2091','海勃湾区','Haibowan','1237','1091');
INSERT INTO job_provinceandcity VALUES('2092','乌达区','Wuda','1237','1092');
INSERT INTO job_provinceandcity VALUES('2093','海南区','Hainan','1237','1093');
INSERT INTO job_provinceandcity VALUES('2094','红山区','Hongshan','1243','1094');
INSERT INTO job_provinceandcity VALUES('2095','元宝山区','Yuanbaoshan','1243','1095');
INSERT INTO job_provinceandcity VALUES('2096','松山区','Songshan','1243','1096');
INSERT INTO job_provinceandcity VALUES('2097','宁城县','Ningcheng','1243','1097');
INSERT INTO job_provinceandcity VALUES('2098','林西县','Linxi','1243','1098');
INSERT INTO job_provinceandcity VALUES('2099','喀喇沁旗','Kalaqin','1243','1099');
INSERT INTO job_provinceandcity VALUES('2100','巴林左旗','Balinzuo','1243','1100');
INSERT INTO job_provinceandcity VALUES('2101','敖汉旗','Aohan','1243','1101');
INSERT INTO job_provinceandcity VALUES('2102','阿鲁科尔沁旗','Alukeerqin','1243','1102');
INSERT INTO job_provinceandcity VALUES('2103','翁牛特旗','Wengniute','1243','1103');
INSERT INTO job_provinceandcity VALUES('2104','克什克腾旗','Keshike','1243','1104');
INSERT INTO job_provinceandcity VALUES('2105','巴林右旗','Balinyou','1243','1105');
INSERT INTO job_provinceandcity VALUES('2106','科尔沁区','Keerqin','1239','1106');
INSERT INTO job_provinceandcity VALUES('2107','霍林郭勒市','Huolinguole','1239','1107');
INSERT INTO job_provinceandcity VALUES('2108','开鲁县','Kailu','1239','1108');
INSERT INTO job_provinceandcity VALUES('2109','科尔沁左翼中旗','Keerqinzuoyizhong','1239','1109');
INSERT INTO job_provinceandcity VALUES('2110','科尔沁左翼后旗','Keerqinzuoyihou','1239','1110');
INSERT INTO job_provinceandcity VALUES('2111','库伦旗','Kulun','1239','1111');
INSERT INTO job_provinceandcity VALUES('2112','奈曼旗','Naiman','1239','1112');
INSERT INTO job_provinceandcity VALUES('2113','扎鲁特旗','Zhalute','1239','1113');
INSERT INTO job_provinceandcity VALUES('2114','东胜区','Dongsheng','1244','1114');
INSERT INTO job_provinceandcity VALUES('2115','准格尔旗','Zhunger','1244','1115');
INSERT INTO job_provinceandcity VALUES('2116','乌审旗','Wushen','1244','1116');
INSERT INTO job_provinceandcity VALUES('2117','伊金霍洛旗','Yijinhuoluo','1244','1117');
INSERT INTO job_provinceandcity VALUES('2118','鄂托克旗','Etuoke','1244','1118');
INSERT INTO job_provinceandcity VALUES('2119','鄂托克前旗','Etuokeqian','1244','1119');
INSERT INTO job_provinceandcity VALUES('2120','杭锦旗','Hangjin','1244','1120');
INSERT INTO job_provinceandcity VALUES('2121','达拉特旗','Dalate','1244','1121');
INSERT INTO job_provinceandcity VALUES('2122','海拉尔区','Hailaer','1245','1122');
INSERT INTO job_provinceandcity VALUES('2123','满洲里市','Manzhouli','1245','1123');
INSERT INTO job_provinceandcity VALUES('2124','牙克石市','Yakeshi','1245','1124');
INSERT INTO job_provinceandcity VALUES('2125','扎兰屯市','Zhalantun','1245','1125');
INSERT INTO job_provinceandcity VALUES('2126','根河市','Genhe','1245','1126');
INSERT INTO job_provinceandcity VALUES('2127','额尔古纳市','Eerguna','1245','1127');
INSERT INTO job_provinceandcity VALUES('2128','陈巴尔虎旗','Chenbaerhuqi','1245','1128');
INSERT INTO job_provinceandcity VALUES('2129','阿荣旗','Arong','1245','1129');
INSERT INTO job_provinceandcity VALUES('2130','新巴尔虎左旗','Xinbaerhuzuo','1245','1130');
INSERT INTO job_provinceandcity VALUES('2131','新巴尔虎右旗','Xinbaerhuyou','1245','1131');
INSERT INTO job_provinceandcity VALUES('2132','鄂伦春自治旗','Elunchun','1245','1132');
INSERT INTO job_provinceandcity VALUES('2133','莫力达瓦达斡尔族自治旗','Molidawadawoer','1245','1133');
INSERT INTO job_provinceandcity VALUES('2134','鄂温克族自治旗','Ewenke','1245','1134');
INSERT INTO job_provinceandcity VALUES('2135','丰镇市','Fengzhen','1236','1135');
INSERT INTO job_provinceandcity VALUES('2136','集宁区','Jining','1236','1136');
INSERT INTO job_provinceandcity VALUES('2137','兴和县','Xinghe','1236','1137');
INSERT INTO job_provinceandcity VALUES('2138','卓资县','Zhuozi','1236','1138');
INSERT INTO job_provinceandcity VALUES('2139','商都县','Shangdu','1236','1139');
INSERT INTO job_provinceandcity VALUES('2140','凉城县','Liangcheng','1236','1140');
INSERT INTO job_provinceandcity VALUES('2141','化德县','Huade','1236','1141');
INSERT INTO job_provinceandcity VALUES('2142','察哈尔右翼前旗','Chahaeryouyiqian','1236','1142');
INSERT INTO job_provinceandcity VALUES('2143','察哈尔右翼中旗','Chahaeryouyizhong','1236','1143');
INSERT INTO job_provinceandcity VALUES('2144','察哈尔右翼后旗','Chahaeryouyihou','1236','1144');
INSERT INTO job_provinceandcity VALUES('2145','四子王旗','Siziwang','1236','1145');
INSERT INTO job_provinceandcity VALUES('2146','锡林浩特市','Xilinhaote','1238','1146');
INSERT INTO job_provinceandcity VALUES('2147','二连浩特市','Erlianhaote','1238','1147');
INSERT INTO job_provinceandcity VALUES('2148','多伦县','Duolun','1238','1148');
INSERT INTO job_provinceandcity VALUES('2149','阿巴嘎旗','Abaga','1238','1149');
INSERT INTO job_provinceandcity VALUES('2150','西乌珠穆沁旗','Xiwuzhumuqin','1238','1150');
INSERT INTO job_provinceandcity VALUES('2151','东乌珠穆沁旗','Dongwuzhumuqin','1238','1151');
INSERT INTO job_provinceandcity VALUES('2152','苏尼特左旗','Sunitezuo','1238','1152');
INSERT INTO job_provinceandcity VALUES('2153','苏尼特右旗','Suniteyou','1238','1153');
INSERT INTO job_provinceandcity VALUES('2154','太仆寺旗','Taipusi','1238','1154');
INSERT INTO job_provinceandcity VALUES('2155','正镶白旗','Zhengxiangbai','1238','1155');
INSERT INTO job_provinceandcity VALUES('2156','正蓝旗','Zhenglan','1238','1156');
INSERT INTO job_provinceandcity VALUES('2157','镶黄旗','Xianghuang','1238','1157');
INSERT INTO job_provinceandcity VALUES('2158','临河区','Linhe','1240','1158');
INSERT INTO job_provinceandcity VALUES('2159','五原县','Wuyuan','1240','1159');
INSERT INTO job_provinceandcity VALUES('2160','磴口县','Dengkou','1240','1160');
INSERT INTO job_provinceandcity VALUES('2161','杭锦后旗','Hangjinhou','1240','1161');
INSERT INTO job_provinceandcity VALUES('2162','乌拉特中旗','Wulatezhong','1240','1162');
INSERT INTO job_provinceandcity VALUES('2163','乌拉特前旗','Wulateqian','1240','1163');
INSERT INTO job_provinceandcity VALUES('2164','乌拉特后旗','Wulatehou','1240','1164');
INSERT INTO job_provinceandcity VALUES('2165','阿拉善左旗','Alashanzuo','1242','1165');
INSERT INTO job_provinceandcity VALUES('2166','阿拉善右旗','Alashanyou','1242','1166');
INSERT INTO job_provinceandcity VALUES('2167','额济纳旗','Ejina','1242','1167');
INSERT INTO job_provinceandcity VALUES('2168','乌兰浩特市','Wulanhaote','1235','1168');
INSERT INTO job_provinceandcity VALUES('2169','阿尔山市','Aershan','1235','1169');
INSERT INTO job_provinceandcity VALUES('2170','突泉县','Tuquan','1235','1170');
INSERT INTO job_provinceandcity VALUES('2171','扎赉特旗','Zhalaite','1235','1171');
INSERT INTO job_provinceandcity VALUES('2172','科尔沁右翼前旗','Keerqinyouyiqian','1235','1172');
INSERT INTO job_provinceandcity VALUES('2173','科尔沁右翼中旗','Keerqinyouyizhong','1235','1173');
INSERT INTO job_provinceandcity VALUES('2174','玄武区','Xuanwu','1207','1174');
INSERT INTO job_provinceandcity VALUES('2175','鼓楼区','Gulou','1207','1175');
INSERT INTO job_provinceandcity VALUES('2176','建邺区','Jianye','1207','1176');
INSERT INTO job_provinceandcity VALUES('2177','白下区','Baixia','1207','1177');
INSERT INTO job_provinceandcity VALUES('2178','秦淮区','Qinhuai','1207','1178');
INSERT INTO job_provinceandcity VALUES('2179','下关区','Xiaguan','1207','1179');
INSERT INTO job_provinceandcity VALUES('2180','雨花台区','Yuhuatai','1207','1180');
INSERT INTO job_provinceandcity VALUES('2181','浦口区','Pukou','1207','1181');
INSERT INTO job_provinceandcity VALUES('2182','栖霞区','Qixia','1207','1182');
INSERT INTO job_provinceandcity VALUES('2183','大厂区','Dachang','1207','1183');
INSERT INTO job_provinceandcity VALUES('2184','江宁区','Jiangning','1207','1184');
INSERT INTO job_provinceandcity VALUES('2185','溧水县','Lishui','1207','1185');
INSERT INTO job_provinceandcity VALUES('2186','高淳县','Gaochun','1207','1186');
INSERT INTO job_provinceandcity VALUES('2187','六合县','Liuhe','1207','1187');
INSERT INTO job_provinceandcity VALUES('2188','江浦县','Jiangpu','1207','1188');
INSERT INTO job_provinceandcity VALUES('2189','云龙区','Yunlong','1198','1189');
INSERT INTO job_provinceandcity VALUES('2190','鼓楼区','Gulou','1198','1190');
INSERT INTO job_provinceandcity VALUES('2191','九里区','Jiuli','1198','1191');
INSERT INTO job_provinceandcity VALUES('2192','贾汪区','Jiawang','1198','1192');
INSERT INTO job_provinceandcity VALUES('2193','贾汪区','Jiawang','1198','1193');
INSERT INTO job_provinceandcity VALUES('2194','邳州市','Pizhou','1198','1194');
INSERT INTO job_provinceandcity VALUES('2195','新沂市','Xinyi','1198','1195');
INSERT INTO job_provinceandcity VALUES('2196','铜山县','Tongshan','1198','1196');
INSERT INTO job_provinceandcity VALUES('2197','睢宁县','Suining','1198','1197');
INSERT INTO job_provinceandcity VALUES('2198','沛县','Peixian','1198','1198');
INSERT INTO job_provinceandcity VALUES('2199','丰县','Fengxian','1198','1199');
INSERT INTO job_provinceandcity VALUES('2200','新浦区','Xinpu','1197','1200');
INSERT INTO job_provinceandcity VALUES('2201','连云区','Lianyun','1197','1201');
INSERT INTO job_provinceandcity VALUES('2202','海州区','Haizhou','1197','1202');
INSERT INTO job_provinceandcity VALUES('2203','东海县','Donghai','1197','1203');
INSERT INTO job_provinceandcity VALUES('2204','灌云县','Guanyun','1197','1204');
INSERT INTO job_provinceandcity VALUES('2205','赣榆县','Ganyu','1197','1205');
INSERT INTO job_provinceandcity VALUES('2206','灌南县','Guannan','1197','1206');
INSERT INTO job_provinceandcity VALUES('2207','清河区','Qinghe','1209','1207');
INSERT INTO job_provinceandcity VALUES('2208','清浦区','Qingpu','1209','1208');
INSERT INTO job_provinceandcity VALUES('2209','楚州区','Chuzhou','1209','1209');
INSERT INTO job_provinceandcity VALUES('2210','淮阴区','Huaiyin','1209','1210');
INSERT INTO job_provinceandcity VALUES('2211','涟水县','Lianshui','1209','1211');
INSERT INTO job_provinceandcity VALUES('2212','洪泽县','Hongze','1209','1212');
INSERT INTO job_provinceandcity VALUES('2213','金湖县','Jinhu','1209','1213');
INSERT INTO job_provinceandcity VALUES('2214','盱眙县','Xuyi','1209','1214');
INSERT INTO job_provinceandcity VALUES('2215','宿城区','Sucheng','1200','1215');
INSERT INTO job_provinceandcity VALUES('2216','宿豫县','Suyu','1200','1216');
INSERT INTO job_provinceandcity VALUES('2217','沭阳县','Shuyang','1200','1217');
INSERT INTO job_provinceandcity VALUES('2218','泗阳县','Siyang','1200','1218');
INSERT INTO job_provinceandcity VALUES('2219','泗洪县','Sihong','1200','1219');
INSERT INTO job_provinceandcity VALUES('2220','城区','Urban Area','1204','1220');
INSERT INTO job_provinceandcity VALUES('2221','东台市','Dongtai','1204','1221');
INSERT INTO job_provinceandcity VALUES('2222','大丰市','Dafeng','1204','1222');
INSERT INTO job_provinceandcity VALUES('2223','盐都县','Yandu','1204','1223');
INSERT INTO job_provinceandcity VALUES('2224','建湖县','Jianhu','1204','1224');
INSERT INTO job_provinceandcity VALUES('2225','响水县','Xiangshui','1204','1225');
INSERT INTO job_provinceandcity VALUES('2226','阜宁县','Funing','1204','1226');
INSERT INTO job_provinceandcity VALUES('2227','射阳县','Sheyang','1204','1227');
INSERT INTO job_provinceandcity VALUES('2228','滨海县','Binhai','1204','1228');
INSERT INTO job_provinceandcity VALUES('2229','广陵区','Guangling','1203','1229');
INSERT INTO job_provinceandcity VALUES('2230','维扬区','Weiyang','1203','1230');
INSERT INTO job_provinceandcity VALUES('2231','邗江区','Hanjiang','1203','1231');
INSERT INTO job_provinceandcity VALUES('2232','高邮市','Gaoyou','1203','1232');
INSERT INTO job_provinceandcity VALUES('2233','江都市','Jiangdu','1203','1233');
INSERT INTO job_provinceandcity VALUES('2234','仪征市','Yizheng','1203','1234');
INSERT INTO job_provinceandcity VALUES('2235','宝应县','Baoying','1203','1235');
INSERT INTO job_provinceandcity VALUES('2236','海陵区','Hailing','1201','1236');
INSERT INTO job_provinceandcity VALUES('2237','高港区','Gaogang','1201','1237');
INSERT INTO job_provinceandcity VALUES('2238','泰兴市','Taixing','1201','1238');
INSERT INTO job_provinceandcity VALUES('2239','姜堰市','Jiangyan','1201','1239');
INSERT INTO job_provinceandcity VALUES('2240','靖江市','Jingjiang','1201','1240');
INSERT INTO job_provinceandcity VALUES('2241','兴化市','Xinghua','1201','1241');
INSERT INTO job_provinceandcity VALUES('2242','崇川区','Chongchuan','1206','1242');
INSERT INTO job_provinceandcity VALUES('2243','港闸区','Gangzha','1206','1243');
INSERT INTO job_provinceandcity VALUES('2244','如皋市','Rugao','1206','1244');
INSERT INTO job_provinceandcity VALUES('2245','通州市','Tongzhou','1206','1245');
INSERT INTO job_provinceandcity VALUES('2246','海门市','Haimen','1206','1246');
INSERT INTO job_provinceandcity VALUES('2247','启东市','Qidong','1206','1247');
INSERT INTO job_provinceandcity VALUES('2248','海安县','Haian','1206','1248');
INSERT INTO job_provinceandcity VALUES('2249','如东县','Rudong','1206','1249');
INSERT INTO job_provinceandcity VALUES('2250','京口区','Jingkou','1205','1250');
INSERT INTO job_provinceandcity VALUES('2251','润州区','Runzhou','1205','1251');
INSERT INTO job_provinceandcity VALUES('2252','丹阳市','Danyang','1205','1252');
INSERT INTO job_provinceandcity VALUES('2253','扬中市','Yangzhong','1205','1253');
INSERT INTO job_provinceandcity VALUES('2254','句容市','Jurong','1205','1254');
INSERT INTO job_provinceandcity VALUES('2255','丹徒县','Dantu','1205','1255');
INSERT INTO job_provinceandcity VALUES('2256','钟楼区','Zhonglou','1208','1256');
INSERT INTO job_provinceandcity VALUES('2257','天宁区','Tianning','1208','1257');
INSERT INTO job_provinceandcity VALUES('2258','戚墅堰区','Qishuyan','1208','1258');
INSERT INTO job_provinceandcity VALUES('2259','郊区','Suburb','1208','1259');
INSERT INTO job_provinceandcity VALUES('2260','金坛市','Jintan','1208','1260');
INSERT INTO job_provinceandcity VALUES('2261','溧阳市','Liyang','1208','1261');
INSERT INTO job_provinceandcity VALUES('2262','武进市','Wujin','1208','1262');
INSERT INTO job_provinceandcity VALUES('2263','崇安区','Chongan','1202','1263');
INSERT INTO job_provinceandcity VALUES('2264','北塘区','Beitang','1202','1264');
INSERT INTO job_provinceandcity VALUES('2265','南长区','Nanchang','1202','1265');
INSERT INTO job_provinceandcity VALUES('2266','锡山区','Xishan','1202','1266');
INSERT INTO job_provinceandcity VALUES('2267','惠山区','Huishan','1202','1267');
INSERT INTO job_provinceandcity VALUES('2268','滨湖区','Binhu','1202','1268');
INSERT INTO job_provinceandcity VALUES('2269','江阴市','Jiangyin','1202','1269');
INSERT INTO job_provinceandcity VALUES('2270','宜兴市','Yixing','1202','1270');
INSERT INTO job_provinceandcity VALUES('2271','沧浪区','Canglang','1199','1271');
INSERT INTO job_provinceandcity VALUES('2272','金阊区','Jinchang','1199','1272');
INSERT INTO job_provinceandcity VALUES('2273','平江区','Pingjiang','1199','1273');
INSERT INTO job_provinceandcity VALUES('2274','虎丘区','Huqiu','1199','1274');
INSERT INTO job_provinceandcity VALUES('2275','吴中区','Wuzhong','1199','1275');
INSERT INTO job_provinceandcity VALUES('2276','相城区','Xiangcheng','1199','1276');
INSERT INTO job_provinceandcity VALUES('2277','常熟市','Changshu','1199','1277');
INSERT INTO job_provinceandcity VALUES('2278','张家港市','Zhangjiagang','1199','1278');
INSERT INTO job_provinceandcity VALUES('2279','太仓市','Taicang','1199','1279');
INSERT INTO job_provinceandcity VALUES('2280','昆山市','Kunshan','1199','1280');
INSERT INTO job_provinceandcity VALUES('2281','吴江市','Wujiang','1199','1281');
INSERT INTO job_provinceandcity VALUES('2282','拱墅区','Gongshu','1360','1282');
INSERT INTO job_provinceandcity VALUES('2283','西湖区','Xihu','1360','1283');
INSERT INTO job_provinceandcity VALUES('2284','上城区','Shangcheng','1360','1284');
INSERT INTO job_provinceandcity VALUES('2285','下城区','Xiacheng','1360','1285');
INSERT INTO job_provinceandcity VALUES('2286','江干区','Jianggan','1360','1286');
INSERT INTO job_provinceandcity VALUES('2287','滨江区','Binjiang','1360','1287');
INSERT INTO job_provinceandcity VALUES('2288','余杭区','Yuhang','1360','1288');
INSERT INTO job_provinceandcity VALUES('2289','萧山区','Xiaoshan','1360','1289');
INSERT INTO job_provinceandcity VALUES('2290','建德市','Jiande','1360','1290');
INSERT INTO job_provinceandcity VALUES('2291','富阳市','Fuyang','1360','1291');
INSERT INTO job_provinceandcity VALUES('2292','临安市','Linan','1360','1292');
INSERT INTO job_provinceandcity VALUES('2293','桐庐县','Tonglu','1360','1293');
INSERT INTO job_provinceandcity VALUES('2294','淳安县','Chunan','1360','1294');
INSERT INTO job_provinceandcity VALUES('2295','海曙区','Haishu','1358','1295');
INSERT INTO job_provinceandcity VALUES('2296','江东区','Jiangdong','1358','1296');
INSERT INTO job_provinceandcity VALUES('2297','江北区','Jiangbei','1358','1297');
INSERT INTO job_provinceandcity VALUES('2298','镇海区','Zhenhai','1358','1298');
INSERT INTO job_provinceandcity VALUES('2299','北仑区','Beilun','1358','1299');
INSERT INTO job_provinceandcity VALUES('2300','鄞州区','Yinzhou','1358','1300');
INSERT INTO job_provinceandcity VALUES('2301','余姚市','Yuyao','1358','1301');
INSERT INTO job_provinceandcity VALUES('2302','慈溪市','Cixi','1358','1302');
INSERT INTO job_provinceandcity VALUES('2303','奉化市','Fenghua','1358','1303');
INSERT INTO job_provinceandcity VALUES('2304','宁海县','Ninghai','1358','1304');
INSERT INTO job_provinceandcity VALUES('2305','象山县','Xiangshan','1358','1305');
INSERT INTO job_provinceandcity VALUES('2306','鹿城区','Lucheng','1356','1306');
INSERT INTO job_provinceandcity VALUES('2307','龙湾区','Longwan','1356','1307');
INSERT INTO job_provinceandcity VALUES('2308','瓯海区','Ouhai','1356','1308');
INSERT INTO job_provinceandcity VALUES('2309','瑞安市','Ruian','1356','1309');
INSERT INTO job_provinceandcity VALUES('2310','乐清市','Yueqing','1356','1310');
INSERT INTO job_provinceandcity VALUES('2311','永嘉县','Yongjia','1356','1311');
INSERT INTO job_provinceandcity VALUES('2312','洞头县','Dongtou','1356','1312');
INSERT INTO job_provinceandcity VALUES('2313','平阳县','Pingyang','1356','1313');
INSERT INTO job_provinceandcity VALUES('2314','苍南县','Cangnan','1356','1314');
INSERT INTO job_provinceandcity VALUES('2315','文成县','Wencheng','1356','1315');
INSERT INTO job_provinceandcity VALUES('2316','泰顺县','Taishun','1356','1316');
INSERT INTO job_provinceandcity VALUES('2317','秀城区','Xiucheng','1362','1317');
INSERT INTO job_provinceandcity VALUES('2318','秀洲区','Xiuzhou','1362','1318');
INSERT INTO job_provinceandcity VALUES('2319','海宁市','Haining','1362','1319');
INSERT INTO job_provinceandcity VALUES('2320','平湖市','Pinghu','1362','1320');
INSERT INTO job_provinceandcity VALUES('2321','桐乡市','Tongxiang','1362','1321');
INSERT INTO job_provinceandcity VALUES('2322','嘉善县','Jiashan','1362','1322');
INSERT INTO job_provinceandcity VALUES('2323','海盐县','Haiyan','1362','1323');
INSERT INTO job_provinceandcity VALUES('2324','吴兴区','Wuxing','1361','1324');
INSERT INTO job_provinceandcity VALUES('2325','南浔区','Nanxun','1361','1325');
INSERT INTO job_provinceandcity VALUES('2326','长兴县','Changxing','1361','1326');
INSERT INTO job_provinceandcity VALUES('2327','德清县','Deqing','1361','1327');
INSERT INTO job_provinceandcity VALUES('2328','安吉县','Anji','1361','1328');
INSERT INTO job_provinceandcity VALUES('2329','越城区','Yuecheng','1355','1329');
INSERT INTO job_provinceandcity VALUES('2330','诸暨市','Zhuji','1355','1330');
INSERT INTO job_provinceandcity VALUES('2331','上虞市','Shangyu','1355','1331');
INSERT INTO job_provinceandcity VALUES('2332','嵊州市','Shengzhou','1355','1332');
INSERT INTO job_provinceandcity VALUES('2333','绍兴县','Shaoxing','1355','1333');
INSERT INTO job_provinceandcity VALUES('2334','新昌县','Xinchang','1355','1334');
INSERT INTO job_provinceandcity VALUES('2335','婺城区','Wucheng','1363','1335');
INSERT INTO job_provinceandcity VALUES('2336','金东区','Jindong','1363','1336');
INSERT INTO job_provinceandcity VALUES('2337','兰溪市','Lanxi','1363','1337');
INSERT INTO job_provinceandcity VALUES('2338','义乌市','Yiwu','1363','1338');
INSERT INTO job_provinceandcity VALUES('2339','东阳市','Dongyang','1363','1339');
INSERT INTO job_provinceandcity VALUES('2340','永康市','Yongkang','1363','1340');
INSERT INTO job_provinceandcity VALUES('2341','武义县','Wuyi','1363','1341');
INSERT INTO job_provinceandcity VALUES('2342','浦江县','Pujiang','1363','1342');
INSERT INTO job_provinceandcity VALUES('2343','磐安县','Panan','1363','1343');
INSERT INTO job_provinceandcity VALUES('2344','柯城区','Kecheng','1353','1344');
INSERT INTO job_provinceandcity VALUES('2345','衢江区','Qujiang','1353','1345');
INSERT INTO job_provinceandcity VALUES('2346','江山市','Jiangshan','1353','1346');
INSERT INTO job_provinceandcity VALUES('2347','龙游县','Longyou','1353','1347');
INSERT INTO job_provinceandcity VALUES('2348','常山县','Changshan','1353','1348');
INSERT INTO job_provinceandcity VALUES('2349','开化县','Kaihua','1353','1349');
INSERT INTO job_provinceandcity VALUES('2350','定海区','Dinghai','1359','1350');
INSERT INTO job_provinceandcity VALUES('2351','普陀区','Putuo','1359','1351');
INSERT INTO job_provinceandcity VALUES('2352','岱山县','Daishan','1359','1352');
INSERT INTO job_provinceandcity VALUES('2353','嵊泗县','Shengsi','1359','1353');
INSERT INTO job_provinceandcity VALUES('2354','椒江区','Jiaojiang','1357','1354');
INSERT INTO job_provinceandcity VALUES('2355','黄岩区','Huangyan','1357','1355');
INSERT INTO job_provinceandcity VALUES('2356','路桥区','Luqiao','1357','1356');
INSERT INTO job_provinceandcity VALUES('2357','临海市','Linhai','1357','1357');
INSERT INTO job_provinceandcity VALUES('2358','温岭市','Wenling','1357','1358');
INSERT INTO job_provinceandcity VALUES('2359','玉环县','Yuhuan','1357','1359');
INSERT INTO job_provinceandcity VALUES('2360','天台县','Tiantai','1357','1360');
INSERT INTO job_provinceandcity VALUES('2361','仙居县','Xianju','1357','1361');
INSERT INTO job_provinceandcity VALUES('2362','三门县','Sanmen','1357','1362');
INSERT INTO job_provinceandcity VALUES('2363','莲都区','Liandu','1354','1363');
INSERT INTO job_provinceandcity VALUES('2364','龙泉市','Longquan','1354','1364');
INSERT INTO job_provinceandcity VALUES('2365','缙云县','Jinyun','1354','1365');
INSERT INTO job_provinceandcity VALUES('2366','青田县','Qingtian','1354','1366');
INSERT INTO job_provinceandcity VALUES('2367','云和县','Yunhe','1354','1367');
INSERT INTO job_provinceandcity VALUES('2368','遂昌县','Suichang','1354','1368');
INSERT INTO job_provinceandcity VALUES('2369','松阳县','Songyang','1354','1369');
INSERT INTO job_provinceandcity VALUES('2370','庆元县','Qingyuan','1354','1370');
INSERT INTO job_provinceandcity VALUES('2371','景宁畲族自治县','Jingning','1354','1371');
INSERT INTO job_provinceandcity VALUES('2372','庐阳区','Luyang','1047','1372');
INSERT INTO job_provinceandcity VALUES('2373','瑶海区','Yaohai','1047','1373');
INSERT INTO job_provinceandcity VALUES('2374','蜀山区','Shushan','1047','1374');
INSERT INTO job_provinceandcity VALUES('2375','包河区','Baohe','1047','1375');
INSERT INTO job_provinceandcity VALUES('2376','长丰县','Changfeng','1047','1376');
INSERT INTO job_provinceandcity VALUES('2377','肥东县','Feidong','1047','1377');
INSERT INTO job_provinceandcity VALUES('2378','肥西县','Feixi','1047','1378');
INSERT INTO job_provinceandcity VALUES('2379','镜湖区','Jinghu','1039','1379');
INSERT INTO job_provinceandcity VALUES('2380','新芜区','Xinwu','1039','1380');
INSERT INTO job_provinceandcity VALUES('2381','马塘区','Matang','1039','1381');
INSERT INTO job_provinceandcity VALUES('2382','鸠江区','Jiujiang','1039','1382');
INSERT INTO job_provinceandcity VALUES('2383','芜湖县','Wuhu','1039','1383');
INSERT INTO job_provinceandcity VALUES('2384','南陵县','Nanling','1039','1384');
INSERT INTO job_provinceandcity VALUES('2385','繁昌县','Fanchang','1039','1385');
INSERT INTO job_provinceandcity VALUES('2386','中市区','Zhongshi','1041','1386');
INSERT INTO job_provinceandcity VALUES('2387','东市区','Dongshi','1041','1387');
INSERT INTO job_provinceandcity VALUES('2388','西市区','Xishi','1041','1388');
INSERT INTO job_provinceandcity VALUES('2389','郊区','Suburb','1041','1389');
INSERT INTO job_provinceandcity VALUES('2390','怀远县','Huaiyuan','1041','1390');
INSERT INTO job_provinceandcity VALUES('2391','固镇县','Guzhen','1041','1391');
INSERT INTO job_provinceandcity VALUES('2392','五河县','Wuhe','1041','1392');
INSERT INTO job_provinceandcity VALUES('2393','田家庵区','Tianjiaan','1049','1393');
INSERT INTO job_provinceandcity VALUES('2394','大通区','Datong','1049','1394');
INSERT INTO job_provinceandcity VALUES('2395','谢家集区','Xiejiaji','1049','1395');
INSERT INTO job_provinceandcity VALUES('2396','八公山区','Bagongshan','1049','1396');
INSERT INTO job_provinceandcity VALUES('2397','潘集区','Panji','1049','1397');
INSERT INTO job_provinceandcity VALUES('2398','凤台县','Fengtai','1049','1398');
INSERT INTO job_provinceandcity VALUES('2399','雨山区','Yushan','1034','1399');
INSERT INTO job_provinceandcity VALUES('2400','花山区','Huashan','1034','1400');
INSERT INTO job_provinceandcity VALUES('2401','金家庄区','Jinjiazhuang','1034','1401');
INSERT INTO job_provinceandcity VALUES('2402','当涂县','Dangtu','1034','1402');
INSERT INTO job_provinceandcity VALUES('2403','相山区','Xiangshan','1050','1403');
INSERT INTO job_provinceandcity VALUES('2404','杜集区','Duji','1050','1404');
INSERT INTO job_provinceandcity VALUES('2405','烈山区','Lieshan','1050','1405');
INSERT INTO job_provinceandcity VALUES('2406','濉溪县','Suixi','1050','1406');
INSERT INTO job_provinceandcity VALUES('2407','铜官山区','Tongguanshan','1038','1407');
INSERT INTO job_provinceandcity VALUES('2408','狮子山区','Shizishan','1038','1408');
INSERT INTO job_provinceandcity VALUES('2409','郊区','Suburb','1038','1409');
INSERT INTO job_provinceandcity VALUES('2410','铜陵县','Tongling','1038','1410');
INSERT INTO job_provinceandcity VALUES('2411','迎江区','Yingjiang','1042','1411');
INSERT INTO job_provinceandcity VALUES('2412','大观区','Daguan','1042','1412');
INSERT INTO job_provinceandcity VALUES('2413','郊区','Suburb','1042','1413');
INSERT INTO job_provinceandcity VALUES('2414','桐城市','Tongcheng','1042','1414');
INSERT INTO job_provinceandcity VALUES('2415','宿松县','Susong','1042','1415');
INSERT INTO job_provinceandcity VALUES('2416','枞阳县','Zongyang','1042','1416');
INSERT INTO job_provinceandcity VALUES('2417','太湖县','Taihu','1042','1417');
INSERT INTO job_provinceandcity VALUES('2418','怀宁县','Huaining','1042','1418');
INSERT INTO job_provinceandcity VALUES('2419','岳西县','Yuexi','1042','1419');
INSERT INTO job_provinceandcity VALUES('2420','望江县','Wangjiang','1042','1420');
INSERT INTO job_provinceandcity VALUES('2421','潜山县','Qianshan','1042','1421');
INSERT INTO job_provinceandcity VALUES('2422','屯溪区','Tunxi','1048','1422');
INSERT INTO job_provinceandcity VALUES('2423','黄山区','Huangshan','1048','1423');
INSERT INTO job_provinceandcity VALUES('2424','徽州区','Huizhou','1048','1424');
INSERT INTO job_provinceandcity VALUES('2425','休宁县','Xiuning','1048','1425');
INSERT INTO job_provinceandcity VALUES('2426','歙县','Shexian','1048','1426');
INSERT INTO job_provinceandcity VALUES('2427','祁门县','Qimen','1048','1427');
INSERT INTO job_provinceandcity VALUES('2428','黟县','Yixian','1048','1428');
INSERT INTO job_provinceandcity VALUES('2429','琅琊区','Langya','1043','1429');
INSERT INTO job_provinceandcity VALUES('2430','南谯区','Nanqiao','1043','1430');
INSERT INTO job_provinceandcity VALUES('2431','天长市','Tianchang','1043','1431');
INSERT INTO job_provinceandcity VALUES('2432','明光市','Mingguang','1043','1432');
INSERT INTO job_provinceandcity VALUES('2433','全椒县','Quanjiao','1043','1433');
INSERT INTO job_provinceandcity VALUES('2434','来安县','Laian','1043','1434');
INSERT INTO job_provinceandcity VALUES('2435','定远县','Dingyuan','1043','1435');
INSERT INTO job_provinceandcity VALUES('2436','凤阳县','Fengyang','1043','1436');
INSERT INTO job_provinceandcity VALUES('2437','颖州区','Yingzhou','1045','1437');
INSERT INTO job_provinceandcity VALUES('2438','颖东区','Yingdong','1045','1438');
INSERT INTO job_provinceandcity VALUES('2439','颖泉区','Yingquan','1045','1439');
INSERT INTO job_provinceandcity VALUES('2440','界首市','Jieshou','1045','1440');
INSERT INTO job_provinceandcity VALUES('2441','临泉县','Linquan','1045','1441');
INSERT INTO job_provinceandcity VALUES('2442','颖上县','Yingshang','1045','1442');
INSERT INTO job_provinceandcity VALUES('2443','阜南县','Funan','1045','1443');
INSERT INTO job_provinceandcity VALUES('2444','太和县','Taihe','1045','1444');
INSERT INTO job_provinceandcity VALUES('2445','?桥区','Yongqiao','1037','1445');
INSERT INTO job_provinceandcity VALUES('2446','萧县','Xianxian','1037','1446');
INSERT INTO job_provinceandcity VALUES('2447','泗县','Sixian','1037','1447');
INSERT INTO job_provinceandcity VALUES('2448','砀山县','Dangshan','1037','1448');
INSERT INTO job_provinceandcity VALUES('2449','灵璧县','Lingbi','1037','1449');
INSERT INTO job_provinceandcity VALUES('2450','居巢区','Juchao','1044','1450');
INSERT INTO job_provinceandcity VALUES('2451','含山县','Hanshan','1044','1451');
INSERT INTO job_provinceandcity VALUES('2452','无为县','Wuwei','1044','1452');
INSERT INTO job_provinceandcity VALUES('2453','庐江县','Lujiang','1044','1453');
INSERT INTO job_provinceandcity VALUES('2454','和县','Hexian','1044','1454');
INSERT INTO job_provinceandcity VALUES('2455','金安区','Jinan','1035','1455');
INSERT INTO job_provinceandcity VALUES('2456','裕安区','Yuan','1035','1456');
INSERT INTO job_provinceandcity VALUES('2457','寿县','Shouxian','1035','1457');
INSERT INTO job_provinceandcity VALUES('2458','霍山县','Huoshan','1035','1458');
INSERT INTO job_provinceandcity VALUES('2459','霍邱县','Huoqiu','1035','1459');
INSERT INTO job_provinceandcity VALUES('2460','舒城县','Shucheng','1035','1460');
INSERT INTO job_provinceandcity VALUES('2461','金寨县','Jinzhai','1035','1461');
INSERT INTO job_provinceandcity VALUES('2462','谯城区','Qiaocheng','1040','1462');
INSERT INTO job_provinceandcity VALUES('2463','利辛县','Lixin','1040','1463');
INSERT INTO job_provinceandcity VALUES('2464','涡阳县','Guoyang','1040','1464');
INSERT INTO job_provinceandcity VALUES('2465','蒙城县','Mengcheng','1040','1465');
INSERT INTO job_provinceandcity VALUES('2466','宣州区','Xuanzhou','1036','1466');
INSERT INTO job_provinceandcity VALUES('2467','宁国市','Ningguo','1036','1467');
INSERT INTO job_provinceandcity VALUES('2468','广德县','Guangde','1036','1468');
INSERT INTO job_provinceandcity VALUES('2469','郎溪县','Langxi','1036','1469');
INSERT INTO job_provinceandcity VALUES('2470','泾县','Jingxian','1036','1470');
INSERT INTO job_provinceandcity VALUES('2471','旌德县','Jingde','1036','1471');
INSERT INTO job_provinceandcity VALUES('2472','绩溪县','Jixi','1036','1472');
INSERT INTO job_provinceandcity VALUES('2473','贵池区','Guichi','1046','1473');
INSERT INTO job_provinceandcity VALUES('2474','东至县','Dongzhi','1046','1474');
INSERT INTO job_provinceandcity VALUES('2475','石台县','Shitai','1046','1475');
INSERT INTO job_provinceandcity VALUES('2476','青阳县','Qingyang','1046','1476');
INSERT INTO job_provinceandcity VALUES('2477','鼓楼区','Gulou','1059','1477');
INSERT INTO job_provinceandcity VALUES('2478','台江区','Taijiang','1059','1478');
INSERT INTO job_provinceandcity VALUES('2479','仓山区','Cangshan','1059','1479');
INSERT INTO job_provinceandcity VALUES('2480','马尾区','Mawei','1059','1480');
INSERT INTO job_provinceandcity VALUES('2481','晋安区','Jinan','1059','1481');
INSERT INTO job_provinceandcity VALUES('2482','福清市','Fuqing','1059','1482');
INSERT INTO job_provinceandcity VALUES('2483','长乐市','Changle','1059','1483');
INSERT INTO job_provinceandcity VALUES('2484','闽侯县','Minhou','1059','1484');
INSERT INTO job_provinceandcity VALUES('2485','闽清县','Minqing','1059','1485');
INSERT INTO job_provinceandcity VALUES('2486','永泰县','Yongtai','1059','1486');
INSERT INTO job_provinceandcity VALUES('2487','连江县','Lianjiang','1059','1487');
INSERT INTO job_provinceandcity VALUES('2488','罗源县','Luoyuan','1059','1488');
INSERT INTO job_provinceandcity VALUES('2489','平潭县','Pingtan','1059','1489');
INSERT INTO job_provinceandcity VALUES('2490','集美区','Jimei','1054','1490');
INSERT INTO job_provinceandcity VALUES('2491','海沧区','Haicang','1054','1491');
INSERT INTO job_provinceandcity VALUES('2492','思明区','Siming','1054','1492');
INSERT INTO job_provinceandcity VALUES('2493','湖里区','Huli','1054','1493');
INSERT INTO job_provinceandcity VALUES('2494','同安区','Tongan','1054','1494');
INSERT INTO job_provinceandcity VALUES('2495','翔安区','Xiangan','1054','1495');
INSERT INTO job_provinceandcity VALUES('2496','梅列区','Meilie','1052','1496');
INSERT INTO job_provinceandcity VALUES('2497','三元区','Sanyuan','1052','1497');
INSERT INTO job_provinceandcity VALUES('2498','永安市','Yongan','1052','1498');
INSERT INTO job_provinceandcity VALUES('2499','明溪县','Mingxi','1052','1499');
INSERT INTO job_provinceandcity VALUES('2500','将乐县','Jiangle','1052','1500');
INSERT INTO job_provinceandcity VALUES('2501','大田县','Datian','1052','1501');
INSERT INTO job_provinceandcity VALUES('2502','宁化县','Ninghua','1052','1502');
INSERT INTO job_provinceandcity VALUES('2503','建宁县','Jianning','1052','1503');
INSERT INTO job_provinceandcity VALUES('2504','沙县','Shaxian','1052','1504');
INSERT INTO job_provinceandcity VALUES('2505','尤溪县','Youxi','1052','1505');
INSERT INTO job_provinceandcity VALUES('2506','清流县','Qingliu','1052','1506');
INSERT INTO job_provinceandcity VALUES('2507','泰宁县','Taining','1052','1507');
INSERT INTO job_provinceandcity VALUES('2508','城厢区','Changxiang','1056','1508');
INSERT INTO job_provinceandcity VALUES('2509','涵江区','Hanjiang','1056','1509');
INSERT INTO job_provinceandcity VALUES('2510','荔城区','Licheng','1056','1510');
INSERT INTO job_provinceandcity VALUES('2511','秀屿区','Xiuyu','1056','1511');
INSERT INTO job_provinceandcity VALUES('2512','仙游县','Xianyou','1056','1512');
INSERT INTO job_provinceandcity VALUES('2513','鲤城区','Licheng','1053','1513');
INSERT INTO job_provinceandcity VALUES('2514','丰泽区','Fengze','1053','1514');
INSERT INTO job_provinceandcity VALUES('2515','洛江区','Luojiang','1053','1515');
INSERT INTO job_provinceandcity VALUES('2516','泉港区','Quangang','1053','1516');
INSERT INTO job_provinceandcity VALUES('2517','石狮市','Shishi','1053','1517');
INSERT INTO job_provinceandcity VALUES('2518','晋江市','Jinjiang','1053','1518');
INSERT INTO job_provinceandcity VALUES('2519','南安市','Nanan','1053','1519');
INSERT INTO job_provinceandcity VALUES('2520','惠安县','Huian','1053','1520');
INSERT INTO job_provinceandcity VALUES('2521','永春县','Yongchun','1053','1521');
INSERT INTO job_provinceandcity VALUES('2522','安溪县','Anxi','1053','1522');
INSERT INTO job_provinceandcity VALUES('2523','德化县','Dehua','1053','1523');
INSERT INTO job_provinceandcity VALUES('2524','金门县','Jinmen','1053','1524');
INSERT INTO job_provinceandcity VALUES('2525','芗城区','Xiangcheng','1055','1525');
INSERT INTO job_provinceandcity VALUES('2526','龙文区','Longwen','1055','1526');
INSERT INTO job_provinceandcity VALUES('2527','龙海市','Longhai','1055','1527');
INSERT INTO job_provinceandcity VALUES('2528','平和县','Pinghe','1055','1528');
INSERT INTO job_provinceandcity VALUES('2529','南靖县','Nanjing','1055','1529');
INSERT INTO job_provinceandcity VALUES('2530','诏安县','Zhaoan','1055','1530');
INSERT INTO job_provinceandcity VALUES('2531','漳浦县','Zhangpu','1055','1531');
INSERT INTO job_provinceandcity VALUES('2532','华安县','Huaan','1055','1532');
INSERT INTO job_provinceandcity VALUES('2533','东山县','Dongshan','1055','1533');
INSERT INTO job_provinceandcity VALUES('2534','长泰县','Changtai','1055','1534');
INSERT INTO job_provinceandcity VALUES('2535','云霄县','Yunxiao','1055','1535');
INSERT INTO job_provinceandcity VALUES('2536','延平区','Yanping','1057','1536');
INSERT INTO job_provinceandcity VALUES('2537','建瓯市','Jianou','1057','1537');
INSERT INTO job_provinceandcity VALUES('2538','邵武市','Shaowu','1057','1538');
INSERT INTO job_provinceandcity VALUES('2539','武夷山市','Wuyishan','1057','1539');
INSERT INTO job_provinceandcity VALUES('2540','建阳市','Jianyang','1057','1540');
INSERT INTO job_provinceandcity VALUES('2541','松溪县','Songxi','1057','1541');
INSERT INTO job_provinceandcity VALUES('2542','光泽县','Guangze','1057','1542');
INSERT INTO job_provinceandcity VALUES('2543','顺昌县','Shunchang','1057','1543');
INSERT INTO job_provinceandcity VALUES('2544','浦城县','Pucheng','1057','1544');
INSERT INTO job_provinceandcity VALUES('2545','政和县','Zhenghe','1057','1545');
INSERT INTO job_provinceandcity VALUES('2546','新罗区','Xinluo','1051','1546');
INSERT INTO job_provinceandcity VALUES('2547','漳平市','Zhangping','1051','1547');
INSERT INTO job_provinceandcity VALUES('2548','长汀县','Changting','1051','1548');
INSERT INTO job_provinceandcity VALUES('2549','武平县','Wuping','1051','1549');
INSERT INTO job_provinceandcity VALUES('2550','上杭县','Shanghang','1051','1550');
INSERT INTO job_provinceandcity VALUES('2551','永定县','Yongding','1051','1551');
INSERT INTO job_provinceandcity VALUES('2552','连城县','Liancheng','1051','1552');
INSERT INTO job_provinceandcity VALUES('2553','蕉城区','Jiaocheng','1058','1553');
INSERT INTO job_provinceandcity VALUES('2554','福安市','Fuan','1058','1554');
INSERT INTO job_provinceandcity VALUES('2555','福鼎市','Fuding','1058','1555');
INSERT INTO job_provinceandcity VALUES('2556','寿宁县','Shouning','1058','1556');
INSERT INTO job_provinceandcity VALUES('2557','霞浦县','Xiapu','1058','1557');
INSERT INTO job_provinceandcity VALUES('2558','柘荣县','Zherong','1058','1558');
INSERT INTO job_provinceandcity VALUES('2559','屏南县','Pingnan','1058','1559');
INSERT INTO job_provinceandcity VALUES('2560','古田县','Gutian','1058','1560');
INSERT INTO job_provinceandcity VALUES('2561','周宁县','Zhouning','1058','1561');
INSERT INTO job_provinceandcity VALUES('2562','东湖区','Donghu','1214','1562');
INSERT INTO job_provinceandcity VALUES('2563','西湖区','Xihu','1214','1563');
INSERT INTO job_provinceandcity VALUES('2564','青云谱区','Qingyun','1214','1564');
INSERT INTO job_provinceandcity VALUES('2565','湾里区','Wanli','1214','1565');
INSERT INTO job_provinceandcity VALUES('2566','青山湖区','Qingshanhu','1214','1566');
INSERT INTO job_provinceandcity VALUES('2567','新建县','Xinjian','1214','1567');
INSERT INTO job_provinceandcity VALUES('2568','南昌县','Nanchang','1214','1568');
INSERT INTO job_provinceandcity VALUES('2569','进贤县','Jinxian','1214','1569');
INSERT INTO job_provinceandcity VALUES('2570','安义县','Anyi','1214','1570');
INSERT INTO job_provinceandcity VALUES('2571','珠山区','Zhushan','1220','1571');
INSERT INTO job_provinceandcity VALUES('2572','昌江区','Changjiang','1220','1572');
INSERT INTO job_provinceandcity VALUES('2573','乐平市','Leping','1220','1573');
INSERT INTO job_provinceandcity VALUES('2574','浮梁县','Fuliang','1220','1574');
INSERT INTO job_provinceandcity VALUES('2575','安源区','Anyuan','1215','1575');
INSERT INTO job_provinceandcity VALUES('2576','湘东区','Xiangdong','1215','1576');
INSERT INTO job_provinceandcity VALUES('2577','莲花县','Lianhua','1215','1577');
INSERT INTO job_provinceandcity VALUES('2578','上栗县','Shangli','1215','1578');
INSERT INTO job_provinceandcity VALUES('2579','芦溪县','Luxi','1215','1579');
INSERT INTO job_provinceandcity VALUES('2580','渝水区','Yushui','1210','1580');
INSERT INTO job_provinceandcity VALUES('2581','分宜县','Fenyi','1210','1581');
INSERT INTO job_provinceandcity VALUES('2582','浔阳区','Xunyang','1219','1582');
INSERT INTO job_provinceandcity VALUES('2583','庐山区','Lushan','1219','1583');
INSERT INTO job_provinceandcity VALUES('2584','瑞昌市','Ruichang','1219','1584');
INSERT INTO job_provinceandcity VALUES('2585','九江县','Jiujiang','1219','1585');
INSERT INTO job_provinceandcity VALUES('2586','星子县','Xingzi','1219','1586');
INSERT INTO job_provinceandcity VALUES('2587','武宁县','Wuning','1219','1587');
INSERT INTO job_provinceandcity VALUES('2588','彭泽县','Pengze','1219','1588');
INSERT INTO job_provinceandcity VALUES('2589','永修县','Yongxiu','1219','1589');
INSERT INTO job_provinceandcity VALUES('2590','修水县','Xiushui','1219','1590');
INSERT INTO job_provinceandcity VALUES('2591','湖口县','Hukou','1219','1591');
INSERT INTO job_provinceandcity VALUES('2592','德安县','Dean','1219','1592');
INSERT INTO job_provinceandcity VALUES('2593','都昌县','Duchang','1219','1593');
INSERT INTO job_provinceandcity VALUES('2594','月湖区','Yuehu','1213','1594');
INSERT INTO job_provinceandcity VALUES('2595','贵溪市','Guixi','1213','1595');
INSERT INTO job_provinceandcity VALUES('2596','余江县','Yujiang','1213','1596');
INSERT INTO job_provinceandcity VALUES('2597','章贡区','Zhanggong','1216','1597');
INSERT INTO job_provinceandcity VALUES('2598','瑞金市','Ruijin','1216','1598');
INSERT INTO job_provinceandcity VALUES('2599','南康市','Nankang','1216','1599');
INSERT INTO job_provinceandcity VALUES('2600','石城县','Shicheng','1216','1600');
INSERT INTO job_provinceandcity VALUES('2601','安远县','Anyuan','1216','1601');
INSERT INTO job_provinceandcity VALUES('2602','赣县','Ganxian','1216','1602');
INSERT INTO job_provinceandcity VALUES('2603','宁都县','Ningdu','1216','1603');
INSERT INTO job_provinceandcity VALUES('2604','寻乌县','Xunwu','1216','1604');
INSERT INTO job_provinceandcity VALUES('2605','兴国县','Xingguo','1216','1605');
INSERT INTO job_provinceandcity VALUES('2606','定南县','Dingnan','1216','1606');
INSERT INTO job_provinceandcity VALUES('2607','上犹县','Shangyou','1216','1607');
INSERT INTO job_provinceandcity VALUES('2608','于都县','Yudu','1216','1608');
INSERT INTO job_provinceandcity VALUES('2609','龙南县','Longnan','1216','1609');
INSERT INTO job_provinceandcity VALUES('2610','崇义县','Chongyi','1216','1610');
INSERT INTO job_provinceandcity VALUES('2611','信丰县','Xinfeng','1216','1611');
INSERT INTO job_provinceandcity VALUES('2612','全南县','Quannan','1216','1612');
INSERT INTO job_provinceandcity VALUES('2613','大余县','Dayu','1216','1613');
INSERT INTO job_provinceandcity VALUES('2614','会昌县','Huichang','1216','1614');
INSERT INTO job_provinceandcity VALUES('2615','吉州区','Jizhou','1218','1615');
INSERT INTO job_provinceandcity VALUES('2616','青原区','Qingyuan','1218','1616');
INSERT INTO job_provinceandcity VALUES('2617','井冈山市','Jinggangshan','1218','1617');
INSERT INTO job_provinceandcity VALUES('2618','吉安县','Jian','1218','1618');
INSERT INTO job_provinceandcity VALUES('2619','永丰县','Yongfeng','1218','1619');
INSERT INTO job_provinceandcity VALUES('2620','永新县','Yongxin','1218','1620');
INSERT INTO job_provinceandcity VALUES('2621','新干县','Xingan','1218','1621');
INSERT INTO job_provinceandcity VALUES('2622','泰和县','Taihe','1218','1622');
INSERT INTO job_provinceandcity VALUES('2623','峡江县','Xiajiang','1218','1623');
INSERT INTO job_provinceandcity VALUES('2624','遂川县','Suichuan','1218','1624');
INSERT INTO job_provinceandcity VALUES('2625','安福县','Anfu','1218','1625');
INSERT INTO job_provinceandcity VALUES('2626','吉水县','Jishui','1218','1626');
INSERT INTO job_provinceandcity VALUES('2627','万安县','Wanan','1218','1627');
INSERT INTO job_provinceandcity VALUES('2628','袁州区','Yuanzhou','1212','1628');
INSERT INTO job_provinceandcity VALUES('2629','丰城市','Fengcheng','1212','1629');
INSERT INTO job_provinceandcity VALUES('2630','樟树市','Zhangshu','1212','1630');
INSERT INTO job_provinceandcity VALUES('2631','高安市','Gaoan','1212','1631');
INSERT INTO job_provinceandcity VALUES('2632','铜鼓县','Tonggu','1212','1632');
INSERT INTO job_provinceandcity VALUES('2633','靖安县','Jingan','1212','1633');
INSERT INTO job_provinceandcity VALUES('2634','宜丰县','Yifeng','1212','1634');
INSERT INTO job_provinceandcity VALUES('2635','奉新县','Fengxin','1212','1635');
INSERT INTO job_provinceandcity VALUES('2636','万载县','Waizai','1212','1636');
INSERT INTO job_provinceandcity VALUES('2637','上高县','Shanggao','1212','1637');
INSERT INTO job_provinceandcity VALUES('2638','临川区','Linchuan','1217','1638');
INSERT INTO job_provinceandcity VALUES('2639','南丰县','Nanfeng','1217','1639');
INSERT INTO job_provinceandcity VALUES('2640','乐安县','Lean','1217','1640');
INSERT INTO job_provinceandcity VALUES('2641','金溪县','Jinxi','1217','1641');
INSERT INTO job_provinceandcity VALUES('2642','南城县','Nancheng','1217','1642');
INSERT INTO job_provinceandcity VALUES('2643','东乡县','Dongxiang','1217','1643');
INSERT INTO job_provinceandcity VALUES('2644','资溪县','Zixi','1217','1644');
INSERT INTO job_provinceandcity VALUES('2645','宜黄县','Yihuang','1217','1645');
INSERT INTO job_provinceandcity VALUES('2646','广昌县','Guangchang','1217','1646');
INSERT INTO job_provinceandcity VALUES('2647','黎川县','Lichuan','1217','1647');
INSERT INTO job_provinceandcity VALUES('2648','崇仁县','Chongren','1217','1648');
INSERT INTO job_provinceandcity VALUES('2649','信州区','Xinzhou','1211','1649');
INSERT INTO job_provinceandcity VALUES('2650','德兴市','Dexing','1211','1650');
INSERT INTO job_provinceandcity VALUES('2651','上饶县','Shangrao','1211','1651');
INSERT INTO job_provinceandcity VALUES('2652','广丰县','Guangfeng','1211','1652');
INSERT INTO job_provinceandcity VALUES('2653','波阳县','Boyang','1211','1653');
INSERT INTO job_provinceandcity VALUES('2654','婺源县','Wuyuan','1211','1654');
INSERT INTO job_provinceandcity VALUES('2655','铅山县','Qianshan','1211','1655');
INSERT INTO job_provinceandcity VALUES('2656','余干县','Yugan','1211','1656');
INSERT INTO job_provinceandcity VALUES('2657','横峰县','Hengfeng','1211','1657');
INSERT INTO job_provinceandcity VALUES('2658','弋阳县','Yiyang','1211','1658');
INSERT INTO job_provinceandcity VALUES('2659','玉山县','Yushan','1211','1659');
INSERT INTO job_provinceandcity VALUES('2660','万年县','Wannian','1211','1660');
INSERT INTO job_provinceandcity VALUES('2661','市中区','Shizhong','1273','1661');
INSERT INTO job_provinceandcity VALUES('2662','历下区','Lixia','1273','1662');
INSERT INTO job_provinceandcity VALUES('2663','天桥区','Tianqiao','1273','1663');
INSERT INTO job_provinceandcity VALUES('2664','槐荫区','Huaiyin','1273','1664');
INSERT INTO job_provinceandcity VALUES('2665','历城区','Licheng','1273','1665');
INSERT INTO job_provinceandcity VALUES('2666','长清区','Changqing','1273','1666');
INSERT INTO job_provinceandcity VALUES('2667','章丘市','Zhangqiu','1273','1667');
INSERT INTO job_provinceandcity VALUES('2668','平阴县','Pingyin','1273','1668');
INSERT INTO job_provinceandcity VALUES('2669','济阳县','Jiyang','1273','1669');
INSERT INTO job_provinceandcity VALUES('2670','商河县','Shanghe','1273','1670');
INSERT INTO job_provinceandcity VALUES('2671','市南区','Shinan','1262','1671');
INSERT INTO job_provinceandcity VALUES('2672','市北区','Shibei','1262','1672');
INSERT INTO job_provinceandcity VALUES('2673','城阳区','Changyang','1262','1673');
INSERT INTO job_provinceandcity VALUES('2674','四方区','Sifang','1262','1674');
INSERT INTO job_provinceandcity VALUES('2675','李沧区','Licang','1262','1675');
INSERT INTO job_provinceandcity VALUES('2676','黄岛区','Huangdao','1262','1676');
INSERT INTO job_provinceandcity VALUES('2677','崂山区','Laoshan','1262','1677');
INSERT INTO job_provinceandcity VALUES('2678','胶南市','Jiaonan','1262','1678');
INSERT INTO job_provinceandcity VALUES('2679','胶州市','Jiaozhou','1262','1679');
INSERT INTO job_provinceandcity VALUES('2680','平度市','Pingdu','1262','1680');
INSERT INTO job_provinceandcity VALUES('2681','莱西市','Laixi','1262','1681');
INSERT INTO job_provinceandcity VALUES('2682','即墨市','Jimo','1262','1682');
INSERT INTO job_provinceandcity VALUES('2683','张店区','Zhangdian','1275','1683');
INSERT INTO job_provinceandcity VALUES('2684','临淄区','Linzi','1275','1684');
INSERT INTO job_provinceandcity VALUES('2685','淄川区','Zichuan','1275','1685');
INSERT INTO job_provinceandcity VALUES('2686','博山区','Boshan','1275','1686');
INSERT INTO job_provinceandcity VALUES('2687','周村区','Zhoucun','1275','1687');
INSERT INTO job_provinceandcity VALUES('2688','桓台县','Huaitai','1275','1688');
INSERT INTO job_provinceandcity VALUES('2689','高青县','Gaoqing','1275','1689');
INSERT INTO job_provinceandcity VALUES('2690','沂源县','Yiyuan','1275','1690');
INSERT INTO job_provinceandcity VALUES('2691','市中区','Shizhong','1268','1691');
INSERT INTO job_provinceandcity VALUES('2692','山亭区','Shanting','1268','1692');
INSERT INTO job_provinceandcity VALUES('2693','峄城区','Yicheng','1268','1693');
INSERT INTO job_provinceandcity VALUES('2694','台儿庄区','Taierzhuang','1268','1694');
INSERT INTO job_provinceandcity VALUES('2695','薛城区','Xuecheng','1268','1695');
INSERT INTO job_provinceandcity VALUES('2696','滕州市','Tengzhou','1268','1696');
INSERT INTO job_provinceandcity VALUES('2697','东营区','Dongying','1271','1697');
INSERT INTO job_provinceandcity VALUES('2698','河口区','Hekou','1271','1698');
INSERT INTO job_provinceandcity VALUES('2699','垦利县','Kenli','1271','1699');
INSERT INTO job_provinceandcity VALUES('2700','广饶县','Guangrao','1271','1700');
INSERT INTO job_provinceandcity VALUES('2701','利津县','Lijin','1271','1701');
INSERT INTO job_provinceandcity VALUES('2702','潍城区','Weicheng','1265','1702');
INSERT INTO job_provinceandcity VALUES('2703','寒亭区','Hanting','1265','1703');
INSERT INTO job_provinceandcity VALUES('2704','坊子区','Fangzi','1265','1704');
INSERT INTO job_provinceandcity VALUES('2705','奎文区','Kuiwen','1265','1705');
INSERT INTO job_provinceandcity VALUES('2706','青州市','Qingzhou','1265','1706');
INSERT INTO job_provinceandcity VALUES('2707','诸城市','Zhucheng','1265','1707');
INSERT INTO job_provinceandcity VALUES('2708','寿光市','Shouguang','1265','1708');
INSERT INTO job_provinceandcity VALUES('2709','安丘市','Anqiu','1265','1709');
INSERT INTO job_provinceandcity VALUES('2710','高密市','Gaomi','1265','1710');
INSERT INTO job_provinceandcity VALUES('2711','昌邑市','Changyi','1265','1711');
INSERT INTO job_provinceandcity VALUES('2712','昌乐县','Changle','1265','1712');
INSERT INTO job_provinceandcity VALUES('2713','临朐县','Linqu','1265','1713');
INSERT INTO job_provinceandcity VALUES('2714','芝罘区','Zhifu','1267','1714');
INSERT INTO job_provinceandcity VALUES('2715','福山区','Fushan','1267','1715');
INSERT INTO job_provinceandcity VALUES('2716','牟平区','Mouping','1267','1716');
INSERT INTO job_provinceandcity VALUES('2717','莱山区','Laishan','1267','1717');
INSERT INTO job_provinceandcity VALUES('2718','龙口市','Longkou','1267','1718');
INSERT INTO job_provinceandcity VALUES('2719','莱阳市','Laiyang','1267','1719');
INSERT INTO job_provinceandcity VALUES('2720','莱州市','Laizhou','1267','1720');
INSERT INTO job_provinceandcity VALUES('2721','招远市','Zhaoyuan','1267','1721');
INSERT INTO job_provinceandcity VALUES('2722','蓬莱市','Penglai','1267','1722');
INSERT INTO job_provinceandcity VALUES('2723','栖霞市','Qixia','1267','1723');
INSERT INTO job_provinceandcity VALUES('2724','海阳市','Haiyang','1267','1724');
INSERT INTO job_provinceandcity VALUES('2725','长岛县','Changdao','1267','1725');
INSERT INTO job_provinceandcity VALUES('2726','环翠区','Huancui','1266','1726');
INSERT INTO job_provinceandcity VALUES('2727','乳山市','Lushan','1266','1727');
INSERT INTO job_provinceandcity VALUES('2728','文登市','Wendeng','1266','1728');
INSERT INTO job_provinceandcity VALUES('2729','荣成市','Rongcheng','1266','1729');
INSERT INTO job_provinceandcity VALUES('2730','市中区','Shizhong','1274','1730');
INSERT INTO job_provinceandcity VALUES('2731','任城区','Rencheng','1274','1731');
INSERT INTO job_provinceandcity VALUES('2732','曲阜市','Qufu','1274','1732');
INSERT INTO job_provinceandcity VALUES('2733','兖州市','Yanzhou','1274','1733');
INSERT INTO job_provinceandcity VALUES('2734','邹城市','Zhoucheng','1274','1734');
INSERT INTO job_provinceandcity VALUES('2735','鱼台县','Yutai','1274','1735');
INSERT INTO job_provinceandcity VALUES('2736','金乡县','Jinxiang','1274','1736');
INSERT INTO job_provinceandcity VALUES('2737','嘉祥县','Jiaxiang','1274','1737');
INSERT INTO job_provinceandcity VALUES('2738','微山县','Weishan','1274','1738');
INSERT INTO job_provinceandcity VALUES('2739','汶上县','Wenshang','1274','1739');
INSERT INTO job_provinceandcity VALUES('2740','泗水县','Sishui','1274','1740');
INSERT INTO job_provinceandcity VALUES('2741','梁山县','Liangshan','1274','1741');
INSERT INTO job_provinceandcity VALUES('2742','泰山区','Taishan','1264','1742');
INSERT INTO job_provinceandcity VALUES('2743','岱岳区','Daiyue','1264','1743');
INSERT INTO job_provinceandcity VALUES('2744','新泰市','Xintai','1264','1744');
INSERT INTO job_provinceandcity VALUES('2745','肥城市','Feicheng','1264','1745');
INSERT INTO job_provinceandcity VALUES('2746','宁阳县','Ningyang','1264','1746');
INSERT INTO job_provinceandcity VALUES('2747','东平县','Dongping','1264','1747');
INSERT INTO job_provinceandcity VALUES('2748','东港区','Donggang','1263','1748');
INSERT INTO job_provinceandcity VALUES('2749','五莲县','Wulian','1263','1749');
INSERT INTO job_provinceandcity VALUES('2750','莒县','Juxian','1263','1750');
INSERT INTO job_provinceandcity VALUES('2751','莱城区','Laicheng','1261','1751');
INSERT INTO job_provinceandcity VALUES('2752','钢城区','Gangcheng','1261','1752');
INSERT INTO job_provinceandcity VALUES('2753','德城区','Decheng','1270','1753');
INSERT INTO job_provinceandcity VALUES('2754','乐陵市','Leling','1270','1754');
INSERT INTO job_provinceandcity VALUES('2755','禹城市','Yucheng','1270','1755');
INSERT INTO job_provinceandcity VALUES('2756','陵县','Lingxian','1270','1756');
INSERT INTO job_provinceandcity VALUES('2757','宁津县','Ningjin','1270','1757');
INSERT INTO job_provinceandcity VALUES('2758','齐河县','Jihe','1270','1758');
INSERT INTO job_provinceandcity VALUES('2759','武城县','Wucheng','1270','1759');
INSERT INTO job_provinceandcity VALUES('2760','庆云县','Qingyun','1270','1760');
INSERT INTO job_provinceandcity VALUES('2761','平原县','Pingyuan','1270','1761');
INSERT INTO job_provinceandcity VALUES('2762','夏津县','Xiajin','1270','1762');
INSERT INTO job_provinceandcity VALUES('2763','临邑县','Linyi','1270','1763');
INSERT INTO job_provinceandcity VALUES('2764','兰山区','Lanshan','1259','1764');
INSERT INTO job_provinceandcity VALUES('2765','罗庄区','Luozhuang','1259','1765');
INSERT INTO job_provinceandcity VALUES('2766','河东区','Hedong','1259','1766');
INSERT INTO job_provinceandcity VALUES('2767','沂南县','Yinan','1259','1767');
INSERT INTO job_provinceandcity VALUES('2768','郯城县','Taicheng','1259','1768');
INSERT INTO job_provinceandcity VALUES('2769','沂水县','Yishui','1259','1769');
INSERT INTO job_provinceandcity VALUES('2770','苍山县','Cangshan','1259','1770');
INSERT INTO job_provinceandcity VALUES('2771','费县','Feixian','1259','1771');
INSERT INTO job_provinceandcity VALUES('2772','平邑县','Pingyi','1259','1772');
INSERT INTO job_provinceandcity VALUES('2773','莒南县','Junan','1259','1773');
INSERT INTO job_provinceandcity VALUES('2774','蒙阴县','Mengyin','1259','1774');
INSERT INTO job_provinceandcity VALUES('2775','临沭县','Linshu','1259','1775');
INSERT INTO job_provinceandcity VALUES('2776','东昌府区','Dongchang','1260','1776');
INSERT INTO job_provinceandcity VALUES('2777','临清市','Linqing','1260','1777');
INSERT INTO job_provinceandcity VALUES('2778','高唐县','Gaotang','1260','1778');
INSERT INTO job_provinceandcity VALUES('2779','阳谷县','Yanggu','1260','1779');
INSERT INTO job_provinceandcity VALUES('2780','茌平县','Chiping','1260','1780');
INSERT INTO job_provinceandcity VALUES('2781','莘县','Shenxian','1260','1781');
INSERT INTO job_provinceandcity VALUES('2782','东阿县','Donge','1260','1782');
INSERT INTO job_provinceandcity VALUES('2783','冠县','Guanxian','1260','1783');
INSERT INTO job_provinceandcity VALUES('2784','滨城区','Bincheng','1269','1784');
INSERT INTO job_provinceandcity VALUES('2785','邹平县','Zhouping','1269','1785');
INSERT INTO job_provinceandcity VALUES('2786','沾化县','Zhanhua','1269','1786');
INSERT INTO job_provinceandcity VALUES('2787','惠民县','Huimin','1269','1787');
INSERT INTO job_provinceandcity VALUES('2788','博兴县','Boxing','1269','1788');
INSERT INTO job_provinceandcity VALUES('2789','阳信县','Yangxin','1269','1789');
INSERT INTO job_provinceandcity VALUES('2790','无棣县','Wudi','1269','1790');
INSERT INTO job_provinceandcity VALUES('2791','牡丹区','Mudan','1272','1791');
INSERT INTO job_provinceandcity VALUES('2792','鄄城县','Juancheng','1272','1792');
INSERT INTO job_provinceandcity VALUES('2793','单县','Shanxian','1272','1793');
INSERT INTO job_provinceandcity VALUES('2794','郓城县','Yuncheng','1272','1794');
INSERT INTO job_provinceandcity VALUES('2795','曹县','Caoxian','1272','1795');
INSERT INTO job_provinceandcity VALUES('2796','定陶县','Dingtao','1272','1796');
INSERT INTO job_provinceandcity VALUES('2797','巨野县','Juye','1272','1797');
INSERT INTO job_provinceandcity VALUES('2798','东明县','Dongming','1272','1798');
INSERT INTO job_provinceandcity VALUES('2799','成武县','Chengwu','1272','1799');
INSERT INTO job_provinceandcity VALUES('2800','中原区','Zhongyuan','1142','1800');
INSERT INTO job_provinceandcity VALUES('2801','金水区','Jinshui','1142','1801');
INSERT INTO job_provinceandcity VALUES('2802','二七区','Eiqi','1142','1802');
INSERT INTO job_provinceandcity VALUES('2803','管城回族区','Quancheng','1142','1803');
INSERT INTO job_provinceandcity VALUES('2804','上街区','Shangjie','1142','1804');
INSERT INTO job_provinceandcity VALUES('2805','邙山区','Mangshan','1142','1805');
INSERT INTO job_provinceandcity VALUES('2806','巩义市','Gongyi','1142','1806');
INSERT INTO job_provinceandcity VALUES('2807','新郑市','Xinzheng','1142','1807');
INSERT INTO job_provinceandcity VALUES('2808','新密市','Xinmi','1142','1808');
INSERT INTO job_provinceandcity VALUES('2809','登封市','Dengfeng','1142','1809');
INSERT INTO job_provinceandcity VALUES('2810','荥阳市','Xingyang','1142','1810');
INSERT INTO job_provinceandcity VALUES('2811','中牟县','Zhongmou','1142','1811');
INSERT INTO job_provinceandcity VALUES('2812','鼓楼区','Gulou','1146','1812');
INSERT INTO job_provinceandcity VALUES('2813','龙亭区','Longting','1146','1813');
INSERT INTO job_provinceandcity VALUES('2814','顺河回族区','Shunhe','1146','1814');
INSERT INTO job_provinceandcity VALUES('2815','南关区','Nanguan','1146','1815');
INSERT INTO job_provinceandcity VALUES('2816','郊区','Suburb','1146','1816');
INSERT INTO job_provinceandcity VALUES('2817','开封县','Kaifeng','1146','1817');
INSERT INTO job_provinceandcity VALUES('2818','尉氏县','Weishi','1146','1818');
INSERT INTO job_provinceandcity VALUES('2819','兰考县','Lankao','1146','1819');
INSERT INTO job_provinceandcity VALUES('2820','杞县','Qixian','1146','1820');
INSERT INTO job_provinceandcity VALUES('2821','通许县','Tongxu','1146','1821');
INSERT INTO job_provinceandcity VALUES('2822','西工区','Xigong','1131','1822');
INSERT INTO job_provinceandcity VALUES('2823','老城区','Laocheng','1131','1823');
INSERT INTO job_provinceandcity VALUES('2824','涧西区','Jianxi','1131','1824');
INSERT INTO job_provinceandcity VALUES('2825','?河回族区','Chanhe','1131','1825');
INSERT INTO job_provinceandcity VALUES('2826','洛龙区','Luolong','1131','1826');
INSERT INTO job_provinceandcity VALUES('2827','吉利区','Jili','1131','1827');
INSERT INTO job_provinceandcity VALUES('2828','偃师市','Yanshi','1131','1828');
INSERT INTO job_provinceandcity VALUES('2829','孟津县','Mengjin','1131','1829');
INSERT INTO job_provinceandcity VALUES('2830','汝阳县','Ruyang','1131','1830');
INSERT INTO job_provinceandcity VALUES('2831','伊川县','Yichuan','1131','1831');
INSERT INTO job_provinceandcity VALUES('2832','洛宁县','Luoning','1131','1832');
INSERT INTO job_provinceandcity VALUES('2833','嵩县','Songxian','1131','1833');
INSERT INTO job_provinceandcity VALUES('2834','宜阳县','Yiyang','1131','1834');
INSERT INTO job_provinceandcity VALUES('2835','新安县','Xinan','1131','1835');
INSERT INTO job_provinceandcity VALUES('2836','栾川县','Luanchuan','1131','1836');
INSERT INTO job_provinceandcity VALUES('2837','新华区','Xinhua','1140','1837');
INSERT INTO job_provinceandcity VALUES('2838','卫东区','Weidong','1140','1838');
INSERT INTO job_provinceandcity VALUES('2839','湛河区','Zhanhe','1140','1839');
INSERT INTO job_provinceandcity VALUES('2840','石龙区','Shilong','1140','1840');
INSERT INTO job_provinceandcity VALUES('2841','汝州市','Ruzhou','1140','1841');
INSERT INTO job_provinceandcity VALUES('2842','舞钢市','Wugang','1140','1842');
INSERT INTO job_provinceandcity VALUES('2843','宝丰县','Baofeng','1140','1843');
INSERT INTO job_provinceandcity VALUES('2844','叶县','Yexian','1140','1844');
INSERT INTO job_provinceandcity VALUES('2845','郏县','Jiaxian','1140','1845');
INSERT INTO job_provinceandcity VALUES('2846','鲁山县','Lushan','1140','1846');
INSERT INTO job_provinceandcity VALUES('2847','解放区','Jiefang','1145','1847');
INSERT INTO job_provinceandcity VALUES('2848','中站区','Zhongzhan','1145','1848');
INSERT INTO job_provinceandcity VALUES('2849','马村区','Macun','1145','1849');
INSERT INTO job_provinceandcity VALUES('2850','山阳区','Shanyang','1145','1850');
INSERT INTO job_provinceandcity VALUES('2851','沁阳市','Qinyang','1145','1851');
INSERT INTO job_provinceandcity VALUES('2852','孟州市','Mengzhou','1145','1852');
INSERT INTO job_provinceandcity VALUES('2853','修武县','Xiuwu','1145','1853');
INSERT INTO job_provinceandcity VALUES('2854','温县','Wenxian','1145','1854');
INSERT INTO job_provinceandcity VALUES('2855','武陟县','Wuzhi','1145','1855');
INSERT INTO job_provinceandcity VALUES('2856','博爱县','Boai','1145','1856');
INSERT INTO job_provinceandcity VALUES('2857','淇滨区','Qibin','1144','1857');
INSERT INTO job_provinceandcity VALUES('2858','山城区','Shancheng','1144','1858');
INSERT INTO job_provinceandcity VALUES('2859','鹤山区','Heshan','1144','1859');
INSERT INTO job_provinceandcity VALUES('2860','浚县','Junxian','1144','1860');
INSERT INTO job_provinceandcity VALUES('2861','淇县','Qixian','1144','1861');
INSERT INTO job_provinceandcity VALUES('2862','新华区','Xinhua','1132','1862');
INSERT INTO job_provinceandcity VALUES('2863','红旗区','Hongqi','1132','1863');
INSERT INTO job_provinceandcity VALUES('2864','北站区','Beizhan','1132','1864');
INSERT INTO job_provinceandcity VALUES('2865','郊区','Suburb','1132','1865');
INSERT INTO job_provinceandcity VALUES('2866','卫辉市','Weihui','1132','1866');
INSERT INTO job_provinceandcity VALUES('2867','辉县市','Huixian','1132','1867');
INSERT INTO job_provinceandcity VALUES('2868','新乡县','Xinxiang','1132','1868');
INSERT INTO job_provinceandcity VALUES('2869','获嘉县','Huojia','1132','1869');
INSERT INTO job_provinceandcity VALUES('2870','原阳县','Yuanyang','1132','1870');
INSERT INTO job_provinceandcity VALUES('2871','长垣县','Chuangyuan','1132','1871');
INSERT INTO job_provinceandcity VALUES('2872','封丘县','Fengqiu','1132','1872');
INSERT INTO job_provinceandcity VALUES('2873','延津县','Yanjin','1132','1873');
INSERT INTO job_provinceandcity VALUES('2874','北关区','Beiguan','1143','1874');
INSERT INTO job_provinceandcity VALUES('2875','文峰区','Wenfeng','1143','1875');
INSERT INTO job_provinceandcity VALUES('2876','殷都区','Yindu','1143','1876');
INSERT INTO job_provinceandcity VALUES('2877','龙安区','Longan','1143','1877');
INSERT INTO job_provinceandcity VALUES('2878','林州市','Linzhou','1143','1878');
INSERT INTO job_provinceandcity VALUES('2879','安阳县','Anyang','1143','1879');
INSERT INTO job_provinceandcity VALUES('2880','滑县','Huaxian','1143','1880');
INSERT INTO job_provinceandcity VALUES('2881','内黄县','Neihuang','1143','1881');
INSERT INTO job_provinceandcity VALUES('2882','汤阴县','Tangyin','1143','1882');
INSERT INTO job_provinceandcity VALUES('2883','华龙区','Hualong','1137','1883');
INSERT INTO job_provinceandcity VALUES('2884','濮阳县','Puyang','1137','1884');
INSERT INTO job_provinceandcity VALUES('2885','南乐县','Nanle','1137','1885');
INSERT INTO job_provinceandcity VALUES('2886','台前县','Taiqian','1137','1886');
INSERT INTO job_provinceandcity VALUES('2887','清丰县','Qingfeng','1137','1887');
INSERT INTO job_provinceandcity VALUES('2888','范县','Fanxian','1137','1888');
INSERT INTO job_provinceandcity VALUES('2889','魏都区','Weidu','1133','1889');
INSERT INTO job_provinceandcity VALUES('2890','禹州市','Yuzhou','1133','1890');
INSERT INTO job_provinceandcity VALUES('2891','长葛市','Changge','1133','1891');
INSERT INTO job_provinceandcity VALUES('2892','许昌县','Xuchang','1133','1892');
INSERT INTO job_provinceandcity VALUES('2893','鄢陵县','Yanling','1133','1893');
INSERT INTO job_provinceandcity VALUES('2894','襄城县','Xiangcheng','1133','1894');
INSERT INTO job_provinceandcity VALUES('2895','源汇区','Yuanhui','1138','1895');
INSERT INTO job_provinceandcity VALUES('2896','郾城县','Yancheng','1138','1896');
INSERT INTO job_provinceandcity VALUES('2897','临颍县','Linying','1138','1897');
INSERT INTO job_provinceandcity VALUES('2898','舞阳县','Wuyang','1138','1898');
INSERT INTO job_provinceandcity VALUES('2899','湖滨区','Hubin','1136','1899');
INSERT INTO job_provinceandcity VALUES('2900','义马市','Yima','1136','1900');
INSERT INTO job_provinceandcity VALUES('2901','灵宝市','Lingbao','1136','1901');
INSERT INTO job_provinceandcity VALUES('2902','渑池县','Mianchi','1136','1902');
INSERT INTO job_provinceandcity VALUES('2903','卢氏县','Lushi','1136','1903');
INSERT INTO job_provinceandcity VALUES('2904','陕县','Shanxian','1136','1904');
INSERT INTO job_provinceandcity VALUES('2905','卧龙区','Wolong','1139','1905');
INSERT INTO job_provinceandcity VALUES('2906','宛城区','Wancheng','1139','1906');
INSERT INTO job_provinceandcity VALUES('2907','邓州市','Dengzhou','1139','1907');
INSERT INTO job_provinceandcity VALUES('2908','桐柏县','Tongbai','1139','1908');
INSERT INTO job_provinceandcity VALUES('2909','方城县','Fangcheng','1139','1909');
INSERT INTO job_provinceandcity VALUES('2910','淅川县','Xichuan','1139','1910');
INSERT INTO job_provinceandcity VALUES('2911','镇平县','Zhenping','1139','1911');
INSERT INTO job_provinceandcity VALUES('2912','唐河县','Tanghe','1139','1912');
INSERT INTO job_provinceandcity VALUES('2913','南召县','Nanzhao','1139','1913');
INSERT INTO job_provinceandcity VALUES('2914','内乡县','Neixiang','1139','1914');
INSERT INTO job_provinceandcity VALUES('2915','新野县','Xinye','1139','1915');
INSERT INTO job_provinceandcity VALUES('2916','社旗县','Sheqi','1139','1916');
INSERT INTO job_provinceandcity VALUES('2917','西峡县','Xixia','1139','1917');
INSERT INTO job_provinceandcity VALUES('2918','梁园区','Liangyuan','1135','1918');
INSERT INTO job_provinceandcity VALUES('2919','睢阳区','Suiyang','1135','1919');
INSERT INTO job_provinceandcity VALUES('2920','永城市','Yongcheng','1135','1920');
INSERT INTO job_provinceandcity VALUES('2921','宁陵县','Ningling','1135','1921');
INSERT INTO job_provinceandcity VALUES('2922','虞城县','Yucheng','1135','1922');
INSERT INTO job_provinceandcity VALUES('2923','民权县','Minquan','1135','1923');
INSERT INTO job_provinceandcity VALUES('2924','夏邑县','Xiayi','1135','1924');
INSERT INTO job_provinceandcity VALUES('2925','柘城县','Zhecheng','1135','1925');
INSERT INTO job_provinceandcity VALUES('2926','睢县','Suixian','1135','1926');
INSERT INTO job_provinceandcity VALUES('2927','?河区','Shihe','1134','1927');
INSERT INTO job_provinceandcity VALUES('2928','平桥区','Pingqiao','1134','1928');
INSERT INTO job_provinceandcity VALUES('2929','潢川县','Huangchuan','1134','1929');
INSERT INTO job_provinceandcity VALUES('2930','淮滨县','Huaibin','1134','1930');
INSERT INTO job_provinceandcity VALUES('2931','息县','Xixian','1134','1931');
INSERT INTO job_provinceandcity VALUES('2932','新县','Xinxian','1134','1932');
INSERT INTO job_provinceandcity VALUES('2933','商城县','Shangcheng','1134','1933');
INSERT INTO job_provinceandcity VALUES('2934','固始县','Gushi','1134','1934');
INSERT INTO job_provinceandcity VALUES('2935','罗山县','Luoshan','1134','1935');
INSERT INTO job_provinceandcity VALUES('2936','光山县','Guangshan','1134','1936');
INSERT INTO job_provinceandcity VALUES('2937','川汇区','Chuanhui','1141','1937');
INSERT INTO job_provinceandcity VALUES('2938','项城市','Dingcheng','1141','1938');
INSERT INTO job_provinceandcity VALUES('2939','商水县','Shangshui','1141','1939');
INSERT INTO job_provinceandcity VALUES('2940','淮阳县','Huaiyang','1141','1940');
INSERT INTO job_provinceandcity VALUES('2941','太康县','Taikang','1141','1941');
INSERT INTO job_provinceandcity VALUES('2942','鹿邑县','Luyi','1141','1942');
INSERT INTO job_provinceandcity VALUES('2943','西华县','Xihua','1141','1943');
INSERT INTO job_provinceandcity VALUES('2944','扶沟县','Fugou','1141','1944');
INSERT INTO job_provinceandcity VALUES('2945','沈丘县','Shenqiu','1141','1945');
INSERT INTO job_provinceandcity VALUES('2946','郸城县','Dancheng','1141','1946');
INSERT INTO job_provinceandcity VALUES('2947','驿城区','Yicheng','1147','1947');
INSERT INTO job_provinceandcity VALUES('2948','确山县','Queshan','1147','1948');
INSERT INTO job_provinceandcity VALUES('2949','新蔡县','Xincai','1147','1949');
INSERT INTO job_provinceandcity VALUES('2950','上蔡县','Shangcai','1147','1950');
INSERT INTO job_provinceandcity VALUES('2951','西平县','Xiping','1147','1951');
INSERT INTO job_provinceandcity VALUES('2952','泌阳县','Biyang','1147','1952');
INSERT INTO job_provinceandcity VALUES('2953','平舆县','Pingyu','1147','1953');
INSERT INTO job_provinceandcity VALUES('2954','汝南县','Runan','1147','1954');
INSERT INTO job_provinceandcity VALUES('2955','遂平县','Suiping','1147','1955');
INSERT INTO job_provinceandcity VALUES('2956','正阳县','Zhengyang','1147','1956');
INSERT INTO job_provinceandcity VALUES('2957','济源市','Jiyuan','1391','1957');
INSERT INTO job_provinceandcity VALUES('2958','江岸区','Jiangan','1166','1958');
INSERT INTO job_provinceandcity VALUES('2959','武昌区','Wuchang','1166','1959');
INSERT INTO job_provinceandcity VALUES('2960','江汉区','Jianghan','1166','1960');
INSERT INTO job_provinceandcity VALUES('2961','?口区','Qiaokou','1166','1961');
INSERT INTO job_provinceandcity VALUES('2962','汉阳区','Hanyang','1166','1962');
INSERT INTO job_provinceandcity VALUES('2963','青山区','Qingshan','1166','1963');
INSERT INTO job_provinceandcity VALUES('2964','洪山区','Hongshan','1166','1964');
INSERT INTO job_provinceandcity VALUES('2965','东西湖区','Dongxihu','1166','1965');
INSERT INTO job_provinceandcity VALUES('2966','汉南区','Hannan','1166','1966');
INSERT INTO job_provinceandcity VALUES('2967','蔡甸区','Caidian','1166','1967');
INSERT INTO job_provinceandcity VALUES('2968','江夏区','Jiangxia','1166','1968');
INSERT INTO job_provinceandcity VALUES('2969','黄陂区','Huangpi','1166','1969');
INSERT INTO job_provinceandcity VALUES('2970','新洲区','Xinzhou','1166','1970');
INSERT INTO job_provinceandcity VALUES('2971','黄石港区','Huangshigang','1170','1971');
INSERT INTO job_provinceandcity VALUES('2972','石灰窑区','Shihuiyao','1170','1972');
INSERT INTO job_provinceandcity VALUES('2973','下陆区','Xialu','1170','1973');
INSERT INTO job_provinceandcity VALUES('2974','铁山区','Tieshan','1170','1974');
INSERT INTO job_provinceandcity VALUES('2975','大冶市','Daye','1170','1975');
INSERT INTO job_provinceandcity VALUES('2976','阳新县','Yangxin','1170','1976');
INSERT INTO job_provinceandcity VALUES('2977','襄城区','Xiangcheng','1165','1977');
INSERT INTO job_provinceandcity VALUES('2978','樊城区','Fancheng','1165','1978');
INSERT INTO job_provinceandcity VALUES('2979','襄阳区','Xiangyang','1165','1979');
INSERT INTO job_provinceandcity VALUES('2980','老河口市','Laohekou','1165','1980');
INSERT INTO job_provinceandcity VALUES('2981','枣阳市','Zaoyang','1165','1981');
INSERT INTO job_provinceandcity VALUES('2982','宜城市','Yicheng','1165','1982');
INSERT INTO job_provinceandcity VALUES('2983','南漳县','Nanzhang','1165','1983');
INSERT INTO job_provinceandcity VALUES('2984','谷城县','Gucheng','1165','1984');
INSERT INTO job_provinceandcity VALUES('2985','保康县','Baokang','1165','1985');
INSERT INTO job_provinceandcity VALUES('2986','张湾区','Zhangwan','1163','1986');
INSERT INTO job_provinceandcity VALUES('2987','茅箭区','Maojian','1163','1987');
INSERT INTO job_provinceandcity VALUES('2988','丹江口市','Danjiangkou','1163','1988');
INSERT INTO job_provinceandcity VALUES('2989','郧县','Yunxian','1163','1989');
INSERT INTO job_provinceandcity VALUES('2990','竹山县','Zhushan','1163','1990');
INSERT INTO job_provinceandcity VALUES('2991','房县','Fangxian','1163','1991');
INSERT INTO job_provinceandcity VALUES('2992','郧西县','Yunxi','1163','1992');
INSERT INTO job_provinceandcity VALUES('2993','竹溪县','Zhuxi','1163','1993');
INSERT INTO job_provinceandcity VALUES('2994','沙市区','Shashi','1173','1994');
INSERT INTO job_provinceandcity VALUES('2995','荆州区','Jingzhou','1173','1995');
INSERT INTO job_provinceandcity VALUES('2996','洪湖市','Honghu','1173','1996');
INSERT INTO job_provinceandcity VALUES('2997','石首市','Shishou','1173','1997');
INSERT INTO job_provinceandcity VALUES('2998','松滋市','Songzi','1173','1998');
INSERT INTO job_provinceandcity VALUES('2999','监利县','Jianli','1173','1999');
INSERT INTO job_provinceandcity VALUES('3000','公安县','Gongan','1173','2000');
INSERT INTO job_provinceandcity VALUES('3001','江陵县','Jiangling','1173','2001');
INSERT INTO job_provinceandcity VALUES('3002','西陵区','Xiling','1167','2002');
INSERT INTO job_provinceandcity VALUES('3003','伍家岗区','Wujiagang','1167','2003');
INSERT INTO job_provinceandcity VALUES('3004','点军区','Dianjun','1167','2004');
INSERT INTO job_provinceandcity VALUES('3005','?亭区','Xiaoting','1167','2005');
INSERT INTO job_provinceandcity VALUES('3006','夷陵区','Yiling','1167','2006');
INSERT INTO job_provinceandcity VALUES('3007','宜都市','Yidu','1167','2007');
INSERT INTO job_provinceandcity VALUES('3008','当阳市','Dangyang','1167','2008');
INSERT INTO job_provinceandcity VALUES('3009','枝江市','Zhijiang','1167','2009');
INSERT INTO job_provinceandcity VALUES('3010','秭归县','Zigui','1167','2010');
INSERT INTO job_provinceandcity VALUES('3011','远安县','Yuanan','1167','2011');
INSERT INTO job_provinceandcity VALUES('3012','兴山县','Xingshan','1167','2012');
INSERT INTO job_provinceandcity VALUES('3013','五峰土家族自治县','Wufeng','1167','2013');
INSERT INTO job_provinceandcity VALUES('3014','长阳土家族自治县','Changyang','1167','2014');
INSERT INTO job_provinceandcity VALUES('3015','东宝区','Dongbao','1172','2015');
INSERT INTO job_provinceandcity VALUES('3016','掇刀区','Duodao','1172','2016');
INSERT INTO job_provinceandcity VALUES('3017','钟祥市','Zhongxiang','1172','2017');
INSERT INTO job_provinceandcity VALUES('3018','京山县','Jingshan','1172','2018');
INSERT INTO job_provinceandcity VALUES('3019','沙洋县','Shayang','1172','2019');
INSERT INTO job_provinceandcity VALUES('3020','鄂城区','Echeng','1168','2020');
INSERT INTO job_provinceandcity VALUES('3021','华容区','Huarong','1168','2021');
INSERT INTO job_provinceandcity VALUES('3022','梁子湖区','Liangzihu','1168','2022');
INSERT INTO job_provinceandcity VALUES('3023','孝南区','Xiaonan','1161','2023');
INSERT INTO job_provinceandcity VALUES('3024','应城市','Yingcheng','1161','2024');
INSERT INTO job_provinceandcity VALUES('3025','安陆市','Anlu','1161','2025');
INSERT INTO job_provinceandcity VALUES('3026','汉川市','Hanchuan','1161','2026');
INSERT INTO job_provinceandcity VALUES('3027','云梦县','Yunmeng','1161','2027');
INSERT INTO job_provinceandcity VALUES('3028','大悟县','Dawu','1161','2028');
INSERT INTO job_provinceandcity VALUES('3029','孝昌县','Xiaochang','1161','2029');
INSERT INTO job_provinceandcity VALUES('3030','黄州区','Huangzhou','1171','2030');
INSERT INTO job_provinceandcity VALUES('3031','麻城市','Macheng','1171','2031');
INSERT INTO job_provinceandcity VALUES('3032','武穴市','Wuxue','1171','2032');
INSERT INTO job_provinceandcity VALUES('3033','红安县','Hongan','1171','2033');
INSERT INTO job_provinceandcity VALUES('3034','罗田县','Luotian','1171','2034');
INSERT INTO job_provinceandcity VALUES('3035','浠水县','Xishui','1171','2035');
INSERT INTO job_provinceandcity VALUES('3036','蕲春县','Qichun','1171','2036');
INSERT INTO job_provinceandcity VALUES('3037','黄梅县','Huangmei','1171','2037');
INSERT INTO job_provinceandcity VALUES('3038','英山县','Yingshan','1171','2038');
INSERT INTO job_provinceandcity VALUES('3039','团风县','Tuofeng','1171','2039');
INSERT INTO job_provinceandcity VALUES('3040','咸安区','Xianan','1164','2040');
INSERT INTO job_provinceandcity VALUES('3041','赤壁市','Chibi','1164','2041');
INSERT INTO job_provinceandcity VALUES('3042','嘉鱼县','Jiayu','1164','2042');
INSERT INTO job_provinceandcity VALUES('3043','通山县','Tongshan','1164','2043');
INSERT INTO job_provinceandcity VALUES('3044','崇阳县','Chongyang','1164','2044');
INSERT INTO job_provinceandcity VALUES('3045','通城县','Tongcheng','1164','2045');
INSERT INTO job_provinceandcity VALUES('3046','曾都区','Zengdu','1162','2046');
INSERT INTO job_provinceandcity VALUES('3047','广水市','Guangshui','1162','2047');
INSERT INTO job_provinceandcity VALUES('3048','仙桃市','Xiantao','1395','2048');
INSERT INTO job_provinceandcity VALUES('3049','天门市','Tianmen','1394','2049');
INSERT INTO job_provinceandcity VALUES('3050','潜江市','Qianjiang','1392','2050');
INSERT INTO job_provinceandcity VALUES('3051','神农架林区','Shennongjia','1393','2051');
INSERT INTO job_provinceandcity VALUES('3052','恩施市','Shien','1169','2052');
INSERT INTO job_provinceandcity VALUES('3053','利川市','Lichuan','1169','2053');
INSERT INTO job_provinceandcity VALUES('3054','建始县','Jianshi','1169','2054');
INSERT INTO job_provinceandcity VALUES('3055','来凤县','Laifeng','1169','2055');
INSERT INTO job_provinceandcity VALUES('3056','巴东县','Badong','1169','2056');
INSERT INTO job_provinceandcity VALUES('3057','鹤峰县','Hefeng','1169','2057');
INSERT INTO job_provinceandcity VALUES('3058','宣恩县','Xuanen','1169','2058');
INSERT INTO job_provinceandcity VALUES('3059','咸丰县','Xianfeng','1169','2059');
INSERT INTO job_provinceandcity VALUES('3060','岳麓区','Yuelu','1184','2060');
INSERT INTO job_provinceandcity VALUES('3061','芙蓉区','Furong','1184','2061');
INSERT INTO job_provinceandcity VALUES('3062','天心区','Tianxin','1184','2062');
INSERT INTO job_provinceandcity VALUES('3063','开福区','Kaifu','1184','2063');
INSERT INTO job_provinceandcity VALUES('3064','雨花区','Yuhua','1184','2064');
INSERT INTO job_provinceandcity VALUES('3065','浏阳市','Liuyang','1184','2065');
INSERT INTO job_provinceandcity VALUES('3066','长沙县','Changsha','1184','2066');
INSERT INTO job_provinceandcity VALUES('3067','望城县','Wangcheng','1184','2067');
INSERT INTO job_provinceandcity VALUES('3068','宁乡县','Ningxiang','1184','2068');
INSERT INTO job_provinceandcity VALUES('3069','天元区','Tianyuan','1182','2069');
INSERT INTO job_provinceandcity VALUES('3070','荷塘区','Hetang','1182','2070');
INSERT INTO job_provinceandcity VALUES('3071','芦淞区','Lusong','1182','2071');
INSERT INTO job_provinceandcity VALUES('3072','石峰区','Shifeng','1182','2072');
INSERT INTO job_provinceandcity VALUES('3073','醴陵市','Liling','1182','2073');
INSERT INTO job_provinceandcity VALUES('3074','株洲县','Zhuzhou','1182','2074');
INSERT INTO job_provinceandcity VALUES('3075','炎陵县','Yanling','1182','2075');
INSERT INTO job_provinceandcity VALUES('3076','茶陵县','Chaling','1182','2076');
INSERT INTO job_provinceandcity VALUES('3077','攸县','Youxian','1182','2077');
INSERT INTO job_provinceandcity VALUES('3078','雨湖区','Yuhu','1176','2078');
INSERT INTO job_provinceandcity VALUES('3079','岳塘区','Yuetang','1176','2079');
INSERT INTO job_provinceandcity VALUES('3080','湘乡市','Xiangxiang','1176','2080');
INSERT INTO job_provinceandcity VALUES('3081','韶山市','Shaoshan','1176','2081');
INSERT INTO job_provinceandcity VALUES('3082','湘潭县','Xiangtan','1176','2082');
INSERT INTO job_provinceandcity VALUES('3083','石鼓区','Shigu','1186','2083');
INSERT INTO job_provinceandcity VALUES('3084','雁峰区','Yanfeng','1186','2084');
INSERT INTO job_provinceandcity VALUES('3085','珠晖区','Zhuhui','1186','2085');
INSERT INTO job_provinceandcity VALUES('3086','蒸湘区','Zhengxiang','1186','2086');
INSERT INTO job_provinceandcity VALUES('3087','南岳区','Nanyue','1186','2087');
INSERT INTO job_provinceandcity VALUES('3088','耒阳市','Leiyang','1186','2088');
INSERT INTO job_provinceandcity VALUES('3089','常宁市','Changning','1186','2089');
INSERT INTO job_provinceandcity VALUES('3090','衡阳县','Hengyang','1186','2090');
INSERT INTO job_provinceandcity VALUES('3091','衡东县','Hengdong','1186','2091');
INSERT INTO job_provinceandcity VALUES('3092','衡山县','Hengshan','1186','2092');
INSERT INTO job_provinceandcity VALUES('3093','衡南县','Hengnan','1186','2093');
INSERT INTO job_provinceandcity VALUES('3094','祁东县','Qidong','1186','2094');
INSERT INTO job_provinceandcity VALUES('3095','双清区','Shuangqing','1175','2095');
INSERT INTO job_provinceandcity VALUES('3096','大祥区','Daxiang','1175','2096');
INSERT INTO job_provinceandcity VALUES('3097','北塔区','Beita','1175','2097');
INSERT INTO job_provinceandcity VALUES('3098','武冈市','Wugang','1175','2098');
INSERT INTO job_provinceandcity VALUES('3099','邵东县','Shaodong','1175','2099');
INSERT INTO job_provinceandcity VALUES('3100','洞口县','Dongkou','1175','2100');
INSERT INTO job_provinceandcity VALUES('3101','新邵县','Xinshao','1175','2101');
INSERT INTO job_provinceandcity VALUES('3102','绥宁县','Suining','1175','2102');
INSERT INTO job_provinceandcity VALUES('3103','新宁县','Xinning','1175','2103');
INSERT INTO job_provinceandcity VALUES('3104','邵阳县','Shaoyang','1175','2104');
INSERT INTO job_provinceandcity VALUES('3105','隆回县','Longhui','1175','2105');
INSERT INTO job_provinceandcity VALUES('3106','城步苗族自治县','Chengbu','1175','2106');
INSERT INTO job_provinceandcity VALUES('3107','岳阳楼区','Yueyanglou','1178','2107');
INSERT INTO job_provinceandcity VALUES('3108','君山区','Junshan','1178','2108');
INSERT INTO job_provinceandcity VALUES('3109','云溪区','Yunxi','1178','2109');
INSERT INTO job_provinceandcity VALUES('3110','临湘市','Linxiang','1178','2110');
INSERT INTO job_provinceandcity VALUES('3111','汨罗市','Miluo','1178','2111');
INSERT INTO job_provinceandcity VALUES('3112','岳阳县','Yueyang','1178','2112');
INSERT INTO job_provinceandcity VALUES('3113','湘阴县','Xiangyin','1178','2113');
INSERT INTO job_provinceandcity VALUES('3114','平江县','Pingjiang','1178','2114');
INSERT INTO job_provinceandcity VALUES('3115','华容县','Huarong','1178','2115');
INSERT INTO job_provinceandcity VALUES('3116','武陵区','Wuling','1183','2116');
INSERT INTO job_provinceandcity VALUES('3117','鼎城区','Dingcheng','1183','2117');
INSERT INTO job_provinceandcity VALUES('3118','津市市','Jinshi','1183','2118');
INSERT INTO job_provinceandcity VALUES('3119','澧县','Lixian','1183','2119');
INSERT INTO job_provinceandcity VALUES('3120','临澧县','Linli','1183','2120');
INSERT INTO job_provinceandcity VALUES('3121','桃源县','Taoyuan','1183','2121');
INSERT INTO job_provinceandcity VALUES('3122','汉寿县','Hanshou','1183','2122');
INSERT INTO job_provinceandcity VALUES('3123','安乡县','Anxiang','1183','2123');
INSERT INTO job_provinceandcity VALUES('3124','石门县','Shimen','1183','2124');
INSERT INTO job_provinceandcity VALUES('3125','永定区','Yongding','1180','2125');
INSERT INTO job_provinceandcity VALUES('3126','武陵源区','Wulingyuan','1180','2126');
INSERT INTO job_provinceandcity VALUES('3127','慈利县','Cili','1180','2127');
INSERT INTO job_provinceandcity VALUES('3128','桑植县','Sangzhi','1180','2128');
INSERT INTO job_provinceandcity VALUES('3129','赫山区','Heshan','1181','2129');
INSERT INTO job_provinceandcity VALUES('3130','资阳区','Ziyang','1181','2130');
INSERT INTO job_provinceandcity VALUES('3131','沅江市','Yuanjiang','1181','2131');
INSERT INTO job_provinceandcity VALUES('3132','桃江县','Taojiang','1181','2132');
INSERT INTO job_provinceandcity VALUES('3133','南县','Nanxian','1181','2133');
INSERT INTO job_provinceandcity VALUES('3134','安化县','Anhua','1181','2134');
INSERT INTO job_provinceandcity VALUES('3135','北湖区','Beihu','1185','2135');
INSERT INTO job_provinceandcity VALUES('3136','苏仙区','Suxian','1185','2136');
INSERT INTO job_provinceandcity VALUES('3137','资兴市','Zixing','1185','2137');
INSERT INTO job_provinceandcity VALUES('3138','宜章县','Yizhang','1185','2138');
INSERT INTO job_provinceandcity VALUES('3139','汝城县','Rucheng','1185','2139');
INSERT INTO job_provinceandcity VALUES('3140','安仁县','Anren','1185','2140');
INSERT INTO job_provinceandcity VALUES('3141','嘉禾县','Jiahe','1185','2141');
INSERT INTO job_provinceandcity VALUES('3142','临武县','Linwu','1185','2142');
INSERT INTO job_provinceandcity VALUES('3143','桂东县','Guidong','1185','2143');
INSERT INTO job_provinceandcity VALUES('3144','永兴县','Yongxing','1185','2144');
INSERT INTO job_provinceandcity VALUES('3145','桂阳县','Guiyang','1185','2145');
INSERT INTO job_provinceandcity VALUES('3146','冷水滩区','Lengshuitan','1179','2146');
INSERT INTO job_provinceandcity VALUES('3147','芝山区','Zhishan','1179','2147');
INSERT INTO job_provinceandcity VALUES('3148','祁阳县','Qiyang','1179','2148');
INSERT INTO job_provinceandcity VALUES('3149','蓝山县','Lanshan','1179','2149');
INSERT INTO job_provinceandcity VALUES('3150','宁远县','Ningyuan','1179','2150');
INSERT INTO job_provinceandcity VALUES('3151','新田县','Xintian','1179','2151');
INSERT INTO job_provinceandcity VALUES('3152','东安县','Dongan','1179','2152');
INSERT INTO job_provinceandcity VALUES('3153','江永县','Jiangyong','1179','2153');
INSERT INTO job_provinceandcity VALUES('3154','道县','Daoxian','1179','2154');
INSERT INTO job_provinceandcity VALUES('3155','双牌县','Shuangpai','1179','2155');
INSERT INTO job_provinceandcity VALUES('3156','江华瑶族自治县','Jianghua','1179','2156');
INSERT INTO job_provinceandcity VALUES('3157','鹤城区','Hecheng','1187','2157');
INSERT INTO job_provinceandcity VALUES('3158','洪江市','Hongjiang','1187','2158');
INSERT INTO job_provinceandcity VALUES('3159','会同县','Huitong','1187','2159');
INSERT INTO job_provinceandcity VALUES('3160','沅陵县','Yuanling','1187','2160');
INSERT INTO job_provinceandcity VALUES('3161','辰溪县','Chenxi','1187','2161');
INSERT INTO job_provinceandcity VALUES('3162','溆浦县','Xupu','1187','2162');
INSERT INTO job_provinceandcity VALUES('3163','中方县','Zhongfang','1187','2163');
INSERT INTO job_provinceandcity VALUES('3164','新晃侗族自治县','Xinhuang','1187','2164');
INSERT INTO job_provinceandcity VALUES('3165','芷江侗族自治县','Zhijiang','1187','2165');
INSERT INTO job_provinceandcity VALUES('3166','通道侗族自治县','Tongdao','1187','2166');
INSERT INTO job_provinceandcity VALUES('3167','靖州苗族侗族自治县','Jingzhou','1187','2167');
INSERT INTO job_provinceandcity VALUES('3168','麻阳苗族自治县','Mayang','1187','2168');
INSERT INTO job_provinceandcity VALUES('3169','娄星区','Louxing','1174','2169');
INSERT INTO job_provinceandcity VALUES('3170','冷水江市','Lengshuijiang','1174','2170');
INSERT INTO job_provinceandcity VALUES('3171','涟源市','Lianyuan','1174','2171');
INSERT INTO job_provinceandcity VALUES('3172','新化县','Xinhua','1174','2172');
INSERT INTO job_provinceandcity VALUES('3173','双峰县','Shuangfeng','1174','2173');
INSERT INTO job_provinceandcity VALUES('3174','吉首市','Jishou','1177','2174');
INSERT INTO job_provinceandcity VALUES('3175','古丈县','Guzhang','1177','2175');
INSERT INTO job_provinceandcity VALUES('3176','龙山县','Longshan','1177','2176');
INSERT INTO job_provinceandcity VALUES('3177','永顺县','Yongshun','1177','2177');
INSERT INTO job_provinceandcity VALUES('3178','凤凰县','Fenghuang','1177','2178');
INSERT INTO job_provinceandcity VALUES('3179','泸溪县','Luxi','1177','2179');
INSERT INTO job_provinceandcity VALUES('3180','保靖县','Baojing','1177','2180');
INSERT INTO job_provinceandcity VALUES('3181','花垣县','Huayuan','1177','2181');
INSERT INTO job_provinceandcity VALUES('3182','越秀区','Yuexiu','1090','2182');
INSERT INTO job_provinceandcity VALUES('3183','东山区','Dongshan','1090','2183');
INSERT INTO job_provinceandcity VALUES('3184','海珠区','Haizhu','1090','2184');
INSERT INTO job_provinceandcity VALUES('3185','荔湾区','Liwan','1090','2185');
INSERT INTO job_provinceandcity VALUES('3186','天河区','Tianhe','1090','2186');
INSERT INTO job_provinceandcity VALUES('3187','白云区','Baiyun','1090','2187');
INSERT INTO job_provinceandcity VALUES('3188','黄埔区','Huangpu','1090','2188');
INSERT INTO job_provinceandcity VALUES('3189','芳村区','Fangcun','1090','2189');
INSERT INTO job_provinceandcity VALUES('3190','花都区','Huadu','1090','2190');
INSERT INTO job_provinceandcity VALUES('3191','番禺区','Fanyu','1090','2191');
INSERT INTO job_provinceandcity VALUES('3192','从化市','Conghua','1090','2192');
INSERT INTO job_provinceandcity VALUES('3193','增城市','Zengcheng','1090','2193');
INSERT INTO job_provinceandcity VALUES('3194','福田区','Futian','1079','2194');
INSERT INTO job_provinceandcity VALUES('3195','罗湖区','Luohu','1079','2195');
INSERT INTO job_provinceandcity VALUES('3196','南山区','Nanshan','1079','2196');
INSERT INTO job_provinceandcity VALUES('3197','宝安区','Baoan','1079','2197');
INSERT INTO job_provinceandcity VALUES('3198','龙岗区','Longgang','1079','2198');
INSERT INTO job_provinceandcity VALUES('3199','盐田区','Yantian','1079','2199');
INSERT INTO job_provinceandcity VALUES('3200','香洲区','Xiangzhou','1086','2200');
INSERT INTO job_provinceandcity VALUES('3201','斗门区','Doumen','1086','2201');
INSERT INTO job_provinceandcity VALUES('3202','金湾区','Jinwan','1086','2202');
INSERT INTO job_provinceandcity VALUES('3203','潮阳区','Chaoyang','1078','2203');
INSERT INTO job_provinceandcity VALUES('3204','潮南区','Chaonan','1078','2204');
INSERT INTO job_provinceandcity VALUES('3205','澄海区','Chenghai','1078','2205');
INSERT INTO job_provinceandcity VALUES('3206','濠江区','Haojiang','1078','2206');
INSERT INTO job_provinceandcity VALUES('3207','金平区','Jinping','1078','2207');
INSERT INTO job_provinceandcity VALUES('3208','龙湖区','Longhu','1078','2208');
INSERT INTO job_provinceandcity VALUES('3209','南澳县','Nanao','1078','2209');
INSERT INTO job_provinceandcity VALUES('3210','北江区','Beijiang','1080','2210');
INSERT INTO job_provinceandcity VALUES('3211','浈江区','Zhenjiang','1080','2211');
INSERT INTO job_provinceandcity VALUES('3212','武江区','Wujiang','1080','2212');
INSERT INTO job_provinceandcity VALUES('3213','乐昌市','Lechang','1080','2213');
INSERT INTO job_provinceandcity VALUES('3214','南雄市','Nanxiong','1080','2214');
INSERT INTO job_provinceandcity VALUES('3215','仁化县','Renhua','1080','2215');
INSERT INTO job_provinceandcity VALUES('3216','始兴县','Shixing','1080','2216');
INSERT INTO job_provinceandcity VALUES('3217','翁源县','Wengyuan','1080','2217');
INSERT INTO job_provinceandcity VALUES('3218','曲江县','Qujiang','1080','2218');
INSERT INTO job_provinceandcity VALUES('3219','新丰县','Xinfeng','1080','2219');
INSERT INTO job_provinceandcity VALUES('3220','乳源瑶族自治县','Luyuan','1080','2220');
INSERT INTO job_provinceandcity VALUES('3221','源城区','Yuancheng','1091','2221');
INSERT INTO job_provinceandcity VALUES('3222','和平县','Heping','1091','2222');
INSERT INTO job_provinceandcity VALUES('3223','龙川县','Longchuan','1091','2223');
INSERT INTO job_provinceandcity VALUES('3224','紫金县','Zijin','1091','2224');
INSERT INTO job_provinceandcity VALUES('3225','连平县','Lianping','1091','2225');
INSERT INTO job_provinceandcity VALUES('3226','东源县','Dongyuan','1091','2226');
INSERT INTO job_provinceandcity VALUES('3227','梅江区','Meijiang','1075','2227');
INSERT INTO job_provinceandcity VALUES('3228','兴宁市','Xingning','1075','2228');
INSERT INTO job_provinceandcity VALUES('3229','梅县','Meixian','1075','2229');
INSERT INTO job_provinceandcity VALUES('3230','蕉岭县','Jiaoling','1075','2230');
INSERT INTO job_provinceandcity VALUES('3231','大埔县','Dabu','1075','2231');
INSERT INTO job_provinceandcity VALUES('3232','丰顺县','Fengshun','1075','2232');
INSERT INTO job_provinceandcity VALUES('3233','五华县','Wuhua','1075','2233');
INSERT INTO job_provinceandcity VALUES('3234','平远县','Pingyuan','1075','2234');
INSERT INTO job_provinceandcity VALUES('3235','惠城区','Huicheng','1092','2235');
INSERT INTO job_provinceandcity VALUES('3236','惠阳市','Huiyang','1092','2236');
INSERT INTO job_provinceandcity VALUES('3237','惠东县','Huidong','1092','2237');
INSERT INTO job_provinceandcity VALUES('3238','博罗县','Boluo','1092','2238');
INSERT INTO job_provinceandcity VALUES('3239','龙门县','Longmen','1092','2239');
INSERT INTO job_provinceandcity VALUES('3240','城区','Urban Area','1077','2240');
INSERT INTO job_provinceandcity VALUES('3241','陆丰市','Lufeng','1077','2241');
INSERT INTO job_provinceandcity VALUES('3242','海丰县','Haifeng','1077','2242');
INSERT INTO job_provinceandcity VALUES('3243','陆河县','Luhe','1077','2243');
INSERT INTO job_provinceandcity VALUES('3244','东莞市','Dongguan','1088','2244');
INSERT INTO job_provinceandcity VALUES('3245','中山市','Zhongshan','1085','2245');
INSERT INTO job_provinceandcity VALUES('3246','江海区','Jianghai','1094','2246');
INSERT INTO job_provinceandcity VALUES('3247','蓬江区','Pengjiang','1094','2247');
INSERT INTO job_provinceandcity VALUES('3248','新会区','Xinhui','1094','2248');
INSERT INTO job_provinceandcity VALUES('3249','台山市','Taishan','1094','2249');
INSERT INTO job_provinceandcity VALUES('3250','开平市','Kaiping','1094','2250');
INSERT INTO job_provinceandcity VALUES('3251','鹤山市','Heshan','1094','2251');
INSERT INTO job_provinceandcity VALUES('3252','恩平市','Enping','1094','2252');
INSERT INTO job_provinceandcity VALUES('3253','顺德区','Shunde','1089','2253');
INSERT INTO job_provinceandcity VALUES('3254','南海区','Nanhai','1089','2254');
INSERT INTO job_provinceandcity VALUES('3255','三水区','Shanshui','1089','2255');
INSERT INTO job_provinceandcity VALUES('3256','高明区','Gaoming','1089','2256');
INSERT INTO job_provinceandcity VALUES('3257','禅城区','Chancheng','1089','2257');
INSERT INTO job_provinceandcity VALUES('3258','江城区','Jiangcheng','1081','2258');
INSERT INTO job_provinceandcity VALUES('3259','阳春市','Yangchun','1081','2259');
INSERT INTO job_provinceandcity VALUES('3260','阳西县','Yangxi','1081','2260');
INSERT INTO job_provinceandcity VALUES('3261','阳东县','Yangdong','1081','2261');
INSERT INTO job_provinceandcity VALUES('3262','赤坎区','Chikan','1083','2262');
INSERT INTO job_provinceandcity VALUES('3263','霞山区','Xiashan','1083','2263');
INSERT INTO job_provinceandcity VALUES('3264','坡头区','Potou','1083','2264');
INSERT INTO job_provinceandcity VALUES('3265','麻章区','Mazhang','1083','2265');
INSERT INTO job_provinceandcity VALUES('3266','廉江市','Lianjiang','1083','2266');
INSERT INTO job_provinceandcity VALUES('3267','雷州市','Leizhou','1083','2267');
INSERT INTO job_provinceandcity VALUES('3268','吴川市','Wuchuan','1083','2268');
INSERT INTO job_provinceandcity VALUES('3269','遂溪县','Suixi','1083','2269');
INSERT INTO job_provinceandcity VALUES('3270','徐闻县','Xuwen','1083','2270');
INSERT INTO job_provinceandcity VALUES('3271','茂南区','Maonan','1074','2271');
INSERT INTO job_provinceandcity VALUES('3272','茂港区','Maogang','1074','2272');
INSERT INTO job_provinceandcity VALUES('3273','高州市','Gaozhou','1074','2273');
INSERT INTO job_provinceandcity VALUES('3274','化州市','Huazhou','1074','2274');
INSERT INTO job_provinceandcity VALUES('3275','信宜市','Xinyi','1074','2275');
INSERT INTO job_provinceandcity VALUES('3276','电白县','Dianbai','1074','2276');
INSERT INTO job_provinceandcity VALUES('3277','端州区','Duanzhou','1084','2277');
INSERT INTO job_provinceandcity VALUES('3278','鼎湖区','Dinghu','1084','2278');
INSERT INTO job_provinceandcity VALUES('3279','高要市','Gaoyao','1084','2279');
INSERT INTO job_provinceandcity VALUES('3280','四会市','Sihui','1084','2280');
INSERT INTO job_provinceandcity VALUES('3281','广宁县','Guangning','1084','2281');
INSERT INTO job_provinceandcity VALUES('3282','德庆县','Deqing','1084','2282');
INSERT INTO job_provinceandcity VALUES('3283','封开县','Fengkai','1084','2283');
INSERT INTO job_provinceandcity VALUES('3284','怀集县','Huaiji','1084','2284');
INSERT INTO job_provinceandcity VALUES('3285','清城区','Qingcheng','1076','2285');
INSERT INTO job_provinceandcity VALUES('3286','英德市','Yingde','1076','2286');
INSERT INTO job_provinceandcity VALUES('3287','连州市','Lianzhou','1076','2287');
INSERT INTO job_provinceandcity VALUES('3288','佛冈县','Fogang','1076','2288');
INSERT INTO job_provinceandcity VALUES('3289','阳山县','Yangshan','1076','2289');
INSERT INTO job_provinceandcity VALUES('3290','清新县','Qingxin','1076','2290');
INSERT INTO job_provinceandcity VALUES('3291','连山壮族瑶族自治县','Lianshan','1076','2291');
INSERT INTO job_provinceandcity VALUES('3292','连南瑶族自治县','Liannan','1076','2292');
INSERT INTO job_provinceandcity VALUES('3293','湘桥区','Xiangqiao','1087','2293');
INSERT INTO job_provinceandcity VALUES('3294','潮安县','Chaoan','1087','2294');
INSERT INTO job_provinceandcity VALUES('3295','饶平县','Raoping','1087','2295');
INSERT INTO job_provinceandcity VALUES('3296','榕城区','Rongcheng','1093','2296');
INSERT INTO job_provinceandcity VALUES('3297','普宁市','Puning','1093','2297');
INSERT INTO job_provinceandcity VALUES('3298','揭东县','Jiedong','1093','2298');
INSERT INTO job_provinceandcity VALUES('3299','揭西县','Jiexi','1093','2299');
INSERT INTO job_provinceandcity VALUES('3300','惠来县','Huilai','1093','2300');
INSERT INTO job_provinceandcity VALUES('3301','云城区','Yuncheng','1082','2301');
INSERT INTO job_provinceandcity VALUES('3302','罗定市','Luoding','1082','2302');
INSERT INTO job_provinceandcity VALUES('3303','云安县','Yunan','1082','2303');
INSERT INTO job_provinceandcity VALUES('3304','新兴县','Xinxing','1082','2304');
INSERT INTO job_provinceandcity VALUES('3305','郁南县','Yunan','1082','2305');
INSERT INTO job_provinceandcity VALUES('3306','琼山市','Qiongshan','1019','2306');
INSERT INTO job_provinceandcity VALUES('3307','秀英区','Xiuying','1119','2307');
INSERT INTO job_provinceandcity VALUES('3308','龙华区','Longhua','1119','2308');
INSERT INTO job_provinceandcity VALUES('3309','琼山区','Qiongshan','1119','2309');
INSERT INTO job_provinceandcity VALUES('3310','美兰区','Meilan','1119','2310');
INSERT INTO job_provinceandcity VALUES('3311','三亚市','Sanya','1118','2311');
INSERT INTO job_provinceandcity VALUES('3312','五指山市','Wuzhishan','1389','2312');
INSERT INTO job_provinceandcity VALUES('3313','琼海市','Qionghai','1384','2313');
INSERT INTO job_provinceandcity VALUES('3314','儋州市','Danzhou','1390','2314');
INSERT INTO job_provinceandcity VALUES('3315','琼山市','Qiongshan','3306','2315');
INSERT INTO job_provinceandcity VALUES('3316','文昌市','Wenchang','1388','2316');
INSERT INTO job_provinceandcity VALUES('3317','万宁市','Wanning','1387','2317');
INSERT INTO job_provinceandcity VALUES('3318','东方市','Dongfang','1380','2318');
INSERT INTO job_provinceandcity VALUES('3319','澄迈县','Chengmai','1378','2319');
INSERT INTO job_provinceandcity VALUES('3320','定安县','Anding','1379','2320');
INSERT INTO job_provinceandcity VALUES('3321','屯昌县','Tunchang','1386','2321');
INSERT INTO job_provinceandcity VALUES('3322','临高县','Lingao','1382','2322');
INSERT INTO job_provinceandcity VALUES('3323','白沙黎族自治县','Baisha','1375','2323');
INSERT INTO job_provinceandcity VALUES('3324','昌江黎族自治县','Changjiang','1377','2324');
INSERT INTO job_provinceandcity VALUES('3325','乐东黎族自治县','Ledong','1381','2325');
INSERT INTO job_provinceandcity VALUES('3326','陵水黎族自治县','Lingshui','1383','2326');
INSERT INTO job_provinceandcity VALUES('3327','保亭黎族苗族自治县','Baoting','1376','2327');
INSERT INTO job_provinceandcity VALUES('3328','琼中黎族苗族自治县','Qiongzhong','1385','2328');
INSERT INTO job_provinceandcity VALUES('3329','新城区','Xincheng','1100','2329');
INSERT INTO job_provinceandcity VALUES('3330','兴宁区','Xingning','1100','2330');
INSERT INTO job_provinceandcity VALUES('3331','永新区','Yongxin','1100','2331');
INSERT INTO job_provinceandcity VALUES('3332','城北区','Chengbei','1100','2332');
INSERT INTO job_provinceandcity VALUES('3333','江南区','Jiangnan','1100','2333');
INSERT INTO job_provinceandcity VALUES('3334','邕宁县','Yongning','1100','2334');
INSERT INTO job_provinceandcity VALUES('3335','武鸣县','Wuming','1100','2335');
INSERT INTO job_provinceandcity VALUES('3336','隆安县','Longan','1100','2336');
INSERT INTO job_provinceandcity VALUES('3337','马山县','Mashan','1100','2337');
INSERT INTO job_provinceandcity VALUES('3338','上林县','Shanglin','1100','2338');
INSERT INTO job_provinceandcity VALUES('3339','宾阳县','Binyang','1100','2339');
INSERT INTO job_provinceandcity VALUES('3340','横县','Hengxian','1100','2340');
INSERT INTO job_provinceandcity VALUES('3341','城中区','Chengzhong','1095','2341');
INSERT INTO job_provinceandcity VALUES('3342','鱼峰区','Yufeng','1095','2342');
INSERT INTO job_provinceandcity VALUES('3343','柳北区','Liubei','1095','2343');
INSERT INTO job_provinceandcity VALUES('3344','柳南区','Liunan','1095','2344');
INSERT INTO job_provinceandcity VALUES('3345','市郊区','Suburb','1095','2345');
INSERT INTO job_provinceandcity VALUES('3346','柳江县','Liujiang','1095','2346');
INSERT INTO job_provinceandcity VALUES('3347','柳城县','Liucheng','1095','2347');
INSERT INTO job_provinceandcity VALUES('3348','融水苗族自治县','Rongshui','1095','2348');
INSERT INTO job_provinceandcity VALUES('3349','鹿寨县','Luzhai','1095','2349');
INSERT INTO job_provinceandcity VALUES('3350','融安县','Rongan','1095','2350');
INSERT INTO job_provinceandcity VALUES('3351','三江侗族自治县','Sanjiang','1095','2351');
INSERT INTO job_provinceandcity VALUES('3352','秀峰区','Xiufeng','1105','2352');
INSERT INTO job_provinceandcity VALUES('3353','叠彩区','Diecai','1105','2353');
INSERT INTO job_provinceandcity VALUES('3354','象山区','Xiangshan','1105','2354');
INSERT INTO job_provinceandcity VALUES('3355','七星区','Qixing','1105','2355');
INSERT INTO job_provinceandcity VALUES('3356','雁山区','Yanshan','1105','2356');
INSERT INTO job_provinceandcity VALUES('3357','阳朔县','Yangshuo','1105','2357');
INSERT INTO job_provinceandcity VALUES('3358','临桂县','Lingui','1105','2358');
INSERT INTO job_provinceandcity VALUES('3359','灵川县','Lingchuan','1105','2359');
INSERT INTO job_provinceandcity VALUES('3360','全州县','Quanzhou','1105','2360');
INSERT INTO job_provinceandcity VALUES('3361','平乐县','Pingle','1105','2361');
INSERT INTO job_provinceandcity VALUES('3362','兴安县','Xingan','1105','2362');
INSERT INTO job_provinceandcity VALUES('3363','灌阳县','Guanyang','1105','2363');
INSERT INTO job_provinceandcity VALUES('3364','荔浦县','Lipu','1105','2364');
INSERT INTO job_provinceandcity VALUES('3365','资源县','Ziyuan','1105','2365');
INSERT INTO job_provinceandcity VALUES('3366','永福县','Yongfu','1105','2366');
INSERT INTO job_provinceandcity VALUES('3367','龙胜各族自治县','Longsheng','1105','2367');
INSERT INTO job_provinceandcity VALUES('3368','恭城瑶族自治县','Gongcheng','1105','2368');
INSERT INTO job_provinceandcity VALUES('3369','万秀区','Wanxiu','1098','2369');
INSERT INTO job_provinceandcity VALUES('3370','蝶山区','Dieshan','1098','2370');
INSERT INTO job_provinceandcity VALUES('3371','市郊区','Suburb','1098','2371');
INSERT INTO job_provinceandcity VALUES('3372','岑溪市','Cenxi','1098','2372');
INSERT INTO job_provinceandcity VALUES('3373','苍梧县','Cangwu','1098','2373');
INSERT INTO job_provinceandcity VALUES('3374','藤县','Tengxian','1098','2374');
INSERT INTO job_provinceandcity VALUES('3375','蒙山县','Mengshan','1098','2375');
INSERT INTO job_provinceandcity VALUES('3376','海城区','Haicheng','1103','2376');
INSERT INTO job_provinceandcity VALUES('3377','银海区','Yinhai','1103','2377');
INSERT INTO job_provinceandcity VALUES('3378','铁山港区','Tieshangang','1103','2378');
INSERT INTO job_provinceandcity VALUES('3379','合浦县','Hepu','1103','2379');
INSERT INTO job_provinceandcity VALUES('3380','港口区','Gangkou','1104','2380');
INSERT INTO job_provinceandcity VALUES('3381','防城区','Fangcheng','1104','2381');
INSERT INTO job_provinceandcity VALUES('3382','东兴市','Dongxing','1104','2382');
INSERT INTO job_provinceandcity VALUES('3383','上思县','Shangsi','1104','2383');
INSERT INTO job_provinceandcity VALUES('3384','钦南区','Qinnan','1097','2384');
INSERT INTO job_provinceandcity VALUES('3385','钦北区','Qinbei','1097','2385');
INSERT INTO job_provinceandcity VALUES('3386','灵山县','Lingshan','1097','2386');
INSERT INTO job_provinceandcity VALUES('3387','浦北县','Pubei','1097','2387');
INSERT INTO job_provinceandcity VALUES('3388','港北区','Gangbei','1106','2388');
INSERT INTO job_provinceandcity VALUES('3389','港南区','Gangnan','1106','2389');
INSERT INTO job_provinceandcity VALUES('3390','桂平市','Guiping','1106','2390');
INSERT INTO job_provinceandcity VALUES('3391','平南县','Pingnan','1106','2391');
INSERT INTO job_provinceandcity VALUES('3392','玉州区','Yuzhou','1099','2392');
INSERT INTO job_provinceandcity VALUES('3393','北流市','Beiliu','1099','2393');
INSERT INTO job_provinceandcity VALUES('3394','容县','Rongxian','1099','2394');
INSERT INTO job_provinceandcity VALUES('3395','陆川县','Luchuan','1099','2395');
INSERT INTO job_provinceandcity VALUES('3396','博白县','Bobai','1099','2396');
INSERT INTO job_provinceandcity VALUES('3397','兴业县','Xingye','1099','2397');
INSERT INTO job_provinceandcity VALUES('3398','江洲区','Jiangzhou','1096','2398');
INSERT INTO job_provinceandcity VALUES('3399','宁明县','Ningming','1096','2399');
INSERT INTO job_provinceandcity VALUES('3400','扶绥县','Fusui','1096','2400');
INSERT INTO job_provinceandcity VALUES('3401','龙州县','Longzhou','1096','2401');
INSERT INTO job_provinceandcity VALUES('3402','大新县','Daxin','1096','2402');
INSERT INTO job_provinceandcity VALUES('3403','天等县','Tiandeng','1096','2403');
INSERT INTO job_provinceandcity VALUES('3404','凭祥市','Pingxiang','1396','2404');
INSERT INTO job_provinceandcity VALUES('3405','合山市','Heshan','1101','2405');
INSERT INTO job_provinceandcity VALUES('3406','兴宾区','Xingbin','1101','2406');
INSERT INTO job_provinceandcity VALUES('3407','象州县','Xiangzhou','1101','2407');
INSERT INTO job_provinceandcity VALUES('3408','武宣县','Wuxuan','1101','2408');
INSERT INTO job_provinceandcity VALUES('3409','忻城县','Xincheng','1101','2409');
INSERT INTO job_provinceandcity VALUES('3410','金秀瑶族自治县','Jinxiu','1101','2410');
INSERT INTO job_provinceandcity VALUES('3411','贺州市','Hezhou','1108','2411');
INSERT INTO job_provinceandcity VALUES('3412','钟山县','Zhongshan','1108','2412');
INSERT INTO job_provinceandcity VALUES('3413','昭平县','Zhaoping','1108','2413');
INSERT INTO job_provinceandcity VALUES('3414','富川瑶族自治县','Fuchuan','1108','2414');
INSERT INTO job_provinceandcity VALUES('3415','凌云县','Lingyun','1102','2415');
INSERT INTO job_provinceandcity VALUES('3416','平果县','Pingguo','1102','2416');
INSERT INTO job_provinceandcity VALUES('3417','西林县','Xilin','1102','2417');
INSERT INTO job_provinceandcity VALUES('3418','乐业县','Leye','1102','2418');
INSERT INTO job_provinceandcity VALUES('3419','德保县','Debao','1102','2419');
INSERT INTO job_provinceandcity VALUES('3420','田林县','Tianlin','1102','2420');
INSERT INTO job_provinceandcity VALUES('3421','田阳县','Tianyang','1102','2421');
INSERT INTO job_provinceandcity VALUES('3422','靖西县','Jingxi','1102','2422');
INSERT INTO job_provinceandcity VALUES('3423','田东县','Tiandong','1102','2423');
INSERT INTO job_provinceandcity VALUES('3424','那坡县','Napo','1102','2424');
INSERT INTO job_provinceandcity VALUES('3425','隆林各族自治县','Longlin','1102','2425');
INSERT INTO job_provinceandcity VALUES('3426','河池市','Hechi','1107','2426');
INSERT INTO job_provinceandcity VALUES('3427','宜州市','Yizhou','1107','2427');
INSERT INTO job_provinceandcity VALUES('3428','天峨县','Tiane','1107','2428');
INSERT INTO job_provinceandcity VALUES('3429','凤山县','Fengshan','1107','2429');
INSERT INTO job_provinceandcity VALUES('3430','南丹县','Nandan','1107','2430');
INSERT INTO job_provinceandcity VALUES('3431','东兰县','Donglan','1107','2431');
INSERT INTO job_provinceandcity VALUES('3432','都安瑶族自治县','Duan','1107','2432');
INSERT INTO job_provinceandcity VALUES('3433','罗城仡佬族自治县','Luocheng','1107','2433');
INSERT INTO job_provinceandcity VALUES('3434','巴马瑶族自治县','Bama','1107','2434');
INSERT INTO job_provinceandcity VALUES('3435','环江毛南族自治县','Huanjiang','1107','2435');
INSERT INTO job_provinceandcity VALUES('3436','大化瑶族自治县','Dahua','1107','2436');
INSERT INTO job_provinceandcity VALUES('3437','青羊区','Qingyang','1310','2437');
INSERT INTO job_provinceandcity VALUES('3438','锦江区','Jinjiang','1310','2438');
INSERT INTO job_provinceandcity VALUES('3439','金牛区','Jinniu','1310','2439');
INSERT INTO job_provinceandcity VALUES('3440','武侯区','Wuhou','1310','2440');
INSERT INTO job_provinceandcity VALUES('3441','成华区','Chenghua','1310','2441');
INSERT INTO job_provinceandcity VALUES('3442','龙泉驿区','Longquanyi','1310','2442');
INSERT INTO job_provinceandcity VALUES('3443','青白江区','Qingbaijiang','1310','2443');
INSERT INTO job_provinceandcity VALUES('3444','新都区','Xindu','1310','2444');
INSERT INTO job_provinceandcity VALUES('3445','都江堰市','Dujiangyan','1310','2445');
INSERT INTO job_provinceandcity VALUES('3446','彭州市','Pengzhou','1310','2446');
INSERT INTO job_provinceandcity VALUES('3447','邛崃市','Qionglai','1310','2447');
INSERT INTO job_provinceandcity VALUES('3448','崇州市','Chongzhou','1310','2448');
INSERT INTO job_provinceandcity VALUES('3449','金堂县','Jintang','1310','2449');
INSERT INTO job_provinceandcity VALUES('3450','温江区','Wenjiang','1310','2450');
INSERT INTO job_provinceandcity VALUES('3451','郫县','Pixian','1310','2451');
INSERT INTO job_provinceandcity VALUES('3452','新津县','Xinjin','1310','2452');
INSERT INTO job_provinceandcity VALUES('3453','双流县','Shuangliu','1310','2453');
INSERT INTO job_provinceandcity VALUES('3454','蒲江县','Pujiang','1310','2454');
INSERT INTO job_provinceandcity VALUES('3455','大邑县','Dayi','1310','2455');
INSERT INTO job_provinceandcity VALUES('3456','大安区','Daan','1317','2456');
INSERT INTO job_provinceandcity VALUES('3457','自流井区','Ziliujing','1317','2457');
INSERT INTO job_provinceandcity VALUES('3458','贡井区','Gongjing','1317','2458');
INSERT INTO job_provinceandcity VALUES('3459','沿滩区','Yantan','1317','2459');
INSERT INTO job_provinceandcity VALUES('3460','荣县','Rongxian','1317','2460');
INSERT INTO job_provinceandcity VALUES('3461','富顺县','Fushun','1317','2461');
INSERT INTO job_provinceandcity VALUES('3462','东区','Dongqu','1305','2462');
INSERT INTO job_provinceandcity VALUES('3463','西区','Xiqu','1305','2463');
INSERT INTO job_provinceandcity VALUES('3464','仁和区','Renhe','1305','2464');
INSERT INTO job_provinceandcity VALUES('3465','米易县','Miyi','1305','2465');
INSERT INTO job_provinceandcity VALUES('3466','盐边县','Yanbian','1305','2466');
INSERT INTO job_provinceandcity VALUES('3467','江阳区','Jiangyang','1298','2467');
INSERT INTO job_provinceandcity VALUES('3468','纳溪区','Naxi','1298','2468');
INSERT INTO job_provinceandcity VALUES('3469','龙马潭区','Longmatan','1298','2469');
INSERT INTO job_provinceandcity VALUES('3470','泸县','Luxian','1298','2470');
INSERT INTO job_provinceandcity VALUES('3471','合江县','Hejiang','1298','2471');
INSERT INTO job_provinceandcity VALUES('3472','叙永县','Xuyong','1298','2472');
INSERT INTO job_provinceandcity VALUES('3473','古蔺县','Gulin','1298','2473');
INSERT INTO job_provinceandcity VALUES('3474','旌阳区','Jingyang','1312','2474');
INSERT INTO job_provinceandcity VALUES('3475','广汉市','Guanghan','1312','2475');
INSERT INTO job_provinceandcity VALUES('3476','什邡市','Shifang','1312','2476');
INSERT INTO job_provinceandcity VALUES('3477','绵竹市','Mianzhu','1312','2477');
INSERT INTO job_provinceandcity VALUES('3478','罗江县','Luojiang','1312','2478');
INSERT INTO job_provinceandcity VALUES('3479','中江县','Zhongjiang','1312','2479');
INSERT INTO job_provinceandcity VALUES('3480','涪城区','Fucheng','1297','2480');
INSERT INTO job_provinceandcity VALUES('3481','游仙区','Youxian','1297','2481');
INSERT INTO job_provinceandcity VALUES('3482','江油市','Jiangyou','1297','2482');
INSERT INTO job_provinceandcity VALUES('3483','盐亭县','Yanting','1297','2483');
INSERT INTO job_provinceandcity VALUES('3484','三台县','Santai','1297','2484');
INSERT INTO job_provinceandcity VALUES('3485','平武县','Pingwu','1297','2485');
INSERT INTO job_provinceandcity VALUES('3486','北川县','Beichuan','1297','2486');
INSERT INTO job_provinceandcity VALUES('3487','安县','Anxian','1297','2487');
INSERT INTO job_provinceandcity VALUES('3488','梓潼县','Zitong','1297','2488');
INSERT INTO job_provinceandcity VALUES('3489','市中区','Shizhong','1314','2489');
INSERT INTO job_provinceandcity VALUES('3490','元坝区','Yuanba','1314','2490');
INSERT INTO job_provinceandcity VALUES('3491','朝天区','Chaotian','1314','2491');
INSERT INTO job_provinceandcity VALUES('3492','青川县','Qingchuan','1314','2492');
INSERT INTO job_provinceandcity VALUES('3493','旺苍县','Wangcang','1314','2493');
INSERT INTO job_provinceandcity VALUES('3494','剑阁县','Jiange','1314','2494');
INSERT INTO job_provinceandcity VALUES('3495','苍溪县','Cangxi','1314','2495');
INSERT INTO job_provinceandcity VALUES('3496','市中区','Shizhong','1302','2496');
INSERT INTO job_provinceandcity VALUES('3497','射洪县','Shehong','1302','2497');
INSERT INTO job_provinceandcity VALUES('3498','蓬溪县','Pengxi','1302','2498');
INSERT INTO job_provinceandcity VALUES('3499','大英县','Daying','1302','2499');
INSERT INTO job_provinceandcity VALUES('3500','市中区','Shizhong','1307','2500');
INSERT INTO job_provinceandcity VALUES('3501','东兴区','Dongxing','1307','2501');
INSERT INTO job_provinceandcity VALUES('3502','资中县','Zizhong','1307','2502');
INSERT INTO job_provinceandcity VALUES('3503','隆昌县','Longchang','1307','2503');
INSERT INTO job_provinceandcity VALUES('3504','威远县','Weiyuan','1307','2504');
INSERT INTO job_provinceandcity VALUES('3505','市中区','Shizhong','1299','2505');
INSERT INTO job_provinceandcity VALUES('3506','五通桥区','Wutongqiao','1299','2506');
INSERT INTO job_provinceandcity VALUES('3507','沙湾区','Shawan','1299','2507');
INSERT INTO job_provinceandcity VALUES('3508','金口河区','Jinkouhe','1299','2508');
INSERT INTO job_provinceandcity VALUES('3509','峨眉山市','Emeishan','1299','2509');
INSERT INTO job_provinceandcity VALUES('3510','夹江县','Jiajiang','1299','2510');
INSERT INTO job_provinceandcity VALUES('3511','井研县','Jingyan','1299','2511');
INSERT INTO job_provinceandcity VALUES('3512','犍为县','Qianwei','1299','2512');
INSERT INTO job_provinceandcity VALUES('3513','沐川县','Muchuan','1299','2513');
INSERT INTO job_provinceandcity VALUES('3514','马边彝族自治县','Mabian','1299','2514');
INSERT INTO job_provinceandcity VALUES('3515','峨边彝族自治县','Ebian','1299','2515');
INSERT INTO job_provinceandcity VALUES('3516','顺庆区','Shunqing','1306','2516');
INSERT INTO job_provinceandcity VALUES('3517','高坪区','Gaoping','1306','2517');
INSERT INTO job_provinceandcity VALUES('3518','嘉陵区','Jialing','1306','2518');
INSERT INTO job_provinceandcity VALUES('3519','阆中市','Langzhong','1306','2519');
INSERT INTO job_provinceandcity VALUES('3520','营山县','Yingshan','1306','2520');
INSERT INTO job_provinceandcity VALUES('3521','蓬安县','Pengan','1306','2521');
INSERT INTO job_provinceandcity VALUES('3522','仪陇县','Yilong','1306','2522');
INSERT INTO job_provinceandcity VALUES('3523','南部县','Nanbu','1306','2523');
INSERT INTO job_provinceandcity VALUES('3524','西充县','Xichong','1306','2524');
INSERT INTO job_provinceandcity VALUES('3525','翠屏区','Cuiping','1304','2525');
INSERT INTO job_provinceandcity VALUES('3526','宜宾县','Yibin','1304','2526');
INSERT INTO job_provinceandcity VALUES('3527','兴文县','Xingwen','1304','2527');
INSERT INTO job_provinceandcity VALUES('3528','南溪县','Nanxi','1304','2528');
INSERT INTO job_provinceandcity VALUES('3529','珙县','Gongxian','1304','2529');
INSERT INTO job_provinceandcity VALUES('3530','江安县','Jiangan','1304','2530');
INSERT INTO job_provinceandcity VALUES('3531','筠连县','Junlian','1304','2531');
INSERT INTO job_provinceandcity VALUES('3532','屏山县','Pingshan','1304','2532');
INSERT INTO job_provinceandcity VALUES('3533','长宁县','Changning','1304','2533');
INSERT INTO job_provinceandcity VALUES('3534','高县','Gaoxian','1304','2534');
INSERT INTO job_provinceandcity VALUES('3535','广安区','Guangan','1315','2535');
INSERT INTO job_provinceandcity VALUES('3536','华蓥市','Huaying','1315','2536');
INSERT INTO job_provinceandcity VALUES('3537','岳池县','Yuechi','1315','2537');
INSERT INTO job_provinceandcity VALUES('3538','邻水县','Lingshui','1315','2538');
INSERT INTO job_provinceandcity VALUES('3539','武胜县','Wusheng','1315','2539');
INSERT INTO job_provinceandcity VALUES('3540','通川区','Tongchuan','1311','2540');
INSERT INTO job_provinceandcity VALUES('3541','万源市','Wanyuan','1311','2541');
INSERT INTO job_provinceandcity VALUES('3542','达县','Daxian','1311','2542');
INSERT INTO job_provinceandcity VALUES('3543','渠县','Quxian','1311','2543');
INSERT INTO job_provinceandcity VALUES('3544','宣汉县','Xuanhan','1311','2544');
INSERT INTO job_provinceandcity VALUES('3545','开江县','Kaijiang','1311','2545');
INSERT INTO job_provinceandcity VALUES('3546','大竹县','Dazhu','1311','2546');
INSERT INTO job_provinceandcity VALUES('3547','巴州区','Bazhou','1308','2547');
INSERT INTO job_provinceandcity VALUES('3548','南江县','Nanjiang','1308','2548');
INSERT INTO job_provinceandcity VALUES('3549','平昌县','Pingchang','1308','2549');
INSERT INTO job_provinceandcity VALUES('3550','通江县','Tongjiang','1308','2550');
INSERT INTO job_provinceandcity VALUES('3551','雨城区','Yucheng','1303','2551');
INSERT INTO job_provinceandcity VALUES('3552','芦山县','Lushan','1303','2552');
INSERT INTO job_provinceandcity VALUES('3553','石棉县','Shimian','1303','2553');
INSERT INTO job_provinceandcity VALUES('3554','名山县','Mingshan','1303','2554');
INSERT INTO job_provinceandcity VALUES('3555','天全县','Tianquan','1303','2555');
INSERT INTO job_provinceandcity VALUES('3556','荥经县','Yingjing','1303','2556');
INSERT INTO job_provinceandcity VALUES('3557','宝兴县','Baoxing','1303','2557');
INSERT INTO job_provinceandcity VALUES('3558','汉源县','Hanyuan','1303','2558');
INSERT INTO job_provinceandcity VALUES('3559','东坡区','Dongpo','1301','2559');
INSERT INTO job_provinceandcity VALUES('3560','仁寿县','Renshou','1301','2560');
INSERT INTO job_provinceandcity VALUES('3561','彭山县','Pengshan','1301','2561');
INSERT INTO job_provinceandcity VALUES('3562','洪雅县','Hongya','1301','2562');
INSERT INTO job_provinceandcity VALUES('3563','丹棱县','Danleng','1301','2563');
INSERT INTO job_provinceandcity VALUES('3564','青神县','Qingshen','1301','2564');
INSERT INTO job_provinceandcity VALUES('3565','雁江区','Yanjiang','1316','2565');
INSERT INTO job_provinceandcity VALUES('3566','简阳市','Jianyang','1316','2566');
INSERT INTO job_provinceandcity VALUES('3567','安岳县','Anyue','1316','2567');
INSERT INTO job_provinceandcity VALUES('3568','乐至县','Lezhi','1316','2568');
INSERT INTO job_provinceandcity VALUES('3569','马尔康县','Maerkang','1309','2569');
INSERT INTO job_provinceandcity VALUES('3570','九寨沟县','Jiuzhaigou','1309','2570');
INSERT INTO job_provinceandcity VALUES('3571','红原县','Hongyuan','1309','2571');
INSERT INTO job_provinceandcity VALUES('3572','汶川县','Wenchuan','1309','2572');
INSERT INTO job_provinceandcity VALUES('3573','阿坝县','Aba','1309','2573');
INSERT INTO job_provinceandcity VALUES('3574','理县','Lixian','1309','2574');
INSERT INTO job_provinceandcity VALUES('3575','若尔盖县','Ruoergai','1309','2575');
INSERT INTO job_provinceandcity VALUES('3576','小金县','Xiaojin','1309','2576');
INSERT INTO job_provinceandcity VALUES('3577','黑水县','Heishui','1309','2577');
INSERT INTO job_provinceandcity VALUES('3578','金川县','Jinchuan','1309','2578');
INSERT INTO job_provinceandcity VALUES('3579','松潘县','Songpan','1309','2579');
INSERT INTO job_provinceandcity VALUES('3580','壤塘县','Rangtang','1309','2580');
INSERT INTO job_provinceandcity VALUES('3581','茂县','Maoxian','1309','2581');
INSERT INTO job_provinceandcity VALUES('3582','康定县','Kangding','1313','2582');
INSERT INTO job_provinceandcity VALUES('3583','丹巴县','Danba','1313','2583');
INSERT INTO job_provinceandcity VALUES('3584','炉霍县','Luhuo','1313','2584');
INSERT INTO job_provinceandcity VALUES('3585','九龙县','Jiulong','1313','2585');
INSERT INTO job_provinceandcity VALUES('3586','甘孜县','Ganzi','1313','2586');
INSERT INTO job_provinceandcity VALUES('3587','雅江县','Yajiang','1313','2587');
INSERT INTO job_provinceandcity VALUES('3588','新龙县','Xinlong','1313','2588');
INSERT INTO job_provinceandcity VALUES('3589','道孚县','Daofu','1313','2589');
INSERT INTO job_provinceandcity VALUES('3590','白玉县','Baiyu','1313','2590');
INSERT INTO job_provinceandcity VALUES('3591','理塘县','Litang','1313','2591');
INSERT INTO job_provinceandcity VALUES('3592','德格县','Dege','1313','2592');
INSERT INTO job_provinceandcity VALUES('3593','乡城县','Xiangcheng','1313','2593');
INSERT INTO job_provinceandcity VALUES('3594','石渠县','Shiqu','1313','2594');
INSERT INTO job_provinceandcity VALUES('3595','稻城县','Daocheng','1313','2595');
INSERT INTO job_provinceandcity VALUES('3596','色达县','Seda','1313','2596');
INSERT INTO job_provinceandcity VALUES('3597','巴塘县','Batang','1313','2597');
INSERT INTO job_provinceandcity VALUES('3598','泸定县','Luding','1313','2598');
INSERT INTO job_provinceandcity VALUES('3599','得荣县','Derong','1313','2599');
INSERT INTO job_provinceandcity VALUES('3600','西昌市','Xichang','1300','2600');
INSERT INTO job_provinceandcity VALUES('3601','美姑县','Meigu','1300','2601');
INSERT INTO job_provinceandcity VALUES('3602','昭觉县','Zhaojue','1300','2602');
INSERT INTO job_provinceandcity VALUES('3603','金阳县','Jinyang','1300','2603');
INSERT INTO job_provinceandcity VALUES('3604','甘洛县','Ganluo','1300','2604');
INSERT INTO job_provinceandcity VALUES('3605','布拖县','Butuo','1300','2605');
INSERT INTO job_provinceandcity VALUES('3606','雷波县','Leibo','1300','2606');
INSERT INTO job_provinceandcity VALUES('3607','普格县','Puge','1300','2607');
INSERT INTO job_provinceandcity VALUES('3608','宁南县','Ningnan','1300','2608');
INSERT INTO job_provinceandcity VALUES('3609','喜德县','Xide','1300','2609');
INSERT INTO job_provinceandcity VALUES('3610','会东县','Huidong','1300','2610');
INSERT INTO job_provinceandcity VALUES('3611','越西县','Yuexi','1300','2611');
INSERT INTO job_provinceandcity VALUES('3612','会理县','Huili','1300','2612');
INSERT INTO job_provinceandcity VALUES('3613','盐源县','Yanyuan','1300','2613');
INSERT INTO job_provinceandcity VALUES('3614','德昌县','Dechang','1300','2614');
INSERT INTO job_provinceandcity VALUES('3615','冕宁县','Mianning','1300','2615');
INSERT INTO job_provinceandcity VALUES('3616','木里藏族自治县','Muli','1300','2616');
INSERT INTO job_provinceandcity VALUES('3617','南明区','Nanming','1116','2617');
INSERT INTO job_provinceandcity VALUES('3618','云岩区','Yunyan','1116','2618');
INSERT INTO job_provinceandcity VALUES('3619','花溪区','Huaxi','1116','2619');
INSERT INTO job_provinceandcity VALUES('3620','乌当区','Wudang','1116','2620');
INSERT INTO job_provinceandcity VALUES('3621','白云区','Baiyun','1116','2621');
INSERT INTO job_provinceandcity VALUES('3622','小河区','Xiaohe','1116','2622');
INSERT INTO job_provinceandcity VALUES('3623','清镇市','Qingzhen','1116','2623');
INSERT INTO job_provinceandcity VALUES('3624','开阳县','Kaiyang','1116','2624');
INSERT INTO job_provinceandcity VALUES('3625','修文县','Xiuwen','1116','2625');
INSERT INTO job_provinceandcity VALUES('3626','息烽县','Xifeng','1116','2626');
INSERT INTO job_provinceandcity VALUES('3627','钟山区','Zhongshan','1109','2627');
INSERT INTO job_provinceandcity VALUES('3628','水城县','Shuicheng','1109','2628');
INSERT INTO job_provinceandcity VALUES('3629','盘县','Panxian','1109','2629');
INSERT INTO job_provinceandcity VALUES('3630','六枝特区','Xiuzhite','1109','2630');
INSERT INTO job_provinceandcity VALUES('3631','红花岗区','Honghuagang','1117','2631');
INSERT INTO job_provinceandcity VALUES('3632','赤水市','Chishui','1117','2632');
INSERT INTO job_provinceandcity VALUES('3633','仁怀市','Renhuai','1117','2633');
INSERT INTO job_provinceandcity VALUES('3634','遵义县','Zunyi','1117','2634');
INSERT INTO job_provinceandcity VALUES('3635','绥阳县','Suiyang','1117','2635');
INSERT INTO job_provinceandcity VALUES('3636','桐梓县','Tongzi','1117','2636');
INSERT INTO job_provinceandcity VALUES('3637','习水县','Xishui','1117','2637');
INSERT INTO job_provinceandcity VALUES('3638','凤冈县','Fenggang','1117','2638');
INSERT INTO job_provinceandcity VALUES('3639','正安县','Zhengan','1117','2639');
INSERT INTO job_provinceandcity VALUES('3640','余庆县','Yuqing','1117','2640');
INSERT INTO job_provinceandcity VALUES('3641','湄潭县','Meitan','1117','2641');
INSERT INTO job_provinceandcity VALUES('3642','道真仡佬族苗族自治县','Daozhen','1117','2642');
INSERT INTO job_provinceandcity VALUES('3643','务川仡佬族苗族自治县','Wuchuan','1117','2643');
INSERT INTO job_provinceandcity VALUES('3644','西秀区','Xixiu','1114','2644');
INSERT INTO job_provinceandcity VALUES('3645','普定县','Puding','1114','2645');
INSERT INTO job_provinceandcity VALUES('3646','平坝县','Pingba','1114','2646');
INSERT INTO job_provinceandcity VALUES('3647','镇宁布依族苗族自治县','Zhenning','1114','2647');
INSERT INTO job_provinceandcity VALUES('3648','紫云苗族布依族自治县','Ziyun','1114','2648');
INSERT INTO job_provinceandcity VALUES('3649','关岭布依族苗族自治县','Guanling','1114','2649');
INSERT INTO job_provinceandcity VALUES('3650','铜仁市','Tongren','1113','2650');
INSERT INTO job_provinceandcity VALUES('3651','德江县','Dejiang','1113','2651');
INSERT INTO job_provinceandcity VALUES('3652','江口县','Jiangkou','1113','2652');
INSERT INTO job_provinceandcity VALUES('3653','思南县','Sinan','1113','2653');
INSERT INTO job_provinceandcity VALUES('3654','石阡县','Shiqian','1113','2654');
INSERT INTO job_provinceandcity VALUES('3655','玉屏侗族自治县','Yuping','1113','2655');
INSERT INTO job_provinceandcity VALUES('3656','松桃苗族自治县','Songtao','1113','2656');
INSERT INTO job_provinceandcity VALUES('3657','印江土家族苗族自治县','Yinjiang','1113','2657');
INSERT INTO job_provinceandcity VALUES('3658','沿河土家族自治县','Yanhe','1113','2658');
INSERT INTO job_provinceandcity VALUES('3659','万山特区','Wanshante','1113','2659');
INSERT INTO job_provinceandcity VALUES('3660','毕节市','Bijie','1115','2660');
INSERT INTO job_provinceandcity VALUES('3661','黔西县','Qianxi','1115','2661');
INSERT INTO job_provinceandcity VALUES('3662','大方县','Dafang','1115','2662');
INSERT INTO job_provinceandcity VALUES('3663','织金县','Zhijin','1115','2663');
INSERT INTO job_provinceandcity VALUES('3664','金沙县','Jinsha','1115','2664');
INSERT INTO job_provinceandcity VALUES('3665','赫章县','Hezhang','1115','2665');
INSERT INTO job_provinceandcity VALUES('3666','纳雍县','Nayong','1115','2666');
INSERT INTO job_provinceandcity VALUES('3667','威宁彝族回族苗族自治县','Weining','1115','2667');
INSERT INTO job_provinceandcity VALUES('3668','兴义市','Xingyi','1110','2668');
INSERT INTO job_provinceandcity VALUES('3669','望谟县','Wangmo','1110','2669');
INSERT INTO job_provinceandcity VALUES('3670','兴仁县','Xingren','1110','2670');
INSERT INTO job_provinceandcity VALUES('3671','普安县','Puan','1110','2671');
INSERT INTO job_provinceandcity VALUES('3672','册亨县','Ceheng','1110','2672');
INSERT INTO job_provinceandcity VALUES('3673','晴隆县','Qinglong','1110','2673');
INSERT INTO job_provinceandcity VALUES('3674','贞丰县','Zhenfeng','1110','2674');
INSERT INTO job_provinceandcity VALUES('3675','安龙县','Anlong','1110','2675');
INSERT INTO job_provinceandcity VALUES('3676','凯里市','Kaili','1112','2676');
INSERT INTO job_provinceandcity VALUES('3677','施秉县','Shibing','1112','2677');
INSERT INTO job_provinceandcity VALUES('3678','从江县','Congjiang','1112','2678');
INSERT INTO job_provinceandcity VALUES('3679','锦屏县','Jinping','1112','2679');
INSERT INTO job_provinceandcity VALUES('3680','镇远县','Zhenyuan','1112','2680');
INSERT INTO job_provinceandcity VALUES('3681','麻江县','Majiang','1112','2681');
INSERT INTO job_provinceandcity VALUES('3682','台江县','Taijiang','1112','2682');
INSERT INTO job_provinceandcity VALUES('3683','天柱县','Tianzhu','1112','2683');
INSERT INTO job_provinceandcity VALUES('3684','黄平县','Huangping','1112','2684');
INSERT INTO job_provinceandcity VALUES('3685','榕江县','Rongjiang','1112','2685');
INSERT INTO job_provinceandcity VALUES('3686','剑河县','Jianhe','1112','2686');
INSERT INTO job_provinceandcity VALUES('3687','三穗县','Sansui','1112','2687');
INSERT INTO job_provinceandcity VALUES('3688','雷山县','Leishan','1112','2688');
INSERT INTO job_provinceandcity VALUES('3689','黎平县','Liping','1112','2689');
INSERT INTO job_provinceandcity VALUES('3690','岑巩县','Cengong','1112','2690');
INSERT INTO job_provinceandcity VALUES('3691','丹寨县','Danzhai','1112','2691');
INSERT INTO job_provinceandcity VALUES('3692','都匀市','Duyun','1111','2692');
INSERT INTO job_provinceandcity VALUES('3693','贵定县','Guiding','1111','2693');
INSERT INTO job_provinceandcity VALUES('3694','惠水县','Huishui','1111','2694');
INSERT INTO job_provinceandcity VALUES('3695','罗甸县','Luodian','1111','2695');
INSERT INTO job_provinceandcity VALUES('3696','瓮安县','Wenan','1111','2696');
INSERT INTO job_provinceandcity VALUES('3697','荔波县','Libo','1111','2697');
INSERT INTO job_provinceandcity VALUES('3698','龙里县','Longli','1111','2698');
INSERT INTO job_provinceandcity VALUES('3699','平塘县','Pingtang','1111','2699');
INSERT INTO job_provinceandcity VALUES('3700','长顺县','Changshun','1111','2700');
INSERT INTO job_provinceandcity VALUES('3701','独山县','Dushan','1111','2701');
INSERT INTO job_provinceandcity VALUES('3702','三都水族自治县','Sandu','1111','2702');
INSERT INTO job_provinceandcity VALUES('3703','盘龙区','Panlong','1339','2703');
INSERT INTO job_provinceandcity VALUES('3704','五华区','Wuhua','1339','2704');
INSERT INTO job_provinceandcity VALUES('3705','官渡区','Guandu','1339','2705');
INSERT INTO job_provinceandcity VALUES('3706','西山区','Xishan','1339','2706');
INSERT INTO job_provinceandcity VALUES('3707','东川区','Dongchuan','1339','2707');
INSERT INTO job_provinceandcity VALUES('3708','安宁市','Anning','1339','2708');
INSERT INTO job_provinceandcity VALUES('3709','富民县','Fumin','1339','2709');
INSERT INTO job_provinceandcity VALUES('3710','嵩明县','Songming','1339','2710');
INSERT INTO job_provinceandcity VALUES('3711','呈贡县','Chenggong','1339','2711');
INSERT INTO job_provinceandcity VALUES('3712','晋宁县','Jinning','1339','2712');
INSERT INTO job_provinceandcity VALUES('3713','宜良县','Yiliang','1339','2713');
INSERT INTO job_provinceandcity VALUES('3714','禄劝彝族苗族自治县','Luquan','1339','2714');
INSERT INTO job_provinceandcity VALUES('3715','石林彝族自治县','Shilin','1339','2715');
INSERT INTO job_provinceandcity VALUES('3716','寻甸回族自治县','Xundian','1339','2716');
INSERT INTO job_provinceandcity VALUES('3717','麒麟区','Qilin','1341','2717');
INSERT INTO job_provinceandcity VALUES('3718','宣威市','Xuanwei','1341','2718');
INSERT INTO job_provinceandcity VALUES('3719','陆良县','Luliang','1341','2719');
INSERT INTO job_provinceandcity VALUES('3720','会泽县','Huize','1341','2720');
INSERT INTO job_provinceandcity VALUES('3721','富源县','Fuyuan','1341','2721');
INSERT INTO job_provinceandcity VALUES('3722','罗平县','Luoping','1341','2722');
INSERT INTO job_provinceandcity VALUES('3723','马龙县','Malong','1341','2723');
INSERT INTO job_provinceandcity VALUES('3724','师宗县','Shizong','1341','2724');
INSERT INTO job_provinceandcity VALUES('3725','沾益县','Zhanyi','1341','2725');
INSERT INTO job_provinceandcity VALUES('3726','红塔区','Hongta','1345','2726');
INSERT INTO job_provinceandcity VALUES('3727','华宁县','Huaning','1345','2727');
INSERT INTO job_provinceandcity VALUES('3728','澄江县','Chengjiang','1345','2728');
INSERT INTO job_provinceandcity VALUES('3729','易门县','Yimen','1345','2729');
INSERT INTO job_provinceandcity VALUES('3730','通海县','Tonghai','1345','2730');
INSERT INTO job_provinceandcity VALUES('3731','江川县','Jiangchuan','1345','2731');
INSERT INTO job_provinceandcity VALUES('3732','元江哈尼族彝族傣族自治县','Yuanjiang','1345','2732');
INSERT INTO job_provinceandcity VALUES('3733','新平彝族傣族自治县','Xinping','1345','2733');
INSERT INTO job_provinceandcity VALUES('3734','峨山彝族自治县','Eshan','1345','2734');
INSERT INTO job_provinceandcity VALUES('3735','隆阳区','Longyang','1347','2735');
INSERT INTO job_provinceandcity VALUES('3736','施甸县','Shidian','1347','2736');
INSERT INTO job_provinceandcity VALUES('3737','昌宁县','Changning','1347','2737');
INSERT INTO job_provinceandcity VALUES('3738','龙陵县','Longling','1347','2738');
INSERT INTO job_provinceandcity VALUES('3739','腾冲县','Tengchong','1347','2739');
INSERT INTO job_provinceandcity VALUES('3740','昭阳区','Zhaoyang','1344','2740');
INSERT INTO job_provinceandcity VALUES('3741','永善县','Yongshan','1344','2741');
INSERT INTO job_provinceandcity VALUES('3742','绥江县','Suijiang','1344','2742');
INSERT INTO job_provinceandcity VALUES('3743','镇雄县','Zhenxiong','1344','2743');
INSERT INTO job_provinceandcity VALUES('3744','大关县','Daguan','1344','2744');
INSERT INTO job_provinceandcity VALUES('3745','盐津县','Yanjin','1344','2745');
INSERT INTO job_provinceandcity VALUES('3746','巧家县','Qiaojia','1344','2746');
INSERT INTO job_provinceandcity VALUES('3747','彝良县','Yiliang','1344','2747');
INSERT INTO job_provinceandcity VALUES('3748','威信县','Weixin','1344','2748');
INSERT INTO job_provinceandcity VALUES('3749','水富县','Shuifu','1344','2749');
INSERT INTO job_provinceandcity VALUES('3750','鲁甸县','Ludian','1344','2750');
INSERT INTO job_provinceandcity VALUES('3751','普洱哈尼族彝族自治县','Puer','1342','2751');
INSERT INTO job_provinceandcity VALUES('3752','景东彝族自治县','Jingdong','1342','2752');
INSERT INTO job_provinceandcity VALUES('3753','镇沅彝族哈尼族拉祜族自治县','Zhenyuan','1342','2753');
INSERT INTO job_provinceandcity VALUES('3754','景谷彝族傣族自治县','Jinggu','1342','2754');
INSERT INTO job_provinceandcity VALUES('3755','墨江哈尼族自治县','Mojiang','1342','2755');
INSERT INTO job_provinceandcity VALUES('3756','澜沧拉祜族自治县','Lancang','1342','2756');
INSERT INTO job_provinceandcity VALUES('3757','西盟佤族自治县','Ximeng','1342','2757');
INSERT INTO job_provinceandcity VALUES('3758','江城哈尼族彝族自治县','Jiangcheng','1342','2758');
INSERT INTO job_provinceandcity VALUES('3759','孟连傣族拉祜族佤族自治县','Menglian','1342','2759');
INSERT INTO job_provinceandcity VALUES('3760','翠云区','Cuiyun','1342','2760');
INSERT INTO job_provinceandcity VALUES('3761','临翔区','Linxiang','1337','2761');
INSERT INTO job_provinceandcity VALUES('3762','镇康县','Zhenkang','1337','2762');
INSERT INTO job_provinceandcity VALUES('3763','凤庆县','Fengqing','1337','2763');
INSERT INTO job_provinceandcity VALUES('3764','云县','Yunxian','1337','2764');
INSERT INTO job_provinceandcity VALUES('3765','永德县','Yongde','1337','2765');
INSERT INTO job_provinceandcity VALUES('3766','双江拉祜族佤族布朗族傣族自治县','Shuangjiang','1337','2766');
INSERT INTO job_provinceandcity VALUES('3767','沧源佤族自治县','Cangyuan','1337','2767');
INSERT INTO job_provinceandcity VALUES('3768','耿马傣族佤族治县','Gengma','1337','2768');
INSERT INTO job_provinceandcity VALUES('3769','古城区','Gucheng','1338','2769');
INSERT INTO job_provinceandcity VALUES('3770','华坪县','Huaping','1338','2770');
INSERT INTO job_provinceandcity VALUES('3771','永胜县','Yongsheng','1338','2771');
INSERT INTO job_provinceandcity VALUES('3772','玉龙纳西族自治县','Yulong','1338','2772');
INSERT INTO job_provinceandcity VALUES('3773','宁蒗彝族自治县','Ninglang','1338','2773');
INSERT INTO job_provinceandcity VALUES('3774','文山县','Wenshan','1343','2774');
INSERT INTO job_provinceandcity VALUES('3775','麻栗坡县','Malipo','1343','2775');
INSERT INTO job_provinceandcity VALUES('3776','砚山县','Yanshan','1343','2776');
INSERT INTO job_provinceandcity VALUES('3777','广南县','Guangnan','1343','2777');
INSERT INTO job_provinceandcity VALUES('3778','马关县','Maguan','1343','2778');
INSERT INTO job_provinceandcity VALUES('3779','富宁县','Funing','1343','2779');
INSERT INTO job_provinceandcity VALUES('3780','西畴县','Xichou','1343','2780');
INSERT INTO job_provinceandcity VALUES('3781','丘北县','Qiubei','1343','2781');
INSERT INTO job_provinceandcity VALUES('3782','个旧市','Gejiu','1351','2782');
INSERT INTO job_provinceandcity VALUES('3783','开远市','Kaiyuan','1351','2783');
INSERT INTO job_provinceandcity VALUES('3784','弥勒县','Mile','1351','2784');
INSERT INTO job_provinceandcity VALUES('3785','红河县','Honghe','1351','2785');
INSERT INTO job_provinceandcity VALUES('3786','绿春县','Lvchun','1351','2786');
INSERT INTO job_provinceandcity VALUES('3787','蒙自县','Mengzi','1351','2787');
INSERT INTO job_provinceandcity VALUES('3788','泸西县','Luxi','1351','2788');
INSERT INTO job_provinceandcity VALUES('3789','建水县','Jianshui','1351','2789');
INSERT INTO job_provinceandcity VALUES('3790','元阳县','Yuanyang','1351','2790');
INSERT INTO job_provinceandcity VALUES('3791','石屏县','Shiping','1351','2791');
INSERT INTO job_provinceandcity VALUES('3792','金平苗族瑶族傣族自治县','Jinping','1351','2792');
INSERT INTO job_provinceandcity VALUES('3793','河口瑶族自治县','Hekou','1351','2793');
INSERT INTO job_provinceandcity VALUES('3794','屏边苗族自治县','Pingbian','1351','2794');
INSERT INTO job_provinceandcity VALUES('3795','景洪市','Jinghong','1352','2795');
INSERT INTO job_provinceandcity VALUES('3796','勐海县','Menghai','1352','2796');
INSERT INTO job_provinceandcity VALUES('3797','勐腊县','Mengla','1352','2797');
INSERT INTO job_provinceandcity VALUES('3798','楚雄市','Chuxiong','1348','2798');
INSERT INTO job_provinceandcity VALUES('3799','元谋县','Yuanmou','1348','2799');
INSERT INTO job_provinceandcity VALUES('3800','南华县','Nanhua','1348','2800');
INSERT INTO job_provinceandcity VALUES('3801','牟定县','Mouding','1348','2801');
INSERT INTO job_provinceandcity VALUES('3802','武定县','Wuding','1348','2802');
INSERT INTO job_provinceandcity VALUES('3803','大姚县','Dayao','1348','2803');
INSERT INTO job_provinceandcity VALUES('3804','双柏县','Shuangbai','1348','2804');
INSERT INTO job_provinceandcity VALUES('3805','禄丰县','Lufeng','1348','2805');
INSERT INTO job_provinceandcity VALUES('3806','永仁县','Yongren','1348','2806');
INSERT INTO job_provinceandcity VALUES('3807','姚安县','Yaoan','1348','2807');
INSERT INTO job_provinceandcity VALUES('3808','大理市','Dali','1349','2808');
INSERT INTO job_provinceandcity VALUES('3809','剑川县','Jianchuan','1349','2809');
INSERT INTO job_provinceandcity VALUES('3810','弥渡县','Midu','1349','2810');
INSERT INTO job_provinceandcity VALUES('3811','云龙县','Yunlong','1349','2811');
INSERT INTO job_provinceandcity VALUES('3812','洱源县','Eryuan','1349','2812');
INSERT INTO job_provinceandcity VALUES('3813','鹤庆县','Heqing','1349','2813');
INSERT INTO job_provinceandcity VALUES('3814','祥云县','Xiangyun','1349','2814');
INSERT INTO job_provinceandcity VALUES('3815','宾川县','Binchuan','1349','2815');
INSERT INTO job_provinceandcity VALUES('3816','永平县','Yongping','1349','2816');
INSERT INTO job_provinceandcity VALUES('3817','漾濞彝族自治县','Yangbi','1349','2817');
INSERT INTO job_provinceandcity VALUES('3818','巍山彝族回族自治县','Weishan','1349','2818');
INSERT INTO job_provinceandcity VALUES('3819','南涧彝族自治县','Nanjian','1349','2819');
INSERT INTO job_provinceandcity VALUES('3820','潞西市','Luxi','1340','2820');
INSERT INTO job_provinceandcity VALUES('3821','瑞丽市','Ruili','1340','2821');
INSERT INTO job_provinceandcity VALUES('3822','盈江县','Yingjiang','1340','2822');
INSERT INTO job_provinceandcity VALUES('3823','梁河县','Lianghe','1340','2823');
INSERT INTO job_provinceandcity VALUES('3824','陇川县','Longchuan','1340','2824');
INSERT INTO job_provinceandcity VALUES('3825','泸水县','Lushui','1346','2825');
INSERT INTO job_provinceandcity VALUES('3826','福贡县','Fugong','1346','2826');
INSERT INTO job_provinceandcity VALUES('3827','兰坪白族普米族自治县','Lanping','1346','2827');
INSERT INTO job_provinceandcity VALUES('3828','贡山独龙族怒族自治县','Gongshan','1346','2828');
INSERT INTO job_provinceandcity VALUES('3829','香格里拉县','Xianggelila','1350','2829');
INSERT INTO job_provinceandcity VALUES('3830','德钦县','Deqin','1350','2830');
INSERT INTO job_provinceandcity VALUES('3831','维西傈僳族自治县','Weixi','1350','2831');
INSERT INTO job_provinceandcity VALUES('3832','城关区','Chengguan','1319','2832');
INSERT INTO job_provinceandcity VALUES('3833','林周县','Linzhou','1319','2833');
INSERT INTO job_provinceandcity VALUES('3834','达孜县','Dazi','1319','2834');
INSERT INTO job_provinceandcity VALUES('3835','尼木县','Nimu','1319','2835');
INSERT INTO job_provinceandcity VALUES('3836','当雄县','Dangxiong','1319','2836');
INSERT INTO job_provinceandcity VALUES('3837','曲水县','Qushui','1319','2837');
INSERT INTO job_provinceandcity VALUES('3838','墨竹工卡县','Mozhugongka','1319','2838');
INSERT INTO job_provinceandcity VALUES('3839','堆龙德庆县','Duilongdeqing','1319','2839');
INSERT INTO job_provinceandcity VALUES('3840','那曲县','Naqu','1322','2840');
INSERT INTO job_provinceandcity VALUES('3841','嘉黎县','Jiali','1322','2841');
INSERT INTO job_provinceandcity VALUES('3842','申扎县','Shenzha','1322','2842');
INSERT INTO job_provinceandcity VALUES('3843','巴青县','Baqing','1322','2843');
INSERT INTO job_provinceandcity VALUES('3844','聂荣县','Nierong','1322','2844');
INSERT INTO job_provinceandcity VALUES('3845','尼玛县','Nima','1322','2845');
INSERT INTO job_provinceandcity VALUES('3846','比如县','Biru','1322','2846');
INSERT INTO job_provinceandcity VALUES('3847','索县','Suoxian','1322','2847');
INSERT INTO job_provinceandcity VALUES('3848','班戈县','Bange','1322','2848');
INSERT INTO job_provinceandcity VALUES('3849','安多县','Anduo','1322','2849');
INSERT INTO job_provinceandcity VALUES('3850','昌都县','Changdu','1324','2850');
INSERT INTO job_provinceandcity VALUES('3851','芒康县','Mangkang','1324','2851');
INSERT INTO job_provinceandcity VALUES('3852','贡觉县','Gongjue','1324','2852');
INSERT INTO job_provinceandcity VALUES('3853','八宿县','Basu','1324','2853');
INSERT INTO job_provinceandcity VALUES('3854','左贡县','Zuogong','1324','2854');
INSERT INTO job_provinceandcity VALUES('3855','边坝县','Bianba','1324','2855');
INSERT INTO job_provinceandcity VALUES('3856','洛隆县','Luolong','1324','2856');
INSERT INTO job_provinceandcity VALUES('3857','江达县','Jiangda','1324','2857');
INSERT INTO job_provinceandcity VALUES('3858','类乌齐县','Leiwuqi','1324','2858');
INSERT INTO job_provinceandcity VALUES('3859','丁青县','Dingqing','1324','2859');
INSERT INTO job_provinceandcity VALUES('3860','察雅县','Chaya','1324','2860');
INSERT INTO job_provinceandcity VALUES('3861','乃东县','Naidong','1321','2861');
INSERT INTO job_provinceandcity VALUES('3862','琼结县','Qiongjie','1321','2862');
INSERT INTO job_provinceandcity VALUES('3863','措美县','Cuomei','1321','2863');
INSERT INTO job_provinceandcity VALUES('3864','加查县','Jiacha','1321','2864');
INSERT INTO job_provinceandcity VALUES('3865','贡嘎县','Gongga','1321','2865');
INSERT INTO job_provinceandcity VALUES('3866','洛扎县','Luozha','1321','2866');
INSERT INTO job_provinceandcity VALUES('3867','曲松县','Qusong','1321','2867');
INSERT INTO job_provinceandcity VALUES('3868','桑日县','Sangri','1321','2868');
INSERT INTO job_provinceandcity VALUES('3869','扎囊县','Zhanang','1321','2869');
INSERT INTO job_provinceandcity VALUES('3870','错那县','Cuona','1321','2870');
INSERT INTO job_provinceandcity VALUES('3871','隆子县','Longzi','1321','2871');
INSERT INTO job_provinceandcity VALUES('3872','浪卡子县','Langkazi','1321','2872');
INSERT INTO job_provinceandcity VALUES('3873','日喀则市','Rikaze','1320','2873');
INSERT INTO job_provinceandcity VALUES('3874','定结县','Dingjie','1320','2874');
INSERT INTO job_provinceandcity VALUES('3875','萨迦县','Sajia','1320','2875');
INSERT INTO job_provinceandcity VALUES('3876','江孜县','Jiangzi','1320','2876');
INSERT INTO job_provinceandcity VALUES('3877','拉孜县','Lazi','1320','2877');
INSERT INTO job_provinceandcity VALUES('3878','定日县','Dingri','1320','2878');
INSERT INTO job_provinceandcity VALUES('3879','康马县','Kangma','1320','2879');
INSERT INTO job_provinceandcity VALUES('3880','聂拉木县','Nielamu','1320','2880');
INSERT INTO job_provinceandcity VALUES('3881','吉隆县','Jilong','1320','2881');
INSERT INTO job_provinceandcity VALUES('3882','亚东县','Yadong','1320','2882');
INSERT INTO job_provinceandcity VALUES('3883','谢通门县','Xiedongmen','1320','2883');
INSERT INTO job_provinceandcity VALUES('3884','昂仁县','Angren','1320','2884');
INSERT INTO job_provinceandcity VALUES('3885','岗巴县','Gangba','1320','2885');
INSERT INTO job_provinceandcity VALUES('3886','仲巴县','Zhongba','1320','2886');
INSERT INTO job_provinceandcity VALUES('3887','萨嘎县','Saga','1320','2887');
INSERT INTO job_provinceandcity VALUES('3888','仁布县','Renbu','1320','2888');
INSERT INTO job_provinceandcity VALUES('3889','白朗县','Bailang','1320','2889');
INSERT INTO job_provinceandcity VALUES('3890','南木林县','Nanmulin','1320','2890');
INSERT INTO job_provinceandcity VALUES('3891','噶尔县','Gaer','1323','2891');
INSERT INTO job_provinceandcity VALUES('3892','措勤县','Cuoqin','1323','2892');
INSERT INTO job_provinceandcity VALUES('3893','普兰县','Pulan','1323','2893');
INSERT INTO job_provinceandcity VALUES('3894','革吉县','Geji','1323','2894');
INSERT INTO job_provinceandcity VALUES('3895','日土县','Ritu','1323','2895');
INSERT INTO job_provinceandcity VALUES('3896','札达县','Zhada','1323','2896');
INSERT INTO job_provinceandcity VALUES('3897','改则县','Gaize','1323','2897');
INSERT INTO job_provinceandcity VALUES('3898','林芝县','Linzhi','1318','2898');
INSERT INTO job_provinceandcity VALUES('3899','墨脱县','Motuo','1318','2899');
INSERT INTO job_provinceandcity VALUES('3900','朗县','Langxian','1318','2900');
INSERT INTO job_provinceandcity VALUES('3901','米林县','Milin','1318','2901');
INSERT INTO job_provinceandcity VALUES('3902','察隅县','Chaou','1318','2902');
INSERT INTO job_provinceandcity VALUES('3903','波密县','Bomi','1318','2903');
INSERT INTO job_provinceandcity VALUES('3904','工布江达县','Gongbujiangda','1318','2904');
INSERT INTO job_provinceandcity VALUES('3905','莲湖区','Lianhu','1291','2905');
INSERT INTO job_provinceandcity VALUES('3906','新城区','Xincheng','1291','2906');
INSERT INTO job_provinceandcity VALUES('3907','碑林区','Beilin','1291','2907');
INSERT INTO job_provinceandcity VALUES('3908','雁塔区','Yanta','1291','2908');
INSERT INTO job_provinceandcity VALUES('3909','灞桥区','Baqiao','1291','2909');
INSERT INTO job_provinceandcity VALUES('3910','未央区','Weiyang','1291','2910');
INSERT INTO job_provinceandcity VALUES('3911','阎良区','Yanliang','1291','2911');
INSERT INTO job_provinceandcity VALUES('3912','临潼区','Lintong','1291','2912');
INSERT INTO job_provinceandcity VALUES('3913','长安县','Changan','1291','2913');
INSERT INTO job_provinceandcity VALUES('3914','高陵县','Gaoling','1291','2914');
INSERT INTO job_provinceandcity VALUES('3915','蓝田县','Lantian','1291','2915');
INSERT INTO job_provinceandcity VALUES('3916','户县','Huxian','1291','2916');
INSERT INTO job_provinceandcity VALUES('3917','周至县','Zhouzhi','1291','2917');
INSERT INTO job_provinceandcity VALUES('3918','王益区','Wangyi','1289','2918');
INSERT INTO job_provinceandcity VALUES('3919','印台区','Yintai','1289','2919');
INSERT INTO job_provinceandcity VALUES('3920','耀县','Yaoxian','1289','2920');
INSERT INTO job_provinceandcity VALUES('3921','宜君县','Yijun','1289','2921');
INSERT INTO job_provinceandcity VALUES('3922','渭滨区','Weibin','1295','2922');
INSERT INTO job_provinceandcity VALUES('3923','金台区','Jintai','1295','2923');
INSERT INTO job_provinceandcity VALUES('3924','宝鸡县','Baoji','1295','2924');
INSERT INTO job_provinceandcity VALUES('3925','岐山县','Qishan','1295','2925');
INSERT INTO job_provinceandcity VALUES('3926','凤翔县','Fengxiang','1295','2926');
INSERT INTO job_provinceandcity VALUES('3927','陇县','Longxian','1295','2927');
INSERT INTO job_provinceandcity VALUES('3928','太白县','Taibai','1295','2928');
INSERT INTO job_provinceandcity VALUES('3929','麟游县','Linyou','1295','2929');
INSERT INTO job_provinceandcity VALUES('3930','扶风县','Fufeng','1295','2930');
INSERT INTO job_provinceandcity VALUES('3931','千阳县','Qianyang','1295','2931');
INSERT INTO job_provinceandcity VALUES('3932','眉县','Meixian','1295','2932');
INSERT INTO job_provinceandcity VALUES('3933','凤县','Fengxian','1295','2933');
INSERT INTO job_provinceandcity VALUES('3934','秦都区','Qindu','1288','2934');
INSERT INTO job_provinceandcity VALUES('3935','渭城区','Weicheng','1288','2935');
INSERT INTO job_provinceandcity VALUES('3936','杨陵区','Yangling','1288','2936');
INSERT INTO job_provinceandcity VALUES('3937','兴平市','Xingping','1288','2937');
INSERT INTO job_provinceandcity VALUES('3938','礼泉县','Liquan','1288','2938');
INSERT INTO job_provinceandcity VALUES('3939','泾阳县','Jingyang','1288','2939');
INSERT INTO job_provinceandcity VALUES('3940','永寿县','Yongshou','1288','2940');
INSERT INTO job_provinceandcity VALUES('3941','三原县','Sanyuan','1288','2941');
INSERT INTO job_provinceandcity VALUES('3942','彬县','Binxian','1288','2942');
INSERT INTO job_provinceandcity VALUES('3943','旬邑县','Xunyi','1288','2943');
INSERT INTO job_provinceandcity VALUES('3944','长武县','Changwu','1288','2944');
INSERT INTO job_provinceandcity VALUES('3945','乾县','Qianxian','1288','2945');
INSERT INTO job_provinceandcity VALUES('3946','武功县','Wugong','1288','2946');
INSERT INTO job_provinceandcity VALUES('3947','淳化县','Chunhua','1288','2947');
INSERT INTO job_provinceandcity VALUES('3948','临渭区','Linwei','1290','2948');
INSERT INTO job_provinceandcity VALUES('3949','韩城市','Hancheng','1290','2949');
INSERT INTO job_provinceandcity VALUES('3950','华阴市','Huayin','1290','2950');
INSERT INTO job_provinceandcity VALUES('3951','蒲城县','Pucheng','1290','2951');
INSERT INTO job_provinceandcity VALUES('3952','潼关县','Tongguan','1290','2952');
INSERT INTO job_provinceandcity VALUES('3953','白水县','Baishui','1290','2953');
INSERT INTO job_provinceandcity VALUES('3954','澄城县','Chengcheng','1290','2954');
INSERT INTO job_provinceandcity VALUES('3955','华县','Huaxian','1290','2955');
INSERT INTO job_provinceandcity VALUES('3956','合阳县','Heyang','1290','2956');
INSERT INTO job_provinceandcity VALUES('3957','合阳县','Heyang','1290','2957');
INSERT INTO job_provinceandcity VALUES('3958','大荔县','Dali','1290','2958');
INSERT INTO job_provinceandcity VALUES('3959','宝塔区','Baota','1292','2959');
INSERT INTO job_provinceandcity VALUES('3960','安塞县','Ansai','1292','2960');
INSERT INTO job_provinceandcity VALUES('3961','洛川县','Luochuan','1292','2961');
INSERT INTO job_provinceandcity VALUES('3962','子长县','Zichang','1292','2962');
INSERT INTO job_provinceandcity VALUES('3963','黄陵县','Huangling','1292','2963');
INSERT INTO job_provinceandcity VALUES('3964','延长县','Yanchang','1292','2964');
INSERT INTO job_provinceandcity VALUES('3965','甘泉县','Ganquan','1292','2965');
INSERT INTO job_provinceandcity VALUES('3966','宜川县','Yichuan','1292','2966');
INSERT INTO job_provinceandcity VALUES('3967','志丹县','Zhidan','1292','2967');
INSERT INTO job_provinceandcity VALUES('3968','黄龙县','Huanglong','1292','2968');
INSERT INTO job_provinceandcity VALUES('3969','吴旗县','Wuqi','1292','2969');
INSERT INTO job_provinceandcity VALUES('3970','延川县','Yanchuan','1292','2970');
INSERT INTO job_provinceandcity VALUES('3971','富县','Fuxian','1292','2971');
INSERT INTO job_provinceandcity VALUES('3972','汉台区','Hantai','1296','2972');
INSERT INTO job_provinceandcity VALUES('3973','留坝县','Liuba','1296','2973');
INSERT INTO job_provinceandcity VALUES('3974','镇巴县','Zhenba','1296','2974');
INSERT INTO job_provinceandcity VALUES('3975','城固县','Chenggu','1296','2975');
INSERT INTO job_provinceandcity VALUES('3976','南郑县','Nanzheng','1296','2976');
INSERT INTO job_provinceandcity VALUES('3977','洋县','Yangxian','1296','2977');
INSERT INTO job_provinceandcity VALUES('3978','宁强县','Ningqiang','1296','2978');
INSERT INTO job_provinceandcity VALUES('3979','佛坪县','Foping','1296','2979');
INSERT INTO job_provinceandcity VALUES('3980','勉县','Mianxian','1296','2980');
INSERT INTO job_provinceandcity VALUES('3981','西乡县','Xixiang','1296','2981');
INSERT INTO job_provinceandcity VALUES('3982','略阳县','Lueyang','1296','2982');
INSERT INTO job_provinceandcity VALUES('3983','榆阳区','Yuyang','1293','2983');
INSERT INTO job_provinceandcity VALUES('3984','清涧县','Qingjian','1293','2984');
INSERT INTO job_provinceandcity VALUES('3985','绥德县','Suide','1293','2985');
INSERT INTO job_provinceandcity VALUES('3986','神木县','Shenmu','1293','2986');
INSERT INTO job_provinceandcity VALUES('3987','佳县','Jiaxian','1293','2987');
INSERT INTO job_provinceandcity VALUES('3988','府谷县','Fugu','1293','2988');
INSERT INTO job_provinceandcity VALUES('3989','子洲县','Zizhou','1293','2989');
INSERT INTO job_provinceandcity VALUES('3990','靖边县','Jingbian','1293','2990');
INSERT INTO job_provinceandcity VALUES('3991','横山县','Hengshan','1293','2991');
INSERT INTO job_provinceandcity VALUES('3992','米脂县','Mizhi','1293','2992');
INSERT INTO job_provinceandcity VALUES('3993','吴堡县','Wubao','1293','2993');
INSERT INTO job_provinceandcity VALUES('3994','定边县','Dingbian','1293','2994');
INSERT INTO job_provinceandcity VALUES('3995','汉滨区','Hanbin','1294','2995');
INSERT INTO job_provinceandcity VALUES('3996','紫阳县','Ziyang','1294','2996');
INSERT INTO job_provinceandcity VALUES('3997','岚皋县','Langao','1294','2997');
INSERT INTO job_provinceandcity VALUES('3998','旬阳县','Xuyang','1294','2998');
INSERT INTO job_provinceandcity VALUES('3999','镇坪县','Zhenping','1294','2999');
INSERT INTO job_provinceandcity VALUES('4000','平利县','Pingli','1294','3000');
INSERT INTO job_provinceandcity VALUES('4001','石泉县','Shiquan','1294','3001');
INSERT INTO job_provinceandcity VALUES('4002','宁陕县','Ningshan','1294','3002');
INSERT INTO job_provinceandcity VALUES('4003','白河县','Baihe','1294','3003');
INSERT INTO job_provinceandcity VALUES('4004','汉阴县','Hanyin','1294','3004');
INSERT INTO job_provinceandcity VALUES('4005','商州区','Shangzhou','1287','3005');
INSERT INTO job_provinceandcity VALUES('4006','镇安县','Zhenan','1287','3006');
INSERT INTO job_provinceandcity VALUES('4007','山阳县','Shanyang','1287','3007');
INSERT INTO job_provinceandcity VALUES('4008','洛南县','Luonan','1287','3008');
INSERT INTO job_provinceandcity VALUES('4009','商南县','Shangnan','1287','3009');
INSERT INTO job_provinceandcity VALUES('4010','丹凤县','Danfeng','1287','3010');
INSERT INTO job_provinceandcity VALUES('4011','柞水县','Zhashui','1287','3011');
INSERT INTO job_provinceandcity VALUES('4012','玉门市','Yumen','1024','3012');
INSERT INTO job_provinceandcity VALUES('4013','敦煌市','Dunhuang','1024','3013');
INSERT INTO job_provinceandcity VALUES('4014','城关区','Chengguan','1062','3014');
INSERT INTO job_provinceandcity VALUES('4015','七里河区','Qilihe','1062','3015');
INSERT INTO job_provinceandcity VALUES('4016','西固区','Xigu','1062','3016');
INSERT INTO job_provinceandcity VALUES('4017','安宁区','Anning','1062','3017');
INSERT INTO job_provinceandcity VALUES('4018','红古区','Honggu','1062','3018');
INSERT INTO job_provinceandcity VALUES('4019','永登县','Yongdeng','1062','3019');
INSERT INTO job_provinceandcity VALUES('4020','榆中县','Yuzhong','1062','3020');
INSERT INTO job_provinceandcity VALUES('4021','皋兰县','Gaolan','1062','3021');
INSERT INTO job_provinceandcity VALUES('4022','金川区','Jinchuan','1072','3022');
INSERT INTO job_provinceandcity VALUES('4023','永昌县','Yongchang','1072','3023');
INSERT INTO job_provinceandcity VALUES('4024','白银区','Baiyin','1068','3024');
INSERT INTO job_provinceandcity VALUES('4025','平川区','Pingchuan','1068','3025');
INSERT INTO job_provinceandcity VALUES('4026','靖远县','Jingyuan','1068','3026');
INSERT INTO job_provinceandcity VALUES('4027','靖远县','Jingyuan','1068','3027');
INSERT INTO job_provinceandcity VALUES('4028','会宁县','Huining','1068','3028');
INSERT INTO job_provinceandcity VALUES('4029','秦城区','Qincheng','1063','3029');
INSERT INTO job_provinceandcity VALUES('4030','北道区','Beidao','1063','3030');
INSERT INTO job_provinceandcity VALUES('4031','武山县','Wushan','1063','3031');
INSERT INTO job_provinceandcity VALUES('4032','甘谷县','Gangu','1063','3032');
INSERT INTO job_provinceandcity VALUES('4033','清水县','Qingshui','1063','3033');
INSERT INTO job_provinceandcity VALUES('4034','秦安县','Qinan','1063','3034');
INSERT INTO job_provinceandcity VALUES('4035','张家川回族自治县','Zhangjiachuan','1063','3035');
INSERT INTO job_provinceandcity VALUES('4036','嘉峪关市','Jiayuguan','1071','3036');
INSERT INTO job_provinceandcity VALUES('4037','凉州区','Liangzhou','1064','3037');
INSERT INTO job_provinceandcity VALUES('4038','民勤县','Minqin','1064','3038');
INSERT INTO job_provinceandcity VALUES('4039','古浪县','Gulang','1064','3039');
INSERT INTO job_provinceandcity VALUES('4040','天祝藏族自治县','Tianzhu','1064','3040');
INSERT INTO job_provinceandcity VALUES('4041','定西区','Dingxi','1069','3041');
INSERT INTO job_provinceandcity VALUES('4042','岷县','Minxian','1069','3042');
INSERT INTO job_provinceandcity VALUES('4043','渭源县','Weiyuan','1069','3043');
INSERT INTO job_provinceandcity VALUES('4044','陇西县','Longxi','1069','3044');
INSERT INTO job_provinceandcity VALUES('4045','通渭县','Tongwei','1069','3045');
INSERT INTO job_provinceandcity VALUES('4046','漳县','Zhangxian','1069','3046');
INSERT INTO job_provinceandcity VALUES('4047','临洮县','Lintao','1069','3047');
INSERT INTO job_provinceandcity VALUES('4048','崆峒区','Kongtong','1067','3048');
INSERT INTO job_provinceandcity VALUES('4049','灵台县','Lingtai','1067','3049');
INSERT INTO job_provinceandcity VALUES('4050','静宁县','Jingning','1067','3050');
INSERT INTO job_provinceandcity VALUES('4051','崇信县','Chongxin','1067','3051');
INSERT INTO job_provinceandcity VALUES('4052','华亭县','Huating','1067','3052');
INSERT INTO job_provinceandcity VALUES('4053','泾川县','Jingchuan','1067','3053');
INSERT INTO job_provinceandcity VALUES('4054','庄浪县','Zhuanglang','1067','3054');
INSERT INTO job_provinceandcity VALUES('4055','西峰区','Xifeng','1065','3055');
INSERT INTO job_provinceandcity VALUES('4056','庆城县','Qingcheng','1065','3056');
INSERT INTO job_provinceandcity VALUES('4057','镇原县','Zhenyuan','1065','3057');
INSERT INTO job_provinceandcity VALUES('4058','环县','Huanxian','1065','3058');
INSERT INTO job_provinceandcity VALUES('4059','华池县','Huachi','1065','3059');
INSERT INTO job_provinceandcity VALUES('4060','合水县','Heshui','1065','3060');
INSERT INTO job_provinceandcity VALUES('4061','宁县','Ningxian','1065','3061');
INSERT INTO job_provinceandcity VALUES('4062','正宁县','Zhengning','1065','3062');
INSERT INTO job_provinceandcity VALUES('4063','成县','Chengxian','1061','3063');
INSERT INTO job_provinceandcity VALUES('4064','礼县','Lixian','1061','3064');
INSERT INTO job_provinceandcity VALUES('4065','康县','Kangxian','1061','3065');
INSERT INTO job_provinceandcity VALUES('4066','武都县','Wudu','1061','3066');
INSERT INTO job_provinceandcity VALUES('4067','文县','Wenxian','1061','3067');
INSERT INTO job_provinceandcity VALUES('4068','两当县','Liangdang','1061','3068');
INSERT INTO job_provinceandcity VALUES('4069','徽县','Huixian','1061','3069');
INSERT INTO job_provinceandcity VALUES('4070','宕昌县','Dangchang','1061','3070');
INSERT INTO job_provinceandcity VALUES('4071','西和县','Xihe','1061','3071');
INSERT INTO job_provinceandcity VALUES('4072','甘州区','Ganzhou','1066','3072');
INSERT INTO job_provinceandcity VALUES('4073','民乐县','Minle','1066','3073');
INSERT INTO job_provinceandcity VALUES('4074','山丹县','Shandan','1066','3074');
INSERT INTO job_provinceandcity VALUES('4075','临泽县','Linze','1066','3075');
INSERT INTO job_provinceandcity VALUES('4076','高台县','Gaotai','1066','3076');
INSERT INTO job_provinceandcity VALUES('4077','肃南裕固族自治县','Sunan','1066','3077');
INSERT INTO job_provinceandcity VALUES('4078','玉门市','Yumen','4012','3078');
INSERT INTO job_provinceandcity VALUES('4079','敦煌市','Dunhuang','4013','3079');
INSERT INTO job_provinceandcity VALUES('4080','肃州区','Suzhou','1073','3080');
INSERT INTO job_provinceandcity VALUES('4081','安西县','Anxi','1073','3081');
INSERT INTO job_provinceandcity VALUES('4082','金塔县','Jinta','1073','3082');
INSERT INTO job_provinceandcity VALUES('4083','阿克塞哈萨克族自治县','Akesai','1073','3083');
INSERT INTO job_provinceandcity VALUES('4084','肃北蒙古族自治县','Subei','1073','3084');
INSERT INTO job_provinceandcity VALUES('4085','合作市','Hezuo','1070','3085');
INSERT INTO job_provinceandcity VALUES('4086','临潭县','Lintan','1070','3086');
INSERT INTO job_provinceandcity VALUES('4087','卓尼县','Zhuoni','1070','3087');
INSERT INTO job_provinceandcity VALUES('4088','舟曲县','Zhouqu','1070','3088');
INSERT INTO job_provinceandcity VALUES('4089','迭部县','Diebu','1070','3089');
INSERT INTO job_provinceandcity VALUES('4090','玛曲县','Maqu','1070','3090');
INSERT INTO job_provinceandcity VALUES('4091','碌曲县','Luqu','1070','3091');
INSERT INTO job_provinceandcity VALUES('4092','夏河县','Xiahe','1070','3092');
INSERT INTO job_provinceandcity VALUES('4093','临夏市','Linxia','1060','3093');
INSERT INTO job_provinceandcity VALUES('4094','临夏县','Linxia','1060','3094');
INSERT INTO job_provinceandcity VALUES('4095','康乐县','Kangle','1060','3095');
INSERT INTO job_provinceandcity VALUES('4096','永靖县','Yongjing','1060','3096');
INSERT INTO job_provinceandcity VALUES('4097','广河县','Guanghe','1060','3097');
INSERT INTO job_provinceandcity VALUES('4098','和政县','Hezheng','1060','3098');
INSERT INTO job_provinceandcity VALUES('4099','东乡族自治县','Dongxiang','1060','3099');
INSERT INTO job_provinceandcity VALUES('4100','积石山保安族东乡族撒拉族自治县','Jishishan','1060','3100');
INSERT INTO job_provinceandcity VALUES('4101','城中区','Chengzhong','1251','3101');
INSERT INTO job_provinceandcity VALUES('4102','城东区','Chengdong','1251','3102');
INSERT INTO job_provinceandcity VALUES('4103','城西区','Chengxi','1251','3103');
INSERT INTO job_provinceandcity VALUES('4104','城北区','Chengbei','1251','3104');
INSERT INTO job_provinceandcity VALUES('4105','湟源县','Huangyuan','1251','3105');
INSERT INTO job_provinceandcity VALUES('4106','湟中县','Huangzhong','1251','3106');
INSERT INTO job_provinceandcity VALUES('4107','大通回族土族自治县','Datong','1251','3107');
INSERT INTO job_provinceandcity VALUES('4108','平安县','Pingan','1257','3108');
INSERT INTO job_provinceandcity VALUES('4109','乐都县','Ledu','1257','3109');
INSERT INTO job_provinceandcity VALUES('4110','民和回族土族自治县','Minhe','1257','3110');
INSERT INTO job_provinceandcity VALUES('4111','互助土族自治县','Huzhu','1257','3111');
INSERT INTO job_provinceandcity VALUES('4112','化隆回族自治县','Hualong','1257','3112');
INSERT INTO job_provinceandcity VALUES('4113','循化撒拉族自治县','Xunhua','1257','3113');
INSERT INTO job_provinceandcity VALUES('4114','海晏县','Haiyan','1256','3114');
INSERT INTO job_provinceandcity VALUES('4115','祁连县','Qilian','1256','3115');
INSERT INTO job_provinceandcity VALUES('4116','刚察县','Gangcha','1256','3116');
INSERT INTO job_provinceandcity VALUES('4117','门源回族自治县','Menyuan','1256','3117');
INSERT INTO job_provinceandcity VALUES('4118','同仁县','Tongren','1258','3118');
INSERT INTO job_provinceandcity VALUES('4119','泽库县','Zeku','1258','3119');
INSERT INTO job_provinceandcity VALUES('4120','尖扎县','Jianzha','1258','3120');
INSERT INTO job_provinceandcity VALUES('4121','河南蒙古族自治县','Henan','1258','3121');
INSERT INTO job_provinceandcity VALUES('4122','共和县','Gonghe','1255','3122');
INSERT INTO job_provinceandcity VALUES('4123','同德县','Tongde','1255','3123');
INSERT INTO job_provinceandcity VALUES('4124','贵德县','Guide','1255','3124');
INSERT INTO job_provinceandcity VALUES('4125','兴海县','Xinghai','1255','3125');
INSERT INTO job_provinceandcity VALUES('4126','贵南县','Guinan','1255','3126');
INSERT INTO job_provinceandcity VALUES('4127','玛沁县','Maqin','1253','3127');
INSERT INTO job_provinceandcity VALUES('4128','班玛县','Banma','1253','3128');
INSERT INTO job_provinceandcity VALUES('4129','甘德县','Gande','1253','3129');
INSERT INTO job_provinceandcity VALUES('4130','达日县','Dari','1253','3130');
INSERT INTO job_provinceandcity VALUES('4131','久治县','Jiuzhi','1253','3131');
INSERT INTO job_provinceandcity VALUES('4132','玛多县','Maduo','1253','3132');
INSERT INTO job_provinceandcity VALUES('4133','玉树县','Yushu','1252','3133');
INSERT INTO job_provinceandcity VALUES('4134','杂多县','Zaduo','1252','3134');
INSERT INTO job_provinceandcity VALUES('4135','称多县','Chengduo','1252','3135');
INSERT INTO job_provinceandcity VALUES('4136','治多县','Zhiduo','1252','3136');
INSERT INTO job_provinceandcity VALUES('4137','囊谦县','Nangqian','1252','3137');
INSERT INTO job_provinceandcity VALUES('4138','曲麻莱县','Qumalai','1252','3138');
INSERT INTO job_provinceandcity VALUES('4139','德令哈市','Delingha','1254','3139');
INSERT INTO job_provinceandcity VALUES('4140','格尔木市','Geermu','1254','3140');
INSERT INTO job_provinceandcity VALUES('4141','乌兰县','Wulan','1254','3141');
INSERT INTO job_provinceandcity VALUES('4142','天峻县','Tianjun','1254','3142');
INSERT INTO job_provinceandcity VALUES('4143','都兰县','Dulan','1254','3143');
INSERT INTO job_provinceandcity VALUES('4144','西夏区','Xixia','1249','3144');
INSERT INTO job_provinceandcity VALUES('4145','金凤区','Jinfeng','1249','3145');
INSERT INTO job_provinceandcity VALUES('4146','兴庆区','Xingqing','1249','3146');
INSERT INTO job_provinceandcity VALUES('4147','永宁县','Yongning','1249','3147');
INSERT INTO job_provinceandcity VALUES('4148','贺兰县','Helan','1249','3148');
INSERT INTO job_provinceandcity VALUES('4149','大武口区','Dawukou','1247','3149');
INSERT INTO job_provinceandcity VALUES('4150','惠农区','Huinong','1247','3150');
INSERT INTO job_provinceandcity VALUES('4151','石炭井区','Shitanjing','1247','3151');
INSERT INTO job_provinceandcity VALUES('4152','平罗县','Pingluo','1247','3152');
INSERT INTO job_provinceandcity VALUES('4153','利通区','Litong','1248','3153');
INSERT INTO job_provinceandcity VALUES('4154','青铜峡市','Qingtongxia','1248','3154');
INSERT INTO job_provinceandcity VALUES('4155','灵武市','Lingwu','1248','3155');
INSERT INTO job_provinceandcity VALUES('4156','同心县','Tongxin','1248','3156');
INSERT INTO job_provinceandcity VALUES('4157','盐池县','Yanchi','1248','3157');
INSERT INTO job_provinceandcity VALUES('4158','中卫县','Zhongwei','1248','3158');
INSERT INTO job_provinceandcity VALUES('4159','中宁县','Zhongning','1248','3159');
INSERT INTO job_provinceandcity VALUES('4160','原州区','Yuanzhou','1250','3160');
INSERT INTO job_provinceandcity VALUES('4161','海原县','Haiyuan','1250','3161');
INSERT INTO job_provinceandcity VALUES('4162','西吉县','Xiji','1250','3162');
INSERT INTO job_provinceandcity VALUES('4163','隆德县','Longde','1250','3163');
INSERT INTO job_provinceandcity VALUES('4164','泾源县','Jingyuan','1250','3164');
INSERT INTO job_provinceandcity VALUES('4165','彭阳县','Pengyang','1250','3165');
INSERT INTO job_provinceandcity VALUES('4166','天山区','Tianshan','1326','3166');
INSERT INTO job_provinceandcity VALUES('4167','沙依巴克区','Shanongbake','1326','3167');
INSERT INTO job_provinceandcity VALUES('4168','新市区','Xinshi','1326','3168');
INSERT INTO job_provinceandcity VALUES('4169','水磨沟区','Shuimogou','1326','3169');
INSERT INTO job_provinceandcity VALUES('4170','头屯河区','Toutunhe','1326','3170');
INSERT INTO job_provinceandcity VALUES('4171','达坂城区','Dabancheng','1326','3171');
INSERT INTO job_provinceandcity VALUES('4172','东山区','Dongshan','1326','3172');
INSERT INTO job_provinceandcity VALUES('4173','乌鲁木齐县','Mulumuqi','1326','3173');
INSERT INTO job_provinceandcity VALUES('4174','克拉玛依区','Kelamayi','1335','3174');
INSERT INTO job_provinceandcity VALUES('4175','独山子区','Dushanzi','1335','3175');
INSERT INTO job_provinceandcity VALUES('4176','白碱滩区','Baijiantan','1335','3176');
INSERT INTO job_provinceandcity VALUES('4177','乌尔禾区','Wuerhe','1335','3177');
INSERT INTO job_provinceandcity VALUES('4178','石河子市','Shihezi','1364','3178');
INSERT INTO job_provinceandcity VALUES('4179','阿拉尔市','Alaer','1365','3179');
INSERT INTO job_provinceandcity VALUES('4180','图木舒克市','Tumushuke','1366','3180');
INSERT INTO job_provinceandcity VALUES('4181','五家渠市','Wujiaqu','1367','3181');
INSERT INTO job_provinceandcity VALUES('4182','吐鲁番市','Tulufan','1325','3182');
INSERT INTO job_provinceandcity VALUES('4183','托克逊县','Tuokexun','1325','3183');
INSERT INTO job_provinceandcity VALUES('4184','鄯善县','Shanshan','1325','3184');
INSERT INTO job_provinceandcity VALUES('4185','哈密市','Hami','1332','3185');
INSERT INTO job_provinceandcity VALUES('4186','伊吾县','Yiwu','1332','3186');
INSERT INTO job_provinceandcity VALUES('4187','巴里坤哈萨克自治县','Balikun','1332','3187');
INSERT INTO job_provinceandcity VALUES('4188','和田市','Hetian','1333','3188');
INSERT INTO job_provinceandcity VALUES('4189','和田县','Hetian','1333','3189');
INSERT INTO job_provinceandcity VALUES('4190','洛浦县','Luopu','1333','3190');
INSERT INTO job_provinceandcity VALUES('4191','民丰县','Minfeng','1333','3191');
INSERT INTO job_provinceandcity VALUES('4192','皮山县','Pishan','1333','3192');
INSERT INTO job_provinceandcity VALUES('4193','策勒县','Cele','1333','3193');
INSERT INTO job_provinceandcity VALUES('4194','于田县','Yutian','1333','3194');
INSERT INTO job_provinceandcity VALUES('4195','墨玉县','Moyu','1333','3195');
INSERT INTO job_provinceandcity VALUES('4196','阿克苏市','Akesu','1329','3196');
INSERT INTO job_provinceandcity VALUES('4197','温宿县','Wensu','1329','3197');
INSERT INTO job_provinceandcity VALUES('4198','沙雅县','Shaya','1329','3198');
INSERT INTO job_provinceandcity VALUES('4199','拜城县','Baicheng','1329','3199');
INSERT INTO job_provinceandcity VALUES('4200','阿瓦提县','Awati','1329','3200');
INSERT INTO job_provinceandcity VALUES('4201','库车县','Kuche','1329','3201');
INSERT INTO job_provinceandcity VALUES('4202','柯坪县','Keping','1329','3202');
INSERT INTO job_provinceandcity VALUES('4203','新和县','Xinhe','1329','3203');
INSERT INTO job_provinceandcity VALUES('4204','乌什县','Wushi','1329','3204');
INSERT INTO job_provinceandcity VALUES('4205','喀什市','Kashi','1336','3205');
INSERT INTO job_provinceandcity VALUES('4206','巴楚县','Bachu','1336','3206');
INSERT INTO job_provinceandcity VALUES('4207','泽普县','Zepu','1336','3207');
INSERT INTO job_provinceandcity VALUES('4208','伽师县','Jiashi','1336','3208');
INSERT INTO job_provinceandcity VALUES('4209','叶城县','Yecheng','1336','3209');
INSERT INTO job_provinceandcity VALUES('4210','岳普湖县','Yuepuhu','1336','3210');
INSERT INTO job_provinceandcity VALUES('4211','疏勒县','Shule','1336','3211');
INSERT INTO job_provinceandcity VALUES('4212','麦盖提县','Maigaiti','1336','3212');
INSERT INTO job_provinceandcity VALUES('4213','英吉沙县','Yingjisha','1336','3213');
INSERT INTO job_provinceandcity VALUES('4214','莎车县','Shache','1336','3214');
INSERT INTO job_provinceandcity VALUES('4215','疏附县','Shufu','1336','3215');
INSERT INTO job_provinceandcity VALUES('4216','塔什库尔干塔吉克自治县','Tashikuergantajike','1336','3216');
INSERT INTO job_provinceandcity VALUES('4217','阿图什市','Atushi','1328','3217');
INSERT INTO job_provinceandcity VALUES('4218','阿合奇县','Aheqi','1328','3218');
INSERT INTO job_provinceandcity VALUES('4219','乌恰县','Wuqia','1328','3219');
INSERT INTO job_provinceandcity VALUES('4220','阿克陶县','Aketao','1328','3220');
INSERT INTO job_provinceandcity VALUES('4221','库尔勒市','Kuerle','1334','3221');
INSERT INTO job_provinceandcity VALUES('4222','和静县','Hejing','1334','3222');
INSERT INTO job_provinceandcity VALUES('4223','尉犁县','Weili','1334','3223');
INSERT INTO job_provinceandcity VALUES('4224','和硕县','Heshuo','1334','3224');
INSERT INTO job_provinceandcity VALUES('4225','且末县','Qiemo','1334','3225');
INSERT INTO job_provinceandcity VALUES('4226','博湖县','Bohu','1334','3226');
INSERT INTO job_provinceandcity VALUES('4227','轮台县','Luntai','1334','3227');
INSERT INTO job_provinceandcity VALUES('4228','若羌县','Ruoqiang','1334','3228');
INSERT INTO job_provinceandcity VALUES('4229','焉耆回族自治县','Yanqi','1334','3229');
INSERT INTO job_provinceandcity VALUES('4230','昌吉市','Changji','1330','3230');
INSERT INTO job_provinceandcity VALUES('4231','阜康市','Fukang','1330','3231');
INSERT INTO job_provinceandcity VALUES('4232','米泉市','Miquan','1330','3232');
INSERT INTO job_provinceandcity VALUES('4233','奇台县','Qitai','1330','3233');
INSERT INTO job_provinceandcity VALUES('4234','玛纳斯县','Manasi','1330','3234');
INSERT INTO job_provinceandcity VALUES('4235','吉木萨尔县','Jimusaer','1330','3235');
INSERT INTO job_provinceandcity VALUES('4236','呼图壁县','Hutubi','1330','3236');
INSERT INTO job_provinceandcity VALUES('4237','木垒哈萨克自治县','Mulei','1330','3237');
INSERT INTO job_provinceandcity VALUES('4238','博乐市','Bole','1331','3238');
INSERT INTO job_provinceandcity VALUES('4239','精河县','Jinghe','1331','3239');
INSERT INTO job_provinceandcity VALUES('4240','温泉县','Wenquan','1331','3240');
INSERT INTO job_provinceandcity VALUES('4241','伊宁市','Yining','1327','3241');
INSERT INTO job_provinceandcity VALUES('4242','奎屯市','Kuitun','1327','3242');
INSERT INTO job_provinceandcity VALUES('4243','伊宁县','Yining','1327','3243');
INSERT INTO job_provinceandcity VALUES('4244','特克斯县','Tekesi','1327','3244');
INSERT INTO job_provinceandcity VALUES('4245','尼勒克县','Nileke','1327','3245');
INSERT INTO job_provinceandcity VALUES('4246','昭苏县','Zhaosu','1327','3246');
INSERT INTO job_provinceandcity VALUES('4247','新源县','Xinyuan','1327','3247');
INSERT INTO job_provinceandcity VALUES('4248','霍城县','Huocheng','1327','3248');
INSERT INTO job_provinceandcity VALUES('4249','巩留县','Gongliu','1327','3249');
INSERT INTO job_provinceandcity VALUES('4250','察布查尔锡伯自治县','Chabuchaer','1327','3250');
INSERT INTO job_provinceandcity VALUES('4251','塔城地区','Tacheng','1327','3251');
INSERT INTO job_provinceandcity VALUES('4252','阿勒泰地区','Aletai','1327','3252');
INSERT INTO job_provinceandcity VALUES('4253','香港','Hongkong','1373','3253');
INSERT INTO job_provinceandcity VALUES('4254','澳门','Macao','1374','3254');
INSERT INTO job_provinceandcity VALUES('4255','台湾','Taiwan','1375','3255');
INSERT INTO job_provinceandcity VALUES('4256','国外','Abroad','0','3256');
INSERT INTO job_provinceandcity VALUES('4261','香港岛','1','1031','3261');
INSERT INTO job_provinceandcity VALUES('4262','九龙','2','1031','3262');
INSERT INTO job_provinceandcity VALUES('4263','新界','3','1031','3263');
INSERT INTO job_provinceandcity VALUES('4264','中西区','a','4263','3264');
INSERT INTO job_provinceandcity VALUES('4265','东区','b','4263','3265');
INSERT INTO job_provinceandcity VALUES('4266','南区','c','4263','3266');
INSERT INTO job_provinceandcity VALUES('4267','湾仔区','c','4263','3267');
INSERT INTO job_provinceandcity VALUES('4271','国外','Aboard','4256','3271');
INSERT INTO job_provinceandcity VALUES('4272','国外','Aboard','4271','3272');
INSERT INTO job_provinceandcity VALUES('4273','澳门','Macao','1032','3273');
INSERT INTO job_provinceandcity VALUES('4274','澳门','Macao','4273','3274');
INSERT INTO job_provinceandcity VALUES('4275','台湾','Taiwan','1033','3275');
INSERT INTO job_provinceandcity VALUES('4276','台湾','Taiwan','4275','3276');

INSERT INTO job_siteconfig VALUES('1','嘉缘人才PHP2011版','中国嘉缘人才求职招聘网','http://192.168.1.200','备案中','','0,更新中','','images/logo.gif','default','default','utf-8','嘉缘','web@finereason.com','本站信息均由求职者、招聘者自由发布,{$FR_网站名称}不承担因内容的合法性及真实性所引起的一切争议和法律责任 <br />地址:{$FR_联系地址} 客服:{$FR_联系人} 电话:{$FR_联系电话} 传真:{$FR_联系传真}<br /> Copyright 2004-2011 FineReason.com Inc All Rights Reserved.<script src=\"/plus/count/mycount.php\"></script>','求职 招聘 招聘网站 人事代理 社会保险 人才租赁 劳务派遣 人才网站 工作 猎头 人力资源 培训 短信求职 无线求职 移动求职 英语 简历 招聘会 毕业生 大学生 外企招聘 HR专家咨询 职业顾问 短期员工聘用 大学生实习  job career hire employee recruitment headhunting training HR zhaopinwang gongzuo','求职 招聘 招聘网站 人事代理 社会保险 人才租赁 劳务派遣 人才网站 工作 猎头 人力资源 培训 短信求职 无线求职 移动求职 英语 简历 招聘会 毕业生 大学生 外企招聘 HR专家咨询 职业顾问 短期员工聘用 大学生实习  job career hire employee recruitment headhunting training HR zhaopinwang gongzuo','','/','admin','赵小姐','陕西省西安市太白南路5号','400-6606-156','029-85460076转600','0,暂时不能注册，维护中,0,1,0,1','0,,0,0,0,1','0,,0,0,0,1','0,,0,0,0,1','','1','smtp.ym.163.com','25','1','service@91rencai.com','0','service@91rencai.com','houzhirong','1','','0','html/','20','html','0','12','0','0','1','1,1,1,1,1,1','1,1,1,1,0,1','/','','1','1','822922400','1');

INSERT INTO job_smstemp VALUES('1','欢迎注册成为{$sitename}个人会员，用户名{$login}，密码{$ueserpwd}，请继续完善资料，祝您求职愉快！','个人会员注册通知','sms_person_reg','0');
INSERT INTO job_smstemp VALUES('2','欢迎注册成为{$sitename}企业会员，用户名{$login}，密码{$ueserpwd}，完善基本资料后就可以发布职位啦！','企业会员注册通知','sms_company_reg','0');
INSERT INTO job_smstemp VALUES('3','欢迎注册成为{$sitename}院校会员，用户名{$login}，密码{$ueserpwd}，完善基本资料后就可以发布职位啦！','院校会员注册通知','sms_school_reg','0');
INSERT INTO job_smstemp VALUES('4','欢迎注册成为{$sitename}培训会员，用户名{$login}，密码{$ueserpwd}，完善基本资料后就可以发布培训课程啦！','培训会员注册通知','sms_train_reg','0');
INSERT INTO job_smstemp VALUES('5','恭喜您！您的新密码设置成功，新密码为:{$ueserpwd},请牢记此密码或者登录{$sitename}进行修改。','找回密码短信','sms_get_pwd','0');
INSERT INTO job_smstemp VALUES('6','{$sitename}提醒您，您【{$login}】本次操作的手机验证码为：{$mobilekey} 请在5分钟内进行验证。','手机验证码通知短信','sms_get_mobilekey','0');
INSERT INTO job_smstemp VALUES('7','{$r_name}：{$comname}通知您面试“{$place}”职位。请登陆{$sitename}查看详细通知内容。','面试邀请通知短信','sms_in_send','0');
INSERT INTO job_smstemp VALUES('8','{$comname}：{$r_name}通过{$sitename}申请应聘贵公司“{$place}”职位,请尽快登陆网站查看详细。','申请职位通知短信','sms_resume_send','1');

INSERT INTO job_trade VALUES('1000','计算机软件','Computer Software','1');
INSERT INTO job_trade VALUES('1001','计算机硬件','Computer Hardware','2');
INSERT INTO job_trade VALUES('1002','计算机服务(系统、数据服务，维修)','Computer Services','3');
INSERT INTO job_trade VALUES('1003','通信/电信/网络设备','Communication/Telecom/Network Equipment','4');
INSERT INTO job_trade VALUES('1004','通信/电信运营、增值服务','Telecom Operators/Service Providers','5');
INSERT INTO job_trade VALUES('1005','互联网/电子商务','Internet/E-commerce','6');
INSERT INTO job_trade VALUES('1006','网络游戏','Network Game','7');
INSERT INTO job_trade VALUES('1007','电子技术/半导体/集成电路','Electronic technology/semiconductor/integrated cir','8');
INSERT INTO job_trade VALUES('1008','仪器仪表/工业自动化','Instrumentation/industrial automation','9');
INSERT INTO job_trade VALUES('1009','会计/审计','Accounting/audit','10');
INSERT INTO job_trade VALUES('1010','金融/投资/证券','Financial/investment/securities','11');
INSERT INTO job_trade VALUES('1011','银行','Bank','12');
INSERT INTO job_trade VALUES('1012','保险','Insurance','13');
INSERT INTO job_trade VALUES('1013','贸易/进出口','Trade/Import and export','14');
INSERT INTO job_trade VALUES('1014','批发/零售','Wholesale/retail','15');
INSERT INTO job_trade VALUES('1015','快速消费品(食品,饮料,化妆品)','Fast moving consumer goods (food,beverage,cosmet)','16');
INSERT INTO job_trade VALUES('1016','服装/纺织/皮革','Dress/textile/leather','17');
INSERT INTO job_trade VALUES('1017','家具/家电/工艺品/玩具/珠宝','Furniture/Homeappliance/Toys/jewelry','18');
INSERT INTO job_trade VALUES('1018','办公用品及设备','Office supplies and equipment','19');
INSERT INTO job_trade VALUES('1019','机械/设备/重工','Machinery/Equipment/Heavy Industries','20');
INSERT INTO job_trade VALUES('1020','汽车及零配件','Cars and spare parts','21');
INSERT INTO job_trade VALUES('1021','制药/生物工程','Pharmaceuticals/Biotechnology','22');
INSERT INTO job_trade VALUES('1022','医疗/护理/保健/卫生','Healthcare/Medicine/Public Health','23');
INSERT INTO job_trade VALUES('1023','医疗设备/器械','Medical Facilities/Equipment','24');
INSERT INTO job_trade VALUES('1024','广告','Advertising','25');
INSERT INTO job_trade VALUES('1025','公关/市场推广/会展','Public Relations/Marketing/Exhibitions','26');
INSERT INTO job_trade VALUES('1026','影视/媒体/艺术','Films/Media/Arts','27');
INSERT INTO job_trade VALUES('1027','文字媒体/出版','Print Media/Publishing','28');
INSERT INTO job_trade VALUES('1028','房地产开发','Real estate development','29');
INSERT INTO job_trade VALUES('1029','建筑与工程','Building and Engineering','30');
INSERT INTO job_trade VALUES('1030','家居/室内设计/装潢','Interior Design/Decoration','31');
INSERT INTO job_trade VALUES('1031','物业管理/商业中心','Property Management','32');
INSERT INTO job_trade VALUES('1032','中介服务','Intermediary services','33');
INSERT INTO job_trade VALUES('1033','专业服务(咨询，人力资源)','Professional service(Consulting,human resources)','34');
INSERT INTO job_trade VALUES('1034','外包服务','Outsourcing service','35');
INSERT INTO job_trade VALUES('1035','检测，认证','Testing,Certification','36');
INSERT INTO job_trade VALUES('1036','法律','Law','37');
INSERT INTO job_trade VALUES('1037','教育/培训','Education/Trainning','38');
INSERT INTO job_trade VALUES('1038','学术/科研','Academic/research','39');
INSERT INTO job_trade VALUES('1039','餐饮业','Catering Industry','40');
INSERT INTO job_trade VALUES('1040','酒店/旅游','Hospitality/Tourism','40');
INSERT INTO job_trade VALUES('1041','娱乐/休闲/体育','Entertainment/Leisure/Sports','41');
INSERT INTO job_trade VALUES('1042','美容/保健','Beauty/Health','42');
INSERT INTO job_trade VALUES('1043','生活服务','Life Services','43');
INSERT INTO job_trade VALUES('1044','交通/运输/物流','Traffic/transportation/logistics','44');
INSERT INTO job_trade VALUES('1045','航天/航空','Aerospace/Aviation/Airlines','45');
INSERT INTO job_trade VALUES('1046','石油/化工/矿产/地质','Oils/Chemicals/Mines/Geology','46');
INSERT INTO job_trade VALUES('1047','采掘业/冶炼','Mining/smelting','47');
INSERT INTO job_trade VALUES('1048','电力/水利','Power/water conservancy','48');
INSERT INTO job_trade VALUES('1049','原材料和加工','Raw Materials &Processing','49');
INSERT INTO job_trade VALUES('1050','政府','Government','50');
INSERT INTO job_trade VALUES('1051','非盈利机构','Nonprofit organizations','51');
INSERT INTO job_trade VALUES('1052','环保','Environmental Protection','52');
INSERT INTO job_trade VALUES('1053','农业/渔业/林业','Agriculture','53');
INSERT INTO job_trade VALUES('1054','多元化业务集团公司','Diversified business group company','54');
INSERT INTO job_trade VALUES('1055','其他行业','Other Trade','55');

INSERT INTO job_vote VALUES('43','上人才网，网上投递简历','0000-00-00','0000-00-00','','0','#000088','20','41');
INSERT INTO job_vote VALUES('44','托朋友、找关系帮忙介绍','0000-00-00','0000-00-00','','0','#8800FF','54','41');
INSERT INTO job_vote VALUES('45','参加各类招聘会投递简历','0000-00-00','0000-00-00','','0','#CCAA00','1','41');
INSERT INTO job_vote VALUES('42','找当地的中介介绍工作','0000-00-00','0000-00-00','','0','#0088FF','18','41');
INSERT INTO job_vote VALUES('41','您使用哪种方式查找工作？','2010-07-18','2010-12-31','radio','1','','0','0');
