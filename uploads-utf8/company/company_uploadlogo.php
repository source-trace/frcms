<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
@session_start();
$_SESSION["sUploadDir"]="company/";
$max_file = "2";
$max_width = "500";
$thumbArray=$cfg['thumb_comlogo']?$cfg['thumb_comlogo']:Array(160,120);
$thumb_width = $thumbArray[0];
$thumb_height = $thumbArray[1];
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
$allowed_image_ext = array_unique($allowed_image_types);
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext)." ";
}
$savePath = "../upfiles/{$_SESSION["sUploadDir"]}";
if (strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = date('YmdHis')."_".rand(100,999); //assign the timestamp to the session variable
    $_SESSION['user_file_ext']= "";
}
$image_name=$savePath.$_SESSION['random_key'];
if(empty($a)) $a='';
if ($a=="upload"&&isset($_POST["upload"])) {
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		foreach ($allowed_image_types as $mime_type => $ext) {
			if($file_ext==$ext && $userfile_type==$mime_type){
				$error = "";
				break;
			}else{
				$error = "只支持<strong>".$image_ext."</strong>格式的图片文件！<br />";
			}
		}
		if ($userfile_size > ($max_file*1048576)) {
			$error.= "图片文件大小不能超出".$max_file."MB！";
		}
		
	}else{
		$error= "请选择要上传的图片！";
	}
	if (strlen($error)==0){
		if (isset($_FILES['image']['name'])){
			$image_location = $image_name.".".$file_ext;
            $_SESSION['user_file_ext']=".".$file_ext;
			move_uploaded_file($userfile_tmp, $image_location);
			chmod($image_location, 0777);
			$width = getWidth($image_location);
			$height = getHeight($image_location);
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = resizeImage($image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = resizeImage($image_location,$width,$height,$scale);
			}
		}
        $photo_exists = "<img src=\"".$image_location."\" alt=\"Large Image\"/>";
	}
}
if($do=='savedata'){ 
    $image_location = $image_name.$_SESSION['user_file_ext'];
    if (isset($_POST["upload_thumbnail"])) {
    	$x1 = $_POST["x1"];
    	$y1 = $_POST["y1"];
    	$x2 = $_POST["x2"];
    	$y2 = $_POST["y2"];
    	$w = $_POST["w"];
    	$h = $_POST["h"];
    	$scale = $thumb_width/$w;
    	$cropped = resizeThumbnailImage($image_location, $image_location,$w,$h,$x1,$y1,$scale);
    }
    $photo=$image_location;
	if($photo!=''){
		$rs = $db->get_one("select m_logo from {$cfg['tb_pre']}member where m_login='$username' and m_logo!='' and m_logo!='error.gif' limit 0,1");
    	if($rs){
			$logo=$rs['m_logo'];@unlink(FR_ROOT.$logo);
			if(rename($photo,$logo)) $photo=$logo;
		}
        $flag=$regcArray[3]==1?",m_logoflag=0":"";
        $photo=str_replace("../",$cfg['path'],$photo);
        $db ->query("update {$cfg['tb_pre']}member set m_logo='$photo',m_logostatus=1 $flag where m_login='$username'");
	}
    $_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	showmsg('LOGO更新成功！',"?mpage=company_uploadlogo&show=$show",0,2000);exit();
}elseif($do=='hidden'){
	$db ->query("update {$cfg['tb_pre']}member set m_logostatus=0 where m_login='$username'");
	showmsg('设置屏蔽成功！',"?mpage=company_uploadlogo&show=$show",0,2000);exit();
}elseif($do=='show'){
	$db ->query("update {$cfg['tb_pre']}member set m_logostatus=1 where m_login='$username'");
	showmsg('设置显示成功！',"?mpage=company_uploadlogo&show=$show",0,2000);exit();
}elseif($do=='del'){
	$rs = $db->get_one("select m_logo from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
	if($rs){
		$logo=$rs['m_logo'];
		if($logo!=''&&$logo!='error.gif') unlink(FR_ROOT.$logo);
	}
	$db ->query("update {$cfg['tb_pre']}member set m_logo='' where m_login='$username'");
	showmsg('删除成功！',"?mpage=company_uploadlogo&show=$show",0,2000);exit();
}
$rs = $db->get_one("select m_logo,m_logostatus,m_logoflag from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
if($rs){
    $logo=$rs['m_logo'];
    $logo=($logo==''||$logo=='error.gif')?$cfg['path'].'upfiles/company/nologo.gif':$logo;
    $logo.='?s='.rand(100,999);
    $logostatus=$rs['m_logostatus'];
    $logoflag=$rs['m_logoflag'];
}else{
    $logo=$cfg['path'].'upfiles/company/nologo.gif';
}
function resizeImage($image,$width,$height,$scale) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
    global $cfg;
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    $text = $cfg['watermark'];
    $font = '../plus/photo/arial.ttf';
    //创建水印图
    if($text!=''){
        $imgs=imagecreatetruecolor(160,14);
        $swhite = imagecolorallocate($imgs, 255, 255, 255);
        imagettftext($imgs,10,0,2,12,$swhite,$font,$text);
        //合并
        imagecopymerge($newImage,$imgs,0,106,0,0,160,14,30);
    }
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,100); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}
if($a=="upload") {
$current_image_width = getWidth($image_location);
$current_image_height = getHeight($image_location);
?>
<script type="text/javascript" src="../js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript"> 
function preview(img, selection) { 
    if (!selection.width || !selection.height)
        return;
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnaildiv > img').css({ 
		width: Math.round(scaleX * <?php echo $current_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
 
$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("请在大图上裁切头像！");
			return false;
		}else{
			return true;
		}
	});
}); 
 
