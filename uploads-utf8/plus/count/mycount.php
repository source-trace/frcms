<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$style = empty($style) ? '' : $style;
echo "document.write(\"<script>var style='$style';var url='{$cfg['siteurl']}{$cfg['path']}plus/count';</script><script src='{$cfg['siteurl']}{$cfg['path']}plus/count/stat.js'></script>\")";
?>