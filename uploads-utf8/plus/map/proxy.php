<?php

/* =========================================================================

     jsproxy.php, Serve as a http proxy for Modello.ajax

     Author: Ken Xu <ken@ajaxwing.com>

     Version: 0.0.6

     Date: 2006-04-18

     For more information, see: http://modello.sourceforge.net/

   -----------------------------------------------------------------------

     Copyright 2006 by Ken Xu

                              All Rights Reserved

     Permission to use, copy, modify, and distribute this software and its
     documentation for any purpose and without fee is hereby granted, provided
     that the above copyright notice appear in all copies and that both that
     copyright notice and this permission notice appear in supporting
     documentation, and that the name of Ken Xu not be used in advertising or
     publicity pertaining to distribution of the software without specific,
     written prior permission.

     KEN XU DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE, INCLUDING
     ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS, IN NO EVENT SHALL
     KEN XU BE LIABLE FOR ANY SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES OR ANY
     DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN
     AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
     OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
添加45-59行。跟原Px.php一样。更改172行跟原Px.php26行一样
   ========================================================================= */
error_reporting(0);

define('ALLOW_CONTENT_TYPE', 'text/* application/x-javascript');
define('DEFAULT_CHARSET', 'gb2312');

define('SOCKET_CONNECT_TIMEOUT', 20);
define('SOCKET_READ_TIMEOUT', 10);

$proxy = 'http://searchbox.mapbar.com/publish'; 
$qry = $_SERVER['QUERY_STRING'];	
$url = "";
if(strpos($qry, 'api=keyword') !== FALSE ){
	$url = $proxy.'/common/proxy.jsp?'.$qry;
}else if(strpos($qry, 'api=getCityByName') !== FALSE ) {
	$url = $proxy.'/common/proxy.jsp?'.$qry;
} else if(strpos($qry, 'api=template1000') !== FALSE ) {
	$url = $proxy.'/template/template1000/?'.substr($qry, strpos($qry, '&') + 1);
} else if(strpos($qry, 'api=poiUpdate') !== FALSE ) {
	$url = $proxy.'/common/proxy.jsp?'.$qry;
}else if(strpos($qry, 'api=template1010') !== FALSE ) {
	$url = $proxy.'/template/template1010/?'.substr($qry, strpos($qry, '&') + 1);
}

$data = stripslashes($_POST['data']);
$header = stripslashes($_POST['header']);

$request_headers = array();
foreach (explode("\r\n", $header) as $item) {
    if (!$item) {
        continue;
    }
    list($key, $val) = explode(':', $item, 2);
    $request_headers[$key] = trim($val);
}

$ret = urlget($url, $data, $request_headers);

if ($ret === false) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

list($response_header, $response_body) = $ret;

// Get content-type, charset from HTTP header
$charset = '';
$content_type = '';
$response_headers = array();
foreach (explode("\r\n", $response_header) as $header) {
    if (!$header) {
        continue;
    }
    list($key, $val) = explode(':', $header, 2);
    if (strpos($key, 'HTTP/') === 0) {
        $response_headers = array();
        continue;
    }
    $val = trim($val);
    if (strtolower($key) == 'content-type') {
        $key = 'Content-Type';
    }
    if (strtolower($key) == 'set-cookie') {
        $key = 'Cross-Domain-Cookie';
    }
    $response_headers[$key] = $val;
    if (strtolower($key) == 'content-type') {
        $items = explode(';', $val);
        $content_type = trim($items[0]);
        if (count($items) > 1) {
            $item = trim($items[1]);
            if (strtolower(substr($item, 0, 8)) == 'charset=') {
                $charset = substr($item, 8);
            }
        }
    }
}

// Get content-type, charset from response body
$pattern = '/<meta\s+http-equiv=["\']?content-type["\']?\s*content=["\']?([^"\']+)["\']?\s*\/?>/i';
$ret = preg_match($pattern, $response_body, $matches);
if ($ret) {
    $str = strtolower($matches[1]);
    $items = explode(';', $str);
    $content_type = trim($items[0]);
    if (count($items) > 1) {
        $item = trim($items[1]);
        if (substr($item, 0, 8) == 'charset=') {
            $charset = substr($item, 8);
        }
    }
}

// Check content-type
if (strlen($content_type) == 0) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

list($major, $minor) = explode('/', $content_type);
$items = explode(' ', ALLOW_CONTENT_TYPE);
$match = false;
foreach ($items as $item) {
    list($part_1, $part_2) = explode('/', $item);
    if ($major === $part_1 && ($minor === $part_2 || $part_2 === '*')) {
        $match = True;
        break;
    }
}

if (!$match) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

// Use default charset
if (strlen($charset) == 0) {
    $charset = DEFAULT_CHARSET;
}

$response_headers['Content-Type'] = $content_type . ';charset=' . $charset;

foreach ($response_headers as $key => $val) {
    header($key . ': ' . $val);
}
//echo  $response_body; //输出返回内容
echo str_replace("proxy.jsp?api=poiUpdate", "proxy.php?api=poiUpdate", $response_body);

function urlget ($url, $data, $headers) {

    $items = @parse_url($url);
    if (!$items || $items['scheme'] !== 'http') {
        return false;
    }

    $host = $items['host'];
    if (!$host) {
        return false;
    }

    $port = $items['port'];
    if (!$port) {
        $port = 80;
    }
    $path = $items['path'];
    if (!$path) {
        $path = '/';
    }

    $s = @fsockopen($host, $port, &$e, &$t, SOCKET_CONNECT_TIMEOUT);
    if ($s === false) {
        return false;
    }

    $location = $path;
    if ($items['query']) {
        $location .= '?' . $items['query'];
    }

    if ($data) {
        $first_line = 'POST ' . $location . ' HTTP/1.1';
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $headers['Content-Length'] = strval(strlen($data));
    }else {
        $first_line = 'GET ' . $location . ' HTTP/1.1';
    }

    $headers['HOST'] = $host;

    $request_header = "$first_line\r\n";
    foreach ($headers as $key => $val) {
        $request_header .= "$key: $val\r\n";
    }

    fputs($s, $request_header . "\r\n");

    if ($data) {
        fputs($s, $data);
    }

    $source_read = '';
    $header_found = false;
    $status = socket_get_status($s);
    while ($status['timed_out'] != true && !feof($s)) {
        socket_set_timeout($s, SOCKET_READ_TIMEOUT);
        $source_read .= fgets($s, 1024);
        if ($header_found == false && substr(&$source_read,-4,4) == "\r\n\r\n") {
            $response_header = substr( $source_read, 0, strlen($source_read)-2 );
            $header_found = true;
            $source_read = '';
        }
        $status = socket_get_status($s);
    }
    $response_body = $source_read;

    return array($response_header, $response_body);

}

?>
