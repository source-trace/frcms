<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$p1_MerId	=	trim($p1_MerId);
$r0_Cmd		=	trim($r0_Cmd); 
$r1_Code	=	trim($r1_Code); 
$r2_TrxId	=	trim($r2_TrxId); 
$r3_Amt		=	trim($r3_Amt); 
$r4_Cur		=	trim($r4_Cur); 
$r5_Pid		=	trim($r5_Pid); 
$r6_Order	=	trim($r6_Order); 
$r7_Uid		=	trim($r7_Uid); 
$r8_MP		=	trim($r8_MP); 
$r9_BType	=	trim($r9_BType); 	
$hmac		=	trim($hmac);  
$rs = $db->get_one("select p_no,p_key from {$cfg['tb_pre']}payonline where p_chk=1 and p_flag=4");
if($rs){
    $ipayno=base64_decode($rs["p_no"]);
    $ipaykey=base64_decode($rs["p_key"]);
}else{
    showmsg('支付失败！接口故障请联系管理员。',"javascript:;");exit;
}
$text = $ipayno.$r0_Cmd.$r1_Code.$r2_TrxId.$r3_Amt.$r4_Cur.$r5_Pid.$r6_Order.$r7_Uid.$r8_MP.$r9_BType;
$key = iconv("GB2312","UTF-8",$ipaykey);
$data = iconv("GB2312","UTF-8",$text);    
$b = 64; // byte length for md5
if (strlen($key) > $b) {
$key = pack("H*",md5($key));
}
$key = str_pad($key, $b, chr(0x00));
$ipad = str_pad('', $b, chr(0x36));
$opad = str_pad('', $b, chr(0x5c));
$k_ipad = $key ^ $ipad ;
$k_opad = $key ^ $opad;
$bRet = md5($k_opad . pack("H*",md5($k_ipad . $data)));
if($ipayno != $p1_MerId )
{
  	showmsg('支付失败！错误的商户号。',"javascript:;");exit;
}
if ($hmac==$bRet)
{	
   if($r1_Code=="1")
	{
        $rs1 = $db->get_one("select p_member,p_class from {$cfg['tb_pre']}payback where p_oid='$r6_Order' and p_isucceed=0");
        if($rs1){
            $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=1,p_pmode='' where p_oid='$r6_Order'"); 
            //会员账号入款
            switch($rs1['p_class']){
                case 'pmember':$mtype=1;break;
        		case 'cmember':$mtype=2;break;
                case 'smember':$mtype=3;break;
        		case 'tmember':$mtype=4;break;
                default:$mtype=0;
            }
            $db ->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$r3_Amt where m_login='$rs1[p_member]' and m_typeid=$mtype");
            if($r9_BType=="1"){
                
            }elseif($r9_BType=="2"){
            echo "success";
            } 
        }else{
        showmsg('对不起，该支付已经结算完毕！',"javascript:;");exit;
        }
	   //支付成功
       showmsg("支付成功！支付金额为：$r3_Amt","javascript:;");exit;
	}
}else{
    $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=2,p_pmode='' where p_oid=$r6_Order");
	showmsg('支付失败！如果您的账户已扣款请联系管理员确认是否支付成功。',"javascript:;");exit;
}
?>