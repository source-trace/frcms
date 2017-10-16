<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if(_getcookie('user_name')==''){
    echo "<script language=javascript>alert('暂不能进行此操作,请先完整填写基本资料！马上进入基本资料管理页面完善资料！');location.href='?mpage=company_info&show=0';</script>";
    exit();
}
$sqlstr=Array('h_id','h_place','h_number','h_sex','h_type','h_trade','h_position','h_dept','h_workadd','h_pay','h_introduce','h_usergroup','h_profession',
			  'h_edu','h_experience','h_age1','h_age2','h_comname','h_address','h_post','h_contact','h_tel','h_telshowflag','h_fax',
			  'h_email','h_emailshowflag','h_enddate'); 
if($do=='savedate'){
	$id=$id?intval($id):'';
	$pay=intval(addhirepay($pay));$ip=getip();
    $emailshowflag=isset($emailshowflag)?0:1;
	$telshowflag=isset($telshowflag)?0:1;
	$place=cleartags($place);$comname=cleartags($comname);$email=cleartags($email);$contact=cleartags($contact);$tel=cleartags($tel);
	if($place==''||$comname==''||$email==''){showmsg('职位名称、单位名称、电子邮箱不能为空，2秒后返回修改！',"-1",0,2000);exit();}
	if($dept=='') $dept="无";
    if(!empty($position)) $position=hireposition($position);
    if(!empty($workadd)) $workadd=hireworkadd($workadd);
    if(!empty($profession)) $profession=hireprofession($profession);
	//判断职位是否已经发布
	if($id!=''){
		$rs = $db->get_one("SELECT `h_place` FROM `{$cfg['tb_pre']}hire` WHERE `h_member`='$username' AND `h_place`='$place' AND `h_dept`='$dept' AND h_id!=$id LIMIT 0,1");
	}else{
		$rs = $db->get_one("SELECT `h_place` FROM `{$cfg['tb_pre']}hire` WHERE `h_member`='$username' AND `h_place`='$place' AND `h_dept`='$dept' LIMIT 0,1");
	}
	if($rs){showmsg('该职位您已经发布过了！同一部门的同一职位不允许重复发布。2秒后返回修改！',"-1",0,2000);exit();}
    $vhire&&$db ->query("INSERT INTO {$cfg['tb_pre']}vhire (v_place,v_number,v_comname,v_contact,v_tel,v_address,v_request,v_validity,v_adddate,v_ip,v_flag) VALUES('$place','$number','$comname','$contact','$tel','$address','$introduce','10',NOW(),'$ip',1)");
	if($id!=''){
        $sqls='';
        foreach($sqlstr as $v){
            $s=str_replace('h_','',$v);
            if(isset($$s)){
                if($s=='introduce'){$sqlss="'".replace_strbox($$s)."'";}else{$sqlss="'".cleartags($$s)."'";}
                $sqls.="$v=$sqlss,";
            }
        }
        $regcArray[4]==1&&$sqls.='h_status=0,';
        $sqls=substr($sqls,0,-1);
        $db ->query("UPDATE `{$cfg['tb_pre']}hire` SET $sqls,h_adddate=NOW() WHERE h_member='$username' and h_id=$id");
        $db->query("update {$cfg['tb_pre']}member set m_activedate=NOW() where m_login='$username'");
		showmsg("职位编辑成功！<br /><a href=?mpage=company_hirelist&show=$show>2秒后返回职位管理页面</a>","?mpage=company_hirelist&show=$show",0,2000);exit();
    }else{
		if (!$Glimit[0]){showmsg('您所在的会员组不能发布职位信息，请联系网站客服进行升级！2秒后进入服务申请页面！',"?mpage=company_service&show=4",0,2000);exit();}
        if ($Glimit[1]&&$Mhirenum<=0){showmsg('您发布的职位信息已达到最大限制,请联系网站客服进行升级！马上进入服务申请页面！',"?mpage=company_service&show=4",0,2000);exit();}
        $sqls=$sqlss='';
        foreach($sqlstr as $v){
            $s=str_replace('h_','',$v);
            if(isset($s)){
                $sqls.="$v,";
				if($s=='introduce'){$sqlss.="'".replace_strbox($$s)."',";}else{$sqlss.="'".cleartags($$s)."',";}
            }
        }
        $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
		$flag=$regcArray[4]==1?0:1;
        $sqls.=",h_member,h_comid,h_status,h_adddate";$sqlss.=",'$username','$Memberid','$flag',NOW()";
        $db ->query("INSERT INTO {$cfg['tb_pre']}hire ($sqls) VALUES($sqlss)");
		//不存在的部门自动增加
		if ($dept!="无"){
			$rsd = $db->get_one("select d_name from {$cfg['tb_pre']}dept where d_cmember='$username' and d_name='$dept' limit 0,1");
			if(!$rsd){$db ->query("INSERT INTO {$cfg['tb_pre']}dept (d_name,d_principal,d_email,d_cmember) VALUES('$dept','$contact','$email','$username')");}
		}
        $hirenum=$db->counter("{$cfg['tb_pre']}hire","h_comid=$Memberid and h_status=1 and DATEDIFF(h_enddate,'".date('Y-m-d')."')>=0");
		//更新发布职位的数量
		if ($Glimit[1]==0){
			$db ->query("update {$cfg['tb_pre']}member set m_hirenums=m_hirenums+1,m_ishire=$hirenum,m_activedate=NOW() where m_id=$Memberid");
		}else{
			$db ->query("update {$cfg['tb_pre']}member set m_hirenums=m_hirenums+1,m_hirenum=m_hirenum-1,m_ishire=$hirenum,m_activedate=NOW() where m_id=$Memberid");
		}
        $integral=$Gintegral[0];
		require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($Memberid,"发布职位【{$place}】获得积分+$integral",$integral);
		showmsg("职位添加成功！<br /><a href=?mpage=company_hirelist&show=$show&t=addform>继续添加</a><br /><a href=?mpage=company_hirelist&show=$show>2秒后返回职位管理页面</a>","?mpage=company_hirelist&show=$show",0,2000);exit();
    }
}elseif($do=='del'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $db->query("delete from {$cfg['tb_pre']}hire where h_member='$username' and h_id in($checks)");
    showmsg('删除成功！',"?mpage=company_hirelist&show=$show",0,2000);exit();
}elseif($do=='refresh'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $db->query("update {$cfg['tb_pre']}hire set h_adddate=NOW() where h_member='$username' and h_id in($checks)");
    $db->query("update {$cfg['tb_pre']}member set m_activedate=NOW() where m_login='$username'");
    showmsg('刷新成功！',"?mpage=company_hirelist&show=$show",0,2000);exit();
}elseif($do=='republish'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $db->query("update {$cfg['tb_pre']}hire set h_adddate=NOW(),h_enddate='".date('Y-m-d',strtotime(date('Y-m-d')."+30 day"))."' where h_member='$username' and h_id in($checks)");
    $db->query("update {$cfg['tb_pre']}member set m_activedate=NOW() where m_login='$username'");
    showmsg('重新发布成功！',"?mpage=company_hirelist&show=$show",0,2000);exit();
}elseif($do=='activate'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $db->query("update {$cfg['tb_pre']}hire set h_status=1 where h_status=2 and h_member='$username' and h_id in($checks)");
    $db->query("update {$cfg['tb_pre']}member set m_activedate=NOW() where m_login='$username'");
    showmsg('激活成功！',"?mpage=company_hirelist&show=$show",0,2000);exit();
}elseif($do=='deactivate'){
    $checks = preg_replace("/[^0-9,\.-]/i",'',$checks);
    $db->query("update {$cfg['tb_pre']}hire set h_status=2 where h_status=1 and h_member='$username' and h_id in($checks)");
    $db->query("update {$cfg['tb_pre']}member set m_activedate=NOW() where m_login='$username'");
    showmsg('屏蔽成功！',"?mpage=company_hirelist&show=$show",0,2000);exit();
}elseif($t=='addform'||$t=='clone'){
    $tabtit='发布职位';
	$id=$id?intval($id):'';
	if($id==''||$t=='clone'){
		if (!$Glimit[0]){
            echo "<script language=javascript>alert('您所在的会员组不能发布职位信息,请联系网站客服进行升级！马上进入服务申请页面！');location.href='?mpage=company_service&show=4';</script>";
			exit();
        }
        if ($Glimit[1]&&$Mhirenum<=0){
            echo "<script language=javascript>alert('您发布的职位信息已达到最大限制,请联系网站客服进行升级！马上进入服务申请页面！');location.href='?mpage=company_service&show=4';</script>";
			exit();
        }
	}
    if($id!=''){
		$rs = $db->get_one("select * from {$cfg['tb_pre']}hire where h_member='$username' and h_id=$id limit 0,1");
		if($rs){
			foreach($sqlstr as $v){
				$s=str_replace('h_','',$v);
				$$s=$rs[$v];
			}
		}
		if($t=='clone'){$id='';$place='';}
	}else{
        $id='';$sqls='';
        $sqlstr=Array('m_email','m_emailshowflag','m_name','m_trade','m_seat','m_tel','m_telshowflag','m_fax','m_address','m_post','m_contact');
        foreach($sqlstr as $v) $sqls.="$v,";
        $sqls=substr($sqls,0,-1);
        $rss = $db->get_one("select $sqls from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            $$s=$rss[$v];
        }
        $comname=$name;$enddate=date('Y-m-d',strtotime(date('Y-m-d')."+3 month"));$workadd=$seat;$experience=-100;
    }
}else{
    $rsdb=array();
    $sql="select h_id,h_dept,h_place,h_enddate,DATEDIFF(h_enddate,'".date('Y-m-d')."') as enddate,h_status,h_comm,h_commstart,h_commend,DATEDIFF(h_commend,'".date('Y-m-d')."') as commend,h_visitcount,h_receiveresume,h_adddate from {$cfg['tb_pre']}hire where h_member='$username' order by h_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"index.php?mpage=company_hirelist&show=$show",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $tabtit='招聘职位管理';
    $hirenum=$db->counter("{$cfg['tb_pre']}hire","h_member='$username' and h_status=1 and DATEDIFF(h_enddate,'".date('Y-m-d')."')>=0");
    $db->query("update {$cfg['tb_pre']}member set m_ishire=$hirenum,m_activedate=NOW() where m_id=$Memberid");
}

