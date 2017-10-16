<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='apply'){
    if(empty($Groupid) || empty($content)){
        echo "<script language=JavaScript>{alert('错误：请填写申请内容!');location.href = 'javascript:history.go(-1)';}</script>";
        exit;
    }else{
        $content=replace_strbox($content);
        $Groupid=intval($Groupid);
        $Groupname="Groupname$Groupid";
        $Groupname=$$Groupname;
        $pactnum = date('YmdHis').rand(1000,9999);
        $db ->query("INSERT INTO {$cfg['tb_pre']}orderservice (o_groupid,o_groupname,o_member,o_datetime,o_pactnum,o_content) VALUES('$Groupid','$Groupname','$username',NOW(),'$pactnum','$content')");
    }
	showmsg('提交申请成功！',"?mpage=company_services&show=$show",0,2000);exit();
}else{
    $query=$db->query("select * from {$cfg['tb_pre']}group where g_typeid=2 order by g_id");
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>服务申请</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>请您从以下列表中选择您需要的招聘服务。申请选中的服务后，<?php echo $cfg['sitename']?>的客户服务人员会尽快与您联系。</li>
    </div>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
    <form name="form" action="?do=apply&mpage=company_service&show=<?php echo $show;?>" method="post">
     <tr class="memtabhead" align="center">
        <td width="16%">产品</td>
        <td width="12%">可发布职位数</td>
        <td width="12%">可下载简历数</td>
        <td width="12%">面试邀请数</td>
        <td width="12%">人才库容量</td>
        <td width="12%">可发送短信数</td>
        <td width="12%">服务期限</td>
        <td width="12%">服务费用</td>
      </tr>
      <?php
        $i=0;
        foreach($rsdb as $key=>$rs){
       $i++;
       $Group_Climits=explode(',',$rs["g_limit"]);
       echo "<tr class=\"memtabmain\" align=\"center\">\r\n";
       echo " <td><input type=\"radio\" name=\"Groupid\" value=\"$rs[g_id]\"";
       if($rs['g_id']==$Gid) echo " disabled";
       echo " />$rs[g_name]</td>\r\n";
       echo " <td><input type=\"hidden\" name=\"Groupname$rs[g_id]\" value=\"$rs[g_name]\" />";
       if($Group_Climits[0]==1){
            if($Group_Climits[1]==0){echo "无限制";}else{echo $Group_Climits[1];}
       }else{echo "0";}
       echo "</td>\r\n";
       echo " <td>";
       if($Group_Climits[8]==1){
            if($Group_Climits[9]==0){echo "无限制";}else{echo $Group_Climits[9];}
       }else{echo "0";}
       echo "</td>\r\n";
       echo " <td>";
       if($Group_Climits[4]==1){
            if($Group_Climits[5]==0){echo "无限制";}else{echo $Group_Climits[5];}
       }else{echo "0";}
       echo "</td>\r\n";
       echo " <td>";
       if($Group_Climits[2]==1){
            if($Group_Climits[3]==0){echo "无限制";}else{echo $Group_Climits[3];}
       }else{echo "0";}
       echo "</td>\r\n";
       echo " <td>";
       if($Group_Climits[12]==1){
            if($Group_Climits[13]==0){echo "无限制";}else{echo $Group_Climits[13];}
       }else{echo "0";}
       echo "</td>\r\n";
       echo " <td>$rs[g_term]$rs[g_unit]</td>\r\n";
       echo " <td>$rs[g_outlay]元</td>\r\n";
       echo "</tr>\r\n";
        }?>
        <tr class="memtabhead">
            <td colspan="8">您可以将具体的要求填写在这里，我们的客服将和您联系确认。</td>
        </tr>
        <tr class="memtabmain">
            <td align="right">具体要求：</td>
            <td colspan="7"><textarea name="content" cols="80" rows="8"></textarea></td>
        </tr>
        <tr class="memtabmain">
            <td align="right">&nbsp;</td>
            <td colspan="7"><input name="Submit" type="submit" class="submit" value="提交申请"></td>
        </tr>
      </form>
      </table>
    </div>
</div>