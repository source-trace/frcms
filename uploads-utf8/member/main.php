<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=="refresh"){
	$db->query("update {$cfg['tb_pre']}resume set r_adddate=NOW() where r_member='$username'");
	showmsg('刷新成功！',"index.php",0,2000);exit();
}
if($a=="orders"){
    $sid=intval($sid);$tid=intval($tid);
    if($sid==0||$tid==0){
        showmsg('参数错误！','-1');exit();
    }
    $rs = $db->get_one("select * from {$cfg['tb_pre']}prices where p_id=$sid and p_type=$tid");
    if($rs){
        $p_name=$rs['p_name'];
        $p_useday=$rs['p_useday'];
        $p_value=$rs['p_value'];
    }else{
        showmsg('服务项目不存在！','-1');exit();
    }
    if($do=='y'){
        if($p_value>$Mbalance){
            showmsg('余额不足，请先充值！','-1');exit();
        }else{
            require_once(FR_ROOT.'/inc/paylog.inc.php');
            $startdate=dtime($fr_time,3);$enddate=date('Y-m-d',strtotime(date('Y-m-d')."+$p_useday day"));$operator=$username;
            switch($tid){
                case 1:
                $db->query("update {$cfg['tb_pre']}member set m_comm=1,m_commstart='$startdate',m_commend='$enddate',m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
                case 2:
                $db->query("update {$cfg['tb_pre']}member set m_logocomm=1,m_logostartdate='$startdate',m_logoenddate='$enddate',m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
                case 3:
                $db->query("update {$cfg['tb_pre']}member set m_logocomm=1,m_logostartdate='$startdate',m_logoenddate='$enddate',m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
                case 4:
                $db->query("update {$cfg['tb_pre']}member set m_comm=1,m_commstart='$startdate',m_commend='$enddate',m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
                case 5:
                $checks = preg_replace("/[^0-9,]/i",'',$checks);
                $db->query("update {$cfg['tb_pre']}hire set h_comm=1,h_commstart='$startdate',h_commend='$enddate' where h_member='$username' and h_id in($checks)");
                $checksnum=count(explode(',',$checks));
                $p_value=$p_value*$checksnum;
                $db->query("update {$cfg['tb_pre']}member set m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
                case 6:
                $db->query("update {$cfg['tb_pre']}member set m_smsnum=m_smsnum+$p_useday,m_balance=m_balance-$p_value where m_login='$username'");
                paylog($username,"购买$p_name,扣除{$p_value}元。",0); //创建日志
                break;
            }
            servicelog($p_name,$startdate,$enddate,$Memberid,0,$p_value);
            showmsg('恭喜您操作成功！','index.php');exit();
        }
    }
?>
<div class="memrightl">
	<div class="memrighttit"><span></span>服务自主购买</div>
    <div class="memrightbox"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
  <tr>
    <tr class="memtabhead">
    <td>购买<font color="#FF0000"><b><?php echo $p_name;?></b></font>，<?php if($tid==6){echo "短信数量{$p_useday}条";}else{echo "有效期{$p_useday}天";}?>，扣费<?php echo $p_value;?>元。</td>
  </tr>
  <?php if($tid==5){?>
  <tr>
    <td style="line-height:200%">请选择要推荐的职位：<br /><table width="98%" align="center" border="0" cellpadding="4" cellspacing="0" style="border:solid 1px #CCC; background:#FFF">
  <tr>
    <td bgcolor="#FFFFFF"><script language="javascript">
    function SelectHire(checkid,num)
{
	var ids = document.getElementsByName(checkid);
	var a=0;
	if (ids != null) 
	{
		for (i=0; i<ids.length; i++) 
		{
			var obj = ids(i);
			if (obj.checked==true)
			{
				a+=1
				if(a>num)
				{
					obj.checked=false;
					alert("对不起，您选中的职位推荐所需点数已经超过账户余额，请先减少已选项再选择！");
					return false;
				}
			}
		}
	}
}
function OrderHire(checkid,href)
{
	var ids = document.getElementsByName(checkid);
	var check=false;
    var allSel="";
	if (ids != null) {
		for (i=0; i<ids.length; i++){
			var obj = ids(i);
			if (obj.checked==true){
                if(allSel==""){
				allSel=obj.value;
				}else{
				allSel=allSel+","+obj.value;
				}
				hireform.checks.value = allSel;
				check=true;
			}
		}
		if(check==false){
		  alert("请选择要推荐的职位！");return false;
        }else{
			document.hireform.action=href;
			document.hireform.submit();
		}
	}
}</script>
<form name="hireform" action="main.php" method="post">
<?php
$query=$db->query("select h_id,h_comm,h_place from {$cfg['tb_pre']}hire where h_member='$username'");
while($row=$db->fetch_array($query)){
echo "<input type=\"checkbox\" name=\"hid\" value=\"$row[h_id]\" onclick=\"SelectHire('hid',".round($Mbalance/$p_value).")\" id=\"hid\"";
if($row['h_comm']==1){
    echo "disabled=\"disabled\"";
}
echo " >$row[h_place]";
}
?>
<input type="hidden" name="checks" value="">
</form></td>
  </tr>
</table>
    </td>
  </tr>
    <tr>
    <td><input name="input" type="button" <?php if($p_value>$Mbalance){?>value="余额不足" disabled="disabled"<?php }else{?>onclick="OrderHire('hid','?a=orders&do=y&sid=<?php echo $sid;?>&tid=<?php echo $tid;?>');" value="确认购买"<?php }?> class="submit" /> <input name="input" type="button" onclick="javascript:history.back()" value="取消购买" class="submit" /></td>
  </tr>
  <?php }else{?>
    <tr class="memtabmain">
    <td><input name="input" type="button" <?php if($p_value>$Mbalance){?>value="余额不足" disabled="disabled"<?php }else{?>onclick="location.href='?a=orders&do=y&sid=<?php echo $sid;?>&tid=<?php echo $tid;?>'" value="确认购买"<?php }?> class="submit" /> <input name="input" type="button" onclick="javascript:history.back()" value="取消购买" class="submit" /></td>
  </tr>
  <?php }?>
  <tr class="memtabmain">
    <td style="line-height:200%">点击“确认购买”系统将自动从您的账户上扣除相应点数；<br>点击“取消购买”本次操作将取消，系统自动返回。</td>
  </tr>
</table>
</div>
</div>
<?php
exit();
}
$Mtrade=$Mseat='';
$rs = $db->get_one("select m_logo,m_logostatus,m_sex,m_startdate,m_enddate,DATEDIFF(m_enddate,'".date('Y-m-d')."') as enddate,m_comm,m_commstart,m_commend,DATEDIFF(m_commend,'".date('Y-m-d')."') as commend,m_logocomm,m_logostartdate,m_logoenddate,DATEDIFF(m_logoenddate,'".date('Y-m-d')."') as logoenddate,m_typeid,m_trade from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
if($rs){
    $logo=$rs['m_logo'];
    $logo=($logo==''||$logo=='error.gif')?'':$logo;
    $logostatus=$rs['m_logostatus'];
	$Msex=$rs['m_sex'];$Mtrade=$rs['m_trade'];
	$Mcomm=$rs['m_comm'];$Mcommstart=$rs['m_commstart'];$Mcommend=$rs['m_commend'];
	$Mlogocomm=$rs['m_logocomm'];$Mlogostartdate=$rs['m_logostartdate'];$Mlogoenddate=$rs['m_logoenddate'];
    $Mstartdate=$rs['m_startdate'];$Menddate=$rs['m_enddate'];$enddate=$rs['enddate'];
    $commend=$rs['commend'];$logoenddate=$rs['logoenddate'];
}
if($Mtrade=='')$Mtrade=0;
require(FR_ROOT.'/inc/common.func.php');
switch($user_type){
	case 'pmember':
    $logo=$logo?$logo:$cfg['path'].'upfiles/person/nophoto.gif';
?>
<div class="memrightl">
	<div class="memrighttit"><span></span>欢迎进入个人求职管理中心</div>
    <div class="memrightbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
  <tr class="memtabhead">
    <td width="400">会员信息</td>
    <td>温馨提示</td>
  </tr>
  <tr class="memtabmain">
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr>
        <td width="110" height="130" align="center" valign="middle"><a href="?mpage=person_photo&show=0"><img height="120" src="<?php echo $logo;?>" width="100" border="0" style="BORDER: #000000 1px solid;" /></a></td>
        <td><strong><?php echo _getcookie('user_name');?></strong><?php if($Msex==1){echo '先生';}else{echo '女士';}?>：<br />
您好，欢迎进入<?php echo $cfg['sitename'];?>个人求职管理中心！<br />
我是您的求职顾问<?php echo $ContactMan;?>，在求职过程中碰到任何问题，欢迎与我联系!<br />
电话:<?php echo $ContactPhone;?><?php if($ContactQq!=''){?>，QQ:<a title="点击与客服交流" href="http://wpa.qq.com/msgrd?V=1&amp;Uin=<?php echo $ContactQq;?>&amp;Site=<?php echo $cfg['sitename'];?>&amp;Menu=no" target="blank"><?php echo $ContactQq;?></a><?php }?><br />
您上次登录时间为：<?php echo _getcookie('user_logindate');?><br />
您上次登录IP为：<?php echo _getcookie('user_loginip');?></td>
      </tr>
    </table> <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>您的积分：<font color="#FF0000"><?php echo $Mintegral;?></font> 分 <a href="?mpage=integral&m=main" target="_blank">如何获得积分?</a>。</li>
 		</div></td>
    <td valign="top">您共创建了 <font color="#FF0000" style="font-weight:bold"><?php echo $Mresumenums;?></font> 份简历，目前有 <font color="#FF0000" style="font-weight:bold"><?php $pnum=$db->counter("{$cfg['tb_pre']}resume","r_member='$username' and r_cnstatus=1");echo $pnum;?></font> 份激活。“激活”状态的简历才能被招聘单位查询。<br />
        您可以创建 <font color="#FF0000" style="font-weight:bold"><?php if($Glimit[6]==0){echo "无限";}else{echo $Glimit[6];}?></font> 份简历，用于申请不同的职位。<br />
        您共收到了 <font color="#FF0000" style="font-weight:bold"><?php $pnum=$db->counter("{$cfg['tb_pre']}myinterview","i_pmember='$username'");echo $pnum;?></font> 封面试邀请，<a href="?mpage=person_interview&show=2" class="04d"><u>点此查看</u></a>。<br />
        您共应聘了 <font color="#FF0000" style="font-weight:bold"><?php $pnum=$db->counter("{$cfg['tb_pre']}mysend","s_pmember='$username'");echo $pnum;?></font> 个职位，<a href="?mpage=person_works&show=2" class="04d"><U>点此查看</U></a>。<br />
        您共收藏了 <font color="#FF0000" style="font-weight:bold"><?php $pnum=$db->counter("{$cfg['tb_pre']}myfavorite","f_pmember='$username'");echo $pnum;?></font> 个职位，<a class="04d" href="?mpage=person_favorite&show=2"><U>点此查看</U></a>。<br />
        您可以使用 <font color="#FF0000" style="font-weight:bold"><?php echo $Msmsnum;?></font> 条短信</a>。<br />
        <b>刷新简历：</b>为了使您的简历更容易被用人企业找到，您可以<a href="?do=refresh">立即刷新</a>您的简历. 
        </td>
  </tr>
</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr class="memtabhead">
        <td width="400" colspan="5">增值服务自助购买</td>
      </tr>
      <tr class="memtabmain" align="center">
        <td><b>服务项目</b></td>
        <td><b>数量</b></td>
        <td><b>费用</b></td>
        <td><b>服务说明</b></td>
        <td><b>在线购买</b></td>
      </tr>
      <?php
		$sql="select * from {$cfg['tb_pre']}prices where p_type in(1,2,6) order by p_adddate desc";
		$query=$db->query($sql,'CACHE');
		$i=0;
		while($row=$db->fetch_array($query)){
            $tn=$row['p_type']==6?'条':'天';
			echo "<tr class=\"memtabmain\" align=\"center\">\r\n";
			echo "<td>$row[p_name]</td>\r\n";
			echo "<td>$row[p_useday]$tn</td>\r\n";
			echo "<td>$row[p_value]元</td>\r\n";
			echo "<td align=\"left\">$row[p_content]</td>\r\n";
			echo "<td>";
			if ($row['p_type']==1){
				if($Mcomm==1){
					echo "已购买($Mcommstart-$Mcommend)";
				}else{
					echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
				}
			}
			if ($row['p_type']==2){
				if($Mlogocomm==1){
					echo "已购买($Mlogostartdate-$Mlogoenddate)";
				}else{
					echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
				}
			}
            if ($row['p_type']==6){
				echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
			}
			echo "</td>\r\n";
			echo "</tr>\r\n";
		}
	?>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr class="memtabhead">
        <td>最新匹配职位</td>
      </tr>
      <tr class="memtabmain">
        <td class="memtabxg"><?php
        $rs=$db->get_one("select r_position from {$cfg['tb_pre']}resume where r_member='$username' and r_cnstatus=1 limit 0,1");
        if($rs){$h_position=$rs['r_position'];}else{$h_position=0;}
        echo gethirelist(20,2,'1|1|0|0|0|0|0|0|0|0|0|0|0|1',1,0,0,1,0,0,0,'h_adddate desc','_blank',$h_position,6,15,3);?></td>
      </tr>
    </table>
    </div>
</div>
<?php
break;
	case 'cmember':
    $logo=$logo?$logo:$cfg['path'].'upfiles/company/nologo.gif';
?>
<div class="memrightl">
	<div class="memrighttit"><span></span>欢迎进入企业招聘管理中心</div>
    <div class="memrightbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
  <tr class="memtabhead">
    <td width="430">会员信息</td>
    <td>服务概况</td>
  </tr>
  <tr class="memtabmain">
    <td valign="top" width="430"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr>
        <td width="110" height="130" align="center" valign="middle"><a href="?mpage=company_uploadlogo&show=0"><img height="75" src="<?php echo $logo;?>" width="100" border="0" style="BORDER: #000000 1px solid;" /></a></td>
        <td><strong><?php echo _getcookie('user_name');?></strong>：<br />
您好，欢迎进入<?php echo $cfg['sitename'];?>企业招聘管理中心！<br />
我是您的专职招聘顾问<?php echo $ContactMan;?>，在招聘过程中碰到任何问题，欢迎与我联系!<br />
电话:<?php echo $ContactPhone;?>，QQ:<a title="点击与客服交流" href="http://wpa.qq.com/msgrd?V=1&amp;Uin=<?php echo $ContactQq;?>&amp;Site=<?php echo $cfg['sitename'];?>&amp;Menu=no" target="blank"><?php echo $ContactQq;?></a><br />
您上次登录时间为：<?php echo _getcookie('user_logindate');?><br />
您上次登录IP为：<?php echo _getcookie('user_loginip');?></td>
      </tr>
    </table> <div class="memts">
        <li><font color="#FF0000"><b>刷新职位：</b></font>为更快找到合适的人才，请到 <a href="?mpage=company_hirelist&show=1"> 职位管理页面</a> 刷新已发布的职位。</li>
 		</div></td>
    <td valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td width="24%" align="right">会员账号：</td>
    <td colspan="3"><?php echo $username;?> <a href="?mpage=company_pwd&show=4">修改用户名</a></td>
  </tr>
  <tr>
    <td align="right">服务类型：</td>
    <td colspan="3"><?php echo $Gname;?>(<?php echo $Mstartdate;?>到<?php echo $Menddate;?>)</td>
  </tr>
  <tr>
    <td align="right">职位库：</td>
    <td width="26%">
    <?php if($Glimit[1]==0){echo "<font color=\"#FF0000\">不限</font>";}else{echo "<font color=\"#FF0000\">$Mhirenum</font> 个";}?>
    </td>
    <td width="24%" align="right" bgcolor="#FFFFFF">人才库：</td>
    <td width="26%">
    <?php if($Glimit[3]==0){echo "<font color=\"#FF0000\">不限</font>";}else{echo "<font color=\"#FF0000\">$Mexpertnum</font> 个";}?>
    </td>
  </tr>
  <tr>
    <td align="right">下载简历：</td>
    <td>
    <?php if($Glimit[9]==0){echo "<font color=\"#FF0000\">不限</font>";}else{echo "<font color=\"#FF0000\">$Mcontactnum</font> 份";}?>
    </td>
    <td align="right">面试邀请：</td>
    <td>
    <?php if($Glimit[5]==0){echo "<font color=\"#FF0000\">不限</font>";}else{echo "<font color=\"#FF0000\">$Mmyinterviewnum</font> 个";}?>
    </td>
  </tr>
  <tr>
    <td align="right">回收站：</td>
    <td>
    <?php if($Glimit[7]==0){echo "<font color=\"#FF0000\">不限</font>";}else{echo "<font color=\"#FF0000\">$Mrecyclenum</font> 份";}?>
    </td>
    <td align="right">求职意向：</td>
    <td><font color="#FF0000"><?php 
    $rs = $db->get_one("select count(m_id) as n from {$cfg['tb_pre']}myreceive where m_cmember='$username' limit 0,1");
	$Mmyreceivecount=$rs['n'];
    echo $Mmyreceivecount;?></font> 个 [<a href="?mpage=company_works&show=1">查看</a>]</td>
  </tr>
  <tr>
    <td align="right">邀请短信：</td>
    <td><font color="#FF0000"><?php echo $Msmsnum;?></font> 条</td>
    <td align="right"class="tdcolor">消费积分：</td>
    <td colspan="3"><font color="#FF0000"><?php echo $Mintegral;?></font> 分 <!--<a href="../help/index.php" target="_blank">如何获得?</a>--></td>
    </tr>
</table>
</td>
  </tr>
</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr class="memtabhead">
        <td width="400" colspan="5">增值服务自助购买</td>
      </tr>
      <tr class="memtabmain" align="center">
        <td><b>服务项目</b></td>
        <td><b>数量</b></td>
        <td><b>费用</b></td>
        <td><b>服务说明</b></td>
        <td><b>在线购买</b></td>
      </tr>
      <?php
		$sql="select * from {$cfg['tb_pre']}prices where p_type in(3,4,5,6) order by p_adddate desc";
		$query=$db->query($sql,'CACHE');
		$i=0;
		while($row=$db->fetch_array($query)){
            $tn=$row['p_type']==6?'条':'天';
			echo "<tr class=\"memtabmain\" align=\"center\">\r\n";
			echo "<td>$row[p_name]</td>\r\n";
			echo "<td>$row[p_useday]$tn</td>\r\n";
			echo "<td>$row[p_value]元</td>\r\n";
			echo "<td align=\"left\">$row[p_content]</td>\r\n";
			echo "<td>";
            if ($row['p_type']==3){
				if($Mlogocomm==1&&$logoenddate>=0){
					if($logoenddate<3){
                        echo "<input name=\"input\" type=\"button\"";
    					if($row['p_value']>$Mbalance){
    						echo "value=\"即将到期，及时续费\" disabled=\"disabled\"";
    					}else{
    						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"即将到期，立即续费\"";
    					}
    					echo " class=\"inputs\" />";
					}else{
                        echo "已购买($Mlogostartdate-$Mlogoenddate)";
                    }
				}else{
					echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
				}
			}
			if ($row['p_type']==4){
				if($Mcomm==1&&$commend>=0){
					if($commend<3){
                        echo "<input name=\"input\" type=\"button\"";
    					if($row['p_value']>$Mbalance){
    						echo "value=\"即将到期，及时续费\" disabled=\"disabled\"";
    					}else{
    						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"即将到期，立即续费\"";
    					}
    					echo " class=\"inputs\" />";
					}else{
                        echo "已购买($Mcommstart-$Mcommend)";
                    }
				}else{
					echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
				}
			}
            if ($row['p_type']==5||$row['p_type']==6){
				echo "<input name=\"input\" type=\"button\"";
					if($row['p_value']>$Mbalance){
						echo "onclick=\"location.href='?mpage=onlinepay&m=main&show=0&p=onlinepay'\" value=\"在线充值\"";
					}else{
						echo "onclick=\"location.href='?a=orders&sid=$row[p_id]&tid=$row[p_type]'\" value=\"立即购买\"";
					}
					echo " class=\"inputs\" />";
			}
			echo "</td>\r\n";
			echo "</tr>\r\n";
		}
	?>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr class="memtabhead">
        <td>最新匹配简历</td>
      </tr>
      <tr class="memtabmain">
        <td class="memtabxg"><?php
        $r_position='';
        $sql="select h_position from {$cfg['tb_pre']}hire where h_member='$username' and h_status=1 order by h_adddate desc limit 0,3";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
            $r_position.=($row['h_position']!=''&&$row['h_position']!=0)?','.$row['h_position']:'';
        }
        if($r_position!='') $r_position=substr($r_position,0,1)==','?substr($r_position,1):0;
        echo getresumelist(20,2,'0|0|1|1|0|1|1|0|0|1',1,1,0,0,3,3,'r_adddate desc','_blank',0,0,0,0,0,$Mtrade,$r_position);?></td>
      </tr>
    </table>
    </div>
</div>
<?php
break;
	case 'smember':
    $logo=$logo?$logo:$cfg['path'].'upfiles/school/nologo.gif';
?>
<div class="memrightl">
	<div class="memrighttit"><span></span>欢迎进入院校管理中心</div>
  <div class="memrightbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
  <tr class="memtabhead">
    <td width="500">会员信息</td>
    <td>服务概况</td>
  </tr>
  <tr class="memtabmain">
    <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr>
        <td width="110" height="130" align="center" valign="middle"><a href="?mpage=school_uploadlogo&show=0"><img height="75" src="<?php echo $logo;?>" width="100" border="0" style="BORDER: #000000 1px solid;" /></a></td>
        <td><strong><?php echo _getcookie('user_name');?></strong>：<br />
您好，欢迎进入<?php echo $cfg['sitename'];?>院校管理中心！<br />

您上次登录时间为：<?php echo _getcookie('user_logindate');?><br />
您上次登录IP为：<?php echo _getcookie('user_loginip');?></td>
      </tr>
    </table> 
    </td>
    <td valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td width="24%" align="right">会员账号：</td>
    <td width="26%" colspan="3"><?php echo $username;?> <a href="?mpage=school_pwd&show=4">修改用户名</a></td>
  </tr>
  <tr>
    <td align="right">服务类型：</td>
    <td colspan="3"><?php echo $Gname;?>(<?php echo $Mstartdate;?>到<?php echo $Menddate;?>)</td>
  </tr>
  <tr>
    <td align="right">邀请短信：</td>
    <td width="26%"><font color="#FF0000"><?php echo $Msmsnum;?></font> 条</td>
    <td width="24%" align="right"class="tdcolor">消费积分：</td>
    <td><font color="#FF0000"><?php echo $Mintegral;?></font> 分 <!--<a href="../help/index.php" target="_blank">如何获得?</a>--></td>
  </tr>
</table>
</td>
  </tr>
</table>
    
    </div>
</div>

<?php
break;
	case 'tmember':
    $logo=$logo?$logo:$cfg['path'].'upfiles/train/nologo.gif';
?>
<div class="memrightl">
	<div class="memrighttit"><span></span>欢迎进入培训机构管理中心</div>
  <div class="memrightbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
  <tr class="memtabhead">
    <td width="500">会员信息</td>
    <td>服务概况</td>
  </tr>
  <tr class="memtabmain">
    <td valign="top" width="500"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
      <tr>
        <td width="110" height="130" align="center" valign="middle"><a href="?mpage=train_uploadlogo&show=0"><img height="75" src="<?php echo $logo;?>" width="100" border="0" style="BORDER: #000000 1px solid;" /></a></td>
        <td><strong><?php echo _getcookie('user_name');?></strong>：<br />
您好，欢迎进入<?php echo $cfg['sitename'];?>培训机构管理中心！<br />

您上次登录时间为：<?php echo _getcookie('user_logindate');?><br />
您上次登录IP为：<?php echo _getcookie('user_loginip');?></td>
      </tr>
    </table> 
    </td>
    <td valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td width="24%" align="right">会员账号：</td>
    <td width="26%" colspan="3"><?php echo $username;?> <a href="?mpage=train_pwd&show=4">修改用户名</a></td>
  </tr>
  <tr>
    <td align="right">服务类型：</td>
    <td colspan="3"><?php echo $Gname;?>(<?php echo $Mstartdate;?>到<?php echo $Menddate;?>)</td>
  </tr>
  <tr>
    <td align="right">邀请短信：</td>
    <td width="26%"><font color="#FF0000"><?php echo $Msmsnum;?></font> 条</td>
    <td width="24%" align="right"class="tdcolor">消费积分：</td>
    <td><font color="#FF0000"><?php echo $Mintegral;?></font> 分 <!--<a href="../help/index.php" target="_blank">如何获得?</a>--></td>
  </tr>
</table>
</td>
  </tr>
</table>
    
    </div>
</div>
<?php
}
?>