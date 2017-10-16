<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$sqlstr=Array('m_email','m_emailshowflag','m_name','m_licence','m_trade','m_seat','m_fund','m_ecoclass','m_founddate','m_workers','m_introduce','m_tel','m_telshowflag','m_fax','m_mobile','m_mobileshowflag','m_chat','m_url','m_address','m_post','m_contact');
    if($do=='savedata'){
        $name=cleartags($name);
        $c = $db->get_one("select m_name from {$cfg['tb_pre']}member where m_name='$name' and m_login!='$username'");
        if ($c){showmsg('错误：此公司名称已有人使用，请正确填写您的公司名称！','-1');exit();}
        $seat='';
        if(!empty($province)) $seat.=$province.'*';
        if(!empty($capital)) $seat.=$capital.'*';
        if(!empty($city)) $seat.=$city.'*';
        $seat=$seat!=''?substr($seat,0,-1):'';
		$emailshowflag=isset($emailshowflag)?0:1;
		$telshowflag=isset($telshowflag)?0:1;
		$mobileshowflag=isset($mobileshowflag)?0:1;
        $sqls='';
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            if(isset($$s)){
                $s=='introduce'?$sqls.="$v='".replace_strbox($$s)."',":$sqls.="$v='".cleartags($$s)."',";
            }
        }
        $sqls.="m_activedate=NOW()";
        $rs=$db ->query("update {$cfg['tb_pre']}member set $sqls where m_login='$username'");
        if(isset($tb2)&&$tb2==1){
            $tb2str=Array('h_email','h_emailshowflag','h_tel','h_telshowflag','h_fax','h_contact','h_address','h_post');
            $tb2sqls='';
            foreach($tb2str as $v){
                $s=str_replace('h_','',$v);
                if(isset($$s)){
                    $tb2sqls.="$v='".$$s."',";
                }
            }
            $tb2sqls=substr($tb2sqls,0,-1);
            $db ->query("update {$cfg['tb_pre']}hire set $tb2sqls where h_member='$username'");
        }
        _setcookie('user_name',$name,3600*24);
        showmsg("资料更新成功！","?mpage=company_info&show=$show",0,2000);exit();
    }
    $sqls='';
    foreach($sqlstr as $v) $sqls.="$v,";
    $sqls=substr($sqls,0,-1);
    $rs = $db->get_one("select $sqls from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
    if($rs){
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            $$s=$rs[$v];
        }
        if($seat!=''){
            $seats=explode("*",$seat);
            $province=$seats[0];$capital=$seats[1];$city=$seats[2];
        }
    }else{
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            $$s='';
        }
        $province=$capital=$city='';
    }
    if($cfg['createhtml']==1) echo "<script src=\"{$cfg['path']}autohtml.php?do=company&id=$Memberid\"></script>";
?>
<script type="text/javascript">
$.validator.addMethod("iszipcode", function(value, element) {    
	var tel = /^[0-9]{6}$/;
	return this.optional(element) || (tel.test(value));});
$.validator.methods.istel=function(value, element) {    
	var tel = /^[0-9\s+.-]+$/;
	return this.optional(element) || (tel.test(value));}
