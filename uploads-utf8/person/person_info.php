<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$sqlstr=Array('m_email','m_name','m_sex','m_birth','m_cardtype','m_idcard','m_marriage','m_polity','m_hukou','m_seat','m_edu','m_tel','m_mobile','m_chat','m_url','m_address','m_post','m_nameshow','m_qzstate');
    if($do=='savedata'){
        $hukou='';
        if(!empty($hukouprovince)) $hukou.=$hukouprovince.'*';
        if(!empty($hukoucapital)) $hukou.=$hukoucapital.'*';
        if(!empty($hukoucity)) $hukou.=$hukoucity.'*';
        $hukou=$hukou!=''?substr($hukou,0,-1):'';
        $seat='';
        if(!empty($province)) $seat.=$province.'*';
        if(!empty($capital)) $seat.=$capital.'*';
        if(!empty($city)) $seat.=$city.'*';
        $seat=$seat!=''?substr($seat,0,-1):'';
        $sqls='';
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            if(isset($$s)){
                $sqls.="$v='".$$s."',";
            }
        }
        $sqls=substr($sqls,0,-1);
        $rs=$db ->query("update {$cfg['tb_pre']}member set $sqls where m_login='$username'");
        if(isset($tb1)&&$tb1==1){
            $tb1str=Array('r_name','r_sex','r_birth','r_cardtype','r_idcard','r_marriage','r_polity','r_hukou','r_seat','r_edu');
            $tb1sqls='';
            foreach($tb1str as $v){
                $s=str_replace('r_','',$v);
                if(isset($$s)){
                    $tb1sqls.="$v='".$$s."',";
                }
            }
            $tb1sqls=substr($tb1sqls,0,-1);
            $db ->query("update {$cfg['tb_pre']}resume set $tb1sqls where r_member='$username'");
        }
        if(isset($tb2)&&$tb2==1){
            $tb2str=Array('r_adddate','r_email','r_tel','r_mobile','r_chat','r_url','r_address','r_post');
            $tb2sqls='';
            foreach($tb2str as $v){
                $s=str_replace('r_','',$v);
                if(isset($$s)){
                    $tb2sqls.="$v='".$$s."',";
                }
            }
            $tb2sqls=substr($tb2sqls,0,-1);
            $db ->query("update {$cfg['tb_pre']}resume set $tb2sqls where r_member='$username'");
        }        
        showmsg('资料更新成功！',"?mpage=person_info&show=$show",0,2000);exit();
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
        if($hukou!=''){
            $hukous=explode("*",$hukou);
            $hukouprovince=$hukous[0];$hukoucapital=$hukous[1];$hukoucity=$hukous[2];
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
        $hukouprovince=$hukoucapital=$hukoucity=$province=$capital=$city='';
    }
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
if(today.getFullYear()-12<=birthb[0]){
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
			name: {required: true,maxlength: 10},
			birth: {required: true,dateISO:true,isbirth: true},
			idcard: {maxlength: 20},
			city: {required: true},
			edu: {required: true},
			tel: {istel:true,maxlength: 100},
			mobile: {required: true,digits:true,rangelength:[10,12]},
			chat: {digits:true},
			url: {url: true},
			address: {maxlength: 100},
			post: "iszipcode"
		},
		messages: {
			name: '请输入真实姓名',
			birth: {
				required: "出生日期为必填项",
				dateISO: "请输入有效的出生日期，格式如：2010-05-18",
				isbirth: '请输入出生日期,出生日期至今必须大于12年!'
			},
			idcard: '请输入有效证件号码，不能超过20位!',
			city: '请选择您的所在地',
			edu: '请选择您的学历',
			tel: {istel:"联系电话格式如：029-85460076",maxlength: "联系电话长度为100个字符以内"},
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
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="addform" id="addform" action="?do=savedata&mpage=person_info&show=<?php echo $show;?>">
        <ul>
        	<li class="t">基本资料 <span style="color:#F00">*为必填</span></li>
            <hr />
            <li class="l"><span style="color:#F00">*</span> 真实姓名：</li>
            <li class="r"><input name="name" type="text" id="name" maxlength="10" value="<?php echo $name;?>" /></li>
            <li class="l">是否隐藏姓名：</li>
            <li class="r"><input type="radio" value="1" style="width:20px;" name="nameshow" id="nameshow" checked="checked">公开<input type="radio" id="nameshow" value="0" style="width:20px;" name="nameshow" <?php if($nameshow==0) echo " checked=\"checked\"";?>>隐藏（如果您选择隐藏，您的姓名将以您的姓氏开头，加上“先生”或“小姐/女士”的形式显示）</li>
            <li class="l"><span style="color:#F00">*</span> 性&nbsp;&nbsp;&nbsp; 别：</li>
            <li class="r"><input type=radio value=1 style="width:20px;" name=sex id="sex" checked="checked">男<input type=radio id="sex" value=2 style="width:20px;" name=sex <?php if($sex==2) echo " checked=\"checked\"";?>>女</li>
            <li class="l"><span style="color:#F00">*</span> 出生日期：</li>
            <li class="r"><input name="birth" type="text" id="birth" onClick="ShowCalendar(this.id)" onFocus="ShowCalendar(this.id)" value="<?php echo $birth;?>" /></li>
            <li class="l">证件类型：</li>
            <li class="r"><select name=cardtype size=1 id="cardtype" class="t100">
                    <option value=0 <?php if($cardtype==0) echo " selected=\"selected\"";?>>身份证</option>
                    <option value=1 <?php if($cardtype==1) echo " selected=\"selected\"";?>>驾证</option>
                    <option value=2 <?php if($cardtype==2) echo " selected=\"selected\"";?>>军官证</option>
                    <option value=3 <?php if($cardtype==3) echo " selected=\"selected\"";?>>护照</option>
                    <option value=4 <?php if($cardtype==4) echo " selected=\"selected\"";?>>其它</option>
                    </select></li>
            <li class="l">证件编号：</li>
            <li class="r"><input name=idcard id="idcard" value="<?php echo $idcard;?>"></li>
            <li class="l">婚姻状况：</li>
            <li class="r"><select name="marriage" id="marriage" class="t100">
                    <option value="">请选择</option>
                    <?php echo getother('marriage','m','m_id asc',$marriage,1);?>
                    </select></li>
            <li class="l">政治面貌：</li>
            <li class="r"><select name="polity" id="polity"  class="t100">
                    <option value="">请选择</option>
                    <?php echo getother('polity','p','p_id asc',$polity,1);?>
                    </select></li>
            <li class="l">户口所在地：</li>
            <li class="r"><select name="hukouprovince" size="1" class="t100" id="hukouprovince" onChange="changeProvince(this.form.hukouprovince.options[this.selectedIndex].value,this.form,'hukou')">
		<?php if($hukouprovince!=''){?>
		<option value="<?php echo $hukouprovince;?>"><?php echo $hukouprovince;?></option>
		<?php }else{?><option value="">选择省</option><?php }?>
		</select>		
		<select name="hukoucapital" class="t" onchange="changeCity(this.form.hukoucapital.options[this.form.hukoucapital.selectedIndex].value,this.form,'hukou')">
		<?php if($hukoucapital!=''){?>
		<option value="<?php echo $hukoucapital;?>"><?php echo $hukoucapital;?></option>
		<?php }else{?><option value="">选择市</option><?php }?>
		</select>
		<select name="hukoucity" class="t">
		<?php if($hukoucity!=''){?>
		<option value="<?php echo $hukoucity;?>"><?php echo $hukoucity;?></option>
		<?php }else{?><option value="">选择区县</option><?php }?>
		</select></li>
            <li class="l"><span style="color:#F00">*</span> 现所在地：</li>
            <li class="r"><select name="province" size="1" class="t100" id="province" onChange="changeProvince(this.form.province.options[this.selectedIndex].value,this.form,'')">
		<?php if($province!=''){?>
		<option value="<?php echo $province;?>"><?php echo $province;?></option>
		<?php }else{?><option value="">选择省</option><?php }?>
		</select>		
		<select name="capital" class="t" onchange="changeCity(this.form.capital.options[this.form.capital.selectedIndex].value,this.form,'')">
		<?php if($capital!=''){?>
		<option value="<?php echo $capital;?>"><?php echo $capital;?></option>
		<?php }else{?><option value="">选择市</option><?php }?>
		</select>
		<select name="city" class="t">
        <?php if($city!=''){?>
		<option value="<?php echo $city;?>"><?php echo $city;?></option>
		<?php }else{?><option value="">选择区县</option><?php }?>
		</select></li>
            <li class="l"><span style="color:#F00">*</span> 最高学历：</li>
            <li class="r"><select name="edu" id="edu" class="t100">
                    <option value="">请选择</option>
                    <?php echo getother('edu','e','e_id asc',$edu);?>
                    </select></li>
            <li class="l">求职状态：</li>
            <li class="r"><input id="qzstate_0" type="radio" name="qzstate" value="我目前处于求职状态，可立即上岗" checked="checked" /><label for="qzstate_0">我目前处于求职状态，可立即上岗</label><br />
            <input id="qzstate_1" type="radio" name="qzstate" value="我目前在职，正考虑换个新环境（如有合适的工作机会，到岗时间一个月左右）"<?php if($qzstate=='我目前在职，正考虑换个新环境（如有合适的工作机会，到岗时间一个月左右）') echo " checked=\"checked\"";?> /><label for="qzstate_1">我目前在职，正考虑换个新环境（如有合适的工作机会，到岗时间一个月左右）</label><br />
            <input id="qzstate_2" type="radio" name="qzstate" value="我对现有工作还算满意，如有更好的工作机会，我也可以考虑。（到岗时间另议）"<?php if($qzstate=='我对现有工作还算满意，如有更好的工作机会，我也可以考虑。（到岗时间另议）') echo " checked=\"checked\"";?> /><label for="qzstate_2">我对现有工作还算满意，如有更好的工作机会，我也可以考虑。（到岗时间另议）</label><br />
            <input id="qzstate_3" type="radio" name="qzstate" value="我是毕业生，还没有太多工作经验，但我对新工作充满期待与热情，请给我机会！"<?php if($qzstate=='我是毕业生，还没有太多工作经验，但我对新工作充满期待与热情，请给我机会！') echo " checked=\"checked\"";?> /><label for="qzstate_3">我是毕业生，还没有太多工作经验，但我对新工作充满期待与热情，请给我机会！</label><br />
            <input id="qzstate_4" type="radio" name="qzstate" value="目前暂无跳槽打算"<?php if($qzstate=='目前暂无跳槽打算') echo " checked=\"checked\"";?> /><label for="qzstate_4">目前暂无跳槽打算</label></li>
            <li class="l"></li>
            <li class="r"><input name="tb1" type="checkbox" value="1" style="width:20px;" checked="checked" />同步基本资料 选中此选项后,您所填写简历中的基本资料都将同时更改为此基本资料。</li>
        </ul>
        <ul>
        	<li class="t">联系方式</li>
        	<hr />
            <li class="l">联系电话：</li>
            <li class="r"><input name=tel id="tel" value="<?php echo $tel;?>" /></li>
            <li class="l"><span style="color:#F00">*</span> 手机号码：</li>
            <li class="r"><input name=mobile id="mobile" value="<?php echo $mobile;?>" /></li>
            <li class="l"><span style="color:#F00">*</span> 电子邮件：</li>
            <li class="r"><input name="email" type="text" id="email" value="<?php echo $email;?>" readonly="readonly" />不可修改</li>
            <li class="l">聊天号码：</li>
            <li class="r"><input name=chat id="chat" value="<?php echo $chat;?>" /></li>
            <li class="l">个人主页：</li>
            <li class="r"><input name=url id="url" value="<?php echo $url;?>" /></li>
            <li class="l">通讯地址：</li>
            <li class="r"><input name=address id="address" value="<?php echo $address;?>" /></li>
            <li class="l">邮政编码：</li>
            <li class="r"><input name=post id="post" value="<?php echo $post;?>" /></li>
            <li class="l"></li>
            <li class="r"><input name="tb2" type="checkbox" value="1" style="width:20px;" checked="checked" />同步联系方式 选中此选项后,您所填写简历中的联系方式都将同时更改为此联系方式。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="保存基本资料" /></label></li>            
        </ul>
        </form>
        </div>
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
selectprovince('hukou');
selectprovince('');
</script>