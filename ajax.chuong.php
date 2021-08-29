<?php
include 'config.php';
include 'class/chucnang.php';
include 'class/dom.php';
include 'class/core.php';

$idtruyen = kiemtra($_GET['id']);
$page = kiemtra($_GET['page']);
$url = ($_GET['url']);

$sql = mysql_query("SELECT id,url FROM temp where id='$idtruyen'");
$qsql = mysql_fetch_array($sql);

$urltruyen = $qsql['url'];
if (stripos(strtolower($urltruyen), 'truyenfull.vn') !== false)
{
	$loai = "truyenfull";
}
if (stripos(strtolower($urltruyen), 'truyenyy.com') !== false)
{
	$loai = "truyenyy";
}


echo '<ul class="list-unstyled">';

if($loai == "truyenfull")
{
	$urltruyen = $urltruyen."trang-".$page."/";	
	$page2 = gettruyenfull($urltruyen);
	$html = str_get_html($page2);
	foreach($html->find('ul[class=list-chapter] li a') as $element)
	{
		$textchuong = trimkhoangtrang(trim($element->plaintext));
		$linkchuong = trim($element->href);
		$templ = explode("/", $linkchuong);
		$dem = count($templ);
		$linkchuong = $templ[$dem-2];
		echo '<li><span class="fa fa-book"></span> <a title="'.$textchuong.'" href="'.$_GET['url'].'/'.$linkchuong.'/">'.$textchuong.'</a> </li>';

	}
	
}

if($loai == "truyenyy")
{
	$urltruyen = $urltruyen."?page=".$page;	
	$page2 = gettruyenyy($urltruyen);
	$html = str_get_html($page2);
	foreach($html->find('a[class=jblack]') as $element)
	{
		$textchuong = trimkhoangtrang(trim($element->plaintext));
		$linkchuong = trim($element->href);
		$templ = explode("/", $linkchuong);
		$dem = count($templ);
		$linkchuong = $templ[$dem-2];
		echo '<li><span class="fa fa-book"></span> <a title="'.$textchuong.'" href="'.$_GET['url'].'/'.$linkchuong.'/">'.$textchuong.'</a> </li>';

	}
	
}
?>
</ul>