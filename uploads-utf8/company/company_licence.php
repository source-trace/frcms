<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
@session_start();
$_SESSION["sUploadDir"]="company/";
if($do=='savedata'){ 
	if($photo!=''){
		$rs = $db->get_one("select p_filename,p_adddate from {$cfg['tb_pre']}picture where p_member='$username' and p_type=11 limit 0,1");
    	if($rs){
			$p_filename=$rs['p_filename'];
			if($p_filename!=$photo) @unlink($p_filename);
            $db ->query("update {$cfg['tb_pre']}picture a,{$cfg['tb_pre']}member b set a.p_filename='$photo',a.p_adddate=NOW(),b.m_confirm=0 where a.p_member=b.m_login and a.p_member='$username' and a.p_type=11");
		}else{
            $db ->query("INSERT INTO {$cfg['tb_pre']}picture (p_filename,p_type,p_status,p_member,p_adddate,p_name,p_flag,p_info) VALUES('$photo',11,1,'$username',NOW(),'我司执照',1,'执照扫描件')");
		}
	}
	showmsg('执照上传成功，请等待管理员审核。<br>未通过审核之前您可以重新上传！',"?mpage=company_licence&show=$show",0,2000);exit();
}
$rs = $db->get_one("select m_confirm from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
$m_confirm=$rs['m_confirm'];
$rs = $db->get_one("select p_filename,p_adddate from {$cfg['tb_pre']}picture where p_member='$username' and p_type=11 order by p_adddate desc limit 0,1");
if($rs){
    $p_filename=$rs['p_filename'];
    $p_filename=$p_filename?$p_filename:'';
    $p_adddate=$rs['p_adddate'];
}else{
    $p_filename='';$p_adddate='';
}
?>
<script language="javascript" type="text/javascript">
function opw(url,name,width,height) 
{
	window.open(url,name,''+'width='+width+',height='+height+',scrollbars=yes'+'');
}
$().ready(function() {
	$("#addform").validate({
		rules: {
			photo: {required: true}
		},
		messages: {
			photo: '点击浏览上传照片'
		}
	});
});
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>营业执照上传</div>
    <div class="memrightbox">
      <div class="memts">
        <li><font color="#FF0000"><b>温馨提示：</b></font>所传营业执照扫描图片一律为JPG、JPEG或GIF格式。如果您没有扫描仪，可以将营业执照复印件邮寄给我们，我们免费为您服务。</li>
    </div>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabhead">
        <td colspan="2">上传营业执照</td>
      </tr>
      <tr class="memtabmain">
        <td width="200" align="center"><?php if($m_confirm==1){
            if($p_adddate!='') echo "上传时间$p_adddate<br>";
            echo "已通过执照认证！";}else{
                if($p_filename!=''){
                    if($m_confirm==2){
                        echo "认证失败，请重新上传！<br>";
                    }else{
                        echo "认证中！<br>";
                    }
                    ?><img height="120" src="<?php echo $p_filename;?>" width="160" border="0" style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid" /><?php }else{echo '尚未上传';}}?></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtable">
          <tr>
            <td align="left">营业执照上传后，仅后台管理员可见，其他用户看不到。</td>
          </tr>
          <tr>
            <td align="left" class="tdcolor"><font color="#FF0000">为什么要上传营业执照？</font></td>
          </tr>
          <tr>
            <td align="left">1、审核通过后您将获得更多功能及会员服务。</td>
          </tr>
          <tr>
            <td align="left">2、审核通过后招聘页面显示该企业已通过营业执照认证，提供求职者对贵公司的信任。</td>
          </tr>
          <tr>
            <td align="left">提示：为消除疑虑，上传或者传真时可备注“此件仅供招聘审核用，再次复印无效”等字样。</td>
          </tr>
        </table></td>
      </tr>
        <?php if($m_confirm!=1){?><form action="?do=savedata&mpage=company_licence&show=<?php echo $show;?>" method="post"  name="addform" id="addform">
            <tr class="memtabmain">
        <td colspan="2">请选择文件：<input name="photo" type="text" id="photo" size="20" />
          <input name="b122" type="button" class="inputs" value="浏览" onClick="javascript:opw('../inc/job_up.php?fromForm=addform&fromEdit=photo','adpic',420,165)" /> <input name="b122" type="submit" class="inputs" value="保存" /> 点击浏览选择上传的图片并上传，上传成功后点击保存按钮。</td>
            </tr>
            </form>
            <?php }?>
      </table>
    </div>
</div>