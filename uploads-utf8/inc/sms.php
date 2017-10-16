<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
require(dirname(__FILE__).'/../config.inc.php');
if (chkpost()&&_getcookie('admin_name')!=''){
    if($cfg['charset']=='utf-8') $smsmsg=@iconv('gb2312','utf-8',$smsmsg);
    $mobno=cleartags($mobno);$login=cleartags($member);$msg=cleartags($smsmsg);
	if($mobno!=''&&$smsArray[5]==1){
        require_once(FR_ROOT.'/smsapi/smsapi.php');
        $newclient=New SMS();
		$respxml=$newclient->sendSMS($mobno,$msg,"");
        $code=$newclient->getCode($respxml);
        if($code!='000'){
            $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobno',0,NOW(),'$msg')");
            echo "失败";exit;
		}else{
            $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('webmaster','$login','$mobno',1,NOW(),'$msg')");
            echo "成功";exit;
        }
    }
}
?>