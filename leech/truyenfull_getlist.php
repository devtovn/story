<?php
include '../config.php';
include '../class/dom.php';
include '../class/chucnang.php';
include '../class/core.php';

$page = $_GET['page'];
if($page == "")
{
	$page= 20;
}
$pagenext = $page - 1;
if($page <= 0)
{
	echo "Hoan thanh";
	//$pagenext = 1;
	exit;
		
}
?>

<html>
<meta http-equiv="refresh" content="5; url=?page=<?php echo $pagenext;?>" />
<meta charset="UTF-8" />
</html>
<?php

$headers = array();
//$headers[] = 'Host: truyenyy.com';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
//$headers[] = 'Referer: http://truyenyy.com/danhmuctruyen/?sap_xep=alphabet&loai_truyen=all&the_loai=17';
//$headers[] = 'Cookie: __utma=67594580.1518516428.1451667072.1455177262.1455183138.10; __utmz=67594580.1451667072.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); csrftoken=q081IaqvT15e9X5Xow86TkYRG5AG7GgC; sessionid=d81548bb229170230bc2364f25724808; __utmc=67594580; __utmb=67594580.4.10.1455183138';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Cache-Control: max-age=0';

$loginUrl = 'http://truyenfull.vn/danh-sach/truyen-moi/trang-'.$page.'/';
$c = curl_init($loginUrl);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
$page = curl_exec($c);
curl_close($c);


$html = str_get_html($page);
foreach($html->find('div[class=col-xs-7]') as $element)
{
	$link = "";
	$tentruyen = "";
	$tacgia = "";
	
	$text = $element->innertext;
	if($text == "")
	{
		echo "Hoan thanh";
		exit;
	}
	$html2 = str_get_html($text);
	foreach($html2->find('h3[class=truyen-title] a') as $element2)
	{
		$link = $element2->href;
		$tentruyen = $element2->plaintext;
		$tentruyen = trim($tentruyen);
		
	}

	foreach($html2->find('span.author') as $element2)
	{
		
			$tacgia = $element2->plaintext;
			$tacgia = trim($tacgia);
			
	}
	
	
	
	
	
	$sql2 = mysql_query("SELECT tentruyen,id FROM temp where tentruyen='$tentruyen'");
	$check = mysql_numrows($sql2);
	if($check > 0)
	{
		//$qsql2 = mysql_fetch_array($sql2);
		//$idtruyen = $qsql2['id'];
		//$a = mysql_query("Delete from temp where id='$idtruyen'") or die('Error: ' . mysql_error());;
		
	
		ghilog("get_list_error.txt", "Truyenfull: $tentruyen - $link");
		echo "Ten truyen: $tentruyen  ===> Trùng<br />";
		echo "--------------------------<br />";
	}
	else {
		$link = mysql_real_escape_string($link);
		$tentruyen = mysql_real_escape_string($tentruyen);
		$tacgia = mysql_real_escape_string($tacgia);
		$a = mysql_query("INSERT INTO temp (url,tentruyen,tacgia) Values ('$link','$tentruyen','$tacgia')") or die('Error: ' . mysql_error());;
		
		ghilog("get_list_OK.txt", "$tentruyen - $link");
		echo "Ten truyen: $tentruyen<br />";
		echo "Link: $link<br />";
		echo "Tac gia: $tacgia<br />";
		echo "--------------------------<br />";
	}
	
}

?>
