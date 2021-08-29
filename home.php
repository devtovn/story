<?php
	$title = "Đọc truyện online mới nhất 2015 2016";
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
                            
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
					<?php
					$sql_tongtruyen = mysql_query("SELECT id FROM temp");
					$tongtruyen = number_format($tongtruyengoc = mysql_numrows($sql_tongtruyen),0);
					
					$sql_theloai = mysql_query("SELECT id FROM dstheloai");
					$tongtheloai = number_format(mysql_numrows($sql_theloai));
					
					//fake chap :D
					$tongchap = number_format($tongtruyengoc * 2000);
					
					//fake useronline
					$useronline = rand(6,10);
					?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $tongtruyen;?>"><?php echo $tongtruyen;?></span>
                                    </div>
                                    <div class="desc"> Đầu truyện </div>
                                </div>
                                <a class="more" href="javascript:;"> Xem ngay
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-file-pdf-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $tongchap;?>"><?php echo $tongchap;?></span></div>
                                    <div class="desc"> Chap </div>
                                </div>
                                <a class="more" href="javascript:;"> Xem ngay
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php echo $tongtheloai;?>"><?php echo $tongtheloai;?></span>
                                    </div>
                                    <div class="desc"> Thể loại </div>
                                </div>
                                <a class="more" href="the-loai/"> Xem ngay
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value=""><?php echo $useronline;?></span> người </div>
                                    <div class="desc"> Online </div>
                                </div>
                                <a class="more" href="javascript:;"> Xem ngay
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="row">
                    	<div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Đang HOT </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
									<?php
                                        	$link = "http://truyenfull.vn/ajax.php";
											$postdata = "type=top_switch&data_type=month&data_limit=12";
                                        	$ketqua = gettruyenfull($link,$postdata);
                                        	$html = str_get_html($ketqua);
											foreach($html->find('h3 a') as $element)
											{
												$tieude = trim($element->title);
												$linkgoc = trim($element->href);
												$sql2 = mysql_query("SELECT tentruyen,thumb,url,id,tacgia FROM temp where url='$linkgoc'");
												$qsql2 = mysql_fetch_array($sql2);
												
												$idtruyen = $qsql2['id'];
												if($idtruyen != "")
												{
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
                                    </div>
                                </div>
                               
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        
						<div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Mới nhất </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
									<?php
																
										$sql2 = mysql_query("SELECT tentruyen,thumb,url,id,tacgia FROM temp order by id DESC limit 12");
										while($qsql2 = mysql_fetch_array($sql2))
										{
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
									?>
                                    </div>
                                </div>
                                <a href="moi-nhat/"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
						
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Ngôn tình </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
									<?php
										listtruyen(41, 6);
									?>
                                    </div>
                                </div>
                                <a href="the-loai/Ngon-Tinh.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Tiên Hiệp </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
										listtruyen(44, 6);
										?>
                                    </div>
                                </div>
                                <a href="the-loai/Tien-Hiep.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Kiếm Hiệp </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
										listtruyen(43, 6);
										?>
                                    </div>
                                </div>
                                <a href="the-loai/Kiem-Hiep.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        

                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Đô thị </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
										listtruyen(47, 6);
										?>
                                    </div>
                                </div>
                                <a href="the-loai/Do-Thi.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Trinh thám </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
										listtruyen(40, 6);
										?>
                                    </div>
                                </div>
                                <a href="the-loai/Trinh-Tham.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light boxhome">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Sắc hiệp </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
										listtruyen(46, 6);
										?>
                                    </div>
                                </div>
                                <a href="the-loai/Sac-Hiep.html"><div class="fa-item" style="float:right;"><i class="icon-arrow-right"></i> Xem thêm</div></a>
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
