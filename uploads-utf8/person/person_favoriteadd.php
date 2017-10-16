<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if(!$Glimit[0]){
    echo "<script language=javascript>alert('您所在的会员组不能收藏职位，请联系网站客服进行升级！');location.href='javascript:history.back()';</script>";exit();
}
$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
if($do=='favorite'){
    $checksnum=count(explode(',',$checks));
	if($Glimit[1]&&$Mmyfavoritenum<$checksnum){showmsg("您的职位收藏可用数量不足，请返回重新选择！","-1",0,2000);exit();}
    $checks=explode(',',$checks);
    foreach($checks as $k){
        $rs=$db ->get_one("select f_id from {$cfg['tb_pre']}myfavorite where f_pmember='$username' and f_hid=$k limit 0,1");
        if(!$rs){
            //记录并扣除发送数
            if($Glimit[1]==0){
                $db ->query("update {$cfg['tb_pre']}member set m_myfavoritenums=m_myfavoritenums+1,m_activedate=NOW() where m_login='$username'");
            }else{
                $db ->query("update {$cfg['tb_pre']}member set m_myfavoritenums=m_myfavoritenums+1,m_myfavoritenum=m_myfavoritenum-1,m_activedate=NOW() where m_login='$username'");
            }
            $rss=$db->get_one("select h_id,h_comname,h_place,h_member from {$cfg['tb_pre']}hire where h_id=$k order by h_adddate desc limit 0,1");
            if($rss){
                $hireid=$rss['h_id'];$comname=$rss['h_comname'];$place=$rss['h_place'];$cmember=$rss['h_member'];
                $db ->query("INSERT INTO {$cfg['tb_pre']}myfavorite (f_hid,f_comname,f_place,f_adddate,f_pmember,f_cmember) VALUES('$hireid','$comname','$place',NOW(),'$username','$cmember')");
            $integral=$Gintegral[0];
			require_once(FR_ROOT.'/inc/paylog.inc.php');
			upintegral($Memberid,"收藏职位【{$place}】获得积分+$integral",$integral);
            }
        }
    }
    showmsg('恭喜您收藏成功！',"?mpage=person_favorite&show=2",0,2000);exit();
}
?>