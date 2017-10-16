<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
set_time_limit(1800);
defined('IN_FR') or exit('Access Denied');
@session_start();
$_SESSION["sUploadDir"]="person/";
$sqlstr=Array('r_usergroup','r_openness','r_title','r_chinese','r_english','r_cnstatus','r_enstatus',
    'r_name','r_sex','r_birth','r_cardtype','r_idcard','r_nation','r_polity','r_marriage','r_height','r_weight',
    'r_hukou','r_seat','r_edu','r_tel','r_mobile','r_chat','r_email','r_url','r_address','r_post',
    'r_sumup','r_appraise','r_jobtype','r_trade','r_position','r_workadd','r_pay','r_stay','r_workdate','r_request',
    'r_visitnum','r_member','r_adddate','r_flag','r_school','r_graduate','r_zhicheng','r_template','r_ability','r_mid');
if($do=='savedate'){
    $rid=intval($rid);
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
    if(!empty($trade)) $trade=hiretrade($trade);
    if(!empty($position)) $position=hireposition($position);
    if(!empty($workadd)) $workadd=hireworkadd($workadd);
    $pay=addhirepay($pay);
    if($rid!=0){
        $sqls='';
        foreach($sqlstr as $v){
            $s=str_replace('r_','',$v);
            if(isset($$s)){
                if($s=='appraise'||$s=='request'||$s=='ability'){$sqlss="'".replace_strbox($$s)."'";}else{$sqlss="'".cleartags($$s)."'";}
                $sqls.="$v=$sqlss,";
            }
        }
        $sqls=substr($sqls,0,-1);
        $db ->query("update {$cfg['tb_pre']}resume set $sqls,r_personinfo=1,r_careerwill=1,r_adddate=NOW() where r_mid=$Memberid and r_id=$rid");
    }else{
        $sqls=$sqlss='';$member=$username;$chinese=1;$mid=$Memberid;
        foreach($sqlstr as $v){
            $v=str_replace('r_','',$v);
            if(isset($$v)){
                $sqls.="r_$v,";
                if($v=='appraise'||$v=='request'||$v=='ability'){$sqlss.="'".replace_strbox($$v)."',";}else{$sqlss.="'".cleartags($$v)."',";}
            }
        }
        $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
        $sqls.=",r_personinfo,r_careerwill";$sqlss.=",1,1";
        $db ->query("INSERT INTO {$cfg['tb_pre']}resume ($sqls) VALUES($sqlss)");
        $rid=$db ->insert_id();
        $db ->query("update {$cfg['tb_pre']}member set m_resumenums=m_resumenums+1 where m_id=$Memberid and m_typeid=1");
        $integral=$Gintegral[3];
		require_once(FR_ROOT.'/inc/paylog.inc.php');
		upintegral($Memberid,"新增加一份简历获得积分+$integral",$integral);
    }
    if ($step==0){
        $db ->query("update {$cfg['tb_pre']}resume set r_cnstatus=0 where r_mid=$Memberid");
        $db ->query("update {$cfg['tb_pre']}resume set r_cnstatus=1 where r_mid=$Memberid and r_id=$rid");
    }
    //更新及添加
    //edu添加
    $esqlstr=array('e_startyear','e_startmonth','e_endyear','e_endmonth','e_school','e_profession','e_edu','e_detail','e_adddate','e_pmember','e_rid','e_language');
    $eid='';$edunum = preg_replace("/[^0-9,\.-]/i",'',$edunum);
    $e_school = empty($e_school) ? array() : $e_school;
    $t_count=count($e_school);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($e_school[$i]!=''){
                if ($e_edu[$i]=='') {showmsg('对不起，学历为必选！','-1');exit();}
                if (!is_numeric($e_startyear[$i])) {showmsg('对不起，入学时间为必选！','-1');exit();}
                $sqls=$sqlss='';$e_pmember[$i]=$username;$e_rid[$i]=$rid;
                $profession='';
                if(!empty($mainprofession[$i])) $profession.=$mainprofession[$i].'*';
                if(!empty($subprofession[$i])) $profession.=$subprofession[$i].'*';
                $e_profession[$i]=$profession!=''?substr($profession,0,-1):'';
                foreach($esqlstr as $v){
                    $s=$$v;
                    if(isset($s[$i])){
                        $sqls.="$v,";
                        if($v=='e_detail'){$sqlss.="'".replace_strbox($s[$i])."',";}else{$sqlss.="'".cleartags($s[$i])."',";}
                    }
                }
                $sqls.="e_adddate,";$sqlss.="NOW(),";
                $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
                $db ->query("INSERT INTO {$cfg['tb_pre']}education ($sqls) VALUES($sqlss)");
                $eid.=$db ->insert_id().',';
            }
        }
    }
    $e_schools = empty($e_schools) ? array() : $e_schools;
    $t_count=count($e_schools);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($e_schools[$i]!=''){
                if ($e_edus[$i]=='') {showmsg('对不起，学历为必选！','-1');exit();}
                if (!is_numeric($e_startyears[$i])) {showmsg('对不起，入学时间为必选！','-1');exit();}
                $sqls=$sqlss='';
                $professions='';
                if(!empty($mainprofessions[$i])) $professions.=$mainprofessions[$i].'*';
                if(!empty($subprofessions[$i])) $professions.=$subprofessions[$i].'*';
                $e_professions[$i]=$professions!=''?substr($professions,0,-1):'';
                foreach($esqlstr as $v){
                    $s=$v."s";$s=$$s;
                    if(isset($s[$i])){
                        if($v=='e_detail'){$sqlss.="$v='".replace_strbox($s[$i])."',";}else{$sqlss.="$v='".cleartags($s[$i])."',";}
                    }
                }
                $sqlss.="e_adddate=NOW(),";
                $sqlss=substr($sqlss,0,-1);
                $db ->query("update {$cfg['tb_pre']}education set $sqlss where e_pmember='$username' and e_rid=$rid and e_id=$e_ids[$i]");
            $edunum=str_replace($e_ids[$i].',','',$edunum);
			$eid.=$e_ids[$i].',';
            }
        }
    }
	$r_education=$eid!=''? 1 : 0;
	if($edunum!=''){
		 $edunum=substr($edunum,0,-1);
		 $db ->query("delete from {$cfg['tb_pre']}education where e_pmember='$username' and e_rid=$rid and e_id in ($edunum)");
	}
    
    //training
    $tsqlstr=array('t_startyear','t_startmonth','t_endyear','t_endmonth','t_train','t_address','t_course','t_certificate','t_detail','t_adddate','t_pmember','t_rid','t_language');
    $tid='';$trainnum = preg_replace("/[^0-9,\.-]/i",'',$trainnum);
    $t_train = empty($t_train) ? array() : $t_train;
    $t_count=count($t_train);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($t_train[$i]!=''){
                if ($t_course[$i]=='') {showmsg('对不起，培训课程为必填！','-1');exit();}
                if (!is_numeric($t_startyear[$i])) {showmsg('对不起，参加培训时间为必选！','-1');exit();}
                $sqls=$sqlss='';$t_pmember[$i]=$username;$t_rid[$i]=$rid;
                foreach($tsqlstr as $v){
                    $s=$$v;
                    if(isset($s[$i])){
                        $sqls.="$v,";
                        if($v=='t_detail'){$sqlss.="'".replace_strbox($s[$i])."',";}else{$sqlss.="'".cleartags($s[$i])."',";}
                    }
                }
                $sqls.="t_adddate,";$sqlss.="NOW(),";
                $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
                $db ->query("INSERT INTO {$cfg['tb_pre']}training ($sqls) VALUES($sqlss)");
                $tid.=$db ->insert_id().',';
            }
        }
    }
    $t_trains = empty($t_trains) ? array() : $t_trains;
    $t_count=count($t_trains);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($t_trains[$i]!=''){
                if ($t_courses[$i]=='') {showmsg('对不起，培训课程为必填！','-1');exit();}
                if (!is_numeric($t_startyears[$i])) {showmsg('对不起，参加培训时间为必选！','-1');exit();}
                $sqls=$sqlss='';
                foreach($tsqlstr as $v){
                    $s=$v."s";$s=$$s;
                    if(isset($s[$i])){
                        if($v=='t_detail'){$sqlss.="$v='".replace_strbox($s[$i])."',";}else{$sqlss.="$v='".cleartags($s[$i])."',";}
                    }
                }
                $sqlss.="t_adddate=NOW(),";
                $sqlss=substr($sqlss,0,-1);
                $db ->query("update {$cfg['tb_pre']}training set $sqlss where t_pmember='$username' and t_rid=$rid and t_id=$t_ids[$i]");
            $trainnum=str_replace($t_ids[$i].',','',$trainnum);
			$tid.=$t_ids[$i].',';
            }
        }
    }
	$r_train=$tid!=''? 1 : 0;
	if($trainnum!=''){
		$trainnum=substr($trainnum,0,-1);
		$db ->query("delete from {$cfg['tb_pre']}training where t_pmember='$username' and t_rid=$rid and t_id in ($trainnum)");
	}
   
    
    //lang
    $lsqlstr=array('l_name','l_master','l_adddate','l_pmember','l_rid','l_language');
    $lid='';$langnum = preg_replace("/[^0-9,\.-]/i",'',$langnum);
    $l_name = empty($l_name) ? array() : $l_name;
    $t_count=count($l_name);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($l_name[$i]!=''){
                if ($l_master[$i]=='') {showmsg('对不起，外语掌握程度为必选！','-1');exit();}
                $sqls=$sqlss='';$l_pmember[$i]=$username;$l_rid[$i]=$rid;
                foreach($lsqlstr as $v){
                    $s=$$v;
                    if(isset($s[$i])){
                        $sqls.="$v,";
                        $sqlss.="'".cleartags($s[$i])."',";
                    }
                }
                $sqls.="l_adddate,";$sqlss.="NOW(),";
                $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
                $db ->query("INSERT INTO {$cfg['tb_pre']}lang ($sqls) VALUES($sqlss)");
                $lid.=$db ->insert_id().',';
            }
        }
    }
    $l_names = empty($l_names) ? array() : $l_names;
    $t_count=count($l_names);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($l_names[$i]!=''){
                if ($l_masters[$i]=='') {showmsg('对不起，外语掌握程度为必选！','-1');exit();}
                $sqls=$sqlss='';
                foreach($lsqlstr as $v){
                    $s=$v."s";$s=$$s;
                    if(isset($s[$i])){
                        $sqlss.="$v='".cleartags($s[$i])."',";
                    }
                }
                $sqlss.="l_adddate=NOW(),";
                $sqlss=substr($sqlss,0,-1);
                $db ->query("update {$cfg['tb_pre']}lang set $sqlss where l_pmember='$username' and l_rid=$rid and l_id=$l_ids[$i]");
            $langnum=str_replace($l_ids[$i].',','',$langnum);
			$lid.=$l_ids[$i].',';
            }
        }
    }
    $r_lang=$lid!=''? 1 : 0;
	if($langnum!=''){
		$langnum=substr($langnum,0,-1);
		$db ->query("delete from {$cfg['tb_pre']}lang where l_pmember='$username' and l_rid=$rid and l_id in ($langnum)");
	}
    
    
    //work
    $wsqlstr=array('w_startyear','w_startmonth','w_endyear','w_endmonth','w_comname','w_ecoclass','w_trade','w_dept','w_position','w_place','w_introduce','w_leftreason','w_adddate','w_pmember','w_rid','w_language');
    $wid='';$worknum = preg_replace("/[^0-9,\.-]/i",'',$worknum);
    $w_comname = empty($w_comname) ? array() : $w_comname;
    $t_count=count($w_comname);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($w_comname[$i]!=''){
                if ($w_ecoclass[$i]=='') {showmsg('对不起，单位性质为必选！','-1');exit();}
                if ($w_place[$i]=='') {showmsg('对不起，职位名称为必填！','-1');exit();}
                if (!is_numeric($w_startyear[$i])) {showmsg('对不起，在职时间为必选！','-1');exit();}
                $sqls=$sqlss='';$w_pmember[$i]=$username;$w_rid[$i]=$rid;
                $position='';
                if(!empty($mainposition[$i])) $position.=$mainposition[$i].'*';
                if(!empty($subposition[$i])) $position.=$subposition[$i].'*';
                $w_position[$i]=$position!=''?substr($position,0,-1):'';
                foreach($wsqlstr as $v){
                    $s=$$v;
                    if(isset($s[$i])){
                        $sqls.="$v,";
                        if($v=='w_introduce'){$sqlss.="'".replace_strbox($s[$i])."',";}else{$sqlss.="'".cleartags($s[$i])."',";}
                    }
                }
                $sqls.="w_adddate,";$sqlss.="NOW(),";
                $sqls=substr($sqls,0,-1);$sqlss=substr($sqlss,0,-1);
                $db ->query("INSERT INTO {$cfg['tb_pre']}work ($sqls) VALUES($sqlss)");
                $wid.=$db ->insert_id().',';
            }
        }
    }
    $w_comnames = empty($w_comnames) ? array() : $w_comnames;
    $t_count=count($w_comnames);
    if ($t_count>0){
        for($i=0;$i<$t_count;$i++){
            if ($w_comnames[$i]!=''){
                if ($w_ecoclasss[$i]=='') {showmsg('对不起，单位性质为必选！','-1');exit();}
                if ($w_places[$i]=='') {showmsg('对不起，职位名称为必填！','-1');exit();}
                if (!is_numeric($w_startyears[$i])) {showmsg('对不起，在职时间为必选！','-1');exit();}
                $sqls=$sqlss='';
                $positions='';
                if(!empty($mainpositions[$i])) $positions.=$mainpositions[$i].'*';
                if(!empty($subpositions[$i])) $positions.=$subpositions[$i].'*';
                $w_positions[$i]=$positions!=''?substr($positions,0,-1):'';
                foreach($wsqlstr as $v){
                    $s=$v."s";$s=$$s;
                    if(isset($s[$i])){
                        if($v=='w_introduce'){$sqlss.="$v='".replace_strbox($s[$i])."',";}else{$sqlss.="$v='".cleartags($s[$i])."',";}
                    }
                }
                $sqlss.="w_adddate=NOW(),";
                $sqlss=substr($sqlss,0,-1);
                $db ->query("update {$cfg['tb_pre']}work set $sqlss where w_pmember='$username' and w_rid=$rid and w_id=$w_ids[$i]");
            $worknum=str_replace($w_ids[$i].',','',$worknum);
			$wid.=$w_ids[$i].',';
            }
        }
    }
    $r_work=$wid!=''? 1 : 0;
	if($worknum!=''){
		$worknum=substr($worknum,0,-1);
		$db ->query("delete from {$cfg['tb_pre']}work where w_pmember='$username' and w_rid=$rid and w_id in ($worknum)");
	}
    
    $db ->query("update {$cfg['tb_pre']}resume set r_education=$r_education,r_train=$r_train,r_lang=$r_lang,r_work=$r_work where r_mid=$Memberid and r_id=$rid");
    
    if($photo!='/upfiles/person/nophoto.gif'){
        $rs = $db->get_one("select m_logo,m_logoflag from {$cfg['tb_pre']}member where m_login='$username' and m_logo!='' and m_logo!='error.gif' limit 0,1");
        if($rs){
            $logo=$rs['m_logo'];$logoflag=$rs['m_logoflag'];$sqllogo='';
            if($logo!=$photo){
                if(rename($photo,$logo)) $photo=$logo;
                $sqllogo=($logoflag==1&&$regpArray[3]==1)?',m_logoflag=0':'';
            }
    	}else{
            $sqllogo=$regpArray[3]==1?',m_logoflag=0':',m_logoflag=1';
    	}
        $db ->query("update {$cfg['tb_pre']}member set m_logo='$photo'$sqllogo where m_login='$username'");
    }
	showmsg('操作成功！',"?mpage=person_resume&show=$show",0,2000);exit();
}else{
	$rid=intval($rid);
    $rs = $db->get_one("select * from {$cfg['tb_pre']}resume where r_mid=$Memberid and r_id=$rid limit 0,1");
    if($rs){
        $rss = $db->get_one("select m_logo from {$cfg['tb_pre']}member where m_id=$Memberid limit 0,1");
        $logo=$rss['m_logo'];
        foreach($sqlstr as $v){
            $s=str_replace('r_','',$v);
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
        $logo=($logo==''||$logo=='error.gif')?'/upfiles/person/nophoto.gif':$logo;
    }else{
        if($Glimit[6]<=$Mresumenums){echo "<script language=javascript>alert('您创建的简历数已达到上限，如需继续创建简历请联系网站客服进行升级！');location.href='javascript:history.back()';</script>";exit();}
        $rid=0;$sqls='';$title='简历'.date('YmdHis');
        $sqlstr=Array('m_email','m_name','m_sex','m_birth','m_cardtype','m_idcard','m_marriage','m_polity','m_hukou',
        'm_seat','m_edu','m_tel','m_mobile','m_chat','m_url','m_address','m_post','m_logo');
        foreach($sqlstr as $v) $sqls.="$v,";
        $sqls=substr($sqls,0,-1);
        $rss = $db->get_one("select $sqls from {$cfg['tb_pre']}member where m_id=$Memberid limit 0,1");
        foreach($sqlstr as $v){
            $s=str_replace('m_','',$v);
            $$s=$rss[$v];
        }
        if($hukou!=''){
            $hukous=explode("*",$hukou);
            $hukouprovince=$hukous[0];$hukoucapital=$hukous[1];$hukoucity=$hukous[2];
        }
        if($seat!=''){
            $seats=explode("*",$seat);
            $province=$seats[0];$capital=$seats[1];$city=$seats[2];
        }
        $logo=($logo==''||$logo=='error.gif')?'/upfiles/person/nophoto.gif':$logo;
    }
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
			title: {required: true,maxlength: 30},
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
			post: "iszipcode",
            sumup: {required: true},
            appraise: {required: true},
            ability: {required: true},
            trades: {required: true},
            positions: {required: true},
            workadds: {required: true}
		},
		messages: {
			title: "请填写简历标题",
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
			post: "邮政编码为6位数字",
            sumup: "请填写特点概括",
            appraise: "请填写自我评价",
            ability: "请填写技能专长",
            trades: "请选择意向行业类别",
            positions: "请选择意向岗位类别",
            workadds: "请选择意向工作地区"
		}
	});
});
</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>添加编辑简历</div>
    <div class="memrightbox">
    <?php ob_start();?>
      <script language="javascript" type="text/javascript">
		function setid(str,tstr){
			strs=document.getElementById(str).innerHTML;
            strs1=document.getElementById(tstr).innerHTML;
//			for(i=1;i<=strv;i++){
//				strss+=strs;
//			}
			if(strs!='&nbsp;'){
                document.getElementById(str).innerHTML=strs+strs1;
			}else{
                document.getElementById(str).innerHTML=strs1;
			}
		}
		function delid(str,strv){
			if (confirm('您确定要删除该记录吗？\n注意：此操作不可恢复！\n点击“确定”按钮后该记录自动消失！点击“取消”返回不删除！\n删除操作将在保存简历的同时进行，不保存不删除！')){
				var d = document.getElementById(str+strv); 
				if (d){ 
					var p
					if (p=d.parentNode){ 
						p.removeChild(d); 
					} 
				}	
			}
		}
        function removetab(str){
            var x=str.parentElement.parentElement.parentElement;//.style.display='none';
            if (x){ 
					var p
					if (p=x.parentNode){ 
						p.removeChild(x); 
					} 
				}
		}
		</script>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead" align="center">
            <td width="100" height="21" align="right"><strong>简历完成进度：</strong></td>
            <td><a href="#s1"><span style="color:#F00">*</span>基本资料</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s2"><span style="color:#F00">*</span>联系方式</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s4">教育背景</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s5">职业培训</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s6">语言能力</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s7">工作经历</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s8"><span style="color:#F00">*</span>求职意向</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s3"><span style="color:#F00">*</span>综合能力</a></td>
            <td width="10">&gt;</td>
            <td><a href="#s9">完成保存</a></td>
          </tr>
      </table>
      <?php ob_end_flush();ob_start();?>
      <form method="post" name="addform" id="addform" action="index.php?do=savedate&mpage=person_addresume&show=<?php echo $show;?>">
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><strong>新增简历（注：带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <tr class="memtabmain">
            <td width="100" align="right"><span style="color:#F00">*</span> 简历名称：</td>
            <td height="21"><input name="rid" type="hidden" value="<?php echo $rid;?>" /><input name="title" type="text" id="title" value="<?php echo $title;?>" size="30" /><span class="note">给简历命名，以区分多份不同的简历&nbsp;</span></td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 选择人才类别：</td>
            <td height="21"><input id="usergroup" type=radio checked value=0 name="usergroup">
      普通 <input id="usergroup" type=radio <?php if($usergroup==1) echo ' checked';?> value=1 name=usergroup>
      应届毕业生 
      <input id="usergroup" type=radio <?php if($usergroup==2) echo ' checked';?> value=2 name=usergroup>高级人才</td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">注意：</span></td>
            <td height="21">高级人才需满足以下任一条件：
        1.博士以上学位；
        2.硕士学历，二年以上工作经验；
        3.本科学历，五年以上工作经验；
        4.大专学历，五年以上中层管理经验；
        5.海外留学归国人员。</td>
          </tr>
      </table>
      <?php ob_end_flush();ob_start();?>
            <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="5"><a name="s1"></a><strong>基本资料（注：带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <tr class="memtabmain">
            <td width="100" align="right"><span style="color:#F00">*</span> 真实姓名：</td>
            <td width="200" height="21"><input name="name" type="text" id="name" value="<?php echo $name;?>" size="10" /></td>
            <td width="100" align="right"><font color="#ff7800">*</font> 性别：</td>
            <td width="200"><input type="radio" value="1" name="sex" checked />
            男
              <input type="radio" value="2" name="sex" <?php if($sex==2) echo ' checked';?> />
            女 </td>
            <td rowspan="5" id="photoimg"><img height=140 src="<?php echo $logo;?>" width=110 border=0 style="BORDER-RIGHT: #666666 1px solid; BORDER-TOP: #666666 1px solid; BORDER-LEFT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid"></td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 出生日期：</td>
            <td height="21"><input type="text" name="birth" value="<?php echo $birth;?>" id="birth" size="10" maxlength="10"  onClick="ShowCalendar(this.id)" readonly /></td>
            <td align="right">证件类型：</td>
            <td><select name="cardtype" size="1" id="cardtype">
      <option value="0" selected="selected">身份证</option>
      <option value="1" <?php if($cardtype==1) echo ' selected="selected"';?>>驾证</option>
      <option value="2" <?php if($cardtype==2) echo ' selected="selected"';?>>军官证</option>
      <option value="3" <?php if($cardtype==3) echo ' selected="selected"';?>>护照</option>
      <option value="4" <?php if($cardtype==4) echo ' selected="selected"';?>>其它</option>
    </select>
      <input name="idcard" id="idcard" maxlength="20" value="<?php echo $idcard;?>" /></td>
            </tr>
          <tr class="memtabmain">
            <td align="right">民族：</td>
            <td height="21"><select name="nation" id="nation">
              <option value="" selected="selected">请选择</option>
			<?php echo getother('nation','n','n_id asc',$nation,1);?>
            </select></td>
            <td align="right">婚姻状况：</td>
            <td><select name="marriage">
              <option value="" selected="selected">请选择</option>
			<?php echo getother('marriage','m','m_id asc',$marriage,1);?>
            </select></td>
            </tr>
          <tr class="memtabmain">
            <td align="right">政治面貌：</td>
            <td height="21"><select name="polity">
              <option value="" selected="selected">请选择</option>
			<?php echo getother('polity','p','p_id asc',$polity,1);?>
            </select></td>
            <td align="right">最高学历：</td>
            <td><select name="edu">
              <option value="" selected="selected">请选择</option>
			<?php echo getother('edu','e','e_id asc',$edu);?>
            </select></td>
            </tr>
          <tr class="memtabmain">
            <td align="right">身高：</td>
            <td height="21"><input name="height" id="height" size="3" maxlength="3" value="<?php echo $height;?>" />
