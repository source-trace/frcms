<?php
//图片3D墙插件
//$a类型  $m用户  $t图片类别  $st是否一张   $n数量
require(dirname(__FILE__).'/../../config.inc.php');
@session_start();
$a=$_SESSION['cooliris_a'];
$m=$_SESSION['cooliris_m'];
$t=$_SESSION['cooliris_t'];
$st=$_SESSION['cooliris_st'];
$n=$_SESSION['cooliris_n'];
$a=preg_replace("/[^a-z]/i",'',$a);
    $sqls='';
    header("Content-type: application/xml;");
    $coolcade.="<?xml version=\"1.0\" encoding=\"{$cfg['charset']}\" standalone=\"yes\"". "?". ">\n";
    $coolcade.="<rss version=\"2.0\" xmlns:media=\"http://search.yahoo.com/mrss/\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
    $coolcade.="<channel>\n";
    $coolcade.="\t<title>3D图片墙_{$cfg['sitetitle']}</title>\n";
    $coolcade.="\t<link>{$cfg['siteurl']}</link>\n"; 
    $coolcade.="\t<description>{$cfg['description']}</description>\n";
    $coolcade.="\t<copyright>Copyright(C) {$cfg['sitename']}</copyright>\n";
    $coolcade.="\t<language>zh-cn</language>\n";
    $coolcade.="\t<generator>FR-HRCMS By Fine Sincere Inc.</generator>\n";
if($a=='news'){
    $sqls.=$w!=""?" and n_title like '%$w%'":"";
    $s=intval($s);
    $sqls.=$s!=0?" and n_sid=$s":"";
    $sql="select n_id,n_sid,n_cid,n_title,n_content,n_addtime,n_content,n_author,s_name from {$cfg['tb_pre']}news,{$cfg['tb_pre']}newssort where n_cid=s_cid and n_sid=s_id $sqls order by n_addtime desc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $coolcade.="\t<item>\n";
        $coolcade.="\t\t<title><![CDATA[{$row['n_title']}]]></title>\n";
        $coolcade.="\t\t<link>{$cfg['siteurl']}".formatlink($row["n_addtime"],$row["n_cid"],1,$row["n_id"],0)."</link>\n"; // 插入链接页 
        $coolcade.="\t\t<description><![CDATA[".sub_cnstrs($row['n_content'],300)."]]></description >\n";
        $coolcade.="\t\t<category>{$row['s_name']}</category>\n";
        $coolcade.="\t\t<author>{$row['n_author']}</author>\n";
        $coolcade.="\t\t<pubDate>".date('r',strtotime($row['n_addtime']))."</pubDate>\n";
        $coolcade.="\t</item>\n";
    }
}elseif($a=='member'){
    $sqlstr='';
    if($m!='') $sqlstr.=" and p_member='$m'";
    $t&&$sqlstr.=" and p_type=$t";
    $st&&$sqlstr.=" group by p_member";
    $sqlstr.=" order by p_adddate desc";
    $n&&$sqlstr.=" limit 0,$n";
    $sql="select p_id,p_filename,p_name,p_info from {$cfg['tb_pre']}picture where p_status=1 and p_flag=1 $sqlstr";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $pic=str_replace("../","",$row["p_filename"]);
        if(substr($t,0,1)==2) $link=formatlink(0,1,2,$row["p_id"],0);
        if(substr($t,0,1)==1) $link=formatlink(0,2,4,$row["p_id"],0);
        if(substr($t,0,1)==3) $link=formatlink(0,3,10,$row["p_id"],0);
        if(substr($t,0,1)==4) $link=formatlink(0,5,9,$row["p_id"],0);
        $coolcade.="\t<item>\n";
        $coolcade.="\t\t<title>{$row['p_name']}</title>\n";
        $coolcade.="\t\t<media:description><![CDATA[{$row['p_info']}]]></media:description>\n";
        $coolcade.="\t\t<link>{$cfg['siteurl']}".$link."</link>\n"; // 插入链接页 
        $coolcade.="\t\t<media:thumbnail url=\"{$cfg['siteurl']}{$cfg['path']}$pic\"/>\n";
        $coolcade.="\t\t<media:content url=\"{$cfg['siteurl']}{$cfg['path']}$pic\"/>\n";
        $coolcade.="\t</item>\n";
    }
}elseif($a=='resume'){
    $sqls.=$w!=""?" and r_position like '%$w%'":"";
    $sql="select r_id,r_sex,r_birth,r_edu,r_position,r_jobtype,r_workadd,r_adddate,r_name,r_sumup,r_appraise from {$cfg['tb_pre']}resume where r_flag=1 and r_openness=0 and r_personinfo=1 and r_cnstatus=1 and r_careerwill=1 $sqls order by r_adddate desc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $coolcade.="\t<item>\n";
        $coolcade.="\t\t<title><![CDATA[求职：".hireposition($row["r_position"],0,1)."]]></title>\n";
        $coolcade.="\t\t<link>{$cfg['siteurl']}".formatlink($row["r_adddate"],1,1,$row["r_id"],0)."</link>\n"; // 插入链接页 
        $coolcade.="\t\t<description><![CDATA[性别：".hiresex($row["r_sex"])." 出生年月：{$row[r_birth]} 学历：".hireedu($row["r_edu"])." 意向工作地：".hireworkadd($row["r_workadd"])."<br><b>特长概括：</b>".$row['r_sumup']."<br><b>自我评价：</b>".$row['r_appraise']."]]></description >\n";
        $coolcade.="\t\t<category>个人求职</category>\n";
        $coolcade.="\t\t<pubDate>".date('r',strtotime($row['r_adddate']))."</pubDate>\n";
        $coolcade.="\t</item>\n";
    }
}
$coolcade.="\t</channel>\n";
$coolcade.="\t</rss>\n";

if($cfg['charset']!='utf-8'){
    $coolcade=str_replace("encoding=\"{$cfg['charset']}\"","encoding=\"utf-8\"",$coolcade);
    $coolcade=@iconv($cfg['charset'],'utf-8',$coolcade);
}
echo $coolcade;
?>