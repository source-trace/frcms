<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $db ->query("delete from {$cfg['tb_pre']}education where e_rid=$rid and e_pmember='$username'");
    $db ->query("delete from {$cfg['tb_pre']}training where t_rid=$ridand t_pmember='$username'");
    $db ->query("delete from {$cfg['tb_pre']}lang where l_rid=$rid and l_pmember='$username'");
    $db ->query("delete from {$cfg['tb_pre']}work where w_rid=$rid and w_pmember='$username'");
    $db ->query("delete from {$cfg['tb_pre']}resume where r_member='$username' and r_id=$rid");
	showmsg('删除成功！',"?mpage=person_resume&show=$show",0,2000);exit();
}elseif($do=='activate'){
    $db ->query("update {$cfg['tb_pre']}resume set r_cnstatus=0 where r_member='$username'");
    $db ->query("update {$cfg['tb_pre']}resume set r_cnstatus=1 where r_id=$rid and r_member='$username'");
    showmsg('激活成功！',"?mpage=person_resume&show=$show",0,2000);exit();
}elseif($do=='refresh'){
    $db ->query("update {$cfg['tb_pre']}resume set r_adddate=NOW() where r_id=$rid and r_member='$username'");
    showmsg('刷新成功！',"?mpage=person_resume&show=$show",0,2000);exit();
}else{
    $rsdb=array();
    $sql="select r_id,r_title,r_chinese,r_english,r_cnstatus,r_enstatus,r_visitnum,r_personinfo,r_education,r_train,r_lang,r_work,r_careerwill,m_logo from {$cfg['tb_pre']}resume,{$cfg['tb_pre']}member where r_member=m_login and r_member='$username' order by r_adddate desc limit 0,10";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>我的简历列表</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>您一共可以创建 <strong><?php if($Glimit[5]==0){echo "0";}else{echo $Glimit[6];}?></strong> 份简历，用于申请不同的职位。现已创建 <strong><?php echo $Mresumenums;?></strong> 份，只有处于“<strong>激活</strong>”状态的简历才可以被招聘单位查询。</li>
    </div>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
        <tr class="memtabhead" align="center">
          <td width="8%" height="21">简历编号</td>
          <td width="12%">简历名称</td>
          <td width="10%">简历状态</td>
          <td width="8%">浏览次数</td>
          <td width="8%">记录</td>
          <td width="29%">简历完整度</td>
          <td width="5%">激活</td>
          <td width="5%">预览</td>
          <td width="5%">修改</td>
          <td width="5%">刷新</td>
          <td width="5%">删除</td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
            $jd=0;$i++;
            $rs["r_personinfo"]&&$jd+=20;$rs["r_education"]&&$jd+=12;$rs["r_train"]&&$jd+=10;$rs["r_lang"]&&$jd+=8;$rs["r_work"]&&$jd+=13;$rs["r_careerwill"]&&$jd+=25;
            if($rs['m_logo']!=''&&$rs['m_logo']!='error.gif') $jd+=12;
            if ($rs['r_chinese']==1){
                if ($rs['r_cnstatus']==1){
                    $status="<IMG height=20 alt=\"简历已激活\" src=\"../images/sign_01.gif\" width=19 border=0><font color=\"green\">已激活</font>";
                }else{
                    $status="<IMG height=20 alt=\"简历未激活\" src=\"../images/sign_03.gif\" width=19 border=0><font color=\"#ff0000\">未激活</font>";
                }
            }else{
                if ($rs['r_enstatus']==1){
                    $status="<IMG height=20 alt=\"简历已激活\" src=\"../images/sign_01.gif\" width=19 border=0><font color=\"green\">已激活</font>";
                }else{
                    $status="<IMG height=20 alt=\"简历未激活\" src=\"../images/sign_03.gif\" width=19 border=0><font color=\"#ff0000\">未激活</font>";
                }
            }
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\">$rs[r_id]</td>\r\n";
            echo "          <td>$rs[r_title]</td>\r\n";
            echo "          <td>$status</td>\r\n";
            echo "          <td>$rs[r_visitnum]</td>\r\n";
            echo "          <td><a href=\"?mpage=person_rbrower&show=$show&rid=$rs[r_id]\" title=\"查看浏览详细记录\">查看</a></td>\r\n";
            echo "          <td align=\"left\"><div class=\"hr\" title=\"您的这份简历完整度指数为：$jd%\" style=\"width:$jd%; height:20px;line-height:20px; text-align:right;\">$jd%</div></td>\r\n";
            echo "          <td><a href=\"?do=activate&mpage=person_resume&show=$show&rid=$rs[r_id]\"><img height=17 alt=激活简历 src=\"../images/sign_05.gif\" width=16 border=0 /></a></td>\r\n";
            echo "          <td><a href=\"../person/cnpreview.php?rid=$rs[r_id]\" target=\"_blank\"><img height=17 alt=预览/打印简历 src=\"../images/sign_04.gif\" width=18 border=0 /></a></td>\r\n";
            echo "          <td><a href=\"?mpage=person_addresume&show=$show&rid=$rs[r_id]\"><img height=17 alt=修改简历 src=\"../images/sign_05.gif\" width=16 border=0 /></a></td>\r\n";
            echo "          <td><input name=\"image\" type=image onclick=\"location.href='?do=refresh&mpage=person_resume&show=$show&rid=$rs[r_id]';\" src=\"../images/sign_06.gif\" alt=刷新简历 width=\"15\" height=\"17\" border=0 /></td>\r\n";
            echo "          <td><input name=\"image2\" type=image onclick=\"javascript:{if(confirm('确定要删除吗？')){location.href='?do=del&mpage=person_resume&show=$show&rid=$rs[r_id]';}}\" src=\"../images/sign_07.gif\" alt=删除简历 width=\"14\" height=\"17\" border=0></td>\r\n";
            echo "        </tr>\r\n";
            if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=person&id=$rs[r_id]\"></script>";
        }
        ?>
        <tr class="memtabmain">
          <td height="21" colspan="11" class="tdcolor">专家提醒：简历要保“鲜”！点击列表中的<img height="17" hspace="6" src="../images/sign_06.gif" width="15" align="absmiddle" />图标刷新你的简历，会让企业更优先找到你！</td>
        </tr>
        <tr class="memtabmain">
          <td height="21" colspan="11" class="tdcolor">
          <input name="submit" type="button" class="submit" value="新建一份简历" onclick="javascript:window.location='?mpage=person_addresume&show=<?php echo $show;?>'" />
          <input name="submit" type="button" class="submit" value="简历公开设置" onclick="javascript:window.location='?mpage=person_openresume&show=<?php echo $show;?>'" />
          <!--<input name="submit" type="button" class="submit" value="简历模板设置" onclick="javascript:window.location='?mpage=person_template&show=<?php echo $show;?>'" />-->
          <input name="submit" type="button" class="submit" value="查看最新职位" onclick="javascript:window.location='?mpage=person_newhire&show=3'" />
          </td>
        </tr>
      </table>
    </div>
</div>
