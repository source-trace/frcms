<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$show=isset($show)?intval($show):0;
switch($user_type){
	case 'pmember':
	$menu=array(
		'会员中心'=>array(
			'会员中心首页,?do=main',
			'基本资料管理,?mpage=person_info',
			'个人照片上传,?mpage=person_photo',
			'上传职场风采,?mpage=person_photos',
			//'查看收到的留言,?mpage=person_guestbook',
			//'查看发出的留言,?mpage=person_guestbook',
			'在线充值记录,?mpage=onlinepay&amp;m=main',
			'消费记录,?mpage=consume&amp;m=main',
            '我的好友列表,?mpage=invite&amp;m=main',
            '我的积分记录,?mpage=integrallist&amp;m=main',
		),
		'简历管理'=>array(
			'求职简历管理,?mpage=person_resume',
			'简历保密设置,?mpage=person_openresume',
			//'简历模板设置,?mpage=person_template',
			'资格证书上传,?mpage=person_certificate',
			//'上传word附件,?mpage=person_word',
		),
		'求职管理'=>array(
			'定义求职信模板,?mpage=person_letters',
			'投递简历记录,?mpage=person_works',
			'收到的面试通知,?mpage=person_interview',
			'收藏的职位,?mpage=person_favorite',
			'外发简历记录,?mpage=person_sendresume',
			'简历被浏览记录,?mpage=person_rbrower',
		),
		'职位查询'=>array(
			'最新职位,?mpage=person_newhire',
			'最新猎头职位,?mpage=person_newhrhire',
			'按职位类别查询,?mpage=person_searchhire&t=position',
			'按职位关键词查询,?mpage=person_searchhire&t=keyword',
			'按单位行业查询,?mpage=person_searchhire&t=trade',
			'按单位名称查询,?mpage=person_searchhire&t=comname',
			'按单位编号查询,?mpage=person_searchhire&t=comid',
			'按职位编号查询,?mpage=person_searchhire&t=id',
			'定义职位搜索器,?mpage=person_addsearch',
			'职位综合查询,?mpage=person_searchhire',
		),
		'安全设置'=>array(
			'修改用户名/密码,?mpage=person_pwd',
			'修改邮箱地址,?mpage=person_email',
			//'屏蔽部分单位,?mpage=person_searchworks',
		),
	);
	break;
	case 'cmember':
    $rs = $db->get_one("select count(m_id) as n from {$cfg['tb_pre']}myreceive where m_cmember='$username' and m_reply=0 limit 0,1");
    $Mmyreceivenew=$rs['n'];$receivenew=$Mmyreceivenew?'(<span style="color:#F00">'.$Mmyreceivenew.'</span>)':'';
	$menu=array(
		'会员中心'=>array(
			'会员中心首页,?do=main',
			'基本资料管理,?mpage=company_info',
			'单位部门管理,?mpage=company_deptlist',
			'单位LOGO上传,?mpage=company_uploadlogo',
			'企业形象展示,?mpage=company_photos',
			'营业执照上传,?mpage=company_licence',
			'企业电子地图,?mpage=company_map',
			//'查看收到的留言,?mpage=company_guestbook',
			//'查看发出的留言,?mpage=company_guestbook',
			'在线充值记录,?mpage=onlinepay&amp;m=main',
			'消费记录,?mpage=consume&amp;m=main',
            '我的好友列表,?mpage=invite&amp;m=main',
            '我的积分记录,?mpage=integrallist&amp;m=main',
		),
		'招聘管理'=>array(
			'招聘职位管理,?mpage=company_hirelist',
			'职位被浏览记录,?mpage=company_rbrower',
			'收到应聘简历'.$receivenew.',?mpage=company_works',
			'邀请面试记录,?mpage=company_interview',
			'已下载的简历,?mpage=company_myresume',
			'企业人才库,?mpage=company_myexpert',
			'简历回收站,?mpage=company_recycle',
		),
		//'简历分析'=>array(
//			'按求职意向分析,?mpage=company_count&t=',
//			'按学历分析,?mpage=company_count&t=edu',
//			'按年龄分析,?mpage=company_count&t=',
//			'按性别分析,?mpage=company_count&t=sex',
//			'按所学专业分析,?mpage=company_count&t=',
//			'按月薪要求分析,?mpage=company_count&t=pay',
//		),
		'简历查询'=>array(
			'最新登记的简历,?mpage=company_newresume',
			'最新高级人才,?mpage=company_newresume&t=1',
			'按求职职位查询,?mpage=company_searchresume&t=position',
			'按工作经历查询,?mpage=company_searchresume&t=work',
			'按专业模糊查询,?mpage=company_searchresume&t=profession',
			'按人才所在地查询,?mpage=company_searchresume&t=seat',
			'按关键词查询,?mpage=company_searchresume&t=keyword',
			'按姓名查询,?mpage=company_searchresume&t=name',
			'按简历编号查询,?mpage=company_searchresume&t=id',
			'定义简历搜索器,?mpage=company_addsearch',
			'简历综合查询,?mpage=company_searchresume',
		),
		'服务管理'=>array(
			'会员服务申请,?mpage=company_service',
			'申请服务管理,?mpage=company_services',
			//'申请增值服务,?mpage=company_services',
			//'申请购买广告位,?mpage=company_services',
		),
		'安全设置'=>array(
			'修改用户名/密码,?mpage=company_pwd',
			'修改邮箱地址,?mpage=company_email',
		),
	);
	break;
	case 'smember':
	$menu=array(
		'会员中心'=>array(
			'会员中心首页,?do=main',
			'基本资料管理,?mpage=school_info',
			'院校LOGO上传,?mpage=school_uploadlogo',
			'上传院校照片,?mpage=school_photos',
            '电子地图标注,?mpage=school_map',
			//'查看收到的留言,?mpage=person_guestbook',
			//'查看发出的留言,?mpage=person_guestbook',
			'在线充值记录,?mpage=onlinepay&amp;m=main',
			'消费记录,?mpage=consume&amp;m=main',
            '我的好友列表,?mpage=invite&amp;m=main',
            '我的积分记录,?mpage=integrallist&amp;m=main',
		),
		'专业设置'=>array(
			'添加专业,?mpage=department_list&t=add',
			'专业管理,?mpage=department_list',
		),
		'专家教授'=>array(
			'添加专家教授,?mpage=professor_list&t=add',
			'专家教授管理,?mpage=professor_list',
		),
		'毕业生管理'=>array(
			'毕业生添加,?mpage=students_list&t=add',
			'毕业生管理,?mpage=students_list',
		),
		'招生简章'=>array(
			'招生简章添加,?mpage=requires_list&t=add',
			'招生简章管理,?mpage=requires_list'
		),		
		
		'安全设置'=>array(
			'修改用户名/密码,?mpage=school_pwd',
			'修改邮箱地址,?mpage=school_email',
			
		),
	);
	break;
	case 'tmember':
	$menu=array(
		'会员中心'=>array(
			'会员中心首页,?do=main',
			'基本资料管理,?mpage=train_info',
			'机构LOGO上传,?mpage=train_uploadlogo',
			'上传机构照片,?mpage=train_photos',
            '电子地图标注,?mpage=train_map',
			'在线充值记录,?mpage=onlinepay&amp;m=main',
			'消费记录,?mpage=consume&amp;m=main',
            '我的好友列表,?mpage=invite&amp;m=main',
            '我的积分记录,?mpage=integrallist&amp;m=main',
		),
		'课程设置'=>array(
			'添加培训课程,?mpage=course_list&t=add',
			'培训课程管理,?mpage=course_list',
		),
		'讲师管理'=>array(
			'添加培训师,?mpage=trainer_list&t=add',
			'培训师管理,?mpage=trainer_list',
		),
		'报名管理'=>array(
			'报名管理,?mpage=signup_list'
		),
		'安全设置'=>array(
			'修改用户名/密码,?mpage=train_pwd',
			'修改邮箱地址,?mpage=train_email',
			
		),
	);
	break; 
	default:
	$menu=array(
		'会员中心'=>array(
			'会员中心首页,?do=main',
			'基本资料管理,?mpage=person_info',
			'个人照片上传,?mpage=person_photo',
			'上传职场风采,?mpage=person_photos',
			//'查看收到的留言,?mpage=person_guestbook',
			//'查看发出的留言,?mpage=person_guestbook',
			'在线充值记录,?mpage=person_onlinepay',
			//'消费记录,?mpage=person_guestbook',
		),
		'简历管理'=>array(
			'求职简历管理,?mpage=person_resume',
			'简历保密设置,?mpage=person_openresume',
			'简历模板设置,?mpage=person_template',
			'资格证书上传,?mpage=person_certificate',
			//'上传word附件,?mpage=person_word',
		),
		'求职管理'=>array(
			'定义求职信模板,?mpage=person_letters',
			'投递简历记录,?mpage=person_works',
			'收到的面试通知,?mpage=person_interview',
			'收藏的职位,?mpage=person_favorite',
			'外发简历记录,?mpage=person_sendresume',
			'简历被浏览记录,?mpage=person_rbrower',
		),
		'职位查询'=>array(
			'最新职位,?mpage=person_newhire',
			'最新猎头职位,?mpage=person_newhrhire',
			'按职位类别查询,?mpage=person_searchhire&t=position',
			'按职位关键词查询,?mpage=person_searchhire&t=keyword',
			'按单位行业查询,?mpage=person_searchhire&t=trade',
			'按单位名称查询,?mpage=person_searchhire&t=comname',
			'按单位编号查询,?mpage=person_searchhire&t=comid',
			'按职位编号查询,?mpage=person_searchhire&t=id',
			'定义职位搜索器,?mpage=person_addsearch',
			'职位综合查询,?mpage=person_searchhire',
		),
		'安全设置'=>array(
			'修改用户名/密码,?mpage=person_pwd',
			'修改邮箱地址,?mpage=person_email',
			//'屏蔽部分单位,?mpage=person_searchworks',
		),
	);
} 
echo "	<div class=\"memmenul\">\r\n";
$i=0;
foreach($menu as $k=>$v){
    echo "		<div class=\"memmenutit\" onclick=\"showmenu($i);\"><span>$k</span></div>\r\n";
    echo "		<ul id=\"show$i\"";
    if($show!=$i) echo " style=\"display:none\"";
    echo ">\r\n";
    foreach($v as $_k){
    $ks=explode(',',$_k);
    echo "			<li><a href=\"$ks[1]&show=$i\"><img src=\"../skin/member/icon1.gif\" border=\"0\" /> $ks[0]</a></li>\r\n";
    }
    echo "		</ul>\r\n";
$i++;
}
echo "		<div class=\"memmenutit\" onclick=\"showmenu($i);\"><span>安全退出</span></div>\r\n";
echo "		<ul id=\"show$i\"";
if($show!=$i) echo " style=\"display:none\"";
echo ">\r\n";
echo "			<li><a href=\"../login.php?do=loginout\"><img src=\"../skin/member/icon1.gif\" border=\"0\" /> 安全退出</a></li>\r\n";
echo "		</ul>\r\n";
echo "	</div>\r\n";
echo "    <div class=\"memmenul\" style=\"border:1px #FF9900 solid; background-color:#FFFFE8; line-height:150%;\">\r\n";
echo "        <li style=\"margin:0 4px;\">$MemMsg</li>\r\n";
echo "    </div>\r\n";
?>