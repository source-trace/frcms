<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$rsdb=array();
$numberss=isset($numberss)?intval($numberss):20;
$numbers=isset($numbers)?intval($numbers):$numberss;
if($numbers==0) $numbers=20;
$taxiss=isset($numberss)?intval($taxiss):1;
$taxis=isset($taxis)?intval($taxis):$taxiss;
if($taxis==0) $taxis=1;
$item1=isset($item1)?(intval($item1)?intval($item1):0):0;
$item2=isset($item2)?(intval($item2)?intval($item2):0):0;
$item3=isset($item3)?(intval($item3)?intval($item3):0):0;
$item4=isset($item4)?(intval($item4)?intval($item4):0):0;
$item5=isset($item5)?(intval($item5)?intval($item5):0):0;
$sqlstr='';$sqljoin='';
$mid = empty($mid) ? 0 :intval($mid);
if($mid!=0){
    $rs = $db->get_one("select m_content from {$cfg['tb_pre']}mail where m_id=$mid limit 0,1");
    if($rs){
        $sqlstr=$rs['m_content'];
    }else{
        showmsg('该搜索器不存在，返回搜索器列表！',"?mpage=company_addsearch&show=$show",0,2000);exit();
    }
}else{
    if($usergroup==0&&$usergroup!=''){
        $sqlstr.=" and r_usergroup=0";
    }elseif($usergroup==1){
        $sqlstr.=" and r_usergroup=1";
    }elseif($usergroup==2){
        $sqlstr.=" and r_usergroup=2";
    }
    if($trade!=''&&$trade!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hiretrade($trade));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_trade like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqlstr.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($position!=''&&$position!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hireposition($position));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_position like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqlstr.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($workadd!=''&&$workadd!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hireworkadd($workadd));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_workadd like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqlstr.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($datetime!=''&&is_numeric($datetime)) $sqlstr.=" and DATEDIFF('".date('Y-m-d')."',r_adddate)<=$datetime";
    if($edu1!=''&&is_numeric($edu1)) $sqlstr.=" and r_edu>=$edu1";
    if($edu2!=''&&is_numeric($edu2)) $sqlstr.=" and r_edu<=$edu2";
    if($sex!=''&&is_numeric($sex)){
        if($sex==1) $sqlstr.=" and r_sex=1";
        if($sex==2) $sqlstr.=" and r_sex=2";
    }
    if($age1!=''&&is_numeric($age1)) $sqlstr.=" and DATEDIFF(r_birth,".date('Y-m-d',strtotime(date('Y-m-d')."-$age1 year")).")>=0";
    if($age1!=''&&is_numeric($age1)) $sqlstr.=" and DATEDIFF(".date('Y-m-d',strtotime(date('Y-m-d')."-$age2 year")).",r_birth)>=0";
    if($name!='') $sqlstr.=" and r_name like '%$name%'";
    $keyword = empty($keyword) ? '' :cleartags($keyword);
    if($keyword!='') $sqlstr.=" and (r_position like '%$keyword%' or r_appraise like '%$keyword%' or r_name like '%$keyword%' or r_request like '%$keyword%' or r_title like '%$keyword%')";
    $id = empty($id) ? '' :intval($id);
    $id!=''&&$sqlstr.=" and r_id=$id";
    $seat = empty($seat) ? '' :cleartags($seat);
    if($seat!=''){
    $sqlstr.=" and (";
    $seats=explode(',',hireworkadd($seat));
    foreach($seats as $key){
    $sqlstr.="r_seat like '%$key%' or ";
    }
    if(substr($sqlstr,-3)=='or ') $sqlstr=substr($sqlstr,0,-4);
    $sqlstr.=")";
    }
    $school = empty($school) ? '' :cleartags($school);
    if($school!=''){
        $sqlstr.=" and (e_school like '%$school%' or r_school like '%$school%')";
        $sqljoin=" LEFT JOIN {$cfg['tb_pre']}education on r_id=e_rid";
    }
    if($profession!=''&&$profession!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hireprofession($profession));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or e_profession like '%$mystring[$i]%' or r_zhicheng like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqlstr.=" and (".substr($sqlstrt,4).")";
            $sqljoin=" LEFT JOIN {$cfg['tb_pre']}education on r_id=e_rid";
        }
    }
    $comname = empty($comname) ? '' :cleartags($comname);
    if($comname!=''){
        $sqlstr.=" and w_comname like '%$comname%'";
        $sqljoin=" LEFT JOIN {$cfg['tb_pre']}work on r_id=w_rid";
    }
    $place = empty($place) ? '' :cleartags($place);
    if($place!=''){
        $sqlstr.=" and w_place like '%$place%'";
        $sqljoin=" LEFT JOIN {$cfg['tb_pre']}work on r_id=w_rid";
    }
    $introduce = empty($introduce) ? '' :cleartags($introduce);
    if($introduce!=''){
        $sqlstr.=" and w_introduce like '%$introduce%'";
        $sqljoin=" LEFT JOIN {$cfg['tb_pre']}work on r_id=w_rid";
    }
}
if(isset($t)&&$t==1){$usergroup=2;}else{$usergroup=$usergroup?2:'';}
$strfilename="index.php?mpage=company_searchresult&show=$show&numberss=$numbers&taxiss=$taxis&usergroup=$usergroup&item1=$item1&item2=$item2&item3=$item3&item4=$item4&item5=$item5&position=$position&workadd=$workadd&seat=$seat&name=$name&id=$id&introduce=$introduce&comname=$comname&place=$place&school=$school&profession=$profession&keyword=$keyword";
$pagesize=$numbers;$sqladd='';
$sql="select r_id,r_adddate,r_name,r_position,r_edu,r_sex,r_pay,r_appraise,r_jobtype,r_workadd from {$cfg['tb_pre']}resume LEFT JOIN {$cfg['tb_pre']}member on r_mid=m_id $sqljoin where ";
$sqladd.=" r_cnstatus=1 and r_openness=0 and m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 $sqlstr";
if($item1) $sqladd.=" and r_sex=$item1";
if($item2) $sqladd.=" and r_edu=$item2";
if($item3&&$item3!=3) $sqladd.=" and r_jobtype=$item3";
if($item4){
    switch($item4){
		case 1:$sqladd.=" AND (`r_pay` between 15 and 800 OR `r_pay`=1)";break;
        case 2:$sqladd.=" AND (`r_pay` between 800 and 1000 OR `r_pay`=2)";break;
        case 3:$sqladd.=" AND (`r_pay` between 1000 and 1200 OR `r_pay`=3)";break;
        case 4:$sqladd.=" AND (`r_pay` between 1200 and 1500 OR `r_pay`=4)";break;
        case 5:$sqladd.=" AND (`r_pay` between 1500 and 2000 OR `r_pay`=5)";break;
        case 6:$sqladd.=" AND (`r_pay` between 2000 and 2500 OR `r_pay`=6)";break;
        case 7:$sqladd.=" AND (`r_pay` between 2500 and 3000 OR `r_pay`=7)";break;
        case 8:$sqladd.=" AND (`r_pay` between 3000 and 4000 OR `r_pay`=8)";break;
        case 9:$sqladd.=" AND (`r_pay` between 4000 and 6000 OR `r_pay`=9)";break;
        case 10:$sqladd.=" AND (`r_pay` between 6000 and 9000 OR `r_pay`=10)";break;
        case 11:$sqladd.=" AND (`r_pay` between 9000 and 12000 OR `r_pay`=11)";break;
        case 12:$sqladd.=" AND (`r_pay` between 12000 and 15000 OR `r_pay`=12)";break;
        case 13:$sqladd.=" AND (`r_pay` between 15000 and 20000 OR `r_pay`=13)";break;
        case 14:$sqladd.=" AND (`r_pay`>=20000 OR `r_pay`=14)";break;
    }
}
if($item5) $sqladd.=" and DATEDIFF('".date('Y-m-d')."',r_adddate)<=$item5";
if($usergroup==2) $sqladd.=" and r_usergroup=2";
$sql.=$sqladd;
if($taxis==1){$sql.=" order by r_adddate desc";}
if($taxis==2){$sql.=" order by r_adddate asc";}
if($taxis==3){$sql.=" order by r_visitnum desc";}
$counts = $db->counter("{$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id $sqljoin","$sqladd");
$page= isset($_GET['page'])?$_GET['page']:1;//默认页码
$getpageinfo = page($page,$counts,"$strfilename",$pagesize,5);
$sql.=$getpageinfo['sqllimit'];
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
    $rsdb[]=$row;
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>简历查询结果</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?mpage=company_newresume&show=<?php echo $show;?>&numberss=<?php echo $numbers;?>&taxiss=<?php echo $taxiss;?>&usergroup=<?php echo $usergroup;?>&page=<?php echo $page;?>" method="post">
        <tr class="memtabhead" align="center">
          <td width="7%" height="21">编号</td>
          <td width="6%" height="21">姓名</td>
          <td width="18%">意向职位</td>
          <td width="18%">意向工作地</td>
          <?php
          $newresumelist=" <td width=\"8%\"><select name=\"item1\" size=\"1\" style=\"width:60px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>性别</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item1==1)  $newresumelist.="selected";
