<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$sql="select m_name,m_typeid,m_regdate from {$cfg['tb_pre']}member where m_inviteid=$Memberid";
$counts = $db->counter("{$cfg['tb_pre']}member","m_inviteid=$Memberid");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"?mpage=invite&amp;m=main",20,5);

$sql.=$getpageinfo['sqllimit'];

$query=$db->query($sql);
while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
}
?>
<script language="javascript">
function copyToClipboard(txt) {     
    if(window.clipboardData) {     
        window.clipboardData.clearData();     
        window.clipboardData.setData("Text", txt);    
        alert("复制成功！您可以发送给MSN或QQ上的好友了")   
    } else if(navigator.userAgent.indexOf("Opera") != -1) {     
        window.location = txt;     
        alert("复制成功！您可以发送给MSN或QQ上的好友了");  
    } else if (window.netscape) {     
        try {     
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");     
        } catch (e) {     
            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将 'signed.applets.codebase_principal_support'设置为'true'");     
        }     
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);     
        if (!clip)     
        return;     
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);     
        if (!trans)     
        return;     
        trans.addDataFlavor('text/unicode');     
        var str = new Object();     
        var len = new Object();     
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);     
        var copytext = txt;     
        str.data = copytext;     
        trans.setTransferData("text/unicode",str,copytext.length*2);     
        var clipid = Components.interfaces.nsIClipboard;     
        if (!clip)     
        return false;     
        clip.setData(trans,null,clipid.kGlobalClipboard);     
        alert("复制成功！您可以发送给MSN或QQ上的好友了")     
    }     
}    
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>我邀请的好友列表</div>

    <div class="memrightbox">
         <div class="memts">
        <li>
        <font color="#FF0000"><b>复制链接给QQ/MSN的朋友</b></font> 
        <table cellspacing="0" cellpadding="0" style="margin-left:20px;">

          <tr>
            <td>点击复制按钮，将它粘贴到MSN或QQ的好友对话框中，即可快速邀请好友们加入！<br />
              <textarea id="urlName" rows="3" cols="80" readonly="readOnly" name="urlName" style="border:1px solid #cecece;"><?php    
		switch($user_type){
        case 'pmember':echo '点击进来，找份合适您的工作吧！  ' ;break;
        case 'cmember':echo '点击进来，一起招聘吧！  ';break;
        case 'smember':echo '点击进来  ';break;
        case 'tmember':echo '点击进来  ';break; 
        default:echo '点击进来，找份合适您的工作吧！  ';
    }     ?><?php echo $cfg['siteurl'].$cfg['path'].'register.php?'.$ut.'&inviteid='.$Memberid;?></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input onclick="copyToClipboard(document.getElementById('urlName').value);" value="复制此链接" class="submit" type="button" name="Submit2" /></td>
          </tr>
        </table>
        </li>
    </div>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabhead">
          <td height="21" colspan="8" style="text-align:left">好友列表</td>
        </tr>
        <tr class="memtabhead" align="center">
          <td width="10%" height="21">序号</td>
          <td width="60%">姓名</td>
          <td width="15%">会员类型</td>
          <td width="15%">注册时间</td>
        </tr>
        <?php
		$i=0;
		
        foreach($rsdb as $key=>$rs){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "          <td height=\"22\">".++$i."</td>\r\n";
        echo "          <td>{$rs['m_name']}</td>\r\n";
        echo "          <td>{$sysgroup[$rs['m_typeid']]}</td>\r\n";
        echo "          <td>".dtime(strtotime($rs["m_adddate"]),3)."</td>\r\n";
       
        echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="8"><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        
      </table>
    </div>
</div>


