<?php
/*
	[FRCMS] Copyright (c) 2010 Finereason.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_FR') or exit('Access Denied');
if($do=='savemap'){
	$nid = preg_replace("/[^a-zA-Z\.-]/i",'',$nid);
	if($nid=='') exit();
	$db ->query("update {$cfg['tb_pre']}member set m_map='$nid' where m_login='$username'");
	showmsg('标注成功！');exit();
}
$rs = $db->get_one("select m_name,m_seat,m_address,m_tel,m_map from {$cfg['tb_pre']}member where m_login='$username' limit 0,1");
if($rs){
	$m_name=$rs['m_name'];$m_seat=$rs['m_seat'];$m_address=$rs['m_address'];$m_tel=$rs['m_tel'];$m_map=$rs['m_map'];
	if($m_seat!=''){
	   $m_seat=explode('*',$m_seat);
       $m_seat=$m_seat[1];
    }
}
?>
<script language="javascript">
/* ======================================================================================
下面的函数用来显示供用户添加标点的地图，其参数配制（请参照说明文档中的参数配制说明）：
CID、tid、width、height、zoom、control等参数需要您在部署代码时设置好；而cityName、nid等参数将从网
页表单中读取值；如果您传递了NID参数的值，地图中将显示此NID所代表的标点。                          
====================================================================================== */
  function initMap() {
    var url = "../plus/map/proxy.php?api=template1000&CID=finereason&tid=tid1000&cityName="+encodeURIComponent(document.getElementById("cityName").value)+
		  "&nid="+document.getElementById("nid").value+"&width=480&height=350&zoom=10&control=2";
    document.getElementById("map").src = url;  
  }
/* ======================================================================================
点击“提交”按钮运行此函数保存地图标点信息，其参数配制（请参照说明文档中的参数配制说明）：
CID、tid、等参数需要您在部署代码时设置好；而name、nid、address、phone、cityName等参数将从网
页表单中读取值；如果您传递了NID参数的值，将修改此NID代表的标点，而不添加新的标点。                          
====================================================================================== */
  function updateMap() {
  	if (!map.getLatLon()) {
  		alert("请先标注位置");
  		return;
    }	
    var url = "../plus/map/proxy.php?api=poiUpdate&CID=finereason&tid=tid1000&cityName="+encodeURIComponent(document.getElementById("cityName").value)+
          "&nid="+document.getElementById("nid").value+
          "&name="+encodeURIComponent(document.getElementById("name").value)+
          "&address="+encodeURIComponent(document.getElementById("address").value)+
          "&phone="+encodeURIComponent(document.getElementById("phone").value)+
          "&latLon="+map.getLatLon();
		document.getElementById("mapSubmit").src = url;
  }
/* ======================================================================================
点击“提交”按钮后，程序会自动调用setNid方法把自动生成的nid传进来，用户可以自己在方法里添加代码把nid保存起来                           
====================================================================================== */
  function setNid(nid) {
    document.getElementById("nid").value = nid;
	document.getElementById("mapSubmit").src = 'index.php?do=savemap&mpage=company_map&show=0&nid='+nid;
  }
	</script>
<div class="memrightl">
    <div class="memrighttit"><span></span>地图标注</div>
    <div class="memrightbox">
      <table width="100%" border="0" cellspacing="0" cellpadding="4" class="memtab">
        <tr class="memtabhead">
          <td width="300">单位信息</td>
          <td>地图标注</td>
        </tr>
        <tr class="memtabmain">
          <td valign="top" width="300">
          <!-- ====================================================================================
请把下面的表单内容，置入您网页的发布信息表单中（例如发布房源信息），它们的值会通过前面的脚本，随地图标点
保存在mapbar数据后台，并可以在显示地图时显示出来。
===================================================================================== -->
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="memtab">
<form name="f">
  <tr>
    <td width="80" align="right">所在城市：</td>
    <td><input id="cityName" type="text" name="cityName" value="<?php echo $m_seat;?>" onChange="map.go2City(this.value)" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right">单位名称：</td>
    <td><input id="name" type="text" name="name" value="<?php echo $m_name;?>"/></td>
  </tr>
  <tr>
    <td align="right">单位地址：</td>
    <td><input id="address" type="text" name="address" value="<?php echo $m_address;?>"/></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="button" type="button" onClick="map.go2Search(document.getElementById('address').value);" value="在地图上匹配地址"/></td>
  </tr>
  <tr>
    <td align="right">联系电话：</td>
    <td><input id="phone" type="text" name="phone" value="<?php echo $m_tel;?>" /></td>
  </tr>
  <tr>
    <td align="right">标点ID：</td>
    <td><input id="nid" type="text" name="nid" value="<?php echo $m_map;?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="submit" value="保存标注" onClick="updateMap()"/>
      &nbsp;<input type="button" name="submit2" value="重载地图" onClick="initMap()"/></td>
    </tr>
</form>
</table><div class="memts">
        <li>如果以上信息不正确请进入“<a href="?mpage=company_info&show=0">基本资料管理</a>”中修改，修改正确后进行标注；</li>
        <li>点击“在地图上匹配地址”可以自动定位单位地址在地图上的位置；</li>
        <li>在右侧地图上移动标点，移动到正确位置后，点击“保存标注”完成并保存标注。</li>
    </div></td>
          <td valign="top"><!-- ====================================================================================
下面的两个IFRAME中，第一个用来显示地图供用户添加标点；第二个用来在“提交”后保存标点信息（不在网页中显示），
===================================================================================== -->
<iframe id="map" name="map" src="" width=480 height=350 frameborder=0 scrolling=no></iframe>
<iframe id="mapSubmit" name="mapSubmit" src="" width=0 height=0 frameborder=0 scrolling=no></iframe></td>
        </tr>
      </table>
    </div>
</div>
<script language="javascript">
initMap();
</script>