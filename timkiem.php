<?php
	$s= kiemtra($_GET['s']);
	$s2  = str_replace("d", "đ", $s);
	$s3  = str_replace("đ", "d", $s);
	
	$title = "Tìm kiếm từ khóa $s";
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
                            <span class="active">Truyện mới</span>
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
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> Tìm kiếm - Từ khóa "<?php echo $s;?>" </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
									<div class="row">
									<?php
									$trang = (int)$_GET['trang'];
									if($trang == "")
									{
										$trang = 0;
									}
									else
										{
											$trang = $trang - 1;
										}
										//phan trang	            
										$sodu_lieu = mysql_query("SELECT id FROM temp where tentruyen like '%$s2%' or tentruyen like '%$s3%' or tacgia like '%$s2%' or tacgia like '%$s3%'") or die(mysql_error());
										$sodu_lieu = mysql_num_rows($sodu_lieu);
										$baitren_mottrang = 36;
										$sotrang = ceil($sodu_lieu/$baitren_mottrang);
										$dau = $trang*$baitren_mottrang;
										$cuoi = $baitren_mottrang;
										
										$sql2 = mysql_query("SELECT tentruyen,thumb,url,id,tacgia FROM temp where tentruyen like '%$s2%' or tentruyen like '%$s3%' or tacgia like '%$s2%' or tacgia like '%$s3%' order by id DESC limit $dau,$cuoi");
										while($qsql2 = mysql_fetch_array($sql2))
										{
											$idtruyen = $qsql2['id'];
											$tentruyen = $qsql2['tentruyen'];
											$tentruyenurl = chuyenurl($tentruyen);
											$thumb = $qsql2['thumb'];
											$thumb = encode($thumb);
											$thumb = "images.php?hash=$thumb";	
	                                    	echo '
											        <div class="col-sm-6 col-md-2">
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
                                    <div class="phantrang" style="text-align: center">     
						            	<ul class="pagination-timkiem pagination-sm"></ul>        
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
