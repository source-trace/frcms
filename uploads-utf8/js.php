<?php
require(dirname(__FILE__).'/config.inc.php');
require(FR_ROOT.'/inc/common.func.php');
$jsid=intval($jsid);
if($webstateArray[0]) exit("document.write('<div id=\"s$jsid\">无数据……</div>');");
$cls="";
if ($jsid==0){
    exit("document.write('<div id=\"s$jsid\">无数据……</div>');");
}else{
    echo "document.write('<div id=\"s$jsid\">数据读取中……</div>');";
    $inhs=$jsid;
    $rs = $db->get_one("select l_content from {$cfg['tb_pre']}label where l_id=$jsid and (l_content like '%{getcomlist(%' or l_content like '%{getresumelist(%' or l_content like '%{gethirelist(%')");
    if($rs){
       $clss=substr($rs['l_content'],1,-1);
       eval("\$cls=$clss;");
    }
    if($cls!=''){
        $cls=detecturl($cls);
        $cls=str_replace("\r\n","",$cls);
    }
    echo "document.getElementById('s$jsid').innerHTML='$cls';";exit();
}

function detecturl($sContent){
	global $cfg;
	$pattern='{(src|href)="?((?!http://)[\w+&@#%=~_|!:,.;/?\-]+)"?}';
	preg_match_all($pattern,$sContent,$out, PREG_SET_ORDER);
	foreach( $out as $v ) {
		if(substr($v[2],0,1)=='/'){
			$sAbsoluteUrl=$v[1].'="'.$cfg['siteurl'].$v[2].'"';
		}else{
			$v[2]=str_replace('../','',$v[2]);
			$sAbsoluteUrl=$v[1].'="'.$cfg['siteurl'].$cfg['path'].$v[2].'"';	
		}
		$sContent=str_replace($v[0],$sAbsoluteUrl,$sContent);
	}
	return $sContent;
}
?>