厘米</td>
            <td align="right">体重：</td>
            <td><input name="weight" type="text" id="weight" size="3" maxlength="3" value="<?php echo $weight;?>" />
公斤</td>
            </tr>
          <tr class="memtabmain">
            <td align="right">户口所在地：</td>
            <td height="21" colspan="4"><select name="hukouprovince" size="1" class="t100" id="hukouprovince" onChange="changeProvince(this.form.hukouprovince.options[this.selectedIndex].value,this.form,'hukou')">
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
		</select></td>
            </tr>
          <tr class="memtabmain">
            <td align="right">目前所在地：</td>
            <td height="21" colspan="4"><select name="province" size="1" class="t100" id="province" onChange="changeProvince(this.form.province.options[this.selectedIndex].value,this.form,'')">
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
		</select></td>
            </tr>
          <tr class="memtabmain">
            <td align="right">毕业学校：</td>
            <td height="21" colspan="4"><input name="school" id="school" value="<?php echo $school;?>" maxlength="100" />
            所学专业：<input name="zhicheng" id="zhicheng" maxlength="25" value="<?php echo $zhicheng;?>" />
            毕业时间：<input type="text" name="graduate" value="<?php echo $graduate;?>" id="graduate" size="10" maxlength="10" onClick="ShowCalendar(this.id)" readonly /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">个人照片：</td>
            <td height="21" colspan="4"><input name="photo" type="text" class="inputt" id="photo" size="30" value="<?php echo $logo;?>" readonly>
      <input name="upfile" type="button" class="inputs" onClick="window.open('../inc/job_up.php?fromForm=addform&fromEdit=photo','','status=no,scrollbars=no,top=80,left=200,width=420,height=165')" value="浏览文件">
      <input type="button" name="button" id="button" class="inputs" value="预览" onClick="if(photo.value==''){alert('请点击左侧浏览文件进行上传，上传后方可预览!');}else{document.getElementById('photoimg').innerHTML='<img height=140 src='+photo.value+' width=110 border=0>'}"></td>
            </tr>
        </table>
        <?php ob_end_flush();ob_start();?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s2"></a><strong>联系方式（注：带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <tr class="memtabmain">
            <td width="100" align="right">联系电话：</td>
            <td height="21"><input name="tel" id="tel" value="<?php echo $tel;?>" size="40" maxlength="100" /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 手机号码：</td>
            <td height="21"><input name="mobile" id="mobile" maxlength="20" value="<?php echo $mobile;?>" /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">聊天QQ号码：</td>
            <td height="21"><input name="chat" id="chat" maxlength="100" value="<?php echo $chat;?>" /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 电子邮件：</td>
            <td height="21"><input name="email" id="email" maxlength="100" value="<?php echo $email;?>" readonly="readonly" />不可修改</td>
          </tr>
          <tr class="memtabmain">
            <td align="right">个人主页：</td>
            <td height="21"><input name="url" id="url" size="40" maxlength="100" value="<?php echo $url;?>" /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">通信地址：</td>
            <td height="21"><input name="address" id="address" size="40" maxlength="50" value="<?php echo $address;?>" /></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">邮政编码：</td>
            <td height="21"><input name="post" id="post" size="6" maxlength="6" value="<?php echo $post;?>" /></td>
          </tr>
        </table>
      <?php ob_end_flush();ob_start();?>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="4"><a name="s4"></a><strong>教育背景（注：选择填写此项内容时，带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <?php
		  $edunum='';
		  $result=$db->query("select * from {$cfg['tb_pre']}education where e_pmember='$username' and e_rid=$rid order by e_adddate asc");
		  while($row=$db->fetch_array($result)){
			  $edunum.=$row['e_id'].',';
			  $professions=explode("*",$row['e_profession']);
			  $mainprofession=$professions[0];$subprofession=$professions[1];
		  ?>
           <tr class="memtabmain" id="edu<?php echo $row['e_id'];?>">
            <td width="100" align="center"><span onclick="delid('edu',<?php echo $row['e_id'];?>)" style="cursor:pointer; color:#F00; font-weight:bold">删除此项</span></td>
            <td>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
          	<tr class="memtabmain">
                <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right"><input type="hidden" name="e_ids[]" value="<?php echo $row['e_id'];?>" />学校名称：</td>
                <td style="border-top: 1px #e1e6e9 solid;" width="160"><input name="e_schools[]" size=20 maxLength=50 value="<?php echo $row['e_school'];?>"></td>
                <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right">所学专业：</td>
                <td style="border-top: 1px #e1e6e9 solid;"><select name="mainprofessions[]" size="1" onChange="changeProfession(this.options[this.selectedIndex].value,this,'subprofessions[]')" style="width:160px;">
                <?php if($mainprofession!=''){?>
                <option value="<?php echo $mainprofession;?>"><?php echo $mainprofession;?></option>
                <?php }else{?><option value="">---请选择---</option><?php }?>
                <?php
                $results=$db->query("select p_id,p_name from {$cfg['tb_pre']}profession where p_fid=0 order by p_order asc");
				while($rows=$db->fetch_array($results)){
					echo "<option value=\"{$rows["p_name"]}\">{$rows["p_name"]}</option>\r\n";
				}
				?>
                </select>
                <select name="subprofessions[]"  style="width:160px;">
                <?php if($subprofession!=''){?>
                <option value="<?php echo $subprofession;?>"><?php echo $subprofession;?></option>
                <?php }else{?><option value="">---请选择---</option><?php }?>
                </select>
                </td>
            </tr>
             <tr class="memtabmain">
                <td align="right">学历：</td>
                <td><select name="e_edus[]">
                <option value="" selected="selected">---请选择---</option>
                <?php echo getother('edu','e','e_id asc',$row['e_edu'],1);?>
    </select></td>
                <td align="right">在校时间：</td>
                <td>从
                <select name="e_startyears[]">
                <option value="0" selected="selected">年</option>
                <?php
				for($i=date("Y")-70;$i<=date("Y");$i++){
					$select=$i==$row['e_startyear']?" selected=\"selected\"":'';
					echo "<option value=\"$i\"$select>$i</option>\r\n";
				}
				?>
                </select>
                <select name="e_startmonths[]">
                <option value="0" selected="selected">月</option>
                <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['e_startmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                </select>
                到
                <select name="e_endyears[]">
                <option value="0" selected="selected">年</option>
                <?php
				for($i=date("Y")-70;$i<=date("Y");$i++){
					$select=$i==$row['e_endyear']?" selected=\"selected\"":'';
					echo "<option value=\"$i\"$select>$i</option>\r\n";
				}
				?>
                </select>
                <select name="e_endmonths[]">
                <option value="0" selected="selected">月</option>
                <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['e_endmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                </select>
      (后两项不填表示至今)</td>
            </tr>
            <tr class="memtabmain">
                <td align="right">专业描述：</td>
                <td colspan="3"><textarea name="e_details[]" cols="80" rows="6"><?php echo change_strbox($row['e_detail']);?></textarea></td>
            </tr>
            </table>
            </td>
          </tr>
           <?php }?>    
          <tr class="memtabmain">
            <td width="100" align="center" valign="bottom"><input type="hidden" name="edunum" value="<?php echo $edunum;?>" /> <input type="button" name="edub" onclick="setid('newedu','tnewedu');" value="新增" class="inputs" /></td>
            <td id="newedu">&nbsp;</td>
          </tr>
      	</table>
        
        <?php ob_end_flush();ob_start();?>
        
        
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s5"></a><strong>职业培训（注：选择填写此项内容时，带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <?php
		  $trainnum='';
		  $result=$db->query("select * from {$cfg['tb_pre']}training where t_pmember='$username' and t_rid=$rid order by t_adddate asc");
		  while($row=$db->fetch_array($result)){
		  $trainnum.=$row['t_id'].',';
		  ?>
           <tr class="memtabmain" id="train<?php echo $row['t_id'];?>">
            <td width="100" align="center"><span onclick="delid('train',<?php echo $row['t_id'];?>)" style="cursor:pointer; color:#F00; font-weight:bold">删除此项</span></td>
            <td class="memtabmain">
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
                  <tr class="memtabmain">
                    <td style="border-top: 1px #e1e6e9 solid;"width="70" align="right"><input type="hidden" name="t_ids[]" value="<?php echo $row['t_id'];?>" />培训机构：</td>
                    <td style="border-top: 1px #e1e6e9 solid;" width="160"><input name="t_trains[]" size=20 maxLength=50 value="<?php echo $row['t_train'];?>"></td>
                    <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right">培训地点：</td>
                    <td style="border-top: 1px #e1e6e9 solid;"><input name="t_addresss[]" size="30" maxlength="50" value="<?php echo $row['t_address'];?>" /></td>
                  </tr>
                  <tr class="memtabmain">
                    <td align="right">培训课程：</td>
                    <td><input name="t_courses[]" size="20" maxlength="50" value="<?php echo $row['t_course'];?>" /></td>
                    <td align="right">培训时间：</td>
                    <td>从
                    <select name="t_startyears[]">
                    <option value="0" selected="selected">年</option>
                    <?php
					for($i=date("Y")-70;$i<=date("Y");$i++){
						$select=$i==$row['t_startyear']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    <select name="t_startmonths[]">
                    <option value="0" selected="selected">月</option>
                    <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['t_startmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    到
                    <select name="t_endyears[]">
                    <option value="0" selected="selected">年</option>
                    <?php
					for($i=date("Y")-70;$i<=date("Y");$i++){
						$select=$i==$row['t_endyear']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    <select name="t_endmonths[]">
                    <option value="0" selected="selected">月</option>
                    <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['t_endmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    (后两项不填表示至今)</td>
                  </tr>
                  <tr class="memtabmain">
                    <td align="right">获得证书：</td>
                    <td colspan="3"><input name="t_certificates[]" size="20" maxlength="50" value="<?php echo $row['t_certificate'];?>" /></td>
                  </tr>
                  <tr class="memtabmain">
                    <td align="right">详细描述：</td>
                    <td colspan="3"><textarea name="t_details[]" cols="80" rows="6"><?php echo change_strbox($row['t_detail']);?></textarea></td>
                  </tr>
              </table>
            </td>
          </tr>  
          <?php }?>    
          <tr class="memtabmain">
            <td width="100" align="center" valign="bottom"><input type="hidden" name="trainnum" value="<?php echo $trainnum;?>" /> <input type="button" name="edub" onclick="setid('newtrain','tnewtrain');" value="新增" class="inputs" /></td>
            <td id="newtrain">&nbsp;</td>
          </tr>
      	</table>
        <?php ob_end_flush();ob_start();?>
        <!--语言能力-->
            <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s6"></a><strong>语言能力（注：选择填写此项内容时，带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <?php
		  $langnum='';
		  $result=$db->query("select * from {$cfg['tb_pre']}lang where l_pmember='$username' and l_rid=$rid order by l_adddate asc");
		  while($row=$db->fetch_array($result)){
		  $langnum.=$row['l_id'].',';
		  ?>
           <tr class="memtabmain" id="lang<?php echo $row['l_id'];?>">
            <td width="100" align="center"><span onclick="delid('lang',<?php echo $row['l_id'];?>)" style="cursor:pointer; color:#F00; font-weight:bold">删除此项</span></td>
            <td>
                  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
                    <tr class="memtabmain">
                      <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right"><input type="hidden" name="l_ids[]" value="<?php echo $row['l_id'];?>" />外语语种：</td>
                      <td style="border-top: 1px #e1e6e9 solid;" width="160"><select name="l_names[]">
                      <option value="" selected="selected">---请选择---</option>
                      <?php echo getother('foreignlanguage','f','f_id asc',$row['l_name'],1);?>
                      </select></td>
                      <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right">掌握程度：</td>
                      <td style="border-top: 1px #e1e6e9 solid;"><select name="l_masters[]">
                      <option value="" selected="selected">---请选择---</option>
                      <?php echo getother('foreigndegree','f','f_id asc',$row['l_master'],1);?>
                      </select></td>
                    </tr>
                  </table>
             </td>
              </tr>
			<?php }?>
          <tr class="memtabmain">
            <td width="100" align="center" valign="bottom"><input type="hidden" name="langnum" value="<?php echo $langnum;?>" /> <input type="button" name="edub" onclick="setid('newlang','tnewlang');" value="新增" class="inputs" /></td>
            <td id="newlang">&nbsp;</td>
          </tr>
      	</table>
        
         <?php ob_end_flush();ob_start();?>
         
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s7"></a><strong>工作经历（注：选择填写此项内容时，带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <?php
		  $worknum='';
		  $result=$db->query("select * from {$cfg['tb_pre']}work where w_pmember='$username' and w_rid=$rid order by w_adddate asc");
		  while($row=$db->fetch_array($result)){
		  $worknum.=$row['w_id'].',';
		  $positions=explode("*",$row['w_position']);
		  $mainposition=$positions[0];$subposition=$positions[1];
		  ?>
           <tr class="memtabmain" id="work<?php echo $row['w_id'];?>">
            <td width="100" align="center"><span onclick="delid('work',<?php echo $row['w_id'];?>)" style="cursor:pointer; color:#F00; font-weight:bold">删除此项</span></td>
            <td>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
          <tr class="memtabmain">
                <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right"><input type="hidden" name="w_ids[]" value="<?php echo $row['w_id'];?>" />单位名称：</td>
                <td style="border-top: 1px #e1e6e9 solid;" width="160"><input name="w_comnames[]" size=20 maxLength=50 value="<?php echo $row['w_comname'];?>"></td>
                <td style="border-top: 1px #e1e6e9 solid;" width="70" align="right">所属行业：</td>
                <td style="border-top: 1px #e1e6e9 solid;"><select name="w_trades[]">
                    <option value="" selected>---请选择---</option>
                    <?php echo getother('trade','t','t_id asc',$row['w_trade'],1);?>
                    </select></td>
          </tr>
              <tr class="memtabmain">
                <td align="right">单位性质：</td>
                <td><select name="w_ecoclasss[]" size="1">
                    <option value="" selected>---请选择---</option>
                    <?php echo getother('ecoclass','e','e_id asc',$row['w_ecoclass'],1);?>
                    </select></td>
                <td align="right">在职时间：</td>
                <td>从
                    <select name="w_startyears[]">
                    <option value="0" selected="selected">年</option>
                    <?php
					for($i=date("Y")-70;$i<=date("Y");$i++){
						$select=$i==$row['w_startyear']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    <select name="w_startmonths[]">
                    <option value="0" selected="selected">月</option>
                    <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['w_startmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    到
                    <select name="w_endyears[]">
                    <option value="0" selected="selected">年</option>
                    <?php
					for($i=date("Y")-70;$i<=date("Y");$i++){
						$select=$i==$row['w_endyear']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                    <select name="w_endmonths[]">
                    <option value="0" selected="selected">月</option>
                    <?php
					for($i=1;$i<=12;$i++){
						$select=$i==$row['w_endmonth']?" selected=\"selected\"":'';
						echo "<option value=\"$i\"$select>$i</option>\r\n";
					}
					?>
                    </select>
                (后两项不填表示至今)</td>
              </tr>
              <tr class="memtabmain">
                <td align="right">职位名称：</td>
                <td><input name="w_places[]" size=20 maxLength=50 value="<?php echo $row['w_place'];?>"></td>
                <td align="right">所在部门：</td>
                <td><input name="w_depts[]" size="30" maxlength="50" value="<?php echo $row['w_dept'];?>" /></td>
              </tr>
              <tr class="memtabmain">
                <td align="right">岗位类别：</td>
                <td colspan="3"><select name="mainpositions[]" size="1" onChange="changePosition(this.options[this.selectedIndex].value,this,'subpositions[]')" style="width:160px;">
                <?php if($mainposition!=''){?>
                <option value="<?php echo $mainposition;?>"><?php echo $mainposition;?></option>
                <?php }else{?><option value="">---请选择---</option><?php }?>
                <?php
                $results=$db->query("select p_id,p_name from {$cfg['tb_pre']}position where p_fid=0 order by p_order asc");
				while($rows=$db->fetch_array($results)){
					echo "<option value=\"{$rows["p_name"]}\">{$rows["p_name"]}</option>\r\n";
				}
				?>
                </select>
                <select name="subpositions[]"  style="width:160px;">
                <?php if($subposition!=''){?>
                <option value="<?php echo $subposition;?>"><?php echo $subposition;?></option>
                <?php }else{?><option value="">---请选择---</option><?php }?>
                </select>
                </td>
              </tr>
              <tr>
                <td align="right">职位描述：</td>
                <td colspan="3"><textarea name="w_introduces[]" cols="80" rows="6"><?php echo change_strbox($row['w_introduce']);?></textarea><br>工作描述限2000个字符，请详细描述您的职责范围、工作任务以及取得的成绩等。</td>
              </tr>
              <tr>
                <td align="right">离职原因：</td>
                <td colspan="3"><input name="w_leftreasons[]" size="30" maxlength="50" value="<?php echo $row['w_leftreason'];?>" /></td>
              </tr>
   		</table>
             </td>
          </tr>
			<?php }?>
          <tr class="memtabmain">
            <td width="100" align="center" valign="bottom"><input type="hidden" name="worknum" value="<?php echo $worknum;?>" /> <input type="button" name="edub" onclick="setid('newwork','tnewwork');" value="新增" class="inputs" /></td>
            <td id="newwork">&nbsp;</td>
          </tr>
      	</table>
        
        <?php ob_end_flush();ob_start();?>
        
            <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s8"></a><strong>求职意向（注：带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <tr class="memtabmain">
                <td width="100" align="right"><span style="color:#F00">*</span> 意向职位类别：</td>
                <td><input type="radio" value="1" name="jobtype"  checked />全职
                <input type="radio" value="2" name="jobtype" <?php if($jobtype==2) echo ' checked';?> />兼职
                <input type="radio" value="3" name="jobtype" <?php if($jobtype==3) echo ' checked';?> />全职、兼职均可</td>
              </tr>
              <tr class="memtabmain">
                <td align="right"><span style="color:#F00">*</span> 意向行业类别：</td>
                <td><input type="hidden" name="trade" id="trade" value="<?php echo hiretrade($trade,0,1);?>" ><input name="trades" type="text" onClick="JumpSearchLayer(4,'addform','trade','trades');" id="trades" value="<?php if($rid!=''){echo csysnames($trade);}else{echo "选择意向行业";}?>" size="60" readonly /></td>
              </tr>
              <tr class="memtabmain">
                <td width="100" align="right"><span style="color:#F00">*</span> 意向岗位类别：</td>
                <td><input type="hidden" name="position" id="position" value="<?php echo hireposition($position,0,0,1);?>" ><input name="positions" type="text" onClick="JumpSearchLayer(1,'addform','position','positions');" id="positions" value="<?php if($rid!=''){echo csysnames($position);}else{echo "选择意向岗位类别";}?>" size="60" readonly /></td>
              </tr>
              <tr class="memtabmain">
                <td align="right"><span style="color:#F00">*</span> 意向工作地区：</td>
                <td><!--调用三级地区-->
	<input name="workadd" type="hidden" id="workadd" value="<?php echo hireworkadd($workadd,0,0,1);?>" /><input name="workadds" type="text" onClick="JumpSearchLayer(5,'addform','workadd','workadds');" id="workadds" value="<?php if($rid!=''){echo csysnames($workadd);}else{echo "选择意向工作地区";}?>" size="60" readonly /></td>
              </tr>
              <tr class="memtabmain">
                <td align="right">月薪要求：</td>
                <td><input name="pay" id="pay" size="10" maxlength="11" value="<?php echo ahirepay($pay);?>">
                <select name="paytemp" onchange="pay.value=this.value">
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
                元 注：0表示面议! &nbsp;&nbsp;&nbsp;&nbsp;
                <input name="stay" type="checkbox" id="stay" value="1" <?php if($stay==1) echo ' checked';?>>
                要求提供住宿</td>
              </tr>
              <tr class="memtabmain">
                <td align="right">到岗时间：</td>
                <td><select name="workdate" id="workdate">
                <option value="0" selected>随时</option>
                <option value="7" <?php if($workdate==7) echo ' selected';?>>1周以内</option>
                <option value="14" <?php if($workdate==14) echo ' selected';?>>2周以内</option>
                <option value="30" <?php if($workdate==30) echo ' selected';?>>1个月内</option>
                <option value="60" <?php if($workdate==60) echo ' selected';?>>1～3个月</option>
                <option value="90" <?php if($workdate==90) echo ' selected';?>>3个月以后</option>
                </select></td>
              </tr>
              <tr class="memtabmain">
                <td align="right">其他要求：</td>
                <td><textarea id="request" name="request" rows="5" cols="80"><?php echo change_strbox($request);?></textarea></td>
              </tr>
      		</table>
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
          <tr class="memtabhead">
            <td height="21" colspan="2"><a name="s3"></a><strong>综合能力（注：带<span style="color:#F00">*</span>号为必填项）</strong></td>
          </tr>
          <tr class="memtabmain">
            <td width="100" align="right"><span style="color:#F00">*</span> 特点概括：</td>
            <td height="21"><input name="sumup" id="sumup" size="30" maxlength="20" value="<?php echo $sumup;?>" />用最精练的几个字概括您最突出的优势。字数在10个字内。如：5年软件开发经验。</td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 自我评价：</td>
            <td height="21"><textarea id="appraise" name="appraise" rows="5" cols="80"><?php echo change_strbox($appraise);?></textarea></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">&nbsp;</td>
            <td height="21">2000个字符，用简洁的词语描述自己的综合能力。</td>
          </tr>
          <tr class="memtabmain">
            <td align="right"><span style="color:#F00">*</span> 技能专长：</td>
            <td height="21"><textarea id="ability" name="ability" rows="5" cols="80"><?php echo change_strbox($ability);?></textarea></td>
          </tr>
          <tr class="memtabmain">
            <td align="right">&nbsp;</td>
            <td height="21">2000个字符，用简洁的词语描述自己的技能专长，如：专业技能，计算机水平等。</td>
          </tr>
      </table>
            <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
              <tr class="memtabhead">
                <td align="right" width="100">是否激活简历：</td>
                <td><input name="step" type="radio" value="0" checked="checked" />是 <input name="step" type="radio" value="1" />否</td>
              </tr>
              <tr class="memtabmain">
                <td align="right" width="100"><a name="s9"></a>&nbsp;</td>
                <td><input name="submit" type="submit" class="submit" value="保存" /> <input name="submit" type="button" class="submit" value="返回" onclick="javascript:history.back();" /></td>
              </tr>
      		</table>
            <?php ob_end_flush();?>
      </form>
    </div>
</div>

<div style="display:none" id="tnewedu">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
<tr>
    <td height="21" colspan="4" style="border-top: 1px #e1e6e9 solid;"><span onclick="removetab(this);" style="cursor:pointer; color:#F00; font-weight:bold"> → 删除此项</span></td>
</tr>
<tr class="memtabmain">
    <td width="70" align="right"><span style="color:#F00">*</span> 学校名称：</td>
    <td width="160"><input name="e_school[]" size="20" maxlength="50" /></td>
    <td width="70" align="right">所学专业：</td>
    <td><select name="mainprofession[]" size="1" onchange="changeProfession(this.options[this.selectedIndex].value,this,'subprofession[]')" style="width:160px;">
    <option value="" selected>---请选择---</option>
    <?php
    $result=$db->query("select p_id,p_name from {$cfg['tb_pre']}profession where p_fid=0 order by p_order asc");
    while($row=$db->fetch_array($result)){
        echo "<option value=\"{$row["p_name"]}\">{$row["p_name"]}</option>\r\n";
    }
    ?>
    </select>
    <select name="subprofession[]" style="width:160px;">
    <option value="" selected>---请选择---</option>
    </select>
    </td>
</tr>
 <tr class="memtabmain">
    <td align="right"><span style="color:#F00">*</span> 学历：</td>
    <td><select name="e_edu[]">
    <option value="" selected="selected">---请选择---</option>
    <?php echo getother('edu','e','e_id asc','',1);?>
</select></td>
    <td align="right"><span style="color:#F00">*</span> 在校时间：</td>
    <td>从
    <select name="e_startyear[]">
    <option value="0" selected="selected">年</option>
    <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    <select name="e_startmonth[]">
    <option value="0" selected="selected">月</option>
    <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    到
    <select name="e_endyear[]">
    <option value="0" selected="selected">年</option>
    <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    <select name="e_endmonth[]">
    <option value="0" selected="selected">月</option>
    <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
(后两项不填表示至今)</td>
</tr>
<tr class="memtabmain">
    <td align="right">专业描述：</td>
    <td colspan="3"><textarea name="e_detail[]" cols="80" rows="6"></textarea></td>
</tr>
</table>
</div>
<div style="display:none" id="tnewtrain">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
<tr>
    <td height="21" colspan="4" style="border-top: 1px #e1e6e9 solid;"><span onclick="removetab(this);" style="cursor:pointer; color:#F00; font-weight:bold"> → 删除此项</span></td>
</tr>
  <tr class="memtabmain">
      <td width="70" align="right"><span style="color:#F00">*</span> 培训机构：</td>
      <td width="160"><input name="t_train[]" size=20 maxLength=50></td>
      <td width="70" align="right">培训地点：</td>
      <td><input name="t_address[]" size="30" maxlength="50" /></td>
  </tr>
  <tr class="memtabmain">
    <td align="right"><span style="color:#F00">*</span> 培训课程：</td>
    <td><input name="t_course[]" size="20" maxlength="50" /></td>
    <td align="right"><span style="color:#F00">*</span> 培训时间：</td>
    <td>从
    <select name="t_startyear[]">
    <option value="0" selected="selected">年</option>
    <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    <select name="t_startmonth[]">
    <option value="0" selected="selected">月</option>
    <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    到
    <select name="t_endyear[]">
    <option value="0" selected="selected">年</option>
    <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    <select name="t_endmonth[]">
    <option value="0" selected="selected">月</option>
    <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
    </select>
    (后两项不填表示至今)</td>
  </tr>
  <tr class="memtabmain">
    <td align="right">获得证书：</td>
    <td colspan="3"><input name="t_certificate[]" size="20" maxlength="50" /></td>
  </tr>
  <tr class="memtabmain">
    <td align="right">详细描述：</td>
    <td colspan="3"><textarea name="t_detail[]" cols="80" rows="6"></textarea></td>
  </tr>
</table>
</div>
<div style="display:none" id="tnewlang">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
<tr>
    <td height="21" colspan="4" style="border-top: 1px #e1e6e9 solid;"><span onclick="removetab(this);" style="cursor:pointer; color:#F00; font-weight:bold"> → 删除此项</span></td>
</tr>
  <tr class="memtabmain">
    <td width="70" align="right"><span style="color:#F00">*</span> 外语语种：</td>
    <td width="160"><select name="l_name[]">
    <option value="" selected="selected">---请选择---</option>
    <?php echo getother('foreignlanguage','f','f_id asc','',1);?>
    </select></td>
    <td width="70" align="right"><span style="color:#F00">*</span> 掌握程度：</td>
    <td><select name="l_master[]">
    <option value="" selected="selected">---请选择---</option>
    <?php echo getother('foreigndegree','f','f_id asc','',1);?>
    </select></td>
  </tr>
</table>
</div>
<div style="display:none" id="tnewwork">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="memtabdel">
<tr>
    <td height="21" colspan="4" style="border-top: 1px #e1e6e9 solid;"><span onclick="removetab(this);" style="cursor:pointer; color:#F00; font-weight:bold"> → 删除此项</span></td>
</tr>
<tr class="memtabmain">
  <td width="70" align="right"><span style="color:#F00">*</span> 单位名称：</td>
  <td width="160"><input name="w_comname[]" size=20 maxLength=50></td>
  <td width="70" align="right">所属行业：</td>
  <td><select name="w_trade[]">
      <option value="" selected>---请选择---</option>
      <?php echo getother('trade','t','t_id asc','',1);?>
      </select></td>
</tr>
<tr class="memtabmain">
  <td align="right"><span style="color:#F00">*</span> 单位性质：</td>
  <td><select name="w_ecoclass[]" size="1">
      <option value="" selected>---请选择---</option>
      <?php echo getother('ecoclass','e','e_id asc','',1);?>
      </select></td>
  <td align="right"><span style="color:#F00">*</span> 在职时间：</td>
  <td>从
  <select name="w_startyear[]">
  <option value="0" selected="selected">年</option>
  <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
  </select>
  <select name="w_startmonth[]">
  <option value="0" selected="selected">月</option>
  <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
  </select>
  到
  <select name="w_endyear[]">
  <option value="0" selected="selected">年</option>
  <?php for($i=date("Y")-70;$i<=date("Y");$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
  </select>
  <select name="w_endmonth[]">
  <option value="0" selected="selected">月</option>
  <?php for($i=1;$i<=12;$i++) echo "<option value=\"$i\">$i</option>\r\n";?>
  </select>
  (后两项不填表示至今)</td>
</tr>
<tr class="memtabmain">
  <td align="right"><span style="color:#F00">*</span> 职位名称：</td>
  <td><input name="w_place[]" size=20 maxLength=50></td>
  <td align="right">所在部门：</td>
  <td><input name="w_dept[]" size="30" maxlength="50" /></td>
</tr>
<tr class="memtabmain">
  <td align="right">岗位类别：</td>
  <td colspan="3"><select name="mainposition[]" size="1" id="mainposition" onChange="changePosition(this.options[this.selectedIndex].value,this,'subposition[]')" style="width:160px;">
  <option value="" selected="selected">---请选择---</option>
  <?php
  $result=$db->query("select p_id,p_name from {$cfg['tb_pre']}position where p_fid=0 order by p_order asc");
  while($row=$db->fetch_array($result)){
      echo "<option value=\"{$row["p_name"]}\">{$row["p_name"]}</option>\r\n";
  }
  ?>
  </select>
  <select name="subposition[]" id="subposition" style="width:160px;">
  <option value="" selected="selected">---请选择---</option>
  </select>
  </td>
</tr>
<tr class="memtabmain">
  <td align="right">职位描述：</td>
  <td colspan="3"><textarea name="w_introduce[]" cols="80" rows="6"></textarea><br>工作描述限2000个字符，请详细描述您的职责范围、工作任务以及取得的成绩等。</td>
</tr>
<tr class="memtabmain">
  <td align="right">离职原因：</td>
  <td colspan="3"><input name="w_leftreason[]" size="30" maxlength="50" /></td>
</tr>
</table>
</div>       
<div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
<script language = "JavaScript" src="../js/getprovince.js"></script>
<script language = "JavaScript" src="../js/gettrade.js"></script>
<script language = "JavaScript" src="../js/getposition.js"></script>
<script language = "JavaScript" src="../js/getprofession.js"></script>
<script language="javascript" src="../js/jobjss.js"></script>
<script language = "JavaScript">
//window.onload=function(){
//    <?php if($edunum=='') echo "document.getElementById('newedu').innerHTML=document.getElementById('tnewedu').innerHTML;";?>
//    <?php if($trainnum=='') echo "document.getElementById('newtrain').innerHTML=document.getElementById('tnewtrain').innerHTML;";?>
//    <?php if($langnum=='') echo "document.getElementById('newlang').innerHTML=document.getElementById('tnewlang').innerHTML;";?>
//    <?php if($worknum=='') echo "document.getElementById('newwork').innerHTML=document.getElementById('tnewwork').innerHTML;";?>
//}
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

function changePosition(selvalue,obj,str){	
	var arrObj = document.getElementsByName(obj.name); 
	for(var i=0; i<arrObj.length; i++){ 
		if(obj == arrObj[i]) { 
		   index=i; 
		} 
	}
	document.getElementsByName(str).item(index).options.length=0; 
	var selvalue=selvalue;	  
	var j,f=0;
    selvalues='';
	for(j=0;j<posiArray.length;j++) {
        if(posiArray[j][0]==selvalue&&f==0){selvalues=posiArray[j][2];f=1;}
		if(posiArray[j][1]==selvalues) {
			var newOption2=new Option(posiArray[j][0],posiArray[j][0]);
			document.getElementsByName(str).item(index).options.add(newOption2);	
		}				
	}
}
function changeProfession(selvalue,obj,str){	
	var arrObj = document.getElementsByName(obj.name);
	for(var i=0; i<arrObj.length; i++){ 
		if(obj == arrObj[i]) { 
		   index=i; 
		}
	}
	document.getElementsByName(str).item(index).options.length=0; 
	var selvalue=selvalue;	  
	var j,f=0;
    selvalues='';
	for(j=0;j<profArray.length;j++) {
        if(profArray[j][0]==selvalue&&f==0){selvalues=profArray[j][2];f=1;}
		if(profArray[j][1]==selvalues) {
			var newOption2=new Option(profArray[j][0],profArray[j][0]);
			document.getElementsByName(str).item(index).options.add(newOption2);
		}				
	}	
}
</script>