$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ handles: true, aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
});
 
</script>
<?php }?>
<div class="memrightl">
    <div class="memrighttit"><span></span>企业LOGO上传</div>
    <div class="memrightbox">
      <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>所传LOGO一律为JPG、JPEG或GIF格式。如果您没有扫描仪，可以将LOGO邮寄给我们，我们免费为您服务。</li>
    </div>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabhead">
        <td colspan="2">上传企业LOGO</td>
      </tr>
      <tr class="memtabmain">
        <td width="400" align="center"><?php if($logoflag==0&&$logo!='/upfiles/company/nologo.gif') echo "审核中……<br>";?><a href="<?php echo $logo;?>" target="_blank"><img height="<?php echo $thumb_height;?>" src="<?php echo $logo;?>" width="<?php echo $thumb_width;?>" border="0" style="border: #666666 1px solid; padding:1px;" /></a></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable">
          <tr>
            <td align="left">LOGO上传后，如果显示变形，说明LOGO尺寸不对。</td>
          </tr>
          <tr>
            <td align="left" class="tdcolor"><font color="#FF0000">如何使您的LOGO显示达到最佳效果？</font></td>
          </tr>
          <tr>
            <td align="left">1、系统提供在线切图功能，可自动生成<strong><?php echo $thumb_width;?>(宽)*<?php echo $thumb_height;?>(高)</strong>像素的LOGO图片。</td>
          </tr>
          <tr>
            <td align="left">2、上传LOGO文件大小不能超过<strong>2</strong>M。</td>
          </tr>
        </table></td>
      </tr>
      </table>
      <table width="100%" style="border:#D3EEFC 1px solid" align="center" cellpadding="4" cellspacing="1" class="mtable">
          <?php if(strlen($photo_exists)>0){?>
          <tr>
          <td bgcolor="#EEF8FF">
            <div align="left">
                <img src="<?php echo $image_location."?s=".rand(100,999);?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="裁切照片" />
                <div id="thumbnaildiv" style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                    <img src="<?php echo $image_location."?s=".rand(100,999);?>" style="position: relative;" alt="LOGO预览" />
                </div>
                <br style="clear:both;"/><br style="clear:both;"/>
                <form name="thumbnail" action="?do=savedata&mpage=company_uploadlogo&show=<?php echo $show;?>" method="post">
                    <input type="hidden" name="x1" value="" id="x1" />
                    <input type="hidden" name="y1" value="" id="y1" />
                    <input type="hidden" name="x2" value="" id="x2" />
                    <input type="hidden" name="y2" value="" id="y2" />
                    <input type="hidden" name="w" value="" id="w" />
                    <input type="hidden" name="h" value="" id="h" />
                    <input type="submit" name="upload_thumbnail" value="保存LOGO" class="inputs" id="save_thumb" style="CURSOR: hand" /> 在图片上按住鼠标左键拉框，然后进行LOGO位置及大小调整，调整完成后点击保存LOGO。
                </form>
            </div>
        </td>
          </tr><?php }?>
            <form name="photo" enctype="multipart/form-data" action="?a=upload&mpage=company_uploadlogo&show=<?php echo $show;?>" method="post">
              <tr>
                <td bgcolor="#EEF8FF" align="left" class="tdcolor">上传LOGO：<input type="file" name="image" size="20" class="inputs" /> <input type="submit" name="upload" class="inputs" value="上传" />
                <?php if(strlen($error)>0){
	               echo "错误：".$error."";
                }else{
                    echo "操作步骤：点击“浏览”选择图片——点击“上传”";
                }?>
                </td>
              </tr>
              </form>
          </table>
    </div>
</div>