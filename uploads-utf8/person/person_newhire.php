<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
    $rsdb=array();
    $sql="select h_id,h_adddate,h_place,h_number,h_enddate,h_workadd,h_comname,m_id,m_regdate,m_name from {$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login where m_flag=1 and DATEDIFF(m_startdate,CURDATE())<=0 and DATEDIFF(m_enddate,CURDATE())>=0 and DATEDIFF(h_enddate,CURDATE())>=0 and h_status=1 order by h_adddate desc";
    $counts = $db->counter("{$cfg['tb_pre']}hire INNER JOIN {$cfg['tb_pre']}member on h_member=m_login","m_flag=1 and DATEDIFF(m_startdate,CURDATE())<=0 and DATEDIFF(m_enddate,CURDATE())>=0 and DATEDIFF(h_enddate,CURDATE())>=0 and h_status=1",'CACHE');
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"?mpage=person_newhire&show=$show",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql,'CACHE');
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>最新职位</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="15%" height="21">职位名称</td>
          <td width="24%">单位名称</td>
          <td width="18%">工作地点</td>
          <td width="8%">招聘人数</td>
          <td width="10%">更新时间</td>
          <td width="10%">截至时间</td>
          <td width="10%">操作</td>
          <td width="5%"><input name="checkSelect" type="checkbox" class="checkbox" onClick="javascript: checkAll(this)" value="checkbox"></td>
        </tr>
        <?php
foreach($rsdb as $key=>$rs){
echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
echo "          <td height=\"22\" align=\"left\"><a href=\"".formatlink($rs["h_adddate"],2,3,$rs["h_id"],0)."\" target=\"_blank\">".$rs["h_place"]."</a></td>\r\n";
echo "          <td align=\"left\"><a href=\"".formatlink($rs["m_regdate"],2,1,$rs["m_id"],0)."\" target=\"_blank\">".$rs["h_comname"]."</a></td>\r\n";
echo "          <td>".xreplace($rs["h_workadd"],1)."</td>\r\n";
echo "          <td>".hirenumber($rs["h_number"])."</td>\r\n";
echo "          <td>".dtime(strtotime($rs["h_adddate"]),3)."</td>\r\n";
echo "          <td>$rs[h_enddate]</td>\r\n";
echo "          <td><input name=\"button\" type=\"button\" value=\"申请职位\" class=\"inputs\" onClick=\"location.href='?a=hire&mpage=person_resumesend&show=$show&checks=$rs[h_id]'\"/></td>\r\n";
echo "          <td><input type=\"checkbox\" name=\"hid\" value=\"$rs[h_id]\" class=\"checkbox\" /></td>\r\n";
echo "        </tr>\r\n";
}
?>
<tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name="Input2" type="button" value="申请选中的职位" class="inputs" onClick="confirmX(1);" /> 
        <input name="Input3" type="button" value="放入收藏夹" class="inputs" onClick="confirmX(2);" /> </div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
    </div>
</div>
<script language="javascript">
function confirmX(num)
{
	var ids = document.getElementsByName("hid");
	var check=false;
	var allSel="";
	if (ids != null) {
		for (i=0; i<ids.length; i++) 
		{
			var obj = ids[i];
			if (obj.checked==true)
			{
				if(allSel==""){
				allSel=obj.value;
				}else{
				allSel=allSel+","+obj.value;
				}
				document.form.checks.value = allSel;
				check=true;
				
			}
		}
		if(check==false){alert("请选择操作对象！");return false;}
	}
	if(num==1)
	{
		document.form.action="?a=hire&mpage=person_resumesend&show=<?php echo $show;?>";
		document.form.submit();
	}
	if(num==2)
	{
		document.form.action="?do=favorite&mpage=person_favoriteadd&show=<?php echo $show;?>";
		document.form.submit();
	}
	return false;	
}
function checkAll(box1) {
    var ids = document.getElementsByName("hid");
	if (ids != null) {
		for (i=0; i<ids.length; i++) {
			var obj = ids[i];
			obj.checked = box1.checked;
		}
	}
}
</script>