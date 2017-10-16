<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='addsearch'){
    $sqladd='';
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
    $comname = empty($comname) ? '' :cleartags($comname);
    $comname!=''&&$sqladd.=" and h_comname like '%$comname%'";
    if($sqladd==''){
        showmsg('请设置搜索器相关选项，2秒后返回到搜索器添加页面！',"-1",0,2000);exit();
    }else{
        $sqladd=addslashes($sqladd);
    }
    $title = empty($title) ? '' :cleartags($title);
    $cycle = empty($cycle) ? 0 :intval($cycle);
    $email = empty($email) ? '' :cleartags($email);
    $number = empty($number) ? 5 :intval($number);
    if($title==''||$email==''){
        showmsg('数据不完整，2秒后返回到搜索器添加页面！',"-1",0,2000);exit();
    }else{
        $db ->query("INSERT INTO {$cfg['tb_pre']}mail (m_title,m_content,m_cycle,m_member,m_email,m_number,m_adddate,m_update,m_type) VALUES('$title','$sqladd','$cycle','$username','$email','$number',NOW(),NOW(),1)");
        showmsg('添加成功！',"?mpage=person_addsearch&show=$show",0,2000);exit();
    }
}elseif($do=='delsearch'){
    $mid=intval($mid);
    $db->query("delete from {$cfg['tb_pre']}mail where m_member='$username' and m_id=$mid");
    showmsg('删除成功！',"?mpage=person_addsearch&show=$show",0,2000);exit();
}elseif($t=='addform'){
    $rs = $db->get_one("select m_email from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
    if($rs){
        $useremail=$rs['m_email'];
    }
    $tabtit='定义职位搜索器';
}else{
    $rsdb=array();
    $sql="select m_id,m_update,m_title,m_cycle,m_senddate from {$cfg['tb_pre']}mail where m_member='$username' order by m_update desc limit 0,6";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $tabtit='职位搜索器列表';
}

?>
<div class="memrightl">
    <div class="memrighttit"><span></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
     <?php if($t=='addform'){?>
    <script language="javascript">
		function check()
		{
			if (document.addform.title.value=="")
			{
				alert("请输入搜索器名称");
				document.addform.title.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="addform" id="addform" action="index.php?do=addsearch&mpage=person_addsearch&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">搜索器名称：</li>
            <li class="r"><input name="title" type="text" id="title" value="" /></li>
            <li class="l">全职/兼职：</li>
            <li class="r"><input type=radio value=1 name="usergroup">全职<input type=radio value=2 name="usergroup">兼职<input name="usergroup" type=radio value=3 checked >全职、兼职均可</li>
            <li class="l">职位关键字：</li>
            <li class="r"><input name="place" type="text" id="place" value="" /> 建议输入简短的关键字，以提高搜索效果。</li>
            <li class="l">单位名称关键字：</li>
            <li class="r"><input name="comname" type="text" id="comname" value="" /></li>
            <li class="l">招聘单位所在行业：：</li>
            <li class="r"><input type="hidden" name="trade" id="trade" ><input name="trades" type="button" onClick="JumpSearchLayer(4,'addform','trade','trades');" id="trades" value="选择单位所在行业" size="60" class="search_case" /></li>
            <li class="l">职位类别：</li>
            <li class="r"><input type="hidden" name="position" id="position" ><input name="positions" type="button" onClick="JumpSearchLayer(1,'addform','position','positions');" id="positions" value="选择职位类别" size="60" class="search_case" /></li>
            <li class="l">工作地点：</li>
            <li class="r"><input name="workadd" type="hidden" id="workadd" /><input name="workadds" type="button" onClick="JumpSearchLayer(5,'addform','workadd','workadds');" id="workadds" value="选择工作地点" size="60" class="search_case" /></li>
            <li class="l">专业要求：</li>
            <li class="r"><input name="profession" type="hidden" id="profession" /><input name="professions" type="button" onClick="JumpSearchLayer(3,'addform','profession','professions');" id="professions" value="选择专业要求" size="60" class="search_case" /></li>
            <li class="l">发布日期：</li>
            <li class="r"><select name=datetime size=1 id="select9" style="FONT-SIZE: 12px; WIDTH: 100px; FONT-FAMILY: 宋体">
                <option value=0 selected>不限</option>
                <option value=1>1天内</option>
                <option value=3>3天内</option>
                <option value=7>一周内</option>
                <option value=15>半月内</option>
                <option value=30>一个月内</option>
                <option value=90>三个月内</option>
                <option value=183>半年内</option>
                <option value=366>一年内</option>
        </select></li>
        <li class="l">招聘单位性质：</li>
            <li class="r"><select name="ecoclass" size=1 id="ecoclass" style="font-size:12px; width:100px; font-family:宋体">
                    <option value="">选择单位性质</option>
                    <?php echo getother('ecoclass','e','e_id asc','',1);?>
                    </select></li>
        <li class="l">薪资待遇：</li>
            <li class="r"><select name="pay" size=1 style="font-size:12px; width:100px; font-family:宋体">
        <option value="" selected>选择薪资范围</option>
		<option value="800以下">800以下</option>
		<option value="800～1000">800～1000</option>
		<option value="1000～1200">1000～1200</option>
		<option value="1200～1500">1200～1500</option>
		<option value="1500～2000">1500～2000</option>
		<option value="2000～2500">2000～2500</option>
		<option value="2500～3000">2500～3000</option>
		<option value="3000～4000">3000～4000</option>
		<option value="4000～6000">4000～6000</option>
		<option value="6000～9000">6000～9000</option>
		<option value="9000～12000">9000～12000</option>
		<option value="12000～15000">12000～15000</option>
		<option value="15000～20000">15000～20000</option>
		<option value="20000以上">20000以上</option>
      </select>
      元 包括面议</li>
            <li class="l">学历要求：</li>
            <li class="r"><select name="edu1" style="font-size:12px; width:100px; font-family:宋体" >
                <option value="" selected>不限</option>
                <?php echo getother('edu','e','e_id asc',0);?>
                </select>
                &nbsp;&nbsp;~&nbsp;&nbsp;
                <select name="edu2" style="font-size:12px; width:100px; font-family:宋体" >
                <option value="" selected>不限</option>
                <?php echo getother('edu','e','e_id asc',0);?>
                </select>
                </li>
            <li class="l">经验要求：</li>
            <li class="r"><select name="experience1" size=1 id="experience1" style="font-size:12px; width:100px; font-family:宋体">
                <option value="" selected>不限</option>
                <option value=-1>在读学生</option>
                <option value=0>毕业生</option>
                <?php
             	for($i=1;$i<=10;$i++){
					echo "<option value=\"$i\">{$i}年</option>\r\n";
				}
				?>
			</select>
              &nbsp;&nbsp;~&nbsp;&nbsp;
              <select name="experience2" size=1 id="experience2" style="font-size:12px; width:100px; font-family:宋体">
                <option value="" selected>不限</option>
                <?php
             	for($i=1;$i<=10;$i++){
					echo "<option value=\"$i\">{$i}年</option>\r\n";
				}
				?>
                <option value=0>毕业生</option>
                <option value=-1>在读学生</option>
              </select></li>
            <li class="l">性别要求：</li>
            <li class="r"><select style="font-size:12px; width:100px; font-family:宋体" name=sex>
                <option value=0 selected>不限</option>
                <option value=1>男性</option>
                <option value=2>女性</option>
          </select></li>
            <li class="l">年龄要求：</li>
            <li class="r"><select style="font-size:12px; width:100px; font-family:宋体" size=1 name=age>
                <option value=0 selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\">{$i}</option>\r\n";
				}
				?>
          </select>
        岁</li>
        <li class="t">您可以E-mail订阅符合以上条件的职位</li>
        <hr />
        <li class="l">发送周期：</li>
            <li class="r"><select name="cycle" size="1" onChange='return cycleClick()' style="width:100px;font-size:9pt">
            <option value="0" selected>不订阅</option>
            <option value="3">每三天一次</option>
            <option value="7">每周一次</option>
            <option value="14">每两周一次</option>
          </select></li>
        <li class="l">E-mail：</li>
            <li class="r"><input name="email" type="text" value="<?php echo $useremail;?>" size="30" maxlength="50" disabled="disabled"></li>
        <li class="l">每次发送的职位数：</li>
            <li class="r"><select name="number" size="1" style="width:100px;font-size:9pt" disabled="disabled">
              <option value="5">5个</option>
              <option value="10">10个</option>
              <option value="15">15个</option>
              <option value="20" selected>20个</option>
              <option value="30">30个</option>
            </select></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="添加搜索器" /></label></li>            
        </ul>
        </form>
        </div>
        <script language="javascript">
        function cycleClick() {
              if (document.addform.cycle.value==0)
              {  
                document.addform.number.disabled=true;
                document.addform.email.disabled=true;
              }
              else
              {  
                document.addform.number.disabled=false;
                document.addform.email.disabled=false;
              }
        }

        </script>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getprovince.js"></script>
        <script language = "JavaScript" src="../js/gettrade.js"></script>
        <script language = "JavaScript" src="../js/getposition.js"></script>
        <script language = "JavaScript" src="../js/getprofession.js"></script>
        <script language="javascript" src="../js/jobjss.js"></script>
        <?php }else{?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
        <td width="5%">编号</td>
          <td width="20%" height="21">搜索器名称</td>
          <td width="17%">发送周期</td>
          <td width="20%">更新时间</td>
          <td width="20%">发送时间</td>
          <td width="6%">搜索</td>
          <td width="6%">修改</td>
          <td width="6%">删除</td>
        </tr>
        <?php
            foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td>$rs[m_id]</td>\r\n";
            echo "          <td height=\"22\">$rs[m_title]</a></td>\r\n";
            if($rs['m_cycle']==0){
                $cycle='不订阅';
            }elseif($rs['m_cycle']==3){
                $cycle='每三天一次';
            }elseif($rs['m_cycle']==7){
                $cycle='每周一次';
            }else{
                $cycle='每两周一次';
            }
            echo "          <td>$cycle</td>\r\n";
            echo "          <td>$rs[m_update]</td>\r\n";
            echo "          <td>$rs[m_senddate]</td>\r\n";
            echo "          <td><a href=\"index.php?mpage=person_searchresult&show=$show&mid=$rs[m_id]\">搜索</a></td>\r\n";
            echo "          <td><a href=\"index.php?mpage=person_addsearch&show=$show&t=addform&mid=$rs[m_id]\">修改</a></td>\r\n";
            echo "          <td><a href=\"javascript:if(confirm('确定要删除吗?'))location.href='index.php?mpage=person_addsearch&show=$show&mid=$rs[m_id]&do=delsearch'\">删除</a></td>\r\n";
            echo "        </tr>\r\n";
            }
            ?>
            <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input name="button" type="button" value="创建搜索器" class="inputs" onClick="location.href='?mpage=person_addsearch&show=3&t=addform';"/></div></td>
        </tr>
      </table>
        <?php }?>
    </div>
</div>