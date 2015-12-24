<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


<?php
$keyword = $_GET['s'];
if(!empty($keyword)){
	$data = getListCategory('news');
	$slug = '';
	foreach ($data as $dataSearch){
		$a = $dataSearch->name;
		var_dump($a);
		if($keyword == htmlentities($dataSearch->name, ENT_QUOTES | ENT_IGNORE, "UTF-8")){
			$slug = $dataSearch->name;
		}
	}
	if(!empty($slug)){
		// tim theo danh muc
	}else{
		// tim tong the.
	}
//	echo htmlentities($str, ENT_QUOTES | ENT_IGNORE, "UTF-8").'<br>';
	var_dump($slug);
//	var_dump($data);
//	echo $data[1]->name;
	
}else{
	// khong co ket qua.
}
?>
<section class="search all-article">
	<div class="container">
		<div class="row">
			<div class="col-md-8 show-search">
				<ul class="row">
					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>

					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>

					<li class="col-md-6">
						<div class="show-article-details">
							<figure>
								<a href="#">
									<img src="images/fashion-2.jpg" alt="">
									<div class="blur"></div>
								</a>
								<figcaption>
									<p><a href="#">Công ty TNHH 1 thành viên thương mại điện tử MTV</a></p>
									<p class="address">237/92A Trần Văn Đang, Phường 11, Quận 3, Tp. Hồ Chí Minh</p>
									<p>
										<span>Bình chọn:</span>
										<img src="images/vote.png" alt="">
									</p>
									<p class="review">
										Bình luận: <span>23.000</span>
									</p>
								</figcaption>
							</figure>
						</div>
					</li>


				</ul>
			</div>
			<div id="sidebar" class="col-md-4">
				<div class="title-map">
					<h2>
						<span class="fa fa-map-marker"></span>
						Thông tin bản đồ
					</h2>
				</div>
				<div class="map-search">
					<img src="images/map-1.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</section>


<!--	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
			</header> .page-header 

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next post navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div> #content 
	</section> #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
