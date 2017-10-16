<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='send'){
    $sqladd='';
    $place=cleartags($place);$comname=cleartags($comname);$email=cleartags($email);$contact=cleartags($contact);$tel=cleartags($tel);
    if($place==''||$comname==''||$email==''){
        showmsg('职位名称、单位名称、电子邮箱3项必填，2秒后返回修改！',"-1",0,2000);exit();
    }else{
        $rid=intval($rid);
        if($rid!=0){
            //读取简历地址
            $rs = $db->get_one("select r_id,r_email,r_name,r_adddate from {$cfg['tb_pre']}resume where r_member='$username' and r_id=$rid limit 0,1");
            if($rs){
                $resumelink=$cfg['siteurl'].formatlink($rs['r_adddate'],1,1,$rs['r_id'],0);
                $resumelink="<a href=\"$resumelink\" target=\"_blank\">$resumelink</a>";
                $from=$cfg['transmit_mail']=='1'?$rs['r_email']:'';$name=$rs['r_name'];
            }else{
                showmsg('简历不存在或已删除！，2秒后返回！',"-1",0,2000);exit();
            }
            //读取求职信
            $lid=intval($lid);$letter='';
            $rs = $db->get_one("select l_title,l_content,l_adddate from {$cfg['tb_pre']}letter where l_member='$username' and l_id=$lid limit 0,1");
            if($rs){
                $letter.="<b>附求职信：</b><br>";
                $letter.="$rs[l_content]<br>";
            }
            //组织内容
            require_once(FR_ROOT.'/inc/mail.inc.php');
            $mailtemp=load_mailtemp('send_out');
            $subject=replace_cfglabel($mailtemp['tit']);
            $subject=str_replace('{$FR_职位名称}',$place,$subject);
            $subject=str_replace('{$FR_应聘者名称}',$name,$subject);
			$body=replace_cfglabel($mailtemp['con']);
            $body=str_replace('{$FR_职位名称}',$place,$body);
            $body=str_replace('{$FR_应聘者名称}',$name,$body);
            $body=str_replace('{$FR_简历地址}',$resumelink,$body);
            $body=str_replace('{$FR_求职信内容}',$letter,$body);
            //发送邮件
            sendmail($email, $from, $subject, $body);
            $db ->query("INSERT INTO {$cfg['tb_pre']}sendresume (s_comname,s_tel,s_email,s_place,s_adddate,s_member,s_contact) VALUES('$comname','$tel','$email','$place',NOW(),'$username','$contact')");
        }else{
            showmsg('请选择一份可用的简历！',"-1",0,2000);exit();
        }
        $integral=$Gintegral[1];
		require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($Memberid,"外发简历获得积分+$integral",$integral);
        showmsg('外发简历操作成功！',"?mpage=person_sendresume&show=$show",0,2000);
        exit();
    }
}elseif($do=='del'){
    $rs=$db->query("delete from {$cfg['tb_pre']}sendresume where s_member='$username' and s_id in($checks)");
    showmsg('删除成功！',"?mpage=person_sendresume&show=$show",0,2000);exit();
}elseif($t=='addform'){
    $tabtit='外发简历';
}else{
    $db->get_one("delete from {$cfg['tb_pre']}sendresume where s_member='$username' and DATEDIFF('".date('Y-m-d')."',s_adddate)>180");
    $rsdb=array();
    $sql="select s_id,s_comname,s_tel,s_contact,s_email,s_adddate,s_place from {$cfg['tb_pre']}sendresume where s_member='$username' order by s_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"index.php?mpage=person_sendresume&show=$show",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $tabtit='外发简历记录';
}

