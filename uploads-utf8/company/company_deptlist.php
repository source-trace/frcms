<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
$sqlstr=Array('d_id','d_name','d_principal','d_email');
if($do=='savedata'){
	$sqls='';
	foreach($sqlstr as $v){
		$s=str_replace('d_','',$v);
		if(isset($$s)&&$s!='id'){
			$sqls.="$v='".cleartags($$s)."',";
		}
	}
	$sqls=substr($sqls,0,-1);
	if($id!=''){
		$db ->query("update {$cfg['tb_pre']}dept set $sqls where d_cmember='$username' and d_id=$id");
	}else{
		$db ->query("INSERT INTO {$cfg['tb_pre']}dept (d_name,d_principal,d_email,d_cmember) VALUES('$name','$principal','$email','$username')");
	}
	showmsg('保存成功！',"?mpage=company_deptlist&show=$show",0,2000);exit();
}elseif($do=='del'){
	$id=$id!=''?intval($id):'';
    $id&&$db ->query("delete from {$cfg['tb_pre']}dept where d_cmember='$username' and d_id=$id");
	showmsg('删除成功！',"?mpage=company_deptlist&show=$show",0,2000);exit();
}else{
    $query=$db->query("select * from {$cfg['tb_pre']}dept where d_cmember='$username'");
    while($row=$db->fetch_array($query)){
    	$rsdb[]=$row;
    }
}
?>
<div class="memrightl">
    <div class="memrighttit"><span></span>单位部门管理</div>
    <div class="memrightbox">
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
     <tr class="memtabhead" align="center">
        <td width="20%">部门名称</td>
        <td width="20%">负责人</td>
        <td>E-mail</td>
        <td width="20%">操作</td>
      </tr>
      <?php
        $i=0;
        foreach($rsdb as $key=>$rs){
       $i++;
	   if($rs['d_id']==$id){$name=$rs['d_name'];$principal=$rs['d_principal'];$email=$rs['d_email'];}
      ?>
     <tr class="memtabmain" align="center">
        <td><?php echo $rs['d_name']?></td>
        <td><?php echo $rs['d_principal']?></td>
        <td><?php echo $rs['d_email']?></td>
        <td><a href="?mpage=company_deptlist&show=<?php echo $show;?>&id=<?php echo $rs['d_id'];?>">修改</a> <a href="?do=del&mpage=company_deptlist&show=<?php echo $show;?>&id=<?php echo $rs['d_id'];?>">删除</a></td>
      </tr>
<?php }?>
      </table>
<script type="text/javascript">
$().ready(function() {
	$("#addform").validate({
		success: function(label) {
			label.text("输入正确!").addClass("success");
		}, 
		rules: {
			name: {required: true,maxlength: 50},
			principal: {required: true,maxlength: 50},
			email: {required: true,email: true,maxlength: 100}
		},
		messages: {
			name: '请正确填写部门名称',
			principal: '请输入部门负责人',
			email: '请输入正确的邮箱地址'
		}
	});
});
</script>
     <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="memtab">
     <form action="?do=savedata&mpage=company_deptlist&show=<?php echo $show;?>" method="post"  name="addform" id="addform">
     <tr class="memtabhead">
        <td colspan="2"><?php if($id!=''){echo '修改';}else{echo '添加';}?>部门</td>
      </tr>
     <tr class="memtabmain">
        <td width="100" align="right"><input type="hidden" name="id" value="<?php echo $id;?>" />部门名称：</td>
        <td><input name="name" id="name" size=20 maxLength=25 value="<?php echo $name;?>" /></td>
      </tr>
      <tr class="memtabmain">
        <td align="right">负责人：</td>
        <td><input id="principal" maxLength=25 size=20 name="principal" value="<?php echo $principal;?>" /></td>
      </tr>
      <tr class="memtabmain">
        <td align="right">E-mail：</td>
        <td><input id="email" maxLength=100 size=20 name="email" value="<?php echo $email;?>" /></td>
      </tr>
      <tr class="memtabmain">
        <td align="right">&nbsp;</td>
        <td><input name="submit" type="submit" class="submit" value="<?php if($id!=''){echo '修改';}else{echo '添加';}?>部门" /></td>
      </tr>
    </form>
      </table>
    </div>
</div>