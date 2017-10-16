<?php
require(dirname(__FILE__).'/../config.inc.php');
require(FR_ROOT.'/member/check.php');
if(!isset($rid)||!is_numeric($rid)){
    echo "<script language=JavaScript>alert('信息参数错误！');window.close();</script>";exit;
}
if(empty($do)) $do='';
$rid=intval($rid);
$rsqlstr=array('r_member','r_id','r_adddate','r_name','r_sex','r_birth',
'r_cardtype','r_idcard','r_nation','r_marriage','r_height','r_polity',
'r_weight','r_hukou','r_seat','r_school','r_graduate','r_edu','r_zhicheng','r_sumup',
'r_appraise','r_jobtype','r_trade','r_position','r_workadd','r_pay','r_stay','r_workdate',
'r_request','r_tel','r_mobile','r_chat','r_email','r_url','r_address','r_post','r_visitnum',
'r_usergroup','r_openness','r_title','r_template','r_ability','r_adddate','m_logo','m_nameshow','m_qzstate');
$sqlss='';
foreach($rsqlstr as $v) $sqlss.="$v,";
$sqlss=substr($sqlss,0,-1);
$rs=$db->get_one("select $sqlss from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_member=m_login where r_id=$rid");
if($rs){
    foreach($rsqlstr as $v) $$v=$rs[$v];
    $r_graduate=$r_graduate=='0000-00-00'?"":$r_graduate;
    $m_logo=($m_logo==''||$m_logo=='error.gif')?$cfg['siteurl'].$cfg['path'].'upfiles/person/nophoto.gif':$cfg['siteurl'].$m_logo;
}else{
    echo "<script language=JavaScript>alert('内容不存在或已删除！');window.close();</script>";exit;
}
$query=$db->query("select * from {$cfg['tb_pre']}education where e_rid=$rid");
while($row=$db->fetch_array($query)){
    $edudb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}training where t_rid=$rid");
while($row=$db->fetch_array($query)){
    $trainingdb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}lang where l_rid=$rid");
