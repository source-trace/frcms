<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
    $rsdb=array();
    $sql="select h_id,h_adddate,h_job,h_cnum,h_enddate,h_workadd,h_cname,h_yearpay from {$cfg['tb_pre']}hrzp where h_flag=1 order by h_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"?sid=$sid",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>最新猎头职位</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
        <td width="5%">编号</td>
          <td width="15%" height="21">职位名称</td>
          <td width="24%">单位名称</td>
          <td width="18%">工作地点</td>
          <td width="8%">招聘人数</td>
          <td width="10%">年薪</td>
          <td width="10%">更新时间</td>
          <td width="10%">截至时间</td>
        </tr>
        <?php
            foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            echo "          <td>$rs[h_id]</td>\r\n";
            echo "          <td height=\"22\"><a href=\"".formatlink($rs["h_adddate"],4,3,$rs["h_id"],0)."\" target=\"_blank\">".$rs["h_job"]."</a></td>\r\n";
            echo "          <td>$rs[h_cname]</td>\r\n";
            echo "          <td>".$rs["h_workadd"]."</td>\r\n";
            echo "          <td>".hirenumber($rs["h_cnum"])."</td>\r\n";
            echo "          <td>$rs[h_yearpay]万</td>\r\n";
            echo "          <td>".dtime(strtotime($rs["h_adddate"]),3)."</td>\r\n";
            echo "          <td>$rs[h_enddate]</td>\r\n";
            echo "        </tr>\r\n";
            }
            ?>
            <tr class="memtabpage">
          <td height="21" colspan="8"><div class="memtabdiv"></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
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
		document.form.action="../person/person_resumesend.php?do=hire";
		document.form.submit();
	}
	if(num==2)
	{
		document.form.action="../person/person_favoriteadd.php";
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