?>
<div class="memrightl">
    <div class="memrighttit"><span><a href="?mpage=person_sendresume&show=<?php echo $show;?>&t=addform">外发简历</a></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
     <?php if($t=='addform'){?>
	  <script type="text/javascript">
		$.validator.methods.istel=function(value, element) {    
			var tel = /^[0-9\s+.-]+$/;
			return this.optional(element) || (tel.test(value));}
        $().ready(function() {
            $("#addform").validate({
                success: function(label) {
                    label.text("输入正确!").addClass("success");
                }, 
                rules: {
                    place: {required: true},
                    comname: {required: true},
                    email: {required: true,email: true},
                    tel: {istel:true,maxlength: 100}
                },
                messages: {
                    place: '请输入应聘的职位名称',
                    comname: "请输入完整的单位名称",
                    email: {
						required: "E-mail地址为必填项",
						email: "请填写有效的E-mail地址"
					},
                    tel: {istel:"联系电话格式如：029-85460076",maxlength: "联系电话长度为100个字符以内"}
                }
            });
        });
        </script>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form method="post" name="addform" id="addform" action="index.php?do=send&mpage=person_sendresume&show=<?php echo $show;?>">
        <tr class="memtabhead">
        <td height="21" colspan="2">您可以用在<?php echo $cfg['sitename'];?>创建的简历申请本网站以外的职位。</td>
        </tr>
        <tr class="memtabmain">
        <td width="140" align="right"><span style="color:#F00">*</span> 职位名称：</td>
          <td height="21"><input name="place" type="text" id="place" value="" size="30" /></td>
        </tr>
         <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 单位名称：</td>
          <td height="21"><input name="comname" type="text" id="comname" size="30" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 单位电子邮箱：</td>
          <td height="21"><input name="email" type="text" id="email" size="30" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">单位联系人</td>
          <td height="21"><input name="contact" type="text" id="contact" size="30" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">单位联系电话</td>
          <td height="21"><input name="tel" type="text" id="tel" size="30" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right" class="tdcolor">选择简历</td>
          <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable" align="center" style="border:1px #ABCEE2 solid;">
  <tr>
    <td width="30%"><strong>&nbsp; 简历名称</strong></td>
    <td width="10%" align="center"><strong>简历语言</strong></td>
    <td width="50%" align="center"><strong>简历完整度</strong></td>
    <td width="10%" align="center"><strong>操作</strong></td>
  </tr>
<?php
	$sql="select r_id,r_personinfo,r_education,r_train,r_lang,r_work,r_careerwill,r_title,r_chinese,r_adddate,m_logo from {$cfg['tb_pre']}resume,{$cfg['tb_pre']}member where r_member=m_login and r_member='$username' order by r_adddate desc";
    $query=$db->query($sql);
    $i=0;
    while($row=$db->fetch_array($query)){
        $jd=0;$i++;
        $row["r_personinfo"]&&$jd+=20;$row["r_education"]&&$jd+=12;$row["r_train"]&&$jd+=10;$row["r_lang"]&&$jd+=8;$row["r_work"]&&$jd+=13;$row["r_careerwill"]&&$jd+=25;
        if($row['m_logo']!=''&&$row['m_logo']!='error.gif') $jd+=12;
		echo "<tr>\r\n";
		echo "<td title=\"个人基本资料、联系方式及求职意向必须填写，否则无法投递简历！\"><input type=\"radio\" name=\"rid\" value=\"$row[r_id]\"";
		if($row["r_personinfo"]!=1||$row["r_careerwill"]!=1) echo " disabled";
		echo " />$row[r_title]</td>\r\n";
		echo "<td align=\"center\">";
		if($row["r_chinese"]==1) echo "中文";
		echo "</td>\r\n";
        echo "<td align=\"left\"><div class=\"hr\" title=\"您的这份简历完整度指数为：$jd%\" style=\"width:$jd%; height:20px;line-height:20px; text-align:right;\">$jd%</div></td>\r\n";
		echo "<td align=\"center\"><a href=\"../person/cnpreview.php?rid=$row[r_id]\" target=\"_blank\">预览</a></td>";
		echo "</tr>\r\n";
    }
?>
</table>
</td>
        </tr>
        <tr class="memtabmain">
        <td align="right" class="tdcolor">附求职信</td>
          <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="memtab">
        <?php
        	$sql="select l_id,l_title,l_content from {$cfg['tb_pre']}letter where l_member='$username' order by l_adddate desc";
            $query=$db->query($sql);
            while($row=$db->fetch_array($query)){
        		echo "<tr>\r\n";
        		echo "<td><input type=\"radio\" name=\"lid\" value=\"$row[l_id]\" />$row[l_title]</td>";
        		echo "</tr>\r\n";
            }
        ?>
        </table>
        </td>
        </tr>
        <tr class="memtabmain">
        <td align="right">&nbsp;</td>
          <td height="21"><input name="submit" type="submit" class="submit" value="外发简历" /></td>
        </tr>
        </form>
        </table>
        <?php }else{?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
        <td width="5%">编号</td>
          <td width="15%" height="21">应聘职位</td>
          <td width="23%">单位名称</td>
          <td width="12%">联系电话</td>
          <td width="10%">联系人</td>
          <td width="20%">邮箱</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
            foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td>$rs[s_id]</td>\r\n";
            echo "          <td height=\"22\">$rs[s_place]</a></td>\r\n";
            echo "          <td>$rs[s_comname]</td>\r\n";
            echo "          <td>$rs[s_tel]</td>\r\n";
            echo "          <td>$rs[s_contact]</td>\r\n";
            echo "          <td>$rs[s_email]</td>\r\n";
			echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[s_id]\"></td>\r\n";
            echo "        </tr>\r\n";
            }
            ?>
            <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp;<input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(1);">&nbsp; &nbsp;<input name="button3" type="button" class="inputs" value="外发简历" onclick="window.location='?mpage=person_sendresume&show=<?php echo $show;?>&t=addform'" /></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
          <tr class="memtabmain">
            <td><div class="memtabdiv"></div>1、外发简历是指通过网站将您的简历发给没有在本网站登记的单位；通过这个功能您可以省去制作标准简历的时间，外发简历后，您的标准简历的地址将通过邮件系统发送到单位的电子信箱中。<br />
2、记录保存时间为6个月，过期系统自动删除。</td>
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
                    document.form.action="?do=del&mpage=person_sendresume&show=<?php echo $show;?>";
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