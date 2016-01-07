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

<section class="categories details user all-article">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							 <ol class="breadcrumb">
										<?php if(function_exists('bcn_display'))
										{
												bcn_display();
										}?>
								</ol>
						</div>
					</div>

					<div class="row">
						<div class="col-md-9">
							<div class="main-page">
									<?php
										// Start the Loop.
										while ( have_posts() ) : the_post();
											the_content();
										endwhile;
									?>
							</div>
						</div><!--end left-user-->

						<div id="sidebar" class="col-md-3">
							<?php get_template_part('block/menu_right'); ?>
						</div>
					</div>

				</div>
			</section>
<?php
get_footer();
