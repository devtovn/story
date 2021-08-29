<?php
	$temp = explode("-",$page);
	//echo $page;
	$dem = count($temp);
	$id = $temp[$dem-1];
	$idtruyen = kiemtra($id);
	
	$sql = mysql_query("SELECT * FROM temp where id='$idtruyen'");
	$qsql = mysql_fetch_array($sql);
	$idtruyen = $qsql['id'];
	$idtruyenview = $idtruyen;
	$tentruyen = $qsql['tentruyen'];
	$urltruyen = $qsql['url'];
	if (stripos(strtolower($urltruyen), 'truyenfull.vn') !== false)
	{
		$loai = "truyenfull";
	}
	if (stripos(strtolower($urltruyen), 'truyenyy.com') !== false)
	{
		$loai = "truyenyy";
	}
	$gioithieu = $qsql['gioithieu'];
	$tacgia = $qsql['tacgia'];
	$thumb = $qsql['thumb'];
	$theloai = "";
	$theloai2 = "";
	$sql2 = mysql_query("SELECT * FROM theloai where idtruyen='$idtruyen'");
	while($qsql2 = mysql_fetch_array($sql2))
	{
		$idtheloai = $qsql2['idtheloai'];
		
		$sql3 = mysql_query("SELECT * FROM dstheloai where id='$idtheloai'");
		$qsql3 = mysql_fetch_array($sql3);
		$tentheloai = $qsql3['ten'];
		$tentheloaiurl = $qsql3['tenurl'];
		$theloai = "<a title=\"Thể loại $tentheloai\" href=\"/the-loai/$tentheloaiurl.html\">$tentheloai</a>, ".$theloai;
		$theloai2 = " <a title=\"Thể loại $tentheloai\" href=\"/the-loai/$tentheloaiurl.html\"><span class=\"label label-primary\">$tentheloai</span></a> ".$theloai2;
	}
	
	$gioithieudes = catchuoi2(trimkhoangtrang(trim(strip_tags(html_entity_decode($gioithieu)))),100);
	
	$title = "Đọc truyện $tentruyen online";
	$des = "Đọc truyện $tentruyen online, ".$gioithieudes;
	include 'header.php';

