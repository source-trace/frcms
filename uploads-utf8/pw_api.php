<?php
//error_reporting(0);
define('P_W','admincp');
require(dirname(__FILE__).'/config.inc.php');
include_once(FR_ROOT.'/api/api_config.php');

define('R_P',FR_ROOT.'/');
define('D_P',R_P);

require_once(FR_ROOT.'/api/pw_api/class_base.php');

$api = new api_client();
$response = $api->run($_POST + $_GET);
if ($response) {
	echo $api->dataFormat($response);
}
?>