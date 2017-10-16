<?php
require(dirname(__FILE__).'/config.inc.php');
if(empty($a)) $a='';
$a=preg_replace("/[^a-z]/i",'',$a);
if($a!=''){
    $w=cleartags($w);
    $sqls='';
    header("Content-type: application/xml");
    echo "<?xml version=\"1.0\" encoding=\"{$cfg['charset']}\"". "?". ">\n";
    echo "<rss version=\"2.0\">\n";
    echo "<channel>\n";
    $at=$w!=''?$a.'('.$w.')':$a;
    echo "\t<title>{$at}_{$cfg['sitetitle']}</title>\n";
    echo "\t<link>{$cfg['siteurl']}</link>\n"; 
    echo "\t<description>{$cfg['description']}</description>\n";
    echo "\t<copyright>Copyright(C) {$cfg['sitename']}</copyright>\n";
    echo "\t<language>zh-cn</language>\n";
    echo "\t<generator>FR-HRCMS By Fine Sincere Inc.</generator>\n";
}
if($a=='news'){
    $sqls.=$w!=""?" AND `n_title` LIKE '%$w%'":"";
    $s=intval($s);
    $sqls.=$s!=0?" AND `n_sid`=$s":"";
    $sql="SELECT `n_id`,`n_sid`,`n_cid`,`n_title`,`n_content`,`n_addtime`,`n_author`,`s_name` FROM `{$cfg['tb_pre']}news` INNER JOIN {$cfg['tb_pre']}newssort on n_cid=s_cid where n_sid=s_id $sqls order by n_addtime desc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        echo "\t<item>\n";
        echo "\t\t<title><![CDATA[{$row['n_title']}]]></title>\n";
        echo "\t\t<link>{$cfg['siteurl']}".formatlink($row["n_addtime"],$row["n_cid"],1,$row["n_id"],0)."</link>\n"; // 插入链接页 
        echo "\t\t<description><![CDATA[".sub_cnstrs($row['n_content'],300)."]]></description >\n";
        echo "\t\t<category>{$row['s_name']}</category>\n";
        echo "\t\t<author>{$row['n_author']}</author>\n";
        echo "\t\t<pubDate>".date('r',strtotime($row['n_addtime']))."</pubDate>\n";
        echo "\t</item>\n";
    }
}elseif($a=='job'){
    $sqls.=$w!=""?" and h_place like '%$w%'":"";
    $sql="select h_id,h_adddate,h_place,h_comname,h_number,h_type,h_enddate,h_workadd,h_edu,h_pay,h_introduce from {$cfg['tb_pre']}hire where h_status=1 $sqls order by h_adddate desc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        echo "\t<item>\n";
        echo "\t\t<title><![CDATA[{$row['h_comname']}招聘{$row['h_place']}]]></title>\n";
        echo "\t\t<link>{$cfg['siteurl']}".formatlink($row["h_adddate"],2,3,$row["h_id"],0)."</link>\n"; // 插入链接页 
        echo "\t\t<description><![CDATA[<font color=\"#ff0000\">招聘类别：".hiretype($row["h_type"])." 招聘人数：".hirenumber($row["h_number"])." 薪资待遇：".hirepay($row["h_pay"])." 学历要求：".hireedu($row["h_edu"])."<br> 工作地区：".xreplace($row["h_workadd"])."</font><br><b>具体描述：</b><br>".$row['h_introduce']."]]></description >\n";
        echo "\t\t<category>企业招聘</category>\n";
        echo "\t\t<pubDate>".date('r',strtotime($row['h_adddate']))."</pubDate>\n";
        echo "\t</item>\n";
    }
}elseif($a=='resume'){
    $sqls.=$w!=""?" and r_position like '%$w%'":"";
    $sql="select r_id,r_sex,r_birth,r_edu,r_position,r_jobtype,r_workadd,r_adddate,r_name,r_sumup,r_appraise from {$cfg['tb_pre']}resume where r_flag=1 and r_openness=0 and r_personinfo=1 and r_cnstatus=1 and r_careerwill=1 $sqls order by r_adddate desc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        echo "\t<item>\n";
        echo "\t\t<title><![CDATA[求职：".hireposition($row["r_position"],0,1)."]]></title>\n";
        echo "\t\t<link>{$cfg['siteurl']}".formatlink($row["r_adddate"],1,1,$row["r_id"],0)."</link>\n"; // 插入链接页 
        echo "\t\t<description><![CDATA[性别：".hiresex($row["r_sex"])." 出生年月：{$row[r_birth]} 学历：".hireedu($row["r_edu"])." 意向工作地：".xreplace($row["r_workadd"])."<br><b>特长概括：</b>".$row['r_sumup']."<br><b>自我评价：</b>".$row['r_appraise']."]]></description >\n";
        echo "\t\t<category>个人求职</category>\n";
        echo "\t\t<pubDate>".date('r',strtotime($row['r_adddate']))."</pubDate>\n";
        echo "\t</item>\n";
    }
}else{
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"最新资讯_{$cfg['sitename']}\" href=\"{$cfg['siteurl']}{$cfg['path']}rss.php?a=news\" />\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"最新职位_{$cfg['sitename']}\" href=\"{$cfg['siteurl']}{$cfg['path']}rss.php?a=job\" />\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"最新人才_{$cfg['sitename']}\" href=\"{$cfg['siteurl']}{$cfg['path']}rss.php?a=resume\" />\n";
}
if($a!=''){
echo "\t</channel>\n";
echo "\t</rss>\n";
}
?>