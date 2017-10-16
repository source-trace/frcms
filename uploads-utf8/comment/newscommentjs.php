<?php
require(dirname(__FILE__).'/../config.inc.php');
require(FR_ROOT.'/inc/common.func.php');

$newsid=intval($newsid);
$jshtml="<font color=\"green\">网友评论仅供其表达个人看法，并不表明{$cfg['sitename']}同意其观点或证实其描述。</font><br />";
if($newsid==0){
	
    $jshtml .="暂时没有此文章的评论！";
}else{
$sql1="select count(*) as n from {$cfg['tb_pre']}comment where c_nid=$newsid and c_pass<>0 order by c_addtime desc ";
$rs = $db->get_one($sql1);

$counts=$rs['n'];
if($counts>0){
$page=isset($_GET["page"])?$_GET["page"]:1;
$pagesize=20;
$getpageinfo = page($page,$counts,'',$pagesize,5,1);

$sql="select * from {$cfg['tb_pre']}comment where c_nid=$newsid and c_pass=1 order by c_addtime desc";
$sql.=$getpageinfo['sqllimit'];

$query=$db->query($sql);
$rsdb=array();
	if($query){
		 $jshtml .="<ul class=\"plulys\">";
		while($rs=$db->fetch_array($query)){
				
				//$rsdb[]=$row;
			 $jshtml .="<li><div><span>{$rs['c_username']} ".trim(getip_from($rs['c_ip']))."</span> {$rs['c_addtime']} </div><p>{$rs['c_content']}</p></li>";
			}
			$jshtml .="</ul>";
			
	}else{
	   $jshtml .="暂时没有此文章的评论！";		
		
	}
}
else{
	
	   $jshtml .="暂时没有此文章的评论！";
	}
//var_dump($rsdb);
}
?>
document.write('<?php echo $jshtml;  ?>');