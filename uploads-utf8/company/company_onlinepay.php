<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='pay'){
	$CardNum = preg_replace("/[^0-9\.-]/i",'',$CardNum);
	$CardPassword = preg_replace("/[^0-9a-zA-Z\.-]/i",'',$CardPassword);
	$CardPasswords=base64_encode($CardPassword);
	$rs=$db->get_one("select c_usetime,c_validnum,c_id,DATEDIFF(c_enddate,'".date('Y-m-d')."') as end from {$cfg['tb_pre']}card where c_num ='$CardNum' and c_pass='$CardPasswords'");
    if($rs){
        if($rs['c_usetime']=='0000-00-00 00:00:00'&&$rs['end']<0){
            showmsg('该充值卡号有效使用时间以过，请使用其他充值卡！',"-1",0,2000);exit();
        }elseif($rs['c_usetime']=='0000-00-00 00:00:00'&&$rs['end']>=0){
            $db->query("update {$cfg['tb_pre']}card set c_username='$username',c_usetime=NOW() where c_id=$rs[c_id]");
            $db->query("update {$cfg['tb_pre']}member set m_balance=m_balance+$rs[c_validnum] where m_login='$username'");
            require_once(FR_ROOT.'/inc/paylog.inc.php');
            paylog($username,"使用充值卡对账户进行充值，成功充入$rs[c_validnum]元",0);
            showmsg("已充值[$rs[c_validnum]]成功，您现在可以使用充值卡消费了！","?mpage=company_onlinepay&show=$show",0,2000);exit();
        }else{
            showmsg('此卡已被别人使用，请输入正确的卡号密码进行充值！',"-1",0,2000);exit();
        }
    }else{
        showmsg('充值卡号或密码错误，请重新输入！',"-1",0,2000);exit();
    }
}
if(empty($p)) $p = '';
if($p==''){
	$rsdb=array();
	$sql="select p_id,p_oid,p_content,p_userip,p_type,p_isucceed,p_amount,p_date from {$cfg['tb_pre']}payback where p_member='$username' order by p_date desc";
	$query=$db->query($sql);
	$counts = $db->num_rows($query);
	$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
	$getpageinfo = page($page,$counts,"index.php?mpage=person_onlinepay&show=$show",20,5);
	$sql.=$getpageinfo['sqllimit'];
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$rsdb[]=$row;
	}
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>在线充值记录</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>您账户当前余额为 <font color="#FF0000"><b><?php echo $Mbalance;?></b></font> ，您可以通过”<a href="?mpage=company_onlinepay&show=<?php echo $show;?>&p=onlinepay">在线支付</a>“或”<a href="?mpage=company_onlinepay&show=<?php echo $show;?>&p=cardpay">充值卡充值</a>“对账户进行充值。</li>
    </div>
    <?php if($p=='onlinepay'){?>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td height="21" colspan="2" align="left">网上银行在线支付</td>
        </tr>
        <tr class="memtabmain">
          <td width="14%" align="right">充值金额： 
        </td>
          <td width="86%"><input name="amount" type="text" value="" size="4" />
          输入充值金额</td>
        </tr>
        <tr class="memtabmain">
          <td align="right">支付方式：</td>
          <td ><?php echo getpaylist();?></td>
        </tr>
        <tr class="memtabmain">
          <td>&nbsp;</td>
          <td ><input name="Input3" type="button" value="进入支付页面" class="submit" onclick="clickpay(amount.value,form.paytype.options(form.paytype.options.selectedIndex).value);" /></td>
        </tr>
        </form>
      </table>
    <?php }elseif($p=='cardpay'){?>
    <script language="javascript">
<!-- 用于判断是否填写了表单,且判断是否用到了正确的管理帐号长度和密码 -->
function check()
{
	if (document.payform.CardNum.value=="")
   {
	   alert("充值卡卡号不能为空！");
	   document.payform.CardNum.focus();
	   document.payform.CardNum.select();
	   return false;
	}   
	var filter2=/^\s*[0-9]{6,12}\s*$/;
   if (!filter2.test(document.payform.CardNum.value))
   {
	   alert("充值卡卡号只能为数字且是6-12位");
	   document.payform.CardNum.focus();
	   document.payform.CardNum.select();
	   return false;
	}   
	if (document.payform.CardPassword.value=="")
   {
	   alert("充值卡密码不能为空！");
	   document.payform.CardPassword.focus();
	   document.payform.CardPassword.select();
	   return false;
	}   
	var filter1=/^\s*[0-9]{4,10}\s*$/;
   if (!filter1.test(document.payform.CardPassword.value))
   {
	   alert("充值卡密码只能为数字且是4-10位");
	   document.payform.CardPassword.focus();
	   document.payform.CardPassword.select();
	   return false;
	}  
}
</script>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="memtab">
<form name="payform" action="?do=pay&mpage=company_onlinepay&show=<?php echo $show;?>" method="post" onSubmit="return check();">
  <tr class="memtabhead" align="center">
          <td height="21" colspan="2" align="left">会员充值卡充值</td>
        </tr>
        <tr class="memtabmain">
    <td width="14%" align="right">充值帐户：</td>
    <td width="86%"><input name="textfield" type="text" value="<?php echo $username;?>" disabled="disabled" /></td>
  </tr>
  <tr class="memtabmain">
    <td align="right">充值用途：</td>
    <td><input type="text" name="textfield2" disabled="disabled" value="预存会员费" /></td>
  </tr>
  <tr class="memtabmain">
    <td colspan="2" class="tdcolor">请输入充值卡卡号和密码按确定后充值</td>
    </tr>
  <tr class="memtabmain">
    <td align="right">充值卡卡号：</td>
    <td><input name="CardNum" type="text" id="CardNum" />      
       <font color="#FF0000">请输入长度为6—12位的纯数字卡号</font></td>
  </tr>
  <tr class="memtabmain">
    <td align="right">充值卡密码：</td>
    <td><input name="CardPassword" id="CardPassword" type="password" />      
       <font color="#FF0000">请输入长度为4—10位的数字、字母组合的密码</font></td>
  </tr>
  <tr class="memtabmain">
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="submit" value=" 充 值 " /></td>
    </tr>
</form>
</table>
    <?php }else{?>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">订单编号</td>
          <td width="18%">用途</td>
          <td width="18%">支付时间</td>
          <td width="15%">IP</td>
          <td width="12%">支付接口</td>
          <td width="12%">支付金额</td>
          <td width="10%">支付结果</td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
            if($rs["p_isucceed"]==1){
                    $p_isucceed="<font color=green>支付成功</font>";
                }elseif($rs["p_isucceed"]==0){
                    $p_isucceed="尚未支付";
                }else{
                    $p_isucceed="<font color=red>支付失败</font>";
                }
            echo "        <tr class=\"memtabmain\">\r\n";
            echo "          <td height=\"22\" align=\"center\">$rs[p_oid]</td>\r\n";
            echo "          <td align=\"center\">$rs[p_content]</td>\r\n";
            echo "          <td align=\"center\">$rs[p_date]</td>\r\n";
            echo "          <td align=\"center\">$rs[p_userip]</td>\r\n";
            echo "          <td align=\"center\">$rs[p_type]</td>\r\n";
            echo "          <td align=\"center\">$rs[p_amount]</td>\r\n";
            echo "          <td align=\"center\">$p_isucceed</td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv">快捷充值 金额：<input name="amount" type="text" value="" size="4" /> <?php echo getpaylist();?>
        <input name="Input3" type="button" value="进入支付页面" class="inputs" onclick="clickpay(amount.value,form.paytype.options(form.paytype.options.selectedIndex).value);" /> </div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <?php }?>
    </div>
</div>
<script language="javascript">
function clickpay(amount,paytype){
if(amount<0.01){
    alert("对不起，输入金额必须为大于1的整数！");
    return false;
}
window.open("../plus/onlinepay/send.php?paytype="+paytype+"&amount="+amount,"","width=520,height=400,scrollbars=yes,resizable = 1");
}
</script>