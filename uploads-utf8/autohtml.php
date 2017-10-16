<?php
set_time_limit(1800);
require_once(dirname(__FILE__).'/config.inc.php');
if(empty($do)) $do= 'index';
$id=intval($id);
if(isset($t)&&$t==1){$t=1;}else{$t=0;}
if($cfg['createhtml']!=1||$cfg['createtime']=='0'){
    exit();
}else{
    require_once(dirname(__FILE__).'/inc/common.func.php');
    switch($do) {
    	case 'index':
        if($id!=0){
            $rs = $db->get_one("select c_id,c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_channeltype!=2 and c_id=$id");
            if($rs){
                extract($rs);
                $cid=$c_id;
                @session_start();
    			$_SESSION["channelid"] = $cid;
    			$_SESSION["typeid"] = "";
                $filenames=formatlink(0,$c_id,0,0,0);
    			$filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                if(cfile($filename)||$t==1){
        			ob_start();
        			include template('index',$c_channeldir);
        			$data = ob_get_contents();
                    $data.= "<script src=\"{$cfg['path']}autohtml.php?do=index&id=$cid\"></script>";
        			ob_clean();
        			file_put($filename, $data);
                }
    		}
        }else{
            $filename= FR_ROOT."/index.".$cfg['defaultext'];
            If(cfile($filename)||$t==1){
                ob_start();
        		include template('index');
        		$data = ob_get_contents();
                $data.= "<script src=\"{$cfg['path']}autohtml.php?do=index\"></script>";
        		ob_clean();
        		file_put($filename, $data); 
            }
        }
    	break;
    	case 'company':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=2");
            if($rsc){
                extract($rsc);
                $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','g_name','g_hide');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=2 and m_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
                    $comid=$m_id;
                    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                    if($m_introduce=='') $m_introduce="暂无公司简介！";
                    $m_seat=xreplace($m_seat);
                    $m_group=membergroup($m_groupid,1);
                    if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                    $filenames=formatlink($m_regdate,2,1,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('company','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=company&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'hires':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=2");
            if($rsc){
                extract($rsc);
                $sqlstr=Array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','g_name','g_hide');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=2 and m_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
                    $comid=$m_id;
                    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                    if($m_introduce=='') $m_introduce="暂无公司简介！";
                    $m_seat=xreplace($m_seat);
                    $m_group=membergroup($m_groupid,1);
                    if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                    $filenames=formatlink($m_regdate,2,2,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
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
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'hire':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=2");
            if($rsc){
                extract($rsc);
                $sqlstr=array('h_id','h_place','h_comid','h_type','h_dept','h_adddate','h_enddate','h_experience','h_edu','h_number','h_profession','h_position','h_pay','h_sex','h_age1','h_age2','h_workadd','h_introduce','m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_template','m_confirm','g_name','g_hide');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_comid=m_id INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where h_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
                    $comid=$m_id;$hireid=$h_id;
                    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                    $m_seat=xreplace($m_seat);
                    $m_group=membergroup($m_groupid,1);
                    if($m_confirm==1){$m_confirm='已通过营业执照认证';}else{$m_confirm='尚未通过认证';}
                    $filenames=formatlink($h_adddate,2,3,$h_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('hire','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hire&id=$h_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'compic':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=2");
            if($rsc){
                extract($rsc);
                $sqlstr=array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_seat','m_trade','m_ecoclass','m_fund','m_workers','m_founddate','m_introduce','m_template','m_map','m_confirm','p_id','p_name','p_info','p_filename','p_type');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login where p_type=12 and p_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
                    $pid=$p_id;
                    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0)?$cfg['path'].'upfiles/company/nologo.gif':$m_logo;
                    if($m_introduce=='') $m_introduce="暂无公司简介！";
                    $m_seat=xreplace($m_seat);
                    $g_name=membergroup($m_groupid,0);
                    if($m_confirm==0){$m_confirm='尚未通过认证';}else{$m_confirm='已通过营业执照认证';}
                    $pic=substr($p_filename,0,3)=="../"?$cfg['path'].substr($p_filename,3):$p_filename;
                    $filenames=formatlink(0,2,4,$p_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('pic','company',$m_template);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=compic&id=$p_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'person':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=1");
            if($rsc){
                extract($rsc);
                $sqlstr=array('r_member','r_id','r_adddate','r_name','r_sex','r_birth',
                    'r_cardtype','r_idcard','r_nation','r_marriage','r_height','r_polity',
                    'r_weight','r_hukou','r_seat','r_school','r_graduate','r_edu','r_zhicheng','r_sumup',
                    'r_appraise','r_jobtype','r_trade','r_position','r_workadd','r_pay','r_stay','r_workdate',
                    'r_request','r_tel','r_chat','r_email','r_url','r_address','r_post','r_visitnum',
                    'r_usergroup','r_openness','r_title','r_template','r_ability','m_logo','m_logoflag','m_logostatus','m_nameshow','m_qzstate','m_groupid');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}resume INNER JOIN {$cfg['tb_pre']}member on r_mid=m_id where m_typeid=1 and r_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
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
                    $filenames=formatlink($r_adddate,1,1,$r_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('cnresume_view','person');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=person&id=$r_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'perpic':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=1");
            if($rsc){
                extract($rsc);
                $sqlstr=array('m_id','m_name','m_login','m_regdate','m_groupid','m_logo','m_logoflag','m_logostatus','m_seat','m_birth','m_edu','m_sex','m_template','m_nameshow','p_id','p_name','p_info','p_filename','p_type');
                $sqlss='';
                foreach($sqlstr as $v) $sqlss.="$v,";
                $sqlss=substr($sqlss,0,-1);
                $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}picture INNER JOIN {$cfg['tb_pre']}member on p_member=m_login where (p_type=21 or p_type=22) and p_id=$id");
                if($rs){
                    foreach($sqlstr as $v) $$v=$rs[$v];
                    $m_logo=($m_logo==''||$m_logo=='error.gif'||$m_logoflag==0||$m_logostatus==0)?$cfg['path'].'upfiles/person/nophoto.gif':$m_logo;
                    $r_name=$m_nameshow?$r_name:($r_sex==1?sub_cnstr($r_name,1).'先生':sub_cnstr($r_name,1).'小姐/女士');
                    if($m_introduce=='') $m_introduce="暂无简介！";
                    $pic=substr($p_filename,0,3)=="../"?$cfg['path'].substr($p_filename,3):$p_filename;
                    if($p_type==21){$p_type="资格证书";}else{$p_type="职场风采";}
                    $filenames=formatlink(0,1,2,$p_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('pic','person');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=perpic&id=$p_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'list':
        if($id!=0){
            $rs = $db->get_one("select s_id,s_name,s_cid,c_name,c_channeldir,c_keywords,c_description from {$cfg['tb_pre']}newssort INNER JOIN {$cfg['tb_pre']}channel on s_cid=c_id where c_createhtml!=0 and c_disabled=0 and s_id=$id");
            if($rs){
                extract($rs);
                @session_start();
                $_SESSION["channelid"] = $s_cid;
                $_SESSION["typeid"] = $s_id;
                $cid=$s_cid;
                $counts = $db->counter("{$cfg['tb_pre']}news","n_sid={$s_id}");
                $pages = ceil($counts/20);
                for($i=1;$i<=$pages;$i++){
                    $_SESSION["page"] = $i;
                    $filenames=formatlink(0,$s_cid,$s_id,0,$i);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('list',$c_channeldir);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=list&id=$s_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
        case 'article':
        if($id!=0){
            $sqlstr=array('n_id','n_sid','n_cid','n_title','n_content','n_addtime','n_overview','n_from','n_author','n_editor','n_hits',
            's_name','n_keywords','n_description','c_name','c_channeldir','c_keywords','c_description');
            $sqlss='';
            foreach($sqlstr as $v) $sqlss.="$v,";
            $sqlss=substr($sqlss,0,-1);
            $rs = $db->get_one("select $sqlss from {$cfg['tb_pre']}news INNER JOIN {$cfg['tb_pre']}newssort on n_sid=s_id INNER JOIN {$cfg['tb_pre']}channel on n_cid=c_id where c_createhtml!=0 and c_disabled=0 and n_id=$id");
            if($rs){
                @session_start();
                foreach($sqlstr as $v) $$v=$rs[$v];
                $_SESSION["channelid"] = $n_cid;
                $_SESSION["typeid"] = $n_sid;
                $newsid=$n_id;
                $cid=$n_cid;
                $n_overview=$n_overview?"<div class=\"newsoverview\"><strong>文章概况：</strong>$n_overview</div>":'';
                $n_author=$n_author?$n_author:'未知';
                $n_editor=$n_editor?$n_editor:'未知';
                if($n_keywords!=''){
                    $nkeywords=explode(',',$n_keywords);$n_keywordslist='本文关键词：';
                    foreach($nkeywords as $v){
                        $n_keywordslist.="<a href=\"$cfg[path]search/news_search.php?cid=$n_cid&keywords=$v\">$v</a>　";
                    }
                }
                if($n_keywords=='') $n_keywords=$n_title;
                if($n_description=='') $n_description=$n_overview?$n_overview:$n_title;
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
                    $filenames=formatlink($n_addtime,$n_cid,1,$newsid,$nowpage);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('article',$c_channeldir);
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=article&id=$newsid\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
    	case 'common':
        if($id!=0){
            $rs = $db->get_one("select c_id,c_title,c_content,c_template,c_htmlname from {$cfg['tb_pre']}common where c_id=$id");
            if($rs){
                $commonid=$rs['c_id'];
                $commontitle=$rs['c_title'];
                $commoncontent=$rs['c_content'];
                $commoncontent=replace_alllabel($commoncontent);
                $commoncontent=replace_cfglabel($commoncontent);
                $commontemplate=$rs['c_template'];
    			$commonhtmlname=$rs["c_htmlname"];
    			$commonlist=getsitebottomnav(1);
                $filename=FR_ROOT.'/'.$cfg['htmlpath'].'about/'.$commonhtmlname.".".$cfg['defaultext'];
                if(cfile($filename)||$t==1){
        			ob_start();
        			include template($commontemplate,'common');
        			$data = ob_get_contents();
                    $data.= "<script src=\"{$cfg['path']}autohtml.php?do=common&id=$commonid\"></script>";
        			ob_clean();
        			file_put($filename, $data);
                }
    		}
        }
    	break;
        case 'hr':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=4");
            if($rsc){
                extract($rsc);
                $rsid=getltarticle($id);
                if($rsid){
                    extract($rsid);
                    $filenames=formatlink(0,4,1,$id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('hr','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hr&id=$id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
        case 'hrhire':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=4");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}hrzp where h_flag=1 and h_id=$id");
                if($rs){
                    extract($rs);
                    $filenames=formatlink($h_adddate,4,3,$id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('hr_hire','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hrhire&id=$id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
        }
    	break;
        case 'hrlist':
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=4");
            if($rsc){
                extract($rsc);
                $counts = $db->counter("{$cfg['tb_pre']}hrzp","h_flag=1");
                $pages = ceil($counts/20);
                for($i=1;$i<=$pages;$i++){
                    $page = $i;
                    $filenames=formatlink(0,4,2,1,$i);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('hr_list','hr');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=hrlist\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                }
            }
    	break;
        case 'school':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=3");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select m_id,m_name,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,m_map,m_regdate,g_name,g_hide from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=3 and m_id=$id");
                if($rs){
                    extract($rs);$m_logo=ltrim($m_logo,'.');$m_group=membergroup($m_groupid,1);
                    $filenames=formatlink($m_regdate,3,1,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('school_view','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                    $spcounts = $db->counter("{$cfg['tb_pre']}professor","p_sid=$m_id and p_flag=1");
                    $sppages = ceil($spcounts/20);
                    for($i=1;$i<=$sppages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,3,2,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('professor_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $sdcounts = $db->counter("{$cfg['tb_pre']}department","d_sid=$m_id and d_flag=1");
                    $sdpages = ceil($sdcounts/20);
                    for($i=1;$i<=$sdpages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,3,6,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('department_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $sscounts = $db->counter("{$cfg['tb_pre']}student","s_sid=$m_id");
                    $sspages = ceil($sscounts/20);
                    for($i=1;$i<=$sspages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,3,4,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('student_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $srcounts = $db->counter("{$cfg['tb_pre']}require","r_sid=$m_id and r_flag=1");
                    $srpages = ceil($srcounts/20);
                    for($i=1;$i<=$srpages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,3,8,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('require_more','school');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=school&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                }
            }
        }
    	break;
        case 'professor':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=3");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}professor where p_id=$id");
                if($rs){
                    extract($rs);$p_photo=ltrim($p_photo,'.');
                    $filenames=formatlink($p_adddate,3,3,$p_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo ,m_address ,m_post ,m_contact ,m_tel ,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid  where m_id=$p_sid and m_typeid =3 ");
                        if($rss){
                            extract($rss);
                        	$m_logo=ltrim($m_logo,'.');
                            $m_group=membergroup($m_groupid,1);
                        }
                        ob_start();
                        include template('professor_info','school');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=professor&id=$p_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
        case 'student':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=3");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}student where s_id=$id");
                if($rs){
                    extract($rs);$s_photo=ltrim($s_photo,'.');
                    $filenames=formatlink($s_adddate,3,5,$s_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
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
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
        case 'department':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=3");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}department where d_id=$id");
                if($rs){
                    extract($rs);
                    $filenames=formatlink($d_adddate,3,7,$d_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
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
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
        case 'require':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=3");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}require where r_id=$id");
                if($rs){
                    extract($rs);
                    $filenames=formatlink($r_adddate,3,9,$r_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
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
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
        case 'train':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=5");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select m_id,m_name,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,m_map,m_regdate,g_name,g_hide from {$cfg['tb_pre']}member INNER JOIN {$cfg['tb_pre']}group on m_groupid=g_id where m_typeid=4 and m_id=$id");
                if($rs){
                    extract($rs);$m_logo=ltrim($m_logo,'.');$m_group=membergroup($m_groupid,1);
                    $filenames=formatlink($m_regdate,5,1,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('train_view','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                    }
                    $filenames=formatlink($m_regdate,5,6,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('teachers_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                    $filenames=formatlink($m_regdate,5,7,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('achievement_info','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                    $filenames=formatlink($m_regdate,5,9,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('pic','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                    $filenames=formatlink($m_regdate,5,8,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('contact','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                    $filenames=formatlink($m_regdate,5,10,$m_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        ob_start();
                        include template('map','train');
                        $data = ob_get_contents();
                        $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                        ob_clean();
                        file_put($filename, $data);
                        unset($data);
                    }
                    $spcounts = $db->counter("{$cfg['tb_pre']}course","c_tid=$m_id");
                    $sppages = ceil($spcounts/20);
                    for($i=1;$i<=$sppages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,5,2,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('course_more','train');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                    $sdcounts = $db->counter("{$cfg['tb_pre']}trainer","t_tid=$m_id");
                    $sdpages = ceil($sdcounts/20);
                    for($i=1;$i<=$sdpages;$i++){
                        $page = $i;
                        $filenames=formatlink($m_regdate,5,4,$m_id,$i);
                        $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                        if(cfile($filename)||$t==1){
                            ob_start();
                            include template('trainer_more','train');
                            $data = ob_get_contents();
                            $data.= "<script src=\"{$cfg['path']}autohtml.php?do=train&id=$m_id\"></script>";
                            ob_clean();
                            file_put($filename, $data);
                            unset($data);
                        }
                    }
                }
            }
        }
    	break;
        case 'course':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=4");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}course where c_id=$id");
                if($rs){
                    extract($rs);
                    $filenames=formatlink($c_adddate,5,3,$c_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
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
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
        case 'trainer':
        if($id!=0){
            $rsc = $db->get_one("select c_name,c_channeldir,c_keywords,c_description,c_createhtml from {$cfg['tb_pre']}channel where c_createhtml!=0 and c_disabled=0 and c_id=4");
            if($rsc){
                extract($rsc);
                $rs = $db->get_one("select * from {$cfg['tb_pre']}trainer where t_id=$id");
                if($rs){
                    extract($rs);
                    $filenames=formatlink($t_adddate,5,5,$t_id,0);
                    $filename=FR_ROOT.'/'.substr($filenames,strlen($cfg['path']));
                    if(cfile($filename)||$t==1){
                        $t_photo=($t_photo==''||$t_photo=='error.gif')?$cfg['path'].'upfiles/train/nophoto.gif':$t_photo;
                        $rss = $db->get_one("select m_id,m_name,m_introduce,m_logo,m_address,m_post,m_contact,m_tel,m_fax,m_email,g_name,g_hide from {$cfg['tb_pre']}member left join {$cfg['tb_pre']}group on g_id =m_groupid where m_id=$t_tid and m_typeid =4 ");
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
                        file_put($filename, $data);
                        unset($data);
                    }
                }
            }
        }
    	break;
    }
}
function cfile($filename){
    global $cfg;
    if(file_exists($filename)&&time()-filemtime($filename)<60*intval($cfg['createtime'])){
        return false;
    }else{
        If(file_ext($filename)!='php'){
            return true;
        }else{
            return false;
        }
    }
}
?>