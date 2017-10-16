<?php
require_once(dirname(__FILE__).'/../../config.inc.php');
$c_ip=getip();
$c_brower=getbrowse();
$c_os=getos();
$c_come=$referer;
if($c_come=='') $c_come="网址输入或收藏夹打开";
$c_page=$_SERVER["HTTP_REFERER"];
$c_year=date('Y');
$c_month=date('m');
$c_day=date('d');
$c_hour=date('H');
$c_time=date('Y-m-d H:i:s');
$c_week=date('w');
$c_where=trim(getip_from($c_ip));

$sql="Insert into {$cfg['tb_pre']}count(c_ip,c_where,c_come,c_page,c_brower,c_os,c_year,c_month,c_day,c_hour,c_time,c_week) values('$c_ip','$c_where','$c_come','$c_page','$c_brower','$c_os','$c_year','$c_month','$c_day','$c_hour','$c_time','$c_week')";
$db->get_one($sql);
$c_id=$db ->insert_id();
$date=date("Y-m-d");
$rs = $db->get_one("select * from {$cfg['tb_pre']}countnum");
if($rs){
    $rss = $db->get_one("select c_ip from {$cfg['tb_pre']}count where DATE(c_time)='$date' AND c_ip='$c_ip' and c_id!=$c_id");
    $n_todayip = $rss ? "" : ",n_todayip=n_todayip+1";
    $dd=datediff($date,$rs["n_time"]);
    switch($dd){
        case 0:
        $sql="n_today=n_today+1$n_todayip";
        break;
        case 1:
        $sql="n_today=1,n_todayip=1,n_yesterday={$rs["n_today"]},n_yesterdayip={$rs["n_todayip"]},n_time='$date'";
        break;
        default:
        $sql="n_today=1,n_todayip=1,n_yesterday=0,n_yesterdayip=0,n_time='$date'";
    }
    $db ->get_one("update {$cfg['tb_pre']}countnum set n_total=n_total+1,$sql");
}else{
    $db ->get_one("Insert into {$cfg['tb_pre']}countnum(n_today,n_todayip,n_total,n_time) values(1,1,1,'$date')");
}
if($style!=''){
$n_today=$n_yesterday=$n_todayip=$n_yesterdayip=$n_total=0;
$rs = $db->get_one("select * from {$cfg['tb_pre']}countnum");
if($rs){$n_today=$rs["n_today"];$n_todayip=$rs["n_todayip"];$n_yesterday=$rs["n_yesterday"];$n_yesterdayip=$rs["n_yesterdayip"];$n_total=$rs["n_total"];}
}
if($style=='total'){
    echo "document.write ('$n_total')";
}elseif($style=='text'){
    echo "document.write ('今日PV:$n_today 今日IP:$n_todayip 昨日PV：$n_yesterday 昨日IP：$n_yesterdayip 总访问：$n_total')";
}else{
    echo "";
}

function getbrowse(){
    $browserver="";
    $agent = $_SERVER["HTTP_USER_AGENT"];
    if(strpos($agent, "MSIE 8.0")) {
        $browserver = "Internet Explorer 8.0";
    }elseif(strpos($agent, "MSIE 7.0")) {
        $browserver = "Internet Explorer 7.0";
    }elseif(strpos($agent, "MSIE 6.0")) {
        $browserver = "Internet Explorer 6.0";
    }elseif(strpos($agent, "MSIE 5.5")) {
        $browserver = "Internet Explorer 5.5";
    }elseif(strpos($agent, "MSIE 5.0")) {
        $browserver = "Internet Explorer 5.0";
    }elseif(strpos($agent, "MSIE 4.01")) {
        $browserver = "Internet Explorer 4.01";
    }elseif(strpos($agent, "NetCaptor")) {
        $browserver = "NetCaptor";
    }elseif(strpos($agent, "Netscape")) {
        $browserver = "Netscape";
    }elseif(strpos($agent, "Lynx")) {
        $browserver = "Lynx";
    }elseif(strpos($agent, "Opera")) {
        $browserver = "Opera";
    }elseif(strpos($agent, "Konqueror")) {
        $browserver = "Konqueror";
    }elseif(strpos($agent, "Mozilla/5.0")) {
        $browserver = "Mozilla";
    }else {
        $browserver = "others";
    }
    return $browserver;
}
function getos() {
    $os="";
    $agent = $_SERVER["HTTP_USER_AGENT"];
    if(eregi('win',$agent) && strpos($agent, '95')) {
        $os="Windows 95";
    }elseif (eregi('win 9x',$agent) && strpos($agent, '4.90')) {
        $os="Windows ME";
    }elseif (eregi('win',$agent) && ereg('98',$agent)) {
        $os="Windows 98";
    }elseif (eregi('win',$agent) && eregi('nt 5',$agent)) {
        $os="Windows 2000";
    }elseif (eregi('win',$agent) && eregi('nt 6',$agent)) {
        $os="Vista";
    }elseif (eregi('win',$agent) && eregi('nt',$agent)) {
        $os="Windows NT";
    }elseif (eregi('win',$agent) && ereg('xp',$agent)) {
        $os="Windows Xp";
    }elseif (eregi('win',$agent) && ereg('32',$agent)) {
        $os="Windows 32";
    }elseif (eregi('linux',$agent)) {
        $os="Linux";
    }elseif (eregi('unix',$agent)) {
        $os="Unix";
    }elseif (eregi('sun',$agent) && eregi('os',$agent)) {
        $os="SunOS";
    }elseif (eregi('ibm',$agent) && eregi('os',$agent)) {
        $os="IBM OS/2";
    }elseif (eregi('Mac',$agent) && eregi('PC',$agent)) {
        $os="Macintosh";
    }elseif (eregi('PowerPC',$agent)) {
        $os="PowerPC";
    }elseif (eregi('AIX',$agent)) {
        $os="AIX";
    }elseif (eregi('HPUX',$agent)) {
        $os="HPUX";
    }elseif (eregi('NetBSD',$agent)) {
        $os="NetBSD";
    }elseif (eregi('BSD',$agent)) {
        $os="BSD";
    }elseif (ereg('OSF1',$agent)) {
        $os="OSF1";
    }elseif (ereg('IRIX',$agent)) {
        $os="IRIX";
    }elseif (eregi('FreeBSD',$agent)) {
        $os="FreeBSD";
    }elseif (eregi('teleport',$agent)) {
        $os="teleport";
    }elseif (eregi('flashget',$agent)) {
        $os="flashget";
    }elseif (eregi('webzip',$agent)) {
        $os="webzip";
    }elseif (eregi('offline',$agent)) {
        $os="offline";
    }
    if ($os=='') $os = "Unknown OS";
    return $os;
}
?>