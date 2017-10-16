<?php
//图片3D墙插件
//$a类型  $m用户  $t图片类别  $st是否一张   $n数量
require(dirname(__FILE__).'/../../config.inc.php');
@session_start();
if(empty($a)) $a='member';
$a=preg_replace("/[^a-z]/i",'',$a);
$_SESSION['cooliris_a']=$a;
$_SESSION['cooliris_m']=$m;
$_SESSION['cooliris_t']=$t;
$_SESSION['cooliris_st']=$st;
$_SESSION['cooliris_n']=$n;
if(empty($w)) $w='0';
if(empty($h)) $h='0';
$w=intval($w)?intval($w):600;
$h=intval($h)?intval($h):450;
$jscooliris.="<object id=\"o\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"$w\" height=\"$h\">";
$jscooliris.="    <param name=\"movie\" value=\"{$cfg['siteurl']}{$cfg['path']}plus/cooliris/cooliris.swf\" />";
$jscooliris.="    <param name=\"allowFullScreen\" value=\"true\" />";
$jscooliris.="    <param name=\"allowScriptAccess\" value=\"always\" />";
$jscooliris.="    <param name=\"flashvars\" value=\"feed={$cfg['siteurl']}{$cfg['path']}plus/cooliris/\" />";
$jscooliris.="    <embed type=\"application/x-shockwave-flash\" src=\"{$cfg['siteurl']}{$cfg['path']}plus/cooliris/cooliris.swf\" flashvars=\"feed={$cfg['siteurl']}{$cfg['path']}plus/cooliris/\" width=\"$w\" height=\"$h\" allowFullScreen=\"true\" allowScriptAccess=\"always\" />";
$jscooliris.="</object>";
?>
document.write('<?php echo $jscooliris;  ?>');