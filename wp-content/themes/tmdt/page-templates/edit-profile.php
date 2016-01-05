<?php
/**
 * Template Name: User Edit profile
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();
//$pid = $_GET['pid'];
//$action = $_GET['action'];
//$arr = array('edit', 'del');
//if(!isset($pid) || !is_numeric($pid) || !in_array($action, $arr)){
//	wp_redirect( home_url(). '/list-user-post/'); exit;
//}
?>

<section class="categories details user all-article">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="#">Trang chủ</a></li>
								<li class="active">Thông tin người dùng</li>
							</ol>
						</div>
					</div>

					<div class="row">
						<div class="col-md-9">
							<div class="all-content-user">
								<div class="title-form-user">
									<h2>
										<span class="fa fa-file-text-o"></span>
										Thông tin tài khoản
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
						</div>
					</div>

				</div>
			</section>
<?php
get_footer();
