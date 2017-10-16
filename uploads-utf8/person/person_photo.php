<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
@session_start();
$_SESSION["sUploadDir"]="person/";

$max_file = "2";
$max_width = "500";
$thumbArray=$cfg['thumb_perphoto']?$cfg['thumb_perphoto']:Array(100,120);
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
        $flag=$regpArray[3]==1?",m_logoflag=0":"";
        $photo=str_replace("../",$cfg['path'],$photo);
        $db ->query("update {$cfg['tb_pre']}member set m_logo='$photo',m_logostatus=1 $flag where m_login='$username'");
	}
    $_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	showmsg('照片更新成功！',"?mpage=person_photo&show=$show",0,2000);exit();
}elseif($do=='hidden'){
	$db ->query("update {$cfg['tb_pre']}member set m_logostatus=0 where m_login='$username'");
	showmsg('设置屏蔽成功！',"?mpage=person_photo&show=$show",0,2000);exit();
}elseif($do=='show'){
	$db ->query("update {$cfg['tb_pre']}member set m_logostatus=1 where m_login='$username'");
	showmsg('设置显示成功！',"?mpage=person_photo&show=$show",0,2000);exit();
}elseif($do=='del'){
	$rs = $db->get_one("select m_logo from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
	if($rs){
		$logo=$rs['m_logo'];
		if($logo!=''&&$logo!='error.gif') unlink(FR_ROOT.$logo);
	}
	$db ->query("update {$cfg['tb_pre']}member set m_logo='' where m_login='$username'");
	showmsg('删除成功！',"?mpage=person_photo&show=$show",0,2000);exit();
}
$rs = $db->get_one("select m_logo,m_logostatus,m_logoflag from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
if($rs){
    $logo=$rs['m_logo'];
    $logo=($logo==''||$logo=='error.gif')?$cfg['path'].'upfiles/person/nophoto.gif':$logo;
    $logo.='?s='.rand(100,999);
    $logostatus=$rs['m_logostatus'];
    $logoflag=$rs['m_logoflag'];
}else{
    $logo=$cfg['path'].'upfiles/person/nophoto.gif';
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
        $imgs=imagecreatetruecolor(100,14);
        $swhite = imagecolorallocate($imgs, 255, 255, 255);
        imagettftext($imgs,10,0,2,12,$swhite,$font,$text);
        //合并
        imagecopymerge($newImage,$imgs,0,106,0,0,100,14,30);
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
<script language="javascript" type="text/javascript">
function unsl(){$("#bodyly").hide();$("#SearchDiv").hide();} 
function jumpsl(){
    $("#bodyly").show();
    $("#bodyly").width($(window).width());
    $("#bodyly").height($(document).height());  
    $("#SearchDiv").show();
    $("#SearchDiv").offset({ top: $(document).scrollTop()+40, left: $(window).width()/2-200 });
    document.getElementById("SearchDiv").style.top=document.documentElement.scrollTop+40;   
    document.getElementById("SearchDiv").style.left=document.body.clientWidth/2-200;
}
<!--实现层移动-->
var mmm='';
document.onmouseup=MUp;
document.onmousemove=MMove;

function MDown(Object){
mmm=Object.id;
document.all(mmm).setCapture();
pX=event.x-document.all(mmm).style.pixelLeft;
pY=event.y-document.all(mmm).style.pixelTop;
}

function MMove(){
if(mmm!=''){
document.all(mmm).style.left=event.x-pX;
document.all(mmm).style.top=event.y-pY;
}
}

function MUp(){
if(mmm!=''){
document.all(mmm).releaseCapture();
mmm='';
}
}
(function(){
var setRemoveCallback = function() {
__flash__removeCallback = function(instance, name) {
if (instance) {
instance[name] = null;
}
};
window.setTimeout(setRemoveCallback, 10);
};
setRemoveCallback();
})();

</script>
<div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
<div id="SearchDiv" style="position:absolute;background-color:#fff; z-index:9999;display:none; width:400px;">
<div onmousedown=MDown(SearchDiv) title="可以随意拖动" style="cursor:move;" class="memmenul">
<div class="memrighttit"><span><a style="cursor:pointer; color:#FFFFFF" onclick="unsl();">关 闭</a></span>在线拍照V1.0</div>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="386" height="296">
      <param name="movie" value="../plus/photo/photo.swf?surl=<?php echo $cfg['path'];?>plus/photo/camphoto.php" />
      <param name="quality" value="high" />
      <embed src="../plus/photo/photo.swf?surl=<?php echo $cfg['path'];?>plus/photo/camphoto.php" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="386" height="296"></embed>
    </object>
</div>
</div>
<div class="memrightl">
    <div class="memrighttit"><span></span>个人照片上传</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>所传照片一律为JPG、JPEG、BMP、PNG或GIF格式。如果您没有扫描仪，可以将照片邮寄给我们，我们免费为您服务。</li>
    </div>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td height="156" colspan="2" align="center"><table width="100%" style="border:#D3EEFC 1px solid" align="center" cellpadding="4" cellspacing="1" class="mtable">
            <tbody>
              <tr>
                <td width="200" bgcolor="#EEF8FF" align="center"><?php if($logoflag==0&&$logo!='/upfiles/person/nophoto.gif') echo "审核中……<br>";?><a href="<?php echo $logo;?>" target="_blank"><img height="<?php echo $thumb_height;?>" src="<?php echo $logo;?>" width="<?php echo $thumb_width;?>" border="0" style="BORDER: #000000 1px solid; <?php if($logostatus==0) echo "filter:gray;";?>" /></a><br />
                  <?php if($logostatus==0) echo "照片已屏蔽";?>
                  <br />
                  <?php if($logostatus==1){echo "<input type=\"button\" class=\"inputs\" value=\"屏蔽\" name=\"btnhidden\" style=\"CURSOR: hand\" onClick=\"window.location='?do=hidden&mpage=person_photo&show=$show'\">";}else{echo "<INPUT type='button' class='inputs' value='显示' name='btnShow' onClick=\"window.location='?do=show&mpage=person_photo&show=$show'\">";}?>
                  <input type='button' class='inputs' value='删除' name='btnDel' style="CURSOR: hand" onclick="window.location='?do=del&amp;mpage=person_photo&amp;show=<?php echo $show;?>'" /></td>
                <td bgcolor="#EEF8FF"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable">
                  <tr>
                    <td align="left">上传你的照片，展现你的形象！相片人才面试机会是普通人才的8.5倍！</td>
                  </tr>
                  <tr>
                    <td align="left" class="tdcolor">如何使您的照片显示达到最佳效果？</td>
                  </tr>
                  <tr>
                    <td align="left">1、将照片尺寸设置为<strong><?php echo $thumb_width;?>(宽)*<?php echo $thumb_height;?>(高)</strong>像素。（图片标准尺寸）</td>
                  </tr>
                  <tr>
                    <td align="left">2、图片大小不能超过</font><strong>2</strong><font color="#333333">M</td>
                  </tr>
                  <tr>
                    <td align="left">3、图片区域应清晰显示您的头像或半身/全身相。（请勿使用艺术照）</td>
                  </tr>
                  <tr>
                    <td align="left" class="tdcolor">注意：照片保存后，你可能需要刷新一下本页面(按F5键)，才能查看最新的照片效果。</td>
                  </tr>
                </table></td>
              </tr>
            </tbody>
          </table>
          <table width="100%" style="border:#D3EEFC 1px solid" align="center" cellpadding="4" cellspacing="1" class="mtable">
          <?php if(strlen($photo_exists)>0){?>
          <tr>
          <td bgcolor="#EEF8FF">
            <div align="left">
                <img src="<?php echo $image_location."?s=".rand(100,999);?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="裁切照片" />
                <div id="thumbnaildiv" style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                    <img src="<?php echo $image_location."?s=".rand(100,999);?>" style="position: relative;" alt="头像预览" />
                </div>
                <br style="clear:both;"/><br style="clear:both;"/>
                <form name="thumbnail" action="?do=savedata&mpage=person_photo&show=<?php echo $show;?>" method="post">
                    <input type="hidden" name="x1" value="" id="x1" />
                    <input type="hidden" name="y1" value="" id="y1" />
                    <input type="hidden" name="x2" value="" id="x2" />
                    <input type="hidden" name="y2" value="" id="y2" />
                    <input type="hidden" name="w" value="" id="w" />
                    <input type="hidden" name="h" value="" id="h" />
                    <input type="submit" name="upload_thumbnail" value="保存照片" class="inputs" id="save_thumb" style="CURSOR: hand" /> 在图片上按住鼠标左键拉框，然后进行头像位置及大小调整，调整完成后点击保存照片。
                </form>
            </div>
        </td>
          </tr><?php }?>
            <form name="photo" enctype="multipart/form-data" action="?a=upload&mpage=person_photo&show=<?php echo $show;?>" method="post">
              <tr>
                <td bgcolor="#EEF8FF" align="left" class="tdcolor">上传照片：<input type="file" name="image" size="20" class="inputs" /> <input type="submit" name="upload" class="inputs" value="上传" />
                <?php if(strlen($error)>0){
	               echo "错误：".$error."";
                }else{
                    echo "操作步骤：点击“浏览”选择图片——点击“上传”";
                }?>
                </td>
              </tr>
              </form>
          </table>
          <table width="100%" style="border:#D3EEFC 1px solid" align="center" cellpadding="4" cellspacing="0" class="mtable">
              <tr>
                <td bgcolor="#EEF8FF" align="left" class="tdcolor">摄像头在线拍摄照片： <input name="b122" type="button" class="inputs" value="打开拍摄窗口" style="CURSOR: hand" onclick="jumpsl();" /> <input name="b122" type="button" class="inputs" value="刷新页面" style="CURSOR: hand" onclick="javascript:location.reload();" /></td>
              </tr>
          </table></td>
        </tr>
      </table>
    </div>
</div>