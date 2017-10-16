<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if(!$Glimit[4]){
    echo "<script language=javascript>alert('您所在的会员组不能在线申请职位，请联系网站客服进行升级！');location.href='javascript:history.back()';</script>";exit();
}
$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
if($do=='send'){
    if(empty($a)) $a = 'hire';
    //查简历的信息
    $rs=$db ->get_one("SELECT `r_name`,`r_sex`,`r_birth`,`r_edu`,`r_title`,`r_email`,`r_mobile` FROM `{$cfg['tb_pre']}resume` WHERE `r_id`=$rid LIMIT 0,1");
    if($rs){
        $name=$rs['r_name'];$sex=$rs['r_sex'];$birth=$rs['r_birth'];$edu=$rs['r_edu'];$title=$rs['r_title'];$r_name=$rs['r_name'];$r_mobile=$rs['r_mobile'];
        $from=$cfg['transmit_mail']=='1'?$rs['r_email']:'';
    }else{
        showmsg('简历不存在或已删除！，2秒后返回！',"-1",0,2000);exit();
    }
    //$checks=explode(',',$checks);
    $checksnum=count(explode(',',$checks));
	if($Glimit[5]&&$Mmysendnum<$checksnum){showmsg("您的职位申请可用数量不足，请返回重新选择！","-1",0,2000);exit();}
    $letter=replace_strbox($letter);
    if($checks!=''){
        $counts = $db->counter("`{$cfg['tb_pre']}mysend`","`s_pmember`='$username' AND s_hid in($checks)");
        if($a=='favorite'){
      		$sql="select h_id,h_comname,h_place,h_member,h_email,h_contact,m_mobile from {$cfg['tb_pre']}myfavorite INNER JOIN {$cfg['tb_pre']}hire on f_hid=h_id LEFT JOIN {$cfg['tb_pre']}member on h_comid=m_id where f_id in($checks) order by f_adddate desc";
       	}else{
      		$sql="select h_id,h_comname,h_place,h_member,h_email,h_contact,m_mobile from {$cfg['tb_pre']}hire LEFT JOIN {$cfg['tb_pre']}member on h_comid=m_id where h_id in($checks) order by h_adddate desc";
       	}
        $query=$db->query($sql);
        $i=0;$hireids='';
		while($row=$db->fetch_array($query)){
            $i++;
            $hireid=$row['h_id'];$comname=$row['h_comname'];$place=$row['h_place'];$cmember=$row['h_member'];$email=$row['h_email'];$m_mobile=$row['m_mobile'];
            $hireids.=$i==1?$hireid:",".$hireid;
            $rst=$db ->get_one("SELECT * FROM `{$cfg['tb_pre']}mysend` WHERE s_hid=$hireid and s_rid=$rid LIMIT 0,1");
            if($rst){
                $db ->query("UPDATE {$cfg['tb_pre']}mysend SET s_sendnum=s_sendnum+1,s_adddate=NOW() WHERE s_hid=$hireid and s_rid=$rid");
            }else{
                $db ->query("INSERT INTO {$cfg['tb_pre']}mysend (s_hid,s_comname,s_place,s_rid,s_resumename,s_lang,s_adddate,s_pmember,s_cmember,s_sendnum) VALUES($hireid,'$comname','$place',$rid,'$title',0,NOW(),'$username','$cmember',1)");
            }
            if($cmember!=''){
                $upset=$letter?",m_content=CONCAT('".dtime(0,6)." $letter<br>',IFNULL(m_content,''))":'';
                $rst=$db ->get_one("SELECT * FROM `{$cfg['tb_pre']}myreceive` WHERE m_hid=$hireid and m_rid=$rid LIMIT 0,1");
                if($rst){
                    $db ->query("UPDATE {$cfg['tb_pre']}myreceive SET m_sendnum=m_sendnum+1,m_adddate=NOW()$upset WHERE m_hid=$hireid and m_rid=$rid");
                }else{
                    $db ->query("INSERT INTO {$cfg['tb_pre']}myreceive (m_rid,m_name,m_sex,m_birth,m_edu,m_hid,m_place,m_pmember,m_cmember,m_read,m_content,m_adddate) VALUES('$rid','$name','$sex','$birth','$edu','$hireid','$place','$username','$cmember','0','$letter',NOW())");
                }
                //发送短信
                if($m_mobile!=''&&$smsArray[4]==1&&isset($issendsms)&&$issendsms==1){
                    if($Glimit[12]==1){
                        if($Glimit[13]&&$Msmsnum<$checksnum){$sendnum=$Msmsnum;}else{$sendnum=$checksnum;}
                        $s++;
                        if($sendnum>=$s){
                            require_once(FR_ROOT.'/smsapi/smsapi.php');
                            $newclient=New SMS();
                            $smscon=load_smstemp('sms_resume_send');
                            foreach($smscon_arry as $k) {
                                $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
                            }
                            $respxml=$newclient->sendSMS($m_mobile,$smscon,"");
                            $code=$newclient->getCode($respxml);
                            if($code=='000'){
                                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('$username','$cmember','$m_mobile',1,NOW(),'$smscon')");
                                if($Glimit[13]==0){
                                    $db ->query("update {$cfg['tb_pre']}member set m_smsnums=m_smsnums+1 where m_login='$username'");
                                }else{
                                    $db ->query("update {$cfg['tb_pre']}member set m_smsnums=m_smsnums+1,m_smsnum=m_smsnum-1 where m_login='$username'");
                                }
                            }else{
                                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('$username','$cmember','$m_mobile',0,NOW(),'$smscon')");
                            }
                        }
                    }
                }
                //发送应聘邮件通知
                $resumelink=$cfg['siteurl'].$cfg['path']."person/cnresume_view.php?rid=$rid";
                $resumelink="<a href=\"$resumelink\" target=\"_blank\">$resumelink</a>";
                require_once(FR_ROOT.'/inc/mail.inc.php');
                $mailtemp=load_mailtemp('re_send');
                $subject=replace_cfglabel($mailtemp['tit']);
                $subject=str_replace('{$FR_职位名称}',$place,$subject);
                $subject=str_replace('{$FR_应聘者名称}',$name,$subject);
    			$body=replace_cfglabel($mailtemp['con']);
                $body=str_replace('{$FR_会员用户名}',$cmember,$body);
                $body=str_replace('{$FR_会员名称}',$comname,$body);
                $body=str_replace('{$FR_职位名称}',$place,$body);
                $body=str_replace('{$FR_应聘者名称}',$name,$body);
                $body=str_replace('{$FR_简历地址}',$resumelink,$body);
                $body=str_replace('{$FR_求职信内容}',$letter,$body);
                //发送邮件
                sendmail($email, $from, $subject, $body);
            }
        }
        //修改职位的收到简历数
        $i&&$db ->query("UPDATE `{$cfg['tb_pre']}hire` SET `h_receiveresume`=`h_receiveresume`+1 WHERE `h_id` IN($hireids)");
        $s=$checksnum-$counts;
        if($s>0){
            //记录并扣除发送数
            if($Glimit[5]==0){
            $db ->query("update {$cfg['tb_pre']}member set m_mysendnums=m_mysendnums+$s,m_activedate=NOW() where m_id=$Memberid");
            }else{
            $db ->query("update {$cfg['tb_pre']}member set m_mysendnums=m_mysendnums+$s,m_mysendnum=m_mysendnum-$s,m_activedate=NOW() where m_id=$Memberid");
            }
            $integral=$Gintegral[2]*$s;
    		require_once(FR_ROOT.'/inc/paylog.inc.php');
    		upintegral($Memberid,"申请职位获得积分+$integral",$integral);
        }
    }
    showmsg('职位申请成功发送！',"?mpage=person_works&show=2",0,2000);exit();
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>申请职位</div>
    <div class="memrightbox">
<script language="JavaScript">
<!--
function CoverLetter_Click(letterID){
document.all.letter.value = document.all["Hidden"+letterID].value.replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&quot;/g,"\"").replace(/&amp;/g,"&");
}
function Juge()
{
 var flag=false; //是否有选择
 for(i=0;i<document.sendresume.elements.length;i++) 
	{
		if (document.sendresume.elements[i].name=="rid")
		{		
			if (document.sendresume.elements[i].checked==true) 
			{
				flag=true;
				break;
			}
		}
	}
	if (flag==false)
	{
		alert("请选择一份简历！");
		return false;
	}
 var flag=false; //是否有选择
}
//关闭弹出层
function SmsLayers()
{
	if(document.getElementById("issendsms").checked==true){
	document.getElementById("SmsLayer").style.display  = "block";
	}
	else{
	document.getElementById("SmsLayer").style.display  = "none";
	}
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
//-->
</script>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form method="post" name="sendresume" id="sendresume" action="index.php?do=send&mpage=person_resumesend&show=<?php echo $show;?>" onSubmit="return Juge()">
        <tr class="memtabhead">
        <td height="21" colspan="2">您要申请的职位如下：</td>
        </tr>
        <tr class="memtabmain">
        <td width="100" align="right" class="tdcolor">应聘职位：<input type="hidden" name="checks" value="<?php echo $checks;?>" /><input type="hidden" name="a" value="<?php echo $a;?>" /></td>
          <td height="21">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable" align="center" style="border:1px #ABCEE2 solid;">
              <tr align="center">
                <td width="10%"><strong>序号</strong></td>
                <td width="35%"><strong>职位名称</strong></td>
                <td width="55%"><strong>招聘单位</strong></td>
              </tr>
            <?php
			if(empty($a)) $a = 'hire';
			if($a=='favorite'){
				$sql="select f_hid as h_id,f_comname as h_comname,f_place as h_place from {$cfg['tb_pre']}myfavorite where f_id in($checks) order by f_adddate desc";
			}else{
				$sql="select h_id,h_comname,h_place from {$cfg['tb_pre']}hire where h_id in($checks) order by h_adddate desc";
			}
			$query=$db->query($sql);
			$i=0;
			while($row=$db->fetch_array($query)){
				$jd=0;$i++;
                $place=$row['h_place'];
                $comname=$row['h_comname'];
				echo "<tr align=\"center\">\r\n";
				echo "<td>$i</td>\r\n";
				echo "<td><a href=\"../company/hire.php?hireid=$row[h_id]\" target=\"_blank\">$row[h_place]</a></td>\r\n";
				echo "<td>$row[h_comname]</td>";
				echo "</tr>\r\n";
			}
            ?>
            </table>
        </td>
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
	$sql="select r_id,r_name,r_mobile,r_personinfo,r_education,r_train,r_lang,r_work,r_careerwill,r_title,r_chinese,r_adddate,m_logo from {$cfg['tb_pre']}resume,{$cfg['tb_pre']}member where r_member=m_login and r_member='$username' order by r_adddate desc";
    $query=$db->query($sql);
    $i=0;
    while($row=$db->fetch_array($query)){
        $jd=0;$i++;$r_name=$row['r_name'];$r_mobile=$row['r_mobile'];
        $row["r_personinfo"]&&$jd+=20;$row["r_education"]&&$jd+=12;$row["r_train"]&&$jd+=10;$row["r_lang"]&&$jd+=8;$row["r_work"]&&$jd+=13;$row["r_careerwill"]&&$jd+=25;
        if($row['m_logo']!=''&&$row['m_logo']!='error.gif') $jd+=12;
		echo "<tr>\r\n";
		echo "<td title=\"个人基本资料、联系方式及求职意向必须填写，否则无法投递简历！\"><input type=\"radio\" name=\"rid\" value=\"$row[r_id]\"";
		if($row["r_personinfo"]!=1||$row["r_careerwill"]!=1) echo " disabled";
		echo " />$row[r_title]</td>\r\n";
		echo "<td align=\"center\">";
		if($row["r_chinese"]==1) echo "中文";
		echo "</td>\r\n";
        echo "<td align=\"left\"><hr width=\"$jd%\" class=\"hr\" title=\"$jd%\" /></td>\r\n";
		echo "<td align=\"center\"><a href=\"../person/cnpreview.php?rid=$row[r_id]\" target=\"_blank\">预览</a></td>";
		echo "</tr>\r\n";
    }
?>
</table>
<input name="submit" type="button" class="submit" value="新建一份简历" onclick="javascript:window.location='?mpage=person_addresume&show=1'" />
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
        		echo "<td><input type=\"radio\" name=\"lid\" value=\"$row[l_id]\" onclick='JavaScript: CoverLetter_Click($row[l_id]);' />$row[l_title]<input type=\"hidden\" value=\"$row[l_content]\" name=\"Hidden$row[l_id]\"></td>";
        		echo "</tr>\r\n";
            }
        ?>
        </table>
        </td>
        </tr>
        <tr class="memtabmain">
        <td align="right">&nbsp;</td>
          <td height="21"><textarea name="letter" cols=90 rows=4 id="letter"></textarea></td>
        </tr>
        <?php if($smsArray[4]==1){?><tr class="memtabmain">
        <td align="right">短信通知：</td>
          <td height="21"><label for="issendsms">
            <font color="#FF0000">*</font><input type="checkbox" name="issendsms" id="issendsms" value="1" onclick="javascript:SmsLayers();" <?php if($Glimit[12]==0){echo 'disabled';}?> />向该公司同时发送职位申请短信（还能发送<font color="#FF0000"><?php if($Glimit[12]==0){echo "0";}else{if($Glimit[13]==0){echo '不限制';}else{echo $Msmsnum;}}?></font>条）</label>
            </td>
        </tr>
        <?php }?>
        <tr class="memtabmain">
        <td align="right">&nbsp;</td>
          <td height="21"><input name="submit" type="submit" class="submit" value="提交申请" /> <input name="submit" type="button" class="submit" value="返回重选" onclick="javascript:history.back();" /></td>
        </tr>
        </form>
        </table>
    </div>
</div>
<?php
$smscon=load_smstemp('sms_resume_send');
foreach($smscon_arry as $k) {
    $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
}?>
<div id="SmsLayer" onmousedown="MDown('SmsLayer');" style="bottom:100px; right:100px; position:absolute; width:180px; height:298px; background:url(../skin/Member/sms.gif); z-index:9999; cursor:move; display:none;">
<div id="smscon" style="width:120px; height:160px; margin:60px auto; font-size:12px; line-height:120%;"><?php echo $smscon;?></div></div>