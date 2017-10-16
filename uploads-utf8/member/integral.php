<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>如何获得积分</div>
    <div class="memrightbox">
      <div class="memts">
        <li>
        <font color="#FF0000"><b>查看积分记录：</b><a href="?mpage=integrallist&amp;m=main">点击查看</a></font> 
        </li>
    </div>
      <table border="0" cellspacing="1" cellpadding="0" width="700" bgcolor="#edecec">
        <tbody>
          <tr>
            <td width="208" height="25" align="center" bgcolor="#FFFFFF"><strong>具体行为</strong></td>
            <td width="167" height="25" align="middle" bgcolor="#FFFFFF"><strong>积分变化</strong></td>
            <td height="25" colspan="2" align="middle" bgcolor="#FFFFFF"><strong>备注</strong></td>
          </tr>
          <?php if($user_type=='pmember'){   ?>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 注册（通过审核）　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[5] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 注册通行证</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 登录次数　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[6] ?>/次</td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 增加简历　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[3] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_addresume&show=1"><u>增加简历</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 简历外发　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[1] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_sendresume&show=2&t=addform"><u>简历外发</u></a></td>
          </tr>
          <!--<tr>
            <td bgcolor="#FFFFFF" height="25">　 证书上传　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[11] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_certificate&show=1"><u>我要上传证书</u></a></td>
          </tr>-->
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 申请职位　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[2] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_newhire&show=3" ><u>我要申请职位</u></a></td>
          </tr>
          <!--<tr>
            <td bgcolor="#FFFFFF" height="25">　 简历照片　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[10] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_photo&show=0"><u>我要上传照片</u></a></td>
          </tr>-->
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 收藏职位　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[0] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_newhire&show=3"><u>浏览最新职位</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 填写求职信　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[4] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=person_letters&show=2&t=addform" ><u>填写求职信</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" height="25">　 成功邀请好友注册　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[7] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 成功邀请好友　 <a href="?mpage=invite&m=main" ><u>邀请好友</u></a></td>
          </tr>
          <?php }else{   ?>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 注册（通过审核）　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[4] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 注册通行证</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 登录次数　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[5] ?>/次</td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 发布职位　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[0] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_hirelist&show=1&t=addform"><u>发布职位</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 放入人才库　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[1] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_newresume&show=2"><u>收藏简历</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 邀请面试　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[2] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_newresume&show=2"><u>查看简历发送面试邀请</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 查看并下载简历　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[3] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_newresume&show=2"><u>查看最新简历</u></a></td>
          </tr>
          <!--<tr>
            <td bgcolor="#FFFFFF" height="25">　 执照上传　　　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[9] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_licence&show=0"><u>我要上传执照</u></a></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" height="25">　 上传LOGO　　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[8] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 <a href="?mpage=company_uploadlogo&show=0"><u>我要上传LOGO</u></a></td>
          </tr>-->
          <tr>
            <td bgcolor="#ffffff" height="25">　 成功邀请好友注册　</td>
            <td height="25" align="middle" bgcolor="#FFFFFF">+<?php echo $Gintegral[6] ?></td>
            <td height="25" colspan="2" bgcolor="#FFFFFF">　 成功邀请好友　 <a href="?mpage=invite&m=main" ><u>邀请好友</u></a></td>
          </tr>
          <?php }  ?>
        </tbody>
      </table>
    </div>
</div>
