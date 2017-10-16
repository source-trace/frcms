<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
function paymoney($UName='',$nValue=0){
    global $cfg,$db;
    $rs=$db->get_one("select m_balance from {$cfg['tb_pre']}member where m_login='$UName'");
    if($rs){
        $HavePoint=$rs['m_balance'];
        $nValue=intval($nValue);
        if($nValue>$HavePoint){
            $restr="<script>alert(\"余额不足!\\n当前消费金额$nValue\\n您的剩余金额$HavePoint\");history.back();</script>";
        }else{
            $HavePoint=$HavePoint-$nValue;
            $db->query("update {$cfg['tb_pre']}member set m_balance=$HavePoint where m_login='$UName'");
            $restr="<script>alert(\"操作成功!\\n当前消费金额$nValue\\n您的剩余金额$HavePoint\");</script>";
        }
    }else{
        return '';
    }
    return $restr;
}
function payintegral($UName='',$nValue=0){
    global $cfg,$db;
    $rs=$db->get_one("select m_integral from {$cfg['tb_pre']}member where m_login='$UName'");
    if($rs){
        $HavePoint=$rs['m_integral'];
        $nValue=intval($nValue);
        echo $nValue;
        if($nValue>$HavePoint){
            return false;
        }else{
            $HavePoint=$HavePoint-$nValue;
            $db->query("update {$cfg['tb_pre']}member set m_integral=$HavePoint where m_login='$UName'");
            return true;
        }
    }else{
        return '';
    }
    return true;
}
function paylog($UName,$sValue='',$DoType,$stype=0){
    global $cfg,$db,$operator;
    $trueIP=getip();
    if($DoType==1){$DoWhere='后台';}else{$DoWhere='前台';}
    $db->query("INSERT INTO {$cfg['tb_pre']}consume(c_content,c_adddate,c_ip,c_member,c_type,c_operator,c_stype) values('$sValue',NOW(),'$trueIP','$UName','$DoWhere','$operator','$stype')");
    return true;
}
function upintegral($mid,$svalue='',$nvalue=0){
    global $cfg,$db;
	$user=outinfo("{$cfg['tb_pre']}member","m_id","m_login",$mid,"num");
	paylog($user,$svalue,0,1);
	$db->query("UPDATE {$cfg['tb_pre']}member SET m_integral=m_integral+$nvalue WHERE m_id=$mid");
}
function servicelog($gname,$startdate,$enddate,$mid,$type,$money){
    global $cfg,$db,$operator;
    $ip=getip();
    $db->query("INSERT INTO {$cfg['tb_pre']}service_log(s_gname,s_startdate,s_enddate,s_mid,s_operator,s_adddate,s_type,s_ip,s_money) values('$gname','$startdate','$enddate','$mid','$operator',NOW(),'$type','$ip','$money')");
    return true;
}
