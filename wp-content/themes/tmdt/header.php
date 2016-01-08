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
global $current_user;
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
  <div id="wrapper">
    <header id="header">
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-right">
								<div class="wrap-user">
                  <?php if (is_user_logged_in()) { ?>
                    <ul>
										<li>
											<a class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown">
												<span class="avarta">
                          <?php echo get_avatar(get_the_author_meta($current_user->user_email), $size = '22'); ?> 
												</span>
												<?php echo $current_user->display_name ?>
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dropdownUser">
                        <li>
                          <span class="fa fa-pencil-square"></span>
                          <a href="<?php echo get_site_url() ?>/edit-profile/">Thay đổi tài khoản</a>
                        </li>
                        <li>
                          <span class="fa fa-pencil-square"></span>
                          <a href="<?php echo get_site_url() ?>/change-password/">Đổi mật khẩu</a>
                        </li>
                        <li>
                          <span class="fa fa-file-text-o"></span>
                          <a href="<?php echo get_site_url() ?>/list-user-post/">Thông tin bài post</a>
                        </li>
                        <li>
                          <span class="fa fa-sign-out"></span>
                          <a href="<?php echo wp_logout_url( home_url() ); ?>">Thoát</a>
                        </li>
											</ul>
										</li>
									</ul>
                    
										<?php } else { get_template_part('ajax', 'auth'); ?>
                    <ul>
													<li>
														<a data-toggle="modal" data-target="#register-form"><span class="fa fa-sign-in"></span>Đăng ký</a>
													</li>
													<li>
														<a data-toggle="modal" data-target="#login-form"><span class="fa fa-user-plus"></span>Đăng nhập</a>
													</li>
										<?php } ?>
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
										<?php
												wp_nav_menu( array(
														'theme_location' => 'primary',
														'menu'=> 'top_menu',
														'menu_class' => 'nav navbar-nav',
														'container_class' => '',
												) );
										?>
										<div class="user-post navbar-right">
                      <a <?php echo (!is_user_logged_in())?'data-toggle="modal" data-target="#login-form"':'href="'.esc_url( home_url() ).'/dang-tin"'; ?>>
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
    
    <?php 
//      if(is_front_page() || is_category() || is_home() || is_search() || is_archive())
        get_template_part('block/block_category'); 
      ?>
