<?php
define('FR_API','');
//是否开启整合，空为不整合，pw为整合phpwind，uc为整合Ucenter
//此文件中的注释字符不可删除
if(FR_API&&FR_API=='uc'){

/*uc_config 开始*/
define('UC_CONNECT', 'mysql');
define('UC_DBHOST', 'localhost');
define('UC_DBUSER', 'root');
define('UC_DBPW', '123456');
define('UC_DBNAME', 'ucenter');
define('UC_DBCHARSET', 'gbk');
define('UC_DBTABLEPRE', 'uc_');
define('UC_DBCONNECT', '0');
define('UC_KEY', 'dfdfdfsdfdsfdsd');
define('UC_API', 'http://192.168.1.200/uc');
define('UC_CHARSET', 'gbk');
define('UC_IP', '');
define('UC_APPID', '1');
define('UC_PPP', '20');
/*uc_config 结束*/
@include_once FR_ROOT.'/uc_client/client.php';

}elseif(FR_API&&FR_API=='pw'){

define('P_W','admincp');
require_once(FR_ROOT.'/api/pw_api/security.php');
require_once(FR_ROOT.'/api/pw_api/pw_common.php');

/*pw_config 开始*/
define('UC_DBHOST', 'localhost');
define('UC_DBUSER', 'root');
define('UC_DBPW', '123456');
define('UC_DBNAME', 'phpwind');
define('UC_DBCHARSET', 'gbk');
define('UC_DBTABLEPRE', 'pw_');
define('UC_DBCONNECT', '0');
define('UC_KEY', '1u0ckr7zbyl58xqwljrq');
define('UC_API', 'http://192.168.1.200');
define('UC_CHARSET', 'gbk');
define('UC_IP', '');
define('UC_APPID', '2');
/*pw_config 结束*/

$uc_appid=UC_APPID;
$uc_key=UC_KEY;
@include_once(FR_ROOT.'/pw_client/uc_client.php');

}
?>