?>
<div class="memrightl">
    <div class="memrighttit"><span><a href="?mpage=company_hirelist&show=<?php echo $show;?>&t=addform">添加职位</a></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
     <?php if($t=='addform'||$t=='clone'){?>
	  <script type="text/javascript">
		$.validator.methods.istel=function(value, element) {    
			var tel = /^[0-9\s+.-]+$/;
			return this.optional(element) || (tel.test(value));}
        $().ready(function() {
            $("#addform").validate({
                success: function(label) {
                    label.text("输入正确!").addClass("success");
                }, 
                rules: {
                    place: {required: true,maxlength: 50},
					trade: {required: true},
					position: {required: true},
					workadd: {required: true},
					number: {required: true,number:true},
					enddate: {required: true,dateISO:true},
                    comname: {required: true,maxlength: 200},
					contact: {required: true,maxlength: 20},
                    email: {required: true,email: true,maxlength: 100},
                    tel: {istel:true,maxlength: 100}
                },
                messages: {
                    place: '请输入应聘的职位名称,50个字符以内',
					trade: '必选',
					position: '必选',
					workadd: '必选',
					number: '必填，必须为数字',
					enddate: '必填，格式如：2010-05-18',
                    comname: "请输入完整的单位名称",
					contact: "必填，20个字符以内",
                    email: {
						required: "E-mail地址为必填项",
						email: "请填写有效的E-mail地址"
					},
                    tel: {istel:"联系电话格式如：029-85460076",maxlength: "联系电话长度为100个字符以内"}
                }
            });
        });
        </script>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form method="post" name="addform" id="addform" action="index.php?do=savedate&mpage=company_hirelist&show=<?php echo $show;?>">
        <tr class="memtabhead">
        <td height="21" colspan="2">职位描述：</td>
        </tr>
        <tr class="memtabmain">
        <td width="140" align="right"><input name="id" type="hidden" value="<?php echo $id;?>" /><span style="color:#F00">*</span> 招聘类别：</td>
          <td height="21"><input type="radio" value="1" name="type"  checked />全职
                <input type="radio" value="2" name="type" <?php if($type==2) echo ' checked';?> />兼职
                <input type="radio" value="3" name="type" <?php if($type==3) echo ' checked';?> />全职、兼职均可</td>
        </tr>
         <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 招聘职位：</td>
          <td height="21"><input name="place" type="text" id="place" size="30" maxlength="50" value="<?php echo $place;?>" <?php if($id) echo "readonly";?> />
      （填写后不能修改，如有变更请联系客服人员。）</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">招聘部门：</td>
          <td height="21"><input type="text" name="dept" size="10" value="<?php echo $dept;?>" />
    <select name="depttemp" size="1" onChange="dept.value=this.value" style="width: 120px">
      <option value="" selected="selected">选择现有部门</option>
      <?php
        	$sql="select d_name from {$cfg['tb_pre']}dept where d_cmember='$username'";
            $query=$db->query($sql);
            while($row=$db->fetch_array($query)){
        		echo "<option value=\"$row[d_name]\">$row[d_name]</option>\r\n";
            }
        ?>
    </select>
&nbsp;如果您尚未添加部门，请直接在文本框中输入部门名称。</td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 所属行业：</td>
          <td height="21"><select name="trade" size=1 id="trade">
                    <option value="">请选择行业</option>
                    <?php echo getother('trade','t','t_order asc',$trade,1);?>
                    </select></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 岗位类别：</td>
          <td height="21"><input type="hidden" name="position" id="position" value="<?php echo hireposition($position,0,0,1);?>" ><input name="positions" type="text" onClick="JumpSearchLayer(1,'addform','position','positions');" value="<?php if($position){echo csysnames($position);}else{echo "选择岗位类别";}?>" size="60" id="positions" readonly /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right" class="tdcolor"><span style="color:#F00">*</span> 工作地区：</td>
          <td height="21"><input name="workadd" type="hidden" id="workadd" value="<?php echo hireworkadd($workadd,0,0,1);?>" /><input name="workadds" type="text" onClick="JumpSearchLayer(5,'addform','workadd','workadds');" id="workadds"  value="<?php if($workadd){echo csysnames($workadd);}else{echo "选择工作地区";}?>" size="60" readonly /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 招聘人数：</td>
          <td height="21"><input name="number" id="number" size="6" maxlength="5" value="<?php echo $number;?>" />
      人 （注：0为若干人）</td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 月薪待遇：</td>
          <td height="21"><input name="pay" id="pay" size=10 value="<?php echo ahirepay($pay);?>">
                <select name="paytemp" onChange="pay.value=this.value">
                        <option value="" selected>请选择薪资范围</option>
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
                   元 （注：0表示面议，按新法规建议您输入固定值或者选择薪资范围。）</td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 截止日期：</td>
          <td height="21"><input type="text" name="enddate" value="<?php echo $enddate;?>" id="enddate" size="10" maxlength="10" onClick="ShowCalendar(this.id)" readonly /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 具体描述：</td>
          <td height="21"><textarea id="introduce" name="introduce" rows="10" cols="80"><?php echo change_strbox($introduce);?></textarea>
言简意赅地阐述职位具体要求。</td>
        </tr>
        <tr class="memtabhead">
        <td height="21" colspan="2">对应聘者要求：</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">人才类型：</td>
          <td height="21"><input id="usergroup" type=radio checked value=0 name="usergroup">
      普通 <input id="usergroup" type=radio <?php if($usergroup==1) echo ' checked';?> value=1 name=usergroup>
      毕业生 
      <input id="usergroup" type=radio <?php if($usergroup==2) echo ' checked';?> value=2 name=usergroup>高级人才</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">专业要求：</td>
          <td height="21"><input type="hidden" name="profession" id="profession" value="<?php echo hireprofession($profession,0,0,1);?>" ><input name="professions" type="text" onClick="JumpSearchLayer(3,'addform','profession','professions');" value="<?php if($profession){echo csysnames($profession);}else{echo "选择专业要求";}?>" size="60" id="professions" readonly /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">学&nbsp; &nbsp;&nbsp;历：</td>
          <td height="21"><select name="edu">
          <option value="0" selected>不限</option>
			<?php echo getother('edu','e','e_id asc',$edu);?>
            </select> 或以上</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">工作经验：</td>
          <td height="21"><select name="experience" size=1 id="experience" style="font-size:12px; width:100px; font-family:宋体">
                <option value="-100" selected>不限</option>
                <option value="-1" <?php if($experience==-1) echo ' selected="selected"';?>>在读学生</option>
                <option value="0" <?php if($experience==0) echo ' selected="selected"';?>>毕业生</option>
                <?php
             	for($i=1;$i<=10;$i++){
					echo "<option value=\"$i\" ";
					if($experience==$i) echo " selected";
					echo ">{$i}年</option>\r\n";
				}
				?>
			</select> 或以上</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">性&nbsp;&nbsp;&nbsp;&nbsp;别：</td>
          <td height="21"><select name=sex size=1>
                <option value=0 selected>不限</option>
                <option value=1 <?php if($sex==1) echo ' selected="selected"';?>>男性</option>
                <option value=2 <?php if($sex==2) echo ' selected="selected"';?>>女性</option>
                </select></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">年&nbsp;&nbsp;&nbsp; 龄：</td>
          <td height="21"><select style="width:60px;" size=1 name="age1">
                <option value=0 selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\" ";
					if($age1==$i) echo " selected";
					echo ">{$i}岁</option>\r\n";
				}
				?>
          </select>
          至
          <select style="width:60px;" size=1 name="age2">
                <option value=0 selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\" ";
					if($age2==$i) echo " selected";
					echo ">{$i}岁</option>\r\n";
				}
				?>
          </select></td>
        </tr>
        <tr class="memtabhead">
        <td height="21" colspan="2">单位联系方式：</td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 公司名称：</td>
          <td height="21"><input name="comname" type="text" id="comname" value="<?php echo $comname;?>" size="38" maxlength="50" readonly /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">通讯地址：</td>
          <td height="21"><input name="address" type="text" size="38" maxlength="50" value="<?php echo $address;?>" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">邮&nbsp;&nbsp;&nbsp; 编：</td>
          <td height="21"><input name="post" id="post" size="6" maxlength="6" value="<?php echo $post;?>" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 联 系 人：</td>
          <td height="21"><input name="contact" id="contact" size="28" maxlength="25" value="<?php echo $contact;?>" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 联系电话：</td>
          <td height="21"><input name="tel" type="text" id="tel" size="38" maxlength="100" value="<?php echo $tel;?>" />
 <br />
