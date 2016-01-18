<?php
/**
 * Template Name: User Profile
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php 
 global $current_user;
 if(!is_user_logged_in())
{
  wp_redirect( home_url());
}
?>
<section class="categories details user all-article">
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post(); ?>
				 <ol class="breadcrumb">
							<?php if(function_exists('bcn_display'))
							{
									bcn_display();
							}?>
					</ol>
				<?php endwhile; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				<div class="all-content-user">
					<div class="title-form-user">
						<h2>
							<span class="fa fa-user"></span>
							Thông tin cá nhân
						</h2>
					</div>
					<div class="content-user">
						<div class="info-user-accout">
							<span class="left">Họ và tên:</span>
							<span class="right"><?php echo $current_user->display_name; ?></span>
						</div>
						<div class="info-user-accout">
							<span class="left">Email:</span>
							<span class="right"><?php echo $current_user->user_email; ?></span>
						</div>
						<div class="info-user-accout">
							<span class="left">Tên đăng nhập:</span>
							<span class="right"><?php echo $current_user->user_login; ?></span>
						</div>
						<div class="info-user-accout">
							<span class="left">Mật khẩu:</span>
							<span class="right">******</span>
						</div>
					</div>

				</div>
			</div><!--end left-user-->

			<div id="sidebar" class="col-md-3">
        <?php get_template_part('block/menu_right'); ?>
				<?php get_template_part('block/menu-user-profile'); ?>
        
			</div>
		</div>

	</div>
</section>
<?php get_footer(); ?>