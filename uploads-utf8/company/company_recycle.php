<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $checks&&$db ->query("delete from {$cfg['tb_pre']}recycle where r_cmember='$username' and r_id in ($checks)");
	showmsg('删除成功！',"?mpage=company_recycle&show=$show",0,2000);exit();
}elseif($do=='clean'){
    $db ->query("delete from {$cfg['tb_pre']}recycle where r_cmember='$username'");
	showmsg('清空成功！',"?mpage=company_recycle&show=$show",0,2000);exit();
}elseif($do=='myexpert'){
	if(!$Glimit[2]){showmsg('您所在的会员组您无权使用人才库！',"-1",0,2000);exit();}
	$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
	$checksnum=count(explode(',',$checks));
	if($Glimit[3]&&$Mexpertnum<$checksnum){showmsg('您的人才库可用数量不足，请返回重新选择！',"-1",0,2000);exit();}
	if($checks!=''){
		$sql="select * from {$cfg['tb_pre']}recycle where r_cmember='$username' and r_id in ($checks) order by r_adddate desc limit 0,$checksnum";
		$query=$db->query($sql);
		$i=0;
		while($row=$db->fetch_array($query)){
        	$rsd = $db->get_one("select * from {$cfg['tb_pre']}myexpert where m_pmember='$row[r_pmember]' and m_cmember='$row[r_cmember]' and m_rid=$row[r_rid] limit 0,1");
			if(!$rsd){
				$db ->query("INSERT INTO {$cfg['tb_pre']}myexpert (m_rid,m_name,m_sex,m_birth,m_edu,m_cmember,m_pmember,m_adddate,m_exp) VALUES('$row[r_rid]','$row[r_name]','$row[r_sex]','$row[r_birth]','$row[r_edu]','$username','$row[r_pmember]','$row[r_adddate]',1)");
				$i++;	
			}else{
				if($rsd['m_exp']!=1){
					$db ->query("update {$cfg['tb_pre']}myexpert set m_exp=1,m_adddate=NOW() where m_cmember='$username' and m_id=$rsd[m_id]");
					$i++;
				}
			}
			//把工作申请记录中相应信息的收藏标志置1
	 		$db ->query("update {$cfg['tb_pre']}mysend set s_favorite=1 where s_hid=$row[r_hid] and s_cmember='$row[r_cmember]' and s_pmember='$row[r_pmember]'");
    	}
		//更新人才库记录
		if($Glimit[3]==0){
			$db ->query("update {$cfg['tb_pre']}member set m_expertnums=m_expertnums+$i,m_activedate=NOW() where m_login='$username'");
		}else{
			$db ->query("update {$cfg['tb_pre']}member set m_expertnums=m_expertnums+$i,m_expertnum=m_expertnum-$i,m_activedate=NOW() where m_login='$username'");
		}
        //删除回收站
        $db ->query("delete from {$cfg['tb_pre']}recycle where r_id in ($checks)");
        showmsg('操作成功！',"?mpage=company_recycle&show=$show",0,2000);exit();
	}else{
		showmsg('请先选择要放入人才库的简历内容！',"-1",0,2000);exit();
	}
}elseif($do=='renew'){
	$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
	$checksnum=count(explode(',',$checks));
	if($checks!=''){
		$sql="select * from {$cfg['tb_pre']}recycle where r_cmember='$username' and r_id in ($checks) order by r_adddate desc limit 0,$checksnum";
		$query=$db->query($sql);
		$i=0;
		while($row=$db->fetch_array($query)){
            $db ->query("INSERT INTO {$cfg['tb_pre']}myreceive (m_rid,m_name,m_sex,m_birth,m_edu,m_hid,m_place,m_cmember,m_pmember,m_adddate,m_content) VALUES('$row[r_rid]','$row[r_name]','$row[r_sex]','$row[r_birth]','$row[r_edu]','$row[r_hid]','$row[r_place]','$username','$row[r_pmember]','$row[r_adddate]','$row[r_content]')");
			$i++;
    	}
        //删除回收站
        $db ->query("delete from {$cfg['tb_pre']}recycle where r_id in ($checks)");
        showmsg('操作成功！',"?mpage=company_recycle&show=$show",0,2000);exit();
	}else{
		showmsg('请先选择要恢复的简历内容！',"-1",0,2000);exit();
	}
}else{
        $rsdb=array();
        $sql="select * from {$cfg['tb_pre']}recycle where r_cmember='$username' order by r_adddate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=company_recycle&show=$show",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>简历回收站</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">姓名</td>
          <td width="10%">性别</td>
          <td width="10%">年龄</td>
          <td width="10%">学历</td>
          <td width="25%">应聘职位</td>
          <td width="25%">发送时间</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"8\">暂无删除的简历！</td>\r\n";
        echo "        </tr>\r\n";
        }
        foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\"><a href=\"../company/company_resumeview.php?rid=$rs[r_rid]\" target=\"_blank\">$rs[r_name]</a></td>\r\n";
            echo "          <td>".hiresex($rs['r_sex'])."</td>\r\n";
            echo "          <td>".(date('Y')-date('Y',strtotime($rs['r_birth'])))."</td>\r\n";
            echo "          <td>".hireedu($rs['r_edu'])."</td>\r\n";
            echo "          <td>$rs[r_place]</td>\r\n";
            echo "          <td>$rs[r_adddate]</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[r_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="7"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="简历恢复" onClick="confirmX(1);">
<input name="button3" type="button" class="inputs" value="发送面试邀请" onClick="confirmX(2);">
<input name="button3" type="button" class="inputs" value="放入人才库" onClick="confirmX(3);">
<input name="button3" type="button" class="inputs" value="删　除" onClick="confirmX(4);">
<input name="button3" type="button" class="inputs" value="清空回收站" onClick="if (confirm('确定要清空回收站吗？')) window.location='?do=clean&mpage=company_recycle&show=<?php echo $show;?>'"></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <div class="memts">
    <li><font color="#FF0000"><b>温馨提示：</b></font></li>
    <li><font color="#000000">“<strong>简历恢复</strong>”</font><font color="#333333">即将回收站中选中的简历恢复至收到应聘简历表中。</font></li>
    <li><font color="#000000">“<strong>发送面试邀请</strong>”</font><font color="#333333">即邀请一个或多个满意的求职者面试。</font></li>
    <li><font color="#000000">“<strong>放入人才库</strong>”</font><font color="#333333">即整理收集有价值的求职者，以备日后使用。 </font></li>
    <li><font color="#000000">“<strong>清空回收站</strong>”</font><font color="#333333">即删除回收站中的所有简历。</font></li>
    <li><font color="#000000">“<strong>删除</strong>”</font><font color="#333333">即彻底删除简历。</font></li>
    </div>
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
        		if(confirm("您确定要恢复简历吗？")==true)
                {
                    document.form.action="?do=renew&mpage=company_recycle&show=<?php echo $show;?>";
                    document.form.submit();
                }
        	}
            if(num==2)
        	{
        		if(confirm("您确定要发送面试邀请吗？")==true)
                {
                    document.form.action="?mpage=company_interviewsend&show=<?php echo $show;?>&a=comrecycle";
                    document.form.submit();
                }
        	}
            if(num==3)
        	{
        		if(confirm("您确定要放入人才库吗？")==true)
                {
                    document.form.action="?do=myexpert&mpage=company_recycle&show=<?php echo $show;?>";
                    document.form.submit();
                }
        	}
            if(num==4)
        	{
        		if(confirm("您确定要彻底删除简历吗？")==true)
                {
                    document.form.action="?do=del&mpage=company_recycle&show=<?php echo $show;?>";
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