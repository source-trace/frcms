<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
require_once("alipay_class.php");
$rs = $db->get_one("select p_no,p_shid,p_key from {$cfg['tb_pre']}payonline where p_chk=1 and (p_flag=1 or p_flag=5)");
if($rs){
    $security_code=base64_decode($rs["p_key"]);
    $seller_email=base64_decode($rs["p_no"]);
    $partner=base64_decode($rs["p_shid"]);
}else{
    showmsg('支付失败！接口故障请联系管理员。',"javascript:;");exit;
}
$_input_charset  = $cfg['charset'];						       //字符编码格式 目前支持 GBK 或 utf-8
$transport       = "http";						       //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$sign_type       = "MD5";						       //加密方式 不需修改

$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();
if($verify_result) {
    $dingdan  = $out_trade_no;  //获取定单号
    $total_fee     = isset($price)?$price:$total_fee;
    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS'||$_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
        $rs1 = $db->get_one("select p_member,p_class from {$cfg['tb_pre']}payback where p_oid='$dingdan' and p_isucceed=0");
        if($rs1){
            $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=1 where p_oid='$dingdan'");
            //会员账号入款
            switch($rs1['p_class']){
                case 'pmember':$mtype=1;break;
        		case 'cmember':$mtype=2;break;
                case 'smember':$mtype=3;break;
        		case 'tmember':$mtype=4;break;
                default:$mtype=0;
            }
            $db ->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$total_fee where m_login='$rs1[p_member]' and m_typeid=$mtype");
        }else{
            showmsg('对不起，该支付已经结算完毕！',"javascript:;");exit;
        }
	   //支付成功
       showmsg("支付成功！支付金额为：$total_fee","javascript:;");exit;
    }else{
        showmsg("支付金额为：{$total_fee}，交易状态为：{$_GET['trade_status']}","javascript:;");exit;
    }
}else{
	showmsg('支付失败！如果您的账户已扣款请联系管理员确认是否支付成功。',"javascript:;");exit;
}
?>