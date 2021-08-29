<?php

	
	$title = "Truyện được xem nhiều nhất";
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
                            <span class="active">Xem nhiều</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-book-open font-yellow-casablanca"></i>
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Xem nhiều </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
										<?php
                                        	$link = "http://truyenfull.vn/ajax.php";
											$postdata = "type=top_switch&data_type=month&data_limit=50";
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
