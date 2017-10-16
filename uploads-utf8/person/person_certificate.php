<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
@session_start();
$_SESSION["sUploadDir"]="person/";
if($do=='savedata'){
    for($i=1;$i<=5;$i++){
        $filename="filename0".$i;$filename=$$filename;
        $name="name0".$i;$info="info0".$i;
        if ($filename!=''){
            $name=cleartags($$name);$info=cleartags($$info);$flag=$regpArray[3]==1?0:1;
            $db ->query("INSERT INTO {$cfg['tb_pre']}picture (p_filename,p_type,p_status,p_member,p_adddate,p_name,p_flag,p_info) VALUES('$filename',21,1,'$username',NOW(),'$name','$flag','$info')");
        }
    }
	showmsg('证书保存成功，并已附加至简历页面！',"?mpage=person_certificate&show=$show",0,2000);exit();
}elseif($do=='hidden'){
	$db ->query("update {$cfg['tb_pre']}picture set p_status=0 where p_member='$username' and p_id in ($checks)");
	showmsg('取消附加成功，需要附加请选择证书后点击附加至简历！',"?mpage=person_certificate&show=$show",0,2000);exit();
}elseif($do=='show'){
	$db ->query("update {$cfg['tb_pre']}picture set p_status=1 where p_member='$username' and p_id in ($checks)");
	showmsg('设置成功，需要取消附件请选择证书后点击取消附加！',"?mpage=person_certificate&show=$show",0,2000);exit();
}elseif($do=='del'){
    $result=$db ->query("select p_filename from {$cfg['tb_pre']}picture where p_member='$username' and p_id in ($checks)");
    while($row=$db->fetch_array($result)){
        @unlink($row['p_filename']);
    }
    $db ->query("delete from {$cfg['tb_pre']}picture where p_member='$username' and p_id in ($checks)");
	showmsg('删除成功！',"?mpage=person_certificate&show=$show",0,2000);exit();
}else{
    $sql="select p_id,p_filename,p_status,p_member,p_adddate,p_name,p_flag,p_info from {$cfg['tb_pre']}picture where p_member='$username' and p_type=21 order by p_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $m=$counts<=4?4-$counts:0;
}
?>
<script language="javascript">
window.onload=function()
{ 
	fResizeImg(600,600, 'perpic');  
}
function fResizeImg(w, h, id){     
var img='';     
var obj;     
if(id==undefined)obj=document.images;     
else obj=document.getElementById(id).getElementsByTagName('img');     
	 
for(var i=0; i<obj.length; i++){     
	img=obj[i];     
	if(img.width>w&&(img.height<img.width)){     
		img.height=img.height-(img.height/(img.width/(img.width-w)))     
		img.width=w;     
	}else if(img.height>h&&(img.height>img.width)){     
		img.width=img.width-(img.width/(img.height/(img.height-h)))     
		img.height=h;     
	}     
		 
	img.onclick=function(){     
		try{ imgPopup.close();} catch(e){}     
		imgPopup=open('#', 'imgurl', 'width=500, height=500, left='+(screen.availWidth-500)/2+     
		', top='+(screen.availHeight-500)/2)     
		imgPopup.document.write('<script>document.onclick=function(){ close();} /* 单击关闭窗口 */ <\/script>');     
			 
		imgPopup.document.write('<img src="'+this.src+'"/>'+     
			'<script>'+     
				'var w, h;'+     
				'var img=document.images[0];'+     
				'if(navigator.appName=="Opera"){w=img.width+10; h=img.height+40} else {w=img.width+10; h=img.height+25};'+     
				'self.resizeTo(w, h);'+     
				'self.moveTo((screen.availWidth-img.width)/2,(screen.availHeight-img.height)/2)'+     
			'<\/script>'+     
			'<style>body{margin:0; padding:0;} .hd{visibility:hidden;}<\/style>');     
		imgPopup.document.write('<p class="hd">ok</p>');     
		imgPopup.document.close();     
		imgPopup.focus();     
	}     
}  
}     
</script>
<script language="javascript" type="text/javascript">
function opw(url,name,width,height) 
{
	window.open(url,name,''+'width='+width+',height='+height+',scrollbars=yes'+'');
}
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>资格证书上传</div>
    <div class="memrightbox">
        <div id="loading" style="z-index: 9999; display:none; position:absolute; text-align: center;width:100%;height:100px;">上传中，请稍后……<br /><br /><img src="../images/loading.gif" /></div>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
        <tr class="memtabhead">
          <td height="21" colspan="5" style="text-align: left;background-color:#f0f5f9;"><span style="MARGIN-LEFT: 5px; LINE-HEIGHT: 18px; padding:4px;"><strong>选择需要上传的证书图片：</strong><br />
      <font color="#333333">（上传证书格式一律为JPG、JPEG或GIF格式，图片大小不能超过</font><strong>100</strong><font color="#333333">K；证件类型包括：学历证书、学位证书、相关技能等级证书……，最多上传四个证书；如果需要更新证书，请删除后重新上传。）</font></span></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><?php if($m==0){echo "已上传四个证书，请设置是否附件至简历。";}else{?><table width="100%" style="border:#D3EEFC 1px solid" align="center" cellpadding="2" cellspacing="0" class="mtable">
            <form action="?do=savedata&mpage=person_certificate&show=<?php echo $show;?>" method="post"  name="addform" id="addform">
              <?php for($i=1;$i<=$m;$i++){?>
              <tr>
                <td align="left" bgcolor="#EEF8FF">证书<?php echo $i;?>：
                  <input name="filename0<?php echo $i;?>" type="text" id="filename0<?php echo $i;?>" size="20" readonly="readonly" onclick="javascript:opw('../inc/job_up.php?fromForm=addform&amp;fromEdit=filename0<?php echo $i;?>','adpic',420,165)" />
                  <input name="b<?php echo $i;?>" type="button" class="inputs" value="浏览" onclick="javascript:opw('../inc/job_up.php?fromForm=addform&amp;fromEdit=filename0<?php echo $i;?>','adpic',420,165)" />
                  名称：
                  <input name="name0<?php echo $i;?>" type="text" id="name0<?php echo $i;?>" size="20" />
                  简介：
                  <input name="info0<?php echo $i;?>" type="text" id="info0<?php echo $i;?>" size="40" /></td>
              </tr>
              <?php }?>
              <tr>
                <td bgcolor="#EEF8FF"><input name="submit" type="submit" class="submit" value="保存证书" /></td>
              </tr>
            </form>
          </table><?php }?></td>
        </tr>
      </table>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab" id="perpic">
        <form name="picform" action="?mpage=person_certificate&show=<?php echo $show;?>" method="post">
        <tr class="memtabhead">
          <td height="21" colspan="5" style="text-align: left;"><strong>给简历配置相关证书：</strong></td>
        </tr>
        <tr class="memtabmain">
        <?php
        $i=0;
        foreach($rsdb as $key=>$rs){
            $i++;
            if($rs['p_flag']==0){
                $status='待审核';
            }elseif($rs['p_status']==0){
                $status='尚未附加至简历页';
            }else{
                $status='已附加至简历页';
            }
            if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=perpic&id=$rs[p_id]\"></script>";
        ?>
            <td align="center"><table width="140" border="0" cellspacing="0" cellpadding="2" style="margin: 2px;border:1px #e1e6e9 solid;border-bottom:none; border-right:none;">
          <tr>
            <td align="left"><img src="<?php echo $rs["p_filename"];?>" style="border:1px #CCC8C9 solid; padding:2px;" width="120" height="90" /></td>
          </tr>
          <tr>
            <td style="text-align: left;"><input type="checkbox" name="pid" value="<?php echo $rs["p_id"];?>"><?php echo $rs["p_name"];?></td>
          </tr>
          <tr>
            <td style="text-align: left;">状态：<?php echo $status;?></td>
          </tr>
          <tr>
            <td align="left"><?php echo $rs["p_adddate"];?></td>
          </tr>
        </table>
        </td>
        <?php
        if($i%5 == 0) echo "        	</tr><tr class=\"memtabmain\">\r\n";
        }
        ?>
        </tr>
        <tr class="memtabpage">
          <td height="21" colspan="5"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp;
<input name="button1" type="button" class="inputs" value="附加至简历" onClick="confirmX(1);"> <input name="button2" type="button" class="inputs" value="取消附加" onClick="confirmX(2);"> <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(3);"></div></td>
        </tr>
        </form>
    </table>
    <script language="javascript">
function confirmX(num)
{
	var ids = document.getElementsByName("pid");
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
				document.picform.checks.value = allSel;
				check=true;
				
			}
		}
		if(check==false){alert("请选择操作对象！");return false;}
	}
	if(num==1)
	{
		document.picform.action="?do=show&mpage=person_certificate&show=<?php echo $show;?>";
		document.picform.submit();
	}
	if(num==2)
	{
		document.picform.action="?do=hidden&mpage=person_certificate&show=<?php echo $show;?>";
		document.picform.submit();
	}
	if(num==3)
	{
		document.picform.action="?do=del&mpage=person_certificate&show=<?php echo $show;?>";
		document.picform.submit();
	}
	return false;	
}
function checkAll(box1) {
    var ids = document.getElementsByName("pid");
	if (ids != null) {
		for (i=0; i<ids.length; i++) {
			var obj = ids[i];
			obj.checked = box1.checked;
		}
	}
}
</script>
    </div>
</div>