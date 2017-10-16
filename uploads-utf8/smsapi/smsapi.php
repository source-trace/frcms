<?php
require_once(FR_ROOT.'/smsapi/config.php');
//SMS.API
Class SMS
{	//提交数据并返回
	function sendSMS($t_pho,$t_msg,$t_time){
        global $cfg;
        $serverURL = $_SESSION["vcpserver"];
		$VCPU = $_SESSION["vcpuser"];
		$VCPApkey = $_SESSION["vcpapikey"];
		$responseXML="";
        if($cfg['charset']=='utf-8') $t_msg=@iconv('utf-8','gb2312',$t_msg);
		$t_msg=base64_encode($t_msg);  //短信内容数据进行加密
		$sign=strtoupper(md5($VCPU.$t_pho.$VCPApkey));
        $strurl=$serverURL."?id=".$VCPU."&sign=".$sign."&to=".$t_pho."&content=".$t_msg."&time=".$t_time;
        $opts = array('http'=>array('method'=>"GET",'timeout'=>5));
        $context = stream_context_create($opts);
        $responseXML=file_get_contents($strurl,false, $context);
        return $responseXML;
	}
    function infoSMSAccount(){
        $serverURL = $_SESSION["vcpserver"];
		$VCPU = $_SESSION["vcpuser"];
		$VCPApkey = $_SESSION["vcpapikey"];
        $responseXML="";
        $sign=strtoupper(md5($VCPU.$VCPApkey));
        $strurl=$serverURL."info.asp?action=infoSMSAccount&id=".$VCPU."&syskey=".$sign;
        $responseXML=file_get_contents($strurl);
        return $responseXML;
    }
	function MoSMS(){
        $serverURL = $_SESSION["vcpserver"];
		$VCPU = $_SESSION["vcpuser"];
		$VCPApkey = $_SESSION["vcpapikey"];
        $responseXML="";
        $sign=strtoupper(md5($VCPU.$VCPApkey));
        $strurl=$serverURL."info.asp?action=MoSMS&id=".$VCPU."&syskey=".$sign;
        $responseXML=file_get_contents($strurl);
        return $responseXML;
    }
	function getCode($response){
	   $start_pos = strlen($response);
       if ($start_pos>0)
       {
       return $getCode = trim(substr($response,0,3));
       }
	}
}
?>