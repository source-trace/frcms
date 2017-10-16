<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$goto=urlencode($_SERVER['REQUEST_URI']);
$username=_getcookie('user_login');
if($username==''){
    echo "<script language=JavaScript>{location.href='{$cfg['path']}login.php?goto=$goto';}</script>";
    exit();
}else{
    $userpass=_getcookie('user_pass');
    $rs = $db->get_one("select m_id,m_flag,DATEDIFF(m_enddate,'".date('Y-m-d')."') as end,m_typeid,m_groupid,m_balance,m_integral,m_resumenums,m_mysendnums,m_mysendnum,m_myinterviewnums,m_myinterviewnum,m_myfavoritenums,m_myfavoritenum,m_letternums,m_contactnums,m_contactnum,m_expertnums,m_expertnum,m_recyclenums,m_recyclenum,m_hirenums,m_hirenum,m_hirenums,m_hirenum,m_smsnums,m_smsnum,m_operator from {$cfg['tb_pre']}member where m_login='$username' and m_pwd='$userpass' limit 0,1");
    if($rs){
        $Memberid=$rs['m_id'];$mflag=$rs['m_flag'];$mend=$rs['end'];$mcomm=$rs['m_comm'];$mcend=$rs['cend'];
        $Mresumenums=$rs['m_resumenums'];$Mletternums=$rs['m_letternums'];
		$Mmysendnums=$rs['m_mysendnums'];$Mmysendnum=$rs['m_mysendnum'];
		$Mmyinterviewnums=$rs['m_myinterviewnums'];$Mmyinterviewnum=$rs['m_myinterviewnum'];
		$Mmyfavoritenums=$rs['m_myfavoritenums'];$Mmyfavoritenum=$rs['m_myfavoritenum'];
		$Mcontactnums=$rs['m_contactnums'];$Mcontactnum=$rs['m_contactnum'];
        $Mexpertnums=$rs['m_expertnums'];$Mexpertnum=$rs['m_expertnum'];
        $Mrecyclenums=$rs['m_recyclenums'];$Mrecyclenum=$rs['m_recyclenum'];
        $Mhirenums=$rs['m_hirenums'];$Mhirenum=$rs['m_hirenum'];
		$Msmsnums=$rs['m_smsnums'];$Msmsnum=$rs['m_smsnum'];
        $Mbalance=$rs['m_balance'];$Mintegral=$rs['m_integral'];
        if($mend<0){
            echo "<script language=JavaScript>{alert('会员服务已到期，无法进行下一步操作，请联系客服进行升级！');location.href='{$cfg['path']}index.php';}</script>";
            exit(); 
        }
        if($mflag==0){$MemberMsg="帐户未通过审核!请完善您的信息或联系客服专员.";}else{$MemberMsg="帐户已通过审核!您可以使用本系统提供的服务.";}
        if($mend<5&&$mend>0){$MemberMsg="您的会员服务将在{$mend}天后到期!请尽快联系客服专员续费升级.";}elseif($mend<0){$MemberMsg="您的会员服务已到期!请尽快联系客服专员续费升级.";}
        $Gid=$Gname=$Gterm=$Gunit='';
        $Glimit=$Gintegral=Array();
        $rsg = $db->get_one("select g_id,g_name,g_term,g_unit,g_limit,g_integral from {$cfg['tb_pre']}group where g_typeid=$rs[m_typeid] and g_id=$rs[m_groupid] limit 0,1");
        if($rsg){
            $Gid=$rsg['g_id'];$Gname=$rsg['g_name'];$Gterm=$rsg['g_term'];$Gunit=$rsg['g_unit'];$Glimit=explode(",",$rsg['g_limit']);$Gintegral=explode(",",$rsg['g_integral']);
        }
        $Moperator=$rs['m_operator'];
        if($Moperator){
            $rsg = $db->get_one("select a_name,a_tel,a_qq from {$cfg['tb_pre']}admin where a_user='$Moperator' and a_kf=1 limit 0,1");
            if($rsg){
                $ContactMan=$rsg['a_name'];$ContactPhone=$rsg['a_tel'];$ContactQq=$rsg['a_qq'];
            }
        }
    }else{
        echo "<script language=JavaScript>{location.href='{$cfg['path']}login.php';}</script>";
        exit();
    }
}
?>