<input id="telshowflag" type="checkbox" value="0" name="telshowflag" <?php if($telshowflag==0) echo ' checked';?> />
<font color="#000000">合则约见，谢绝来电（如果您不想告知求职者联系电话，请选择此项，系统将隐藏您的联系电话。）</font></td>
        </tr>
        <tr class="memtabmain">
        <td align="right">传&nbsp;&nbsp;&nbsp; 真：</td>
          <td height="21"><input name="fax" type="text" id="fax" size="38" maxlength="100" value="<?php echo $fax;?>" /></td>
        </tr>
        <tr class="memtabmain">
        <td align="right"><span style="color:#F00">*</span> 电子邮件：</td>
          <td height="21"><input maxlength="100" size="38" name="email" value="<?php echo $email;?>" />
      <br />
      <input name="emailshowflag" type="checkbox" id="emailshowflag" value=0 <?php if($emailshowflag==0) echo ' checked';?> />
屏蔽电子邮件 （求职者看不到电子邮箱地址，但仍能在线发送简历到该职位的电子邮箱，这样可以在不公开你邮箱地址的同时仍然可以进行招聘。）</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">微招聘：</td>
          <td height="21"><input name="vhire" type="checkbox" id="vhire" value="1" />
自动生成微招聘</td>
        </tr>
        <tr class="memtabmain">
        <td align="right">&nbsp;</td>
          <td height="21"><input name="submit" type="submit" class="submit" value="发 布" />&nbsp;
    <input name="Reset" type="reset" class="submit" value="重 置" /></td>
        </tr>
        </form>
        </table>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
