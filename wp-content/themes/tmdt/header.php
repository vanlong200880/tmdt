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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php if(wpmd_is_phone()): ?>
	<div class="menu-mobile">
    <div class="menu-sp-left mCustomScrollbar">
      <div class="mobile-login">
          <div class="wrap-user">
            <?php if (is_user_logged_in()) { ?>
						<ul class="is_login">
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
                    <a href="<?php echo get_site_url() ?>/account/">Thông tin tài khoản</a>
                  </li>
                  <li>
                    <span class="fa fa-pencil-square"></span>
                    <a href="<?php echo get_site_url() ?>/edit-profile/">Thay đổi tài khoản</a>
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
						<ul class="not_login">
                    <li>
                      <a data-toggle="modal" data-target="#register-form"><span class="fa fa-sign-in"></span>Đăng ký</a>
                    </li>
                    <li>
                      <a data-toggle="modal" data-target="#login-form"><span class="fa fa-user-plus"></span>Đăng nhập</a>
                    </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      <div class="wrap-new-adv">
      <div class="category-menu-left">
        <h2>Danh mục<span></span></h2>
        <ul class="menu-left">
        <?php get_template_part('block/menu_category'); ?>
        </ul>
        <span class="close-menu"><i class="fa fa-times"></i></span>
      </div>
    </div>
    </div>
    <script type="text/javascript">
			jQuery(document).ready(function($){
				$(".menu-sp-left").css('height',$(window).height());
				$("#header .menu-mb").on('click', function(){
					$(".menu-mobile").addClass('site-page-frame');
					$(".menu-showing").addClass('page-frame');
					$("#side-menu-overlay").addClass('on');
					$('body').css('position', 'fixed');
				});
        
				$("#side-menu-overlay").on('click', function(){
					$(this).removeClass('on');
					$(".menu-mobile").removeClass('site-page-frame');
					$(".menu-showing").removeClass('page-frame');
					$('body').removeAttr('style');
				});
				
				// form search
				$(".form-search").on('click', function(){
					$(".menu-sp-2-search").slideToggle();
				});
				// close form 
				$(".close-menu").on('click', function(){
					$("#side-menu-overlay").trigger('click');
				});
				
				// menu top
				$(".menu-top").on('click', function(){
					$(".menu-top-mobile").slideToggle();
				});
        
        // mobile login 
        $(".mobile-login .wrap-user ul.not_login li a").on('click', function(){
          $("#side-menu-overlay").trigger('click');
        });
			});
		</script> 
		
	</div>
	<?php endif; ?>
  
  <div id="wrapper" class="menu-showing">
    <div id="side-menu-overlay"></div>
    <?php if(wpmd_is_phone()): ?>
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 logo-sp">
            <a class="navbar-brand-sp" href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""> 
           </a>
          </div>
          <div class="col-xs-6 text-right">
            <span class="menu-top">
              <i class="fa fa-bars"></i>
            </span>
          </div>
        </div>
		  
		  
        
      </div>
		<div class="row">
			  <div class="menu-top-mobile navigation">
				<nav  class="navbar navbar-default">
				  <div class="container">
					<div class="row">
					  <div class="col-md-12">
						<?php
						  wp_nav_menu( array(
							  'theme_location' => 'primary',
							  'menu'=> 'top_menu',
							  'menu_class' => 'nav navbar-nav',
							  'container_class' => '',
						  ) );
						?>
					  </div>
					</div>
				  </div>
				</nav>
			  </div>
		  </div>
		<div class="row menu-sp-header">
		  <div class="col-xs-4">
			<span class="menu-mb"><i class="fa fa-list"></i></span>
		  </div>
		  <div class="col-xs-4">
			<div class="form-search">
			  <i class="fa fa-search"></i>
			</div>
		  </div>
		  <div class="col-xs-4">
			<div class="user-post navbar-right">
			  <a data-toggle="modal" data-target="#login-form">
				<span class="fa fa-file-text-o"></span>
				Đăng tin
			  </a>
			</div>
		  </div>
		</div>
    </header>
	
    <div class="menu-sp-2-search">
      <div class="container">
        <?php	get_search_form() ?>
      </div>
    </div>
    
    <?php endif; ?>

    <?php if(wpmd_is_notphone()): ?>
    <header id="header">
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-right">
								<div class="wrap-user">
                  <?php if (is_user_logged_in()) { ?>
									<ul class="user_login">
										<li class="dropdown">
											<a class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown">
												<span class="avarta">
                          <?php
                           if(get_user_meta(1, 'user_avatar', true)){ ?>
                            <img src="<?php echo get_user_meta(1, 'user_avatar', true); ?>" alt="<?php echo $current_user->display_name ?>">
                           <?php }else{ ?>
                             <span class="fa fa-user"></span>
                           <?php } ?>
												</span>
												<?php echo $current_user->display_name ?>
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dropdownUser">
                        <li>
                          <span class="fa fa-pencil-square"></span>
                          <a href="<?php echo get_site_url() ?>/account/">Thông tin tài khoản</a>
                        </li>
                        <li>
                          <span class="fa fa-pencil-square"></span>
                          <a href="<?php echo get_site_url() ?>/edit-profile/">Thay đổi tài khoản</a>
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
									<script type="text/javascript">
									$('ul.user_login li.dropdown').hover(function() {
												$(this).find('.dropdown-menu').stop(true, true).fadeIn();
											}, function() {
												$(this).find('.dropdown-menu').stop(true, true).fadeOut();
											});
									</script>
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
								<div class="slideshowHolder">
									<?php echo adrotate_ad(11); ?>
								</div>
								<script type="text/javascript">
									$(function () {
									// Slideshow 1
									$(".a-single").responsiveSlides({
										speed: 800
									});
								});
								</script>
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
      <?php endif; ?>
