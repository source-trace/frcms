<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
require(dirname(__FILE__).'/../../member/check.php');
@session_start();
if(function_exists("imagecreate")){
    $w = (int)$_POST['w'];
    $h = (int)$_POST['h'];
    $img = imagecreatetruecolor($w, $h);
    imagefill($img, 0, 0, 0xffffff);
    $rows = 0;
    $cols = 0;
    for($rows = 0; $rows < $h; $rows++){
        $c_row = explode(",", $_POST['PX' . $rows]);
        for($cols = 0; $cols < $w; $cols++){
            $value = $c_row[$cols];
            if($value != ""){
                $hex = $value;
                while(strlen($hex) < 6){
                    $hex = "0" . $hex;
                }
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                $test = imagecolorallocate($img, $r, $g, $b);
                imagesetpixel($img, $cols, $rows, $test);
            }
        }
    }
    $text = $cfg['watermark'];
    $font = 'arial.ttf';
    //创建水印图
    if($text!=''){
        $imgs=imagecreatetruecolor($w,14);
        $swhite = imagecolorallocate($imgs, 255, 255, 255);
        imagettftext($imgs,10,0,2,12,$swhite,$font,$text);
        //合并
        imagecopymerge($img,$imgs,0,$h-14,0,0,$w,14,30);
    }
    $savePath = "../../upfiles/{$_SESSION["sUploadDir"]}";
    $filename=$savePath.date('YmdHis')."_".rand(100,999).".jpg";
    $rs = $db->get_one("select m_logo from {$cfg['tb_pre']}member where m_login='$username' and m_logo!='' and m_logo!='error.gif' limit 0,1");
   	if($rs){
	   $filename='../'.$rs['m_logo'];
	}
    
	header("Pragma:no-cache\r\n");
	header("Cache-Control:no-cache\r\n");
	header("Expires:0\r\n");

	if(function_exists("imagejpeg")){
		header("content-type:image/jpeg\r\n");
		imagejpeg($img, $filename, 100);
	}else{
		header("content-type:image/png\r\n");
		imagepng($img, $filename, 100);
	}
	ImageDestroy($img);
    
    $filename=substr($filename,3);

    $db ->query("update {$cfg['tb_pre']}member set m_logo='$filename',m_logostatus=1 where m_login='$username'");
}
$url='../../member/?mpage=person_photo&show=0&s=1';
header("Location: $url");
?>