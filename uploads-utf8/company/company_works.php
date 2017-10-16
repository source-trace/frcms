<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $checks&&$db ->query("delete from {$cfg['tb_pre']}myreceive where m_cmember='$username' and m_id in ($checks)");
	showmsg('删除成功！',"?mpage=company_works&show=$show",0,2000);exit();
}elseif($do=='reply'){
    if($reply!=''&&$id!=''){
        $id=intval($id);$reply=intval($reply);$replystr="";$response=$deny=0;
        $db ->query("update {$cfg['tb_pre']}myreceive set m_reply=$reply where m_cmember='$username' and m_id=$id");
        if($reply==1){$replystr="符合要求";$response=1;;
        }elseif($reply==2){$replystr="不符合要求";$response=2;$deny=1;
        }elseif($reply==3){$replystr="以后联系";$response=3;}
        $rs=$db ->get_one("select a.m_rid,a.m_pmember,b.m_email,a.m_hid from {$cfg['tb_pre']}myreceive a INNER JOIN {$cfg['tb_pre']}member b on a.m_pmember=b.m_login where a.m_id=$id limit 0,1");
        if($rs){
            $hid=$rs['m_hid'];$rid=$rs['m_rid'];
            $cemail='';
            $db ->query("update {$cfg['tb_pre']}mysend set s_response=$response,s_deny=$deny where s_hid=$hid and s_rid=$rid");
        }
        echo $replystr;exit();
    }else{
        echo "提交的参数错误，刷新页面后重新提交。";exit();
    }
}elseif($do=='myexpert'){
	if(!$Glimit[2]){showmsg('您所在的会员组您无权使用人才库！',"-1",0,2000);exit();}
	$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
	$checksnum=count(explode(',',$checks));
	if($Glimit[3]&&$Mexpertnum<$checksnum){showmsg('您的人才库可用数量不足，请返回重新选择！',"-1",0,2000);exit();}
	if($checks!=''){
		$sql="select * from {$cfg['tb_pre']}myreceive where m_cmember='$username' and m_id in ($checks) order by m_adddate desc limit 0,$checksnum";
		$query=$db->query($sql);
		$i=0;
		while($row=$db->fetch_array($query)){
        	$rsd = $db->get_one("select * from {$cfg['tb_pre']}myexpert where m_pmember='$row[m_pmember]' and m_cmember='$row[m_cmember]' and m_rid=$row[m_rid] limit 0,1");
			if(!$rsd){
				$db ->query("INSERT INTO {$cfg['tb_pre']}myexpert (m_rid,m_name,m_sex,m_birth,m_edu,m_cmember,m_pmember,m_adddate,m_exp) VALUES('$row[m_rid]','$row[m_name]','$row[m_sex]','$row[m_birth]','$row[m_edu]','$username','$row[m_pmember]',NOW(),1)");
				$i++;	
			}else{
				if($rsd['m_exp']!=1){
					$db ->query("update {$cfg['tb_pre']}myexpert set m_exp=1,m_adddate=NOW() where m_cmember='$username' and m_id=$rsd[m_id]");
					$i++;
				}
			}
			//把工作申请记录中相应信息的收藏标志置1
	 		$db ->query("update {$cfg['tb_pre']}mysend set s_favorite=1 where s_hid=$row[m_hid] and s_cmember='$row[m_cmember]' and s_pmember='$row[m_pmember]'");
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
        showmsg('操作成功！',"?mpage=company_works&show=$show",0,2000);exit();
	}else{
		showmsg('请先选择要放入人才库的简历内容！',"-1",0,2000);exit();
	}
}elseif($do=='comrecycle'){
	if(!$Glimit[6]){showmsg('您所在的会员组您无权使用回收站！',"-1",0,2000);exit();}
	$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
	$checksnum=count(explode(',',$checks));
	if($Glimit[7]&&$Mrecyclenum<$checksnum){showmsg('您的回收站可用数量不足，请返回重新选择！',"-1",0,2000);exit();}
	if($checks!=''){
		$sql="select * from {$cfg['tb_pre']}myreceive where m_cmember='$username' and m_id in ($checks) order by m_adddate desc limit 0,$checksnum";
		$query=$db->query($sql);
		$i=0;
		while($row=$db->fetch_array($query)){
            $db ->query("INSERT INTO {$cfg['tb_pre']}recycle (r_rid,r_name,r_sex,r_birth,r_edu,r_hid,r_place,r_cmember,r_pmember,r_adddate,r_content) VALUES('$row[m_rid]','$row[m_name]','$row[m_sex]','$row[m_birth]','$row[m_edu]','$row[m_hid]','$row[m_place]','$username','$row[m_pmember]','$row[m_adddate]','$row[m_content]')");
			$i++;
    	}
		//更新回收站记录
		if($Glimit[7]==0){
			$db ->query("update {$cfg['tb_pre']}member set m_recyclenums=m_recyclenums+$i,m_activedate=NOW() where m_login='$username'");
		}else{
			$db ->query("update {$cfg['tb_pre']}member set m_recyclenums=m_recyclenums+$i,m_recyclenum=m_recyclenum-$i,m_activedate=NOW() where m_login='$username'");
		}
        //删除到回收站
        $db ->query("delete from {$cfg['tb_pre']}myreceive where m_id in ($checks)");
        showmsg('操作成功！',"?mpage=company_works&show=$show",0,2000);exit();
	}else{
		showmsg('请先选择要放入回收站的简历内容！',"-1",0,2000);exit();
	}
}else{
    if($t=='read'&&$id!=''){
        $id=intval($id);
        $rs = $db->get_one("select m_name,m_content from {$cfg['tb_pre']}myreceive where m_cmember='$username' and m_id=$id limit 0,1");
        if($rs){
            $name=$rs['m_name'];
            $content=change_strbox($rs['m_content']);
            $db ->query("update {$cfg['tb_pre']}myreceive set m_read=1 where m_cmember='$username' and m_id=$id");
        }else{
            echo "<script language=javascript>alert('内存不存在！');location.href='javascript:history.back()';</script>";
            exit();
        }
    }else{
        $db->get_one("delete from {$cfg['tb_pre']}myreceive where m_cmember='$username' and DATEDIFF('".date('Y-m-d')."',m_adddate)>180");
        $rsdb=array();$hid=$hid?intval($hid):'';
        if($hid!=''){$sqladd=" and m_hid=$hid";}
        $sql="select * from {$cfg['tb_pre']}myreceive where m_cmember='$username' $sqladd order by m_adddate desc";
        $query=$db->query($sql);
        $counts = $db->num_rows($query);
        $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
        $getpageinfo = page($page,$counts,"index.php?mpage=company_works&show=$show&hid=$hid",20,5);
        $sql.=$getpageinfo['sqllimit'];
        $query=$db->query($sql);
        while($row=$db->fetch_array($query)){
        	$rsdb[]=$row;
        }
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>收到的应聘简历</div>
    <div class="memrightbox">
	<?php if($t=='read'){?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabmain">
        <td height="30" style="border-top:#efefef 1px solid;">查看求职信</td>
      </tr>
      <tr class="memtabmain">
        <td height="30"><?php if($content!=''&&$content!='&nbsp;'){echo $content;}else{echo "该求职者未提交求职信！";}?></td>
      </tr>
      <tr class="memtabmain">
        <td height="30"><div align="right">求职者：<?php echo $name;?></div></td>
      </tr>
      <tr class="memtabmain">
        <td height="30" align="center"><input name="submit" type="button" class="submit" value="返回" onclick="javascript:history.back();" /></td>
      </tr>
    </table>
    <?php }else{?>
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
  <form name="form" action="?" method="post">
    <tr class="memtabhead" align="center">
      <td width="10%" height="21">姓名</td>
      <td width="6%">性别</td>
      <td width="6%">年龄</td>
      <td width="8%">学历</td>
      <td width="16%">应聘职位</td>
      <td width="16%">发送时间</td>
      <td width="8%">投递次数</td>
      <td width="13%">求职信</td>
      <td width="10%">答复状态</td>
      <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
    </tr>
    <?php
        if(empty($rsdb)){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "        <td colspan=\"8\">暂无人才投递简历，您可以通过”<a href=\"?mpage=company_newresume&show=3\">浏览最新人才</a>“或”<a href=\"?mpage=company_searchresume&show=3\">人才综合查询</a>“来查询最新登记的简历，并选择合适的人才主动邀请前来面试!</td>\r\n";
        echo "        </tr>\r\n";
        }
    foreach($rsdb as $key=>$rs){
        if($rs['m_read']==1){$read='已读';}else{$read="<font color=blue>未读</font>";}
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "          <td height=\"22\"><a href=\"../company/company_resumeview.php?rid=$rs[m_rid]\" target=\"_blank\" title=\"点击查看简历！\">$rs[m_name]</a></td>\r\n";
        echo "          <td>".hiresex($rs['m_sex'])."</td>\r\n";
        echo "          <td>".(date('Y')-date('Y',strtotime($rs['m_birth'])))."</td>\r\n";
        echo "          <td>".hireedu($rs['m_edu'])."</td>\r\n";
        echo "          <td>$rs[m_place]</td>\r\n";
        echo "          <td>$rs[m_adddate]</td>\r\n";
        echo "          <td>$rs[m_sendnum]</td>\r\n";
        echo "          <td>";
        if($rs['m_content']!=''){echo $read."&nbsp;&nbsp;<a href=\"?t=read&mpage=company_works&show=$show&id=$rs[m_id]\" title=\"点击查看求职信！\">查看</a>";}else{echo "无";}
        echo "</td>\r\n";
        echo "          <td>";
        if($rs['m_reply']==0){
            echo "<span id=\"s_$rs[m_id]\"><a onClick=\"sendreply('$rs[m_id]','$rs[m_name]','$row[m_name]');\" style=\"cursor:pointer\">未答复</a></span>";
        }elseif($rs['m_reply']==1){
            echo "符合要求";
        }elseif($rs['m_reply']==2){
            echo "不符合要求";
        }elseif($rs['m_reply']==3){
            echo "以后联系";
        }
        echo "</td>\r\n";
        echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[m_id]\"></td>\r\n";
        echo "        </tr>\r\n";
    }
    ?>
    <tr class="memtabpage">
      <td height="21" colspan="10"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="邀请面试" onClick="confirmX(1);">
<input name="button3" type="button" class="inputs" value="放入人才库" onClick="confirmX(2);">
<input name="button3" type="button" class="inputs" value="放入回收站" onClick="confirmX(3);">
<input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(4);"></div><?php echo $getpageinfo['pagecode'];?></td>
    </tr>
    </form>
  </table>
  <div class="memts">
    <li><font color="#FF0000"><b>温馨提示：</b></font></li>
    <li><font color="#000000">“<strong>发送面试邀请</strong>”</font><font color="#333333">即邀请一个或多个满意的求职者面试。</font>
    <font color="#000000">“<strong>放入人才库</strong>”</font><font color="#333333">即整理收集有价值的求职者，以备日后使用。 </font>
    <font color="#000000">“<strong>放入回收站</strong>”</font><font color="#333333">即删除简历到回收站，必要时可恢复。</font>
    <font color="#000000">“<strong>删除</strong>”</font><font color="#333333">即彻底删除简历。</font></li>
    <li><font color="#333333">求职者给您投递简历后，希望您及时给予答复。为了让您更有效的联系到求职者，建议您在邀请面试的同时选择短信通知求职者。</font></li>
    <li><font color="#333333">为减轻数据库压力，投递简历记录只保存6个月时间。超过6个月的历史记录将被系统自动删除。</font></li>

    </div>
<div id="showreply" onmousedown="down('showreply');" style="position:absolute;padding:0; border:4px #CCCCCC solid; z-index:99999; background:#FFFFFF; display:none;">
    <table border="0" cellpadding="4" style="width:380px;">
        <tr>
            <td class="memrighttit" style=" cursor: move;"><span style=" float:right; cursor:pointer;" onclick="showreply.style.display='none';">关闭</span>答复应聘简历</td>
        </tr>
        <form name="formreply" action="" method="post">
            <tr>
                <td style="font-weight: bold; color: blue;">答复求职者<span id="msgcon"></span>的求职申请</td>
            </tr>
            <tr>
                <td><input type="radio" name="reply" id="reply1" value="1" checked=""/>您的简历基本符合要求，我们将尽快与您取得联系。<br />
                <input type="radio" name="reply" id="reply2" value="2" />对不起，我们认为您不太符合该职位的要求，但我们会关注您的<br />&nbsp;&nbsp;&nbsp;&nbsp;简历，以后有合适的职位我们会联系您。<br />
                <input type="radio" name="reply" id="reply3" value="3" />您的简历我们已经收到，若有需要我们会与您联系。</td>
            </tr>
            <tr>
                <td><input type="hidden" name="mid" id="mid" value="" /><input name="Submit" type="button" onclick="send();" class="inputs" value="确定答复" /></td>
            </tr>
        </form>
    </table>
</div>
<script language="javascript">
function confirmX(num){
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
	if(num==1){
		if(confirm("您确定要发送面试邀请吗？")==true)
		{
			document.form.action="?a=myreceive&mpage=company_interviewsend&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==2){
		if(confirm("您确定要放入人才库吗？")==true)
		{
			document.form.action="?do=myexpert&mpage=company_works&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==3){
		if(confirm("您确定要放入回收站吗？")==true)
		{
			document.form.action="?do=comrecycle&mpage=company_works&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==4){
		if(confirm("您确定要删除简历吗？")==true)
		{
			document.form.action="?do=del&mpage=company_works&show=<?php echo $show;?>";
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
function sendreply(mid,name) {
	document.formreply.mid.value=mid;
	var msgcon=document.getElementById("msgcon")
	msgcon.innerHTML=name;
	showreply.style.display="";
	showreply.style.left=(document.body.clientWidth/2-190)+"px";
	showreply.style.top=(document.documentElement.scrollTop+100)+"px"; 
}
function send(){
	showreply.style.display='none';
	mid=$("#mid").val();
    reply=$('input:radio[name="reply"]:checked').val();
    $.ajax({
        type: "POST",
        url: "?do=reply&mpage=company_works",  
        data: "id="+mid+"&reply="+reply,    
        success: function(msg){
            $("#s_"+mid).text(msg);
        }
  });
}
<!--实现层移动-->
var Obj;
 document.onmouseup=MUp;
 document.onmousemove=MMove;
 document.onmousedown=MDown;
function down(objs){
    Obj = document.getElementById(objs);
}
function MDown(event) {
 if(Obj){
      if (window.event) {/*IE*/
       event = window.event;
       Obj.setCapture();
      }
      else {/*Firefox*/
       window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
      }
      pX=event.clientX-Obj.offsetLeft;
      pY=event.clientY-Obj.offsetTop;
    }
 }
 function MMove(event) {
  if (window.event) event = window.event;
  if(Obj){
   Obj.style.left=event.clientX-pX + "px";
   Obj.style.top=event.clientY-pY + "px";
  }
 }
 function MUp(event) {
  if(Obj){
   if (window.event) Obj.releaseCapture();
   else window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
   Obj=null;
  }
 }
</script>
     <?php }?>
    </div>
</div>