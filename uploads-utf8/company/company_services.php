<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='apply'){
    if(empty($Order_id) || empty($Order_groupid)){
        echo "<script language=JavaScript>{alert('参数错误!');location.href = 'javascript:history.go(-1)';}</script>";
        exit;
    }else{
        $Order_id=intval($Order_id);
        $Order_groupid=intval($Order_groupid);
        if($Order_id==0||$Order_groupid==0){
            echo "<script language=JavaScript>{alert('参数错误!');location.href = 'javascript:history.go(-1)';}</script>";
            exit;
        }
        $rs = $db->get_one("select * from {$cfg['tb_pre']}orderservice,{$cfg['tb_pre']}group where o_groupid=g_id and o_id=$Order_id and o_groupid=$Order_groupid and o_member='$username'");
        if($rs){
            if($rs['o_result']!=''){
                switch($rs['o_result']){
                case 3:
                echo "<script language=JavaScript>{alert('该申请已开通过了，本次操作不成功!');location.href = 'javascript:history.go(-1)';}</script>";
                exit;
                break;
                case 4:
                echo "<script language=JavaScript>{alert('该申请已过期，本次操作不成功!');location.href = 'javascript:history.go(-1)';}</script>";
                exit;
                break;
                case 5:
                echo "<script language=JavaScript>{alert('该申请已作废，本次操作不成功!');location.href = 'javascript:history.go(-1)';}</script>";
                exit;
                break;
               }
            }
            $groupid=$rs['g_id'];$gname=$rs['g_name'];$term=$rs['g_term'];$unit=$rs['g_unit'];$outlay=$rs['g_outlay'];$limit=explode(",",$rs['g_limit']);$integral=explode(",",$rs['g_integral']);
            $integral=$integral[5];$startdate=dtime($fr_time,3);
            $hirenum=$limit[1];$expertnum=$limit[3];$myinterviewnum=$limit[5];$recyclenum=$limit[7];$contactnum=$limit[9];$smsnum=$limit[13];
            switch ($unit){
                case '日':$enddate=date('Y-m-d',strtotime($startdate."+$term day"));break;
                case '月':$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                case '季':$term=$term*3;$enddate=date('Y-m-d',strtotime($startdate."+$term month"));break;
                case '年':$enddate=date('Y-m-d',strtotime($startdate."+$term year"));break;
            }
            if($Mbalance<$outlay){
                echo "<script language=JavaScript>{alert('余额不足，开通失败!');location.href = 'javascript:history.go(-1)';}</script>";
                exit;
            }
            require_once(FR_ROOT.'/inc/paylog.inc.php');
            echo paymoney($username,$outlay); //扣费操作
            paylog($username,"会员账号升级为$name,扣除{$outlay}元。",0); //创建日志
            $db ->query("update {$cfg['tb_pre']}member set m_groupid=$groupid,
            m_hirenum=$hirenum,m_expertnum=$expertnum,m_myinterviewnum=$myinterviewnum,
            m_recyclenum=$recyclenum,m_contactnum=$contactnum,m_smsnum=$smsnum,
            m_startdate='$startdate',m_enddate='$enddate' where m_login='$username'");
            servicelog($gname,$startdate,$enddate,$Memberid,0,$outlay);
            $db ->query("update {$cfg['tb_pre']}orderservice set o_result=3,o_dealdatetime=NOW() where o_member='$username' and o_id=$Order_id");
            showmsg('支付成功！',"?do=main&show=0",0,2000);exit();
        }else{
            echo "<script language=JavaScript>{alert('服务申请不存在!');location.href = 'javascript:history.go(-1)';}</script>";
            exit;
        }
    }
}else{
    $query=$db->query("select * from {$cfg['tb_pre']}orderservice,{$cfg['tb_pre']}group where o_groupid=g_id and o_member='$username' order by o_id");
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>已申请的服务</div>
    <div class="memrightbox">
    <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>您申请的会员服务如下，您还可以申请其他服务，<a href="?mpage=company_service&show=<?php echo $show?>">现在去了解一下</a>。</li>
    </div>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
    <form name="form" action="?do=apply&mpage=company_service&show=<?php echo $show;?>" method="post">
     <tr class="memtabhead" align="center">
        <td width="14%">产品</td>
        <td width="9%">发布职位数</td>
        <td width="9%">下载简历数</td>
        <td width="9%">面试邀请数</td>
        <td width="9%">人才库容量</td>
        <td width="9%">发送短信数</td>
        <td width="8%">服务期限</td>
        <td width="8%">服务费用</td>
        <td width="17%">合同编号</td>
        <td width="8%">状态</td>
      </tr>
      <?php
        $i=0;
        foreach($rsdb as $key=>$rs){
       $i++;
       $Group_Climits=explode(',',$rs["g_limit"]);
       echo "<tr class=\"memtabmain\" align=\"center\">\r\n";
       echo " <td><input type=\"radio\" name=\"Groupid\" value=\"$rs[g_id]\" disabled";
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
       echo " <td>$rs[o_pactnum]</td>\r\n";
       switch($rs['o_result']){
        case 0:$Order_result="申请中";break;
        case 1:$Order_result="处理中";break;
        case 2:$Order_result="等待付款";break;
        case 3:$Order_result="成功";break;
        case 4:$Order_result="过期";break;
        case 5:$Order_result="作废";break;
       }
       echo " <td>$Order_result</td>\r\n";
       echo "</tr>\r\n";
       if($rs['o_result']<3){
           echo "<tr class=\"memtabmain\">\r\n";
           echo "<td colspan=\"5\" align=\"left\"><span class=\"tdcolor\">客服回复：</span>";
           if($rs['o_revert']!=''){echo change_strbox($rs['o_revert']);}else{echo "您可以使用在线支付功能进行支付！";}
           echo "</td>\r\n";
           echo "<td colspan=\"5\" align=\"left\">该服务需要支付$rs[g_outlay]元，当前余额：{$Mbalance}元，";
           if($rs['g_outlay']>$Mbalance){echo "余额不足。";}else{echo "<a href=\"#\" onclick=\"if (confirm('确定要开通该服务吗？系统将自动进行扣费并开通服务！'))location.href=' ?do=apply&mpage=company_services&show=$show&Order_id=$rs[o_id]&Order_groupid=$rs[o_groupid]'\">立即开通服务</a>";}
           echo " <input name=\"\" type=\"button\" onclick=\"location.href='?mpage=company_onlinepay&show=0&p=onlinepay'\" value=\"充值\" class=\"inputs\" /></td>\r\n";
           echo "</tr>\r\n";
       }
       }?>
      </form>
      </table>
    </div>
</div>