$.validator.methods.isbirth=function(value, element) {  
today = new Date(); 
var birtha=value;
var birthb=birtha.split("-");
if(today.getYear()-12<=birthb[0]){
	return false;
}else{
	return true;
}}
$().ready(function() {
	$("#addform").validate({
		success: function(label) {
			label.text("输入正确!").addClass("success");
		}, 
		rules: {
			name: {required: true,maxlength: 100},
			trade: {required: true},
			city: {required: true},
			ecoclass: {required: true},
			founddate: {dateISO:true},
			fund: {digits:true},
			introduce:{required: true,minlength: 10,maxlength: 8000},
			contact: {required: true,maxlength: 100},
			tel: {required: true,istel:true,maxlength: 100},
			fax: {istel:true,maxlength: 100},
			mobile: {digits:true,rangelength:[10,12]},
			chat: {digits:true},
			url: {url: true},
			address: {maxlength: 100},
			post: "iszipcode"
		},
		messages: {
			name: '请正确填写公司名称，填写后不能修改',
			trade: '请公司所属行业!',
			city: '请选择您的所在地',
			ecoclass: '请选择公司性质!',
			founddate: '请输入有效的成立日期，格式如：2010-05-18',
			fund: '请输入正确的注册资金，必须为整数',
			introduce:'请输入公司介绍，10-8000个字符之间',
			contact: '请输入联系人姓名',
			tel: {required: "联系电话格式如：029-85460076",istel:"联系电话格式如：029-85460076",maxlength: "联系电话长度为100个字符以内"},
			fax: {istel:"传真格式如：029-85460076",maxlength: "联系电话长度为100个字符以内"},
			mobile: '请填写正确的手机或小灵通号码，以便接收短信通知',
			chat: 'QQ号码为数字，请正确填写',
			url: '请输入网址，格式如：<?php echo $cfg['siteurl'];?>',
			address: '通讯地址长度为100个字符以内',
			post: "邮政编码为6位数字"
		}
	});
});
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>修改基本资料</div>
    <div class="memrightbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
    <form method="post" name="addform" id="addform" action="?do=savedata&mpage=company_info&show=<?php echo $show;?>">
        <tr class="memtabhead">
          <td colspan="2">基本资料</td>
        </tr>
        <tr class="memtabmain">
          <td width="120" align="right"><span style="color:#F00">*</span> 公司名称：</td>
          <td><input name="name" type="text" id="name" size="30" maxlength="100" value="<?php echo $name;?>" <?php if($name!='') echo ' readonly="readonly"';?>/>（填写后不能修改，如有变更请联系客服人员。）</td>
      </tr>
        <tr class="memtabmain">
          <td align="right">营业执照：</td>
          <td><input name="licence" type="text" id="licence" title="填写营业执照号或者组织机构代码证号" size="30" value="<?php echo $licence;?>" />(填写营业执照号或者组织机构代码证号)</td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 所属行业：</td>
          <td><select name="trade" size=1 id="trade">
                    <option value="">请选择行业</option>
                    <?php echo getother('trade','t','t_order asc',$trade,1);?>
                    </select></td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 所在地：</td>
          <td><select name="province" size="1" class="t100" id="province" onChange="changeProvince(this.form.province.options[this.selectedIndex].value,this.form,'')">
		<?php if($province!=''){?>
		<option value="<?php echo $province;?>"><?php echo $province;?></option>
		<?php }else{?><option value="">选择省</option><?php }?>
		</select>		
		<select name="capital" id="capital" class="t" onchange="changeCity(this.form.capital.options[this.form.capital.selectedIndex].value,this.form,'')">
		<?php if($capital!=''){?>
		<option value="<?php echo $capital;?>"><?php echo $capital;?></option>
		<?php }else{?><option value="">选择市</option><?php }?>
		</select>
		<select name="city" id="city" class="t">
		<?php if($city!=''){?>
		<option value="<?php echo $city;?>"><?php echo $city;?></option>
		<?php }else{?><option value="">选择区县</option><?php }?>
		</select></td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 公司性质：</td>
          <td><select name="ecoclass" size=1 id="ecoclass">
                    <option value="">请选择公司性质</option>
                    <?php echo getother('ecoclass','e','e_id asc',$ecoclass,1);?>
                    </select></td>
      </tr>
        <tr class="memtabmain">
          <td align="right">成立日期：</td>
          <td><input name="founddate" type="text" id="founddate" onClick="ShowCalendar(this.id)" onFocus="ShowCalendar(this.id)" size="10" value="<?php echo $founddate;?>"/></td>
      </tr>
        <tr class="memtabmain">
          <td align="right">注册资金：</td>
          <td><input type="text" name="fund" size="6" maxlength="6" value="<?php echo $fund;?>"/>万人民币</td>
      </tr>
        <tr class="memtabmain">
          <td align="right">员工人数：</td>
          <td><input type="radio" value="少于50人" name="workers"/ checked="checked">少于50人
                    <input type="radio" value="50-200人" name="workers" <?php if($workers=='50-200人') echo ' checked';?> />50-200人
                    <input type="radio" value="200-500人" name="workers" <?php if($workers=='200-500人') echo ' checked';?> />200-500人
                    <input type="radio" value="500-1000人" name="workers" <?php if($workers=='500-1000人') echo ' checked';?> />500-1000人
        <input type="radio" value="1000人以上" name="workers" <?php if($workers=='1000人以上') echo ' checked';?> />1000人以上</td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 公司简介：</td>
          <td><textarea name="introduce" cols="60" rows="8" id="introduce"><?php echo change_strbox($introduce);?></textarea></td>
      </tr>
        <tr class="memtabhead">
          <td colspan="2">联系方式</td>
        </tr>
        <tr class="memtabmain">
          <td align="right">通讯地址：</td>
          <td><input name=address id="address" size="30" maxlength="100" value="<?php echo $address;?>" /></td>
      </tr>
        <tr class="memtabmain">
          <td align="right">邮政编码：</td>
          <td><input name=post id="post" size="6" maxlength="6" value="<?php echo $post;?>" /></td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 联 系 人：</td>
          <td><input name=contact id="contact" size="20" maxlength="25" value="<?php echo $contact;?>" /></td>
      </tr>
        <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 联系电话：</td>
          <td><input name=tel id="tel" size="30" maxlength="100" value="<?php echo $tel;?>" /><br />
          <input id="telshowflag" type="checkbox" value="0" name="telshowflag" <?php if($telshowflag==0) echo ' checked';?> />
