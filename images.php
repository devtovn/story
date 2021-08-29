<?php
include 'config.php';
include 'class/chucnang.php';
include 'class/dom.php';
include 'class/core.php';
header('Content-type: image/png');
$hash = $_GET['hash'];
$url = decode($hash);
$headers = array();
$headers[] = 'Host: truyenfull.vn';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0';
//$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
//$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Referer: http://truyenfull.vn/the-loai/sac/';
//$headers[] = 'Cookie: _ga=GA1.2.811952154.1451875061; history-cookie=KzvPvbVsOibiBLaHV5bmggVGhpw6puIEtodXnhur90OnZhbi1raHV5bmgtdGhpZW4ta2h1eWV0OjI6NDN8VGjhuqduIEto4buRbmcgVGhpw6puIEjhuqE6dHJ1eWVuLXRoYW4ta2hvbmctdGhpZW4taGE6OjI2NzM%3D; _gat=1';
//$headers[] = 'Connection: keep-alive';
$headers[] = 'Cache-Control: max-age=0';

$c = curl_init($url);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);

//curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
$page = curl_exec($c);
curl_close($c);


echo $page;
?>