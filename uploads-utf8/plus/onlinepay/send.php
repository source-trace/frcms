<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$paytype=intval($paytype);
$amount = trim($amount);
if(!is_numeric($amount)){showmsg('支付金额不合法，必须为数字。',"-1");exit;}
if(!strpos($amount,'.')) $amount=$amount.".00";
$rs = $db->get_one("select p_no,p_shid,p_key,p_name from {$cfg['tb_pre']}payonline where p_chk=1 and p_flag=$paytype");
if($rs){
    $ipayno=base64_decode($rs["p_no"]);
    $ipayid=base64_decode($rs["p_shid"]);
    $ipaykey=base64_decode($rs["p_key"]);
    $ipayname=$rs["p_name"];
}else{
    showmsg('操作失败！接口故障请联系管理员。',"-1");exit;
}    
$orderno = date('YmdHis');
//如果是会员查询会员的相关联系信息
if(_getcookie('user_login')!=''){
    $username=_getcookie('user_login');
    $rs = $db->get_one("select m_tel,m_email,m_address from {$cfg['tb_pre']}member where m_login='$username'");
    if($rs){
        $p_address=$rs['m_address'];
        $p_email=$rs['m_email'];
        $p_tel=$rs['m_tel'];
    }else{
        showmsg('查无此用户信息，请与网站管理员联系。',"/index.php");exit;
    }
}else{
    showmsg('登陆时间过长 或 账户为无效账户，请与网站管理员联系。',"../../login.php");exit;
}
$p_address=$p_address==''?'无地址':$p_address;
$p_tel=$p_tel==''?'0':$p_tel;
$p_mid=$ipayno;
$p_amount=$amount;
$p_type=$ipayname;
$p_pmode='';
$p_oid=$orderno;
$p_content=$cfg['sitename'].'会员充值，订单号：'.$orderno;
$p_member=$username;
$p_class=_getcookie('user_type');
$p_date=date('Y-m-d H:i:s');
$p_userip=getip();