<script language = "JavaScript" src="../js/getprovince.js"></script>
<script language = "JavaScript" src="../js/gettrade.js"></script>
<script language = "JavaScript" src="../js/getposition.js"></script>
<script language = "JavaScript" src="../js/getprofession.js"></script>
<script language="javascript" src="../js/jobjss.js"></script>
<?php }else{?>
<?php
if(empty($rsdb)){
echo "        <div class=\"memts\">\r\n";
echo "        <li><font color=\"#FF0000\"><b>温馨提示：</b></font>目前还没有发布职位，可以通过“<a href=\"?mpage=company_hirelist&show=$show&t=addform\">发布职位</a>”来发布单位的招聘职位!</li>\r\n";
echo "        </div>\r\n";
}?>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
<form name="form" action="" method="post">
<tr class="memtabhead" align="center">
<td width="5%" height="21">编号</td>
  <td width="10%">招聘部门</td>
  <td width="15%">招聘职位</td>
  <td width="15%">状态</td>
  <td width="10%">浏览次数</td>
  <td width="10%">收到简历</td>
  <td width="20%">起止日期</td>
  <td width="5%">修改</td>
  <td width="5%">复制</td>
  <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
</tr>
<?php
	foreach($rsdb as $key=>$rs){
	echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
	echo "          <td height=\"22\">$rs[h_id]</td>\r\n";
	echo "          <td>$rs[h_dept]&nbsp;</a></td>\r\n";
	echo "          <td><a href=\"".formatlink($rs["h_adddate"],2,3,$rs["h_id"],0)."\" target=\"_blank\">$rs[h_place]</a></td>\r\n";
	echo "          <td>";
	if($rs['enddate']<0){
		echo "<font color=\"#ff0000\">已经过期</font>";
	}else{
		if($rs['h_status']==0){
			echo "<font color=\"#cccccc\">等待审核</font>";
		}elseif($rs['h_status']==1){
			echo "<font color=\"#008000\">正在招聘</font>";
		}else{
			echo "<font color=\"#808080\">暂时屏蔽</font>";
		}
	}
	if($rs['h_comm']==1&&$rs['commend']>=0) echo "&nbsp;<font color=red>已推荐</font>";
    if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=hire&id=$rs[h_id]\"></script>";
	echo "</td>\r\n";
	echo "          <td>$rs[h_visitcount]</td>\r\n";
	echo "          <td><a href=\"?mpage=company_works&show=$show&hid=$rs[h_id]\" title=\"点击查看该职位收到的应聘简历！\">$rs[h_receiveresume]</a></td>\r\n";
	echo "          <td>".dtime(strtotime($rs['h_adddate']),3)."~$rs[h_enddate]</td>\r\n";
	echo "          <td><a href=\"?mpage=company_hirelist&show=$show&t=addform&id=$rs[h_id]\">修改</a></td>\r\n";
	echo "          <td><a href=\"?mpage=company_hirelist&show=$show&t=clone&id=$rs[h_id]\">复制</a></td>\r\n";
	echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[h_id]\"></td>\r\n";
	echo "        </tr>\r\n";
	}
    if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=hires&id=$Memberid\"></script>";
	?>
	<tr class="memtabpage">
  <td height="21" colspan="10"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp;
<input name="Submit" type="button" class="inputs" value="发布职位" onclick="javascript:window.location='?mpage=company_hirelist&show=<?php echo $show;?>&t=addform'" />
<input name="Submit" type="button" class="inputs" value="删 除" onclick="confirmX(1);" />
<!--刷新职位-->
<input name="Submit4" type="button" class="inputs" value="刷新职位" onclick="confirmX(2);" />
<!--重新发布-->
<input name="Submit5" type="button" class="inputs" value="重新发布" onclick="confirmX(3);" />
<!--激活职位-->
<input name="Submit2" type="button" class="inputs" value="激 活" onclick="confirmX(4);" />
<!--屏蔽职位-->
<input name="Submit3" type="button" class="inputs" value="屏 蔽" onclick="confirmX(5);" /></div><?php echo $getpageinfo['pagecode'];?></td>
</tr>
</form>
</table>
<div class="memts">
<li><font color="#FF0000"><b>温馨提示：</b></font></li>
<li><font color="#000000">“<strong>删除</strong>”</font><font color="#333333">即对已经招聘完成，以后不再需要招聘的职位彻底进行删除。</font></li>
<li><font color="#333333"><font color="#000000">“<strong>刷新职位</strong>”</font>更新职位的发布日期，能将职位排到网站搜索结果的前面，提高招聘效果； </font></li>
<li><font color="#000000">“<strong>重新发布</strong>”</font><font color="#333333">即对已经过期的职位重新进行招聘。招聘有效期自动改为30天（以当天为开始日期）；</font></li>
<li><font color="#000000">“<strong>激活</strong>”</font><font color="#333333">即对已经屏蔽的职位重新进行招聘。</font></li>
<li><font color="#000000">“<strong>屏蔽</strong>”</font><font color="#333333">即隐藏暂时不需要招聘的职位，以后如果需要招聘时再激活该职位即可。（建议使用）</font></li>
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
		if(confirm("您真的要删除选中的招聘信息吗？")==true)
		{
			document.form.action="?do=del&mpage=company_hirelist&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==2)
	{
		document.form.action="?do=refresh&mpage=company_hirelist&show=<?php echo $show;?>";
		document.form.submit();
	}
	if(num==3)
	{
		if(confirm("重新发布选中的招聘信息后，这些信息会有更多机会被求职者浏览!")==true)
		{
			document.form.action="?do=republish&mpage=company_hirelist&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==4)
	{
		if(confirm("激活选中的招聘信息后，使这些信息重新有效!")==true)
		{
			document.form.action="?do=activate&mpage=company_hirelist&show=<?php echo $show;?>";
			document.form.submit();
		}
	}
	if(num==5)
	{
		if(confirm("屏蔽选中的招聘信息后，使这些信息无效并对求职者不可见!")==true)
		{
			document.form.action="?do=deactivate&mpage=company_hirelist&show=<?php echo $show;?>";
			document.form.submit();
		}
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
        <?php }?>
    </div>
</div>