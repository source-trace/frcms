<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
function sendmail($to, $from, $subject, $body){
	global $cfg;
	$from =$from?$from:($cfg['mailadd']?$cfg['mailadd']:$cfg['email']);
    $subject = stripslashes($subject);
    $subject = str_replace("\r", '', str_replace("\n", '', $subject));
    $subject = "=?".$cfg['charset']."?B?".base64_encode($subject)."?=";
    $body = ereg_replace("(^|(\r\n))(\.)", "\1.\3", $body);
	$mail_crlf = $cfg['mailcrlf'] == 0 ? "\r\n" : ($cfg['mailcrlf'] == 1 ? "\n" : "\r");
	$headers = "MIME-Version: 1.0".$mail_crlf;
    $headers .= "Content-type: text/html; charset=".$cfg['charset'].$mail_crlf;
	$headers .= "From: {$cfg['sitename']}<".$from.">".$mail_crlf;
	$headers .= "X-Priority: 1".$mail_crlf;
    $headers .= "X-MSMail-Priority: High".$mail_crlf;
	$headers .= "X-Mailer: Finereason".$mail_crlf;
    if($cfg['mailobject']==1){
        $host = $cfg['mailserver'].':'.$cfg['mailport'].' ';
        if(!$fp = fsockopen($cfg['mailserver'], $cfg['mailport'], $errno, $errstr, 30)) {
			log_write("errno:$errno|error:$errstr|errmsg:Cannot connenct to the SMTP server$host", 'smtp');
			return false;
		}
        stream_set_blocking($fp, true);
		$RE = fgets($fp, 512);
		if(substr($RE, 0, 3) != '220') {
			log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.$RE, 'smtp');
			return false;
		}
        fputs($fp, ($cfg['mailvali'] ? 'EHLO' : 'HELO')." Finereason\r\n");
		$RE = fgets($fp, 512);
		if(substr($RE, 0, 3) != 220 && substr($RE, 0, 3) != 250) {
			log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'HELO/EHLO - '.$RE, 'smtp');
			return false;
		}
		while(1) {
			if(substr($RE, 3, 1) != '-' || empty($RE)) break;
			$RE = fgets($fp, 512);
		}

		if($cfg['mailvali']) {
			fputs($fp, "AUTH LOGIN\r\n");
			$RE = fgets($fp, 512);
			if(substr($RE, 0, 3) != 334) {
				log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'AUTH LOGIN - '.$RE, 'smtp');
				return false;
			}
			fputs($fp, base64_encode($cfg['username'])."\r\n");
			$RE = fgets($fp, 512);
			if(substr($RE, 0, 3) != 334) {
				log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'USERNAME - '.$RE, 'smtp');
				return false;
			}
			fputs($fp, base64_encode($cfg['password'])."\r\n");
			$RE = fgets($fp, 512);
			if(substr($RE, 0, 3) != 235) {
				log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'PASSWORD - '.$RE, 'smtp');
				return false;
			}
			$from = $cfg['username'];
		}
		fputs($fp, "MAIL FROM: <".$from.">\r\n");
		$RE = fgets($fp, 512);
		if(substr($RE, 0, 3) != 250) {
			fputs($fp, "MAIL FROM: <".$from.">\r\n");
			$RE = fgets($fp, 512);
			if(substr($RE, 0, 3) != 250) {
				log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'MAIL FROM - '.$RE, 'smtp');
				return false;
			}
		}
		foreach(explode(',', $to) as $touser) {
			$touser = trim($touser);
			if($touser) {
				fputs($fp, "RCPT TO: <".$touser.">\r\n");
				$RE = fgets($fp, 512);
				if(substr($RE, 0, 3) != 250) {
					fputs($fp, "RCPT TO: <".$touser.">\r\n");
					$RE = fgets($fp, 512);
					log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'RCPT TO - '.$RE, 'smtp');
					return false;
				}
			}
		}
		fputs($fp, "DATA\r\n");
		$RE = fgets($fp, 512);
		if(substr($RE, 0, 3) != 354) {
			log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'DATA - '.$RE, 'smtp');
			return false;
		}
		list($msec, $sec) = explode(' ', microtime());
		$headers .= "Message-ID: <".date('YmdHis', $sec).".".($msec*1000000).".".substr($from, strpos($from,'@')).">".$mail_crlf;
		fputs($fp, "Date: ".date('r')."\r\n");
		fputs($fp, "To: ".$to."\r\n");
		fputs($fp, "Subject: ".$subject."\r\n");
		fputs($fp, $headers."\r\n");
		fputs($fp, "\r\n\r\n");
		fputs($fp, "$body\r\n.\r\n");
		$RE = fgets($fp, 512);
		if(substr($RE, 0, 3) != 250) {
			log_write('errno:'.$errno.'|error:'.$errstr.'|errmsg:'.$host.'END - '.$RE, 'smtp');
			return false;
		}
		fputs($fp, "QUIT\r\n");
		return true;
    }else{
        if($cfg['mailobject']==2) {
			ini_set('SMTP', $cfg['mailserver']);
			ini_set('smtp_port', $cfg['mailport']);
			ini_set('sendmail_from', $from);
		}
		return  @mail($to, $subject, $body, $headers);
    }
}
?>