<?php
require_once(dirname(__FILE__).'/../config.inc.php');
$username=_getcookie('user_login');
if($username!=''){
require(FR_ROOT.'/member/check.php');
}
$admin_name=_getcookie('admin_name');
if($admin_name!=''){
    $admin_pass=_getcookie('admin_pass');
    $rs = $db->get_one("select * from {$cfg['tb_pre']}admin where a_user='$admin_name' and a_pass='$admin_pass'");
    if(!$rs){
        echo "<script language=JavaScript>{location.href='{$cfg['path']}login.php';}</script>";
        exit();
    }
}
if($username==''&&$admin_name==''){
    echo "<script language=JavaScript>{location.href='{$cfg['path']}login.php';}</script>";exit();
}
@session_start();
$error = "";
$msg = "";
$fileElementName = 'fileToUpload';
if(isset($_FILES['fileToUpload'])){
    if($_FILES['fileToUpload']['name'] <> ""){
        require_once ('upload_class.php');
        $savePath = "../upfiles/{$_SESSION["sUploadDir"]}";
        makeDirectory($savePath);
        $fileFormat = array('gif','jpg','jpge','png','swf');
        $maxSize = 1*1024*1024;//上传文件最大限制1表示1M
        $overwrite = 0;
        $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
        $f->setThumb(0);
        if (!$f->run('fileToUpload',1)){
        $error.=$f->errmsg();
        }
       $upArrays=$f->getInfo();
       foreach ($upArrays as $upArray) { 
           $msg.=$upArray[path].$upArray[saveName].",";
       }
       if($msg!=''){
            $msg=substr($msg,0,-1);
            $msg=str_replace("../",$cfg['path'],$msg);
       }
       echo "{";
       echo				"error: '" . $error . "',\n";
       echo				"msg: '" . $msg . "'\n";
       echo "}";
    }
}
function makeDirectory($directoryName) {
       $directoryName = str_replace("\\","/",$directoryName);
       $dirNames = explode('/', $directoryName);
       $total = count($dirNames) ;
       $temp = '';
       for($i=0; $i<$total; $i++) {
         $temp .= $dirNames[$i].'/';
         if (!is_dir($temp)&&$temp!='../') {
            $oldmask = umask(0);
            if (!mkdir($temp, 0777)) exit("不能建立目录 $temp"); 
            umask($oldmask);
         }
       }
       return true;
}
?>