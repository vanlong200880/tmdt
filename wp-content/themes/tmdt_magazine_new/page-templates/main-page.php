<?php
/**
 * Template Name: main page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>
<?php //get_template_part('block/block_category');  ?>
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
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="main-page">
									<?php
										// Start the Loop.
										while ( have_posts() ) : the_post();
											the_content();
										endwhile;
									?>
							</div>
						</div><!--end left-user-->

						<div id="sidebar" class="col-md-3 col-sm-4 col-xs-12">
							<?php get_template_part('block/menu_right'); ?>
						</div>
					</div>

				</div>
			</section>
<?php
get_footer();
