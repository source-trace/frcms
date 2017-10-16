<?php
require_once(dirname(__FILE__).'/../config.inc.php');
if(empty($do)) $do= '';
if($do=="vote"){
    $vid=intval($vid);
    $voted = empty($voted) ? array() : $voted;
    $t_count=count($voted);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            $db ->query("update {$cfg['tb_pre']}vote set v_count=v_count+1 where v_id=$voted[$i]");
        }
    }else{
        echo "<script>alert('请选择投票项目。');window.close()</script>";exit();
    }
    header("Location: vote.php?do=show&vid=$vid");exit;
}elseif($do=="show"){
    if(is_numeric($vid)){
        $vid=intval($vid);
        $rs = $db->get_one("select v_style,v_title from {$cfg['tb_pre']}vote where v_id=$vid and v_ing=1 and DATEDIFF(v_end,'".date('Y-m-d')."')>=0 and v_class=0");
        if($rs){
            $str="<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#eeeeee\" style=\"margin:2px 0;\">\r\n";
            $str.="  <tr>\r\n";
            $str.="    <td colspan=\"3\" align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"votetitle\">$rs[v_title]</span></td>\r\n";
            $str.="  </tr>\r\n";
            $rss = $db->get_one("select sum(v_count) as total from {$cfg['tb_pre']}vote where v_class=$vid");
            $totalcount = $rss ? $rss['total'] : 0;
            $sql="select v_id,v_title,v_count,v_color from {$cfg['tb_pre']}vote where v_class=$vid";
            $query=$db->query($sql);
            while($row=$db->fetch_array($query)){
            $str.="  <tr>\r\n";
            $str.="    <td width=\"35%\" bgcolor=\"#FFFFFF\">&nbsp;投票选项: $row[v_title]</td>\r\n";
            $h=round($row["v_count"]*300/$totalcount);
            $str.="    <td width=\"45%\" align=\"left\" valign=\"middle\" bgcolor=\"#FFFFFF\"><hr width=\"$h\" color=\"$row[v_color]\" style=\"height:10px;\"></td>\r\n";
            $str.="    <td width=\"20%\" bgcolor=\"#FFFFFF\"> <span class=\"votenum\">$row[v_count]</span> 票(".round($row["v_count"]*100/$totalcount,2)."%)</td>\r\n";
            $str.="  </tr>\r\n";
            }
            $str.="  <tr>\r\n";
            $str.="    <td colspan=\"3\" align=\"right\" bgcolor=\"#FFFFFF\" style=\" padding-right:20px;\"><a href=\"{$cfg['siteurl']}{$cfg['path']}\">返回首页</a> <a href=\"#\" onclick=\"javacript:window.close();\" title=\"关闭本页\">关闭</a> 共有{$totalcount}人投票</td>\r\n";
            $str.="  </tr>\r\n";
            $str.="</table>\r\n";
            echo $str;
        }
    }else{
        echo "<script>alert(\"非法参数!\");window.close();</script>";exit();
    }

}else{
    if(is_numeric($vid)){
        $vid=intval($vid);
        $rs = $db->get_one("select v_style,v_title from {$cfg['tb_pre']}vote where v_id=$vid and v_ing=1 and DATEDIFF(v_end,'".date('Y-m-d')."')>=0 and v_class=0");
        if($rs){
            $str="<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"2\">";
            $str.="<form name=\"form\" target=\"_blank\" action=\"{$cfg['siteurl']}{$cfg['path']}plus/vote.php?do=vote&v_style=$rs[v_style]\" method=\"post\">";
            $str.="<tr><td class=\"votetitle\" align=\"center\"><b>$rs[v_title]</b><input type=\"hidden\" name=\"vid\" value=\"$vid\"></td></tr>";
            echo "document.write ('$str');\r\n";
            $sql="select v_id,v_title from {$cfg['tb_pre']}vote where v_class=$vid";
            $query=$db->query($sql);
            while($row=$db->fetch_array($query)){
                $str="<tr><td align=\"left\"><input type=\"$rs[v_style]\" name=\"voted[]\" value=\"$row[v_id]\" size=\"20\">$row[v_title]</td></tr>";
                echo "document.write ('$str');\r\n";
            }
            $str="<tr><td>";
            $str.="<input type=\"Submit\" name=\"Submit\" value=\"投票\">&nbsp;&nbsp;";
            $str.="<input type=\"button\" name=\"button\" onclick=window.open(\"{$cfg['siteurl']}{$cfg['path']}plus/vote.php?do=show&vid=$vid\") value=\"查看\">";
            $str.="</td></tr></form></table>";
            echo "document.write ('$str');";exit();
            
        }else{
            echo "document.write ('没有该投票或已结束!');";exit();
        }
    }
}
?>