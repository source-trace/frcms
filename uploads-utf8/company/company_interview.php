<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $checks&&$db ->query("delete from {$cfg['tb_pre']}interview where i_cmember='$username' and i_id in ($checks)");
	showmsg('删除成功！',"?mpage=company_interview&show=$show",0,2000);exit();
}else{
        $rsdb=array();
        $sql="select * from {$cfg['tb_pre']}interview where i_cmember='$username' order by i_adddate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=company_interview&show=$show",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>邀请面试记录</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">姓名</td>
          <td width="10%">性别</td>
          <td width="10%">年龄</td>
          <td width="10%">学历</td>
          <td width="25%">应聘职位</td>
          <td width="25%">通知时间</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"8\">您尚未邀请任何人面试，您可以通过”<a href=\"?mpage=company_newresume&show=3\">浏览最新人才</a>“或”<a href=\"?mpage=company_searchresume&show=3\">人才综合查询</a>“来查询最新登记的简历，并选择合适的人才主动邀请前来面试!</td>\r\n";
        echo "        </tr>\r\n";
        }
        foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\"><a href=\"../company/company_resumeview.php?rid=$rs[i_rid]\" target=\"_blank\">$rs[i_name]</a></td>\r\n";
            echo "          <td>".hiresex($rs['i_sex'])."</td>\r\n";
            echo "          <td>".(date('Y')-date('Y',strtotime($rs['i_birth'])))."</td>\r\n";
            echo "          <td>".hireedu($rs['i_edu'])."</td>\r\n";
            echo "          <td>$rs[i_place]</td>\r\n";
            echo "          <td>$rs[i_adddate]</td>\r\n";
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
        				form.checks.value = allSel;
        				check=true;
        				
        			}
        		}
        		if(check==false){alert("请选择操作对象！");return false;}
        	}
        	if(num==1)
        	{
        		if(confirm("您确定要删除邀请记录吗？")==true)
                {
                    document.form.action="?do=del&mpage=company_interview&show=<?php echo $show;?>";
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