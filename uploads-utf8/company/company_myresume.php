<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    if($checks){
        $db ->query("delete from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_id in ($checks) and m_exp!=1");
        $db ->query("update {$cfg['tb_pre']}myexpert set m_down=2 where m_cmember='$username' and m_id in ($checks) and m_exp=1");
    }
	showmsg('删除成功！',"?mpage=company_myresume&show=$show",0,2000);exit();
}else{
        $rsdb=array();
        $sql="select * from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_down=1 order by m_downdate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=company_myresume&show=$show",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>已下载的简历</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="20%" height="21">姓名</td>
          <td width="15%">性别</td>
          <td width="15%">年龄</td>
          <td width="15%">学历</td>
          <td width="25%">下载时间</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"8\">您尚未下载任何人才简历，您可以通过”<a href=\"?mpage=company_newresume&show=3\">浏览最新人才</a>“或”<a href=\"?mpage=company_searchresume&show=3\">人才综合查询</a>“来查询最新登记的简历，下载合适的人才简历!</td>\r\n";
        echo "        </tr>\r\n";
        }
        foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\"><a href=\"../company/company_resumeview.php?rid=$rs[m_rid]\" target=\"_blank\">$rs[m_name]</a></td>\r\n";
            echo "          <td>".hiresex($rs['m_sex'])."</td>\r\n";
            echo "          <td>".(date('Y')-date('Y',strtotime($rs['m_birth'])))."</td>\r\n";
            echo "          <td>".hireedu($rs['m_edu'])."</td>\r\n";
            echo "          <td>$rs[m_adddate]</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[m_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="7"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="删除" onclick="confirmX(1);">
<input name="button3" type="button" class="inputs" value="邀请面试" onclick="confirmX(2);"></div><?php echo $getpageinfo['pagecode'];?></td>
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
        				form.checks.value = allSel;
        				check=true;
        				
        			}
        		}
        		if(check==false){alert("请选择操作对象！");return false;}
        	}
        	if(num==1)
        	{
        		if(confirm("您确定要删除记录吗？")==true)
                {
                    document.form.action="?do=del&mpage=company_myresume&show=<?php echo $show;?>";
                    document.form.submit();
                }
        	}
            if(num==2){
        		if(confirm("您确定要发送面试邀请吗？")==true)
        		{
        			document.form.action="?a=myexpert&mpage=company_interviewsend&show=<?php echo $show;?>";
        			document.form.submit();
        		}
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