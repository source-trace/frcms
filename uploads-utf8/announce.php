<?php
if(!file_exists(dirname(__FILE__).'/config.inc.php'))
{
    header('Location:install/index.php');
    exit();
}
require(dirname(__FILE__).'/config.inc.php');
if(isset($aid)&&is_numeric($aid)){
    $aid=intval($aid);
    $rs = $db->get_one("select a_title,a_content from {$cfg['tb_pre']}announce where a_id=$aid");
    if($rs){
        $title=$rs['a_title'];
        $content=$rs['a_content'];
    }else{
        echo "<script language=JavaScript>alert('内容不存在！');window.close();</script>";exit;
    }
}else{
    $rsdb=array();
    $sqladd='';
    if($cfg['site']!=''){
        if($cfg['announce']=='2'){
            $sqladd.=" AND `a_site`={$cfg['site']}";
        }elseif($cfg['announce']=='3'){
            $sqladd.=" AND (`a_site`={$cfg['site']} OR `a_site`=0)";
        }
    }else{
        $sqladd.=" AND `a_site`=0";
    }
    $sql="select * from {$cfg['tb_pre']}announce where 1 $sqladd order by a_dateandtime desc";
    $counts = $db->counter("{$cfg['tb_pre']}announce","1 $sqladd");
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"announce.php",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
require(FR_ROOT.'/inc/common.func.php');
include template('announce','common');
?>