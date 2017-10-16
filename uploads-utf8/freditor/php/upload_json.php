<?php
$admin_name=isset($_COOKIE['fr_admin_name'])?$_COOKIE['fr_admin_name']:'';
if($admin_name=='') exit();
$sessSavePath = "../../data/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath)){session_save_path($sessSavePath);}
require_once 'JSON.php';
@session_start();
$save_path = "../../upfiles/{$_SESSION["sUploadDir"]}";
$save_url = "../../upfiles/{$_SESSION["sUploadDir"]}";
makeDirectory($save_path);
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'doc', 'xls', 'ppt', 'pdf', 'txt', 'rar' , 'zip');
$max_size = 10000000;
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//服务器上临时文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("请选择文件。");
	}
	//检查目录
	if (@is_dir($save_path) === false) {
		alert("上传目录不存在。");
	}
	//检查目录写权限
	if (@is_writable($save_path) === false) {
		alert("上传目录没有写权限。");
	}
	//检查是否已上传
	if (@is_uploaded_file($tmp_name) === false) {
		alert("临时文件可能不是上传文件。");
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("上传文件大小超过限制。");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr) === false) {
		alert("上传文件扩展名是不允许的扩展名。");
	}
	//新文件名
	$new_file_name = date("YmdHis") . '_' . rand(100, 999) . '.' . $file_ext;
	//移动文件
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("上传文件失败。");
	}
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;
	
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
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
            if (!mkdir($temp, 0777)) alert("不能建立目录 $temp"); 
            umask($oldmask);
         }
       }
       return true;
}
?>