?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a title="Đọc truyện online" href="trang-chu/">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <?php echo $theloai;?>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="<?php echo $_GET['page'];?>/"><span class="active">Đọc truyện <?php echo $tentruyen;?></span></a>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-soft">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h1 class="read"><i class="fa icon-notebook"></i> Đọc truyện <?php echo $tentruyen;?></h1></div>
                               
                                </div>
                                <div id="bodynoidung" class="portlet-body">
                                	
                                	<?php
                                	$chuong = $_GET['chuong'];
                                	if($loai == "truyenfull")
									{
	                                	$urltruyenget = $urltruyen."$chuong/";
	                                	$page2 = gettruyenfull($urltruyenget);
										$html = str_get_html($page2);
										foreach($html->find('a[class=chapter-title]') as $element)
										{
											$textchuong = trimkhoangtrang(trim($element->plaintext));
											$titlechuong = trim($element->title);
											
										}
										foreach($html->find('div.chapter-c') as $element)
										{
											$noidungchuong = $element->innertext;
											
										}
										
										foreach($html->find('a#prev_chap') as $element)
										{
											$chuongtruoc = $element->href;
											if($chuongtruoc != "javascript:void(0)")
											{
												$templ = explode("/", $chuongtruoc);
												$dem = count($templ);
												$chuongtruoc = $templ[$dem-2];
												$urlchuongtruoc = $page."/$chuongtruoc/";
											}
											else {
												$distruoc = "disabled";
											}
											
											
										}
										
										foreach($html->find('a#next_chap') as $element)
										{
											$chuongsau = $element->href;
											if($chuongsau != "javascript:void(0)")
											{
												$templ = explode("/", $chuongsau);
												$dem = count($templ);
												$chuongsau = $templ[$dem-2];
												$urlchuongsau = $page."/$chuongsau/";
											}
											else {
												$dissau = "disabled";
											}
										}
									}

									if($loai == "truyenyy")
									{
	                                	$urltruyenget = $urltruyen."$chuong/";
										$urltruyenget = str_replace("/truyen/", "/doc-truyen/", $urltruyenget);
	                                	$page2 = gettruyenyy($urltruyenget);
										
										$html = str_get_html($page2);
										foreach($html->find('div#noidungtruyen h1') as $element)
										{
											$textchuong = trimkhoangtrang(trim($element->plaintext));
											break;
											
										}
										foreach($html->find('div#id_noidung_chuong') as $element)
										{
											$noidungchuong = $element->innertext;
											$noidungchuong = str_replace('<a href="http://truyenyy.com" style="color:white;font-size:1px;">Nguồn: http://truyenyy.com</a>', "", $noidungchuong);
											
										}
										
										foreach($html->find('div.mobi-chuyentrang a') as $element)
										{
											$text = "";
											$url = "";
											$text = trimkhoangtrang(trim($element->plaintext));
											$url = trim($element->href);
											if($text == "Trước")
											{
												$templ = explode("/", $url);
												$dem = count($templ);
												$chuongtruoc = $templ[$dem-2];
												$urlchuongtruoc = $_GET['page']."/$chuongtruoc/";
												
											}
											if($text == "Sau")
											{
												$templ = explode("/", $url);
												$dem = count($templ);
												$chuongsau = $templ[$dem-2];
												$urlchuongsau = $_GET['page']."/$chuongsau/";
												
											}
											
											
											
											
											
											
										}
										if($urlchuongtruoc == "")
										{
											$distruoc = "disabled";
										}
										
										if($urlchuongsau == "")
										{
											$dissau = "disabled";
										}
										
										
									}
                                	?>
                                	<h2 class="chuongsub uppercase"><?php echo $textchuong;?></h2>
                                	
                                	<div class="control toolboxkhung">
	                                	<div class="btn-group btn-group btn-group-justified toolbox">
	                                        <a href="<?php echo $urlchuongtruoc;?>" class="btn  blue <?php echo $distruoc;?>"><span class="glyphicon glyphicon-chevron-left"></span> Trước </a>
	                                        <a data-toggle="modal" href="<?php echo $_SERVER['REQUEST_URI'];?>#showlistchuong" class="btn red"> List chương </a>
	                                        <a href="<?php echo $urlchuongsau;?>" class="btn green <?php echo $dissau;?>"> Sau <span class="glyphicon glyphicon-chevron-right"></span></a>
	                                    </div>
	                                    
                                   </div>
                                   <div class="control toolboxkhung">
	                                    
	                                    <div class="btn-group btn-group btn-group-justified toolbox">
	                                        <a href="" class="btn green fullscreen"></span> Toàn màn hình </a>
	                                        <a class="btn dark nenden btn-nenden" > Nền đen </span></a>
	                                        <a class="btn btn-default nentrang btn-nentrang" > Nền trắng </span></a>
	                                    </div>
                                   </div>
                                   
                                   
                                   <div id="kichthuoc" class="noUi-success"></div>
                                  
                                   
                             		<div id="noidungchap">
                             			<?php
                             			if($loai == "truyenfull")
										{
											$noidungchuong = str_replace("<br><br>", "<br />",$noidungchuong);
											$htmlnoidung = str_get_html($noidungchuong);
											foreach($html->find('img') as $element)
											{
												$src = "";
												$src = $element->src;
												$mahoa = encode($src);
												$mahoa = "images.php?hash=$mahoa";
												$noidungchuong = str_replace($src, $mahoa, $noidungchuong);
												
											}
										}
                             			
                             			?>
                             			<?php echo $noidungchuong;?>
                             			
                             		</div>
                             		
                             		
                             		<div class="control toolboxkhung">
	                                	<div class="btn-group btn-group btn-group-justified toolbox">
	                                        <a href="<?php echo $urlchuongtruoc;?>" class="btn  blue <?php echo $distruoc;?>"><span class="glyphicon glyphicon-chevron-left"></span> Trước </a>
	                                        <a data-toggle="modal" href="<?php echo $_SERVER['REQUEST_URI'];?>#showlistchuong" class="btn red"> List chương </a>
	                                        <a href="<?php echo $urlchuongsau;?>" class="btn green <?php echo $dissau;?>"> Sau <span class="glyphicon glyphicon-chevron-right"></span></a>
	                                    </div>
	                                    
                                   </div>
                                   <div class="control toolboxkhung">
	                                    
	                                    <div class="btn-group btn-group btn-group-justified toolbox">
	                                        <a href="" class="btn green fullscreen"></span> Toàn màn hình </a>
	                                        <a class="btn dark nenden btn-nenden" > Nền đen </span></a>
	                                        <a class="btn btn-default nentrang btn-nentrang" > Nền trắng </span></a>
	                                    </div>
                                   </div>
                                    
                                </div>
                            </div>
                            <div id="showlistchuong" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Danh sách chương</h4>
                                                </div>
                                                <div class="modal-body">
                                                		<div class="phantrang">     
													            	<ul class="pagination-view pagination-sm"></ul>        
											                	</div>
                                                    <div id="listchuong">
                                                    	
				                                            	<ul class="list-unstyled">
									                			
				                                            	<?php
				                                            	
				                                            	if($loai == "truyenfull")
																{
				                                            		$page2 = gettruyenfull($urltruyen);
																	$html = str_get_html($page2);
																	foreach($html->find('ul[class=list-chapter] li a') as $element)
																	{
																		$textchuong = trimkhoangtrang(trim($element->plaintext));
																		$linkchuong = trim($element->href);
																		$templ = explode("/", $linkchuong);
																		$dem = count($templ);
																		$linkchuong = $templ[$dem-2];
				                                            			echo '<li><span class="fa fa-book"></span> <a title="'.$textchuong.'" href="'.$_GET['page'].'/'.$linkchuong.'/">'.$textchuong.'</a> </li>';
				                                            	
				                                                	}
																	foreach($html->find('input#total-page') as $element2)
																	{
																		$sotrang = $element2->value;
																	}
																}
																
																if($loai == "truyenyy")
																{
				                                            		$page2 = gettruyenyy($urltruyen);
																	$html = str_get_html($page2);
																	foreach($html->find('a[class=jblack]') as $element)
																	{
																		$textchuong = trimkhoangtrang(trim($element->plaintext));
																		$linkchuong = trim($element->href);
																		$templ = explode("/", $linkchuong);
																		$dem = count($templ);
																		$linkchuong = $templ[$dem-2];
				                                            			echo '<li><span class="fa fa-book"></span> <a title="'.$textchuong.'" href="'.$_GET['page'].'/'.$linkchuong.'/">'.$textchuong.'</a> </li>';
				                                            	
				                                                	}
																	foreach($html->find('div.pagination ul li') as $element2)
																	{
																		$text = trim($element2->plaintext);
																		if($text != "&rarr;")
																		{
																			$sotrang = $text;
																		}
																	}
																}
																
																
				                                                ?>
				                                                </ul>
				                                               </div>
				                                           
				                                             	</div>
				                                           		<div class="phantrang">     
													            	<ul class="pagination-view pagination-sm"></ul>        
											                	</div>
											                	<div class="phantrang">
											                	<span id="tranghientai"></span> / <span><?php echo $sotrang;?></span>
											                	</div>
											                	
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                    </div>
                    
                    
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        
<?php
	include 'footer.php';

?>
