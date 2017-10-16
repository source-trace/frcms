<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='addsearch'){
    $sqladd='';
    if($usergroup==0&&$usergroup!=''){
        $sqladd.=" and r_usergroup=0";
    }elseif($usergroup==1){
        $sqladd.=" and r_usergroup=1";
    }elseif($usergroup==2){
        $sqladd.=" and r_usergroup=2";
    }
    $seat = empty($seat) ? '' :cleartags($seat);
    if($seat!=''){
        $sqladd.=" and (";
        $seats=explode(',',hireworkadd($seat));
        foreach($seats as $key){
            $sqladd.="r_seat like '%$key%' or ";
        }
        if(substr($sqladd,-3)=='or ') $sqladd=substr($sqladd,0,-4);
        $sqladd.=")";
    }
    if($workadd!=''&&$workadd!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hireworkadd($workadd));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_workadd like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqladd.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($trade!=''&&$trade!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hiretrade($trade));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_trade like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqladd.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($position!=''&&$position!='0000'){
        $sqlstrt='';
        $mystring=explode(',',hireposition($position));
        for($i=0;$i<count($mystring);$i++){
            $sqlstrt.=" or r_position like '%$mystring[$i]%'";
        }
        if($sqlstrt!=''){
            $sqladd.=" and (".substr($sqlstrt,4).")";
        }
    }
    if($datetime!=''&&is_numeric($datetime)) $sqladd.=" and DATEDIFF(CURDATE(),r_adddate)<=$datetime";
    if($edu1!=''&&is_numeric($edu1)) $sqlstr.=" and r_edu>=$edu1";
    if($edu2!=''&&is_numeric($edu2)) $sqlstr.=" and r_edu<=$edu2";
    if($sex!=''&&is_numeric($sex)){
        if($sex==1) $sqlstr.=" and r_sex=1";
        if($sex==2) $sqlstr.=" and r_sex=2";
    }
    if($age1!=''&&is_numeric($age1)) $sqlstr.=" and DATEDIFF(r_birth,".date('Y-m-d',strtotime(date('Y-m-d')."-$age1 year")).")>=0";
    if($age1!=''&&is_numeric($age1)) $sqlstr.=" and DATEDIFF(".date('Y-m-d',strtotime(date('Y-m-d')."-$age2 year")).",r_birth)>=0";
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
        showmsg('添加成功！',"?mpage=company_addsearch&show=$show",0,2000);exit();
    }
}elseif($do=='delsearch'){
    $mid=intval($mid);
    $db->query("delete from {$cfg['tb_pre']}mail where m_member='$username' and m_id=$mid");
    showmsg('删除成功！',"?mpage=company_addsearch&show=$show",0,2000);exit();
}elseif($t=='addform'){
    $rs = $db->get_one("select m_email from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
    if($rs){
        $useremail=$rs['m_email'];
    }
    $tabtit='定义简历搜索器';
}else{
    $rsdb=array();
    $sql="select m_id,m_update,m_title,m_cycle,m_senddate from {$cfg['tb_pre']}mail where m_member='$username' order by m_update desc limit 0,6";
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
    $tabtit='搜索器列表';
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
        <form method="post" name="addform" id="addform" action="index.php?do=addsearch&mpage=company_addsearch&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">搜索器名称：</li>
            <li class="r"><input name="title" type="text" id="title" value="" /></li>
            <li class="l">人才类型：</li>
            <li class="r"><input id="radUserGroup" type="radio" checked value="0" name="usergroup" />普通<input id="radUserGroup" type="radio" value="1" name="usergroup" />毕业生<input id="radUserGroup" type="radio" value="2" name="usergroup" />高级人才</li>
            <li class="l">目前所在地：</li>
            <li class="r"><input name="seat" type="hidden" id="seat" value="" /><input name="seats" type="button" onClick="JumpSearchLayer(5,'addform','seat','seats');" id="seats" value="选择目前所在地" class="search_case" /></li>
            <li class="l">希望工作地区：</li>
            <li class="r"><input name="workadd" type="hidden" id="workadd" value="" /><input name="workadds" type="button" onClick="JumpSearchLayer(5,'addform','workadd','workadds');" id="workadds" value="选择希望工作地区"  class="search_case" /></li>
            <li class="l">希望行业类别：</li>
            <li class="r"><input type="hidden" name="trade" id="trade" value="" ><input name="trades" type="button" onClick="JumpSearchLayer(4,'addform','trade','trades');" value="选择希望行业类别" class="search_case" /></li>
            <li class="l">希望工作岗位：</li>
            <li class="r"><input type="hidden" name="position" id="position" value="" ><input name="positions" type="button" onClick="JumpSearchLayer(1,'addform','position','positions');" value="选择希望岗位类别" class="search_case" /></li>
            <li class="l">简历更新日期：</li>
            <li class="r"><input type="hidden" id="datetime" name="datetime"><input type="button" id="datetimes" name="datetimes" value="选择日期" class="search_case" onclick="JumpSearchDate('addform','datetimes','datetime');" /></li>
            <li class="l">学历要求：</li>
            <li class="r"><select name="edu1" style="font-size:12px; width:100px; font-family:宋体" >
                <option value="" selected>不限</option>
                <?php echo getother('edu','e','e_id asc','');?>
                </select>
                &nbsp;&nbsp;~&nbsp;&nbsp;
                <select name="edu2" style="font-size:12px; width:100px; font-family:宋体" >
                <option value="" selected>不限</option>
                <?php echo getother('edu','e','e_id asc','');?>
                </select>
            </li>
            <li class="l">性别要求：</li>
            <li class="r"><select style="font-size:12px; width:100px; font-family:宋体" name=sex>
                <option value="" selected>不限</option>
                <option value=1>男性</option>
                <option value=2>女性</option>
          </select></li>
            <li class="l">年龄要求：</li>
            <li class="r"><select style="font-size:12px; width:100px; font-family:宋体" size="1" name="age1">
                <option value="" selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\">{$i}</option>\r\n";
				}
				?>
          </select>
          &nbsp;&nbsp;~&nbsp;&nbsp;
          <select style="font-size:12px; width:100px; font-family:宋体" size="1" name="age2">
                <option value="" selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\">{$i}</option>\r\n";
				}
				?>
          </select>
        岁</li>
        <li class="t">您可以E-mail订阅符合以上条件的</li>
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
        <li class="l">每次发送的数：</li>
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
            echo "          <td><a href=\"index.php?mpage=company_searchresult&show=$show&mid=$rs[m_id]\">搜索</a></td>\r\n";
            echo "          <td><a href=\"index.php?mpage=company_addsearch&show=$show&t=addform&mid=$rs[m_id]\">修改</a></td>\r\n";
            echo "          <td><a href=\"javascript:if(confirm('确定要删除吗?'))location.href='index.php?mpage=person_addsearch&show=$show&mid=$rs[m_id]&do=delsearch'\">删除</a></td>\r\n";
            echo "        </tr>\r\n";
            }
            ?>
            <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input name="button" type="button" value="创建搜索器" class="inputs" onClick="location.href='?mpage=company_addsearch&show=2&t=addform';"/></div></td>
        </tr>
      </table>
        <?php }?>
    </div>
</div>