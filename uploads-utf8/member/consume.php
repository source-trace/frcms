<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$sql="select * from {$cfg['tb_pre']}consume where c_stype=0 and c_member='$username' order by c_id desc ";
$counts = $db->counter("{$cfg['tb_pre']}consume","c_stype=0 and c_member='$username' ");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"?mpage=consume&amp;m=main",20,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>我的消费记录</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
        <tr class="memtabhead" align="center">
          <td width="10%" height="21">序号</td>
          <td width="60%">备注</td>
          <td width="30%">时间</td>
        </tr>
        <?php
		$i=0;
        foreach($rsdb as $key=>$rs){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "          <td height=\"22\">".++$i."</td>\r\n";
        echo "          <td align=\"left\">于{$rs['c_adddate']} {$rs['c_content']}</td>\r\n";
        echo "          <td>{$rs['c_adddate']}</td>\r\n";
        echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="8"><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        
      </table>
    </div>
</div>