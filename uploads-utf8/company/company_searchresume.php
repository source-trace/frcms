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
        $tabtit='按求职者意向职位类别查询';
        break;
        case 'keyword':$tabtit='按简历关键词查询';break;
        case 'trade':
		$tabtit='按单位行业查询';
		$rsdb=array();
		$sql="select t_id,t_name from {$cfg['tb_pre']}trade order by t_order asc limit 0,50";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			$rsdb[]=$row;
		}
		break;
        case 'profession':$tabtit='按专业模糊查询';break;
        case 'workadd':$tabtit='按求职者意向工作地查询';break;
        case 'seat':$tabtit='按求职者所在地查询';break;
        case 'name':$tabtit='按姓名查询';break; 
        case 'work':$tabtit='按工作经历查询';break; 
        case 'id':$tabtit='按简历编号查询';break;  
        default:$tabtit='简历综合查询';
    }
}else{
    $tabtit='简历综合查询';
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span><?php echo $tabtit;?></div>
    <div class="memrightbox">
    <?php if($t=='position'){?> 
   		<script language="javascript">
		function check()
		{
			if (document.searchform.position.value=="")
			{
				alert("职位类别必须选择");
				document.searchform.positions.click();
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">希望工作岗位：</li>
            <li class="r"><input type="hidden" name="position" id="position" value="" ><input name="positions" type="button" onClick="JumpSearchLayer(1,'searchform','position','positions');" value="选择希望岗位类别" class="search_case" /></li>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getposition.js"></script>
        <script language="javascript" src="../js/jobjss.js"></script>
   <?php
   }elseif($t=='keyword'){?>
   		<script language="javascript">
		function check()
		{
			if (document.searchform.keyword.value=="")
			{
				alert("请输入检索的关键字");
				document.searchform.keyword.focus;
				return false;
			}
//            if (document.searchform.workadd.value=="")
//			{
//				alert("求职者意向工作地区必选！");
//				document.searchform.workadd.focus;
//				return false;
//			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">请输入检索的关键字：</li>
            <li class="r"><input name="keyword" type="text" id="place" value="" /></li>
            <li class="l"></li>
            <li class="r">1、说明：关键词查询可对求职者的“自我评价”、“真实姓名”、“意向岗位”、“其他要求”等进行精确查询。</li>
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
   <?php }elseif($t=='profession'){?>
   		<script language="javascript">
		function check()
		{
			if (document.searchform.profession.value==""&&document.searchform.school.value=="")
			{
				alert("毕业学校或所学专业必须选择检索一项");
				document.searchform.profession.focus;
				return false;
			}
//            if (document.searchform.workadd.value=="")
//			{
//				alert("求职者意向工作地区必选！");
//				document.searchform.workadds.click();
//				return false;
//			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">检索“毕业学校”关键字：</li>
            <li class="r"><input name="school" type="text" id="school" value="" /></li>
            <li class="l">选择求职者所学专业：</li>
            <li class="r"><input type="hidden" value="" name="profession"><input type="button" name="professions" value="选择专业类别" class="search_case" onclick="JumpSearchLayers(0,0,5,'searchform','professions','profession');" readonly /></li>
            <li class="l"></li>
            <li class="r">1、说明：以上至少需要填写一项；填写多项可以实现更为精确的查询。</li>
            <li class="l">求职工作地区：</li>
            <li class="r"><input type="hidden" value="" name="workadd"><input type="button" name="workadds" value="选择工作地点" class="search_case" onclick="JumpSearchLayers(0,0,2,'searchform','workadds','workadd');" readonly /></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getprofession.js"></script>
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
   <?php }elseif($t=='seat'){?>
   		<script language="javascript">
		function check()
		{
			if (document.searchform.seat.value=="")
			{
				alert("求职者所在地至少选择一项");
				document.searchform.seat.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">求职者所在地：</li>
            <li class="r"><input type="hidden" value="" name="seat"><input type="button" name="seats" value="选择求职者所在地" class="search_case" onclick="JumpSearchLayer(5,'searchform','seat','seats');" readonly /></li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
        <div id="bodyly" style="position:absolute;top:0px;FILTER: alpha(opacity=80);background-color:#333; z-index:0;left:0px;display:none;"></div>
        <script language = "JavaScript" src="../js/getprovince.js"></script>
        <script language="javascript" src="../js/jobjss.js"></script>
   <?php }elseif($t=='name'){?>
<script language="javascript">
		function check()
		{
			if (document.searchform.name.value=="")
			{
				alert("请输入姓名关键字");
				document.searchform.name.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">姓名关键字：</li>
            <li class="r"><input name="name" type="text" id="name" value="" /></li>
            <li class="l"></li>
            <li class="r">姓名存在相同的可能性，请确认查到的简历是否是您需要的。</li>
        </ul>
        <ul>
            <li class="l"></li>
            <li class="r"><label for="submit"><input name="submit" type="submit" class="submit" value="开始搜索" /></label></li>            
        </ul>
        </form>
        </div>
   <?php }elseif($t=='work'){?>
<script language="javascript">
		function check()
		{
			if (document.searchform.comname.value==""&&document.searchform.place.value==""&&document.searchform.introduce.value=="")
			{
				alert("单位名称、职位名称、工作描述必填一项！");
				document.searchform.comname.focus;
				return false;
			}
//			if (document.searchform.workadd.value=="")
//			{
//				alert("求职者意向工作地区必选！");
//				document.searchform.workadd.focus;
//				return false;
//			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">“单位名称”关键字：</li>
            <li class="r"><input name="comname" type="text" id="comname" value="" /></li>
            <li class="l">“职位名称”关键字：</li>
            <li class="r"><input name="place" type="text" id="place" value="" /></li>
            <li class="l">“工作描述”关键字：</li>
            <li class="r"><input name="introduce" type="text" id="introduce" value="" /></li>
            <li class="l"></li>
            <li class="r">以上三项必填一项，通过以上搜索选项可以精确地找到曾在某单位工作过的求职者简历信息。</li>
            <li class="l">求职工作地区：</li>
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
   <?php }elseif($t=='id'){?>
		<script language="javascript">
		function check()
		{
			if (document.searchform.id.value=="")
			{
				alert("请输入简历编号");
				document.searchform.id.focus;
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">简历编号：</li>
            <li class="r"><input name="id" type="text" id="id" value="" /></li>
            <li class="l"></li>
            <li class="r">每个简历有一个唯一的编号，通过该功能可以准确迅速找到该简历。</li>
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
				document.searchform.positions.click();
				return false;
			}
		}
		</script>
    	<div class="msg"><li></li></div>
    	<div class="con">
        <form method="post" name="searchform" id="searchform" action="index.php?mpage=company_searchresult&show=<?php echo $show;?>" onsubmit="return check();">
        <ul>
            <li class="l">人才类型：</li>
            <li class="r"><input id="radUserGroup" type="radio" checked value="0" name="usergroup" />普通<input id="radUserGroup" type="radio" value="1" name="usergroup" />毕业生<input id="radUserGroup" type="radio" value="2" name="usergroup" />高级人才</li>
            <li class="l">目前所在地：</li>
            <li class="r"><input name="seat" type="hidden" id="seat" value="" /><input name="seats" type="button" onClick="JumpSearchLayer(5,'searchform','seat','seats');" id="seats" value="选择目前所在地" class="search_case" /></li>
            <li class="l">希望工作地区：</li>
            <li class="r"><input name="workadd" type="hidden" id="workadd" value="" /><input name="workadds" type="button" onClick="JumpSearchLayer(5,'searchform','workadd','workadds');" id="workadds" value="选择希望工作地区"  class="search_case" /></li>
            <li class="l">希望行业类别：</li>
            <li class="r"><input type="hidden" name="trade" id="trade" value="" ><input name="trades" type="button" onClick="JumpSearchLayer(4,'searchform','trade','trades');" value="选择希望行业类别" class="search_case" /></li>
            <li class="l">希望工作岗位：</li>
            <li class="r"><input type="hidden" name="position" id="position" value="" ><input name="positions" type="button" onClick="JumpSearchLayer(1,'searchform','position','positions');" value="选择希望岗位类别" class="search_case" /></li>
            <li class="l">简历更新日期：</li>
            <li class="r"><input type="hidden" id="datetime" name="datetime"><input type="button" id="datetimes" name="datetimes" value="选择日期" class="search_case" onclick="JumpSearchDate('searchform','datetimes','datetime');" /></li>
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