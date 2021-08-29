<?php
	$tenurl = $_GET['tenurl'];
	$trang = (int)$_GET['trang'];
	
	$tenurl = kiemtra($tenurl);
	$trang = kiemtra($trang);
	$sql = mysql_query("SELECT * FROM dstheloai where tenurl='$tenurl'");
	$qsql = mysql_fetch_array($sql);
	$idtheloai = $qsql['id'];
	$tentheloai = $qsql['ten'];
	$tenurl = $qsql['tenurl'];
	
	
	 
	$title = "Truyện $tentheloai";
	$des = "Đọc truyện $tentheloai online, cập nhật mới nhất 2015 2016";
	
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
                            <a title="Thể loại truyện" href="the-loai/">Thể loại</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php echo $tentheloai;?></span>
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
                                        <span class="caption-subject bold font-yellow-casablanca uppercase"> <?php echo $tentheloai;?> </span>
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
										$sodu_lieu = mysql_query("SELECT idtheloai FROM theloai where idtheloai='$idtheloai'") or die(mysql_error());
										$sodu_lieu = mysql_num_rows($sodu_lieu);
										$baitren_mottrang = 35;
										$sotrang = ceil($sodu_lieu/$baitren_mottrang);
										$dau = $trang*$baitren_mottrang;
										$cuoi = $baitren_mottrang;
										
										listtruyen($idtheloai, "$dau,$cuoi");
									?>
                                    </div>
                                    <div id="phantrang" style="text-align: center">     
						            	<ul class="pagination-demo pagination-sm"></ul>        
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
