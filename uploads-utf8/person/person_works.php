<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $db ->query("delete from {$cfg['tb_pre']}mysend where s_pmember='$username' and s_id in ($checks)");
	showmsg('删除成功！',"?mpage=person_works&show=$show",0,2000);exit();
}else{
    $rsdb=array();
    $sql="select s_id,s_hid,s_comname,s_place,s_resumename,s_adddate,s_interview,s_favorite,s_response,s_deny,s_sendnum from {$cfg['tb_pre']}mysend where s_pmember='$username' order by s_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"index.php?mpage=person_works&show=$show",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>投递简历记录</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="14%" height="21">应聘职位</td>
          <td width="20%">公司名称</td>
          <td width="16%">投递时间</td>
          <td width="10%">投递的简历</td>
          <td width="8%">投递次数</td>
          <td width="8%">应聘人数</td>
          <td width="5%">邀请</td>
          <td width="5%">收藏</td>
          <td width="5%">回复</td>
          <td width="5%">拒绝</td>
          <td width="4%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
            $rss = $db->get_one("select DATEDIFF(h_enddate,'".date('Y-m-d')."') as enddate,h_status,h_adddate,h_receiveresume from {$cfg['tb_pre']}hire where h_id=$rs[s_hid] limit 0,1");
			if($rss){
				if($rss['enddate']<0||$rss['h_status']=0){
				    $place=$rs['s_place']."（停止招聘）";
				}else{
				    $place="<a href=\"".formatlink($rss["h_adddate"],2,3,$rs["s_hid"],0)."\" target=\"_blank\">$rs[s_place]</a>";
				}
                $receiveresume=$rss['h_receiveresume'];
			}else{
                $place=$rs['s_place']."（已删除）";
                $receiveresume=0;
			}
            $interview=$rs['s_interview']?'是':'否';
            $favorite=$rs['s_favorite']?'是':'否';
            $response=$rs['s_response'];
            $deny=$rs['s_deny']?'是':'否';
            if($response==1){
                $response='<a href="#" title="您的简历基本符合要求，我们将尽快与您取得联系。">是</a>';
            }elseif($response==2){
                $response='<a href="#" title="对不起，我们认为您不太符合该职位的要求，但我们会关注您的简历，以后有合适的职位我们会联系您。">是</a>';
            }elseif($response==3){
                $response='<a href="#" title="您的简历我们已经收到，若有需要我们会与您联系。">是</a>';
            }else{
                $response='否';
            }
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td height=\"22\">$place</td>\r\n";
            echo "          <td>$rs[s_comname]</td>\r\n";
            echo "          <td>$rs[s_adddate]</td>\r\n";
            echo "          <td>$rs[s_resumename]</td>\r\n";
            echo "          <td>$rs[s_sendnum]</td>\r\n";
            echo "          <td>$receiveresume</td>\r\n";
            echo "          <td>$interview</td>\r\n";
            echo "          <td>$favorite</td>\r\n";
            echo "          <td>$response</td>\r\n";
            echo "          <td>$deny</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[s_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="11"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(1);"></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
          <tr class="memtabmain">
            <td><div class="memtabdiv"></div>1、“<b>回复</b>”列中显示“否”表示企业尚未回复，“是”表示企业已回复，鼠标移动到“是”字上，可以看到回复的具体内容。<br />
2、“<b>拒绝</b>”列中显示“否”表示企业尚未拒绝您的申请，“是”表示企业已拒绝了您的申请。。</td>
          </tr>
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
        		document.form.action="?do=del&mpage=person_works&show=<?php echo $show;?>";
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