$newresumelist.=">男</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item1==2)  $newresumelist.="selected";
$newresumelist.=">女</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"8%\"><select name=\"item2\" size=\"1\" style=\"width:60px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>学历</option>\r\n";
$newresumelist.=getother('edu','e','e_id asc',$item2);
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"10%\"><select name=\"item3\" size=\"1\" style=\"width:80px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>职位类别</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item3==1)  $newresumelist.="selected";
$newresumelist.=">全职</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item3==2)  $newresumelist.="selected";
$newresumelist.=">兼职</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item3==3)  $newresumelist.="selected";
$newresumelist.=">不限</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"12%\"><select name=\"item4\" size=\"1\" style=\"width:90px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>期望月薪</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item4==1)  $newresumelist.="selected";
$newresumelist.=">800以下</option>\r\n";
$newresumelist.="<option value=\"2\"";
if($item4==2)  $newresumelist.="selected";
$newresumelist.=">800～1000</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item4==3)  $newresumelist.="selected";
$newresumelist.=">1000～1200</option>\r\n";
$newresumelist.="<option value=\"4\"";
if($item4==4)  $newresumelist.="selected";
$newresumelist.=">1200～1500</option>\r\n";
$newresumelist.="<option value=\"5\"";
if($item4==5)  $newresumelist.="selected";
$newresumelist.=">1500～2000</option>\r\n";
$newresumelist.="<option value=\"6\"";
if($item4==6)  $newresumelist.="selected";
$newresumelist.=">2000～2500</option>\r\n";
$newresumelist.="<option value=\"7\"";
if($item4==7)  $newresumelist.="selected";
$newresumelist.=">2500～3000</option>\r\n";
$newresumelist.="<option value=\"8\"";
if($item4==8)  $newresumelist.="selected";
$newresumelist.=">3000～4000</option>\r\n";
$newresumelist.="<option value=\"9\"";
if($item4==9)  $newresumelist.="selected";
$newresumelist.=">4000～6000</option>\r\n";
$newresumelist.="<option value=\"10\"";
if($item4==10)  $newresumelist.="selected";
$newresumelist.=">6000～9000</option>\r\n";
$newresumelist.="<option value=\"11\"";
if($item4==11)  $newresumelist.="selected";
$newresumelist.=">9000～12000</option>\r\n";
$newresumelist.="<option value=\"12\"";
if($item4==12)  $newresumelist.="selected";
$newresumelist.=">12000～15000</option>\r\n";
$newresumelist.="<option value=\"13\"";
if($item4==13)  $newresumelist.="selected";
$newresumelist.=">15000～20000</option>\r\n";
$newresumelist.="<option value=\"14\"";
if($item4==14)  $newresumelist.="selected";
$newresumelist.=">20000以上</option>\r\n";
$newresumelist.="</select></td>\r\n";

