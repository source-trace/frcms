<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if(!$Glimit[4]){
    echo "<script language=javascript>alert('您所在的会员组不能发送邀请面试，请联系网站客服进行升级！');location.href='javascript:history.back()';</script>";exit();
}
$checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
if($do=='send'){
    if(empty($a)) $a = 'resume';
    $hid=$hireid?intval($hireid):'';
    //查职位的信息
    $hid&&$rs=$db ->get_one("select h_place,h_comname,h_email from {$cfg['tb_pre']}hire where h_id=$hid limit 0,1");
    if($rs){
        $place=$rs['h_place'];$comname=$rs['h_comname'];
        $cemail=$cfg['transmit_mail']=='1'?$rs['h_email']:'';
    }else{
        showmsg('职位不存在或已删除！，2秒后返回！',"-1",0,2000);exit();
    }
    $checksnum=count(explode(',',$checks));
	if($Glimit[5]&&$Mmyinterviewnum<$checksnum){showmsg("您的面试邀请可用数量不足，请返回重新选择！","-1",0,2000);exit();}
    $content=replace_strbox($content);$subject=cleartags($subject);
    if($checks!=''){
        if($a=='myreceive'){
            $sql="select m_rid,{$cfg['tb_pre']}myreceive.m_name,{$cfg['tb_pre']}myreceive.m_sex,{$cfg['tb_pre']}myreceive.m_birth,{$cfg['tb_pre']}myreceive.m_edu,m_pmember,m_email,m_mobile from {$cfg['tb_pre']}myreceive,{$cfg['tb_pre']}member where m_pmember=m_login and {$cfg['tb_pre']}myreceive.m_id in($checks) order by m_adddate desc";
        }elseif($a=='myexpert'){
            $sql="select m_rid,{$cfg['tb_pre']}myexpert.m_name,{$cfg['tb_pre']}myexpert.m_sex,{$cfg['tb_pre']}myexpert.m_birth,{$cfg['tb_pre']}myexpert.m_edu,m_pmember,m_email,m_mobile from {$cfg['tb_pre']}myexpert,{$cfg['tb_pre']}member where m_pmember=m_login and {$cfg['tb_pre']}myexpert.m_id in($checks) order by m_adddate desc";
        }elseif($a=='comrecycle'){
            $sql="select r_rid,r_name,r_sex,r_birth,r_edu,r_pmember,m_email,m_mobile from {$cfg['tb_pre']}recycle,{$cfg['tb_pre']}member where r_pmember=m_login and r_id in($checks) order by r_adddate desc";
        }elseif($a=='search'||$a=='resume'){
            $sql="select r_id,r_name,r_sex,r_birth,r_edu,r_member,m_email,m_mobile from {$cfg['tb_pre']}resume,{$cfg['tb_pre']}member where r_member=m_login and r_id in($checks) order by r_adddate desc";
        }
        $query=$db->query($sql);
            $i=0;$s=0;
			while($row=$db->fetch_array($query)){
                $i++;
                if($a=='myreceive'){
                    $r_id=$row['m_rid'];$r_name=$row['m_name'];$r_sex=$row['m_sex'];$r_birth=$row['m_birth'];$r_edu=$row['m_edu'];$r_member=$row['m_pmember'];
    			}elseif($a=='myexpert'){
    				$r_id=$row['m_rid'];$r_name=$row['m_name'];$r_sex=$row['m_sex'];$r_birth=$row['m_birth'];$r_edu=$row['m_edu'];$r_member=$row['m_pmember'];
    			}elseif($a=='comrecycle'){
    				$r_id=$row['r_rid'];$r_name=$row['r_name'];$r_sex=$row['r_sex'];$r_birth=$row['r_birth'];$r_edu=$row['r_edu'];$r_member=$row['r_pmember'];
                }elseif($a=='search'||$a=='resume'){
    				$r_id=$row['r_id'];$r_name=$row['r_name'];$r_sex=$row['r_sex'];$r_birth=$row['r_birth'];$r_edu=$row['r_edu'];$r_member=$row['r_member'];
                }
                $r_email=$row['m_email'];$r_mobile=$row['m_mobile'];
                $db ->query("INSERT INTO {$cfg['tb_pre']}interview (i_rid,i_name,i_sex,i_birth,i_edu,i_hid,i_place,i_cmember,i_pmember,i_adddate) VALUES('$r_id','$r_name','$r_sex','$r_birth','$r_edu','$hid','$place','$username','$r_member',NOW())");
                $db ->query("INSERT INTO {$cfg['tb_pre']}myinterview (i_hid,i_comname,i_place,i_adddate,i_pmember,i_cmember,i_read,i_title,i_content ) VALUES('$hid','$comname','$place',NOW(),'$r_member','$username',0,'$subject','$content')");
                //发送短信
                if($r_mobile!=''&&$smsArray[3]==1&&isset($issendsms)&&$issendsms==1){
                    if($Glimit[12]==1){
                        if($Glimit[13]&&$Msmsnum<$checksnum){$sendnum=$Msmsnum;}else{$sendnum=$checksnum;}
                        $s++;
                        if($sendnum>=$s){
                            require_once(FR_ROOT.'/smsapi/smsapi.php');
                            $newclient=New SMS();
                            $smscon=load_smstemp('sms_in_send');
                            foreach($smscon_arry as $k) {
                                $smscon=str_replace('{$'.$k.'}',$$k,$smscon);
                            }
                            $respxml=$newclient->sendSMS($r_mobile,$smscon,"");
                            $code=$newclient->getCode($respxml);
                            if($code=='000'){
                                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('$username','$r_member','$r_mobile',1,NOW(),'$smscon')");
                                if($Glimit[13]==0){
                                    $db ->query("update {$cfg['tb_pre']}member set m_smsnums=m_smsnums+1 where m_login='$username'");
                                }else{
                                    $db ->query("update {$cfg['tb_pre']}member set m_smsnums=m_smsnums+1,m_smsnum=m_smsnum-1 where m_login='$username'");
                                }
                            }else{
                                $db ->query("INSERT INTO {$cfg['tb_pre']}sms(s_memberlogin,s_tomemberlogin,s_tomobile,s_issuccess,s_sendtime,s_content) values('$username','$r_member','$r_mobile',0,NOW(),'$smscon')");
                            }
                        }
                    }
                }
                //发送应聘邮件通知 
                $hirelink=$cfg['siteurl'].$cfg['path']."company/hire.php?hireid=$hid";
                $hirelink="<a href=\"$hirelink\" target=\"_blank\">$hirelink</a>";
                require_once(FR_ROOT.'/inc/mail.inc.php');
                $mailtemp=load_mailtemp('in_send');
                $mailtit=replace_cfglabel($mailtemp['tit']);
                $mailtit=str_replace('{$FR_职位名称}',$place,$mailtit);
                $mailtit=str_replace('{$FR_单位名称}',$comname,$mailtit);
                $mailtit=str_replace('{$FR_应聘者名称}',$r_name,$mailtit);
    			$body=replace_cfglabel($mailtemp['con']);
                $body=str_replace('{$FR_会员名称}',$comname,$body);
                $body=str_replace('{$FR_职位名称}',$place,$body);
                $body=str_replace('{$FR_应聘者名称}',$r_name,$body);
                $body=str_replace('{$FR_单位名称}',$comname,$body);
                $body=str_replace('{$FR_职位地址}',$hirelink,$body);
                $body=str_replace('{$FR_留言内容}',$content,$body);
                //发送邮件
                sendmail($r_email, $cemail, $mailtit, $body);
                //把工作申请记录中相应信息的收藏标志置1
	 		    $db ->query("update {$cfg['tb_pre']}mysend set s_interview=1 where s_hid=$hid and s_pmember='$r_member'");
			}
        //记录并扣除发送数
        if($Glimit[5]==0){
            $db ->query("update {$cfg['tb_pre']}member set m_myinterviewnums=m_myinterviewnums+$i,m_activedate=NOW() where m_login='$username'");
        }else{
            $db ->query("update {$cfg['tb_pre']}member set m_myinterviewnums=m_myinterviewnums+$i,m_myinterviewnum=m_myinterviewnum-$i,m_activedate=NOW() where m_login='$username'");
        }
        $integral=$Gintegral[2];
		require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($Memberid,"邀请【{$r_name}】面试获得积分+$integral",$integral);
        //职位发送面试通知数加1
        $db ->query("update {$cfg['tb_pre']}hire set h_sendinterview=h_sendinterview+$i where h_id=$hid");
    }
    showmsg('操作成功！',"?mpage=company_interview&show=$show",0,2000);exit();
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>发送面试邀请</div>
    <div class="memrightbox">
<script language="JavaScript">
<!--
 //功能：去掉字符串前后空格
//返回值：去掉空格后的字符串
function fnRemoveBrank(strSource)
{
 return strSource.replace(/^\s*/,'').replace(/\s*$/,'');
}
function Juge(theForm)
{
 if (fnRemoveBrank(theForm.hireid.value) == "")
  {
    alert("对不起，请选择面试职位！如未发布职位，请先到管理中心发布招聘职位");
	theForm.hireid.focus();
    return (false);
  }
  if (fnRemoveBrank(theForm.subject.value) == "")
  {
    alert("对不起，请输入面试邀请主题！");
	theForm.subject.focus();
    return (false);
  }
  if (fnRemoveBrank(theForm.content.value) == "")
  {
    alert("对不起，请输入面试邀请内容!");
	theForm.content.focus();
    return (false);
  }
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
      <form method="post" name="sendform" id="sendform" action="index.php?do=send&mpage=company_interviewsend&show=<?php echo $show;?>" onSubmit="return Juge(this)">
        <tr class="memtabhead">
        <td height="21" colspan="2">您要邀请面试的人才如下：</td>
        </tr>
        <tr class="memtabmain">
        <td width="100" align="right" class="tdcolor">被邀人才：<input type="hidden" name="checks" value="<?php echo $checks;?>" /><input type="hidden" name="a" value="<?php echo $a;?>" /></td>
          <td height="21">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable" align="center" style="border:1px #ABCEE2 solid;">
              <tr align="center">
                <td width="30%"><strong>姓名</strong></td>
                <td width="20%"><strong>性别</strong></td>
                <td width="20%"><strong>年龄</strong></td>
                <td width="30%"><strong>学历</strong></td>
              </tr>
            <?php
			if(empty($a)) $a = 'resume';
			if($a=='myreceive'){
                $sql="select m_rid,m_name,m_sex,m_birth,m_edu from {$cfg['tb_pre']}myreceive where m_id in($checks) order by m_adddate desc";
			}elseif($a=='myexpert'){
				$sql="select m_rid,m_name,m_sex,m_birth,m_edu from {$cfg['tb_pre']}myexpert where m_id in($checks) order by m_adddate desc";
			}elseif($a=='comrecycle'){
				$sql="select r_rid,r_name,r_sex,r_birth,r_edu from {$cfg['tb_pre']}recycle where r_id in($checks) order by r_adddate desc";
            }elseif($a=='search'||$a=='resume'){
				$sql="select r_id,r_name,r_sex,r_birth,r_edu from {$cfg['tb_pre']}resume where r_id in($checks) order by r_adddate desc";
            }
			$query=$db->query($sql);
            $i=0;
			while($row=$db->fetch_array($query)){
                $i++;
                if($a=='myreceive'){
                    $r_id=$row['m_rid'];$r_name=$row['m_name'];$r_sex=$row['m_sex'];$r_birth=$row['m_birth'];$r_edu=$row['m_edu'];
    			}elseif($a=='myexpert'){
    				$r_id=$row['m_rid'];$r_name=$row['m_name'];$r_sex=$row['m_sex'];$r_birth=$row['m_birth'];$r_edu=$row['m_edu'];
    			}elseif($a=='comrecycle'){
    				$r_id=$row['r_rid'];$r_name=$row['r_name'];$r_sex=$row['r_sex'];$r_birth=$row['r_birth'];$r_edu=$row['r_edu'];
                }elseif($a=='search'||$a=='resume'){
    				$r_id=$row['r_id'];$r_name=$row['r_name'];$r_sex=$row['r_sex'];$r_birth=$row['r_birth'];$r_edu=$row['r_edu'];
                }
                if($i==1) $personname=$r_name;
				echo "<tr align=\"center\">\r\n";
				echo "<td><a href=\"../person/cnresume_view.php?rid=$r_id\" target=\"_blank\">$r_name</a></td>\r\n";
				echo "<td>".hiresex($r_sex)."</td>\r\n";
				echo "<td>".(date('Y')-date('Y',strtotime($r_birth)))."</td>";
                echo "<td>".hireedu($r_edu)."</td>";
				echo "</tr>\r\n";
			}
            ?>
            </table>
        </td>
        </tr>
        <tr class="memtabhead">
        <td height="21" colspan="2">填写面试邀请：</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">面试职位：</td>
          <td height="21">
          <?php
          $rsd = $db->get_one("select m_name,m_url,m_tel from {$cfg['tb_pre']}member where m_login='$username'");
          if($rsd){
			$m_name=$rsd['m_name'];$m_url=$rsd['m_url'];$m_tel=$rsd['m_tel'];$subject='';
            }
          ?>
          <select name="hireid" size="1" id="hireid" onchange="document.getElementById('smscon').innerHTML='<?php echo $personname;?>：恭喜您收到<?php echo $m_name;?>面试通知。请登陆<?php echo $cfg['sitename'];?>查看。'">
          <option value="" selected>--选择面试职位--</option>
           <?php 
           $result=$db->query("select h_id,h_place from {$cfg['tb_pre']}hire where h_member='$username' order by h_adddate desc");
            while($row=$db->fetch_array($result)){
                echo "<option value=\"$row[h_id]\">$row[h_place]</option>\r\n";
            }
            ?>
            </select></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">邮件主题：</td>
          <td height="21"><input name="subject" type="text" value="<?php echo $subject;?>" size="50" maxlength="50"></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">邮件内容：</td>
          <td height="21"><textarea name="content" cols="80" rows="10" id="content">
求职者：
    您好，我们（<?php echo $m_name;?>）已经收到您通过(<?php echo $cfg['sitename'];?>)发来的应聘资料，感谢应聘本公司职位。
    有关本公司更详细信息请阅（<?php echo $m_url;?>）。在认真阅读及评估您的简历后，我们认为您符合本公司基本条件要求。为进一步增加双方间的了解，希望您能够前往本公司面试。面试时请带上你的相关毕业证书、身份证、职称证书、获奖证书及作品等资料。
    面试时间：
    面试地点：
    如有任何问题，您可以致电本公司查询。电话：<?php echo $m_tel;?>。谢谢！</textarea></td>
        </tr>
        <?php if($smsArray[3]==1){?><tr class="memtabmain">
        <td align="right">短信通知：</td>
          <td height="21"><label for="issendsms">
            <font color="#FF0000">*</font><input type="checkbox" name="issendsms" id="issendsms" value="1" onclick="javascript:SmsLayers();" <?php if($Glimit[12]==0){echo 'disabled';}?> />向该人才同时发送邀请短信（还能发送<font color="#FF0000"><?php if($Glimit[12]==0){echo "0";}else{if($Glimit[13]==0){echo '不限制';}else{echo $Msmsnum;}}?></font>条）</label>
            </td>
        </tr>
        <?php }?>
        <tr class="memtabmain">
        <td align="right">&nbsp;</td>
          <td height="21"><input name="submit" type="submit" class="submit" value="提交发送" /> <input name="submit" type="button" class="submit" value="返回重选" onclick="javascript:history.back();" /></td>
        </tr>
        </form>
        </table>
    </div>
</div>
<div id="SmsLayer" onmousedown="MDown('SmsLayer');" style="bottom:100px; right:100px; position:absolute; width:180px; height:298px; background:url(../skin/Member/sms.gif); z-index:9999; cursor:move; display:none;">
<div id="smscon" style="width:120px; height:160px; margin:60px auto; font-size:12px; line-height:120%;">XXX：恭喜您收到XXXX公司面试通知。请登陆<?php echo $cfg['sitename']?>查看。</div></div>