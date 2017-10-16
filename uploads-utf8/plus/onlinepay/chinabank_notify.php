<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$v_oid     =trim($v_oid);      
$v_pmode   =trim($v_pmode);      
$v_pstatus =trim($v_pstatus);      
$v_pstring =trim($v_pstring);      
$v_amount  =trim($v_amount);     
$v_moneytype  =trim($v_moneytype);     
$remark1   =trim($remark1);     
$remark2   =trim($remark2);     
$v_md5str  =trim($v_md5str);     
$rs = $db->get_one("select p_key from {$cfg['tb_pre']}payonline where p_chk=1 and p_flag=2");
if($rs){
    $ipaykey=base64_decode($rs["p_key"]);
}else{
    showmsg('支付失败！接口故障请联系管理员。',"javascript:;");exit;
}
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$ipaykey)); //拼凑加密串
if ($v_md5str==$md5string)
{	
   if($v_pstatus=="20")
	{
	   $rs1 = $db->get_one("select p_member,p_class from {$cfg['tb_pre']}payback where p_oid='$v_oid' and p_isucceed=0");
        if($rs1){
            $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=1,p_pmode='$v_pmode' where p_oid='$v_oid'");
            //会员账号入款
            switch($rs1['p_class']){
                case 'pmember':$mtype=1;break;
        		case 'cmember':$mtype=2;break;
                case 'smember':$mtype=3;break;
        		case 'tmember':$mtype=4;break;
                default:$mtype=0;
            }
            $db ->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$v_amount where m_login='$rs1[p_member]' and m_typeid=$mtype");
        }else{
            showmsg('对不起，该支付已经结算完毕！',"javascript:;");exit;
        }
	   //支付成功
       showmsg("支付成功！支付金额为：$v_amount","javascript:;");exit;
	}
}else{
    $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=2,p_pmode='$v_pmode' where p_oid=$v_oid");
	showmsg('支付失败！如果您的账户已扣款请联系管理员确认是否支付成功。',"javascript:;");exit;
}
?>