$newresumelist.=" <td width=\"10%\"><select name=\"item5\" size=\"1\" style=\"width:90px;\" onchange=\"document.form.submit();\">\r\n";
$newresumelist.="<option value=\"0\" selected>更新时间</option>\r\n";
$newresumelist.="<option value=\"1\"";
if($item5==1)  $newresumelist.="selected";
$newresumelist.=">今天</option>\r\n";
$newresumelist.="<option value=\"3\"";
if($item5==3)  $newresumelist.="selected";
$newresumelist.=">三天内</option>\r\n";
$newresumelist.="<option value=\"7\"";
if($item5==7)  $newresumelist.="selected";
$newresumelist.=">一周内</option>\r\n";
$newresumelist.="<option value=\"15\"";
if($item5==15)  $newresumelist.="selected";
$newresumelist.=">半月内</option>\r\n";
$newresumelist.="<option value=\"30\"";
if($item5==30)  $newresumelist.="selected";
$newresumelist.=">一月内</option>\r\n";
$newresumelist.="</select></td>\r\n";
echo $newresumelist;
?>
          <td width="3%"><input name="checkSelect" type="checkbox" class="checkbox" onclick="javascript: checkAll(this)" value="checkbox"></td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "          <td height=\"22\"><a href=\"".formatlink($rs["r_adddate"],1,1,$rs["r_id"],0)."\" target=\"_blank\">$rs[r_id]</a>&nbsp;</td>\r\n";
        echo "          <td align=\"left\"><a href=\"".formatlink($rs["r_adddate"],1,1,$rs["r_id"],0)."\" target=\"_blank\" title=\"".change_strbox($rs['r_appraise'])."\">$rs[r_name]</a>&nbsp;</td>\r\n";
        echo "          <td align=\"left\"><a href=\"".formatlink($rs["r_adddate"],1,1,$rs["r_id"],0)."\" target=\"_blank\">".xreplace($rs["r_position"],1)."</a>&nbsp;</td>\r\n";
        echo "          <td>".xreplace($rs["r_workadd"],1)."&nbsp;</td>\r\n";
        echo "          <td>".hiresex($rs['r_sex'])."&nbsp;</td>\r\n";
        echo "          <td>".hireedu($rs['r_edu'])."&nbsp;</td>\r\n";
        echo "          <td>".hiretype($rs['r_jobtype'])."&nbsp;</td>\r\n";
        echo "          <td>".hirepay($rs['r_pay'])."&nbsp;</td>\r\n";
        echo "          <td>".dtime(strtotime($rs["r_adddate"]),3)."&nbsp;</td>\r\n";
        echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[r_id]\" class=\"checkbox\" /></td>\r\n";
        echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="10"><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        <tr class="memtabpage">
          <td height="21" colspan="10"><div class="memtabdiv"><input type="hidden" name="checks" value="">
           
        每页显示<select name="numbers" size="1" style="z-index:0" onchange="javascript:window.location='<?php echo joinchar($strfilename);?>numbers='+this.options[this.selectedIndex].value;">
        <option value="10" <?php if($numbers==10) echo 'selected'; ?>>10条</option>
        <option value="20" <?php if($numbers==20) echo 'selected'; ?>>20条</option>
        <option value="50" <?php if($numbers==50) echo 'selected'; ?>>50条</option>
        </select>
        <select name="taxis" size="1" onchange="javascript:window.location='<?php echo joinchar($strfilename);?>taxis='+this.options[this.selectedIndex].value;">
        <option value="1" <?php if($taxis==1) echo 'selected'; ?>>按发布时间降序</option>
        <option value="2" <?php if($taxis==2) echo 'selected'; ?>>按发布时间升序</option>
        <option value="3" <?php if($taxis==3) echo 'selected'; ?>>按关注度排序</option>
        </select>
        <input name="Input2" type="button" value="发送面试邀请" class="inputs" onClick="confirmX(1);" /> 
        <input name="Input3" type="button" value="放入人才库" class="inputs" onClick="confirmX(2);" /></div></td>
        </tr>
        </form>
      </table>
    </div>
</div>
<script language="javascript">
function confirmX(num)
{
	var ids = document.getElementsByName("id");
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
				form.checks.value = allSel;
				check=true;
				
			}
		}
		if(check==false){alert("请选择操作对象！");return false;}
	}
	if(num==1)
	{
		document.form.action="?a=resume&mpage=company_interviewsend&show=1";
		document.form.submit();
	}
	if(num==2)
	{
		document.form.action="?do=myexpert&mpage=company_myexpert&show=1";
		document.form.submit();
	}
	return false;	
}
function checkAll(box1) {
    var ids = document.getElementsByName("id");
	if (ids != null) {
		for (i=0; i<ids.length; i++) {
			var obj = ids[i];
			obj.checked = box1.checked;
		}
	}
}
</script>