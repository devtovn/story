<!-- BEGIN FOOTER -->
        <div class="page-footer ">
        	<div class="row note note-info">
               <div class="col-md-8">
               		<h2 style="font-size: 15px; display: inline">Đọc truyện 24h online</h2>  - Đọc truyện online, đọc truyện chữ, truyện hay. Website luôn cập nhật những bộ truyện mới thuộc các thể loại đặc sắc như truyện tiên hiệp, kiếm hiệp, hay truyện ngôn tình một cách nhanh nhất. Hỗ trợ mọi thiết bị như di động và máy tính bảng. Tất cả các truyện trên site đều được đọc giả sưu tầm từ các nguồn trên mạng, chúng tôi không chịu bất cứ trách nhiệm nào về vấn đề bản quyền tác giả, nếu các bạn đọc truyện nào thấy có nội dung liên quan đến vấn đề chính trị hoặc có nội dung không lành mạnh vui lòng liên hệ chúng tôi xóa bỏ truyện khỏi trang web. Chân thành cảm ơn.
               </div>
               <!-- Go to www.addthis.com/dashboard to customize your tools -->
				

               <div class="col-md-4 "><h1 style="font-size: 15px">Đọc truyện online</h1>
               	<div itemscope itemtype="http://schema.org/Person">
				   <span itemprop="name"> DocTruyen24h.xyz</span>
				   <span itemprop="company"> Sieuleech</span>
				   <span itemprop="tel"> 090-555-1234</span>
				   <a itemprop="email" href="mailto:admin@doctruyen24h.xyz"> admin@doctruyen24h.xyz</a>
				</div>
               	<div class="page-footer-inner"> 2016 &copy; <a href="http://doctruyen24h.xyz" title="Đọc truyện online" target="_blank">DocTruyen24h.xYz</a> - <a href="https://trolyfacebook.com" title="Đọc truyện online" target="_blank">Trợ lý Bé Điệu - Trợ lý facebook</a>.
	            </div>
               </div>

	            
	            
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
		<script src="assets/global/plugins/respond.min.js"></script>
		<script src="assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.twbsPagination.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.lazyload.min.js" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script type="text/javascript">
			 $(document).ready(function(){ 
				
				$("img.lazy").lazyload({
				    effect : "fadeIn"
				});
				
				<?php 
				if($sotrang == "")
				{
					$sotrang = 20;
				}
				?>
				
				$('.pagination-demo').twbsPagination({
				    totalPages: <?php echo $sotrang;?>,
				    visiblePages: 7,
				    href: '/the-loai/<?php echo $tenurl;?>/trang-{{number}}.html'
				});
				
				$('.pagination-new').twbsPagination({
				    totalPages: <?php echo $sotrang;?>,
				    visiblePages: 7,
				    href: '/moi-nhat/trang-{{number}}.html'
				});
				
				$('.pagination-timkiem').twbsPagination({
				    totalPages: <?php echo $sotrang;?>,
				    visiblePages: 7,
				    href: '/?s=<?php echo $s;?>&trang={{number}}'
				});
				
				$('.pagination-view').twbsPagination({
				    totalPages: <?php echo $sotrang;?>,
				    visiblePages: 5,
				    last: 'Cuối',
				    first: 'Đầu',
				    next: '',
				    prev : '',
				    initiateStartPageClick: true,
				 	href: '<?php echo $_SERVER['REQUEST_URI'];?>#trang-{{pageNumber}}.html',
				 	hrefVariable: '{{pageNumber}}',
			        onPageClick: function (event, page) {
			        	
			            $.ajax({
				          type: 'GET',    
				          url: "ajax.chuong.php?id=<?php echo $idtruyenview;?>&page=" + page +"&url=<?php echo $_GET['page'];?>",
				          data: {},        
				          cache:false,
				         
				          success: function(data)
							{
								$('#tranghientai').html(page);
								if(page != "1")
								{
									$("html, body").animate({
							        scrollTop: $('#listchuong').offset().top 
							    	}, 400);
								}
								
								$("#listchuong").html('Loading...');
					            
								$('#listchuong').html(data);
								
								
							}
				        });
			        }
				});
				
				
				
				 $(".show-more").click(function () {
				      var $this = $(this);
				      $this.text($this.text() == "(Thu gọn)" ? "(Xem thêm)" : "(Thu gọn)");
				      	$(".noidung").toggleClass("show-more-height");
				    });
				 $(".btn-nenden").click(function () {
				      $("#bodynoidung").css({"background-color":"#000000"});
				      $("#noidungchap").css({"color":"#ffffff"});
				    });
				    
				 $(".btn-nentrang").click(function () {
				      $("#bodynoidung").css({"background-color":"#ffffff"});
				      $("#noidungchap").css({"color":"#000000"});
				    });
			
			})
		</script>
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <?php
        if($t == "read")
		{
			echo '
			<script src="assets/global/plugins/nouislider/nouislider.min.js" type="text/javascript"></script>
			<script src="assets/pages/scripts/components-nouisliders.min.js" type="text/javascript"></script>';
		}
        ?>
        
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>