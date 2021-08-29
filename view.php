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
	$thumb = encode($thumb);
	$thumb = "images.php?hash=$thumb";
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
		$theloai2 = " <a title=\"Thể loại $tentheloai\" href=\"/the-loai/$tentheloaiurl.html\"><span style=\"margin-top:15px;\" class=\"btn btn-sm blue\">$tentheloai</span></a> ".$theloai2;
	}
	
	$gioithieudes = catchuoi2(trimkhoangtrang(trim(strip_tags(html_entity_decode($gioithieu)))),100);
	
	$title = "Đọc truyện $tentruyen online - Đọc truyện online";
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

                    <div class="profile">
                        <div class="tabbable-line tabbable-full-width">
                           
                            <div class="">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled">
                                                <li>
                                                    
											            <div class="img-thumb">
											                <img alt="<?php echo $tentruyen;?>" src="<?php echo $thumb;?>" >
											                <div class="caption">
											                    
											                </div>
											            </div>
											           
											       
                                                </li>
                                                <li>
                                                    
                                                    <div class="thongtintruyen note note-success">
				                                    	<strong>Tác giả</strong>: <?php echo $tacgia;?>
				                                    </div>
                                                </li>
                                                <li>
                                                    <div class="thongtintruyen note note-info">
				                                    	<strong>Trạng thái</strong>: Loading...
				                                    </div>
                                                </li>
                                                <li>
                                                	<div class="thongtintruyen note note-danger">
				                                    	<strong>Thể loại</strong>: <?php echo $theloai2;?>
				                                    </div>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="gioithieutruyen col-md-8 profile-info">
                                                    <h1 class="font-green sbold uppercase"><?php echo $tentruyen;?></h1>
                                                    <div class="gioithieutruyen">
                                                    	<div class="noidung show-more-height">
                                                    		<?php echo giaima($gioithieu);?>
                                                    	</div>
                                                    	 <div class="show-more">(Xem thêm)</div>
                                                    	</div
                                                    </div>
                                                    
                                                    
                                                    <div class="tabbable-custom nav-justified">
				                                        <ul class="nav nav-tabs nav-justified">
				                                            <li class="active">
				                                                <a aria-expanded="true" href="#tab_1_1_1" data-toggle="tab"> Danh sách chương </a>
				                                            </li>
				                                            <li class="">
				                                                <a aria-expanded="false" href="#tab_1_1_2" data-toggle="tab"> Cùng tác giả </a>
				                                            </li>
				                                            
				                                        </ul>
				                                        <div class="tab-content">
				                                            <div class="tab-pane active" id="tab_1_1_1">
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
				                                           		<div class="phantrang">     
													            	<ul class="pagination-view pagination-sm"></ul>        
											                	</div>
											                	<div class="phantrang">
											                	<span id="tranghientai">1</span> / <span><?php echo $sotrang;?></span>
											                	</div>
				                                            </div>
				                                            <div class="tab-pane" id="tab_1_1_2" style="">
				                                            	<div class="row">
				                                            	<?php
				                                                	$sql2 = mysql_query("SELECT tentruyen,thumb,id,tacgia FROM temp where tacgia like '$tacgia' and id <>'$idtruyen'");
																	while($qsql2 = mysql_fetch_array($sql2))
																	{
																	$idtruyen = $qsql2['id'];
																	$tentruyen = $qsql2['tentruyen'];
																	$tentruyenurl = chuyenurl($tentruyen);
																	$thumb = $qsql2['thumb'];
															        
															        
															        echo '
															        <div class="col-sm-12 col-md-6">
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
																?>
																</div>
												
				                                            </div>
				                                            
				                                        </div>
				                                    </div>
                                                    
                                                  
                                                </div>
                                                <!--end col-md-8-->
                                                <div class="col-md-4">
                                                    <div class="portlet sale-summary">
                                                        <div class="portlet-title">
                                                            <div class="caption font-red sbold"> Chuyện hay </div>
                                                            
                                                        </div>
                                                        <div class="portlet-body">
                                                            <ul class="list-unstyled">
                                                            	<?php
                                                            	$link = "http://truyenfull.vn/ajax.php";
																$postdata = "type=top_switch&data_type=month&data_limit=20";
                                                            	$ketqua = gettruyenfull($link,$postdata);
                                                            	$html = str_get_html($ketqua);
																foreach($html->find('h3 a') as $element)
																{
																	$tieude = trim($element->title);
																	$linkgoc = trim($element->href);
																	$sql2 = mysql_query("SELECT tentruyen,url,id,tacgia FROM temp where url='$linkgoc'");
																	$qsql2 = mysql_fetch_array($sql2);
																	
																	$idtruyenhot = $qsql2['id'];
																	if($idtruyenhot != "")
																	{
																	$tentruyenhot = $qsql2['tentruyen'];
																	$tentruyenurlhot = chuyenurl($tentruyenhot);
																		
                                                            	?>
                                                                <li>
                                                                    <h2 class="truyenhot"><a title="Đọc truyện <?php echo $tentruyenhot;?>" href="Doc-Truyen-<?php echo $tentruyenurlhot;?>-<?php echo $idtruyenhot;?>/"><?php echo $tentruyenhot;?></a></h2>
                                                                        
                                                                    
                                                                </li>
                                                                <?php
																	}
                                                                }
                                                                ?>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-md-4-->
                                            </div>
                                            <!--end row-->
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
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
