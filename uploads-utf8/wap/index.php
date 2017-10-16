<?php
require(dirname(__FILE__).'/../config.inc.php');
$waphtml="<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=utf-8\"/>
<title>$cfg[sitename] 手机版</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/$cfg[skin]/wap.css\">
</head>
<body>
<div id=\"logo\"><img src=\"../images/wap_logo.gif\" /></div>";
if($a=='login'){
    $waphtml.="<div class=\"tit\">个人会员登录</div>
    <div class=\"con\">
    <form id=\"form1\" name=\"form1\" method=\"post\" action=\"?a=cklogin\">
    用户名：<input name=\"login\" type=\"text\" id=\"login\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    密　码：<input name=\"pwd\" type=\"text\" id=\"pwd\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    <input type=\"submit\" name=\"Submit\" value=\"登录\" />
    </form>
    </div>
    <div class=\"con\"><a href=\"index.php\">返回首页</a></div>";
}elseif($a=='reg'){
    $waphtml.="<div class=\"tit\">个人会员注册</div>
    <div class=\"con\">
    <form id=\"form1\" name=\"form1\" method=\"post\" action=\"?a=cklogin\">
    用户名：<input name=\"word\" type=\"text\" id=\"word\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    密　码：<input name=\"word\" type=\"text\" id=\"word\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    邮　箱：<input name=\"word\" type=\"text\" id=\"word\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    <input type=\"submit\" name=\"Submit\" value=\"注册\" />
    </form>
    </div>
    <div class=\"con\"><a href=\"index.php\">返回首页</a></div>";
}elseif($a=='cklogin'){
    $waphtml.="<div class=\"tit\">会员登录</div>\n\r";
    $ip=getip();
    if(!empty($login) && !empty($pwd)){
        $expstr='\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
        $len = strlen($login);
        if($len > 20 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$expstr/is",$login)){
            showwapmsg('用户名不合法!','0');exit();
        }
        $rs = $db->get_one("select m_pwd,m_typeid,m_name,m_loginip,m_logindate,m_email,g_integral from {$cfg['tb_pre']}member,{$cfg['tb_pre']}group where m_groupid=g_id and m_login='$login and m_typeid=1' limit 0,1");
			if($rs){
				$ueserpwd=$pwd;$pwd=md5($pwd);
				if(strtolower($rs['m_pwd'])!=$pwd){
                    $waphtml.="<font color=\"#ff0000\">你的密码错误!</font><br>";
				}else{
				    $loginip=$rs['m_loginip'];$logindate=$rs['m_logindate'];$Gintegral=explode(",",$rs['g_integral']);
                    $integral=$Gintegral[6];
				    $db ->query("update {$cfg['tb_pre']}member set m_loginnum=m_loginnum+1,m_integral=m_integral+$integral,m_logindate=NOW(),m_loginip='$ip' where m_login='$login'");
                    @session_start();
                    $_SESSION["username"]=$login;
//                    $waphtml.="<font color=\"#ff0000\">成功登录!</font><br>";
//                    $waphtml.="<div class=\"con\"><a href=\"?a=member\">进入会员中心</a> <a href=\"index.php\">返回首页</a></div>\n\r";
//					echo $waphtml;
//                    exit();
                    showwapmsg('成功登录!','?a=member');exit();
				}
			}
			else{
				$waphtml.="<font color=\"#ff0000\">你的用户名不存在!</font><br>";
			}
    }else{
        $waphtml.="<font color=\"#ff0000\">用户和密码没填写完整!</font><br>";
    }
    $waphtml.="<div class=\"con\"><a href=\"?a=login\">重新登录</a> <a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='aboutus'){
	$id=intval($id);
	if($id==0){
		$waphtml.="您浏览的内容不存在，请访问其他内容！";
	}else{
		$rs = $db->get_one("select c_title,c_content from {$cfg['tb_pre']}common where c_id=$id");
		if($rs){
			$waphtml.="<div class=\"tit\">".$rs['c_title']."</div>\n\r";
			$waphtml.="<div class=\"con\">\n\r";
			$waphtml.=$rs['c_content'];
			$waphtml.="</div>\n\r";
		}else{
			$waphtml.="该栏目不存在，请访问其他内容！";
		}
	}
	$waphtml.="<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='news'){
	$waphtml.="<div class=\"tit\">人力资讯</div>\n\r";
	$waphtml.="<div class=\"con\">\n\r";
	$id=intval($id);
	if($id==0){
		$waphtml.="您浏览的内容不存在，请访问其他内容！";
	}else{
		$rs = $db->get_one("select n_title,n_content,n_addtime,s_id,s_name from {$cfg['tb_pre']}news,{$cfg['tb_pre']}newssort where n_sid=s_id and n_id=$id");
		if($rs){
			$waphtml.="<b>".$rs['n_title']."</b><br>";
			$waphtml.="发布时间：".$rs['n_addtime']."<br>";
			$n_content=$rs['n_content'];
			$arr = explode("<!-- pagebreak -->",$n_content); 
			$total = count($arr); 
			$nowpage = $_GET['page']?$_GET['page']:1; 
			$prepage = $nowpage==1?1:$nowpage-1; 
			$nextpage = $nowpage>$total-1?$total:$nowpage+1; 
			$lastpage = $total; 
			$pdiv = "<br /><div class=\"conpage\">";
			if($nowpage>1){
				$pdiv .= "<li><a href=\"?a=news&id=$id&page=$prepage\" style=\"text-decoration:none;\"> 上一页 </a></li>"; 
			}
			if($nowpage<$total){
				$pdiv .= " <li><a href=\"?a=news&id=$id&page=$nextpage\" style=\"text-decoration:none;\"> 下一页</a></li>"; 
			}
			$pdiv .= '</div>';  
			$n_content=$arr[$nowpage-1];
			if( $total <=1) $pdiv = ''; 
			$n_content.=$pdiv;
			$waphtml.=$n_content;
		}else{
			$waphtml.="该栏目不存在，请访问其他内容！";
		}
	}
	$waphtml.="</div>\n\r";
	$waphtml.="<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='newslist'){
	$waphtml.="<div class=\"tit\">人力资讯</div>
	<div class=\"con\">\n\r";
	$page = $_GET['page']?$_GET['page']:1;
	$total=10;
	$prepage = $page==1?1:$page-1; 
	$nextpage = $page>$total-1?$total:$page+1; 
	$lastpage = $total;
	$offset = 10*($page-1);
	$sql="select n_id,n_title from {$cfg['tb_pre']}news order by n_id desc limit $offset,10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
	$waphtml.="<a href=\"?a=news&id=$row[n_id]\">$row[n_title]</a><br>";
	}
	$waphtml.="<div class=\"conpage\">";
	if($page>1){
		$waphtml.="<li><a href=\"?a=newslist&page=1\" style=\"text-decoration:none;\"> 首页 </a></li>";
		$waphtml.="<li><a href=\"?a=newslist&page=$prepage\" style=\"text-decoration:none;\"> 上页 </a></li>"; 
	}
	if($page<$total){
		$waphtml.=" <li><a href=\"?a=newslist&page=$nextpage\" style=\"text-decoration:none;\"> 下页 </a></li>"; 
		$waphtml.=" <li><a href=\"?a=newslist&page=$total\" style=\"text-decoration:none;\"> 尾页 </a></li>";
	}
	$waphtml.="</div>
	</div>
	<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='company'){
    if($s=='contact'){
        $waphtml.="<div class=\"tit\">联系方式</div>
    	<div class=\"con\">\n\r";
        $id=intval($id);
    	if($id==0){
    		$waphtml.="您浏览的内容不存在，请访问其他内容！";
    	}else{
            @session_start();
            if(isset($_SESSION["username"])){
                $username=$_SESSION["username"];
                $db ->query("update {$cfg['tb_pre']}member set m_hits=m_hits+1 where m_id=$id");
                $rs = $db->get_one("select m_address,m_post,m_contact,m_telshowflag,m_tel,m_fax,m_emailshowflag,m_email from {$cfg['tb_pre']}member where m_id=$id");
        		if($rs){
                    $waphtml.="联系人：".$rs['m_contact'];
                    if($rs['m_telshowflag']==1) $waphtml.="电话：".$rs['m_tel'];
                    if($rs['m_emailshowflag']==1) $waphtml.="Email：".$rs['m_email'];
        			$waphtml.="地址：".$rs['m_address'];
        		}else{
                    $waphtml.="联系方式读取出错!";exit;
        		}
            }else{
                $waphtml.="您还没有登录无法查看！<br>";
                $waphtml.="<a href=\"?a=login\">【立即登录】</a> <a href=\"?a=reg\">【免费注册】</a>";
            }
    	}
        $waphtml.="</div>\n\r";
    }else{
    	$waphtml.="<div class=\"tit\">公司介绍</div>\n\r";
    	$waphtml.="<div class=\"con\">\n\r";
    	$id=intval($id);
    	if($id==0){
    		$waphtml.="您浏览的内容不存在，请访问其他内容！";
    	}else{
            $rs = $db->get_one("select m_id,m_name,m_seat,m_trade,m_ecoclass,m_workers,m_introduce from {$cfg['tb_pre']}member where m_flag=1 and m_id=$id");
    		if($rs){
    			$waphtml.="<b>".$rs['m_name']."</b><br>";
                $waphtml.="<a href=\"?a=hirelist&cid=$rs[m_id]\">招聘职位</a> <a href=\"?a=company&s=contact&id=$rs[m_id]\">联系方式</a><br>";
                $waphtml.="所属行业：".$rs['m_trade']."<br>";
                $waphtml.="公司性质：".$rs['m_ecoclass']."<br>";
                $waphtml.="公司规模：".$rs["m_workers"]."<br>";
                $waphtml.="所在地区：".xreplace($rs["m_seat"])."<br>";
                $waphtml.="公司简介：<br>".$rs['m_introduce']."<br>";
    		}else{
    			$waphtml.="该栏目不存在，请访问其他内容！";
    		}
    	}
    	$waphtml.="</div>\n\r";
    }
	$waphtml.="<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='hire'){
	$waphtml.="<div class=\"tit\">职位信息</div>\n\r";
	$waphtml.="<div class=\"con\">\n\r";
	$id=intval($id);
	if($id==0){
		$waphtml.="您浏览的内容不存在，请访问其他内容！";
	}else{
        $rs = $db->get_one("select h_id,h_adddate,h_place,h_number,h_type,h_enddate,h_workadd,h_edu,h_pay,h_experience,h_comid,h_comname,h_introduce from {$cfg['tb_pre']}hire where h_status=1 and h_id=$id");
		if($rs){
			$waphtml.="<a href=\"?a=company&id=$rs[h_comid]\">公司介绍</a> <a href=\"?a=company&s=contact&id=$rs[h_comid]\">联系方式</a><br>";
			$waphtml.="职位名称：<b>".$rs['h_place']."</b><br>";
            $waphtml.="单位名称：".$rs['h_comname']."<br>";
            $waphtml.="招聘类别：".hiretype($rs["h_type"])."<br>";
            $waphtml.="招聘人数：".hirenumber($rs["h_number"])."<br>";
            $waphtml.="薪资待遇：".hirepay($rs["h_pay"])."<br>";
            $waphtml.="学历要求：".hireedu($rs["h_edu"])."<br>";
            $waphtml.="工作经验：".hireexperience($rs["h_experience"])."<br>";
            $waphtml.="工作地区：".xreplace($rs["h_workadd"],1)."<br>";
			$waphtml.="发布时间：".$rs['h_adddate']."<br>";
            $waphtml.="职位描述：<br>".$rs['h_introduce']."<br>";
		}else{
			$waphtml.="该栏目不存在，请访问其他内容！";
		}
	}
	$waphtml.="</div>\n\r";
	$waphtml.="<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='hirelist'){
    $page = $_GET['page']?$_GET['page']:1;
	$offset = 10*($page-1);
	$workadds=hireworkadd($workadd);
	$sqls= $workadd!=0 ? " and h_workadd like '%$workadds%'":"";
    if(empty($word)) $word='';
    $wordt='';
    if($word!=''){
        if($cfg['db_charset']=='gbk') $word=iconv("UTF-8","GB2312",$word); 
        if($stype==2){
            $sqls.=" and h_comname like '%$word%'";
        }else{
            $sqls.=" and h_place like '%$word%'";
        }
        $wordt=$word."相关的";
    }
	$waphtml.="<div class=\"tit\">";
    $cid=intval($cid);
	if($cid==0){
	   if($s=='hot'){$waphtml.= $wordt."推荐职位";}else{$waphtml.= $wordt."最新职位";}
    }else{
        $waphtml.="招聘职位";
    }
	$waphtml.="</div>\n\r";
	$waphtml.="<div class=\"con\">\n\r";
    if($cid!=0){
        $sqls.=" and h_comid=$cid";
        $waphtml.="<a href=\"?a=company&id=$cid\">公司介绍</a> <a href=\"?a=company&s=contact&id=$cid\">联系方式</a><br>";
    }
	if($s=='hot'){
		$sql="select h_id,h_place,h_number,h_workadd,h_pay,h_comname from {$cfg['tb_pre']}hire where h_status=1 and h_comm=1 and DATEDIFF(h_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(h_commend,'".date('Y-m-d')."')>=0 $sqls order by h_adddate desc limit $offset,10";
		$counts = $db->counter("{$cfg['tb_pre']}hire","h_status=1 and h_comm=1 and DATEDIFF(h_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(h_commend,'".date('Y-m-d')."')>=0 $sqls");
	}else{
		$sql="select h_id,h_place,h_number,h_workadd,h_pay,h_comname from {$cfg['tb_pre']}hire where h_status=1 $sqls order by h_adddate desc limit $offset,10";
		$counts = $db->counter("{$cfg['tb_pre']}hire","h_status=1 $sqls");
	}
	$total=ceil($counts/10);
	if($total>10) $total=10;
	$prepage = $page==1?1:$page-1; 
	$nextpage = $page>$total-1?$total:$page+1; 
	$lastpage = $total;
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
	$waphtml.="<a href=\"?a=hire&id=$row[h_id]\">$row[h_place]</a><br>";
	if($cid==0){$waphtml.="$row[h_comname]<br>";}
	$waphtml.="招聘人数：".hirenumber($row["h_number"])."<br>";
	$waphtml.="工作地区：".xreplace($row["h_workadd"],1)."<br>";
	$waphtml.="薪资待遇：".hirepay($row["h_pay"])."<br>";
	}
	$waphtml.="<div class=\"conpage\">";
	if($page>1){
		$waphtml.="<li><a href=\"?a=hirelist&s=$s&workadd=$workadd&cid=$cid&word=$word&page=1\" style=\"text-decoration:none;\"> 首页 </a></li>";
		$waphtml.="<li><a href=\"?a=hirelist&s=$s&workadd=$workadd&cid=$cid&word=$word&page=$prepage\" style=\"text-decoration:none;\"> 上页 </a></li>"; 
	}
	if($page<$total){
		$waphtml.=" <li><a href=\"?a=hirelist&s=$s&workadd=$workadd&cid=$cid&word=$word&page=$nextpage\" style=\"text-decoration:none;\"> 下页 </a></li>"; 
		$waphtml.=" <li><a href=\"?a=hirelist&s=$s&workadd=$workadd&cid=$cid&word=$word&page=$total\" style=\"text-decoration:none;\"> 尾页 </a></li>";
	}
	$waphtml.="</div>
	</div>
	<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='addvhire'){
    $waphtml.="<div class=\"tit\">发布微招聘</div>\n\r";
    $waphtml.="<div class=\"con\">\n\r";
    $waphtml.="<form name=\"vform\" action=\"?a=addsave\" method=\"post\">
            招聘单位：<input name=\"v_comname\" type=\"text\" id=\"v_comname\" size=\"20\" /><br />
            招聘岗位：<input name=\"v_place\" type=\"text\" id=\"v_place\" size=\"20\" /><br />
            招聘人数：<input name=\"v_number\" type=\"text\" id=\"v_number\" size=\"3\" />人<br />
            应聘要求：<input name=\"v_request\" type=\"text\" id=\"v_request\" size=\"20\" /><br />
            面试地址：<input name=\"v_address\" type=\"text\" id=\"v_address\" size=\"20\" /><br />
            联系电话：<input name=\"v_tel\" type=\"text\" id=\"v_tel\" size=\"20\" /><br />
            联系人：<input name=\"v_contact\" type=\"text\" id=\"v_contact\" size=\"10\" /><br />
            有效期：<select name=\"v_validity\" id=\"v_validity\">
            <option value=\"3\">3天</option>
            <option value=\"5\">5天</option>
            <option value=\"10\">10天</option>
            <option value=\"30\">30天</option>
            <option value=\"180\">半年</option>
            <option value=\"365\">一年</option>
            <option value=\"9999\">长期</option>
            </select>
            <input name=\"Submit\" type=\"submit\" value=\"发布\" />
            </form>
    </div>
    <div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='addsave'){
    unset($_POST['Submit']);
    $tv=$tvs='';$ip=getip();
    foreach($_POST as $key=>$value){
		if($value==''){
			continue;
		}else{
            if($cfg['db_charset']=='gbk') $value=iconv("UTF-8","GB2312",$value);
            $tv.="$key,";
            $tvs.="'".cleartags($value)."',";
		}
    }
    $tv=substr($tv,0,-1);	
	$tvs=substr($tvs,0,-1);	
    if($_POST['v_place']==''||$_POST['v_tel']==''){
        showwapmsg('职位名称及联系电话不能为空！！！','0');exit();
    }else{
        $db ->query("INSERT INTO {$cfg['tb_pre']}vhire ($tv,v_adddate,v_ip,v_flag) VALUES($tvs,NOW(),'$ip',1)");
        showwapmsg('发布成功！','?a=vhire');exit();
    }
}elseif($a=='vhire'){
    $page = $_GET['page']?$_GET['page']:1;
	$offset = 10*($page-1);
    if(empty($word)) $word='';
    $wordt='';$sqls='';
    if($word!=''){
        if($cfg['db_charset']=='gbk') $words=iconv("UTF-8","GB2312",$word); 
        if($stype==1){
            $sqls.=" and v_comname like '%$words%'";
            $wordt=$words;
        }else{
            $sqls.=" and v_place like '%$words%'";
            $wordt=$words."-";
        }
    }
	$waphtml.="<div class=\"tit\">";
    $waphtml.="{$wordt}微职位列表  <a href=\"?a=addvhire\"><font color=\"#ffffff\">快速发布</font></a>";
	$waphtml.="</div>\n\r";
	$waphtml.="<div class=\"con\">\n\r";
    $sql="SELECT * FROM `".$cfg['tb_pre']."vhire` WHERE `v_flag`=1 $sqls ORDER BY `v_adddate` DESC LIMIT $offset,10";
    $counts = $db->counter("{$cfg['tb_pre']}vhire","`v_flag`=1 $sqls");
	$total=ceil($counts/10);
	if($total>10) $total=10;
	$prepage = $page==1?1:$page-1; 
	$nextpage = $page>$total-1?$total:$page+1; 
	$lastpage = $total;
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
    	$waphtml.="<li><span>".time_tran($row["v_adddate"])." </span> <a href=\"?a=vhire&word=$row[v_comname]&stype=1\">$row[v_comname]</a> 招聘 <a href=\"?a=vhire&word=$row[v_place]&stype=2\">$row[v_place]</a> ";
        if($row["v_number"]==0){
            $waphtml.="若干";
        }else{
            $waphtml.=$row["v_number"];
        }
        $waphtml.=" 名，要求：{$row[v_request]} 联系人：{$row[v_contact]} 电话：{$row[v_tel]} 地址：{$row[v_address]}</li>";
	}
	$waphtml.="<div class=\"conpage\">";
	if($page>1){
		$waphtml.="<li><a href=\"?a=vhire&page=1&stype=$stype&word=$word\" style=\"text-decoration:none;\"> 首页 </a></li>";
		$waphtml.="<li><a href=\"?a=vhire&page=$prepage&stype=$stype&word=$word\" style=\"text-decoration:none;\"> 上页 </a></li>"; 
	}
	if($page<$total){
		$waphtml.=" <li><a href=\"?a=vhire&page=$nextpage&stype=$stype&word=$word\" style=\"text-decoration:none;\"> 下页 </a></li>"; 
		$waphtml.=" <li><a href=\"?a=vhire&page=$total&stype=$stype&word=$word\" style=\"text-decoration:none;\"> 尾页 </a></li>";
	}
	$waphtml.="</div>
	</div>
	<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}elseif($a=='province'){    
    $waphtml.="<div class=\"tit\">地区招聘</div>
    <div class=\"con\">";
    $sql="select p_id,p_name from {$cfg['tb_pre']}provinceandcity where p_fid=0 order by p_order asc limit 0,100";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    $waphtml.="<a href=\"?a=hirelist&workadd=$row[p_id]\">$row[p_name]</a> ";
    }
    $waphtml.="</div>";
	$waphtml.="<div class=\"con\"><a href=\"index.php\">返回首页</a></div>\n\r";
}else{
    $waphtml.="<div id=\"con\">欢迎访问本站！ <a href=\"?a=login\">登录</a> | <a href=\"?a=reg\">注册</a><br />职位<a href=\"?a=hirelist&s=new\">最新</a>|<a href=\"?a=hirelist&s=hot\">推荐</a>|<a href=\"?a=vhire\">微招聘</a>|<a href=\"?a=newslist\">资讯</a></div>
    <div class=\"tit\">职位搜索</div>
    <div class=\"con\">
    <form id=\"form1\" name=\"form1\" method=\"post\" action=\"?a=hirelist\">
    关键字：  <input name=\"word\" type=\"text\" id=\"word\" style=\"WIDTH: 100px; HEIGHT: 15px;border: 1px solid #7F9DB9;\" />
    <br />
    <input name=stype type=radio value=1 checked=checked />
    职位名
    <input type=radio name=stype value=2 /> 
    公司名
    <input type=\"submit\" name=\"Submit\" value=\"搜索\" />
    </form>
    </div>
    <div class=\"tit\">地区招聘</div>
    <div class=\"con\">";

    $sql="select p_id,p_name from {$cfg['tb_pre']}provinceandcity where p_fid=0 order by p_order asc limit 0,10";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $waphtml.="<a href=\"?a=hirelist&workadd=$row[p_id]\">$row[p_name]</a> ";
    }
    $waphtml.="<a href=\"?a=province\">更多...</a>";
    $waphtml.="</div>
    <div class=\"tit\">推荐职位</div>
    <div class=\"con\">";

    $sql="select h_id,h_place,h_number from {$cfg['tb_pre']}hire where h_status=1 and h_comm=1 and DATEDIFF(h_commstart,'".date('Y-m-d')."')<=0 and DATEDIFF(h_commend,'".date('Y-m-d')."')>=0 order by h_adddate desc limit 0,10";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $waphtml.="<a href=\"?a=hire&id=$row[h_id]\">$row[h_place]</a> ";
    }
    $waphtml.="<a href=\"?a=hirelist&s=hot\">更多...</a>";
    $waphtml.="</div>
    <div class=\"tit\">最新招聘</div>
    <div class=\"con\">";

    $sql="select m_id,m_name from {$cfg['tb_pre']}member where m_flag=1 and m_typeid=2 and m_ishire>0 and DATEDIFF(m_startdate,'".date('Y-m-d')."')<=0 and DATEDIFF(m_enddate,'".date('Y-m-d')."')>=0 order by m_activedate desc limit 0,8";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $waphtml.="<a href=\"?a=company&id=$row[m_id]\">$row[m_name]</a><br>";
    }
    $waphtml.="<a href=\"?a=hirelist&s=new\">更多...</a>";
    $waphtml.="</div>
    <div class=\"tit\">人力资讯</div>
    <div class=\"con\">";

    $sql="select n_id,n_title from {$cfg['tb_pre']}news order by n_id desc limit 0,8";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
        $waphtml.="<a href=\"?a=news&id=$row[n_id]\">$row[n_title]</a><br>";
    }
    $waphtml.="<a href=\"?a=newslist\">更多...</a>";
    $waphtml.="</div>";
}
$waphtml.="<hr class=\"line\" />
<div class=\"con\"><a href=\"?a=aboutus&id=1\">关于我们</a> <a href=\"?a=aboutus&id=7\">联系我们</a></div>
客服热线：$cfg[phone]<br />
$cfg[sitename] 版权所有<br />Powered by FRhrCms".stripslashes($cfg['count'])."
</body>
</html>";
echo $waphtml;
function showwapmsg($msg,$gourl,$onlymsg=0,$limittime=0){
    global $cfg;
    $sitename=$cfg['sitename'];
    $siteurl=$cfg['siteurl'];
    $path=$cfg['path'];
	if(empty($siteurl)) $siteurl = '..';
	$htmlhead  = "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>提示信息_$sitename</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$cfg['charset']}\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>";
	$htmlhead .= "*{font-size:12px;color:#2B61BA;}\r\n";
	$htmlhead .= "body{font-family:\"微软雅黑\",\"宋体\", Verdana, Arial, Helvetica, sans-serif;background:#FFFFFF;margin:0;}\r\n";
	$htmlhead .= "a:link,a:visited,a:active {color:#ABBBD6;text-decoration:none;}\r\n";
	$htmlhead .= ".msg{width:100%;text-align:left;background:#FFFFFF url('{$path}skin/default/msgbg.gif') repeat-x;margin:auto;}\r\n";
    $htmlhead .= ".head{letter-spacing:2px;line-height:29px;height:26px;overflow:hidden;font-weight:bold;}\r\n";
    $htmlhead .= ".content{padding:10px 20px 5px 20px;line-height:200%;word-break:break-all;border:#7998B7 1px solid;border-top:none;}\r\n";
    $htmlhead .= ".ml{color:#FFFFFF;background:url('{$path}skin/default/msg.gif') no-repeat 0 0;padding-left:10px;}\r\n";
    $htmlhead .= ".mr{float:right;background:url('{$path}skin/default/msg.gif') no-repeat 0 -34px;width:4px;font-size:1px;}\r\n";
    $htmlhead .= "</style></head>\r\n<body leftmargin='0' topmargin='0'>".(isset($GLOBALS['ucsynlogin']) ? $GLOBALS['ucsynlogin'] : '')."\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";
	$litime = ($limittime==0 ? 1000 : $limittime);
	$func = '';
	if($gourl=='-1'){
		if($limittime==0) $litime = 5000;
		$gourl = "javascript:history.go(-1);";
	}
	if($gourl=='0'){
		if($limittime==0) $litime = 5000;
		$gourl = "javascript:history.back();";
	}
	if($gourl=='' || $onlymsg==1){
		$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
	}else{
		if(preg_match('/close::/i',$gourl)){
			$tgobj = trim(eregi_replace('close::', '', $gourl));
			$gourl = 'javascript:;';
			$func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
		}
		
		$func .= "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
		$rmsg = $func;
		$rmsg .= "document.write(\"<br /><br /><br /><div class='msg'>";
		$rmsg .= "<div class='head'><div class='mr'> </div><div class='ml'>提示信息！</div></div>\");\r\n";
		$rmsg .= "document.write(\"<div class='content'>\");\r\n";
		$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		
		if($onlymsg==0){
			if( $gourl != 'javascript:;' && $gourl != ''){
				$rmsg .= "<br /><a href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a>";
				$rmsg .= "</div>\");\r\n";
				$rmsg .= "setTimeout('JumpUrl()',$litime);";
			}else{
				$rmsg .= "</div>\");\r\n";
			}
		}else{
			$rmsg .= "<br/></div>\");\r\n";
		}
		$msg  = $htmlhead.$rmsg.$htmlfoot;
	}
	echo $msg;
}