while($row=$db->fetch_array($query)){
    $langdb[]=$row;
}
$query=$db->query("select * from {$cfg['tb_pre']}work where w_rid=$rid");
while($row=$db->fetch_array($query)){
    $workdb[]=$row;
}
if($do=='doc'){
    $ua = $_SERVER["HTTP_USER_AGENT"];
    $filename = $r_name.'的个人简历.doc';
	$encoded_filename=$filename;
    //$encoded_filename = urlencode($filename);
    //$encoded_filename = str_replace("+",'%20',$encoded_filename);
    //header('Content-Type: application/octet-stream');
    header('Content-type: application/doc');
    if (preg_match("/MSIE/", $ua)) {
    	header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    	} 
    else if (preg_match("/Firefox/", $ua)) {
    	header('Content-Disposition: attachment; filename*="utf8\'\" '. $filename . '"');}
    	else {
    	header('Content-Disposition: attachment; filename="' . $filename . '"');
    }
    print'<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns="http://www.w3.org/TR/REC-html40">';
}
require(FR_ROOT.'/inc/common.func.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>查看简历</title>
<style type="text/css">
<!--
body ,th,td{font:normal 12px "微软雅黑", "宋体",verdana,arial,helvetica,sans-serif;}
body {line-height: 150%; background:#fff;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;margin-left: 0px;}
tr {background:#EEF7FD;}
td {height:18px;line-height:20px;font-size:12px;border:1px solid #fff;color:#000000;padding:2px;}
table{background:#C4D8ED; margin-bottom:6px;}
th {color:#000;height:18px; line-height:18px; font-size:14px;background:#fff;font-weight:bold;border:1px solid #fff;padding-left:20px;text-align:left;}
li{float:left; margin:2px;}
li img{padding:1px; margin:0; border:1px solid #ccc}
#contact li{ width:100%;}
.tablebg{ background:#C4D8ED}
.inputs{border:1px #C7C8C9 solid; background:url(../skin/system/tit_bg.gif) center repeat-x; height:20px; padding:2px 4px 0 4px; font-size:12px; cursor:pointer}
-->
</style>
<?php
$rs = $db->get_one("select * from {$cfg['tb_pre']}myexpert where m_cmember='$username' and m_rid=$rid and m_down=1");
if($rs){
$Show=1;
}else{
$Show=0;
?>
<script language="javascript" type="text/javascript"> 
<!--
function Contact(resumeid,issee){
var xmlhttp;
try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}
catch (e){
	try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
catch (e){
	try{xmlhttp=new XMLHttpRequest();}
	catch (e){}
		}
	}
	//创建请求，并使用escape对email编码，以避免乱码
	xmlhttp.open("get","<?php echo $cfg['path'];?>inc/contacts.php?resumeid="+escape(resumeid)+ "&issee="+escape(issee)+ "&t=" + new Date().getTime());
	xmlhttp.onreadystatechange=function()
	{if(4==xmlhttp.readyState)
	{if(200==xmlhttp.status)
	{msg=xmlhttp.responseText;}
	else{msg="网络链接失败！";}
	var ch=document.getElementById("contact");
	ch.innerHTML=msg; 
	}else{msg="<img src='<?php echo $cfg['path'];?>skin/system/loing.gif'>数据读取中，请稍后...";
	var ch=document.getElementById("contact");
	ch.innerHTML=msg; 
	}
}
xmlhttp.send(null); 
return false;
}
-->
</script>
<?php }?>
</head>
<body>
<table width="760" border="0" align="center" cellpadding="4" cellspacing="1">
<tr style="background: #FFFFFF;">
<td style="padding: 10px; line-height:30px;"><font style="font-size:24px; float:left"><?php echo $r_name;?>的求职简历</font><span style="float:right">简历编号：<?php echo $r_id;?>　更新时间：<?php echo $r_adddate;?></span></td>
</tr>
<tr>
  <td style="padding: 10px;">
    <table width="760" border="0" align="center" cellpadding="4" cellspacing="1">
    <tr>
      <th colspan="7">基本资料</th>
    </tr>
    <tr>
      <td width="80" align="right">姓　　名：</td>
      <td width="80"><?php echo $r_name;?></td>
      <td width="80" align="right">性　　别：</td>
      <td width="80"><?php echo hiresex($r_sex);?></td>
      <td width="80" align="right">出生年月：</td>
      <td width="80"><?php echo $r_birth;?></td>
      <td rowspan="7" align="center" valign="middle"><img src="<?php echo $m_logo;?>" width="100" height="120" /></td>
    </tr>
    <tr>
      <td align="right">婚姻状况：</td>
      <td><?php echo $r_marriage;?>&nbsp;</td>
      <td align="right">政治面貌：</td>
      <td><?php echo $r_polity;?>&nbsp;</td>
      <td align="right">民　　族：</td>
      <td><?php echo $r_nation;?>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">身　　高：</td>
      <td><?php echo $r_height;?>cm</td>
      <td align="right">体　　重：</td>
      <td><?php echo $r_weight;?>kg</td>
      <td align="right">最高学历：</td>
      <td><?php echo hireedu($r_edu);?></td>
    </tr>
    <tr>
      <td align="right">所学专业：</td>
      <td><?php echo $r_zhicheng;?>&nbsp;</td>
      <td align="right">毕业学校：</td>
      <td colspan="3"><?php echo $r_school;?>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">毕业时间：</td>
      <td><?php echo $r_graduate;?>&nbsp;</td>
      <td align="right">特长概括：</td>
      <td colspan="3"><?php echo $r_sumup;?>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">户　　籍：</td>
      <td colspan="5"><?php echo xreplace($r_hukou);?>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">现所在地：</td>
      <td colspan="5"><?php echo xreplace($r_seat);?></td>
    </tr>
    <tr>
      <th colspan="7">自我评价</th>
    </tr>
    <tr>
      <td colspan="7"><?php echo $r_appraise;?>&nbsp;</td>
    </tr>
    </table>
    <table width="760" border="0" align="center" cellpadding="4" cellspacing="1">
    <tr>
      <th colspan="6">求职意向</th>
    </tr>
    <tr>
        <td width="80" align="right">求职状态：</td>
        <td colspan="5"><font color="red"><?php echo $m_qzstate;?></font></td>
    </tr>
    <tr>
      <td width="80" align="right">职位性质：</td>
      <td width="100"><?php echo hiretype($r_jobtype);?></td>
      <td width="80" align="right">到岗时间：</td>
      <td width="100"><?php echo memberworkdate($r_workdate);?></td>
      <td width="80" align="right">月薪要求：</td>
      <td><?php echo hirepay($r_pay);?> <?php echo $FR_住宿要求;?></td>
    </tr>
    <tr>
      <td align="right">工作岗位：</td>
      <td colspan="5"><?php echo xreplace($r_position);?></td>
    </tr>
    <tr>
      <td align="right">行业类别：</td>
      <td colspan="5"><?php echo xreplace($r_trade);?></td>
    </tr>
    <tr>
      <td align="right">工作地区：</td>
      <td colspan="5"><?php echo xreplace($r_workadd);?></td>
    </tr>
    <tr>
      <td align="right">其他要求：</td>
      <td colspan="5"><?php echo $r_request;?></td>
    </tr>
    </table>
    <table width="760" border="0" align="center" cellpadding="4" cellspacing="1">
    <?php if(is_array($edudb)){?>
    <tr>
      <th>教育背景</th>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tablebg">
        <tr>
            <td width="8%" align="center"><strong>学历</strong></td>
            <td width="20%" align="center"><strong>学校名称</strong></td>
            <td width="15%" align="center"><strong>专业</strong></td>
            <td width="20%" align="center"><strong>时间范围</strong></td>
            <td width="37%" align="center"><strong>专业描述</strong></td>
        </tr>
          <?php foreach($edudb as $rs){?>
          <tr>
            <td align="center"><?php echo $rs['e_edu'];?></td>
            <td align="center"><?php echo $rs['e_school'];?></td>
            <td align="center"><?php echo xreplace($rs['e_profession'],1,1);?>&nbsp;</td>
            <td align="center"><?php echo $rs['e_startyear'];?>年<?php echo $rs['e_startmonth'];?>月-<?php echo $rs['e_endyear'];?>年<?php echo $rs['e_endmonth'];?>月</td>
            <td><?php echo $rs['e_detail'];?>&nbsp;</td>
          </tr>
          <?php }?>
      </table></td>
    </tr>
    <?php
}
if(is_array($trainingdb)){?>
    <tr>
      <th>培训经历</th>
    </tr>
    <tr>
      <td>
      <?php foreach($trainingdb as $rs){?>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" border="0" class="tablebg">
    <tr>
    <td colspan="4"><strong><?php echo $rs['t_startyear'];?>年<?php echo $rs['t_startmonth'];?>月-<?php echo $rs['t_endyear'];?>年<?php echo $rs['t_endmonth'];?>月 　培训课程：<?php echo $rs['t_course'];?> </strong></td>
    </tr>
    <tr>
    <td width="12%" align="right">培训机构：</td>
    <td width="38%"><?php echo $rs['t_train'];?>&nbsp;</td>
    <td width="12%" align="right">培训地点：</td>
    <td width="38%"><?php echo $rs['t_address'];?>&nbsp;</td>
    </tr>
    
    <tr>
    <td align='right'>获得证书：</td>
    <td colspan="3" ><?php echo $rs['t_certificate'];?>&nbsp;</td>
    </tr>
    <tr>
    <td align='right'>培训描述：</td>
    <td colspan="3"><?php echo $rs['t_detail'];?>&nbsp;</td>
    </tr>
    </table>
    <?php }?>
    </td>
    </tr>
    <?php
}
if(is_array($langdb)){?>
    <tr>
      <th>语言能力</th>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" class="tablebg">
        <tr>
          <td width="50%" align="center"><strong>外语语种</strong></td>
          <td width="50%" align="center"><strong>掌握程度</strong></td>
        </tr>
        <?php foreach($langdb as $rs){?>
        <tr>
          <td align="center"><?php echo $rs['l_name'];?></td>
          <td align="center"><?php echo $rs['l_master'];?></td>
        </tr>
        <?php }?>
      </table></td>
    </tr>
    <?php
}
if(is_array($workdb)){?>
    <tr>
      <th>工作经验</th>
    </tr>
    <tr>
      <td>
      <?php foreach($workdb as $rs){?>
        <table cellspacing="1" cellpadding="4" width="100%" align="center" border="0" class="tablebg">
          <tr>
            <td colspan="4"><strong><?php echo $rs['w_startyear'];?>年<?php echo $rs['w_startmonth'];?>月-<?php echo $rs['w_endyear'];?>年<?php echo $rs['w_endmonth'];?>月
              ：<?php echo $rs['w_comname'];?> </strong></td>
          </tr>
          <tr>
            <td width="12%" align="right">公司性质：</td>
            <td width="38%"><?php echo $rs['w_ecoclass'];?></td>
            <td width="12%" align="right">所属行业：</td>
            <td width="38%"><?php echo $rs['w_trade'];?></td>
          </tr>
          <tr>
            <td align="right">所在部门：</td>
            <td><?php echo $rs['w_dept'];?>&nbsp;</td>
            <td align='right'>担任职务：</td>
            <td><?php echo $rs['w_place'];?>&nbsp;</td>
          </tr>
          <tr>
            <td align='right'>工作描述：</td>
            <td colspan="3" ><?php echo $rs['w_introduce'];?>&nbsp;</td>
          </tr>
          <tr>
            <td align='right'>离职原因：</td>
            <td colspan="3"><?php echo $rs['w_leftreason'];?>&nbsp;</td>
          </tr>
        </table>
        <?php }?>
        </td>
    </tr>
    <?php }?>
    <tr>
      <th>技能专长</th>
    </tr>
    <tr>
      <td><?php echo $r_ability;?>&nbsp;</td>
    </tr>
    <tr>
      <th>相关证书</th>
    </tr>
    <tr>
      <td><?php echo getmemberpic($r_member,0,5,21,138,106);?>&nbsp;</td>
    </tr>
    <tr>
      <th>职场风采</th>
    </tr>
    <tr>
      <td><?php echo getmemberpic($r_member,0,5,22,138,106);?>&nbsp;</td>
    </tr>
    </table>
    <table width="760" border="0" align="center" cellpadding="4" cellspacing="1">
    <tr>
      <th colspan="4">联系方式</th>
    </tr>
    <?php if($Show==1){?>
    <tr>
      <td width="80" align="right">联系电话：</td>
      <td width="260"><?php echo $r_tel;?>&nbsp;</td>
      <td width="80" align="right">手机号码：</td>
      <td><?php echo $r_mobile;?></td>
    </tr>
    <tr>
      <td width="80" align="right">QQ号码：</td>
      <td><?php echo $r_chat;?>&nbsp;</td>
      <td width="80" align="right">电子邮件：</td>
      <td><?php echo $r_email;?></td>
    </tr>
    <tr>
      <td width="80" align="right">个人主页：</td>
      <td colspan="3"><?php echo $r_url;?>&nbsp;</td>
    </tr>
    <tr>
      <td width="80" align="right">通讯地址：</td>
      <td colspan="3"><?php echo $r_address;?>（<?php echo $r_post;?>）</td>
     </tr>
     <?php }else{?>
     <tr>
      <td colspan="4" id="contact">
      <font color="red">注意：只有付费下载的简历才能查看到联系方式！</font> <input type="button" name="but4" value="我要查看联系方式" class="inputs" onclick="Contact(<?php echo $r_id;?>,1);" /></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="4" align="center"><input type="button" name="but1" value="打印简历" class="inputs" onclick="window.print();" />
        
        <input type="button" name="but2" value="下载word文件" class="inputs" onclick="window.open('company_resumeview.php?rid=<?php echo $r_id;?>&do=doc');" />
        
        <input type="button" name="but3" value="关闭窗口" class="inputs" onclick="window.close();" /></td>
    </tr>
    </table>
  </td>
</tr>
</table>
</body>
</html>