<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='del'){
    $db ->query("delete from {$cfg['tb_pre']}rbrower where r_bmember='$username' and r_type!=1 and r_id in ($checks)");
	showmsg('删除成功！',"?mpage=company_rbrower&show=$show",0,2000);exit();
}else{
    $db->get_one("delete from {$cfg['tb_pre']}rbrower where r_bmember='$username' and r_type!=1 and DATEDIFF('".date('Y-m-d')."',r_adddate)>30");
    $rsdb=array();$sqladd='';
    $cid=intval($cid);$cid&&$sqladd=" and r_bid=$cid";
    $hid=intval($hid);$hid&&$sqladd=" and r_bid=$hid";
    $sqladd=$cid?$sqladd.' and r_type=2':$sqladd.' and r_type=3';
    $sql="select r_id,r_bid,r_adddate,r_name from {$cfg['tb_pre']}rbrower where r_bmember='$username' $sqladd order by r_adddate desc";
    $query=$db->query($sql);
    $counts = $db->num_rows($query);
    $page= isset($_GET['page'])?$_GET['page']:1;//默认页码
    $getpageinfo = page($page,$counts,"index.php?mpage=company_rbrower&show=$show&cid=$cid&hid=$hid",20,5);
    $sql.=$getpageinfo['sqllimit'];
    $query=$db->query($sql);
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>职位被浏览记录</div>
    <div class="memrightbox">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
      <form name="form" action="?" method="post">
        <tr class="memtabhead" align="center">
          <td width="10%" height="21">编号</td>
          <?php if($cid==''){?><td width="10%">职位编号</td><?php }?>
          <td width="55%">浏览者</td>
          <td width="20%">访问时间</td>
          <td width="5%"><img src="../images/sel_ico.gif" width="13" height="12" /></td>
        </tr>
        <?php
        foreach($rsdb as $key=>$rs){
            echo "        <tr class=\"memtabmain\" align=\"center\">\r\n";
            if($cid=='') echo "          <td height=\"22\">$rs[r_id]</td>\r\n";
            echo "          <td>$rs[r_bid]</td>\r\n";
            echo "          <td>$rs[r_name]</td>\r\n";
            echo "          <td>$rs[r_adddate]</td>\r\n";
            echo "          <td><input type=\"checkbox\" name=\"id\" value=\"$rs[r_id]\"></td>\r\n";
            echo "        </tr>\r\n";
        }
        ?>
        <tr class="memtabpage">
          <td height="21" colspan="5"><div class="memtabdiv"><input type="hidden" name="checks" value=""><input name=chkall onClick="checkAll(this)" type=checkbox value=on>
全选&nbsp; &nbsp; <input name="button3" type="button" class="inputs" value="删除" onClick="confirmX(1);"></div><?php echo $getpageinfo['pagecode'];?></td>
        </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
          <tr class="memtabmain">
            <td>保存最近30天内的浏览记录，过期系统自动删除。</td>
          </tr>
          <?php if($rid!=0){?>
            <tr class="memtabmain">
                <td height="30" align="center"><input name="submit" type="button" class="submit" value="返回" onclick="javascript:history.back();" /></td>
              </tr>
          <?php }?>
      </table>
      <script language="javascript">
        function confirmX(num)
        {
        	var ids = document.getElementsByName("id");
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
        				form.checks.value = allSel;
        				check=true;
        				
        			}
        		}
        		if(check==false){alert("请选择操作对象！");return false;}
        	}
        	if(num==1)
        	{
        		document.form.action="?do=del&mpage=company_rbrower&show=<?php echo $show;?>";
        		document.form.submit();
        	}
        	return false;	
        }
        function checkAll(box1) {
            var ids = document.getElementsByName("id");
        	if (ids != null) {
        		for (i=0; i<ids.length; i++) {
        			var obj = ids[i];
        			obj.checked = box1.checked;
        		}
        	}
        }
        </script>
    </div>
</div>