<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
function createhtml($dofile,$coid=0,$soid=0,$num=0){
    global $cfg,$db,$_GET;
    if($cfg['createhtml']!=1){
        showmsg('生成HTML未启动!');exit();
    }else{
        require_once(dirname(__FILE__).'/common.func.php');
        $coid=intval($coid);
        $num=intval($num);
        switch($dofile) {
            case 'index':
				ob_start();
				include template('index');
				$data = ob_get_contents();
                $data.= "<script src=\"{$cfg['path']}autohtml.php?do=index\"></script>";
				ob_clean();
				$filename= FR_ROOT."/index.".$cfg['defaultext'];
				file_put($filename, $data);
				return true;
        	break;
            case 'allindex':
				$sql="select c_id,c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_channeltype!=2 order by c_order asc";
				$query=$db->query($sql);
				while($row=$db->fetch_array($query)){
					$c_id=$row['c_id'];
					$c_name=$row['c_name'];
					$c_channeldir=$row['c_channeldir'];
					$c_keywords=$row['c_keywords'];
					$c_description=$row['c_description'];
					$cid=$c_id;
					@session_start();
					$_SESSION["channelid"] = $cid;
					$_SESSION["typeid"] = "";
					ob_start();
					include template('index',$c_channeldir);
					$data = ob_get_contents();
                    $data.= "<script src=\"{$cfg['path']}autohtml.php?do=index&id=$cid\"></script>";
					ob_clean();
					$filenames=formatlink(0,$c_id,0,0,0);
					$filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
					file_put($filename, $data);
				}
				return true;
        	break;
            case 'common':
				$sql="select c_id,c_title,c_content,c_template,c_htmlname from {$cfg['tb_pre']}common order by c_isorder asc";
				$query=$db->query($sql);
				while($row=$db->fetch_array($query)){
					$commonid=$row['c_id'];
                    $commontitle=$row['c_title'];
					$commoncontent=$row['c_content'];
					$commoncontent=replace_alllabel($commoncontent);
					$commoncontent=replace_cfglabel($commoncontent);
					$commontemplate=$row['c_template'];
					$commonhtmlname=$row["c_htmlname"];
					$commonlist=getsitebottomnav(1);
					ob_start();
					include template($commontemplate,'common');
					$data = ob_get_contents();
                    $data.= "<script src=\"{$cfg['path']}autohtml.php?do=common&id=$commonid\"></script>";
					ob_clean();
					$filename=FR_ROOT.'/'.$cfg['htmlpath'].'about/'.$commonhtmlname.".".$cfg['defaultext'];
					file_put($filename, $data);
				}
				return true;
        	break;
            case 'newslist':
                @session_start();
                $rsdb=array();
                $csql="select c_id,c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_moduletype=10 and c_createhtml!=0 and c_disabled=0 order by c_order asc";
                $query=$db->query($csql);
                while($row=$db->fetch_array($query)){
	               $rsdb[]=$row;
                }
                if($coid==0){$sqlss="";}else{$sqlss=" and s_cid=$coid";}
                if($soid!=0&&$coid!=0){$sqlss.=" and s_id=$soid";}else{$sqlss.="";}
                if($sqlss!='') $sqlss=" where".substr($sqlss,4);
                $sql="select s_id,s_name,s_cid from {$cfg['tb_pre']}newssort $sqlss";
                $query=$db->query($sql);
                while($row=$db->fetch_array($query)){
                    $_SESSION["channelid"] = $row['s_cid'];
                    $s_id=$row['s_id'];
                    $cid=$s_cid=$row['s_cid'];
                    $s_name=$row['s_name'];
                    $_SESSION["typeid"] = $row['s_id'];
                    foreach($rsdb as $key=>$rs){
                        if($rs['c_id']==$row['s_cid']){
                            $c_name=$rs['c_name'];
                            $c_channeldir=$rs['c_channeldir'];
                            $c_keywords=$rs['c_keywords'];
                            $c_description=$rs['c_description'];
                        }
                    }
                    $counts = $db->counter("{$cfg['tb_pre']}news","n_sid={$row['s_id']}");
                    $pages = ceil($counts/20);
                    for($i=1;$i<=$pages;$i++){
                        $_SESSION["page"] = $i;
                        ob_start();
                        include template('list',$c_channeldir);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=list&id=$s_id\"></script>";
                        ob_clean();
                        $filenames=formatlink(0,$s_cid,$s_id,0,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                    }
                }
                return true;
        	break;
            //生成资讯内容页
            case 'newspage':
                @session_start();
                $rsdb=array();$cidt=$coid;
                if($coid==0){$sqls=$sqlss="";}else{$sqls=" where n_cid=$coid";$sqlss=" n_cid=$coid";}
                if($soid!=0&&$coid!=0){$sqls.=" and n_sid=$soid";$sqlss.=" and n_sid=$soid";}else{$sqls.="";$sqlss.="";}
                $sql="select n_id,n_sid,n_cid,n_title,n_content,n_addtime,n_overview,n_from,n_author,n_editor,n_hits,s_name,n_keywords,n_description from {$cfg['tb_pre']}news INNER JOIN {$cfg['tb_pre']}newssort on n_sid=s_id $sqls order by n_id desc";
                if($num==0){
                    $counts = $db->counter("{$cfg['tb_pre']}news INNER JOIN {$cfg['tb_pre']}newssort on n_sid=s_id","$sqlss");
                    $num=$counts;
                }
                if($num>0){
                    $csql="select c_id,c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_moduletype=10 and c_createhtml!=0 and c_disabled=0 order by c_order asc";
                    $query=$db->query($csql);
                    while($row=$db->fetch_array($query)){
    	               $rsdb[]=$row;
                    }
                }
                $page= isset($_GET['page'])?$_GET['page']:1;
                $pages = ceil($num/100);
                $offset = 100*($page-1);
                $maxset=($num>0&&$num<100)?$num:100;
                $sql.=" limit $offset,$maxset";
                $query=$db->query($sql);
                while($row=$db->fetch_array($query)){
                    $_SESSION["channelid"] = $row['n_cid'];
                    foreach($rsdb as $key=>$rs){
                        if($rs['c_id']==$row['n_cid']){
                            $c_name=$rs['c_name'];
                            $c_channeldir=$rs['c_channeldir'];
                            $c_keywords=$rs['c_keywords'];
                            $c_description=$rs['c_description'];
                        }
                    }
                    $newsid=$n_id=$row['n_id'];
                    $n_sid=$row['n_sid'];
                    $s_name=$row['s_name'];
                    $n_sid=$row['n_sid'];
                    $cid=$n_cid=$row['n_cid'];
                    $n_title=$row['n_title'];
                    $n_content=$row['n_content'];
                    $n_addtime=$row['n_addtime'];
                    $n_overview=$row['n_overview']?"<div class=\"newsoverview\"><strong>文章概况：</strong>$row[n_overview]</div>":'';
                    $n_from=$row['n_from'];
                    $n_author=$row['n_author']?$row['n_author']:'未知';
                    $n_editor=$row['n_editor']?$row['n_editor']:'未知';
                    $n_hits=$row['n_hits'];
                    $n_keywords=$row["n_keywords"];
                    $n_description=$row["n_description"];
                    $_SESSION["typeid"] = $row['n_sid'];
                    if($n_keywords!=''){
                        $nkeywords=explode(',',$n_keywords);$n_keywordslist='本文关键词：';
                        foreach($nkeywords as $v){
                            $n_keywordslist.="<a href=\"$cfg[path]search/news_search.php?cid=$n_cid&keywords=$v\">$v</a>　";
                        }
                    }
                    if($n_keywords=='') $n_keywords=$n_title;
                    if($n_description=='') $n_description=$row['n_overview']?$row['n_overview']:$n_title;
                    $arr = explode("<!-- pagebreak -->",$n_content); 
                    $total = count($arr);
                    for($i=1;$i<=$total;$i++){
                        $nowpage = $i; 
                        $prepage = $nowpage==1?1:$nowpage-1; 
                        $nextpage = $nowpage>$total-1?$total:$nowpage+1; 
                        $lastpage = $total; 
                        $pdiv = "<br /><div class=\"conpage\">";
                        if($nowpage>1){
                            $url=formatlink($n_addtime,$n_cid,1,$newsid,$prepage);
                            $pdiv .= "<li><a href=\"{$url}\" style=\"text-decoration:none;\"> 上一页 </a></li>"; 
                        }
                        if($nowpage<$total){
                            $url=formatlink($n_addtime,$n_cid,1,$newsid,$nextpage);
                            $pdiv .= " <li><a href=\"{$url}\" style=\"text-decoration:none;\"> 下一页</a></li>"; 
                        }
                        $pdiv .= '</div>';  
                        $n_content=$arr[$nowpage-1];
                        if( $total <=1) $pdiv = ''; 
                        $n_content.=$pdiv;
                        ob_start();
                        include template('article',$c_channeldir);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=article&id=$newsid\"></script>";
                        ob_clean();
                        $filenames=formatlink($n_addtime,$n_cid,1,$newsid,$nowpage);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                    }
                }
                $pagen=$page+1;$cid=$cidt;
                if($page<$pages){
                    $s1=$offset;$s2=$page*100;
                    showmsg($s1.'-'.$s2.'条生成成功',"?do=newspage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                }
                return true;
        	break;
            //生成求职内容页
            case 'personpage':
                $rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_id=1");
                if($rs){
                    extract($rs);
                }else{
                    showmsg('频道生成未开启!');exit();
                }
                if($coid==1){
                    $rsqlstr=array('r_member','r_id','r_adddate','r_name','r_sex','r_birth',
                    'r_cardtype','r_idcard','r_nation','r_marriage','r_height','r_polity',
                    'r_weight','r_hukou','r_seat','r_school','r_graduate','r_edu','r_zhicheng','r_sumup',
                    'r_appraise','r_jobtype','r_trade','r_position','r_workadd','r_pay','r_stay','r_workdate',
                    'r_request','r_tel','r_chat','r_email','r_url','r_address','r_post','r_visitnum',
                    'r_usergroup','r_openness','r_title','r_template','r_ability','m_logo','m_logoflag','m_logostatus','m_nameshow','m_qzstate','m_groupid');
                    $sqlss='';
                    foreach($rsqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id where m_typeid=1 order by r_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id","m_typeid=1");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($rsqlstr as $v) $$v=$rs[$v];
                        $rsg = $db->get_one("select g_hide from {$cfg['tb_pre']}group where g_id=$m_groupid");
                        if($rsg){$g_hide=$rsg['g_hide'];}
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0||$m_logostatus==0)?$cfg['path'].'upfiles/person/nophoto.gif':$m_logo;
                        $r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'小姐/女士');
                        $rid=$r_id;$edudb=$trainingdb=$langdb=$workdb=array();
                        $querys=$db->query("select * from {$cfg['tb_pre']}education where e_rid=$rid");
                        while($rows=$db->fetch_array($querys)) $edudb[]=$rows;
                        $querys=$db->query("select * from {$cfg['tb_pre']}training where t_rid=$rid");
                        while($rows=$db->fetch_array($querys)) $trainingdb[]=$rows;
                        $querys=$db->query("select * from {$cfg['tb_pre']}lang where l_rid=$rid");
                        while($rows=$db->fetch_array($querys)) $langdb[]=$rows;
                        $querys=$db->query("select * from {$cfg['tb_pre']}work where w_rid=$rid");
                        while($rows=$db->fetch_array($querys)) $workdb[]=$rows;
                        ob_start();
                        include template('cnresume_view','person');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=person&id=$r_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($r_adddate,1,1,$r_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=personpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }else{
                    $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_logostatus','m_seat','m_birth','m_edu','m_sex','m_template','m_nameshow','p_id','p_name','p_info','p_filename','p_type');
                    $sqlss='';
                    foreach($sqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login where p_status=1 and p_flag=1 and (p_type=21 or p_type=22) order by p_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login",'p_status=1 and p_flag=1 and (p_type=21 or p_type=22)');
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($sqlstr as $v) $$v=$rs[$v];
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0||$m_logostatus==0)?$cfg['path'].'upfiles/person/nophoto.gif':$m_logo;
                        $r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'小姐/女士');
                        if($m_introduce=='') $m_introduce="暂无简介！";
                        $pic=substr($p_filename,0,3)=="../"?$cfg['path'].substr($p_filename,3):$p_filename;
                        if($p_type==21){$p_type="资格证书";}else{$p_type="职场风采";}
                        ob_start();
                        include template('pic','person');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=perpic&id=$p_id\"></script>";
                        ob_clean();
                        $filenames=formatlink(0,1,2,$p_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=personpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }
                return true;
        	break;
            //生成招聘内容页
            case 'companypage':
                $rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_id=2");
                if($rs){
                    extract($rs);
                }else{
                    showmsg('频道生成未开启!');exit();
                }
                if($coid==1){
                    $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','g_name','g_hide');
                    $sqlss='';
                    foreach($sqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=2 order by m_id desc";                    
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id","m_typeid=2");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($sqlstr as $v) $$v=$rs[$v];
                        $comid=$m_id;
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                        if($m_introduce=='') $m_introduce="暂无公司简介！";
                        $m_seat=xreplace($m_seat);
                        $m_group=membergroup($m_groupid,1);
                        if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                        ob_start();
                        include template('company','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=company&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,2,1,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=companypage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==2){
                    $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','g_name','g_hide');
                    $sqlss='';
                    foreach($sqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=2 order by m_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id",'m_typeid=2');
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($sqlstr as $v) $$v=$rs[$v];
                        $comid=$m_id;
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                        if($m_introduce=='') $m_introduce="暂无公司简介！";
                        $m_seat=xreplace($m_seat);
                        $m_group=membergroup($m_groupid,1);
                        if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                        $hsqlstr=array('h_id','h_place','h_type','h_dept','h_adddate','h_enddate','h_experience','h_edu','h_number','h_profession','h_pay','h_sex','h_age1','h_age2','h_workadd','h_introduce');
                        $hsqlss='';$hirelistdb=array();
                        foreach($hsqlstr as $v) $hsqlss.="$v,";
                        $hsqlss=substr($hsqlss,0,-1);
                        $queryh=$db->query("select $hsqlss from {$cfg['tb_pre']}hire where h_comid=$m_id");
                        while($rowh=$db->fetch_array($queryh)){
                            $hirelistdb[]=$rowh;
                        }
                        ob_start();
                        include template('hires','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hires&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,2,2,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=companypage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==3){
                    $hsqlstr=array('h_id','h_place','h_comid','h_type','h_dept','h_adddate','h_enddate','h_experience','h_edu','h_number','h_profession','h_position','h_pay','h_sex','h_age1','h_age2','h_workadd','h_introduce','m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_template','m_confirm','g_name','g_hide');
                    $sqlss='';
                    foreach($hsqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_comid=m_id INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id order by h_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_comid=m_id INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($hsqlstr as $v) $$v=$rs[$v];
                        $comid=$m_id;$hireid=$h_id;
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                        $m_seat=xreplace($m_seat);
                        $m_group=membergroup($m_groupid,1);
                        if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                        ob_start();
                        include template('hire','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hire&id=$h_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($h_adddate,2,3,$h_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=companypage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }else{
                    $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','p_id','p_name','p_info','p_filename','p_type');
                    $sqlss='';
                    foreach($sqlstr as $v) $sqlss.="$v,";
                    $sqlss=substr($sqlss,0,-1);
                    $sql="select $sqlss from {$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login where p_status=1 and p_flag=1 and p_type=12 order by p_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login",'p_status=1 and p_flag=1 and p_type=12');
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        foreach($sqlstr as $v) $$v=$rs[$v];
                        $pid=$p_id;
                        $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                        if($m_introduce=='') $m_introduce="暂无公司简介！";
                        $m_seat=xreplace($m_seat);
                        $g_name=membergroup($m_groupid,0);
                        if($m_confirm==0){$m_confirm='尚未通过认证';}else{$m_confirm='已通过营业执照认证';}
                        $pic=substr($p_filename,0,3)=="../"?$cfg['path'].substr($p_filename,3):$p_filename;
                        ob_start();
                        include template('pic','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=compic&id=$p_id\"></script>";
                        ob_clean();
                        $filenames=formatlink(0,2,4,$p_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=companypag&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }
                return true;
        	break;
            //生成猎头内容页
            case 'hrpage':
                $rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_id=4");
                if($rs){
                    extract($rs);
                }else{
                    showmsg('频道生成未开启!');exit();
                }
                if($coid==1){
                    $sql="select * from {$cfg['tb_pre']}common where c_type=2 order by c_id desc";                    
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}common","c_type=2");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);$id=$c_id;
                        ob_start();
                        include template('hr','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hr&id=$c_id\"></script>";
                        ob_clean();
                        $filenames=formatlink(0,4,1,$c_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=hrpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==2){
                    $sql="select * from {$cfg['tb_pre']}hrzp where h_flag=1 order by h_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}hrzp",'h_flag=1');
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);
                        ob_start();
                        include template('hr_hire','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hrhire&id=$h_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($h_adddate,4,3,$h_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=hrpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==3){
                    $counts = $db->counter("{$cfg['tb_pre']}hrzp","h_flag=1");
                    $pages = ceil($counts/20);
                    for($i=1;$i<=$pages;$i++){
                        $page = $i;
                        ob_start();
                        include template('hr_list','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hrlist\"></script>";
                        ob_clean();
                        $filenames=formatlink(0,4,2,1,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                    }
                }
                return true;
        	break;
            //生成院校内容页
            case 'schoolpage':
                $rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_id=3");
                if($rs){
                    extract($rs);
                }else{
                    showmsg('频道生成未开启!');exit();
                }
                if($coid==1){
                    $sql="select m_id,m_name,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,m_map,m_regdate,g_name,g_hide from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=3 order by m_id desc";                    
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id","m_typeid=3");
                        $num=$counts;
                    }
                    $p= isset($_GET['p'])?$_GET['p']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($p-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);$m_logo=ltrim($m_logo,'.');$m_group=membergroup($m_groupid,1);
                        ob_start();
                        include template('school_view','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,3,1,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        $spcounts = $db->counter("{$cfg['tb_pre']}professor","p_sid=$m_id and p_flag=1");
                        $sppages = ceil($spcounts/20);
                        for($i=1;$i<=$sppages;$i++){
                            $page = $i;
                            ob_start();
                            include template('professor_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,3,2,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                        $sdcounts = $db->counter("{$cfg['tb_pre']}department","d_sid=$m_id and d_flag=1");
                        $sdpages = ceil($sdcounts/20);
                        for($i=1;$i<=$sdpages;$i++){
                            $page = $i;
                            ob_start();
                            include template('department_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,3,6,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                        $sscounts = $db->counter("{$cfg['tb_pre']}student","s_sid=$m_id");
                        $sspages = ceil($sscounts/20);
                        for($i=1;$i<=$sspages;$i++){
                            $page = $i;
                            ob_start();
                            include template('student_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,3,4,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                        $srcounts = $db->counter("{$cfg['tb_pre']}require","r_sid=$m_id and r_flag=1");
                        $srpages = ceil($srcounts/20);
                        for($i=1;$i<=$srpages;$i++){
                            $page = $i;
                            ob_start();
                            include template('require_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,3,8,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $pagen=$p+1;
                    if($p<$pages){
                        $s1=$offset;$s2=$p*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=schoolpage&channelid=$coid&sortid=$soid&num=$num&p=$pagen");exit();
                    }
                }elseif($coid==2){
                    $sql="select * from {$cfg['tb_pre']}professor order by p_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}professor");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);$p_photo=ltrim($p_photo,'.');
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$p_sid and m_typeid =3 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                        }
                        ob_start();
                        include template('professor_info','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=professor&id=$p_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($p_adddate,3,3,$p_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=schoolpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==3){
                    $sql="select * from {$cfg['tb_pre']}student order by s_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}student");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);$s_photo=ltrim($s_photo,'.');
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$s_sid and m_typeid =3 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('student_info','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=student&id=$s_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($s_adddate,3,5,$s_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=schoolpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==4){
                    $sql="select * from {$cfg['tb_pre']}require order by r_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}require");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$r_sid and m_typeid =3 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('require_info','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=require&id=$r_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($r_adddate,3,9,$r_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=schoolpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==5){
                    $sql="select * from {$cfg['tb_pre']}department order by d_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}department");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$d_sid and m_typeid =3 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('department_info','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=department&id=$d_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($d_adddate,3,7,$d_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=schoolpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }
                return true;
        	break;
            //生成培训内容页
            case 'trainpage':
                $rs = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_id=5");
                if($rs){
                    extract($rs);
                }else{
                    showmsg('频道生成未开启!');exit();
                }
                if($coid==1){
                    $sql="select m_id, m_name,m_groupid,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,g_name,m_url,m_teachers,m_map,g_hide from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=4 order by m_id desc";                    
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id","m_typeid=4");
                        $num=$counts;
                    }
                    $p= isset($_GET['p'])?$_GET['p']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($p-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);$m_logo=ltrim($m_logo,'.');$m_group=membergroup($m_groupid,1);$id=$m_id;
                        ob_start();
                        include template('train_view','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,1,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        ob_start();
                        include template('teachers_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,6,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        ob_start();
                        include template('achievement_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,7,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        ob_start();
                        include template('pic','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,9,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        ob_start();
                        include template('contact','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,8,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        ob_start();
                        include template('map','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($m_regdate,5,10,$m_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                        $spcounts = $db->counter("{$cfg['tb_pre']}course","c_tid=$m_id");
                        $sppages = ceil($spcounts/20);
                        for($i=1;$i<=$sppages;$i++){
                            $page = $i;
                            ob_start();
                            include template('course_more','train');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,5,2,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                        $sdcounts = $db->counter("{$cfg['tb_pre']}trainer","t_tid=$m_id");
                        $sdpages = ceil($sdcounts/20);
                        for($i=1;$i<=$sdpages;$i++){
                            $page = $i;
                            ob_start();
                            include template('trainer_more','train');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                            ob_clean();
                            $filenames=formatlink($m_regdate,5,4,$m_id,$i);
                            $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $pagen=$p+1;
                    if($p<$pages){
                        $s1=$offset;$s2=$p*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=trainpage&channelid=$coid&sortid=$soid&num=$num&p=$pagen");exit();
                    }
                }elseif($coid==2){
                    $sql="select * from {$cfg['tb_pre']}course order by c_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}course");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$c_tid and m_typeid =4 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('course_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=course&id=$c_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($c_adddate,5,3,$c_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=trainpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }elseif($coid==3){
                    $sql="select * from {$cfg['tb_pre']}trainer order by t_id desc";
                    if($num==0){
                        $counts = $db->counter("{$cfg['tb_pre']}trainer");
                        $num=$counts;
                    }
                    $page= isset($_GET['page'])?$_GET['page']:1;
                    $pages = ceil($num/100);
                    $offset = 100*($page-1);
                    $maxset=($num>0&&$num<100)?$num:100;
                    $sql.=" limit $offset,$maxset";
                    $query=$db->query($sql);
                    while($rs=$db->fetch_array($query)){
                        extract($rs);
                        $t_photo=($t_photo==''||$t_photo=='error.gif')?$cfg['path'].'upfiles/train/nophoto.gif':$t_photo;
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$t_tid and m_typeid =4 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('trainer_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=trainer&id=$t_id\"></script>";
                        ob_clean();
                        $filenames=formatlink($t_adddate,5,5,$t_id,0);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        file_put($filename, $data);
                        unset($data);
                    }
                    $pagen=$page+1;
                    if($page<$pages){
                        $s1=$offset;$s2=$page*100;
                        showmsg($s1.'-'.$s2.'条生成成功',"?do=trainpage&channelid=$coid&sortid=$soid&num=$num&page=$pagen");exit();
                    }
                }
                return true;
        	break;
        }
    }
}
?>