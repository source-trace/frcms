<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    if($checks){
        $db ->query("delete from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_id in ($checks) and m_down!=1");
        $db ->query("update {$cfg['tb_pre']}myexpert set m_exp=2 where m_cmember='$username' and m_id in ($checks) and m_down=1");
    }
	showmsg('删除成功！',"?mpage=company_myexpert&show=$show",0,2000);exit();
}elseif($do=='myexpert'){
	if(!$Glimit[2]){showmsg('您所在的会员组您无权使用人才库！',"-1",0,2000);exit();}
	$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
	$checksnum=count(explode(',',$checks));
	if($Glimit[3]&&$Mexpertnum<$checksnum){showmsg('您的人才库可用数量不足，请返回重新选择！',"-1",0,2000);exit();}
	if($checks!=''){
		$sql="select r_id,r_name,r_sex,r_birth,r_edu,r_member from {$cfg['tb_pre']}resume where r_id in ($checks) order by r_adddate desc limit 0,$checksnum";
		$query=$db->query($sql);
		$i=0;
		while($row=$db->fetch_array($query)){
        	$rsd = $db->get_one("select * from {$cfg['tb_pre']}myexpert where m_pmember='$row[r_member]' and m_cmember='$row[m_cmember]' and m_rid=$row[r_id] limit 0,1");
			if(!$rsd){
				$db ->query("INSERT INTO {$cfg['tb_pre']}myexpert (m_rid,m_name,m_sex,m_birth,m_edu,m_cmember,m_pmember,m_adddate,m_exp) VALUES('$row[r_id]','$row[r_name]','$row[r_sex]','$row[r_birth]','$row[r_edu]','$username','$row[r_member]',NOW(),1)");
				$i++;	
			}else{
				if($rsd['m_exp']!=1){
					$db ->query("update {$cfg['tb_pre']}myexpert set m_exp=1,m_adddate=NOW() where m_cmember='$username' and m_id=$rsd[m_id]");
					$i++;
				}
			}
    	}
		//更新人才库记录
		if($Glimit[3]==0){
			$db ->query("update {$cfg['tb_pre']}member set m_expertnums=m_expertnums+$i,m_activedate=NOW() where m_login='$username'");
		}else{
			$db ->query("update {$cfg['tb_pre']}member set m_expertnums=m_expertnums+$i,m_expertnum=m_expertnum-$i,m_activedate=NOW() where m_login='$username'");
		}
        $integral=$Gintegral[1];
		require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($Memberid,"储备人才简历获得积分+$integral",$integral);
        showmsg('操作成功！',"?mpage=company_myexpert&show=$show",0,2000);exit();
	}else{
		showmsg('请先选择要放入人才库的简历内容！',"-1",0,2000);exit();
	}
}else{
        $rsdb=array();
        $sql="select * from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_exp=1 order by m_adddate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=company_myexpert&show=$show",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>企业人才库</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="20%" height="21">姓名</td>
          <td width="15%">性别</td>
          <td width="15%">年龄</td>
          <td width="15%">学历</td>
          <td width="25%">收藏时间</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"8\">您尚未收藏任何人才简历，您可以通过”<a href=\"?mpage=company_newresume&show=3\">浏览最新人才</a>“或”<a href=\"?mpage=company_searchresume&show=3\">人才综合查询</a>“来查询最新登记的简历，收藏合适的人才建立人才储备库!</td>\r\n";
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
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(1);">
<input name="button3" type="button" class="inputs" value="邀请面试" onClick="confirmX(2);"></div><?php echo $getpageinfo['pagecode'];?></td>
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
                    document.form.action="?do=del&mpage=company_myexpert&show=<?php echo $show;?>";
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