<?php
require('../vendor/autoload.php');

$jobTicket = (string)\Ulid\Ulid::generate();
$url = @$_GET['url'] ?? '';
$s   = @$_GET['s'] ?? 2 ;
$s   = sprintf('%0.3f', $s);

$fmt = @$_GET['fmt'] ?? 'jpg';
if (!in_array($fmt, ['png', 'jpg', 'jpeg'])) {
	header('HTTP/1.1 422 Unprocesible Entity');
	exit();
}
$codec = $fmt;
if ($fmt == 'jpg'){
	$fmt = 'jpeg';
	$codec = 'jpeg';
}

if (substr($url, 0, 4) !== 'http') {
	header('HTTP/1.1 422 Unprocesible Entity');
	exit();
}
[
	'scheme' => $scheme,
	'host'   => $host,
] = parse_url($url);

$allowedDomains = getenv('DOMAINS') ? explode(',', getenv('DOMAINS')) : [];
if (!empty($allowedDomains) && ! in_array($host, $allowedDomains)) {
	header('HTTP/1.1 422 Unprocesible Entity');
	exit();
}

$picName = sprintf('%s.%s', $jobTicket, $fmt);
$convertFlags = '';
if ($codec == 'png') {
	$convertFlags = ' -vcodec png  -q:v 15 ';
}
if ($codec == 'jpeg') {
	$convertFlags = ' -vcodec mjpeg  -q:v 15 ';
}

$cmd = 'ffmpeg -ss '.escapeshellarg($s).' -i '.escapeshellarg($url).' -vframes 1 '.$convertFlags.' -an '.$picName . ' 2>&1';

$output = '';
$ret = 0;
$q = exec($cmd, $output, $ret);

if ($ret != 0) {
	header('HTTP/1.1 500 Internal Server Error');
	header('X-Error: exec returrned '.$ret);
	exit($ret);
}

$f = @fopen($picName, 'rb');
if (!$f) {
	header('HTTP/1.1 500 Internal Server Error');
	header('X-Error: fopen failed');
	exit(-1);
}
['size'=>$size] = fstat($f);

header('Content-Type: image/'.$fmt);
header('Content-Disposition: attachment; filename="'.$picName.'"');
header('Content-Length: '.$size);
fpassthru($f);
fclose($f);
unlink($picName);
