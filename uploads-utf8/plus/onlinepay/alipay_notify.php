<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
require_once("alipay_class.php");
$rs = $db->get_one("select p_no,p_shid,p_key from {$cfg['tb_pre']}payonline where p_chk=1 and (p_flag=1 or p_flag=5)");
if($rs){
    $security_code=base64_decode($rs["p_key"]);
    $seller_email=base64_decode($rs["p_no"]);
    $partner=base64_decode($rs["p_shid"]);
}else{
    echo "fail";exit;
}
$_input_charset  = $cfg['charset'];						       //字符编码格式 目前支持 GBK 或 utf-8
$transport       = "http";						       //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$sign_type       = "MD5";						       //加密方式 不需修改
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);    //构造通知函数信息
$verify_result = $alipay->notify_verify();  //计算得出通知验证结果
$dingdan       = $out_trade_no;       	//获取支付宝传递过来的订单号
$total         = isset($price)?$price:$total_fee;			//获取支付宝传递过来的总价格
if($verify_result) {
    if($_POST['trade_status'] == 'WAIT_BUYER_PAY'||$_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {
        echo "success";
    }
	else if ($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS'){
		echo "success";
	}
	else if ($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS'){
		echo "success";
	}
	else if ($_POST['trade_status'] == 'TRADE_FINISHED'){
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
            $db ->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$total where m_login='$rs1[p_member]' and m_typeid=$mtype");
        }
		echo "success";
	}
    else {
        echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。
    }
}
else {
    $db ->query("update {$cfg['tb_pre']}payback set p_isucceed=2 where p_oid=$dingdan");
    echo "fail";
}
?>