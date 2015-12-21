<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php //if ( get_header_image() ) : ?>
<!--	<div id="site-header">
		<a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php //header_image(); ?>" width="<?php //echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>-->
	<?php //endif; ?>

<!--	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<h1 class="site-title"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a></h1>

			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text" aria-expanded="false" aria-controls="search-container"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
			</div>

			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php// _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php// _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
			</nav>
		</div>

		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php //get_search_form(); ?>
			</div>
		</div>
	</header> #masthead -->

	<!--<div id="main" class="site-main">-->
  
  <div id="wrapper">
    <header id="header">
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-right">
								<div class="wrap-user">
									<ul>
										<li>
											<a data-toggle="modal" data-target="#register"><span class="fa fa-sign-in"></span>Đăng ký</a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#login"><span class="fa fa-sign-in"></span>Đăng nhập</a>
										</li>
									</ul>
								</div>
								<div class="social">
									<a href="">
										<span class="fa fa-facebook-square"></span>
									</a>
									<a href="">
										<span class="fa fa-twitter-square"></span>
									</a>
								</div>
								<div class="hotline">
									<span class="fa fa-phone-square"></span>
									<span class="name">Hotline:</span>
									<span class="number">(08) 3932 9777</span>
								</div>
							</div>
						</div>
					</div>
				</div><!--end topbar-->
				<div class="top-adv">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<a href="#">
									<img src="<?php echo get_template_directory_uri(); ?>/images/banner-top.jpg" alt="">
								</a>
							</div>
						</div>
					</div>
				</div><!--end top-adv-->
				<div class="navigation">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<nav class="navbar navbar-default" role="navigation">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
										<a class="navbar-brand" href="#">
											<!-- <img src="images/logo.png" alt=""> -->
										</a>
									</div>
								
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse navbar-ex1-collapse">
										<form class="navbar-form navbar-left form-inline" role="search">
											<div class="form-group dropdown">
												<input type="text" class="form-control dropdown-toggle" placeholder="Tìm theo danh mục" id="dropdownCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<ul class="dropdown-menu" aria-labelledby="dropdownCategories">
													<li><a href="">Thời trang & Sức khỏe</a></li>
													<li><a href="">Ẩm thực & Tiệc</a></li>
													<li><a href="">Nguồn địa ốc</a></li>
													<li><a href="">4 mùa & Khuyến mãi</a></li>
													<li><a href="">Điện & Gia dụng</a></li>
													<li><a href="">Xe & Công nghệ</a></li>
												</ul>
												
												<button type="submit" class="btn btn-default">
													<i class="fa fa-search"></i>
												</button>
											</div>	
										</form>
										<ul class="nav navbar-nav">
											<li class="active"><a href="#">Trang chủ</a></li>
											<li><a href="#">Giới thiệu</a></li>
											<li><a href="#">Quy định</a></li>
											<li><a href="#">Tuyển dụng</a></li>
											<li><a href="#">Liên hệ</a></li>
										</ul>
										<div class="user-post navbar-right">
											<a href="#">
												<span class="fa fa-file-text-o"></span>
												Đăng tin
											</a>
										</div>
									</div><!-- /.navbar-collapse -->
								</nav>
							</div>
						</div>
					</div>
				</div><!--end navigation-->
			</header>
    
    <?php get_template_part('block/block_category'); ?>
