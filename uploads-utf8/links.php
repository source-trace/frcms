<?php
if(!file_exists(dirname(__FILE__).'/config.inc.php'))
{
    header('Location:install/index.php');
    exit();
}
require(dirname(__FILE__).'/config.inc.php');
if(empty($do)) $do= '';
if(empty($linkname)) $linkname='';
if(empty($linkurl)) $linkurl='';
if(empty($linksm)) $linksm='';
if(empty($key)) $key='';
$linkname=cleartags($linkname);$linkurl=cleartags($linkurl);$linksm=cleartags($linksm);
if($do=='save1'){
    if (chkpost()){
        if($linkname==''||$linkurl==''||$linksm==''){
            showmsg('友情连接资料不能为空！！！','-1');exit();
        }else{
            $key=intval($key);
            $db ->query("INSERT INTO {$cfg['tb_pre']}links (l_name,l_url,l_sm,l_key,l_key1) VALUES('$linkname','$linkurl','$linksm',0,0)");
            echo "<script>alert('操作成功，请等待管理员审核开通！');window.close()</script>";exit();
        }
    }else{
        showmsg('请勿非法提交数据','-1');exit();
    }
}elseif($do=='save2'){
    if (chkpost()){
        if($linkname==''||$linkurl==''||$linksm==''||$key==''){
            showmsg('友情连接资料不能为空！！！','-1');exit();
        }else{
            $db ->query("INSERT INTO {$cfg['tb_pre']}links (l_name,l_url,l_sm,l_key,l_key1) VALUES('$linkname','$linkurl','$linksm',1,0)");
            echo "<script>alert('操作成功，请等待管理员审核开通！');window.close()</script>";exit();
        }
        
    }else{
        showmsg('请勿非法提交数据','-1');exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Content-Language" content="gb2312" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
</hand>
<style type="text/css">
<!--
body{
	font-size:12px;
}
.STYLE1 {font-size: 14px}
-->
</style>
<body style="margin:5">
<script language="javascript">
function show1()
{
 	text.style.display="";
	picture.style.display="none";
}
function show2()
{
	picture.style.display="";
	text.style.display="none";
}

</script><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#FFFFFF">
    <tr>
      <td height="25" align="center" bgcolor=#efefef>&nbsp; <strong class="STYLE1">交换链接类型</strong></td>
    </tr>
    <tr>
      <td height="25" align="center"><p class="STYLE1">
        <input name="type" type="radio" id=1 value="text" checked onClick="show1()">
        文字链接
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
        <input type="radio" name="type" id=2 value="picture" onClick="show2()">
        图片连接
&nbsp;&nbsp;</p>
      </td>
    </tr>
</table>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#FFFFFF" id="text" style="display:">
<form name="addform" action="links.php?do=save1" method="post">
<input name="key" type="hidden" value="0">
<tr><td height="25" colspan=2 align="left" bgcolor=#efefef>&nbsp; <strong class="STYLE1">文字链接</strong></td>
</tr>
<tr><td width="12%" height="25" align="right"><span class="STYLE1">网站名称</span>&nbsp;</td>
<td width="88%">&nbsp;<input name="linkname" type="text" size="30" value=""></td></tr>
<tr> <td height="25" align="right"><span class="STYLE1">连接地址</span>&nbsp;</td>
<td>&nbsp;<input name="linkurl" type="text" size="40" value="http://"></td></tr>
<tr><td height="25" align="right"><span class="STYLE1">网站说明</span>&nbsp;</td>
<td>&nbsp;<input name="linksm" type="text" size="40"></td></tr>
<tr><td height="25" align="center" colspan="2"><input type="submit" name="Submit" value=" 现在申请 "></td></tr>
</form>
</table>

<table width="100%" border="1" align="right" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#FFFFFF" id="picture" style="display:none">
<form name="form" action="links.php?do=save2" method="post">
<input name="key" type="hidden" value="1">
<tr><td height="25" align="left" colspan=2 bgcolor=#efefef>&nbsp; <strong class="STYLE1">图片连接</strong></td>
</tr>
<tr><td width="12%" height="25" align="right"><span class="STYLE1">图片地址</span>&nbsp;</td>
<td>&nbsp;<input name="linkname" type="text" size="30" value="http://"> <span class="STYLE1">尺寸</span>：<span class="STYLE1">88*31
</span></td>
</tr>
<tr> <td height="25" align="right"><span class="STYLE1">连接地址</span>&nbsp;</td>
<td>&nbsp;<input name="linkurl" type="text" size="40" value="http://"></td></tr>
<tr><td height="25" align="right"><span class="STYLE1">网站说明</span>&nbsp;</td>
<td>&nbsp;<input name="linksm" type="text" size="40"></td></tr>
<tr><td height="25" align="center" colspan="2"><input type="submit" name="Submit" value=" 现在申请 "></td></tr>
</form>
</table>
</body>
</html>