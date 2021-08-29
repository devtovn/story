<html>
<meta http-equiv="refresh" content="5; url=truyenyy_get_thongtin.php" />
<meta charset="UTF-8" />
</html>
<?php
include '../config.php';
include '../class/dom.php';
include '../class/chucnang.php';
include '../class/core.php';


$check2 = mysql_query("SELECT * FROM temp where thumb='' order by id ASC limit 1");
$qcheck2 = mysql_fetch_array($check2);
$url = $qcheck2['url'];
$idtruyen = $qcheck2['id'];
$ten = $qcheck2['tentruyen'];


echo "<title>$idtruyen</title>";

$headers = array();
$headers[] = 'Host: truyenyy.com';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Referer: http://truyenyy.com/danhmuctruyen/?sap_xep=alphabet&loai_truyen=all&the_loai=17';
$headers[] = 'Cookie: __utma=67594580.1518516428.1451667072.1455177262.1455183138.10; __utmz=67594580.1451667072.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); csrftoken=q081IaqvT15e9X5Xow86TkYRG5AG7GgC; sessionid=d81548bb229170230bc2364f25724808; __utmc=67594580; __utmb=67594580.4.10.1455183138';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Cache-Control: max-age=0';

$c = curl_init($url);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
$page = curl_exec($c);
curl_close($c);


$html = str_get_html($page);
foreach($html->find('div[class=thumbnail] img') as $element)
{
	$thumb = $element->src;
	$thumb = "http:".$thumb;
}

foreach($html->find('div[id=desc_story]') as $element)
{
	$gioithieu = $element->innertext;
}

$html2 = str_get_html($gioithieu);
foreach($html2->find('div[class=fb-like],div[class=g-plusone]') as $element2)
{
	$b = $element2->outertext='';
	$gioithieu = $html2->save();
}

foreach($html->find('span[class=ds-theloai] span') as $element)
{
	$theloai = $element->plaintext;
	$theloai = trim($theloai);
	$theloaitim = chuyenurl($theloai);
	
	$check2 = mysql_query("SELECT * FROM dstheloai where tenurl='$theloaitim'");
	$qcheck2 = mysql_fetch_array($check2);
	$idtheloai = $qcheck2['id'];
	if($idtheloai == "0" or $idtheloai == "")
	{
		ghilog("get_noidung_error_theloai_1.txt", "$theloai -  - $url");
		
		$theloai = mysql_real_escape_string($theloai);		
		$a = mysql_query("INSERT INTO dstheloai (ten,tenurl) Values ('$theloai','$theloaitim')") or die('Error: ' . mysql_error());
		$check3 = mysql_query("SELECT * FROM dstheloai where tenurl='$theloaitim'");
		$qcheck3 = mysql_fetch_array($check3);
		$idtheloai = $qcheck3['id'];
	}
	if($idtheloai == 0 or $idtheloai == "")
	{
		ghilog("get_noidung_error_theloai_2.txt", "$theloai - $idtruyen - $url");
	}
	
	echo $idtheloai." - ";
	
	$sql_check_trung_tl = mysql_query("SELECT * FROM theloai where idtruyen='$idtruyen' and idtheloai='$idtheloai'");
	$check_tl = mysql_numrows($sql_check_trung_tl);
	if($check_tl == 0)
	{
		$a = mysql_query("INSERT INTO theloai (idtruyen,idtheloai) Values ('$idtruyen','$idtheloai')") or die('Error: ' . mysql_error());
	}
	
}

echo "<br />Tên Truyện: $ten <br />";
echo "<br />Link anh: ".$thumb."<br />";
echo "Link goc: ".$url."<br />";
echo $gioithieu;

$gioithieu = mysql_real_escape_string($gioithieu);

$run = mysql_query("UPDATE temp SET thumb='$thumb', gioithieu='$gioithieu', trangthai='1' where id='$idtruyen'");
ghilog("get_noidung_OK.txt", "$ten - $idtruyen - $url");



?>
