<?php
$sessSavePath = dirname(__FILE__)."/../data/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath)){ session_save_path($sessSavePath); }
session_start();
$vstr = '';
for($i=0; $i<4; $i++) $vstr .= chr(mt_rand(65,90));
if(function_exists("imagecreate")){
	$_SESSION['verifycodes'] = strtolower($vstr);
	$vstr = $_SESSION['verifycodes'];
	$vstrlen = strlen($vstr);
	$img = imagecreate(50,20);
	ImageColorAllocate($img, 255,255,255);
	$bordercolor = ImageColorAllocate($img, 0x99,0x99,0x99);
	imagerectangle($img, 0, 0, 49, 19, $bordercolor);
	$fontColor = ImageColorAllocate($img, 48,61,50);
	for($i=0;$i<$vstrlen;$i++){
		$bc = mt_rand(0,1);
		$vstr[$i] = strtoupper($vstr[$i]);
		imagestring($img, 5, $i*10+6, mt_rand(2,4), $vstr[$i], $fontColor);
	}

	header("Pragma:no-cache\r\n");
	header("Cache-Control:no-cache\r\n");
	header("Expires:0\r\n");

	if(function_exists("imagejpeg")){
		header("content-type:image/jpeg\r\n");
		imagejpeg($img);
	}else{
		header("content-type:image/png\r\n");
		imagepng($img);
	}
	ImageDestroy($img);
	exit();
}else{
    $_SESSION['verifycodes'] = "code";
	header("content-type:image/jpeg\r\n");
	header("Pragma:no-cache\r\n");
	header("Cache-Control:no-cache\r\n");
	header("Expires:0\r\n");
	$fp = fopen("../images/verifycode.jpg","r");
	echo fread($fp,filesize("../images/verifycode.jpg"));
	fclose($fp);exit();
}
?>