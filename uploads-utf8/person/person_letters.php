<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='add'){
    $sqladd='';
    $title=cleartags($title);
    $content=replace_strbox($content);
    if($title==''||$content==''){
        showmsg('数据不完整，2秒后返回到添加页面！',"-1",0,2000);exit();
    }else{
        $lid=intval($lid);
        if($lid!=0){
            $db ->query("update {$cfg['tb_pre']}letter set l_title='$title',l_content='$content',l_adddate=NOW() where l_member='$username' and l_id=$lid");
        }else{
            $db ->query("INSERT INTO {$cfg['tb_pre']}letter (l_title,l_content,l_member,l_adddate) VALUES('$title','$content','$username',NOW())");
            $integral=$Gintegral[4];
			require_once(FR_ROOT.'/inc/paylog.inc.php');
			upintegral($Memberid,"增加求职信获得积分+$integral",$integral);
        }
        showmsg('操作成功！',"?mpage=person_letters&show=$show",0,2000);exit();
    }
}elseif($do=='del'){
    $lid=intval($lid);
    $db->query("delete from {$cfg['tb_pre']}letter where l_member='$username' and l_id=$lid");
    showmsg('删除成功！',"?mpage=person_letters&show=$show",0,2000);exit();
}elseif($t=='addform'){
    $lid=intval($lid);
    if($lid!=0){
        $rs = $db->get_one("select l_title,l_content from {$cfg['tb_pre']}letter where l_member='$username' and l_id=$lid limit 0,1");
        if($rs){
            $title=$rs['l_title'];
            $content=change_strbox($rs['l_content']);
        }
    }else{
        $lid=$title=$content='';
    }
    $tabtit='定义求职信模版';
}else{
    $rsdb=array();
    $maxlimit=$Glimit[7]?$Glimit[7]:10;
    $sql="select l_id,l_title,l_adddate from {$cfg['tb_pre']}letter where l_member='$username' order by l_adddate desc limit 0,$maxlimit";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $tabtit='求职信模版列表';
}

?>
<div class="memrightl">
    <div class="memrighttit"><span></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
     <?php if($t=='addform'){?>
    <script language="javascript">
		function check()
		{
			if (document.addform.title.value=="")
			{
				alert("请输入求职信标题");
				document.addform.title.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="addform" id="addform" action="index.php?do=add&mpage=person_letters&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">求职信标题：</li>
            <li class="r"><input name="title" type="text" id="title" value="<?php echo $title;?>" /></li>
            <li class="l">求职信内容：</li>
            <li class="r"><textarea name="content" cols="60" rows="8" id="content"><?php echo $content;?></textarea>（限2000字符）</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="lid" type="hidden" id="lid" value="<?php echo $lid;?>" /><input name="submit" type="submit" class="submit" value="保存" /></label></li>            
        </ul>
        </form>
        </div>
        <?php }else{?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
        <td width="5%">编号</td>
          <td width="20%" height="21">求职信标题</td>
          <td width="17%">添加时间</td>
          <td width="6%">修改</td>
          <td width="6%">删除</td>
        </tr>
        <?php
            $i=0;
            foreach($rsdb as $key=>$rs){
                $i++;
                echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
                echo "          <td>$rs[l_id]</td>\r\n";
                echo "          <td height=\"22\">$rs[l_title]</a></td>\r\n";
                echo "          <td>$rs[l_adddate]</td>\r\n";
                //echo "          <td><a href=\"letter_preview.php?id=$rs[l_id]\" target=\"_blank\"><img src=\"../images/sign_04.gif\" border=\"0\"></a></td>\r\n";
                echo "          <td><a href=\"index.php?mpage=person_letters&show=$show&t=addform&lid=$rs[l_id]\"><IMG height=17 alt=修改求职信 src='../images/sign_05.gif' width=16 border=0></a></td>\r\n";
                echo "          <td><a href=\"javascript:if(confirm('确定要删除吗?'))location.href='index.php?mpage=person_letters&show=$show&lid=$rs[l_id]&do=del'\"><img height=17 alt=修改求职信 src='../images/sign_07.gif' width=16 border=0></a></td>\r\n";
                echo "        </tr>\r\n";
            }
            if($i<$maxlimit){
            ?>
            <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input name="button" type="button" value="创建求职信模板" class="inputs" onClick="location.href='?mpage=person_letters&show=<?php echo $show;?>&t=addform';"/></div></td>
        </tr>
        <?php }?>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
          <tr class="memtabmain">
            <td>你可以在这里保存求职信，附在简历上发给招聘单位。你可以保存<?php echo $Glimit[7];?>份不同内容的求职信，以适应不同职位的需求,目前你已经添加并保存过<?php echo $i;?>份。</td>
          </tr>
      </table>
        <?php }?>
    </div>
</div>