<?php
/**
 * Template Name: User post
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
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
										<span class="fa fa-file-text-o"></span>
										Form đăng tin
									</h2>
								</div>
								<div class="content-user">
									<p>Chú ý: Những thông tin có dấu <span class="star">(*)</span> là bắt buộc nhập, không được bỏ trống</p>
									<?php
										// Start the Loop.
										while ( have_posts() ) : the_post();
											the_content();
										endwhile;
									?>
								</div>

							</div>
						</div><!--end left-user-->

						<div id="sidebar" class="col-md-3">
							<?php get_template_part('block/menu-user-profile'); ?>
							<?php get_template_part('block/menu_right'); ?>
              
						</div>
					</div>

				</div>
			</section>
<?php
get_footer();
