<?php
require(dirname(__FILE__).'/../config.inc.php');
$newsid=intval($newsid);
if($newsid==0){
    echo "<script language=JavaScript>alert('该页面不存在，请访问其他内容！');window.close();</script>";exit;
}else{
    $rs = $db->get_one("select n_sid,n_cid,n_title,n_content,n_addtime,n_overview,n_from,n_author,n_editor,n_hits,s_name,n_keywords,n_description from {$cfg['tb_pre']}news,{$cfg['tb_pre']}newssort where n_sid=s_id and n_state=1 and n_id=$newsid");
    if($rs){
		
        $s_name=$rs['s_name'];
        $n_sid=$rs['n_sid'];
        $n_cid=$rs['n_cid'];
        $n_title=$rs['n_title'];
        $n_addtime=$rs['n_addtime'];
       
   		 $infolink=formatlink($n_addtime,$n_cid,1,$newsid,0);

		$user_login=_getcookie('user_login');		
    }else{
        echo "<script language=JavaScript>alert('该栏目不存在，请访问其他内容！');window.close();</script>";exit;
    }
}

$cid=$n_cid;
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}

$sql1="select count(*) as n from {$cfg['tb_pre']}comment where c_nid=$newsid and c_pass<>0 order by c_addtime desc ";

$rs = $db->get_one($sql1);
$counts=$rs['n'];

$page=isset($_GET["page"])?$_GET["page"]:1;
$pagesize=20;
$getpageinfo = page($page,$counts,'',$pagesize,5,1);

$sql="select * from {$cfg['tb_pre']}comment where c_nid=$newsid and c_pass=1 order by c_addtime desc";
$sql.=$getpageinfo['sqllimit'];

$query=$db->query($sql);
$rsdb=array();

while($row=$db->fetch_array($query)){
		
    	$rsdb[]=$row;
    }
//var_dump($rsdb);
require(FR_ROOT.'/inc/common.func.php');
include template('newscomment','comment');
?>