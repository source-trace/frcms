<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$cmdno			= trim($cmdno);
$pay_result		= trim($pay_result);
$pay_info		= trim($pay_info);
$bill_date		= trim($date);
$bargainor_id	= trim($bargainor_id);
$transaction_id	= trim($transaction_id);
$sp_billno		= trim($sp_billno);
$total_fee		= trim($total_fee);
$fee_type		= trim($fee_type);
$attach			= trim($attach);
$md5_sign		= trim($sign);
echo "<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\">";
$rs = $db->get_one("select p_no,p_key from {$cfg['tb_pre']}payonline where p_chk=1 and p_flag=3");
if($rs){
    $ipayno=base64_decode($rs["p_no"]);
    $ipaykey=base64_decode($rs["p_key"]);
}else{
    showmsg('支付失败！接口故障请联系管理员。',"javascript:;");exit;
}
$strResponseText  = "cmdno=$cmdno&pay_result=$pay_result&date=$bill_date&transaction_id=$transaction_id&sp_billno=$sp_billno&total_fee=$total_fee&fee_type=$fee_type&attach=$attach&key=$ipaykey";
$md5string=strtoupper(md5($strResponseText)); //拼凑加密串
if($ipayno != $bargainor_id )
{
  	showmsg('支付失败！错误的商户号。',"javascript:;");exit;
}
if ($md5_sign==$md5string)
{	
   if($pay_result=="0")
	{
	   $rs1 = $db->get_one("select p_member,p_class from {$cfg['tb_pre']}payback where p_oid='$sp_billno' and p_isucceed=0");
        if($rs1){
            $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=1 where p_oid='$sp_billno'");
            //会员账号入款
            switch($rs1['p_class']){
                case 'pmember':$mtype=1;break;
        		case 'cmember':$mtype=2;break;
                case 'smember':$mtype=3;break;
        		case 'tmember':$mtype=4;break;
                default:$mtype=0;
            }
            $total=$total_fee/100;
            $db ->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$total where m_login='$rs1[p_member]' and m_typeid=$mtype");
            
        }else{
            showmsg('对不起，该支付已经结算完毕！',"javascript:;");exit;
        }
	   //支付成功
       showmsg("支付成功！支付金额为：".$total_fee/100,"javascript:;");exit;
	}
}else{
    $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=2 where p_oid=$sp_billno");
	showmsg('支付失败！如果您的账户已扣款请联系管理员确认是否支付成功。',"javascript:;");exit;
}
?>