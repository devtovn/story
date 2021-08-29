<?php
include '../config.php';
include '../class/dom.php';
include '../class/chucnang.php';
include '../class/core.php';

$page = $_GET['page'];
if($page == "")
{
	$page= 10;
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
<meta http-equiv="refresh" content="3; url=?page=<?php echo $pagenext;?>" />
<meta charset="UTF-8" />
</html>
<?php





$loginUrl = 'http://truyenyy.com/danhmuctruyen/?loai_truyen=all&the_loai=all&sap_xep=alphabet&page='.$page;
$c = curl_init($loginUrl);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($c);
curl_close($c);



$html = str_get_html($page);
foreach($html->find('tr[class=info],tr[class=success]') as $element)
{
	$text = $element->innertext;
	if($text == "")
	{
		echo "Hoan thanh";
		exit;
	}
	$html2 = str_get_html($text);
	foreach($html2->find('td[class=nav-list] a') as $element2)
	{
		$link = $element2->href;
		$link = "http://truyenyy.com".$link;
		$tentruyen = $element2->plaintext;
		$tentruyen = trim($tentruyen);
		
	}
	$stt = 0;
	$tacgia = "";
	foreach($html2->find('td') as $element2)
	{
		if($stt == 1)
		{
			$tacgia = $element2->plaintext;
			$tacgia = trim($tacgia);
			break;
		}
		else {
			$stt = $stt + 1;
		}
		
	}
	
	$sql2 = mysql_query("SELECT tentruyen,id FROM temp where tentruyen='$tentruyen'");
	$check = mysql_numrows($sql2);
	if($check > 0)
	{
		//$qsql2 = mysql_fetch_array($sql2);
		//$idtruyen = $qsql2['id'];
		//$a = mysql_query("Delete from temp where id='$idtruyen'") or die('Error: ' . mysql_error());;
		
	
		ghilog("get_list_error.txt", "Truyenyy: $tentruyen - $link");
		echo "Ten truyen: $tentruyen  ===> Trùng<br />";
		echo "--------------------------<br />";
	}
	else {
	
	echo "Ten truyen: $tentruyen<br />";
	echo "Link: $link<br />";
	echo "Tac gia: $tacgia<br />";
	echo "--------------------------<br />";
	
	$a = mysql_query("INSERT INTO temp (url,tentruyen,tacgia) Values ('$link','$tentruyen','$tacgia')") or die('Error: ' . mysql_error());;
	}
}

?>
