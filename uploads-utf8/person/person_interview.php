<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $db ->query("delete from {$cfg['tb_pre']}myinterview where i_pmember='$username' and i_id in ($checks)");
	showmsg('删除成功！',"?mpage=person_interview&show=$show",0,2000);exit();
}else{
    if($t=='read'&&$id!=''){
        $id=intval($id);
        $rs = $db->get_one("select i_title,i_content,i_comname from {$cfg['tb_pre']}myinterview where i_pmember='$username' and i_id=$id limit 0,1");
        if($rs){
            $title=$rs['i_title'];
            $content=change_strbox($rs['i_content']);
            $comname=$rs['i_comname'];
        }else{
            showmsg('内容不存在！',"-1",0,2000);exit();
        }
    }else{
        $rsdb=array();
        $sql="select i_id,i_hid,i_comname,i_place,i_adddate,i_read from {$cfg['tb_pre']}myinterview where i_pmember='$username' order by i_adddate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=person_interview&show=$show",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>收到的面试通知</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>如果发现有企业发送的邀请面试内容存在虚假或其他非招聘信息，请向我们投诉！</li>
    </div>
    <?php if($t=='read'){?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabmain">
        <td height="30" style="border-top:#efefef 1px solid;"><div align="center" style="font-size:12px; font-weight:bold"><?php echo $title;?></div></td>
      </tr>
      <tr class="memtabmain">
        <td height="30"><div align="center">面试公司：<?php echo $comname;?></div></td>
      </tr>
      <tr class="memtabmain">
        <td height="200" valign="top" style="text-align: left;"><?php echo $content;?></td>
      </tr>
      <tr class="memtabmain">
        <td height="30" align="center"><input name="submit" type="button" class="submit" value="返回" onclick="javascript:history.back();" /></td>
      </tr>
    </table>
    <?php }else{?>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">面试职位</td>
          <td width="25%">公司名称</td>
          <td width="10%">招聘人数</td>
          <td width="20%">通知时间</td>
          <td width="10%">面试人数</td>
          <td width="15%">是否已读</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"7\">暂无面试通知，您可以通过”<a href=\"?mpage=person_newhire&show=3\">浏览最新职位</a>“或”<a href=\"?mpage=person_searchhire&show=3\">职位综合查询</a>“来查询最新适合您的职位，并主动投递简历获得更多就业机会!</td>\r\n";
        echo "        </tr>\r\n";
        }
        foreach($rsdb as $key=>$rs){
            $rss = $db->get_one("select DATEDIFF(h_enddate,'".date('Y-m-d')."') as enddate,h_number,h_status,h_adddate,h_sendinterview from {$cfg['tb_pre']}hire where h_id=$rs[i_hid] limit 0,1");
			if($rss){
				if($rss['enddate']<0||$rss['h_status']=0){
				    $place=$rs['s_place']."（停止招聘）";
				}else{
				    $place="<a href=\"".formatlink($rss["h_adddate"],2,3,$rs["i_hid"],0)."\" target=\"_blank\">$rs[i_place]</a>";
				}
                $sendinterview=$rss['h_sendinterview'];
                $number=hirenumber($rss['h_number']);
			}else{
                $place=$rs['i_place']."（已删除）";
                $number=hirenumber(0);
                $sendinterview=0;
			}
            $read=$rs['i_read']?'已读':'未读';
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\">$place</td>\r\n";
            echo "          <td>$rs[i_comname]</td>\r\n";
            echo "          <td>$number</td>\r\n";
            echo "          <td>$rs[i_adddate]</td>\r\n";
            echo "          <td>$sendinterview</td>\r\n";
            echo "          <td>$read&nbsp;&nbsp;<a href=\"?t=read&mpage=person_interview&show=$show&id=$rs[i_id]\">查看</a>	</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[i_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="7"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(1);"></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <script language="javascript">
        function confirmX(num)
        {
        	var ids = document.getElementsByName("id");
        	var check=false;
        	var allSel="";
        	if (ids != null) {
        		for (i=0; i<ids.length; i++) 
        		{
        			var obj = ids[i];
        			if (obj.checked==true)
        			{
        				if(allSel==""){
        				allSel=obj.value;
        				}else{
        				allSel=allSel+","+obj.value;
        				}
        				document.form.checks.value = allSel;
        				check=true;
        				
        			}
        		}
        		if(check==false){alert("请选择操作对象！");return false;}
        	}
        	if(num==1)
        	{
        		document.form.action="?do=del&mpage=person_interview&show=<?php echo $show;?>";
        		document.form.submit();
        	}
        	return false;	
        }
        function checkAll(box1) {
            var ids = document.getElementsByName("id");
        	if (ids != null) {
        		for (i=0; i<ids.length; i++) {
        			var obj = ids[i];
        			obj.checked = box1.checked;
        		}
        	}
        }
        </script>
        <?php }?>
    </div>
</div>