<?php
require(dirname(__FILE__).'/../config.inc.php');
require_once(FR_ROOT.'/inc/paylog.inc.php');
if(!$cfg['comment']=='1'){echo "<script language=JavaScript>{alert('本站未开启评论功能！');window.close();}</script>";exit;}
$submit=isset($_POST['Submit'])?$_POST['Submit']:'';
if($submit){
	if($cfg['comment']){
	if($anonymous){
		$c_username ='匿名网友';
	}else{
		$user_login=_getcookie('user_login');
		if($user_login){
			$pjrname=$user_login;
		}
		$c_username=$pjrname;
		$sql="select  m_id,m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral from {$cfg['tb_pre']}member ,{$cfg['tb_pre']}group where m_groupid=g_id and m_login='$pjrname'";
		$rs= $db->get_one($sql);
		if($rs){
			$typeid=$rs["m_typeid"];$name=$rs['m_name'];$loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
			//if($typeid==1){$integral=$Gintegral[6];$integral2=$Gintegral[9];}else{$integral=$Gintegral[5];$integral2=$Gintegral[7];}
			if($pjrpass){
				if($rs['m_pwd']==md5($pjrpass)){
					$pwd=md5($pjrpass);
					$db ->query("update {$cfg['tb_pre']}member set m_loginnum=m_loginnum+1,m_logindate=NOW(),m_loginip='$ip' where m_login='$pjrname'");
					//upintegral($rs['m_id'],"会员登录增加积分+$integral",$integral);
					
					_setcookie('user_login',$pjrname,3600*24);
					_setcookie('user_pass',$pwd,3600*24);
					_setcookie('user_type',usertype($typeid),3600*24);
					_setcookie('user_name',$name,3600*24);
					_setcookie('user_loginip',$loginip,3600*24);
					_setcookie('user_logindate',$logindate,3600*24);
					
				}else{
					echo "<script language=JavaScript>{alert('用户名密码错误，请重新输入！');window.close();}</script>";exit;
				}
			}
			//upintegral($rs['m_id'],"评论文章增加积分+$integral2",$integral2);
		}
	}
	$c_ip=getip();
	$c_nid=intval($newsid);
	$c_addtime=date('Y-m-d H:i:s');
	$c_content=$pj_content;
	$c_title=$n_title;
	
	if(!$cfg['commentcheck']){
		
	$pbarr=explode('|',$cfg['gbmanagerubbish']);

	foreach ($pbarr as $value){
		
		
			//var_dump($value);
		$flag=strstr($pj_content,$value)?2:1;
		if($flag){
			break;
			}
		}
	$c_pass=$flag;
	}else{
		
		$c_pass=0;
		}
	
	if($c_pass==0){
		$tsxx="您的评论内容已经提交成功！\\n管理员审核后在相关页中显示！";
	}elseif($c_pass==1){
		$tsxx="您的评论内容已经提交成功！\\n请刷新页面！";
	}elseif($c_pass==2){
		$tsxx="您的评论内容有非法关键词！\\n请阅读发表评论须知";
	}
	$sql="insert into {$cfg['tb_pre']}comment(c_username,c_content,c_nid,c_pass,c_addtime,c_ip,c_title ) values ('$c_username','$c_content','$c_nid','$c_pass','$c_addtime','$c_ip','$c_title')";
	//exit($sql);
	$db->query($sql);
	 echo "<script language=JavaScript>alert('$tsxx');window.opener.location.reload();window.close();</script>";
	 exit;
	}else{	
	echo "<script language=JavaScript>alert('网站不允许发表评论！');window.close();</script>";exit;
	}
}else{
	 echo "<script language=JavaScript>alert('参数错误！');window.close();</script>";exit;
}
?>