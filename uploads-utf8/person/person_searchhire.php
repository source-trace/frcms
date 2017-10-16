<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if(empty($t)) $t= '';
if($t!=''){
    switch($t){
        case 'position':
		$rsdb=array();
		$sql="select p_id,p_name from {$cfg['tb_pre']}position where p_fid=0 order by p_order asc limit 0,50";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			$rsdb[]=$row;
		}
        $tabtit='按职位类别查询';
        break;
        case 'keyword':$tabtit='按职位关键词查询';break;
        case 'trade':
		$tabtit='按单位行业查询';
		$rsdb=array();
		$sql="select t_id,t_name from {$cfg['tb_pre']}trade order by t_order asc limit 0,50";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			$rsdb[]=$row;
		}
		break;
        case 'workadd':$tabtit='按职位工作地查询';break;
        case 'comname':$tabtit='按单位名称查询';break; 
        case 'comid':$tabtit='按单位编号查询';break; 
        case 'id':$tabtit='按职位编号查询';break;  
        default:$tabtit='职位综合查询';
    }
}else{
    $tabtit='职位综合查询';
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
    <?php if($t=='position'){
             
            foreach($rsdb as $key=>$rs){
            ob_start();
            echo "    <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" class=\"memdiv\">\r\n";
			echo "        <tr class=\"memdivhead\">\r\n";
            echo "          <td height=\"21\" colspan=\"5\"><a href=\"index.php?mpage=person_searchresult&show=$show&position=$rs[p_id]\" target=\"_self\">$rs[p_name]</a></td>\r\n";
            echo "        </tr>\r\n";
            echo "        <tr class=\"memdivmain\">\r\n";
			$i=0;
			$sqls="select p_id,p_name,p_fid from {$cfg['tb_pre']}position where p_fid=$rs[p_id] order by p_order asc limit 0,100";
			$querys=$db->query($sqls);
			while($row=$db->fetch_array($querys)){
				$i++;
				echo "        	<td width=\"20%\"><a href=\"index.php?mpage=person_searchresult&show=$show&position={$row[p_fid]}*{$row[p_id]}\" target=\"_self\">$row[p_name]</a></td>\r\n";
				if($i%5 == 0) echo "        	</tr><tr class=\"memdivmain\">\r\n";
			}
            echo "        </tr>\r\n";
            echo "      </table>\r\n";
            ob_end_flush();
            }
   }elseif($t=='keyword'){?>
   		<script language="javascript">
		function check()
		{
			if (document.searchform.place.value==""&&document.searchform.introduce.value=="")
			{
				alert("职位名称和职位描述必须输入一项");
				document.searchform.place.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=person_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">检索“职位名称”关键字：</li>
            <li class="r"><input name="place" type="text" id="place" value="" /></li>
            <li class="l">检索“职位描述”关键字：</li>
            <li class="r"><input name="introduce" type="text" id="introduce" value="" /></li>
            <li class="l"></li>
            <li class="r">1、说明：以上至少需要填写一项；填写多项可以实现更为精确的查询。</li>
            <li class="l">工作地点：</li>
            <li class="r"><input type="hidden" value="" name="workadd"><input type="button" name="workadds" value="选择工作地点" class="search_case" onclick="JumpSearchLayers(0,0,2,'searchform','workadds','workadd');" readonly /></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getprovince.js"></script>
        <div id="SearchDivhire" style="border:1px #8BC3F6 solid; position:absolute;background-color:#FFFFFF;width:560px;font-size:12px;  z-index:999; display:none;">
        	<div class="memmenul">
        		<div style="width:538px; font-size:13px;color:#166AB6; font-weight:bold;" class="leftmenutit"><span style="float:right;font-size:12px; padding-right:10px; font-weight:normal; cursor:pointer;" onClick="unSearchLayers();">[关闭]</span><span id="wintit"></span></div>
        		<div style="width:100%;">
        			<div id="hiretypes" style="margin-left:20px; margin-top:10px;"></div>
        			<div id="hiretype" style="margin-left:20px; width:540px;"></div>
        		</div>
        	</div>
        </div>
        <script language="javascript" src="../js/searchjs.js"></script>
   <?php }elseif($t=='trade'){?>
        <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memdiv">
             <?php
			echo "        <tr class=\"memdivhead\">\r\n";
            echo "          <td height=\"21\" colspan=\"3\">点击行业名称进行职位查询</td>\r\n";
            echo "        </tr>\r\n";
			 echo "        <tr class=\"memdivmain\">\r\n";
			 $i=0;
            foreach($rsdb as $key=>$rs){
			$i++;
            echo "          <td height=\"21\"><a href=\"index.php?mpage=person_searchresult&show=$show&trade=$rs[t_id]\" target=\"_self\">$rs[t_name]</a></td>\r\n";
			if($i%3 == 0) echo "        	</tr><tr class=\"memdivmain\">\r\n";
            }
			echo "        </tr>\r\n";
            ?>
          </table>
   <?php }elseif($t=='workadd'){?>
   
   <?php }elseif($t=='comname'){?>
<script language="javascript">
		function check()
		{
			if (document.searchform.comname.value=="")
			{
				alert("请输入单位名称关键字");
				document.searchform.comname.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=person_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">单位名称关键字：</li>
            <li class="r"><input name="comname" type="text" id="comname" value="" /></li>
            <li class="l"></li>
            <li class="r">只要输入某单位的简称，就可以查出单位招聘职位。<br />如果该单位当前没有有效职位，则不能查出。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
   <?php }elseif($t=='comid'){?>
<script language="javascript">
		function check()
		{
			if (document.searchform.comid.value=="")
			{
				alert("请输入单位编号");
				document.searchform.comid.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=person_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">单位编号：</li>
            <li class="r"><input name="comid" type="text" id="comid" value="" /></li>
            <li class="l"></li>
            <li class="r">每个单位有一个唯一的编号，通过该功能可以准确迅速找到该单位的招聘信息。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
   <?php }elseif($t=='id'){?>
		<script language="javascript">
		function check()
		{
			if (document.searchform.id.value=="")
			{
				alert("请输入职位编号");
				document.searchform.id.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=person_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">职位编号：</li>
            <li class="r"><input name="id" type="text" id="id" value="" /></li>
            <li class="l"></li>
            <li class="r">每个职位有一个唯一的编号，通过该功能可以准确迅速找到该职位。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
   <?php }else{?>
		<script language="javascript">
		function check()
		{
			if (document.searchform.position.value=="")
			{
				alert("职位类别必须选择");
				document.searchform.position.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=person_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">全职/兼职：</li>
            <li class="r"><input type=radio value=1 style="width:20px;" name="usergroup">全职<input type=radio value=2 style="width:20px;" name="usergroup">兼职<input name="usergroup" type=radio value=3 style="width:20px;" checked >全职、兼职均可</li>
            <li class="l">职位关键字：</li>
            <li class="r"><input name="place" type="text" id="place" value="" /> 建议输入简短的关键字，以提高搜索效果。</li>
            <li class="l">单位名称关键字：</li>
            <li class="r"><input name="comname" type="text" id="comname" value="" /></li>
            <li class="l">招聘单位所在行业：：</li>
            <li class="r"><input type="hidden" name="trade" id="trade" ><input name="trades" type="button" onClick="JumpSearchLayer(4,'searchform','trade','trades');" id="trades" value="选择单位所在行业" size="60" class="search_case" /></li>
            <li class="l">职位类别：</li>
            <li class="r"><input type="hidden" name="position" id="position" ><input name="positions" type="button" onClick="JumpSearchLayer(1,'searchform','position','positions');" id="positions" value="选择职位类别" size="60" class="search_case" /></li>
            <li class="l">工作地点：</li>
            <li class="r"><input name="workadd" type="hidden" id="workadd" /><input name="workadds" type="button" onClick="JumpSearchLayer(5,'searchform','workadd','workadds');" id="workadds" value="选择工作地点" size="60" class="search_case" /></li>
            <li class="l">专业要求：</li>
            <li class="r"><input name="profession" type="hidden" id="profession" /><input name="professions" type="button" onClick="JumpSearchLayer(3,'searchform','profession','professions');" id="professions" value="选择专业要求" size="60" class="search_case" /></li>
            <li class="l">发布日期：</li>
            <li class="r"><select name=datetime size=1 id="datetime" style="font-size:12px; width:100px; font-family:宋体">
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
            <li class="l">您的年龄：</li>
            <li class="r"><select style="font-size:12px; width:100px; font-family:宋体" size=1 name=age>
                <option value=0 selected>不限</option>
                <?php
             	for($i=16;$i<=60;$i++){
					echo "<option value=\"$i\">{$i}</option>\r\n";
				}
				?>
          </select>
        岁</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getprovince.js"></script>
        <script language = "JavaScript" src="../js/gettrade.js"></script>
        <script language = "JavaScript" src="../js/getposition.js"></script>
        <script language = "JavaScript" src="../js/getprofession.js"></script>
        <script language="javascript" src="../js/jobjss.js"></script>
   <?php }?>
    </div>
</div>