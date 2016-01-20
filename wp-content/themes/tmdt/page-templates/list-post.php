<?php
/**
 * Template Name: List User Post
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
global $current_user;
if(!is_user_logged_in())
{
  wp_redirect( home_url());
}
$filter = array();
if(isset($_GET['filter']) && $_GET['filter'] == 'pending'){
	$filter = array('pending');
}elseif (isset($_GET['filter']) && $_GET['filter'] == 'publish') {
	$filter = array('publish');
}else{
	$filter = array('publish','pending');
}
$width = 269;
$height = 179;
if(wpmd_is_phone())
{
	$width = 360;
	$height = 240;
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
			<div class="col-md-9 col-sm-9 col-xs-12">
				<div class="all-content-user">
					<div class="title-form-user">
						<h2>
							<span class="fa fa-file-text-o"></span>
							Danh sách bài đăng
							<div class="status">
								<span>Trạng thái</span>
								<select name="user-post-user" id="user-post-filter">
                  <option value="<?php echo get_site_url() ?>/list-post/">-- Tất cả --</option>
									<option <?php echo ($_GET['filter'] == 'publish')?'selected':''; ?> value="<?php echo get_site_url() ?>/list-post/?filter=publish">Đã post</option>
									<option <?php echo ($_GET['filter'] == 'pending')?'selected':''; ?> value="<?php echo get_site_url() ?>/list-post/?filter=pending">Chờ duyệt</option>
								</select>
							</div>
						</h2>
					</div>
          <script type="text/javascript">
          jQuery(document).ready(function($){
            $( "#user-post-filter" ).on('change',function() {
              window.location.href = $(this).val();
            });
          });
          </script>
					<div class="content-user content-post">
						<ul class="row">
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
		'post_status' => $filter,
    'orderby'       =>  'post_date',
    'order'         =>  'DESC',
		'post_type'      => 'post',
		'author'        =>  $current_user->ID,
		'category__not_in' => array(1),
		'paged'          => $paged,
    'posts_per_page' => 80
    );
$the_query = new WP_Query( $args );
//var_dump($the_query);
if($the_query->have_posts()){
	while ($the_query->have_posts()){
		$the_query->the_post(); ?>
							<li class="col-md-4 col-sm-6 col-xs-12 list-post-item">
								<div class="show-article-details">
									<figure>
										<a href="<?php echo (get_post_status(get_the_ID()) != 'pending')? get_the_permalink(): '#'; ?>" title="<?php the_title(); ?>">
										<?php 
											$attachment_id = get_post_thumbnail_id(get_the_ID());
											if (!empty($attachment_id)) { 
												the_post_thumbnail(array($width, $height)); ?>
											<?php }else{ ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
										<?php	} ?>
												<div class="blur"></div>
											</a>
										<figcaption>
											<p><a href="<?php echo (get_post_status(get_the_ID()) != 'pending')? get_the_permalink(): '#'; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
											<p class="edit-delete">
                        <a href="<?php echo get_site_url() ?>/edit-post/?pid=<?php echo get_the_ID(); ?>&action=edit">
													<span class="fa fa-pencil-square"></span>
													Sửa
												</a>
												<a href="<?php echo get_site_url() ?>/edit-post/?pid=<?php echo get_the_ID(); ?>&action=del&_wpnonce=f0f2bb2c7d" onclick="return confirm('Bạn có muốn xoá không?');">
													<span class="fa fa-trash-o"></span>
													Xóa
												</a>
												<span class="waiting">
													<?php echo (get_post_status(get_the_ID()) == 'pending')? '<span class="fa fa-minus-square fa-cck fa-visible"></span>': '<span class="fa fa-check-square-o fa-cck fa-active"></span>'; ?>
												</span>
											</p>
										</figcaption>
									</figure>
								</div>
							</li>
	<?php }
}
?>
						</ul>
						<div class="row">
						<div class="paging col-md-12">
						<nav>
							<nav>
								<?php	 wp_pagenavi(array('query' => $the_query )) ; ?>
							</nav>
						</nav>
					</div><!--end pagination-->
					</div>
					</div><!--end content-user-->

				</div>
			</div><!--end left-user-->

			<div id="sidebar" class="col-md-3 col-sm-3 col-xs-12 sidebar-user">
				<?php get_template_part('block/menu-user-profile'); ?>
				<?php get_template_part('block/menu_right'); ?>

			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>