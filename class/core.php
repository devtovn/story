<?php
function ghilog($filename,$noidung)
{
	$pathfull = "logs/$filename";
	$write = fopen($pathfull, "a");
	fwrite($write,"- ".date('d/m/Y - H:i:s').": ".$noidung." \n");
	fclose($write);
}

function get_noidung($url) {
	$ch = curl_init();
	$timeout = 1200000;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0"); // set  useragent
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function laynoidung($noidung, $start, $stop) {
		$bd = strpos($noidung, $start);
		$tru = strlen($start);
		$bd = $bd + $tru;
		$noidung2 = substr($noidung, $bd);
		$kt = strpos($noidung2, $stop);
		$content = substr($noidung2, 0, $kt);
		return $content;
}

function gettruyenfull($url,$postdata="") {
		$headers = array();
		$headers[] = 'Host: truyenfull.vn';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0';
		$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		$headers[] = 'Referer: http://truyenfull.vn/the-loai/sac/';
		//$headers[] = 'Cookie: _ga=GA1.2.811952154.1451875061; history-cookie=KzvPvbVsOibiBLaHV5bmggVGhpw6puIEtodXnhur90OnZhbi1raHV5bmgtdGhpZW4ta2h1eWV0OjI6NDN8VGjhuqduIEto4buRbmcgVGhpw6puIEjhuqE6dHJ1eWVuLXRoYW4ta2hvbmctdGhpZW4taGE6OjI2NzM%3D; _gat=1';
		//$headers[] = 'Connection: keep-alive';
		$headers[] = 'Cache-Control: max-age=0';
		
		$c = curl_init($url);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		if($postdata != "")
		{
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
		}
		$page = curl_exec($c);
		curl_close($c);

		return $page;
}


function gettruyenyy($url,$postdata="") {
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
		if($postdata != "")
		{
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
		}
		$page = curl_exec($c);
		curl_close($c);

		return $page;
}

function listtruyen($idtheloai, $limit) {
		$sql = mysql_query("SELECT * FROM theloai where idtheloai='$idtheloai' ORDER BY id Desc limit $limit");
		while($qsql = mysql_fetch_array($sql))
		{
		$idtheloai = $qsql['id'];
		$idtruyen = $qsql['idtruyen'];
		//Qyery truyen
        $sql2 = mysql_query("SELECT tentruyen,thumb,id FROM temp where id='$idtruyen'");
		$qsql2 = mysql_fetch_array($sql2);
		$idtruyen = $qsql2['id'];
		$tentruyen = $qsql2['tentruyen'];
		$tentruyenurl = chuyenurl($tentruyen);
		$thumb = $qsql2['thumb'];
		$thumb = encode($thumb);
		$thumb = "hinh-anh/$thumb.jpg";
        
        
        echo '
        <div class="col-xs-6 col-sm-4 col-md-2">
        	<a href="Doc-Truyen-'.$tentruyenurl.'-'.$idtruyen.'/">
            <div class="img-wrap">
                <img class="lazy" data-original="'.$thumb.'" alt="'.$tentruyen.'">
                <div class="caption">
                    <h6 style="text-align: center; ">'.$tentruyen.'</h6>
                </div>
            </div>
            </a>
        </div>
  		';
		
		
		}
}



?>