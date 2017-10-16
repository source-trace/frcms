<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
    $rsdb=array();
    $sqladd='';
    $mid = empty($mid) ? 0 :intval($mid);
    if($mid!=0){
        $rs = $db->get_one("select m_content from {$cfg['tb_pre']}mail where m_id=$mid limit 0,1");
        if($rs){
            $sqladd=$rs['m_content'];
        }else{
            showmsg('该搜索器不存在，返回搜索器列表！',"?mpage=person_addsearch&show=$show",0,2000);exit();
        }
    }else{
        $usergroup = empty($usergroup) ? '' :intval($usergroup);
        if($usergroup!=3&&$usergroup!=0){
            $sqladd.=" and h_type=$usergroup";
        }
    	$position = empty($position) ? '' :cleartags($position);
        if($position!=''){
            $sqladd.=" and (";
            $positions=explode(',',hireposition($position));
            foreach($positions as $key){
                $sqladd.="h_position like '%$key%' or ";
            }
            if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
            $sqladd.=")";
        }
    	$profession = empty($profession) ? '' :cleartags($profession);
        if($profession!=''){
            $sqladd.=" and (";
            $professions=explode(',',hireprofession($profession));
            foreach($professions as $key){
                $sqladd.="h_profession like '%$key%' or ";
            }
            if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
            $sqladd.=")";
        }
        $workadd = empty($workadd) ? '' :cleartags($workadd);
        if($workadd!=''){
            $sqladd.=" and (";
            $workadds=explode(',',hireworkadd($workadd));
            foreach($workadds as $key){
                $sqladd.="h_workadd like '%$key%' or ";
            }
            if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
            $sqladd.=")";
        }
        $trade = empty($trade) ? '' :cleartags($trade);
        if($trade!=''){
            $sqladd.=" and (";
            $trades=explode(',',hiretrade($trade));
            foreach($trades as $key){
                $sqladd.="h_trade like '%$key%' or ";
            }
            if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
            $sqladd.=")";
        }
        $datetime = empty($datetime) ? '' :intval($datetime);
        $datetime!=''&&$sqladd.=" and DATEDIFF('".date('Y-m-d')."',h_adddate)<=$datetime";
        $edu1 = empty($edu1) ? '' :intval($edu1);
        $edu1!=''&&$sqladd.=" and h_edu>=$edu1";
        $edu2 = empty($edu2) ? '' :intval($edu2);
        $edu2!=''&&$sqladd.=" and h_edu<=$edu2";
        $experience1 = empty($experience1) ? '' :intval($experience1);
        $experience1!=''&&$sqladd.=" and h_experience>=$experience1";
        $experience2 = empty($experience2) ? '' :intval($experience2);
        $experience2!=''&&$sqladd.=" and h_experience<=$experience2";
        $sex = empty($sex) ? 0 :intval($sex);
        $sex!=0&&$sqladd.=" and h_sex=$sex";
        $age = empty($age) ? 0 :intval($age);
        $age!=0&&$sqladd.=" and h_age1<=$age and h_age2>=$age";
        $ecoclass = empty($ecoclass) ? '' :intval($ecoclass);
        $ecoclass!=''&&$sqladd.=" and m_ecoclass=$ecoclass";
        $pay = empty($pay) ? '' :addhirepay($pay);
        if($pay!=''){
            switch($pay){
    		case 1:$sqladd.=" and ((h_pay<=800 and h_pay>=15) or h_pay=0 or h_pay=1)";break;
            case 2:$sqladd.=" and ((h_pay<=1000 and h_pay>=800) or h_pay=0 or h_pay=2)";break;
            case 3:$sqladd.=" and ((h_pay<=1200 and h_pay>=1000) or h_pay=0 or h_pay=3)";break;
            case 4:$sqladd.=" and ((h_pay<=1500 and h_pay>=1200) or h_pay=0 or h_pay=4)";break;
            case 5:$sqladd.=" and ((h_pay<=2000 and h_pay>=1500) or h_pay=0 or h_pay=5)";break;
            case 6:$sqladd.=" and ((h_pay<=2500 and h_pay>=2000) or h_pay=0 or h_pay=6)";break;
            case 7:$sqladd.=" and ((h_pay<=3000 and h_pay>=2500) or h_pay=0 or h_pay=7)";break;
            case 8:$sqladd.=" and ((h_pay<=4000 and h_pay>=3000) or h_pay=0 or h_pay=8)";break;
            case 9:$sqladd.=" and ((h_pay<=6000 and h_pay>=4000) or h_pay=0 or h_pay=9)";break;
            case 10:$sqladd.=" and ((h_pay<=9000 and h_pay>=6000) or h_pay=0 or h_pay=10)";break;
            case 11:$sqladd.=" and ((h_pay<=12000 and h_pay>=9000) or h_pay=0 or h_pay=11)";break;
            case 12:$sqladd.=" and ((h_pay<=15000 and h_pay>=12000) or h_pay=0 or h_pay=12)";break;
            case 13:$sqladd.=" and ((h_pay<=20000 and h_pay>=15000) or h_pay=0 or h_pay=13)";break;
            case 14:$sqladd.=" and (h_pay>=20000 or h_pay=0 or h_pay=14)";break;
            }
        }
        $place = empty($place) ? '' :cleartags($place);
        $place!=''&&$sqladd.=" and h_place like '%$place%'";
        $introduce = empty($introduce) ? '' :cleartags($introduce);
        $introduce!=''&&$sqladd.=" and h_introduce like '%$introduce%'";
        $comname = empty($comname) ? '' :cleartags($comname);
        $comname!=''&&$sqladd.=" and h_comname like '%$comname%'";
        $comid = empty($comid) ? '' :intval($comid);
        $comid!=''&&$sqladd.=" and h_comid=$comid";
        $id = empty($id) ? '' :intval($id);
        $id!=''&&$sqladd.=" and h_id=$id";
    }
    $sql="select h_id,h_adddate,h_place,h_number,h_enddate,h_workadd,h_comname,m_id,m_regdate,m_name from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login where m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and h_status=1 $sqladd order by h_adddate desc";
    $counts = $db->counter("{$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login","m_flag=1 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 and h_status=1 $sqladd",'CACHE');
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"?sid=$sid",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>职位搜索结果</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <tr class="memtabhead">
          <td height="21" colspan="8" style="text-align:left">搜索条件：<font color="#FF0000"><?php echo hireposition($position,1,1);?></font></td>
        </tr>
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">职位名称</td>
          <td width="24%">单位名称</td>
          <td width="18%">工作地点</td>
          <td width="8%">招聘人数</td>
          <td width="10%">更新时间</td>
          <td width="10%">截至时间</td>
          <td width="10%">操作</td>
          <td width="5%"><input name="checkSelect" type="checkbox" class="checkbox" onClick="javascript: checkAll(this)" value="checkbox"></td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
        echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
        echo "          <td height=\"22\" align=\"left\"><a href=\"".formatlink($rs["h_adddate"],2,3,$rs["h_id"],0)."\" target=\"_blank\">".str_replace($place,"<font color=\"red\">$place</font>",$rs["h_place"])."</a></td>\r\n";
        echo "          <td align=\"left\"><a href=\"".formatlink($rs["m_regdate"],2,1,$rs["m_id"],0)."\" target=\"_blank\">".str_replace($comname,"<font color=\"red\">$comname</font>",$rs["h_comname"])."</a></td>\r\n";
        echo "          <td>".xreplace($rs["h_workadd"],1)."</td>\r\n";
        echo "          <td>".hirenumber($rs["h_number"])."</td>\r\n";
        echo "          <td>".dtime(strtotime($rs["h_adddate"]),3)."</td>\r\n";
        echo "          <td>$rs[h_enddate]</td>\r\n";
        echo "          <td><input name=\"button\" type=\"button\" value=\"申请职位\" class=\"inputs\" onClick=\"location.href='?a=hire&mpage=person_resumesend&show=$show&checks=$rs[h_id]'\"/></td>\r\n";
        echo "          <td><input type=\"checkbox\" name=\"hid\" value=\"$rs[h_id]\" class=\"checkbox\" /></td>\r\n";
        echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name="Input2" type="button" value="申请选中的职位" class="inputs" onClick="confirmX(1);" /> 
        <input name="Input3" type="button" value="放入收藏夹" class="inputs" onClick="confirmX(2);" /> </div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        <tr class="memtabmain">
          <td height="21" colspan="8" style="text-align:left">1、本次查询到 <?php echo $counts;?> 个 <font color="#FF0000"><?php echo hireposition($position,1,1);?></font> 类职位。<br />
2、为避免重复设定查询条件，建议使用“<a href="?mpage=person_addsearch&show=3">自定义职位搜索器</a>”，将设置保存起来重复利用。</td>
        </tr>
      </table>
    </div>
</div>
<script language="javascript">
function confirmX(num)
{
	var ids = document.getElementsByName("hid");
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
				document.form.checks.value = allSel;
				check=true;
				
			}
		}
		if(check==false){alert("请选择操作对象！");return false;}
	}
	if(num==1)
	{
		document.form.action="?a=hire&mpage=person_resumesend&show=<?php echo $show;?>";
		document.form.submit();
	}
	if(num==2)
	{
		document.form.action="?do=favorite&mpage=person_favoriteadd&show=<?php echo $show;?>";
		document.form.submit();
	}
	return false;	
}
function checkAll(box1) {
    var ids = document.getElementsByName("hid");
	if (ids != null) {
		for (i=0; i<ids.length; i++) {
			var obj = ids[i];
			obj.checked = box1.checked;
		}
	}
}
</script>