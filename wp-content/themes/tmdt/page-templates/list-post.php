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
							Thông tin bài post
							<div class="status">
								<span>Trạng thái</span>
								<select name="" id="">
									<option value="">Đã post</option>
									<option value="">Chờ duyệt</option>
								</select>
							</div>
						</h2>
					</div>
					<div class="content-user content-post">
						<ul class="row">
<?php
$filter = array();
if(isset($_GET['filter']) && $_GET['filter'] == 'pending'){
	$filter = array('pending');
}elseif (isset($_GET['filter']) && $_GET['filter'] == 'publish') {
	$filter = array('publish');
}else{
	$filter = array('publish','pending');
}
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
		'post_status' => $filter,
    'orderby'       =>  'post_date',
    'order'         =>  'DESC',
		'post_type'      => 'post',
		'author'        =>  $current_user->ID,
		'category__not_in' => array('uncategorized'),
		'paged'          => $paged,
    'posts_per_page' => 80
    );
$the_query = new WP_Query( $args );
//var_dump($the_query);
if($the_query->have_posts()){
	while ($the_query->have_posts()){
		$the_query->the_post(); ?>
							<li class="col-md-4">
								<div class="show-article-details">
									<figure>
										<a href="<?php echo (get_post_status(get_the_ID()) != 'pending')? get_the_permalink(): '#'; ?>" title="<?php the_title(); ?>">
										<?php 
											$attachment_id = get_post_thumbnail_id(get_the_ID());
											if (!empty($attachment_id)) { 
												the_post_thumbnail(array(269, 179)); ?>
											<?php }else{ ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default.jpg" alt="<?php the_title() ?>" title="<?php the_title() ?>">
										<?php	} ?>
												<div class="blur"></div>
											</a>
										<figcaption>
											<p><a href="<?php echo (get_post_status(get_the_ID()) != 'pending')? get_the_permalink(): '#'; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
											<?php if(get_field('address')): ?><p class="address"><?php echo get_field('address'); ?></p> <?php endif; ?>
											<p class="edit-delete">
												<a>
													<span class="fa fa-pencil-square"></span>
													Sửa
												</a>
												<a>
													<span class="fa fa-trash-o"></span>
													Xóa
												</a>
												<span class="waiting">
													<?php echo (get_post_status(get_the_ID()) == 'pending')? 'Pending': 'Published'; ?>
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

			<div id="sidebar" class="col-md-3">
				<?php get_template_part('block/menu-user-profile'); ?>

			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>