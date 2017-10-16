<?php
require(dirname(__FILE__).'/../config.inc.php');
$cid=6;
@session_start();
$_SESSION["channelid"] = $cid;
$rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_id=$cid");
if($rs){
    $c_name=$rs['c_name'];
    $c_channeldir=$rs['c_channeldir'];
    $c_keywords=$rs['c_keywords'];
    $c_description=$rs['c_description'];
}else{
    echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
$newsid=intval($newsid);
if($newsid==0){
    echo "<script language=JavaScript>alert('该页面不存在，请访问其他内容！');window.close();</script>";exit;
}else{
    $rs = $db->get_one("select n_sid,n_cid,n_title,n_content,n_addtime,n_overview,n_from,n_author,n_editor,n_hits,s_name,n_keywords,n_description from {$cfg['tb_pre']}news,{$cfg['tb_pre']}newssort where n_sid=s_id and n_id=$newsid");
    if($rs){
        $s_name=$rs['s_name'];
        $n_sid=$rs['n_sid'];
        $n_cid=$rs['n_cid'];
        $n_title=$rs['n_title'];
        $n_content=$rs['n_content'];
        $n_addtime=$rs['n_addtime'];
        $n_overview=$rs['n_overview']?"<div class=\"newsoverview\"><strong>文章概况：</strong>$rs[n_overview]</div>":'';
        $n_from=$rs['n_from'];
        $n_author=$rs['n_author']?$rs['n_author']:'未知';
        $n_editor=$rs['n_editor']?$rs['n_editor']:'未知';
        $n_hits=$rs['n_hits'];
        $n_keywords=$rs["n_keywords"];
        $n_description=$rs["n_description"];
        $_SESSION["typeid"] = $rs['n_sid'];
        if($n_keywords!=''){
            $nkeywords=explode(',',$n_keywords);$n_keywordslist='本文关键词：';
            foreach($nkeywords as $v){
                $n_keywordslist.="<a href=\"$cfg[path]search/news_search.php?cid=$n_cid&keywords=$v\">$v</a>　";
            }
        }
        if($n_keywords=='') $n_keywords=$n_title;
        if($n_description=='') $n_description=$rs['n_overview']?$rs['n_overview']:$n_title;
        //分页
        $arr = explode("<!-- pagebreak -->",$n_content); 
        $total = count($arr); 
        $nowpage = $_GET['page']?$_GET['page']:1; 
        $prepage = $nowpage==1?1:$nowpage-1; 
        $nextpage = $nowpage>$total-1?$total:$nowpage+1; 
        $lastpage = $total; 
        $pdiv = "<br /><div class=\"conpage\">";
        if($nowpage>1){
            $url=formatlink($n_addtime,$cid,1,$newsid,$prepage);
            $pdiv .= "<li><a href=\"{$url}\" style=\"text-decoration:none;\"> 上一页 </a></li>"; 
        }
        if($nowpage<$total){
            $url=formatlink($n_addtime,$cid,1,$newsid,$nextpage);
            $pdiv .= " <li><a href=\"{$url}\" style=\"text-decoration:none;\"> 下一页</a></li>"; 
        }
        $pdiv .= '</div>';  
        $n_content=$arr[$nowpage-1];
        if( $total <=1) $pdiv = ''; 
        $n_content.=$pdiv;
    }else{
        echo "<script language=JavaScript>alert('该栏目不存在，请访问其他内容！');window.close();</script>";exit;
    }
}
require(FR_ROOT.'/inc/common.func.php');
include template('article','article');
?>