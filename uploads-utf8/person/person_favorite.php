<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $db ->query("delete from {$cfg['tb_pre']}myfavorite where f_pmember='$username' and f_id in ($checks)");
	showmsg('删除成功！',"?mpage=person_favorite&show=$show",0,2000);exit();
}else{
    $rsdb=array();
    $sql="select f_id,f_hid,f_comname,f_place,f_adddate from {$cfg['tb_pre']}myfavorite where f_pmember='$username' order by f_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"index.php?mpage=person_favorite&show=$show",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>收藏的职位</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">招聘职位</td>
          <td width="23%">公司名称</td>
          <td width="10%">招聘人数</td>
          <td width="20%">收藏时间</td>
          <td width="10%">应聘人数</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
            $rss = $db->get_one("select DATEDIFF(h_enddate,'".date('Y-m-d')."') as enddate,h_number,h_status,h_adddate,h_receiveresume from {$cfg['tb_pre']}hire where h_id=$rs[f_hid] limit 0,1");
			if($rss){
				if($rss['enddate']<0||$rss['h_status']=0){
				    $place=$rs['f_place']."（停止招聘）";
				}else{
				    $place="<a href=\"".formatlink($rss["h_adddate"],2,3,$rs["f_hid"],0)."\" target=\"_blank\">$rs[f_place]</a>";
				}
                $receiveresume=$rss['h_receiveresume'];
                $number=hirenumber($rss['h_number']);
			}else{
                $place=$rs['f_place']."（已删除）";
                $number=hirenumber(0);
                $receiveresume=0;
			}
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\">$place</td>\r\n";
            echo "          <td>$rs[f_comname]</td>\r\n";
            echo "          <td>$number</td>\r\n";
            echo "          <td>$rs[f_adddate]</td>\r\n";
            echo "          <td>$receiveresume</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[f_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="6"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="投递简历" onClick="confirmX(1);"> <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(2);"></div><?php echo $getpageinfo['pagecode'];?></td>
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
        		document.form.action="?a=favorite&mpage=person_resumesend&show=<?php echo $show;?>";
        		document.form.submit();
        	}
            if(num==2)
        	{
        		document.form.action="?do=del&mpage=person_favorite&show=<?php echo $show;?>";
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
    </div>
</div>