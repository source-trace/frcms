<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='open'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    if($checks!=''){
        $db ->query("update {$cfg['tb_pre']}resume set r_openness=0 where r_member='$username' and r_id in ($checks)");
    }
    showmsg('公开设置成功，2秒后自动返回！',"?mpage=person_openresume&show=$show",0,2000);exit();
}elseif($do=='hidden'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    if($checks!=''){
        $db ->query("update {$cfg['tb_pre']}resume set r_openness=1 where r_member='$username' and r_id in ($checks)");
    }
    showmsg('隐藏设置成功，2秒后自动返回！',"?mpage=person_openresume&show=$show",0,2000);exit();
}else{
    $rsdb=array();
    $sql="select r_id,r_title,r_openness,r_chinese,r_english,r_cnstatus,r_enstatus,r_visitnum,r_personinfo,r_education,r_train,r_lang,r_work,r_careerwill,m_logo from {$cfg['tb_pre']}resume,{$cfg['tb_pre']}member where r_member=m_login and r_member='$username' order by r_adddate desc limit 0,10";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>简历公开设置</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="" method="post">
        <tr class="memtabhead" align="center">
          <td width="8%" height="21">简历编号</td>
          <td width="12%">简历名称</td>
          <td width="10%">简历状态</td>
          <td width="8%">浏览次数</td>
          <td width="8%">记录</td>
          <td width="29%">简历完整度</td>
          <td width="20%">公开状态</td>
          <td width="5%"><input name="checkSelect" type="checkbox" class="checkbox" onClick="javascript: checkAll(this)" value="checkbox"></td>
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
            if($rs["r_openness"]==1){$openness='已隐藏，尚未公开。';}else{$openness='已公开，企业可以看到我。';}
            echo "          <td>$openness</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[r_id]\" class=\"checkbox\" /></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabmain">
          <td height="21" colspan="11" class="tdcolor"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name="Input2" type="button" value="设置为公开" class="submit" onClick="confirmX(1);" /> 
        <input name="Input3" type="button" value="设置为隐藏" class="submit" onClick="confirmX(2);" /> </div>公开：企业会员都可以通过搜索看到您的简历。 如果您希望尽可能多的得到各类招聘机会，这项服务将更加适合您。<br />
          隐藏：您的简历的完全保密的，任何人都看不到，但您仍然可以使用这份简历主动申请职位。</td>
        </tr>
        </form>
      </table>
    </div>
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
		document.form.action="?do=open&mpage=person_openresume&show=<?php echo $show;?>";
		document.form.submit();
	}
	if(num==2)
	{
		document.form.action="?do=hidden&mpage=person_openresume&show=<?php echo $show;?>";
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