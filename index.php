<?php

include 'config.php';
include 'class/chucnang.php';
include 'class/dom.php';
include 'class/core.php';


$page = kiemtra($_GET['page']);
$s = kiemtra($_GET['s']);



if($page == "trang-chu" and $s == "")
{
	include 'home.php';
}
else if($page == "" and $s != "")
{
	include 'timkiem.php';
}
else if($page == "the-loai")
{
	include 'theloai.php';
}
else if(substr($page,0,10) == "Doc-Truyen")
{
	if($_GET['act']=="read")
	{
		$t="read";
		include 'read.php';
		
	}
	else {
		$t="view";
		include 'view.php';
	}
	
}
elseif($page == "xem-nhieu")
{
	include 'xemnhieu.php';
}
elseif($page == "moi-nhat")
{
	include 'moinhat.php';
}
else
{
	include 'home.php';
}


?>