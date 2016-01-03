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
<body <?php //body_class(); ?> <?php echo is_search()?'onload="initialize()"':'' ?>>
  <?php if (is_user_logged_in()) { ?>
    	<a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
<?php } else { get_template_part('ajax', 'auth'); ?>            	
        <a class="login_button" id="show_login" href="">Login</a>
        <a class="login_button" id="show_signup" href="">Signup</a>
<?php } ?>
  <div id="wrapper">
    <header id="header">
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-right">
								<div class="wrap-user">
									<ul>
										<li>
											<a data-toggle="modal" data-target="#register-form"><span class="fa fa-sign-in"></span>Đăng ký</a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#login-form"><span class="fa fa-sign-in"></span>Đăng nhập</a>
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
								<?php echo adrotate_ad(11); ?>
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
										<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
											 <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""> 
										</a>
									</div>
								
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse navbar-ex1-collapse">
										<?php	get_search_form() ?>
										<style>
												.ui-autocomplete{
													width: 200px;
													border: 1px solid #DDD;
													background: #E7E7E7;
													z-index: 999;
													position: absolute;
												}
											</style>
										
<!--										<form class="navbar-form navbar-left form-inline" role="search">
											<div class="form-group dropdown">
												<input type="text" class="form-control" id="tags">
												<ul id="red" class="dropdown-menu">
													<li><span data-key="a">Thời trang & Sức khỏe</span></li>
													<li><span data-key="b">Ẩm thực & Tiệc</span></li>
													<li><span data-key="c">Nguồn địa ốc</span></li>
													<li><span data-key="e">4 mùa & Khuyến mãi</span></li>
													<li><span data-key="g">Điện & Gia dụng</span></li>
													<li><span data-key="h">Xe & Công nghệ</span></li>
												</ul>
												
												<button type="submit" class="btn btn-default">
													<i class="fa fa-search"></i>
												</button>
											</div>
											
											<style>
												.ui-autocomplete{
													width: 200px;
													/*background: #000;*/
													border: 1px solid #DDD;
													background: #E7E7E7;
													z-index: 999;
													position: absolute;
												}
											</style>

										</form>-->
										<?php
												wp_nav_menu( array(
														'theme_location' => 'primary',
														'menu'=> 'top_menu',
														'menu_class' => 'nav navbar-nav',
														'container_class' => '',
												) );
										?>
										<div class="user-post navbar-right">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>/dang-tin">
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