屏蔽联系电话<br />
（如果您不想在公司简介中显示联系电话，请选择此项，系统将隐藏您的联系电话）</td>
      </tr>
        <tr class="memtabmain">
          <td align="right"> 手机号码：</td>
          <td><input name=mobile id="mobile" size="20" maxlength="20" value="<?php echo $mobile;?>"><br />
<input id="mobileshowflag" type="checkbox" value="0" name="mobileshowflag" <?php if($mobileshowflag==0) echo ' checked';?> />
屏蔽手机号码</td>
      </tr>
      <tr class="memtabmain">
          <td align="right"><span style="color:#F00">*</span> 电子邮件：</td>
          <td><input name="email" type="text" id="email" size="20" maxlength="100" value="<?php echo $email;?>" readonly="readonly" />不可修改<br />
        <input name="emailshowflag" type="checkbox" id="emailshowflag" value="0" <?php if($emailshowflag==0) echo ' checked';?> />
屏蔽电子邮件<br />
（如果您不想在公司简介中显示电子邮件，请选择此项，系统将隐藏您的电子邮件）</td>
      </tr>
        <tr class="memtabmain">
          <td align="right">传&nbsp;&nbsp;&nbsp; 真：</td>
          <td><input name=fax id="fax" size="30" maxlength="100" value="<?php echo $fax;?>" /></td>
      </tr>
        <tr class="memtabmain">
          <td align="right">QQ号码：</td>
          <td><input name=chat id="chat" size="20" maxlength="20" value="<?php echo $chat;?>" /></td>
      </tr>
        <tr class="memtabmain">
          <td align="right">公司主页：</td>
          <td><input name=url id="url" size="30" maxlength="100" value="<?php echo $url;?>" /></td>
      </tr>
      <tr class="memtabmain">
          <td align="right">&nbsp;</td>
          <td><input name="tb2" type="checkbox" value="1" checked="checked" />
          同步更新所有招聘信息中的联系方式<br />
（选中此选项后,所有贵公司发布的招聘信息中的联系方式也将同时更改为此联系方式。）</td>
      </tr>
        <tr class="memtabmain">
          <td align="right">&nbsp;</td>
          <td><input name="submit" type="submit" class="submit" value="保存基本资料" /></td>
      </tr>
     </form>
    </table>
   </div>
</div>
<script language = "JavaScript" src="../js/getprovince.js"></script>
<script language = "JavaScript">
function changeProvince(selvalue,form,str){	
	if(str=='hukou'){
		form.hukoucapital.length=0; 
		form.hukoucity.length=0;
	}else{
		form.capital.length=0; 
		form.city.length=0;
	}
	var selvalue=selvalue;	  
	var j,d,mm,f=0;
    selvalues='';
	d=0;
	for(j=0;j<provArray.length;j++) {
        if(provArray[j][0]==selvalue&&f==0){selvalues=provArray[j][2];f=1;}
		if(provArray[j][1]==selvalues) {
			if (d==0){
			mm=provArray[j][2];
			}
			var newOption2=new Option(provArray[j][0],provArray[j][0]);
			if(str=='hukou'){
				document.getElementById('hukoucapital').options.add(newOption2);
			}else{
				document.getElementById('capital').options.add(newOption2);
			}
			d=d+1;	
		}		
		if(provArray[j][1]==mm) 
		{		
			var newOption3=new Option(provArray[j][0],provArray[j][0]);
			if(str=='hukou'){
				document.getElementById('hukoucity').options.add(newOption3);
			}else{
				document.getElementById('city').options.add(newOption3);
			}
		}			
	}
}
function changeCity(selvalue,form,str) { 
	if(str=='hukou'){form.hukoucity.length=0;}else{form.city.length=0;} 
	var selvalue=selvalue;
	var j,d,f=0;
    selvalues='';
	for(j=0;j<provArray.length;j++) 
	{
        if(provArray[j][0]==selvalue&&f==0){selvalues=provArray[j][2];f=1;}
        if(provArray[j][1]==selvalues) 
		{
			var newOption4=new Option(provArray[j][0],provArray[j][0]);
			if(str=='hukou'){
				document.getElementById('hukoucity').options.add(newOption4);
			}else{
				document.getElementById('city').options.add(newOption4);
			}
		}
	}
}
function selectprovince(str) { 
var j;
	for(j=0;j<provArray.length;j++) {
		if(provArray[j][1]==0) {
			var newOption4=new Option(provArray[j][0],provArray[j][0]);
            //alert(newOption4);
			if(str=='hukou'){
				document.getElementById('hukouprovince').options.add(newOption4);
			}else{
				document.getElementById('province').options.add(newOption4);
			}
		}
	}
}
selectprovince('');
</script>