//存入在线缴费记录表
$db ->query("INSERT INTO {$cfg['tb_pre']}payback (p_mid,p_amount,p_type,p_pmode,p_oid,p_content,p_member,p_class,p_address,p_email,p_tel,p_date,p_userip,p_isucceed) VALUES('$p_mid','$p_amount','$p_type','$p_pmode','$p_oid','$p_content','$p_member','$p_class','$p_address','$p_email','$p_tel','$p_date','$p_userip',0)");
switch($paytype){
    case 1:
        //支付宝支付发送接口代码
        $pay_url         = "https://www.alipay.com/cooperate/gateway.do?";
        $notify_url	     = $cfg['siteurl'].$cfg['path']."plus/onlinepay/alipay_notify.php";	       //交易过程中服务器通知的页面，例如http://www.alipay.com/alipay/Alipay_Notify.asp  注意文件位置请填写正确。
        $return_url	     = $cfg['siteurl'].$cfg['path']."plus/onlinepay/alipay_return.php";  //付完款后跳转的页面，例如http://www.alipay.com/alipay/return_Alipay_Notify.asp  注意文件位置请填写正确。
        $show_url        = $cfg['siteurl'];        //商户网站的网址,例如:www.alipay.com
        $subject	     = $p_content;	     //商品名称，如果客户走购物车流程可以设为  "订单号："&request("客户网站订单")
        $out_trade_no    = $orderno;        //按时间获取的订单号
        $price		     = $amount;		 //price商品单价	0.01～50000.00 , 注：不要出现3,000.00，价格不支持","号
        $quantity        = "1";             //商品数量,如果走购物车默认为1
        $seller_email    = $ipayno;         //卖家的支付宝帐号,c2c客户，可以更改此参数。
        $partner	     = $ipayid;	     //填写对应支付宝账户的合作者身份ID
        $security_code   = $ipaykey;
        $sign_type       = "MD5";
        $_input_charset  = $cfg['charset'];
        $receive_address = $p_address;
        $receive_mobile  = "000000";
        $receive_name    = $p_member;
        $receive_phone   = $p_tel;
        $receive_zip     = "000000";

        $logistics_fee		= "0.00";		//物流费用，即运费。
        $logistics_type		= "EXPRESS";	//物流类型，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
        $logistics_payment	= "SELLER_PAY"; //物流支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        $text="_input_charset=$_input_charset&logistics_fee=$logistics_fee&logistics_payment=$logistics_payment&logistics_type=$logistics_type&notify_url=$notify_url&out_trade_no=$out_trade_no&partner=$partner&payment_type=1&price=$price&quantity=$quantity&receive_address=$p_address&receive_mobile=000000&receive_name=$p_member&receive_phone=$p_tel&receive_zip=000000&return_url=$return_url&seller_email=$seller_email&service=create_partner_trade_by_buyer&show_url=$show_url&subject=$subject";
        $sign=md5($text.$security_code);
        $text="_input_charset=$_input_charset&logistics_fee=$logistics_fee&logistics_payment=$logistics_payment&logistics_type=$logistics_type&notify_url=$notify_url&out_trade_no=$out_trade_no&partner=$partner&payment_type=1&price=$price&quantity=$quantity&receive_address=".urlencode($p_address)."&receive_mobile=000000&receive_name=".urlencode($p_member)."&receive_phone=".urlencode($p_tel)."&receive_zip=000000&return_url=$return_url&seller_email=$seller_email&service=create_partner_trade_by_buyer&show_url=$show_url&subject=".urlencode($subject)."";
        $url=$pay_url.$text."&sign=$sign&sign_type=$sign_type";
        echo "<script>window.location =\"$url\";</script>";
        break;
    case 2:
        //网银在线支付发送接口代码
        $v_oid        = $orderno;               //订单号
    	$v_amount     = $amount;
        $v_url        = $cfg['siteurl'].$cfg['path']."plus/onlinepay/chinabank_notify.php";
        $v_moneytype  = "CNY";           //币种
        $remark1      = "";
        $remark2      = "";
    	$text         = $v_amount.$v_moneytype.$v_oid.$ipayno.$v_url.$ipaykey;  //md5加密拼凑串,注意顺序不能变
    	$v_md5info    = strtoupper(md5($text));                             //md5函数加密并转化成大写字母
        echo "<form method=\"post\" name=\"E_FORM\" action=\"https://pay3.chinabank.com.cn/PayGate\">";
    	echo "<input type=\"hidden\" name=\"v_mid\" value=\"$ipayno\">";
    	echo "<input type=\"hidden\" name=\"v_oid\" value=\"$v_oid\">";
    	echo "<input type=\"hidden\" name=\"v_amount\" value=\"$v_amount\">";
    	echo "<input type=\"hidden\" name=\"v_moneytype\" value=\"$v_moneytype\">";
    	echo "<input type=\"hidden\" name=\"v_url\" value=\"$v_url\">";
    	echo "<input type=\"hidden\" name=\"v_md5info\" value=\"$v_md5info\">";	
    	echo "<input type=\"hidden\" name=\"remark1\" value=\"$remark1\">";
    	echo "<input type=\"hidden\" name=\"remark2\" value=\"$remark2;?>\">";
    	echo "<input type=\"hidden\" name=\"v_rcvname\" value=\"$p_member\">";
    	echo "<input type=\"hidden\" name=\"v_rcvtel\" value=\"$p_tel\">";
    	echo "<input type=\"hidden\" name=\"v_rcvaddr\" value=\"$p_address\">";
    	echo "<input type=\"hidden\" name=\"v_rcvemail\" value=\"$p_email\">";
        echo "</form>";
        echo "<SCRIPT LANGUAGE=\"JavaScript\">";
        echo "document.E_FORM.submit();";
        echo "</script>";
        break;
    case 3:
        //财付通支付发送接口代码
       	$spid			= $ipayno;		//商户号
    	$sp_key			= $ipaykey;		//商户密钥
    	$v_spid			= "";			//买家帐号
    	$attach			= "tencent_magichu";			//支付附加数据，非中文标准字符
    	$pay_url		= "https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi"; 	//财付通支付网关地址
    	$notify_url     = $cfg['siteurl'].$cfg['path']."plus/onlinepay/tenpay_notify.php";
    	$desc			= $p_content;		//商品描述
    	$sp_billno      = $orderno;       //按时间获取的订单号
    	$total_fee		= $amount*100;		//price商品单价	0.01～50000.00 , 注：不要出现3,000.00，价格不支持","号
    	$ip				= getip();
    	$sign_text      = "cmdno=1&date=".date('Ymd')."&bargainor_id=$spid&transaction_id=".$spid.date('Ymd').time()."&sp_billno=$sp_billno&total_fee=$total_fee&fee_type=1&return_url=$notify_url&attach=$attach";
    	if($ip != "")
    	{
    	$sign_text = $sign_text . "&spbill_create_ip=$ip";
    	}
        $strSign = strtoupper(md5($sign_text."&key=$sp_key"));
    	$redurl= $pay_url."?".$sign_text . "&sign=" . $strSign."&desc=".$desc."&bank_type=0";
    	echo "<SCRIPT LANGUAGE=\"JavaScript\">";
    	echo "window.location.href=\"$redurl\";";
    	echo "</script>";
        break;
    case 4:
        //易宝支付发送接口代码
        $p0_Cmd = "Buy";
    	$p1_MerId = $ipayno;			
    	$merchantKey = $ipaykey;
    	$p2_Order = $orderno; 
    	$p3_Amt = $amount;
    	$p4_Cur = "CNY";
    	$p5_Pid = $p_content;   //商品名称
    	$p6_Pcat = "";  //商品种类
    	$p7_Pdesc = $p_content;  //商品描述			
    	$p8_Url = $cfg['siteurl'].$cfg['path']."plus/onlinepay/yeepay_notify.php";
    	$p9_SAF = "0";    //需要填写送货信息 0：不需要  1:需要
    	$pa_MP = "";    //商户扩展信息	
    	$pd_FrpId = "";    //银行编码
    	$pr_NeedResponse = "1";	//应答机制
    
        $text = $p0_Cmd.$p1_MerId.$p2_Order.$p3_Amt.$p4_Cur.$p5_Pid.$p6_Pcat.$p7_Pdesc.$p8_Url.$p9_SAF.$pa_MP.$pd_FrpId.$pr_NeedResponse;
        $key = iconv("GB2312","UTF-8",$merchantKey);
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
    	$hmac = md5($k_opad . pack("H*",md5($k_ipad . $data)));
        
        echo "<form name='yeepay' action='https://www.yeepay.com/app-merchant-proxy/node' method='post'>";
        echo "<input type='hidden' name='p0_Cmd' value='$p0_Cmd'>";
        echo "<input type='hidden' name='p1_MerId' value='$p1_MerId'>";
        echo "<input type='hidden' name='p2_Order' value='$p2_Order'>";
        echo "<input type='hidden' name='p3_Amt' value='$p3_Amt'>";
        echo "<input type='hidden' name='p4_Cur' value='$p4_Cur'>";
        echo "<input type='hidden' name='p5_Pid' value='$p5_Pid'>";
        echo "<input type='hidden' name='p6_Pcat' value='$p6_Pcat'>";
        echo "<input type='hidden' name='p7_Pdesc' value='$p7_Pdesc'>";
        echo "<input type='hidden' name='p8_Url' value='$p8_Url'>";
        echo "<input type='hidden' name='p9_SAF' value='$p9_SAF'>";
        echo "<input type='hidden' name='pa_MP' value='$pa_MP'>";
        echo "<input type='hidden' name='pd_FrpId' value='$pd_FrpId'>";
        echo "<input type='hidden' name='pr_NeedResponse' value='$pr_NeedResponse'>";
        echo "<input type='hidden' name='hmac' value='$hmac'>";
        echo "</form>";
        echo "<SCRIPT LANGUAGE=\"JavaScript\">";
        echo "document.yeepay.submit();";
        echo "</script>";
        break; 
    case 5:
        //支付宝支付发送接口代码
        $pay_url         = "https://www.alipay.com/cooperate/gateway.do?";
        $notify_url	     = $cfg['siteurl'].$cfg['path']."plus/onlinepay/alipay_notify.php";	       //交易过程中服务器通知的页面，例如http://www.alipay.com/alipay/Alipay_Notify.asp  注意文件位置请填写正确。
        $return_url	     = $cfg['siteurl'].$cfg['path']."plus/onlinepay/alipay_return.php";  //付完款后跳转的页面，例如http://www.alipay.com/alipay/return_Alipay_Notify.asp  注意文件位置请填写正确。
        $show_url        = $cfg['siteurl'];        //商户网站的网址,例如:www.alipay.com
        $subject	     = $p_content;	     //商品名称，如果客户走购物车流程可以设为  "订单号："&request("客户网站订单")
        $out_trade_no    = $orderno;        //按时间获取的订单号
        $price		     = $amount;		 //price商品单价	0.01～50000.00 , 注：不要出现3,000.00，价格不支持","号
        $quantity        = "1";             //商品数量,如果走购物车默认为1
        $seller_email    = $ipayno;         //卖家的支付宝帐号,c2c客户，可以更改此参数。
        $partner	     = $ipayid;	     //填写对应支付宝账户的合作者身份ID
        $security_code   = $ipaykey;
        $sign_type       = "MD5";
        $_input_charset  = $cfg['charset'];

        $text="_input_charset=$_input_charset&notify_url=$notify_url&out_trade_no=$out_trade_no&partner=$partner&payment_type=1&price=$price&quantity=$quantity&return_url=$return_url&seller_email=$seller_email&service=create_direct_pay_by_user&show_url=$show_url&subject=$subject";
        $sign=md5($text.$security_code);
        $text="_input_charset=$_input_charset&notify_url=$notify_url&out_trade_no=$out_trade_no&partner=$partner&payment_type=1&price=$price&quantity=$quantity&return_url=$return_url&seller_email=$seller_email&service=create_direct_pay_by_user&show_url=$show_url&subject=".urlencode($subject)."";
        $url=$pay_url.$text."&sign=$sign&sign_type=$sign_type";
        echo "<script>window.location =\"$url\";</script>";
        break;
}
?>