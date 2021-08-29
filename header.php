<?php
if($title == "")
{
	$title = "Đọc truyện Online";
}

if($des == "")
{
	$des = "Đọc truyện online 24h xyz , truyện chữ, truyện hay ,truyện hentai , truyện 18+, truyện người lớn, tiên hiệp, kiếm hiệp, ngôn tình, sắc hiệp, đô thị mới nhất";
}

if($thumb == "")
{
	$thumb = "http://".$_SERVER['SERVER_NAME']."/images/logo.jpg";
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $title;?></title>
        <base href="https://<?php echo $_SERVER['SERVER_NAME'];?>/" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        
		<meta name="description" content="<?php echo $des;?>">
        <meta name="keywords" content="Đọc truyện 24h xyz , Đọc truyện online, đọc truyện chữ, truyện hay ,truyen hentai , truyện 18+, truyện người lớn, truyện tiên hiệp, kiếm hiệp, truyện ngôn tình, truyện sắc hiệp, truyện đô thị, truyện huyền nhiễm">
        <meta name="author" content="doctruyen.site">
        
		<meta property="og:type" content="article" /> 
		<meta property="og:url" content="<?php echo $url;?>"/>
		<meta property="og:title" content="<?php echo $title;?>" />
		<meta property="og:image" content="<?php echo $thumb;?>" /> 
		<meta property="og:description" content="<?php echo $des;?>" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        
        <?php
        if($t =="view")
		{
			echo '
        <link href="assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
        ';
		}
		 if($t == "read")
		{
			echo '
        <link href="assets/global/plugins/nouislider/nouislider.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/nouislider/nouislider.pips.css" rel="stylesheet" type="text/css" />
        ';
		}
		?>
		
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
		<link rel="manifest" href="images/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<script type="application/ld+json">
		{
		    "@context": "http://schema.org",
		    "@type": "WebSite",
		    "url": "https://doctruyen.site/",
		    "name": "Doc truyen online 24h",
		    "alternateName": "Truyen Tong Hop"
		    "potentialAction": {
		      "@type": "SearchAction",
		      "target": "https://doctruyen.site/?s={search_term_string}",
		      "query-input": "required name=search_term_string"
		    }
		}
		</script>

		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', 'UA-71090934-3', 'auto');
			  ga('send', 'pageview');
			
			</script>
			
</head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a title="Đọc truyện Online" href="https://doctruyen.site">
                        <img title="Đọc truyện Online" alt="Đọc truyện Online" src="images/logo.png" height="70px" style="margin: 1px 10px 0 10px;" /> </a>
                    
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <form class="search-form" action="/" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm"  placeholder="Nhập tên truyện hoặc tác giả muốn tìm kiếm..." name="s">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper" >
                <div class="page-sidebar navbar-collapse collapse" >
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">
                        <li class="nav-item start ">
                            <a title="Đọc truyện online" href="trang-chu/" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Trang chủ</span>
                            </a>
                            
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Thống Kê</h3>
                        </li>
                        <li class="nav-item  ">
                            <a title="Đọc truyện online mới nhất" href="moi-nhat/" class="nav-link nav-toggle">
                                <i class="icon-star"></i>
                                <span class="title">Mới nhất</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a title="Đọc truyện online được xem nhiều nhất" href="xem-nhieu/" class="nav-link nav-toggle">
                                <i class="icon-badge"></i>
                                <span class="title">Xem nhiều</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Thể loại</h3>
                        </li>
                        <?php
                        
						$sql = mysql_query("SELECT * FROM dstheloai");
						while($qsql = mysql_fetch_array($sql))
						{
						$idtheloaimenu = $qsql['id'];
						$tentheloaimenu = $qsql['ten'];
						$tenurlmenu = $qsql['tenurl'];
                        
                        
                        ?>
                        <li class="nav-item  ">
                            <a href="/the-loai/<?php echo $tenurlmenu;?>.html" title="Thể loại <?php echo $tentheloaimenu;?>" class="nav-link nav-toggle">
                                <i class="icon-tag"></i>
                                <span class="title"><?php echo $tentheloaimenu;?></span>
                            </a>
                        </li>
                        <?php
						}
						
						?>
                            </ul>
                        
                   
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->